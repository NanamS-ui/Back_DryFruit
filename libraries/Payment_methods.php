<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_methods
{
    protected $CI;

    private $id_payment;
    private $id_client;
    private $payment_type;
    private $card_number;
    private $expiry_date;
    private $cvv;

    public function __construct($id_payment = null, $id_client = null, $payment_type = null, $card_number = null, $expiry_date = null, $cvv = null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Payment_methods_Model');

        $this->id_payment = $id_payment;
        $this->id_client = $id_client;
        $this->payment_type = $payment_type;
        $this->card_number = $card_number;
        $this->expiry_date = $expiry_date;
        $this->cvv = $cvv;
    }

    public function get_id_payment()
    {
        return $this->id_payment;
    }

    public function set_id_payment($id_payment)
    {
        $this->id_payment = $id_payment;
    }

    public function get_id_client()
    {
        return $this->id_client;
    }

    public function set_id_client($id_client)
    {
        $this->id_client = $id_client;
    }

    public function get_payment_type()
    {
        return $this->payment_type;
    }

    public function set_payment_type($payment_type)
    {
        $this->payment_type = $payment_type;
    }

    public function get_card_number()
    {
        return $this->card_number;
    }

    public function set_card_number($card_number)
    {
        $this->card_number = $card_number;
    }

    public function get_expiry_date()
    {
        return $this->expiry_date;
    }

    public function set_expiry_date($expiry_date)
    {
        $this->expiry_date = $expiry_date;
    }

    public function get_cvv()
    {
        return $this->cvv;
    }

    public function set_cvv($cvv)
    {
        $this->cvv = $cvv;
    }


    public function get_all_payment_methods()
    {
        $result = $this->CI->Payment_methods_Model->get_all_payment_methods();
        $payment_methods = array();
        foreach ($result as $data) {
            $payment_methods[] = new Payment_Methods(
                $data['id_payment'],
                $data['id_client'],
                $data['payment_type'],
                $data['card_number'],
                $data['expiry_date'],
                $data['cvv']
            );
        }
        return $payment_methods;
    }

    public function get_payment_method_by_id($id_payment)
    {
        $data = $this->CI->Payment_methods_Model->get_payment_method_by_id($id_payment);
        return new Payment_Methods(
            $data['id_payment'],
            $data['id_client'],
            $data['payment_type'],
            $data['card_number'],
            $data['expiry_date'],
            $data['cvv']
        );
    }

    public function get_payment_methods_by_client_id($id_client)
    {
        $result = $this->CI->Payment_methods_Model->get_payment_methods_by_client_id($id_client);
        $payment_methods = array();
        foreach ($result as $data) {
            $payment_methods[] = new Payment_Methods(
                $data['id_payment'],
                $data['id_client'],
                $data['payment_type'],
                $data['card_number'],
                $data['expiry_date'],
                $data['cvv']
            );
        }
        return $payment_methods;
    }

    public function add_payment_method()
    {
        $data = array(
            'id_client' => $this->id_client,
            'payment_type' => $this->payment_type,
            'card_number' => $this->card_number,
            'expiry_date' => $this->expiry_date,
            'cvv' => $this->cvv
        );

        return $this->CI->Payment_methods_Model->add_payment_method($data);
    }

    public function update_payment_method($id_payment)
    {
        $data = array(
            'id_client' => $this->id_client,
            'payment_type' => $this->payment_type,
            'card_number' => $this->card_number,
            'expiry_date' => $this->expiry_date,
            'cvv' => $this->cvv
        );

        return $this->CI->Payment_methods_Model->update_payment_method($id_payment, $data);
    }

    public function delete_payment_method($id_payment)
    {
        return $this->CI->Payment_methods_Model->delete_payment_method($id_payment);
    }
}
