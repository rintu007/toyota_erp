<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jpcb extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('s_repairorder');
        $this->load->model('s_rochecklist');
        $this->load->model('s_rofinance');
        $this->load->model('s_financeinfo');
        $this->load->model('s_fuelmanagement');
        $this->load->model('s_jobreferencemanual');
        $this->load->model('s_partsuseage');
        $this->load->model('s_subletrepairuseage');
        $this->load->model('s_luboiluseage');
        $this->load->model('s_staff');
        $this->load->model('s_customer');
        $this->load->model('s_vehicle');
        $this->load->model('s_bodypaint');
        $this->load->model('s_allbrands');
        $this->load->model('s_allmodels');
        $this->load->model('s_allvehicles');
        $this->load->model('s_bodypaint');
        $this->load->model('s_conditionconfirmationdetail');
        $this->load->model('s_periodicmaintenancedetails');
        $this->load->model('s_jobprogresscontrolboard');
        $this->load->model('s_bays');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {
        $dataArray = array();
        $repairOrderModel = new S_repairorder();
        $BayModel = new S_bays();
        $checkListModel = new S_Rochecklist();
        $financeModel = new S_financeinfo();
        $jobRefManual = new S_jobreferencemanual();
        $fuelManagment = new S_fuelmanagement();
        $staffManagment = new S_staff();
        $allBrands = new S_allbrands();
        $allVehicles = new S_allvehicles();
        $allModels = new S_allmodels();
        $pmdModel = new S_periodicmaintenancedetails();
        $conditionModel = new S_conditionconfirmationdetail();

        $dataArray['Response'] = $this->session->flashdata('Appointment');
        $dataArray['ROMode'] = $repairOrderModel->getROModes();
        $dataArray['RONumber'] = $repairOrderModel->generateRONumber();
        $dataArray['condConfirm'] = $conditionModel->getConditionDetail();
        $dataArray['partsList'] = $repairOrderModel->fillPartCombo();
        $dataArray['checkList'] = $checkListModel->getAllRoCheckList();
        $dataArray['financeInfoList'] = $financeModel->getFinanceInfo();
        $dataArray['mechanicalJobs'] = $jobRefManual->getMechanicalJobs();
//        var_dump($dataArray['mechanicalJobs']);die;
        $dataArray['bodyPaintJobs'] = $jobRefManual->getBodyPaintJobs();
        $dataArray['fuelVolume'] = $fuelManagment->getFuelInfo();
        $dataArray['gasVolume'] = $repairOrderModel->getGasInfo();
        $dataArray['technicianList'] = $staffManagment->getTechnicianStaff();
        $dataArray['serviceAdvList'] = $staffManagment->getServiceAdvisor();
        $dataArray['foremanList'] = $staffManagment->getForemanStaff();
        $dataArray['brandsList'] = $allBrands->getAllBrands();
        $dataArray['pmdList'] = $pmdModel->getAllPmd();
        $dataArray['bay'] = $BayModel->AllBays();
        $dataArray['staff'] = $staffManagment->AllStaff();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $this->load->view('header');
        $this->load->view('appointment', $dataArray);
        $this->load->view('footer');
    }

    function plan() {
//        $Bays = new S_bays();
//        $JobRefManual = new S_jobreferencemanual();
//        $Jpcb = new S_jobprogresscontrolboard();
//        $AllBays = $Bays->AllBays();
//        $AllJobRef = $JobRefManual->AllJobRef();
//        $Data['Bays'] = json_encode($AllBays);
//        $Data['JobRef'] = json_encode($AllJobRef);
//        $Data['AllJpcb'] = json_encode($Jpcb->AllJPCB());
//        $this->load->view('jobprogresscontrolboard', $Data);
        $this->load->view('jpcb');
    }

    function asb($date = NULL) {
        $Bays = new S_bays();
        $AllBays = $Bays->AllBays();


        $bay = array();
        foreach ($AllBays as $row)
        {
            array_push($bay,$row['label']);
        }

        $Data['Bays'] = json_encode($bay);

        $res = $Bays->getAll();
        $Data['resource'] = json_encode($res,false);

//        $JPCB = new S_jobprogresscontrolboard();
//        $Data['allAppointments']= json_encode($JPCB->AllAsb('2017-09-13'));

//        var_dump($Data['allAppointments']);die;

//        var_dump($res);die;



//        $JobRefManual = new S_jobreferencemanual();
//        $Jpcb = new S_jobprogresscontrolboard();
//        var_dump($AllBays);die;

////        $AllJobRef = $JobRefManual->AllJobRef();
//        $Data['JobRef'] = json_encode($AllJobRef);
//        $Data['AllJpcb'] = json_encode($Jpcb->AllJPCB());
        if ($date == NULL) {
            $Data['date'] = date('Y-m-d');
        } else {
            $Data['date'] = $date;
        }
//        $this->load->view('jobprogresscontrolboard', $Data);
        $this->load->view('asb1', $Data);
    }

    function Add() {
        $repairOrderModel = new S_repairorder();
        $financeInfoModel = new S_financeinfo();
        $conditionModel = new S_conditionconfirmationdetail();
        $isFIR = $this->input->post('isFIR');
        $isWorkOrderAttach = $this->input->post('isWorkOrder');
        $isOrignalTools = $this->input->post('isOrignial');
        $idRoMode = $this->input->post('isM');
        $newRow = $this->input->post('newRow');
        $newRowParts = $this->input->post('newRowParts');
        $newRowSublet = $this->input->post('newRowSublet');
        $newRowLub = $this->input->post('newRowLubricants');
        $approvedLabour = $this->input->post('LabourRs');
        $getJob = $this->input->post('isM');
        $idFinance = $this->input->post('FinanceList');
        $netTotal = $this->input->post('NetTotal');

        $financeName = $financeInfoModel->selectOneFinanceInfo($idFinance);

        if ($financeName === 'Others') {
            $otherFinance = $this->input->post('InputOther');
        } else {
            $otherFinance = NULL;
        }

        if ($isFIR == "1") {
            $isFIR = 1;
        } else {
            $isFIR = 0;
        }

        if ($isWorkOrderAttach == "1") {
            $isWorkOrderAttach = 1;
        } else {
            $isWorkOrderAttach = 0;
        }

        if ($isOrignalTools == "1") {
            $isOrignalTools = 1;
        } else {
            $isOrignalTools = 0;
        }

        if ($this->input->post('idStaff') === "Select Technician") {
            $idStaff = NULL;
        } else {
            $idStaff = $this->input->post('idStaff');
        }

        if ($this->input->post('Foreman') === "Select Foreman") {
            $idForeman = NULL;
        } else {
            $idForeman = $this->input->post('Foreman');
        }

        $idCustomer = $this->getCustomer();
        $repairOrderData = array(
            'idCustomerDetail' => $idCustomer,
            'idVehicle' => $this->getVehicle(),
            'idFinance' => $idFinance,
            'idFuel' => $this->input->post('FuelVolume'),
            'idCNG' => $this->input->post('CNGVolume'),
            'idLPG' => $this->input->post('LPGVolume'),
            'RONumber' => $this->input->post('RoNumber'),
            'CashMemoNumber' => $this->input->post('CashMemo'),
            'CreditMemoNumber' => $this->input->post('CreditMemo'),
            'BookInDate' => $this->input->post('BookDate'),
            'BookInTime' => $this->input->post('BookTime'),
            'DeliveryDate' => $this->input->post('DeliveryDate'),
            'DeliveryTime' => $this->input->post('DeliveryTime'),
            'VOC' => $this->input->post('VOC'),
            'LabourAmount' => $this->input->post('Labour'),
            'LubOilAmount' => $this->input->post('LubOil'),
            'SubletRepairAmount' => $this->input->post('SubletRepair'),
            'PartsAmount' => $this->input->post('Parts'),
            'GrandTotal' => $this->input->post('GrandTotal'),
            'GSTax' => $this->input->post('GST'),
            'NetTotal' => $netTotal,
            'isWorkOrderAttach' => $isWorkOrderAttach,
            'isPSFU' => 0,
            'idStaff' => $idStaff,
            'idForeman' => $idForeman,
            'idROMode' => $idRoMode,
            'isPaymentCleared' => 0,
            'isFIR' => $isFIR,
            'Status' => 'open',
            'MileageBefTesting' => $this->input->post('MBRT'),
            'MileageAftTesting' => $this->input->post('MART'),
            'ToolsQuantity' => $this->input->post('toolsQty'),
            'isOrignalTools' => $isOrignalTools,
            'OtherFinance' => $otherFinance,
            'FinanceRefNo' => $this->input->post('FinanceRefNo'),
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $insertRepairOrder = $repairOrderModel->InsertRepairOrder($repairOrderData);
        if ($getJob === "1") {
            $addMechJob = $this->addMechJob();
            if ($this->input->post('SelectPMPackage') != "Select PM Packages") {
                $addPMPackage = $this->addPMPackage($this->input->post('SelectPMPackage'));
            }
        }
        if ($getJob === "0") {
            $addBodyPaint = $this->addBodyPaint();
        }
        if (count($_POST['ConditionDetail']) > 0) {
            $addJobCondition = $this->addJobCondition();
        }
        $addCheckList = $this->addCheckList();

        if ($newRow == "-") {
            $addWorkPerfomed = $this->addWorkPerformed();
        }

        if ($newRowSublet == "-") {
            $addSubletUseage = $this->addSubletUseage();
        }
        $this->Receivable($idCustomer, $netTotal);
        $this->session->set_flashdata('insertmessage', '<h4>' . $insertRepairOrder . '</h4>');
        redirect(base_url() . "index.php/repairorder/index");
    }

    function GetJobRef() {
        $JobRefManual = new S_jobreferencemanual();
        $AllJobRef = $JobRefManual->AllJobRef();
        echo json_encode($AllJobRef);
    }

    function updateAppointment() {
        $JPCB = new S_jobprogresscontrolboard();
        $idAppointment = $this->input->post('idAppointment');
        $Data = array(
            'ExtendTime' => $this->input->post('ExtendTime'),
            'isRoadTest' => ($this->input->post('RoadTest')=='1')?1:0,
			'idBay' => $this->input->post('idBay')
        );
        $editAppointment = $JPCB->EditAppointment($idAppointment, $Data);
        if ($editAppointment == "Updated") {
            echo "Updated";
        }
    }

    function updatewash() {
        $JPCB = new S_jobprogresscontrolboard();
        $idAppointment = $this->input->post('idAppointment');
        $Data = array(
            'isWash' => ($this->input->post('Wash') == '1') ? 1 :0
        );
        $editAppointment = $JPCB->EditAppointment($idAppointment, $Data);
        if ($editAppointment == "Updated") {
            echo "Updated";
        }
    }

    function updatecomplete() {
        $JPCB = new S_jobprogresscontrolboard();
        $idAppointment = $this->input->post('idAppointment');
        $Data = array(
            'isCompleted' => ($this->input->post('Complete')=='1')?1:0
        );
        $editAppointment = $JPCB->EditAppointment($idAppointment, $Data);
        if ($editAppointment == "Updated") {
            echo "Updated";
        }
    }

    function AllAppointments($date = NULL) {
        $JPCB = new S_jobprogresscontrolboard();
        if ($date == NULL) {
            $allAppointments = $JPCB->AllAppointments();
        } else {
            $allAppointments = $JPCB->AllAppointments($date);
        }
        echo json_encode($allAppointments);
    }

    function AllAsb() {
        $date = $_GET['start'];
        $JPCB = new S_jobprogresscontrolboard();

            $allAppointments = $JPCB->AllAsb();

        echo json_encode($allAppointments);
    }

    function form($idAppointment) {
        $JPCB = new S_jobprogresscontrolboard();
        $Data['AllJobs'] = $JPCB->AllJobRef();
        $Data['AllBays'] = $JPCB->AllBays();
        $Data['Appointment'] = $JPCB->Appointment($idAppointment)[0];
        $Data['Jobs'] = $JPCB->AppointmentJobs($idAppointment);
        $this->load->view('form', $Data);
    }

    function roadwash($idAppointment) {
        $Data['Appointment'] = $idAppointment;
        $this->load->view('roadwash', $Data);
    }

    function washcomplete($idAppointment) {
        $Data['Appointment'] = $idAppointment;
        $this->load->view('complete', $Data);
    }

}
