<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Umar Akbar
 * Description: Gate Pass Controller Class
 */

class Gatepass extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_resource_book');
        $this->load->model('Car_gatepass');
        $this->load->library('form_validation');
    }

    public function index22() {
        $Gatepass = new Car_gatepass();
        $Data = array();
//        $Data['message'] = $this->session->flashdata('message');
        $Data['GatePassNumber'] = $Gatepass->GatePassSerial();
        $Data['DoNumber'] = $Gatepass->DOSerial();
        $Data['Response'] = $this->session->flashdata('Response');
        $this->load->view('header');
        $this->load->view('gatepass', $Data);
        $this->load->view('footer');
    }
    function gatepass_list()
    {
        $Gatepass = new Car_gatepass();
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 1;
        $config["base_url"] = base_url() . "index.php/gatepass/list";
        $config["total_rows"] = $Gatepass->Gatepass_count();
        $this->data['counts']=  $config["total_rows"];
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['page'] = $page+1;
        $this->data["links"] = $this->pagination->create_links();

        $this->data['gp'] = $Gatepass->get_gatepass($config["per_page"], $page);

        $this->load->view('header');
        $this->load->view('gatepass_list', $this->data);
        $this->load->view('footer');

    }
    public function index($idDispatch) {
        $Gatepass = new Car_gatepass();
        $Data = array();
        $Data['customertype'] = $this->Car_resource_book->fillCustomerTypeCombo();
//        print_r($Data);
//        $Data['message'] = $this->session->flashdata('message');
        $Data['GatePassNumber'] = $Gatepass->GatePassSerial();
        $Data['dispatchdata'] = $Gatepass->get_data($idDispatch);
        $Data['DoNumber'] = $Gatepass->DOSerial();
        $Data['Response'] = $this->session->flashdata('Response');
        $this->load->view('header');
//        $this->load->view('gatepass', $Data);
        $this->load->view('gatepass1', $Data);
        $this->load->view('footer');
    }

    function newGatepass() {
        $Gatepass = new Car_gatepass();
        $this->form_validation->set_rules('GatePassNumber', 'Gate Pass Number', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {

            $GatepassData = array(
                'GatePassNumber' => $this->input->post('GatePassNumber'),
                'GatePassDate' => $this->input->post('GatePassDate'),
                'Through' => $this->input->post('Through'),
                'Cnic' => $this->input->post('Cnic'),
                'Company' => $this->input->post('CompanyName'),
                'customerId' => $this->input->post('CustomerId'),
                'dispatchId' => $this->input->post('DispatchId'),
                'Description' => $this->input->post('Description'),
                'SaleNoteId' => NULL
            );

            $PboId = $this->input->post('pboid');
            $insertGatepass = $Gatepass->insertGatepass($GatepassData, $PboId);
            $this->receipt($insertGatepass);
            return;



            if ($this->input->post('gatepassType') == 'PBO') {

                $GatepassData = array(
                    'GatePassNumber' => $this->input->post('GatePassNumber'),
                    'GatePassDate' => $this->input->post('GatePassDate'),
                    'Through' => $this->input->post('Through'),
                    'Cnic' => $this->input->post('Cnic'),
                    'Company' => $this->input->post('CompanyName'),
                    'customerId' => $this->input->post('CustomerId'),
                    'dispatchId' => $this->input->post('DispatchId'),
                    'Description' => $this->input->post('Description'),
                    'SaleNoteId' => NULL
                );

                $PboId = $this->input->post('pboid');
                $insertGatepass = $Gatepass->insertGatepass($GatepassData, $PboId);
                if ($insertGatepass != FALSE) {
                    //Generate Receipt For Printing
                    $Response = '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Gate Pass Haas Been Created. Now You Can Print The Gate Pass. Click On Print.</h4>';
                    echo "Without DO";
                    $this->receipt($insertGatepass, $Response);
                } else {
                    $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please Re-Generate Gate Pass. Some Error Occurred During Generating Gate Pass.</h4>');
                    redirect(base_url() . "index.php/gatepass/index");
                }
            } else if ($this->input->post('gatepassType') == 'Open Stock') {
                if ($this->input->post('dOrder') == "check") {
                    $GatepassData = array(
                        'GatePassNumber' => $this->input->post('GatePassNumber'), 'GatePassDate' => $this->input->post('GatePassDate'),
                        'Through' => $this->input->post('Through'),
                        'Cnic' => $this->input->post('Cnic'),
                        'Company' => $this->input->post('CompanyName'),
                        'isffs' => 0,
                        'SaleNoteId' => $this->input->post('SaleNoteId'));

                    $DoData = array(
                        'DoNumber' => $this->input->post('do'), 'DoDate' => $this->input->post('GatePassDate'),
                        'Through' => $this->input->post('Through'),
                        'Cnic' => $this->input->post('Cnic'),
                        'Company' => $this->input->post('CompanyName'));

                    $PboId = NULL;
                    $insertGatepass = $Gatepass->insertGatepass($GatepassData, $PboId, $DoData);
                    if ($insertGatepass != FALSE) {
                        //Generate Receipt For Printing
                        $Response = '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Gate Pass Haas Been Created. Now You Can Print The Gate Pass. Click On Print.</h4>';
                        $this->receiptSaleNote($insertGatepass, $Response);
                    } else {
                        $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please Re-Generate Gate Pass. Some Error Occurred During Generating Gate Pass.</h4>');
                        redirect(base_url() . "index.php/gatepass/index");
                    }
                } else {
                    $GatepassData = array(
                        'GatePassNumber' => $this->input->post('GatePassNumber'), 'GatePassDate' => $this->input->post('GatePassDate'),
                        'Through' => $this->input->post('Through'),
                        'Cnic' => $this->input->post('Cnic'),
                        'Company' => $this->input->post('CompanyName'),
                        'isffs' => 0,
                        'SaleNoteId' => $this->input->post('SaleNoteId'));
                    $PboId = NULL;
                    $insertGatepass = $Gatepass->insertGatepass($GatepassData, $PboId);
                    if ($insertGatepass != FALSE) {
                        //Generate Receipt For Printing
                        $Response = '<h4 style="background-color: Green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Gate Pass Haas Been Created. Now You Can Print The Gate Pass. Click On Print.</h4>';
                        $this->receiptSaleNote($insertGatepass, $Response);
                    } else {
                        $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please Re-Generate Gate Pass. Some Error Occurred During Generating Gate Pass.</h4>');
                        redirect(base_url() . "index.php/gatepass/index");
                    }
                }
            } else {
                $this->session->set_flashdata('Response', '<h4>You Must Select Open Stock or PBO</h4>');
                redirect(base_url() . "index.php/gatepass/index");
            }
        } else {
            $this->session->set_flashdata('Response', '<h4>Must fill all required fields</h4>');
            redirect(base_url() . "index.php/gatepass/index");
        }
    }

    function getPbo() {
        $Gatepass = new Car_gatepass();
        $search = $this->input->post('Pbo');
        $dataSearch = $Gatepass->getPbo($search);
        echo json_encode($dataSearch);
    }

    function receipt($idGatePass) {
        $Gatepass = new Car_gatepass();
        $GatePassReceipt = $Gatepass->GatePassReceipt($idGatePass)[0];

        $Data['GatePassReceipt'] = $GatePassReceipt;
        $Data['Response'] = '';
        $this->load->view('header');
        $this->load->view('gatepass_receipt', $Data);
        $this->load->view('footer');
    }

    function receiptSaleNote($idGatePass, $Response) {
        $Gatepass = new Car_gatepass();
        $GatePassReceipt = $Gatepass->GatePassReceipt($idGatePass)[0];

        $Data['GatePassReceipt'] = $GatePassReceipt;
        $Data['Response'] = $Response;
        $this->load->view('header');
        $this->load->view('gatepass_receipt', $Data);
        $this->load->view('footer');
    }

    function getSaleNote() {
        $Gatepass = new Car_gatepass();
        $search = $this->input->post('ChasisNo');
        $dataSearch = $Gatepass->getSaleNote($search);
        if (count($dataSearch) > 0) {
            echo json_encode($dataSearch);
        } else {
            $a = "Variant of the Given Chasis Number is Already Delivered.";
            echo json_encode($a);
        }
    }

    function getPayment() {
        $Gatepass = new Car_gatepass();
        $search = $this->input->post('ChasisNo');

        $ReceiptPayment = $Gatepass->getReceiptPayment($search);
        $ReceivablePayment = $Gatepass->getReceivablePayment($search);

        if (!empty($ReceiptPayment)) {
            foreach ($ReceiptPayment as $val) {
                $Receipt = $val;
            }
            $arr1 = array($Receipt['Receipt']);
        }

        if (!empty($ReceivablePayment)) {
            foreach ($ReceivablePayment as $val) {
                $Receivable = $val;
            }
            $arr = array($Receivable['Receivable']);
        }

        if (!empty($Receivable) || !empty($Receipt)) {
            $subtracted = array_map(function ($x, $y ) {
                $a = $x - $y;
                return $a;
            }, $arr, $arr1);
            $result = array_combine(array_keys($arr), $subtracted);
            echo json_encode($result);
        } else {
            $a = "Given Chasis Number is not Exists.";
            echo json_encode($a);
        }
    }

    function getVariantColor() {
        $Gatepass = new Car_gatepass();
        $idVariant = $this->input->post('Variant');
        $GetColor = $Gatepass->fillColorByVariant($idVariant);
        echo json_encode($GetColor);
    }

    function CheckEngineNumber() {
        $Gatepass = new Car_gatepass();
        $EngineNumber = $this->input->post('EngineNumber');
        $CheckEngineNumber = $Gatepass->CheckEngineNumber($EngineNumber);
        print_r($CheckEngineNumber);
    }

    function CheckChasisNumber() {
        $Gatepass = new Car_gatepass();
        $ChasisNumber = $this->input->post('ChasisNumber');
        $CheckChasisNumber = $Gatepass->CheckChasisNumber($ChasisNumber);
        print_r($CheckChasisNumber);
    }

}
