

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Requestfordocument extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_document_request');
        $this->load->library('form_validation');
    }

    /* public function index() {
        $this->load->view('header');
        $this->load->view('request_for_document');
        $this->load->view('footer');
    } */

    public function add($id = '') {

        if ($id == '') {
           $enteryNum = $this->Car_document_request->getEnteryNo();
            //print_r($enteryNum);



            if (isset($enteryNum[0]['entry_no']) && $enteryNum[0]['entry_no'] > 0) {
                $entry = $enteryNum[0]['entry_no'] + 1;
            } else {
                $entry = 1;
            }
            //echo $entry;
            //	die;
            $data = array(
                'Customer' => $this->Car_document_request->getCustomer(),
                'Variants' => $this->Car_document_request->getVariant(),
               
                'entery_no' => $entry,
              
				'Saleman' => $this->Car_document_request ->getSaleman(),
            );
            //echo"hasib";
           $this->load->view('header');
            $this->load->view('request_for_document_add', $data);
           
            $this->load->view('footer');
			//print_r($_POST);
        }
    }

    //////////////////////////////////////////////////////////
    public function save() {
        $this->Car_document_request->save();
       redirect(base_url() . "index.php/Requestfordocument/add");
		//print_r($_POST);
    }
	///////////////////////////////
	public function view() {
        $data = array(
            'testDrive' => $this->Car_document_request->getDocumentRequest()
        );
        print_r($data);


        $this->load->view('header');
        $this->load->view('request_for_document_view', $data);
        $this->load->view('footer');
    }
	////////////////////////////////////////////////////////////////////////
	 public function edit($editKey = '') {
		 $enteryNum = $this->Car_document_request->getEnteryNo();
            //print_r($enteryNum);



            if (isset($enteryNum[0]['entry_no']) && $enteryNum[0]['entry_no'] > 0) {
                $entry = $enteryNum[0]['entry_no'] + 1;
            } else {
                $entry = 1;
            }


        $data = array(
            'testDrivedetail' => $this->Car_document_request->getOneDocumentRequest($editKey),
                'Customer' => $this->Car_document_request->getCustomer(),
                'Variants' => $this->Car_document_request->getVariant(),
               
                'entery_no' => $entry,
               // 'Model_no' => $this->Car_document_request->getCarModel(),
				'Saleman' => $this->Car_document_request ->getSaleman(),
        );
        print_r($data['testDrivedetail']);

        $this->load->view('header');
        $this->load->view('request_for_document_edit', $data);
        $this->load->view('footer');
    }

    public function update() {

        $this->Car_document_request->update();
        redirect(base_url() . "index.php/Requestfordocument/view");
    }


}
