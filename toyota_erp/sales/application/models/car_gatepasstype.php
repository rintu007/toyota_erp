<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_gatepasstype extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allLocation($perpage = '', $limit = '') {
       // $Financer = $this->db->select('*')->from('car_gatepass_type')->get();
        //return $Financer->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$Financer = $this->db->get('car_gatepass_type')->result_array();
        return $Financer;
    }
/////////
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("car_gatepass_type");
            return $query->num_rows();
       
    }
    function insertLocation($LocationData) {
        $this->db->insert('car_gatepass_type', $LocationData);
        $this->db->insert_id();
		//print_r($locationData);
    }

    function updateLocation($LocationId, $LocationData) {
        $this->db->where('idgatepasstype', $LocationId);
        $this->db->update('car_gatepass_type', $LocationData);
    }
		/////////////
    function deleteLocation($LocationID) {
        $this->db->where('idgatepasstype', $LocationID);
        $this->db->delete('car_gatepass_type');
    }
	/////////////////////
	public function delete($LocationId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('idgatepasstype', $LocationId);
        $this->db->update('car_gatepass_type', $data);
        return true;
    }

}
