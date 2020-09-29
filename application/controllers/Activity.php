<?php
class Activity extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Activity';
        $data['activities'] = $this->activity_model->get_activity();
        // print_r($data['activities']);
        $this->load->view('templates/header');
        $this->load->view('activity/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['activity'] = $this->activity_model->get_activity($slug);
        // print_r($data['activity']);
        if (empty($data['activity'])) {
            show_404();
        }
        $data['title'] = $data['activity']['activity_name'];
        $activity_id = $data['activity']['id'];
        $data['comments'] = $this->comment_model->get_comments($activity_id);
        $data['committees'] = $this->activity_model->get_committees($activity_id);
        $data['categories'] = $this->category_model->get_category();

        $this->load->view('templates/header');
        $this->load->view('activity/view', $data);
        if ($data['committees']) {
            $this->load->view('activity/committee');
        }
        $this->load->view('activity/comments');
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $sig_id = '1';

        $this->form_validation->set_rules('activityname', 'Activity Name', 'required');
        $this->form_validation->set_rules('activitydesc', 'Activity Description', 'required');
        $this->form_validation->set_rules('academicsession_id', 'Academic Session', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('sig_id', 'SIG', 'required');
        $this->form_validation->set_rules('advisor_matric', 'Advisor', 'required');
        $this->form_validation->set_rules('photo_path', 'Activity Image');
        $this->form_validation->set_rules('datetime_start', 'Datetime Start');
        $this->form_validation->set_rules('datetime_end', 'Datetime End');

        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Create Activity';
            $data['academicsessions'] = $this->academic_model->get_academicsession();
            $data['sigs'] = $this->sig_model->get_sig();
            $data['mentors'] = $this->mentor_model->get_mentor();
            $data['semesters'] = $this->semester_model->get_semesters();
            $data['sigstudents'] = $this->student_model->get_sigstudents($sig_id);

            $this->load->view('templates/header');
            $this->load->view('activity/create', $data);
            $this->load->view('templates/footer');
        } else {
            $this->activity_model->create_activity();
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
        $data['activity'] = $this->activity_model->get_activity($slug);
        if (empty($data['activity'])) {
            show_404();
        }
        $data['title'] = 'Edit activity';
        $data['academicsessions'] = $this->academic_model->get_academicsession();
        $data['sigs'] = $this->sig_model->get_sig();
        $data['mentors'] = $this->mentor_model->get_mentor();
        $data['semesters'] = $this->semester_model->get_semesters();
        $data['highcoms'] = $this->student_model->get_highcoms($data['activity']['id']);
        $data['sigstudents'] = $this->student_model->get_sigstudents($data['activity']['sig_id']);

        // print_r($data['highcoms']);
        print_r($data['activity']['sig_id']);

        $this->load->view('templates/header');
        $this->load->view('activity/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $slug = url_title($this->input->post('activityname'));
        $activitydata = array(
            'activity_name' => $this->input->post('activityname'),
            'activity_desc' => $this->input->post('activitydesc'),
            'venue' => $this->input->post('venue'),
            'theme' => $this->input->post('theme'),
            'acadsession_id' => $this->input->post('academicsession_id'),
            'sig_id' => $this->input->post('sig_id'),
            'advisor_matric' => $this->input->post('advisor_matric'),
            'datetime_start' => $this->input->post('datetime_start'),
            'datetime_end' => $this->input->post('datetime_end'),
            'slug' => $slug,
            'photo_path' => $this->input->post('photo_path')
        );

        $this->activity_model->update_activity($id, $activitydata);
        redirect('activity/' . $slug);
    }

    public function committee($id)
    {
        $data['activity'] = $this->activity_model->get_activity($id);
        $data['title'] = "Committee";
        $this->load->view('templates/header');
        $this->load->view('activity/committee/index', $data);
        $this->load->view('templates/footer');
    }

    public function addcommittee($id)
    {
    }
}
