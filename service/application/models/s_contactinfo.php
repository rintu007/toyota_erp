<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_contactinfo extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertContactInfo($contactInfoData) {

        $this->db->insert('s_contactinfo', $contactInfoData);
        return "Successfully Inserted";
    }

    function UpdateContactInfo($idContactInfo, $contactInfoData) {

        $this->db->where('idContactInfo', $idContactInfo);
        $this->db->update('s_contactinfo', $contactInfoData);
        return "Successfully Updated";
    }

    function DeleteContactInfo($idContactInfo) {

        $this->db->set('isActive', 0);
        $this->db->where('idContactInfo', $idContactInfo);
        $this->db->update('s_contactinfo');
        return "Successfully Deleted";
    }

    function getContactInfo() {

        $this->db->select('*');
        $this->db->from('s_contactinfo');
        $this->db->where('s_contactinfo.isActive != 0');
        $contactInfoList = $this->db->get();
        return $contactInfoList->result_array();
    }

    function searchContactInfo($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_contactinfo');
        $this->db->like('s_contactinfo.Name', $SearchKeyword);
        $this->db->where('s_contactinfo.isActive != 0');
        $searchContact = $this->db->get();
        return $searchContact->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
