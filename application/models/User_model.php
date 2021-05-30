<?php
class User_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function login($username, $password)
    {
        $query = $this->db->get_where('user', array(
            'id' => $username,
            'password' => $password
        ));
        if ($query->num_rows() == 1 and $query->row(0)->userstatus == 'active') {
            return $query->row(0)->id;
        } else {
            return false;
        }
    }

    public function get_user($user_id = FALSE, $sig_id = FALSE)
    {
        if ($user_id === FALSE and $sig_id === FALSE) {
            # return array of users
            $this->db->select('id, name, userstatus, usertype, sig_id, userphoto')
                ->from('user as user');
            $query = $this->db->get();
            return $query->result_array();
        }
        if ($user_id) {
            # return specific user
            $this->db->select('user.*, sig.code, sig.name as signame')
                ->from('user')
                ->where('user.id', $user_id)
                // ->join('usertype as ust', 'user.usertype_id = ust.id', 'left')
                // ->join('userstatus as uss', 'user.userstatus_id = uss.id', 'left')
                ->join('sig as sig', 'user.sig_id = sig.code', 'left');
            $query = $this->db->get();
            return $query->row_array();
        }
        if ($sig_id) {
            # returns user with specific sig
            $this->db->select('id, name, userstatus, usertype, userphoto')
                ->from('user')
                ->where('sig_id', $sig_id);
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

    public function get_user_superior($id)
    {
        $superior_id = $this->db->get_where('user', array('id' => $id))->row()->superior_id;
        $query = $this->db->get_where('user', array('id' => $superior_id));
        // $query = $this->db->select('user.id, user.name')
        //     ->from('user')
        //     ->where('id', $superior_id)->get();
        return $query->row_array();
    }

    public function get_usertype($user_id)
    {
        $usertype = $this->db->select('usertype')
            ->get_where('user', array('id' => $user_id))
            ->row()->usertype;
        return $usertype;
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
                'usertype' => 'admin'
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
        return $this->db->update('user', array('userstatus' => 'active'));
    }

    public function get_birthdaymembers($sig_id)
    {
        // current month
        $this->db->select('name, dob')
            ->from('user')->where(array(
                'MONTH(dob)' => date('m'),
                'sig_id' => $sig_id
            ));
        $query = $this->db->get();
        return $query->result_array();
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

    public function id_active($user_id)
    {
        $query = $this->db->get_where('user', array('id' => $user_id));
        if ($query->num_rows() > 1 and  $query->row()->userstatus_id != 2) {
            return false;
        } else {
            return true;
        }
    }

    public function import_user($data)
    {
        $rowaffectedcount = 0;
        foreach ($data as $d) {
            $query = $this->db->get_where('user', array(
                'id' => $d['id']
            ));
            if ($query->num_rows() < 1) {
                $this->db->insert('user', $d);
                if ($this->db->affected_rows() > 0) {
                    $rowaffectedcount += 1;
                }
            }
        }
        return $rowaffectedcount;
    }

    public function change_password($username, $password)
    {
        return $this->db->set('password', $password)
            ->where('id', $username)
            ->update('user');
    }

    public function reset_password($username, $password)
    {
        return $this->db->set('password', $password)
            ->where('id', $username)
            ->update('user');
    }
}