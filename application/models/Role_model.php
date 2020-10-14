<?php
class Role_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_allroles()
    {
        $query = $this->db->get('role');
        return $query->result_array();
    }

    public function get_mentor_roles()
    {
        $this->db->select('*')
            ->from('role')
            ->like('rolename', 'Club');
        $query = $this->db->get();
        return $query->result_array();
    }
}
