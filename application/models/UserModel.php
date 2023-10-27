<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function add_record($urtable, $userdata)
    {
        return $query = $this->db->insert($urtable, $userdata);
    }
    public function placeorder($urtable, $userdata)
    {
        $this->db->insert($urtable, $userdata);
        $this->db->trans_complete();
        return $this->db->insert_id();
    }

    public function userlogin($tableName, $condition, $ordby = '', $ordCol = '')
    {
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_record($urtable, $userdata, $condition)
    {
        $this->db->where($condition);
        return $query = $this->db->update($urtable, $userdata);
    }
}
