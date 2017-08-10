<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reportservices extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
        $this->load->model('s_reportservices');
        $this->load->model('s_repairorder');
    }

    public function index() {

        $this->load->view('header');
        $this->load->view('reportservices');
        $this->load->view('footer');
    }

    public function reportAllServices() {

        $html = array();

        $dateone = $_POST['filterbydateone'];
        $datetwo = $_POST['filterbydatetwo'];
        $fromdate = date("d-M-Y", strtotime($dateone));
        $todate = date("d-M-Y", strtotime($datetwo));

        $reportServices = new S_reportservices();
        $allServices = $reportServices->allServicesInDate($dateone, $datetwo);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('All Services Reports');
        $pdf->SetTitle('All Services Reports');
        $pdf->SetSubject('All Services Reports');
        $pdf->SetKeywords('Services');

        //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Services', 'Reports');
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
            <span><h4>Report For All Booked Vehicles For Service</h4></span><br><div>
       <table border="1">
            <thead>
                <tr>
                    <td width="02%" height="25px" align="center"><b>SNo.</b></td> 
                    <td width="15%" height="25px" align="center"><b>RO Number</b></td> 
                    <td width="15%" height="25px" align="center"><b>Customer</b></td>  
                    <td width="10%" height="25px" align="center"><b>Variant</b></td>  
                    <td width="10%" height="25px" align="center"><b>Registration No</b></td>  
                    <td width="20%" height="25px" align="center"><b>VOC</b></td>  
                    <td width="23%" height="25px" align="center"><b>Work</b></td>  
                    <td width="05%" height="25px" align="center"><b>Amount</b></td>  
                </tr>
            </thead>
            <tbody>';

        $SNO = 1;
        foreach ($allServices as $allData) {
            $html .= '                
                <tr><td width = "02%" align="center">' . $SNO++ . '</td>
                    <td width = "15%" align="center">' . $allData['RONumber'] . '</td>
                    <td width = "15%" align="center">' . $allData['CustomerName'] . '</td>
                    <td width = "10%" align="center">' . $allData['Vehicle'] . '</td>
                    <td width = "10%" align="center">' . $allData['RegNumber'] . '</td>
                    <td width = "20%" align="center">' . $allData['VOC'] . '</td>
                    <td width = "23%" align="center">' . $allData['WorkPerformed'] . '</td>
                    <td width = "05%" align="center">' . $allData['NetTotal'] . ' =/</td></tr>';
        }

        $html .= '</tbody>
        </table><br>';

        $pdf->writeHTML($html, true, false, false, false, '');

        //Close and output PDF document
        //This method has several options, check the source code documentation for more information.
        $pdf->Output('twm.pdf', 'I');
    }

}
