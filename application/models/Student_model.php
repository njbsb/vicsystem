<?php
class Student_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_student($student_id = FALSE)
    {
        if ($student_id === FALSE) {
            $this->db->select('user.id, user.profile_image')
                ->from('tbl_user as user')
                ->where(array('userstatus_id' => '2', 'usertype_id' => '3'))
                ->order_by('user.id');
            $query = $this->db->get();
            return $query->result_array();
        }
        $this->db->select("user.id, user.name, user.email, user.dob, user.profile_image, user.sig_id,
        std.phonenum, std.program_code, std.mentor_matric, std.joined_sig,
        mtr.name as mentor_name, prg.name as program_name, 
        sig.id as sigid, sig.code as sigcode, sig.signame, concat(sig.signame, ' (', sig.code, ')') as signamecode")
            ->from('tbl_user as user')
            ->where(array('user.id' => $student_id))
            ->join('tbl_student as std', 'std.matric = user.id')
            ->join('tbl_program as prg', 'prg.code = std.program_code')
            ->join('tbl_sig as sig', 'sig.id = user.sig_id')
            ->join('tbl_user as mtr', 'mtr.id = std.mentor_matric', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_sigstudents($sig_id)
    {
        $this->db->select('user.id, user.name')
            ->from('tbl_user as user')
            ->where(array(
                'sig_id' => $sig_id,
                'usertype_id' => '3',
                'userstatus_id' => '2'
            ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_student($studentdata)
    {
        return $this->db->insert('tbl_student', $studentdata);
    }

    public function register_highcoms($highcoms)
    {
        return $this->db->insert_batch('tbl_activity_committee', $highcoms);
    }

    public function update_student($id, $studentdata)
    {
        $this->db->where('matric', $id);
        return $this->db->update('tbl_student', $studentdata);
    }

    public function update_activity_highcoms($activity_id, $highcoms)
    {
        foreach ($highcoms as $hc) {
            $change = array('student_matric' => $hc['student_matric']);
            $this->db->where(array('activity_id' => $activity_id, 'role_id' => $hc['role_id']));
            $this->db->update('tbl_activity_committee', $change);
        }
        return true;
    }

    public function verifymatric($matric)
    {
        $this->db->where('matric', $matric);
        $query = $this->db->get('tbl_student');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_student($matric)
    {
        $this->db->where('matric', $matric);
        $this->db->delete('tbl_student');
        return true;
    }

    public function student_exist($matric)
    {
        $query = $this->db->get_where('tbl_student', array('matric' => $matric));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
