<?php
class Mentor extends CI_Controller
{
    public function index()
    {
        $current_id = $this->session->userdata('username');
        $my_sig = $this->user_model->get_my_sig($current_id);
        $data = array(
            'title' => $my_sig['signame'] . "'s Mentors",
            'mentors' => $this->mentor_model->get_mentor()
        );
        if ($this->session->userdata('isStudent')) {
            $mentor_matric = $this->student_model->get_mentor_matric($this->session->userdata('username'));
            $data['mentor_matric'] = $mentor_matric;
        }
        $this->load->view('templates/header');
        $this->load->view('mentor/index', $data);
        // $this->load->view('templates/footer');
    }

    public function view($mentor_id)
    {
        $data = array(
            'mentor' => $this->mentor_model->get_mentor($mentor_id),
            'activity_roles' => $this->committee_model->get_mentor_activityroles($mentor_id)
        );
        $this->load->view('templates/header');
        $this->load->view('mentor/view', $data);
        // $this->load->view('templates/footer');
    }

    // public function register()
    // {
    //     $data['title'] = 'Register Mentor';
    //     $data['sigs'] = $this->sig_model->get_sig();
    //     $data['mentor_roles'] = $this->role_model->get_mentor_roles();

    //     $this->form_validation->set_rules('matric', 'Matric', 'required');
    //     $this->form_validation->set_rules('name', 'Name', 'required');
    //     $this->form_validation->set_rules('email', 'Email', 'required');
    //     $this->form_validation->set_rules('password', 'Password', 'required');
    //     $this->form_validation->set_rules('passwordconfirm', 'PasswordConfirm', 'required');
    //     $this->form_validation->set_rules('position', 'Position', 'required');
    //     $this->form_validation->set_rules('sig_id', 'SIG', 'required');
    //     $this->form_validation->set_rules('role_id', 'Role in SIG', 'required');


    //     if ($this->form_validation->run() === FALSE) {
    //         $this->load->view('templates/header');
    //         $this->load->view('mentor/register', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $config['upload_path'] = '.assets/images/profile';
    //         $config['allowed_types'] = 'gif|jpg|png';
    //         $config['max_size'] = '2048';
    //         $config['max_width'] = '2000';
    //         $config['max_height'] = '2000';

    //         $this->load->library('upload', $config);

    //         if (!$this->upload->do_upload()) {
    //             $errors = array('error', $this->upload->display_errors());
    //             print_r($errors);
    //             $profile_image = 'default.png';
    //         } else {
    //             $data = array('upload_data' => $this->upload->data());
    //             $profile_image = $_FILES['profile_image']['name'];
    //         }

    //         $this->mentor_model->register_mentor($profile_image);
    //         $this->user_model->register_user(2);

    //         redirect('mentor');
    //     }
    // }

    public function edit($mentor_id)
    {
        $mentor = $this->mentor_model->get_mentor($mentor_id);
        if (empty($mentor)) {
            show_404();
        }
        $data = array(
            'title' => 'Edit Mentor: ' . $mentor['name'],
            'mentor' => $mentor,
            'sigs' => $this->sig_model->get_sig(),
            'roles' => $this->role_model->get_mentor_roles()
        );
        $this->load->view('templates/header');
        $this->load->view('mentor/edit', $data);
        // $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $mentordata = array(
            'position' => $this->input->post('position'),
            'roomnum' => $this->input->post('roomnum'),
            'orgrole_id' => $this->input->post('orgrole_id')
        );
        $userdata = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'sig_id' => $this->input->post('sig_id')
        );
        $this->mentor_model->update_mentor($id, $mentordata);
        $this->user_model->update_user($id, $userdata);
        redirect('mentor/' . $id);
    }
}
