<?php
class Committee_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_orgcommittee($sig_id)
    {
        $this->db->select('orgcom.*, std.name, std.profile_image, role.rolename')
            ->from('tbl_org_committee as orgcom')
            ->where(array('orgcom.sig_id' => $sig_id))
            ->join('tbl_user as std', 'std.id = orgcom.student_matric')
            ->join('tbl_role as role', 'role.id = orgcom.role_id')
            ->join('tbl_academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array('acy.status' => 'active'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_president($sig_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, std.profile_image, role.rolename, acy.acadyear')
            ->from('tbl_org_committee as orgcom')
            ->where(array('orgcom.sig_id' => $sig_id, 'role_id' => '3'))
            ->join('tbl_user as std', 'std.id = orgcom.student_matric')
            ->join('tbl_role as role', 'role.id = orgcom.role_id')
            ->join('tbl_academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array('acy.status' => 'active'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_deputypresident($sig_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, std.profile_image, role.rolename')
            ->from('tbl_org_committee as orgcom')
            ->where(array('orgcom.sig_id' => $sig_id, 'role_id' => '4'))
            ->join('tbl_user as std', 'std.id = orgcom.student_matric')
            ->join('tbl_role as role', 'role.id = orgcom.role_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_orgtreasurer($sig_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, std.profile_image, role.rolename')
            ->from('tbl_org_committee as orgcom')
            ->where(array('orgcom.sig_id' => $sig_id, 'role_id' => '7'))
            ->join('tbl_user as std', 'std.id = orgcom.student_matric')
            ->join('tbl_role as role', 'role.id = orgcom.role_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_orgsecretary($sig_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, std.profile_image, role.rolename')
            ->from('tbl_org_committee as orgcom')
            ->where(array('orgcom.sig_id' => $sig_id, 'role_id' => '9'))
            ->join('tbl_user as std', 'std.id = orgcom.student_matric')
            ->join('tbl_role as role', 'role.id = orgcom.role_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_ajks($sig_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, std.profile_image, role.rolename')
            ->from('tbl_org_committee as orgcom')
            ->where(array('orgcom.sig_id' => $sig_id, 'role_id' => '11'))
            ->join('tbl_user as std', 'std.id = orgcom.student_matric')
            ->join('tbl_role as role', 'role.id = orgcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_activeacadyear()
    {
        $query = $this->db->get_where('tbl_academicyear', array('status' => 'active'));
        return $query->row_array();
    }

    public function get_activityroles($student_id)
    {
        // used in profile page
        // shows specific student's role(s) in activities
        $this->db->select('act.activity_name, std.name, role.rolename, actcom.role_desc')
            ->from('tbl_activity_committee as actcom')
            ->where(array('actcom.student_matric' => $student_id))
            ->join('tbl_user as std', 'std.id = actcom.student_matric')
            ->join('tbl_activity as act', 'act.id = actcom.activity_id')
            ->join('tbl_role as role', 'role.id = actcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_orgroles($student_id, $sig_id)
    {
        // used in profile page
        // shows specific student's role(s) in organization
        $this->db->select('acy.acadyear, role.rolename, orgcom.role_desc, sig.signame')
            ->from('tbl_org_committee as orgcom')
            ->where(array('orgcom.student_matric' => $student_id, 'orgcom.sig_id' => $sig_id))
            ->join('tbl_academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->join('tbl_role as role', 'role.id = orgcom.role_id')
            ->join('tbl_sig as sig', 'sig.id = orgcom.sig_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_mentor_activityroles($mentor_id)
    {
        $this->db->select('act.name, role.rolename')
            ->from('tbl_activity')
            ->where('advisor_matric', $mentor_id);
        // ->join('tbl_role as role', 'role.id = ')
    }

    public function delete_orgcommittee($deleteuserdata)
    {
        $this->db->where($deleteuserdata);
        $this->db->delete('tbl_org_committee');
        return true;
    }

    public function get_roles_org()
    {
        $roles = array('3', '4', '7', '8', '9', '10', '11', '12');
        $this->db->select('*')
            ->from('tbl_role')
            ->where_in('id', $roles);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_roles_activity()
    {
        $roles = array('5', '6', '7', '8', '9', '10', '11', '12');
        $this->db->select('*')
            ->from('tbl_role')
            ->where_in('id', $roles);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_org_committee($comdata)
    {
        $this->db->set($comdata);
        $this->db->insert('tbl_org_committee');
        return true;
    }

    public function register_act_committee($comdata)
    {
        $this->db->set($comdata);
        $this->db->insert('tbl_activity_committee');
        return true;
    }
}
