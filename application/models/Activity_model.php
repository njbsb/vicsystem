<?php
    class Activity_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        public function get_activity($slug = FALSE, $id = FALSE) {
            if($slug === FALSE && $id === FALSE) {
                // this code will get all activities
                $this->db->select('act.*, acs.session as acadsession, mtr.name as advisorname');
                $this->db->from('tbl_activity as act');
                $this->db->join('tbl_academic_session as acs', 'act.acad_session_fk = acs.id', 'left');
                $this->db->join('tbl_mentor as mtr', 'act.advisor_matric_fk = mtr.matric', 'left');
                $this->db->order_by('act.id', 'DESC');
                $query = $this->db->get();
                
                // $this->db->order_by('id', 'DESC');
                // $query = $this->db->get('tbl_activity');
                return $query->result_array();
            }
            else {
                // this will get specific activity
                if(!$slug === FALSE) {
                    $query = $this->db->get_where('tbl_activity', array('slug' => $slug));
                }
                else if(!$id === FALSE) {
                    $query = $this->db->get_where('tbl_activity', array('id' => $id));
                }
                else {
                    // both are not null
                    $query = $this->db->get_where('tbl_activity', array('id' => $id, 'slug' => $slug));
                }
                return $query->row_array();
            }
            // this will get specific activity
            // $query = $this->db->get_where('tbl_activity', array('slug' => $slug));
            // return $query->row_array();
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

    