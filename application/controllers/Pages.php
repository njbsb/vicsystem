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
            // print_r($user);
            $activesession = $this->academic_model->get_activeacademicsession();
            $activities = $this->activity_model->get_upcomingactivities($user['sig_id'], $activesession['id']);
            foreach ($activities as $key => $act) {
                $date_event = date_create($act['datetime_start']);
                $date_now = date_create(date('y-m-d'));
                $diff = date_diff($date_now, $date_event);
                $d = ($date_event < $date_now) ? 'Event passed' : $diff->format("%r%a days");
                $activities[$key]['diff'] = $d;
            }
            $coursecount = $this->student_model->get_studentbycourse($user['sig_id']);
            $intakedata = $this->student_model->get_studentbyintake($user['sig_id']);
            $pieData = [];
            $barData = [];
            // print_r($coursecount);
            $totalmembercount = 0;
            foreach ($coursecount as $row) {
                $pieData['label'][] = $row->program_id;
                $pieData['data'][] = $row->program_count;
                $totalmembercount += $row->program_count;
            }
            foreach ($intakedata as $intake) {
                $barData['label'][] = $intake->yearjoined;
                $barData['data'][] = $intake->intake_count;
            }
            $data = array(
                'user_name' => $user['name'],
                'activesession' => $this->academic_model->get_activeacademicsession(),
                'birthdaymembers' => $this->user_model->get_birthdaymembers($user['sig_id']),
                'upcomingactivities' => $activities,
                'chart_data' => json_encode($pieData),
                'total_count' => $totalmembercount,
                'barchart_data' => json_encode($barData)
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