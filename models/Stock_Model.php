<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('stock')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('stock', array('id_stock' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('stock', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_stock', $id);
        return $this->db->update('stock', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('stock', array('id_stock' => $id));
    }

    public function get_stock_by_product_date($id_product, $renewal_date)
    {
        $sql = "
        SELECT *
        FROM stock
        WHERE id_product = ? AND DATE(renewal_date) = ?
    ";

        $query = $this->db->query($sql, array($id_product, $renewal_date));
        return $query->row_array();
    }
}
