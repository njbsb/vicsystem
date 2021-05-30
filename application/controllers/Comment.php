<?php
class Comment extends CI_Controller
{

    public function create($activity_id)
    {
        $slug = $this->input->post('slug');
        $data['activity'] = $this->activity_model->get_activity($slug);
        $this->form_validation->set_rules('comment', 'Comment', 'required');
        if ($this->form_validation->run() != FALSE) {
            $user_id = $this->session->userdata('username');
            $commentdata = array(
                'activity_id' => $activity_id,
                'user_id' => $user_id,
                'comment' => $this->input->post('comment')
            );
            $this->comment_model->create_comment($commentdata);
        }
        redirect('activity/' . $slug);
    }

    public function delete($slug, $comment_id)
    {
        $this->comment_model->delete_comment($comment_id);
        redirect('activity/' . $slug);
    }

    public function pagination($activity_id)
    {
        $config = array(
            'base_url' => '#',
            'total_rows' => $this->comment_model->count_all($activity_id),
            'per_page' => 5,
            'uri_segment' => 3,
            'use_page_numbers' => TRUE,
            'full_tag_open' => '<ul class="pagination">',
            'full_tag_close' => '</ul>',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li>',
            'last_tag_close' => '</li>',
            'next_link' => '&gt;',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_link' => '&lt;',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'cur_tag_open' => '<li class="active"><a href="#">',
            'cur_tag_close' => '</a></li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'num_links' => 1
        );
        $this->pagination->initialize($config);
        $page = $this->$this->uri->segment(3);
        $start = ($page - 1) * $config['per_page'];
        $output = array(
            'pagination_link' => $this->pagination->create_links(),
            'comment_table' => $this->comment_model->fetch_details($activity_id, $config['per_page'], $start)
        );
        echo json_encode($output);
    }
}