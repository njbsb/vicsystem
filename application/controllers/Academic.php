<?php
class Academic extends CI_Controller
{
    public function index()
    {
        $data['academicyear'] = $this->academic_model->get_academicyear();
        $data['academicsession'] = $this->academic_model->get_academicsession();
        $data['academicplan'] = $this->academic_model->get_academicplan();
        $data['semesters'] = $this->academic_model->get_semester();
        // print_r($data['academicyear']);
        $data['title'] = 'Academic Control Page';
        $this->load->view('templates/header');
        $this->load->view('academic/index', $data);
        $this->load->view('templates/footer');
    }

    public function academicplan()
    {
        $student_id = 'A160000';
        $data['student_id'] = $student_id; # to be passed to template
        $activeacadsession = $this->academic_model->get_activeacademicsession();
        $acadsession_id = $activeacadsession['id'];

        $data['thisacademicplan'] = $this->academic_model->get_this_academicplan(
            $student_id,
            $acadsession_id
        );
        $data['title'] = 'Student Academic Plan';

        // $raw_scorelevels = $this->score_model->get_students_scorebylevels($student_id);
        // $raw_scorecomp = $this->score_model->get_students_scorebycomp($student_id);
        // $raw_academicplan = $this->academic_model->get_academicplan($student_id);

        # for each table displayed in the template
        # scoretable library is autoloaded
        $data['academicplans'] = $this->scoretable->get_arraytable_academicplan(
            $this->academic_model->get_academicplan($student_id)
        );
        $data['score_levels'] = $this->scoretable->get_arraytable_level(
            $this->score_model->get_students_scorebylevels($student_id)
        );
        $data['score_comp'] = $this->scoretable->get_arraytable_comp(
            $this->score_model->get_students_scorebycomp($student_id)
        );
        $data['tabletotals'] = $this->scoretable->get_arraytable_allscore(
            $data['academicplans'],
            $data['score_levels'],
            $data['score_comp']
        );

        $data['activeacadsession'] = $activeacadsession;
        $this->load->view('templates/header');
        $this->load->view('academic/academicplan', $data);
        $this->load->view('templates/footer');
    }

    public function create_academicplan($student_id)
    {
        $this->form_validation->set_rules('gpa_target', 'GPA target', 'required');

        if ($this->form_validation->run() == FALSE) {
        } else {
            $acadsession_id = $this->input->post('activeacadsession_id');
            $acpdata = array(
                'student_matric' => $student_id,
                'acadsession_id' => $acadsession_id,
                'gpa_target' => $this->input->post('gpa_target')
            );
            $this->academic_model->create_academicplan($acpdata);
            $this->score_model->create_emptyscores($student_id, $acadsession_id);
            redirect('academicplan');
        }
    }

    public function create_academicsession()
    {
        $acsdata = array(
            'acadyear_id' => $this->input->post('acadyear_id'),
            'semester_id' => $this->input->post('semester_id'),
            'status' => $this->input->post('status')
        );
        $this->academic_model->create_acs($acsdata);
        redirect('academic');
    }

    public function create_academicyear()
    {
        $acydata = array(
            'acadyear' => $this->input->post('acadyear'),
            'status' => $this->input->post('status')
        );
        $this->academic_model->create_acy($acydata);
        redirect('academic');
    }

    public function set_activesession()
    {
        $id = $this->input->post('session_id');
        $this->academic_model->setactive_acadsession($id);
        redirect('academic');
    }

    public function set_activeyear()
    {
        $id = $this->input->post('acadyear_id');
        $this->academic_model->setactive_acadyear($id);
        redirect('academic');
    }
}
