<?php
require FCPATH . 'vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use SebastianBergmann\Diff\Diff;

class Academic extends CI_Controller
{
    # pages
    public function index()
    {
        if ($this->session->userdata('user_type') == 'student' or !$this->session->userdata('username')) {
            redirect(site_url());
        } else {
            $latest_year = $this->academic_model->get_latest_academicyear();
            $years = explode("/", $latest_year['acadyear']);
            $suggested_year = '';
            foreach ($years as $i => $year) {
                $years[$i] = $year + 1;
            }
            $suggested_year = $years[0] . '/' . $years[1];
            $data = array(
                'academicyear' => $this->academic_model->get_academicyear(),
                'academicsession' => $this->academic_model->get_academicsession(),
                'academicplan' => $this->academic_model->get_academicplan(),
                'semesters' => $this->semester_model->get_semesters(),
                'title' => 'Academic Control Page',
                'new_year' => $suggested_year
            );
            $this->load->view('templates/header');
            $this->load->view('academic/index', $data);
            $this->load->view('templates/footer');
        }
    }

    public function academicplanstudent()
    {
        # for student
        if (!$this->session->userdata('user_type') == 'student' and !$this->session->userdata('username')) {
            redirect(site_url());
        }
        $student_id = $this->session->userdata('username');
        $student = $this->student_model->get_student($student_id);
        $activeacadsession = $this->academic_model->get_activeacademicsession();
        $data = array(
            'student_id' => $student_id,
            'student' => $student,
            'thisacademicplan' => $this->academic_model->get_this_academicplan(
                $student_id,
                $activeacadsession['id']
            ),
            'academicsessions' => $this->academic_model->get_academicsession(),
            'academicyears' => $this->academic_model->get_academicyear(),
            'semesters' => $this->semester_model->get_semesters(),
            'title' => 'Academic Plan: ' . $student['name'],
            'academicplans' => $this->scoretable->get_arraytable_academicplan(
                $this->academic_model->get_academicplan($student_id)
            ),
            'activeacadsession' => $activeacadsession
        );
        $this->load->view('templates/header');
        $this->load->view('academic/plan/student', $data);
        $this->load->view('templates/footer');
    }

