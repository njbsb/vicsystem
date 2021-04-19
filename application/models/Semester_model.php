<?php
class Semester_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_semesters()
    {
        return array(1,2);
    }
}