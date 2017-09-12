<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_location extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allLocation($perpage = '', $limit = '') {
        //$Financer = $this->db->select('*')->from('car_location')->get();
       // return $Financer->result_array();
	   $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$Financer = $this->db->get('car_location')->result_array();
        return $Financer;
    }
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("car_location");
            return $query->num_rows();
       
    }
    function insertLocation($LocationData) {
        $this->db->insert('car_location', $LocationData);
        $this->db->insert_id();
    }

    function updateLocation($LocationId, $LocationData) {
        $this->db->where('idLocation', $LocationId);
        $this->db->update('car_location', $LocationData);
    }

    function deleteLocation($LocationID) {
        $this->db->where('idLocation', $LocationID);
        $this->db->delete('car_location');
    }
	///////////////
	public function delete($LocationId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('idLocation', $LocationId);
        $this->db->update('car_location', $data);
        return true;
    }

}
