<?php
class Sig_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_sig($sig_id = NULL)
    {
        $this->db->select("sig.*, concat(signame, ' (', code, ')') as namecode")
            ->from('sig');
        if ($sig_id == FALSE) {
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->where('id', $sig_id);
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    public function get_sig_id($user_id)
    {
        $query = $this->db->get_where('user', array(
            'id' => $user_id
        ));
        return $query->row()->sig_id;
    }
}
