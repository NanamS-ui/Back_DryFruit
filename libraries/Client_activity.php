<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients_activity
{
    protected $CI;

    private $client;
    private $date;

    public function __construct($client = null, $date = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Clients_account_Model');
        $this->client = $client;
        $this->date = $date;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function get_Activity_ordered()
    {
        $CI = &get_instance(); 

        $result = $CI->Clients_account_Model->get_clients_sorted_by_activity();
        $activity = array();

        foreach ($result as $data) {
            $client = new Clients_Account(
                $data['id_client'],
                $data['full_name'],
                $data['mail'],
                $data['password'],
                $data['phone_number'],
                $data['user_image']
            );
            $date = $data['last_order_date'];
            $activity[] = new Clients_activity($client, $date);
        }

        return $activity;
    }
}
?>
