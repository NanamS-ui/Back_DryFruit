<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_movement
{
    protected $CI;

    private $id_detail_movement;
    private $movement_date;
    private $price;
    private $reduction;
    private $id_product;

    public function __construct($id_detail_movement = null, $movement_date = null, $price = null, $reduction = null, $id_product = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Detail_movement_Model');

        $this->id_detail_movement = $id_detail_movement;
        $this->movement_date = $movement_date;
        $this->price = $price;
        $this->reduction = $reduction;
        $this->id_product = $id_product;
    }

    public function get_id_detail_movement()
    {
        return $this->id_detail_movement;
    }

    public function set_id_detail_movement($id_detail_movement)
    {
        $this->id_detail_movement = $id_detail_movement;
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

    public function get_all_detail_movements()
    {
        $result = $this->CI->Detail_movement_Model->get_all();
        $detail_movements = array();
        foreach ($result as $data) {
            $detail_movements[] = new Detail_movement(
                $data['id_detail_movement'],
                $data['movement_date'],
                $data['price'],
                $data['reduction'],
                $data['id_product']
            );
        }
        return $detail_movements;
    }

    public function get_detail_movement_by_id($id)
    {
        $data = $this->CI->Detail_movement_Model->get_by_id($id);
        return new Detail_movement(
            $data['id_detail_movement'],
            $data['movement_date'],
            $data['price'],
            $data['reduction'],
            $data['id_product']
        );
    }

    public function add_detail_movement($data)
    {
        return $this->CI->Detail_movement_Model->insert($data);
    }

    public function update_detail_movement($id, $data)
    {
        return $this->CI->Detail_movement_Model->update($id, $data);
    }

    public function delete_detail_movement($id)
    {
        return $this->CI->Detail_movement_Model->delete($id);
    }
}