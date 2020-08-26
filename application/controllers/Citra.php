<?php
    class Citra extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Citra';

            $this->load->view('templates/header');
            $this->load->view('Citra/index', $data);
            $this->load->view('templates/footer');

        }
    }