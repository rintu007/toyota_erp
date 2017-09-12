<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_bin extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allRack() {
        $this->db->select('*');
        $this->db->from('parts_rack');
        $this->db->join('parts_zone', 'parts_rack.ZoneId = parts_zone.idZone');
        $this->db->join('rows_parts', 'parts_rack.RowId = rows_parts.id');
        $this->db->join('parts_warehouse', 'parts_rack.WarehouseId = parts_warehouse.idWarehouse');
        $PartRack = $this->db->get();
        return $PartRack->result_array();
    }

    function oneRack($idRack) {
        $PartRack = $this->db->select('*')->from('parts_rack')->where('idRack', $idRack)->get();
        return $PartRack->result_array();
    }

    function insertRack($RackData) {
        $InsertRack = $this->db->insert('parts_rack', $RackData);
        if ($InsertRack) {
            return "Successfully Inserted";
        } else {
            return "Failed";
        }
        $this->db->insert_id();
    }

    function updateRack($RackData, $idRack) {
        $this->db->where('idRack', $idRack);
        $this->db->update('parts_rack', $RackData);
    }

    function deleteRack($idRack) {
        $this->db->where('idRack', $idRack);
        $this->db->delete('parts_rack');
    }

    function searchRack($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('parts_rack');
        $this->db->join('parts_zone', 'parts_rack.ZoneId = parts_zone.idZone');
        $this->db->join('parts_row', 'parts_rack.RowId = parts_row.idRow');
        $this->db->join('parts_warehouse', 'parts_rack.WarehouseId = parts_warehouse.idWarehouse');
        $this->db->like('parts_zone.ZoneName', $SearchKeyword);
        $this->db->like('parts_rack.RackNumber', $SearchKeyword);
        $SearchInventory = $this->db->get();
        return $SearchInventory->result_array();
    }

    function fillZoneCombo() {
        $query = $this->db->query('select distinct idZone, ZoneName from parts_zone');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idZone" => $dropdown->idZone, "ZoneName" => $dropdown->ZoneName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillRowCombo() {
        $query = $this->db->query('select distinct idRow, `To`, `From` from parts_row');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idRow" => $dropdown->idRow, "ToFrom" => $dropdown->To . " - " . $dropdown->From]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
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

    function fillZoneByWarehouse($WarehouseId) {
        $query = $this->db->query('SELECT parts_zone.idZone, parts_zone.ZoneName FROM parts_zone
                            INNER JOIN parts_warehouse ON parts_zone.WarehouseId = parts_warehouse.idWarehouse
                            WHERE parts_zone.WarehouseId = ' . $WarehouseId);
        $dropdowns = $query->result();
        return $dropdowns;
    }

    function fillRowByZone($ZoneId) {
        $query = $this->db->query('SELECT rows_parts.id, rows_parts.RowNumber FROM
                            rows_parts
                            INNER JOIN parts_warehouse ON rows_parts.WarehouseId = parts_warehouse.idWarehouse
                            INNER JOIN parts_zone ON parts_zone.WarehouseId = parts_warehouse.idWarehouse AND rows_parts.ZoneId = parts_zone.idZone
                            WHERE rows_parts.ZoneId = ' . $ZoneId);
        $dropdowns = $query->result();
        return $dropdowns;
    }

}
