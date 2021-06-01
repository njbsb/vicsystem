<?php
require FCPATH . 'vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use SebastianBergmann\Diff\Diff;

class Academic extends CI_Controller
{
    # route, vicsystem/academic
    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect(site_url());
        }
        $usertype = $this->session->userdata('user_type');
        switch ($usertype) {
            case  'admin':
            case 'mentor':
                $this->academicplanmentor();
                break;
            case 'student':
                $this->academicplanstudent();
                break;
        }
    }

    # route vicsystem/academic/record
    public function record()
    {
        if (!$this->session->userdata('username')) {
            redirect(site_url());
        }
        $usertype = $this->session->userdata('user_type');
        switch ($usertype) {
            case  'admin':
            case 'mentor':
                $this->academicrecordmentor();
                break;
            case 'student':
                $this->academicrecordstudent();
                break;
        }
    }

    # page, for mentor/admin only
    public function academiccontrol()
    {
        $academicsession = $this->academic_model->get_activeacademicsession();
        $latest_year = $this->academic_model->get_latest_academicyear();
        $suggested_year = '';
        if (!$latest_year) {
            # if no data originally exists in db, then we'll take last years as initial year
            $year1 = intval(date('Y')) - 1;
            $year2 = $year1 + 1;
            $suggested_year = $year1 . '/' . $year2;
        } else {
            $years = explode("/", $latest_year['acadyear']);
            foreach ($years as $i => $year) {
                $years[$i] = $year + 1;
            }
            $suggested_year = $years[0] . '/' . $years[1];
        }

        $semesters = $this->semester_model->get_semesters();
        $academicsessions = $this->academic_model->get_academicsession_activeyear();
        $academicyears = $this->academic_model->get_academicyear();
        $activeyear = $this->academic_model->get_activeacadyear();
        $now = time();
        # Rule: if current date is still within the active academic session, user cannot create new one
        $btn_acy = true;
        $btn_acs = true;
        foreach ($academicsessions as $i => $acs) {
            $startdate = strtotime($acs['startdate']);
            $enddate = strtotime($acs['enddate']);
            $academicsessions[$i]['status'] = ($now >= $startdate and $now <= $enddate) ? 'active' : 'inactive';
            if ($now >= $startdate) {
                if ($now <= $enddate) {
                    $progress = 'On Going';
                } else {
                    $progress = 'Ending';
                }
            } else {
                $progress = 'Incoming';
            }
            $academicsessions[$i]['progress'] = $progress;
            if ($now < $enddate) {
                $btn_acs = false;
                # still within acs, cannoi create new acs
                # button.disabled should be true
            }
        }
        foreach ($academicyears as $i => $acy) {
            $startdate = strtotime($acy['startdate']);
            $enddate = strtotime($acy['enddate']);
            $academicyears[$i]['status'] = ($now >= $startdate and $now <= $enddate) ? 'active' : 'inactive';
            if ($now < $enddate) {
                $btn_acy = false;
                # still within acs, cannoi create new acs
            }
        }
        foreach ($semesters as $i => $semester) {
            foreach ($academicsessions as $session) {
                if ($session['semester'] == $semester) {
                    unset($semesters[$i]);
                }
            }
        }
        $data = array(
            'activeyear' => $this->academic_model->get_activeacadyear(),
            'academicyear' => $academicyears,
            'academicsession' => $academicsessions,
            'semesters' => $semesters,
            'title' => 'Academic Control Page',
            'new_year' => $suggested_year,
            'btn_acs' => $btn_acs,
            'btn_acy' => $btn_acy
        );
        # btn_acs and #
        $this->load->view('templates/header');
        $this->load->view('academic/index', $data);
        $this->load->view('templates/footer');
    }

    # page, for student
    public function academicplanstudent()
    {
        if (!$this->session->userdata('user_type') == 'student' and !$this->session->userdata('username')) {
            redirect(site_url());
        }
        $student_id = $this->session->userdata('username');
        $student = $this->student_model->get_student($student_id);
        $activesession = $this->academic_model->get_activeacademicsession();
        $data = array(
            'student_id' => $student_id,
            'student' => $student,
            'thisacademicplan' => $this->academic_model->get_this_academicplan(
                $student_id,
                $activesession['id']
            ),
            'academicsessions' => $this->academic_model->get_academicsession(),
            'academicyears' => $this->academic_model->get_academicyear(),
            'semesters' => $this->semester_model->get_semesters(),
            'title' => 'Academic Plan: ' . $student['name'],
            'academicplans' => $this->scoretable->get_arraytable_academicplan(
                $this->academic_model->get_academicplan($student_id, '')
            ),
            'activesession' => $activesession,
            'today' => time(),
            'examdate' => date('Y-m-d', strtotime("+4 months", strtotime($activesession['startdate'])))
        );
        $this->load->view('templates/header');
        $this->load->view('academic/plan/student', $data);
        $this->load->view('templates/footer');
    }

    #  page, for mentor
    public function academicplanmentor()
    {
        if (!$this->session->userdata('user_type') == 'mentor' and !$this->session->userdata('username')) {
            redirect('home');
        }
        $activesession = $this->academic_model->get_activeacademicsession();
        $academicplans = $this->academic_model->get_academicplan(FALSE, $activesession['id']);
        foreach ($academicplans as $i => $acp) {
            $diff = $acp['gpa_achieved'] - $acp['gpa_target'];
            $academicplans[$i]['difference'] = $diff;
            if ($diff > 0) {
                $status = 'Passed';
                $textclass = 'text-success';
            } elseif ($diff < 0) {
                $status = 'Not Pass';
                $textclass = 'text-warning';
            } else {
                $status = 'Constant';
                $textclass = '';
            }
            $academicplans[$i]['status'] = $status;
            $academicplans[$i]['textclass'] = $textclass;
        }
        $data = array(
            'title' => "Student's Academic Records",
            'academicplans' => $academicplans,
            'academicyears' => $this->academic_model->get_academicyear(),
            'semesters' => $this->semester_model->get_semesters(),
            'activesession' => $activesession,
            'today' => time(),
            'examdate' => date('Y-m-d', strtotime("+4 months", strtotime($activesession['startdate'])))
        );
        $this->load->view('templates/header');
        $this->load->view('academic/plan/mentor', $data);
        $this->load->view('templates/footer');
    }

    public function academicrecordstudent()
    {
        $student_id = $this->input->post('student_id');
        $acadsession_id = $this->input->post('acadsession_id');
        if ((!$student_id and !$acadsession_id) or !$this->session->userdata('user_type') == 'student') {
            redirect('academic');
        }
        $student = $this->student_model->get_student($student_id);
        if ($acadsession_id) {
            $total_all = 0;
            $scoreleveltotal = $this->score_model->get_maxscore_position() + $this->score_model->get_maxscore_meeting() + $this->score_model->get_maxscore_attendance() + $this->score_model->get_maxscore_involvement();
            $scoreplans = $this->score_model->get_scoreplan($acadsession_id, FALSE);
            foreach ($scoreplans as $i => $scoreplan) {
                $scores = $this->score_model->get_scoreplan_scorelevel($student_id, $scoreplan['id']);
                $total = $scores ? array_sum($scores) : 0;
                $totalpercent = ($total / $scoreleveltotal) * $scoreplan['percentweightage'];
                $scoreplans[$i]['scores'] = $scores ? $scores : array('position' => '-', 'involvement' => '-', 'meeting' => '-', 'attendance' => '-');
                $scoreplans[$i]['total'] = $total;
                $scoreplans[$i]['totalpercent'] = $totalpercent;
                $total_all += $totalpercent;
            }
            $scorecomp = $this->score_model->get_student_scorecomp($student_id, $acadsession_id);
            $scorecomps = array('scores' => $this->score_model->get_scoreplan_scorecomp($student_id, $acadsession_id));
            $scorecomps['totalpercent'] = (!empty($scorecomps['scores'])) ? array_sum($scorecomps['scores']) : 0;
            $totalcomp = 0;
            $totalcomp += $scorecomps['totalpercent'];
            if (!is_null($scorecomp)) {
                $scorecomp['total'] = $scorecomp['digitalcv'] + $scorecomp['leadership'] + $scorecomp['volunteer'];
                $total_all += $scorecomp['total'];
            }
            $data = array(
                'title' => 'Academic Record: ' . $student['name'],
                'student' => $student,
                'academicsession' => $this->academic_model->get_academicsession($acadsession_id),
                'academicplan' => $this->academic_model->get_academicplan($student_id, $acadsession_id),
                'levelrubrics' => $this->scoretable->get_level_rubrics(),
                'scoreplans' => $scoreplans,
                'scorecomps' => $scorecomps,
                'totalcomp' => $totalcomp,
                'total_all' => $total_all,
                'scoreleveltotal' => $this->score_model->get_scoreleveltotal(),
                'guide' => array(
                    'position' => $this->score_model->get_guideposition(),
                    'meeting' => $this->score_model->get_guidemeeting(),
                    'involvement' => $this->score_model->get_guideinvolvement(),
                    'attendance' => $this->score_model->get_guideattendance(),
                    'digitalcv' => $this->score_model->get_guidedigitalcv(),
                    'leadership' => $this->score_model->get_guideleadership()
                )
            );
            $this->load->view('templates/header');
            $this->load->view('academic/records', $data);
            $this->load->view('templates/footer');
        } else {
            # put error message
            redirect('academic');
        }
    }

    public function academicrecordmentor()
    {
        $acadyear_id = $this->input->post('acadyear_id');
        $semester = $this->input->post('semester');
        $academicsession = $this->academic_model->get_academicsession_byyearsem($acadyear_id, $semester);
        if (!isset($academicsession)) {
            $this->load->view('templates/header');
            $this->load->view('academic/plan/norecord');
            $this->load->view('templates/footer');
        } else {
            $academicplans = $this->academic_model->get_academicplan(FALSE, $academicsession['id']);
            foreach ($academicplans as $i => $acp) {
                $diff = $acp['gpa_achieved'] - $acp['gpa_target'];
                $academicplans[$i]['difference'] = $diff;
                if ($diff > 0) {
                    $status = 'Passed';
                    $textclass = 'text-success';
                } elseif ($diff < 0) {
                    $status = 'Not Pass';
                    $textclass = 'text-warning';
                } else {
                    $status = 'Constant';
                    $textclass = '';
                }
                $academicplans[$i]['status'] = $status;
                $academicplans[$i]['textclass'] = $textclass;
            }
            $data = array(
                'title' => 'Academic Records',
                'academicyears' => $this->academic_model->get_academicyear(),
                'semesters' => $this->semester_model->get_semesters(),
                'academicsession' => $academicsession,
                'academicplans' => $academicplans,
                'acadyear_id' => $acadyear_id,
                'semester' => $semester
            );
            $this->load->view('templates/header');
            $this->load->view('academic/plan/records', $data);
            $this->load->view('templates/footer');
        }
    }

    public function download_record()
    {
        $postdata = $this->input->post();
        $acadyear_id = $postdata['acadyear_id'];
        $semester = $postdata['semester'];
        $academicsession = $this->academic_model->get_academicsession_byyearsem($acadyear_id, $semester);
        $academicplans = $this->academic_model->get_academicplan(FALSE, $academicsession['id']);
        foreach ($academicplans as $i => $acp) {
            # acp = students
            $diff = $acp['gpa_achieved'] - $acp['gpa_target'];
            $academicplans[$i]['difference'] = $diff;
            if ($diff > 0) {
                $status = 'Passed';
            } elseif ($diff < 0) {
                $status = 'Not Pass';
            } else {
                $status = 'Constant';
            }
            $academicplans[$i]['status'] = $status;
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $academicsession['academicsession'] . ' Academic Records.xlsx"');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Academic Year');
        $sheet->setCellValue('B1', 'Semester');
        $sheet->setCellValue('C1', 'Matric');
        $sheet->setCellValue('D1', 'Name');
        $sheet->setCellValue('E1', 'GPA Target');
        $sheet->setCellValue('F1', 'GPA Achieved');
        $sheet->setCellValue('G1', 'Increment');
        $sheet->setCellValue('H1', 'Target Status');
        foreach ($academicplans as $i => $student) {
            $i += 1;
            $sheet->setCellValue('A' . $i + 1, $academicsession['academicyear']);
            $sheet->setCellValue('B' . $i + 1, $semester);
            $sheet->setCellValue('C' . $i + 1, $student['student_id']);
            $sheet->setCellValue('D' . $i + 1, $student['name']);
            $sheet->setCellValue('E' . $i + 1, $student['gpa_target']);
            $sheet->setCellValue('F' . $i + 1, $student['gpa_achieved']);
            $sheet->setCellValue('G' . $i + 1, $student['difference']);
            $sheet->setCellValue('H' . $i + 1, $student['status']);
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    # controller functions
    public function enroll()
    {
        # to enroll students into new academic session

        if (!$this->session->userdata('username') or $this->session->userdata('user_type') == 'student') {
            redirect(site_url());
        }
        $this->form_validation->set_rules('acadsession_id', 'academic session', 'required');
        // $this->form_validation->set_rules('students', 'student', 'required');

        if ($this->form_validation->run() == FALSE) {
            $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
            $activesession = $this->academic_model->get_activeacademicsession();
            $enrolledstudents = $this->student_model->get_enrolling_students($activesession['id']);
            $data = array(
                'title' => 'Student Enrollment',
                'availablestudents' => $this->student_model->get_available_sigstudents($sig_id, $enrolledstudents),
                'enrolledstudents' => $enrolledstudents,
                'activesession' => $activesession
            );
            $this->load->view('templates/header');
            $this->load->view('academic/enroll', $data);
            $this->load->view('templates/footer');
        } else {
            # data is submitted
            $acadsession_id = $this->input->post('acadsession_id');
            $students = $this->input->post('unenrollstudents');
            foreach ($students as $std_id) {
                $this->academic_model->create_academicplan($acadsession_id, $std_id);
            }
            redirect('enroll');
        }
    }

    public function unenroll()
    {
        $acadsession_id = $this->input->post('acadsession_id');
        $students = $this->input->post('enrollstudents');
        foreach ($students as $std) {
            $this->academic_model->delete_academicplan($acadsession_id, $std);
        }
        redirect('enroll');
    }

    # called when mentor enroll students
    public function create_academicplan($student_id)
    {
        $acadsession_id = $this->input->post('activeacadsession_id');
        $acpdata = array(
            'student_id' => $student_id,
            'acadsession_id' => $acadsession_id,
            'gpa_target' => $this->input->post('gpa_target')
        );
        $this->academic_model->create_academicplan($acpdata);
        redirect('academicplan/student');
    }

    # called by mentor in academic control panel
    public function create_academicsession()
    {
        $postdata = $this->input->post();
        $acy = $this->academic_model->get_academicyear($postdata['acadyear_id']);
        $academicsessiontitle = $acy['acadyear'] . '-' . $postdata['semester'];
        $acs_slug = url_title($academicsessiontitle);
        $acadyear_id = $postdata['acadyear_id'];
        $semester = $postdata['semester'];
        $where = array(
            'acadyear_id' => $acadyear_id,
            'semester' => $semester
        );
        $sessionexist = $this->academic_model->check_academicsession_exist($where);
        if (!$sessionexist) {
            $acsdata = array(
                'acadyear_id' => $acadyear_id,
                'semester' => $semester,
                'slug' => $acs_slug,
                'startdate' => $postdata['acs_startdate'],
                'enddate' => $postdata['acs_enddate']
            );
            $this->academic_model->create_acs($acsdata);
        }
        redirect('academic/control');
    }

    public function create_academicyear()
    {
        $postdata = $this->input->post();
        $acadyear = $postdata['acadyear'];
        $where = array('acadyear' => $acadyear);
        $yearexist = $this->academic_model->check_academicyear_exist($where);
        if (!$yearexist) {
            $acydata = array(
                'acadyear' => $acadyear,
                'startdate' => $postdata['acy_startdate'],
                'enddate' => $postdata['acy_enddate']
            );
            $this->academic_model->create_acy($acydata);
        }
        redirect('academic/control');
    }

    public function update_academicsession()
    {
        $postdata = $this->input->post();
        $id = $postdata['acadsession_id'];
        $startdate = $postdata['acs_editstartdate'];
        $enddate = $postdata['acs_editenddate'];
        $data = array(
            'startdate' => $startdate,
            'enddate' => $enddate
        );
        $this->academic_model->update_academicsession($id, $data);
        redirect('academic/control');
    }

    public function update_academicyear()
    {
        $postdata = $this->input->post();
        $id = $postdata['acadyear_id'];
        $startdate = $postdata['acy_editstartdate'];
        $enddate = $postdata['acy_editenddate'];
        $data = array(
            'startdate' => $startdate,
            'enddate' => $enddate
        );
        $this->academic_model->update_academicyear($id, $data);
        redirect('academic/control');
    }

    public function set_gpatarget()
    {
        $where = array(
            'student_id' => $this->input->post('student_id'),
            'acadsession_id' => $this->input->post('acadsession_id')
        );
        $gpa = array('gpa_target' => $this->input->post('gpa_target'));
        $this->academic_model->set_gpa($where, $gpa);
        redirect('academic');
    }

    public function import_result()
    {
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
        switch ($extension) {
            case 'xlsx':
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                break;
            case 'xls':
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                break;
            case 'csv':
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                break;
        }
        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        $sheetcount = count($sheetdata);
        if ($sheetcount > 1) {
            for ($i = 1; $i < $sheetcount; $i++) {
                $acadsession_id = $sheetdata[$i][0];
                $student_id = $sheetdata[$i][1];
                $gpa_achieved = $sheetdata[$i][2];
                $data[] = array(
                    'acadsession_id' => $acadsession_id,
                    'student_id' => $student_id,
                    'gpa_achieved' => $gpa_achieved
                );
            }
            $rowaffected = $this->academic_model->import_gpa_achieved($data);
            if ($rowaffected > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">' . $rowaffected . ' rows affected</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">' . $rowaffected . ' rows affected</div>');
            }
            redirect(site_url('academic'));
        }
    }
}