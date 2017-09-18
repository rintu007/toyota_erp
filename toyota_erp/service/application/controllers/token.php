<?php
/**
 * Created by PhpStorm.
 * User: Shah Saqib
 * Date: 9/18/2017
 * Time: 12:12 PM
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Token extends CI_Controller
{
    private $token;

    public function __construct()
    {
        parent::__construct();
//        $this->load->model('s_repairorder');
//        $this->load->model('s_rochecklist');
//        $this->load->model('s_rofinance');
//        $this->load->model('s_financeinfo');
//        $this->load->model('s_fuelmanagement');
//        $this->load->model('s_jobreferencemanual');
//        $this->load->model('s_partsuseage');
//        $this->load->model('s_subletrepairuseage');
//        $this->load->model('s_luboiluseage');
//        $this->load->model('s_staff');
//        $this->load->model('s_customer');
//        $this->load->model('s_vehicle');
//        $this->load->model('s_bodypaint');
//        $this->load->model('s_allbrands');
//        $this->load->model('s_allmodels');
//        $this->load->model('s_allvehicles');
//        $this->load->model('s_bodypaint');
//        $this->load->model('s_conditionconfirmationdetail');
//        $this->load->model('s_periodicmaintenancedetails');
//        $this->load->model('s_jobprogresscontrolboard');
//        $this->load->model('s_bays');
        $this->load->model('s_token');
        $this->load->library('form_validation');

        $this->token = new s_token();

        date_default_timezone_set("Asia/Karachi");
    }

    public function index()
    {
        $dataArray = array();
        $dataArray['token'] = $this->token->get_all();
//        var_dump($data);die;

//        $this->load->view('header');
        $this->load->view('token', $dataArray);
//        $this->load->view('footer');

    }

    public function form()
    {
        $dataArray = array();
        $dataArray['customer_list'] = $this->token->customer_list();
        $dataArray['variants'] = $this->token->get_variants();
        $dataArray['s_category'] = $this->token->get_s_category();
        $dataArray['tokenNumber'] = $this->token->get_tokenNumber();

//        var_dump($dataArray['tokenNumber']);die;;

        $this->load->view('header');
        $this->load->view('token_form', $dataArray);
        $this->load->view('footer');
    }

    public function add()
    {
        $Token = $this->token->insert();

        $Response = "Token # $Token Has Been Inserted";
        $this->session->set_flashdata('message', $Response);
        redirect(base_url() . "index.php/token/form");

    }




}