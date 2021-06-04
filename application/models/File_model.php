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
            $query = $this->db->get_where('filelink', array('id' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->get('filelink');
            return $query->result_array();
        }
    }

    public function update_link($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('filelink', $data);
    }

    public function create_link($data)
    {
        return $this->db->insert('filelink', $data);
    }

    public function delete_link($id)
    {
        return $this->db->where('id', $id)
            ->delete('filelink');
    }

    public function get_image($id = null)
    {
        if ($id) {
            $query = $this->db->get_where('image', array('id' => $id));
            return $query->row_array();
        }
        $query = $this->db->get('image');
        return $query->result_array();
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
}