<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allModel($perpage = '', $limit = '') {
       // $carModel = $this->db->select('*')->from('car_model')->join('car_parent', 'car_model.ParentId = car_parent.IdParent')
       //         ->get();
       // return $carModel->result_array();
		$this->db->select('*');
		$this->db->join('car_parent', 'car_model.ParentId = car_parent.IdParent');
		$this->db->limit($perpage, $limit);
		$this->db->where('car_model.inActive',0);
		$this->db->where('car_parent.inActive',0);
		$carModel = $this->db->get('car_model')->result_array();
        return $carModel;
    }
 public function record_count() {
        
            $this->db->select('*');
         //$this->db->where('IsLost', 0);
            $query = $this->db->get("car_model");
            return $query->num_rows();
       // print_r($return);
    }
    function insertModel($ModelData) {
        $this->db->insert('car_model', $ModelData);
        $this->db->insert_id();
    }

    function updateModel($ModelID, $ModelData, $IdParent) {
        $this->db->where('IdModel', $ModelID);
        $this->db->set('Model', $ModelData);
        $this->db->set('ParentId', $IdParent);
        $update = $this->db->update('car_model');
        echo $update;
    }

    function deleteModel($ModelID) {
        $this->db->where('IdModel', $ModelID);
        $this->db->delete('car_model');
    }

    function oneModel($keyword) {
        $OneModel = $this->db->select('*')->
                        from('car_model')->join('car_parent', 'car_model.ParentId = car_parent.IdParent')->
                        like('car_model.Model', $keyword)->get();
        if ($OneModel->num_rows() > 0) {
            return $OneModel->result_array();
        }
    }

    function fillParentCombo() {
        $query = $this->db->query('select distinct IdParent, ParentName from car_parent');
        $parentCombo = $query->result();
        $dropDownList = array();
        foreach ($parentCombo as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdParent, "ParentName" => $dropdown->ParentName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillParentComboEdit() {
        $query = $this->db->query('select distinct IdParent, ParentName from car_parent');
        $dropdowns = $query->result();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->IdParent] = $dropdown->ParentName;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }
	////
	public function delete($ModelID) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('IdModel', $ModelID);
        $this->db->update('car_model', $data);
        return true;
    }

}
