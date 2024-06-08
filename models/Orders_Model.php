<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->get('orders')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('orders', array('id_order' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('orders', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_order', $id);
        return $this->db->update('orders', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('orders', array('id_order' => $id));
    }

    public function get_total_quantity_ordered($date, $product_id)
    {
        $sql = "
            SELECT
                SUM(quantity) AS total_quantity
            FROM
                orders o
            JOIN
                products_ordered po ON o.id_order = po.id_order
            WHERE
                DATE(o.ordering_date) = ?
                AND po.id_product = ?
        ";

        $query = $this->db->query($sql, array($date, $product_id));
        return $query->row_array();
    }

    public function get_number_package_ordered($date, $product_id)
    {
        $sql = "
            SELECT
                SUM(quantity) / 0.1 AS number_package
            FROM
                orders o
            JOIN
                products_ordered po ON o.id_order = po.id_order
            WHERE
                DATE(o.ordering_date) = ?
                AND po.id_product = ?
                AND (sales_type = 'B' OR sales_type = 'D')
        ";

        $query = $this->db->query($sql, array($date, $product_id));
        return $query->row_array();
    }

    public function get_charge_price($product_id, $movement_date)
    {
        $sql = "
            SELECT DISTINCT
                ckm.price
            FROM
                charges_kg_movement ckm
            JOIN
                products_ordered po ON ckm.id_product = po.id_product
            WHERE
                ckm.id_product = ?
                AND ckm.movement_date = ?
        ";

        $query = $this->db->query($sql, array($product_id, $movement_date));
        return $query->result_array();
    }

    public function get_sales_amount($ordering_date, $product_id)
    {
        $sql = "
            SELECT
                SUM(
                    CASE 
                        WHEN po.sales_type = 'D' THEN dm.price * po.quantity
                        WHEN po.sales_type = 'W' THEN wm.price * po.quantity
                        WHEN po.sales_type = 'B' THEN bm.price * po.quantity
                        ELSE 0
                    END
                ) AS total_price
            FROM
                orders o
            JOIN
                products_ordered po ON o.id_order = po.id_order
            LEFT JOIN
                detail_movement dm ON po.id_product = dm.id_product AND po.sales_type = 'D' AND DATE(o.ordering_date) = dm.movement_date
            LEFT JOIN
                wholesale_movement wm ON po.id_product = wm.id_product AND po.sales_type = 'W' AND DATE(o.ordering_date) = wm.movement_date
            LEFT JOIN
                bulk_movement bm ON po.id_product = bm.id_product AND po.sales_type = 'B' AND DATE(o.ordering_date) = bm.movement_date
            WHERE
                DATE(o.ordering_date) = ?
                AND po.id_product = ?
        ";

        $query = $this->db->query($sql, array($ordering_date, $product_id));
        return $query->row_array();
    }
}
