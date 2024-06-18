<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product
{
    protected $CI;

    private $id_product;
    private $image_link;
    private $description;
    private $creation_date;
    private $id_cat_product;
    private $id_cat_fruit;

    public function __construct($id = null, $image_link = null, $description = null, $creation_date = null, $id_cat_product = null, $id_cat_fruit = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Product_Model');

        $this->id_product = $id;
        $this->image_link = $image_link;
        $this->description = $description;
        $this->creation_date = $creation_date;
        $this->id_cat_product = $id_cat_product;
        $this->id_cat_fruit = $id_cat_fruit;
    }

    public function get_id_product()
    {
        return $this->id_product;
    }

    public function set_id_product($id_product)
    {
        $this->id_product = $id_product;
    }

    public function get_image_link()
    {
        return $this->image_link;
    }

    public function set_image_link($image_link)
    {
        $this->image_link = $image_link;
    }

    public function get_description()
    {
        return $this->description;
    }

    public function set_description($description)
    {
        $this->description = $description;
    }

    public function get_creation_date()
    {
        return $this->creation_date;
    }

    public function set_creation_date($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function get_id_cat_product()
    {
        return $this->id_cat_product;
    }

    public function set_id_cat_product($id_cat_product)
    {
        $this->id_cat_product = $id_cat_product;
    }

    public function get_id_cat_fruit()
    {
        return $this->id_cat_fruit;
    }

    public function set_id_cat_fruit($id_cat_fruit)
    {
        $this->id_cat_fruit = $id_cat_fruit;
    }

    public function get_all_products()
    {
        $result = $this->CI->Product_Model->get_all();
        $products = array();
        foreach ($result as $data) {
            $products[] = new Product(
                $data['id_product'],
                $data['image_link'],
                $data['description'],
                $data['creation_date'],
                $data['id_cat_product'],
                $data['id_cat_fruit']
            );
        }
        return $products;
    }

    public function get_product_by_id($id)
    {
        $data = $this->CI->Product_Model->get_by_id($id);
        return new Product(
            $data['id_product'],
            $data['image_link'],
            $data['description'],
            $data['creation_date'],
            $data['id_cat_product'],
            $data['id_cat_fruit']
        );
    }

    public function add_product($data)
    {
        return $this->CI->Product_Model->insert($data);
    }

    public function update_product($id, $data)
    {
        return $this->CI->Product_Model->update($id, $data);
    }

    public function delete_product($id)
    {
        return $this->CI->Product_Model->delete($id);
    }

    public function get_product_configuration()
    {
        return $this->CI->Product_Model->get_product_configuration();
    }

    public function get_new_products (){
		return $this->CI->Product_Model->get_new_product(); 
	}

    // retourne un tableau de product 
	public function get_most_saled_product(){
		$products = $this->CI->Product_Model->get_most_saled_product();
		$mostSaled = array();
		foreach ($products as $product){
			$mostSaled [] = $this->CI->Product_Model->get_by_id($product['id_product']);
		}
		return $mostSaled; 
	}

	public function filter_product_by_cat ($id_cat_prod){
		return $this->CI->Product_Model->filter_product_by_cat($id_cat_prod);
	}

	public function filter_product_by_price ($cat_id = null , $minPrice , $maxPrice){
		return $this->CI->Product_Model->filter_product_by_price($cat_id ,$minPrice , $maxPrice);
	
	}
    
}
