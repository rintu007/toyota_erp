<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_rochecklist extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertRoCheckList($checkListData) {

        $this->db->insert('s_ro_checklist', $checkListData);
        return "Successfully Inserted";
    }

    function UpdateRoCheckList($idCheckList, $CheckListData) {

        $this->db->where('idROCheckList', $idCheckList);
        $this->db->update('s_ro_checklist', $CheckListData);
        return "Successfully Updated";
    }

    function DeleteRoCheckList($idCheckList) {

        $this->db->set('isActive', 0);
        $this->db->where('idROCheckList', $idCheckList);
        $this->db->update('s_ro_checklist');
        return "Successfully Deleted";
    }

    function searchRoCheckList($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_ro_checklist');
        $this->db->like('s_ro_checklist.Name', $SearchKeyword);
        $this->db->where('s_ro_checklist.isActive', 1);
        $searchCheckList = $this->db->get();
        return $searchCheckList->result_array();
    }

    function getAllRoCheckList() {

        $this->db->select('*');
        $this->db->from('s_ro_checklist');
        $this->db->where('s_ro_checklist.isActive', 1);
        $checkList = $this->db->get();
        return $checkList->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
