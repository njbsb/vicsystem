<?php
    class User extends CI_Controller {
        
        public function index() {
            $data['title'] = 'User profile';
            
            $this->load->view('templates/header');
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        }

        public function update_profile() {
            // replace profile controller with user controller
            // later re route using config route
        }
    }