<?php
class Academic_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_academicsession($id = NULL)
    {
        if ($id == FALSE) {
            $this->db->select('acs.*, acy.acadyear as academicyear')
                ->from('tbl_academicsession as acs')
                ->join('tbl_academicyear as acy', 'acs.acadyear_id = acy.id');
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->select('acs.*, acy.acadyear as academicyear')
            ->from('tbl_academicsession as acs')
            ->where(array('acs.id' => $id))
            ->join('tbl_academicyear as acy', 'acs.acadyear_id = acy.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_activeacademicsession()
    {
        $this->db->select('acs.*, acy.acadyear as academicyear')
            ->from('tbl_academicsession as acs')
            ->where('acs.status', 'active')
            ->join('tbl_academicyear as acy', 'acs.acadyear_id = acy.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_count_academicsession($id)
    {
        $this->db->distinct()
            ->select('student_matric, acadsession_id')
            ->from('tbl_academicsession')
            ->where(array('student_matric' => $id));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_academicyear()
    {
        $query = $this->db->get('tbl_academicyear');
        return $query->result_array();
    }

    public function get_academicplan($id = NULL)
    {
        if ($id == FALSE) {
            $this->db->select('acp.*, std.name, acy.acadyear, acs.semester_id')
                ->from('tbl_academicplan as acp')
                ->join('tbl_academicsession as acs', 'acs.id = acp.acadsession_id')
                ->where(array('acs.status' => 'active'))
                ->join('tbl_academicyear as acy', 'acy.id = acs.acadyear_id')
                ->join('tbl_user as std', 'std.id = acp.student_matric');
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->select('acp.*, std.name, acy.acadyear, acs.semester_id')
            ->from('tbl_academicplan as acp')
            ->join('tbl_academicsession as acs', 'acs.id = acp.acadsession_id')
            ->where(array('acp.student_matric' => $id))
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
