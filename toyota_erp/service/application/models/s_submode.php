<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class s_submode extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function Insertsubmode($submodeData) {

        $this->db->insert('s_submode', $submodeData);
        return "Successfully Inserted";
    }

    function Updatesubmode($idsubmode, $submodeData) {

        $this->db->where('idSubMode', $idsubmode);
        $this->db->update('s_submode', $submodeData);
        return "Successfully Updated";
    }

    function Deletesubmode($idSubMode) {

        $this->db->set('isActive', 0);
        $this->db->where('idSubMode', $idSubMode);
        $this->db->update('s_submode');
        return "Successfully Deleted";
    }

    function getAllSubROMode() {

        $this->db->select('*');
        $this->db->from('s_submode');
		$this->db->join('s_romode','s_submode.idROMode = s_romode.idROMode','Left');
        $this->db->where('s_submode.isActive != 0');
        $SubModeList = $this->db->get();
        return $SubModeList->result_array();
    }
	function getAllROMode(){
		$this->db->select('*');
		$this->db->from('s_romode');
		$this->db->where('s_romode.isActive !=0');
		$modeList = $this->db->get();
		return $modeList->result_array();
	}

    function isExist($data) {
        $this->db->select('*');
        $this->db->from('s_submode');
        $this->db->like('s_submode.SubModeName', $data['SubModeName'] AND 's_submode.SubModeName', $data['SubModeName']);
        $this->db->where('s_submode.isActive != 0');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $row = $result->row();
            $result = $row->SubModeName;
            return $result;
        }
    }

    function searchROMode($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_submode');
        $this->db->like('s_submode.ModeName', $SearchKeyword);
        $this->db->where('s_submode.isActive != 0');
        $searchROMode = $this->db->get();
        return $searchROMode->result_array();
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}