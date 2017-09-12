<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_allocation_type extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allAllocationType($perpage = '', $limit = '') {
//        $this->db->select('Id', 'AllocationType', 'CreatedDate');
//        $allocationType = $this->db->get('car_allocation_type');
        //$allocationType = $this->db->select('*')->from('car_allocation_type')->get();
        //return $allocationType->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$allocationType = $this->db->get('car_allocation_type')->result_array();
        return $allocationType;
    }
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("car_allocation_type");
            return $query->num_rows();
       
    }
    function insertAllocationType($atData) {
        $this->db->insert('car_allocation_type', $atData);
        $this->db->insert_id();
    }

    function updateAllocationType($atID, $atData) {
        $this->db->where('Id', $atID);
        $this->db->update('car_allocation_type', $atData);
    }

    function deleteAllocationType($atID) {
        $this->db->where('Id', $atID);
        $this->db->delete('car_allocation_type');
    }
	//////////////////////
	///////
	public function delete($atID) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('Id', $atID);
        $this->db->update('car_allocation_type', $data);
        return true;
    }

}
