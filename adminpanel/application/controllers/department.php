<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_department');
        $this->load->library('form_validation');
    }

    public function index() {
        $modelDepartment = new M_department();
        $this->data['Department'] = $modelDepartment->allDepartment();

        $this->load->view('header');
        $this->load->view('v_department', $this->data);
        $this->load->view('footer');
    }

    function newdepartment() {
        $modelDepartment = new M_department();
        //validate form input
        $this->form_validation->set_rules('department_name', 'Department Name', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $departmentData = array(
                'Department' => $this->input->post('department_name'),
                'CreatedDate' => date('Y/m/d')
            );
            $modelDepartment->insertDepartment($departmentData);

            redirect(base_url() . "index.php/department/index");
        }
    }

    function update() {
        $modelDepartment = new M_department();
        //validate form input
        $this->form_validation->set_rules('department_id', 'Department ID', 'required|xss_clean');
        $this->form_validation->set_rules('department_name', 'Department Name', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $DepartmentId = $this->input->post('department_id');
            $DepartmentName = $this->input->post('department_name');
            $modelDepartment->updateDepartment($DepartmentId, $DepartmentName);

            redirect(base_url() . "index.php/department/index");
        }
    }

}
