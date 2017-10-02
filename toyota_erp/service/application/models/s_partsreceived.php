<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_partsreceived extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getAllReceivedParts() {
        $this->db->select('*');
        $this->db->from('viewpartsrecdetail vr');
        $this->db->where('vr.PartsReceived', 0);
        $allPartsReceived = $this->db->get();
        return $allPartsReceived->result_array();
    }

   /* function getReceivedParts($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('viewpartsrecdetail vr');
        $this->db->like('vr.RONumber', $SearchKeyword);
        $this->db->where('vr.PartsReceived', 0);
        $partsReceived = $this->db->get();
        return $partsReceived->result_array();
    } */
	
	function getReceivedParts($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('view_partrecieve vr');
        $this->db->like('vr.RONumber', $SearchKeyword);
        $this->db->where('vr.isReceived', 0);
		$this->db->where('vr.isDispatched', 1);
        $partsReceived = $this->db->get();
        return $partsReceived->result_array();
    }

    function updatePartsReceived() {
       $idPartReceived = $_POST['idpartsrec'];
        for ($i = 0; $i < count($_POST['idpartsrec']); $i++) {
//            $isReceived = array(
//                'isReceived' => 1,
//                'ReceivedDate' => date('Y-m-d H:i:s'),
//                'ModifiedDate' => date('Y-m-d H:i:s')
//            );
            $data = array(
               "idPartsReqInfo"     =>$_POST['idPartsReqInfo'][$i],
               "DispatchedQuantity" =>$_POST['requestquantity'][$i],
              // "DispatchedDate"     =>$_POST['DispatchedDate'],
              // "ReceivedDate"       =>$_POST['ReceivedDate'],
               "isReceived"         =>1,
               "CreatedDate"        => date("Y-m-d H:i:s"),
               "ModifiedDate"       => date("Y-m-d H:i:s"),
               "isActive"           =>1,
               "RemainingQuantity"  =>0,
//               "manual" =>$_POST['manual']
            );
//            $this->db->where('idPartsReceivedInfo', $idPartReceived[$i]);
            $update = $this->db->insert('s_partsreceivedinfo', $data);
        }
      /*  if ($update) {
            return TRUE;
        } else {
            return FALSE;
        } */
		
		$idPartReceived = $_POST['idpartsrec'];
        for ($i = 0; $i < count($_POST['idpartsrec']); $i++) {
            $isReceived = array(
                'isReceived' => 1,
                
            );
            $this->db->where('idPartsRequisition', $idPartReceived[$i]);
            $update = $this->db->update('s_partsreq_partsinfo', $isReceived);
        }
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        } 
		
    }

    function fillPartCombo() {
        $query = $this->db->query('select idPart, PartNumber,PartName from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber, "PartName" => $dropdown->PartName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function Update() {
        
    }

    function Delete() {
        
    }

    function search() {
        
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

}
