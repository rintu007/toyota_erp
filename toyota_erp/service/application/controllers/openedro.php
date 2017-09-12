<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Openedro extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('Pdf');
        $this->load->model('s_openedro');
        $this->load->model('s_repairorder');
        $this->load->model('s_rolist');
        $this->load->model('s_rochecklist');
        $this->load->model('s_financeinfo');
        $this->load->model('s_fuelmanagement');
        $this->load->model('s_jobreferencemanual');
        $this->load->model('s_partsuseage');
        $this->load->model('s_subletrepairuseage');
        $this->load->model('s_luboiluseage');
        $this->load->model('s_staff');
        $this->load->model('s_customer');
        $this->load->model('s_vehicle');
        $this->load->model('s_bodypaint');
        $this->load->model('s_allbrands');
        $this->load->model('s_allvehicles');
        $this->load->model('s_allmodels');
        $this->load->model('s_bodypaint');
        $this->load->model('s_conditionconfirmationdetail');
        $this->load->model('s_periodicmaintenancedetails');
         $this->load->model('s_rodetail');
        
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {
        $repairOrderModel = new S_repairorder();
        $modelOpenedRO = new S_openedro();
        $financeModel = new S_financeinfo();
        $checkListModel = new S_Rochecklist();
        $jobRefManual = new S_jobreferencemanual();
        $fuelManagment = new S_fuelmanagement();
        $dataArray['gasVolume'] = $repairOrderModel->getGasInfo();
        $dataArray['allOpenedRO'] = $modelOpenedRO->getOpenedRODetail();
        $dataArray['fuelVolume'] = $fuelManagment->getFuelInfo();
        $dataArray['ROMode'] = $repairOrderModel->getROModes();
        $dataArray['checkList'] = $checkListModel->getAllRoCheckList();
        $dataArray['mechanicalJobs'] = $jobRefManual->getMechanicalJobs();
        $dataArray['financeInfoList'] = $financeModel->getFinanceInfo();
        $dataArray['insertMessage'] = $this->session->flashdata('insertmessage');
        $dataArray['updateMessage'] = $this->session->flashdata('updatemessage');
        $dataArray['deleteMessage'] = $this->session->flashdata('deletemessage');
        $dataArray['cancelMessage'] = $this->session->flashdata('cancelmessage');
        $this->load->view('header');
        $this->load->view('openedro', $dataArray);
        $this->load->view('footer');
    }

    public function getRo($RONumber) {
        $repairOrderModel = new s_repairorder();
        $data = array();
        $data['getRoData'] = $repairOrderModel->getRoData($RONumber);
		$data['EstimateJob'] = $repairOrderModel->getRequestedJobs($RONumber);
		$data['RODetailJob'] = $repairOrderModel->getDetailJobs($RONumber);
		$data['Sublet'] = $repairOrderModel->getSublet($RONumber);
		$data['Parts'] = $repairOrderModel->getReceivedParts($RONumber);
		$data['AdditionalJobs'] = $repairOrderModel->getAdditionalJobs($RONumber);
		$data['PMJobs'] = $repairOrderModel->getPMJobs($RONumber);
       // $idfinance = $data['getRoData'][0]['idFinance'];
    //    $financeDetailModel = new s_financeinfo();
       // $data['getfianancetype'] = $financeDetailModel->getfainancename($idfinance);
     //  $idRoMode = $data['getRoData'][0]['idROMode'];
    //    $staffModel = new s_staff();
     //   $data['getROMode'] = $staffModel->getRoName($idRoMode);
     //   $data['getmanualreferance'] = $repairOrderModel->getReferanceRecords($RONumber);

    //    $roDetailModel = new S_rodetail();
       
     //   $data3 = $roDetailModel->roDetail($RONumber);
    //    $data2 = $roDetailModel->roDetailparts($RONumber);
        
    //    $array = array('parts'=>$data2,'other'=>$data3);
     //   $data['ro_partsDetail'] = $array;
//
   //     $data['getWorkedDetail'] = $roDetailModel->getro_workDetail($RONumber);

     //   $data['cunsumersubletDetail'] = $roDetailModel->getro_cunsumersubletDetail($RONumber);
      
        
        
        $this->load->view('header');
        $this->load->view('viewro', $data);
        $this->load->view('footer');
    }
	
	function get_invoice_data(){
	 $repairOrderModel = new s_repairorder();
        $data = array();
        $data['getRoData'] = $repairOrderModel->getRoData($_POST['ROnumber']);	
		$data['Sublet'] = $repairOrderModel->getSublet($_POST['ROnumber']);
		$data['Parts'] = $repairOrderModel->getReceivedParts($_POST['ROnumber']);
		$data['RODetailJob'] = $repairOrderModel->getDetailJobs($_POST['ROnumber']);
		
		echo json_encode($data);
	}

    function searchOpenedRODetail() {
        $openedROModel = new S_openedro();
        $search = $this->input->post('SearchByRO');
        $data = $openedROModel->searchOpenedRODetail($search);
        $rODetail = json_encode($data);
        echo $rODetail;
    }
	
	function searchOpenedRODetailDate() {
        $openedROModel = new S_openedro();
        $search = $this->input->post('SearchByDate');
        $data = $openedROModel->searchOpenedRODetailDate($search);
        $rODetail = json_encode($data);
        echo $rODetail;
    }

    function cancel($idRO) {
        $modelOpenedRO = new S_openedro();
        $cancelRO = $modelOpenedRO->cancelRO($idRO);
        $this->session->set_flashdata('cancelmessage', '<h4>' . $cancelRO . '</h4>');
        redirect(base_url() . "index.php/openedro/index");
    }

    // Testing Function

    public function insert_spin_data($fb, $winningamount, $islst) {
        date_default_timezone_set('Asia/Karachi');
        $date = date('Y/m/d H:i:s');
        $query_turn = "SELECT UserTurn,Amount FROM userinfo WHERE FbId = '" . $fb . "'";
        $result_turn = $this->getConnection()->query($query_turn);
//        $result_turn_result = mysqli_fetch_array($result_turn, MYSQLI_ASSOC);

        while ($row_turn = $result_turn->fetch_assoc()) {
            $prev_turn = $row_turn['UserTurn'];
            $amount = $row_turn['Amount'];
        }

        if ($islst == true) {
            if ($prev_turn == 0) {
                
            } else {
                $upd_turn = $prev_turn - 1;
                $query = "UPDATE userinfo SET UserTurn = " . $upd_turn . " WHERE FbId='" . $fb . "'";
                $result_upd = $this->getConnection()->query($query);
            }
        }

        $query = "INSERT INTO usercredithistory(FbId,WinningAmount,DateTime,IsLast) VALUES('" . $fb . "','" . $winningamount . "','" . $date . "','" . $islst . "')";
        $result = $this->getConnection()->query($query);

        $user_update_query = "UPDATE `userinfo` SET `Amount` = `Amount` + $winningamount WHERE `FbId`='" . $fb . "'";
        $result_update_user_amount = $this->getConnection()->query($user_update_query);

        return $result;


//        if ($res->num_rows > 0) {
//            while ($row = $res->fetch_assoc()) {
//                $result_arr['data'] = array('Name' => $row['Name'], 'Email' => $row['Email'], 'ContactNumber' => $row['ContactNumber'], 'Address' => $row['Address'], 'DateOfBirth' => $row['DateOfBirth'], 'Cnic' => $row['Cnic'], 'City' => $row['City'], 'TurnLeft' => $row['UserTurn'], 'TotalAmount' => $row['Amount'], 'time' => '00:00:00', 'time' => "00:00:00", 'time_interval' => '23:59:59');
//            }
//            return $result_arr;
//        } else {
//            return false;
//        }
    }

    public function calculate_time_span($date) {

        $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($date);

        $months = floor($seconds / (3600 * 24 * 30));
        $day = floor($seconds / (3600 * 24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);
        if ($hours < 10) {
            $hours = '0' . $hours;
        } else {
            $hours = $hours;
        }
        if ($mins < 10) {
            $mins = '0' . $mins;
        } else {
            $mins = $mins;
        }
        if ($secs < 10) {
            $secs = '0' . $secs;
        } else {
            $secs = $secs;
        }
        $time = $hours . ':' . $mins . ':' . $secs;
//        if ($seconds < 60)
//            $time = $secs . " seconds ago";
//        else if ($seconds < 60 * 60)
//            $time = $mins . " min ago";
//        else if ($seconds < 24 * 60 * 60)
//            $time = $hours . " hours ago";
//        else if ($seconds < 24 * 60 * 60)
//            $time = $day . " day ago";
//        else
//            $time = $months . " month ago";

        echo $time;
    }

    public function test($dateTime) {
        $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($dateTime);
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);
        if ($hours < 10) {
            $hours = '0' . $hours;
        } else {
            $hours = $hours;
        }
        if ($mins < 10) {
            $mins = '0' . $mins;
        } else {
            $mins = $mins;
        }
        if ($secs < 10) {
            $secs = '0' . $secs;
        } else {
            $secs = $secs;
        }
        $timeInterval = $hours . ':' . $mins . ':' . $secs;
//        echo $timeInterval;
        $spanInterval = '00:01:59';
        if ($spanInterval > $timeInterval) {
            $startTime = strtotime($timeInterval);
            $timeEnd = strtotime($spanInterval);
            $difference = ($timeEnd - $startTime);
            $diffHours = floor($difference / 3600);
            $diffMins = floor(($difference - ($diffHours * 3600)) / 60);
            $diffSecs = floor($difference % 60);
            if ($diffHours < 10) {
                $diffHours = '0' . $diffHours;
            } else {
                $diffHours = $diffHours;
            }
            if ($diffMins < 10) {
                $diffMins = '0' . $diffMins;
            } else {
                $diffMins = $diffMins;
            }
            if ($diffSecs < 10) {
                $diffSecs = '0' . $diffSecs;
            } else {
                $diffSecs = $diffSecs;
            }
            $intervalDifference = $diffHours . ':' . $diffMins . ':' . $diffSecs;
            echo $intervalDifference;
        } else {
            echo '34:00:00';
        }
    }

    function convert_number_to_words($number) {
        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Fourty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety',
            100 => 'Hundred',
            1000 => 'Thousand',
            1000000 => 'Million',
            1000000000 => 'Billion',
            1000000000000 => 'Trillion',
            1000000000000000 => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }
        return $string;
    }

    public function pdf($RONumber) {
        $repairOrderModel = new s_repairorder();
        //$data = array();
        $getRoData = $repairOrderModel->getRoData($RONumber);
        $cus = $getRoData[0]['CustomerName'];
        //echo $getRoData[0]['CustomerName'];
        //die;
        /* //		echo $id;
          //	exit();
          //$model = new Customers();
          $data = $this->get_one_poli($id);
          $productname2 = '';


          $now = new DateTime();
          $date = new DateTime($data['CustomerDOB']);
          $diff = date_diff($date, $now);
          $age = $diff->y;

          $room = '';
          if ($data['PlanName'] == 'Gold') {
          $room = 'Private Room';
          } else if ($data['PlanName'] == 'Silver') {
          $room = 'Sami Private Room';
          } else {
          $room = 'General Ward';
          }

          $newEndingDate = date("Y-m-d", strtotime(date("M d Y", strtotime($data['IssueDate'])) . " + 364 day"));

          $datefbirth = date("M d Y", strtotime($data['CustomerDOB'])); */

        $pdf = new tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('ICL');
        $pdf->SetTitle('Organized By ICL');
        $pdf->SetSubject('PDF generated');
        $pdf->SetKeywords('ICL');
// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '' . '', '');

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set font
        $pdf->SetFont('helvetica', '', 11);
// add a page
        $pdf->AddPage();
// column titles
        $header = array('id');

        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetXY(15, 110);
        $html = "<html>
						<head>
						<link rel=Stylesheet href='<?= base_url(); ?>assets1/css/bootstrap.min.css'>
						<link rel=Stylesheet href='<?= base_url(); ?>assets1/css/style.css'>

						<style>
						li{
							display:inline;
							padding: 0px 9px 0px 0px;
						}
						#y{
							display:inline;
							padding: 0px 30px 0px 10px;
						}
						#a{
							padding: 0px 17px 0px 10px;
						}
						</style>
						</head>

						<body>
						<br/>
						<!--Print area  starts-->
						<div id='printArea'>
						<div style='text-align:center; font-size:14px;'><strong>REPAIR ORDER/BILL</strong></div>
						<!--container  starts-->
						<div class='container border' style='border:1px solid black;width:948px;'>
						<!--top section starts-->
						<div id='topsection'style='width: auto;height: 90px; border-bottom:1px solid;'>
						<div class='left'>
							  <div class='logo' style='    border: 1px solid; margin-top: -1px;clear: both;width: 182px;height: 84px;'> <img style='    width: 150px;margin: 27px 0px 0px 11px;'src='<?= base_url(); ?>assets/images/toyota-logo.PNG' style='width: 150px;'> </div>
							</div>
							<div class='center' style=' margin-left: 181px;margin-top: -84px; border: 1px solid black; width: 560px;'>
							  <div style='font-size: 22px;     margin: 0px -3px -6px 9px;'><strong>TOYOTA WESTERN MOTORS</strong></div>
							  <p style='font-size: 13px;margin: 1px -1px 2px 10px;'>C-38, Estate Avenue, S.I.T.E Karachi, Pakistan. Post Code-75730 <br>
								Tel : (021) 111-888-788, 32564531-5 Fax : (021) 32587669, 32564536 <br>
								E-mail : twm_services@yahoo.com</p>
							</div>
							<div class='right' >
							  <div class='logo'> <img src='<?= base_url(); ?>assets/images/daihaisu-logo.PNG' style='width: 176px;float: right;margin-right: 11px;margin-top: -84px;'><br>
								<div class='rono'> <div style='float: right;border: 1px solid;width: 178px; margin-right: 9px;margin-top: -69px;height: 49px;'><div style='    margin: 9px 6px 6px 11px;font-size: 17px;font-weight: bold;'>R. O. #</div> </div></div>
							  </div>
							</div>
						</div>
						<!--top section End-->
						
						<!--Middle section Strats-->
						<div id='middlesection'>
						 <div class='col-sm-9 p-l'>
						 <div border='1px solid black'>
							<table style=' font-size: 12px;margin-top: -11px; border: 1px solid;height: 66px;border-bottom: none;    border-right: none;'>
							<tr>
							<td style='padding: 4px;'>CUSTOMER'S NAME :</td>
							<td style='padding: 4px;'><strong><?= $cus ?></strong></td>
							</tr>
							<tr>
							<td style='padding: 4px; height:38px'>ADDRESS :</td>
							<td style='padding: 4px;'><strong><?= $cus ?></strong></td>
							</tr>
							<tr>
							<td style='padding: 4px;'>NTN/NIC :</td>
							<td style='padding: 4px;width: 253px;' ><strong><?= $cus ?> &nbsp; / <?= $cus ?></strong></td>
							<td style='padding: 4px;'>TEL :</td>
							<td style='padding: 4px;'><strong><?= $cus ?></strong></td>
							</tr>
							</table>
							</div>
							</div>
							<div class='col-sm-9 p-l'style='border-left: 1px solid;'>
							<table style='font-size: 12px;float: right;margin-right: -250px;margin-top: -89px; border: 1px solid;'>
							<tr>
							<td style='width: 120px;height: 37px;vertical-align: top; padding: 0px 0px 0px 11px;' colspan='2'>CASH MEMO NO.<br/><strong style='padding: 20px;'><?= $cus ?></strong></td>
							<td style='border: 1px solid;width: 120px;height: 37px;vertical-align: top; padding: 0px 0px 0px 07px;' colspan='2'>CREDIT MEMO NO.<br/><strong style='padding: 20px;'><?= $cus ?></strong></td>
							</tr>
							<tr>
							<td style='border: 1px solid;width: 120px;height: 37px;vertical-align:top; padding: 0px 0px 0px 28px;'colspan='2'>BOOK IN
							<div style='float:right; margin: 3px 16px 0px 0px;'>TIME</div>
							<div style='float: left;margin: 3px 0px 0px -15px;'>DATE</div>
							</td>
							<td style='border: 1px solid;width: 120px;height: 37px;vertical-align:top; padding: 0px 0px 0px 28px;'colspan='2'>DELIVERY
							<div style='float:right; margin: 3px 9px 0px 0px;'>TIME</div>
							<div style='float: left;margin: 3px 0px 0px -15px;'>DATE</div>
							</td>
							
							</tr>
							<tr>
							<td style='border: 1px solid;width: 60px;height: 37px;vertical-align:middle; padding:1px;'><strong><?= $cus ?></strong></td>
							<td style='border: 1px solid;width: 60px;height: 37px;vertical-align:middle; padding:7px;'><strong><?= $cus ?></strong></td>
							<td style='border: 1px solid;width: 60px;height: 37px;vertical-align:middle; padding:1px;'><strong><?= $cus ?></strong></td>
							<td style='border: 1px solid;width: 60px;height: 37px;vertical-align:middle; padding:7px;'><strong><?= $cus?></strong></td>
							</tr>
							</table>
							
						  </div>
						  <div style='width: 938px; margin-top:10px;'>
						  <table style='font-size: 12px;' >
							<tr>
							<td style='border: 1px solid;width: 110.5px; padding: 0px 0px 2px 21px;' >MAKE<br/><strong ><?= $cus ?></td>
							<td style='border: 1px solid;width: 110.5px; padding: 0px 0px 0px 25px;' >MODEL<br/><strong ><?= $cus ?></td>
							<td style='border: 1px solid;width: 110.5px; padding: 0px 0px 0px 20px;'>REG. NO.<br/><strong ><?= $cus ?></td>
							<td style='border: 1px solid;width: 110.5px; padding: 0px 0px 0px 32px;' >KM<br/><strong ><?= $cus ?></td>
							<td style='border: 1px solid;width: 196px; padding: 0px 0px 0px 42px;' >FRAME NO.<br/><strong ><?= $cus ?></td>
							<td style='border: 1px solid;width: 183px; padding: 0px 0px 0px 28px;' >ENGINE NO.<br/><strong ><?= $cus ?></td>
							<td style='border: 1px solid;width: 138px; padding: 0px 0px 0px 40px; border-top: none;' >FUEL<br/><strong ><?= $cus ?></td>
							<td style='border: 1px solid;width: 148px; padding: 0px 0px 0px 16px; border-top: none;'>GATE PASS NO.<br/><strong ><?= $cus ?></td>
							
							
							</tr>
							</table>
						  </div>
						  <div style='float:left; border:1px solid black;border-top: none;width:180px; height:223px;'>
						  
						  </div>
						  <div style='    margin-right: -250px; width: 758px;height: auto;float: right;'>
						  <table style='font-size: 12px;  margin-left: -250px;'>
							<tr>
							<td style='border: 1px solid;border-top:none;border-left:none;width: 108px; padding: 0px 0px 9px 17px;' >INSURANCE</td>
							<td style='border: 1px solid;width: 98px; border-top:none;padding: 0px 0px 9px 17px;' >INTERNAL</td>
							<td style='border: 1px solid;width: 112px; border-top:none; padding: 0px 0px 0px 20px;'>CUSTOMER</td>
							<td style='border: 1px solid;width: 111px; border-top:none;padding: 0px 0px 0px 32px;' >WARRANTY</td>
							<td style='border: 1px solid;width: 158px; border-top:none;padding: 0px 0px 0px 42px;' >OTHER</td>
							<td style='border: 1px solid;width: 170px;border-top:none; padding: 0px 0px 0px 28px;' >CASH/CREDIT CHEQUE</td>
							</tr>
							</table>
							<table style='font-size: 12px;margin-left: -251px;' width='759px '>
							<tr>
							<td style='border: 1px solid;    border-top: none;font-weight: bolder; padding: 1px 0px 0px 109px;' colspan='3' >MECHANICAL REPAIRS</td>
							<td style='border: 1px solid;width: 130px;     border-top: none;font-weight: bolder;padding: 1px 0px 0px 163px;' colspan='3' >BODY/PAINT</td>
							</tr>
							<tr>
							<td style='border: 1px solid;     padding: 0px 0px 3px 12px;' colspan='3' >1.  WASH AND LUBRICATION <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' rowspan='2' >
							<ul>
							<li>SERVICE </li> 
							<li>UNDERCOAT</li>   
							<li>W/BALANCE</li>   
							<li>W/ALIGNMENT</li> 
							</ul>
							<ul style='margin-left:-9px; margin-top: -12px;'>
							<li id='a'><input type='text' style='width:15%'/></li> 
							<li id='a'><input type='text' style='width:15%'/></li> 
							<li id='a'><input type='text' style='width:15%'/></li> 
							<li id='a'><input type='text' style='width:15%'/></li> 
							
							</ul>
							</td>
							</tr>
							<tr>
							<td style='border: 1px solid;  padding: 0px 0px 3px 12px;' colspan='3' >2.OIL CHANGE ENG. / GEAR / DIFF <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							
							</tr>
							<tr>
							<td style='border: 1px solid;     padding: 0px 0px 3px 12px;' colspan='3' >3. REPLACE OIL FILTER ELEMENT <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >1. COLOUR/PAINT CODE APPLIED</td>
							</tr>
							<tr>
							<td style='border: 1px solid;     padding: 0px 0px 3px 12px;' colspan='3' >4. ENGINE TUNNING <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >2. INSURANCE CO/CODE</td>
							</tr>
							<tr>
							<td style='border: 1px solid;    padding: 0px 0px 3px 12px;' colspan='3' >5.  BRAKE ADJUSTMENT  <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >3. SURVEYOR</td>
							</tr>
							<tr>
							<td style='border: 1px solid;    padding: 0px 0px 3px 12px;' colspan='3' >6. WHEEL BALANCE / ALIGNMENT <input style='background:white; float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >4. B/P CONTINUATION R.O REF NO.(IF ANY)</td>
							</tr>
							<tr>
							<td style='border: 1px solid;   padding: 0px 0px 3px 12px;' colspan='3' >7. A/C GAS CHARGING / REPAIRS <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >5. MECHANICAL R.O  REF NO.(IF ANY)</td>
							</tr>
							<tr>
							<td style='border: 1px solid;     padding: 0px 0px 3px 12px;' colspan='3' >8.PRE-DELIVERY SERVICE <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >6. APPROVED LABOUR Rs.</td>
							</tr>
							<tr>
							<td style='border: 1px solid;    padding: 0px 0px 3px 12px;' colspan='3' >9.  100 KM SERVICES <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >7. DEPRECIATION AMOUNT Rs.</td>
							</tr>
							<tr>
							<td style='border: 1px solid;    padding: 0px 0px 3px 12px;' colspan='3' >10. .............KM SERVICES<input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >8. INVOICE #</td>
							</tr>
							<tr>
							<td style='border: 1px solid;    padding: 0px 0px 3px 12px;' colspan='3' >11.  <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >9. INVOICE DATE</td>
							</tr>
							<tr>
							<td style='border: 1px solid;     padding: 0px 0px 3px 12px;' colspan='3' >12.   <input style='float:right; margin-right: 22px;'type='checkbox'/></td>
							<td style='border: 1px solid;width: 130px;     padding: 0px 0px 3px 12px;' colspan='3' >DELIVERY DATE</td>
							</tr>
							
							</table>
						  </div>
						  <div style='float:left; width:auto; height:auto; clear:both;    margin-top: -84px;'>
						  <table style='border:1px solid;font-size: 12px; width:180px;' >
						  <tr>
						  <td style='border: 1px solid;width: 33px;'></td>
						  <td style='border: 1px solid; font-weight:bolder;font-size: 15px;padding: 4px 0px 4px 25px;'>CHECK LIST</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>RADIO / ANTENNAE</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>CASSTTE PLAYER</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>CASSETTES-USB</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>CLOCK</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>LIGHTER</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>ASHTRAY</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>REAR VIEW MIRROR</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>WIPER BLADES</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>FLOOR MATS</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>SEAT COVERS</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>DICKEY MAT</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>SPARE WHEEL</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>JACK & HANDEL</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>TOOLS (QTY)</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>HIB CAPS/WHEEL CAPS </td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>MONOGRAMS</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>NO OF KEYS/RING</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>PERFUME</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>ANTI THEFT</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>DICKY HARD BOARD</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>TOP COVER</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>STEERING LOCK</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid;'></td>
						  <td style='border: 1px solid;padding: 0px 0px 0px 6px;'>DOCUMENT(R+1)</td>
						  </tr>
						  <!--second table-->
						  <table style='font-size: 12px;width: 547px;float: right;margin-left: 179px;margin-top: -362px;'>
							<tr>
						  <td style='border: 1px solid; width:556px;text-align: center;'>JOB REQUESTS/V.O.C</td>
						  </tr><tr>
						  <td style='border: 1px solid; width:556px;'>&nbsp;</td>
						  
						  </td>
						  </tr><tr>
						  <td style='border: 1px solid; width:556px;'>&nbsp;</td>
						  </tr><tr>
						  <td style='border: 1px solid; width:556px;'>&nbsp;</td>
						  </tr>
						  </tr>
						  </table>
						  <!--second table end-->
						  <?php
						  
						  ?>
						  </div>
						  <div style='float:right; margin-top:-1px;'>
						  <table style='font-size: 12px;width: 212px;'>
							<tr>
						  <td style='border: 1px solid; text-align: center;'>WORK ORDER ATTACH<td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;padding: 7px 0px 0px 0px;'>
						  <ul>
							<li id='y'>YES </li> 
							<li id='y'>NO</li>   
							</ul>
							<ul style='margin-left:-9px; margin-top: -12px;'>
							<li id='a'><input type='text' style='width:15%' value='<?=$cus ?>'/></li> 
							<li id='a'><input type='text' style='width:15%' value='<?=$cus ?>'/></li> 
							
							</ul>
							</td>
						  </tr>
						  </table>
						  </div>
						  <div style='float:right; margin-top:-290px;'>
						  <table style='font-size: 12px;width: 759px;'>
							<tr>
						  <td style='border: 1px solid; width: 575px;text-align: center;'>WORK PERFORMED</td>
						  <td style='border: 1px solid; text-align: center;'>HRS</td>
						  <td style='border: 1px solid; text-align: center;width:100px;'>AMOUNT</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;'>&nbsp;</td>
						  </tr>
						  </table>
						  </div>
							<div style='width: 938px; clear:both;'>
							<table style='font-size: 12px;margin-top:10px; width: 938px;'>
						  
						  <tr>
						  <td style='border: 1px solid; text-align: left;width:407px;padding: 5px 5px 2px 18px;'rowspan='5'><p>THE ABOVE WORK HEREBY AUTHORISED AND<br/> 
																										TERMS AGREED TO AS OUT LINED OVERLEAF</p>
																									<p>CUSTOMER'S SIGNATURE _____________________ </p>
																									<p>CUSTOMER'S NAME: __________________________ </p></td>
						  <td style='border: 1px solid; text-align: center; vertical-align:bottom;'rowspan='6'><p> _____________________ <br/>SERVICE ADVISOR</p></td>
						  <td style='border: 1px solid; text-align: center; vertical-align:bottom;'rowspan='6'><p> _____________________ <br/>RECOVERY ADVISOR</p></td>
						  <td style='border: 1px solid; text-align: left;width: 128px;padding: 0px 0px 0px 12px;'>LABOUR</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'><strong><?=$cus?></strong></td>
						  </tr>
						  <tr>
						  
						  <td style='border: 1px solid; text-align: left;width: 128px;padding: 0px 0px 0px 12px;'>LUB OIL</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'><strong><?=$cus?></strong></td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: left;width: 128px;padding: 0px 0px 0px 12px;'>SUBLET REPAIR</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'><strong><?=$cus?></strong></td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: left;width: 128px;padding: 0px 0px 0px 12px;'>PARTS</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'><strong><?=$cus</strong></td>
						  </tr>
						  <tr>
						  
						  <td style='border: 1px solid; text-align: left;width: 128px;padding: 0px 0px 0px 12px;'>GRAND TOTAL</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'><strong><?=$cus?></strong></td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: left;width:407px;padding: 5px 5px 2px 18px;'rowspan='4'><p>RECEIVED CAR ALONG WITH ALL TOOLS<br/> 
																										AND AGREED ACCESSORIES. THE REPAIRS HAVE BEEN <br/>
																										PERFORMED TO MY SATISFACTION</p>
																									<p>CUSTOMER'S SIGNATURE _____________________ </p>
																									<p>CUSTOMER'S NAME: __________________________ </p></td>
						  <td style='border: 1px solid; text-align: left;width: 128px;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: center; vertical-align:bottom;'rowspan='3'colspan='2'><p> _____________________ <br/>SERVICE MANAGER</p></td>
						  <td style='border: 1px solid; text-align: left;width: 128px;'>&nbsp;</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'>&nbsp;</td>
						  </tr>
						  <tr>
						  <td style='border: 1px solid; text-align: left;width: 128px;padding: 0px 0px 0px 12px;'>G.S.T @16%</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'><strong><?=$cus?></strong></td>
						  </tr>
						  
						  <tr>
						  <td style='border: 1px solid; text-align: left;width: 128px;padding: 0px 0px 0px 12px;'>NET TOTAL</td>
						  <td style='border: 1px solid; text-align: center;width: 100px;'><strong><?=$cus?></strong></td>
						  </tr>
						  </table>
							</div>
							</div>
						<!--Middle section End-->
						</div>
						<!--container  End-->
						</div>
						<!--Print area  End-->
						<script src='assets/js/jquery-2.1.1.min.js'></script>
						</body>
						</html>";
        $pdf->WriteHTML($html);

        $pdf->lastPage();
//        if ($productname2 == 'Family Health Care'){
        /* $base_path = 'E:\xampp\htdocs\jubileehealth\jubileehealth\uploads\policy';
          $filename = $data['PolicyNumber'] . '.pdf';
          $fullpath = $base_path . "/" . $filename; */
        $pdf->Output('i');
//        $this->emailicoddelivered($data["CustomerEmail"], $data["CustomerName"], $fullpath, $data['ProductName'],$data['PolicyNumber']);
//        }
    }

}
