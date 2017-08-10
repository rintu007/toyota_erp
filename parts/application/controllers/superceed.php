<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Superceed extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_superceed');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Superceed = new Parts_superceed();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Superceed'] = $this->Parts_superceed->allSuperceeds();
        $Data['Parts'] = $Superceed->fillPartCombo();
        $this->load->view('header_parts', $Data);
        $this->load->view('superceed', $Data);
        $this->load->view('footer');
    }

    function newSuperceed() {
        $this->form_validation->set_rules('Superceed', 'Superceed', 'required|xss_clean');
        $this->form_validation->set_rules('PartName', 'Part Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $SuperceedData = array(
                'OldPart' => $this->input->post('PartName'),
                'SuperceedPart' => $this->input->post('Superceed')
            );
            $this->Parts_superceed->insertSuperceed($SuperceedData);
            redirect(base_url() . "index.php/superceed/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('Superceed', 'Superceed', 'required|xss_clean');
        $this->form_validation->set_rules('PartName', 'Part Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idSuperceed = $this->input->post('SuperceedId');
            $SuperceedData = array(
                'OldPart' => $this->input->post('PartName'),
                'SuperceedPart' => $this->input->post('Superceed')
            );
            $this->Parts_superceed->updateSuperceed($idSuperceed, $SuperceedData);
            redirect(base_url() . "index.php/superceed/index");
        }
    }

    function search() {
        $Search = $this->input->post('search');
        $SuperceedSearch = $this->Parts_superceed->searchSuperceed($Search);
        $PartSuperceed = json_encode($SuperceedSearch);
        print_r($PartSuperceed);
    }

}
