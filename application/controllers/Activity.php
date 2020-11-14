<?php
class Activity extends CI_Controller
{
    public function index()
    {
        $user_id = $this->session->userdata('username');
        $sig_id = $this->sig_model->get_sig_id($user_id);
        if ($this->session->userdata('isAdmin')) {
            $activities = $this->activity_model->get_activity();
        } else {
            $activities = $this->activity_model->get_sig_activity($sig_id);
        }
        foreach ($activities as $i => $activity) {
            $committee = $this->activity_model->get_committees($activity['id']);
            $activities[$i]['committeenum'] = count($committee);
        }
        $data = array(
            'title' => 'Activities',
            'activitycategory' => $this->activity_model->get_activitycategory(),
            'activities' => $activities
        );
        $this->load->view('templates/header');
        $this->load->view('activity/index', $data);
        // $this->load->view('templates/footer');
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
        $data = array(
            'title' => $activity['activity_name'],
            'activity' => $activity,
            'comments' => $this->comment_model->get_comments($activity['id']),
            'committees' => $this->activity_model->get_committees($activity['id']),
            'categories' => $this->category_model->get_category(),
            'activity_roles' => $this->committee_model->get_roles_activity(),
            'sig_members' => $this->student_model->get_sigstudents($activity['sig_id']),
            'highcoms_id' => $this->committee_model->get_acthighcoms_id()
        );
        if ($this->session->userdata('isStudent')) {
            $isHighcom = $this->activity_model->check_activity_highCom($this->session->userdata('username'), $activity['id']);
            $data['isHighcom'] = $isHighcom;
        }
        $this->load->view('templates/header');
        $this->load->view('activity/view', $data);
        if ($data['committees']) {
            $this->load->view('activity/committee', $data);
        }
        $this->load->view('activity/comments');
    }

    public function create()
    {
        $sig_id = '1';

        $this->form_validation->set_rules('activityname', 'Activity Name', 'required');

        if ($this->form_validation->run() == FALSE) {

            if (!$this->input->post('activity_cat')) {
                redirect('activity');
            }
            $data = array(
                'activitycategory' => $this->activity_model->get_activitycategory($this->input->post('activity_cat')),
                'activitytype' => $this->activity_model->get_activitytype($this->input->post('activity_cat')),
                'title' => 'Create Activity',
                'academicsessions' => $this->academic_model->get_academicsession(),
                'sigs' => $this->sig_model->get_sig(),
                'mentors' =>  $this->mentor_model->get_mentor(),
                'semesters' => $this->semester_model->get_semesters(),
                'sigstudents' => $this->student_model->get_sigstudents($sig_id),
                'highcoms' => $this->activity_model->get_act_highcoms_position(),
                'activesession' => $this->academic_model->get_activeacademicsession()
            );
            $this->load->view('templates/header');
            $this->load->view('activity/mentor/create', $data);
            // $this->load->view('templates/footer');
        } else {
            $slug = url_title($this->input->post('activityname'));
            // $config = array(
            //     'upload_path' => './assets/images/activity',
            //     'allowed_types' => 'gif|jpg|png',
            //     'max_size' => 1000,
            //     'max_width' => 2048,
            //     'max_height' => 1024,
            //     'file_name' => $slug . '-' . substr(md5(rand()), 0, 10)
            // );
            // $this->load->library('upload', $config);

            // if (@$_FILES['photo_path']['name'] != NULL) {
            //     if ($this->upload->do_upload('photo_path')) {
            //         $photo_path = $this->upload->data('file_name');
            //     } else {
            //         $photo_path = 'default.jpg';
            //     }
            // }

            $activity_data = array(
                'activity_name' => $this->input->post('activityname'),
                'activitycategory_id' => $this->input->post('activitycategory_id'),
                // 'activitytype_id' => $this->input->post('activitytype_id'),
                'acadsession_id' => $this->input->post('acadsession_id'),
                'sig_id' => $sig_id,
                'advisor_matric' => $this->input->post('advisor_matric'),
                'slug' => $slug
            );
            # returns newly added activity ID
            $activity_id = $this->activity_model->create_activity($activity_data);
            $highcoms = $this->input->post('highcoms');
            foreach ($highcoms as $id => $highcom) {
                $highcomdata = array(
                    'activity_id' => $activity_id,
                    'student_matric' => $highcom,
                    'role_id' => $id
                );
                $this->committee_model->register_act_committee($highcomdata);
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
        $sig_id = 1;
        $activity = $this->activity_model->get_activity($slug);
        if (empty($activity)) {
            show_404();
        }
        $data = array(
            'title' => 'Edit: ' . $activity['activity_name'],
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
    }

    public function update()
    {
        $id = $this->input->post('id');
        $slug = url_title($this->input->post('activityname'));

        # Photo
        $config_photo = array(
            'upload_path' => './assets/images/activity',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 1000,
            'max_width' => 2048,
            'max_height' => 1024,
            'file_name' => $slug . '-' . substr(md5(rand()), 0, 10),
        );
        $this->load->library('upload', $config_photo);

        if (@$_FILES['photo_path']['name'] != NULL) {
            if ($this->upload->do_upload('photo_path')) {
                $photo_path = $this->upload->data('file_name');
            } else {
                $photo_path = 'default.jpg';
            }
        } else {
            $photo_path = $this->input->post('photo_path_hidden');
        }

        # Paperwork / documents
        $config_file = array(
            'allowed_types' => 'docx|doc|pdf',
            'file_name' => $slug . '- paperwork - ' . substr(md5(rand()), 0, 10),
            'upload_path' => './assets/images/activity'
        );
        $this->load->library('upload', $config_file);
        if (@$_FILES['paperwork_file']['name'] != NULL) {
            if ($this->upload->do_upload('paperwork_file')) {
                $paperwork_file = $this->upload->data('file_name');
            } else {
                $paperwork_file = '';
            }
        } else {
            $paperwork_file = $this->input->post('paperwork_file_hidden');
        }

        $activitydata = array(
            'activity_name' => $this->input->post('activityname'),
            'activity_desc' => $this->input->post('activitydesc'),
            'venue' => $this->input->post('venue'),
            'theme' => $this->input->post('theme'),
            // 'acadsession_id' => $this->input->post('academicsession_id'),
            // 'sig_id' => $this->input->post('sig_id'),
            // 'advisor_matric' => $this->input->post('advisor_matric'),
            'datetime_start' => $this->input->post('datetime_start'),
            'datetime_end' => $this->input->post('datetime_end'),
            'slug' => $slug,
            'photo_path' => $photo_path,
            'paperwork_file' => $paperwork_file
        );

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
    }

    public function addcommittee($activity_id)
    {
        $slug = $this->get_slug($activity_id);
        $comdata = array(
            'activity_id' => $activity_id,
            'role_id' => $this->input->post('role_id'),
            'student_matric' => $this->input->post('student_matric'),
            'role_desc' => $this->input->post('role_desc')
        );
        $this->committee_model->register_act_committee($comdata);
        redirect('activity/' . $slug);
    }

    public function get_slug($activity_id)
    {
        return $this->activity_model->get_slug($activity_id);
    }
}
