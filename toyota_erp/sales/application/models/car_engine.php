<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_engine extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allEngine($perpage = '', $limit = '') {
        //$CarEngine = $this->db->select('*')->from('car_engine')->get();
        //return $CarEngine->result_array();
		 $this->db->select('*');
		$this->db->limit($perpage, $limit);
		$this->db->where('inActive',0);
		$CarEngine = $this->db->get('car_engine')->result_array();
        return $CarEngine;
    }
public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_engine");
            return $query->num_rows();
       // print_r($return);
    }
    function oneEngine($keyword) {
        $CarEngine = $this->db->select('*')->from('car_engine')->like('EngineType', $keyword, 'after')->get();
        return $CarEngine->result_array();
    }

    function insertEngine($EngineData) {
        $this->db->insert('car_engine', $EngineData);
        $this->db->insert_id();
    }

    function updateEngine($EngineId, $EngineData) {
        $this->db->where('IdEngine', $EngineId);
        $this->db->set('EngineType', $EngineData);
        $this->db->update('car_engine');
    }

    function deleteEngine($EngineId) {
        $this->db->where('IdEngine', $EngineId);
        $this->db->delete('car_engine');
    }
///
////
	public function delete($EngineId) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('IdEngine', $EngineId);
        $this->db->update('car_engine', $data);
        return true;
    }
}
