<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_source extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allLocation($perpage = '', $limit = '') {
       // $Financer = $this->db->select('*')->from('source')->get();
        //return $Financer->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$Financer = $this->db->get('source')->result_array();
        return $Financer;
    }
/////////
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("source");
            return $query->num_rows();
       
    }
    function insertLocation($LocationData) {
        $this->db->insert('source', $LocationData);
        $this->db->insert_id();
		print_r($locationData);
    }

    function updateLocation($LocationId, $LocationData) {
        $this->db->where('id', $LocationId);
        $this->db->update('source', $LocationData);
    }

    function deleteLocation($LocationID) {
        $this->db->where('id', $LocationID);
        $this->db->delete('source');
    }
	///////////
	public function delete($LocationId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('id', $LocationId);
        $this->db->update('source', $data);
        return true;
    }
}
