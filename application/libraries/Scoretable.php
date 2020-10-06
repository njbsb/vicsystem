<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scoretable
{

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function show_hello_world()
    {
        return 'Hello World';
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

    public function get_arraytable_allscore($acadplans, $scorelevels, $scorecomps)
    {
        $tabletotals = array();
        for ($i = 0; $i < count($acadplans); $i++) {
            $totalarray = array(
                'academicsession' => $acadplans[$i]['academicsession']
            );
            $levelkeys = array_keys(array_column($scorelevels, 'acadsession_id'), $acadplans[$i]['acadsession_id']);
            foreach ($levelkeys as $key) {
                $dl = $scorelevels[$key];
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
            $compkey = array_search($acadplans[$i]['acadsession_id'], array_column($scorecomps, 'acadsession_id'));
            $totalarray['comp'] = $scorecomps[$compkey]['total'];
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
}
