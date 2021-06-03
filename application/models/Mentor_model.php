<?php
class Mentor_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_mentor($matric = FALSE)
    {
        $now = date('Y-m-d');
        if ($matric === FALSE) {
            $this->db->select('user.id, user.name, user.email, mtr.position, sig.code as sigcode, sig.name as signame, role.role')
                ->from('user')
                ->where(array(
                    'usertype' => 'mentor',
                    'user.startdate <=' => $now
                ))
                ->join('mentor as mtr', 'mtr.matric = user.id', 'left')
                ->join('sig as sig', 'sig.code = user.sig_id', 'left')
                ->join('role_organization as role', 'role.id = mtr.role_id', 'left');
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->select('user.id, user.name, user.email, user.sig_id, user.userphoto, user.phonenum, mtr.role_id, role.role, mtr.position, mtr.roomnum, sig.code as sigcode, sig.name as signame')
            ->from('user')
            ->where(array(
                'user.id' => $matric
            ))
            ->join('mentor as mtr', 'mtr.matric = user.id', 'left')
            ->join('role_organization as role', 'mtr.role_id = role.id', 'left')
            ->join('sig', 'sig.code = user.sig_id', 'left');
        // ->join('role_organization as role', 'role.id = mtr.orgrole_id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_mentor_profile($id)
    {
        $query = $this->db->get_where('mentor', array('matric' => $id));
        return $query->row_array();
    }

    public function get_sigmentors($sig_id)
    {
        $this->db->select('user.*, mtr.position, mtr.roomnum, role.role, sig.code as sigcode, sig.name as signame')
            ->from('mentor as mtr')
            ->join('user', 'mtr.matric = user.id', 'left')
            ->where(array(
                'user.sig_id' => $sig_id,
                'user.startdate <=' => date('Y-m-d')
            ))
            ->join('role_organization as role', 'role.id = mtr.role_id')
            ->join('sig as sig', 'sig.code = user.sig_id', 'left');
        // ->join('role_organization as role', 'role.id = mtr.orgrole_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_mentor($mentordata)
    {
        return $this->db->insert('mentor', $mentordata);
    }

    public function update_mentor($id, $mentordata)
    {
        $this->db->where('matric', $id)
            ->set($mentordata);
        if ($this->db->get_where('mentor', array('matric' => $id))->num_rows() > 0) {
            return $this->db->update('mentor');
        } else {
            return $this->db->insert('mentor');
        }
    }

    public function delete_mentor($matric)
    {
        $this->db->where('matric', $matric);
        $this->db->delete('mentor');
        return true;
    }

    public function mentor_exist($matric)
    {
        $query = $this->db->get_where('mentor', array('matric' => $matric));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}