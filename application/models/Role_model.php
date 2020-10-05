<?php
class Role_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_allroles()
    {
        $query = $this->db->get('tbl_role');
        return $query->result_array();
    }

    public function get_mentor_roles()
    {
        $this->db->select('*')
            ->from('tbl_role')
            ->like('rolename', 'Club');
        $query = $this->db->get();
        return $query->result_array();
    }
}
