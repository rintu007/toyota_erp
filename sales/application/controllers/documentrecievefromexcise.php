<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documentrecievefromexcise extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_document_excise');
        $this->load->library('form_validation');
    }

    /* public function index() {
      $this->load->view('header');
      $this->load->view('document_recieve_from_excise');
      $this->load->view('footer');
      } */

    public function add($id = '') {

        if ($id == '') {
            $enteryNum = $this->Car_document_excise->getEnteryNo();
            //print_r($enteryNum);



            if (isset($enteryNum[0]['entry_no']) && $enteryNum[0]['entry_no'] > 0) {
                $entry = $enteryNum[0]['entry_no'] + 1;
            } else {
                $entry = 1;
            }

            //echo $entry;
            //	die;
            $data = array(
                'Customer' => $this->Car_document_excise->getCustomer(),
                'Variants' => $this->Car_document_excise->getVariant(),
                'VariantsColor' => $this->Car_document_excise->getVariantColor(),
                'entery_no' => $entry,
                'Model_no' => $this->Car_document_excise->getCarModel()
            );
            //echo"hasib";
            //print_r($data['testData']);
            //$this->data['testDrive'] = $this->Car_test_drive->allTestDrive();
            $this->load->view('header');
            $this->load->view('document_recieve_from_excise_add', $data);
            //$this->load->view('view_test_drive', $data);
            $this->load->view('footer');
        }
    }

    //////////////////////////////////////////////////////////
    public function save() {
        $this->Car_document_excise->save();
        redirect(base_url() . "index.php/documentrecievefromexcise/add");
    }

    //////////////////////////////////////////////////////////
    public function view() {
        $data = array(
            'testDrive' => $this->Car_document_excise->getDocumentExisce()
        );
        print_r($data);


        $this->load->view('header');
        $this->load->view('document_recieve_from_excise_show', $data);
        $this->load->view('footer');
    }

    ///////////////////////////////////////////////////////////////////////////////
    public function edit($editKey = '') {


        $data = array(
            'testDrivedetail' => $this->Car_document_excise->getOneDocumentExisce($editKey),
                'Customer' => $this->Car_document_excise->getCustomer(),
                'Variants' => $this->Car_document_excise->getVariant(),
                'VariantsColor' => $this->Car_document_excise->getVariantColor(),
                //'entery_no' => $entry,
                'Model_no' => $this->Car_document_excise->getCarModel()
        );


        $this->load->view('header');
        $this->load->view('document_recieve_from_excise_edit', $data);
        $this->load->view('footer');
    }

    public function update() {

        $this->Car_document_excise->update();
        redirect(base_url() . "index.php/documentrecievefromexcise/view");
    }

    //////////////////////////////////////////////////////////////////////////////
}
