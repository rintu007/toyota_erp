<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class LocalPackage extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_invoices');
        $this->load->model('Order_mode');
        $this->load->model('Reporting');
        $this->load->library("Pdf");
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
		if(isset($_POST['BrandCode']))
        $this->session->set_userdata('BrandCode', $_POST['BrandCode']);
        $Data['OrderType'] = $invoice->getLocalPurchaseCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Part'] = $this->parts("Local Package");
        $this->load->view('header_parts', $Data);
        $this->load->view('localpurchase', $Data);
        $this->load->view('footer');
    }

    public function report() {
        if (isset($_POST['pdf'])) {
            $Filter = $_POST['filter'];
            $OrderNumber = $_POST['OrderNumber'];
            $Brand = $_POST['Brand'];
            $Reporting = new Reporting();
            if ($Filter == "All") {
                $Data = $Reporting->LocalPackageReport(NULL, NULL);
            } else if ($Filter == "OrderNumber") {
                if ($OrderNumber != "") {
                    $Data = $Reporting->LocalPackageReport($OrderNumber, NULL);
                }
            } else {
                if ($Brand != "Select Brand") {
                    $Data = $Reporting->LocalPackageReport(NULL, $Brand);
                }
            }
//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Local Package Reports');
            $pdf->SetSubject('');
            $pdf->SetKeywords('Local Package Report');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Parts Division', "Local Package Report");
            $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

            //set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            //set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            //set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            //set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            //set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            //set some language-dependent strings (optional)
            if (file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                require_once(dirname(__FILE__) . '/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            //set default font subsetting mode
            $pdf->setFontSubsetting(true);

            //Set font
            //dejavusans is a UTF-8 Unicode font, if you only need to
            //print standard ASCII chars, you can use core fonts like
            //helvetica or times to reduce file size.
            $pdf->SetFont('dejavusans', '', 8, '', true);

            //Add a page
            //This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            //set text shadow effect
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            //Set some content to print
            if ($Filter == "OrderNumber") {
                $html = '&nbsp;&nbsp;<span><h4>Order Number : ' . $OrderNumber . '</h4></span><br><br>';
                $html .= '&nbsp;&nbsp;<span><h4>Date : ' . date("d-M-Y") . '</h4></span><br><br>';
                $html.='<table border="1" align="center">
            <thead>
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align="center" colspan="2"><b>S No. </b></td>
                    <td width="120" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part Number</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description of Parts</b></td>
                    <td width="60" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Qty</b></td>
                    <td width="150" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Unit Price</b></td>
                    <td width="150" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Total Price</b></td>
                    <td width="150" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Package Date</b></td>
                </tr>
            </thead>
            <tbody>';
                $count = 1;
                $arr = array();
                foreach ($Data as $allData) {
                    $html .= '
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $count++ . '</td>
                    <td width="120" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                    <td width="60" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Quantity"] . '</td>
                    <td width="150" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['UnitPrice'] . '</td>
                    <td width="150" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['TotalPrice'] . '</td>
                    <td width="150" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PackageDate'] . '</td>
                </tr>';
                }
                $html .= '</tbody></table>';
            } else {
                $html = '&nbsp;&nbsp;<span><h4>Date : ' . date("d-M-Y") . '</h4></span><br><br>';

                $html .= '<table border="1" align="center">
            <thead>
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align="center" colspan="2"><b>S No. </b></td>
                    <td width="120" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Order Number</b></td>
                    <td width="120" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part Number</b></td>
                    <td width="150" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description of Parts</b></td>
                    <td width="53" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Qty</b></td>
                    <td width="130" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Unit Price</b></td>
                    <td width="130" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Total Price</b></td>
                    <td width="130" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Package Date</b></td>
                    <td width="90" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Brand</b></td>
                </tr>
            </thead>
            <tbody>';
                $count = 1;
                $b = "";
                foreach ($Data as $allData) {
                    if ($allData["BrandCode"] == "T") {
                        $b = "Toyota";
                    } else if ($allData["BrandCode"] == "D") {
                        $b = "Daihatsu";
                    }
                    $html .= '
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $count++ . '</td>
                    <td width="120" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['OrderNumber'] . '</td>
                    <td width="120" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                    <td width="150" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                    <td width="53" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Quantity"] . '</td>
                    <td width="130" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['UnitPrice'] . '</td>
                    <td width="130" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['TotalPrice'] . '</td>
                    <td width="130" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PackageDate'] . '</td>
                    <td width="90" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $b . '</td>
                </tr>';
                }
                $html .= '</tbody></table>';
            }

            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('TWM-PARTS-LOCAL-PACKAGE-REPORT-' . date('d/m/Y') . '.pdf', 'I');
        }

        $OrderReport = new Reporting();
        $Data['AllBrand'] = $OrderReport->fillPartBrandCombo();
        $this->load->view('header_parts');
        $this->load->view('lp_report', $Data);
        $this->load->view('footer');
    }

    function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDhamakaPackageCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Type'] = $invoice->fillInvoiceTypeCombo();
        $Data['AllLocalPurchase'] = $invoice->allTgmo();
        $this->load->view('header_parts', $Data);
        $this->load->view('view_invoice', $Data);
        $this->load->view('footer');
    }

    function parts($Type = NULL) {
        $invoice = new Parts_invoices();
        return $invoice->fillPartCombo($Type);
//        $fillPartCombo = $invoice->fillPartCombo();
//        echo json_encode($fillPartCombo);
    }

    function dispatch() {
        $invoice = new Parts_invoices();
        $fillDispatchCombo = $invoice->fillDispatchModeCombo();
        echo json_encode($fillDispatchCombo);
    }

    function saveLocalPurchase() {
        $invoice = new Parts_invoices();
        $saveDhamkapackage = $invoice->saveLocalPurchase();
        redirect(base_url() . "/index.php/LocalPackage/index");
    }

    function allLocalPurchase() {
        $invoice = new Parts_invoices();
        $Dhamkapackage = $invoice->allLocalPurchase();
        echo json_encode($Dhamkapackage);
    }

    function delete() {
        $invoice = new Parts_invoices();
        $idOrderNumber = $invoice->oneLocalPurchase($_POST["id"])[0];
        if (!empty($idOrderNumber)) {
            $deleteDailyOrder = $invoice->deleteLocalPurchase($idOrderNumber["idOrderNumber"]);
            if ($deleteDailyOrder) {
                echo json_encode(["success" => "true"]);
            } else {
                echo json_encode(["success" => "false"]);
            }
        }
    }

    function orderNumber() {
        $invoice = new Parts_invoices();
        $orderNumber = $invoice->getOrderNumber($invoice->getDailyOrderCode()[0]);
        return $orderNumber;
    }

}
