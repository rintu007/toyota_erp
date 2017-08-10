<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_superceed extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allSuperceeds() {
        $this->db->select('*');
        $this->db->from('parts_superceed');
        $this->db->join('parts_name', 'parts_superceed.OldPart= parts_name.idPart');
        $PartRack = $this->db->get();
        return $PartRack->result_array();
    }

    function oneSuperceed($idSuperceed) {
        $PartRack = $this->db->select('*')->from('parts_superceed')->where('idSuperceed', $idSuperceed)->get();
        return $PartRack->result_array();
    }

    function insertSuperceed($SuperceedData) {
        $InsertSuperceed = $this->db->insert('parts_superceed', $SuperceedData);
        if ($InsertSuperceed) {
            return "Successfully Inserted";
        } else {
            return "Failed";
        }
        $this->db->insert_id();
    }

    function deleteSuperceed($idSuperceed) {
        $this->db->where('idSuperceed', $idSuperceed);
        $this->db->delete('parts_superceed');
    }

    function searchSuperceed($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('parts_superceed');
        $this->db->join('parts_name', 'parts_superceed.OldPart= parts_name.idPart');
        $this->db->like('parts_superceed.SuperceedPart', $SearchKeyword);
        $this->db->or_like('parts_superceed.OldPart', $SearchKeyword);
        $SearchSuperceed = $this->db->get();
        return $SearchSuperceed->result_array();
    }

    function fillPartCombo() {
        $query = $this->db->query('select distinct idPart, PartNumber from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

}
