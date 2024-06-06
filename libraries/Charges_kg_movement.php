<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Charges_kg_movement
{
    protected $CI;

    private $id_charges_movement;
    private $movement_date;
    private $price;
    private $id_product;

    public function __construct($id_charges_movement = null, $movement_date = null, $price = null, $id_product = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Charges_kg_movement_Model');

        $this->id_charges_movement = $id_charges_movement;
        $this->movement_date = $movement_date;
        $this->price = $price;
        $this->id_product = $id_product;
    }

    public function get_id_charges_movement()
    {
        return $this->id_charges_movement;
    }

    public function set_id_charges_movement($id_charges_movement)
    {
        $this->id_charges_movement = $id_charges_movement;
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

    public function get_id_product()
    {
        return $this->id_product;
    }

    public function set_id_product($id_product)
    {
        $this->id_product = $id_product;
    }

    public function get_all_charges_movements()
    {
        $result = $this->CI->Charges_kg_movement_Model->get_all();
        $charges_movements = array();
        foreach ($result as $data) {
            $charges_movements[] = new Charges_kg_movement(
                $data['id_charges_movement'],
                $data['movement_date'],
                $data['price'],
                $data['id_product']
            );
        }
        return $charges_movements;
    }

    public function get_charges_movement_by_id($id)
    {
        $data = $this->CI->Charges_kg_movement_Model->get_by_id($id);
        return new Charges_kg_movement(
            $data['id_charges_movement'],
            $data['movement_date'],
            $data['price'],
            $data['id_product']
        );
    }

    public function add_charges_movement($data)
    {
        return $this->CI->Charges_kg_movement_Model->insert($data);
    }

    public function update_charges_movement($id, $data)
    {
        return $this->CI->Charges_kg_movement_Model->update($id, $data);
    }

    public function delete_charges_movement($id)
    {
        return $this->CI->Charges_kg_movement_Model->delete($id);
    }
}
