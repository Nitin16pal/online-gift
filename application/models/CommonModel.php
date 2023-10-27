<?php defined('BASEPATH') or exit('No direct script access allowed');

class CommonModel extends CI_Model
{

    public function add_record($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function fetch_single_record($table, $data)
    {
        $query = $this->db->get_where($table, $data);
        return $query->result_array();
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

    public function fetch_lrecord($table, $data, $clname, $ordby, $lmt = '') // Like Rcords
    {
        $this->db->like($data);
        $this->db->order_by($clname, $ordby);
        if ($lmt) {
            $this->db->limit($lmt);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function fetch_or($table, $data, $clname, $ordby, $lmt = '') // Like Rcords
    {
        $this->db->or_like($data);
        $this->db->order_by($clname, $ordby);
        if ($lmt) {
            $this->db->limit($lmt);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function joinquery($id='')
    {
        $this->db->select('*');
        $this->db->from('products a');
        $this->db->join('category b', 'b.cat_id=a.prod_cat', 'left');
        $this->db->join('sub_category c', 'c.sub_cat_id=a.prod_sub_cat', 'left');
        // $this->db->where('a.album_id', $id);
        $this->db->order_by('a.prod_id', 'asc');
            $this->db->limit(8);
            $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
