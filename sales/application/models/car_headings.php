<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_headings extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allLocation($perpage = '', $limit = '') {
       // $Financer = $this->db->select('*')->from('parking_row')->get();
        //return $Financer->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$Financer = $this->db->get('pds_headings')->result_array();
        return $Financer;
    }
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("pds_headings");
            return $query->num_rows();
       
    }
    function insertLocation($LocationData) {
        $this->db->insert('pds_headings', $LocationData);
        $this->db->insert_id();
		print_r($locationData);
    }

    function updateLocation($LocationId, $LocationData) {
        $this->db->where('id', $LocationId);
        $this->db->update('pds_headings', $LocationData);
    }

    function deleteLocation($LocationID) {
        $this->db->where('id', $LocationID);
        $this->db->delete('pds_headings');
    }
public function delete($LocationId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('id', $LocationId);
        $this->db->update('pds_headings', $data);
        return true;
    }
}
