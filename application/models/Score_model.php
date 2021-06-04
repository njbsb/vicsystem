<?php
class Score_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_activityworkshopscore($student_id, $acadsession_id, $activitycategory_id)
    {
        $this->db->select();
    }

    public function get_levelscore($id = NULL)
    {
        if ($id == FALSE) {
            $query = $this->db->get('levelscore');
            return $query->result_array();
        }
        $query = $this->db->get_where('levelscore', array('id' => $id));
        return $query->row_array();
    }

    public function get_student_scorelevel($matric, $acadsession_id)
    {
        $this->db->select("scl.*, scp.label, scp.activitycategory_id, scp.percentweightage, act.id as activity_id, act.title, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
            ->from('score_level as scl')
            ->where(array('scl.student_id' => $matric))
            ->join('score_plan as scp', 'scp.id = scl.scoreplan_id', 'left')
            ->where(array('scp.acadsession_id' => $acadsession_id))
            ->join('activity as act', 'act.id = scp.activity_id', 'left')
            ->join('academicsession as acs', 'acs.id = scp.acadsession_id', 'left')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id', 'left');
        $query = $this->db->get();
        # can select scl or scp first.
        return $query->result_array();
    }

    public function get_scoreplan_scorelevel($student_id, $scoreplan_id = FALSE)
    {
        if ($scoreplan_id === FALSE) {
            $this->db->select('position.score as position, meeting.score as meeting, attendance.score as attendance, involvement.score as involvement')
                ->from('score_level as sc')
                ->join('score_plan as scp', 'scp.id = sc.scoreplan_id')
                ->where(array(
                    'sc.student_id' => $student_id,
                    'scp.activitycategory_id' => 'A'
                ))
                ->join('level_position as position', 'position.id = sc.position')
                ->join('level_meeting as meeting', 'meeting.id = sc.meeting')
                ->join('level_attendance as attendance', 'attendance.id = sc.attendance')
                ->join('level_involvement as involvement', 'involvement.id = sc.involvement');
            $query = $this->db->get();
            return $query->result_array();
        } elseif ($student_id and $scoreplan_id) {
            $this->db->select('position.score as position, meeting.score as meeting, attendance.score as attendance, involvement.score as involvement')
                ->from('score_level as sc')
                ->where(array(
                    'student_id' => $student_id,
                    'scoreplan_id' => $scoreplan_id
                ))
                ->join('level_position as position', 'position.id = sc.position')
                ->join('level_meeting as meeting', 'meeting.id = sc.meeting')
                ->join('level_attendance as attendance', 'attendance.id = sc.attendance')
                ->join('level_involvement as involvement', 'involvement.id = sc.involvement');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                // return array(
                //     'position' => 0,
                //     'meeting' => 0,
                //     'attendance' => 0,
                //     'involvement' => 0
                // );
            }
        }
    }

    public function get_scoreplan_level($student_id, $scoreplan_id)
    {
        # UNUSED
        $this->db->select('position, meeting, attendance, involvement')
            ->from('score_level')
            ->where(array(
                'student_id' => $student_id,
                'scoreplan_id' => $scoreplan_id
            ));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_scoreplan_scorecomp($student_id, $acadsession_id)
    {
        $this->db->select('digitalcv.score as digitalcv, leadership.score as leadership, volunteer')
            ->from('score_comp')
            ->where(array(
                'student_id' => $student_id,
                'acadsession_id' => $acadsession_id
            ))
            ->join('comp_digitalcv as digitalcv', 'digitalcv.id = score_comp.digitalcv', 'left')
            ->join('comp_leadership as leadership', 'leadership.id = score_comp.leadership', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_student_scorecomp($matric, $acadsession_id)
    {
        $this->db->select('*')
            ->from('score_comp')
            ->where(array(
                'student_id' => $matric,
                'acadsession_id' => $acadsession_id
            ));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_students_scorebylevels($student_id)
    {
        $this->db->select("scl.*, acy.acadyear, acs.semester, 
        concat(acy.acadyear, ' Sem ', acs.semester) as academicsession, act.title")
            ->from('score_level as scl')
            ->where(array(
                'scl.student_id' => $student_id
            ))
            ->join('score_plan as scp', 'scp.id = scl.scoreplan_id')
            ->join('academicsession as acs', 'acs.id = scp.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
            ->join('activity as act', 'act.id = scp.activity_id', 'left');
        // ->join('levelscore as ls', 'ls.id = scl.levelscore_id');
        // ->join('scposition as scpos', )
        # must include a 'left' parameter if a column data is null
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_students_scorebycomp($student_id)
    {
        $this->db->select("sc.*, acy.acadyear, acs.semester, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
            ->from('score_comp as sc')
            ->where(array(
                'sc.student_id' => $student_id
            ))
            ->join('academicsession as acs', 'acs.id = sc.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id');
        // ->join('levelscore as ls', 'ls.id = sc.levelscore_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_student_scoreexternal($student_id)
    {
        $this->db->select('sc.*')
            ->from('score_external as sc')
            ->where('sc.student_id', $student_id);
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function get_guideposition()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('level_position as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guidemeeting()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('level_meeting as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guideattendance()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('level_attendance as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guideinvolvement()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('level_involvement as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guidedigitalcv()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('comp_digitalcv as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guideleadership()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('comp_leadership as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_maxscore_position()
    {
        $this->db->select_max('score');
        $score = $this->db->get('level_position')->row()->score;
        return $score;
    }

    public function get_maxscore_meeting()
    {
        $this->db->select_max('score');
        $score = $this->db->get('level_meeting')->row()->score;
        return $score;
    }

    public function get_maxscore_attendance()
    {
        $this->db->select_max('score');
        $score = $this->db->get('level_attendance')->row()->score;
        return $score;
    }

    public function get_maxscore_involvement()
    {
        $this->db->select_max('score');
        $score = $this->db->get('level_involvement')->row()->score;
        return $score;
    }

    public function check_scorelevelexist($level_id)
    {
        $this->db->get_where('score_level', array('levelscore' => $level_id));
    }

    #  SCORE LEVEL
    public function add_scoreleveldata($scoreleveldata)
    {
        return $this->db->insert('score_level', $scoreleveldata);
    }

    public function update_scoreleveldata($where, $scoredata)
    {
        return $this->db->where($where)
            ->update('score_level', $scoredata);
    }

    public function get_scorelevels_bystudentacadsession_a($student_id, $acadsession_id)
    {
        $this->db->select('position.score as position, meeting.score as meeting, attendance.score as attendance, involvement.score as involvement, (position.score + meeting.score + attendance.score + involvement.score) as totalscore, act.title')
            ->from('score_level as sc')
            ->join('score_plan as scp', 'scp.id = sc.scoreplan_id', 'left')
            ->join('activity as act', 'act.id = scp.activity_id', 'left')
            ->where(array(
                'student_id' => $student_id,
                'scp.acadsession_id' => $acadsession_id,
                'scp.activitycategory_id' => 'A'
            ))
            ->join('level_position as position', 'position.id = sc.position')
            ->join('level_meeting as meeting', 'meeting.id = sc.meeting')
            ->join('level_attendance as attendance', 'attendance.id = sc.attendance')
            ->join('level_involvement as involvement', 'involvement.id = sc.involvement');
        $query = $this->db->get();
        return $query->result_array();
    }

    # SCORE COMP
    public function add_scorecompdata($scorecompdata)
    {
        return $this->db->insert('score_comp', $scorecompdata);
    }

    public function update_scorecompdata($where, $scoredata)
    {
        return $this->db->where($where)
            ->update('score_comp', $scoredata);
    }

    # SCORE EXTERNAL
    public function add_externalparticipant($data)
    {
        $query = $this->db->get_where('score_external', $data);
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return $this->db->insert('score_external', $data);
        }
    }

    public function delete_externalparticipant($data)
    {
        return $this->db->delete('score_external', $data);
    }

    public function add_scoringplan($scoreplandata)
    {
        return $this->db->insert('score_plan', $scoreplandata);
    }

    public function update_scoreplan($scoreplan_id, $scoreplandata)
    {
        $this->db->where('id', $scoreplan_id);
        return $this->db->update('score_plan', $scoreplandata);
    }

    public function get_scoreplan($acadsession_id = NULL, $category_id = NULL)
    {
        if ($acadsession_id == FALSE && $category_id == FALSE) {
            # returns all scoreplans of specific sig
            $this->db->select("scp.*, act.title, acs.slug, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
                ->from('score_plan as scp')
                ->join('academicsession as acs', 'scp.acadsession_id = acs.id', 'left')
                ->join('academicyear as acy', 'acy.id = acs.acadyear_id', 'left')
                ->join('activity as act', 'scp.activity_id = act.id', 'left');
        } else {
            if ($category_id == FALSE) {
                # returns scoreplan under specific category
                $this->db->select('scp.*, act.title, actcat.category')
                    ->from('score_plan as scp')
                    ->where(array(
                        'scp.acadsession_id' => $acadsession_id
                    ))
                    ->join('activitycategory as actcat', 'actcat.code = scp.activitycategory_id', 'left')
                    ->join('activity as act', 'scp.activity_id = act.id', 'left')
                    ->order_by('scp.activitycategory_id', 'asc');
            } elseif ($acadsession_id == FALSE) {
                # returns scoreplan under specific academic session
                $this->db->select('scp.*, act.title')
                    ->from('score_plan as scp')
                    ->where(array(
                        'scp.activitycategory_id' => $category_id
                    ))
                    ->join('activity as act', 'scp.activity_id = act.id');
            } else {
                # returns scoreplan of specific sig under specific acadsession and category
                $this->db->select('scp.*, act.title')
                    ->from('score_plan as scp')
                    ->where(
                        array(
                            'scp.acadsession_id' => $acadsession_id,
                            'scp.activitycategory_id' => $category_id
                        )
                    )
                    ->join('activity as act', 'scp.activity_id = act.id');
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_categorytotalpercent($acadsession_id, $category_id)
    {
        $this->db->select_sum('scp.percentweightage')
            ->from('score_plan as scp')
            ->where(array(
                'scp.acadsession_id' => $acadsession_id,
                'scp.activitycategory_id' => $category_id
            ));
        $totalpercent = $this->db->get()->row()->percentweightage;
        if (isset($totalpercent)) {
            return $totalpercent;
        } else {
            return 0;
        }
        return $totalpercent;
    }

    public function get_scoreleveltotal()
    {
        return $this->get_maxscore_position() + $this->get_maxscore_meeting() + $this->get_maxscore_involvement() + $this->get_maxscore_attendance();
    }
}