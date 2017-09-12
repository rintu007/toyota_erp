<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class S_reportjobs extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allSerivceOfJobs($job) {
        $this->db->select('*');
        $this->db->from('viewrodetail vr');
        $this->db->join('s_ro_mechrepairs m', 'm.idRepairOrderBill = vr.idRO', 'left');
        $this->db->join('s_jobreferencemanual j', 'j.idJobRef = m.idJobRefManual', 'left');
        $this->db->where('j.idJobRef', $job);
        $this->db->where('vr.CustomerOff ', 'Service Customer');
        $this->db->where('vr.isActive ', 1);
        $reportServices = $this->db->get();
        return $reportServices->result_array();
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
