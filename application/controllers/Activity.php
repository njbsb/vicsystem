<?php
    class Activity extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Activity';
            $data['activities'] = $this->activity_model->get_activities();

            $this->load->view('templates/header');
            $this->load->view('activity/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($slug = NULL) {
            $data['activity'] = $this->activity_model->get_activity($slug);
            if(empty($data['activity'])) {
                show_404();
            }
            $data['title'] = $data['activity']['activity_name'];

            $this->load->view('templates/header');
            $this->load->view('activity/view', $data);
            $this->load->view('templates/footer');
        }

        public function create() {
            $data['title'] = 'Create Activity';
            $data['academicsessions'] = $this->academicsession_model->get_academicsessions();
            $data['sigs'] = $this->sig_model->get_sig();
            $data['mentors'] = $this->mentor_model->get_allmentors();
            // print_r($data['mentors']);
            $this->form_validation->set_rules('activityname', 'Activity Name', 'required');
            $this->form_validation->set_rules('activitydesc', 'Activity Description', 'required');
            $this->form_validation->set_rules('academicsession_id', 'Academic Session', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            $this->form_validation->set_rules('sig_id', 'SIG', 'required');
            $this->form_validation->set_rules('advisor_matric', 'Advisor', 'required');
            $this->form_validation->set_rules('photo_path', 'Activity Image');
            $this->form_validation->set_rules('datetime_start', 'Datetime Start');
            $this->form_validation->set_rules('datetime_end', 'Datetime End');
            $this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12]');
            
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