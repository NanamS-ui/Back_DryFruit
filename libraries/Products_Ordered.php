<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_Ordered
{
    protected $CI;

    private $id_product_ordered;
    private $sales_type;
    private $quantity;
    private $id_order;
    private $id_product;

    public function __construct($id = null, $sales_type = null, $quantity = null, $id_order = null, $id_product = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Products_ordered_Model');

        $this->id_product_ordered = $id;
        $this->sales_type = $sales_type;
        $this->quantity = $quantity;
        $this->id_order = $id_order;
        $this->id_product = $id_product;
    }

    public function get_id_product_ordered()
    {
        return $this->id_product_ordered;
    }

    public function set_id_product_ordered($id_product_ordered)
    {
        $this->id_product_ordered = $id_product_ordered;
    }

    public function get_sales_type()
    {
        return $this->sales_type;
    }

    public function set_sales_type($sales_type)
    {
        $this->sales_type = $sales_type;
    }

    public function get_quantity()
    {
        return $this->quantity;
    }

    public function set_quantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function get_id_order()
    {
        return $this->id_order;
    }

    public function set_id_order($id_order)
    {
        $this->id_order = $id_order;
    }

    public function get_id_product()
    {
        return $this->id_product;
    }

    public function set_id_product($id_product)
    {
        $this->id_product = $id_product;
    }

    public function get_all_products_ordered()
    {
        $result = $this->CI->Products_ordered_Model->get_all();
        $products_ordered = array();
        foreach ($result as $data) {
            $products_ordered[] = new Products_Ordered(
                $data['id_product_ordered'],
                $data['sales_type'],
                $data['quantity'],
                $data['id_order'],
                $data['id_product']
            );
        }
        return $products_ordered;
    }

    public function get_product_ordered_by_id($id)
    {
        $data = $this->CI->Products_ordered_Model->get_by_id($id);
        return new Products_Ordered(
            $data['id_product_ordered'],
            $data['sales_type'],
            $data['quantity'],
            $data['id_order'],
            $data['id_product']
        );
    }

    public function add_product_ordered($data)
    {
        return $this->CI->Products_ordered_Model->insert($data);
    }

    public function update_product_ordered($id, $data)
    {
        return $this->CI->Products_ordered_Model->update($id, $data);
    }

    public function delete_product_ordered($id)
    {
        return $this->CI->Products_ordered_Model->delete($id);
    }
}
