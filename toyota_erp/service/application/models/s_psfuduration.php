<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_psfuduration extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertPsfuDuration($psfuDurationData) {

        $this->db->insert('s_psfu_duration', $psfuDurationData);
        return "Successfully Inserted";
    }

    function UpdatePsfuDuration($idPsfuDuration, $psfuDurationData) {

        $this->db->where('idPsfuDuration', $idPsfuDuration);
        $this->db->update('s_psfu_duration', $psfuDurationData);
        return "Successfully Updated";
    }

    function DeletePsfuDuration($idPsfuDuration) {

        $this->db->set('isActive', 0);
        $this->db->where('idPsfuDuration', $idPsfuDuration);
        $this->db->update('s_psfu_duration');
        return "Successfully Deleted";
    }

    function getAllPsfuDuration() {

        $this->db->select('*');
        $this->db->from('s_psfu_duration');
        $this->db->where('s_psfu_duration.isActive != 0');
        $firQuestionsList = $this->db->get();
        return $firQuestionsList->result_array();
    }

    function isExist($data) {
        $this->db->select('*');
        $this->db->from('s_psfu_duration');
        $this->db->like('s_psfu_duration.Duration', $data['Duration']);
        $this->db->where('s_psfu_duration.isActive != 0');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            $result = $row->Duration;
            return $result;
        }
    }

    function searchPsfuDuration($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_psfu_duration');
        $this->db->like('s_psfu_duration.Duration', $SearchKeyword);
        $this->db->where('s_psfu_duration.isActive != 0');
        $searchPsfuDuration = $this->db->get();
        return $searchPsfuDuration->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}