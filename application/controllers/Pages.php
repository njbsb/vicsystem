<?php
class Pages extends CI_Controller
{
    public function view($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }
        if ($this->session->userdata('logged_in')) {
            $user = $this->user_model->get_user($this->session->userdata('username'));
            // $data['title'] = 'Welcome, ' . $user['name'];
            $data = array(
                'user_name' => $user['name']
            );

            $this->load->view('templates/header');
            $this->load->view('pages/home_user', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = ucfirst($page);

            $this->load->view('templates/header');
            $this->load->view('pages/' . $page, $data);
            // $this->load->view('templates/footer');
        }
    }
}
