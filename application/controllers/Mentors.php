<?php
    class Mentors extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Mentors';
            $data['mentors'] = $this->mentor_model->get_summary_mentors();
            print_r($data['mentors']);
            $this->load->view('templates/header');
            $this->load->view('mentors/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($mentor_id) {
            
            $this->load->view('templates/header');
            // $this->load->view('mentors/index', $data);
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

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('mentors/register', $data);
                $this->load->view('templates/footer');
            } else {
                die('Continue');
            }
            
        }
    }