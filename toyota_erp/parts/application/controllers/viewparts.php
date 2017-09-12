<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Viewparts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_name');
        $this->load->model('Parts_inventory');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Inventory'] = $this->Parts_name->viewparts();
        $Data['Parts'] = $this->Parts_inventory->fillPartCombo();
        $Data['Variant'] = $this->Parts_name->fillVariantCombo();
        $Data['Category'] = $this->Parts_inventory->fillCategoryCombo();
        $Data['Manufacturer'] = $this->Parts_inventory->fillManufacturerCombo();
        $this->load->view('header_parts', $Data);
        $this->load->view('parts_view', $Data);
        $this->load->view('footer');
    }

    function newInventory() {
        $this->form_validation->set_rules('PartId', 'Part ID', 'required|xss_clean');
        $this->form_validation->set_rules('PartCategory', 'Part Name', 'required|xss_clean');
        $this->form_validation->set_rules('CostPrice', 'Variant ID', 'required|xss_clean');
        $this->form_validation->set_rules('RetailPrice', 'Quantity', 'required|xss_clean');
        $this->form_validation->set_rules('ManufacturerId', 'Quantity', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $InventoryData = array(
                'PartId' => $this->input->post('PartId'),
                'PartCategory' => $this->input->post('PartCategory'),
                'CostPrice' => $this->input->post('CostPrice'),
                'RetailPrice' => $this->input->post('RetailPrice'),
                'ManufacturerId' => $this->input->post('ManufacturerId')
            );
            $this->Parts_inventory->insertInventory($InventoryData);
            redirect(base_url() . "index.php/inventory/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('PartId', 'Part ID', 'required|xss_clean');
        $this->form_validation->set_rules('PartCategory', 'Part Name', 'required|xss_clean');
        $this->form_validation->set_rules('CostPrice', 'Variant ID', 'required|xss_clean');
        $this->form_validation->set_rules('RetailPrice', 'Quantity', 'required|xss_clean');
        $this->form_validation->set_rules('ManufacturerId', 'Quantity', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idInventory = $this->input->post('InventoryId');
            $InventoryData = array(
                'PartId' => $this->input->post('PartId'),
                'PartCategory' => $this->input->post('PartCategory'),
                'CostPrice' => $this->input->post('CostPrice'),
                'RetailPrice' => $this->input->post('RetailPrice'),
                'ManufacturerId' => $this->input->post('ManufacturerId')
            );
            $this->Parts_inventory->updateInventory($idInventory, $InventoryData);
            redirect(base_url() . "index.php/inventory/index");
        }
    }

    function search() {
        $Search = $this->input->post('search');
        $InventorySearch = $this->Parts_inventory->searchInventory($Search);
        $PartInventory = json_encode($InventorySearch);
//        print_r($PartInventory);
        echo $PartInventory;
    }
	
	    function searchPartDetails() {
        $partsInventoryModule = new Parts_inventory();
        $search = $this->input->post('search');
        $data = $partsInventoryModule->searchPartsDetails($search);
        $partsDetail = json_encode($data);
        echo $partsDetail;
    }

}
