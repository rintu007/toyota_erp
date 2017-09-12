<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_zone extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allZone() {
        $this->db->select('*');
        $this->db->from('parts_zone');
        $this->db->join('parts_warehouse', 'parts_zone.WarehouseId = parts_warehouse.idWarehouse');
        $PartZone = $this->db->get();
        return $PartZone->result_array();
    }

    function oneZone($idZone) {
        $PartZone = $this->db->select('*')->from('parts_zone')->where('idZone', $idZone)->get();
        return $PartZone->result_array();
    }

    function insertZone($ZoneData) {
        $InsertZone = $this->db->insert('parts_zone', $ZoneData);
        if ($InsertZone) {
            return "Successfully Inserted";
        } else {
            return "Failed";
        }
        $this->db->insert_id();
    }

    function deleteZone($idZone) {
        $this->db->where('idZone', $idZone);
        $this->db->delete('parts_zone');
    }

    function searchZone($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('parts_zone');
        $this->db->join('parts_warehouse', 'parts_zone.WarehouseId = parts_warehouse.idWarehouse');
        $this->db->like('parts_zone.ZoneName', $SearchKeyword);
        $this->db->or_like('parts_warehouse.Name', $SearchKeyword);
        $SearchZone = $this->db->get();
        return $SearchZone->result_array();
    }

    function fillWarehouseCombo() {
        $query = $this->db->query('select distinct idWarehouse, Name from parts_warehouse');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idWarehouse" => $dropdown->idWarehouse, "Name" => $dropdown->Name]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

}
