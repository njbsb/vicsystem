<?php
    class Sig_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_sig() {
            $query = $this->db->get('tbl_sig');
            return $query->result_array();
        }
    }