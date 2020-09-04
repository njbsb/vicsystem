<?php
    class Student_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_students() {
            $query = $this->db->get('tbl_student');
            return $query->result_array();
        }

        public function register_student() {
            $data = array(
                'matric' => $this->input->post('matric'),
                'name' => $this->input->post('name'),
                'phonenum' => $this->input->post('phonenum'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'program_code_fk' => $this->input->post('program_code'),
                'sig_id_fk' => $this->input->post('sig_id'),
                'mentor_id_fk' => $this->input->post('sig_mentor_matric'),
                'photo_path' => $this->input->post('photo_path')
            );
            return $this->db->insert('tbl_student', $data);
            
        }
    }