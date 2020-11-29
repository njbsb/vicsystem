<?php
class Score_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
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
        $this->db->select("scl.*, scp.label, scp.percentweightage, act.id as activity_id, act.activity_name, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
            ->from('scorelevel as scl')
            ->where(array('scl.student_matric' => $matric))
            ->join('scoringplan as scp', 'scp.id = scl.scoreplan_id', 'left')
            ->where(array('scp.acadsession_id' => $acadsession_id))
            ->join('activity as act', 'act.id = scp.activity_id', 'left')
            ->join('academicsession as acs', 'acs.id = scp.acadsession_id', 'left')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id', 'left');
        $query = $this->db->get();
        # can select scl or scp first.
        return $query->result_array();
    }

    public function get_scoreplan_scorelevel($student_id, $scoreplan_id)
    {
        $this->db->select('position, meeting, attendance, involvement')
            ->from('scorelevel')
            ->where(array(
                'student_matric' => $student_id,
                'scoreplan_id' => $scoreplan_id
            ));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_scoreplan_scorecomp($student_id, $acadsession_id)
    {
        $this->db->select('digitalcv, leadership, volunteer')
            ->from('scorecomp')
            ->where(array(
                'student_matric' => $student_id,
                'acadsession_id' => $acadsession_id
            ));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_student_scorecomp($matric, $acadsession_id)
    {
        $this->db->select('*')
            ->from('scorecomp')
            ->where(array(
                'student_matric' => $matric,
                'acadsession_id' => $acadsession_id
            ));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_students_scorebylevels($student_id)
    {
        $this->db->select("scl.*, 
        acy.acadyear, acs.semester_id, 
        concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession, 
        act.activity_name, 
        ")
            ->from('scorelevel as scl')
            ->where(array(
                'scl.student_matric' => $student_id
            ))
            ->join('scoringplan as scp', 'scp.id = scl.scoreplan_id')
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
        $this->db->select("sc.*, acy.acadyear, acs.semester_id, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
            ->from('scorecomp as sc')
            ->where(array(
                'sc.student_matric' => $student_id
            ))
            ->join('academicsession as acs', 'acs.id = sc.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id');
        // ->join('levelscore as ls', 'ls.id = sc.levelscore_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guideposition()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('scposition as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guidemeeting()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('scmeeting as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guideattendance()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('scattendance as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guideinvolvement()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('scinvolvement as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guidedigitalcv()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('scdigitalcv as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_guideleadership()
    {
        $this->db->select("sc.*, concat(sc.score, ' - ', sc.description) as concat")
            ->from('scleadership as sc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_maxscore_position()
    {
        $this->db->select_max('score');
        $score = $this->db->get('scposition')->row()->score;
        return $score;
    }

    public function get_maxscore_meeting()
    {
        $this->db->select_max('score');
        $score = $this->db->get('scmeeting')->row()->score;
        return $score;
    }

    public function get_maxscore_attendance()
    {
        $this->db->select_max('score');
        $score = $this->db->get('scattendance')->row()->score;
        return $score;
    }

    public function get_maxscore_involvement()
    {
        $this->db->select_max('score');
        $score = $this->db->get('scinvolvement')->row()->score;
        return $score;
    }

    public function check_scorelevelexist($level_id)
    {
        $this->db->get_where('scorelevel', array('levelscore' => $level_id));
    }

    #  SCORE LEVEL
    public function add_scoreleveldata($scoreleveldata)
    {
        return $this->db->insert('scorelevel', $scoreleveldata);
    }

    public function update_scoreleveldata($where, $scoredata)
    {
        return $this->db->where($where)
            ->update('scorelevel', $scoredata);
    }

    # SCORE COMP
    public function add_scorecompdata($scorecompdata)
    {
        return $this->db->insert('scorecomp', $scorecompdata);
    }

    public function update_scorecompdata($where, $scoredata)
    {
        return $this->db->where($where)
            ->update('scorecomp', $scoredata);
    }

    // public function setscorecomp($where, $score_comp)
    // {
    //     return $this->db->where($where)
    //         ->update('scorecomp', $score_comp);
    // }

    public function add_scoringplan($scoreplandata)
    {
        return $this->db->insert('scoringplan', $scoreplandata);
    }

    public function update_scoreplan($scoreplan_id, $scoreplandata)
    {
        $this->db->where('id', $scoreplan_id);
        return $this->db->update('scoringplan', $scoreplandata);
    }

    public function get_scoreplan($sig_id, $acadsession_id = NULL, $category_id = NULL)
    {
        if ($acadsession_id == FALSE && $category_id == FALSE) {
            # returns all scoreplans of specific sig
            $this->db->select("scp.*, act.activity_name, acs.slug, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
                ->from('scoringplan as scp')
                ->where('scp.sig_id', $sig_id)
                ->join('academicsession as acs', 'scp.acadsession_id = acs.id', 'left')
                ->join('academicyear as acy', 'acy.id = acs.acadyear_id', 'left')
                ->join('activity as act', 'scp.activity_id = act.id', 'left');
        } else {
            if ($category_id == FALSE) {
                # returns scoreplan under specific category
                $this->db->select('scp.*, act.activity_name')
                    ->from('scoringplan as scp')
                    ->where(array(
                        'scp.acadsession_id' => $acadsession_id,
                        'scp.sig_id' => $sig_id
                    ))
                    ->join('activity as act', 'scp.activity_id = act.id');
            } elseif ($acadsession_id == FALSE) {
                # returns scoreplan under specific acs
                $this->db->select('scp.*, act.activity_name')
                    ->from('scoringplan as scp')
                    ->where(array(
                        'scp.activitycategory_id' => $category_id,
                        'scp.sig_id' => $sig_id
                    ))
                    ->join('activity as act', 'scp.activity_id = act.id');
            } else {
                # returns scoreplan of specific sig under specific acadsession and category
                $this->db->select('scp.*, act.activity_name')
                    ->from('scoringplan as scp')
                    ->where(array(
                        'scp.acadsession_id' => $acadsession_id,
                        'scp.activitycategory_id' => $category_id,
                        'scp.sig_id' => $sig_id
                    ))
                    ->join('activity as act', 'scp.activity_id = act.id');
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_categorytotalpercent($acadsession_id, $category_id, $sig_id)
    {
        $this->db->select_sum('scp.percentweightage')
            ->from('scoringplan as scp')
            ->where(array(
                'scp.acadsession_id' => $acadsession_id,
                'scp.activitycategory_id' => $category_id,
                'scp.sig_id' => $sig_id
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
