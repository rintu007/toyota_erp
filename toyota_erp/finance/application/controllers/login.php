<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function logout() {
        $data = unserialize($_COOKIE['logindata']);
        $baseUrl = $data['Url'];
        unset($_COOKIE['logindata']);
        redirect($baseUrl);
    }

    public function index($msg = NULL) {
//        $data['msg'] = $msg;
//        $this->load->view('login_view', $data);
//        $this->load->view('footer');
    }

    public function process() {
//        $this->load->model('Login_model');;
//        $result = $this->Login_model->validate();
//        if (!$result) {
//            $msg = '<font color=red>Invalid username and/or password.</font><br />';
//            $this->index($msg);
//        } else {
//            // If user did validate, 
//            // Send them to members area
//            if ($this->session->userdata('Role') === "CRAdmin") {
//                redirect(base_url() . "index.php/psfuupdate/index");
//            } else {
//                redirect(base_url() . "index.php/bay/index");
//            }
//        }
    }

}
