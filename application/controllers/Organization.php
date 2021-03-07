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
        $activeacadyear = $this->committee_model->get_activeacadyear();
        $acadyear_id = $activeacadyear['id'];

        $president = $this->committee_model->get_president($sig_id, $acadyear_id);
        $deputypresident = $this->committee_model->get_deputypresident($sig_id, $acadyear_id);
        $treasurer = $this->committee_model->get_orgtreasurer($sig_id, $acadyear_id);
        $secretary = $this->committee_model->get_orgsecretary($sig_id, $acadyear_id);

        $secondrows = array(
            'secretary' => $secretary, 
            'deputypresident' => $deputypresident, 
            'treasurer' => $treasurer);
        $secondrowid = array('secretary', 'deputypresident', 'treasurer');
        $secondrownames = array('Secretary', 'Deputy President', 'Treasurer');
        foreach($secondrowid as $key=>$name) {
            if(!$secondrows[$name]) {
                $secondrows[$name] = array(
                    'rolename' => $secondrownames[$key],
                    'profile_image' => '',
                    'student_matric' => 'no data',
                    'name' => '-',
                    'email' => '-'
                );
            }
        }
        // print_r($secondrows);
        if(!$president) {
            $president = array(
                'rolename' => 'President',
                'profile_image' => '',
                'student_matric' => 'no data',
                'name' => '-',
                'email' => '-'
            );
        }
        $data = array(
            'title' => 'Organization Hierarchy',
            'sig' => $sig,
            'isMentor' => $this->session->userdata('isMentor'),
            'activeacadyear' => $activeacadyear,
            'president' => $president,
            'secondrows' => $secondrows,
            'orgajks' => $this->committee_model->get_ajks($sig_id, $acadyear_id),
            'sigcommittees' => $this->committee_model->get_orgcommittee($sig_id),
            'roles_org' => $this->committee_model->get_roles_org(), # to register new com
            'sig_member' => $this->student_model->get_sigstudents($sig_id) # to register new com
        );
        $this->load->view('templates/header');
        $this->load->view('organization/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete_committee()
    {
        $acadyear_id = $this->committee_model->get_activeacadyear()['id'];
        $sig_id = $this->input->post('sig_id');
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
        $sig_id = $this->input->post('sig_id');
        // $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
        $comdata = array(
            'acadyear_id' => $this->input->post('acadyear_id'),
            'student_matric' => $this->input->post('student_id'),
            'sig_id' => $sig_id,
            'role_id' => $this->input->post('role_id'),
            'role_desc' => $this->input->post('role_desc'),
        );
        $this->committee_model->register_org_committee($comdata);
        redirect('organization');
    }
}