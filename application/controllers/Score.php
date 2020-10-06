<?php
class Score extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Score';
        $activesession_id = $this->academic_model->get_activeacademicsession()['id'];
        $currentsession_students = $this->academic_model->get_registered_student($activesession_id);
        $data['student_score'] = $this->scoretable->get_arraytable_score($currentsession_students);
        $this->load->view('templates/header');
        $this->load->view('score/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($student_id)
    {
        $data['title'] = 'Score Page: ' . $student_id;
        $data['levels'] = $this->score_model->get_levelscore();
        $data['student_id'] = $student_id;
        $data['activeacadsession'] = $this->academic_model->get_activeacademicsession();
        $data['sigactivity'] = $this->activity_model->get_sig_activity($this->student_model->get_student($student_id)['sigid']);

        $data['academicplans'] = $this->scoretable->get_arraytable_academicplan(
            $this->academic_model->get_academicplan($student_id)
        );
        $data['score_levels'] = $this->scoretable->get_arraytable_level(
            $this->score_model->get_students_scorebylevels($student_id)
        );
        $data['score_comp'] = $this->scoretable->get_arraytable_comp(
            $this->score_model->get_students_scorebycomp($student_id)
        );
        $data['tabletotals'] = $this->scoretable->get_arraytable_allscore(
            $data['academicplans'],
            $data['score_levels'],
            $data['score_comp']
        );
        $active_scorebylevels = $this->score_model->get_student_scorelevel($student_id, $data['activeacadsession']['id']);
        $active_scorebycomps = $this->score_model->get_student_scorecomp($student_id, $data['activeacadsession']['id']);
        $active_scorebycomps['allhasvalue'] = $active_scorebycomps['sc_digitalcv'] && $active_scorebycomps['sc_leadership'] && $active_scorebycomps['sc_volunteer'];
        for ($i = 0; $i < count($active_scorebylevels); $i++) {
            $as = $active_scorebylevels[$i];
            $active_scorebylevels[$i]['allhasvalue'] = $as['sc_position'] && $as['sc_meeting'] && $as['sc_involvement'] && $as['sc_attendance'];
        }
        $data['active_scorebylevels'] = $active_scorebylevels;
        $data['active_scorebycomps'] = $active_scorebycomps;

        $data['guide_position'] = $this->score_model->get_guideposition();
        $data['guide_meeting'] = $this->score_model->get_guidemeeting();
        $data['guide_involvement'] = $this->score_model->get_guideinvolvement();
        $data['guide_attendance'] = $this->score_model->get_guideattendance();
        $data['guide_digitalcv'] = $this->score_model->get_guidedigitalcv();
        $data['guide_leadership'] = $this->score_model->get_guideleadership();

        $this->load->view('templates/header');
        $this->load->view('score/view', $data);
        $this->load->view('templates/footer');
    }

    public function setscorelevel($student_id)
    {
        $where = array(
            'acadsession_id' => $this->input->post('acadsession_id'),
            'student_matric' => $student_id,
            'levelscore_id' => $this->input->post('levelscore_id')
        );
        $score_eachlevel = array(
            'activity_id' => $this->input->post('activity_id'),
            'sc_position' => $this->input->post('sc_position'),
            'sc_meeting' => $this->input->post('sc_meeting'),
            'sc_attendance' => $this->input->post('sc_attendance'),
            'sc_involvement' => $this->input->post('sc_involvement')
        );
        $this->score_model->setscorelevel($where, $score_eachlevel);
        redirect('score/' . $student_id);
    }

    public function setscorecomp($student_id)
    {
        $where = array(
            'acadsession_id' => $this->input->post('acadsession_id'),
            'student_matric' => $student_id
        );
        $score_comp = array(
            'sc_digitalcv' => $this->input->post('sc_digitalcv'),
            'sc_leadership' => $this->input->post('sc_digitalcv'),
            'sc_volunteer' => $this->input->post('sc_volunteer')
        );
        $this->score_model->setscorecomp($where, $score_comp);
        redirect('score/' . $student_id);
    }
}
