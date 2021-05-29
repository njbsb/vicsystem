<?php
class Organization extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect(site_url());
        }
        $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
        $sig = $this->sig_model->get_sig($sig_id);
        $activeacadyear = $this->academic_model->get_activeacadyear();
        $acadyear_id = $activeacadyear['id'];

        $president = $this->committee_model->get_org_highcom('president', $acadyear_id);
        $deputypresident = $this->committee_model->get_org_highcom('deputy president', $acadyear_id);
        $treasurer = $this->committee_model->get_org_highcom('treasurer', $acadyear_id);
        $secretary = $this->committee_model->get_org_highcom('secretary', $acadyear_id);

        $secondrows = array(
            'secretary' => $secretary,
            'deputypresident' => $deputypresident,
            'treasurer' => $treasurer
        );
        $secondrowid = array('secretary', 'deputypresident', 'treasurer');
        $secondrownames = array('Secretary', 'Deputy President', 'Treasurer');
        foreach ($secondrowid as $key => $name) {
            if (!$secondrows[$name]) {
                $secondrows[$name] = array(
                    'role' => $secondrownames[$key],
                    'userphoto' => '',
                    'student_id' => 'no data',
                    'name' => '-',
                    'email' => '-',
                    'year' => ''
                );
            }
        }
        if (!$president) {
            $president = array(
                'role' => 'President',
                'userphoto' => '',
                'student_id' => 'no data',
                'name' => '-',
                'email' => '-'
            );
        }
        $data = array(
            'title' => 'Organization Hierarchy',
            'sig' => $sig,
            'isMentor' => $this->session->userdata('user_type') == 'mentor',
            'activeacadyear' => $activeacadyear,
            'president' => $president,
            'secondrows' => $secondrows, # deputy, secretary, treasurer
            'orgajks' => $this->committee_model->get_org_ajks($acadyear_id), # member with committee members (AJK) role
            'sigcommittees' => $this->committee_model->get_org_committees($acadyear_id), # all committees registered in the table
            'roles_org' => $this->committee_model->get_roles_org(), # to register new com
            'sig_member' => $this->student_model->get_sigstudents($sig_id) # to register new com
        );
        // print_r($data['sigcommittees']);
        $this->load->view('templates/header');
        $this->load->view('organization/index', $data);
        $this->load->view('templates/footer');
    }

    public function register_committee()
    {
        $description = $this->input->post('description');
        if ($this->input->post('description') == '') {
            $description = NULL;
        }
        $comdata = array(
            'acadyear_id' => $this->input->post('acadyear_id'),
            'student_id' => $this->input->post('student_id'),
            'role_id' => $this->input->post('role_id'),
            'description' => $description
        );
        $this->committee_model->register_org_committee($comdata);
        redirect('organization');
    }

    public function delete_committee()
    {
        $acadyear_id = $this->input->post('acadyear_id');
        $student_id = $this->input->post('stdmatric');
        $role_id = $this->input->post('role_id');
        $deluser = array(
            'acadyear_id' => $acadyear_id,
            'student_id' => $student_id,
            'role_id' => $role_id
        );
        $this->committee_model->delete_orgcommittee($deluser);
        redirect('organization');
    }
}