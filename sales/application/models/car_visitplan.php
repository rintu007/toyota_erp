<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_visitplan extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getEnteryNo() {
        $this->db->select_max('idvisitplan');
        $result = $this->db->get('visit_plan')->row_array();
        return ((int) $result['idvisitplan'] + 1 );
    }

    public function save() {

        $data_visitplan = array(
            'entery_no' => $this->input->post('entery_no'),
            'entery_date' => $this->input->post('entery_date'),
        );

        $this->db->insert('visit_plan', $data_visitplan);

        $idvisitplan = $this->db->insert_id();

        $sale_person = $this->input->post('sale_person');
        $location = $this->input->post('location');
        $visit_date = $this->input->post('visit_date');
        $day_of_visit = $this->input->post('day_of_visit');

        for ($i = 0; $i < count($sale_person); $i++) {

            $data_visitplandetail = array(
                'idvisitplan' => $idvisitplan,
                'idsaleman' => $sale_person[$i],
                'idlocation' => $location[$i],
                'visit_date' => $visit_date[$i],
                'day_of_visit' => $day_of_visit[$i]
            );

            $this->db->insert('visitPlan_detail', $data_visitplandetail);
        }
    }

    public function edit() {
        $data_visitplan = array(
            'entery_no' => $this->input->post('entery_no'),
            'entery_date' => $this->input->post('entery_date'),
        );
        $this->db->where('entery_no', $data_visitplan['entery_no']);
        $this->db->update('visit_plan', $data_visitplan);

        $this->db->where('idvisitplan', $this->input->post('idvisitplan'));
        $this->db->delete('visitplan_detail');

        $sale_person = $this->input->post('sale_person');
        $location = $this->input->post('location');
        $visit_date = $this->input->post('visit_date');
        $day_of_visit = $this->input->post('day_of_visit');

        for ($i = 0; $i < count($sale_person); $i++) {
            $data_visitplandetail = array(
                'idvisitplan' => $this->input->post('idvisitplan'),
                'idsaleman' => $sale_person[$i],
                'idlocation' => $location[$i],
                'visit_date' => $visit_date[$i],
                'day_of_visit' => $day_of_visit[$i]
            );
            $this->db->insert('visitPlan_detail', $data_visitplandetail);
        }
    }

    public function getVisitPlans() {
        $this->db->select("visit_plan.* , visitPlan_detail.* , car_user_profile.Fullname , car_location.Location");
        $this->db->join('visit_plan', 'visit_plan.idvisitplan =  visitPlan_detail.idvisitplan');
        $this->db->join('car_user_profile', 'car_user_profile.Id =  visitPlan_detail.idsaleman');
        $this->db->join('car_location', 'car_location.idLocation =  visitPlan_detail.idlocation');
        $this->db->order_by('visit_plan.entery_no', 'DESC');
        $result = $this->db->get('visitPlan_detail')->result_array();
        return $result;
    }

    public function getSalePerson() {
        $this->db->select("*");
        $result = $this->db->get('car_user_profile')->result_array();
        return $result;
    }

    public function getLocation() {
        $this->db->select("*");
        $result = $this->db->get('car_location')->result_array();
        return $result;
    }

    public function getOneVisitPlan($id) {
        $this->db->select("*");
        $this->db->where('idvisitplan', $id);
        $result = $this->db->get('visit_plan')->row_array();
        return $result;
    }

    public function getVisitPlanDetail($id) {
        $this->db->select("*");
        $this->db->where('idvisitplan', $id);
        $result = $this->db->get('visitPlan_detail')->result_array();
        return $result;
    }

}

?>