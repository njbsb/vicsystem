<?php
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
            // print_r($data['semesters']);
            $this->load->view('templates/header');
            $this->load->view('academic/index', $data);
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
            'title' => 'Student Academic Plan: ' . $student['name'],
            'academicplans' => $this->scoretable->get_arraytable_academicplan(
                $this->academic_model->get_academicplan($student_id)
            ),
            'activeacadsession' => $activeacadsession
        );
        $this->load->view('templates/header');
        $this->load->view('academic/plan/student', $data);
    }

    public function academicplanmentor()
    {
        # for mentor
        if (!$this->session->userdata('user_type') == 'mentor' and !$this->session->userdata('username')) {
            redirect('home');
        }
        $activesession = $this->academic_model->get_activeacademicsession();
        $data = array(
            'title' => "Student's academic plan",
            'academicplans' => $this->academic_model->get_academicplan(FALSE, $activesession['id']),
            'academicyears' => $this->academic_model->get_academicyear(),
            'semesters' => $this->semester_model->get_semesters(),
            'activesession' => $activesession
        );
        $this->load->view('templates/header');
        $this->load->view('academic/plan/mentor', $data);
    }

    public function academicplanrecords()
    {
        $acadyear_id = $this->input->post('acadyear_id');
        $semester = $this->input->post('semester');
        $academicsession = $this->academic_model->get_academicsession_byyearsem($acadyear_id, $semester);
        if (empty($academicsession)) {
            $this->load->view('templates/header');
        } else {
            $academicplans = $this->academic_model->get_academicplan(FALSE, $academicsession['id']);
            $data = array(
                'title' => 'Academic Plan Records',
                'academicyears' => $this->academic_model->get_academicyear(),
                'semesters' => $this->semester_model->get_semesters(),
                'academicsession' => $academicsession,
                'academicplans' => $academicplans
            );
            $this->load->view('templates/header');
            $this->load->view('academic/plan/records', $data);
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
            $scoreplans = $this->score_model->get_scoreplan($student['sig_id'], $selected_academicsession['id'], FALSE);
            foreach ($scoreplans as $i => $scoreplan) {
                $scores = $this->score_model->get_scoreplan_scorelevel($student_id = $student_id, $scoreplan['id']);
                $total = $scores ? array_sum($scores) : 0;
                $totalpercent = ($total / $scoreleveltotal) * $scoreplan['percentweightage'];
                $scoreplans[$i]['scores'] = $scores ? $scores : array(0, 0, 0, 0);
                $scoreplans[$i]['total'] = $total;
                $scoreplans[$i]['totalpercent'] = $totalpercent;
                $total_all += $totalpercent;
            }
            $scorecomp = $this->score_model->get_student_scorecomp($student_id, $selected_academicsession['id']);
            if (!is_null($scorecomp)) {
                $scorecomp['total'] = $scorecomp['digitalcv'] + $scorecomp['leadership'] + $scorecomp['volunteer'];
                $total_all += $scorecomp['total'];
            }
            $data = array(
                'title' => 'Record: ' . $student['name'],
                'student' => $student,
                'academicsession' => $selected_academicsession,
                // 'citras' => $this->citra_model->get_citra_registered($student_id, $selected_academicsession['id']),
                'academicplan' => $this->academic_model->get_academicplan($student_id, $selected_academicsession['id']),
                'levelrubrics' => $this->scoretable->get_level_rubrics(),
                'scoreplans' => $scoreplans,
                'scorecomp' => $scorecomp,
                'total_all' => $total_all
            );
            $this->load->view('templates/header');
            $this->load->view('academic/records', $data);
        } else {
            # put error message
            redirect('academicplan/student');
        }
    }

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
        } else {
            # data is submitted
            $acadsession_id = $this->input->post('acadsession_id');
            $students = $this->input->post('students');
            foreach ($students as $std_id) {
                $this->academic_model->create_academicplan($acadsession_id, $std_id);
            }
            redirect('enroll');
        }
    }

    # controller functions

    # unenroll
    public function unenroll()
    {
        $acadsession_id = $this->input->post('acadsession_id');
        $students = $this->input->post('students');
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
            'student_matric' => $student_id,
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
        $academicsessiontitle = $acy['acadyear'] . '-' . $this->input->post('semester_id');
        $acs_slug = url_title($academicsessiontitle);

        $acsdata = array(
            'acadyear_id' => $this->input->post('acadyear_id'),
            'semester_id' => $this->input->post('semester_id'),
            'slug' => $acs_slug,
            'status' => 'inactive'
        );
        $this->academic_model->create_acs($acsdata);
        redirect('academic');
    }

    public function create_academicyear()
    {
        $acydata = array(
            'acadyear' => $this->input->post('acadyear'),
            'status' => 'inactive'
        );
        $this->academic_model->create_acy($acydata);
        redirect('academic');
    }

    public function set_activesession()
    {
        $id = $this->input->post('session_id');
        $this->academic_model->setactive_acadsession($id);
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
            'student_matric' => $this->input->post('student_id'),
            'acadsession_id' => $this->input->post('acadsession_id')
        );
        $gpa = array('gpa_target' => $this->input->post('gpa_target'));
        $this->academic_model->set_gpa($where, $gpa);
        redirect('academicplan/student');
    }
}