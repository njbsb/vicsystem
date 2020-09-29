<?php
class Student_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_student($id = FALSE)
    {
        if ($id === FALSE) {
            $this->db->select('user.id, user.profile_image')
                ->from('tbl_user as user')
                ->where(array('userstatus_id' => '2', 'usertype_id' => '3'))
                ->order_by('user.id');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('user.id, user.name, user.email, user.sig_id, user.profile_image, 
        std.phonenum, std.program_code, std.mentor_matric, 
        prg.name as program_name, sig.signame, mtr.name as mentor_name')
            ->from('tbl_user as user')
            ->where(array('user.id' => $id))
            ->join('tbl_student as std', 'std.matric = user.id')
            ->join('tbl_program as prg', 'prg.code = std.program_code')
            ->join('tbl_sig as sig', 'sig.id = user.sig_id')
            ->join('tbl_user as mtr', 'mtr.id = std.mentor_matric');
        $query = $this->db->get();
        if (!$query->num_rows()) {
            $default = array(
                'phonenum' => '',
                'program_code' => '',
                'mentor_matric' => '',
            );
            return $default;
        }
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

    public function get_highcoms($activity_id)
    {
        $this->db->select('actcom.student_matric as id, user.name')
            ->from('tbl_activity_committee as actcom')
            ->where(array('activity_id' => $activity_id))
            ->join('tbl_user as user', 'user.id = actcom.student_matric');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function register_student($studentdata)
    {
        return $this->db->insert('tbl_student', $studentdata);
    }

    public function update_student($id, $studentdata)
    {
        $this->db->where('matric', $id);
        return $this->db->update('tbl_student', $studentdata);
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
