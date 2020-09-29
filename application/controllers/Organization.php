<?php
class Organization extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Organization Hierarchy';
        $data['activeacadyear'] = $this->committee_model->get_activeacadyear();

        print_r($data['activeacadyear']);
        $sig_id = '1';
        $data['sigcommittees'] = $this->committee_model->get_orgcommittee($sig_id);

        $data['president'] = $this->committee_model->get_president($sig_id);
        $data['deputypresident'] = $this->committee_model->get_deputypresident($sig_id);
        $data['treasurer'] = $this->committee_model->get_orgtreasurer($sig_id);
        $data['secretary'] = $this->committee_model->get_orgsecretary($sig_id);
        $data['highcoms'] = array(
            $data['president'],
            $data['deputypresident'],
            $data['treasurer'],
            $data['secretary']
        );
        $data['orgajks'] = $this->committee_model->get_ajks($sig_id);
        // foreach ($data['highcoms'] as $hc) {
        //     if ($hc) {
        //         if (!$hc['profile_image']) {
        //             $hc['profile_image'] = 'default.jpg';
        //         }
        //     }
        // }
        $data['president']['profile_image'] = 'default.jpg';
        print_r($data['president']);
        $this->load->view('templates/header');
        $this->load->view('organization/index', $data);
        $this->load->view('templates/footer');
    }
}
