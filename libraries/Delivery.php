<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery
{
    protected $CI;

    private $id_delivery;
    private $delivery_date;
    private $delivery_address;
    private $cost;
    private $status;
    private $id_order;

    public $data_pending_baskets;
    public $data_delivered_baskets;
    public $data_deliveries_management;

    public function __construct($id = null, $delivery_date = null, $delivery_address = null, $cost = null, $status = null, $id_order = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Delivery_Model');

        $this->id_delivery = $id;
        $this->delivery_date = $delivery_date;
        $this->delivery_address = $delivery_address;
        $this->cost = $cost;
        $this->status = $status;
        $this->id_order = $id_order;
    }

    public function get_id_delivery()
    {
        return $this->id_delivery;
    }

    public function set_id_delivery($id_delivery)
    {
        $this->id_delivery = $id_delivery;
    }

    public function get_delivery_date()
    {
        return $this->delivery_date;
    }

    public function set_delivery_date($delivery_date)
    {
        $this->delivery_date = $delivery_date;
    }

    public function get_delivery_address()
    {
        return $this->delivery_address;
    }

    public function set_delivery_address($delivery_address)
    {
        $this->delivery_address = $delivery_address;
    }

    public function get_cost()
    {
        return $this->cost;
    }

    public function set_cost($cost)
    {
        $this->cost = $cost;
    }

    public function get_status()
    {
        return $this->status;
    }

    public function set_status($status)
    {
        $this->status = $status;
    }

    public function get_id_order()
    {
        return $this->id_order;
    }

    public function set_id_order($id_order)
    {
        $this->id_order = $id_order;
    }

    public function get_all_deliveries()
    {
        $result = $this->CI->Delivery_Model->get_all();
        $deliveries = array();
        foreach ($result as $data) {
            $deliveries[] = new Delivery(
                $data['id_delivery'],
                $data['delivery_date'],
                $data['delivery_address'],
                $data['cost'],
                $data['status'],
                $data['id_order']
            );
        }
        return $deliveries;
    }

    public function get_delivery_by_id($id)
    {
        $data = $this->CI->Delivery_Model->get_by_id($id);
        return new Delivery(
            $data['id_delivery'],
            $data['delivery_date'],
            $data['delivery_address'],
            $data['cost'],
            $data['status'],
            $data['id_order']
        );
    }

    public function add_delivery($data)
    {
        return $this->CI->Delivery_Model->insert($data);
    }

    public function update_delivery($id, $data)
    {
        return $this->CI->Delivery_Model->update($id, $data);
    }

    public function delete_delivery($id)
    {
        return $this->CI->Delivery_Model->delete($id);
    }

    public function get_pending_baskets()
    {
        $this->data_pending_baskets = $this->CI->Delivery_Model->get_pending_baskets();
    }

    public function get_delivered_baskets()
    {
        $this->data_delivered_baskets = $this->CI->Delivery_Model->get_delivered_baskets();
    }

    public function get_deliveries_management($month, $year)
    {
        $this->data_deliveries_management = $this->CI->Delivery_Model->get_deliveries_management($month, $year);
    }
}
