<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_dealer extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allDealers() {
        $variants = $this->db->select('*')->from('car_sub_dealer')->
                join('car_dealer_type', 'car_sub_dealer.DealerType = car_dealer_type.IdDealer')->
                join('car_limit_type', 'car_sub_dealer.VendorLimitType = car_limit_type.IdLimit')->
                get();
        return $variants->result_array();
    }

    function searchDealer($keyword) {
        $variants = $this->db->select('*')->from('car_sub_dealer')->
                        join('car_dealer_type', 'car_sub_dealer.DealerType = car_dealer_type.IdDealer')->
                        join('car_limit_type', 'car_sub_dealer.VendorLimitType = car_limit_type.IdLimit')->
                        like('car_sub_dealer.Name', $keyword)->get();
        return $variants->result();
    }

    function insertDealer($DealerData) {
        $this->db->insert('car_sub_dealer', $DealerData);
        $this->db->insert_id();
    }

    function updateDealer($IdDealer, $DealerData) {
        $this->db->where('IdSubDealer', $IdDealer);
        $this->db->update('car_sub_dealer', $DealerData);
    }

    function deleteDealer($IdDealer) {
        $this->db->where('IdSubDealer', $IdDealer);
        $this->db->delete('car_sub_dealer');
    }

    function fillDealerType() {
        $query = $this->db->query('select distinct IdDealer, TypeName from car_dealer_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdDealer, "DealerType" => $dropdown->TypeName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillLimitType() {
        $query = $this->db->query('select IdLimit, LimitType from car_limit_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["IdLimit" => $dropdown->IdLimit, "LimitType" => $dropdown->LimitType]);
        }
        return $dropDownList;
    }

}
