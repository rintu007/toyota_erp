<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_parking extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allLocation($perpage = '', $limit = '') {
       // $Financer = $this->db->select('*')->from('parking_row')->get();
        //return $Financer->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$Financer = $this->db->get('parking_row')->result_array();
        return $Financer;
    }
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("parking_row");
            return $query->num_rows();
       
    }
    function insertLocation($LocationData) {
        $this->db->insert('parking_row', $LocationData);
        $this->db->insert_id();
		print_r($locationData);
    }

    function updateLocation($LocationId, $LocationData) {
        $this->db->where('id', $LocationId);
        $this->db->update('parking_row', $LocationData);
    }

    function deleteLocation($LocationID) {
        $this->db->where('id', $LocationID);
        $this->db->delete('parking_row');
    }
public function delete($LocationId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('id', $LocationId);
        $this->db->update('parking_row', $data);
        return true;
    }
}
