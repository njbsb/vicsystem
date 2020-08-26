<?php
    class Mentor_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_allmentors() {
            $query = $this->db->get('tbl_mentor');
            return $query->result_array();
        }

        public function getMyMentor($sig_id) {
            $query = $this->db->get_where('tbl_mentor', array('sig_fk_id' => $sig_id));
            return $query->result();
        }
    }