<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sales extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Inventory_sales');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Sale = new Inventory_sales();

        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Parts'] = $Sale->fillPartComboCombo();
        $Data['Party'] = $Sale->fillPartyCombo();
        $Data['SaleType'] = $Sale->fillSaleTypeCombo();
        $Data['paymentMode'] = $invoice->allModePayment();
        $Data['InvoiceNumber'] = $invoice->getInvoiceNumber();
        $Data['message'] = $this->session->flashdata('message');
        $Data['Fleet'] = $this->db->where('isFleet',1)->get('sale_customer')->result_array();
        $Data['Jobber'] =  $this->db->where('isJobber',1)->get('sale_customer')->result_array();

        $this->load->view('header_parts', $Data);
        $this->load->view('sales', $Data);
        $this->load->view('footer');
    }
    function addcustomer() {

        $Data['Customers'] = $this->db->get('sale_customer')->result_array();
        $this->load->view('header_parts', $Data);
        $this->load->view('addcustomer', $Data);
        $this->load->view('footer');
    }

    function customer_add(){
        $data = array(
            'name'=>$this->input->post('name'),
            'mobile'=>$this->input->post('mobile'),
            'phone'=>$this->input->post('phone'),
            'address'=>$this->input->post('address'),
            'IsJobber'=>($this->input->post('jobber'))?1:0,
            'IsFleet'=>($this->input->post('fleet'))?1:0
        );
        //	var_dump($data);die;
        $this->db->insert('sale_customer',$data);
        redirect(base_url() . "index.php/sales/addcustomer");

    }

    public function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Sale = new Inventory_sales();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['Sale'] = $Sale->AllSales();
        $i = 0;
        foreach ($Data['Sale'] as $InventorySales) {
            $count = $Sale->getdiscountperitem($InventorySales['SaleId']);
            $Data['Sale'][$i]['Discount'] =  intval($InventorySales['Discount'])/$count;
            $Data['Sale'][$i]['Surcharge'] =  intval($InventorySales['Surcharge'])/$count;
            $i++;
        }
        $Data['paymentMode'] = $invoice->allModePayment();
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $this->load->view('header_parts', $Data);
        $this->load->view('sales_view', $Data);
        $this->load->view('footer');
    }

    public function generate($idSale) {
        $Sale = new Inventory_sales();
        $Data['SaleInvoice'] = $Sale->AllSales(NULL,$idSale);
        $this->load->view('header_parts');
        $this->load->view('sale_invoice', $Data);
//        $this->load->view('sale_invoice');
        $this->load->view('footer');
    }
	//generate1 added on 2-2-2016
	public function generate1($idSale) {
        $Sale = new Inventory_sales();
        $Data['SaleInvoice'] = $Sale->AllSales(NULL,$idSale);
        $this->load->view('header_parts');
        $this->load->view('sale_invoice1', $Data);
//        $this->load->view('sale_invoice');
        $this->load->view('footer');
    }

    function add() {
        $Sale = new Inventory_sales();
        $this->form_validation->set_rules('idSaleType', 'Sale Type', 'required|xss_clean');
        $this->form_validation->set_rules('idParty', 'Party Name', 'required|xss_clean');
        $this->form_validation->set_rules('SaleDate', 'Sale Date', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $AddSale = $Sale->AddSales();
            if ($AddSale == "TRUE") {
                $this->session->set_flashdata('message', '<h4 style="background-color: green;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center; margin-top: 14px;">' . "Sales Has Been Successfully Done" . '</h4>');
                redirect(base_url() . "index.php/sales/index");
            } else if ($AddSale == "FALSE") {
                $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">' . "Failed" . '</h4>');
                redirect(base_url() . "index.php/sales/index");
            } else {
                $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">' . $AddSale . '</h4>');
                redirect(base_url() . "index.php/sales/index");
            }
        } else {
            $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Please fill all mandatory fields!</h4>');
            redirect(base_url() . "index.php/sales/index");
        }
    }

    function type() {
        $Sale = new Inventory_sales();
        $this->form_validation->set_rules('TypeName', 'Purchase Type Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $SaleTypeData = array(
                'SaleType' => $this->input->post('TypeName'),
                'CreatedDate' => date('Y/m/d')
            );
            $PurchaseType = $Sale->AddSaleType($SaleTypeData);
            if ($PurchaseType) {
                $this->session->set_flashdata('Response', '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Sale Type has been added successfully!</h4>');
                redirect(base_url() . "index.php/sales/type");
            } else {
                $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Please fill all required feilds!</h4>');
                redirect(base_url() . "index.php/sales/type");
            }
        }
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['SaleType'] = $Sale->allSaleType();
        $Data['Response'] = $this->session->flashdata('Response');
        $this->load->view('header_parts', $Data);
        $this->load->view('sale_type', $Data);
        $this->load->view('footer');
    }

    function edittype() {
        $Sale = new Inventory_sales();
        $this->form_validation->set_rules('idSaleType', 'Sale ID', 'required|xss_clean');
        $this->form_validation->set_rules('TypeName', 'Sale Type Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $SaleTypeData = array(
                'SaleType' => $this->input->post('TypeName')
            );
            $idSaleType = $this->input->post('idSaleType');
            $editSaleType = $Sale->EditSaleType($idSaleType, $SaleTypeData);
            if ($editSaleType) {
                $this->session->set_flashdata('Response', '<h4 style="background-color: green; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Sale Type has been updated successfully!</h4>');
                redirect(base_url() . "index.php/sales/type");
            } else {
                $this->session->set_flashdata('Response', '<h4 style="background-color: maroon; color: white; margin-left: 39px; margin-top: 12px; width: 1016px; text-align: center;">Failed to update Sale Type!</h4>');
                redirect(base_url() . "index.php/sales/type");
            }
        }
    }

    function typesearch() {
        $SaleType = new Inventory_sales();
        $search = $this->input->post('search');
        $dataSearch = $SaleType->SearchSaleType($search);
        $Type = json_encode($dataSearch);
        print_r($Type);
    }

    function Search() {
        $Sale = new Inventory_sales();
        $Keyword = $this->input->post('search');
        $SaleSearch = $Sale->SearchSales($Keyword);
        echo json_encode($SaleSearch);
    }

    function filterByDate() {
        $Sale = new Inventory_sales();
        $filterByDate = $this->input->post();
        $SaleFilterByDate = $Sale->AllSales($filterByDate);
        echo json_encode($SaleFilterByDate);
    }

    public function saveSaleReturn()
    {
        $Sale = new Inventory_sales();
        $insert= $Sale->insertSaleReturn();
        if($insert)
        {
            $insert = $Sale->addPartQuantity($_POST['idPart'],$_POST['ReturnQuantity']);
        }
        if($insert)
        {
            $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Sales Return Added Successfully</h4>');
            redirect(base_url() . "index.php/sales/view");

        }
        $this->session->set_flashdata('message', '<h4 style="background-color: maroon;color: white;font-size: initial;width: 985px;margin-left: 56px;text-align: center;margin-top: 14px;">Unable to Add Sales Return</h4>');
        redirect(base_url() . "index.php/sales/view");


    }



    function getSalesReturn()
    {
        $Sale = new Inventory_sales();
        $data = $Sale->getSalesReturn( $_POST['IdSale'],$_POST['IdPart']);
        echo json_encode($data);

    }

    function viewSalesReturn()
    {
        $Data = array();
        $Sale = new Inventory_sales();
        $Data['message'] = $this->session->flashdata('message');
        $Data['SalesReturn'] = $Sale->getAllSalesReturn();
//        var_dump( $Data['SalesReturn']);exit();


        $this->load->view('header_parts', $Data);
        $this->load->view('salesreturn_view', $Data);
        $this->load->view('footer');
    }


}
