<?php
    class User_model extends CI_Model {
        
        public function __construct() {
            $this->load->database();
        }
        
        public function get_user($id) {
            $query = $this->db->get_where('tbl_user', array('user_matric' => $id));
            return $query->result_array(); 
        }

        public function register_user($usertype_id) {
            $data = array(
                'user_matric' => $this->input->post('matric'),
                'password' => $this->input->post('password'),
                'usertype_id' => $usertype_id
            );
            return $this->db->insert('tbl_user', $data);
        }
    }