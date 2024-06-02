<?php
class Category_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Récupérer toutes les catégories
    public function get_all() {
        $query = $this->db->get('cat_fruit');
        return $query->result_array();
    }

    // Récupérer une catégorie par ID
    public function get_by_id($id) {
        $query = $this->db->get_where('cat_fruit', array('id' => $id));
        return $query->row_array();
    }

    // Ajouter une nouvelle catégorie
    public function insert($data) {
        return $this->db->insert('cat_fruit', $data);
    }

    // Mettre à jour une catégorie existante
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('cat_fruit', $data);
    }

    // Supprimer une catégorie
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('cat_fruit');
    }
}
?>
