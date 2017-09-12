<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_rodetail extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertTotalCostData($data) {

        $insert = $this->db->insert('s_bodypaint_totalcost', $data);
        return $insert;
    }

    function UpdateRO($idRO, $data) {

        $this->db->where('idRepairOrderBill', $idRO);
        $this->db->update('s_repairorderbill', $data);
        return "Successfully Updated";
    }

    function roDetail($searchKeyword) {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->where('vr.RONumber', $searchKeyword);
        $this->db->where('vr.Status', 'open');
        $this->db->where('vr.isAmountDue', 0);
        $this->db->where('vr.isActive != 0');
        $data = $this->db->get();
        $data = $data->result_array();
		if(count($data) > 0){
		
			if($data[0]['isMechanical'] == '0'){
					if($data[0]['EstimateNo']){
		$data[0]['Jobs'] 		= $this->db->query("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(s_estimate_jobdescription.JobDescription, '||', 1), ' ', -15)as JobTask
,SUBSTRING_INDEX(SUBSTRING_INDEX(s_estimate_jobdescription.JobDescription, '||', 2), '||', -1) as RangeAmount
FROM
	s_estimate_jobdescription
INNER JOIN s_estimate ON s_estimate_jobdescription.idEstimate = s_estimate.idEstimate


 WHERE s_estimate.SerialNumber = ".$data[0]['EstimateNo']." AND isMechanical = ".$data[0]['isMechanical']." ")->result_array();
				
				}else{
				
					$data[0]['Jobs'] 	= array();	
					}	

					
		}else{
				
				
		$data[0]['Jobs'] 		= $this->db->query("SELECT
		s_jobreferencemanual.JobTask,
	s_job.idJobRef,

IF (
	viewrodetail.`Ranges` = 'RangeOneAmount',
	RangeOneAmount,

IF (
	viewrodetail.`Ranges` = 'RangeTwoAmount',
	RangeTwoAmount,
	RangeThreeAmount
)
) AS RangeAmount
FROM
	viewrodetail
INNER JOIN s_jobprogresssheet ON viewrodetail.idRO = s_jobprogresssheet.idRepairOrderBill
INNER JOIN s_job ON s_jobprogresssheet.idJobProgressSheet = s_job.idJobProgressSheet
INNER JOIN s_jobreferencemanual ON s_job.idJobRef = s_jobreferencemanual.idJobRef
WHERE
	viewrodetail.RONumber =".$searchKeyword)->result_array();
		if($data[0]['idRoPmd'] != 'None'){
					$d = $this->db->query('select * from s_periodicmaintenancedetail where idPeriodicMaintenanceDetail = '.$data[0]['idRoPmd'])->result_array();
						$data[0]['ZPM_amountt'] = $d[0][$data[0]['Ranges']];
		} 
			}
			
	//	$data[0]['Parts'] 		= $this->db->query("Select s_estimate_partsdescription.idPart,viewparts.RetailPrice,viewparts.PartNumber from s_estimate_partsdescription INNER JOIN s_estimate on s_estimate_partsdescription.idEstimate = s_estimate.idEstimate INNER JOIN viewparts on s_estimate_partsdescription.idPart = viewparts.idPart  Where s_estimate.SerialNumber = ".$searchKeyword)->result_array();
		if($data[0]['EstimateNo']){
	$data[0]['Sublet'] 		= $this->db->query("Select s_estimatesubletrepairuseage.* from s_estimatesubletrepairuseage INNER JOIN s_estimate on s_estimatesubletrepairuseage.idEstimate = s_estimate.idEstimate Where s_estimate.SerialNumber = ".$data[0]['EstimateNo']." AND isMechanical = ".$data[0]['isMechanical'])->result_array();
		}else{
		$data[0]['Sublet'] 	= array();	
		}
		}
        return $data;
    }

    function getro_cunsumersubletDetail($searchKeyword) {

        $this->db->select('*');
        $this->db->from('s_subletrepairuseage vr');
        $this->db->where('vr.idRepairOrderBill', $searchKeyword);

        $this->db->where('vr.isActive != 0');
        $data = $this->db->get();
       
        return $data->result_array();
    }

    function getro_workDetail($searchKeyword) {

        $this->db->select('*');
        $this->db->from('s_ro_workperformed vr');
        $this->db->where('vr.idRepairOrderBill', $searchKeyword);

        $this->db->where('vr.isActive != 0');
        $data = $this->db->get();
        return $data->result_array();
    }

    function roDetailparts($searchKeyword) {

        $data = $this->db->query('SELECT
s_partsrequisition.SerialNumber,
s_partsrequisition.idRepairOrderBill,
s_partsrequisition.idPartsRequisition,
s_partsrequisition.ServiceAdvisor
FROM
s_partsrequisition
WHERE
s_partsrequisition.idRepairOrderBill = ' . $searchKeyword);
//      print_r($searchKeyword);
        $result = $data->result_array();
//        print_r($result);
        if (!empty($result)) {
          //  echo 'a';
            $data2 = $this->db->query('SELECT
s_partsreq_partsinfo.idPartsReqInfo,
s_partsreq_partsinfo.idPart,
s_partsreq_partsinfo.PartQuantity,
parts_inventory.RetailPrice As PartAmount,
s_partsreq_partsinfo.isDispatched,
s_partsreq_partsinfo.CreatedDate,
parts_name.PartName,
s_partsreceivedinfo.manual
FROM
s_partsreq_partsinfo
INNER JOIN parts_inventory on parts_inventory.PartId = s_partsreq_partsinfo.idPart
INNER JOIN parts_name on s_partsreq_partsinfo.idPart = parts_name.idPart
inner join s_partsreceivedinfo on s_partsreceivedinfo.idPartsReqInfo=s_partsreq_partsinfo.idPartsReqInfo
WHERE
s_partsreq_partsinfo.idPartsRequisition = ' . $result[0]['idPartsRequisition']);
            $result2 = $data2->result_array();


            for ($i = 0; $i < count($result2); $i++) {
                $result2[$i]['signature'] = $result[0]['ServiceAdvisor'];
                $result2[$i]['invoice'] = $result[0]['SerialNumber'];
            }
            return $result2;
        }
    }

    function getReceivedParts($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('viewpartsrecdetail vr');
        $this->db->where('vr.RONumber', $SearchKeyword);
        $this->db->where('vr.PartsReceived', 1);
        $partsReceived = $this->db->get();
        return $partsReceived->result_array();
    }

    function getRequestedParts($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('viewpartsreqdetail vr');
        $this->db->where('vr.RONumber', $SearchKeyword);
        $this->db->where('vr.PartRequested', 1);
        $partsRequested = $this->db->get();
        return $partsRequested->result_array();
    }

}
