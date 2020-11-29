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
