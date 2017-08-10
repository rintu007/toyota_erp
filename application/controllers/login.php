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
        $this->load->helper('cookie');
        $this->load->model('m_login');
    }

    public function index($msg = NULL) {
        $data['msg'] = $msg;
        $this->load->view('vlogin', $data);
        $this->load->view('footer');
    }

    public function menu() {
        $this->load->view('menu');
    }

    public function process() {
        $loginModel = new M_login();
        $result = $loginModel->validate();
        if (!$result) {
            $msg = '<font color=red>Invalid username and/or password.</font><br>';
            $this->index($msg);
        } else {
            // If user did validate, 
            // Send them to members area
            if ($this->session->userdata('Role') === "Admin" || $this->session->userdata('Role') === "FinanceAdmin" || $this->session->userdata('Role') === "CRAdmin" || $this->session->userdata('Role') === "Sales Admin" || $this->session->userdata('Role') === "Assistant") {
                redirect(base_url() . "index.php/login/menu");
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        redirect(base_url() . "index.php/login/index");
    }

}
