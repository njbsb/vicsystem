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

        $data['thisacademicplan'] = $this->academic_model->get_this_academicplan($student_id, $acadsession_id);

        $data['title'] = 'Student Academic Plan';

        $raw_scorelevels = $this->score_model->get_students_scorebylevels($student_id);
        $raw_scorecomp = $this->score_model->get_students_scorebycomp($student_id);
        $raw_academicplan = $this->academic_model->get_academicplan($student_id);

        # for each table displayed in the template
        $data['academicplans'] = $this->get_arraytable_academicplan($raw_academicplan);
        $data['score_levels'] = $this->get_arraytable_level($raw_scorelevels);
        $data['score_comp'] = $this->get_arraytable_comp($raw_scorecomp);
        $data['tabletotals'] = $this->get_arraytable_allscore($data['academicplans'], $data['score_levels'], $data['score_comp']);

        $data['activeacadsession'] = $activeacadsession;
        $this->load->view('templates/header');
        $this->load->view('academic/academicplan', $data);
        $this->load->view('templates/footer');
    }

    public function get_arraytable_academicplan($academicplans)
    {
        $acadplans = array();
        for ($i = 0; $i < count($academicplans); $i++) {
            $acp = $academicplans[$i];
            $citrarow = $this->citra_model->get_students_registeredcitra($acp['student_matric'], $acp['acadsession_id']);
            $citrastring = '';
            foreach ($citrarow as $cr) {
                $citrastring .= $cr['citra_code'] . ' ';
            }
            $acparray = array(
                'acadsession_id' => $acp['acadsession_id'],
                'academicsession' => $acp['academicsession'],
                'citra_reg' => $citrastring,
                'gpa_target' => $acp['gpa_target'],
                'gpa_achieved' => $acp['gpa_achieved'],
                'difference' => floatval($acp['gpa_achieved']) - floatval($acp['gpa_target'])
            );
            $acadplans[$i] = $acparray;
        }
        return $acadplans;
    }

    public function get_arraytable_allscore($data_acadplan, $datalevel, $datacomp)
    {
        // $academicsession = $this->get_academicsession($acadsession_id);
        $tabletotals = array();
        for ($i = 0; $i < count($data_acadplan); $i++) {
            $totalarray = array(
                'academicsession' => $data_acadplan[$i]['academicsession'],
                // 'a1' => '0',
                // 'a2' => '0',
                // 'b1' => '0',
                // 'comp' => '0',
                // 'total' => '0'
            );
            $levelkeys = array_keys(array_column($datalevel, 'acadsession_id'), $data_acadplan[$i]['acadsession_id']);
            foreach ($levelkeys as $key) {
                $dl = $datalevel[$key];
                switch ($dl['levelscore_id']) {
                    case '1':
                        $totalarray['a1'] = $dl['totalpercent'];
                        break;
                    case '2':
                        $totalarray['a2'] = $dl['totalpercent'];
                        break;
                    case '3':
                        $totalarray['b1'] = $dl['totalpercent'];
                        break;
                }
            }
            $compkey = array_search($data_acadplan[$i]['acadsession_id'], array_column($datacomp, 'acadsession_id'));
            $totalarray['comp'] = $datacomp[$compkey]['total'];
            $totalarray['total'] = $totalarray['a1'] + $totalarray['a2'] + $totalarray['b1'] + $totalarray['comp'];
            $tabletotals[$i] = $totalarray;
        }
        return $tabletotals;
    }

    public function get_arraytable_level($datalevel)
    {
        for ($i = 0; $i < count($datalevel); $i++) {
            $levelpercentage = $this->score_model->get_levelscore($datalevel[$i]['levelscore_id'])['percentage'];
            $total = $datalevel[$i]['sc_position'] + $datalevel[$i]['sc_meeting'] + $datalevel[$i]['sc_attendance'] + $datalevel[$i]['sc_involvement'];
            $datalevel[$i]['total'] = $total;
            $datalevel[$i]['totalpercent'] = ($total / 20) * $levelpercentage;
        }
        return $datalevel;
    }

    public function get_arraytable_comp($datacomp)
    {
        for ($i = 0; $i < count($datacomp); $i++) {
            $datacomp[$i]['total'] = $datacomp[$i]['sc_digitalcv'] + $datacomp[$i]['sc_leadership'] + $datacomp[$i]['sc_volunteer'];
        }
        return $datacomp;
    }

    public function get_academicsession($acadsession_id)
    {
        $acs = $this->academic_model->get_academicsession($acadsession_id);
        return $acs['academicyear'] . ' Sem ' . $acs['semester_id'];
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
