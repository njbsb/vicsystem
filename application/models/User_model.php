<?php
class User_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_user($user_id = FALSE)
    {
        if ($user_id === FALSE) {
            // return array of users
            $this->db->select('user.id, user.name, user.userstatus_id, ust.usertype, uss.userstatus')
                ->from('tbl_user as user')
                ->join('tbl_usertype as ust', 'user.usertype_id = ust.id', 'left')
                ->join('tbl_userstatus as uss', 'user.userstatus_id = uss.id', 'left');

            $query = $this->db->get();
            return $query->result_array();
        }
        // return specific user
        $this->db->select('user.*, ust.usertype, uss.userstatus, user.dob, sig.code, sig.signame')
            ->from('tbl_user as user')
            ->where('user.id', $user_id)
            ->join('tbl_usertype as ust', 'user.usertype_id = ust.id', 'left')
            ->join('tbl_userstatus as uss', 'user.userstatus_id = uss.id', 'left')
            ->join('tbl_sig as sig', 'user.sig_id = sig.id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function register_user($userdata)
    {
        return $this->db->insert('tbl_user', $userdata);
    }

    public function update_user($user_id, $userdata)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('tbl_user', $userdata);
    }

    public function delete_user($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->delete('tbl_user');
        return true;
    }

    public function get_usertype_id($user_id)
    {
        $usertype_id = $this->db->select('usertype_id')->get_where('tbl_user', array('id' => $user_id))->row()->usertype_id;
        return $usertype_id;
    }

    public function get_usertypename($user_id)
    {
        $usertype_name = $this->db->select('usertype')->get_where('tbl_usertype', array('id' => $user_id))->row()->usertype;
        return $usertype_name;
    }

    public function get_userstatus()
    {
        $query = $this->db->get('tbl_userstatus');
        return $query->result_array();
    }

    public function approve_user($user_id)
    {
        $this->db->where('id', $user_id);
        // 2 = active
        return $this->db->update('tbl_user', array('userstatus_id' => '2'));
    }

    public function id_exist($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('tbl_user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
