<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_login extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('cookie');
    }

    public function validate() {
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $this->db->where('Username', $username);
        $this->db->where('Password', $password);
        $this->db->where('IsDeleted', 0);
        $query = $this->db->get('viewlogin');
        // Let's check if there are any results
        if ($query->num_rows == 1) {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                'userid' => $row->Id, 'username' => $row->Username, 'Dealer' => $row->DealerName, 'Code' => $row->DealerCode, 'isAdmin' => $row->IsAdmin, 'Role' => $row->RoleName, 'Url' => base_url() . "index.php/login/");
            $this->session->set_userdata($data);
            $this->input->set_cookie('logindata', serialize($data), time() + 3600);
            return true;
        }
        return false;
    }

}
