<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_customer extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allCustomer() {
        $customers = $this->db->select('*')->from('car_customer')->get();
        return $customers->result_array();
    }

    function oneCustomer($customerID) {
        $this->db->select('IdCustomer, CustomerName, FatherName, AddressDetails, City, Province, Cnic, Ntn, Telephone, Cellphone, Email');
        $this->db->where('IdCustomer', $customerID);
        $customers = $this->db->get('car_customer');

        return $customers->row_array();
    }

    function insertCustomer($customerData, $ctData) {
        $this->db->trans_start();
        $this->db->insert('car_customer', $customerData);
        $this->db->insert('car_customer_type', $ctData);
        $customer = $this->db->insert_id();
        $this->db->trans_complete();

        return (isset($customer) ? $customer : FALSE);
    }

    function updateCustomer($customerID, $customerData) {
        $this->db->where('IdCustomer', $customerID);
        $this->db->update('car_customer', $customerData);
    }

    function deleteCustomer($customerID) {
        $this->db->where('IdCustomer', $customerID);
        $this->db->delete('car_customer');
    }

}
