<?php
class Cat_Fruit
{

    private $id;
    private $libelle;

    private $CI;

    public function __construct($id = null, $libelle = null)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->CI = &get_instance();
        $this->CI->load->model('Cat_Fruit_model');
    }

    // getters and setters 
    public function get_Id()
    {
        return $this->id;
    }

    public function set_Id($id)
    {
        $this->id = $id;
    }

    public function get_Libelle()
    {
        return $this->libelle;
    }

    public function set_Libelle($libelle)
    {
        $this->libelle = $libelle;
    }

    //select tous les categories de fruits 
    public function get_All_Fruits()
    {
        $result = $this->CI->Cat_Fruit_model->get_all();
        return $result;
    }

    // Charger une catégorie depuis la base de données
    // utilise la methode get_category_by_id dans le modele 
    public function get_Fruit_By_Id($id)
    {
        $result = $this->CI->Cat_Fruit_model->get_by_id($id);
        if ($result) {
            $this->set_Id($result['id']);
            echo $result['id'];
            $this->set_Libelle($result['libelle']);
        }
        return $result ? $this : null;
    }

    // Sauvegarder une catégorie dans la base de données
    // inserer dans la table ou la mettre a jour
    // manao insertion raha ohatra ka mbola tsy misy le id fa raha efa misy dia manao update  
    public function add_Fruit()
    {
        $data = array(
            'libelle' => $this->get_Libelle()
        );

        if ($this->id) {
            // Mettre à jour si l'id existe deja 
            return $this->CI->Cat_Fruit_model->update($this->id, $data);
        } else {
            // Insérer un nouveau 
            return $this->CI->Cat_Fruit_model->insert($data);
        }
    }

    // Supprimer une catégorie
    public function delete()
    {
        if ($this->id) {
            return $this->CI->Cat_Fruit_model->delete_category($this->id);
        }
        return false;
    }
}
