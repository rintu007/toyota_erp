<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_salenote extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allSaleNote() {
        $this->db->select('*');
        $this->db->from('car_salenote');
        $this->db->join('car_customer', 'car_salenote.Customer = car_customer.IdCustomer', 'LEFT OUTER');
        $this->db->join('car_variants', 'car_salenote.Vehicle = car_variants.IdVariants', 'LEFT OUTER');
        $SaleNote = $this->db->get();
        return $SaleNote->result_array();
    }
    
     function getAllSaleNote($limit = '', $offset = '') {
        $this->db->select('*');
        $this->db->from('car_salenote');
        $this->db->join('car_customer', 'car_salenote.Customer = car_customer.IdCustomer', 'LEFT OUTER');

         if(isset($_POST['Dispatch']) && $_POST['Dispatch']!='')
         {

             $this->db->where('Dispatch', $_POST['Dispatch']);
         }

         if(isset($_POST['CustomerName']) && $_POST['CustomerName']!='')
         {
             $this->db->like('CustomerName', $_POST['CustomerName']);
         }
         if(  $offset != '' or  $limit!='')
             $this->db->limit( $limit,$offset);
        $SaleNote = $this->db->get();
        return $SaleNote->result_array();
    }
    
     function record_count() {
       return $this->db->count_all('car_salenote');


    }

    function oneSaleNote($idSaleNote) {
        $this->db->select('car_customer.*,car_dispatch.*, car_salenote.*,car_pbo.*,car_variants.Variants,car_color.ColorName,car_model.Model');
        $this->db->from('car_salenote');
        $this->db->join('car_dispatch', 'car_salenote.Dispatch = car_dispatch.idDispatch', 'LEFT OUTER');
        $this->db->join('car_pbo', 'car_pbo.Id = car_dispatch.PboId', 'LEFT OUTER');
        $this->db->join('car_resource_book', 'car_pbo.ResourcebookId = car_resource_book.IdResourceBook', 'LEFT OUTER');
        $this->db->join('car_customer', 'car_salenote.Customer = car_customer.IdCustomer', 'LEFT OUTER');
        $this->db->join('car_variants', 'car_dispatch.VariantId = car_variants.IdVariants', 'LEFT OUTER');
        $this->db->join('car_color', 'car_dispatch.ColorId = car_color.IdColor', 'LEFT OUTER');
        $this->db->join('car_model', 'car_model.IdModel = car_variants.ModelId', 'LEFT OUTER');
        $this->db->where('idSaleNote', $idSaleNote);
        $oneRb = $this->db->get();
        return $oneRb->row_array();
    }

    //Modifed After Adding Finance Module
    function insertSaleNote($CustomerData) {
        $this->db->trans_start();
        $result = $this->db->query('Select max(idSaleNote) AS Id From car_salenote')->result_array();
        $max = $result[0]['Id'];
//        print_r($_POST);
//        die;
        $PBONumber = $this->input->post('PboNumber');
        $idCustomer = $this->input->post('customer_id');
        $ExCustomer = $this->input->post('customer_ex');
        $idDispatch = $this->input->post('dispatchId');
        $VehiclePrice = $this->input->post('Price');
        $SellingPrice = $this->input->post('SellingPrice');
        $PurchaseFrom = $this->input->post('PurchaseFrom');
        $PurchasePrice = $this->input->post('purchasePrice');
        $Percentage = $this->input->post('Percentage');
        $ProfitPercentage = $this->input->post('ProfitPercentage');
        $NetProfit = $this->input->post('NetProfit');
        $SalePerson = $this->input->post('saleperson');
        $date = $this->input->post('date');
//        $SaleNoteNumber = $this->input->post('SaleNoteNumber');
        $SaleNoteNumber = $max + 1;

        $idParty = "";

        if ($ExCustomer == "New_Customer") {
            $pboData = array(
                'idDispatch' => $idDispatch,
                'SaleNoteCreated' => 1
            );
            $this->db->where('idDispatch', $idDispatch);
            $this->db->update('car_dispatch', $pboData);

            $this->db->insert('car_customer', $CustomerData);
            $LastCustomerInserted = $this->db->insert_id();
            $idParty = $LastCustomerInserted;

            $SaleNoteData = array(
                'SaleNoteNumber' => $SaleNoteNumber,
                'Customer' => $LastCustomerInserted,
                'Dispatch' => $idDispatch,
                'VehiclePrice' => $VehiclePrice,
                'SellingPrice' => $SellingPrice,
                'PurchaseFrom' => $PurchaseFrom,
                'PurchasePrice' => $PurchasePrice,
                'isDelivered' => 0,
                'CreatedDate' => $date,
                'Percentage' => $Percentage,
                'ProfitPercentage' => $ProfitPercentage,
                'NetProfit' => $NetProfit,
                'SalePerson' => $SalePerson
            );
            $this->db->insert('car_salenote', $SaleNoteData);
            $LastSaleNote = $this->db->insert_id();

            $Payment = array(
                'SaleNoteId' => $LastSaleNote,
                'Payable' => NULL,
                'Receivable' => $SellingPrice,
                'Receipt' => NULL,
                'Balance' => '-' . $SellingPrice,
                'Date' => $date);
            $this->db->insert('car_finance', $Payment);
            $this->Receivable($idParty, $SellingPrice);
        } elseif ($ExCustomer == "Existing_Customer") {
            $pboData = array(
                'idDispatch' => $idDispatch,
                'SaleNoteCreated' => 1
            );
            $this->db->where('idDispatch', $idDispatch);
            $this->db->update('car_dispatch', $pboData);
            $this->db->where('IdCustomer', $idCustomer);
            $this->db->update('car_customer', $CustomerData);

            $SaleNoteData = array(
                'SaleNoteNumber' => $SaleNoteNumber,
                'Customer' => $idCustomer,
                'Dispatch' => $idDispatch,
                'VehiclePrice' => $VehiclePrice,
                'SellingPrice' => $SellingPrice,
                'PurchaseFrom' => $PurchaseFrom,
                'PurchasePrice' => $PurchasePrice,
                'isDelivered' => 0,
                'CreatedDate' => $date,
                'Percentage' => $Percentage,
                'ProfitPercentage' => $ProfitPercentage,
                'NetProfit' => $NetProfit,
                'SalePerson' => $SalePerson);
            $this->db->insert('car_salenote', $SaleNoteData);
            $LastSaleNote = $this->db->insert_id();

            $Payment = array(
                'SaleNoteId' => $LastSaleNote,
                'Payable' => NULL,
                'Receivable' => $SellingPrice,
                'Receipt' => NULL,
                'Balance' => '-' . $SellingPrice,
                'Date' => $date);
            $this->db->insert('car_finance', $Payment);
            $this->Receivable($idCustomer, $SellingPrice);
        }
        $trans_complete = $this->db->trans_complete();
        if ($trans_complete) {
            return 1;
        } else {
            return 0;
        }
    }

    function updateSaleNote($idSaleNote, $idCustomer, $SaleNoteData, $CustomerData) {
        $this->db->trans_start();
        $this->db->where('IdCustomer', $idCustomer);
        $this->db->update('car_customer', $CustomerData);
        $this->db->where('idSaleNote', $idSaleNote);
        $this->db->update('car_salenote', $SaleNoteData);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "rollback";
        } else {
            $this->db->trans_commit();
        }
        $this->db->trans_complete();
    }

    function deleteSaleNote($idSaleNote) {
        $this->db->where('idSaleNote', $idSaleNote);
        $this->db->delete('car_salenote');
    }

    function searchSaleNote($Keyword) {
        $this->db->select('*');
        $this->db->from('car_salenote');
        $this->db->join('car_customer', 'car_salenote.Customer = car_customer.IdCustomer');
        $this->db->join('car_variants', 'car_salenote.Vehicle = car_variants.IdVariants');
        $this->db->like('car_salenote.SaleNoteNumber', $Keyword);
        $this->db->or_like('CustomerName', $Keyword);
        $this->db->or_like('Variants', $Keyword);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getDispatch($ChassisNo) {
        $Dispatch = $this->db->select('*')->from('ViewSaleNoteAdd')->where('ChasisNo', $ChassisNo)->get();
        return $Dispatch->result_array();
    }

    function getDispatchByPbo($PboNumber) {
        $this->db->select('salenotepbo.*');
        $this->db->from('salenotepbo');

        $this->db->where('salenotepbo.SaleNoteCreated', '0');
        $this->db->where('salenotepbo.PboNumber', $PboNumber);
        $Dispatch = $this->db->get();
//        $Dispatch = $this->db->select('*')->from('salenotepbo')->where('PboNumber', $PboNumber)->get();
        return $Dispatch->result_array();
    }

    function fillCustomerCombo() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        if ($cookieData['Role'] != "Salesman") {
            $query = $this->db->query('SELECT distinct car_customer.IdCustomer, car_customer.CustomerName FROM car_resource_book LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer');
            $colorCombo = $query->result();
        } else {
//            $query = $this->db->query('SELECT distinct car_customer.IdCustomer, car_customer.CustomerName, car_resource_book.SalesmanId FROM car_resource_book INNER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer WHERE car_resource_book.SalesmanId = ' . $cookieData['userid']);
            $query = $this->db->query('SELECT distinct car_customer.IdCustomer, car_customer.CustomerName, car_resource_book.SalesmanId FROM car_resource_book INNER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer WHERE car_resource_book.SalesmanId = ' . $UserId);
            $colorCombo = $query->result();
        }
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["IdCustomer" => $dropdown->IdCustomer, "CustomerName" => $dropdown->CustomerName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function CustomerDetails($CustomerId) {
        $CustomerDetails = $this->db->query('SELECT
                    car_customer.IdCustomer,
                    car_customer.CustomerName,
                    car_customer.FatherName,
                    car_customer.AddressDetails,
                    car_customer.CompanyName,
                    car_customer.Designation,
                    car_customer.OfficeNumber,
                    car_customer.DateOfBirth,
                    car_customer.City,
                    car_customer.Province,
                    car_customer.Cnic,
                    car_customer.Ntn,
                    car_customer.Telephone,
                    car_customer.Cellphone,
                    car_customer.Email
                    FROM
                    car_resource_book
                    INNER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                    WHERE
                    car_resource_book.CustomerId = ' . $CustomerId);
        $Customer = $CustomerDetails->result();
        return $Customer;
    }

    function CustomerByCnic($Cnic) {
        $CustomerDetails = $this->db->query('SELECT
                    car_customer.IdCustomer,
                    car_customer.CustomerName,
                    car_customer.FatherName,
                    car_customer.AddressDetails,
                    car_customer.CompanyName,
                    car_customer.Designation,
                    car_customer.OfficeNumber,
                    car_customer.DateOfBirth,
                    car_customer.City,
                    car_customer.Province,
                    car_customer.Cnic,
                    car_customer.Ntn,
                    car_customer.Telephone,
                    car_customer.Cellphone,
                    car_customer.Email
                    FROM
                    car_resource_book
                    LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                    WHERE
                    car_customer.Cnic = ' . $Cnic);
        $Customer = $CustomerDetails->result();
        return $Customer;
    }

    function fillModelCombo() {
        $query = $this->db->query('select distinct IdModel, Model from car_model');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdModel, "Model" => $dropdown->Model]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillVariantsCombo() {
        $query = $this->db->query('select distinct IdVariants, Variants from car_variants');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdVariants, "Variants" => $dropdown->Variants]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillColorByVariant($variantId) {
        $query = $this->db->query('SELECT car_variants_color.ColorId, car_color.ColorName
FROM car_variants_color
INNER JOIN car_color ON car_variants_color.ColorId = car_color.IdColor
INNER JOIN car_variants ON car_variants_color.VariantId = car_variants.IdVariants
WHERE car_variants_color.VariantId = ' . $variantId);
        $dropdowns = $query->result();
        return $dropdowns;
    }

    function fillVariantByModel($ModelId) {
        $query = $this->db->query('SELECT car_variants.IdVariants, car_variants.Variants FROM car_model
INNER JOIN car_variants ON car_variants.ModelId = car_model.IdModel
WHERE car_variants.ModelId = ' . $ModelId);
        $dropdowns = $query->result();
        return $dropdowns;
    }

    //Add Following Functions for Finance Module
    function Receivable($idParty, $ReceiveableAmount) {
        $isExistReceivable = $this->isExistReceivable($idParty);
        if ($isExistReceivable != NULL) {
            $receivableAmount = $isExistReceivable[0]['ReceiveableAmount'] + $ReceiveableAmount;
            $receivableData = array(
                'ReceiveableAmount' => $receivableAmount,
                'ReceivableDate' => $this->getFieldsValue()['ReceivableDate'],
                'ReceivableTime' => $this->getFieldsValue()['ReceivableTime'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            );
            $updateReceivable = $this->updateReceivable($isExistReceivable[0]['idReceivable'], $receivableData);
            if ($updateReceivable === "Receivable Updated Successfully") {
                return True;
            }
        } else {
            $receivableData = array(
                'idParty' => $idParty,
                'ReceiveableAmount' => $ReceiveableAmount,
                'FromDepartment' => 'SalesDepartment',
                'ReceivableDate' => $this->getFieldsValue()['ReceivableDate'],
                'ReceivableTime' => $this->getFieldsValue()['ReceivableTime'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $createReceivable = $this->createReceivable($receivableData);
            if ($createReceivable === "Receivable Created Successfully") {
                return True;
            }
        }
    }

    function isExistReceivable($idCustomer) {

        $whereClause = "idParty = '$idCustomer' AND FromDepartment = 'SalesDepartment' AND isActive = 1";
        $this->db->select('*');
        $this->db->from('f_receivable');
        $this->db->where($whereClause);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return $isExist->result_array();
        }
    }

    function createReceivable($receivableData) {
        $this->db->insert('f_receivable', $receivableData);
        return "Receivable Created Successfully";
    }

    function updateReceivable($idReceivable, $receivableData) {
        $this->db->where('idReceivable', $idReceivable);
        $this->db->update('f_receivable', $receivableData);
        return "Receivable Updated Successfully";
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "ReceivableDate" => date("Y-m-d"), "ReceivableTime" => date("H:i:s"));
        return $fieldsValue;
    }

}
