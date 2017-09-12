<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Jorge Torres
 * Description: Login model class
 */

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
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
                'userid' => $row->Id, 'username' => $row->Username, 'isAdmin' => $row->IsAdmin, 'Dealer' => $row->DealerName, 'Code' => $row->DealerCode, 'Role' => $row->RoleName);
            $this->session->set_userdata($data);
            return true;
        }
        return false;
    }

}
