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
            $this->db->select('user.id, user.profile_image')
                ->from('user as user')
                ->where(array('userstatus_id' => '2', 'usertype_id' => '3'))
                ->order_by('user.id');
            $query = $this->db->get();
            return $query->result_array();
        }
        if ($student_id) {
            # returns specific user
            $this->db->select("user.id, user.name, user.email, user.dob, user.profile_image, user.sig_id,
        std.phonenum, std.program_code, std.mentor_matric, std.year_joined,
        mtr.name as mentor_name, prg.name as program_name, 
        sig.code as sigcode, sig.signame, concat(sig.signame, ' (', sig.code, ')') as signamecode")
                ->from('user as user')
                ->where(array('user.id' => $student_id))
                ->join('student as std', 'std.matric = user.id', 'left')
                ->join('program as prg', 'prg.code = std.program_code', 'left')
                ->join('sig as sig', 'sig.id = user.sig_id', 'left')
                ->join('user as mtr', 'mtr.id = std.mentor_matric', 'left');
            $query = $this->db->get();
            return $query->row_array();
        }
        if ($sig_id) {
            # returns active students under specific sig
            $this->db->select('user.id, user.profile_image')
                ->from('student as std')
                ->join('user', 'user.id = std.matric')
                ->where(array(
                    'user.userstatus_id' => '2',
                    'user.sig_id' => $sig_id
                ))
                ->order_by('user.id');
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function get_studentbycourse($sig_id) {
        $this->db->select('program_code, count(*) as program_count')
        ->from('student')
        ->join('user', 'user.id = student.matric')
        ->where('user.sig_id', $sig_id)
        ->group_by('program_code');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_studentbyintake($sig_id) {
        $this->db->select('year_joined, count(*) as intake_count')
        ->from('student')
        ->join('user', 'user.id = student.matric')
        ->where('user.sig_id', $sig_id)
        ->group_by('year_joined');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_mentor_matric($student_id)
    {
        $query = $this->db->get_where('student', array('matric' => $student_id));
        return $query->row()->mentor_matric;
    }

    public function get_sigstudents($sig_id)
    {
        $this->db->select('user.id, user.name')
            ->from('user as user')
            ->where(array(
                'sig_id' => $sig_id,
                'usertype_id' => '3',
                'userstatus_id' => '2' #active
            ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_available_sigstudents($sig_id, $enrolledstudents)
    {
        $this->db->select('std.matric, user.name, std.year_joined')
            ->from('student as std')
            ->join('user', 'user.id = std.matric')
            ->where(array(
                'user.sig_id' => $sig_id,
                'user.userstatus_id' => 2
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
        $this->db->select('acp.student_matric as matric, user.name, acp.gpa_target, acp.gpa_achieved')
            ->from('academicplan as acp')
            ->where(array('acp.acadsession_id' => $acadsession_id))
            ->join('user', 'user.id = acp.student_matric and user.sig_id = ' . $sig_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_student($studentdata)
    {
        return $this->db->insert('student', $studentdata);
    }

    public function update_student($student_id, $studentdata)
    {
        $this->db->where('matric', $student_id);
        return $this->db->update('student', $studentdata);
    }

    public function update_activity_highcoms($activity_id, $highcoms)
    {
        foreach ($highcoms as $hc) {
            $change = array('student_matric' => $hc['student_matric']);
            $this->db->where(array('activity_id' => $activity_id, 'role_id' => $hc['role_id']));
            $this->db->update('activity_committee', $change);
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