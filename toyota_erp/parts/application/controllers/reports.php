<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reports extends CI_Controller {

    function __construct() {
        parent::__construct();
		  $this->load->model('Inventory_sales');
        $this->load->model('Reporting');
        $this->load->library("Pdf");
    }

    public function index() {
        $this->load->view('header_parts');
        $this->load->view('Reporting');
        $this->load->view('footer');
    }

    function sale() {
        if (isset($_POST['pdf'])) {
            $FromDate = $_POST['fromDate'];
            $ToDate = $_POST['toDate'];
            $SaleType = $_POST['SaleType'];
            $Reporting = new Reporting();

            if ($FromDate != "" && $ToDate != "") {
                $Data = $Reporting->SaleReport($FromDate, $ToDate);
            } else {
                $Data = $Reporting->SaleReport(NULL, NULL, $SaleType);
            }
//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Sale Reports');
            $pdf->SetSubject('');
            $pdf->SetKeywords('Sale Report');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData('', '', 'Parts Division', "Sale Report");
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
            $html = '&nbsp;&nbsp;<span>Date:' . date('M d, Y') . '</span><br>
        <table border="1" align="center">
            <thead>
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align="center" colspan="2"><b>S No.</b></td>
                    <td width="130" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Invoice #</b></td>
                    <td width="150" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part #</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description</b></td>
                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Quantity</b></td>
                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Cost Price</b></td>
                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Sale Price</b></td>
                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Profit</b></td>
                </tr>
            </thead>
            <tbody>';
            $count = 1;
            $arr = array();
            foreach ($Data as $allData) {
                $CostPrice = $allData['CostPrice'];
                $SalePrice = $allData['SalePrice'];
                $Profit = $SalePrice - $CostPrice;
                array_push($arr, $Profit);
                $html .= '
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $count++ . '</td>
                    <td width="130" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['InvoiceNumber'] . '</td>
                    <td width="150" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                    <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["SaleQuantity"] . '</td>
                    <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["CostPrice"] . '</td>
                    <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["SalePrice"] . '</td>
                    <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $Profit . '</td>
                </tr>';
            }
            $html .= '<tr><td colspan="16" ><div style="margin-left=100px" >Total Profit: ' . array_sum($arr) . '</div></td></tr></tbody></table>';

            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('TWM-PARTS-SALE-REPORT-' . date('d/m/Y') . '.pdf', 'I');
        }

        $SaleReport = new Reporting();
        $Data['SaleType'] = $SaleReport->fillSaleTypeCombo();
        $this->load->view('header_parts');
        $this->load->view('salereport', $Data);
        $this->load->view('footer');
    }

    function order() {
        if (isset($_POST['pdf'])) {
            $FromDate = $_POST['fromDate'];
            $ToDate = $_POST['toDate'];
            $OrderMode = $_POST['OrderMode'];
            $Reporting = new Reporting();

            if ($FromDate != "" && $ToDate != "") {
                $Data = $Reporting->OrderReport($FromDate, $ToDate);
            } else {
                $Data = $Reporting->OrderReport('', '', $OrderMode);
            }
//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Sale Reports');
            $pdf->SetSubject('');
            $pdf->SetKeywords('Sale Report');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData('', '', 'Parts Division', "Order Report");
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
            $html = '&nbsp;&nbsp;<span>Date:' . date('M d, Y') . '</span><br>
        <table border="1" align="center">
            <thead>
                <tr>
                    <td width="90" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Date</b></td>
                    <td width="180" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Order #</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part #</b></td>
                    <td width="260" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description</b></td>
                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Quantity</b></td>
                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Dispatch Mode</b></td>
                </tr>
            </thead>
            <tbody>';
            $count = 1;
            $arr = array();
            foreach ($Data as $allData) {
                $html .= '
                <tr>
                    <td width="90" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Date'] . '</td>
                    <td width="180" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['OrderNumber'] . '</td>
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                    <td width="260" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                    <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Quantity"] . '</td>
                    <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Dispatch Mode"] . '</td>
                </tr>';
            }
            $html .= '</tbody></table>';

            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('TWM-PARTS-SALE-REPORT-' . date('d/m/Y') . '.pdf', 'I');
        }

        $OrderReport = new Reporting();
        $Data['OrderMode'] = $OrderReport->fillOrderModeCombo();
        $this->load->view('header_parts');
        $this->load->view('orderreport', $Data);
        $this->load->view('footer');
    }

    function inventory() {
        if (isset($_POST['pdf'])) {
            $Filter = $_POST['filter'];
            $Category = $_POST['Category'];
            $Manufacturer = $_POST['Manufacturer'];
            $Reporting = new Reporting();
            if ($Filter == "All") {
                $Data = $Reporting->InventoryReport('', '');
            } else if ($Filter == "Category") {
                if ($Category != "Select Category") {
                    $Data = $Reporting->InventoryReport($Category, '');
                }
            } else {
                if ($Category != "Select Manufacturer") {
                    $Data = $Reporting->InventoryReport('', $Manufacturer);
                }
            }
//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Inventory Reports');
            $pdf->SetSubject('');
            $pdf->SetKeywords('Inventory Report');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData('', '', 'Parts Division', "Inventory Report");
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
            $html = '&nbsp;&nbsp;<span>Date:' . date('M d, Y') . '</span><br>
        <table border="1" align="center">
            <thead>
                <tr>
                    <td width="90" height="30" style="line-height: 30px;" align="center" colspan="2"><b>S No. </b></td>
                    <td width="180" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part #</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part Name</b></td>
                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part Category</b></td>
                    <td width="130" height="30" style="line-height: 30px;" align="center" colspan="2"><b>In Stock Quantity</b></td>
                    <td width="140" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Manufacturer</b></td>
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
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartName'] . '</td>
                    <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['CategoryName'] . '</td>
                    <td width="130" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Quantity"] . '</td>
                    <td width="140" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Manufacturer"] . '</td>
                </tr>';
            }
            $html .= '</tbody></table>';

            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('TWM-PARTS-INVENTORY-REPORT-' . date('d/m/Y') . '.pdf', 'I');
        }

        $OrderReport = new Reporting();
        $Data['Category'] = $OrderReport->fillPartCategoryCombo();
        $Data['Manufacturer'] = $OrderReport->fillPartManufacturerCombo();
        $this->load->view('header_parts');
        $this->load->view('inventoryreport', $Data);
        $this->load->view('footer');
    }

    function purchase() {
        if (isset($_POST['pdf'])) {
            $Type = $_POST['Type'];
            $Party = $_POST['Party'];
            $Reporting = new Reporting();
            $Data = "";
            if ($Type == "LOC" && $Party == "Select Party") {
                $Data = $Reporting->PurchaseReport($Type, "");
            } else if ($Type == "IMC" && $Party == "Select Party") {
                $Data = $Reporting->PurchaseReport($Type, "");
            } else if ($Type == "Force" && $Party == "Select Party") {
                $Data = $Reporting->PurchaseReport($Type, "");
            } else if ($Type == "LOC" && $Party != "Select Party") {
                $Data = $Reporting->PurchaseReport($Type, $Party);
            } else if ($Type == "IMC" && $Party != "Select Party") {
                $Data = $Reporting->PurchaseReport($Type, $Party);
            } else if ($Type == "Force" && $Party != "Select Party") {
                $Data = $Reporting->PurchaseReport($Type, $Party);
            } else if ($Type == "Select Purchase Type" && $Party != "Select Party") {
                $Data = $Reporting->PurchaseReport("", $Party);
            }
//            echo "<pre>";
//            print_r($Data);
//            exit();
//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Sale Reports');
            $pdf->SetSubject('');
            $pdf->SetKeywords('Sale Report');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData('', '', 'Parts Division', "Purchase Report [" . $Type . "]");
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
            if ($Type == "LOC") {
                $html = '&nbsp;&nbsp;<span>Date:' . date('M d, Y') . '</span><br>
                        <table border="1" align="center">
                            <thead>
                                <tr>
                                    <td width="90" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Date</b></td>
                                    <td width="180" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part #</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Quantity</b></td>
                                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>GRN Number</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Amount</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Actual Cost</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Landvalue</b></td>
                                </tr>
                            </thead>
                            <tbody>';
//                                    <td width="260" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description</b></td>
                $count = 1;
                $arr = array();
//                        <td width="260" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                foreach ($Data as $allData) {
                    $html .= '
                    <tr>
                        <td width="90" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PurchaseDate'] . '</td>
                        <td width="180" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["PurchaseQuantity"] . '</td>
                        <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['GrnNo'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Amount"] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["ActualCost"] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["LandValue"] . '</td>
                    </tr>';
                }
                $html .= '</tbody></table>';
            } else if ($Type == "IMC") {
                $html = '&nbsp;&nbsp;<span>Date:' . date('M d, Y') . '</span><br>
                        <table border="1" align="center">
                            <thead>
                                <tr>
                                    <td width="90" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Date</b></td>
                                    <td width="180" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Order #</b></td>
                                    <td width="200" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part #</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Quantity</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Quantity Received</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Quantity Remaining</b></td>
                                </tr>
                            </thead>
                            <tbody>';
                $count = 1;
                $arr = array();
                foreach ($Data as $allData) {
                    $html .= '
                    <tr>
                        <td width="90" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PurchaseDate'] . '</td>
                        <td width="180" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['OrderNo'] . '</td>
                        <td width="200" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["QuantityRequested"] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['QuantityReceived'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . ($allData["QuantityRequested"] - $allData['QuantityReceived']) . '</td>
                    </tr>';
                }
                $html .= '</tbody></table>';
            }
            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('TWM-PARTS-PURCHASE-REPORT-' . date('d/m/Y') . '.pdf', 'I');
        }

        $PurchaseReport = new Reporting();
        $Data['Type'] = $PurchaseReport->fillPurchaseTypeCombo();
        $Data['Party'] = $PurchaseReport->fillPartyCombo();
        $this->load->view('header_parts');
        $this->load->view('purchasereport', $Data);
        $this->load->view('footer');
    }
	
	public function partwise(){
		 $Sale = new Inventory_sales();
		  if (isset($_POST['pdf'])) {
      
//            echo "<pre>";
//            print_r($Data);
//            exit();
//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Sale Reports');
            $pdf->SetSubject('');
            $pdf->SetKeywords('Sale Report');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData('', '', 'Part Wise Report');
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
          
                $html = '&nbsp;&nbsp;<span>Date:' . date('M d, Y') . '</span><br>
                        <table border="1" align="center">
                            <thead>
                                <tr>
                                    <td width="90" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Date</b></td>
                                    <td width="90" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Trans</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Part #</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Sale Qty</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Sale Total</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Sale Price</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Total Price</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Cost</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Total Cost</b></td>
                                    <td width="100" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Stock</b></td>
                                </tr>
                            </thead>
                            <tbody>';
//                                    <td width="260" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description</b></td>
                $count = 1;
             $result = $Sale->PartWiseSale();
//                        <td width="260" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                 foreach ($result as $allData) {
                    $html .= '
                    <tr>
                        <td width="90"  height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['SaleDate'] . '</td>
                        <td width="90"  height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['InvoiceNumber'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PartNumber'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['SaleQuantity'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['SaleQuantity'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['SalePrice'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['TotalPrice'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['CostPrice'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['TotalCost'] . '</td>
                        <td width="100" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Stock'] . '</td>
                           
                    </tr>';
                }
                $html .= '</tbody></table>';
            
            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('TWM-PARTS-PURCHASE-REPORT-' . date('d/m/Y') . '.pdf', 'I');
        }
		 
		$Data['Parts'] = $Sale->fillPartComboCombo();
		$this->load->view('header_parts');
		$this->load->view('partwise',$Data);
		 $this->load->view('footer');
	}
    
    
    public function losssalereport(){
		 $Sale = new Inventory_sales();
		  if (isset($_POST['service']) || isset($_POST['fill'])  ) {
              if (isset($_POST['service'])) {
                  $heading = 'Service Rate Report';
                  $span = 2;
                  $width = 14.28;
                  $trhead = 'Line Items';
                  $rate = 'Service Rate';
                  $balance = '<td width="14.28%" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Balance</b></td>';
                  $result = $Sale->ServiceRateReport();

              }elseif (isset($_POST['fill'])) {
                  $heading = 'Fill Rate Report';
                  $span = 3;
                  $width = 21.42;
                  $trhead = 'Demand Slip';
                  $rate = 'Fill Rate';
                  $balance = "";
                  $result = $Sale->FillRateReport();
              }
      
//            echo "<pre>";
//            print_r($Data);
//            exit();
//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle($heading);
            $pdf->SetSubject('');
            $pdf->SetKeywords($heading);

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData('', '', $heading);
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
          
                $html = '&nbsp;&nbsp;<span>Date:' . date('M d, Y') . '</span><br>
                        <table border="1" align="center">
                            <thead>
                                <tr>
                                    <td width="14.28%" height="30" style="line-height: 30px;" align="center" colspan="2" rowspan="2"><b>S.No</b></td>
                                    <td width="14.28%" height="30" style="line-height: 30px;" align="center" colspan="2" rowspan="2"><b>Date</b></td>
                                    <td width="14.28%" height="30" style="line-height: 30px;" align="center" colspan="2" rowspan="2"><b>Day</b></td>
                                    <td width="42.85%" height="30" style="line-height: 30px;" align="center" colspan="6"><b>'.$trhead.'</b></td>
                                    <td width="14.28%" height="30" style="line-height: 30px;" align="center" colspan="2" rowspan="2"><b>'.$rate.'</b></td>
                                  
                                </tr>
                                   <tr>
                                  
                                    <td width="'.$width.'%" height="30" style="line-height: 30px;" align="center" colspan="'.$span.'"><b>Required</b></td>
                                    <td width="'.$width.'%" height="30" style="line-height: 30px;" align="center" colspan="'.$span.'"><b>Supplied</b></td>
                                    '.$balance.'
                                    
                                  
                                </tr>
                            </thead>
                            <tbody>';
//                                    <td width="260" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Description</b></td>
                $count = 1;
          //    var_dump($_POST['monthyear']);die;



            // $result = array();
//                        <td width="260" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Description'] . '</td>
                 foreach ($result as $allData) {
                     if(isset($_POST['service'])){
                         $loop = '<td width="14.28%" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['balance'] . '</td>';
                     }else{
                         $loop = "";
                     }
                    $html .= '
                    <tr>
                        <td width="14.28%"  height="30" style="line-height: 30px;" align = "center" colspan="2">' .$count++ . '</td>
                        <td width="14.28%"  height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['date'] . '</td>
                        <td width="14.28%" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['day'] . '</td>
                        <td width="'.$width.'%" height="30" style="line-height: 30px;" align = "center" colspan="'.$span.'">' . $allData['demand'] . '</td>
                        <td width="'.$width.'%" height="30" style="line-height: 30px;" align = "center" colspan="'.$span.'">' . $allData['supplied'] . '</td>
                        
                       '.$loop.'
                        <td width="14.28%" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['rate'] . '</td>           
                    </tr>';
                }
                $html .= '</tbody></table>';
            
            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('TWM-PARTS-PURCHASE-REPORT-' . date('d/m/Y') . '.pdf', 'I');
        }
		 
		$Data['Parts'] = $Sale->fillPartComboCombo();
		$this->load->view('header_parts');
		$this->load->view('losssalereport',$Data);
		 $this->load->view('footer');
	}
public function Inventioncontrol(){
       $this->load->model('Inventory_sales');
        $this->load->model('Parts_invoices');
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
$this->load->view('header_parts');
	$this->load->view('html1',$Data);
	$this->load->view('footer');
	}
}
