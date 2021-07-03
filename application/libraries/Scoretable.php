<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scoretable
{

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function get_arraytable_academicplan($academicplans)
    {
        # to include acadyear_id and semester
        $acadplans = array();
        for ($i = 0; $i < count($academicplans); $i++) {
            $acp = $academicplans[$i];

            if (floatval($acp['gpa_achieved']) == 0 or floatval($acp['gpa_achieved']) == null) {
                $difference = '';
            } else {
                $difference = floatval($acp['gpa_achieved']) - floatval($acp['gpa_target']);
            }
            if ($acp['gpa_achieved'] == 0 or $acp['gpa_achieved'] == null) {
                $gpa_achieved = '';
            } else {
                $gpa_achieved = $acp['gpa_achieved'];
            }
            $acparray = array(
                'acadsession_id' => $acp['acadsession_id'],
                'academicsession' => $acp['academicsession'],
                // 'citra_reg' => $citrastring,
                'gpa_target' => $acp['gpa_target'],
                'gpa_achieved' => $gpa_achieved,
                'difference' => $difference
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

    public function calculate_academicbadge($student_id)
    {
        $academicplans = $this->CI->academic_model->get_academicplan($student_id, FALSE);
        $badgecount = 0;
        foreach ($academicplans as $plan) {
            $target = $plan['gpa_target'];
            $achieved = $plan['gpa_achieved'];
            $difference = $achieved - $target;
            $previousgpa = $this->CI->academic_model->get_previous_semester_gpa($student_id, $plan['acadsession_id']);
            $difference2 = $achieved - $previousgpa;
            if (is_numeric($achieved)) { # check if achieved exists and is number
                if (is_numeric($target) and $difference >= 0) {
                    $badgecount += 1;
                }
                if ($difference2 > 0 and $previousgpa > 0) {
                    $badgecount += 1;
                }
                if ($achieved > 3.67) {
                    $badgecount += 1;
                }
            }
        }
        return $badgecount;
    }

    public function calculate_activitybadge($student_id)
    {
        $badgecount = 0;
        $activityscores = $this->CI->score_model->get_scoreplan_scorelevel($student_id);
        foreach ($activityscores as $score) {
            $sum = array_sum($score);
            if ($sum >= 18) {
                $badgecount += 1;
            }
        }
        return $badgecount;
    }

    public function calculate_externalbadge($student_id)
    {
        $score_externals = $this->CI->score_model->get_student_scoreexternal($student_id);
        return count($score_externals);
    }

    public function calculate_activityscore($student_id, $acadsession_id)
    {
        $scoreplans = $this->CI->score_model->get_scoreplan($acadsession_id, 'A');
        $activityscore = 0; # percent
        $scoreleveltotal = $this->CI->score_model->get_scoreleveltotal();
        foreach ($scoreplans as $i => $scoreplan) {
            $percentweightage = $scoreplan['percentweightage'];
            $scorelevel = $this->CI->score_model->get_scoreplan_scorelevel($student_id, $scoreplan['id']);
            # $scorelevel already specific to one score plan

            $sum = (isset($scorelevel)) ? array_sum($scorelevel) : 0;
            $score = ($sum / $scoreleveltotal) * $percentweightage;
            $activityscore += $score;
        }
        return $activityscore;
        # first to get scoreplans of $acadsession_id, filter by activitycategory_id
        # foreach scoreplans, get corresponding score_level
    }

    public function calculate_workshopscore($student_id, $acadsession_id)
    {
        $scoreplans = $this->CI->score_model->get_scoreplan($acadsession_id, 'B');
        $activityscore = 0; # percent
        $scoreleveltotal = $this->CI->score_model->get_scoreleveltotal();
        foreach ($scoreplans as $i => $scoreplan) {
            $percentweightage = $scoreplan['percentweightage'];
            $scorelevel = $this->CI->score_model->get_scoreplan_scorelevel($student_id, $scoreplan['id']);
            # $scorelevel already specific to one score plan

            $sum = (isset($scorelevel)) ? array_sum($scorelevel) : 0;
            $score = ($sum / $scoreleveltotal) * $percentweightage;
            $activityscore += $score;
        }
        return $activityscore;
    }

    public function calculate_componentscore($student_id, $acadsession_id)
    {
        $componentscore = 0;
        $scorecomps = array('scores' => $this->CI->score_model->get_scoreplan_scorecomp($student_id, $acadsession_id));
        if ($scorecomps['scores']) {
            $componentscore += array_sum($scorecomps['scores']);
        }
        return $componentscore;
    }
}