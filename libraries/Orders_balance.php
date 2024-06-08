<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_balance
{
    protected $CI;
    public $data_client_detail;
    public $data_client_invoice;
    public $data_client_result;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Orders_balance_Model');
    }

    public function get_order_balance($order_id, $client_id)
    {
        // Get client details
        $this->data_client_detail = $this->CI->Orders_balance_Model->get_order_client_details($order_id, $client_id);

        // Get invoice details
        $this->data_client_invoice = $this->CI->Orders_balance_Model->get_order_detail_invoice($order_id, $client_id);

        //Get result
        $this->data_client_result = $this->CI->Orders_balance_Model->get_order_balance_result($order_id, $client_id);
    }
}
