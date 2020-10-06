<?php
class Activity_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_activity($slug = FALSE, $activity_id = FALSE)
    {
        if ($slug === FALSE && $activity_id === FALSE) {
            // this code will get all activities
            $this->db->select('act.*, acs.*, acy.*, sig.*, mtr.name as advisorname')
                ->from('tbl_activity as act')
                ->join('tbl_academicsession as acs', 'act.acadsession_id = acs.id', 'left')
                ->join('tbl_academicyear as acy', 'acs.acadyear_id = acy.id', 'left')
                ->join('tbl_user as mtr', 'act.advisor_matric = mtr.id', 'left')
                ->join('tbl_sig as sig', 'act.sig_id = sig.id')
                ->order_by('act.id', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            // this will get specific activity
            if (!$slug === FALSE) {
                $this->db->select('act.*, mtr.name as advisorname, sig.signame')
                    ->from('tbl_activity as act')
                    ->where(array('slug' => $slug))
                    ->join('tbl_user as mtr', 'mtr.id = act.advisor_matric')
                    ->join('tbl_sig as sig', 'sig.id = act.sig_id');
                $query = $this->db->get();
            } else if (!$activity_id === FALSE) {
                $this->db->select('act.*, mtr.name as advisorname')
                    ->from('tbl_activity as act')
                    ->where(array('id' => $activity_id))
                    ->join('tbl_user as mtr', 'mtr.id = act.advisor_matric');
                $query = $this->db->get();
            } else {
                // both are not null
                $this->db->select('act.*, mtr.name as advisorname')
                    ->from('tbl_activity as act')
                    ->where(array('id' => $activity_id, 'slug' => $slug))
                    ->join('tbl_user as mtr', 'mtr.id = act.advisor_matric');
                $query = $this->db->get();
            }
            return $query->row_array();
        }
    }

    public function get_sig_activity($sig_id)
    {
        $query = $this->db->get_where('tbl_activity', array(
            'sig_id' => $sig_id
        ));
        return $query->result_array();
    }

    public function create_activity()
    {
        $slug = url_title($this->input->post('activityname'));
        $data = array(
            'activity_name' => $this->input->post('activityname'),
            'activity_desc' => $this->input->post('activitydesc'),
            'acadsession_id' => $this->input->post('academicsession_id'),
            'sig_id' => $this->input->post('sig_id'),
            'advisor_matric' => $this->input->post('advisor_matric'),
            'datetime_start' => $this->input->post('datetime_start'),
            'datetime_end' => $this->input->post('datetime_end'),
            'venue' => $this->input->post('venue'),
            'theme' => $this->input->post('theme'),
            'slug' => $slug,
            'photo_path' => $this->input->post('photo_path')
        );

        $this->db->insert('tbl_activity', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function delete_activity($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_activity');
        return true;
    }

    public function update_activity($id, $activitydata)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_activity', $activitydata);
    }

    public function get_highcoms($activity_id)
    {
        $this->db->select('actcom.student_matric as id, user.name, actcom.role_id, role.rolename')
            ->from('tbl_activity_committee as actcom')
            ->where(array('activity_id' => $activity_id))
            ->join('tbl_user as user', 'user.id = actcom.student_matric')
            ->join('tbl_role as role', 'role.id = actcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_committees($id)
    {
        $this->db->select('actcom.*, std.name, role.rolename')
            ->from('tbl_activity_committee as actcom')
            ->where('activity_id', $id)
            ->join('tbl_user as std', 'actcom.student_matric = std.id')
            ->join('tbl_role as role', 'actcom.role_id = role.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_slug($activity_id)
    {
        $this->db->select('slug')
            ->from('tbl_activity')
            ->where('id', $activity_id);
        $query = $this->db->get();
        return $query->row()->slug;
    }
}
