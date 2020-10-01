<?php
class Category extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Category';
        $data['categories'] = $this->category_model->get_category();

        $this->load->view('templates/header');
        $this->load->view('category/index', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {
        $this->form_validation->set_rules('category', 'Category', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Create Category';
            $this->load->view('templates/header');
            $this->load->view('category/create', $data);
            $this->load->view('templates/footer');
        } else {
            $this->category_model->create_category();
            redirect('category');
        }
    }
    public function comments($id = NULL)
    {
        if ($id == FALSE) {
            show_404();
        }
        $data['title'] = $this->category_model->get_category($id)->category;
        $data['comments'] = $this->comment_model->get_comments_bycategory($id);
        $this->load->view('templates/header');
        $this->load->view('category/comments', $data);
        $this->load->view('templates/footer');
    }
}
