<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Umar Akbar
 * Description: Variants controller class
 */

class Registration extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_resource_book');
        $this->load->model('Car_registration');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
//        $Data['message'] = $this->session->flashdata('message');

        $this->load->view('header');
        $this->load->view('registration');
        $this->load->view('footer');
    }

    function newRegistration() {
        $Invoice = new Car_registration();
        $this->form_validation->set_rules('InvoiceNumber', 'Invoice Number', 'required|xss_clean');
        $this->form_validation->set_rules('InvoiceDate', 'Invoice Date', 'required|xss_clean');
        $this->form_validation->set_rules('ModelYear', 'Model Year', 'required|xss_clean');
        $this->form_validation->set_rules('ReceivedFrom', 'Received From', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $invoiceData = array(
                'PboId' => $this->input->post('pboid'), 'InvoiceNumber' => $this->input->post('InvoiceNumber'),
                'InvoiceDate' => $this->input->post('InvoiceDate'),
                'CertificateNumber' => $this->input->post('CertificateNumber'),
                'ModelYear' => $this->input->post('ModelYear'),
                'Remarks' => $this->input->post('remarks'),
                'ReceivedFrom' => $this->input->post('ReceivedFrom'),
                'InvoiceAmount' => $this->input->post('InvoiceAmount'));

            $PboId = $this->input->post('pboid');

            $PboData = array(
                'InvoiceCreated' => 1
            );

            $Invoice->insertInvoice($invoiceData, $PboData, $PboId);

            redirect(base_url() . "index.php/invoice/index");
        }
    }

    function getPbo() {
        $invoice = new Car_registration();
        $search = $this->input->post('Pbo');
        $dataSearch = $invoice->getPbo($search);
        echo json_encode($dataSearch);
    }

    function getVariantColor() {
        $invoice = new Car_registration();
        $idVariant = $this->input->post('Variant');
        $GetColor = $invoice->fillColorByVariant($idVariant);
        echo json_encode($GetColor);
    }

    function CheckEngineNumber() {
        $invoice = new Car_registration();
        $EngineNumber = $this->input->post('EngineNumber');
        $CheckEngineNumber = $invoice->CheckEngineNumber($EngineNumber);
        print_r($CheckEngineNumber);
    }

    function CheckChasisNumber() {
        $invoice = new Car_registration();
        $ChasisNumber = $this->input->post('ChasisNumber');
        $CheckChasisNumber = $invoice->CheckChasisNumber($ChasisNumber);
        print_r($CheckChasisNumber);
    }

}
