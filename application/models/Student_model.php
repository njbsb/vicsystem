<?php
class Student_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_student($student_id = FALSE, $sig_id = FALSE)
    {
        if ($student_id === FALSE and $sig_id === FALSE) {
            $this->db->select('user.id, user.name')
                ->from('user')
                ->where(array(
                    'userstatus' => 'active',
                    'usertype' => 'student'
                ))
                ->order_by('user.id');
            $query = $this->db->get();
            return $query->result_array();
        }
        if ($student_id) {
            # returns specific user
            $this->db->select("user.*, std.*, mtr.name as mentor_name, prg.program as program_name, 
        sig.code as sigcode, sig.name as signame, concat(sig.name, ' (', sig.code, ')') as signamecode")
                ->from('user as user')
                ->where(array('user.id' => $student_id))
                ->join('student as std', 'std.matric = user.id', 'left')
                ->join('program as prg', 'prg.code = std.program_id', 'left')
                ->join('sig as sig', 'sig.code = user.sig_id', 'left')
                ->join('user as mtr', 'user.superior_id = mtr.id', 'left');
            $query = $this->db->get();
            return $query->row_array();
        }
        if ($sig_id) {
            # returns active students under specific sig
            $this->db->select('user.id')
                ->from('user')
                ->join('student as std', 'user.id = std.matric', 'left')
                ->where(array(
                    'user.userstatus' => 'active',
                    'user.sig_id' => $sig_id,
                    'user.usertype' => 'student'
                ))
                ->order_by('user.id');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function get_student_profile($id)
    {
        $query = $this->db->get_where('student', array(
            'matric' => $id
        ));
        return $query->row_array();
    }

    public function get_studentbycourse($sig_id)
    {
        $this->db->select('program_id, count(*) as program_count')
            ->from('student')
            ->join('user', 'user.id = student.matric')
            ->where('user.sig_id', $sig_id)
            ->group_by('program_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_studentbyintake($sig_id)
    {
        $currentyear = intval(date('Y'));
        $limityear = $currentyear - 4;
        $this->db->select('user.yearjoined, count(*) as intake_count')
            ->from('user')
            ->join('student', 'user.id = student.matric', 'left')
            ->where(array(
                'user.usertype' => 'student',
                'user.sig_id' => $sig_id,
                'user.yearjoined >' => $limityear
            ))
            ->group_by('yearjoined');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_mentor_matric($student_id)
    {
        $query = $this->db->get_where('user', array('id' => $student_id));
        return $query->row()->superior_id;
    }

    public function get_sigstudents($sig_id)
    {
        $currentyear = intval(date('Y'));
        $limityear = $currentyear - 4;
        $this->db->select('user.id, user.name')
            ->from('user as user')
            ->where(array(
                'sig_id' => $sig_id,
                'usertype' => 'student',
                'userstatus' => 'active'
            ))
            ->join('student', 'student.matric = user.id', 'left')
            ->join('academicplan as acp', 'user.id = acp.student_id')
            ->where('student.yearjoined >=', $limityear);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_available_sigstudents($sig_id, $enrolledstudents)
    {
        $this->db->select('std.matric, user.name, std.yearjoined')
            ->from('student as std')
            ->join('user', 'user.id = std.matric')
            ->where(array(
                'user.sig_id' => $sig_id,
                'user.userstatus' => 'active'
            ));
        if (isset($enrolledstudents)) {
            foreach ($enrolledstudents as $std) {
                $this->db->where_not_in('std.matric', $std['matric']);
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_enrolling_students($acadsession_id, $sig_id)
    {
        # those that has data in the academicplan
        $this->db->select('acp.student_id as matric, user.name, acp.gpa_target, acp.gpa_achieved')
            ->from('academicplan as acp')
            ->join('user', 'user.id = acp.student_id')
            // ->join('user', array('user.id' => 'acp.student_id', 'user.sig_id' => $sig_id))
            ->where(array(
                'acp.acadsession_id' => $acadsession_id,
                'user.sig_id' => $sig_id
            ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_student($studentdata)
    {
        return $this->db->insert('student', $studentdata);
    }

    public function update_student($id, $studentdata)
    {
        $firstquery = $this->db->get_where('student', array('matric' => $id));
        if ($firstquery->num_rows() > 0) {
            unset($studentdata['matric']);
            return $this->db->where('matric', $id)
                ->update('student', $studentdata);
        } else {
            return $this->db->where('matric', $id)
                ->set($studentdata)
                ->insert('student');
        }

        // $this->db->where('matric', $id);
        // return $this->db->update('student', $studentdata);
    }

    public function update_activity_highcoms($activity_id, $highcoms)
    {
        foreach ($highcoms as $hc) {
            $change = array('student_id' => $hc['student_id']);
            $this->db->where(array('activity_id' => $activity_id, 'role_id' => $hc['role_id']));
            $this->db->update('committee_activity', $change);
        }
        return true;
    }

    public function verifymatric($matric)
    {
        $this->db->where('matric', $matric);
        $query = $this->db->get('student');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_student($matric)
    {
        $this->db->where('matric', $matric);
        $this->db->delete('student');
        return true;
    }

    public function student_exist($matric)
    {
        $query = $this->db->get_where('student', array('matric' => $matric));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}