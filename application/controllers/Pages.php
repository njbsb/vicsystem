<?php
class Pages extends CI_Controller
{
    public function view($page = 'home')
    {
        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }
        if ($this->session->userdata('logged_in')) {
            $username  = $this->session->userdata('username');
            $user = $this->user_model->get_user($username);
            switch ($user['usertype']) {
                case 'mentor':
                    $userspecific = $this->mentor_model->get_mentor_profile($username);
                    break;
                case 'student':
                    $userspecific = $this->student_model->get_student_profile($username);
                    break;
            }
            $profileComplete = (isset($userspecific)) ? true : false;

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
                'user' => $user,
                'profileComplete' => $profileComplete,
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
        }
    }

    public function template()
    {
        if ($this->session->userdata('logged_in') and $this->session->userdata('user_type') != 'student') {
            $data = array(
                'title' => 'File Upload Template',
                'templates' => $this->file_model->get_template()
            );
            $this->load->view('templates/header');
            $this->load->view('pages/template', $data);
        } else {
            redirect('home');
        }
    }
}