<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cat_Produit_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->get('cat_produit')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('cat_produit', array('id' => $id))->row();
    }

    public function insert($data)
    {
        return $this->db->insert('cat_produit', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('cat_produit', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('cat_produit', array('id' => $id));
    }
}
