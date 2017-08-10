<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Route extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $Data = array();
        $Data['routeslist'] = $this->servicerouteslist();
        $Data['departments'] = $this->servicedepartmentlist();
        $Data['insertMessage'] = $this->session->flashdata('insertmessage');
        $Data['updateMessage'] = $this->session->flashdata('updatemessage');
        $this->load->view('crpanelheader');
        $this->load->view('route', $Data);
        $this->load->view('crpanelfooter');
    }

    public function addroutes() {

        $addroutes = new registercomplaint();
        $addroutess = $addroutes->addroute();
        $this->session->set_flashdata('insertmessage', '<h4>' . $addroutess . '</h4>');
        redirect(base_url() . "index.php/route/index");
    }

    public function updateroutes() {

        $updateroutes = new registercomplaint();
        $updateroutess = $updateroutes->updateroutes_();
        $this->session->set_flashdata('updatemessage', '<h4>' . $updateroutess . '</h4>');
        redirect(base_url() . "index.php/route/index");
    }

    public function servicerouteslist() {

        $routeslist = new registercomplaint();
        $routeslists = $routeslist->getrouteslist();
        return json_encode($routeslists->result_array);
    }

    public function servicedepartmentlist() {

        $departmentlist = new registercomplaint();
        $departmentlists = $departmentlist->getdepartmentlist();
        return json_encode($departmentlists->result_array);
    }

}
