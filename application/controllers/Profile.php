<?php
    class Profile extends CI_Controller {
        public function index() {
            $data['title'] = 'Profile';
            $this->load->view('templates/header');
            $this->load->view('profile/index', $data);
            $this->load->view('templates/footer');
        }

        public function update() {
            $data['title'] = 'Update Profile';
            $this->load->view('templates/header');
            $this->load->view('profile/update', $data);
            $this->load->view('templates/footer');
        }
    }