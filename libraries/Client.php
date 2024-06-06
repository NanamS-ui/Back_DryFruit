<?php
class Client {
	private $CI ;

    private $id_client; 
    private $full_name;
    private $password; 
    private $mail; 
    private $phone_number;
	

    // Constructor
    public function __construct($id_client = null , $full_name = null, $password = null , $mail = null , $phone_number = null ) {
        $this->id_client = $id_client;
        $this->full_name = $full_name;
        $this->password = $password;
        $this->mail = $mail;
        $this->phone_number = $phone_number;

		$this->CI =& get_instance();
		$this->CI->load->model('Client_Model');
    }

    // Getters and setters 
    public function get_ClientId() {
        return $this->id_client;
    }

    public function get_ClientName() {
        return $this->full_name;
    }

    public function get_Password() {
        return $this->password;
    }

    public function get_Email() {
        return $this->mail;
    }

    public function get_Number() {
        return $this->phone_number;
    }

    public function set_ClientId($id_client) {
        $this->id_client = $id_client;
    }

    public function set_ClientName($full_name) {
        $this->full_name = $full_name;
    }

    public function set_Password($password) {
        $this->password = $password;
    }

    public function set_Email($mail) {
        $this->mail = $mail;
    }

    public function set_Number($phone_number) {
        $this->phone_number = $phone_number;
    }

	public function get_all_client(){
		$list = $this->CI->Client_model->get_all();
		return $list ; 
	}

	public function get_client_by_id ($id){
		$client = $this->CI->Client_model->get_by_id($id);
		if($client) {
			$this->set_ClientId($client['id_client']);
			$this->set_ClientName($client['full_name']);
			$this->set_Email($client['mail']);
			$this->set_Number($client['phone_number']);
		}
		return $client ; 

	}

	
	public function search_client_by_name ($name){
		$client = $this->CI->Client_model->search_client($name);
		$result = array();
		if($client) {
			foreach ($client as $client_result) {
				$client_search = new Client();
				$client_search->set_ClientId($client_result['id_client']);
				$client_search->set_ClientName($client_result['full_name']);
				$result[] = $client_search ;
			}
		}
		return $result ; 
	} 


}
?>
