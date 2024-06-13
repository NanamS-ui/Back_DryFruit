<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients_account_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('clients_account')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('clients_account', array('id_client' => $id))->row_array();
    }

    public function register($data)
    {
        $this->db->insert('clients_account', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_client', $id);
        return $this->db->update('clients_account', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('clients_account', array('id_client' => $id));
    }

    public function verify_login($email, $password)
    {
        $query = $this->db->get_where('clients_account', array('mail' => $email));

        if ($query->num_rows() > 0) {
            $user = $query->row_array();

            $hashed_password = $user['password'];

            if (password_verify($password, $hashed_password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_clients_sorted_by_activity()
    {
        $subquery = $this->db->select('id_2, MAX(dateCommande) as last_order_date')
                             ->from('Commande')
                             ->group_by('id_2')
                             ->get_compiled_select();
                             
        $this->db->select('Compte_clients.id, Compte_clients.pseudoName, COALESCE(last_order_date, \'1970-01-01\') as last_order_date');
        $this->db->from('Compte_clients');
        $this->db->join("($subquery) as subquery", 'subquery.id_2 = Compte_clients.id', 'left');
        $this->db->order_by('last_order_date', 'DESC');
        $query = $this->db->get();
        
        return $query->result_array();
    }    

}
