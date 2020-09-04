<?php
    class Comment extends CI_Controller {
        
        public function create($activity_id) {
            
            $slug = $this->input->post('slug');
            $data['activity'] = $this->activity_model->get_activity($slug);

            $this->form_validation->set_rules('comment', 'Comment', 'required');

            if($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header');
                $this->load->view('activity/view', $data);
                $this->load->view('templates/footer');
            } else {
                $this->comment_model->create_comment($activity_id);
                redirect('activity/'.$slug);
            }
        }

        // public function get_comments($activity_id) {
        //     $query = $this->db->get_where('tbl_activity_comment', array('activity_id_fk' => $activity_id));
        //     return $query->result_array();
        // }
    }