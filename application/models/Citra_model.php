<?php
class Citra_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_citra($code = FALSE)
    {
        if ($code === FALSE) {
            $this->db->order_by('citra_level', 'ASC');
            $query = $this->db->get('tbl_citra');
            return $query->result_array();
        }
        $query = $this->db->get_where('tbl_citra', array('code' => $code));
        return $query->row_array();
    }

    public function get_citra_registered()
    {
        $this->db->select('citreg.*, acadsess.semester_id, acadyear.acadyear')
            ->from('tbl_citra_registration as citreg')
            ->join('tbl_academicsession as acadsess', 'citreg.acadsession_id = acadsess.id')
            ->join('tbl_academicyear as acadyear', 'acadsess.acadyear_id = acadyear.id');
        $query = $this->db->get();
        return $query->result_array();
        // print_r($query->row_array());
    }
}
