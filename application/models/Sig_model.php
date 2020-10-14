<?php
class Sig_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_sig()
    {
        $this->db->select("sig.*, concat(sig.signame, ' (', sig.code, ')') as namecode")
            ->from('sig as sig');
        $query = $this->db->get();
        return $query->result_array();
    }
}
