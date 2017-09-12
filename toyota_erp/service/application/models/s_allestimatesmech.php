<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_allestimatesmech extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertEstimateMechanical($estimateData) {

        $this->db->insert('s_estimate', $estimateData);
        return "Estimate Created";
    }

    function getSerialNumber() {

        $where = "isMechanical = 1";
        $this->db->select('SerialNumber');
        $this->db->from('s_estimate');
        $this->db->where($where);
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $serialNumber = $this->db->get();
        if ($serialNumber->num_rows() > 0) {
            $row = $serialNumber->row();
            $serialNumber = $row->SerialNumber;
            return $serialNumber;
        }
    }

    function getIdEstimateMechanical() {

        $where = "isMechanical = 1";
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

    function Update() {
        
    }

    function Delete() {
        
    }

    function search() {
        
    } 
	
	
	function selectSubletbyEsitmateNo($searchKeyword) {
        $data		= $this->db->query("Select s_estimatesubletrepairuseage.* from s_estimatesubletrepairuseage INNER JOIN s_estimate on s_estimatesubletrepairuseage.idEstimate = s_estimate.idEstimate Where s_estimate.SerialNumber = ".$searchKeyword)->result_array();
return $data;   
   }
 function selectOneMechEstimateJobs($SearchKeyword) {

        $this->db->select('idJob');
        $this->db->from('s_estimate_jobdescription');
		 $this->db->join('s_estimate', 's_estimate.idEstimate = s_estimate_jobdescription.idEstimate');
        $this->db->where('s_estimate.SerialNumber', $SearchKeyword);
       $this->db->where('s_estimate.isMechanical', 1);
      
        $oneEstimate = $this->db->get();
        return $oneEstimate->result_array();
 }
    function selectOneMechEstimate($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('viewestimatedetail v');
        $this->db->where('v.SerialNumber', $SearchKeyword);
        $this->db->where('v.isMechanical', 1);
        $this->db->group_by('v.idEstimate');
        $oneEstimate = $this->db->get();
        return $oneEstimate->result_array();


//        $this->db->select('m.idEstimate AS idEstimate,m.SerialNumber AS SerialNumber,c.CustomerName AS CustomerName,c.Cellphone AS Cellphone,av.Variant AS VehicleName,GROUP_CONCAT(jobs.idJobRef) AS idJobRef,GROUP_CONCAT(jobs.JobTask) AS Jobs,GROUP_CONCAT(jobs.RangeOneAmount) AS RangeOneAmount,GROUP_CONCAT(jobs.RangeTwoAmount) AS RangeTwoAmount,GROUP_CONCAT(jobs.RangeThreeAmount) AS RangeThreeAmount,Date As Date,staff.idStaff,staff.Name');
//        $this->db->select('m.idEstimate AS idEstimate,m.SerialNumber AS SerialNumber,m.Attender AS Attender,m.InsuranceCompany AS InsuranceCompany,m.PolicyNumber AS PolicyNumber,m.SurveyorName AS SurveyorName,m.SurveyorPhone AS SurveyorPhone,m.Branch AS Branch,m.LossNumber AS LossNumber,m.PMC AS PMC,m.ServiceAdvisor AS ServiceAdvisor,m.isMechanical AS isMechanical,'
//                . 'c.CompanyName AS CompanyName,c.CompanyContact AS CompanyContact,c.CustomerName AS CustomerName,c.Cellphone AS Cellphone,c.PhoneOne AS PhoneOne,c.PhoneTwo AS PhoneTwo,c.Cnic AS CNIC,c.Ntn AS NTN,c.AddressDetails AS AddressDetails,'
//                . 'av.Variant AS VehicleName,v.RegistrationNumber AS RegistrationNumber,v.Model AS Model,v.EngineNumber AS EngineNumber,v.ChassisNumber AS ChassisNumber,v.EstNumber AS EstNumber,v.Mileage AS Mileage,v.Year AS Year,v.isEstimate AS isEstimate,ab.idAllBrands AS idAllBrands,ab.BrandName AS BrandName,am.idAllModels AS idAllModels,am.ModelName'
//                . ',GROUP_CONCAT(jobs.idJobRef) AS idJobRef,GROUP_CONCAT(jobs.JobTask) AS Jobs,GROUP_CONCAT(jobs.RangeOneAmount) AS RangeOneAmount,GROUP_CONCAT(jobs.RangeTwoAmount) AS RangeTwoAmount,GROUP_CONCAT(jobs.RangeThreeAmount) AS RangeThreeAmount,m.Date As Date,staff.idStaff,staff.Name');
//        $this->db->from('s_estimate m');
//        $this->db->join('s_cutomerdetail c', 'c.idCustomer = m.idCustomerDetail');
//        $this->db->join('s_vehicle v', 'v.idVehicle = m.idVehicle');
//        $this->db->join('s_allvehicles av', 'av.idAllVehicles = v.idVariant');
//        $this->db->join('s_allbrands ab', 'ab.idAllBrands = av.idAllBrands');
//        $this->db->join('s_allmodels am', 'am.idAllBrands = ab.idAllBrands');
//        $this->db->join('s_staff staff', 'staff.idStaff = m.ServiceAdvisor');
//        $this->db->join('s_estimate_jobdescription j', 'j.idEstimate = m.idEstimate');
//        $this->db->join('s_jobreferencemanual jobs', 'jobs.idJobRef = j.idJob');
//        $this->db->where('m.SerialNumber', $SearchKeyword);
//        $this->db->where('m.isMechanical', 1);
//        $this->db->group_by('m.idEstimate');
//        $oneEstimate = $this->db->get();
//        return $oneEstimate->result_array();
    }

    function selectAllMechEstimates() {

        $this->db->select('m.is_PM ,m.PM_package,PM_amount ,m.idEstimate AS idEstimate,m.Range AS Rangee,m.SerialNumber AS SerialNumber,c.CustomerName AS CustomerName,c.Cellphone AS Cellphone,av.Variant AS VehicleName,GROUP_CONCAT(jobs.idJobRef) AS idJobRef,GROUP_CONCAT(jobs.JobTask) AS Jobs,GROUP_CONCAT(jobs.RangeOneAmount) AS RangeOneAmount,GROUP_CONCAT(jobs.RangeTwoAmount) AS RangeTwoAmount,GROUP_CONCAT(jobs.RangeThreeAmount) AS RangeThreeAmount,Date As Date,staff.idStaff,staff.Name');
        $this->db->from('s_estimate m');
        $this->db->join('s_cutomerdetail c', 'c.idCustomer = m.idCustomerDetail');
        $this->db->join('s_vehicle v', 'v.idVehicle = m.idVehicle');
        $this->db->join('s_allvehicles av', 'av.idAllVehicles = v.idVariant');
        $this->db->join('s_staff staff', 'staff.idStaff = m.ServiceAdvisor');
        $this->db->join('s_estimate_jobdescription j', 'j.idEstimate = m.idEstimate','left');
        $this->db->join('s_jobreferencemanual jobs', 'jobs.idJobRef = j.idJob','left');
        $this->db->where('m.isMechanical', 1);
        $this->db->where('m.isActive', 1);
        $this->db->group_by('m.idEstimate');
        $allEsitmates = $this->db->get();
        return $allEsitmates->result_array();
    }

    function selectbyEsitmateNo($estNo) {
        $this->db->select('m.PM_package,m.PM_amount,m.is_PM,m.Attender,c.AddressDetails,v.Mileage,v.EngineNumber,v.ChassisNumber,Ntn,Gst,c.CompanyName AS CompanyName,c.CustomerEmail AS CustomerEmail,c.CompanyContact AS CompanyContact,v.Model,v.year as YEAR ,m.idEstimate AS idEstimate,m.Range AS Rangee,m.SerialNumber AS SerialNumber,c.CustomerName AS CustomerName,c.Cellphone AS Cellphone,av.Variant AS VehicleName,v.RegistrationNumber AS RegistrationNumber,GROUP_CONCAT(jobs.idJobRef),GROUP_CONCAT(jobs.JobTask) AS Jobs,GROUP_CONCAT(jobs.RangeOneAmount) AS RangeOneAmount,GROUP_CONCAT(jobs.RangeTwoAmount) AS RangeTwoAmount,GROUP_CONCAT(jobs.RangeThreeAmount) AS RangeThreeAmount,m.Date As Date,m.isMechanical AS isMechanical,staff.idStaff,staff.Name');
        $this->db->from('s_estimate m');
        $this->db->join('s_cutomerdetail c', 'c.idCustomer = m.idCustomerDetail');
        $this->db->join('s_vehicle v', 'v.idVehicle = m.idVehicle');
        $this->db->join('s_allvehicles av', 'av.idAllVehicles = v.idVariant');
        $this->db->join('s_staff staff', 'staff.idStaff = m.ServiceAdvisor');
     //   $this->db->join('s_periodicmaintenance', 's_periodicmaintenance.idPeriodicMaintenance = m.PM_package');
        $this->db->join('s_estimate_jobdescription j', 'j.idEstimate = m.idEstimate','left');
       // $this->db->join('s_estimate_partsdescription p', 'p.idEstimate = m.idEstimate','left');
      //  $this->db->join('parts_name parts', 'parts.idPart = p.idPart','left');
        //$this->db->join('viewestimatedetail ex', 'ex.idEstimate = m.idEstimate');
        $this->db->join('s_jobreferencemanual jobs', 'jobs.idJobRef = j.idJob','left');
        $this->db->where('m.SerialNumber', $estNo);
        $this->db->where('m.isMechanical', 1);
        $this->db->where('m.isActive', 1);
        $this->db->group_by('m.idEstimate');
        $allEsitmates = $this->db->get();
        return $allEsitmates->result_array();
    }

	function selectPartsbyEsitmateNo($estNo) {
        $this->db->select('parts.PartName,i.RetailPrice AS Price');
        $this->db->from('s_estimate_partsdescription p');
		$this->db->join('parts_name parts', 'p.idPart = parts.idPart');
		$this->db->join('s_estimate m', 'p.idEstimate = m.idEstimate');
		$this->db->join('parts_inventory i', 'i.PartId = parts.idPart');
        $this->db->where('m.SerialNumber', $estNo);
        $this->db->where('m.isMechanical', 1);
        $this->db->where('m.isActive', 1);
        //$this->db->group_by('m.idEstimate');
        $allEsitmates = $this->db->get();
        return $allEsitmates->result_array();
    }
	
	function selectPartsbyEsitmateNoTotal($estNo) {
        $this->db->select('SUM(i.RetailPrice) AS Price');
        $this->db->from('s_estimate_partsdescription p');
		$this->db->join('parts_name parts', 'p.idPart = parts.idPart');
		$this->db->join('s_estimate m', 'p.idEstimate = m.idEstimate');
		$this->db->join('parts_inventory i', 'i.PartId = parts.idPart');
        $this->db->where('m.idEstimate', $estNo);
        $this->db->where('m.isMechanical', 1);
        $this->db->where('m.isActive', 1);
        //$this->db->group_by('m.idEstimate');
        $allEsitmates = $this->db->get();
        
$result = $allEsitmates->result_array();
if($result){
	return $result[0]['Price'];
}else{
	return 0;
	
}
    }
	
	function selectSubletbyEsitmateNoTotal($searchKeyword) {
        $data	= $this->db->query("Select SUM(s_estimatesubletrepairuseage.SubletRepairAmount) As Amount from s_estimatesubletrepairuseage INNER JOIN s_estimate on s_estimatesubletrepairuseage.idEstimate = s_estimate.idEstimate Where s_estimate.idEstimate = ".$searchKeyword)->result_array();
//$result = $allEsitmates->result_array();
if($data){
	return $data[0]['Amount'];
}else{
	return 0;
	
}   
   }

}
