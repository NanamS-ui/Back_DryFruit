<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Production_balance
{
    private $product;
    private $stock;
    private $out;
    private $sales;
    private $charges;
    private $sales_amount;
    private $results;

    private $CI;

    public function __construct($product = null, $stock = 0, $out = 0, $sales = 0, $charges = 0, $sales_amount = 0, $results = 0)
    {
        $this->product = $product;
        $this->stock = $stock;
        $this->out = $out;
        $this->sales = $sales;
        $this->charges = $charges;
        $this->sales_amount = $sales_amount;
        $this->results = $results;
        $this->CI = &get_instance();
        $this->CI->load->model('Stock_Model');
        $this->CI->load->model('Orders_Model');
        $this->CI->load->model('Product_Model');
    }

    public function get_product()
    {
        return $this->product;
    }

    public function set_product($product)
    {
        $this->product = $product;
    }

    public function get_stock()
    {
        return $this->stock;
    }

    public function set_stock($stock)
    {
        $this->stock = $stock;
    }

    public function get_out()
    {
        return $this->out;
    }

    public function set_out($out)
    {
        $this->out = $out;
    }

    public function get_sales()
    {
        return $this->sales;
    }

    public function set_sales($sales)
    {
        $this->sales = $sales;
    }

    public function get_charges()
    {
        return $this->charges;
    }

    public function set_charges($charges)
    {
        $this->charges = $charges;
    }

    public function get_sales_amount()
    {
        return $this->sales_amount;
    }

    public function set_sales_amount($sales_amount)
    {
        $this->sales_amount = $sales_amount;
    }

    public function get_results()
    {
        return $this->results;
    }

    public function set_results($results)
    {
        $this->results = $results;
    }

    public function get_balance_production($id_product, $date)
    {
        $this->CI->load->model('Product_Model');

        $product_categories = $this->CI->Product_Model->get_product_categories();

        $report = [];

        foreach ($product_categories as $product) {
            // Get stock
            $stock = $this->CI->Stock_Model->get_stock_by_product_date($id_product, $date);
            $stock_quantity = $stock ? $stock['quantity_kg'] : 0;

            // Get total quantity ordered
            $total_quantity = $this->CI->Orders_Model->get_total_quantity_ordered($date, $id_product);
            $total_quantity_ordered = $total_quantity ? $total_quantity['total_quantity'] : 0;

            $out_quantity = $total_quantity_ordered;
            $remaining_stock = $stock_quantity - $total_quantity_ordered;

            //number package
            $package = $this->CI->Orders_Model->get_number_package_ordered($date, $id_product);
            // Get charges price
            $charges = $this->CI->Orders_Model->get_charge_price($id_product, $date);
            $charges_price = !empty($charges) ? $charges[0]['price'] : 0;

            // Get sales amount
            $sales_amount = $this->CI->Orders_Model->get_sales_amount($date, $id_product);
            $sales_amount_total = $sales_amount ? $sales_amount['total_price'] : 0;

            // Calculate results as sales amount minus charges
            $results = $sales_amount_total - $charges_price;

            // Create a Bilan object and add it to the report array
            $bilan = new Production_balance(
                $product,
                $remaining_stock,
                $out_quantity,
                $package['number_package'],
                $charges_price,
                $sales_amount_total,
                $results
            );

            $report[] = $bilan;
        }

        return $report;
    }
}
