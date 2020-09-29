<?php
class User_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_user($id = FALSE)
    {
        if ($id === FALSE) {
            // return array of users
            $this->db->select('user.id, user.name, ust.usertype, uss.userstatus')
                ->from('tbl_user as user')
                ->join('tbl_usertype as ust', 'user.usertype_id = ust.id', 'left')
                ->join('tbl_userstatus as uss', 'user.userstatus_id = uss.id', 'left');

            $query = $this->db->get();
            return $query->result_array();
        }
        // return specific user
        $this->db->select('user.*, ust.usertype, uss.userstatus, user.dob, sig.code, sig.signame')
            ->from('tbl_user as user')
            ->where('user.id', $id)
            ->join('tbl_usertype as ust', 'user.usertype_id = ust.id', 'left')
            ->join('tbl_userstatus as uss', 'user.userstatus_id = uss.id', 'left')
            ->join('tbl_sig as sig', 'user.sig_id = sig.id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function register_user($usertype_id, $password)
    {
        // 1 = admin, 2 = mentor, 3 = student
        $data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $password,
            'sig_id' => $this->input->post('sig_id'),
            'usertype_id' => $usertype_id,
            'userstatus_id' => '1',
            'dob' => $this->input->post('dob')
        );
        return $this->db->insert('tbl_user', $data);
    }

    public function update_user($id, $userdata)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_user', $userdata);
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_user');
        return true;
    }

    public function get_usertype($matric)
    {
        $usertype_id = $this->db->select('usertype_id')->get_where('tbl_user', array('id' => $matric))->row()->usertype_id;
        return $usertype_id;
    }

    public function get_usertypename($id)
    {
        $usertype_name = $this->db->select('usertype')->get_where('tbl_usertype', array('id' => $id))->row()->usertype;
        return $usertype_name;
    }

    public function approve_user($id)
    {
        $this->db->where('id', $id);
        // 2 = active
        return $this->db->update('tbl_user', array('userstatus_id' => '2'));
    }

    public function id_exist($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
