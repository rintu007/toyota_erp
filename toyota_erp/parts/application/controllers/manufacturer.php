<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Manufacturer extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_manufacturer');
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
        $Data['Manufacturer'] = $this->Parts_manufacturer->allManufacturer();
        $this->load->view('header_parts');
        $this->load->view('manufacturer', $Data);
        $this->load->view('footer');
    }

    function newManufacturer() {
        $this->form_validation->set_rules('Manufacturer', 'Manufacturer', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $ManufacturerData = array(
                'Manufacturer' => $this->input->post('Manufacturer'),
                'CreatedDate' => date('Y-m-d')
            );
            $this->Parts_manufacturer->insertManufacturer($ManufacturerData);
            redirect(base_url() . "index.php/manufacturer/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('Manufacturer', 'Manufacturer', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idManufacturer = $this->input->post('ManufacturerId');
            $ManufacturerData = array(
                'Manufacturer' => $this->input->post('Manufacturer')
            );
            $this->Parts_manufacturer->updateManufacturer($idManufacturer, $ManufacturerData);
            redirect(base_url() . "index.php/manufacturer/index");
        }
    }

    function search() {
        $Search = $this->input->post('search');
        $InventorySearch = $this->Parts_manufacturer->searchManufacturer($Search);
        $PartInventory = json_encode($InventorySearch);
        print_r($PartInventory);
    }

}
