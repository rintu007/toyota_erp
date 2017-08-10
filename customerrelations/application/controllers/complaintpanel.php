<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//if (!defined('BASEPATH')) {
//    exit('No direct script access allowed');
//}

class Complaintpanel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        $this->load->view('crpanelheader');
        $this->load->view('complaintpanel');
        $this->load->view('crpanelfooter');
    }

}
