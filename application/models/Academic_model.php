<?php
class Academic_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_academicsession($id = NULL, $slug = NULL)
    {
        if ($id == FALSE && $slug == FALSE) {
            $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
                ->from('academicsession as acs')
                ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            if ($id == TRUE) {
                $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
                    ->from('academicsession as acs')
                    ->where(array('acs.id' => $id))
                    ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
                $query = $this->db->get();
                return $query->row_array();
            }
            if ($slug == TRUE) {
                $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
                    ->from('academicsession as acs')
                    ->where(array('acs.slug' => $slug))
                    ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
                $query = $this->db->get();
                return $query->row_array();
            }
        }
        // if ($id == FALSE) {
        //     $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
        //         ->from('academicsession as acs')
        //         ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
        //     $query = $this->db->get();
        //     return $query->result_array();
        // }
        // $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
        //     ->from('academicsession as acs')
        //     ->where(array('acs.id' => $id))
        //     ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
        // $query = $this->db->get();
        // return $query->row_array();
    }

    public function get_academicsession_byyearsem($acadyear_id, $semester_id)
    {
        $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
            ->from('academicsession as acs')
            ->where(array(
                'acadyear_id' => $acadyear_id,
                'semester_id' => $semester_id
            ))
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_activeacademicsession()
    {
        $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
            ->from('academicsession as acs')
            ->where('acs.status', 'active')
            ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_count_academicsession($id)
    {
        $this->db->distinct()
            ->select('student_matric, acadsession_id')
            ->from('academicsession')
            ->where(array('student_matric' => $id));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_latest_academicyear()
    {
        $this->db->select('*')
            ->from('academicyear')
            ->order_by('id', 'DESC')
            ->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_academicyear($academicyear_id = NULL)
    {
        if ($academicyear_id == FALSE) {
            $query = $this->db->get('academicyear');
            return $query->result_array();
        }
        $query = $this->db->get_where('academicyear', array('id' => $academicyear_id));
        return $query->row_array();
    }

    public function get_academicplan($student_id = NULL, $acadsession_id = NULL)
    {
        if ($student_id == FALSE and $acadsession_id == FALSE) {
            $this->db->select("acp.*, std.name, acy.acadyear, acs.semester_id, 
        concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
                ->from('academicplan as acp')
                ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
                ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
                ->join('user as std', 'std.id = acp.student_matric');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            if ($student_id == TRUE) {
                if ($acadsession_id == TRUE) {
                    $this->db->select("acp.*, std.name, acy.acadyear, acs.semester_id, 
                concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession, (acp.gpa_achieved - acp.gpa_target) as increment")
                        ->from('academicplan as acp')
                        ->where(array(
                            'acp.student_matric' => $student_id,
                            'acp.acadsession_id' => $acadsession_id
                        ))
                        ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
                        ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
                        ->join('user as std', 'std.id = acp.student_matric');
                    $query = $this->db->get();
                    return $query->row_array();
                } else {
                    $this->db->select("acp.*, std.name, acy.acadyear, acs.semester_id, 
                concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
                        ->from('academicplan as acp')
                        ->where(array('acp.student_matric' => $student_id))
                        ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
                        ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
                        ->join('user as std', 'std.id = acp.student_matric');
                    $query = $this->db->get();
                    return $query->result_array();
                }
            } else {
                $this->db->select("acp.*, std.name, acy.acadyear, acs.semester_id, 
                concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
                    ->from('academicplan as acp')
                    ->where(array('acp.acadsession_id' => $acadsession_id))
                    ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
                    ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
                    ->join('user as std', 'std.id = acp.student_matric');
                $query = $this->db->get();
                return $query->result_array();
            }
        }
    }

    public function get_academicplan_byyearsem($acadyear_id, $semester_id)
    {
        // $this->db->select("acp.*, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
        // ->from('academicplan as acp')
        // ->where(array('acadyear'))
    }

    public function get_this_academicplan($student_id, $acadsession_id)
    {
        $this->db->select("acp.*, std.name, concat(acy.acadyear, ' Sem ', acs.semester_id) as academicsession")
            ->from('academicplan as acp')
            ->where(array(
                'acadsession_id' => $acadsession_id,
                'student_matric' => $student_id
            ))
            ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
            ->join('user as std', 'std.id = acp.student_matric');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_semester()
    {
        $query = $this->db->get('semester');
        return $query->result_array();
    }

    public function get_registered_student($acadsession_id)
    {
        $this->db->select("acp.*, acs.slug as acslug, std.name, concat(acy.acadyear, ' Sem ' , acs.semester_id) as academicsession")
            ->from('academicplan as acp')
            ->where('acadsession_id', $acadsession_id)
            ->join('user as std', 'acp.student_matric = std.id')
            ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function create_acs($acsdata)
    {
        return $this->db->insert('academicsession', $acsdata);
    }

    public function create_acy($acydata)
    {
        return $this->db->insert('academicyear', $acydata);
    }

    public function create_academicplan($acadsession_id, $student_id)
    {
        $academicplan = array(
            'acadsession_id' => $acadsession_id,
            'student_matric' => $student_id
        );
        $this->db->insert('academicplan', $academicplan);
    }

    public function delete_academicplan($acadsession_id, $student_id)
    {
        $this->db->where(array(
            'acadsession_id' => $acadsession_id,
            'student_matric' => $student_id
        ));
        return $this->db->delete('academicplan');
    }

    public function setactive_acadsession($acadsession_id)
    {
        $active = array('status' => 'active');
        $inactive = array('status' => 'inactive');
        $this->db->where('id', $acadsession_id)
            ->update('academicsession', $active);
        $this->db->where('id !=', $acadsession_id)
            ->update('academicsession', $inactive);
    }

    public function setactive_acadyear($acadyear_id)
    {
        $active = array('status' => 'active');
        $inactive = array('status' => 'inactive');
        $this->db->where('id', $acadyear_id)
            ->update('academicyear', $active);
        $this->db->where('id !=', $acadyear_id)
            ->update('academicyear', $inactive);
        return true;
    }

    public function set_gpa($where, $gpa)
    {
        return $this->db->where($where)->update('academicplan', $gpa);
    }
}
