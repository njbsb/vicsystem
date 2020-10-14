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
                ->from('activity as act')
                ->join('academicsession as acs', 'act.acadsession_id = acs.id', 'left')
                ->join('academicyear as acy', 'acs.acadyear_id = acy.id', 'left')
                ->join('user as mtr', 'act.advisor_matric = mtr.id', 'left')
                ->join('sig as sig', 'act.sig_id = sig.id')
                ->order_by('act.id', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            // this will get specific activity
            if (!$slug === FALSE) {
                $this->db->select('act.*, mtr.name as advisorname, sig.signame')
                    ->from('activity as act')
                    ->where(array('slug' => $slug))
                    ->join('user as mtr', 'mtr.id = act.advisor_matric')
                    ->join('sig as sig', 'sig.id = act.sig_id');
                $query = $this->db->get();
            } else if (!$activity_id === FALSE) {
                $this->db->select('act.*, mtr.name as advisorname')
                    ->from('activity as act')
                    ->where(array('id' => $activity_id))
                    ->join('user as mtr', 'mtr.id = act.advisor_matric');
                $query = $this->db->get();
            } else {
                // both are not null
                $this->db->select('act.*, mtr.name as advisorname')
                    ->from('activity as act')
                    ->where(array('id' => $activity_id, 'slug' => $slug))
                    ->join('user as mtr', 'mtr.id = act.advisor_matric');
                $query = $this->db->get();
            }
            return $query->row_array();
        }
    }

    public function get_sig_activity($sig_id)
    {
        $query = $this->db->get_where('activity', array(
            'sig_id' => $sig_id
        ));
        return $query->result_array();
    }

    public function create_activity($activity_data)
    {
        $this->db->insert('activity', $activity_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function delete_activity($activity_id)
    {
        $this->db->where('id', $activity_id);
        $this->db->delete('activity');
        return true;
    }

    public function update_activity($activity_id, $activitydata)
    {
        $this->db->where('id', $activity_id);
        return $this->db->update('activity', $activitydata);
    }

    public function get_highcoms($activity_id)
    {
        $this->db->select('actcom.student_matric as id, user.name, actcom.role_id, role.rolename')
            ->from('activity_committee as actcom')
            ->where(array('activity_id' => $activity_id))
            ->join('user as user', 'user.id = actcom.student_matric')
            ->join('role as role', 'role.id = actcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_committees($activity_id)
    {
        $this->db->select('actcom.*, std.name, role.rolename')
            ->from('activity_committee as actcom')
            ->where('activity_id', $activity_id)
            ->join('user as std', 'actcom.student_matric = std.id')
            ->join('role as role', 'actcom.role_id = role.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_slug($activity_id)
    {
        $this->db->select('slug')
            ->from('activity')
            ->where('id', $activity_id);
        $query = $this->db->get();
        return $query->row()->slug;
    }
}
