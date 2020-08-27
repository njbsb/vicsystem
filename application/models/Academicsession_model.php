<?php
    class Academicsession_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_academicsessions() {
            $query = $this->db->get('tbl_academic_session');
            return $query->result_array();
        }
    }