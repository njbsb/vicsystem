<?php
    class Score extends CI_Controller {

        public function index() {
            
            $data['title'] = 'Score';
            $data['citras'] = $this->citra_model->get_citra();
            // print_r($data['citras']);

            $this->load->view('templates/header');
            $this->load->view('Score/index', $data);
            $this->load->view('templates/footer');

        }
    }