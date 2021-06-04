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
            $this->db->order_by('level', 'ASC');
            $query = $this->db->get('citra');
            return $query->result_array();
        }
        $query = $this->db->get_where('citra', array('code' => $code));
        return $query->row_array();
    }

    public function get_citra_registered($id = NULL, $acadsession_id = NULL)
    {
        if ($id == FALSE && $acadsession_id == FALSE) {
            $this->db->select('citreg.*, citra.name_en as citraname, acadsess.semester, acadyear.acadyear')
                ->from('citra_registration as citreg')
                ->join('citra', 'citra.code = citreg.citra_code')
                ->join('academicsession as acadsess', 'citreg.acadsession_id = acadsess.id')
                ->join('academicyear as acadyear', 'acadsess.acadyear_id = acadyear.id');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            if ($id) {
                if ($acadsession_id) {
                    // both id and acadsession_id
                    $this->db->select('citreg.*, citra.name_en as citraname, acadsess.semester, acadyear.acadyear')
                        ->from('citra_registration as citreg')
                        ->where(array('citreg.student_id' => $id, 'acadsession_id' => $acadsession_id))
                        ->join('citra', 'citra.code = citreg.citra_code')
                        ->join('academicsession as acadsess', 'citreg.acadsession_id = acadsess.id')
                        ->join('academicyear as acadyear', 'acadsess.acadyear_id = acadyear.id');
                    $query = $this->db->get();
                    return $query->result_array();
                } else {
                    $this->db->select('citreg.*, acadsess.semester, acadyear.acadyear')
                        ->from('citra_registration as citreg')
                        ->where(array('citreg.student_id' => $id))
                        ->join('academicsession as acadsess', 'citreg.acadsession_id = acadsess.id')
                        ->join('academicyear as acadyear', 'acadsess.acadyear_id = acadyear.id');
                    $query = $this->db->get();
                    return $query->result_array();
                }
            } else {
                $this->db->select('citreg.*, acadsess.semester, acadyear.acadyear')
                    ->from('citra_registration as citreg')
                    ->where(array('citreg.acadsession_id' => $acadsession_id))
                    ->join('academicsession as acadsess', 'citreg.acadsession_id = acadsess.id')
                    ->join('academicyear as acadyear', 'acadsess.acadyear_id = acadyear.id');
                $query = $this->db->get();
                return $query->result_array();
            }
        }
    }

    public function get_students_registeredcitra($id, $acadsession_id)
    {
        $this->db->select('citreg.citra_code')
            ->from('citra_registration as citreg')
            ->where(array('student_id' => $id, 'acadsession_id' => $acadsession_id));
        $query = $this->db->get();
        return $query->result_array();
    }
}