<?php
    class Role_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_allroles() {
            $query = $this->db->get('tbl_role');
            return $query->result_array();
        }
        
        public function get_mentor_roles() {
            // $query = $this->db->get_where('tbl_role');

            $this->db->select('*');
            $this->db->from('tbl_role');
            $this->db->like('role_name', 'Club');
            $query = $this->db->get();
            return $query->result_array();
        }
    }