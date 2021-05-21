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
        $acadplans = array();
        for ($i = 0; $i < count($academicplans); $i++) {
            $acp = $academicplans[$i];
            // $citrarow = $this->CI->citra_model->get_students_registeredcitra($acp['student_id'], $acp['acadsession_id']);
            // $citrastring = '';
            // foreach ($citrarow as $cr) {
            //     $citrastring .= $cr['citra_code'] . ' ';
            // }

            if (floatval($acp['gpa_achieved']) == 0 or floatval($acp['gpa_achieved']) == null) {
                $difference = 'No data';
            } else {
                $difference = floatval($acp['gpa_achieved']) - floatval($acp['gpa_target']);
            }
            if ($acp['gpa_achieved'] == 0 or $acp['gpa_achieved'] == null) {
                $gpa_achieved = 'No data';
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
            if ($difference > 0 or $achieved >= 3.67) {
                $badgecount += 1;
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
}