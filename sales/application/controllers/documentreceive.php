<?php
/**
 * Created by PhpStorm.
 * User: Shah Saqib
 * Date: 8/30/2017
 * Time: 11:47 AM
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Documentreceive extends CI_Controller
{
    private $doc;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Car_resource_book');
        $this->load->model('car_documentreceive');
        $this->load->model('Car_dispatch');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->doc = new car_documentreceive();
    }

    public function index()
    {
        $Data = array();
        $Data['docs'] = $this->doc->get_all_docs();
        $Data['dispatch'] = $this->doc->get_all_dispatch();

        $this->load->view('header');
        $this->load->view('docucemntreceiveimc', $Data);
        $this->load->view('footer');
    }

    public function receive_from_imc()
    {
        $data = $this->doc->receive();
        if($data)
        {
            $this->session->set_flashdata('message', "Documents received");
        }
        else
        {
            $this->session->set_flashdata('message', "Failed to  receive");
        }


        redirect(site_url('index.php/documentreceive/index'));
    }

    public function getDocumentreceive()
    {
        $data = $this->doc->getDocumentreceive($_POST['idDispatch']);
        echo json_encode($data);


    }


}