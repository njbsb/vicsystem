<?php
class Collaborator_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_collaborator($collabdata)
    {
        return $this->db->insert('collaborator', $collabdata);
    }

    public function get_collaborators($collab_id = NULL)
    {
        if ($collab_id == FALSE) {
            $query = $this->db->get('collaborator');
            return $query->result_array();
        }
        $query = $this->db->get_where('collaborator', array('id' => $collab_id));
        return $query->row_array();
    }

    public function update($id, $collabdata)
    {
        return $this->db->where('id', $id)
            ->update('collaborator', $collabdata);
    }
}