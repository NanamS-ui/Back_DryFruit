<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cat_product
{
    protected $CI;

    private $id_cat_product;
    private $wording;

    public function __construct($id = null, $wording = null)
    {
        $this->CI = &get_instance();

        $this->CI->load->model('Cat_product_Model');

        $this->id_cat_product = $id;
        $this->wording = $wording;
    }

    public function get_id_cat_product()
    {
        return $this->id_cat_product;
    }

    public function set_id_cat_product($id_cat_product)
    {
        $this->id_cat_product = $id_cat_product;
    }

    public function get_wording()
    {
        return $this->wording;
    }

    public function set_wording($wording)
    {
        $this->wording = $wording;
    }

    public function get_all_products()
    {
        $result = $this->CI->Cat_product_Model->get_all();
        $products = array();
        foreach ($result as $data) {
            $products[] = new Cat_product($data['id_cat_product'], $data['wording']);
        }
        return $products;
    }

    public function get_product_by_id($id)
    {
        $data = $this->CI->Cat_product_Model->get_by_id($id);
        return new Cat_product($data['id_cat_product'], $data['wording']);
    }

    public function add_product($data)
    {
        return $this->CI->Cat_product_Model->insert($data);
    }

    public function update_product($id, $data)
    {
        return $this->CI->Cat_product_Model->update($id, $data);
    }

    public function delete_product($id)
    {
        return $this->CI->Cat_product_Model->delete($id);
    }
}
