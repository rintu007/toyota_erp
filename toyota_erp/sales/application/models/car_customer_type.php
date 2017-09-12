<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_customer_type extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function allCustomerType($perpage = '', $limit = '') {
       // $CustomerType = $this->db->select('*')->from('car_customer_type')->get();
       // return $CustomerType->result_array();
	    $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$CustomerType = $this->db->get('car_customer_type')->result_array();
        return $CustomerType;
    }
///////////////
public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_customer_type");
            return $query->num_rows();
       // print_r($return);
    }
    function insertCustomerType($ctData) {
        $this->db->insert('car_customer_type', $ctData);
        $this->db->insert_id();
    }

    function updateCustomerType($ctID, $ctData) {
        $this->db->where('Id', $ctID);
        $this->db->set('CustomerType', $ctData);
        $this->db->update('car_customer_type');
    }

    function deleteCustomerType($ctID) {
        $this->db->where('Id', $ctID);
        $this->db->delete('car_customer_type');
    }
	public function delete($CustomerTypeId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('Id', $CustomerTypeId);
        $this->db->update('car_customer_type', $data);
        return true;
    }

}
