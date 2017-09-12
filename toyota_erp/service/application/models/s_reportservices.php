<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_reportservices extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allServicesInDate($dateFrom, $dateTo) {

        $where = "vr.BookingDate BETWEEN '$dateFrom' AND '$dateTo' GROUP BY vr.idRO";
        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->where('vr.CustomerOff ', 'Service Customer');
        $this->db->where('vr.isActive ', 1);
        $reportServices = $this->db->get();
        return $reportServices->result_array();
    }

}
