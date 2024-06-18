<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('product')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('product', array('id_product' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('product', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_product', $id);
        return $this->db->update('product', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('product', array('id_product' => $id));
    }

    public function get_product_categories()
    {
        return $this->db->get('v_product_categories')->result_array();
    }

    public function get_product_configuration()
    {
        return $this->db->get('v_product_configuration')->result_array();
    }

    public function get_new_products (){
        $sql = 'SELECT * from v_product_configuration order by product_creation_date DESC limit 10';
		$query = $this->db->query($sql) ; 
		return $query->result_array();
    }

    // return id most saled product , apres manao get_by_id 
	public function get_most_saled_product(){
		$sql = 'SELECT id_product,count(id_product) as saleNumber from v_sales group by id_product order by saleNumber DESC limit 10 ';
		$query = $this->db->query($sql) ; 
		return $query->result_array();
	}

	public function filter_product_by_cat ($cat_prod_id){
		$sql = 'SELECT * FROM product where id_cat_fruit ='.$cat_prod_id ;
		$query = $this->db->query($sql) ; 
		return $query->result_array();
	}

	public function filter_product_by_price ($category = null ,$min_price , $max_price ){
        $sql = '' ; 
        if($category != null ){
            $sql = 'SELECT * FROM v_product_configuration join cat_product on v_product_configuration.product_category = cat_product.wording where cat_product.id_cat_product = '.$category.' and detail_price >='.$min_price.' and detail_price <='.$max_price ;
        }else{
            $sql = 'SELECT * FROM v_product_configuration where detail_price >='.$min_price.' and detail_price <='.$max_price;
        }
		$query = $this->db->query($sql) ; 
		return $query->result_array();
	}
    
}
