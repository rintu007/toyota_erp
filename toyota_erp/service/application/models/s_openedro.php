<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_openedro extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // get All Opened ROs
    function getOpenedRODetail() {
        $this->db->select('*');
        $this->db->from('viewroupdate vr');
        $this->db->where('vr.Status = "open"');
        $this->db->where('vr.isActive', 0);
        $this->db->or_where('vr.isCancel', 0);
        $this->db->group_by('vr.idRO');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    function searchOpenedRODetail($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('viewroupdate vr');
        $this->db->like('vr.RONumber', $SearchKeyword, 'after');
        $this->db->where('vr.Status = "open"');
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idRO');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }  

	function searchOpenedRODetailDate($SearchKeyword) {
	//	echo $SearchKeyword;die;
        $this->db->select('*');
        $this->db->from('viewroupdate vr');
		if($SearchKeyword)
        $this->db->where('vr.BookingDate', $SearchKeyword);
        $this->db->where('vr.Status = "open"');
        $this->db->where('vr.isActive != 0');
        $this->db->group_by('vr.idRO');
        $rODetail = $this->db->get();
        return $rODetail->result_array();
    }

    function cancelRO($idRO) {
        $this->db->set('isCancel', 1);
        $this->db->where('idRepairOrderBill', $idRO);
        $this->db->update('s_repairorderbill');
        return "RO Canceled Successfully";
    }

}
