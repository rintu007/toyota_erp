<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ChemicalOrder extends CI_Controller {

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
        $Data['OrderType'] = $invoice->getChemicalOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Part'] = $this->parts('Chemical Order');
        $this->load->view('header_parts', $Data);
        $this->load->view('chemicalorder', $Data);
        $this->load->view('footer');
    }

    public function report() {
        if (isset($_POST['pdf'])) {
            $Filter = $_POST['filter'];
            $OrderNumber = $_POST['OrderNumber'];
            $Brand = $_POST['Brand'];
            $Reporting = new Reporting();
            if ($Filter == "All") {
                $Data = $Reporting->ChemicalOrderReport(NULL, NULL);
            } else if ($Filter == "OrderNumber") {
                if ($OrderNumber != "") {
                    $Data = $Reporting->ChemicalOrderReport($OrderNumber, NULL);
                }
            } else {
                if ($Brand != "Select Brand") {
                    $Data = $Reporting->ChemicalOrderReport(NULL, $Brand);
                }
            }
//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Chemical Order Reports');
            $pdf->SetSubject('');
            $pdf->SetKeywords('Chemical Order Report');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Parts Division', "Chemical Order Report");
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
                    <td width="90" height="30" style="line-height: 30px;" align="center" colspan="2"><b>S No. </b></td>
                    <td width="180" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part Number</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description of Parts</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Model</b></td>
                    <td width="130" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Quantity</b></td>
                </tr>
            </thead>
            <tbody>';
                $count = 1;
                $arr = array();
                foreach ($Data as $allData) {
                    $html .= '
                <tr>
                    <td width="90" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $count++ . '</td>
                    <td width="180" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Model'] . '</td>
                    <td width="130" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Quantity"] . '</td>
                </tr>';
                }
                $html .= '</tbody></table>';
            } else {
                $html = '&nbsp;&nbsp;<span><h4>Date : ' . date("d-M-Y") . '</h4></span><br><br>';
                $html.='<table border="1" align="center">
            <thead>
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align="center" colspan="2"><b>S No. </b></td>
                    <td width="140" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Order Number</b></td>
                    <td width="180" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part Number</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description of Parts</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Model</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Quantity</b></td>
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
                    <td width="140" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['OrderNumber'] . '</td>
                    <td width="180" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Model'] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Quantity"] . '</td>
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
            $pdf->Output('TWM-PARTS-CHEMICAL-ORDER-REPORT-' . date('d/m/Y') . '.pdf', 'I');
        }

        $OrderReport = new Reporting();
        $Data['AllBrand'] = $OrderReport->fillPartBrandCombo();
        $this->load->view('header_parts');
        $this->load->view('co_report', $Data);
        $this->load->view('footer');
    }

    function view() {
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDhamakaPackageCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['Type'] = $invoice->fillInvoiceTypeCombo();
        $Data['AllTgmo'] = $invoice->allTgmo();
        $this->load->view('header_parts', $Data);
        $this->load->view('view_invoice', $Data);
        $this->load->view('footer');
    }

    function parts($Type = NULL) {
        $invoice = new Parts_invoices();
        return $invoice->fillPartCombo($Type);
//        $fillPartCombo = $invoice->fillPartCombo($Type);
//        echo json_encode($fillPartCombo);
    }

    function dispatch() {
        $invoice = new Parts_invoices();
        $fillDispatchCombo = $invoice->fillDispatchModeCombo();
        echo json_encode($fillDispatchCombo);
    }

    function delete() {
        $invoice = new Parts_invoices();
        $idOrderNumber = $invoice->oneChemicalOrder($_POST["id"])[0];
        if (!empty($idOrderNumber)) {
            $deleteDailyOrder = $invoice->deleteChemicalOrder($idOrderNumber["idOrderNumber"]);
            if ($deleteDailyOrder) {
                echo json_encode(["success" => "true"]);
            } else {
                echo json_encode(["success" => "false"]);
            }
        }
    }

    function saveChemicalOrder() {
        $invoice = new Parts_invoices();
        $saveDhamkapackage = $invoice->saveChemicalOrder();
        redirect(base_url() . "/index.php/chemicalorder/index");
    }

    function allChemicalOrder() {
        $invoice = new Parts_invoices();
        $Dhamkapackage = $invoice->allChemicalOrder();
        echo json_encode($Dhamkapackage);
    }

    function orderNumber() {
        $invoice = new Parts_invoices();
        $orderNumber = $invoice->getOrderNumber($invoice->getDailyOrderCode()[0]);
        return $orderNumber;
    }

}
