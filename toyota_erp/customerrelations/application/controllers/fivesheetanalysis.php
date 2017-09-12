<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Fivesheetanalysis extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
        $this->load->model('reportingpanel');
    }

    public function index() {

        $this->load->view('crpanelheader');
        $this->load->view('fivesheetanalysis');
        $this->load->view('crpanelfooter');
    }

    public function servicegettotalcomplaintsinquiries() {

        $faqslist = new reportingpanel();
        $faqslists = $faqslist->gettotalcomplaintsinquiries();
        return json_encode($faqslists->result_array);
    }

    public function servicegetfivesheetreport() {
        
        $fivesheetreport = new reportingpanel();
        $fivesheetreport->getfivesheetreport();
        return json_encode($fivesheetreport->result_array);
    }

    public function servicegetfilteredinquiries() {

        $faqslist = new reportingpanel();
        $faqslists = $faqslist->getfilteredinquiries();
        echo json_encode($faqslists->result_array);
    }

    public function servicegetfilterednormalcomplaints() {

        $dateone = $_POST['filterbydateone'];
        $datetwo = $_POST['filterbydatetwo'];
        $total = array();

        $fivesheetreport = new reportingpanel();
        $total = $fivesheetreport->getfilterednormalcomplaints($dateone, $datetwo);


        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Toyota Western Motors');
        $pdf->SetTitle('Customer Relations Reports');
        $pdf->SetSubject('Customer Relations Reports');
        $pdf->SetKeywords('Customer Relations');

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
        <tbody>
            <thead>
                <tr>
                    <td width="75%" align="center" colspan="1">Total VOC Contact Trend</td> 
                </tr>
                <tr>
                    <td width="40%" align="center>SNO</td>
                    <td width="40%" align="center">Complaints/Inquiries</td>
                    <td width="10%" align="center">Number Of Complaints/Inquiries</td>

                </tr>
            </thead>
            <tbody>
               </table>';
        $count = 1;
        foreach ($total as $allData) {


            $html .= '
                <tr>
                    <td width = "50" align = "center">' . $allData['Mode'] . '</td>
                    <td width = "50" align = "center">' . $allData['Total'] . '</td>';
        }
        $pdf->writeHTML($html, true, false, false, false, '');

        //Close and output PDF document
        //This method has several options, check the source code documentation for more information.
        $pdf->Output('twm.pdf', 'I');
    }

    public function servicegetfilteredseriouscomplaints() {

        $faqslist = new reportingpanel();
        $faqslists = $faqslist->getfilteredseriouscomplaints();
        echo json_encode($faqslists->result_array);
    }

}
