<?php
class Committee_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_org_highcom($position, $acadyear_id)
    {
        # to get highcom using position string
        $this->db->select("orgcom.*, user.name, user.email, user.userphoto, role.role, (year(CURDATE()) - year(user.startdate) + 1 ) as year")
            ->from('committee_organization as orgcom')
            ->join('user', 'user.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array(
                'acy.id' => $acadyear_id,
                'role.role' => $position
            ));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_org_committees($acadyear_id)
    {
        # to get all committees registered in the table
        $this->db->select('orgcom.*, user.name, user.userphoto, role.role')
            ->from('committee_organization as orgcom')
            ->join('user', 'user.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array(
                'acy.id' => $acadyear_id
            ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_org_ajks($acadyear_id)
    {
        # to get members with committee member (AJK) role
        $this->db->select('orgcom.*, user.name, user.email, user.userphoto, role.role, (year(CURDATE()) - year(user.startdate) + 1 ) as year')
            ->from('committee_organization as orgcom')
            ->join('user', 'user.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array(
                'acy.id' => $acadyear_id,
                'role.role' => 'committee member'
            ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_orgroles($student_id)
    {
        // used in profile page
        // shows specific student's role(s) in organization
        $this->db->select('acy.acadyear, role.role, orgcom.description')
            ->from('committee_organization as orgcom')
            ->where(array(
                'orgcom.student_id' => $student_id
            ))
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_activityroles($student_id)
    {
        # used in profile page
        # shows specific student's role(s) in activities
        $this->db->select("act.id, act.title as activity_name, acy.*, acs.*, act.slug, user.name, role.role, actcom.description")
            ->from('committee_activity as actcom')
            ->where(array(
                'actcom.student_id' => $student_id
            ))
            ->join('user', 'user.id = actcom.student_id')
            ->join('activity as act', 'act.id = actcom.activity_id')
            ->join('academicsession as acs', 'acs.id = act.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
            ->join('role_activity as role', 'role.id = actcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_mentor_activityroles($mentor_id)
    {
        # called in mentor/view
        $this->db->select("act.id, act.slug, act.title, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
            ->from('activity as act')
            // ->join('committee_activity as actcom')
            // ->where('act.advisor_matric', $mentor_id)
            // ->join('commmittee_activity')
            // ->join('user', 'user.id = act.advisor_matric')
            ->join('academicsession as acs', 'acs.id = act.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_orgcommittee($deleteuserdata)
    {
        return $this->db->where($deleteuserdata)
            ->delete('committee_organization');
    }

    public function delete_actcommittee($userdata)
    {
        return $this->db->where($userdata)->delete('committee_activity');
    }

    public function get_roles_org()
    {
        $this->db->select('*')
            ->from('role_organization')
            ->where(array(
                'committee' => true,
                'level' => 'student'

            ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_org_committee($comdata)
    {
        return $this->db->set($comdata)
            ->insert('committee_organization');
    }

    public function register_act_committee($comdata)
    {
        return $this->db->set($comdata)
            ->insert('committee_activity');
    }

    public function get_acthighcoms_id()
    {
        $this->db->select('id')
            ->from('role_activity')
            ->where(array(
                'level' => 'student',
                'description' => 'highcom'
            ));
        $query = $this->db->get();
        $highcom_id = array();
        foreach ($query->result_array() as $highcom) {
            $highcom_id[] = $highcom['id'];
        }
        return $highcom_id;
    }
}