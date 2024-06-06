<?php 
class Orders_Model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function get_all (){
		$query = $this->db->get('orders');
		return $query->result_array();
	}

	public function insert_order ($data){
		return $this->db->insert('orders' , $data);
	}

	public function update_order($id, $data) {
        $this->db->where('orders', $id);
        return $this->db->update('order', $data);
    }

	public function delete_order($id) {
        $this->db->where('orders', $id);
        return $this->db->delete('orders');
    }

	public function get_all_client_orders ($id_client){
		$query = $this->db->get_where('orders', array('id_client' => $id_client));
        return $query->result_array();
	}

	public function last_client_orders($id_client , $row){ 
		$sql = 'SELECT * FROM orders where id_client ='.$id_client.'order by ordering_date DESC limit '.$row; 
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	
	// public function last_activity_value ($id_client) {

	// }

}
?>
