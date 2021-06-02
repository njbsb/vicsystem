<?php
class Activity extends CI_Controller
{
    public function index()
    {
        $user_id = $this->session->userdata('username');
        $sig_id = $this->sig_model->get_sig_id($user_id);
        if ($this->session->userdata('user_type') == 'admin') {
            $activities = $this->activity_model->get_activity();
        } else {
            $activities = $this->activity_model->get_sig_activity($sig_id);
        }
        foreach ($activities as $i => $activity) {
            $committee = $this->activity_model->get_committees($activity['id']);
            $activities[$i]['committeenum'] = count($committee);
            $activities[$i]['committees'] = $committee;
        }
        $data = array(
            'title' => 'Activities',
            'sig' => $this->sig_model->get_sig($sig_id),
            'activitycategory' => $this->activity_model->get_activitycategory(),
            'activities' => $activities
        );
        $this->load->view('templates/header');
        $this->load->view('activity/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        if (!$this->session->userdata('username')) {
            redirect(site_url());
        }
        $activity = $this->activity_model->get_activity($slug);
        if (empty($activity)) {
            show_404();
        }
        // $activity['datetime_start'] = date('jS M Y', strtotime($activity['datetime_start']));
        // $activity['datetime_end'] = date('jS M Y', strtotime($activity['datetime_end']));
        $data = array(
            'title' => $activity['title'],
            'activity' => $activity,
            'comments' => $this->comment_model->get_comments($activity['id']),
            'committees' => $this->activity_model->get_committees($activity['id']),
            'categories' => $this->category_model->get_category(),
            'activity_roles' => $this->role_model->get_roles_activity(),
            'sig_members' => $this->student_model->get_sigstudents($activity['sig_id']),
            'highcoms_id' => $this->committee_model->get_acthighcoms_id()
        );
        if ($this->session->userdata('user_type') == 'mentor') {
            $isHighcom = $this->activity_model->check_activity_highCom($this->session->userdata('username'), $activity['id']);
            $data['isHighcom'] = $isHighcom;
        } else {
            # if mentor or admin
            $data['isHighcom'] = false;
        }
        $this->load->view('templates/header');
        $this->load->view('activity/view', $data);
        if ($data['committees']) {
            $this->load->view('activity/committee', $data);
        }
        if (isset($data['comments'])) {
            $this->load->view('activity/comments');
        }
        $this->load->view('templates/footer');
    }

