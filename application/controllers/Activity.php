<?php
    class Activity extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Activity';

            $this->load->view('templates/header');
            $this->load->view('Activity/index', $data);
            $this->load->view('templates/footer');

        }
    }