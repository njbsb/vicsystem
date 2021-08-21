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
            $upload_file = $_FILES['logo']['tmp_name'];
            if ($upload_file) {
                $data = file_get_contents($upload_file);
                $type = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $collablogo = $base64;
            }

            $collabdata = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('background'),
                'logo' => $collablogo
            );
            $this->collaborator_model->create_collaborator($collabdata);
            redirect('collaborator');
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('collab_name', 'collaborator name', 'required');
        $this->form_validation->set_rules('collab_desc', 'collaborator background', 'required');
        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('collab_id');
            $name = $this->input->post('collab_name');
            $desc = $this->input->post('collab_desc');
            $updatearray = array(
                'name' => $name,
                'description' =>  $desc
            );
            $upload_file = $_FILES['collab_logo']['tmp_name'];
            if ($upload_file) {
                $data = file_get_contents($upload_file);
                $type = pathinfo($_FILES["collab_logo"]["name"], PATHINFO_EXTENSION);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                $updatearray['logo'] = $base64;
            }
            $this->collaborator_model->update($id, $updatearray);
        }
        redirect('collaborator');
    }
}