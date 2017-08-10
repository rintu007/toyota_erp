<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Allreports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
        $this->load->model('reportingpanel');
    }

    public function index() {

        $this->load->view('crpanelheader');
        $this->load->view('allreports');
        $this->load->view('crpanelfooter');
    }

    public function fivesheetreport() {

        $html = array();
        $vtrend = array();
        $inquiryresolution = array();
        $complaintresolution = array();
        $totalvoc = 0;
        $totalinq = 0;
        $totalnormal = 0;
        $totalnsc = 0;
        $totalnnsaf = 0;
        $totalnrc = 0;
        $totalserious = 0;
        $totalssaf = 0;
        $totalsnsaf = 0;
        $totalsrc = 0;
        $headingcounter = 0;

        $dateone = $_POST['filterbydateone'];
        $datetwo = $_POST['filterbydatetwo'];
        $fromdate = date("d-M-Y", strtotime($dateone));
        $todate = date("d-M-Y", strtotime($datetwo));


        $fivesheetreport = new reportingpanel();
        $vtrend = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $vinquiries = $fivesheetreport->getfivesheetreport($dateone, $datetwo);

        //For Normal
        $normalcomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $productnormalcomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $salenormalcomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $servicenormalcomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $bodypartsnormalcomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);

        //For Serious
        $seriouscomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $productseriouscomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $saleseriouscomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $serviceseriouscomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $bodypartsseriouscomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);

        //For Point 4  Normal
        $normalsafetycomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $normalnonsafetycomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $normalrepeatedcomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);

        //For Point 4  Serious
        $serioussafetycomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $seriousnonsafetycomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $seriousrepeatedcomplaints = $fivesheetreport->getfivesheetreport($dateone, $datetwo);

        //For Point 5 Complaint
        $complaintresolution = $fivesheetreport->getfivesheetreport($dateone, $datetwo);
        $inquiryresolution = $fivesheetreport->getfivesheetreport($dateone, $datetwo);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Customer Relations Reports');
        $pdf->SetTitle('Customer Relations Reports');
        $pdf->SetSubject('Customer Relations Reports');
        $pdf->SetKeywords('Customer Relations');

        //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Customer Relations', '5 Sheet Analysis');
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
        $html = '&nbsp;&nbsp;<span>Report From:    ' . $fromdate . '</span><label>&nbsp;&nbsp;</label><span>To:   ' . $todate . '</span><br><br>
            <span><h3>1. Total VOC Contact Trend</h3></span><br><div>
       <table border="1">
            <thead>
                <tr>
                    <td width="2%"  height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Complaints/Inquiries</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td>  
                </tr>
            </thead>
            <tbody>';

        $vtcount = 1;
        foreach ($vtrend['total'] as $allData) {
            $totalvoc += $allData['Count'];
            $html .= '
                
                <tr valign="bottom">
                    <td width = "2%"  align="center">' . $vtcount++ . '</td>
                    <td width = "50%" align="center">' . $allData['Title'] . '</td>
            <td width = "48%" align="center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '<tr><td height="20px"></td><td height="20px" align="center"><b>Total</b></td><td height="20px" align="center">' . $totalvoc . '</td></tr></tbody>
        </table></div><br>';

        $html .= '
            <span><h3>2. Top 3 Inquiries</h3></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%"  height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Relatedto</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $inquirycount = 1;
        foreach ($vinquiries['totalinquiries'] as $allData) {
            $totalinq += $allData['Count'];
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $inquirycount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['Title'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '<tr><td height="20px"></td><td height="20px" align="center"><b>Total</b></td><td height="20px" align="center">' . $totalinq . '</td></tr></tbody>
        </table></div><br>';


        $html .= '<br><span><h3>3. Top 3 Normal Complaints</h3></span><br>
            <span><h4>Trend of Top 3 Normal Complaints</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Relatedto</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                  
                </tr>
            </thead>
            <tbody>';


        // For Normal
        $normalcount = 1;
        foreach ($normalcomplaints['normalcomplaints'] as $allData) {
            $totalnormal += $allData['Total'];
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $normalcount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['Title'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Total'] . '</td></tr>';
        }

        $html .= '<tr><td height="20px"></td><td height="20px" align="center"><b>Total</b></td><td height="20px" align="center">' . $totalnormal . '</td></tr></tbody>
        </table></div><br>';


        /**
         * Starting VOC 
         */
        $html .= '
         <br><span><h4> Top 3 Product Normal Complaints</h4></span><br><div>
       <table border="1" align="center">
            <thead>  
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Process Details</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $pncount = 1;
        foreach ($productnormalcomplaints['productnormalcomplaints'] as $allData) {
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $pncount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['ProcessDescription'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Count'] . '</td></tr>';
        }
        $html .= '</tbody>
        </table></div>';

        $html .= '<br><span><h4>Top 3 Sales Normal Complaints</h4></span><br><div>
         <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Contact Details</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $sntcount = 1;
        foreach ($salenormalcomplaints['salesnormalcomplaints'] as $allData) {
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $sntcount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['ContactDetails'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div>';

        $html .= '<br><span><h4>Top 3 Service Normal Complaints</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Contact Details</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $svncount = 1;
        foreach ($servicenormalcomplaints['servicenormalcomplaints'] as $allData) {
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $svncount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['ContactDetails'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div>';

        $html .= '<br><span><h4>Top 3 Body & Parts Normal Complaints</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Contact Details</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $bncount = 1;
        foreach ($bodypartsnormalcomplaints['bodypartsnormalcomplaints'] as $allData) {
            $html .= '
                <tr>
                    <td width = "2%"  align = "center">' . $bncount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['ContactDetails'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div><br><br><br>';
//
//
//        // For Point 4  Normal
        $html .= '<span><h3>3(A). Normal Complaints Cases</h3></span><br><br>
         <span><h4>Saftey Cases</h4></span><br><div>
         <table border="1" align="center">
            <thead>
                <tr>
                    <td width="50%" height="25px" align="center"><b>Complaint Status</b></td> 
                    <td width="50%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        foreach ($normalsafetycomplaints['normalsafetycomplaints'] as $allData) {
            $totalnsc += $allData['Count'];
            $html .= '
                <tr>
                    <td width = "50%" align = "center">' . $allData['ComplaintStatus'] . '</td>
                    <td width = "50%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '<tr><td height="20px" align="center"><b>Total Cases</b></td><td height="20px" align="center">' . $totalnsc . '</td></tr></tbody>
        </table></div><br>';

        $html .= '<span><h4>Non-Saftey Cases</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="50%" height="25px" align="center"><b>Complaint Status</b></td> 
                    <td width="50%" height="25px" align="center"><b>Count</b></td>
                </tr>
            </thead>
            <tbody>';

        foreach ($normalnonsafetycomplaints['normalnonsafetycomplaints'] as $allData) {
            $totalnnsaf += $allData['Count'];
            $html .= '
                <tr>
                    <td width = "50%" align = "center">' . $allData['ComplaintStatus'] . '</td>
                    <td width = "50%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '<tr><td><b>Total Cases</b></td><td height="20px" align="center">' . $totalnnsaf . '</td></tr></tbody>
        </table></div><br>';

        $html .= '<span><h4>Repeat Complaint Cases</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="50%" height="25px" align="center"><b>Complaint Status</b></td> 
                    <td width="50%" height="25px" align="center"><b>Count</b></td>
                </tr>
            </thead>
            <tbody>';


        foreach ($normalrepeatedcomplaints['normalrepeatedcomplaints'] as $allData) {
            $totalnrc += $allData['Count'];
            $html .= '
                <tr>
                    <td width = "50%" align = "center">' . $allData['RepeatComplaint'] . '</td>
                    <td width = "50%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '<tr><td height="20px" align="center"><b>Total Cases</b></td><td height="20px" align="center">' . $totalnrc . '</td></tr></tbody>
        </table></div><br>';

        // For Serious
        $html .= '
           <br><span><h3>4. Top 3 Serious Complaints</h3></span>
           <br><span><h4>Trend of Top 3 Serious Complaints</h4></span><br><div>
           <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Relatedto</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td>
                </tr>
            </thead>
            <tbody>';

        $seriouscount = 1;
        foreach ($seriouscomplaints['seriouscomplaints'] as $allData) {
            $totalserious += $allData['Total'];
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $seriouscount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['Title'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Total'] . '</td></tr>';
        }

        $html .= '<tr><td></td><td height="20px" align="center"><b>Total</b></td><td height="20px" align="center">' . $totalserious . '</td></tr></tbody>
        </table></div><br>';

        $html .= '<br><span><h4>Top 3 Product Serious Complaints</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Process Details</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $pscount = 1;
        foreach ($productseriouscomplaints['productseriouscomplaints'] as $allData) {
            $html .= '
                <tr>
                    <td width = "2%" height="25px" align = "center">' . $pscount++ . '</td>
                    <td width = "50%" height="25px" align = "center">' . $allData['ProcessDescription'] . '</td>
                    <td width = "48%" height="25px" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div>';

        $html .= '<br><span><h4>Top 3 Sales Serious Complaints</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Contact Details</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $sstcount = 1;
        foreach ($saleseriouscomplaints['salesseriouscomplaints'] as $allData) {
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $sstcount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['ContactDetails'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div>';

        $html .= '<br><span><h4>Top 3 Service Serious Complaints</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Contact Details</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $svscount = 1;
        foreach ($serviceseriouscomplaints['serviceseriouscomplaints'] as $allData) {
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $svscount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['ContactDetails'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div>';

        $html .= '<br><span><h4>Top 3 Body & Parts Serious Complaints</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="2%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="50%" height="25px" align="center"><b>Contact Details</b></td> 
                    <td width="48%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        $bscount = 1;
        foreach ($bodypartsseriouscomplaints['bodypartsseriouscomplaints'] as $allData) {
            $html .= '
                <tr>
                    <td width = "2%" align = "center">' . $bscount++ . '</td>
                    <td width = "50%" align = "center">' . $allData['ContactDetails'] . '</td>
                    <td width = "48%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div>';


        // For Point 4  Serious

        $html .= '
         <br><br><span><h3>4(A). Serious Complaints Cases</h3></span><br><br>
        <span>Saftey Cases</span><br><div>
         <table border="1" align="center">
            <thead>
                <tr> 
                    <td width="50%" height="25px" align="center"><b>Complaint Status</b></td> 
                    <td width="50%" height="25px" align="center"><b>Count</b></td>
                </tr>
            </thead>
            <tbody>';
        foreach ($serioussafetycomplaints['serioussafetycomplaints'] as $allData) {
            $totalssaf += $allData['Count'];
            $html .= '
                <tr>
                    <td width = "50%" align = "center">' . $allData['ComplaintStatus'] . '</td>
                    <td width = "50%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '<tr><td height="20px" align="center"><b>Total Cases</b></td><td height="20px" align="center">' . $totalssaf . '</td></tr></tbody>
        </table></div><br>';

        $html .= '<span><h4>Non-Saftey Cases</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="50%" height="25px" align="center"><b>Complaint Status</b></td> 
                    <td width="50%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        foreach ($seriousnonsafetycomplaints['seriousnonsafetycomplaints'] as $allData) {
            $totalsnsaf += $allData['Count'];
            $html .= '
                <tr>
                    <td width = "50%" align = "center">' . $allData['ComplaintStatus'] . '</td>
                    <td width = "50%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '<tr><td height="20px" align="center"><b>Total Cases</b></td><td height="20px" align="center">' . $totalsnsaf . '</td></tr></tbody>
        </table></div><br>';

        $html .= '<span><h4>Repeat Complaint Cases</h4></span><br><div>
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="50%" height="25px" align="center"><b>Complaint Status</b></td> 
                    <td width="50%" height="25px" align="center"><b>Count</b></td>
                </tr>
            </thead>
            <tbody>';


        foreach ($seriousrepeatedcomplaints['seriousrepeatedcomplaints'] as $allData) {
            $totalsrc += $allData['Count'];
            $html .= '
                <tr>
                    <td width = "50%" align = "center">' . $allData['RepeatComplaint'] . '</td>
                    <td width = "50%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '<tr><td height="20px" align="center"><b>Total Cases</b></td><td height="20px" align="center">' . $totalsrc . '</td></tr></tbody>
        </table></div><br>';

        // For Point 5 Inquiry
        $html .= '<span><h3>5. Inquiry & Complaint Handling KPI</h3></span><br><br><br>
    
       <table border="1" align="center">
            <thead>
                <tr> 
                    <td width="50%" height="25px" align="center"><b>A. Call Centre (hours)</b></td> 
                    <td width="50%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';

        foreach ($inquiryresolution['nonfcrtarget'] as $allData) {
            $html .= '
                <tr>
                    <td width = "50%" align = "center">' . $allData['Title'] . '</td>
                    <td width = "50%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div><br>';


        // For Point 5 Complaint
        $html .= '
   
       <table border="1" align="center">
            <thead>
                <tr>
                    <td width="50%" height="25px" align="center"><b>B. Normal & Serious Complaint Handling L/T (days)</b></td> 
                    <td width="50%" height="25px" align="center"><b>Count</b></td> 
                </tr>
            </thead>
            <tbody>';


        foreach ($complaintresolution['normaltarget'] as $allData) {
            $html .= '
                <tr>
                    <td width = "50%" align = "center">' . $allData['Title'] . '</td>
                    <td width = "50%" align = "center">' . $allData['Count'] . '</td></tr>';
        }

        $html .= '</tbody>
        </table></div><br>';

        $pdf->writeHTML($html, true, false, false, false, '');

        //Close and output PDF document
        //This method has several options, check the source code documentation for more information.
        $pdf->Output('twm.pdf', 'I');
    }

}
