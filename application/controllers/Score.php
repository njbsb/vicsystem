<?php
class Score extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Score';
        $data['citra_registered'] = $this->citra_model->get_citra_registered();
        // print_r($data['citra_registered']);
        $this->load->view('templates/header');
        $this->load->view('score/index', $data);
        $this->load->view('templates/footer');
    }

    public function addscore()
    {
        // $data['scorebylevels'] = $this->score_model->get_scorebylevels();
        $data['title'] = 'Add Score';
        $data['levelscores'] = $this->score_model->get_levelscore();
        $data['activities'] = $this->activity_model->get_activity();

        $data['guide_position'] = $this->score_model->get_guideposition();
        $data['guide_meeting'] = $this->score_model->get_guidemeeting();
        $data['guide_involvement'] = $this->score_model->get_guideinvolvement();
        $data['guide_attendance'] = $this->score_model->get_guideattendance();

        $this->load->view('templates/header');
        $this->load->view('score/addscore', $data);
        $this->load->view('score/scoreguide');
        $this->load->view('templates/footer');
    }
}
