<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_partsuseage extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertPartsUseage($partsUseageData) {

        $this->db->insert('s_partsuseage', $partsUseageData);
        return "Successfully Inserted";
    }

    function UpdatePartsUseage($idPartsUseage, $partsUseageData) {

        $this->db->where('idPartsUseage', $idPartsUseage);
        $this->db->update('s_partsuseage', $partsUseageData);
        return "Successfully Updated";
    }

    function DeletePartsUseage($idPartsUseage) {

        $this->db->set('isActive', 0);
        $this->db->where('idPartsUseage', $idPartsUseage);
        $this->db->update('s_partsuseage');
        return "Successfully Deleted";
    }

    function searchPartsUseage($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_partsuseage');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_partsuseage.idDealer');
        $this->db->like('s_partsuseage.PartsUseageName', $SearchKeyword);
        $this->db->where('s_partsuseage.isActive != 0');
        $searchPartsUseage = $this->db->get();
        return $searchPartsUseage->result_array();
    }

    function selectOnePartsUseage() {

        $this->db->select('idPartsUseage');
        $this->db->from('s_partsuseage');
        $this->db->order_by("CreatedDate", "desc");
        $idPartsUseage = $this->db->get();
        if ($idPartsUseage->num_rows() > 0) {
            $row = $idPartsUseage->row();
            $idPartsUseage = $row->idPartsUseage;
            return $idPartsUseage;
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

    function getAllPartsUseages() {

        $this->db->select('*');
        $this->db->from('s_partsuseage');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_partsuseage.idDealer');
        $this->db->where('s_partsuseage.isActive != 0');
        $baysList = $this->db->get();
        return $baysList->result_array();
    }

    function selectAllPartsUseages() {
        
    }

}
