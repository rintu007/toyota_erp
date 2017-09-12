<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_invoice extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function GetInvoices($data = '', $dispatchType = '') {
        if ($dispatchType == 'OPENSTOCK') {
            $this->db->select('car_dispatch.RegistrationNumber AS DispatchRegistrationNumber,parking_row.name AS ParkingRow, car_location.Location,car_customer.CustomerName,car_customer.Cellphone,car_dispatch.idDispatch,car_dispatch.ChasisNo,car_dispatch.DispatchType, car_dispatch.EngineNo, car_salenote.*,car_variants.Variants,car_color.ColorName ');
            $this->db->from('car_dispatch');
            $this->db->join('car_salenote', 'car_dispatch.idDispatch = car_salenote.Dispatch');
            $this->db->join('car_customer', 'car_customer.IdCustomer = car_salenote.Customer');
            $this->db->join('car_variants', 'car_dispatch.VariantId = car_variants.IdVariants');
            $this->db->join('car_color', 'car_dispatch.ColorId = car_color.IdColor');
            $this->db->join('car_location', 'car_dispatch.LocationId = car_location.idLocation');
            $this->db->join('car_receive', 'car_receive.idDispatch = car_dispatch.idDispatch');
            $this->db->join('parking_row', 'parking_row.id = car_receive.idparking_row');
            $this->db->where('car_dispatch.isStock', '1');
            $this->db->where('car_dispatch.Pdi', '1');
            $this->db->where('car_dispatch.InvoiceCreated', '0');
            if ($data) {
                $this->db->where('car_dispatch.idDispatch', $data);
            }
        } elseif ($dispatchType == 'PBO') {
            $this->db->select('car_dispatch.RegistrationNumber AS DispatchRegistrationNumber, car_pbo.*,car_resource_book.*,car_contact_type.*,parking_row.name AS ParkingRow, car_location.Location,car_customer.CustomerName,car_customer.Cellphone,car_dispatch.idDispatch,car_dispatch.ChasisNo,car_dispatch.DispatchType,car_dispatch.ColorId, car_dispatch.EngineNo, car_variants.Variants,car_color.ColorName ');
            $this->db->from('car_dispatch');
            $this->db->join('car_pbo', 'car_pbo.Id = car_dispatch.PboId', "LEFT");
            $this->db->join('car_resource_book', 'car_pbo.ResourcebookId = car_resource_book.IdResourceBook', "LEFT");
            $this->db->join('car_salenote', 'car_dispatch.idDispatch = car_salenote.Dispatch', "LEFT");
            $this->db->join('car_customer', 'car_customer.IdCustomer = car_resource_book.CustomerId', "LEFT");
            $this->db->join('car_variants', 'car_dispatch.VariantId = car_variants.IdVariants', "LEFT");
             $this->db->join('car_contact_type', 'car_contact_type.Id = car_resource_book.ContactTypeId', "LEFT");
            $this->db->join('car_color', 'car_dispatch.ColorId = car_color.IdColor', "LEFT");
            $this->db->join('car_location', 'car_dispatch.LocationId = car_location.idLocation', "LEFT");
            $this->db->join('car_receive', 'car_receive.idDispatch = car_dispatch.idDispatch', "LEFT");
            $this->db->join('parking_row', 'parking_row.id = car_receive.idparking_row', "LEFT");
            $this->db->where('car_dispatch.isStock', '1');
            $this->db->where('car_dispatch.Pdi', '1');
            $this->db->where('car_dispatch.InvoiceCreated', '0');
            if ($data) {
                $this->db->where('car_dispatch.idDispatch', $data);
            }
        } else {
            $this->db->select('car_pbo.Is_partial, car_pbo.Is_partial_amount ,car_location.Location,car_dispatch.idDispatch,car_dispatch.ChasisNo,car_dispatch.DispatchType, car_dispatch.EngineNo, car_variants.Variants,car_color.ColorName ');
            $this->db->from('car_dispatch');
            $this->db->join('car_variants', 'car_dispatch.VariantId = car_variants.IdVariants');
            $this->db->join('car_color', 'car_dispatch.ColorId = car_color.IdColor');
            $this->db->join('car_location', 'car_dispatch.LocationId = car_location.idLocation');
             $this->db->join('car_pbo', 'car_pbo.Id = car_dispatch.PboId', 'LEFT');
            $this->db->where('car_dispatch.isStock', '1');
            $this->db->where('car_dispatch.Pdi', '1');
            $this->db->where('car_dispatch.InvoiceCreated', '0');
        }
        $result = $this->db->get();
        return $result->result_array();
    }
    
    function getInvoiceNumber(){
          $GetPbo = $this->db->select('max(InvoiceNumber) AS InvoiceNumber')->from('car_invoice')->get();
        return $GetPbo->result_array();
    }
    
    function getInvoiceEntryNumber(){
          $GetPbo = $this->db->select('max(idInvoice) AS EntryNumber')->from('car_invoice')->get();
        return $GetPbo->result_array();
    }

    function getPbo($PboNumber) {
        $GetPbo = $this->db->select('*')->from('dispatchInvoice')->where('PboNumber', $PboNumber)->where('InvoiceCreated', 0)->get();
        return $GetPbo->result_array();
    }

    function getModel() {
        $GetPbo = $this->db->select('*')->from('car_model')->get();
        return $GetPbo->result_array();
    }

    function getVarients() {
        $GetPbo = $this->db->select('*')->from('car_variants')->where('isActive', '1')->get();
        return $GetPbo->result_array();
    }

    function GetColor($VarientsId) {
        $this->db->select('car_color.*');
        $this->db->from('car_variants');
        $this->db->join('car_variants_color', 'car_variants.IdVariants = car_variants_color.VariantId');
        $this->db->join('car_color', 'car_color.IdColor = car_variants_color.ColorId');
        $this->db->where('car_variants.IdVariants', $VarientsId);
        $this->db->where('isActive', '1');
        $GetPbo = $this->db->get();
        return $GetPbo->result_array();
    }

    function InvoiceList($UserRole, $idUser) {
        if ($UserRole == "Admin" || $UserRole == "Sales Admin" || $UserRole == "Director") {
            $this->db->select('*');
            $this->db->from('viewInvoice');
            $InvoiceList = $this->db->get();
            return $InvoiceList->result_array();
        } else if ($UserRole == "Salesman") {
            $this->db->select('*');
            $this->db->from('viewInvoice');
            $this->db->where('SalesmanId', $idUser);
            $InvoiceList = $this->db->get();
            return $InvoiceList->result_array();
        }
    }

    function insertInvoice($invoiceData, $PboData, $PboId, $DispatchId) {
        $this->db->trans_start();
        $this->db->insert('car_invoice', $invoiceData);

        $this->db->where('Id', $PboId);
        $this->db->update('car_pbo', $PboData);
        
        $this->db->where('idDispatch', $DispatchId);
        $this->db->update('car_dispatch', $PboData);
        echo '1';
        $this->db->trans_complete();
    }

    function updateInvoice($idInvoice, $invoiceData) {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->update('car_invoice', $invoiceData);
    }

    function deleteInvoice($idInvoice) {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->delete('car_invoice');
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

}
