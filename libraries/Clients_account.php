<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients_Account
{
    protected $CI;

    private $id_client;
    private $full_name;
    private $mail;
    private $password;
    private $phone_number;
    private $user_image;

    public function __construct($id = null, $full_name = null, $mail = null, $password = null, $phone_number = null, $user_image = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Clients_account_Model');

        $this->id_client = $id;
        $this->full_name = $full_name;
        $this->mail = $mail;
        $this->password = $password;
        $this->phone_number = $phone_number;
        $this->user_image = $user_image;
    }

    public function get_id_client()
    {
        return $this->id_client;
    }

    public function set_id_client($id_client)
    {
        $this->id_client = $id_client;
    }

    public function get_full_name()
    {
        return $this->full_name;
    }

    public function set_full_name($full_name)
    {
        $this->full_name = $full_name;
    }

    public function get_mail()
    {
        return $this->mail;
    }

    public function set_mail($mail)
    {
        $this->mail = $mail;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }

    public function get_phone_number()
    {
        return $this->phone_number;
    }

    public function set_phone_number($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function get_user_image()
    {
        return $this->phone_number;
    }

    public function set_user_image($user_image)
    {
        $this->user_image = $user_image;
    }

    public function get_all_clients()
    {
        $result = $this->CI->Clients_account_Model->get_all();
        $clients = array();
        foreach ($result as $data) {
            $clients[] = new Clients_Account(
                $data['id_client'],
                $data['full_name'],
                $data['mail'],
                $data['password'],
                $data['phone_number'],
                $data['user_image']
            );
        }
        return $clients;
    }

    public function get_client_by_id($id)
    {
        $data = $this->CI->Clients_account_Model->get_by_id($id);
        return new Clients_Account(
            $data['id_client'],
            $data['full_name'],
            $data['mail'],
            $data['password'],
            $data['phone_number'],
            $data['user_image']
        );
    }

    public function add_client()
    {
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $data = array(
            'full_name' => $this->full_name,
            'mail' => $this->mail,
            'password' => $hashed_password,
            'phone_number' => $this->phone_number,
            'user_image' => $this->user_image
        );

        $this->CI->Clients_account_Model->register($data);
    }

    public function update_client($id, $data)
    {
        return $this->CI->Clients_account_Model->update($id, $data);
    }

    public function delete_client($id)
    {
        return $this->CI->Clients_account_Model->delete($id);
    }

    public function login($email, $password)
    {
        return $this->CI->Clients_account_Model->verify_login($email, $password);
    }
}
