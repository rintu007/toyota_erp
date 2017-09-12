<?php

if (!defined('BASEPATH')) {
    exit('No direct script accessf allowed');
}
/* Author: Umar Akbar
 * Description: User Controller Class
 */

class AddUser extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_user');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['Users'] = $this->Car_user->allUser();
        $this->data['UserDepartment'] = $this->Car_user->fillUserDepartment();
        $this->data['UserRole'] = $this->Car_user->fillUserRole();
        $this->data['DealerShip'] = $this->Car_user->fillDealerShip();
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['usercreated'] = $this->session->flashdata('usercreated');

        $this->load->view('header');
        $this->load->view('adduser', $this->data);
        $this->load->view('footer');
    }

    function adduser() {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $userData = array(
                'FullName' => $this->input->post('fullname'), 'DepartmentId' => $this->input->post('userdepartment'),
                'RoleId' => $this->input->post('userrole'), 'Username' => $this->input->post('username'),
                'Password' => $this->input->post('password'), 'DateOfBirth' => $this->input->post('dob'),
                'ContactNumber' => $this->input->post('mobile_number'),
                'DealerShip' => $this->input->post('dealership')
            );
            $this->Car_user->insertUser($userData);
            $this->session->set_flashdata('usercreated', '<p>User Has Been Created!</p>');
            redirect(base_url() . "index.php/adduser/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('full_name', 'Full Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $userId = $this->input->post('user_id');
            $userData = array(
                'FullName' => $this->input->post('full_name'), 'DepartmentId' => $this->input->post('userdepartment'),
                'RoleId' => $this->input->post('userrole'), 'Username' => $this->input->post('user_name'),
                'Password' => $this->input->post('password'), 'Email' => $this->input->post('email'),
                'DateOfBirth' => $this->input->post('dob'), 'ContactNumber' => $this->input->post('mobile_number'),
                'DealerShip' => $this->input->post('dealership'));
            $this->Car_user->updateUser($userId, $userData);
            $this->session->set_flashdata('message', '<p>User Has Been Updated!</p>');
            redirect(base_url() . "index.php/adduser/index");
        }
    }

    function delete($IdUser) {
        $this->Car_user->deleteUser($IdUser);
        $this->session->set_flashdata('message', '<p>User Has Been Deactivated!</p>');
        redirect(base_url() . 'index.php/adduser/index');
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_user->oneUser($search);
        $CarUsers = json_encode($dataSearch);
        print_r($CarUsers);
    }

}