    public function create()
    {
        if (!$this->session->userdata('username') or $this->session->userdata('user_type') == 'student') {
            redirect(site_url());
        }
        $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
        $this->form_validation->set_rules('activityname', 'Activity Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            if (!$this->input->post('activity_cat')) {
                redirect('activity');
            }
            $data = array(
                'activitycategory' => $this->activity_model->get_activitycategory($this->input->post('activity_cat')),
                'title' => 'Create Activity',
                'academicsessions' => $this->academic_model->get_academicsession(),
                'sigs' => $this->sig_model->get_sig(),
                'mentors' =>  $this->mentor_model->get_sigmentors($sig_id),
                'semesters' => $this->semester_model->get_semesters(),
                'sigstudents' => $this->student_model->get_sigstudents($sig_id),
                'highcoms' => $this->activity_model->get_act_highcoms_position(),
                'activesession' => $this->academic_model->get_activeacademicsession()
            );
            $this->load->view('templates/header');
            $this->load->view('activity/mentor/create', $data);
            $this->load->view('templates/footer');
        } else {
            $slug = url_title($this->input->post('activityname'));
            $activity_data = array(
                'title' => $this->input->post('activityname'),
                'acadsession_id' => $this->input->post('acadsession_id'),
                'activitycategory_id' => $this->input->post('activitycategory_id'),
                // 'activitytype_id' => $this->input->post('activitytype_id'),
                'datetime_start' => $this->input->post('datetime_start'),
                'datetime_end' => $this->input->post('datetime_end'),
                'sig_id' => $sig_id,
                'author_id' => $this->session->userdata('username'),
                'advisor_id' => $this->input->post('advisor_id'),
                'slug' => $slug
            );
            # returns newly added activity ID
            $activity_id = $this->activity_model->create_activity($activity_data);
            if (isset($activity_id)) {
                $highcoms = $this->input->post('highcoms');
                foreach ($highcoms as $id => $highcom) {
                    $highcomdata = array(
                        'activity_id' => $activity_id,
                        'student_id' => $highcom,
                        'role_id' => $id
                    );
                    $this->committee_model->register_act_committee($highcomdata);
                }
            }
            redirect('activity');
        }
    }

    public function delete($id)
    {
        $this->activity_model->delete_activity($id);
        redirect('activity');
    }

    public function edit($slug)
    {
        $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
        $activity = $this->activity_model->get_activity($slug);
        if (empty($activity)) {
            show_404();
        }
        $data = array(
            'title' => 'Edit: ' . $activity['title'],
            'academicsession' => $this->academic_model->get_academicsession($activity['acadsession_id']),
            'sig' => $this->sig_model->get_sig($sig_id),
            'mentors' => $this->mentor_model->get_mentor(),
            'semesters' => $this->semester_model->get_semesters(),
            'highcoms' => $this->activity_model->get_highcoms($activity['id']),
            'sigstudents' => $this->student_model->get_sigstudents($activity['sig_id']),
            'activity' => $activity,
        );
        $this->load->view('templates/header');
        $this->load->view('activity/edit', $data);
        $this->load->view('templates/footer');
    }

    public function external()
    {
        if (!$this->session->userdata('username')) {
            redirect(site_url());
        }
        $externals = $this->activity_model->get_externalactivity();
        $academicsession = $this->academic_model->get_activeacademicsession();
        if ($academicsession) {
            $students = $this->student_model->get_enrolling_students($academicsession['id']);
        } else {
            $students = array();
        }

        foreach ($externals as $i => $external) {
            $externals[$i]['participants'] = $this->activity_model->get_externalactivity_participants($external['id']);
        }
        $data = array(
            'externals' => $externals,
            'academicsession' => $academicsession,
            'mentors' => $this->mentor_model->get_mentor(),
            'activitylevels' => $this->activity_model->get_activitylevels(),
            'students' => $students
        );
        $this->load->view('templates/header');
        $this->load->view('activity/external', $data);
        $this->load->view('templates/footer');
    }

    public function create_external()
    {
        $this->form_validation->set_rules('title', 'Activity Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('acadsession_id', 'academic session', 'required');
        if ($this->form_validation->run() == FALSE) {
        } else {
            $slug = url_title($this->input->post('title'));
            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'acadsession_id' => $this->input->post('acadsession_id'),
                'slug' => $slug,
                'date' => $this->input->post('date'),
                'mentor_id' => $this->input->post('mentor_id'),
                'activitylevel_id' => $this->input->post('activitylevel_id')
            );
            $this->activity_model->create_externalactivity($data);
        }
        redirect('activity/external');
    }

    public function update_external()
    {
        $id = $this->input->post('editid');
        $title = $this->input->post('edittitle');
        $description = $this->input->post('editdescription');
        $date = $this->input->post('editdate');

        $data = array(
            'title' => $title,
            'description' => $description,
            'date' => $date
        );
        $this->activity_model->update_external($id, $data);
        redirect('activity/external');
    }

    public function add_externalparticipant()
    {
        $activityexternal_id = $this->input->post('external_id');
        $student_id = $this->input->post('student_id');
        $data = array(
            'activityexternal_id' => $activityexternal_id,
            'student_id' => $student_id
        );
        $this->score_model->add_externalparticipant($data);
        redirect('activity/external');
    }

    public function delete_externalparticipant()
    {
        $student_id = $this->input->post('deleteuserid');
        $activityexternal_id = $this->input->post('deleteexternalid');
        $data = array(
            'activityexternal_id' => $activityexternal_id,
            'student_id' => $student_id
        );
        $this->score_model->delete_externalparticipant($data);
        redirect('activity/external');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $slug = url_title($this->input->post('title'));
        $datestart = $this->input->post('datetime_start');
        $dateend = $this->input->post('datetime_end');
        $activitydata = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'venue' => $this->input->post('venue'),
            'theme' => $this->input->post('theme'),
            'advisor_id' => $this->input->post('advisor_id'),
            'slug' => $slug,
            'sp_link' => $this->input->post('sp_link')
        );
        if ($datestart != '0000-00-00 00:00:00' and $dateend != '0000-00-00 00:00:00') {
            $activitydata['datetime_start'] = $datestart;
            $activitydata['datetime_end'] = $dateend;
        }

        $this->activity_model->update_activity($id, $activitydata);
        redirect('activity/' . $slug);
    }

    public function committee($id)
    {
        $data = array(
            'activity' => $this->activity_model->get_activity($id),
            'title' => "Committee"
        );
        $this->load->view('templates/header');
        $this->load->view('activity/committee/index', $data);
        $this->load->view('templates/footer');
    }

    public function addcommittee($activity_id)
    {
        $slug = $this->get_slug($activity_id);
        $comdata = array(
            'activity_id' => $activity_id,
            'role_id' => $this->input->post('role_id'),
            'student_id' => $this->input->post('student_matric'),
            'description' => $this->input->post('role_desc')
        );
        $this->committee_model->register_act_committee($comdata);
        redirect('activity/' . $slug);
    }

    public function delete_committee()
    {
        $slug = $this->input->post('slug');
        $activity_id = $this->input->post('activity_id');
        $student_id = $this->input->post('deletestudentid');
        $role_id = $this->input->post('deleteroleid');
        $data = array(
            'activity_id' => $activity_id,
            'student_id' => $student_id,
            'role_id' => $role_id
        );
        $this->committee_model->delete_actcommittee($data);
        redirect('activity/' . $slug);
    }

    public function get_slug($activity_id)
    {
        return $this->activity_model->get_slug($activity_id);
    }
}