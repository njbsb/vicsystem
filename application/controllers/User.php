<?php
    class User extends CI_Controller {
        
        public function index() {
            $data['title'] = 'User profile';
            $id = 'K0000'; // get the current session user first
            $data['user'] = $this->user_model->get_user($id);
            $id = $data['user']['id'];
            $usertype = $data['user']['usertype_id'];

            // $data['sigs'] = $this->sig_model->get_sig();
            // $data['programs'] = $this->program_model->get_programs();
            // $data['mentors'] = $this->mentor_model->get_mentor();
            
            $this->load->view('templates/header');
            // $this->load->view('user/student/profile', $data);
            switch($usertype) {
                case '1':
                    $data['admin'] = $this->admin_model->get_admin($id);
                    $this->load->view('user/admin/profile', $data);
                    break;
                case '2':
                    $data['mentor'] = $this->mentor_model->get_mentor($id);
                    $this->load->view('user/mentor/profile', $data);
                    break;
                case '3':
                    $data['student'] = $this->student_model->get_student($id);
                    $this->load->view('user/student/profile', $data);
                    break;
            }
            $this->load->view('templates/footer');
        }

        public function edit() {
            $data['title'] = 'Update profile';
            $id = 'K0000'; // get the current session user first
            $data['user'] = $this->user_model->get_user($id);
            $id = $data['user']['id'];
            $usertype = $data['user']['usertype_id'];
            
            $data['sigs'] = $this->sig_model->get_sig();
            $data['programs'] = $this->program_model->get_programs();
            $data['mentors'] = $this->mentor_model->get_mentor();

            $this->load->view('templates/header');
            switch($usertype) {
                case '1':
                    $data['admin'] = $this->admin_model->get_admin($id);
                    $this->load->view('user/admin/update', $data);
                    break;
                case '2':
                    $data['mentor'] = $this->mentor_model->get_mentor($id);
                    $this->load->view('user/mentor/update', $data);
                    break;
                case '3':
                    $data['student'] = $this->student_model->get_student($id);
                    $this->load->view('user/student/update', $data);
                    break;
            }
            $this->load->view('templates/footer');
            
            // NOT DONE
            // get the current session user
            
            // DONE
            // replace profile controller with user controller
            // later re route using config route
            // put if condition to check the user type of the user
            // so that we can load the right view
        }
    }