<?php
    class Student extends CI_Controller {

        public function index() {
            $data['title'] = 'My Students';
            $data['students'] = $this->student_model->get_student();

            $this->load->view('templates/header');
            $this->load->view('student/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($matric) {
            
            $data['student'] = $this->student_model->get_student($matric);
            // print_r($data['student']);
            $this->load->view('templates/header');
            $this->load->view('student/view', $data);
            $this->load->view('templates/footer');
        }

        public function register() {
            $data['title'] = 'Register Student';
            $data['programs'] = $this->program_model->get_programs();
            $data['sigs'] = $this->sig_model->get_sig();
            $data['mentors'] = $this->mentor_model->get_mentor();
            
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
                $this->load->view('student/register', $data);
                $this->load->view('templates/footer');
            }
            else {
                $this->student_model->register_student();
                $this->user_model->register_user(3);
                redirect('student');
            }
        }

        public function edit($matric) {
            $data['student'] = $this->student_model->get_student($matric);
            $data['programs'] = $this->program_model->get_programs();
            $data['sigs'] = $this->sig_model->get_sig();
            $data['mentors'] = $this->mentor_model->get_mentor();

            if(empty($data['student'])) {
                show_404();
            }
            $data['title'] = 'Edit Student';
            $this->load->view('templates/header');
            $this->load->view('student/edit', $data);
            $this->load->view('templates/footer');
        }

        public function update($matric) {
            $this->student_model->update_student();
            redirect('student/'.$matric);
        }
    }