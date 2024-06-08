<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrators_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $query = $this->db->get('administrators');
        return $query->result_array();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('administrators', array('id_admin' => $id));
        return $query->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('administrators', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_admin', $id);
        return $this->db->update('administrators', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_admin', $id);
        return $this->db->delete('administrators');
    }

    public function verify_login($pseudo_name, $password)
    {
        $query = $this->db->get_where('administrators', array('pseudo_name' => $pseudo_name));
        if ($query->num_rows() > 0) {
            $admin = $query->row_array();
            if (password_verify($password, $admin['password'])) {
                return $admin;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
