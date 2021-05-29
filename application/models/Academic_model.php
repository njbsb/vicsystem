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
            $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
                ->from('academicsession as acs')
                ->join('academicyear as acy', 'acs.acadyear_id = acy.id')
                ->order_by('acs.id', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            if ($id == TRUE) {
                $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
                    ->from('academicsession as acs')
                    ->where(array('acs.id' => $id))
                    ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
                $query = $this->db->get();
                return $query->row_array();
            }
            if ($slug == TRUE) {
                $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
                    ->from('academicsession as acs')
                    ->where(array('acs.slug' => $slug))
                    ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
                $query = $this->db->get();
                return $query->row_array();
            }
        }
        // if ($id == FALSE) {
        //     $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
        //         ->from('academicsession as acs')
        //         ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
        //     $query = $this->db->get();
        //     return $query->result_array();
        // }
        // $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
        //     ->from('academicsession as acs')
        //     ->where(array('acs.id' => $id))
        //     ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
        // $query = $this->db->get();
        // return $query->row_array();
    }

    public function get_academicsession_byyearsem($acadyear_id, $semester)
    {
        $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
            ->from('academicsession as acs')
            ->where(array(
                'acadyear_id' => $acadyear_id,
                'semester' => $semester
            ))
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_activeacadyear()
    {
        $query = $this->db->get_where('academicyear', array('status' => 'active'));
        return $query->row_array();
    }

    public function get_activeacademicsession()
    {
        $this->db->select("acs.*, acy.acadyear as academicyear, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
            ->from('academicsession as acs')
            ->where('acs.status', 'active')
            ->join('academicyear as acy', 'acs.acadyear_id = acy.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_count_academicsession($id)
    {
        $this->db->distinct()
            ->select('student_id, acadsession_id')
            ->from('academicsession')
            ->where(array('student_id' => $id));
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
            $this->db->select('*')
                ->from('academicyear')
                ->order_by('id', 'desc');
            $query = $this->db->get();
            return $query->result_array();
        }
        $query = $this->db->get_where('academicyear', array('id' => $academicyear_id));
        return $query->row_array();
    }

    public function get_academicplan($student_id = NULL, $acadsession_id = NULL)
    {
        if ($student_id == FALSE and $acadsession_id == FALSE) {
            $this->db->select("acp.*, std.name, acy.acadyear, acs.semester, 
        concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
                ->from('academicplan as acp')
                ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
                ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
                ->join('user as std', 'std.id = acp.student_id');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            if ($student_id == TRUE) {
                if ($acadsession_id == TRUE) {
                    $this->db->select("acp.*, std.name, acy.acadyear, acs.semester, 
                concat(acy.acadyear, ' Sem ', acs.semester) as academicsession, (acp.gpa_achieved - acp.gpa_target) as increment")
                        ->from('academicplan as acp')
                        ->where(array(
                            'acp.student_id' => $student_id,
                            'acp.acadsession_id' => $acadsession_id
                        ))
                        ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
                        ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
                        ->join('user as std', 'std.id = acp.student_id');
                    $query = $this->db->get();
                    return $query->row_array();
                } else {
                    $this->db->select("acp.*, std.name, acy.acadyear, acs.semester, 
                concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
                        ->from('academicplan as acp')
                        ->where(array('acp.student_id' => $student_id))
                        ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
                        ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
                        ->join('user as std', 'std.id = acp.student_id');
                    $query = $this->db->get();
                    return $query->result_array();
                }
            } else {
                $this->db->select("acp.*, std.name, acy.acadyear, acs.semester, 
                concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
                    ->from('academicplan as acp')
                    ->where(array('acp.acadsession_id' => $acadsession_id))
                    ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
                    ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
                    ->join('user as std', 'std.id = acp.student_id');
                $query = $this->db->get();
                return $query->result_array();
            }
        }
    }

    public function get_academicplan_byyearsem($acadyear_id, $semester_id)
    {
        // $this->db->select("acp.*, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
        // ->from('academicplan as acp')
        // ->where(array('acadyear'))
    }

    public function get_this_academicplan($student_id, $acadsession_id)
    {
        $this->db->select("acp.*, std.name, concat(acy.acadyear, ' Sem ', acs.semester) as academicsession")
            ->from('academicplan as acp')
            ->where(array(
                'acadsession_id' => $acadsession_id,
                'student_id' => $student_id
            ))
            ->join('academicsession as acs', 'acs.id = acp.acadsession_id')
            ->join('academicyear as acy', 'acy.id = acs.acadyear_id')
            ->join('user as std', 'std.id = acp.student_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_registered_student($acadsession_id)
    {
        $this->db->select("acp.*, acs.slug as acslug, std.name, concat(acy.acadyear, ' Sem ' , acs.semester) as academicsession")
            ->from('academicplan as acp')
            ->where('acadsession_id', $acadsession_id)
            ->join('user as std', 'acp.student_id = std.id')
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
            'student_id' => $student_id
        );
        $this->db->insert('academicplan', $academicplan);
    }

    public function delete_academicplan($acadsession_id, $student_id)
    {
        $this->db->where(array(
            'acadsession_id' => $acadsession_id,
            'student_id' => $student_id
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

    public function import_gpa_achieved($data)
    {
        $rowaffectedcount = 0;
        foreach ($data as $d) {
            $this->db->set('gpa_achieved', $d['gpa_achieved'])
                ->where(array(
                    'acadsession_id' => $d['acadsession_id'],
                    'student_id' => $d['student_id']
                ))
                ->update('academicplan');
            if ($this->db->affected_rows() > 0) {
                $rowaffectedcount += 1;
            }
        }
        return $rowaffectedcount;
    }

    public function set_endsession($acadsession_id)
    {
        $status = $this->db->get_where('academicsession', array('id' => $acadsession_id))->row()->endofsession;
        return $this->db->where('id', $acadsession_id)
            ->update('academicsession', array(
                'endofsession' => !$status
            ));
    }
}