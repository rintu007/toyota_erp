<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_name extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allParts() {
        $PartName = $this->db->select('*')->from('parts_name')->get();
        return $PartName->result_array();
    }

    function onePart($idPart) {
        $PartName = $this->db->select('*')->from('parts_name')->where('idPart', $idPart)->get();
        return $PartName->result_array();
    }

    function insertParts($PartData) {
        $this->db->insert('parts_name', $PartData);
        $this->db->insert_id();
    }

    function updateParts($idPart, $PartData) {
        $this->db->where('idPart', $idPart);
        $this->db->update('parts_name', $PartData);
    }

    function deleteParts($idPart) {
        $this->db->where('idPart', $idPart);
        $this->db->delete('parts_name');
    }

    function searchPart($searchKeyword) {
        $PartName = $this->db->select('*')->from('parts_name')->like('idPart', $searchKeyword)->
                        like('PartName', $searchKeyword)->get();
        return $PartName->result_array();
    }

}
