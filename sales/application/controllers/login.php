<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
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
//        $this->load->view('footer');
    }

    public function process() {
        $this->load->model('Login_model');

        $result = $this->Login_model->validate();

        if (!$result) {
            $msg = '<font color=red>Invalid username and/or password.</font><br />';
            $this->index($msg);
        } else {
            // If user did validate,
            // Send them to members area
            if ($this->session->userdata('Role') == "Director") {
                redirect(base_url() . "index.php/pbo/index");
            } else {
                redirect(base_url() . "index.php/resourcebook/index");
            }
        }
    }

}
