<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_Ordered_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('products_ordered')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('products_ordered', array('id_product_ordered' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('products_ordered', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_product_ordered', $id);
        return $this->db->update('products_ordered', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('products_ordered', array('id_product_ordered' => $id));
    }
}