    public function academicplanmentor()
    {
        # for mentor
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
            'title' => "Student's academic plan",
            'academicplans' => $academicplans,
            'academicyears' => $this->academic_model->get_academicyear(),
            'semesters' => $this->semester_model->get_semesters(),
            'activesession' => $activesession
        );
        // print_r($activesession);
        $this->load->view('templates/header');
        $this->load->view('academic/plan/mentor', $data);
        $this->load->view('templates/footer');
    }

    public function academicplanrecords()
    {
        $acadyear_id = $this->input->post('acadyear_id');
        $semester = $this->input->post('semester');
        $academicsession = $this->academic_model->get_academicsession_byyearsem($acadyear_id, $semester);
        if (!isset($academicsession)) {
            $this->load->view('templates/header');
            $this->load->view('academic/plan/norecord');
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
            # create chart from academicplans
            $barData = [];
            $barData['label'] = ['1 - 1.5', '1.5 - 2', '2 - 2.5', '2.5 - 3', '3 - 3.5', '3.5 - 4'];
            $barData['threshold'] = [1, 1.5, 2, 2.5, 3, 3.5, 4];
            foreach ($barData['label'] as $i => $group) {
                foreach ($academicplans as $plan) {
                    $gpa = $plan['gpa_achieved'];
                    if ($gpa > $group['threshold']) {
                    }
                }
            }
            $data = array(
                'title' => 'Academic Plan Records',
                'academicyears' => $this->academic_model->get_academicyear(),
                'semesters' => $this->semester_model->get_semesters(),
                'academicsession' => $academicsession,
                'academicplans' => $academicplans
            );

            $this->load->view('templates/header');
            $this->load->view('academic/plan/records', $data);
            $this->load->view('templates/footer');
        }
    }

    public function records()
    {
        $student_id = $this->input->post('student_id');
        $acadyear_id = $this->input->post('acadyear_id');
        $semester_id = $this->input->post('semester_id');
        if ((!$student_id and !$acadyear_id and !$semester_id) or !$this->session->userdata('user_type') == 'student') {
            redirect('academicplan/student');
        }
        $student = $this->student_model->get_student($student_id);
        $selected_academicsession = $this->academic_model->get_academicsession_byyearsem($acadyear_id, $semester_id);
        if ($selected_academicsession) {
            $total_all = 0;
            $scoreleveltotal = $this->score_model->get_maxscore_position() + $this->score_model->get_maxscore_meeting() + $this->score_model->get_maxscore_attendance() + $this->score_model->get_maxscore_involvement();
            $scoreplans = $this->score_model->get_scoreplan($selected_academicsession['id'], FALSE);
            // print_r($scoreplans);
            foreach ($scoreplans as $i => $scoreplan) {
                $scores = $this->score_model->get_scoreplan_scorelevel($student_id, $scoreplan['id']);
                $total = $scores ? array_sum($scores) : 0;
                $totalpercent = ($total / $scoreleveltotal) * $scoreplan['percentweightage'];
                $scoreplans[$i]['scores'] = $scores ? $scores : array('position' => '-', 'involvement' => '-', 'meeting' => '-', 'attendance' => '-');
                $scoreplans[$i]['total'] = $total;
                $scoreplans[$i]['totalpercent'] = $totalpercent;
                $total_all += $totalpercent;
            }
            $scorecomp = $this->score_model->get_student_scorecomp($student_id, $selected_academicsession['id']);
            $scorecomps = array('scores' => $this->score_model->get_scoreplan_scorecomp($student_id, $selected_academicsession['id']));
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
                'academicsession' => $selected_academicsession,
                // 'citras' => $this->citra_model->get_citra_registered($student_id, $selected_academicsession['id']),
                'academicplan' => $this->academic_model->get_academicplan($student_id, $selected_academicsession['id']),
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
            // print_r($data['scoreplans']);
            $this->load->view('templates/header');
            $this->load->view('academic/records', $data);
            $this->load->view('templates/footer');
        } else {
            # put error message
            redirect('academicplan/student');
        }
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
            $enrolledstudents = $this->student_model->get_enrolling_students($activesession['id'], $sig_id);
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

    # unenroll
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
        $acy = $this->academic_model->get_academicyear($this->input->post('acadyear_id'));
        $academicsessiontitle = $acy['acadyear'] . '-' . $this->input->post('semester');
        $acs_slug = url_title($academicsessiontitle);
        $acadyear_id = $this->input->post('acadyear_id');
        $semester = $this->input->post('semester');
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
                'status' => 'inactive'
            );
            $this->academic_model->create_acs($acsdata);
        }
        redirect('academic');
    }

    public function create_academicyear()
    {
        $acadyear = $this->input->post('acadyear');
        $where = array('acadyear' => $acadyear);
        $yearexist = $this->academic_model->check_academicyear_exist($where);
        if (!$yearexist) {
            $acydata = array(
                'acadyear' => $acadyear,
                'status' => 'inactive'
            );
            $this->academic_model->create_acy($acydata);
        }
        redirect('academic');
    }

    public function set_activesession()
    {
        $id = $this->input->post('session_id');
        $this->academic_model->setactive_acadsession($id);
        redirect('academic');
    }

    public function set_endsession()
    {
        $acadsession_id = $this->input->post('session_id');
        $this->academic_model->set_endsession($acadsession_id);
        redirect('academic');
    }

    public function set_activeyear()
    {
        $id = $this->input->post('acadyear_id');
        $this->academic_model->setactive_acadyear($id);
        redirect('academic');
    }

    public function set_gpatarget()
    {
        $where = array(
            'student_id' => $this->input->post('student_id'),
            'acadsession_id' => $this->input->post('acadsession_id')
        );
        $gpa = array('gpa_target' => $this->input->post('gpa_target'));
        $this->academic_model->set_gpa($where, $gpa);
        redirect('academicplan/student');
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
            redirect(site_url('academicplan/mentor'));
        }
    }
}