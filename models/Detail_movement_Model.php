<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_movement_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('detail_movement')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('detail_movement', array('id_detail_movement' => $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('detail_movement', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_detail_movement', $id);
        return $this->db->update('detail_movement', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('detail_movement', array('id_detail_movement' => $id));
    }
}
