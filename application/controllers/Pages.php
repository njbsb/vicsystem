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
            $activesession = $this->academic_model->get_activeacademicsession();
            $activities = $this->activity_model->get_upcomingactivities($user['sig_id'], $activesession['id']);
            foreach($activities as $key => $act) {
                $date_event = date_create($act['datetime_start']);
                $date_now = date_create(date('y-m-d'));
                $diff = date_diff($date_now, $date_event);
                $d = ($date_event < $date_now) ? 'Event passed' : $diff->format("%r%a days");
                $activities[$key]['diff'] = $d;
            }
            // print_r($activities);
            $data = array(
                'user_name' => $user['name'],
                'activesession' => $this->academic_model->get_activeacademicsession(),
                'birthdaymembers' => $this->user_model->get_birthdaymembers($user['sig_id']),
                'upcomingactivities' => $activities
            );
            // print_r($data['activesession']);
            // $birthdaymembers = $this->user_model->get_birthdaymembers($user['sig_id']);
            // print_r($data['upcomingactivities']);
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