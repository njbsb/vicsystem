<?php
    class Student_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function get_student($matric = FALSE, $sig = FALSE) {
            if($matric === FALSE) {
                $this->db->select('std.*, prg.name as program_name, sig.signame, mtr.name as mentor_name');
                $this->db->from('tbl_student as std');
                $this->db->join('tbl_program as prg', 'std.program_code_fk = prg.code');
                $this->db->join('tbl_sig as sig', 'std.sig_id_fk = sig.id');
                $this->db->join('tbl_mentor as mtr', 'std.mentor_id_fk = mtr.matric');
                $this->db->order_by('std.matric');
                $query = $this->db->get();
                // $query = $this->db->get('tbl_student');
            return $query->result_array();
            }
            // $query = $this->db->get_where('tbl_student', array('matric' => $matric));
            $this->db->select('std.*, prg.name as program_name, sig.signame, mtr.name as mentor_name');
            $this->db->from('tbl_student as std');
            $this->db->where(array('std.matric' => $matric));
            $this->db->join('tbl_program as prg', 'std.program_code_fk = prg.code');
            $this->db->join('tbl_sig as sig', 'std.sig_id_fk = sig.id');
            $this->db->join('tbl_mentor as mtr', 'std.mentor_id_fk = mtr.matric');
            $query = $this->db->get();
            
            return $query->row_array();
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

        public function update_student() {
            $data = array(
                'matric' => $this->input->post('matric'),
                'name' => $this->input->post('studentname'),
                'phonenum' => $this->input->post('phonenum'),
                'email' => $this->input->post('email'),
                'program_code_fk' => $this->input->post('program_code'),
                'sig_id_fk' => $this->input->post('sig_id'),
                'mentor_id_fk' => $this->input->post('mentor_matric'),
            );
            $this->db->where('matric', $this->input->post('matric'));
            return $this->db->update('tbl_student', $data);
        }
    }