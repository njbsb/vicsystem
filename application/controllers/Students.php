<?php
    class Students extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Students';

            $this->load->view('templates/header');
            $this->load->view('students/index', $data);
            $this->load->view('templates/footer');

        }

        public function student() {
            
        }
    }