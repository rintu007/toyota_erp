<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_allestimatesbshop extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function InsertEstimateBodyShop($estimateData) {

        $this->db->insert('s_estimate', $estimateData);
        return "Estimate Created";
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
            return $serialNumber;
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

    function Update() {
        
    }

    function Delete() {
        
    }

    function search() {
        
    }

    function selectOneBShopEstimate($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('viewestimatedetail v');
        $this->db->where('v.SerialNumber', $SearchKeyword);
        $this->db->where('v.isMechanical', 0);
        $this->db->group_by('v.idEstimate');
        $oneEstimate = $this->db->get();
        return $oneEstimate->result_array();
//        $this->db->select('m.idEstimate AS idEstimate,m.SerialNumber AS SerialNumber,m.Attender AS Attender,ic.Name AS InsuranceCompany,ic.CompanyCode AS CompanyCode,m.PolicyNumber AS PolicyNumber,sur.Name AS SurveyorName,sur.Phone AS SurveyorPhone,icd.idInsuranceCompanyDetail,icd.BranchName AS Branch,m.LossNumber AS LossNumber,m.PMC AS PMC,m.ServiceAdvisor AS ServiceAdvisor,m.isMechanical AS isMechanical,'
//                . 'c.CompanyName AS CompanyName,c.CompanyContact AS CompanyContact,c.CustomerName AS CustomerName,c.Cellphone AS Cellphone,c.PhoneOne AS PhoneOne,c.PhoneTwo AS PhoneTwo,c.Cnic AS CNIC,c.Ntn AS NTN,c.AddressDetails AS AddressDetails,'
//                . 'av.Variant AS VehicleName,v.RegistrationNumber AS RegistrationNumber,v.Model AS Model,v.EngineNumber AS EngineNumber,v.ChassisNumber AS ChassisNumber,v.EstNumber AS EstNumber,v.Mileage AS Mileage,v.Year AS Year,v.isEstimate AS isEstimate,ab.idAllBrands AS idAllBrands,ab.BrandName AS BrandName,am.idAllModels AS idAllModels,am.ModelName,'
//                . 'GROUP_CONCAT(jobs.idJobRef) AS idJobRef,GROUP_CONCAT(jobs.JobTask) AS Jobs,GROUP_CONCAT(jobs.RangeOneAmount) AS RangeOneAmount,GROUP_CONCAT(jobs.RangeTwoAmount) AS RangeTwoAmount,GROUP_CONCAT(jobs.RangeThreeAmount) AS RangeThreeAmount,m.Date As Date,staff.idStaff,staff.Name');
//        $this->db->from('s_estimate m');
//        $this->db->join('s_cutomerdetail c', 'c.idCustomer = m.idCustomerDetail');
//        $this->db->join('s_vehicle v', 'v.idVehicle = m.idVehicle');
//        $this->db->join('s_allvehicles av', 'av.idAllVehicles = v.idVariant');
//        $this->db->join('s_allbrands ab', 'ab.idAllBrands = av.idAllBrands');
//        $this->db->join('s_allmodels am', 'am.idAllBrands = ab.idAllBrands');
//        $this->db->join('s_staff staff', 'staff.idStaff = m.ServiceAdvisor');
//        $this->db->join('s_estimate_jobdescription j', 'j.idEstimate = m.idEstimate');
//        $this->db->join('s_jobreferencemanual jobs', 'jobs.idJobRef = j.idJob');
//        $this->db->join('s_insurancecompany ic', 'ic.idInsuranceCompany = m.idInsuranceCompany');
//        $this->db->join('s_insurancecompany_detail icd', 'icd.idInsuranceCompany = ic.idInsuranceCompany');
//        $this->db->join('s_surveyor sur', 'sur.idSurveyor = m.idSurveyor');
//        $this->db->where('m.SerialNumber', $SearchKeyword);
//        $this->db->where('m.isMechanical', 0);
//        $this->db->where('m.isActive', 1);
//        $this->db->group_by('m.idEstimate');
//        $oneEstimate = $this->db->get();
//        return $oneEstimate->result_array();
    }
	
	
	 function selectOneMechEstimateJobs($SearchKeyword) {

        $this->db->select('s_estimate_jobdescription.*');
        $this->db->from('s_estimate_jobdescription');
		 $this->db->join('s_estimate', 's_estimate.idEstimate = s_estimate_jobdescription.idEstimate');
        $this->db->where('s_estimate.SerialNumber', $SearchKeyword);
        $this->db->where('s_estimate.isMechanical', 0);
      
        $oneEstimate = $this->db->get();
        return $oneEstimate->result_array();
 }

    function selectAllBShopEstimates() {

        $this->db->select('m.idEstimate AS idEstimate,m.SerialNumber AS SerialNumber,c.CustomerName AS CustomerName,c.Cellphone AS Cellphone,av.Variant AS VehicleName,GROUP_CONCAT(jobs.idJobRef) AS idJobRef,GROUP_CONCAT(j.JobDescription) AS Jobs,GROUP_CONCAT(jobs.RangeOneAmount) AS RangeOneAmount,GROUP_CONCAT(jobs.RangeTwoAmount) AS RangeTwoAmount,GROUP_CONCAT(jobs.RangeThreeAmount) AS RangeThreeAmount,Date As Date,staff.idStaff,staff.Name ');
        $this->db->from('s_estimate m');
        $this->db->join('s_cutomerdetail c', 'c.idCustomer = m.idCustomerDetail');
        $this->db->join('s_vehicle v', 'v.idVehicle = m.idVehicle');
        $this->db->join('s_allvehicles av', 'av.idAllVehicles = v.idVariant');
        $this->db->join('s_staff staff', 'staff.idStaff = m.ServiceAdvisor');
        $this->db->join('s_estimate_jobdescription j', 'j.idEstimate = m.idEstimate');
        $this->db->join('s_jobreferencemanual jobs', 'jobs.idJobRef = j.idJob');
        $this->db->where('m.isMechanical', 0);
        $this->db->where('m.isActive', 1);
        $this->db->group_by('m.idEstimate');
        $allEsitmates = $this->db->get();
        return $allEsitmates->result_array();
    }

    function selectbyEsitmateNo($estNo) {

        $this->db->select('m.idEstimate AS idEstimate,m.SerialNumber AS SerialNumber,c.CustomerName AS CustomerName,c.CompanyName AS CompanyName,c.CompanyContact AS CompanyContact,c.CustomerEmail AS CustomerEmail,Ntn,Gst,c.Cellphone AS Cellphone,av.Variant AS VehicleName,v.RegistrationNumber AS RegistrationNumber,GROUP_CONCAT(jobs.JobTask) AS Jobs,GROUP_CONCAT(j.JobDescription) AS JJobs,GROUP_CONCAT(jobs.RangeOneAmount) AS TotalAmountOne,GROUP_CONCAT(jobs.RangeTwoAmount) AS TotalAmountTwo,GROUP_CONCAT(jobs.RangeThreeAmount) AS TotalAmountThree,m.Date As Date,m.isMechanical AS isMechanical,staff.idStaff,staff.Name ,m.is_PM , c.AddressDetails AS AddressDetails , m.Attender , m.Range , v.Model , v.Year as YEAR , v.ChassisNumber , v.EngineNumber , v.Mileage');
        $this->db->from('s_estimate m');
        $this->db->join('s_cutomerdetail c', 'c.idCustomer = m.idCustomerDetail');
        $this->db->join('s_vehicle v', 'v.idVehicle = m.idVehicle');
        $this->db->join('s_allvehicles av', 'av.idAllVehicles = v.idVariant');
        $this->db->join('s_staff staff', 'staff.idStaff = m.ServiceAdvisor');
        $this->db->join('s_estimate_jobdescription j', 'j.idEstimate = m.idEstimate');
		$this->db->join('s_jobreferencemanual jobs', 'jobs.idJobRef = j.idJob');
        $this->db->where('m.SerialNumber', $estNo);
        $this->db->where('m.isMechanical', 0);
        $this->db->where('m.isActive', 1);
        $this->db->group_by('m.idEstimate');
        $allEsitmates = $this->db->get();
        return $allEsitmates->result_array();
    }
	//  s_estimate.isMechanical = 0 AND 
	function selectSubletbyEsitmateNo($searchKeyword) {
        $data		= $this->db->query("Select s_estimatesubletrepairuseage.* from s_estimatesubletrepairuseage INNER JOIN s_estimate on s_estimatesubletrepairuseage.idEstimate = s_estimate.idEstimate Where  s_estimate.isMechanical = 0 AND s_estimate.SerialNumber = ".$searchKeyword)->result_array();
return $data;   
   }
   
   function selectPartsbyEsitmateNo($estNo) {
        $this->db->select('parts.PartName,i.RetailPrice AS Price');
        $this->db->from('s_estimate_partsdescription p');
		$this->db->join('parts_name parts', 'p.idPart = parts.idPart');
		$this->db->join('s_estimate m', 'p.idEstimate = m.idEstimate');
		$this->db->join('parts_inventory i', 'i.PartId = parts.idPart');
        $this->db->where('m.SerialNumber', $estNo);
        $this->db->where('m.isMechanical', 0);
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
        $this->db->where('m.isMechanical', 0);
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
        $data		= $this->db->query("Select SUM(s_estimatesubletrepairuseage.SubletRepairAmount) AS Amount from s_estimatesubletrepairuseage INNER JOIN s_estimate on s_estimatesubletrepairuseage.idEstimate = s_estimate.idEstimate Where  s_estimate.isMechanical = 0 AND s_estimate.idEstimate = ".$searchKeyword)->result_array();
if($data){
	return $data[0]['Amount'];
}else{
	return 0;
	  
   }
   }

}
