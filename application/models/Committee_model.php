<?php
class Committee_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_orgcommittee($sig_id)
    {
        $this->db->select('orgcom.*, std.name, role.role')
            ->from('committee_organization as orgcom')
            // ->where(array('orgcom.sig_id' => $sig_id))
            ->join('user as std', 'std.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array('acy.status' => 'active'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_president($sig_id, $acadyear_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, role.role, acy.acadyear')
            ->from('committee_organization as orgcom')
            ->where(array('role_id' => '3'))
            ->join('user as std', 'std.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array('acy.id' => $acadyear_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_deputypresident($sig_id, $acadyear_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, role.role')
            ->from('committee_organization as orgcom')
            ->where(array('role_id' => '4'))
            ->join('user as std', 'std.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array('acy.id' => $acadyear_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_orgtreasurer($sig_id, $acadyear_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, role.role')
            ->from('committee_organization as orgcom')
            ->where(array('role_id' => '7'))
            ->join('user as std', 'std.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array('acy.id' => $acadyear_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_orgsecretary($sig_id, $acadyear_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, role.role')
            ->from('committee_organization as orgcom')
            ->where(array('role_id' => '9'))
            ->join('user as std', 'std.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array('acy.id' => $acadyear_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_ajks($sig_id, $acadyear_id)
    {
        $this->db->select('orgcom.*, std.name, std.email, role.role')
            ->from('committee_organization as orgcom')
            ->where(array('role_id' => '11'))
            ->join('user as std', 'std.id = orgcom.student_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id')
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->where(array('acy.id' => $acadyear_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_activeacadyear()
    {
        $query = $this->db->get_where('academicyear', array('status' => 'active'));
        return $query->row_array();
    }

    public function get_activityroles($student_id)
    {
        # used in profile page
        # shows specific student's role(s) in activities
        $this->db->select("act.id, act.title as activity_name, act.slug, std.name, role.role, actcom.description as role_desc")
            ->from('committee_activity as actcom')
            ->where(array('actcom.student_id' => $student_id))
            ->join('user as std', 'std.id = actcom.student_id')
            ->join('activity as act', 'act.id = actcom.activity_id')
            ->join('role_activity as role', 'role.id = actcom.role_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_orgroles($student_id, $sig_id)
    {
        // used in profile page
        // shows specific student's role(s) in organization
        $this->db->select('acy.acadyear, role.role, orgcom.description as role_desc')
            ->from('committee_organization as orgcom')
            ->where(array('orgcom.student_id' => $student_id))
            ->join('academicyear as acy', 'acy.id = orgcom.acadyear_id')
            ->join('role_organization as role', 'role.id = orgcom.role_id');
        // ->join('sig as sig', 'sig.code = orgcom.sig_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_mentor_activityroles($mentor_id)
    {
        # called in mentor/view
        $this->db->select("act.id, act.slug, act.title,
        concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
            ->from('activity as act')
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
        $this->db->where($deleteuserdata);
        $this->db->delete('committee_organization');
        return true;
    }

    public function get_roles_org()
    {
        $roles = array('3', '4', '7', '8', '9', '10', '11', '12');
        $this->db->select('*')
            ->from('role_organization')
            ->where_in('id', $roles);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_roles_activity()
    {
        $this->db->select('*')
            ->from('role')
            ->like('keyword', 'activity')
            ->not_like('keyword', 'highcom');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_org_committee($comdata)
    {
        $this->db->set($comdata);
        $this->db->insert('committee_organization');
        return true;
    }

    public function register_act_committee($comdata)
    {
        $this->db->set($comdata);
        $this->db->insert('activity_committee');
        return true;
    }

    public function get_acthighcoms_id()
    {
        $this->db->select('id')
            ->from('role')
            ->like('keyword', 'activity')
            ->like('keyword', 'highcom');
        $query = $this->db->get();
        $highcom_id = array();
        foreach ($query->result_array() as $highcom) {
            $highcom_id[] = $highcom['id'];
        }
        return $highcom_id;
    }
}