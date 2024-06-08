<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_methods_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_payment_methods()
    {
        $query = $this->db->get('payment_methods');
        return $query->result_array();
    }

    public function get_payment_method_by_id($id_payment)
    {
        $query = $this->db->get_where('payment_methods', array('id_payment' => $id_payment));
        return $query->row_array();
    }

    public function get_payment_methods_by_client_id($id_client)
    {
        $query = $this->db->get_where('payment_methods', array('id_client' => $id_client));
        return $query->result_array();
    }

    public function add_payment_method($data)
    {
        return $this->db->insert('payment_methods', $data);
    }

    public function update_payment_method($id_payment, $data)
    {
        $this->db->where('id_payment', $id_payment);
        return $this->db->update('payment_methods', $data);
    }

    public function delete_payment_method($id_payment)
    {
        $this->db->where('id_payment', $id_payment);
        return $this->db->delete('payment_methods');
    }
}
