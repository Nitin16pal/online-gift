<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CartModel extends CI_Model
{
    public function add_record($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return $query;
    }
    public function fetch_record($table, $data, $clname, $ordby, $lmt = '')
    {
        $query = $this->db->where($data);
        $this->db->order_by($clname, $ordby);
        if ($lmt) {
            $this->db->limit($lmt);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function checkcart($usrcol, $usrid, $table, $pdcol = '', $pdid = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($pdid)) {
            $this->db->where($pdcol, $pdid);
        }
        $this->db->where($usrcol, $usrid);
        $query = $this->db->get();
        return $query->result();
    }

    public function gt_category()
    {
        $query = $this->db
            ->select('*')
            ->from('product_category')
            ->where('catstatus', '1')
            ->get();
        return $query->result();
    }

    public function countproduct($table,$condition )
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    // Update Cart

    public function updatecart($condition, $data, $table)
    {
        $this->db->where($condition);
        $query = $this->db->update($table, $data);
        return $query;
    }

    public function delete_data($table, $data)
    {
        $this->db->where($data);
        $query = $this->db->delete($table);
        return $query;
    }
}
