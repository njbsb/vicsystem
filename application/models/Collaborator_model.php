<?php
class Collaborator_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_collaborator($collabdata)
    {
        return $this->db->insert('tbl_collaborator', $collabdata);
    }

    public function get_collaborators($collab_id = NULL)
    {
        if ($collab_id == FALSE) {
            $query = $this->db->get('tbl_collaborator');
            return $query->result_array();
        }
        $query = $this->db->get_where('tbl_collaborator', array('id' => $collab_id));
        return $query->row_array();
    }
}
