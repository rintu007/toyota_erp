<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_displacement extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allDisplacement($perpage = '', $limit = '') {
        //$CarDisplacement = $this->db->select('*')->from('car_displacement')->get();
        //return $CarDisplacement->result_array();
		$this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$CarDisplacement = $this->db->get('car_displacement')->result_array();
        return $CarDisplacement;
    }
///////////
 public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_displacement");
            return $query->num_rows();
       // print_r($return);
    }
    function oneDisplacement($keyword) {
        $CarDisplacement = $this->db->select('*')->from('car_displacement')->like('DisplacementName', $keyword, 'after')->get();
        return $CarDisplacement->result_array();
    }

    function insertDisplacement($DisplacementData) {
        $this->db->insert('car_displacement', $DisplacementData);
        $this->db->insert_id();
    }

    function updateDisplacement($DisplacementId, $DisplacementData) {
        $this->db->where('IdDisplacement', $DisplacementId);
        $this->db->set('DisplacementName', $DisplacementData);
        $this->db->update('car_displacement');
    }

    function deleteDisplacement($DisplacementId) {
        $this->db->where('IdDisplacement', $DisplacementId);
        $this->db->delete('car_displacement');
    }
	////
	public function delete($DisplacementId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('IdDisplacement', $DisplacementId);
        $this->db->update('car_displacement', $data);
        return true;
    }

}
