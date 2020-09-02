<?php
    class Citra_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_citra() {
            $query = $this->db->order_by('citra_level', 'ASC');
            $query = $this->db->get('tbl_citra');
            return $query->result_array();
        }
        
    }