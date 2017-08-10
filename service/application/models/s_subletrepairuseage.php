<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_subletrepairuseage extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertSubletRepairUseage($subletUseageData) {

        $this->db->insert('s_subletrepairuseage', $subletUseageData);
        return "Successfully Inserted";
    }

    function UpdateSubletRepairUseage($idSubletRepairUseage, $subletUseageData) {

        $this->db->where('idSubletRepairUseage', $idSubletRepairUseage);
        $this->db->update('s_subletrepairuseage', $subletUseageData);
        return "Successfully Updated";
    }

    function DeleteSubletRepairUseage($idSubletRepairUseage) {

        $this->db->set('isActive', 0);
        $this->db->where('idSubletRepairUseage', $idSubletRepairUseage);
        $this->db->update('s_subletrepairuseage');
        return "Successfully Deleted";
    }

    function searchSubletRepairUseage($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_subletrepairuseage');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_subletrepairuseage.idDealer');
        $this->db->like('s_subletrepairuseage.SubletRepairUseageName', $SearchKeyword);
        $this->db->where('s_subletrepairuseage.isActive != 0');
        $searchSubletRepairUseage = $this->db->get();
        return $searchSubletRepairUseage->result_array();
    }

    function selectOneSubletRepairUseage() {

        $this->db->select('idSubletRepairUseage');
        $this->db->from('s_subletrepairuseage');
        $this->db->order_by("CreatedDate", "desc");
        $idSubletRepairUseage = $this->db->get();
        if ($idSubletRepairUseage->num_rows() > 0) {
            $row = $idSubletRepairUseage->row();
            $idSubletRepairUseage = $row->idSubletRepairUseage;
            return $idSubletRepairUseage;
        }
    }

    function getAllDealers() {
        $query = $this->db->query('select * from car_dealer_type');
        $querResult = $query->result();
        $queryResultList = array();
        foreach ($querResult as $key) {
            array_push($queryResultList, ["IdDealer" => $key->IdDealer, "DealerName" => $key->TypeName]);
        }
        $dealerList = $queryResultList;
        return $dealerList;
    }

    function getAllSubletRepairUseages() {

        $this->db->select('*');
        $this->db->from('s_subletrepairuseage');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_subletrepairuseage.idDealer');
        $this->db->where('s_subletrepairuseage.isActive != 0');
        $baysList = $this->db->get();
        return $baysList->result_array();
    }

    function selectAllSubletRepairUseages() {
        
    }

}
