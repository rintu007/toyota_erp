<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Party extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_invoices');
        $this->load->model('Inventory_party');
        $this->load->library('form_validation');
    }

    public function index() {
        $Party = new Inventory_party();
        $this->form_validation->set_rules('PartyName', 'Party/Vendor Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $PartyData = array(
                'Name' => $this->input->post('PartyName'),
                'CreatedDate' => date('Y/m/d'),
				'Type' => 'Party',
            );
            $insertParty = $Party->insertParty($PartyData);
            if ($insertParty) {
                $this->session->set_flashdata('Response', '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Party / Vendor has been added successfully!</h4>');
                redirect(base_url() . "index.php/party/");
            } else {
                $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please fill all required feilds!</h4>');
                redirect(base_url() . "index.php/party/");
            }
            echo "POst Data";
        }
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Party'] = $Party->allParties();
        $Data['Response'] = $this->session->flashdata('Response');
        $this->load->view('header_parts', $Data);
        $this->load->view('party', $Data);
        $this->load->view('footer');
    }

    function update() {
        $Party = new Inventory_party();

        $this->form_validation->set_rules('idParty', ' idParty/idVendor Name', 'required|xss_clean');
        $this->form_validation->set_rules('PartyName', 'Party/Vendor Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idParty = $this->input->post('idParty');
            $PartyData = array(
                'Name' => $this->input->post('PartyName'),
            );
            $updateParty = $Party->updateParty($idParty, $PartyData);
            if ($updateParty) {
                $this->session->set_flashdata('Response', '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Party / Vender Has Been Updated Successfully!</h4>');
                redirect(base_url() . "index.php/party/");
            }
        }
    }

    function search() {
        $Party = new Inventory_party();

        $SearchKeyword = $this->input->post('search');
        $PartySearch = $Party->searchParty($SearchKeyword);
        $InventoryParty = json_encode($PartySearch);
        print_r($InventoryParty);
    }

}
