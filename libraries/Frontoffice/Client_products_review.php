<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Client_products_review 
{
    protected $CI ; 

    private $id_product_review ; 
    private $stars ; 
    private $comment ; 
    private $id_client ; 
    private $id_product ; 

    public function get_id_product_review (){
        return $this->id_product_review ; 
    }

    public function get_stars (){
        return $this->stars ; 
    }

    public function get_comment (){
        return $this->comment ; 
    }

    public function get_id_client (){
        return $this->id_client ; 
    }

    public function get_id_product(){
        return $this->id_product; 
    }

    public function set_id_product_review ($id_product_review){
        $this->id_product_review = $id_product_review ; 
    }

    public function set_stars ($stars){
        $this->stars = $stars ; 
    }

    public function set_comment ($comment){
        $this->comment = $comment ; 
    }

    public function set_id_client ($id_client){
        $this->id_client = $id_client ; 
    }

    public function set_id_product ($id_product){
        $this->id_product = $id_product ; 
    }

    public function __construct($id_product_review = null , $stars = null , $comment = null , $id_client = null , $id_product = null )
    {
        $this->CI = &get_instance();
        $this->CI->load->model('frontoffice/Client_products_review_model','Client_products_review_model');
        $this->set_id_product_review($id_product_review);
        $this->set_stars($stars) ; 
        $this->set_comment($comment);
        $this->set_id_client($id_client) ; 
        $this->set_id_product($id_product);
    }

    public function get_all_client_product_review (){
        $data = $this->Client_products_review_model->get_all();
        $client_reviews = array();
        foreach ($data as $client_review) {
            $client_reviews[] = new Client_products_review(
               $client_review['id_product_review'],
               $client_review['stars'],
               $client_review['comment'],
               $client_review['id_client'],
               $client_review['id_product'] 
            ); 
        }
        return $client_reviews ; 
    }

    public function add_client_product_review ($id_client , $stars = 0  ,$comment , $id_product){
        return $this->CI->Client_products_review_model->insert($id_client , $stars , $comment , $id_product);
    }

    // return an object 
    public function get_client_product_review_by_id($id_client_review){
        $client_review = $this->CI->Client_products_review_model->get_by_id($id_client_review);
       return new Client_products_review(
            $client_review['id_product_review'],
            $client_review['stars'],
            $client_review['comment'],
            $client_review['id_client'],
            $client_review['id_product'] 
         ); 
    }

    public function update_client_product_review ($id_client_review , $data){
        return $this->CI->Client_products_review_model->update($id_client_review , $data); 
    }

    public function delete_client_product_review ($id_client_review){
        return $this->CI->Client_products_review_model->delete($id_client_review);
    }





}
?>