<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_customer_status extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allCustomerStatus() {
        $this->db->select('Id', 'StatusType', 'CreatedType');
        $customerStatus = $this->db->get('car_customer_status');

        return $customerStatus->result_array();
    }

    function insertCustomerStatus($csData) {
        $this->db->insert('car_customer_status', $csData);
        $this->db->insert_id();
    }

    function updateCustomerStatus($csID, $csData) {
        $this->db->where('Id', $csID);
        $this->db->update('car_customer_status', $csData);
    }

    function deleteCustomerStatus($csID) {
        $this->db->where('Id', $csID);
        $this->db->delete('car_customer_status');
    }

}
