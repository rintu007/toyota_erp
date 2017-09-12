<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_followup_status extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allFollowupStatus() {
        $this->db->select('Id', 'FollowupType', 'CreatedDate');
        $followupStatus = $this->db->get('car_followup_status');

        return $followupStatus->result_array();
    }

    function insertFollowupStatus($fsData) {
        $this->db->insert('car_followup_status', $fsData);
        $this->db->insert_id();
    }

    function updateFollowupStatus($fsID, $fsData) {
        $this->db->where('Id', $fsID);
        $this->db->update('car_followup_status', $fsData);
    }

    function deleteFollowupStatus($fsID) {
        $this->db->where('Id', $fsID);
        $this->db->delete('car_followup_status');
    }

}
