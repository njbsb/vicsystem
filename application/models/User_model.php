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
        if ($query->num_rows() == 1 and $query->row(0)->validated) {
            return $query->row(0)->id;
        } else {
            return false;
        }
    }

    public function get_user($user_id = FALSE)
    {
        if ($user_id === FALSE) {
            # return array of users
            $this->db->select('user.*, year(user.startdate) as yearjoined')
                ->from('user');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            # return specific user
            $this->db->select('user.*, sig.code, sig.name as signame')
                ->from('user')
                ->where('user.id', $user_id)
                ->join('sig as sig', 'user.sig_id = sig.code', 'left');
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    # for download
    public function get_userdata()
    {
        # return array of users
        $this->db->select('user.*, year(user.startdate) as yearjoined, student.program_id, student.parent_num1, student.parent_num2, student.address, 
        superior.name as mentorname, mentor.position, mentor.roomnum')
            ->from('user')
            ->join('user as superior', 'superior.id = user.superior_id', 'left')
            ->join('student', 'user.id = student.matric', 'left')
            ->join('mentor', 'user.id = mentor.matric', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_user($userdata)
    {
        return $this->db->insert('user', $userdata);
    }

    public function update_user($user_id, $userdata)
    {
        return $this->db->where('id', $user_id)
            ->update('user', $userdata);
    }

    public function delete_user($user_id)
    {
        return $this->db->where('id', $user_id)
            ->delete('user');
    }

    public function get_user_superior($id)
    {
        $superior_id = $this->db->get_where('user', array('id' => $id))->row()->superior_id;
        $query = $this->db->get_where('user', array('id' => $superior_id));
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
            array('matric' => $user_id)
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
            array('matric' => $user_id)
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

    public function get_birthdaymembers()
    {
        // current month
        $this->db->select('name, dob')
            ->from('user')
            ->where(array(
                'MONTH(dob)' => date('m')
            ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function id_exist($user_id)
    {
        $query = $this->db->get_where('user', array('id' => $user_id));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function id_active($user_id)
    {
        $query = $this->db->get_where('user', array('id' => $user_id));
        if ($query->num_rows() > 1 and $query->row()->startdate < date('Y-m-d')) {
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

    public function check_defaultpassword($username)
    {
        $query = $this->db->get_where('user', array('id' => $username));
        $password = $query->row(0)->password;
        if (md5($username) == $password) {
            return true;
        } else {
            return false;
        }
    }
}