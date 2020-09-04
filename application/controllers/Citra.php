<?php
    class Citra extends CI_Controller {
        public function index() {
            
            $data['title'] = 'Citra';
            $data['citras'] = $this->citra_model->get_citra();

            $this->load->view('templates/header');
            $this->load->view('citra/index', $data);
            $this->load->view('templates/footer');
        }

        public function view($code = NULL) {
            $data['citra'] = $this->citra_model->get_citra($code);
            
            if(empty($data['citra'])) {
                show_404();
            }
            $data['title'] = $data['citra']['name_en'];
            $this->load->view('templates/header');
            $this->load->view('citra/view', $data);
            $this->load->view('templates/footer');
        }
    }