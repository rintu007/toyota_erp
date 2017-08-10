<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_luboiluseage extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertLubOilUseage($lubUseageData) {

        $this->db->insert('s_luboiluseage', $lubUseageData);
        return "Successfully Inserted";
    }

    function UpdateLubOilUseage($idLubOilUseage, $lubUseageData) {

        $this->db->where('idLubOilUseage', $idLubOilUseage);
        $this->db->update('s_luboiluseage', $lubUseageData);
        return "Successfully Updated";
    }

    function DeleteLubOilUseage($idLubOilUseage) {

        $this->db->set('isActive', 0);
        $this->db->where('idLubOilUseage', $idLubOilUseage);
        $this->db->update('s_luboiluseage');
        return "Successfully Deleted";
    }

    function searchLubOilUseage($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_luboiluseage');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_luboiluseage.idDealer');
        $this->db->like('s_luboiluseage.LubOilUseageName', $SearchKeyword);
        $this->db->where('s_luboiluseage.isActive != 0');
        $searchLubOilUseage = $this->db->get();
        return $searchLubOilUseage->result_array();
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

    function getAllLubOilUseages() {

        $this->db->select('*');
        $this->db->from('s_luboiluseage');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_luboiluseage.idDealer');
        $this->db->where('s_luboiluseage.isActive != 0');
        $baysList = $this->db->get();
        return $baysList->result_array();
    }

    function selectOneLubOilUseage() {

        $this->db->select('idLubOilUseage');
        $this->db->from('s_luboiluseage');
        $this->db->order_by("CreatedDate", "desc");
        $idLubOilUseage = $this->db->get();
        if ($idLubOilUseage->num_rows() > 0) {
            $row = $idLubOilUseage->row();
            $idLubOilUseage = $row->idLubOilUseage;
            return $idLubOilUseage;
        }
    }

    function selectAllLubOilUseages() {
        
    }

}
