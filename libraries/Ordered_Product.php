<?php
class Ordered_Product
{
    protected $CI;

    private $id_product_ordered;
    private $sales_type;
    private $quantity;
    private $product;
    private $orders;

    public function __construct($id_product_ordered = null, $sales_type = null, $quantity = null, Product $product = null, Orders $orders = null)
    {
        $this->id_product_ordered = $id_product_ordered;
        $this->sales_type = $sales_type;
        $this->quantity = $quantity;
        $this->product = $product;
        $this->orders = $orders;

        $this->CI = &get_instance();
        $this->CI->load->model('Product_Ordered_Model');
    }

    // Getters and setters 
    public function get_IdProductOrdered()
    {
        return $this->id_product_ordered;
    }

    public function get_SalesType()
    {
        return $this->sales_type;
    }

    public function get_Quantity()
    {
        return $this->quantity;
    }

    public function get_IdProduct()
    {
        return $this->product;
    }

    public function get_IdOrder()
    {
        return $this->orders;
    }

    public function set_IdProductOrdered($id_product_ordered)
    {
        $this->id_product_ordered = $id_product_ordered;
    }

    public function set_SalesType($sales_type)
    {
        $this->sales_type = $sales_type;
    }

    public function set_Quantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function set_IdProduct($product)
    {
        $this->product = $product;
    }

    public function set_IdOrder($orders)
    {
        $this->orders = $orders;
    }
}
