<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitplanpost extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_visitplanpost');
        $this->load->library('form_validation');
    }

    public function index($id = '') {

        if ($id == '') {
            $data = array(
                'entery_no' => $this->Car_visitplanpost->getEnteryNo(),
                'customername' => $this->Car_visitplanpost->getSalePersonCustomerName()
            );
//            print_r($data);

            $this->load->view('header');
            $this->load->view('add_post_visit_plan', $data);
            $this->load->view('footer');
        } else {

            $data_visit = array(
                'enter_no' => $id,
                'postplandetail' => $this->Car_visitplanpost->getOneVisitPost($id),
                'customername' => $this->Car_visitplanpost->getSalePersonCustomerName()
            );
            $this->load->view('header');
            $this->load->view('edit_visit_post', $data_visit);
            $this->load->view('footer');
        }
    }

    public function save() {
        $this->Car_visitplanpost->save();
        redirect(base_url() . "index.php/visitplanpost");
    }

    public function edit() {
        $this->Car_visitplanpost->edit();
        redirect(base_url() . "index.php/visitplanpost");
    }

    public function addPostVisit() {
        $data = array(
            'entery_no' => $this->Car_visitplanpost->getallEntry(),
            'customername' => $this->Car_visitplanpost->getSalePersonCustomerName()
        );
        $this->load->view('header');
        $this->load->view('add_post_visit_plan', $data);
        $this->load->view('footer');
    }

    public function viewPostVisit() {
        $data['visit_post'] = $this->Car_visitplanpost->getVisitPosts();
        $this->load->view('header');
        $this->load->view('view_post_visit_plan', $data);
        $this->load->view('footer');
    }

    public function serviceexistingcustomer() {

        $getapproless =  $this->Car_visitplanpost->getexistingcustomer();
        echo json_encode($getapproless);
    }

}
