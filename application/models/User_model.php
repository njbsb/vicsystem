<?php
class User_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function login($username, $password)
    {
        $this->db->where(array(
            'id' => $username,
            'password' => $password
        ));
        $query = $this->db->get('user');
        if ($query->num_rows() == 1) {
            return $query->row(0)->id;
            # return essential user data: id, usertype, sig_id, mentor_id
        } else {
            return false;
        }
    }

    public function get_user($user_id = FALSE, $sig_id = FALSE)
    {
        if ($user_id === FALSE and $sig_id === FALSE) {
            # return array of users
            $this->db->select('user.id, user.name, user.userstatus_id, ust.usertype, uss.userstatus')
                ->from('user as user')
                ->join('usertype as ust', 'user.usertype_id = ust.id', 'left')
                ->join('userstatus as uss', 'user.userstatus_id = uss.id', 'left');
            $query = $this->db->get();
            return $query->result_array();
        }
        if ($user_id) {
            # return specific user
            $this->db->select('user.*, ust.usertype, uss.userstatus, user.dob, sig.code, sig.signame')
                ->from('user')
                ->where('user.id', $user_id)
                ->join('usertype as ust', 'user.usertype_id = ust.id', 'left')
                ->join('userstatus as uss', 'user.userstatus_id = uss.id', 'left')
                ->join('sig as sig', 'user.sig_id = sig.id', 'left');
            $query = $this->db->get();
            return $query->row_array();
        }
        if ($sig_id) {
            # returns user with specific sig
            $this->db->select('user.id, user.name, user.userstatus_id, ust.usertype, uss.userstatus')
                ->from('user as user')
                ->where('sig_id', $sig_id)
                ->join('usertype as ust', 'user.usertype_id = ust.id', 'left')
                ->join('userstatus as uss', 'user.userstatus_id = uss.id', 'left');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function register_user($userdata)
    {
        return $this->db->insert('user', $userdata);
    }

    public function update_user($user_id, $userdata)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('user', $userdata);
    }

    public function delete_user($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->delete('user');
        return true;
    }

    public function get_usertype_id($user_id)
    {
        $usertype_id = $this->db->select('usertype_id')
            ->get_where('user', array('id' => $user_id))
            ->row()->usertype_id;
        return $usertype_id;
    }

    public function get_mentor_status($user_id)
    {
        $query = $this->db->get_where(
            'mentor',
            array(
                'matric' => $user_id
            )
        );
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_student_status($user_id)
    {
        $query = $this->db->get_where(
            'student',
            array(
                'matric' => $user_id
            )
        );
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_admin_status($user_id)
    {
        $query = $this->db->get_where(
            'user',
            array(
                'id' => $user_id,
                'usertype_id' => 1
            )
        );
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_my_sig($user_id)
    {
        $query = $this->db->get_where('user', array('id' => $user_id));
        $my_sig = $this->sig_model->get_sig($query->row()->sig_id);
        return $my_sig;
    }

    public function get_usertypename($user_id)
    {
        $usertype_name = $this->db->select('usertype')->get_where('usertype', array('id' => $user_id))->row()->usertype;
        return $usertype_name;
    }

    public function get_userstatus()
    {
        $query = $this->db->get('userstatus');
        return $query->result_array();
    }

    public function approve_user($user_id)
    {
        $this->db->where('id', $user_id);
        // 2 = active
        return $this->db->update('user', array('userstatus_id' => '2'));
    }

    public function id_exist($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
