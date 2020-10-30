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

    public function get_arraytable_allscore($acadplans, $datascorelevels, $datascorecomps)
    {
        $tabletotals = array();
        for ($i = 0; $i < count($acadplans); $i++) {
            $totalarray = array(
                'academicsession' => $acadplans[$i]['academicsession']
            );
            $levelkeys = array_keys(array_column($datascorelevels, 'acadsession_id'), $acadplans[$i]['acadsession_id']);
            foreach ($levelkeys as $key) {
                $dl = $datascorelevels[$key];
                switch ($dl['levelscore_id']) {
                    case '1':
                        $totalarray['a1'] = $dl['totalpercent'];
                        break;
                    case '2':
                        $totalarray['a2'] = $dl['totalpercent'];
                        break;
                    case '3':
                        $totalarray['b1'] = $dl['totalpercent'];
                        break;
                }
            }
            $compkey = array_search($acadplans[$i]['acadsession_id'], array_column($datascorecomps, 'acadsession_id'));
            $totalarray['comp'] = $datascorecomps[$compkey]['total'];
            $totalarray['total'] = $totalarray['a1'] + $totalarray['a2'] + $totalarray['b1'] + $totalarray['comp'];
            $tabletotals[$i] = $totalarray;
        }
        return $tabletotals;
    }

    public function get_arraytable_level($datalevel)
    {
        for ($i = 0; $i < count($datalevel); $i++) {
            $levelpercentage = $this->CI->score_model->get_levelscore($datalevel[$i]['levelscore_id'])['percentage'];
            $total = $datalevel[$i]['sc_position'] + $datalevel[$i]['sc_meeting'] + $datalevel[$i]['sc_attendance'] + $datalevel[$i]['sc_involvement'];
            $datalevel[$i]['total'] = $total;
            $datalevel[$i]['totalpercent'] = ($total / 20) * $levelpercentage;
        }
        return $datalevel;
    }

    public function get_arraytable_comp($datacomp)
    {
        for ($i = 0; $i < count($datacomp); $i++) {
            $datacomp[$i]['total'] = $datacomp[$i]['sc_digitalcv'] + $datacomp[$i]['sc_leadership'] + $datacomp[$i]['sc_volunteer'];
        }
        return $datacomp;
    }

    # used in score/index
    public function get_arraytable_score($currentsession_students)
    {
        for ($i = 0; $i < count($currentsession_students); $i++) {
            $student_id = $currentsession_students[$i]['student_matric'];
            $acadsession = $currentsession_students[$i]['acadsession_id'];
            $levelscores = $this->CI->score_model->get_student_scorelevel($student_id, $acadsession);
            $compscore = $this->CI->score_model->get_student_scorecomp($student_id, $acadsession);
            $levelpercent = 0;
            foreach ($levelscores as $ls) {
                $levelpercent += $this->calculate_levelscore($ls);
            }
            $comppercent = $compscore['sc_digitalcv'] + $compscore['sc_leadership'] + $compscore['sc_volunteer'];
            $currentsession_students[$i]['totalpercent'] = $levelpercent + $comppercent;
        }
        return $currentsession_students;
    }

    public function calculate_levelscore($eachlevel)
    {
        $levelpercentage = $this->CI->score_model->get_levelscore($eachlevel['levelscore_id'])['percentage'];
        $totalscore = $eachlevel['sc_position'] + $eachlevel['sc_meeting'] + $eachlevel['sc_attendance'] + $eachlevel['sc_involvement'];
        return ($totalscore / 20) * $levelpercentage;
    }

    public function get_arraytable_scoringplan($categories, $academicsessions, $scoreplans)
    {
        $table = array();
        # group by academic session
        foreach ($academicsessions as $key => $acadsess) {
            $table[$key]['academicsession'] = $acadsess['academicsession'];
            $table[$key]['slug'] = $acadsess['slug'];
            foreach ($categories as $category) {
                $count = 0;
                foreach ($scoreplans as $scoreplan) {
                    if ($scoreplan['activitycategory_id'] == $category['id']) {
                        if ($scoreplan['acadsession_id'] == $acadsess['id']) {
                            $count += 1;
                        }
                    }
                }
                $categorysummary = array(
                    'code' => $category['code'],
                    'count' => $count
                );
                $table[$key]['category'][] = $categorysummary;
            }
        }
        return $table;
    }
}
