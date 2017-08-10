<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitplan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_visitplan');
        $this->load->library('form_validation');
    }

    public function index($id = '') {

        if ($id == '') {

            $data = array(
                'entery_no' => $this->Car_visitplan->getEnteryNo(),
                'saleperson' => $this->Car_visitplan->getSalePerson(),
                'location' => $this->Car_visitplan->getLocation(),
            );
            $this->load->view('header');
            $this->load->view('add_visit_plan', $data);
            $this->load->view('footer');
        } else {
            $data = array(
                'visit_plan' => $this->Car_visitplan->getOneVisitPlan($id),
                'visit_plan_detail' => $this->Car_visitplan->getVisitPlanDetail($id),
                'saleperson' => $this->Car_visitplan->getSalePerson(),
                'location' => $this->Car_visitplan->getLocation(),
            );
            $this->load->view('header');
            $this->load->view('edit_visit_plan', $data);
            $this->load->view('footer');
        }
    }

    public function save() {
        $this->Car_visitplan->save();
        redirect(base_url() . "index.php/visitplan");
    }
    
     public function edit() {
        $this->Car_visitplan->edit();
        redirect(base_url() . "index.php/visitplan/viewVisitPlan");
    }

    public function viewVisitPlan() {

        $data['visitplans'] = $this->Car_visitplan->getVisitPlans();
        $this->load->view('header');
        $this->load->view('view_visit_plan', $data);
        $this->load->view('footer');
    }

    public function addPostVisitPlan() {
        $this->load->view('header');
        $this->load->view('add_post_visit_plan');
        $this->load->view('footer');
    }

    public function viewPostVisitPlan() {
        $this->load->view('header');
        $this->load->view('view_post_visit_plan');
        $this->load->view('footer');
    }

}
