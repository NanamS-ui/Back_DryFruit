<?php
class Orders
{
	private $CI;

	private $id_order;
	private $reduction;
	private $ordering_date;
	private $client;

	public function __construct($id_order = null, $reduction = null, $ordering_date = null, Client $client = null)
	{
		$this->id_order = $id_order;
		$this->reduction = $reduction;
		$this->ordering_date = $ordering_date;
		$this->client = $client;

		$this->CI = &get_instance();
		$this->CI->load->model('Orders_Model');
	}


	// getters and setters 
	public function get_IdOrder()
	{
		return $this->id_order;
	}

	public function get_Reduction()
	{
		return $this->reduction;
	}

	public function get_OrderingDate()
	{
		return $this->ordering_date;
	}

	public function get_Client()
	{
		return $this->client;
	}

	public function set_IdOrder($id_order)
	{
		$this->id_order = $id_order;
	}

	public function set_Reduction($reduction)
	{
		$this->reduction = $reduction;
	}

	public function set_OrderingDate($ordering_date)
	{
		$this->ordering_date = $ordering_date;
	}

	public function set_Client($client)
	{
		$this->client = $client;
	}

	public function get_all_orders()
	{
		$order_list = $this->CI->Orders_Model->get_all();
		$orders = array();
		foreach ($order_list as $order) :
			// echo $order['id_client'] ; 
			$client = new Client();
			$orders[] = new Orders(
				$order['id_order'],
				$order['reduction'],
				$order['ordering_date'],
				$client->get_client_by_id($order['id_client'])
			);

		endforeach;
		return $orders;
	}

	public function add_order($data)
	{
		return $this->Orders_Model->insert_order($data);
	}

	public function update_ordder($id, $data)
	{
		return $this->Orders_Model->update_order($id, $data);
	}

	public function delete_order($id, $data)
	{
		return $this->Orders_Model->delete_order_order($id, $data);
	}

	public function get_all_client_orders($id_client)
	{
		$order_list = $this->CI->Orders_Model->get_all_client_orders($id_client);
		$client_order = array();
		foreach ($order_list as $order) :
			$client = new Client();
			$client_order[] = new Orders(
				$order['id_order'],
				$order['reduction'],
				$order['ordering_date'],
				$client->get_client_by_id($order['id_client'])
			);
		endforeach;
		return $client_order;
	}

	// donner l'id client et le nombre de ligne de resultat qu'on veut recuperer
	public function last_client_order($id_client, $row)
	{
		$order_list = $this->CI->Orders_Model->last_client_order($id_client, $row);
		$client_order = array();
		foreach ($order_list as $order) :
			$client_order[] = new Orders(
				$order['id_order'],
				$order['reduction'],
				$order['ordering_date'],
				$order['id_client']
			);
		endforeach;
		return $client_order;
	}
}
