<?php
class Category_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function create_category()
    {
        $data = array('category' => $this->input->post('category'));
        return $this->db->insert('comment_category', $data);
    }

    public function get_category($id = FALSE)
    {
        // if ($id === FALSE) {
        //     $this->db->order_by('category');
        //     $query = $this->db->get('comment_category');
        //     return $query->result_array();
        // }
        // $query = $this->db->get_where('comment_category', array('id' => $id));
        // return $query->row();
    }
}