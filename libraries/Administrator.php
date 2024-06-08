<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator
{
    protected $CI;

    private $id_admin;
    private $pseudo_name;
    private $password;

    public function __construct($id = null, $pseudo_name = null, $password = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Administrators_Model');

        $this->id_admin = $id;
        $this->pseudo_name = $pseudo_name;
        $this->password = $password;
    }

    public function get_id_admin()
    {
        return $this->id_admin;
    }

    public function set_id_admin($id_admin)
    {
        $this->id_admin = $id_admin;
    }

    public function get_pseudo_name()
    {
        return $this->pseudo_name;
    }

    public function set_pseudo_name($pseudo_name)
    {
        $this->pseudo_name = $pseudo_name;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }

    public function get_all_administrators()
    {
        $result = $this->CI->Administrators_Model->get_all();
        $administrators = array();
        foreach ($result as $data) {
            $administrators[] = new Administrator(
                $data['id_admin'],
                $data['pseudo_name'],
                $data['password']
            );
        }
        return $administrators;
    }

    public function get_administrator_by_id($id)
    {
        $data = $this->CI->Administrators_Model->get_by_id($id);
        return new Administrator(
            $data['id_admin'],
            $data['pseudo_name'],
            $data['password']
        );
    }

    public function add_administrator($pseudo_name, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'pseudo_name' => $pseudo_name,
            'password' => $hashed_password
        );

        $this->CI->Administrators_Model->insert($data);
    }

    public function update_administrator($id, $pseudo_name, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'pseudo_name' => $pseudo_name,
            'password' => $hashed_password
        );

        $this->CI->Administrators_Model->update($id, $data);
    }

    public function delete_administrator($id)
    {
        return $this->CI->Administrators_Model->delete($id);
    }

    public function login($pseudo_name, $password)
    {
        return $this->CI->Administrators_Model->verify_login($pseudo_name, $password);
    }
}
