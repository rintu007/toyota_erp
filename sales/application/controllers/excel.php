<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Excel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_excel');
    }

    public function index() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $Data = array();
        $excel = new Car_excel();
        $ToDate = $this->input->post('ToDate');
        $FromDate = $this->input->post('FromDate');
        $Search = $this->input->post('Search');
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        if ($Search[0] != "" || $Search[1] != "" || $Search[2] != "" || $Search[3] != "" || $Search[4] != "" || $Search[5] != "" || $Search[6] != "" || $Search[7] != "" || $Search[8] != "" || $Search[9] != "" || $Search[10] != "" || $Search[11] != "" || $Search[12] != "") {
            $Data['AllData'] = $excel->report($FromDate, $ToDate, $Search, $UserId, $UserRole);
        } else {
            $Data['AllData'] = $excel->reportDate($FromDate, $ToDate, $UserId, $UserRole);
        }
        $this->load->view('excel', $Data);
    }

}
