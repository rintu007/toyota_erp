<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_conditionconfirmation extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertCondition($conditionData) {

        $this->db->insert('s_conditionconfirmation', $conditionData);
        return "Successfully Inserted";
    }

    function UpdateCondition($idConditionConfirmation, $conditionData) {

        $this->db->where('idConditionConfirmation', $idConditionConfirmation);
        $this->db->update('s_conditionconfirmation', $conditionData);
        return "Successfully Updated";
    }

    function DeleteCondition($idConditionConfirmation) {

        $this->db->set('isActive', 0);
        $this->db->where('idConditionConfirmation', $idConditionConfirmation);
        $this->db->update('s_conditionconfirmation');
        return "Successfully Deleted";
    }

    function getCondition() {

        $this->db->select('*');
        $this->db->from('s_conditionconfirmation');
        $this->db->where('s_conditionconfirmation.isActive != 0');
        $conditionList = $this->db->get();
        return $conditionList->result_array();
    }

    function searchCondition($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_conditionconfirmation');
        $this->db->like('s_conditionconfirmation.Name', $SearchKeyword);
        $this->db->where('s_conditionconfirmation.isActive != 0');
        $searchCondition = $this->db->get();
        return $searchCondition->result_array();
    }

}
