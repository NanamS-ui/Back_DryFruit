<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cat_fruit
{
    protected $CI;

    private $id_cat_fruit;
    private $wording;

    public function __construct($id = null, $wording = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Cat_fruit_Model');

        $this->id_cat_fruit = $id;
        $this->wording = $wording;
    }

    public function get_id_cat_fruit()
    {
        return $this->id_cat_fruit;
    }

    public function set_id_cat_fruit($id_cat_fruit)
    {
        $this->id_cat_fruit = $id_cat_fruit;
    }

    public function get_wording()
    {
        return $this->wording;
    }

    public function set_wording($wording)
    {
        $this->wording = $wording;
    }

    public function get_all_fruits()
    {
        $result = $this->CI->Cat_fruit_Model->get_all();
        $fruits = array();
        foreach ($result as $data) {
            $fruits[] = new Cat_fruit($data['id_cat_fruit'], $data['wording']);
        }
        return $fruits;
    }

    public function get_fruit_by_id($id)
    {
        $data = $this->CI->Cat_fruit_Model->get_by_id($id);
        return new Cat_fruit($data['id_cat_fruit'], $data['wording']);
    }

    public function add_fruit($data)
    {
        return $this->CI->Cat_fruit_Model->insert($data);
    }

    public function update_fruit($id, $data)
    {
        return $this->CI->Cat_fruit_Model->update($id, $data);
    }

    public function delete_fruit($id)
    {
        return $this->CI->Cat_fruit_Model->delete($id);
    }
}
