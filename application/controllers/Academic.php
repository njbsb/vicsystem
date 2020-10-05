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

    public function academicplan($level_id = NULL)
    {
        $id = 'A160000';
        $acadsession_id = $this->academic_model->get_activeacademicsession()['id'];

        if ($level_id == FALSE) {
            $data['title'] = 'Register Academic Plan';

            $data['raw_scorelevels'] = $this->score_model->get_students_scorebylevels($id, $acadsession_id);
            $data['raw_scorecomp'] = $this->score_model->get_students_scorebycomp($id, $acadsession_id);
            $data['raw_academicplan'] = $this->academic_model->get_academicplan($id);

            $data['academicplans'] = $this->get_arraytable_academicplan($data['raw_academicplan']);
            $data['score_levels'] = $this->get_arraytable_level($acadsession_id, $data['raw_scorelevels']);
            $data['score_comp'] = $this->get_arraytable_comp($acadsession_id, $data['raw_scorecomp']);
            $data['tabletotal'] = $this->get_arraytable_allscore($acadsession_id, $data['score_levels'], $data['score_comp']);
            $this->load->view('templates/header');
            $this->load->view('academic/academicplan', $data);
            $this->load->view('templates/footer');
        }
    }

    public function get_arraytable_academicplan($academicplans)
    {
        $acadplans = array();
        for ($i = 0; $i < count($academicplans); $i++) {
            $acp = $academicplans[$i];
            $id = $acp['student_matric'];
            $acadsess_id = $acp['acadsession_id'];
            $academicsession = $this->get_academicsession($acadsess_id);
            $citrarow = $this->citra_model->get_citrarow($id, $acadsess_id);
            $citrastring = '';
            foreach ($citrarow as $cr) {
                $citrastring .= $cr['citra_code'] . ' ';
            }
            $acparray = array(
                'academicsession' => $academicsession,
                'citra_reg' => $citrastring,
                'gpa_target' => $acp['cgpa_target'],
                'gpa_achieved' => $acp['cgpa_achieved']
            );
            $acadplans[$i] = $acparray;
        }
        return $acadplans;
    }

    public function get_arraytable_allscore($acadsession_id, $datalevel, $datacomp)
    {
        $academicsession = $this->get_academicsession($acadsession_id);
        $totalarray = array(
            'academicsession' => $academicsession,
            'a1' => '0',
            'a2' => '0',
            'b1' => '0',
            'comp' => '0',
            'total' => '0'
        );
        foreach ($datalevel as $data) {
            switch ($data['levelscore_id']) {
                case '1':
                    $totalarray['a1'] = $data['totalpercent'];
                    break;
                case '2':
                    $totalarray['a2'] = $data['totalpercent'];
                    break;
                case '3':
                    $totalarray['b1'] = $data['totalpercent'];
                    break;
            }
        }
        $totalarray['comp'] = $datacomp['total'];
        $totalarray['total'] = $totalarray['a1'] + $totalarray['a2'] + $totalarray['b1'] + $totalarray['comp'];
        return $totalarray;
    }

    public function get_arraytable_level($acadsession_id, $datalevel)
    {
        $academicsession = $this->get_academicsession($acadsession_id);
        for ($i = 0; $i < count($datalevel); $i++) {
            $datalevel[$i]['academicsession'] = $academicsession;
            $levelpercentage = $this->score_model->get_levelscore($datalevel[$i]['levelscore_id'])['percentage'];
            $total = $datalevel[$i]['sc_position'] + $datalevel[$i]['sc_meeting'] + $datalevel[$i]['sc_attendance'] + $datalevel[$i]['sc_involvement'];
            $datalevel[$i]['total'] = $total;
            $datalevel[$i]['totalpercent'] = ($total / 20) * ($levelpercentage / 100);
        }
        return $datalevel;
    }

    public function get_arraytable_comp($acadsession_id, $datacomp)
    {
        $acs = $this->academic_model->get_academicsession($acadsession_id);
        $academicsession = $acs['academicyear'] . ' Sem ' . $acs['semester_id'];
        $datacomp['academicsession'] = $academicsession;
        $datacomp['total'] = $datacomp['sc_digitalcv'] + $datacomp['sc_leadership'] + $datacomp['sc_volunteer'];
        return $datacomp;
    }

    public function get_academicsession($acadsession_id)
    {
        $acs = $this->academic_model->get_academicsession($acadsession_id);
        return $acs['academicyear'] . ' Sem ' . $acs['semester_id'];
    }

    public function create_acadplan($id)
    {
        $this->form_validation->set_rules('fieldname', 'fieldlabel', 'trim|required|min_length[5]|max_length[12]');

        if ($this->form_validation->run() == FALSE) {
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
