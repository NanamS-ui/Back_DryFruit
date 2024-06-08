<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('product')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('product', array('id_product' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('product', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_product', $id);
        return $this->db->update('product', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('product', array('id_product' => $id));
    }

    public function get_product_categories()
    {
        return $this->db->get('v_product_categories')->result_array();
    }

    public function get_product_configuration()
    {
        return $this->db->get('v_product_configuration')->result_array();
    }
}
