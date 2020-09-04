<?php
    class Activity_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_activity($slug = FALSE) {
            if($slug === FALSE) {
                $this->db->order_by('id', 'DESC');
                $query = $this->db->get('tbl_activity');
                return $query->result_array();
            }
            $query = $this->db->get_where('tbl_activity', array('slug' => $slug));
            return $query->row_array();
        }

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

        public function update_activity() {
            
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
            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('tbl_activity', $data);
        }

    }

    