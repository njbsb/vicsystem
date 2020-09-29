<?php
class Comment extends CI_Controller
{

    public function create($activity_id)
    {

        $slug = $this->input->post('slug');
        $data['activity'] = $this->activity_model->get_activity($slug);

        $this->form_validation->set_rules('comment', 'Comment', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('activity/view', $data);
            $this->load->view('activity/committee');
            $this->load->view('activity/comments');
            $this->load->view('templates/footer');
        } else {
            $commentdata = array(
                'activity_id' => $activity_id,
                'student_matric' => $this->input->post('id'),
                'comment' => $this->input->post('comment'),
                'category_id' => $this->input->post('category_id')
            );
            $this->comment_model->create_comment($commentdata);
            redirect('activity/' . $slug);
        }
    }

    public function comments($category_id)
    {
    }


    // public function get_comments($activity_id) {
    //     $query = $this->db->get_where('tbl_comment', array('activity_id' => $activity_id));
    //     return $query->result_array();
    // }
}
