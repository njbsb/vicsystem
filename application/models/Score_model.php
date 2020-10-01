<?php
class Score_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_allscores()
    {
        // $this->db->select('citreg.student_matric, acy.acadyear, acs.semester_id')
        //     // ->distinct()
        //     ->from('tbl_citra_registration as citreg')
        //     ->join('tbl_academicsession as acs', 'acs.id = citreg.acadsession_id')
        //     ->join('tbl_academicyear as acy', 'acy.id = acs.acadyear_id');
        $this->db->select('citreg.student_matric, citreg.acadsession_id, acy.acadyear, acs.semester_id, count(citreg.citra_code) as citracount')
            ->from('tbl_citra_registration as citreg')
            ->join('tbl_academicsession as acs', 'acs.id = citreg.acadsession_id')
            ->join('tbl_academicyear as acy', 'acy.id = acs.acadyear_id')
            // ->join('tbl_scorelevel as scl', 'scl.acadsession_id = citreg.acadsession_id')
            ->group_by(array('citreg.student_matric', 'citreg.acadsession_id'));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_levelscore($id = NULL)
    {
        if ($id == FALSE) {
            $query = $this->db->get('tbl_levelscore');
            return $query->result_array();
        }
        $query = $this->db->get_where('tbl_levelscore', array('id' => $id));
        return $query->row_array();
    }

    public function get_scorebylevels($matric, $acadsession)
    {
        $this->db->select('scl.*, acy.acadyear, acs.semester_id, act.activity_name, ls.level, ls.percentage')
            ->from('tbl_scorelevel as scl')
            ->where(array('scl.student_matric' => $matric, 'scl.acadsession_id' => $acadsession))
            ->join('tbl_academicsession as acs', 'acs.id = scl.acadsession_id')
            ->join('tbl_academicyear as acy', 'acy.id = acs.acadyear_id')
            ->join('tbl_activity as act', 'act.id = scl.activity_id')
            ->join('tbl_levelscore as ls', 'ls.id = scl.levelscore_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_scorebycomp($matric, $acadsession)
    {
        $this->db->select('sc.*, acy.acadyear, acs.semester_id, ls.level')
            ->from('tbl_scorecomp as sc')
            ->where(array('sc.student_matric' => $matric, 'sc.acadsession_id' => $acadsession))
            ->join('tbl_academicsession as acs', 'acs.id = sc.acadsession_id')
            ->join('tbl_academicyear as acy', 'acy.id = acs.acadyear_id')
            ->join('tbl_levelscore as ls', 'ls.id = sc.levelscore_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_guideposition()
    {
        $query = $this->db->get('tbl_scposition');
        return $query->result_array();
    }
    public function get_guidemeeting()
    {
        $query = $this->db->get('tbl_scmeeting');
        return $query->result_array();
    }
    public function get_guideattendance()
    {
        $query = $this->db->get('tbl_scattendance');
        return $query->result_array();
    }
    public function get_guideinvolvement()
    {
        $query = $this->db->get('tbl_scinvolvement');
        return $query->result_array();
    }
}
