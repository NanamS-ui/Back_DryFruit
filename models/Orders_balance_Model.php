<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_balance_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_order_client_details($order_id, $client_id)
    {
        $sql = "
            SELECT 
                client_full_name, 
                client_email, 
                client_phone_number, 
                delivery_address,
                payment_type, 
                card_number, 
                expiry_date, 
                cvv  
            FROM 
                v_client_orders_payment_delivery 
            WHERE 
                id_order = ? AND id_client = ?
        ";

        $query = $this->db->query($sql, array($order_id, $client_id));
        return $query->result_array();
    }

    public function get_order_detail_invoice($order_id, $client_id)
    {
        $sql = "
    WITH OrderDetails AS (
        SELECT 
            product_category, 
            fruit_category, 
            product_ordered_sales_type,
            product_ordered_quantity,
            CASE 
                WHEN product_ordered_sales_type = 'D' THEN detail_price
                WHEN product_ordered_sales_type = 'W' THEN wholesale_price
                WHEN product_ordered_sales_type = 'B' THEN bulk_price
                ELSE NULL
            END AS product_price,
            CASE 
                WHEN product_ordered_sales_type = 'D' THEN detail_price * product_ordered_quantity
                WHEN product_ordered_sales_type = 'W' THEN wholesale_price * product_ordered_quantity
                WHEN product_ordered_sales_type = 'B' THEN bulk_price * product_ordered_quantity
                ELSE NULL
            END AS total_price_product,
            order_reduction
        FROM v_order_delivery_link
        WHERE order_id = ? AND client_id = ?
    )
    SELECT 
        product_category, 
        fruit_category, 
        product_ordered_sales_type,
        product_ordered_quantity,
        product_price,
        total_price_product
    FROM OrderDetails;
    ";
        $query = $this->db->query($sql, array($order_id, $client_id));
        return $query->result_array();
    }

    public function get_order_balance_result($order_id, $client_id)
    {
        $sql = "
        WITH Order_Details_Result AS (
            SELECT
                product_category,
                fruit_category,
                product_ordered_sales_type,
                product_ordered_quantity,
                CASE
                    WHEN product_ordered_sales_type = 'D' THEN detail_price
                    WHEN product_ordered_sales_type = 'W' THEN wholesale_price
                    WHEN product_ordered_sales_type = 'B' THEN bulk_price
                    ELSE NULL
                END AS product_price,
                CASE
                    WHEN product_ordered_sales_type = 'D' THEN detail_price * product_ordered_quantity
                    WHEN product_ordered_sales_type = 'W' THEN wholesale_price * product_ordered_quantity
                    WHEN product_ordered_sales_type = 'B' THEN bulk_price * product_ordered_quantity
                    ELSE NULL
                END AS total_price_product,
                order_reduction
            FROM v_order_delivery_link
            WHERE order_id = ? AND client_id = ?
        )
        SELECT
            order_reduction,
            SUM(total_price_product) AS total_order_price,
            SUM(total_price_product - (total_price_product * order_reduction / 100)) AS total_order_price_with_reduction
        FROM Order_Details_Result GROUP BY order_reduction;
    ";

        $query = $this->db->query($sql, array($order_id, $client_id));
        return $query->row_array();
    }
}
