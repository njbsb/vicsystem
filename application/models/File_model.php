<?php
class File_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create($data)
    {
        return $this->db->insert('filetemplate', $data);
    }

    public function get_template($id = null)
    {
        if ($id === false) {
            $query = $this->db->get_where('filetemplate', array('id' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->get('filetemplate');
            return $query->result_array();
        }
    }

    // public function get_collaborators($collab_id = NULL)
    // {
    //     if ($collab_id == FALSE) {
    //         $query = $this->db->get('collaborator');
    //         return $query->result_array();
    //     }
    //     $query = $this->db->get_where('collaborator', array('id' => $collab_id));
    //     return $query->row_array();
    // }
}