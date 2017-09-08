<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_document extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allLocation($perpage = '', $limit = '') {
       // $Financer = $this->db->select('*')->from('document')->get();
        //return $Financer->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
//		$this->db->where('inActive',0);
		$Financer = $this->db->get('document')->result_array();
        return $Financer;
    }
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("document");
            return $query->num_rows();
       
    }
    function insertLocation($LocationData) {
        $this->db->insert('document', $LocationData);
        $this->db->insert_id();
//		print_r($locationData);
    }

    function updateLocation($LocationId, $LocationData) {
        $this->db->where('iddocument', $LocationId);
        $this->db->update('document', $LocationData);
    }

    function deleteLocation($LocationID) {
        $this->db->where('iddocument', $LocationID);
        $this->db->delete('document');
    }
public function delete($LocationId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('iddocument', $LocationId);
        $this->db->update('document', $data);
        return true;
    }
}
