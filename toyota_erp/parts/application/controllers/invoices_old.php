<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Invoices extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_invoices');
        $this->load->model('Order_mode');
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $oMode = new Order_mode();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['OrderModes'] = $oMode->allOrderModes();
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['brandCombo'] = $invoice->getBrand();
        $this->load->view('header_parts', $Data);
        $this->load->view('invoice', $Data);
        $this->load->view('footer');
    }

    function Oldview() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Type'] = $invoice->fillInvoiceTypeCombo();
        $Data['AllDailyOrders'] = $invoice->allDO();
        $Data['AllPlanOrders'] = $invoice->allPO();
        $Data['AllUrgentOrders'] = $invoice->allUO();
        $Data['AllDPackageOrders'] = $invoice->allDPO();
        $Data['AllMPackageOrders'] = $invoice->allMPO();
        $Data['AllAccessoriesOrders'] = $invoice->allAO();
        $Data['AllDhamakaPackage'] = $invoice->allDP();
        $Data['AllMaintenancePackage'] = $invoice->allMP();
        $Data['AllWarrantyOrders'] = $invoice->allWO();
        $Data['AllChemicalOrders'] = $invoice->allCO();
        $Data['AllLocalPurchases'] = $invoice->allLP();
        $Data['AllOtherPurchases'] = $invoice->allOP();
        $Data['AllVOR'] = $invoice->allVR();
        $Data['AllTgmo'] = $invoice->allT();
        $Data['BrandNameCombo'] = $invoice->allBrands();
        $this->load->view('header_parts', $Data);
        $this->load->view('view_invoice', $Data);
        $this->load->view('footer');
    }
	
	  function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Type'] = $invoice->fillInvoiceTypeCombo();
        $Data['AllDailyOrders'] = $invoice->allDailyOrders();
        $Data['AllPlanOrders'] = $invoice->allPlanOrders();
        $Data['AllUrgentOrders'] = $invoice->allUrgentOrders();
        $Data['AllDPackageOrders'] = $invoice->allDPackageOrders();
        $Data['AllSpecialOffers'] = $invoice->allSpecialOffers();
        $Data['AllTgmo'] = $invoice->allTgmo();
        $Data['AllVOR'] = $invoice->allVOR();
        $Data['AllChemicalOrder'] = $invoice->allChemicalOrder();
        $Data['AllBySeaOrders'] = $invoice->allBySeaOrders();
        $Data['AllLocalPurchase'] = $invoice->allLocalPurchase();
        $Data['AllMPackageOrders'] = $invoice->allMPackageOrders();
        $Data['AllAccessoriesOrders'] = $invoice->allAccessoriesOrders();
        $Data['AllDhamakaPackage'] = $invoice->allDhamakaPackage();
        $Data['AllMaintenancePackage'] = $invoice->allMaintenancePackage();
        $Data['AllWarrantyOrders'] = $invoice->allWarrantyOrder();
        $Data['BrandNameCombo'] = $invoice->allBrands();
        $this->load->view('header_parts', $Data);
        $this->load->view('view_invoice', $Data);
        $this->load->view('footer');
    }

    function parts($Type) {
        $invoice = new Parts_invoices();
        $fillPartCombo = $invoice->fillPartCombo(urldecode($Type));
        echo json_encode($fillPartCombo);
    }

    function dispatch($Name = NULL) {
        $invoice = new Parts_invoices();
        $fillDispatchCombo = $invoice->fillDispatchModeCombo($Name);
        echo json_encode($fillDispatchCombo);
    }

    function dailyorder($idInvoice) {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber();
        $Data['GetInvoice'] = $invoice->oneDailyOrder($idInvoice)[0];
        $this->load->view('header_parts', $Data);
        $this->load->view('dailyorder', $Data);
        $this->load->view('footer');
    }

    function saveDailyOrder() {
        $invoice = new Parts_invoices();
        $saveDailyOrder = $invoice->saveDailyOrder();
//        echo "Daily Order: <br>";
//        print_r($saveDailyOrder);
//        redirect(base_url() . "/index.php/invoices/index");
    }

    function allDailyOrders() {
        $invoice = new Parts_invoices();
        $DailyOrder = $invoice->allDailyOrders();
        echo json_encode($DailyOrder);
    }

    function searchdailyorder() {
        $SearchKeyword = $this->input->post('idPart');
        $invoice = new Parts_invoices();
        $InvoiceSearch = $invoice->searchDailyOrder($SearchKeyword);
        $PartInvoice = json_encode($InvoiceSearch);
        echo $PartInvoice;
    }

    function orderNumber() {
        $invoice = new Parts_invoices();
        $orderNumber = $invoice->getOrderNumber();
        return $orderNumber;
    }

    function getSpecificOrder() {
        $invoice = new Parts_invoices();
        $orderType = $this->input->post('OrderType');
        $brandName = $this->input->post('BrandName');
        $orderNumber = $this->input->post('OrderNumber');
        $specificOrder = $invoice->searchSpecificOrder($orderType, $brandName, $orderNumber);
        echo json_encode($specificOrder);
    }
	
	public function PrintDailyOrder($idOrder)
    {

        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneDailyOrder($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintDailyOrder', $Data);
        $this->load->view('footer');


    }



    public function PrintTgmoPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneTgmo($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintTgmo', $Data);
        $this->load->view('footer');



    }

    public function PrintDhamakaPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneDhamakaPackage($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintDhamakaPackage', $Data);
        $this->load->view('footer');



    }

    public function PrintMaintenancePackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneMaintenancePackage($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintMaintenancePackage', $Data);
        $this->load->view('footer');



    }

    public function PrintWarrentyPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneWarrantyOrder($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintWarrentyPackage', $Data);
        $this->load->view('footer');



    }

    public function PrintLocalPackage($idOrder)
{
    $Data = array();
    $invoice = new Parts_invoices();
    $Data['OrderNo'] = $idOrder;
    $Data['GetInvoice'] = $invoice->oneLocalPurchase($idOrder);
    $this->load->view('header_parts', $Data);
    $this->load->view('PrintLocalPackage', $Data);
    $this->load->view('footer');



}
    public function PrintVORPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneVOR($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintVORPackage', $Data);
        $this->load->view('footer');



    }
	   public function PrintChemicalPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneChemicalOrder($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintChemicalPackage', $Data);
        $this->load->view('footer');



    }
	   public function PrintOtherPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneOtherPurchase($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintOtherPackage', $Data);
        $this->load->view('footer');



    }
	public function PrintSeaPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneBySeaOrder($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintSeaPackage', $Data);
        $this->load->view('footer');



    }
	public function PrintPlanPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->onePlanOrder($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintPlanPackage', $Data);
        $this->load->view('footer');



    }
	   public function PrintSpecialPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneSpecialOffer($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintSpecialPackage', $Data);
        $this->load->view('footer');



    }
	public function PrintAccessoriesPackage($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneAccessoriesOrder($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintAccessoriesPackage', $Data);
        $this->load->view('footer');



    }
	


}
