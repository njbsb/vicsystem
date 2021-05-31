<?php
class Collaborator extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Industry Collaborators',
            'collaborators' => $this->collaborator_model->get_collaborators()
        );
        $this->load->view('templates/header');
        $this->load->view('collaborator/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'collaborator name', 'required');
        $this->form_validation->set_rules('background', 'collaborator background', 'required');
        // $this->form_validation->set_rules('logo', 'logo', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Create new collaborator';
            $this->load->view('templates/header');
            $this->load->view('collaborator/create', $data);
            $this->load->view('templates/footer');
        } else {
            $config = array(
                'upload_path' => './assets/images/collaborator',
                'allowed_types' => 'gif|jpg|png',
                'max_size' => 1000,
                'max_width' => 2048,
                'max_height' => 1024,
                'file_name' => url_title($this->input->post('name')) . '-' . substr(md5(rand()), 0, 10)
            );
            $this->load->library('upload', $config);

            if (@$_FILES['logo']['name'] != NULL) {
                if ($this->upload->do_upload('logo')) {
                    $logo = $this->upload->data('file_name');
                } else {
                    $logo = 'default.jpg';
                }
            }

            $collabdata = array(
                'name' => $this->input->post('name'),
                'background' => $this->input->post('background'),
                'logo' => $logo
            );
            $this->collaborator_model->create_collaborator($collabdata);
            redirect('collaborator');
        }
    }
}