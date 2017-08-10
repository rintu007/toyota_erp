<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_invoices extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getDealerCode() {
        $DealerCode = $this->db->select('Code')->from('car_sub_dealer')->get();

        return $DealerCode->result_array();
    }

    //*************** START ****************//
    //************ M Package ORDER *************//
    function getUrgentOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Urgent Order')->get();
        return $invoiceType->result_array();
    }

    function allUrgentOrders() {
//        $AllDailyOrder = $this->db->select('*')->from('viewurgentorder')->order_by('Date', 'ASC')->get();
        $AllDailyOrder = $this->db->select('*')->from('viewurgentorder')->Where(['Date' => date('Y-m-d'), "isActive" => "1", "BrandCode" => $this->session->userdata('BrandCode')])->get();
        return $AllDailyOrder->result_array();
    }

    function saveUrgentOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Urgent Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
//        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = $this->input->post('Dispatch_Mode');
        $idDispatch = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatch,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneUrgentOrder($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewurgentorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteUrgentOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    //
    //
    //*************** START ****************//
    //************ M Package ORDER *************//
    function getMPackageOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'M Package Order')->get();
        return $invoiceType->result_array();
    }

    function allMPackageOrders() {
//        $AllDailyOrder = $this->db->select('*')->from('viewmpackageorder')->order_by('Date', 'ASC')->get();
        $AllDailyOrder = $this->db->select('*')->from('viewmpackageorder')->Where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->get();
        return $AllDailyOrder->result_array();
    }

    function saveMPackageOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('M Package Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneMPackageOrder($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewmpackageorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteMPackageOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    //
    //
    //*************** START ****************//
    //************ D Package ORDER *************//
    function getDPackageOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'D Package Order')->get();
        return $invoiceType->result_array();
    }

    function allDPackageOrders() {
//        $AllDailyOrder = $this->db->select('*')->from('viewdpackageorder')->order_by('Date', 'ASC')->get();
        $AllDailyOrder = $this->db->select('*')->from('viewdpackageorder')->Where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->get();
        return $AllDailyOrder->result_array();
    }

    function saveDPackageOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('D Package Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
//        $Month = str_replace('0', '', $month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $DispatchId = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneDPackageOrder($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewdpackageorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteDPackageOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    //
    //
    //*************** START ****************//
    //************ ACCESSORIES ORDER *************//
    function getAccessoriesOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Accessories Order')->get();
        return $invoiceType->result_array();
    }

    function allAccessoriesOrders() {
        $AllDailyOrder = $this->db->select('*')->from('viewaccessoriesorder')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function saveAccessoriesOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Accessories Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $DispatchId = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneAccessoriesOrder($OrderNumber) {
        $OneDailyOrder = $this->db->select('idOrderNumber')->from('viewaccessoriesorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneDailyOrder->result_array();
    }

    function deleteAccessoriesOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    //
    //
        //*************** START ****************//
    //************ SPECIAL OFFER *************//
    function getSpecialOfferCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Special Offer')->get();
        return $invoiceType->result_array();
    }

    function allSpecialOffers() {
        $AllDailyOrder = $this->db->select('*')->from('viewspecialoffer')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function saveSpecialOffer() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Special Offer');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $DispatchId = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $SpecialPrice = $this->input->post('SpecialPrice');
        $PackageDate = $this->input->post('PackageDate');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity,
            "SpecialPrice" => $SpecialPrice,
            "PackageDate" => $PackageDate,
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneSpecialOffer($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewspecialoffer')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteSpecialOffer($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    //
    //
    //*************** START ****************//
    //************ PLAN ORDER *************//
    function getPlanOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Plan Order')->get();
        return $invoiceType->result_array();
    }

    function allPlanOrders() {
        $AllDailyOrder = $this->db->select('*')->from('viewplanorder')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function savePlanOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Plan Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $WSPrice = $this->input->post('WSPrice');
        $TotalPrice = $this->input->post('TotalPrice');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity,
            "WSPrice" => $WSPrice,
            "TotalPrice" => $TotalPrice
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function onePlanOrder($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewplanorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deletePlanOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    //
    //
    //*************** START ****************//
    //************ BY SEA ORDER *************//
    function getBySeaOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'By Sea Order')->get();
        return $invoiceType->result_array();
    }

    function allBySeaOrders() {
        $AllDailyOrder = $this->db->select('*')->from('viewbyseaorder')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function saveBySeaOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('By Sea Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();
        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $SeaPrice = $this->input->post('BySeaPrice');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity,
            "TWMUnitPriceSea" => $SeaPrice
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneBySeaOrder($OrderNumber) {
        $OneBySeaOrder = $this->db->select('idOrderNumber')->from('viewbyseaorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneBySeaOrder->result_array();
    }

    function deleteBySeaOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    //
    //
    ////*************** START ****************//
    //************ DAILY ORDER *************//
    function getDailyOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Daily Order')->get();
        return $invoiceType->result_array();
    }

    function selectDailyOrder() {
        $PartName = $this->db->select('*')->from('viewDailyOrder')->get();
        return $PartName->result_array();
    }

    function allDailyOrders() {
        $AllDailyOrder = $this->db->select('*')->from('viewdailyorder')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
//        $AllDailyOrder = $this->db->select('*')->from('viewdailyorder')->Where('Date', date('Y-m-d'))->get();
        return $AllDailyOrder->result_array();
    }

    function saveDailyOrder() {

        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Daily Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
//        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumberData = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumberData);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        ;
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
//        echo "<br>Invoice Details:";
//        print_r($InvoiceDetails);
//        echo "<br>Order Number :";
//        print_r($OrderNumber);

        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function updateDailyOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNum = $this->getOrderNumber();
        $OrderNo = $OrderNum['Number'];
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Daily Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        $month_only = date('m', $time);
        $Month = $month_only;
//        $Month = str_replace('0', '', $month_only);
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNo + 1,
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );

        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $DispatchId = $this->getDispatchMode($DispatchMode);
        $idDispatch = $DispatchId['idDispatch'];
        $idPart = $this->input->post('idPart');
        $Quantity = $this->input->post('Quantity');
        $OrderNumber = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatch,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );

        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneDailyOrder($OrderNumber) {
        $OneDailyOrder = $this->db->select('idOrderNumber')->from('viewdailyorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneDailyOrder->result_array();
    }

    function searchDailyOrder($searchKeyword) {
        $PartName = $this->db->select('*')->from('viewdailyorder')->like('PartNumber', $searchKeyword)->get();
        return $PartName->result_array();
    }

    function deleteDailyOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //*************** END ****************//
    ////*************** START ****************//
    //************ Dhamaka Package *************//

    function getDhamakaPackageCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Dhamaka Package')->get();
        return $invoiceType->result_array();
    }

    function allDhamakaPackage() {
        $AllDailyOrder = $this->db->select('*')->from('viewdhamakapackage')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
//        $AllDailyOrder = $this->db->select('*')->from('viewdhamakapackage')->Where('Date', date('Y-m-d'))->get();
        return $AllDailyOrder->result_array();
    }

    function saveDhamakaPackage() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Plan Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneDhamakaPackage($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewdhamakapackage')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteDhamakaPackage($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    ////*************** START ****************//
    //************ Dhamaka Package *************//

    function getMaintenancePackageCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Maintenance Package')->get();
        return $invoiceType->result_array();
    }

    function allMaintenancePackage() {
        $AllDailyOrder = $this->db->select('*')->from('viewmaintenancepackage')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
//        $AllDailyOrder = $this->db->select('*')->from('viewmaintenancepackage')->Where('Date', date('Y-m-d'))->get();
        return $AllDailyOrder->result_array();
    }

    function saveMaintenancePackage() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Plan Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneMaintenancePackage($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewmaintenancepackage')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteMaintenancePackage($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    ////*************** START ****************//
    //************ Dhamaka Package *************//
    function getWarrantyOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Warranty Order')->get();
        return $invoiceType->result_array();
    }

    function allWarrantyOrder() {
        $AllDailyOrder = $this->db->select('*')->from('viewwarrantyorder')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allBrands() {
        $allBrands = $this->db->select('*')->from('car_parent')->get();
        return $allBrands->result_array();
    }

    function saveWarrantyOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Warranty Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();
        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $ModelCode = $this->input->post('ModelCode');
        $FrameNo = $this->input->post('FrameNo');
        $TrNo = $this->input->post('TrNo');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity,
            "ModelCode" => $ModelCode,
            "FrameNo" => $FrameNo,
            "TrNo" => $TrNo
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneWarrantyOrder($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewwarrantyorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteWarrantyOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    ////*************** START ****************//
    //************ TGMO *************//
    function getTGMOCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Toyota Genuine Motor Oil')->get();
        return $invoiceType->result_array();
    }

    function allTgmo() {
        $AllDailyOrder = $this->db->select('*')->from('viewtgmo')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function saveTgmo() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Toyota Genuine Motor Oil');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');
        $LTR = $this->input->post('Quantity');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity,
            "LTR" => $LTR
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneTgmo($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewtgmo')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteTgmo($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    ////*************** START ****************//
    //************ Chemical Order *************//
    function getChemicalOrderCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Chemical Order')->get();
        return $invoiceType->result_array();
    }

    function oneChemicalOrder($OrderNumber) {
        $OneChemicalOrder = $this->db->select('idOrderNumber')->from('viewchemicalorder')->where('OrderNumber', $OrderNumber)->get();
        return $OneChemicalOrder->result_array();
    }

    function allChemicalOrder() {
        $AllDailyOrder = $this->db->select('*')->from('viewchemicalorder')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function saveChemicalOrder() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Chemical Order');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function deleteChemicalOrder($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    ////*************** START ****************//
    //************ VOR Package *************//
    function getVORCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'VOR')->get();
        return $invoiceType->result_array();
    }

    function allVOR() {
        $AllDailyOrder = $this->db->select('*')->from('viewvor')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function saveVOR() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('VOR');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
//        $DispatchMode = $this->input->post('Dispatch_Mode');
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $ModelCode = $this->input->post('ModelCode');
        $FrameNo = $this->input->post('FrameNo');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity,
            "ModelCode" => $ModelCode,
            "FrameNo" => $FrameNo
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneVOR($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewvor')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteVOR($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    ////*************** START ****************//
    //************ Dhamaka Package *************//
    function getLocalPurchaseCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Local Purchase')->get();
        return $invoiceType->result_array();
    }

    function allLocalPurchase() {
        $AllDailyOrder = $this->db->select('*')->from('viewlocalpurchase')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function saveLocalPurchase() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Local Package');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
//        $DispatchMode = $this->input->post('Dispatch_Mode');
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $UnitPrice = $this->input->post('UnitPrice');
        $TotalPrice = $this->input->post('TotalPrice');
        $PackageDate = $this->input->post('PackageDate');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity,
            "UnitPrice" => $UnitPrice,
            "TotalPrice" => $TotalPrice,
            "PackageDate" => $PackageDate
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneLocalPurchase($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewlocalpurchase')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteLocalPurchase($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//
    ////*************** START ****************//
    //************ Other  *************//
    function getOtherPurchaseCode() {
        $invoiceType = $this->db->select('*')->from('invoice_claim_type')->where('Title', 'Other Purchase')->get();
        return $invoiceType->result_array();
    }

    function allOtherPurchase() {
        $AllDailyOrder = $this->db->select('*')->from('viewotherpurchase')->where(['Date' => date('Y-m-d'), "BrandCode" => $this->session->userdata('BrandCode'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function saveOtherPurchase() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $this->db->trans_start();
        //Data For Order_Number Table..
        $OrderNo = $this->input->post('OrderNumber');
        $OrderNum = strstr($OrderNo, '-');
        $OrderNumber = str_replace('-', "", $OrderNum);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('Other Purchase');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $DealerRemarks = $this->input->post('DealerRemarks');
        $IMCRemarks = $this->input->post('IMCRemarks');
        $date = date('Y/m/d');
        $time = strtotime($date);
        //        $Month = str_replace('0', '',$month_only);
        $month_only = date('m', $time);
        $Month = $month_only;
        $OrderNumber = array(
            "DealerId" => $idDealer,
            "TypeId" => $idType,
            "Month" => $Month,
            "Number" => $OrderNumber,
            "BrandCode" => $this->session->userdata('BrandCode'),
            "DealerRemarks" => $DealerRemarks,
            "IMCRemarks" => $IMCRemarks,
            "Date" => $Date
        );
        $this->db->insert('order_number', $OrderNumber);
        $idOrderNumber = $this->db->insert_id();

        //Data For Order_Number Table..
        $DispatchMode = "By Road";
        $idDispatchMode = $this->getDispatchMode($DispatchMode)[0]['idDispatch'];
//        echo "<br>Dispatch ID:" . $DispatchMode . "<br>";
//        print_r($DispatchId);
//        $idDispatch = $DispatchMode;
        $partNumber = $this->input->post('PartNumber');
        $idPart = $this->getIdPartNumber($partNumber)[0]['idPart'];
        $Quantity = $this->input->post('Quantity');
        $OrderNo = $this->input->post('OrderNumber');

        $InvoiceDetails = array(
            "DispatchId" => $idDispatchMode,
            "OrderNumberId" => $idOrderNumber,
            "PartId" => $idPart,
            "Quantity" => $Quantity
        );
        $this->db->insert('order_invoice_details', $InvoiceDetails);
        $this->db->trans_complete();
    }

    function oneOtherPurchase($OrderNumber) {
        $OneDhamakaPackage = $this->db->select('idOrderNumber')->from('viewotherpurchase')->where('OrderNumber', $OrderNumber)->get();
        return $OneDhamakaPackage->result_array();
    }

    function deleteOtherPurchase($idOrderNumber) {
        $this->db->where('idOrderNumber', $idOrderNumber);
        $update = $this->db->update('order_number', ["isActive" => "0"]);
        if ($update) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //***************** END ******************//

    function getOrderNumber($OrderType) {
//        Umer Logic
//        $MaxNumber = $this->db->query('SELECT Max(order_number.Number)+1  as `Number` FROM order_number');
//        return $MaxNumber->result_array()[0];
//        
//        New Logic.
//        $OrderType = $OrderType["Title"];
//        $MaxNumber = $this->db->query("SELECT MAX(vgo.OrderNumber) + 1 AS `Number` from viewgenerateordernumber vgo"
//                . " WHERE vgo.OrderType = '$OrderType'");
//        return $MaxNumber->result_array()[0];

        $OrderType = $OrderType["Title"];
        //        $MaxNumber = $this->db->query("SELECT MAX(vgo.OrderNumber) + 1 AS `Number` from viewgenerateordernumber vgo"
//                . " WHERE vgo.`Month` = EXTRACT(MONTH FROM NOW()) AND vgo.`OrderType` = '$OrderType'");

        $MaxNumber = $this->db->query("SELECT max(cast(order_number.Number as DECIMAL))+1 as Number FROM order_number
                INNER JOIN invoice_claim_type ON order_number.TypeId = invoice_claim_type.id
                WHERE order_number.`Month` = EXTRACT(MONTH FROM NOW()) AND invoice_claim_type.Title='$OrderType'");
        return $MaxNumber->result_array()[0];
    }

    function getDealer($Dealer) {
        $Dealer = $this->db->query("SELECT IdSubDealer from car_sub_dealer WHERE Name = '$Dealer'");
        return $Dealer->row();
    }

    function getModel($ModelName) {
        $Model = $this->db->query("SELECT IdModel from car_model WHERE Model = '$ModelName'");
        $idModel = $Model->result_array()[0];
        return $idModel;
    }

    function getDispatchMode($DispatchMode) {
        $Dispatch = $this->db->query("SELECT idDispatch from dispatch_mode WHERE Mode = '$DispatchMode'");
        return $Dispatch->result_array();
    }

    function getIdPartNumber($partNumber) {
        $idPart = $this->db->query("SELECT idPart from parts_name WHERE PartNumber = '$partNumber'");
        return $idPart->result_array();
    }

    function getTypeId($TypeName) {
        $idType = $this->db->query("SELECT id from invoice_claim_type WHERE Title = '$TypeName'");
        return $idType->row();
    }

    function getBrand() {
        $brands = $this->db->query("SELECT * from car_parent");
        return $brands->result_array();
    }

    function getInvoiceNumber() {
        $InvoiceNumber = $this->db->query("SELECT max(inventory_sale_detail.InvoiceNumber) as InvoiceNumber FROM inventory_sale_detail");
        $InvoiceNumber = $InvoiceNumber->result_array()[0];
        if ($InvoiceNumber['InvoiceNumber'] == NULL) {
            $InvoiceNumber['InvoiceNumber'] = "1";
        } else {
            $InvoiceNumber['InvoiceNumber'] = $InvoiceNumber['InvoiceNumber'] + 1;
        }

        return $InvoiceNumber['InvoiceNumber'];
    }

    function fillInvoiceTypeCombo() {
        $query = $this->db->query('select distinct id, Title from invoice_claim_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idType" => $dropdown->Title, "TypeName" => $dropdown->Title]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillPartCombo($Type = NULL) {
//        $query = $this->db->query("SELECT parts_name.idPart, parts_name.PartNumber, invoice_claim_type.Title,
//                                    parts_manufacturer.Manufacturer FROM parts_name
//                                LEFT OUTER JOIN parts_ordermode ON parts_ordermode.idParts_Name = parts_name.idPart
//                                LEFT OUTER JOIN invoice_claim_type ON parts_ordermode.idOrderMode = invoice_claim_type.id
//                                LEFT JOIN parts_inventory ON parts_inventory.PartId = parts_name.idPart
//                                LEFT JOIN parts_manufacturer ON parts_inventory.ManufacturerId = parts_manufacturer.idManufacturer
//                             WHERE invoice_claim_type.Title = '" . $Type . "' AND parts_manufacturer.Manufacturer ='IMC'");
        $query = $this->db->query("SELECT parts_name.idPart, parts_name.PartNumber,
	invoice_claim_type.Title, parts_manufacturer.Manufacturer, car_parent.ShortCode
                            FROM parts_name 
                            LEFT OUTER JOIN parts_ordermode ON parts_ordermode.idParts_Name = parts_name.idPart
                            LEFT OUTER JOIN invoice_claim_type ON parts_ordermode.idOrderMode = invoice_claim_type.id
                            LEFT JOIN parts_inventory ON parts_inventory.PartId = parts_name.idPart
                            LEFT JOIN parts_manufacturer ON parts_inventory.ManufacturerId = parts_manufacturer.idManufacturer
                            LEFT JOIN car_parent ON car_parent.IdParent = parts_name.BrandName
                            WHERE invoice_claim_type.Title = '" . $Type . "' AND parts_manufacturer.Manufacturer ='IMC' AND car_parent.ShortCode = '" . $this->session->userdata("BrandCode") . "'");

        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillDispatchModeCombo($Name = NULL) {
        if ($Name == NULL) {
            $query = $this->db->query('select idDispatch, Mode from dispatch_mode');
            $dropdowns = $query->result();
            $dropDownList = array();
            foreach ($dropdowns as $dropdown) {
                array_push($dropDownList, ["idDispatch" => $dropdown->idDispatch, "Mode" => $dropdown->Mode]);
            }
            $finalDropDown = $dropDownList;
            return $finalDropDown;
        } else {
            $query = $this->db->query('select idDispatch, Mode from dispatch_mode where Mode = "' . $Name . '"');
            $dropdowns = $query->result();
            $dropDownList = array();
            foreach ($dropdowns as $dropdown) {
                array_push($dropDownList, ["idDispatch" => $dropdown->idDispatch, "Mode" => $dropdown->Mode]);
            }
            $finalDropDown = $dropDownList;
            return $finalDropDown;
        }
    }

    function allModePayment() {
        $modePayment = $this->db->select('*')->from('car_mode_payment')->get();
        return $modePayment->result_array();
    }

    function searchSpecificOrder($orderType, $brandName, $orderNumber) {
        if ($orderType === "Daily Order") {
            $order = $this->db->query("SELECT * from viewdailyorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Dhamaka Package") {
            $order = $this->db->query("SELECT * from viewdhamakapackage WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Maintenance Package") {
            $order = $this->db->query("SELECT * from viewmaintenancepackage WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Warranty Order") {
            $order = $this->db->query("SELECT * from viewwarrantyorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Plan Order") {
            $order = $this->db->query("SELECT * from viewplanorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "D Package Order") {
            $order = $this->db->query("SELECT * from viewdpackageorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "M Package Order") {
            $order = $this->db->query("SELECT * from viewmpackageorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Accessories Order") {
            $order = $this->db->query("SELECT * from viewaccessoriesorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Urgent Order") {
            $order = $this->db->query("SELECT * from viewurgentorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
    }

    function searchDateWiseOrder($fromDate, $toDate, $orderType, $brandName) {
        if ($orderType === "Daily Order") {
            $order = $this->db->query("SELECT * from viewdailyorder WHERE ParentName = '$brandName' AND Date BETWEEN '$fromDate' AND '$toDate'");
            return $order->result_array();
        }
        if ($orderType === "Dhamaka Package") {
            $order = $this->db->query("SELECT * from viewdhamakapackage WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Maintenance Package") {
            $order = $this->db->query("SELECT * from viewmaintenancepackage WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Warranty Order") {
            $order = $this->db->query("SELECT * from viewwarrantyorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Plan Order") {
            $order = $this->db->query("SELECT * from viewplanorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "D Package Order") {
            $order = $this->db->query("SELECT * from viewdpackageorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "M Package Order") {
            $order = $this->db->query("SELECT * from viewmpackageorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Accessories Order") {
            $order = $this->db->query("SELECT * from viewaccessoriesorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
        if ($orderType === "Urgent Order") {
            $order = $this->db->query("SELECT * from viewurgentorder WHERE ParentName = '$brandName' AND OrderNumber = '$orderNumber'");
            return $order->result_array();
        }
    }

    //ALL LIST OF ORDERS 
    function allLP() {
        $AllDailyOrder = $this->db->select('*')->from('viewlocalpurchase')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allOP() {
        $AllDailyOrder = $this->db->select('*')->from('viewotherpurchase')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allVR() {
        $AllDailyOrder = $this->db->select('*')->from('viewvor')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allCO() {
        $AllDailyOrder = $this->db->select('*')->from('viewchemicalorder')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allT() {
        $AllDailyOrder = $this->db->select('*')->from('viewtgmo')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allWO() {
        $AllDailyOrder = $this->db->select('*')->from('viewwarrantyorder')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allMP() {
        $AllDailyOrder = $this->db->select('*')->from('viewmaintenancepackage')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allDO() {
        $AllDailyOrder = $this->db->select('*')->from('viewdailyorder')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allDP() {
        $AllDailyOrder = $this->db->select('*')->from('viewdhamakapackage')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allUO() {
        $AllDailyOrder = $this->db->select('*')->from('viewurgentorder')->Where(['Date' => date('Y-m-d'), "isActive" => "1"])->get();
        return $AllDailyOrder->result_array();
    }

    function allMPO() {
        $AllDailyOrder = $this->db->select('*')->from('viewmpackageorder')->Where(['Date' => date('Y-m-d'), "isActive" => "1"])->get();
        return $AllDailyOrder->result_array();
    }

    function allDPO() {
        $AllDailyOrder = $this->db->select('*')->from('viewdpackageorder')->Where(['Date' => date('Y-m-d'), "isActive" => "1"])->get();
        return $AllDailyOrder->result_array();
    }

    function allAO() {
        $AllDailyOrder = $this->db->select('*')->from('viewaccessoriesorder')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allSO() {
        $AllDailyOrder = $this->db->select('*')->from('viewspecialoffer')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allPO() {
        $AllDailyOrder = $this->db->select('*')->from('viewplanorder')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

    function allBSO() {
        $AllDailyOrder = $this->db->select('*')->from('viewbyseaorder')->where(['Date' => date('Y-m-d'), "isActive" => "1"])->order_by('Date', 'ASC')->get();
        return $AllDailyOrder->result_array();
    }

}
