<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders
{
    protected $CI;

    private $id_order;
    private $reduction;
    private $ordering_date;
    private $id_client;

    public function __construct($id = null, $reduction = null, $ordering_date = null, $id_client = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Orders_Model');

        $this->id_order = $id;
        $this->reduction = $reduction;
        $this->ordering_date = $ordering_date;
        $this->id_client = $id_client;
    }

    public function get_id_order()
    {
        return $this->id_order;
    }

    public function set_id_order($id_order)
    {
        $this->id_order = $id_order;
    }

    public function get_reduction()
    {
        return $this->reduction;
    }

    public function set_reduction($reduction)
    {
        $this->reduction = $reduction;
    }

    public function get_ordering_date()
    {
        return $this->ordering_date;
    }

    public function set_ordering_date($ordering_date)
    {
        $this->ordering_date = $ordering_date;
    }

    public function get_id_client()
    {
        return $this->id_client;
    }

    public function set_id_client($id_client)
    {
        $this->id_client = $id_client;
    }

    public function get_all_orders()
    {
        $result = $this->CI->Orders_Model->get_all();
        $orders = array();
        foreach ($result as $data) {
            $orders[] = new Orders(
                $data['id_order'],
                $data['reduction'],
                $data['ordering_date'],
                $data['id_client']
            );
        }
        return $orders;
    }

    public function get_order_by_id($id)
    {
        $data = $this->CI->Orders_Model->get_by_id($id);
        return new Orders(
            $data['id_order'],
            $data['reduction'],
            $data['ordering_date'],
            $data['id_client']
        );
    }

    public function add_order($data)
    {
        return $this->CI->Orders_Model->insert($data);
    }

    public function update_order($id, $data)
    {
        return $this->CI->Orders_Model->update($id, $data);
    }

    public function delete_order($id)
    {
        return $this->CI->Orders_Model->delete($id);
    }

    public function get_total_quantity_ordered($date, $product_id)
    {
        return $this->CI->Orders_Model->get_total_quantity_ordered($date, $product_id);
    }

    public function get_charge_price($product_id, $movement_date)
    {
        return $this->CI->Orders_Model->get_charge_price_by_product_and_date($product_id, $movement_date);
    }

    public function get_number_package_ordered($date, $product_id)
    {
        return $this->CI->Orders_Model->get_number_package_ordered($date, $product_id);
    }
}
