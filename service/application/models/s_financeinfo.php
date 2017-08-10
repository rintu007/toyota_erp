<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_financeinfo extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertFinanceInfo($financeData) {

        $this->db->insert('s_finance', $financeData);
        return "Successfully Inserted";
    }

    function UpdateFinanceInfo($idFinance, $financeData) {

        $this->db->where('idFinance', $idFinance);
        $this->db->update('s_finance', $financeData);
        return "Successfully Updated";
    }

    function DeleteFinanceInfo($idFinance) {

        $this->db->set('isActive', 0);
        $this->db->where('idFinance', $idFinance);
        $this->db->update('s_finance');
        return "Successfully Deleted";
    }

    function selectOneFinanceInfo($idFinance) {
        $this->db->select('s_finance.Name');
        $this->db->from('s_finance');
        $this->db->where('s_finance.idFinance', $idFinance);
        $this->db->where('s_finance.isActive != 0');
        $this->db->limit(1);
        $financeName = $this->db->get();
        if ($financeName->num_rows() > 0) {
            $row = $financeName->row();
            $financeName = $row->Name;
            return $financeName;
        }
    }

    function searchFinanceInfo($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_finance');
        $this->db->like('s_finance.Name', $SearchKeyword);
        $this->db->where('s_finance.isActive != 0');
        $searchFinance = $this->db->get();
        return $searchFinance->result_array();
    }

    function getFinanceInfo() {

        $this->db->select('*');
        $this->db->from('s_finance');
        $this->db->where('s_finance.isActive != 0');
        $financeInfoList = $this->db->get();
        return $financeInfoList->result_array();
    }

    function getfainancename($idfinance){
        $this->db->select('*');
        $this->db->from('s_finance');
        $this->db->where('s_finance.isActive != 0');
        $this->db->where('s_finance.idFinance' , $idfinance);
        $financeInfoList = $this->db->get();
        return $financeInfoList->result_array();        
    }

    function selectAll() {
        
    }

}
