<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AddUser extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_adduser');
        $this->load->library('form_validation');
    }

    public function index() {
        $modelAddUser = new M_adduser();
        $this->data['Users'] = $modelAddUser->allUser();
        $this->data['UserDepartment'] = $modelAddUser->fillUserDepartment();
        $this->data['UserRole'] = $modelAddUser->fillUserRole();
        $this->data['DealerShip'] = $modelAddUser->fillDealerShip();
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['usercreated'] = $this->session->flashdata('usercreated');

        $this->load->view('header');
        $this->load->view('v_adduser', $this->data);
        $this->load->view('footer');
    }

    function adduser() {
        $modelAddUser = new M_adduser();
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $userData = array(
                'FullName' => $this->input->post('fullname'),
                'DepartmentId' => $this->input->post('userdepartment'),
                'RoleId' => $this->input->post('userrole'),
                'Username' => $this->input->post('username'),
                'Password' => $this->input->post('password'),
                'Email' => $this->input->post('email'),
                'DateOfBirth' => $this->input->post('dob'),
                'ContactNumber' => $this->input->post('mobile_number'),
                'DealerShip' => $this->input->post('dealership'),
                'IsDeleted' => 0
            );
            $modelAddUser->insertUser($userData);
            $this->session->set_flashdata('usercreated', '<p>User Has Been Created!</p>');
            redirect(base_url() . "index.php/adduser/index");
        }
    }

    function update() {
        $modelAddUser = new M_adduser();
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $userId = $this->input->post('user_id');
            $userData = array(
                'FullName' => $this->input->post('full_name'), 'DepartmentId' => $this->input->post('userdepartment'),
                'RoleId' => $this->input->post('userrole'), 'Username' => $this->input->post('user_name'),
                'Password' => $this->input->post('password'), 'Email' => $this->input->post('email'),
                'DateOfBirth' => $this->input->post('dob'), 'ContactNumber' => $this->input->post('mobile_number'),
                'DealerShip' => $this->input->post('dealership'));
            $modelAddUser->updateUser($userId, $userData);
            $this->session->set_flashdata('message', '<p>User Has Been Updated!</p>');
            redirect(base_url() . "index.php/adduser/index");
        }
    }

    function delete($IdUser) {
        $modelAddUser = new M_adduser();
        $modelAddUser->deleteUser($IdUser);
        $this->session->set_flashdata('message', '<p>User Has Been Deactivated!</p>');
        redirect(base_url() . 'index.php/adduser/index');
    }

    function search() {
        $modelAddUser = new M_adduser();
        $search = $this->input->post('search');
        $dataSearch = $modelAddUser->oneUser($search);
        $CarUsers = json_encode($dataSearch);
        print_r($CarUsers);
    }

}
