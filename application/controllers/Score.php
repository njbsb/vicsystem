<?php
require FCPATH . 'vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Score extends CI_Controller
{
    ###
    # Controller's page
    ###

    public function index()
    {
        if (!$this->session->userdata('user_type') == 'mentor') {
            redirect(site_url());
        }
        $academicsessions = $this->academic_model->get_academicsession();
        foreach ($academicsessions as $i => $academicsession) {
            $enrollingstudents = $this->student_model->get_enrolling_students($academicsession['id']);
            $academicsessions[$i]['enrolling'] = count($enrollingstudents);
        }
        $data = array(
            'title' => "Student's Activity Scores",
            'academicsessions' => $academicsessions,
            'academicyears' => $this->academic_model->get_academicyear(),
            'semesters' => $this->semester_model->get_semesters()
        );
        $this->load->view('templates/header');
        $this->load->view('score/index', $data);
        $this->load->view('templates/footer');
    }

    public function viewacs($acadsession_slug)
    {
        if (!$this->session->userdata('user_type') == 'mentor') {
            redirect(site_url());
        }
        $academicsession = $this->academic_model->get_academicsession(FALSE, $acadsession_slug);
        $enrolling = $this->student_model->get_enrolling_students($academicsession['id']);
        $scoreplans = $this->score_model->get_scoreplan($academicsession['id']);
        $fullscore = 15; # fixed value of components
        foreach ($scoreplans as $scoreplan) {
            $fullscore += $scoreplan['percentweightage'];
        }
        $scoreleveltotal = $this->score_model->get_scoreleveltotal();
        foreach ($enrolling as $i => $std) {
            $score = 0;
            $badgecount = 0;
            foreach ($scoreplans as $scoreplan) {
                $scores = $this->score_model->get_scoreplan_scorelevel($std['matric'], $scoreplan['id']);
                $totalpercent = $scores ? (array_sum($scores) / $scoreleveltotal) * $scoreplan['percentweightage'] : 0;
                $score += $totalpercent;
                $scoresum = ($scores) ? array_sum($scores) : 0;
                if ($scoreplan['activitycategory_id'] == 'A' and $scoresum > 18) {
                    $badgecount += 1;
                }
            }
            $scorecomps = array('scores' => $this->score_model->get_scoreplan_scorecomp($std['matric'], $academicsession['id']));
            if ($scorecomps['scores']) {
                $score += array_sum($scorecomps['scores']);
            }
            $enrolling[$i]['score'] = $score;
            $enrolling[$i]['badgecount'] = $badgecount;
        }
        $data = array(
            'academicsession' => $academicsession,
            'enrolling' => $enrolling,
            'fullscore' => $fullscore
        );
        $this->load->view('templates/header');
        $this->load->view('score/viewacs', $data);
        $this->load->view('templates/footer');
    }

    public function view($acadsession_slug, $student_id)
    {
        if ($this->session->userdata('user_type') != 'mentor') {
            redirect(site_url());
        }
        $student = $this->student_model->get_student($student_id);
        $thisacadsession = $this->academic_model->get_academicsession(FALSE, $acadsession_slug);
        $scoreplans = $this->score_model->get_scoreplan($thisacadsession['id'], FALSE);
        $scorecomps = array('scores' => $this->score_model->get_scoreplan_scorecomp($student_id, $thisacadsession['id']));
        # SCORE LEVELS
        $scoreleveltotal = $this->score_model->get_scoreleveltotal();
        $totalwhole = 0;
        foreach ($scoreplans as  $i => $scoreplan) {
            # to recalculate scores bcs now using id
            $scores = $this->score_model->get_scoreplan_scorelevel($student_id, $scoreplan['id']);
            $scoreplans[$i]['totalpercent'] =  $scores ? (array_sum($scores) / $scoreleveltotal) * $scoreplan['percentweightage'] : 0;
            $totalwhole += $scoreplans[$i]['totalpercent'];
            $scoreplans[$i]['scores'] = isset($scores) ? $scores : array();
        }
        # SCORE COMPONENTS
        $scorecomps['totalpercent'] = (!empty($scorecomps['scores'])) ? array_sum($scorecomps['scores']) : 0;
        $totalwhole += $scorecomps['totalpercent'];
        $data = array(
            'title' => 'Score: ' . $student['name'] . ' on ' . $thisacadsession['academicsession'],
            'student_id' => $student['id'],
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
            'levelrubrics' => $this->scoretable->get_level_rubrics(),
            'scoreplans' => $scoreplans,
            'scorecomps' => $scorecomps,
            'totalwhole' => $totalwhole,
            'scoreleveltotal' => $scoreleveltotal
        );
        # score by level will be contained in scoreplans
        # since each score plans will carry 1 score by level
        $this->load->view('templates/header');
        $this->load->view('score/view', $data);
        $this->load->view('templates/footer');
    }

    public function scoreplan($slug = NULL)
    {
        if ($this->session->userdata('user_type') == 'student') {
            redirect(site_url());
        }
        if ($slug == FALSE) {
            # scoreplan index
            $activitycategories = $this->activity_model->get_activitycategory();
            $academicsessions = $this->academic_model->get_academicsession();
            foreach ($academicsessions as $index => $acs) {
                $totalcategory = 0;
                foreach ($activitycategories as $id => $cat) {
                    $activitycategories[$id]['categorycount'] = $this->activity_model->get_categoryactivitycount($acs['id'], $cat['code']);
                    $activitycategories[$id]['categorytotalpercent'] = $this->score_model->get_categorytotalpercent($acs['id'], $cat['code']);
                    $totalcategory += $activitycategories[$id]['categorytotalpercent'];
                }
                $academicsessions[$index]['activitycategories'] = $activitycategories;
                $academicsessions[$index]['total'] = $totalcategory;
            }
            $data = array(
                'title' => 'Score Plans',
                'activitycategory' => $activitycategories,
                'activeacadsession' => $this->academic_model->get_activeacademicsession(),
                'academicsessions' => $academicsessions
            );
            $this->load->view('templates/header');
            $this->load->view('score/scoreplan/index', $data);
            $this->load->view('templates/footer');
        } else {
            # scoreplan view
            $academicsession = $this->academic_model->get_academicsession(FALSE, $slug);
            $activitycategories = $this->activity_model->get_activitycategory();
            foreach ($activitycategories as $i => $actcat) {
                // $activitycategories[$i]['scoreplan'] = $this->score_model->get_scoreplan($sig_id, $academicsession['id'], $actcat['code']);
                $activitycategories[$i]['unregistered'] = $this->activity_model->get_category_unregisteredactivity($academicsession['id'], $actcat['code']);
            }
            $data = array(
                'acslug' => $slug,
                'activitycategories' => $activitycategories,
                'acadsession' => $academicsession,
                'scoreplans' => $this->score_model->get_scoreplan($academicsession['id'])
            );
            $this->load->view('templates/header');
            $this->load->view('score/scoreplan/view', $data);
            $this->load->view('templates/footer');
        }
    }

    public function scoreboard($student_id = NULL)
    {
        if ($student_id == FALSE) {
            $academicsession = $this->academic_model->get_activeacademicsession();
            if ($academicsession) {
                $enrollingstudents = $this->student_model->get_enrolling_students($academicsession['id']);
                # for score per session
                foreach ($enrollingstudents as $i => $student) {
                    $activityscore = $this->scoretable->calculate_activityscore($student['matric'], $academicsession['id']);
                    $workshopscore = $this->scoretable->calculate_workshopscore($student['matric'], $academicsession['id']);
                    $componentscore = $this->scoretable->calculate_componentscore($student['matric'], $academicsession['id']);

                    $enrollingstudents[$i]['activityscore'] = $activityscore;
                    $enrollingstudents[$i]['workshopscore'] = $workshopscore;
                    $enrollingstudents[$i]['componentscore'] = $componentscore;
                    $enrollingstudents[$i]['totalscore'] = $activityscore + $workshopscore + $componentscore;
                }
            } else {
                $enrollingstudents = null;
            }

            $students = $this->student_model->get_student();
            # for cumulative badge
            foreach ($students as $i => $student) {
                $academicbadge = $this->scoretable->calculate_academicbadge($student['id']);
                $activitybadge = $this->scoretable->calculate_activitybadge($student['id']);
                $externalbadge = $this->scoretable->calculate_externalbadge($student['id']);
                $students[$i]['academicbadge'] = $academicbadge;
                $students[$i]['activitybadge'] = $activitybadge;
                $students[$i]['externalbadge'] = $externalbadge;
                $students[$i]['totalbadge'] = $academicbadge + $activitybadge + $externalbadge;
            }
            $data = array(
                'usertype' => $this->session->userdata('user_type'),
                'thisacademicsession' => $academicsession,
                'students' => $students,
                'enrollingstudents' => $enrollingstudents
            );
            $this->load->view('templates/header');
            $this->load->view('score/scoreboard', $data);
            $this->load->view('templates/footer');
        } else {
            # specific to student
            $student = $this->student_model->get_student($student_id);
            $academicplans = $this->academic_model->get_academicplan($student_id);

            $academicbadge = $this->scoretable->calculate_academicbadge($student['id']);
            $activitybadge = $this->scoretable->calculate_activitybadge($student['id']);
            $externalbadge = $this->scoretable->calculate_externalbadge($student['id']);


            foreach ($academicplans as $i => $plan) {
                # academic
                $badgecount = 0;
                $academicdesc = array();
                if ($plan['gpa_achieved'] > 3.67) {
                    $string = sprintf("Achieved Dean's List (%s)", $plan['gpa_achieved']);
                    array_push($academicdesc, $string);
                    $badgecount += 1;
                }
                if (is_numeric($plan['gpa_achieved']) and is_numeric($plan['gpa_target']) and $plan['gpa_achieved'] >= $plan['gpa_target']) {
                    $diff = $plan['gpa_achieved'] - $plan['gpa_target'];
                    $string = sprintf("Achieved academic target with increment of +%s (%s)", $diff, $plan['gpa_target']);
                    array_push($academicdesc, $string);
                    $badgecount += 1;
                }

                # activity
                $scorelevels = $this->score_model->get_scorelevels_bystudentacadsession_a($student['id'],  $plan['acadsession_id']);
                $activitydesc = array();
                foreach ($scorelevels as $level) {
                    if ($level['totalscore'] >= 18) {
                        $string = sprintf("Performed excellently in activity: %s", $level['title']);
                        array_push($activitydesc, $string);
                        $badgecount += 1;
                    }
                }

                # external activity
                $externaldesc = array();
                $externalsjoined = $this->activity_model->get_externalactivity_bystudentsession($student['id'], $plan['acadsession_id']);
                foreach ($externalsjoined as $ext) {
                    $string = sprintf("Joined %s on %s level", $ext['title'], $ext['level']);
                    array_push($externaldesc, $string);
                    $badgecount += 1;
                }
                $academicplans[$i]['academicdesc'] = $academicdesc;
                $academicplans[$i]['activitydesc'] = $activitydesc;
                $academicplans[$i]['externaldesc'] = $externaldesc;
                $academicplans[$i]['badgecount'] = $badgecount;
            }

            $student['academicbadge'] = $academicbadge;
            $student['activitybadge'] = $activitybadge;
            $student['externalbadge'] = $externalbadge;
            $student['totalbadge'] = $academicbadge + $activitybadge + $externalbadge;
            krsort($academicplans);
            $data = array(
                'student' => $student,
                'academicplans' => $academicplans,
                'academicbadge' => $this->file_model->get_academicbadge(),
                'activitybadge' => $this->file_model->get_activitybadge(),
                'externalbadge' => $this->file_model->get_externalbadge()
            );
            $this->load->view('templates/header');
            $this->load->view('score/scoreboardview', $data);
            $this->load->view('templates/footer');
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
            'marker_id' => $this->session->userdata('username'),
            'student_id' => $student_id,
            'scoreplan_id' => $this->input->post('scoreplan_id') #hidden
        );
        foreach ($levelrubrics as $rubricname => $value) {
            $scoreleveldata[$rubricname] = $value;
        }
        $this->score_model->add_scoreleveldata($scoreleveldata);
        redirect('score/' . $acslug  . '/' . $student_id);
    }

    public function edit_scorelevel()
    {
        $acslug = $this->input->post('acslug'); # hidden
        $student_id = $this->input->post('student_id'); #hidden
        $levelrubrics = $this->input->post('keys');
        $where = array(
            'scoreplan_id' => $this->input->post('scoreplan_id'),
            'student_id' => $this->input->post('student_id')
        );
        $scoreleveldata = array();
        foreach ($levelrubrics as $rubricname => $value) {
            $scoreleveldata[$rubricname] = $value;
        }
        $this->score_model->update_scoreleveldata($where, $scoreleveldata);
        redirect('score/' . $acslug  . '/' . $student_id);
    }

    public function add_scorecomp()
    {
        $acslug = $this->input->post('acslug');
        $student_id = $this->input->post('student_id');
        $scorecompdata = array(
            'acadsession_id' => $this->input->post('acadsession_id'),
            'student_id' => $student_id,
            'digitalcv' => $this->input->post('digitalcv'),
            'leadership' => $this->input->post('leadership'),
            'volunteer' => $this->input->post('volunteer')
        );
        $this->score_model->add_scorecompdata($scorecompdata);
        redirect('score/' . $acslug . '/' . $student_id);
    }

    public function edit_scorecomp()
    {
        $acslug = $this->input->post('acslug');
        $student_id = $this->input->post('student_id');
        $where = array(
            'student_id' => $student_id,
            'acadsession_id' => $this->input->post('acadsession_id')
        );
        $keys = $this->input->post('keys');
        $scorecompdata = array();
        foreach ($keys as $key => $value) {
            $scorecompdata[$key] = $value;
        }
        $this->score_model->update_scorecompdata($where, $scorecompdata);
        redirect('score/' . $acslug . '/' . $student_id);
    }

    public function download_badgeboard()
    {
        $students = $this->student_model->get_student();
        foreach ($students as $i => $student) {
            $academicbadge = $this->scoretable->calculate_academicbadge($student['id']);
            $activitybadge = $this->scoretable->calculate_activitybadge($student['id']);
            $externalbadge = 0;
            $students[$i]['academicbadge'] = $academicbadge;
            $students[$i]['activitybadge'] = $activitybadge;
            $students[$i]['externalbadge'] = $externalbadge;
            $students[$i]['totalbadge'] = $academicbadge + $activitybadge + $externalbadge;
            # external badge idk also
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Cumulative Badgeboard.xlsx"');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Matric');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Academic Badge');
        $sheet->setCellValue('D1', 'Activity Badge');
        $sheet->setCellValue('E1', 'External Badge');
        $sheet->setCellValue('F1', 'Total Badge');
        foreach ($students as $i => $student) {
            $i += 1;
            $sheet->setCellValue('A' . $i + 1, $student['id']);
            $sheet->setCellValue('B' . $i + 1, $student['name']);
            $sheet->setCellValue('C' . $i + 1, $student['academicbadge']);
            $sheet->setCellValue('D' . $i + 1, $student['activitybadge']);
            $sheet->setCellValue('E' . $i + 1, $student['externalbadge']);
            $sheet->setCellValue('F' . $i + 1, $student['totalbadge']);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function download_scoreboard($acadsession_id = NULL)
    {
        if ($acadsession_id == FALSE) {
            $academicsession = $this->academic_model->get_activeacademicsession();
            $students = $this->student_model->get_student();
        } {
            $academicsession = $this->academic_model->get_academicsession($acadsession_id, NULL);
            $students = $this->student_model->get_enrolling_students($acadsession_id);
            foreach ($students as $i => $student) {
                $students[$i]['id'] = $student['matric'];
            }
        }
        foreach ($students as $i => $student) {
            $activityscore = $this->scoretable->calculate_activityscore($student['id'], $academicsession['id']);
            $workshopscore = $this->scoretable->calculate_workshopscore($student['id'], $academicsession['id']);
            $componentscore = $this->scoretable->calculate_componentscore($student['id'], $academicsession['id']);
            $students[$i]['activityscore'] = $activityscore;
            $students[$i]['workshopscore'] = $workshopscore;
            $students[$i]['componentscore'] = $componentscore;
            $students[$i]['totalscore'] = $activityscore + $workshopscore + $componentscore;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Scoreboard ' . $academicsession['academicsession'] . '.xlsx"');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Academic Year');
        $sheet->setCellValue('B1', 'Semester');
        $sheet->setCellValue('C1', 'Matric');
        $sheet->setCellValue('D1', 'Name');
        $sheet->setCellValue('E1', 'Academic Score');
        $sheet->setCellValue('F1', 'Activity Score');
        $sheet->setCellValue('G1', 'External Score');
        $sheet->setCellValue('H1', 'Total Score (55%)');
        foreach ($students as $i => $student) {
            $i += 1;
            $sheet->setCellValue('A' . $i + 1, $academicsession['academicyear']);
            $sheet->setCellValue('B' . $i + 1, $academicsession['semester']);
            $sheet->setCellValue('C' . $i + 1, $student['id']);
            $sheet->setCellValue('D' . $i + 1, $student['name']);
            $sheet->setCellValue('E' . $i + 1, $student['activityscore']);
            $sheet->setCellValue('F' . $i + 1, $student['workshopscore']);
            $sheet->setCellValue('G' . $i + 1, $student['componentscore']);
            $sheet->setCellValue('H' . $i + 1, $student['totalscore']);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
