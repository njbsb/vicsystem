<?php
    class Mentors extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Mentors';
            $data['mentors'] = $this->mentor_model->get_allmentors();
            $this->load->view('templates/header');
            $this->load->view('mentors/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($mentor_id) {
            
            $this->load->view('templates/header');
            // $this->load->view('mentors/index', $data);
            $this->load->view('templates/footer');
        }
    }