<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_conditionconfirmationdetail extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertConditionDetails($conditionDetailsData) {

        $this->db->insert('s_conditionconfirmationdetail', $conditionDetailsData);
        return "Successfully Inserted";
    }

    function UpdateConditionDetails($idConditsionDetails, $conditionDetailsData) {

        $this->db->where('idConditionConfirmationDetail', $idConditsionDetails);
        $this->db->update('s_conditionconfirmationdetail', $conditionDetailsData);
        return "Successfully Updated";
    }

    function DeleteConditionDetails($idConditionDetails) {

        $this->db->set('isActive', 0);
        $this->db->where('idConditionConfirmationDetail', $idConditionDetails);
        $this->db->update('s_conditionconfirmationdetail');
        return "Successfully Deleted";
    }

    function getAllConditionDetails() {

        $this->db->select('cd.idConditionConfirmationDetail AS idConditionDetail,cd.Name AS ConditionDetail,co.idConditionConfirmation AS idCondition,co.Name AS conditionconfirmation');
        $this->db->from('s_conditionconfirmationdetail cd');
        $this->db->join('s_conditionconfirmation AS co', 'co.idConditionConfirmation  = cd.idConditionConfirmation');
        $this->db->where('cd.isActive != 0');
        $conditionDetailsList = $this->db->get();
        return $conditionDetailsList->result_array();
    }

    function getConditionDetail() {

        $this->db->select('*');
        $this->db->from('s_conditionconfirmation');
        $this->db->where('s_conditionconfirmation.isActive != 0');
        $condition = $this->db->get();
        $resultarray['Condition'] = $condition->result_array();

        $index = 0;
        foreach ($resultarray['Condition'] as $result) {
            $this->db->select('cd.idConditionConfirmationDetail AS idConditionDetail,cd.Name AS ConditionDetail,co.idConditionConfirmation AS idCondition,co.Name AS conditionconfirmation');
            $this->db->from('s_conditionconfirmationdetail cd');
            $this->db->join('s_conditionconfirmation AS co', 'co.idConditionConfirmation  = cd.idConditionConfirmation');
            $this->db->where('cd.isActive != 0 and co.idConditionConfirmation=' . $result['idConditionConfirmation']);
            $this->db->order_by('cd.OrderPriority', 'Asc');
            $conditionDetails = $this->db->get();
            $result['ConditionDetail'] = $conditionDetails->result_array();
            $resultarray['Condition'][$index++]['ConditionDetail'] = $conditionDetails->result_array();
        }

        return $resultarray['Condition'];
    }

    function searchConditionDetails($SearchKeyword) {

        $this->db->select('cd.idConditionConfirmationDetail AS idConditionDetail,cd.Name AS ConditionDetail,co.idConditionConfirmation AS idCondition,co.Name AS conditionconfirmation');
        $this->db->from('s_conditionconfirmationdetail cd');
        $this->db->join('s_conditionconfirmation AS co', 'co.idConditionConfirmation  = cd.idConditionConfirmation');
        $this->db->like('cd.Name', $SearchKeyword);
        $this->db->where('cd.isActive != 0');
        $searchConditionDetails = $this->db->get();
        return $searchConditionDetails->result_array();
    }

}
