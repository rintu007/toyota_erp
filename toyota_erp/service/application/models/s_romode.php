<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_romode extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertROMode($roModeData) {

        $this->db->insert('s_romode', $roModeData);
        return "Successfully Inserted";
    }

    function UpdateROMode($idROMode, $roModeData) {

        $this->db->where('idROMode', $idROMode);
        $this->db->update('s_romode', $roModeData);
        return "Successfully Updated";
    }

    function DeleteROMode($idROMode) {

        $this->db->set('isActive', 0);
        $this->db->where('idROMode', $idROMode);
        $this->db->update('s_romode');
        return "Successfully Deleted";
    }

    function getAllROMode() {

        $this->db->select('*');
        $this->db->from('s_romode');
        $this->db->where('s_romode.isActive != 0');
        $firQuestionsList = $this->db->get();
        return $firQuestionsList->result_array();
    }

    function isExist($data) {
        $this->db->select('*');
        $this->db->from('s_romode');
        $this->db->like('s_romode.ModeName', $data['ModeName']);
        $this->db->where('s_romode.isActive != 0');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            $result = $row->ModeName;
            return $result;
        }
    }

    function searchROMode($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_romode');
        $this->db->like('s_romode.ModeName', $SearchKeyword);
        $this->db->where('s_romode.isActive != 0');
        $searchROMode = $this->db->get();
        return $searchROMode->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}