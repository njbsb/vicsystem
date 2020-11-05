<?php
class Score extends CI_Controller
{
    ###
    # Controller's page
    ###

    public function index()
    {
        $data['title'] = 'Score';
        $activesession_id = $this->academic_model->get_activeacademicsession()['id'];
        $currentsession_students = $this->academic_model->get_registered_student($activesession_id);
        print_r($currentsession_students);
        $data['student_score'] = $this->scoretable->get_arraytable_score($currentsession_students);
        $this->load->view('templates/header');
        $this->load->view('score/index', $data);
    }

    public function view($student_id, $acadsession_slug = NULL)
    {
        $student = $this->student_model->get_student($student_id);
        $thisacadsession = $this->academic_model->get_academicsession(FALSE, $acadsession_slug);
        $data = array(
            'title' => 'Score: ' . $student['name'] . ' on ' . $thisacadsession['academicsession'],
            'student_id' => $student_id,
            'student' => $student,
            'academicsession' => $thisacadsession,
            'guide' => array(
                'position' => $this->score_model->get_guideposition(),
                'meeting' => $this->score_model->get_guidemeeting(),
                'involvement' => $this->score_model->get_guideinvolvement(),
                'attendance' => $this->score_model->get_guideattendance(),
                'digitalcv' => $this->score_model->get_guidedigitalcv(),
                'leadership' => $this->score_model->get_guideleadership()
            ),
            'scoreplans' => $this->score_model->get_scoreplan($thisacadsession['id'], FALSE),
            'scorecomps' => array(
                'scores' => $this->score_model->get_scoreplan_scorecomp($student_id, $thisacadsession['id'])
            ),
            'levelrubrics' => $this->scoretable->get_level_rubrics()
        );
        # score by level will be contained in scoreplans
        # since each score plans will carry 1 score by level

        # SCORE LEVELS
        $scoreleveltotal = $this->score_model->get_maxscore_position() + $this->score_model->get_maxscore_meeting() + $this->score_model->get_maxscore_attendance() + $this->score_model->get_maxscore_involvement();
        foreach ($data['scoreplans'] as $key => $scoreplan) {
            $scores = $this->score_model->get_scoreplan_scorelevel($student_id, $scoreplan['id']);
            if ($scores) {
                $sum = 0;
                foreach ($scores as $score) {
                    $sum += $score;
                }
                $totalpercent = ($sum / $scoreleveltotal) * $scoreplan['percentweightage'];
                $data['scoreplans'][$key]['totalpercent'] = $totalpercent;
            } else {
                $data['scoreplans'][$key]['totalpercent'] = 0;
            }
            $data['scoreplans'][$key]['scores'] = $scores;
        }
        print_r($data['academicsession']);

        # SCORE COMPONENTS
        if ($data['scorecomps']['scores']) {
            $sumcomp = 0;
            foreach ($data['scorecomps']['scores'] as $score) {
                $sumcomp += $score;
            }
            $data['scorecomps']['totalpercent'] = $sumcomp;
        }

        # TOTAL SCORE PERCENT
        $totalwhole = 0;
        foreach ($data['scoreplans'] as $scoreplan) {
            $totalwhole += $scoreplan['totalpercent'];
        }
        $data['totalwhole'] = $totalwhole + $data['scorecomps']['totalpercent'];

        $this->load->view('templates/header');
        $this->load->view('score/view', $data);
    }

