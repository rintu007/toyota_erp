<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/*
 * Author: Umar Akbar
 * Description: Login controller class
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Login_model');
    }

    public function logout() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $baseUrl = $cookieData['Url'];
        unset($_COOKIE['logindata']);
        redirect($baseUrl);
    }

    public function index($msg = NULL) {
//        $data['msg'] = $msg;
//        $this->load->view('login_view', $data);
//        $this->load->view('crpanelfooter');
    }

    public function process() {
//        $Login = new Login_model();
//        $result = $Login->validate();
//
//        if (!$result) {
//            $msg = '<font color=red>Invalid username and/or password.</font><br />';
//            $this->index($msg);
//        } else {
//            // If user did validate, 
//            // Send them to members area
//            redirect(base_url() . "index.php/crpanel/index");
//        }
    }

}
