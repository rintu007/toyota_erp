<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_name extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_inventory');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['Inventory'] = $this->Parts_inventory->allInventory();
        $this->load->view('header_parts');
        $this->load->view('partsInventory', $this->data);
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
            redirect(base_url() . "index.php/partsInventory/index");
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
            redirect(base_url() . "index.php/partsInventory/index");
        }
    }

    function search() {
        $Search = $this->input->post('search');
        $InventorySearch = $this->Parts_inventory->searchInventory($Search);
        $PartInventory = json_encode($InventorySearch);
        print_r($PartInventory);
    }

}
