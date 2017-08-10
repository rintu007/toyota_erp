<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class GenerateReport extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model("Car_excel");
    }

    public function index() {
        //create new PDF document
        $Data = array();
        $City = $this->input->get('reportByCity');
        $ContactType = $this->input->get('reportByContactType');
        $Color = $this->input->get('reportByColor');
        $CustomerName = $this->input->get('reportByCustomerName');
        $CompanyName = $this->input->get('reportByCompanyName');
        $CustomerType = $this->input->get('reportByCustomerType');
        $CustomerStatus = $this->input->get('reportByCustomerStatus');
        $Model = $this->input->get('reportByModel');
        $Payment = $this->input->get('reportByPayment');
        $Variant = $this->input->get('reportByVariant');
        $Dealer = $this->input->get('reportByDealer');
        $Province = $this->input->get('reportByProvince');
        $ToDate = $this->input->get('ToDate');
        $FromDate = $this->input->get('FromDate');

        if ($City != "") {
            $Data = $this->Car_excel->reportByCity($City, $FromDate, $ToDate);
            print_r($Data);
        } else if ($ContactType != "") {
            $Data = $this->Car_excel->reportByContactType($ContactType, $FromDate, $ToDate);
        } else if ($Color != "") {
            $Data = $this->Car_excel->reportByColor($Color, $FromDate, $ToDate);
        } else if ($CustomerType != "") {
            $Data = $this->Car_excel->reportByCustomerType($CustomerType, $FromDate, $ToDate);
        } else if ($CustomerStatus != "") {
            $Data = $this->Car_excel->reportByCustomerStatus($CustomerStatus, $FromDate, $ToDate);
        } else if ($Model != "") {
            $Data = $this->Car_excel->reportByModel($Model, $FromDate, $ToDate);
        } else if ($Payment != "") {
            $Data = $this->Car_excel->reportByPayment($Payment, $FromDate, $ToDate);
        } else if ($Variant != "") {
            $Data = $this->Car_excel->reportByVariant($Variant, $FromDate, $ToDate);
        } else if ($Dealer != "") {
            $Data = $this->Car_excel->reportByDealer($Dealer, $FromDate, $ToDate);
        } else if ($Province != "") {
            $Data = $this->Car_excel->reportByProvince($Province, $FromDate, $ToDate);
        } else if ($CustomerName != "") {
            $Data = $this->Car_excel->reportByCustomerName($CustomerName, $FromDate, $ToDate);
        } else if ($CompanyName != "") {
            $Data = $this->Car_excel->reportByCompanyName($CompanyName, $FromDate, $ToDate);
        } else {
            $Data = $this->Car_excel->AllReport($FromDate, $ToDate);
        }
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Toyota Western Motors');
        $pdf->SetTitle('Daily ResourceBook Reports');
        $pdf->SetSubject('Daily Resourcebook');
        $pdf->SetKeywords('Resourcebook');

        //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
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
        $html = '
        <table border="1">
            <thead>
                <tr>
                    <td width="170" align="center" colspan="4"></td>
                    <td width="150" align="center" colspan="3">1st Contact Type</td>
                    <td width="370" align="center" colspan="4"></td>
                    <td width="100" align="center">Contact Type</td>
                    <td width="100" align="center" colspan="2">Mode Of Payment</td>
                    <td width="150" align="center" colspan="3">Prospect Customer</td>
                    <td width="120" align="center" colspan="3">Follow-Ups</td>
                    <td width="100" align="center">If Sale Made:</td>
                </tr>
                <tr>
                    <td width="20" align="center">S No.</td>
                    <td width="50" align="center">Date</td>
                    <td width="50" align="center">Salesman</td>
                    <td width="50" align="center">Time Consumed</td>
                    <td width="50" align="center">Phone</td>
                    <td width="50" align="center">Walk-in</td>
                    <td width="50" align="center">Email</td>
                    <td width="90" align="center">Contact Person</td>
                    <td width="90" align="center">Company Name</td>
                    <td width="90" align="center">Existing Vehicle</td>
                    <td width="100" align="center">Variant Interested</td>
                    <td width="100" align="center">Office / Mobile</td>
                    <td width="40" align="center">Cash</td>
                    <td width="60" align="center">Lease / Finance</td>
                    <td width="50" align="center">Hot</td>
                    <td width="50" align="center">Warm</td>
                    <td width="50" align="center">Cold</td>
                    <td width="40" align="center">7th</td>
                    <td width="40" align="center">14th</td>
                    <td width="40" align="center">21th</td>
                    <td width="100" align="center">Pso#/ Color/Del Mth</td>
                    <td width="80" align="center">Lost Sale Reason</td>
                    <td width="92" align="center">Remarks</td>
                </tr>
            </thead>
            <tbody>';
        $count = 1;
        foreach ($Data as $allData) {
            $Id = $allData["IdResourceBook"];
            $html .= '
                <tr>
                    <td width = "20" align = "center">' . $count++ . '</td>
                    <td width = "50" align = "center">' . $allData['Date'] . '</td>
                    <td width = "50" align = "center">' . $allData['FullName'] . '</td>
                    <td width = "50" align = "center">' . $allData["TimeConsumed"] . '</td>
                    <td width = "50" align = "center">';
            if ($allData["ContactType"] == "Telephone") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "50" align = "center">';
            if ($allData["ContactType"] == "Walk-in") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "50" align = "center">';
            if ($allData["ContactType"] == "Email") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "90" align = "center">' . $allData["CustomerName"] . '</td>
                    <td width = "90" align = "center">' . $allData["CompanyName"] . '</td>
                    <td width = "90" align = "center"> - </td>
                    <td width = "100" align = "center">' . $allData["Variants"] . '</td>
                    <td width = "100" align = "center">' . $allData["Cellphone"] . '</td>
                    <td width = "40" align = "center">';
            if ($allData["PaymentType"] == "Cash") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "60" align = "center">';
            if ($allData["PaymentType"] == "Financing") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "50" align = "center">';
            if ($allData["StatusType"] == "Hot") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "50" align = "center">';
            if ($allData["StatusType"] == "Warm") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "50" align = "center">';
            if ($allData["StatusType"] == "Cold") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "40" align = "center">';
            if ($allData["FollowupType"] == "7 Days") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "40" align = "center">';
            if ($allData["FollowupType"] == "14 Days") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "40" align = "center">';
            if ($allData["FollowupType"] == "21 Days") {
                $html .= "Yes";
            } else {
                $html .= "-";
            }
            $html .= '</td>
                    <td width = "100" align = "center">' . $allData["ColorName"] . '</td>
                    <td width = "80" align = "center">' . $allData["Reason"] . '</td>
                    <td width = "92" align = "center">' . $allData["Remarks"] . '</td>
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

    public function report() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        $Search = $_POST['filter'];
        $FromDate = $_POST['fromDate'];
        $ToDate = $_POST['toDate'];

        if (isset($_POST['pdf'])) {
            $Excel = new Car_excel();
            if ($Search[0] != "" || $Search[1] != "" || $Search[2] != "" || $Search[3] != "" || $Search[4] != "" || $Search[5] != "" || $Search[6] != "" || $Search[7] != "" || $Search[8] != "" || $Search[9] != "" || $Search[10] != "" || $Search[11] != "" || $Search[12] != "") {
                $Data = $Excel->report($FromDate, $ToDate, $Search, $UserId, $UserRole);
            } else {
                $Data = $Excel->reportDate($FromDate, $ToDate, $UserId, $UserRole);
            }

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Daily ResourceBook Reports');
            $pdf->SetSubject('Daily Resourcebook');
            $pdf->SetKeywords('Resourcebook');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
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
            $html = '
        <table border="1">
            <thead>
                <tr>
                    <td width="170" align="center" colspan="4"></td>
                    <td width="150" align="center" colspan="3">1st Contact Type</td>
                    <td width="370" align="center" colspan="4"></td>
                    <td width="100" align="center">Contact Type</td>
                    <td width="100" align="center" colspan="2">Mode Of Payment</td>
                    <td width="150" align="center" colspan="3">Prospect Customer</td>
                    <td width="120" align="center" colspan="3">Follow-Ups</td>
                    <td width="100" align="center">If Sale Made:</td>
                </tr>
                <tr>
                    <td width="20" align="center">S No.</td>
                    <td width="50" align="center">Date</td>
                    <td width="50" align="center">Salesman</td>
                    <td width="50" align="center">Time Consumed</td>
                    <td width="50" align="center">Phone</td>
                    <td width="50" align="center">Walk-in</td>
                    <td width="50" align="center">Email</td>
                    <td width="90" align="center">Contact Person</td>
                    <td width="90" align="center">Company Name</td>
                    <td width="90" align="center">Existing Vehicle</td>
                    <td width="100" align="center">Variant Interested</td>
                    <td width="100" align="center">Office / Mobile</td>
                    <td width="40" align="center">Cash</td>
                    <td width="60" align="center">Lease / Finance</td>
                    <td width="50" align="center">Hot</td>
                    <td width="50" align="center">Warm</td>
                    <td width="50" align="center">Cold</td>
                    <td width="40" align="center">7th</td>
                    <td width="40" align="center">14th</td>
                    <td width="40" align="center">21th</td>
                    <td width="100" align="center">Pso#/ Color/Del Mth</td>
                    <td width="80" align="center">Lost Sale Reason</td>
                    <td width="92" align="center">Remarks</td>
                </tr>
            </thead>
            <tbody>';
            $count = 1;
            foreach ($Data as $allData) {
                $Id = $allData["IdResourceBook"];
                $html .= '
                <tr>
                    <td width = "20" align = "center">' . $count++ . '</td>
                    <td width = "50" align = "center">' . $allData['Date'] . '</td>
                    <td width = "50" align = "center">' . $allData['FullName'] . '</td>
                    <td width = "50" align = "center">' . $allData["TimeConsumed"] . '</td>
                    <td width = "50" align = "center">';
                if ($allData["ContactType"] == "Telephone") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "50" align = "center">';
                if ($allData["ContactType"] == "Walk-in") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "50" align = "center">';
                if ($allData["ContactType"] == "Email") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "90" align = "center">' . $allData["CustomerName"] . '</td>
                    <td width = "90" align = "center">' . $allData["CompanyName"] . '</td>
                    <td width = "90" align = "center"> - </td>
                    <td width = "100" align = "center">' . $allData["Variants"] . '</td>
                    <td width = "100" align = "center">' . $allData["Cellphone"] . '</td>
                    <td width = "40" align = "center">';
                if ($allData["PaymentType"] == "Cash") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "60" align = "center">';
                if ($allData["PaymentType"] == "Financing") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "50" align = "center">';
                if ($allData["StatusType"] == "Hot") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "50" align = "center">';
                if ($allData["StatusType"] == "Warm") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "50" align = "center">';
                if ($allData["StatusType"] == "Cold") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "40" align = "center">';
                if ($allData["FollowupType"] == "7 Days") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "40" align = "center">';
                if ($allData["FollowupType"] == "14 Days") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "40" align = "center">';
                if ($allData["FollowupType"] == "21 Days") {
                    $html .= "Yes";
                } else {
                    $html .= "-";
                }
                $html .= '</td>
                    <td width = "100" align = "center">' . $allData["ColorName"] . '</td>
                    <td width = "80" align = "center">' . $allData["Reason"] . '</td>
                    <td width = "92" align = "center">' . $allData["Remarks"] . '</td>
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
        } else if (isset($_POST['excel'])) {
//            
            $Data = array();
            $excel = new Car_excel();
            if ($Search[0] != "" || $Search[1] != "" || $Search[2] != "" || $Search[3] != "" || $Search[4] != "" || $Search[5] != "" || $Search[6] != "" || $Search[7] != "" || $Search[8] != "" || $Search[9] != "" || $Search[10] != "" || $Search[11] != "" || $Search[12] != "") {
                $Data['AllData'] = $excel->report($FromDate, $ToDate, $Search, $UserId, $UserRole);
            } else {
                $Data['AllData'] = $excel->reportDate($FromDate, $ToDate, $UserId, $UserRole);
            }
            $this->load->view('excel', $Data);
//            $Excel = new Car_excel();
//            if ($Search[0] != "" || $Search[1] != "" || $Search[2] != "" || $Search[3] != "" || $Search[4] != "" || $Search[5] != "" || $Search[6] != "" || $Search[7] != "" || $Search[8] != "" || $Search[9] != "" || $Search[10] != "" || $Search[11] != "" || $Search[12] != "") {
//                $Data = $Excel->report($FromDate, $ToDate, $Search, $UserId, $UserRole);
//            } else {
//                $Data = $Excel->reportDate($FromDate, $ToDate, $UserId, $UserRole);
//            }
//            //Enter the headings of the excel columns
//            $contents = "\t, \t, \t, \t, \t,\t,\t ,\t, \t,\t,Toyota Western Motors,  \t,\t,\t, \t,\t, \t,\t,\t, \t, \t, \t\n";
//            $contents .= "\t, \t, \t, \t, \t,\t,\t ,\t, \t,Daily Report:," . date('d/m/Y') . ", \t,\t,\t, \t,\t, \t,\t,\t, \t, \t, \t\n";
//            $contents .= "\t, \t, \t, \t, \t,1st Contact,\t ,\t, \t,\t,Contact Type,  Mode Of Payment,\t,\t, Prospect Customer,\t, \t,Follow-Ups,\t, If Sale Made:, \t, \t\n";
//            $contents .= "<b>S No.</b>, Date, Salesman, Time Consumed, Phone, Walk-in, Email, Contact Person , Company Name, Variant Interested, Office/Mobile, Cash, Lease/Finance, Hot, Warm, Cold, 7 Days, 14 Days, 21 Days, Color, Lost Sale Reason, Remarks\n";
//
////            $Data = $excel->report($FromDate, $ToDate, $Search, $UserId);
//            $count = 1;
//            foreach ($Data as $row) {
//                $contents.=$count++ . ",";
//                $contents.=$row['Date'] . ",";
//                $contents.=$row['FullName'] . ",";
//                $contents.=$row['TimeConsumed'] . ",";
//                //Contact Type
//                if ($row['ContactType'] == 'Walk-in') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                if ($row['ContactType'] == 'Email') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                if ($row['ContactType'] == 'Telephone') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                $contents.=$row['CustomerName'] . ",";
//                $contents.=$row['CompanyName'] . ",";
//                $contents.=$row['Variants'] . ",";
//                $contents.=$row['OfficeNumber'] . ",";
//                //Payment Mode
//                if ($row['PaymentType'] == 'Cash') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                if ($row['PaymentType'] == 'Financing') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                //Customer Status
//                if ($row['StatusType'] == 'Hot') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                if ($row['StatusType'] == 'Warm') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                if ($row['StatusType'] == 'Cold') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                //Follow up
//                if ($row['FollowupType'] == '7 Days') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                if ($row['FollowupType'] == '14 Days') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                if ($row['FollowupType'] == '21 Days') {
//                    $contents.="Yes" . ",";
//                } else {
//                    $contents.="-" . ",";
//                }
//                $contents.=$row['ColorName'] . ",";
//                $contents.=$row['Reason'] . ",";
//                $contents.=$row['Remarks'] . "\n";
//            }
//
//// remove html and php tags etc.
//            $ExcelData = strip_tags($contents);
////header to make force download the file
//            print $ExcelData;
//            header("Content-Disposition: attachment; filename=Toyota-DMS-" . date('d-m-Y') . ".csv");
        }
    }

}
