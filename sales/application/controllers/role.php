<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */

class Role extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_role');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['Role'] = $this->Car_role->allRole();

        $this->load->view('header');
        $this->load->view('role', $this->data);
        $this->load->view('footer');
    }

    function newrole() {
        //validate form input
        $this->form_validation->set_rules('role_name', 'Full Name', 'required|xss_clean');

        if (isset($_POST['IsAdmin'])) {
            if ($this->form_validation->run() == TRUE) {
                $roleData = array(
                    'RoleName' => $this->input->post('role_name'),
                    'IsAdmin' => '1'
                );
                $this->Car_role->insertRole($roleData);
                redirect(base_url() . "index.php/role/index");
            }
        } else {
            if ($this->form_validation->run() == TRUE) {
                $roleData = array(
                    'RoleName' => $this->input->post('role_name'),
                    'IsAdmin' => '0'
                );
                $this->Car_role->insertRole($roleData);
                redirect(base_url() . "index.php/role/index");
            }
        }
    }

    // Old Function
//    function newrole() {
//        //validate form input
//        $this->form_validation->set_rules('role_name', 'Full Name', 'required|xss_clean');
//
//        if ($this->form_validation->run() == TRUE) {
//            $roleData = array(
//                'RoleName' => $this->input->post('role_name')
//            );
//            $this->Car_role->insertRole($roleData);
//
//            redirect(base_url() . "index.php/role/index");
//        }
//    }

    function update() {
        //validate form input
        $this->form_validation->set_rules('role_id', 'Role ID', 'required|xss_clean');
        $this->form_validation->set_rules('role_name', 'Role Name', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $RoleId = $this->input->post('role_id');
            $RoleName = $this->input->post('role_name');
            $this->Car_role->updateRole($RoleId, $RoleName);

            redirect(base_url() . "index.php/role/index");
        }
    }

}
