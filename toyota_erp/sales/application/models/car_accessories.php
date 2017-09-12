<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_accessories extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allCarAccessories($perpage = '', $limit = '') {
        //$this->db->select('*');
       // $this->db->from('car_accessory_info');
        //$carAccessories = $this->db->get();

        //return $carAccessories->result_array();
		 $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$carAccessories = $this->db->get('car_accessory_info')->result_array();
        return $carAccessories;
    }
////
 public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_accessory_info");
            return $query->num_rows();
       // print_r($return);
    }



///////
    function oneCarAccessory($idAccessory) {
        $this->db->select('*');
        $this->db->from('car_accessory_info');
        $this->db->where('Id', $idAccessory);
        $OneCa = $this->db->get();
        return $OneCa->row_array();
    }

    function insertCarAccessories($caData) {
        $this->db->insert('car_accessory_info', $caData);
        $this->db->insert_id();
    }

    function updateCarAccessories($caID, $caData) {
        $this->db->where('Id', $caID);
        $this->db->update('car_accessory_info', $caData);
    }

    function deleteCarAccessories($caID) {
        $this->db->where('Id', $caID);
        $this->db->delete('car_accessory_info');
    }
	///////
	public function delete($caID) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('Id', $caID);
        $this->db->update('car_accessory_info', $data);
        return true;
    }

}
