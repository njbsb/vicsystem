<?php
class Mentor_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_mentor($matric = FALSE)
    {
        if ($matric === FALSE) {
            $this->db->select('user.id, user.name, user.email, user.profile_image, mtr.position, sig.code as sigcode, sig.signame, role.rolename')
                ->from('tbl_user as user')
                ->where(array('usertype_id' => '2', 'userstatus_id' => '2'))
                ->join('tbl_mentor as mtr', 'mtr.matric = user.id', 'left')
                ->join('tbl_sig as sig', 'sig.id = user.sig_id', 'left')
                ->join('tbl_role as role', 'role.id = mtr.orgrole_id', 'left');
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->select('user.id, user.name, user.email, user.sig_id, user.profile_image, mtr.position, mtr.roomnum, mtr.orgrole_id, sig.code as sigcode, sig.signame, role.rolename')
            ->from('tbl_user as user')
            ->where(array('user.id' => $matric, 'usertype_id' => '2', 'userstatus_id' => '2'))
            ->join('tbl_mentor as mtr', 'mtr.matric = user.id', 'left')
            ->join('tbl_sig as sig', 'sig.id = user.sig_id', 'left')
            ->join('tbl_role as role', 'role.id = mtr.orgrole_id', 'left');
        $query = $this->db->get();
        if (!$query->num_rows()) {
            $default = array(
                'position' => '',
                'roomnum' => '',
                'orgrole_id' => ''
            );
            return $default;
        }
        return $query->row_array();
    }

    public function get_sigmentors($sig_id)
    {
        $this->db->select('user.id, user.name')
            ->from('tbl_user as user')
            ->where(array('usertype_id' => '2', 'sig_id' => $sig_id));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_mentor($mentordata)
    {
        return $this->db->insert('tbl_mentor', $mentordata);
    }

    public function update_mentor($id, $mentordata)
    {
        $this->db->where('matric', $id);
        return $this->db->update('tbl_mentor', $mentordata);
    }

    public function delete_mentor($matric)
    {
        $this->db->where('matric', $matric);
        $this->db->delete('tbl_mentor');
        return true;
    }

    public function mentor_exist($matric)
    {
        $query = $this->db->get_where('tbl_mentor', array('matric' => $matric));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
