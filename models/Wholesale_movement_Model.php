<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wholesale_movement_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('wholesale_movement')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('wholesale_movement', array('id_wholesale_movement' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('wholesale_movement', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_wholesale_movement', $id);
        return $this->db->update('wholesale_movement', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('wholesale_movement', array('id_wholesale_movement' => $id));
    }
}
