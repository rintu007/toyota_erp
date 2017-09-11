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
        $this->load->model('Car_documentdelivery');
        $this->load->model('Car_dispatch');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->doc = new car_documentreceive();
    }

    public function index()
    {
        $config['total_rows'] = $this->doc->count_all_imc();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);

        $data['documentdelivery'] = $this->doc->get_all_imc();
        $data['pagination']       = $this->pagination->create_links();
        $this->load->view('header');
        $this->load->view('document_delivery_view',$data);
        $this->load->view('footer');
    }
    public function document_from_imc_add()
    {
        $Data = array();
        $Data['docs'] = $this->doc->get_all_docs();
        $Data['dispatch'] = $this->doc->get_dist_dispatch();

        $this->load->view('header');
        $this->load->view('docucemntreceiveimc', $Data);
        $this->load->view('footer');
    }
    public function from_sales_request()
    {
        $Data = array();
        $Data['docs'] = $this->doc->get_all_docs();
        $Data['dispatch'] = $this->doc->get_all_req_filtered_dispatch();
        $this->load->view('header');
        $this->load->view('docucemntfromsales_request', $Data);
        $this->load->view('footer');
    }

    public function dispatch_request_view($idDispatch)
    {
        $Data = array();
        $Data['docs'] = $a =$this->doc->get_document_receive_from_sales($idDispatch);
        $Data['data'] = $this->doc->getRequestedDocument($Data['docs']->id);
//        var_dump($Data['data']);die;
//        $Data['dispatch'] = $this->Car_documentdelivery->get_dispatch_data($idDispatch);
        $Data['idDispatch'] = $idDispatch;
        $this->load->view('header');
        $this->load->view('docucemntfromsales_view_dispatch_request', $Data);
        $this->load->view('footer');
    }

    public function sales_request_update()
    {
//        var_dump($_POST);die;

        $this->doc->doc_sales_request_update();
        $this->session->set_flashdata('message', "Request Updated Successfully");
        redirect(site_url('index.php/documentreceive/from_sales_reponse/Sales'));

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
    public function getRequestedDocument()
    {
        $data = $this->doc->getRequestedDocument($_POST['idDispatch']);
        echo json_encode($data);


    }

    public function from_sales()
    {
        $Data = array();
        $Data['docs']       = $this->doc->get_all_docs();
//        $Data['dispatch']   = $this->doc->get_all_dispatch();
        $Data['documentRequests']   = $this->doc->get_all_doc_request();

        $this->load->view('header');
        $this->load->view('docucemntfromsales', $Data);
        $this->load->view('footer');
    }
    public function from_sales_reponse($type='')
    {
        $Data = array();
        $Data['data'] = $this->doc->get_doc_sales_request();

        $this->load->view('header');
        $this->load->view('docucemntfromsales_reponse', $Data);
        $this->load->view('footer');
    }

    function receive_dispatch($idDispatch)
    {
        $Data = array();
        $Data['docs'] = $a =$this->doc->get_document_receive_from_sales($idDispatch);
        $Data['data'] = $this->doc->getRequestedDocument($Data['docs']->id);
        $Data['idDispatch'] = $idDispatch;
        $this->load->view('header');
        $this->load->view('docucemntfromsales_dispatch_receive', $Data);
        $this->load->view('footer');

    }

    function receive_documents()
    {
        $this->doc->doc_receive_documents();
        $this->session->set_flashdata('message', "Request Updated Successfully");
        redirect(site_url('index.php/documentreceive/from_sales'));

    }



    public function sales_request_insert()
    {
        if($_POST)
        {
            $this->doc->doc_sales_request_insert();
            $this->session->set_flashdata('message', "Request Inserted Successfully");
            redirect(site_url('index.php/documentreceive/from_sales'));
        }
    }
    public function sales_request_response($id,$action)
    {

            $this->doc->doc_sales_request_response($id,$action);
            $this->session->set_flashdata('message', "Request Updated Successfully");
            redirect(site_url('index.php/documentreceive/from_sales_reponse'));

    }

    public function excise_registration()
    {
        $Data = array();
        $Data['data'] = $this->doc->get_doc_excise();

        $this->load->view('header');
        $this->load->view('document_excise_registration', $Data);
        $this->load->view('footer');
    }

    public function excise_registration_view($idDispatch)
    {
        $Data = array();
        $Data['docs'] = $a =$this->doc->get_document_receive_from_sales($idDispatch);
        $Data['documents']=$this->doc->get_all_docs();
        $Data['data'] = $this->doc->getRequestedDocument($Data['docs']->id);
        $res = array();
        foreach ( $Data['data'] as $row)
        {
            array_push($res,$row['iddocument']);
        }
        $Data['res'] = $res;
//        var_dump($res);die;
//        $Data['dispatch'] = $this->Car_documentdelivery->get_dispatch_data($idDispatch);
        $Data['idDispatch'] = $idDispatch;
        $this->load->view('header');
        $this->load->view('docucemnt_excise_registration_view', $Data);
        $this->load->view('footer');
    }

    public function excise_update()
    {
        $this->doc->update_excise();
        $this->session->set_flashdata('message', "Excise Registered Successfully");
        redirect(site_url('index.php/documentreceive/excise_registration'));
    }



}