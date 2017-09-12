<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_color extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allCarColor( $perpage = '', $limit = '') {
		
        $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$carColor = $this->db->get('car_color')->result_array();
        return $carColor;
		//print_r($carColor);
    }
/////////////////
 public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_color");
            return $query->num_rows();
       // print_r($return);
    }



/////////////////
    function oneCarColor($keyword) {
        $carColor = $this->db->select('*')->from('car_color')->like('ColorName', $keyword, 'after')->get();
        return $carColor->result_array();
    }

    function insertCarColor($ccData) {
        $this->db->insert('car_color', $ccData);
        $this->db->insert_id();
    }

    function updateCarColor($ccID, $ccName, $ccCode) {
        $this->db->where('IdColor', $ccID);
        $this->db->set('ColorName', $ccName);
		 $this->db->set('ColorCode', $ccCode);
        $this->db->update('car_color');
    }

    function deleteCarColor($ccID) {
        $this->db->where('IdColor', $ccID);
        $this->db->delete('car_color');
    }
	////
	public function delete($ccID) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('IdColor', $ccID);
        $this->db->update('car_color', $data);
        return true;
    }

}
