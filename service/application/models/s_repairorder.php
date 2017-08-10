<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_repairorder extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    function InsertRepairOrder($repairOrderData) {

        $this->db->insert('s_repairorderbill', $repairOrderData);
        return "RO Opened with RO-Number ";
    }

    function UpdateRepairOrder($idRO) {

        $this->db->where('idRepairOrderBill', $idRO);
        $this->db->set('isPSFU', 1);
        $this->db->update('s_repairorderbill');
        return "Successfully Updated";
    }

   

    function getAllCustype() {
        $this->db->select('*');
        $this->db->from('s_cusType');
        $cusType = $this->db->get();
        return $cusType->result_array();
    }

    function searchisExistCustomer($searchKeyword) {
		
		$this->db->select('*');
        $this->db->from('viewestimatedetail veh');
        $this->db->where('SerialNumber', $searchKeyword);
   
	
	
	
/*        $this->db->select('*');
        $this->db->from('s_vehicle veh');
        $this->db->join('s_allvehicles allveh', 'allveh.idAllVehicles = veh.idVariant', 'left');
        $this->db->join('s_cutomerdetail customer', 'customer.idCustomer = veh.idCustomer', 'left');
        $this->db->like('veh.RegistrationNumber', $searchKeyword, 'after');
        $this->db->or_like('veh.ChassisNumber', $searchKeyword, 'after');
        $this->db->or_like('veh.EngineNumber', $searchKeyword, 'after');
        $this->db->or_like('veh.Model', $searchKeyword, 'after');
        $this->db->or_like('veh.EstNumber', $searchKeyword, 'after');*/
		
        $searchReg = $this->db->get();
		$data = $searchReg->result_array();
		if(count($data) > 0){
		$data[0]['Jobs'] 		= $this->db->query("SELECT s_estimate_jobdescription.idJob,IF (`Range` = 'RangeOneAmount',RangeOneAmount,IF (`Range` = 'RangeTwoAmount',RangeTwoAmount,RangeThreeAmount)) AS RangeAmount FROM s_estimate_jobdescription INNER JOIN s_estimate ON s_estimate_jobdescription.idEstimate = s_estimate.idEstimate INNER JOIN s_jobreferencemanual ON s_estimate_jobdescription.idJob = s_jobreferencemanual.idJobRef WHERE s_estimate.SerialNumber = ".$searchKeyword)->result_array();
		$data[0]['Parts'] 		= $this->db->query("Select s_estimate_partsdescription.idPart,viewparts.RetailPrice,viewparts.PartNumber from s_estimate_partsdescription INNER JOIN s_estimate on s_estimate_partsdescription.idEstimate = s_estimate.idEstimate INNER JOIN viewparts on s_estimate_partsdescription.idPart = viewparts.idPart  Where s_estimate.SerialNumber = ".$searchKeyword)->result_array();
		$data[0]['Sublet'] 		= $this->db->query("Select s_estimatesubletrepairuseage.* from s_estimatesubletrepairuseage INNER JOIN s_estimate on s_estimatesubletrepairuseage.idEstimate = s_estimate.idEstimate Where s_estimate.SerialNumber = ".$searchKeyword)->result_array();

		}
        return $data;
    }
	
 function searchRepairOrder($searchKeyword) {

        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->where('vr.RONumber', $searchKeyword);
        $this->db->where('vr.isActive != 0');
        $searchRO = $this->db->get();
      
		$data = $searchRO->result_array();
		if(count($data) > 0){
	//	$data[0]['Jobs'] 		= $this->db->query("SELECT s_estimate_jobdescription.idJob,IF (`Range` = 'RangeOneAmount',RangeOneAmount,IF (`Range` = 'RangeTwoAmount',RangeTwoAmount,RangeThreeAmount)) AS RangeAmount FROM s_estimate_jobdescription INNER JOIN s_estimate ON s_estimate_jobdescription.idEstimate = s_estimate.idEstimate INNER JOIN s_jobreferencemanual ON s_estimate_jobdescription.idJob = s_jobreferencemanual.idJobRef WHERE s_estimate.SerialNumber = ".$searchKeyword)->result_array();
		if($data[0]['EstimateNo'])
		$data[0]['Parts'] 		= $this->db->query("Select s_estimate_partsdescription.idPart,viewparts.RetailPrice,viewparts.PartNumber from s_estimate_partsdescription INNER JOIN s_estimate on s_estimate_partsdescription.idEstimate = s_estimate.idEstimate INNER JOIN viewparts on s_estimate_partsdescription.idPart = viewparts.idPart  Where s_estimate.isMechanical =".$data[0]['isMechanical']." AND  s_estimate.SerialNumber = ".$data[0]['EstimateNo'])->result_array();
		$data[0]['s_job'] 		= $this->db->query("select s_job.* from viewrodetail INNER JOIN s_jobprogresssheet On viewrodetail.idRO = s_jobprogresssheet.idRepairOrderBill INNER JOIN s_job ON s_jobprogresssheet.idJobProgressSheet = s_job.idJobProgressSheet WHERE viewrodetail.RONumber = ".$searchKeyword)->result_array();
		$data[0]['s_package'] 	= $this->db->query("select s_jobprog_pmpackage.* from viewrodetail INNER JOIN s_jobprogresssheet On viewrodetail.idRO = s_jobprogresssheet.idRepairOrderBill INNER JOIN s_jobprog_pmpackage ON s_jobprogresssheet.idJobProgressSheet = s_jobprog_pmpackage.idJobProgressSheet WHERE viewrodetail.RONumber = ".$searchKeyword)->result_array();
		$data[0]['s_diag'] 		= $this->db->query("select s_diagnosis.* from viewrodetail INNER JOIN s_jobprogresssheet On viewrodetail.idRO = s_jobprogresssheet.idRepairOrderBill INNER JOIN s_diagnosis ON s_jobprogresssheet.idJobProgressSheet = s_diagnosis.idJobProgressSheet WHERE viewrodetail.RONumber = ".$searchKeyword)->result_array();
		$data[0]['s_addjob'] 	= $this->db->query("select s_additionaljob.* from viewrodetail INNER JOIN s_jobprogresssheet On viewrodetail.idRO = s_jobprogresssheet.idRepairOrderBill INNER JOIN s_additionaljob ON s_jobprogresssheet.idJobProgressSheet = s_additionaljob.idJobProgressSheet WHERE viewrodetail.RONumber = ".$searchKeyword)->result_array();
		$data[0]['ro_job'] 	= $this->db->query("SELECT
	s_ro_mechrepairs.*
FROM
	viewrodetail
INNER JOIN s_ro_mechrepairs ON viewrodetail.idRO = s_ro_mechrepairs.idRepairOrderBill

WHERE
	viewrodetail.RONumber = ".$searchKeyword)->result_array();
	$data[0]['ro_package'] 	= $this->db->query("SELECT
	s_ro_pmpackages.*
FROM
	viewrodetail
INNER JOIN s_ro_pmpackages ON viewrodetail.idRO = s_ro_pmpackages.idRepairOrderBill

WHERE
	viewrodetail.RONumber = ".$searchKeyword)->result_array();
		if(count($data[0]['s_job']) > 0){
			for($f=0;$f<count($data[0]['s_job']);$f++){
				$data[0]['s_job'][$f]['staff'] =  $this->db->query("Select * from s_job_staff where idJob = ".$data[0]['s_job'][$f]['idJob'])->result_array();
			}
		}
		//$data[0]['s_job']  = "";
		if(count($data[0]['s_package']) > 0){
			for($f=0;$f<count($data[0]['s_package']);$f++){
				$data[0]['s_package'][$f]['staff'] =  $this->db->query("Select * from s_jobprog_package_staff where idJobProgPMPackage = ".$data[0]['s_package'][$f]['idJobProgPMPackage'])->result_array();
			}
		}
		if(count($data[0]['s_diag']) > 0){
			for($f=0;$f<count($data[0]['s_diag']);$f++){
				$data[0]['s_diag'][$f]['jobs'] =  $this->db->query("Select * from s_diagnosis_jobs where idDiagnosis = ".$data[0]['s_diag'][$f]['idDiagnosis'])->result_array();
				$data[0]['s_diag'][$f]['staff'] =  $this->db->query("Select * from s_diagnosis_staff where idDiagnosis = ".$data[0]['s_diag'][$f]['idDiagnosis'])->result_array();
			}
		}if(count($data[0]['s_addjob']) > 0){
			for($f=0;$f<count($data[0]['s_addjob']);$f++){
				//$data[0]['s_addjob'][$f]['jobs'] =  $this->db->query("Select * from s_diagnosis_jobs where idDiagnosis = ".$data[0]['s_addjob'][$f]['idDiagnosis'])->result_array();
				$data[0]['s_addjob'][$f]['staff'] =  $this->db->query("Select * from s_addjob_staff where idAdditionalJob = ".$data[0]['s_addjob'][$f]['idAdditionalJob'])->result_array();
			}
		}
		}
        return $data;
    }

    function selectOneRepairOrder($RONumber) {

        $where = "RONumber = '$RONumber' AND isActive != 0";
        $this->db->select('idRepairOrderBill');
        $this->db->from('s_repairorderbill');
        $this->db->where($where);
        $idRO = $this->db->get();
        if ($idRO->num_rows() > 0) {
            $row = $idRO->row();
            $idRO = $row->idRepairOrderBill;
            return $idRO;
        }
    }

    function fillPartCombo() {
        $query = $this->db->query('select idPart, PartNumber, PartName from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber, "PartName" => $dropdown->PartName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function getIdRepairOrder() {

        $this->db->select('idRepairOrderBill');
        $this->db->from('s_repairorderbill');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idRO = $this->db->get();
        if ($idRO->num_rows() > 0) {
            $row = $idRO->row();
            $idRO = $row->idRepairOrderBill;
            return $idRO;
        }
    }
	
	function getPMJobs($searchKeyword){
	$data		= $this->db->query("SELECT PMPackage as JobTask FROM viewrodetail WHERE 	viewrodetail.RONumber = 108 UNION SELECT 	s_jobreferencemanual.JobTask FROM 	viewrodetail INNER JOIN s_ro_pmpackages ON viewrodetail.idRO = s_ro_pmpackages.idRepairOrderBill INNER JOIN s_ro_pm_jobs ON s_ro_pmpackages.idRoPMPackage = s_ro_pm_jobs.idRoPMPackage INNER JOIN s_jobreferencemanual ON s_ro_pm_jobs.idJobRef = s_jobreferencemanual.idJobRef WHERE viewrodetail.RONumber = ".$searchKeyword)->result_array();	
	return $data;
	}

    function getIdRoPmPackage() {

        $this->db->select('idRoPMPackage');
        $this->db->from('s_ro_pmpackages');
        $this->db->order_by("CreatedDate", "desc");
        $this->db->limit(1);
        $idRoPMPackage = $this->db->get();
        if ($idRoPMPackage->num_rows() > 0) {
            $row = $idRoPMPackage->row();
            $idRoPMPackage = $row->idRoPMPackage;
            return $idRoPMPackage;
        }
    }

    function getROModes() {

        $this->db->select('*');
        $this->db->from('s_romode');
        $this->db->where('isActive', 1);
        $roModes = $this->db->get();
        return $roModes->result_array();
    }

    function getSubModesMech() {
        $this->db->select('*');
        $this->db->from('s_submode');
        $this->db->where('isActive', 1);
        $this->db->where('idROMode', 6);
        $subModesM = $this->db->get();
        return $subModesM->result_array();
    }

    function getSubModeWarr() {
        $this->db->select('*');
        $this->db->from('s_submode');
        $this->db->where('isActive', 1);
        $this->db->where('idROMode', 13);
        $subModesW = $this->db->get();
        return $subModesW->result_array();
    }

    function getSubModeBP() {
        $this->db->select('*');
        $this->db->from('s_submode');
        $this->db->where('isActive', 1);
        $this->db->where('idROMode', 7);
        $subModesB = $this->db->get();
        return $subModesB->result_array();
    }

    function getSubModeCW() {
        $this->db->select('*');
        $this->db->from('s_submode');
        $this->db->where('isActive', 1);
        $this->db->where('idROMode', 15);
        $subModesC = $this->db->get();
        return $subModesC->result_array();
    }

    function getGasInfo() {

        $this->db->select('*');
        $this->db->from('s_gas');
        $this->db->where('s_gas.isActive != 0');
        $gasInfo = $this->db->get();
        return $gasInfo->result_array();
    }

    function generateRONumber() {

        $this->db->select('count(*)+1 AS RONumber');
        $this->db->from('s_repairorderbill');
        $idRO = $this->db->get();
        if ($idRO->num_rows() > 0) {
            $row = $idRO->row();
            $idRO = $row->RONumber;
            return $idRO;
        } else {
            return 0;
        }
    }

    function DeleteRepairOrder() {
        
    }

    function selectAllRepairOrder() {
        
    }
	
	function getAdditionalJobs($searchKeyword){
	$data		= $this->db->query("select s_additionaljob.*,s_jobreferencemanual.JobTask from viewrodetail INNER JOIN s_jobprogresssheet On viewrodetail.idRO = s_jobprogresssheet.idRepairOrderBill INNER JOIN s_additionaljob ON s_jobprogresssheet.idJobProgressSheet = s_additionaljob.idJobProgressSheet INNER JOIN s_jobreferencemanual ON s_additionaljob.idJobRef = s_jobreferencemanual.idJobRef WHERE viewrodetail.RONumber = ".$searchKeyword)->result_array();	
	return $data;
	}
	
	function getRequestedJobs($RONumber) {
	
		$data		= $this->db->query("SELECT
s_jobreferencemanual.JobTask
FROM
	viewrodetail
INNER JOIN s_ro_mechrepairs ON viewrodetail.idRO = s_ro_mechrepairs.idRepairOrderBill
INNER JOIN s_jobreferencemanual ON s_ro_mechrepairs.idJobRefManual = s_jobreferencemanual.idJobRef

WHERE
	viewrodetail.RONumber = ".$RONumber)->result_array();
	
	
        return $data;
	
	}
	
	function getDetailJobs($RONumber) {
	
		$data		= $this->db->query("SELECT
s_ro_workperformed.*

FROM 

s_ro_workperformed
	
INNER JOIN viewrodetail ON s_ro_workperformed.idRepairOrderBill = viewrodetail.RONumber
WHERE
	viewrodetail.RONumber = ".$RONumber)->result_array();
	
	
        return $data;
	
	}
	
	function getSublet($RONumber) {
	
		$data		= $this->db->query("SELECT
s_subletrepairuseage.*

FROM 

s_subletrepairuseage
	
INNER JOIN viewrodetail ON s_subletrepairuseage.idRepairOrderBill = viewrodetail.RONumber
WHERE
	viewrodetail.RONumber = ".$RONumber)->result_array();
	
	
        return $data;
	
	}
	
	 function getReceivedParts($searchKeyword) {


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
cast(s_partsreq_partsinfo.CreatedDate as date) as CreatedDate,
parts_name.PartName,
parts_name.PartNumber
FROM
s_partsreq_partsinfo
INNER JOIN parts_inventory on parts_inventory.PartId = s_partsreq_partsinfo.idPart
INNER JOIN parts_name on s_partsreq_partsinfo.idPart = parts_name.idPart
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

    function getRoData($RONumber) {
        $sql = "
							SELECT
							s_repairorderbill.RONumber,
							s_repairorderbill.CashMemoNumber,
							s_repairorderbill.CreditMemoNumber,
							s_repairorderbill.BookInDate,
							s_repairorderbill.BookInTime,
							s_repairorderbill.DeliveryDate,
							s_repairorderbill.DeliveryTime,
							s_repairorderbill.VOC,
							s_repairorderbill.LabourAmount,
							s_repairorderbill.LubOilAmount,
							s_repairorderbill.SubletRepairAmount,
							s_repairorderbill.PartsAmount,
							s_repairorderbill.GrandTotal,
							s_repairorderbill.GSTax,
							s_repairorderbill.NetTotal,
							s_repairorderbill.isWorkOrderAttach,
							s_repairorderbill.GatePassNumber,
                            s_repairorderbill.cusTypeId,
                            s_repairorderbill.idFinance,
                            s_repairorderbill.idROMode,
							
						s_staff.Name as Advisor,
                           
                          
							s_fuel.FuelVolume,
							s_cutomerdetail.idCustomer,
							s_cutomerdetail.CustomerName,
							s_cutomerdetail.CustomerEmail,
							s_cutomerdetail.AddressDetails,
							s_cutomerdetail.Cnic,
							s_cutomerdetail.Ntn,
							s_cutomerdetail.Cellphone,
                            s_cutomerdetail.CompanyName,
                            s_cutomerdetail.CompanyContact,
                            s_cutomerdetail.PhoneOne,
                            s_cutomerdetail.PhoneTwo,
							s_vehicle.VehicleName,
							s_vehicle.Model,
							s_vehicle.RegistrationNumber,
							s_vehicle.EngineNumber,
							s_vehicle.ChassisNumber,
							s_vehicle.Mileage,
                            s_vehicle.Year
							FROM
							s_repairorderbill
							INNER JOIN s_fuel ON s_repairorderbill.idFuel = s_fuel.idFuel
							INNER JOIN s_staff ON s_repairorderbill.idStaff = s_staff.idStaff
							INNER JOIN s_cutomerdetail ON s_repairorderbill.idCustomerDetail = s_cutomerdetail.idCustomer
							INNER JOIN s_vehicle ON s_repairorderbill.idVehicle = s_vehicle.idVehicle
							WHERE s_repairorderbill.RONumber = $RONumber";
							
							
							//$sql = "Select * From viewrodetail where RONumber = $RONumber";

        $getRoData = $this->db->query($sql);
        return $getRoData->result_array();
    }

    function isRecordExist($tableName, $where, $value) {

        $whereClause = "$where = '$value' AND isActive = 1";
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where($whereClause);
        $this->db->limit(1);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getReferanceRecords($refnum) {        
        $query = $this->db
		->select("s_jobreferencemanual.JobTask")
		->from("s_ro_mechrepairs")
		->join("s_jobreferencemanual", "s_ro_mechrepairs.idJobRefManual = s_jobreferencemanual.idJobRef")
		->where("s_ro_mechrepairs.idRepairOrderBill", $refnum)
                ->where('s_ro_mechrepairs.isActive != 0')
		->get();
		return $query->result_array();
    }
	
	function searchisExistCustomerbody($searchKeyword) {
		
		$this->db->select('*');
        $this->db->from('viewestimatedetail veh');
        $this->db->where('SerialNumber', $searchKeyword);
        $this->db->where('isMechanical',0);		
        $searchReg = $this->db->get();
		$data = $searchReg->result_array();
		if(count($data) > 0){
		$data[0]['Jobs'] 		= $this->db->query("SELECT s_estimate_jobdescription.JobDescription,s_estimate_jobdescription.JobAmount FROM s_estimate_jobdescription INNER JOIN s_estimate ON s_estimate_jobdescription.idEstimate = s_estimate.idEstimate INNER JOIN s_jobreferencemanual ON s_estimate_jobdescription.idJob = s_jobreferencemanual.idJobRef WHERE s_estimate.isMechanical = 0 AND s_estimate.SerialNumber = ".$searchKeyword)->result_array();
		$data[0]['Parts'] 		= $this->db->query("Select s_estimate_partsdescription.idPart,viewparts.RetailPrice,viewparts.PartNumber from s_estimate_partsdescription INNER JOIN s_estimate on s_estimate_partsdescription.idEstimate = s_estimate.idEstimate INNER JOIN viewparts on s_estimate_partsdescription.idPart = viewparts.idPart  Where s_estimate.isMechanical = 0 AND s_estimate.SerialNumber = ".$searchKeyword)->result_array();
		$data[0]['Sublet'] 		= $this->db->query("Select s_estimatesubletrepairuseage.* from s_estimatesubletrepairuseage INNER JOIN s_estimate on s_estimatesubletrepairuseage.idEstimate = s_estimate.idEstimate Where s_estimate.isMechanical = 0 AND s_estimate.SerialNumber = ".$searchKeyword)->result_array();

		}
        return $data;
    }
	
	function getMrs()
	{
	  $date =  date('Y-m-d',strtotime("-80 days"));
	  $result =  $this->db->query("SELECT ro.RONumber , ct.cusType , cd.CustomerName , cd.Cellphone , cd.PhoneOne , cd.PhoneTwo , ro.CreatedDate , ro.MileageAftTesting , pmm.PeriodName , v.RegistrationNumber , v.ChassisNumber , cv.Variants , v.`Year` AS year, v.Mileage AS KM , ro.DeliveryDate
From s_repairorderbill As ro
LEFT JOIN s_custype AS ct
ON ro.cusTypeId = ct.cusTypeId
LEFT JOIN s_cutomerdetail AS cd
ON ro.idCustomerDetail =  cd.idCustomer
LEFT JOIN s_ro_pmpackages  AS pm
ON ro.idRepairOrderBill =  pm.idRepairOrderBill
LEFT JOIN s_periodicmaintenancedetail AS pmd
ON  pm.idPeriodicMaintenanceDetail =  pmd.idPeriodicMaintenanceDetail
LEFT JOIN s_periodicmaintenance AS pmm
ON pmd.idPeriodicMaintenance  =  pmm.idPeriodicMaintenance
LEFT JOIN s_vehicle  As v
ON ro.idVehicle =  v.idVehicle
LEFT JOIN car_variants AS cv
ON   v.idVariant =  cv.IdVariants
WHERE ro.CreatedDate =  '$date'")->result_array();
	  return $result;
	}

function in_la(){

for($a=0;$a<$this->input->post('count');$a++){
 $s_insert = array(
 'RONumber'=>$this->input->post('RONumber'.$a),
  't_req'=>$this->input->post('t_req'.$a),
   'a_pak'=>$this->input->post('a_pak'.$a),
    'lab'=>$this->input->post('lab'.$a),
     'main'=>$this->input->post('main'.$a), 
     'parts'=>$this->input->post('parts'.$a), 
     'sms'=>$this->input->post('sms'.$a), 
     't_cost'=>$this->input->post('t_cost'.$a),
      'r_type'=>$this->input->post('r_type'.$a),
       'comment'=>$this->input->post('comment'.$a),
        '1_date'=>$this->input->post('1_date'.$a),
         '2_date'=>$this->input->post('2_date'.$a), 
         '3_date'=>$this->input->post('3_date'.$a),
'CustomerName'=>$this->input->post('CustomerName'.$a),
 'RegistrationNumber'=>$this->input->post('RegistrationNumber'.$a),
  'Cellphone'=>$this->input->post('Cellphone'.$a),
   'ChassisNumber'=>$this->input->post('ChassisNumber'.$a),
    'KM'=>$this->input->post('KM'.$a),
     'PhoneOne'=>$this->input->post('PhoneOne'.$a),
     'Variants'=>$this->input->post('Variants'.$a),
      'CreatedDate'=>$this->input->post('CreatedDate'.$a),
       'DeliveryDate'=>$this->input->post('DeliveryDate'.$a),
        'PeriodName'=>$this->input->post('PeriodName'.$a),
         'year'=>$this->input->post('year'.$a),
          'e_mile'=>$this->input->post('e_mile'.$a),



);
$this->db->insert('s_insert',$s_insert);
}
$this->session->set_userdata('done',"Inserted Succ");

redirect("index.php/repairorder/mrs","refresh");

}

function up_last(){
    $ronum=$this->input->post('RONumber');
$que=$this->db->query('select RONumber from s_insert where RONumber="'.$ronum.'"');
$res=$que->result_array();

$c=count($res);
$a=0;
if($c>0)
{
    $s_insert = array(
 'RONumber'=>$this->input->post('RONumber'),
  't_req'=>$this->input->post('t_req'.$a),
   'a_pak'=>$this->input->post('a_pak'.$a),
    'lab'=>$this->input->post('lab'.$a),
     'main'=>$this->input->post('main'.$a), 
     'parts'=>$this->input->post('parts'.$a), 
     'sms'=>$this->input->post('sms'), 
     't_cost'=>$this->input->post('t_cost'.$a),
      'r_type'=>$this->input->post('r_type'.$a),
       'comment'=>$this->input->post('comment'.$a),
        '1_date'=>$this->input->post('1_date'.$a),
         '2_date'=>$this->input->post('2_date'.$a), 
         '3_date'=>$this->input->post('3_date'.$a),
'CustomerName'=>$this->input->post('CustomerName'.$a),
 'RegistrationNumber'=>$this->input->post('RegistrationNumber'.$a),
  'Cellphone'=>$this->input->post('Cellphone'.$a),
   'ChassisNumber'=>$this->input->post('ChassisNumber'.$a),
    'KM'=>$this->input->post('KM'.$a),
     'PhoneOne'=>$this->input->post('PhoneOne'.$a),
     'Variants'=>$this->input->post('Variants'.$a),
      'CreatedDate'=>$this->input->post('CreatedDate'.$a),
       'DeliveryDate'=>$this->input->post('DeliveryDate'.$a),
        'PeriodName'=>$this->input->post('PeriodName'.$a),
         'year'=>$this->input->post('year'.$a),
          'e_mile'=>$this->input->post('e_mile'.$a),



);
    $this->db->where('RONumber',$ronum);
    $this->db->update('s_insert',$s_insert);
$this->session->set_userdata('done',"Inserted Succ");

redirect("index.php/repairorder1","refresh");
}
else{
$this->session->set_userdata('error',"Something wrong");

redirect("index.php/repairorder1/","refresh");
}

}

function fa_la(){
          $id =  $this->input->post('id');
          $result =  $this->db->query("SELECT * from s_insert where RONumber = $id")->result_array();
      return json_encode($result);

}


}
