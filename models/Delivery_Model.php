<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('delivery')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('delivery', array('id_delivery' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('delivery', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_delivery', $id);
        return $this->db->update('delivery', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('delivery', array('id_delivery' => $id));
    }

    public function get_pending_baskets()
    {
        $sql = "
            SELECT
                order_id,
                id_client,
                client_full_name,
                delivery_address
            FROM 
                v_delivery_info 
            WHERE 
                delivery_status = 0
            GROUP BY 
            order_id,client_full_name,
            delivery_address,
            delivery_status,
            id_client
        ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_delivered_baskets()
    {
        $sql = "
            SELECT
                order_id,
                id_client,
                client_full_name,
                delivery_address
            FROM 
                v_delivery_info 
            WHERE 
                delivery_status = 1
            GROUP BY 
            order_id,client_full_name,
            delivery_address,
            delivery_status,
            id_client
        ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_deliveries_management($month, $year)
    {
        $sql = "
        SELECT 
            order_id,
            id_client,
            client_full_name,
            delivery_address
        FROM 
            v_delivery_info l
        WHERE 
            EXTRACT(MONTH FROM l.delivery_date) = ?
            AND EXTRACT(YEAR FROM l.delivery_date) = ?
        GROUP BY 
            order_id,client_full_name,
            delivery_address,
            id_client
    ";

        $query = $this->db->query($sql, array($month, $year));
        return $query->result_array();
    }
}
