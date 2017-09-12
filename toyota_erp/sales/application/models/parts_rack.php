<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_rack extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allRack() {
        $this->db->select('*');
        $this->db->from('parts_rack');
        $this->db->join('parts_zone', 'parts_rack.ZoneId = parts_zone.idZone');
        $this->db->join('parts_row', 'parts_rack.RowId = parts_row.idRow');
        $this->db->join('parts_warehouse', 'parts_rack.WarehouseId = parts_warehouse.idWarehouse');
        $PartRack = $this->db->get();
        return $PartRack->result_array();
    }

    function oneRack($idRack) {
        $PartRack = $this->db->select('*')->from('parts_rack')->where('idRack', $idRack)->get();
        return $PartRack->result_array();
    }

    function insertRack($RackData) {
        $this->db->insert('parts_rack', $RackData);
        $this->db->insert_id();
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

}
