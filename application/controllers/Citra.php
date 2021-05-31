<?php
class Citra extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Citra Courses',
            'citras' => $this->citra_model->get_citra()
        );
        $this->load->view('templates/header');
        $this->load->view('citra/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($code = NULL)
    {
        $citra = $this->citra_model->get_citra($code);
        if (empty($citra)) {
            show_404();
        }
        $data = array(
            'citra' => $citra,
        );
        $this->load->view('templates/header');
        $this->load->view('citra/view', $data);
        $this->load->view('templates/footer');
    }
}