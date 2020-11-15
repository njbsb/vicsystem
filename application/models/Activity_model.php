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
            $this->db->select("act.id, act.activity_name, act.slug, act.datetime_start, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession, sig.code, mtr.name as advisorname")
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
        $this->db->select("act.id, act.activity_name, act.slug, act.datetime_start, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession, sig.code, mtr.name as advisorname")
            ->from('activity as act')
            ->where('act.sig_id', $sig_id)
            ->join('academicsession as acs', 'act.acadsession_id = acs.id', 'left')
            ->join('academicyear as acy', 'acs.acadyear_id = acy.id', 'left')
            ->join('user as mtr', 'act.advisor_matric = mtr.id', 'left')
            ->join('sig as sig', 'act.sig_id = sig.id')
            ->order_by('act.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_activity_highCom($user_id, $activity_id)
    {
        $highcoms_id = $this->committee_model->get_acthighcoms_id(); # array
        $this->db->select('*')
            ->from('activity_committee')
            ->where(array(
                'student_matric' => $user_id,
                'activity_id' => $activity_id,
            ))
            ->where_in('role_id', $highcoms_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
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
        $highcom_id = $this->committee_model->get_acthighcoms_id();
        $this->db->select('actcom.student_matric as id, user.name, actcom.role_id, role.rolename')
            ->from('activity_committee as actcom')
            ->where(array('actcom.activity_id' => $activity_id))
            ->where_in('actcom.role_id', $highcom_id)
            ->join('user as user', 'user.id = actcom.student_matric')
            ->join('role as role', 'role.id = actcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_act_highcoms_position()
    {
        $this->db->select('id, rolename')
            ->from('role')
            ->like('keyword', 'activity')
            ->like('keyword', 'highcom');
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

    public function get_activitycategory($actcat_id = NULL)
    {
        if ($actcat_id == FALSE) {
            $this->db->select("actcat.*, concat(actcat.category, ' (', actcat.code, ')') as categorycode")
                ->from('activity_category as actcat');
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->select("actcat.*, concat(actcat.category, ' (', actcat.code, ')') as categorycode")
            ->from('activity_category as actcat')
            ->where(array('id' => $actcat_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_activitytype($category_id = NULL)
    {
        if ($category_id == FALSE) {
            $query = $this->db->get('activity_type');
            return $query->result_array();
        }
        $query = $this->db->get_where('activity_type', array('category_id' => $category_id));
        return $query->result_array();
    }

    public function get_categoryactivity($acadsession_id, $category_id)
    {
        $this->db->select("id, activity_name")
            ->from('activity')
            ->where(array(
                'activity.acadsession_id' => $acadsession_id,
                'activity.activitycategory_id' => $category_id
            ))
            ->join('scoringplan', 'scoringplan.activity_id = activity.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_category_registeredactivity($acadsession_id, $category_id)
    {
        $this->db->select('act.id')
            ->from('activity as act')
            ->where(array(
                'act.acadsession_id' => $acadsession_id,
                'act.activitycategory_id' => $category_id
            ))
            ->join('scoringplan as scp', 'scp.activity_id = act.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_category_unregisteredactivity($acadsession_id, $category_id)
    {
        $activities = $this->get_category_registeredactivity($acadsession_id, $category_id);
        $this->db->select('act.id, act.activity_name');
        $this->db->from('activity as act');
        $this->db->where(array(
            'act.acadsession_id' => $acadsession_id,
            'act.activitycategory_id' => $category_id
        ));
        foreach ($activities as $act) {
            $this->db->where_not_in('id', array($act['id']));
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_categoryactivitycount($acadsession_id, $category_id, $sig_id)
    {
        $this->db->where(array(
            'acadsession_id' => $acadsession_id,
            'activitycategory_id' => $category_id,
            'sig_id' => $sig_id
        ))->from('scoringplan');
        return $this->db->count_all_results();
    }
}
