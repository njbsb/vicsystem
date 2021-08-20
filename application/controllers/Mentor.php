<?php
class Mentor extends CI_Controller
{
    public function index()
    {
        $current_id = $this->session->userdata('username');
        $my_sig = $this->user_model->get_my_sig($current_id);
        $data = array(
            'title' => $my_sig['name'] . "'s Mentors",
            'mentors' => $this->mentor_model->get_sigmentors($my_sig['code'])
        );
        if ($this->session->userdata('user_type') == 'student') {
            $mentor_matric = $this->student_model->get_mentor_matric($this->session->userdata('username'));
            $data['mentor_matric'] = $mentor_matric;
        } else {
            $data['mentor_matric'] = null;
        }
        $this->load->view('templates/header');
        $this->load->view('mentor/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($mentor_id)
    {
        $data = array(
            'mentor' => $this->mentor_model->get_mentor($mentor_id),
            'activity_roles' => $this->committee_model->get_mentor_activityroles($mentor_id),
            'isMentor' => $this->session->userdata('user_type') == 'mentor'
        );
        $this->load->view('templates/header');
        $this->load->view('mentor/view', $data);
        $this->load->view('templates/footer');
    }

    public function edit($mentor_id)
    {
        $mentor = $this->mentor_model->get_mentor($mentor_id);
        if (empty($mentor)) {
            show_404();
        }
        $data = array(
            'title' => 'Edit Mentor: ' . $mentor['name'],
            'mentor' => $mentor,
            'sigs' => $this->sig_model->get_sig(),
            'roles' => $this->role_model->get_mentor_roles()
        );
        $this->load->view('templates/header');
        $this->load->view('mentor/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $mentordata = array(
            'position' => $this->input->post('position'),
            'roomnum' => $this->input->post('roomnum'),
            'orgrole_id' => $this->input->post('orgrole_id')
        );
        $userdata = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'sig_id' => $this->input->post('sig_id')
        );
        $this->mentor_model->update_mentor($id, $mentordata);
        $this->user_model->update_user($id, $userdata);
        redirect('mentor/' . $id);
    }
}