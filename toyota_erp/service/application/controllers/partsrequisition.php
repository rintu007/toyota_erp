<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Partsrequisition extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('s_partsrequisition');
        $this->load->model('s_repairorder');
        $this->load->library('form_validation');
        date_default_timezone_set("Asia/Karachi");
    }

    function index() {

        $this->load->view('header');
        $this->load->view('partsrequisition');
        $this->load->view('footer');
    }

    function allRequested() {

        $reqModel = new S_partsrequisition();
        $allRequestedData = $reqModel->getAllRequestedParts();
        $allPartsRequested = json_encode($allRequestedData);
        echo $allPartsRequested;
    }
	function generateInvoice($RONumber){
		$data = array();
		$reqModel = new s_partsrequisition();
		$data['getPartsByRo'] = $reqModel->getPartsByRo($RONumber);
		/*foreach($data['getPartsByRo'] as $key){
		print_r($key['CreatedDate']);
		}*/
		$this->load->view('header');
		$this->load->view('requisitionInvoice',$data);
        $this->load->view('footer');
	}

    function search() {

        $reqModel = new S_partsrequisition();
        $search = $this->input->post('searchbyro');
        $requestedData = $reqModel->getRequestedParts($search);
        $partsRequested = json_encode($requestedData);
        echo $partsRequested;
    }

}
