<?php
    class Activity_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_activities() {
            // $this->db->select('tbl_activity');
            $query = $this->db->get('tbl_activity');
            return $query->result_array();
        }

        public function create_activity() {
            $slug = url_title($this->input->post('activityname'));
            $data = array(
                'activityname' => $this->input->post('activityname'),
                'slug' => $slug,
                'activitydesc' => $this->input->post('activitydesc')
                
            );

            return $this->db->insert('tbl_activity', $data);
        }

        public function get_something(){
            $CI =& get_instance();
            $CI->load->model('profile_model');
            return $CI->profile_model->get_another_thing();
        }
    }

    