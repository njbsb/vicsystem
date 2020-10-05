<?php
class Score extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Score';
        $activesession_id = $this->academic_model->get_activeacademicsession()['id'];
        $data['registered_student'] = $this->academic_model->get_registered_student($activesession_id);
        $data['student_score'] = $this->get_arraytable_score($data['registered_student']);
        $this->load->view('templates/header');
        $this->load->view('score/index', $data);
        $this->load->view('templates/footer');
    }

    public function addscore($matric = NULL)
    {
        if ($matric == FALSE) {
            show_404();
        }
        $this->form_validation->set_rules('activity_id', 'Activity', 'required');

        if ($this->form_validation->run() ===  FALSE) {
            $data['title'] = 'Add Score';
            $data['levelscores'] = $this->score_model->get_levelscore();
            $data['activities'] = $this->activity_model->get_activity();
            $data['matric'] = $matric;

            $data['guide_position'] = $this->score_model->get_guideposition();
            $data['guide_meeting'] = $this->score_model->get_guidemeeting();
            $data['guide_involvement'] = $this->score_model->get_guideinvolvement();
            $data['guide_attendance'] = $this->score_model->get_guideattendance();

            $this->load->view('templates/header');
            $this->load->view('score/addscore', $data);
            $this->load->view('score/scoreguide');
            $this->load->view('templates/footer');
        } else {
            $scorelevel = '';
            # code...
        }
    }

    public function view($id)
    {
        $data['title'] = 'Score: ' . $id;
        $this->load->view('templates/header');
        $this->load->view('score/view', $data);
        $this->load->view('templates/footer');
    }

    public function get_arraytable_score($regstd)
    {
        for ($i = 0; $i < count($regstd); $i++) {
            $id = $regstd[$i]['student_matric'];
            $acadsession = $regstd[$i]['acadsession_id'];
            $levelscores = $this->score_model->get_student_scorelevel($id, $acadsession);
            $compscore = $this->score_model->get_student_scorecomp($id, $acadsession);
            $levelpercent = 0;
            foreach ($levelscores as $ls) {
                $levelpercent += $this->calculate_levelscore($ls);
            }
            $comppercent = $compscore['sc_digitalcv'] + $compscore['sc_leadership'] + $compscore['sc_volunteer'];
            $regstd[$i]['totalpercent'] = $levelpercent + $comppercent;
        }
        return $regstd;
    }

    public function calculate_levelscore($eachlevel)
    {
        $levelpercentage = $this->score_model->get_levelscore($eachlevel['levelscore_id'])['percentage'];
        $totalscore = $eachlevel['sc_position'] + $eachlevel['sc_meeting'] + $eachlevel['sc_attendance'] + $eachlevel['sc_involvement'];
        return ($totalscore / 20) * ($levelpercentage / 100);
    }
}
