<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bulk_movement_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('bulk_movement')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('bulk_movement', array('id_bulk_movement' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('bulk_movement', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_bulk_movement', $id);
        return $this->db->update('bulk_movement', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('bulk_movement', array('id_bulk_movement' => $id));
    }
}
