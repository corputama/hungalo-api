<?php

class Data_api extends CI_Model{
    public function getData($table, $where = null, $orderby = null){
        $this->db->from($table);
        if($where != ''){
            $this->db->where($where);
        }
        if ($orderby != '') {
            $this->db->order_by($orderby, 'DESC');
        }
        return $this->db->get()->result_array();
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }
    
    public function updateData($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }
}