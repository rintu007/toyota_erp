<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Service extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_name');
        $this->load->model('Inventory_purchase');
        $this->load->model('Inventory_party');
        $this->load->model('Parts_invoices');
        $this->load->model('Parts_service');
        $this->load->library('form_validation');
//parts models
               $this->load->model('s_partsrequistionmechanical');
        $this->load->model('s_repairorder');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");


    }

    public function dispatch() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Purchase = new Inventory_purchase();
        $Party = new Inventory_party();
        $PartsName = new Parts_name();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Parts'] = $Purchase->fillPartComboCombo();
        $Data['Party'] = $Purchase->fillPartyCombo();
        $Data['PurchaseType'] = $Purchase->fillPurchaseTypeCombo();
        $Data['Party'] = $Party->fillPartyCombo();
        $Data['Part'] = $PartsName->fillPartNumberCombo();
        $Data['message'] = $this->session->flashdata('message');
        $this->load->view('header_parts', $Data);
        $this->load->view('dispatch', $Data);
        $this->load->view('footer');
    }

    function add() {
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
//        exit();
        $PartsService = new Parts_service();
        $this->form_validation->set_rules('parts', 'parts', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $NewDispatch = $PartsService->AddDispatch();
            if ($NewDispatch) {
                $this->session->set_flashdata('message', '<h4 style="background-color: green;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center; margin-top: 14px;">Parts For Service Has Been Dispatched.</h4>');
                redirect(base_url() . "index.php/service/dispatch");
            } else {
                $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Parts For Service Has Been Failed To Dispatch Due To Low Quantity of Availability.</h4>');
                redirect(base_url() . "index.php/service/dispatch");
            }
        } else {
            $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Please fill all mandatory fields!</h4>');
            redirect(base_url() . "index.php/service/dispatch");
        }
    }   

    function edit() {
        $this->form_validation->set_rules('PartId', 'Part ID', 'required|xss_clean');
        $this->form_validation->set_rules('PartName', 'Part Name', 'required|xss_clean');
        $this->form_validation->set_rules('VariantId', 'Variant ID', 'required|xss_clean');
        $this->form_validation->set_rules('Quantity', 'Quantity', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            
        }
    }

    public function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Purchase = new Inventory_purchase();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber();
        $Data['message'] = $this->session->flashdata('message');
        $Data['Purchase'] = $Purchase->AllPurchases();
        $this->load->view('header_parts', $Data);
        $this->load->view('purchase_view', $Data);
        $this->load->view('footer');
    }

    function type() {
        $Purchase = new Inventory_purchase();
        $this->form_validation->set_rules('TypeName', 'Purchase Type Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $PuschaseTypeData = array(
                'PurchaseType' => $this->input->post('TypeName'),
                'CreatedDate' => date('Y/m/d')
            );
            $PurchaseType = $Purchase->AddPurchaseType($PuschaseTypeData);
            if ($PurchaseType) {
                $this->session->set_flashdata('Response', '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Purchase Type has been added successfully!</h4>');
                redirect(base_url() . "index.php/purchase/type");
            } else {
                $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please fill all required feilds!</h4>');
                redirect(base_url() . "index.php/purchase/type");
            }
        }
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber();
        $Data['PurchaseType'] = $Purchase->allPurchaseType();
        $Data['Response'] = $this->session->flashdata('Response');
        $this->load->view('header_parts', $Data);
        $this->load->view('purchase_type', $Data);
        $this->load->view('footer');
    }

    function edittype() {
        $Purchase = new Inventory_purchase();
        $this->form_validation->set_rules('idPurchaseType', 'Purchase ID', 'required|xss_clean');
        $this->form_validation->set_rules('TypeName', 'Purchas Type Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $PurchaseTypeData = array(
                'PurchaseType' => $this->input->post('TypeName')
            );
            $idPurchaseType = $this->input->post('idPurchaseType');
            $editPurchaseType = $Purchase->EditPurchaseType($idPurchaseType, $PurchaseTypeData);
            if ($editPurchaseType) {
                $this->session->set_flashdata('Response', '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Purchase Type has been updated successfully!</h4>');
                redirect(base_url() . "index.php/purchase/type");
            } else {
                $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Failed to update Purchase Type!</h4>');
                redirect(base_url() . "index.php/purchase/type");
            }
        }
    }

    function get() {
        $RODetails = new Parts_service();
        $RoNumber = $this->input->post('RoNumber');
        $GetRo = $RODetails->getRo($RoNumber);
        $Ro = json_encode($GetRo);
        echo $Ro;
    }

       function get1() {
        $RODetails = new Parts_service();
        $RoNumber = $this->input->post('RoNumber');
        $GetRo = $RODetails->getRo1($RoNumber);
        $Ro = json_encode($GetRo);
        echo $Ro;
    }

}
