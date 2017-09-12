<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jobprogresssheet extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_jobprogresssheet');
        $this->load->model('s_repairorder');
        $this->load->model('s_vehicle');
        $this->load->model('s_categoryinfo');
        $this->load->model('s_conditionconfirmationdetail');
        $this->load->model('s_psfu');
        $this->load->model('s_psfuresult');
        $this->load->model('s_diagnosis');
        $this->load->model('s_job');
        $this->load->model('s_additionaljob');
        $this->load->model('s_jobresultexplanation');
        $this->load->model('s_qualitycheck');
        $this->load->model('s_contactinfo');
        $this->load->model('s_staff');
        $this->load->model('s_jobreferencemanual');
        $this->load->model('s_periodicmaintenance');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $dataArray = array();
        $jobModel = new S_jobprogresssheet();
        $categoryModel = new S_categoryinfo();
        $conditionModel = new S_conditionconfirmationdetail();
        $psfuresultModel = new S_psfuresult();
        $jobExpModel = new S_jobresultexplanation();
        $qualityCheckModel = new S_qualitycheck();
        $contactModel = new S_contactinfo();
        $staffManagment = new S_staff();
        $jobRefManual = new S_jobreferencemanual();
        $psfuModel = new S_psfu();
        $pmModel = new S_periodicmaintenance();
        $dataArray['categoryList'] = $categoryModel->getCategoryInfo();
        $dataArray['condConfirm'] = $conditionModel->getConditionDetail();
        $dataArray['psufList'] = $psfuresultModel->getPSFUResult();
        $dataArray['jobResultList'] = $jobExpModel->getJobResult();
        $dataArray['qualityList'] = $qualityCheckModel->getQualityCheckInfo();
        $dataArray['contactList'] = $contactModel->getContactInfo();
        $dataArray['staffList'] = $staffManagment->getAllStaff();
        $dataArray['technicianList'] = $staffManagment->getTechnicianStaff();
        $dataArray['allJobs'] = $jobRefManual->getAllJrm();
        $dataArray['allPackages'] = $pmModel->getAllPm();
        $dataArray['stdDuration'] = $psfuModel->getPSFUStdDuration();
        $dataArray['allDentPanals'] = $jobModel->getDentPanals();
        $dataArray['allPaintPanals'] = $jobModel->getPaintPanals();
        $dataArray['denterList'] = $staffManagment->getDenterStaff();
        $dataArray['painterList'] = $staffManagment->getPainterStaff();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('jobprogresssheet', $dataArray);
        $this->load->view('footer');
    }

    function Add() {
	//	var_dump($_POST);die;
        $jobModel = new S_jobprogresssheet();
        $roModel = new S_repairorder();
        $idRO = $this->input->post('idRepairOrder');
        $isClean = $this->input->post('Clean');
        $isCourtesy = $this->input->post('Courtesy');
        $isCustDuration = $this->input->post('isCustDuration');
        $newDiagnosis = $this->input->post('newDiagnose');
        $newJob = $this->input->post('newJob');
        $newPackageDesc = $this->input->post('newPackageDesc');
        $newAddJob = $this->input->post('newAddJob');
        $newJObStoppage = $this->input->post('newJobStop');
        $revisedDeliveryDate = $this->input->post('RevisedDeliveryDate');
        $isExistMData = $roModel->isRecordExist('s_jobprogresssheet', 'idRepairOrderBill', $idRO);

        if (!$isExistMData) {
            if ($revisedDeliveryDate != NULL) {
                $revisedDeliveryDate = date("Y-m-d", strtotime($this->input->post('RevisedDeliveryDate')));
            } else {
                $revisedDeliveryDate = "0000-00-00";
            }
            if ($isClean == 'Cleanliness') {
                $isClean = 1;
            } else {
                $isClean = 0;
            }
            if ($isCourtesy == 'Courtesy') {
                $isCourtesy = 1;
            } else {
                $isCourtesy = 0;
            }

            if ($isCustDuration == '1') {
                $isCustDuration = 0;
                $custDuration = 0;
            } else {
                $isCustDuration = 1;
                $custDuration = $this->input->post('custDuration');
            }

            $jobData = array(
                'idRepairOrderBill' => $idRO,
                'idQualityCheck' => $this->input->post('QualityCheck'),
                'RevisedDeliveryDate' => $revisedDeliveryDate,
                'RevisedDeliveryTime' => $this->input->post('RevisedDeliveryTime'),
                'EstimatedCost' => $this->input->post('EstimatedCost'),
                'EstimatedJobTime' => $this->input->post('EstimatedJobTime'),
                'RevisedEstimated' => $this->input->post('RevisedEstimated'),
                'JobDescription' => $this->input->post('JobDescription'),
                'JobRequest' => $this->input->post('JobRequested'),
                'SSCCampaign' => $this->input->post('SSC'),
                'idQCInspectorName' => $this->input->post('InspectorName'),
                'isCleanliness' => $isClean,
                'isCourtesyItemRemoval' => $isCourtesy,
                'isCustPSFUDuration' => $isCustDuration,
                'CustPSFUDuration' => $custDuration,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertJobData = $jobModel->InsertJobData($jobData);
            if (isset($_POST['Category']) != NULL) {
                $addJobCategory = $this->addJobCategory();
            }

            if (isset($_POST['JobExp']) != NULL) {
                $addJobExp = $this->addJobExp();
            }

            $addPSFUPlan = $this->addPSFUPlan($idRO);

            if ($newDiagnosis == "+") {
                $addDiagnosis = $this->addDiagnosis();
            }

            if ($newJob == "+") {
                $addJob = $this->addJob();
            }

            if ($newPackageDesc == "+") {
                $addPackage = $this->addPackagesDetails();
            }

            if ($newAddJob == "+") {
                $addAdditionalJob = $this->addAdditionalJob();
            }

            if ($newJObStoppage == "+") {
                $addJobStoppage = $this->addJobStoppage();
            } else {
                
            }
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertJobData . '</label>');
        } else {
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">Job Progress Sheet Already Exist For this RO </label>');
        }
        redirect(base_url() . "index.php/jobprogresssheet/index");
    }

    function addJobCategory() {

        $categoryData = array();
        $jobModel = new S_jobprogresssheet();
        $idCategory = $_POST['Category'];
        for ($Count = 0; $Count < count($_POST['Category']); $Count++) {
            $categoryData[] = array(
                'idJobProgressSheet' => $jobModel->getIdJobData(),
                'idCategory' => $idCategory[$Count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $inserJobCategory = $this->db->insert_batch('s_jobprog_category', $categoryData);
    }

    function addJobCondition() {

        $conditionData = array();
        $jobModel = new S_jobprogresssheet();
        $idCondtion = $_POST['ConditionDetail'];
        for ($Count = 0; $Count < count($_POST['ConditionDetail']); $Count++) {
            $conditionData[] = array(
                'idJobProgressSheet' => $jobModel->getIdJobData(),
                'idConditionConfirmationDetail' => $idCondtion[$Count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $inserJobCondition = $this->db->insert_batch('s_jobprog_condition', $conditionData);
    }

    function addJobExp() {

        $jobExpData = array();
        $jobModel = new S_jobprogresssheet();
        $idJobExp = $_POST['JobExp'];
        for ($Count = 0; $Count < count($_POST['JobExp']); $Count++) {
            $jobExpData[] = array(
                'idJobProgressSheet' => $jobModel->getIdJobData(),
                'idJobResultExplanaition' => $idJobExp[$Count],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $inserJobExp = $this->db->insert_batch('s_jobprog_jobexp', $jobExpData);
    }

    function addPSFUPlan($idRO) {

        $psfuModel = new s_psfu();
        $psfuPlanDate = $this->input->post('PSFUPlanDate');
        if ($psfuPlanDate != NULL) {
            $psfuPlanDate = date("Y-m-d", strtotime($this->input->post('PSFUPlanDate')));
        } else {
            $psfuPlanDate = "0000-00-00";
        }
        $psfuData = array(
            'idRO' => $idRO,
            'idStaff' => NULL,
            'idPSFUResult' => NULL,
            'PSFUPlanDate' => $psfuPlanDate,
            'PSFUPlanTime' => $this->input->post('PSFUPlanTime'),
            'PSFUActualDate' => NULL,
            'PSFUActualTime' => NULL,
            'PSFURemarks' => NULL,
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => NULL,
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertPSFUPlan = $psfuModel->InsertPSFU($psfuData);
    }

    function addJob() {

        $jobData = array();
        $jobModel = new S_jobprogresssheet();
        $jobArray = json_decode($_POST['jobs'], true);
        for ($jCount = 0; $jCount < count($jobArray); $jCount++) {
            $isDone = 0;
            $isNotDone = 0;
            $isRefused = 0;
            if ($jobArray[$jCount]['status'] === "Done") {
                $isDone = 1;
            } else {
                if ($jobArray[$jCount]['status'] === "NotDone") {
                    $isNotDone = 1;
                } else {
                    $isRefused = 1;
                }
            }
            $jobData = array(
                'idJobProgressSheet' => $jobModel->getIdJobData(),
                'idJobRef' => $jobArray[$jCount]['job'],
                'ClockOnDate' => explode("T", $jobArray[$jCount]['clockOn'])[0],
                'ClockOnTime' => explode("T", $jobArray[$jCount]['clockOn'] ++)[1],
                'ClockOffDate' => explode("T", $jobArray[$jCount]['clockOff'])[0],
                'ClockOffTime' => explode("T", $jobArray[$jCount]['clockOff'] ++)[1],
                'isDone' => $isDone,
                'isNotDone' => $isNotDone,
                'isRefused' => $isRefused,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $inserJobs = $this->db->insert('s_job', $jobData);
            if ($inserJobs) {
                $jobTechData = array();
                for ($tCount = 0; $tCount < count($jobArray[$jCount]['technician']); $tCount++) {
                    $jobTechData = array(
                        'idJob' => $jobModel->getIdJob(),
                        'idStaff' => $jobArray[$jCount]['technician'][$tCount],
                        'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                        'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                        'isActive' => $this->getFieldsValue()['isActive']
                    );
                    $insertJobTechnicians = $this->db->insert('s_job_staff', $jobTechData);
                }
            } else {
                
            }
        }
    }

    function addPackagesDetails() {

        $jobPackageData = array();
        $jobModel = new S_jobprogresssheet();
        $jobPackageArray = json_decode($_POST['jobspackages'], true);
        for ($pCount = 0; $pCount < count($jobPackageArray); $pCount++) {
            $isDone = 0;
            $isNotDone = 0;
            $isRefused = 0;
            if ($jobPackageArray[$pCount]['status'] === "Done") {
                $isDone = 1;
            } else {
                if ($jobPackageArray[$pCount]['status'] === "NotDone") {
                    $isNotDone = 1;
                } else {
                    $isRefused = 1;
                }
            }
            $jobPackageData = array(
                'idJobProgressSheet' => $jobModel->getIdJobData(),
                'idPeriodicMaintenance' => $jobPackageArray[$pCount]['package'],
                'ClockOnDate' => explode("T", $jobPackageArray[$pCount]['clockOn'])[0],
                'ClockOnTime' => explode("T", $jobPackageArray[$pCount]['clockOn'] ++)[1],
                'ClockOffDate' => explode("T", $jobPackageArray[$pCount]['clockOff'])[0],
                'ClockOffTime' => explode("T", $jobPackageArray[$pCount]['clockOff'] ++)[1],
                'isDone' => $isDone,
                'isNotDone' => $isNotDone,
                'isRefused' => $isRefused,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $inserJobsPackage = $this->db->insert('s_jobprog_pmpackage', $jobPackageData);
            if ($inserJobsPackage) {
                $jobTechData = array();
                for ($tCount = 0; $tCount < count($jobPackageArray[$pCount]['technician']); $tCount++) {
                    $jobTechData = array(
                        'idJobProgPMPackage' => $jobModel->getIdJobPMPackage(),
                        'idStaff' => $jobPackageArray[$pCount]['technician'][$tCount],
                        'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                        'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                        'isActive' => $this->getFieldsValue()['isActive']
                    );
                    $insertJobTechnicians = $this->db->insert('s_jobprog_package_staff', $jobTechData);
                }
            } else {
                
            }
        }
    }

//    function addJobStaff($idStaff) {
//
//        $jobStaffData = array();
//        $jobModel = new S_jobprogresssheet();
//        for ($Count = 0; $Count < count($idStaff); $Count++) {
//            $jobStaffData[] = array(
//                'idJob' => $jobModel->getIdJob(),
//                'idStaff' => $idStaff[$Count],
//                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
//                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
//                'isActive' => $this->getFieldsValue()['isActive']
//            );
//        }
//        $inserDiagnosisStaff = $this->db->insert_batch('s_job_staff', $jobStaffData);
//    }

    function addDiagnosis() {

        $diagnosisData = array();
        $jobModel = new S_jobprogresssheet();
        $dignosisArray = json_decode($_POST['diago'], true);
        for ($Count = 0; $Count < count($dignosisArray); $Count++) {

            $diagnosisData = array(
                'idJobProgressSheet' => $jobModel->getIdJobData(),
                'Diagnosis' => $dignosisArray[$Count]['Diagnosis'],
                'ClockOnDate' => explode("T", $dignosisArray[$Count]['ClockOn'])[0],
                'ClockOnTime' => explode("T", $dignosisArray[$Count]['ClockOn'] ++)[1],
                'ClockOffDate' => explode("T", $dignosisArray[$Count]['ClockOff'])[0],
                'ClockOffTime' => explode("T", $dignosisArray[$Count]['ClockOff'] ++)[1],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );

            $inserDiagnosis = $this->db->insert('s_diagnosis', $diagnosisData);

            if ($inserDiagnosis) {
                for ($sCount = 0; $sCount < count($dignosisArray [$Count]['DiagStaff']); $sCount++) {
                    $diagnosisStaffData = array(
                        'idDiagnosis' => $jobModel->getIdDiagnosis(),
                        'idStaff' => $dignosisArray[$Count]['DiagStaff'][$sCount],
                        'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                        'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                        'isActive' => $this->getFieldsValue()['isActive']
                    );

                    $inserDiagnosisStaff = $this->db->insert('s_diagnosis_staff', $diagnosisStaffData);
                }
                for ($jCount = 0; $jCount < count($dignosisArray [$Count]['DiagJobs']); $jCount++) {
                    $diagnosisJobData = array(
                        'idDiagnosis' => $jobModel->getIdDiagnosis(),
                        'idJobRef' => $dignosisArray[$Count]['DiagJobs'][$jCount],
                        'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                        'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                        'isActive' => $this->getFieldsValue()['isActive']
                    );
                    $inserDiagnosisJob = $this->db->insert('s_diagnosis_jobs', $diagnosisJobData);
                }
            } else {
                
            }
        }
    }

//    function addDiagnosisJob($diagJobs) {
//        $diagnosisJobData = array();
//        $jobModel = new S_jobprogresssheet();
//        
//        for ($Count = 0; $Count < count($diagJobs); $Count++) {
//            $diagnosisJobData[] = array(
//                'idDiagnosis' => $jobModel->getIdDiagnosis(),
//                'idJobRef' => $diagJobs[$Count],
//                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
//                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
//                'isActive' => $this->getFieldsValue()['isActive']
//            );
//        }
//        $inserDiagnosisJob = $this->db->insert_batch('s_diagnosis_jobs', $diagnosisJobData);
//    }
//    function addDiagnosisStaff($idStaff) {
//        $diagnosisStaffData = array();
//        $jobModel = new S_jobprogresssheet();
//        for ($Count = 0; $Count < count($idStaff); $Count++) {
//            $diagnosisStaffData[] = array(
//                'idDiagnosis' => $jobModel->getIdDiagnosis(),
//                'idStaff' => $idStaff[$Count],
//                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
//                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
//                'isActive' => $this->getFieldsValue()['isActive']
//            );
//        }
//        $inserDiagnosisStaff = $this->db->insert_batch('s_diagnosis_staff', $diagnosisStaffData);
//    }

    function addAdditionalJob() {

        $addJobData = array();
        $jobModel = new S_jobprogresssheet();
        $additionJobArray = json_decode($_POST['addjobs'], true);
        for ($Count = 0; $Count < count($additionJobArray); $Count++) {
            $isDone = 0;
            $isNotDone = 0;
            $isRefused = 0;
            if ($additionJobArray[$Count]['AddJobStatus'] === "Done") {
                $isDone = 1;
            } else {
                if ($additionJobArray[$Count]['AddJobStatus'] === "NotDone") {
                    $isNotDone = 1;
                } else {
                    $isRefused = 1;
                }
            }
            $addJobData = array(
                'idJobProgressSheet' => $jobModel->getIdJobData(),
                'idJobRef' => $additionJobArray[$Count]['AddJob'],
                'AdditionalCost' => $additionJobArray[$Count]['Cost'],
                'CustomerContactDate' => explode("T", $additionJobArray[$Count]['AddJobClock'])[0],
                'CustomerContactTime' => explode("T", $additionJobArray[$Count]['AddJobClock'] ++)[1],
                'ClockOnDate' => explode("T", $additionJobArray[$Count]['AddJobClockOn'])[0],
                'ClockOnTime' => explode("T", $additionJobArray[$Count]['AddJobClockOn'] ++)[1],
                'ClockOffDate' => explode("T", $additionJobArray[$Count]['AddJobClockOff'])[0],
                'ClockOffTime' => explode("T", $additionJobArray[$Count]['AddJobClockOff'] ++)[1],
                'isDone' => $isDone,
                'isNotDone' => $isNotDone,
                'isRefused' => $isRefused,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $inserAdditionalJob = $this->db->insert('s_additionaljob', $addJobData);
            if ($inserAdditionalJob) {
                $addjobStaffData = array();
                for ($aCount = 0; $aCount < count($additionJobArray[$Count]['AddStaff']); $aCount++) {
                    $addjobStaffData = array(
                        'idAdditionalJob' => $jobModel->getIdAdditionalJob(),
                        'idStaff' => $additionJobArray[$Count]['AddStaff'][$aCount],
                        'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                        'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                        'isActive' => $this->getFieldsValue()['isActive']
                    );
                    $insertAddJobStaff = $this->db->insert('s_addjob_staff', $addjobStaffData);
                }
            } else {
                
            }
        }
    }

    function addJobStoppage() {
        $addJobStopData = array();
        $jobModel = new S_jobprogresssheet();
        $jobStoppageArray = json_decode($_POST['jobstop'], true);

        for ($Count = 0; $Count < count($jobStoppageArray); $Count++) {
            $isDone = 0;
            $isNotDone = 0;
            $isRefused = 0;
            if ($jobStoppageArray[$Count]['JobStopStatus'] === "Done") {
                $isDone = 1;
            } else {
                if ($jobStoppageArray[$Count]['JobStopStatus'] === "NotDone") {
                    $isNotDone = 1;
                } else {
                    $isRefused = 1;
                }
            }
            $addJobStopData = array(
                'idJobProgressSheet' => $jobModel->getIdJobData(),
                'idJobRef' => $jobStoppageArray[$Count]['StopJob'],
                'Cost' => $jobStoppageArray[$Count]['StopCost'],
                'CustomerContactDate' => explode("T", $jobStoppageArray[$Count]['JobStopClock'])[0],
                'CustomerContactTime' => explode("T", $jobStoppageArray[$Count]['JobStopClock'] ++)[1],
                'ClockOnDate' => explode("T", $jobStoppageArray[$Count]['JobStopClockOn'])[0],
                'ClockOnTime' => explode("T", $jobStoppageArray[$Count]['JobStopClockOn'] ++)[1],
                'ClockOffDate' => explode("T", $jobStoppageArray[$Count]['JobStopClockOff'])[0],
                'ClockOffTime' => explode("T", $jobStoppageArray[$Count]['JobStopClockOff'] ++)[1],
                'Remarks' => $jobStoppageArray[$Count]['JobStopRemarks'],
                'isDone' => $isDone,
                'isNotDone' => $isNotDone,
                'isRefused' => $isRefused,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertJobStoppage = $this->db->insert('s_jobstoppage', $addJobStopData);
            if ($insertJobStoppage) {
                $jobStoppageData = array();
                for ($aCount = 0; $aCount < count($jobStoppageArray[$Count]['JobStopStaff']); $aCount++) {
                    $jobStoppageData = array(
                        'idJobStoppage' => $jobModel->getIdJobStoppage(),
                        'idStaff' => $jobStoppageArray[$Count]['JobStopStaff'][$aCount],
                        'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                        'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                        'isActive' => $this->getFieldsValue()['isActive']
                    );
                    $insertJobStopStaff = $this->db->insert('s_jobstoppage_staff', $jobStoppageData);
                }
            } else {
                
            }
        }
    }

//    function addAdditionaJobStaff($idStaff) {
//
//        $addjobStaffData = array();
//        $jobModel = new S_jobprogresssheet();
//
//        for ($Count = 0; $Count < count($idStaff); $Count++) {
//            $addjobStaffData[] = array(
//                'idAdditionalJob' => $jobModel->getIdAdditionalJob(),
//                'idStaff' => $idStaff[$Count],
//                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
//                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
//                'isActive' => $this->getFieldsValue()['isActive']
//            );
//        }
//        $insertAddJobStaff = $this->db->insert_batch('s_addjob_staff', $addjobStaffData);
//    }

    function getRODetail() {

        $getfieldsValue = $this->getFieldsValue();
        $customerData = array(
            'CustomerName' => $this->input->post('CustomerName'),
            'AddressDetails' => $this->input->post('CustomerAddress'),
            'Cnic' => '',
            'Ntn' => '',
            'Cellphone' => $this->input->post('CustomerContact'),
            'Fax' => $this->input->post('CustomerFax'),
            'isPotentialCustomer' => 0,
            'CreatedDate' => $getfieldsValue['CreatedDate'],
            'ModifiedDate' => $getfieldsValue['ModifiedDate'],
            'isActive' => $getfieldsValue['isActive']
        );
        $insertCustomer = $customerModel->InsertCustomer($customerData);
        if ($insertCustomer === "Successfully Inserted") {
            $idCustomer = $customerModel->selectOneCustomer();
            return $idCustomer;
        }
    }

    function getAllJobs() {

        $jobModel = new S_jobprogresssheet();
        $search = $this->input->post('RONumber');
        $jobsData = $jobModel->getJobDetails($search);
        $allJobs = json_encode($jobsData);
        echo $allJobs;
    }

    function searchRONumber() {

        $roModel = new S_repairorder();
        $search = $this->input->post('searchRONumber');
        $roSearch = $roModel->searchRepairOrder($search);
        $rONumber = json_encode($roSearch);
        echo $rONumber;
    }

    // Body Shop Functions

    function AddBodyPaint() {
        $jobModel = new S_jobprogresssheet();
        $roModel = new S_repairorder();
        $idRO = $this->input->post('idRO');
        $newPanals = $this->input->post('newPanals');
        $isExistBPaintData = $roModel->isRecordExist('s_bodypaint_progress_sheet', 'idRepairOrderBill', $idRO);
        if (!$isExistBPaintData) {
            $bodyPaintProgressData = array(
                'idRepairOrderBill' => $idRO,
                'JobStartDate' => date("Y-m-d", strtotime($this->input->post('JobStartDate'))),
                'JobStartTime' => $this->input->post('JobStartTime'),
                'Remarks' => $this->input->post('BodyPaintRemarks'),
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $insertBodyPaintProgressData = $jobModel->InsertBodyPaintProgressData($bodyPaintProgressData);

            if ($newPanals == "+") {
                $addDentPanals = $this->addPanalDetails();
            }
            if ((isset($_POST['idDenter']) != NULL) && (isset($_POST['idPainter']) != NULL)) {
                $addStaffDetails = $this->addBodyPaintStaffDetails();
            } else {
                
            }
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">' . $insertBodyPaintProgressData . '</label>');
        } else {
            $this->session->set_flashdata('insertmessage', '<label style="font-weight: bolder;font-size:35px;">Body Shop Progress Sheet Already Exist For this RO</label>');
        }
        redirect(base_url() . "index.php/jobprogresssheet/index");
    }

    function addPanalDetails() {
        $dentData = array();
        $jobModel = new S_jobprogresssheet();
        $dentArray = json_decode($_POST['panals'], true);
        for ($dCount = 0; $dCount < count($dentArray); $dCount++) {
            if ($dentArray [$dCount]['dentpanals'] !== "Select Dent Panal") {
                $dentData[] = array(
                    'idBodyPaintProgressSheet' => $jobModel->getIdBodyPaintProgress(),
                    'idPanalDent' => $dentArray [$dCount]['dentpanals'],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
        }
        $this->db->insert_batch('s_bodypaint_dent_panal', $dentData);
        $paintData = array();
        for ($pCount = 0; $pCount < count($dentArray); $pCount++) {
            if ($dentArray[$pCount]['paintpanals'] !== "Select Paint Panal") {
                $paintData[] = array(
                    'idBodyPaintProgressSheet' => $jobModel->getIdBodyPaintProgress(),
                    'idPanalPaint' => $dentArray[$pCount]['paintpanals'],
                    'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                    'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                    'isActive' => $this->getFieldsValue()['isActive']
                );
            }
        }
        $this->db->insert_batch('s_bodypaint_paint_panal', $paintData);
    }

    function addBodyPaintStaffDetails() {
        $jobData = array();
        $jobModel = new S_jobprogresssheet();
        $paintArray = $_POST['idPainter'];
        $idBodyPaintProgressSheet = $jobModel->getIdBodyPaintProgress();
        for ($pCount = 0; $pCount < count($_POST['idPainter']); $pCount++) {
            $paintStaffData[] = array(
                'idBodyPaintProgressSheet' => $idBodyPaintProgressSheet, 'idPainterStaff' => $paintArray [$pCount],
                'idDenterStaff' => NULL,
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
        }
        $this->db->insert_batch('s_bodypaint_staff', $paintStaffData);

        $dentStaff = $_POST['idDenter'];
        for ($dCount = 0; $dCount < count($_POST['idDenter']); $dCount++) {
            $dentStaffData = array(
                'idDenterStaff' => $dentStaff[$dCount]
            );
            $this->db->where('idBodyPaintProgressSheet', $idBodyPaintProgressSheet);
            $this->db->update('s_bodypaint_staff', $dentStaffData);
        }
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1);
        return $fieldsValue;
    }

}
