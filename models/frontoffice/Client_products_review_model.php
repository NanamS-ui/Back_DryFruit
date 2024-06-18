<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Client_products_review_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('client_products_review')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('client_products_review', array('id_product_review' => $id))->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id_product_review', $id);
        return $this->db->update('client_products_review', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('client_products_review', array('id_product_review' => $id));
    }

    public function insert ($id_client ,$stars = 0 ,$comment ,$id_product) {
        $sql = 'INSERT INTO client_products_review (id_product_review ,stars,  comment , id_client , id_product ) values (default ,'.$stars.','.$comment.','.$id_client.' , '.$id_product.')';
        $query = $this->db->query($sql);
    }
}

?>