<?php
    class Activity extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Activity';
            $data['activities'] = $this->activity_model->get_activities();

            $this->load->view('templates/header');
            $this->load->view('activity/index', $data);
            $this->load->view('templates/footer');

        }

        public function create() {
            $data['title'] = 'Create Activity';
            $data['academicsessions'] = $this->academicsession_model->get_academicsessions();
            $data['sigs'] = $this->sig_model->get_sig();
            $data['mentors'] = $this->mentor_model->get_allmentors();
            print_r($data['mentors']);
            $this->form_validation->set_rules('activityname', 'activity name', 'required');
            $this->form_validation->set_rules('activitydesc', 'activity description', 'required');
            
            if($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header');
                $this->load->view('activity/create', $data);
                $this->load->view('templates/footer');
            }
            else {
                $this->activity_model->create_activity();
                redirect('activity');
            }

            
            
        }
    }