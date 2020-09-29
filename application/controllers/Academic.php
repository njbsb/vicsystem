<?php
class Academic extends CI_Controller
{
    public function index()
    {
        $data['academicyear'] = $this->academic_model->get_academicyear();
        $data['academicsession'] = $this->academic_model->get_academicsession();
        $data['academicplan'] = $this->academic_model->get_academicplan();
        $data['semesters'] = $this->academic_model->get_semester();
        // print_r($data['academicplan']);
        $data['title'] = 'Academic Index Page';
        $this->load->view('templates/header');
        $this->load->view('academic/index', $data);
        $this->load->view('templates/footer');
    }

    public function create_academicsession()
    {
        $acsdata = array(
            'acadyear_id' => $this->input->post('acadyear_id'),
            'semester_id' => $this->input->post('semester_id'),
            'status' => $this->input->post('status')
        );
        $this->academic_model->create_acs($acsdata);
    }
    public function create_academicyear()
    {
        $acydata = array(
            'acadyear' => $this->input->post('acadyear'),
            'status' => $this->input->post('status')
        );
        $this->academic_model->create_acy($acydata);
    }

    public function set_activesession($id)
    {
    }
    public function set_activeyear($id)
    {
    }
}
