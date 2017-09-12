<?php
/**
* 
*/
class Call_res extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('call_res_model');
		$this->load->library('session');
		$this->load->helper('url');
        $this->load->model('s_repairorder');
        $this->load->model('s_rofinance');
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
        $this->load->model('s_bodypaint');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
	}

public function  index(){
	   $dataArray = array();
        $roFinance = new S_rofinance();
        $financeModel = new S_financeinfo();
        $dataArray['roDetails'] = $roFinance->getRODetail();
        $dataArray['financeInfoList'] = $financeModel->getFinanceInfo();
        $dataArray['paymentReceived'] = $this->session->flashdata('paymentreceived');
        $this->load->view('header');
	$this->load->view('call_res');
	 $this->load->view('footer');
}

public function in(){
	$this->call_res_model->insert();
}


public function fe(){
	echo $this->call_res_model->fetch();
}


}


?>