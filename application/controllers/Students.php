<?php
    class Students extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Students';

            $this->load->view('templates/header');
            $this->load->view('students/index', $data);
            $this->load->view('templates/footer');

        }

        public function register() {
            $data['title'] = 'Register Student';
            $data['programs'] = $this->program_model->get_programs();
            $data['sigs'] = $this->sig_model->get_sig();
            $data['mentors'] = $this->mentor_model->get_allmentors();


            $this->load->view('templates/header');
            $this->load->view('students/register', $data);
            $this->load->view('templates/footer');
        }
    }