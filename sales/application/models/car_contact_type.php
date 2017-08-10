<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_contact_type extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allContactType($perpage = '', $limit = '') {
        //$ContactType = $this->db->select('*')->from('car_contact_type')->get();

        //return $ContactType->result_array();
		 $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$ContactType = $this->db->get('car_contact_type')->result_array();
        return $ContactType;
    }
	//////////////
public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_contact_type");
            return $query->num_rows();
       // print_r($return);
    }
    function insertContactType($ctData) {
        $this->db->insert('car_contact_type', $ctData);
        $this->db->insert_id();
    }

    function updateContactType($ctID, $ctData) {
        $this->db->where('Id', $ctID);
        $this->db->set('ContactType', $ctData);
        $this->db->update('car_contact_type');
    }

    function deleteContactType($ctID) {
        $this->db->where('Id', $ctID);
        $this->db->delete('car_contact_type');
    }
	public function delete($ContactTypeId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('Id', $ContactTypeId);
        $this->db->update('car_contact_type', $data);
        return true;
    }

}
