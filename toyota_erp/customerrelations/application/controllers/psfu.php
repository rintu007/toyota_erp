<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Psfu extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registercomplaint');
    }

    public function index() {

        
        $this->load->view('crpanelheader');
        $this->load->view('psfu_view');
        $this->load->view('crpanelfooter');
    }


    

   

}
