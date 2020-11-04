<?php
class Student extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'My Students';
        $data['students'] = $this->student_model->get_student();
        $this->load->view('templates/header');
        $this->load->view('student/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($student_id)
    {
        $data['student'] = $this->student_model->get_student($student_id);
        if (!array_filter($data['student'])) {
            show_404();
        }
        $data['activity_roles'] = $this->committee_model->get_activityroles($student_id);
        $data['org_roles'] = $this->committee_model->get_orgroles($student_id, $data['student']['sig_id']);
        $this->load->view('templates/header');
        $this->load->view('student/view', $data);
        $this->load->view('templates/footer');
    }

    // public function register()
    // {
    //     $this->form_validation->set_rules('matric', 'Matric Number', 'required|callback_matric_exist');
    //     $this->form_validation->set_rules('name', 'Name', 'required');
    //     $this->form_validation->set_rules('phonenum', 'Phone Number', 'required');
    //     $this->form_validation->set_rules('email', 'Email', 'required');
    //     $this->form_validation->set_rules('password', 'Password', 'required');
    //     $this->form_validation->set_rules('passwordconfirm', 'Confirm Password', 'required');
    //     $this->form_validation->set_rules('program_code', 'Program Code', 'required');
    //     $this->form_validation->set_rules('sig_id', 'SIG', 'required');
    //     $this->form_validation->set_rules('sig_mentor_matric', 'Mentor', 'required');
    //     // $this->form_validation->set_rules('photo_path', 'Profile Photo', 'required');

    //     if ($this->form_validation->run() === FALSE) {
    //         $data['title'] = 'Register Student';
    //         $data['programs'] = $this->program_model->get_programs();
    //         $data['sigs'] = $this->sig_model->get_sig();
    //         $data['mentors'] = $this->mentor_model->get_mentor();

    //         $this->load->view('templates/header');
    //         $this->load->view('student/register', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $this->student_model->register_student();
    //         $this->user_model->register_user(3);
    //         redirect('student');
    //     }
    // }

    public function edit($student_id = NULL)
    {
        $data['student'] = $this->student_model->get_student($student_id);
        if (empty($data['student']) || !array_filter($data['student']) || $student_id == FALSE) {
            show_404();
        }
        $data['title'] = 'Edit Student';
        $data['programs'] = $this->program_model->get_programs();
        $data['sigs'] = $this->sig_model->get_sig();
        $data['mentors'] = $this->mentor_model->get_mentor();
        $this->load->view('templates/header');
        $this->load->view('student/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($student_id)
    {
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
