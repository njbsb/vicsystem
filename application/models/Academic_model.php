<?php
class Academic_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_academicsession()
    {
        $this->db->select('acs.*, acy.acadyear as academicyear')
            ->from('tbl_academicsession as acs')
            // ->where('acs.status', 'active')
            ->join('tbl_academicyear as acy', 'acs.acadyear_id = acy.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_academicyear()
    {
        $query = $this->db->get('tbl_academicyear');
        return $query->result_array();
    }

    public function get_academicplan()
    {
        $this->db->select('acp.*, std.name, acy.acadyear, acs.semester_id')
            ->from('tbl_academicplan as acp')
            ->join('tbl_academicsession as acs', 'acs.id = acp.acadsession_id')
            ->where(array('acs.status' => 'active'))
            ->join('tbl_academicyear as acy', 'acy.id = acs.acadyear_id')
            ->join('tbl_user as std', 'std.id = acp.student_matric');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_semester()
    {
        $query = $this->db->get('tbl_semester');
        return $query->result_array();
    }

    public function create_acs($acsdata)
    {
        // if ($_POST["action"] == "add") {
        // }
        return $this->db->insert('tbl_academicsession', $acsdata);
    }
    public function create_acy($acydata)
    {
        return $this->db->insert('tbl_academicyear', $acydata);
    }
}