    public function scoreplan($slug = NULL)
    {
        if ($slug == FALSE) {
            # scoreplan index
            $activitycategories = $this->activity_model->get_activitycategory();
            $academicsessions = $this->academic_model->get_academicsession();
            foreach ($academicsessions as $index => $acs) {
                foreach ($activitycategories as $id => $cat) {
                    $activitycategories[$id]['categorycount'] = $this->activity_model->get_categoryactivitycount($acs['id'], $cat['id']);
                    $activitycategories[$id]['categorytotalpercent'] = $this->score_model->get_categorytotalpercent($acs['id'], $cat['id']);
                }
                $academicsessions[$index]['activitycategories'] = $activitycategories;
            }
            $data = array(
                'title' => 'All Score Plans',
                'activitycategory' => $activitycategories,
                'activeacadsession' => $this->academic_model->get_activeacademicsession(),
                'academicsessions' => $academicsessions
            );
            $this->load->view('templates/header');
            $this->load->view('score/scoreplanindex', $data);
        } else {
            # scoreplan view
            // $acadsession_id = $this->academic_model->get_academicsession(FALSE, $slug)['id'];
            $academicsession = $this->academic_model->get_academicsession(FALSE, $slug);
            $activitycategories = $this->activity_model->get_activitycategory();
            foreach ($activitycategories as $i => $actcat) {
                $activitycategories[$i]['scoreplan'] = $this->score_model->get_scoreplan($academicsession['id'], $actcat['id']);
                $activitycategories[$i]['unregistered'] = $this->activity_model->get_category_unregisteredactivity($academicsession['id'], $actcat['id']);
            }
            $data = array(
                'acslug' => $slug,
                'activitycategories' => $activitycategories,
                'acadsession' => $academicsession
            );
            print_r($data['activitycategories'][1]['unregistered']);
            $this->load->view('templates/header');
            $this->load->view('score/scoreplanview', $data);
        }
    }

    ###
    # Controller Functions
    ###

    public function addscoreplan()
    {
        $acslug = $this->input->post('acslug');
        $scoreplan = array(
            'acadsession_id' => $this->input->post('acadsession_id'),
            'activitycategory_id' => $this->input->post('activitycategory_id'),
            'activity_id' => $this->input->post('activity_id'),
            'percentweightage' => $this->input->post('percentweightage'),
            'label' => $this->input->post('label')
        );
        $this->score_model->add_scoringplan($scoreplan);
        redirect('scoreplan/' . $acslug);
    }

    public function updatescoreplan()
    {
        $scoreplan_id = $this->input->post('scoreplan_id');
        $scoreplandata = array(
            'label' => $this->input->post('label'),
            'activity_id' => $this->input->post('activity_id'),
            'percentweightage' => $this->input->post('percentweightage')
        );
        $this->score_model->update_scoreplan($scoreplan_id, $scoreplandata);
        redirect('scoreplan/' . $this->input->post('acslug'));
    }


    public function add_scorelevel()
    {
        $acslug = $this->input->post('acslug'); # hidden
        $student_id = $this->input->post('student_id'); #hidden
        $levelrubrics = $this->input->post('keys');
        $scoreleveldata = array(
            'student_matric' => $student_id,
            'scoreplan_id' => $this->input->post('scoreplan_id') #hidden
        );
        foreach ($levelrubrics as $rubricname => $value) {
            $scoreleveldata[$rubricname] = $value;
        }
        // print_r($scoreleveldata);
        $this->score_model->add_scoreleveldata($scoreleveldata);
        redirect('score/' . $student_id . '/' . $acslug);
    }

    public function edit_scorelevel()
    {
        $acslug = $this->input->post('acslug'); # hidden
        $student_id = $this->input->post('student_id'); #hidden
        $levelrubrics = $this->input->post('keys');
        $where = array(
            'scoreplan_id' => $this->input->post('scoreplan_id'),
            'student_matric' => $this->input->post('student_id')
        );
        $scoreleveldata = array();
        foreach ($levelrubrics as $rubricname => $value) {
            $scoreleveldata[$rubricname] = $value;
        }
        $this->score_model->update_scoreleveldata($where, $scoreleveldata);
        redirect('score/' . $student_id . '/' . $acslug);
    }

    public function edit_scorecomp()
    {
        $acslug = $this->input->post('acslug');
        $student_id = $this->input->post('student_id');
        $where = array(
            'student_matric' => $student_id,
            'acadsession_id' => $this->input->post('acadsession_id')
        );
        $keys = $this->input->post('keys');
        $scorecompdata = array();
        foreach ($keys as $key => $value) {
            $scorecompdata[$key] = $value;
        }
        $this->score_model->update_scorecompdata($where, $scorecompdata);
        redirect('score/' . $student_id . '/' . $acslug);
    }

    public function setscorecomp($student_id)
    {
        $where = array(
            'acadsession_id' => $this->input->post('acadsession_id'),
            'student_matric' => $student_id
        );
        $score_comp = array(
            'digitalcv' => $this->input->post('digitalcv'),
            'leadership' => $this->input->post('digitalcv'),
            'volunteer' => $this->input->post('volunteer')
        );
        $this->score_model->setscorecomp($where, $score_comp);
        redirect('score/' . $student_id);
    }
}
