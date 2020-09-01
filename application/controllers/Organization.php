<?php 
    class Organization extends CI_Controller {
        public function index() {

            $data['title'] = 'Organization Index';

            $this->load->view('templates/header');
            $this->load->view('organization/index', $data);
            $this->load->view('templates/footer');
        }
    }