<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_estimatebodyshop extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertEstimateBodyShop($estimateData) {

        $this->db->insert('s_estimate', $estimateData);
        return "Estimate Created with Estimate-No ";
    }
	
	function UpdateEstimateBodyShop($estimateData,$SNo) {

	    $this->db->where('SerialNumber',$SNo);
        $this->db->insert('s_estimate', $estimateData);
        return "Estimate Updated";
    }


    function getSerialNumber() {

        $where = "isMechanical = 0";
        $this->db->select('SerialNumber');
        $this->db->from('s_estimate');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $serialNumber = $this->db->get();
        if ($serialNumber->num_rows() > 0) {
            $row = $serialNumber->row();
            $serialNumber = $row->SerialNumber;
            return $serialNumber + 1;
        } else {
            return "1";
        }
    }

    function getIdEstimateBodyShop() {

        $where = "isMechanical = 0";
        $this->db->select('idEstimate');
        $this->db->from('s_estimate');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idEstimate = $this->db->get();
        if ($idEstimate->num_rows() > 0) {
            $row = $idEstimate->row();
            $idEstimate = $row->idEstimate;
            return $idEstimate;
        }
    }

    function getPartDetails($idPart) {

        $this->db->select('*');
        $this->db->from('viewparts');
        $this->db->where('idPart', $idPart);
        $getPartDetails = $this->db->get();
        return $getPartDetails->result_array();
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
	
	public function delete_estimatejob($SNo)
	{
		
	   $this->db->select('idEstimate');
       $this->db->where('SerialNumber',$SNo);
	   $this->db->where('isMechanical',0);
       $result  =  $this->db->get('s_estimate')->row_array();	   
	   $this->db->where('idEstimate', $result['idEstimate']);
       $this->db->delete('s_estimate_jobdescription');
	}
	
	public function delete_estimatepart($SNo)
	{
	   $this->db->select('idEstimate');
       $this->db->where('SerialNumber',$SNo);
	   $this->db->where('isMechanical',0);
       $result  =  $this->db->get('s_estimate')->row_array();	   
	   $this->db->where('idEstimate', $result['idEstimate']);
       $this->db->delete('s_estimate_partsdescription'); 
	}
	
	public function delete_estimatesublet($SNo)
	{
	   $this->db->select('idEstimate');
       $this->db->where('SerialNumber',$SNo);
	   $this->db->where('isMechanical',0);
       $result  =  $this->db->get('s_estimate')->row_array();	   
	   $this->db->where('idEstimate', $result['idEstimate']);
       $this->db->delete('s_estimatesubletrepairuseage'); 
	}
	
	public function get_idestimate($SNo)
	{
	   $this->db->select('idEstimate');
       $this->db->where('SerialNumber',$SNo);
	   $this->db->where('isMechanical',0);
       $result  =  $this->db->get('s_estimate')->row_array();
	   return $result['idEstimate'];
	}


}
