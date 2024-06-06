<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bulk_movement
{
    protected $CI;

    private $id_bulk_movement;
    private $movement_date;
    private $price;
    private $reduction;
    private $id_product;

    public function __construct($id_bulk_movement = null, $movement_date = null, $price = null, $reduction = null, $id_product = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Bulk_movement_Model');

        $this->id_bulk_movement = $id_bulk_movement;
        $this->movement_date = $movement_date;
        $this->price = $price;
        $this->reduction = $reduction;
        $this->id_product = $id_product;
    }

    public function get_id_bulk_movement()
    {
        return $this->id_bulk_movement;
    }

    public function set_id_bulk_movement($id_bulk_movement)
    {
        $this->id_bulk_movement = $id_bulk_movement;
    }

    public function get_movement_date()
    {
        return $this->movement_date;
    }

    public function set_movement_date($movement_date)
    {
        $this->movement_date = $movement_date;
    }

    public function get_price()
    {
        return $this->price;
    }

    public function set_price($price)
    {
        $this->price = $price;
    }

    public function get_reduction()
    {
        return $this->reduction;
    }

    public function set_reduction($reduction)
    {
        $this->reduction = $reduction;
    }

    public function get_id_product()
    {
        return $this->id_product;
    }

    public function set_id_product($id_product)
    {
        $this->id_product = $id_product;
    }

    public function get_all_bulk_movements()
    {
        $result = $this->CI->Bulk_movement_Model->get_all();
        $bulk_movements = array();
        foreach ($result as $data) {
            $bulk_movements[] = new Bulk_movement(
                $data['id_bulk_movement'],
                $data['movement_date'],
                $data['price'],
                $data['reduction'],
                $data['id_product']
            );
        }
        return $bulk_movements;
    }

    public function get_bulk_movement_by_id($id)
    {
        $data = $this->CI->Bulk_movement_Model->get_by_id($id);
        return new Bulk_movement(
            $data['id_bulk_movement'],
            $data['movement_date'],
            $data['price'],
            $data['reduction'],
            $data['id_product']
        );
    }

    public function add_bulk_movement($data)
    {
        return $this->CI->Bulk_movement_Model->insert($data);
    }

    public function update_bulk_movement($id, $data)
    {
        return $this->CI->Bulk_movement_Model->update($id, $data);
    }

    public function delete_bulk_movement($id)
    {
        return $this->CI->Bulk_movement_Model->delete($id);
    }
}
