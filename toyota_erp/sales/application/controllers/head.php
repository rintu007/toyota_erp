<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class head extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_heads');
        $this->load->library('form_validation');
    }

    public function index($id = '') {

        if ($id == '') {

            $data = array(
                'entery_no' => $this->Car_heads->getEnteryNo(),
                'saleperson' => $this->Car_heads->getSalePerson(),
                'location' => $this->Car_heads->getLocation(),
            );
            $this->load->view('header');
            $this->load->view('add_heads', $data);
            $this->load->view('footer');
        }  else {
            $data = array(
                'visit_plan' => $this->Car_heads->getOneVisitPlan($id),
                'visit_plan_detail' => $this->Car_heads->getVisitPlanDetail($id),
                'saleperson' => $this->Car_heads->getSalePerson(),
                'location' => $this->Car_heads->getLocation(),
            );
            $this->load->view('header');
            $this->load->view('edit_heads', $data);
            $this->load->view('footer');
        }
    }

    public function save() {
        $this->Car_heads->save();
        redirect(base_url() . "index.php/head");
    }
    
///////////
 public function Pds() {

        $data['visitplans'] = $this->Car_heads->getPds();
        $this->load->view('header');
        $this->load->view('view_heads', $data);
        $this->load->view('footer');
		//print_r($data['visitplans']);
    }
	////////////////////////
	     public function edit() {
        $this->Car_heads->edit();
        redirect(base_url() . "index.php/head/Pds");
		//print_r($_POST);
		
    }
}
