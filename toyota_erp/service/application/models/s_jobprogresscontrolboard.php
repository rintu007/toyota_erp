<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class S_jobprogresscontrolboard extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('s_bays');

    }

    function ScheduleAppointment() {
        $this->db->trans_start(true);
//        $this->db->trans_begin();
        $CustomerData = array(
            'CompanyName' => $_POST['CompanyName'],
            'CompanyContact' => $_POST['CompanyContact'],
            'Cellphone' => $_POST['CustomerContact'],
            'CustomerName' => $_POST['CustomerName'],
            'Cnic' => $_POST['CustomerNIC'],
            'Ntn' => $_POST['CustomerNTN'],
            'AddressDetails' => $_POST['CustomerAddress'],
            'CreatedDate' => date('Y-m-d H:i:s'),
            'isActive' => '1'
        );

        $this->db->insert('s_cutomerdetail', $CustomerData);
        $idCustomer = $this->db->insert_id();

        $VehicleDate = array(
            'idVariant' => $_POST['Make'],
            'idCustomer' => $idCustomer,
            'Model' => $_POST['Model'],
            'RegistrationNumber' => $_POST['RegNumber'],
            'Mileage' => $_POST['KM'],
            'ChassisNumber' => $_POST['FrameNumber'],
            'EngineNumber' => $_POST['EngineNumber'],
            'ModelCode' => $_POST['ModelCode'],
            'EstNumber' => $_POST['EstNum'],
            'Year' => $_POST['Year'],
            'isEstimate' => '0',
            'CreatedDate' => date('Y-m-d H:i:s'),
            'isActive' => '1'
        );

        $this->db->insert('s_vehicle', $VehicleDate);
        $idVehicle = $this->db->insert_id();

        $AppointmentData = array(
            'AppointmentDate' => date("Y-m-d", strtotime($_POST['AppointmentDate'])),
            'color' => $_POST['color'],
            'idCategory' => $_POST['idCategory'],
            'StartTime' => $_POST['StartTime'],
            'EndTime' => $_POST['EndTime'],
            'RegistrationNumber' => $_POST['RegNumber'],
            'idBay' => $_POST['idBay'],
            'CustomerName' => $_POST['CustomerName'],
            'idCustomer' => $idCustomer,
            'idVehicle' => $idVehicle,
            'isCompleted' => 0,
            'isRoadTest' => 0,
            'isWash' => 0,
            'ExtendTime' => '00:00',
//            'LabourAmount' => $_POST['LabourAmount'],
            'EstimateAmount' => $_POST['EstimateAmount'],
            'additoinalInformation' => $_POST['additoinalInformation'],
//            'PartsAmount' => $_POST['Parts'],
//            'GrandTotal' => $_POST['GrandTotal'],
//            'isWarranty' => isset($_POST['isWarranty']),
//            'isPm' =>       isset($_POST['isPeriodicMaintenance']),
//            'isGr' =>       isset($_POST['isGeneralRepair']),
//            'isInternal' => isset($_POST['isInternal']),
//            'ReceptionDate' => date("Y-m-d", strtotime($_POST['PreferredDate'])),
//            'ReceptionTime' => $_POST['PreferredTime'],
//            'idPreferredStaff' => $_POST['PreferredStaff'],
//            'ConfirmationDate' => date("Y-m-d", strtotime($_POST['ConfirmDate'])),
//            'ConfirmationTime' => $_POST['ConfirmTime'],
//            'idConfirmationStaff' => $_POST['ConfirmStaff'],
//            'PartsOrderedDate' => date("Y-m-d", strtotime($_POST['PartsOrderedDate'])),
//            'PartsOrderedTime' => $_POST['PartsOrderedTime'],
//            'idPartsOrderedStaff' => $_POST['PartsOrderedStaff'],
//            'PartsArrivedDate' => date("Y-m-d", strtotime($_POST['PartsArrivedDate'])),
//            'PartsArrivedTime' => $_POST['PartsArrivedTime'],
//            'idPartsArrivedStaff' => $_POST['PartsArrivedStaff'],
//            'PreferredDeliveryDate' => date("Y-m-d", strtotime($_POST['PreferredDeliveryDate'])),
//            'PreferredDeliveryTime' => $_POST['PreferredDeliveryTime'],
//            'isCustomerBringIn' => ($_POST['isCDIn'] == '1') ? '1' : '0',
//            'isDealerPickup' => ($_POST['isCDIn'] == '0') ? '1' : '0',
//            'isCustomerComeIn' => ($_POST['isCDOut'] == '1') ? '1' : '0',
//            'isDealerDeliver' => ($_POST['isCDOut'] == '0') ? '1' : '0'
        );

        $this->db->insert('s_appointment', $AppointmentData);
        $idApointment = $this->db->insert_id();

        $AppointmentJobs = array();
        for ($i = 0; $i < count($_POST['Jobs']); $i++) {
            $AppointmentJobs[] = array(
                'idAppointment' => $idApointment,
                'idJobs' => $_POST['Jobs'][$i],
                'customerVoice' => $_POST['customerVoice'][$i],
                'laborCost' => $_POST['laborCost'][$i]
            );
        }

        $this->db->insert_batch('s_appointment_jobs', $AppointmentJobs);

//        $ConditionData = "";
//        $ConditionData[] = array(
//            'idAppointment' => $idApointment,
//            'idCondition' => $_POST['ConditionDetail0']
//        );
//        $ConditionData[] = array(
//            'idAppointment' => $idApointment,
//            'idCondition' => $_POST['ConditionDetail1']
//        );
//        $ConditionData[] = array(
//            'idAppointment' => $idApointment,
//            'idCondition' => $_POST['ConditionDetail2']
//        );
//        $ConditionData[] = array(
//            'idAppointment' => $idApointment,
//            'idCondition' => $_POST['ConditionDetail3']
//        );
//        $ConditionData[] = array(
//            'idAppointment' => $idApointment,
//            'idCondition' => $_POST['ConditionDetail4']
//        );
//
//        $this->db->insert_batch('s_appointment_condition', $ConditionData);

        foreach ($_POST['ConditionDetail'] as $row)
        {
            $cond = array(
                'idAppointment' => $idApointment,
                'idConditionConfirmationDetail'   => $row
            );
            $this->db->insert('s_appointment_condition', $cond);
        }

        if (isset($_POST['PartNumber'])) {
            $PartsData = array();
            for ($i = 0; $i < count($_POST['PartNumber']); $i++) {
                $PartsData[] = array(
                    'idAppointment' => $idApointment,
                    'idPart' => $_POST['PartNumber'][$i],
                    'Quantity' => $_POST['PartsQuantity'][$i],
//                    'isStock' => ($_POST['isStock'][$i] == "Out of Stock") ? '1' : '0',
                    'ETA' => $_POST['PartsETA'][$i],
//                    'ConfirmationDate' => date("Y-m-d", strtotime($_POST['PartsConfirmDate'])),
//                    'ConfirmationTime' => $_POST['PartsConfirmTime'],
//                    'idStaff' => $_POST['PartsConfirmStaff']
                );
            }
            $this->db->insert_batch('s_appointment_parts', $PartsData);
        }

//        $this->db->trans_rollback();die;
        $trans_complete = $this->db->trans_complete();

        return $trans_complete;
//        return true;
    }

    function AllJPCB() {
        $this->db->select('*');
        $this->db->from('s_jpcb');
        $this->db->join('s_jobreferencemanual', 's_jpcb.idJobPerform = s_jobreferencemanual.idJobRef', 'LEFT OUTER');
        $this->db->join('s_bay', 's_jpcb.idBay = s_bay.idBay', 'LEFT OUTER');
        $AllJPCB = $this->db->get();
//        return $AllJPCB->result_array();
        $dropdowns = $AllJPCB->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["jobref_id" => $dropdown->idJobRef, "JobTask" => $dropdown->JobTask, "section_id" => $dropdown->idBay, "text" => $dropdown->JobTask . " " . $dropdown->RegistrationNumber, "start_date" => $dropdown->StartDate . " " . $dropdown->StartTime, "end_date" => $dropdown->EndDate . " " . $dropdown->EndTime]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function get_s_category()
    {
        $this->db->select('*');
        $this->db->from('s_category');
        $this->db->where('s_category.isActive != 0');
        $category = $this->db->get();
        return $category->result_array();
    }

    function InsertJpcb($JPCBData) {

        $InsertJPCB = $this->db->insert('s_jpcb', $JPCBData);
        if ($InsertJPCB) {
            return True;
        } else {
            return False;
        }
    }

    function UpdateJrm($idJrm, $jrmData) {

        $this->db->where('idJobRef', $idJrm);
        $this->db->update('s_jobreferencemanual', $jrmData);
        return "Successfully Updated";
    }

    function DeleteJrm($idJrm) {

        $this->db->set('isActive', 0);
        $this->db->where('idJobRef', $idJrm);
        $this->db->update('s_jobreferencemanual');
        return "Successfully Deleted";
    }

    function getAllJrm() {

        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->where('s_jobreferencemanual.isActive != 0');
        $baysList = $this->db->get();
        return $baysList->result_array();
    }

    function searchJrm($SearchKeyword) {

        $this->db->select('*');
        $this->db->from('s_jobreferencemanual');
        $this->db->like('JobTask', $SearchKeyword);
        $this->db->where('isActive', 1);
        $searchJrm = $this->db->get();
        return $searchJrm->result_array();
    }

    function AllAppointments($date = NULL) {
        if ($date == NULL) {
            $this->db->select('*');
            $this->db->from('ViewAppointments');
            $this->db->where('AppointmentDate', date('Y-m-d'));
            $this->db->where('isCompleted', '0');
            $Appointments = $this->db->get();
            $result = $Appointments->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('ViewAppointments');
            $this->db->where('AppointmentDate', $date);
            $this->db->where('isCompleted', '0');
            $Appointments = $this->db->get();
            $result = $Appointments->result_array();
        }

//        $data = array();
        $data['Bay 1'] = array();
        $data['Bay 2'] = array();
        $data['Bay 3'] = array();
        $data['Bay 4'] = array();
        $data['Bay 5'] = array();
        $data['Waiting'] = array();
        $data['RoadTest'] = array();
        $data['Wash'] = array();
        $EndTimeBay1 = "";
        $EndTimeBay2 = "";
        $EndTimeBay3 = "";
        $EndTimeBay4 = "";
        $EndTimeBay5 = "";
        $RoadTestBay1 = "";
        $RoadTestBay2 = "";
        $RoadTestBay3 = "";
        $RoadTestBay4 = "";
        $RoadTestBay5 = "";
        foreach ($result as $GetAll) {
            if ($GetAll['BayName'] == "Bay 1") {
                if ($EndTimeBay1 == "") {
                    if ($GetAll['isRoadTest'] == '0' && $GetAll['isWash'] == '0') {
                        array_push($data["Bay 1"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay1 = $GetAll['EndTime'];
                        $RoadTestBay1 = '0';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '0') {
                        array_push($data["RoadTest"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay1 = $GetAll['EndTime'];
                        $RoadTestBay1 = '1';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '1') {
                        array_push($data["Wash"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay1 = $GetAll['EndTime'];
                        $RoadTestBay1 = '1';
                    }
                } else {
                    if ($EndTimeBay1 <= $GetAll['StartTime'] && $RoadTestBay1 == '1') {
                        array_push($data["Bay 1"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    } else {
                        array_push($data["Waiting"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    }
                }
            } else if ($GetAll['BayName'] == "Bay 2") {
                if ($EndTimeBay2 == "") {
                    if ($GetAll['isRoadTest'] == '0' && $GetAll['isWash'] == '0') {
                        array_push($data["Bay 2"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay2 = $GetAll['EndTime'];
                        $RoadTestBay2 = '0';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '0') {
                        array_push($data["RoadTest"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay2 = $GetAll['EndTime'];
                        $RoadTestBay2 = '1';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '1') {
                        array_push($data["Wash"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay2 = $GetAll['EndTime'];
                        $RoadTestBay2 = '0';
                    }
                } else {
                    if ($EndTimeBay2 <= $GetAll['StartTime'] && $RoadTestBay2 == '1') {
                        array_push($data["Bay 2"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    } else {
                        array_push($data["Waiting"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    }
                }
            } else if ($GetAll['BayName'] == "Bay 3") {
                if ($EndTimeBay3 == "") {
                    if ($GetAll['isRoadTest'] == '0' && $GetAll['isWash'] == '0') {
                        array_push($data["Bay 3"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay3 = $GetAll['EndTime'];
                        $RoadTestBay3 = '0';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '0') {
                        array_push($data["RoadTest"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay3 = $GetAll['EndTime'];
                        $RoadTestBay3 = '1';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '1') {
                        array_push($data["Wash"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay3 = $GetAll['EndTime'];
                        $RoadTestBay3 = '0';
                    }
                } else {
                    if ($EndTimeBay3 <= $GetAll['StartTime'] && $RoadTestBay3 == '1') {
                        array_push($data["Bay 3"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    } else {
                        array_push($data["Waiting"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    }
                }
            } else if ($GetAll['BayName'] == "Bay 4") {
                if ($EndTimeBay4 == "") {
                    if ($GetAll['isRoadTest'] == '0' && $GetAll['isWash'] == '0') {
                        array_push($data["Bay 4"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay4 = $GetAll['EndTime'];
                        $RoadTestBay4 = '0';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '0') {
                        array_push($data["RoadTest"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay4 = $GetAll['EndTime'];
                        $RoadTestBay4 = '1';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '1') {
                        array_push($data["Wash"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay4 = $GetAll['EndTime'];
                        $RoadTestBay4 = '0';
                    }
                } else {
                    if ($EndTimeBay4 <= $GetAll['StartTime'] && $RoadTestBay4 == '1') {
                        array_push($data["Bay 4"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    } else {
                        array_push($data["Waiting"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    }
                }
            } else if ($GetAll['BayName'] == "Bay 5") {
                if ($EndTimeBay5 == "") {
                    if ($GetAll['isRoadTest'] == '0' && $GetAll['isWash'] == '0') {
                        array_push($data["Bay 5"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay5 = $GetAll['EndTime'];
                        $RoadTestBay5 = '0';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '0') {
                        array_push($data["RoadTest"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay5 = $GetAll['EndTime'];
                        $RoadTestBay5 = '1';
                    } else if ($GetAll['isRoadTest'] == '1' && $GetAll['isWash'] == '1') {
                        array_push($data["Wash"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                        $EndTimeBay5 = $GetAll['EndTime'];
                        $RoadTestBay5 = '0';
                    }
                } else {
                    if ($EndTimeBay5 <= $GetAll['StartTime'] && $RoadTestBay5 == '0') {
                        array_push($data["Bay 5"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    } else {
                        array_push($data["Waiting"], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => ($GetAll['ExtendTime'] == NULL) ? '00:00' : $GetAll['ExtendTime'], "addtionalTime" => "00:00"]);
                    }
                }
            }
        }
//        print_r($data);
        return $data;
    }

    function AllAsb() {

        $start = $_GET['start'];
        $end   = $_GET['end'];

            $this->db->select('*');
            $this->db->from('ViewAppointments');
            $this->db->where('date(`AppointmentDate`) >= ', $start);
            $this->db->where('date(`AppointmentDate`) <', $end);
            $this->db->where('isCompleted', '0');
            $Appointments = $this->db->get();
            $result = $Appointments->result_array();


        return $result;

        $data = array();

        $this->db->select('*');
        $this->db->from('s_bay');
        $this->db->where('isActive', 1);
        $BaysList = $this->db->get()->result_array();

        foreach ($BaysList as $Bay) {
            $data[$Bay['BayName']] = array();
        }

        foreach ($result as $GetAll)
        {
            array_push($data[$GetAll['BayName']], ["idAppointment" => $GetAll['idAppointment'], "Name" => $GetAll['CustomerName'], "startTime" => $GetAll['StartTime'], "endTime" => $GetAll['EndTime'], "extendedTime" => '00:00', "addtionalTime" => "00:00"]);
        }

        return $data;
    }

    function EditAppointment($idAppointment, $Data) {
        $this->db->where('idAppointment', $idAppointment);
        $update = $this->db->update('s_appointment', $Data);
        if ($update) {
            return "Updated";
        } else {
            return "error";
        }
    }

    function selectOne() {
        
    }

    function selectAll() {
        
    }

    function AllJobRef() {
        $query = $this->db->query('SELECT idJobRef, JobTask FROM s_jobreferencemanual');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idJobRef" => $dropdown->idJobRef, "JobTask" => $dropdown->JobTask]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function AllBays() {
        $query = $this->db->query('SELECT idBay, BayName FROM s_bay');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idBay" => $dropdown->idBay, "BayName" => $dropdown->BayName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function AppointmentJobs($idAppointment) {
        $this->db->select('*');
        $this->db->from('ViewAppointmentJobs');
        $this->db->where('idAppointment', $idAppointment);
        $Appointments = $this->db->get();
        $result = $Appointments->result_array();
        return $result;
    }

    function Appointment($idAppointment) {
        $this->db->select('*');
        $this->db->from('ViewAppointments');
        $this->db->where('idAppointment', $idAppointment);
        $Appointments = $this->db->get();
        $result = $Appointments->result_array();
        return $result;
    }

    function GetParts($idPart) {
        $this->db->select('Quantity');
        $this->db->from('parts_name');
        $this->db->where('idPart', $idPart);
        $Parts = $this->db->get();
        $result = $Parts->result_array();
        if ($result[0]['Quantity'] > 0) {
            $this->db->select('*');
            $this->db->from('parts_name');
            $this->db->where('idPart', $idPart);
            $GetParts = $this->db->get();
            $result1 = $GetParts->result_array();
            return $result1;
        } else {
            return "Out of Stock";
        }
    }

    function get_appointment_list( $perpage = '', $limit = '')
    {
        $this->db->select('*')->from('viewappointments');
//        $this->db->join('car_dispatch','car_dispatch.idDispatch = car_receive.idDispatch');
//        $this->db->join('car_pbo','car_pbo.Id = car_dispatch.PboId');


        if(isset($_POST['RegistrationNumber']) && $_POST['RegistrationNumber']!='')
        {
            $this->db->where('RegistrationNumber', $_POST['RegistrationNumber']);
        }
        if(isset($_POST['AppointmentDate']) && $_POST['AppointmentDate']!='')
        {
            $this->db->where('AppointmentDate', $_POST['AppointmentDate']);
        }
        if(isset($_POST['idBay']) && $_POST['idBay']!='')
        {
            $this->db->where('idBay', $_POST['idBay']);
        }
        if(isset($_POST['CustomerName']) && $_POST['CustomerName']!='')
        {
            $this->db->like('CustomerName', $_POST['CustomerName']);
        }

        $this->db->limit($perpage, $limit);
        $this->db->order_by("idAppointment",'desc');
        $query =  $this->db->get();




        return $query->result_array();


    }
    function get_appointments_count()
    {
        return $this->db->count_all_results('s_appointment');
    }

}
