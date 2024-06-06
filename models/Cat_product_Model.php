<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cat_product_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->get('cat_product')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('cat_product', array('id_cat_fruit' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('cat_product', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('cat_product', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('cat_product', array('id' => $id));
    }
}
