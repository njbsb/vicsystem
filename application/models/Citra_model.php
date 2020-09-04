<?php
    class Citra_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_citra($code = FALSE) {
            if($code === FALSE) {
                $this->db->order_by('citra_level', 'ASC');
                $query = $this->db->get('tbl_citra');
                return $query->result_array();
            }
            $query = $this->db->get_where('tbl_citra', array('code' => $code));
            return $query->row_array();
        }
        
    }