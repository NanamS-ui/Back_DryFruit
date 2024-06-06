<?php
class Client_model extends CI_Model {
	public function __construct() {
        $this->load->database();
    }

	public function get_all() {
        $query = $this->db->get('clients_account');
        return $query->result_array();
    }

	public function get_by_id($id) {
        $query = $this->db->get_where('clients_account', array('id_client' => $id));
        return $query->row_array();
    }


	public function insert($data) {
        return $this->db->insert('clients_account', $data);
    }


	public function update($id, $data) {
        $this->db->where('id_client', $id);
        return $this->db->update('clients_account', $data);
    }

    public function delete($id) {
        $this->db->where('id_client', $id);
        return $this->db->delete('clients_account');
    }

	public function search_client($name) {
		$name = strtolower($this->db->escape_like_str($name));		
		$sql = "SELECT * FROM clients_account WHERE LOWER(full_name) LIKE '%$name%'";
		$query = $this->db->query($sql);
		// echo $this->db->last_query();		
		return $query->result_array();
	}

}
?>
