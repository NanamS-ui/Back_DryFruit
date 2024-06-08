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

    public function get_stock($date, $product_id)
    {
        $this->db->select('qttKg');
        $this->db->from('stock');
        $this->db->where('dateRenouvellement =', $date);
        $this->db->where('id_1', $product_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_sum_quantity($date, $product_id)
    {
        $this->db->select_sum('quantite');
        $this->db->from('produit_commander');
        $this->db->join('commande', 'produit_commander.id = commande.id_1');
        $this->db->where('produit_commander.id_1', $product_id);
        $this->db->where('DATE(commande.dateCommande)', $date);
        $query = $this->db->get();
        return $query->row()->quantite;
    }

    public function get_sum_price_Depenses($date, $product_id)
    {
        $this->db->select_sum('prix');
        $this->db->from('mvt_depenseskg');
        $this->db->where('id_1', $product_id);
        $this->db->where('DATE(dateMvt)', $date);
        $query = $this->db->get();
        return $query->row()->prix;
    }

    public function get_detail($date, $product_Id)
    {
        // Ensure the date format is correct
        $date = date('Y-m-d', strtotime($date));

        // Prepare the query
        $this->db->select('*');
        $this->db->from('Mvt_Detail');
        $this->db->where('dateMvt', $date);
        $this->db->where('id_1', $productId);

        // Execute the query and fetch the result
        $query = $this->db->get();
        return $query->row_array();
    }

}

