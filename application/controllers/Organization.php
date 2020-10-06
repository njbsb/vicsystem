<?php
class Organization extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Organization Hierarchy';

        $activeacadyear = $this->committee_model->get_activeacadyear();
        $data['activeacadyear'] = $activeacadyear;
        $acadyear_id = $activeacadyear['id'];
        $sig_id = '1';
        $data['sig_id'] = $sig_id;

        # load data of the highcoms, ajk, and members
        $data['president'] = $this->committee_model->get_president($sig_id, $acadyear_id);
        $data['deputypresident'] = $this->committee_model->get_deputypresident($sig_id, $acadyear_id);
        $data['treasurer'] = $this->committee_model->get_orgtreasurer($sig_id, $acadyear_id);
        $data['secretary'] = $this->committee_model->get_orgsecretary($sig_id, $acadyear_id);
        $data['orgajks'] = $this->committee_model->get_ajks($sig_id, $acadyear_id);

        # load data for table
        $data['sigcommittees'] = $this->committee_model->get_orgcommittee($sig_id);

        # for register new org committee member
        $data['roles_org'] = $this->committee_model->get_roles_org();
        $data['sig_member'] = $this->student_model->get_sigstudents($sig_id);

        $this->load->view('templates/header');
        $this->load->view('organization/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete_committee()
    {
        $acadyear_id = $this->committee_model->get_activeacadyear()['id'];
        $sig_id = '1';
        $matric = $this->input->post('stdmatric');
        $deluser = array(
            'acadyear_id' => $acadyear_id,
            'sig_id' => $sig_id,
            'student_matric' => $matric
        );
        $this->committee_model->delete_orgcommittee($deluser);
        redirect('organization');
    }

    public function register_committee()
    {
        $comdata = array(
            'acadyear_id' => $this->input->post('acadyear_id'),
            'student_matric' => $this->input->post('student_id'),
            'sig_id' => '1',
            'role_id' => $this->input->post('role_id'),
            'role_desc' => $this->input->post('role_desc'),
        );
        $this->committee_model->register_org_committee($comdata);
        redirect('organization');
    }
}
