<?php
    class Activity_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_activities() {
            $query = $this->db->get('tbl_activity');
            return $query->result_array();
        }

        public function get_activity($slug = FALSE) {
            if($slug === FALSE) {
                $query = $this->db->get('tbl_activity');
                return $query->result_array();
            }
            $query = $this->db->get_where('tbl_activity', array('slug' => $slug));
            return $query->row_array();
        }

        // public function get_edit_activity($slug) {
        //     // $this->db->select('act.*')->from('tbl_activity as act')->where('slug', $slug);
        //     $query = $this->db->get_where('tbl_activity', array('slug' => $slug));
        //     // $this->db->join('tbl_academic_session as acs', 'act.acad_session_fk = acs.id', 'left');
        //     // $this->db->join('tbl_sig as sig', 'act.sig_id_fk = sig.id', 'left');
        //     // $this->db->join('tbl_mentor as mtr', 'act.advisor_matric_fk = mtr.matric');
        //     // $query = $this->db->get();
        //     return $query->row_array();
        //     // print_r($query->row_array());
        // }

        public function create_activity() {
            $slug = url_title($this->input->post('activityname'));
            $data = array(
                'activity_name' => $this->input->post('activityname'),
                'activity_desc' => $this->input->post('activitydesc'),
                'acad_session_fk' => $this->input->post('academicsession_id'),
                'semester_fk' => $this->input->post('semester'),
                'sig_id_fk' => $this->input->post('sig_id'),
                'advisor_matric_fk' => $this->input->post('advisor_matric'),
                'datetime_start' => $this->input->post('datetime_start'),
                'datetime_end' => $this->input->post('datetime_end'),
                'slug' => $slug,
                'photo_path' => $this->input->post('photo_path')
            );

            return $this->db->insert('tbl_activity', $data);
        }

        public function delete_activity($id) {
            $this->db->where('id', $id);
            $this->db->delete('tbl_activity');
            return true;
        }

        public function update_activity($id) {
            
        }

        // public function get_something(){
        //     $CI =& get_instance();
        //     $CI->load->model('profile_model');
        //     return $CI->profile_model->get_another_thing();
        // }
    }

    