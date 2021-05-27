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
            $this->db->select("act.id, act.title, act.slug, act.datetime_start, act.activitycategory_id, act.created_at,
            concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession, sig.code, mtr.name as advisorname")
                ->from('activity as act')
                ->join('academicsession as acs', 'act.acadsession_id = acs.id', 'left')
                ->join('academicyear as acy', 'acs.acadyear_id = acy.id', 'left')
                // ->join('user as mtr', 'act.advisor_matric = mtr.id', 'left')
                ->join('sig as sig', 'act.sig_id = sig.code')
                ->order_by('act.id', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            // this will get specific activity
            if (!$slug === FALSE) {
                $this->db->select('act.*, mtr.name as advisorname, sig.name as signame')
                    ->from('activity as act')
                    ->where(array('slug' => $slug))
                    ->join('user as mtr', 'mtr.id = act.advisor_id')
                    ->join('sig as sig', 'sig.code = act.sig_id');
                $query = $this->db->get();
            } else if (!$activity_id === FALSE) {
                $this->db->select('act.*, mtr.name as advisorname')
                    ->from('activity as act')
                    ->where(array('id' => $activity_id))
                    ->join('user as mtr', 'mtr.id = act.advisor_id');
                $query = $this->db->get();
            } else {
                // both are not null
                $this->db->select('act.*, mtr.name as advisorname')
                    ->from('activity as act')
                    ->where(array('id' => $activity_id, 'slug' => $slug))
                    ->join('user as mtr', 'mtr.id = act.advisor_id');
                $query = $this->db->get();
            }
            return $query->row_array();
        }
    }

    public function get_externalactivity($slug = FALSE)
    {
        $this->db->select('ext.*, level.level, mentor.name as mentorname')
            ->from('activityexternal as ext')
            ->join('academicsession as acs', 'acs.id = ext.acadsession_id', 'left')
            ->join('activitylevel as level', 'level.id = ext.activitylevel_id', 'left')
            ->join('user as mentor', 'mentor.id = ext.mentor_id')
            ->order_by('id', 'desc');
        if ($slug === FALSE) {
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->where(array('ext.slug' => $slug));
            // ->join('academicsession as acs', 'acs.id = ext.acadsession_id', 'left')
            // ->join('activitylevel as level', 'level.id = ext.activitylevel_id', 'left');
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    public function get_externalactivity_participants($activity_id)
    {
        $this->db->select('sext.*, student.id, student.name, student.userphoto')
            ->from('score_external as sext')
            ->where(array('activityexternal_id' => $activity_id))
            ->join('user as student', 'student.id = sext.student_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_activitylevels()
    {
        return $this->db->get('activitylevel')
            ->result_array();
    }

    public function get_upcomingactivities($sig_id, $acadsession_id)
    {
        $this->db->select('*')
            ->from('activity')->where(array(
                'sig_id' => $sig_id,
                'acadsession_id' => $acadsession_id
            ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_sig_activity($sig_id)
    {
        $this->db->select("act.id, act.title, act.description, act.slug, act.activitycategory_id, act.created_at, mtr.name as advisorname,
        act.datetime_start, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession, sig.code")
            ->from('activity as act')
            ->where('act.sig_id', $sig_id)
            ->join('academicsession as acs', 'act.acadsession_id = acs.id', 'left')
            ->join('academicyear as acy', 'acs.acadyear_id = acy.id', 'left')
            ->join('user as mtr', 'act.advisor_id = mtr.id', 'left')
            ->join('sig as sig', 'act.sig_id = sig.code')
            // ->join('activity_type as acttype', 'act.activitytype_id = acttype.id')
            ->order_by('act.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_activity_highCom($user_id, $activity_id)
    {
        $highcoms_id = $this->committee_model->get_acthighcoms_id(); # array
        $this->db->select('*')
            ->from('committee_activity')
            ->where(array(
                'student_id' => $user_id,
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

    public function create_externalactivity($activitydata)
    {
        return $this->db->insert('activityexternal', $activitydata);
    }

    public function delete_activity($activity_id)
    {
        return $this->db->where('id', $activity_id)->delete('activity');
    }

    public function update_activity($activity_id, $activitydata)
    {
        $this->db->where('id', $activity_id);
        return $this->db->update('activity', $activitydata);
    }

    public function get_highcoms($activity_id)
    {
        $highcom_id = $this->committee_model->get_acthighcoms_id();
        $this->db->select('actcom.student_id as id, user.name, actcom.role_id, role.role')
            ->from('committee_activity as actcom')
            ->where(array('actcom.activity_id' => $activity_id))
            ->where_in('actcom.role_id', $highcom_id)
            ->join('user as user', 'user.id = actcom.student_id')
            ->join('role_activity as role', 'role.id = actcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_act_highcoms_position()
    {
        $this->db->select('id, role')
            ->from('role_activity')
            ->where(array(
                'level' => 'student',
                'description' => 'highcom'
            ));
        // ->like('keyword', 'activity')
        // ->like('keyword', 'highcom');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_committees($activity_id)
    {
        $this->db->select('actcom.*, std.name, role.role')
            ->from('committee_activity as actcom')
            ->where('activity_id', $activity_id)
            ->join('user as std', 'actcom.student_id = std.id')
            ->join('role_activity as role', 'actcom.role_id = role.id');
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
                ->from('activitycategory as actcat');
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->select("actcat.*, concat(actcat.category, ' (', actcat.code, ')') as categorycode")
            ->from('activitycategory as actcat')
            ->where(array('code' => $actcat_id));
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
            ->join('score_plan', 'score_plan.activity_id = activity.id');
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
            ->join('score_plan as scp', 'scp.activity_id = act.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_category_unregisteredactivity($acadsession_id, $category_id)
    {
        $activities = $this->get_category_registeredactivity($acadsession_id, $category_id);
        $this->db->select('act.id, act.title');
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
            // 'sig_id' => $sig_id,
            'activitycategory_id' => $category_id
        ))->from('score_plan');
        return $this->db->count_all_results();
    }
}