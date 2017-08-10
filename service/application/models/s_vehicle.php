<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_vehicle extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertVehicle($vehicleData) {

        $this->db->insert('s_vehicle', $vehicleData);
        return "Successfully Inserted";
    }

    function UpdateVehicle($idVehicle, $vehicleData) {

        $this->db->where('idVehicle', $idVehicle);
        $this->db->update('s_vehicle', $vehicleData);
        return "Successfully Update";
    }

    function DeleteVehicle($idVehicle) {

        $this->db->set('isActive', 0);
        $this->db->where('idVehicle', $idVehicle);
        $this->db->update('s_vehicle');
        return "Successfully Deleted";
    }

    function searchVehicle($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_vehicle');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_vehicle.idDealer');
        $this->db->like('s_vehicle.VehicleName', $SearchKeyword);
        $this->db->where('s_vehicle.isActive != 0');
        $searchVehicle = $this->db->get();
        return $searchVehicle->result_array();
    }

    function selectOneVehicle() {

        $this->db->select('idVehicle');
        $this->db->from('s_vehicle');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idVehicle = $this->db->get();
        if ($idVehicle->num_rows() > 0) {
            $row = $idVehicle->row();
            $idVehicle = $row->idVehicle;
            return $idVehicle;
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

    function getAllVehicles() {

        $this->db->select('*');
        $this->db->from('s_vehicle');
        $this->db->join('car_dealer_type', 'car_dealer_type.IdDealer = s_vehicle.idDealer');
        $this->db->where('s_vehicle.isActive != 0');
        $baysList = $this->db->get();
        return $baysList->result_array();
    }

    function isExistVehicle($idVariant, $regNumber) {


        $whereClause = "idVariant = '$idVariant' AND RegistrationNumber = '$regNumber' AND isActive = 1";
        $this->db->select('*');
        $this->db->from('s_vehicle');
        $this->db->where($whereClause);
        $this->db->limit(1);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            $row = $isExist->row();
            $isExist = $row->idVehicle;
            return $isExist;
        }
    }

    function selectAllVehicles() {
        
    }

}
