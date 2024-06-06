<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Charges_kg_movement_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('charges_kg_movement')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('charges_kg_movement', array('id_charges_movement' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('charges_kg_movement', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_charges_movement', $id);
        return $this->db->update('charges_kg_movement', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('charges_kg_movement', array('id_charges_movement' => $id));
    }
}
