<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cat_Produit
{
    private $id;
    private $libelle;
    protected $CI;

    public function __construct($id = null, $libelle = null)
    {
        // Récupérer l'instance de l'objet CodeIgniter
        $this->CI = &get_instance();
        $this->CI->load->model('Cat_Produit_Model');

        $this->id = $id;
        $this->libelle = $libelle;
    }

    public function get_Id()
    {
        return $this->id;
    }

    public function get_Libelle()
    {
        return $this->libelle;
    }

    public function set_Id($id)
    {
        $this->id = $id;
    }

    public function set_Libelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /*Liste Produits*/
    public function get_All_Produits()
    {
        return $this->CI->Cat_Produit_Model->get_all();
    }

    /*Récuperer un produit par son id*/
    public function get_Produit_By_Id($id)
    {
        return $this->CI->Cat_Produit_Model->get_by_id($id);
    }

    /*Insertion Produit*/
    public function add_Produit()
    {
        $data = array('libelle' => $this->libelle);
        return $this->CI->Cat_Produit_Model->insert($data);
    }

    /*Mise à jour*/
    public function update_Produit()
    {
        $data = array('libelle' => $this->libelle);
        return $this->CI->Cat_Produit_Model->update($this->id, $data);
    }

    /*Suppression produit*/
    public function delete_Produit($id)
    {
        return $this->CI->Cat_Produit_Model->delete($id);
    }
}
