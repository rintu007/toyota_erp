<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Purchase extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_name');
        $this->load->model('Inventory_purchase');
        $this->load->model('Inventory_party');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
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
        $Data['GRNumber'] = $Purchase->getGRNumber();
        $Data['Party'] = $Party->fillPartyCombo();
        $id= $this->db->query('select max(s.idPurchaseLocal) as grn from inventory_purchase_local s')->row();
        $Data['GRN'] = ($id->grn)+1;
        $Data['Part'] = $PartsName->fillLocalPartsCombo();
        $Data['Parts'] = $PartsName->fillIMCPartsCombo();
        $Data['message'] = $this->session->flashdata('message');
        $this->load->view('header_parts', $Data);
        $this->load->view('purchase', $Data);
        $this->load->view('footer');
    }

    public function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Purchase = new Inventory_purchase();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Purchase'] = $Purchase->AllPurchases();
        $Data['LOCPurchase'] = $Purchase->LOCPurchases();
        $Data['IMCPurchase'] = $Purchase->IMCPurchases();
        $this->load->view('header_parts', $Data);
        $this->load->view('purchase_view', $Data);
        $this->load->view('footer');
    }

    function add() {
        $Purchase = new Inventory_purchase();
        $this->form_validation->set_rules('PartyName', 'Party Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $NewPurchase = $Purchase->NewPurchase();
            if ($NewPurchase) {
                $this->session->set_flashdata('message', '<h4 style="background-color: green;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center; margin-top: 14px;">' . "Successfully Done" . '</h4>');
                redirect(base_url() . "index.php/purchase/index");
            } else {
                $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">' . "Failed" . '</h4>');
                redirect(base_url() . "index.php/purchase/index");
            }
        } else {
            $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Please fill all mandatory fields!</h4>');
            redirect(base_url() . "index.php/purchase/index");
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
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
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

    function typesearch() {
        $PurchaseType = new Inventory_purchase();
        $search = $this->input->post('search');
        $dataSearch = $PurchaseType->SearchPurchaseType($search);
        $Type = json_encode($dataSearch);
        print_r($Type);
    }

    function test() {
        $PurchaseData = array();

        $idPurchaseType = $this->input->post('type');
        $PurchaseType = $this->getPurchaseType($idPurchaseType)[0];

        if ($PurchaseType['PurchaseType'] == "Order") {
            $idOrder = $_POST['orderdetails'];
            $PartyName = $_POST['PartyName'];
            $Part = $_POST['parts'];
            $Quantity = $_POST['receivedquantity'];
            $Price = $_POST['price'];
            $Discount = $_POST['discount'];
            $ActualCost = $_POST['actualcost'];
            $LandValue = $_POST['landvalue'];
            $InvoiceNumber = $_POST['InvoiceNumber'];
            $InvoiceDate = $_POST['InvoiceDate'];
            for ($i = 0; $i < count($_POST['parts']); $i++) {
                $PurchaseData[] = array(
                    'OrderId' => $idOrder[$i],
                    'PurchaseId' => '1',
                    'PartId' => $Part[$i],
                    'QuantityReceived' => $Quantity[$i],
                    'CostPrice' => $Price[$i],
                    'Discount' => $Discount[$i],
                    'ActualCost' => $ActualCost[$i],
                    'LandValue' => $LandValue[$i],
                    'InvoiceNumber' => $InvoiceNumber,
                    'InvoiceDate' => $InvoiceDate,
                );
            }
        } else {
            print_r($PurchaseType['PurchaseType']);
        }
    }

    function checkOrderNumber() {
        $Pbo = new Inventory_purchase();
        $PboSerial = $this->input->post('PboSerial');
        $CheckPboSerial = $Pbo->CheckOrderNumber($PboSerial);
        print_r($CheckPboSerial);
    }

    function getPurchaseType($idPurchaseType) {
        $Purchase = new Inventory_purchase();

        $PurchaseType = $Purchase->AllPurchaseType($idPurchaseType);
        return $PurchaseType;
    }

    function getOrder() {
        $OrderNumber = $this->input->post('OrderNumber');
        $Purchase = new Inventory_purchase();
        $Order = $Purchase->getOrder($OrderNumber);
        echo json_encode($Order);
    }

    function getPartDetails() {
        $Purchase = new Inventory_purchase();
        $idPart = $this->input->post('idPart');
        $PartDetails = $Purchase->getPartDetails($idPart);
        echo json_encode($PartDetails);
    }

    function SearchLOC() {
        $search = $this->input->post('searchLOC');
        $dataSearch = $this->Inventory_purchase->SearchLOCPurchase($search);
        echo json_encode($dataSearch);
    }

    function SearchIMC() {
        $search = $this->input->post('searchIMC');
        $dataSearch = $this->Inventory_purchase->SearchIMCPurchase($search);
        echo json_encode($dataSearch);
    }

    function filterByDateLOC() {
        $Purchase = new Inventory_purchase();
        $filterByDate = $this->input->post();
        $PurchaseFilterByDate = $Purchase->LOCPurchases($filterByDate);
        echo json_encode($PurchaseFilterByDate);
    }

    function filterByDateIMC() {
        $Purchase = new Inventory_purchase();
        $filterByDate = $this->input->post();
        $PurchaseFilterByDate = $Purchase->IMCPurchases($filterByDate);
        echo json_encode($PurchaseFilterByDate);
    }
	
	public function savePurchaseReturn() {

        $Purchase = new Inventory_purchase();
        $insert = $Purchase->insertPurchaseReturn();
        if ($insert) {
            $insert = $Purchase->subtractPartQuantity($_POST['idPart'], $_POST['ReturnQuantity']);
        }
        if ($insert) {
            $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Purchase Return Added Successfully</h4>');
            redirect(base_url() . "index.php/purchase/view");
        }
        $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Unable to Add Purchase Return</h4>');
        redirect(base_url() . "index.php/purchase/view");
    }

    function getPurchaseReturn() {
        $Purchase = new Inventory_purchase();
        $data = $Purchase->getPurchaseReturn($_POST['IdPurchase'], $_POST['IdPart'], $_POST['type']);
        echo json_encode($data);
    }
    
    function viewPurchaseReturn()
    {
        $Data = array();
        $Purchase = new Inventory_purchase();
        $Data['message'] = $this->session->flashdata('message');

        
       
        $Data['PurchaseReturn'] = $Purchase->getAllPurchaseReturn();
        $this->load->view('header_parts', $Data);
        $this->load->view('purchasereturn_view', $Data);
        $this->load->view('footer');
    }
	//changes made on 20-01-2016 generateImc() generateLoc added
	function generateImc($idPurchase){
        $Purchases = new Inventory_purchase();
		$Data['PurchaseInvoice'] = $Purchases->IMCPurchases(Null,$idPurchase);
        $this->load->view('header_parts');
        $this->load->view('viewpurchaseinv', $Data);
        $this->load->view('footer');
	}
	function generateLoc($idPurchase){
        $Purchases = new Inventory_purchase();
		$Data['PurchaseInvoice'] = $Purchases->LOCPurchases(Null,$idPurchase);
        $this->load->view('header_parts');
        $this->load->view('viewpurchaseinvLoc', $Data);
        $this->load->view('footer');
	}

}
