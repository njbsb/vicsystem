<?php
    class Mentor_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }
        
        public function get_summary_mentors() {
            $this->db->select('tbl_mentor.name, tbl_mentor.email, tbl_mentor.photo_path, tbl_sig.code, tbl_role.role_name');
            $this->db->from('tbl_mentor');
            $this->db->join('tbl_sig', 'tbl_sig.id = tbl_mentor.sig_fk_id', 'left');
            $this->db->join('tbl_role', 'tbl_mentor.org_role_id_fk = tbl_role.id', 'left');

            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_allmentors() {
            // $this->db->get('tbl_mentor')
            $query = $this->db->get('tbl_mentor');
            return $query->result_array();
        }

        public function getMyMentor($sig_id) {
            $query = $this->db->get_where('tbl_mentor', array('sig_fk_id' => $sig_id));
            return $query->result();
        }
    }