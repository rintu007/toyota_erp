<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_headings_input extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allLocation($perpage = '', $limit = '') {
       // $Financer = $this->db->select('*')->from('parking_row')->get();
        //return $Financer->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$Financer = $this->db->get('pds_inputs')->result_array();
        return $Financer;
    }
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("pds_inputs");
            return $query->num_rows();
       
    }
	///////////////////////////////
	
	////////////////////////////////////////////////////////////////////////////////
 public function getHeadingsInput() {
	// print_r($_POST);
        $this->db->select("*");
		$this->db->join ('pds_headings',' pds_headings.Id = pds_inputs.idheading');
		$result = $this->db->get('pds_inputs')->result_array();
	return $result;
    }
	///////////////////////////
    function insertLocation($LocationData) {
        $this->db->insert('pds_inputs', $LocationData);
        $this->db->insert_id();
		print_r($locationData);
    }

    function updateLocation($LocationId, $LocationData) {
        $this->db->where('id', $LocationId);
        $this->db->update('pds_inputs', $LocationData);
    }

    function deleteLocation($LocationID) {
        $this->db->where('id', $LocationID);
        $this->db->delete('pds_inputs');
    }
public function delete($LocationId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('id', $LocationId);
        $this->db->update('pds_inputs', $data);
        return true;
    }
}
