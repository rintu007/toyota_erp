<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_periodicmaintenancedetails extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertPmd($pmdData) {

        $this->db->insert('s_periodicmaintenancedetail', $pmdData);
        return "Successfully Inserted";
    }

    function UpdatePmd($idPmd, $pmdData) {

        $this->db->where('idPeriodicMaintenanceDetail', $idPmd);
        $this->db->update('s_periodicmaintenancedetail', $pmdData);
        return "Successfully Updated";
    }

    function DeletePmd($idPmd) {

        $this->db->set('isActive', 0);
        $this->db->where('idPeriodicMaintenanceDetail', $idPmd);
        $this->db->update('s_periodicmaintenancedetail');
        return "Successfully Deleted";
    }

    function searchPmd($SearchKeyword) {

        $this->db->select('pmd.idPeriodicMaintenanceDetail,pm.PeriodName,GROUP_CONCAT(jobref.JobTask) AS JobTask,pmd.Amount,pmd.RangeOneAmount,pmd.RangeTwoAmount,pmd.RangeThreeAmount');
        $this->db->from('s_periodicmaintenancedetail pmd');
        $this->db->join('s_periodicmaintenance pm', 'pm.idPeriodicMaintenance = pmd.idPeriodicMaintenance');
        $this->db->join('s_periodicdetail_jobs jobs', 'jobs.idPeriodicMaintenanceDetail = pmd.idPeriodicMaintenanceDetail');
        $this->db->join('s_jobreferencemanual jobref', 'jobref.idJobRef = jobs.idJobRef');
        $this->db->like('pm.PeriodName', $SearchKeyword);
        $this->db->where('pmd.isActive', 1);
        $this->db->group_by('pmd.idPeriodicMaintenanceDetail');
        $searchPmd = $this->db->get();
        return $searchPmd->result_array();
    }

    function getAllPm() {
        $query = $this->db->query('select * from s_periodicmaintenance where isActive != 0');
        $querResult = $query->result();
        $queryResultList = array();
        foreach ($querResult as $key) {
            array_push($queryResultList, ["IdPM" => $key->idPeriodicMaintenance, "PeriodName" => $key->PeriodName]);
        }
        $pmList = $queryResultList;
        return $pmList;
    }

    function getAllJrm() {
        $query = $this->db->query('select * from s_jobreferencemanual where isActive != 0');
        $querResult = $query->result();
        $queryResultList = array();
        foreach ($querResult as $key) {
            array_push($queryResultList, ["IdJobRef" => $key->idJobRef, "JobTask" => $key->JobTask]);
        }
        $jrmList = $queryResultList;
        return $jrmList;
    }

    function getAllPmd() {

//        $this->db->select('pmd.idPeriodicMaintenanceDetail,pm.PeriodName,GROUP_CONCAT(jobref.JobTask) AS JobTask,pmd.Amount');
        $this->db->select('pmd.idPeriodicMaintenanceDetail,pm.PeriodName,GROUP_CONCAT(jobref.JobTask) AS JobTask,pmd.Amount,pmd.RangeOneAmount,pmd.RangeTwoAmount,pmd.RangeThreeAmount');
        $this->db->from('s_periodicmaintenancedetail pmd');
        $this->db->join('s_periodicmaintenance pm', 'pm.idPeriodicMaintenance = pmd.idPeriodicMaintenance');
        $this->db->join('s_periodicdetail_jobs jobs', 'jobs.idPeriodicMaintenanceDetail = pmd.idPeriodicMaintenanceDetail');
        $this->db->join('s_jobreferencemanual jobref', 'jobref.idJobRef = jobs.idJobRef');
        $this->db->group_by('pmd.idPeriodicMaintenanceDetail');
        $this->db->where('pmd.isActive', 1);
        $pmdList = $this->db->get();
        return $pmdList->result_array();   
		
		
    }

    function getFilteredPmd($idPmd) {

        $this->db->select('pmd.idPeriodicMaintenanceDetail,pm.PeriodName,jobref.idJobRef,jobref.JobTask AS JobTask,pmd.Amount,pmd.RangeOneAmount,pmd.RangeTwoAmount,pmd.RangeThreeAmount');
        $this->db->from('s_periodicmaintenancedetail pmd');
        $this->db->join('s_periodicmaintenance pm', 'pm.idPeriodicMaintenance = pmd.idPeriodicMaintenance');
        $this->db->join('s_periodicdetail_jobs jobs', 'jobs.idPeriodicMaintenanceDetail = pmd.idPeriodicMaintenanceDetail');
        $this->db->join('s_jobreferencemanual jobref', 'jobref.idJobRef = jobs.idJobRef');
        $this->db->where('pmd.idPeriodicMaintenanceDetail', $idPmd);
        $this->db->where('pmd.isActive', 1);
        $pmdList = $this->db->get();
        return $pmdList->result_array();
    }

    function getIdPmd() {

        $this->db->select('idPeriodicMaintenanceDetail');
        $this->db->from('s_periodicmaintenancedetail');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idPmd = $this->db->get();
        if ($idPmd->num_rows() > 0) {
            $row = $idPmd->row();
            $idPmd = $row->idPeriodicMaintenanceDetail;
            return $idPmd;
        }
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }
	
	public function getamount($id , $range)
	{
		$this->db->select($range);
		$this->db->where('idPeriodicMaintenanceDetail' , $id);
		$result =  $this->db->get('s_periodicmaintenancedetail')->row_array();
		return $result[$range];
	}

}
