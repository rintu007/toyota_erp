<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_bays extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function AllBays() {
        $this->db->select('*');
        $this->db->from('s_bay');
        $this->db->where('isActive', 1);
        $BaysList = $this->db->get();
        $colorCombo = $BaysList->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["key" => $dropdown->idBay, "label" => $dropdown->BayName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function getAll() {
        $this->db->select('idBay as id,s_bay.*');
        $this->db->from('s_bay');
        $this->db->where('isActive', 1);
        $BaysList = $this->db->get()->result_array();
        return $BaysList;

    }

    function InsertBay($bayData) {

        $this->db->insert('s_bay', $bayData);
        return "Successfully Inserted";
    }

    function UpdateBay($idBay, $bayData) {

        $this->db->where('idBay', $idBay);
        $this->db->update('s_bay', $bayData);
        return "Successfully Updated";
    }

    function DeleteBay($idBay) {

        $this->db->set('isActive', 0);
        $this->db->where('idBay', $idBay);
        $this->db->update('s_bay');
        return "Successfully Deleted";
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
	function getAllshopwise(){
		$query = $this->db->query('select * from car_shop_wise');
		$queryResult = $query->result();
		$querResultList = array();
		foreach($queryResult as $Key){
			array_push($querResultList,["idShopwise" => $Key->idShopwise, "ShopName" => $Key->Typename]);
		}
		$shopList = $querResultList;
		return $shopList;
	}

    function getAllBays() {

        $this->db->select('*');
        $this->db->from('s_bay');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_bay.idDealer');
		$this->db->join('car_shop_wise', 'car_shop_wise.idShopwise = s_bay.idShopwise');
        $this->db->where('s_bay.isActive != 0');
        $baysList = $this->db->get();
        return $baysList->result_array();
    }

    function searchBay($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_bay');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_bay.idDealer');
        $this->db->like('s_bay.BayName', $SearchKeyword);
        $this->db->where('s_bay.isActive != 0');
        $searchBay = $this->db->get();
        return $searchBay->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
