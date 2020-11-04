<?php
class Academic extends CI_Controller
{
    public function index()
    {
        $data = array(
            'academicyear' => $this->academic_model->get_academicyear(),
            'academicsession' => $this->academic_model->get_academicsession(),
            'academicplan' => $this->academic_model->get_academicplan(),
            'semesters' => $this->academic_model->get_semester(),
            'title' => 'Academic Control Page'
        );
        $this->load->view('templates/header');
        $this->load->view('academic/index', $data);
        // $this->load->view('templates/footer');
    }

    public function academicplan()
    {
        $student_id = 'A160000';
        $student = $this->student_model->get_student($student_id);
        // $data['student_id'] = $student_id; # to be passed to template
        $activeacadsession = $this->academic_model->get_activeacademicsession();
        $data = array(
            'student_id' => $student_id,
            'student' => $student,
            'thisacademicplan' => $this->academic_model->get_this_academicplan(
                $student_id,
                $activeacadsession['id']
            ),
            'academicsessions' => $this->academic_model->get_academicsession(),
            'academicyears' => $this->academic_model->get_academicyear(),
            'semesters' => $this->semester_model->get_semesters(),
            'title' => 'Student Academic Plan: ' . $student['name'],
            'academicplans' => $this->scoretable->get_arraytable_academicplan(
                $this->academic_model->get_academicplan($student_id)
            ),
            // 'score_levels' => $this->scoretable->get_arraytable_level(
            //     $this->score_model->get_students_scorebylevels($student_id)
            // ),
            'score_comp' => $this->scoretable->get_arraytable_comp(
                $this->score_model->get_students_scorebycomp($student_id)
            ),
            'activeacadsession' => $activeacadsession
        );
        // $this_scorelevel = $this->score_model->get_student_scorelevel($student_id, $activeacadsession['id']);
        // $data['allscore_table'] = $this->scoretable->get_table_allscore($this_scorelevel);

        // $data['tabletotals'] = $this->scoretable->get_arraytable_allscore(
        //     $data['academicplans'],
        //     $data['score_levels'],
        //     $data['score_comp']
        // );

        $this->load->view('templates/header');
        $this->load->view('academic/academicplan', $data);
    }

    public function records()
    {
        $student_id = $this->input->post('student_id');
        $student = $this->student_model->get_student($student_id);
        $acadyear_id = $this->input->post('acadyear_id');
        $semester_id = $this->input->post('semester_id');
        $selected_academicsession = $this->academic_model->get_academicsession_byyearsem($acadyear_id, $semester_id);
        if ($selected_academicsession) {
            $data = array(
                'title' => 'Record: ' . $student['name'],
                'student' => $student,
                'academicsession' => $selected_academicsession,
                'citras' => $this->citra_model->get_citra_registered($student_id, $selected_academicsession['id']),
                'academicplan' => $this->academic_model->get_academicplan($student_id, $selected_academicsession['id']),
                'levelrubrics' => $this->scoretable->get_level_rubrics()
            );

            $scorelevels = $this->score_model->get_student_scorelevel($student_id, $selected_academicsession['id']);
            $total_all = 0;
            foreach ($scorelevels as $key => $scorelevel) {
                $scoreleveltotal = $this->score_model->get_maxscore_position() + $this->score_model->get_maxscore_meeting() + $this->score_model->get_maxscore_attendance() + $this->score_model->get_maxscore_involvement();
                $total = 0;
                foreach ($data['levelrubrics'] as $rubric => $value) {
                    $total += $scorelevel[$rubric];
                }
                $scorelevels[$key]['total'] = $total;
                $scorelevels[$key]['totalpercent'] = ($total / $scoreleveltotal) * $scorelevel['percentweightage'];
                $total_all  += $scorelevels[$key]['totalpercent'];
            }
            $data['scorelevels'] = $scorelevels;
            $scorecomp = $this->score_model->get_student_scorecomp($student_id, $selected_academicsession['id']);
            $scorecomp['total'] = $scorecomp['digitalcv'] + $scorecomp['leadership'] + $scorecomp['volunteer'];
            $total_all += $scorecomp['total'];
            $data['scorecomp'] = $scorecomp;
            $overall_table = array(
                'academicsession' => $selected_academicsession['academicsession'],
                'scorelevels' => $scorelevels,
                'scorecomp' => $scorecomp,
                'total_all' => $total_all
            );

            $data['overall'] = $overall_table;
            // print_r($scorelevels);
            $this->load->view('templates/header');
            $this->load->view('academic/records', $data);
        } else {
            # put error message
            redirect('academicplan');
        }

        // print_r($selected_academicsession);
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
        $acy = $this->academic_model->get_academicyear($this->input->post('acadyear_id'));
        $academicsessiontitle = $acy['acadyear'] . '-' . $this->input->post('semester_id');
        $acs_slug = url_title($academicsessiontitle);

        $acsdata = array(
            'acadyear_id' => $this->input->post('acadyear_id'),
            'semester_id' => $this->input->post('semester_id'),
            'slug' => $acs_slug,
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
