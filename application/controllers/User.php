<?php
    class User extends CI_Controller {
        
        public function index() {
            $data['title'] = 'User profile';
            
            $this->load->view('templates/header');
            $this->load->view('user/student/profile', $data);
            // put if statement to check user type and load the right view
            $this->load->view('templates/footer');
        }

        public function edit() {
            $data['title'] = 'Update Student user';
            $this->load->view('templates/header');
            if(1) {
                // load mentor/user model's data
                // load the right view based on user type
            }
            $this->load->view('user/student/update', $data);
            $this->load->view('templates/footer');
            
            // NOT DONE
            // put if condition to check the user type of the user
            // so that we can load the right view
            
            // DONE
            // replace profile controller with user controller
            // later re route using config route
        }
    }