<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wholesale_movement
{
    protected $CI;

    private $id_wholesale_movement;
    private $movement_date;
    private $price;
    private $reduction;
    private $id_product;

    public function __construct($id_wholesale_movement = null, $movement_date = null, $price = null, $reduction = null, $id_product = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Wholesale_movement_Model');

        $this->id_wholesale_movement = $id_wholesale_movement;
        $this->movement_date = $movement_date;
        $this->price = $price;
        $this->reduction = $reduction;
        $this->id_product = $id_product;
    }

    public function get_id_wholesale_movement()
    {
        return $this->id_wholesale_movement;
    }

    public function set_id_wholesale_movement($id_wholesale_movement)
    {
        $this->id_wholesale_movement = $id_wholesale_movement;
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

    public function get_all_wholesale_movements()
    {
        $result = $this->CI->Wholesale_movement_Model->get_all();
        $wholesale_movements = array();
        foreach ($result as $data) {
            $wholesale_movements[] = new Wholesale_movement(
                $data['id_wholesale_movement'],
                $data['movement_date'],
                $data['price'],
                $data['reduction'],
                $data['id_product']
            );
        }
        return $wholesale_movements;
    }

    public function get_wholesale_movement_by_id($id)
    {
        $data = $this->CI->Wholesale_movement_Model->get_by_id($id);
        return new Wholesale_movement(
            $data['id_wholesale_movement'],
            $data['movement_date'],
            $data['price'],
            $data['reduction'],
            $data['id_product']
        );
    }

    public function add_wholesale_movement($data)
    {
        return $this->CI->Wholesale_movement_Model->insert($data);
    }

    public function update_wholesale_movement($id, $data)
    {
        return $this->CI->Wholesale_movement_Model->update($id, $data);
    }

    public function delete_wholesale_movement($id)
    {
        return $this->CI->Wholesale_movement_Model->delete($id);
    }
}
