<?php
class Role_model extends CI_Model
{
    # this model works on role_organization and role_activity table in db

    public function __construct()
    {
        $this->load->database();
    }

    public function get_mentor_roles()
    {
        $this->db->select('*')
            ->from('role_organization')
            ->where(array('level' => 'mentor'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_roles_activity()
    {
        $this->db->select('*')
            ->from('role_activity')
            ->where(array(
                'level' => 'student',
                'description' => NULL
            ));
        $query = $this->db->get();
        return $query->result_array();
    }
}