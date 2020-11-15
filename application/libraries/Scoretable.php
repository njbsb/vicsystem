<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scoretable
{

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function get_student_totalscore_acs($acadsession_id, $student_id)
    {
        $sig_id = $this->CI->sig_model->get_sig_id($this->CI->session->userdata('username'));
        $scoreplans = $this->CI->score_model->get_scoreplan($sig_id, $acadsession_id, FALSE);
        $scorecomps = array('scores' => $this->CI->score_model->get_scoreplan_scorecomp($student_id, $acadsession_id));
        # SCORE LEVELS
        $scoreleveltotal = $this->CI->score_model->get_scoreleveltotal();
        $totalwhole = 0;
        foreach ($scoreplans as  $i => $scoreplan) {
            $scores = $this->CI->score_model->get_scoreplan_scorelevel($student_id, $scoreplan['id']);
            $scoreplans[$i]['totalpercent'] =  $scores ? (array_sum($scores) / $scoreleveltotal) * $scoreplan['percentweightage'] : 0;
            $totalwhole += $scoreplans[$i]['totalpercent'];
            $scoreplans[$i]['scores'] = $scores;
        }
        # SCORE COMPONENTS
        if ($scorecomps['scores']) {
            $scorecomps['totalpercent'] = array_sum($scorecomps['scores']);
            $totalwhole += $scorecomps['totalpercent'];
        }
        return $totalwhole;
    }

    public function get_arraytable_academicplan($academicplans)
    {
        $acadplans = array();
        for ($i = 0; $i < count($academicplans); $i++) {
            $acp = $academicplans[$i];
            $citrarow = $this->CI->citra_model->get_students_registeredcitra($acp['student_matric'], $acp['acadsession_id']);
            $citrastring = '';
            foreach ($citrarow as $cr) {
                $citrastring .= $cr['citra_code'] . ' ';
            }
            $acparray = array(
                'acadsession_id' => $acp['acadsession_id'],
                'academicsession' => $acp['academicsession'],
                'citra_reg' => $citrastring,
                'gpa_target' => $acp['gpa_target'],
                'gpa_achieved' => $acp['gpa_achieved'],
                'difference' => floatval($acp['gpa_achieved']) - floatval($acp['gpa_target'])
            );
            $acadplans[$i] = $acparray;
        }
        return $acadplans;
    }

    public function get_level_rubrics()
    {
        $levelrubrics = array(
            'position' => 0,
            'meeting' => 0,
            'attendance' => 0,
            'involvement' => 0
        );
        return $levelrubrics;
    }
}
