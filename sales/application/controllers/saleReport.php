<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class SaleReport extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model("Car_dispatch");
    }

    public function index() {
        $Data = array();
        $Dispatch = new Car_dispatch();
        $Data['SaleReport'] = $Dispatch->SaleReport(NULL, NULL);
        $this->load->view('header');
        $this->load->view('salereport', $Data);
        $this->load->view('footer');
    }

    public function report() {
        $FromDate = $_POST['fromDate'];
        //$FromDate = 1971-09-09;
        $ToDate = $_POST['toDate'];
        if (isset($_POST['pdf'])) {
            $Dispatch = new Car_dispatch();

            $Data = $Dispatch->SaleReport($FromDate, $ToDate);

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
            $pdf->SetHeaderData('', '', '', "Sale Report");
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
            $html = '<span>Date:' . date('M d, Y') . ' </span> <br>
			From  '. $FromDate.' <br> To ' . $ToDate . '<br><br>
        <table border="1" align="center">
            <thead>
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align="center" colspan="2"><b>S No.</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Make</b></td>
					<td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Create Date</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Color</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>PBO No</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Engine No</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Chassis No</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Purchase From</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Sold To</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Purchase Amount</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Sold Amount</b></td>
                    <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Profit</b></td>
                     <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Percentage</b></td>
                      <td width="70" height="30" style="line-height: 30px;" align="center" colspan="2"><b>ProfitPercentage</b></td>
                </tr>
            </thead>
            <tbody>';
            $count = 1;
            foreach ($Data as $allData) {
                $SellingPrice = $allData['SellingPrice'];
                $VehiclePrice = $allData['VehiclePrice'];
                $TotalPrice = $SellingPrice - $VehiclePrice;
                $html .= '
                <tr>
                    <td width="50" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $count++ . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Variants'] . '</td>
					<td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['CreatedDate'] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['ColorName'] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['PboNumber'] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["EngineNo"] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["ChasisNo"] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["PurchaseFrom"] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["CustomerName"] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["VehiclePrice"] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["SellingPrice"] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $TotalPrice . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["Percentage"] . '</td>
                    <td width="70" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["ProfitPercentage"] . '</td>
                </tr>';
            }
            $html .= '</tbody>
        </table>';

            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('twm.pdf', 'I');
        }
    }

}
