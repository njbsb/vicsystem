<?php
    class Mentor extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Mentor';
            $data['mentors'] = $this->mentor_model->get_summary_mentors();
            // print_r($data['mentors']);
            $this->load->view('templates/header');
            $this->load->view('mentor/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($matric) {
            $data['mentor'] = $this->mentor_model->get_mentor($matric);
            $this->load->view('templates/header');
            $this->load->view('mentor/view', $data);
            $this->load->view('templates/footer');
        }

        public function register() {
            $data['title'] = 'Register Mentor';
            $data['sigs'] = $this->sig_model->get_sig();
            $data['mentor_roles'] = $this->role_model->get_mentor_roles();
            
            $this->form_validation->set_rules('matric', 'Matric', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passwordconfirm', 'PasswordConfirm', 'required');
            $this->form_validation->set_rules('position', 'Position', 'required');
            $this->form_validation->set_rules('sig_id', 'SIG', 'required');
            $this->form_validation->set_rules('role_id', 'Role in SIG', 'required');
            $this->form_validation->set_rules('photo_path', 'Profile photo', 'required');
            

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('mentor/register', $data);
                $this->load->view('templates/footer');
            } else {
                $this->mentor_model->register_mentor();
                $this->user_model->register_user(2);
                redirect('mentor');
            }
            
        }
        // public function edit($matric) {
        //     $data['title'] = 'Update Mentor';
        //     $data['activity'] = $this->mentor_model-->get_mentor($matric);
        // }
    }