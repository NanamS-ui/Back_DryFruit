<?php 
class Ordered_Product {
	protected $CI ; 

	private $id_product_ordered;
	private $sales_type ; 
	private $quantity ; 
	private $id_product ; 
	private $id_order ; 

	public function __construct($id_product_ordered = null , $sales_type = null , $quantity = null , $id_product = null , $id_order = null){
		$this->id_product_ordered = $id_product_ordered;
        $this->sales_type = $sales_type;
        $this->quantity = $quantity;
        $this->id_product = $id_product;
        $this->id_order = $id_order;

		$this->CI =& get_instance();
		$this->CI->load->model('Product_Ordered_Model');
	}

	// Getters and setters 
    public function getIdProductOrdered() {
        return $this->id_product_ordered;
    }

    public function getSalesType() {
        return $this->sales_type;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getIdProduct() {
        return $this->id_product;
    }

    public function getIdOrder() {
        return $this->id_order;
    }

    public function setIdProductOrdered($id_product_ordered) {
        $this->id_product_ordered = $id_product_ordered;
    }

    public function setSalesType($sales_type) {
        $this->sales_type = $sales_type;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setIdProduct($id_product) {
        $this->id_product = $id_product;
    }

    public function setIdOrder($id_order) {
        $this->id_order = $id_order;
    }

	

}
?>
