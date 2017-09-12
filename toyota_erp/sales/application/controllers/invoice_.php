<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Umar Akbar
 * Description: Variants controller class
 */

class Invoice extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_resource_book');
        $this->load->model('Car_invoice');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $Data['InvoiceMessage'] = "";
        $dispatch = '';
        $Data['Invoicedetail'] = $this->Car_invoice->GetInvoices($dispatch);
//        print_r( $Data['Invoicedetail']);
        $Data['ActualSalesMan'] = $this->Car_resource_book->fillAllSalesManCombo();
        $Data['ContactType'] = $this->Car_resource_book->fillContactTypeCombo();
        $Data['Varients'] = $this->Car_invoice->getVarients();
        $Data['Model'] = $this->Car_invoice->getModel();
        $invoice = $this->Car_invoice->getInvoiceNumber();
        if (isset($invoice) && $invoice !== '' && count($invoice) > 0) {
            $Data['NewInvoiceNumber'] = $invoice[0]['InvoiceNumber'] + 1;
        } else {
            $Data['NewInvoiceNumber'] = 900000;
        }
        $EntryNumber = $this->Car_invoice->getInvoiceEntryNumber();
        if (isset($EntryNumber) && $EntryNumber !== '' && count($EntryNumber) > 0) {
            $Data['NewEnterNumber'] = $EntryNumber[0]['EntryNumber'] + 1;
        } else {
            $Data['NewEnterNumber'] = 1;
        }

        $this->load->view('header');
        $this->load->view('invoice', $Data);
        $this->load->view('footer');
    }

    public function GetInvoices() {
        $post = $this->input->post();
        $result = $this->Car_invoice->GetInvoices($post['selectDispatch'], $post['dispatchType']);
        echo json_encode($result);
    }

    public function GetVarients() {
        $post = $this->input->post();
        $result = $this->Car_invoice->getVarients();
        echo json_encode($result);
    }

    public function GetColor() {
        $post = $this->input->post();
        $result = $this->Car_invoice->GetColor($post['Vehicle']);
        echo json_encode($result);
    }

    public function index2() {
        $Data = array();
        $Data['InvoiceMessage'] = "";

        $this->load->view('header');
        $this->load->view('invoice_old', $Data);
        $this->load->view('footer');
    }

    function newInvoice() {
        $Invoice = new Car_invoice();
        $this->form_validation->set_rules('InvoiceNo', 'Invoice Number', 'required|xss_clean');


        if ($this->form_validation->run() == TRUE) {
            $invoiceData = array(
                'InvoiceNumber' => $this->input->post('InvoiceNo'),
                'PboId' => $this->input->post('BookingNo'),
                'DispatchId' => $this->input->post('DispatchId'),
                'InvoiceDate' => $this->input->post('InvoiceDate'),
                'ColorResBook' => $this->input->post('Coloor'),
                'ColorDispatch' => $this->input->post('ArrivalColor'),
                'InvoiceAmount' => $this->input->post('InvoiceAmount'),
                'WHT' => $this->input->post('Tax'),
                'Commission' => $this->input->post('Commission'),
                'DeliveryCharges' => $this->input->post('DeliveryCharges'),
                'DonationCharges' => $this->input->post('DonationCharges'),
                'TotalAmount' => $this->input->post('TotalAmount'),
                'InvoiceSource' => $this->input->post('Source'),
                'PurchaseType' => $this->input->post('PurchaseType'),
                'CertificateNumber' => '',
                'ModelYear' => '',
                'Remarks' => '',
                'ReceivedFrom' => ''
            );
            $PboId = $this->input->post('BookingNo');
            $PboData = array(
                'InvoiceCreated' => 1
            );
            $DispatchId = $this->input->post('DispatchId');

            $result = $Invoice->insertInvoice($invoiceData, $PboData, $PboId, $DispatchId);
            echo $result;
        }
    }

    function update() {
        $this->form_validation->set_rules('variant_id', 'Role ID', 'required|xss_clean');
        $this->form_validation->set_rules('variant_name', 'Role Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $VariantId = $this->input->post('variant_id');
            $VariantData = array(
                'Variants' => $this->input->post('variant_name'), 'ModelId' => $this->input->post('model'),
                'ModelCode' => $this->input->post('model_code'), 'ModelDescription' => $this->input->post('model_description'),
                'EngineId' => $this->input->post('engine'), 'DisplacementId' => $this->input->post('displacement'),
                'Price' => $this->input->post('price'), 'FICharges' => $this->input->post('freight'),
                'TotalPrice' => $this->input->post('total_price'), 'MakeId' => $this->input->post('makeId'),
                'CreatedDate' => date('Y/m/d'));
            $this->Car_variants->updateVariants($VariantId, $VariantData);
            redirect(base_url() . "index.php/variants/index");
        }
    }

    function getPbo() {
        $invoice = new Car_invoice();
        $search = $this->input->post('Pbo');
        $dataSearch = $invoice->getPbo($search);
        echo json_encode($dataSearch);
    }

    function lists() {

        $invoice = new Car_invoice();
        $cookieData = unserialize($_COOKIE['logindata']);
        $idUser = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        $Data['InvoiceList'] = $invoice->InvoiceList($UserRole, $idUser);
        $this->load->view('header');
        $this->load->view('invoicelist', $Data);
        $this->load->view('footer');
    }

    function getVariantColor() {
        $invoice = new Car_invoice();
        $idVariant = $this->input->post('Variant');
        $GetColor = $invoice->fillColorByVariant($idVariant);
        echo json_encode($GetColor);
    }

    function CheckEngineNumber() {
        $invoice = new Car_invoice();
        $EngineNumber = $this->input->post('EngineNumber');
        $CheckEngineNumber = $invoice->CheckEngineNumber($EngineNumber);
        print_r($CheckEngineNumber);
    }

    function CheckChasisNumber() {
        $invoice = new Car_invoice();
        $ChasisNumber = $this->input->post('ChasisNumber');
        $CheckChasisNumber = $invoice->CheckChasisNumber($ChasisNumber);
        print_r($CheckChasisNumber);
    }

}
