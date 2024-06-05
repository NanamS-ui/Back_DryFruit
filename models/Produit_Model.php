<?php

class Produit_Model extends CI_Model {

    public function __construct($params = array()) {
        parent::__construct();
        $this->load->database();
    }


    public function insert($data){ 
        return $this->db->insert('produit',$data);
    }

    public function update($id,$data){ 
        $this->db->where('id',$id);
        return $this->db->update('produit',$data);
    }
    
    public function delete($id){ 
        $this->db->where('id',$id);
        return $this->db->delete('produit');
    }

    public function get_by_id($id) {
        $query=$this->db->get_where('produit',array('id'=>$id));
        return $query->row_array();
    }

    public function get_all() {
        $query = $this->db->get('produit');
        return $query->result_array();
    }

    // Insérer stock produit:
    public function insert_stock($data) {
        return $this->db->insert('Stock');
    }

    // Insérer dépense produit:
    public function insert_depense($data){
        return $this->db->insert('Mvt_DepensesKg',$data);
    }

    // Insérer prix pour 100g
    public function insert_prix($data){
        return $this->db->insert('Mvt_Prix100g',$data);
    }
}

