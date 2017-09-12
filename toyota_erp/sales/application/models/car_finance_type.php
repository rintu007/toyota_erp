<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_finance_type extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allFinanceType() {
        $this->db->select('Id', 'FinanceType', 'CreatedDate');
        $carFinance = $this->db->get('car_finance_type');

        return $carFinance->result_array();
    }

    function insertFinanceType($cfData) {
        $this->db->insert('car_finance_type', $cfData);
        $this->db->insert_id();
    }

    function updateFinanceType($cfID, $cfData) {
        $this->db->where('Id', $cfID);
        $this->db->update('car_finance_type', $cfData);
    }

    function deleteFinanceType($cfID) {
        $this->db->where('Id', $cfID);
        $this->db->delete('car_finance_type');
    }

}
