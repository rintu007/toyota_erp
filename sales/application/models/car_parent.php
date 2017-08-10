<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_parent extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allParent($perpage = '', $limit = '') {
        //$carBrand = $this->db->select('*')->from('car_parent')->get();
        //return $carBrand->result_array();
		 $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$carBrand = $this->db->get('car_parent')->result_array();
        return $carBrand;
    }
 public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_parent");
            return $query->num_rows();
       // print_r($return);
    }
    function insertParent($ParentData) {
        $this->db->insert('car_parent', $ParentData);
        $this->db->insert_id();
    }

    function updateParent($ParentID, $ParentData,$ParentCode) {
        $this->db->where('IdParent', $ParentID);
        $this->db->set('ParentName', $ParentData);
		$this->db->set('ShortCode', $ParentCode);
        $this->db->update('car_parent');
    }

    function deleteParent($ParentID) {
        $this->db->where('IdParent', $ParentID);
        $this->db->delete('car_parent');
    }

    function oneParent($keyword) {
        $OneParent = $this->db->select('*')->from('car_parent')->
                        like('ParentName', $keyword)->get();
        if ($OneParent->num_rows() > 0) {
            return $OneParent->result_array();
			 
        }
    }
	public function delete($ParentID) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('IdParent', $ParentID);
        $this->db->update('car_parent', $data);
        return true;
    }

}
