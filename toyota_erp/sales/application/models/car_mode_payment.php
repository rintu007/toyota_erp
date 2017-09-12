<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_mode_payment extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allModePayment($perpage = '', $limit = '') {
       // $modePayment = $this->db->select('*')->from('car_mode_payment')->get();
       // return $modePayment->result_array();
	    $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('car_mode_payment.inActive',0);
		$modePayment = $this->db->get('car_mode_payment')->result_array();
        return $modePayment;
    }
 public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_mode_payment");
            return $query->num_rows();
       // print_r($return);
    }
    function insertModePayment($mpData) {
        $this->db->insert('car_mode_payment', $mpData);
        $this->db->insert_id();
    }

    function updateModePayment($mpID, $mpData) {
        $this->db->where('Id', $mpID);
        $this->db->set('PaymentType', $mpData);
        $this->db->update('car_mode_payment');
    }

    function deleteModePayment($mpID) {
        $this->db->where('Id', $mpID);
        $this->db->delete('car_mode_payment');
    }
	public function delete($PaymentId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('Id', $PaymentId);
        $this->db->update('car_mode_payment', $data);
        return true;
    }

}
