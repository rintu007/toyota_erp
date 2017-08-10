<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_dispatchmode extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertDispatchMode($dispatchModeData) {

        $this->db->insert('dispatch_mode', $dispatchModeData);
        return "Successfully Inserted";
    }

    function UpdateDispatchMode($idDispatchMode, $dispatchModeData) {

        $this->db->where('idDispatch', $idDispatchMode);
        $this->db->update('dispatch_mode', $dispatchModeData);
        return "Successfully Updated";
    }

    function getAllDispatchMode() {

        $this->db->select('*');
        $this->db->from('dispatch_mode');
        $dispatchModeList = $this->db->get();
        return $dispatchModeList->result_array();
    }

    function isExist($data) {
        $this->db->select('*');
        $this->db->from('dispatch_mode');
        $this->db->like('dispatch_mode.Mode', $data['Mode']);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            $result = $row->Mode;
            return $result;
        }
    }

    function searchDispatchMode($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('dispatch_mode');
        $this->db->like('dispatch_mode.Mode', $SearchKeyword);
        $searchDispatchMode = $this->db->get();
        return $searchDispatchMode->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}