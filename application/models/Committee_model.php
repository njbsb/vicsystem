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

    public function get_activityroles($id)
    {
        $this->db->select('act.activity_name, std.name, role.rolename, actcom.role_desc')
            ->from('tbl_activity_committee as actcom')
            ->where(array('actcom.student_matric' => $id))
            ->join('tbl_user as std', 'std.id = actcom.student_matric')
            ->join('tbl_activity as act', 'act.id = actcom.activity_id')
            ->join('tbl_role as role', 'role.id = actcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_orgroles($id, $sig_id)
    {
        $this->db->select('acy.acadyear, role.rolename, orgcom.role_desc, sig.signame')
            ->from('tbl_org_committee as orgcom')
            ->where(array('orgcom.student_matric' => $id, 'orgcom.sig_id' => $sig_id))
            ->join('tbl_academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->join('tbl_role as role', 'role.id = orgcom.role_id')
            ->join('tbl_sig as sig', 'sig.id = orgcom.sig_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_mentor_activityroles($id)
    {
        $this->db->select('*')
            ->from('tbl');
    }
}
