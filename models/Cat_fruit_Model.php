<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cat_fruit_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('cat_fruit')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('cat_fruit', array('id_cat_fruit' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('cat_fruit', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_cat_fruit', $id);
        return $this->db->update('cat_fruit', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('cat_fruit', array('id_cat_fruit' => $id));
    }
}
