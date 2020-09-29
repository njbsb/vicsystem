<?php
class Score_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_levelscore()
    {
        $query = $this->db->get('tbl_levelscore');
        return $query->result_array();
    }

    public function get_scorebylevels($matric, $acadsession)
    {
        $query = $this->db->get_where('tbl_scorelevel', array('$matric' => $matric, 'acadsession_id' => $acadsession));
        return $query->result_array();
    }

    public function get_scorebycomp($matric, $acadsession)
    {
        $query = $this->db->get_where('tbl_scorecomp', array('$matric' => $matric, 'acadsession_id' => $acadsession));
        return $query->result_array();
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
