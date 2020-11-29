<?php
class Student extends CI_Controller
{

    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect(site_url());
        }
        if ($this->session->userdata('isStudent')) {
            redirect(site_url());
        }
        $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
        $sig = $this->sig_model->get_sig($sig_id);
        if ($this->session->userdata('isMentor')) {
            $students = $this->student_model->get_student('', $sig_id);
            $title = $sig['code'] . ' Students';
        }
        if ($this->session->userdata('isAdmin')) {
            $students = $this->student_model->get_student();
            $title = 'All Students';
        }
        $data = array(
            'title' => $title,
            'students' => $students
        );
        $this->load->view('templates/header');
        $this->load->view('student/index', $data);
    }

    public function view($student_id)
    {
        if ($this->session->userdata('isStudent')) {
            redirect(site_url());
        }
        $student = $this->student_model->get_student($student_id);
        if (!array_filter($student)) {
            show_404();
        }
        if (date('Y') - $student['year_joined'] + 1 > 4) {
            $student['year'] = 'Alumni';
        } else {
            $student['year'] = date('Y') - $student['year_joined'] + 1;
        }
        $data = array(
            'student' => $student,
            'activity_roles' => $this->committee_model->get_activityroles($student_id),
            'org_roles' => $this->committee_model->get_orgroles($student_id, $student['sig_id'])
        );
        $this->load->view('templates/header');
        $this->load->view('student/view', $data);
        $this->load->view('templates/footer');
    }

    public function edit($student_id = NULL)
    {
        if ($this->session->userdata('isStudent')) {
            redirect('student');
        }
        $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
        $student = $this->student_model->get_student($student_id);
        if (empty($student) || !array_filter($student) || $student_id == FALSE) {
            show_404();
        }
        if ($student['sig_id'] != $sig_id) {
            redirect('student');
        }
        $data = array(
            'title' => 'Edit Student: ' . $student['id'],
            'student' => $student,
            'programs' => $this->program_model->get_programs(),
            'sigs' => $this->sig_model->get_sig(),
            'mentors' => $this->mentor_model->get_sigmentors($student['sig_id'])
        );
        $this->load->view('templates/header');
        $this->load->view('student/edit', $data);
        // $this->load->view('templates/footer');
    }

    public function update()
    {
        $student_id = $this->input->post('student_id');
        $userdata = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'sig_id' => $this->input->post('sig_id'),
            'dob' => $this->input->post('dob')
        );
        $studentdata = array(
            'phonenum' => $this->input->post('phonenum'),
            'program_code' => $this->input->post('program_code'),
            'mentor_matric' => $this->input->post('mentor_matric')
        );
        $this->student_model->update_student($student_id, $studentdata);
        $this->user_model->update_user($student_id, $userdata);
        redirect('student/' . $student_id);
    }

    public function matric_exist($student_id)
    {
        $verifymatric = $this->student_model->verifymatric($student_id);
        if ($verifymatric == true) {
            $this->form_validation->set_message('matric_exist',  'User already exists. Please select another matric');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
