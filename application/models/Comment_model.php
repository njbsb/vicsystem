<?php
class Comment_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_comment($commentdata)
    {
        return $this->db->insert('comment', $commentdata);
    }

    public function get_comments($activity_id)
    {
        $this->db->select('*')
            ->from('comment as cmt')
            ->where(array('cmt.activity_id' => $activity_id))
            ->join('comment_category as cmtcat', 'cmt.category_id = cmtcat.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_comments_bycategory($category_id)
    {
        $this->db->select('cmt.*, act.activity_name')
            ->from('comment as cmt')
            ->where('category_id', $category_id)
            ->join('activity as act', 'cmt.activity_id = act.id');
        $query = $this->db->get();
        return $query->result_array();
    }
}
