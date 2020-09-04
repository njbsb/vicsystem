<?php
    class Comment_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        // public function get_comments($activityid) {
        //     $query = $this->db->get('tbl_activity_comment');
        //     return $query->result_array();
        // }

        public function create_comment($activity_id) {
            $data = array(
                'activity_id_fk' => $activity_id,
                'student_matric_fk' => $this->input->post('matric'),
                'role_id_fk' => '12',
                'comment' => $this->input->post('comment')
            );

            return $this->db->insert('tbl_activity_comment', $data);
        }
        public function get_comments($activity_id) {
            $query = $this->db->get_where('tbl_activity_comment', array('activity_id_fk' => $activity_id));
            return $query->result_array();
        }
    }