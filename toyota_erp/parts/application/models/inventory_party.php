<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inventory_party extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allParties() {
        $this->db->select('*');
        $this->db->from('inventory_party');
		$this->db->where('Type','Party');
        $InventoryParty = $this->db->get();
        return $InventoryParty->result_array();
    }

    function oneZone($idParty) {
        $InventoryParty = $this->db->select('*')->from('inventory_party')->where('idParty', $idParty)->get();
        return $InventoryParty->result_array();
    }

    function insertParty($PartyData) {
        $InsertParty = $this->db->insert('inventory_party', $PartyData);
        if ($InsertParty) {
            return TRUE;
        } else {
            return FALSE;
        }
        $this->db->insert_id();
    }

    function updateParty($idParty, $PartyData) {
        $this->db->where('idParty', $idParty);
        $UpdateParty = $this->db->update('inventory_party', $PartyData);
        if ($UpdateParty) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleteParty($idParty) {
        $this->db->where('idParty', $idParty);
        $this->db->delete('inventory_party');
    }

    function searchParty($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('inventory_party');
        $this->db->like('inventory_party.Name', $SearchKeyword);
        $SearchParty = $this->db->get();
        return $SearchParty->result_array();
    }

    function fillPartyCombo() {
        $query = $this->db->query("select idParty, Name from inventory_party where Type='Party'");
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idParty" => $dropdown->idParty, "Name" => $dropdown->Name]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

}
