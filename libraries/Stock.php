<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock
{
    protected $CI;

    private $id_stock;
    private $renewal_date;
    private $quantity_kg;
    private $id_product;

    public function __construct($id_stock = null, $renewal_date = null, $quantity_kg = null, $id_product = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Stock_Model');

        $this->id_stock = $id_stock;
        $this->renewal_date = $renewal_date;
        $this->quantity_kg = $quantity_kg;
        $this->id_product = $id_product;
    }

    public function get_id_stock()
    {
        return $this->id_stock;
    }

    public function set_id_stock($id_stock)
    {
        $this->id_stock = $id_stock;
    }

    public function get_renewal_date()
    {
        return $this->renewal_date;
    }

    public function set_renewal_date($renewal_date)
    {
        $this->renewal_date = $renewal_date;
    }

    public function get_quantity_kg()
    {
        return $this->quantity_kg;
    }

    public function set_quantity_kg($quantity_kg)
    {
        $this->quantity_kg = $quantity_kg;
    }

    public function get_id_product()
    {
        return $this->id_product;
    }

    public function set_id_product($id_product)
    {
        $this->id_product = $id_product;
    }

    public function get_all_stocks()
    {
        $result = $this->CI->Stock_Model->get_all();
        $stocks = array();
        foreach ($result as $data) {
            $stocks[] = new Stock(
                $data['id_stock'],
                $data['renewal_date'],
                $data['quantity_kg'],
                $data['id_product']
            );
        }
        return $stocks;
    }

    public function get_stock_by_id($id)
    {
        $data = $this->CI->Stock_Model->get_by_id($id);
        return new Stock(
            $data['id_stock'],
            $data['renewal_date'],
            $data['quantity_kg'],
            $data['id_product']
        );
    }

    public function add_stock($data)
    {
        return $this->CI->Stock_Model->insert($data);
    }

    public function update_stock($id, $data)
    {
        return $this->CI->Stock_Model->update($id, $data);
    }

    public function delete_stock($id)
    {
        return $this->CI->Stock_Model->delete($id);
    }

    public function get_stock_by_product_date($id_product, $renewal_date)
    {
        return $this->CI->Stock_Model->get_stock_by_product_date($id_product, $renewal_date);
    }
}
