<?php
    class Students extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Students';
            $data['students'] = $this->student_model->get_students();

            $this->load->view('templates/header');
            $this->load->view('students/index', $data);
            $this->load->view('templates/footer');

        }

        public function register() {
            $data['title'] = 'Register Student';
            $data['programs'] = $this->program_model->get_programs();
            $data['sigs'] = $this->sig_model->get_sig();
            $data['mentors'] = $this->mentor_model->get_allmentors();
            
            $this->form_validation->set_rules('matric', 'Matric Number', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('phonenum', 'Phone Number', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passwordconfirm', 'Confirm Password', 'required');
            $this->form_validation->set_rules('program_code', 'Program Code', 'required');
            $this->form_validation->set_rules('sig_id', 'SIG', 'required');
            $this->form_validation->set_rules('sig_mentor_matric', 'Mentor', 'required');
            $this->form_validation->set_rules('photo_path', 'Profile Photo', 'required');
            
            if($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('students/register', $data);
                $this->load->view('templates/footer');
            }
            else {
                $this->student_model->register_student();
                $this->user_model->register_user(3);
                redirect('students');
            }
        }

        public function update_profile() {
            
        }
    }