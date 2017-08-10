<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_financer extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allFinancer($perpage = '', $limit = '') {
        //$Financer = $this->db->select('*')->from('car_finance_bank')->get();
       // return $Financer->result_array();
	   $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$Financer = $this->db->get('car_finance_bank')->result_array();
        return $Financer;
    }
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("car_finance_bank");
            return $query->num_rows();
       
    }
    function insertFinancer($FinancerData) {
        $this->db->insert('car_finance_bank', $FinancerData);
        $this->db->insert_id();
    }

    function updateFinancer($FinancerId, $FinancerData) {
        $this->db->where('idFinance', $FinancerId);
        $this->db->set('FinancerName', $FinancerData);
        $this->db->update('car_finance_bank');
    }

    function deleteFinancer($ctID) {
        $this->db->where('idFinance', $ctID);
        $this->db->delete('car_finance_bank');
    }
	//
	public function delete($FinancerId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('idFinance', $FinancerId);
        $this->db->update('car_finance_bank', $data);
        return true;
    }

}
