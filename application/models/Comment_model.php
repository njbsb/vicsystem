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
        $this->db->select('cmt.*, user.name, user.userphoto')
            ->from('comment as cmt')
            ->where(array('cmt.activity_id' => $activity_id))
            ->join('user', 'user.id = cmt.user_id', 'left');
        // ->join('comment_category as cmtcat', 'cmt.category_id = cmtcat.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_comment($comment_id)
    {
        return $this->db->where('id', $comment_id)->delete('comment');
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

    public function count_all($activity_id)
    {
        $query = $this->db->get_where('comment', array('activity_id' => $activity_id));
        return $query->num_rows();
    }

    public function fetch_details($activity_id, $limit, $start)
    {
        $output = '';
        $this->db->select('*');
        $this->db->from('comment as cmt');
        $this->db->where('cmt.activity_id', $activity_id);
        $this->db->order_by('cmt.commented_at', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        // $output .= '';
        foreach ($query->result() as $row) {
            $output .= '<div class="alert alert-dismissible alert-primary">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        ' . $row->comment . '[by <a href="' . site_url('student/' . $row->student_id) . '"><strong>' . $row->student_id . '</strong></a>]
                    <a href=""><span class="badge badge-pill badge-primary">' . $row->category . '</span></a>
                    </div>';
        }
        return $output;
    }
}