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
        $Data['message'] = $this->session->flashdata('message');
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
        $Data['MonthlyOrderCycle'] =  $this->db->query("select *,pn.PartNumber,pn.PartName,pn.Description
                                                    from monthly_order_cycle m
                                                    left join parts_name pn
                                                    on pn.idPart=m.IdPart  order by id desc")->result_array();
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

    public function excel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneDailyOrder($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"DAILY ORDER");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e');
$head=array('S.No','Part Number','Part Name','Model','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['Model']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['IMCRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }

	public function PrintUrgentOrder($idOrder)
    {

        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->oneUrgentOrderDetail($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('PrintUrgentOrder', $Data);
        $this->load->view('footer');


    }
     public function PrintUrgentOrderexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
           $Data['GetInvoice'] = $invoice->oneUrgentOrderDetail($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"URGENT ORDER");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d');
$head=array('S.No','Part Number','Part Name','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 //$this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['Quantity']);
 //$this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['DealerRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('d'.($c+2),$Data['GetInvoice'][0]['IMCRemarks']);
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
      public function PrintTgmoPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
         $Data['GetInvoice'] = $invoice->oneTgmo($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"TOYOTA GENUINE MOTOR OIL");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e');
$head=array('S.No','Part Number','Part Name','Model','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['Model']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['IMCRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
      public function PrintDhamakaPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
      $Data['GetInvoice'] = $invoice->oneDhamakaPackage($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"TOYOTA DHAMAKA PACKAGE");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e');
$head=array('S.No','Part Number','Part Name','Model','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['Model']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['IMCRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
      public function PrintMaintenancePackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
    $Data['GetInvoice'] = $invoice->oneMaintenancePackage($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"TOYOTA MAINTENANCE PACKAGE");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e');
$head=array('S.No','Part Number','Part Name','Model','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['Model']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['IMCRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
      public function PrintWarrentyPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
   $Data['GetInvoice'] = $invoice->oneWarrantyOrder($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"TOYOTA WARRENTY PACKAGE");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e');
$head=array('S.No','Part Number','Part Name','Model','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['Model']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['IMCRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
    public function PrintVORPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
  $Data['GetInvoice'] = $invoice->oneVOR($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"TOYOTA VOR PACKAGE");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e','f');
$head=array('S.No','Part Number','Part Name','Model','Frame','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['ModelCode']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['FrameNo']);
 $this->excel->getActiveSheet()->SetCellValue('f'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['DealerRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('d'.($c+2),$Data['GetInvoice'][0]['IMCRemarks']);
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
      public function PrintChemicalPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
    $Data['GetInvoice'] = $invoice->oneChemicalOrder($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"TOYOTA CHEMICAL PACKAGE");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e');
$head=array('S.No','Part Number','Part Name','Model','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['Model']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['IMCRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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

       public function PrintSeaPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
   $Data['GetInvoice'] = $invoice->oneBySeaOrder($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"SEA ORDER");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e');
$head=array('S.No','Part Number','Part Name','Model','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['BySeaPrice']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['DealerRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('d'.($c+2),$Data['GetInvoice'][0]['IMCRemarks']);
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
     public function PrintPlanPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;

        $Data['GetInvoice'] = $invoice->onePlanOrder($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"TOYOTA PLAN PACKAGE");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e','F','G');
$head=array('S.No','Part Number','Part Name','Model','Quantity','WS Price','Total Price');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);
  $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
   $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['Model']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['Quantity']);
  $this->excel->getActiveSheet()->SetCellValue('f'.$c, $Data['GetInvoice'][$a]['WSPrice']);
   $this->excel->getActiveSheet()->SetCellValue('g'.$c, $Data['GetInvoice'][$a]['TotalPrice']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['DealerRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('d'.($c+2),$Data['GetInvoice'][0]['IMCRemarks']);
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
       public function PrintSpecialPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
  $Data['GetInvoice'] = $invoice->oneSpecialOffer($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"SPECIAL ORDER");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d','e','f');
$head=array('S.No','Part Number','Part Name','Special Price','Package Date','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);
  $this->excel->getActiveSheet()->getColumnDimension('f')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['SpecialPrice']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['PackageDate']);
 $this->excel->getActiveSheet()->SetCellValue('f'.$c, $Data['GetInvoice'][$a]['PackageDate']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['DealerRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('d'.($c+2),$Data['GetInvoice'][0]['IMCRemarks']);
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

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
      public function printplan($idOrder)
    {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderNo'] = $idOrder;
        $Data['GetInvoice'] = $invoice->onePlanOrder($idOrder);
        $this->load->view('header_parts', $Data);
        $this->load->view('printplan', $Data);
        $this->load->view('footer');



    }
          public function PrintAccessoriesPackageexcel($idOrder){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();

        $Data['OrderNo'] = $idOrder;
   $Data['GetInvoice'] = $invoice->oneAccessoriesOrder($idOrder);

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"ACCESSORIES ORDER");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['Date']);

        //tbale
$col=array('a','b','c','d');
$head=array('S.No','Part Number','Description of Parts','Quantity');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartName']);

 $this->excel->getActiveSheet()->SetCellValue('D'.$c, $Data['GetInvoice'][$a]['Quantity']);

 $c=$c+1;
   }     
$c=$c+6;
$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['DealerRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('d'.($c+2),$Data['GetInvoice'][0]['IMCRemarks']);
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }
    
     public function PrintMonthlyOrder($idOrder,$month)
    {
         if(!$idOrder){
             redirect('/');
         }
        $Data = array();
        $Data['idorder'] = $idOrder;
        $Data['MonthlyOrder'] = $this->db->query("select *,pn.PartNumber,pn.PartName,pn.Description
                                                    from monthly_order_cycle m
                                                    left join parts_name pn
                                                    on pn.idPart=m.IdPart where id=$idOrder OR month1=$month ORDER BY id desc")
                                            ->result_array();
        $this->load->view('header_parts', $Data);
        $this->load->view('printmonthlyorder', $Data);
        $this->load->view('footer');



    }
        public function PrintMonthlyOrderexcel($idOrder,$month,$tot){
  $Data = array();
      $this->load->library('excel');
        $invoice = new Parts_invoices();
if(!$idOrder){
             redirect('/');
         }
        $Data = array();
        $Data['idorder'] = $idOrder;
     
    $Data['GetInvoice'] =$this->db->query("select *,pn.PartNumber,pn.PartName,pn.Description
                                                    from monthly_order_cycle m
                                                    left join parts_name pn
                                                    on pn.idPart=m.IdPart where id=$idOrder OR month1=$month ORDER BY id desc")
                                            ->result_array();

       // read data to active sheet
        $styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 20,
        'name'  => 'ITALIC'
    ));

      //  $this->excel->getActiveSheet()->fromArray(array_keys($Data['GetInvoice'][0]),NULL,'A2');
       // $this->excel->getActiveSheet()->fromArray($Data['GetInvoice'],NULL,'A3');
        $this->excel->getActiveSheet()->getStyle('c2')->applyFromArray($styleArray);
$this->excel->getActiveSheet()->SetCellValue('c2',"MONTHLY ORDER CYCLE");

$this->excel->getActiveSheet()->SetCellValue('b3',"Toyota");
$this->excel->getActiveSheet()->SetCellValue('c3',"western");
$this->excel->getActiveSheet()->SetCellValue('d3',"Motors");

$this->excel->getActiveSheet()->SetCellValue('b5',"Order #:");
$this->excel->getActiveSheet()->SetCellValue('b6',"Date :");


$this->excel->getActiveSheet()->SetCellValue('d5',"TWM-MO-".$idOrder);
$this->excel->getActiveSheet()->SetCellValue('d6',$Data['GetInvoice'][0]['CreatedDate']);

        //tbale
$col=array('a','b','c','d','e','f','g','h','i');
$head=array('S.No','Order Reason','Part Number','Description','Qty In Stock','MAD','January','Unit Price','Total January');
 $c=9;
 for($a=0;$a<count($col);$a++){



        $this->excel->getActiveSheet()->getColumnDimension($col[$a])->setWidth(-1);
 $this->excel->getActiveSheet()->SetCellValue($col[$a].$c, $head[$a]);
$this->excel->getActiveSheet()->getStyle($col[$a].$c)->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F5DEB3'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."2")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '9A0A06'))));
$this->excel->getActiveSheet()->getStyle($col[$a]."3")->applyFromArray( array('fill' => array( 'type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'D2B48C'))));

}

          $c=$c+2;   
      for($a=0;$a<count($Data['GetInvoice']);$a++){ 
 $this->excel->getActiveSheet()->getColumnDimension('a')->setWidth(10);
 $this->excel->getActiveSheet()->getColumnDimension('b')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('d')->setWidth(30);
 $this->excel->getActiveSheet()->getColumnDimension('e')->setWidth(30);

 $this->excel->getActiveSheet()->SetCellValue('a'.$c, ($a+1).")");
 $this->excel->getActiveSheet()->SetCellValue('b'.$c, $Data['GetInvoice'][$a]['OrderReason']);
 $this->excel->getActiveSheet()->SetCellValue('c'.$c, $Data['GetInvoice'][$a]['PartNumber']);
 $this->excel->getActiveSheet()->SetCellValue('d'.$c, $Data['GetInvoice'][$a]['PartName']);
 $this->excel->getActiveSheet()->SetCellValue('e'.$c, $Data['GetInvoice'][$a]['QuantityInStock']);
  $this->excel->getActiveSheet()->SetCellValue('f'.$c, $Data['GetInvoice'][$a]['MAD']);
   $this->excel->getActiveSheet()->SetCellValue('g'.$c, $Data['GetInvoice'][$a]['Quantity1']);
    $this->excel->getActiveSheet()->SetCellValue('h'.$c, $Data['GetInvoice'][$a]['UnitPrice']);
     $this->excel->getActiveSheet()->SetCellValue('i'.$c, $Data['GetInvoice'][$a]['UnitPrice']*$Data['GetInvoice'][$a]['Quantity1']);

 $c=$c+1;
   }     
   $this->excel->getActiveSheet()->SetCellValue('h'.($c+1),"TOTAL:");
    $this->excel->getActiveSheet()->SetCellValue('I'.($c+1),$tot);
$c=$c+6;

//$end=$c+3;

$this->excel->getActiveSheet()->SetCellValue('b'.$c,"Dealer's Remarks :");
//$this->excel->getActiveSheet()->SetCellValue('d'.$c,$Data['GetInvoice'][0]['IMCRemarks']);


$this->excel->getActiveSheet()->SetCellValue('b'.($c+2),"IMC Remarks  :");
$this->excel->getActiveSheet()->SetCellValue('b'.($c+4),"Manager Parts Dealership");
  


   //end of table
 
        $filename= $idOrder.'.xls'; //save our workbook as this file name
 
        header('Content-Type: application/vnd.ms-excel'); //mime type
 
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
 
        header('Cache-Control: max-age=0'); //no cache
                    
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
 
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
 
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');

    }



}
