<?php
class Score_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function create_emptyscores($student_id, $acadsession_id)
    {
        $levelscore = $this->get_levelscore();
        foreach ($levelscore as $levelscore) {
            $levelarray = array(
                'acadsession_id' => $acadsession_id,
                'student_matric' => $student_id,
                'levelscore_id' => $levelscore['id']
            );
            $this->db->insert('scorelevel', $levelarray);
        }
        $comparray = array(
            'acadsession_id' => $acadsession_id,
            'student_matric' => $student_id
        );
        $this->db->insert('scorecomp', $comparray);
        return true;
    }
    // no call
    public function get_students_takingcitra()
    {
        // $this->db->select('citreg.student_matric, acy.acadyear, acs.semester_id')
        //     // ->distinct()
        //     ->from('citra_registration as citreg')
        //     ->join('academicsession as acs', 'acs.id = citreg.acadsession_id')
        //     ->join('academicyear as acy', 'acy.id = acs.acadyear_id');
        $this->db->select('citreg.student_matric, citreg.acadsession_id, acy.acadyear, acs.semester_id, count(citreg.citra_code) as citracount')
            ->from('citra_registration as citreg')
            ->join('academicsession as acs', 'acs.id = citreg.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
            // ->join('scorelevel as scl', 'scl.acadsession_id = citreg.acadsession_id')
            ->group_by(array('citreg.student_matric', 'citreg.acadsession_id'));

        $query = $this->db->get();
        return $query->result_array();
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
        $this->db->select('*')
            ->from('scorelevel as scl')
            ->where(array('student_matric' => $matric, 'acadsession_id' => $acadsession_id));
        $query = $this->db->get();
        return $query->result_array();
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
        ls.level, ls.percentage")
            ->from('scorelevel as scl')
            ->where(array(
                'scl.student_matric' => $student_id
            ))
            ->join('academicsession as acs', 'acs.id = scl.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
            ->join('activity as act', 'act.id = scl.activity_id', 'left')
            ->join('levelscore as ls', 'ls.id = scl.levelscore_id');
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
        $query = $this->db->get('scposition');
        return $query->result_array();
    }

    public function get_guidemeeting()
    {
        $query = $this->db->get('scmeeting');
        return $query->result_array();
    }

    public function get_guideattendance()
    {
        $query = $this->db->get('scattendance');
        return $query->result_array();
    }

    public function get_guideinvolvement()
    {
        $query = $this->db->get('scinvolvement');
        return $query->result_array();
    }

    public function get_guidedigitalcv()
    {
        $query = $this->db->get('scdigitalcv');
        return $query->result_array();
    }

    public function get_guideleadership()
    {
        $query = $this->db->get('scleadership');
        return $query->result_array();
    }

    public function check_scorelevelexist($level_id)
    {
        $this->db->get_where('scorelevel', array('levelscore' => $level_id));
    }

    public function setscorelevel($where, $score_eachlevel)
    {
        return $this->db->where($where)
            ->update('scorelevel', $score_eachlevel);
    }

    public function setscorecomp($where, $score_comp)
    {
        return $this->db->where($where)
            ->update('scorecomp', $score_comp);
    }
}
