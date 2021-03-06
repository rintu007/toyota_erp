<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_resource_book extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allRbNoPbo($UserId, $UserRole) {
        if ($UserRole == 'Director' || $UserRole == 'Admin' || $UserRole == 'Sales Admin') {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'left outer');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'left outer');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'left outer');
            $this->db->where('isPboCreated', 0);
            $this->db->where('IsLost', 0);
        } else {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'left outer');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'left outer');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'left outer');
            $this->db->where('isPboCreated', 0);
            $this->db->where('IsLost', 0);
            $this->db->where('car_resource_book.SalesmanId', $UserId);
        }
        $resourceBook = $this->db->get();
        return $resourceBook->result_array();
    }

    function allRbWithPbo($UserId, $UserRole) {
        if ($UserRole == 'Director' || $UserRole == 'Admin' || $UserRole == 'Sales Admin') {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'left outer');
            $this->db->join('car_pbo', 'car_pbo.ResourcebookId = car_resource_book.IdResourceBook', 'left outer');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'left outer');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'left outer');
            $this->db->where('isPboCreated', 1);
            $this->db->where('IsLost', 0);
        } else {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'left outer');
            $this->db->join('car_pbo', 'car_pbo.ResourcebookId = car_resource_book.IdResourceBook', 'left outer');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'left outer');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'left outer');
            $this->db->where('isPboCreated', 1);
            $this->db->where('IsLost', 0);
            $this->db->where('car_resource_book.SalesmanId', $UserId);
        }
        $resourceBook = $this->db->get();
        return $resourceBook->result_array();
    }

    public function record_count($UserId) {
        if ($UserId == 2) {
            return $this->db->count_all("car_resource_book");
        } else {
            $this->db->where('car_resource_book.SalesmanId', $UserId);
            return $this->db->count_all("car_resource_book");
        }
    }

    public function fetch_rb($UserId, $limit, $start) {
        if ($UserId == 2) {
            $this->db->select('*');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'left outer');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'left outer');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'left outer');
            $this->db->where('IsLost', 0);
            $this->db->limit($limit, $start);
            $query = $this->db->get("car_resource_book");
        } else {
            $this->db->select('*');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'left outer');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'left outer');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'left outer');
            $this->db->where('IsLost', 0);
            $this->db->where('car_resource_book.SalesmanId', $UserId);
            $this->db->limit($limit, $start);
            $query = $this->db->get("car_resource_book");
        }
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function allResourceBook($UserId, $UserRole = null) {
        if ($UserId == 2) {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'LEFT OUTER');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'LEFT OUTER');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'LEFT OUTER');
            $this->db->join('car_user_profile', 'car_resource_book.SalesmanId = car_user_profile.Id', 'LEFT OUTER');
            $this->db->where('IsLost', 0);
            $resourceBook = $this->db->get();
            return $resourceBook->result_array();
        } else if ($UserRole == 'Director' || $UserRole == 'Sales Admin') {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'LEFT OUTER');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'LEFT OUTER');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'LEFT OUTER');
            $this->db->join('car_user_profile', 'car_resource_book.SalesmanId = car_user_profile.Id', 'LEFT OUTER');
            $this->db->where('IsLost', 0);
            $resourceBook = $this->db->get();
            return $resourceBook->result_array();
        } else {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'LEFT OUTER');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'LEFT OUTER');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'LEFT OUTER');
            $this->db->join('car_user_profile', 'car_resource_book.SalesmanId = car_user_profile.Id', 'LEFT OUTER');
            $this->db->where('IsLost', 0);
            $this->db->where('car_resource_book.SalesmanId', $UserId);
            $resourceBook = $this->db->get();
            return $resourceBook->result_array();
        }
    }

    function oneResourceBook($ResourceBookId) {
        $this->db->select('*');
        $this->db->from('car_resource_book');
        $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer', 'LEFT OUTER');
        $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor', 'LEFT OUTER');
        $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants', 'LEFT OUTER');
        $this->db->join('car_followup_status', 'car_resource_book.FollowupStatus = car_followup_status.Id', 'LEFT OUTER');
        $this->db->join('car_customer_type', 'car_resource_book.CustomerTypeId = car_customer_type.Id', 'LEFT OUTER');
        $this->db->join('car_customer_status', 'car_resource_book.CustomerStatus = car_customer_status.Id', 'LEFT OUTER');
        $this->db->join('car_mode_payment', 'car_resource_book.PaymentMode = car_mode_payment.Id', 'LEFT OUTER');
        $this->db->join('car_model', 'car_resource_book.idModel = car_model.IdModel', 'LEFT OUTER');
        $this->db->where('IdResourceBook', $ResourceBookId);
        $oneRb = $this->db->get();
        return $oneRb->row_array();
    }

    function insertResourceBook($customerData, $rbData) {

        $this->db->trans_start();
        $cookieData = unserialize($_COOKIE['logindata']);
        $Role = $cookieData['Role'];
        if ($Role == 'Admin' || $Role == 'Sales Admin') {
            $CustomerId = $this->input->post('customer_id');
            $UserId = $cookieData['userid'];
            $Model = $this->input->post('model');
            $Financier = $this->input->post('financer');
            $variant = $this->input->post('vehicle_interst');
            $DeliveryMonth = $this->input->post('delivery_month');
            $FollowUp = $this->input->post('follow_up');
            $Color1 = $this->input->post('color_choice_one');
            $ActualSalesMan = $this->input->post('actual_salesman');
            $AllotedSalesMan = $this->input->post('alloted_salesman');
            if ($ActualSalesMan == "Select Sales Man") {
                $ActualSalesMan = $cookieData['userid'];
            }
            if ($AllotedSalesMan == "Select Sales Man") {
                $AllotedSalesMan = $cookieData['userid'];
            }
            if ($Financier == "Select Bank") {
                $Financier = null;
            }
            if ($Model == "Select Model") {
                $Model = null;
            }
            if ($variant == "Select Variant") {
                $variant = null;
                $FollowUp = null;
                $Color1 = null;
                $Color2 = null;
            }
            if ($FollowUp == "Select Followup") {
                $FollowUp = null;
            }
            if ($Color1 == "Select Color") {
                $Color1 = null;
            }
            if ($DeliveryMonth == "Select Delivery Month") {
                $DeliveryMonth = null;
            }
            $Payment = $this->input->post('payment_mode');
            if ($Payment == "Select PaymentMode") {
                $Payment = null;
            }
            $CustomerStatus = $this->input->post('customer_status');
            if ($CustomerStatus == 3) {
                $CustomerStatus = null;
            } else if ($CustomerStatus == "Select Customer Status") {
                $CustomerStatus = null;
            }

            $LeadBy = $this->input->post('lead');
            if ($LeadBy == "Select Lead") {
                $LeadBy = NULL;
            }

            if ($CustomerId == "Select Customer") {
                $this->db->insert('car_customer', $customerData);
                $insert_id = $this->db->insert_id();
                $rbData = array(
                    'Date' => $this->input->post('date'),
                    'CustomerId' => $insert_id,
                    'CustomerTypeId' => $this->input->post('customertype'),
                    'ContactTypeId' => $this->input->post('contact_type'),
                    'idModel' => $Model,
                    'VehicleInterested' => $variant,
                    'PaymentMode' => $Payment,
                    'CustomerStatus' => $CustomerStatus,
                    'FollowupStatus' => $FollowUp,
                    'Remarks' => $this->input->post('remarks'),
                    'DeliveryMonth' => $DeliveryMonth,
                    'DeliveryYear' => $this->input->post('delivery_year'),
                    'TimeConsumed' => $this->input->post('time_consumed'),
                    'AdditionalNote' => $this->input->post('additional_note'),
                    'FinancerId' => $Financier,
                    'Color1' => $Color1,
                    'Color2' => $Color2,
                    'LeadBy' => $LeadBy,
                    'IsLost' => 0,
                    'SalesmanId' => $AllotedSalesMan,
                    'ActualSalesman' => $ActualSalesMan);
                $this->db->insert('car_resource_book', $rbData);
            } else {
                $this->db->where('IdCustomer', $CustomerId);
                $this->db->update('car_customer', $customerData);
                $rbData = array(
                    'Date' => $this->input->post('date'),
                    'CustomerId' => $CustomerId,
                    'CustomerTypeId' => $this->input->post('customertype'),
                    'ContactTypeId' => $this->input->post('contact_type'),
                    'idModel' => $Model,
                    'VehicleInterested' => $variant,
                    'PaymentMode' => $Payment,
                    'CustomerStatus' => $CustomerStatus,
                    'FollowupStatus' => $FollowUp,
                    'Remarks' => $this->input->post('remarks'),
                    'DeliveryMonth' => $DeliveryMonth,
                    'DeliveryYear' => $this->input->post('delivery_year'),
                    'TimeConsumed' => $this->input->post('time_consumed'),
                    'AdditionalNote' => $this->input->post('additional_note'),
                    'FinancerId' => $Financier,
                    'Color1' => $Color1,
                    'Color2' => null,
                    'LeadBy' => $LeadBy,
                    'IsLost' => 0,
                    'SalesmanId' => $AllotedSalesMan,
                    'ActualSalesman' => $ActualSalesMan);
                $this->db->insert('car_resource_book', $rbData);
            }

            $LastIdRb = $this->db->insert_id();
            $AccessoriesData = array();
            $accessory = $this->input->post('accessories');
            $count = count($this->input->post('accessories'));
            for ($i = 0; $i < $count; $i++) {
                $AccessoriesData[] = array(
                    'ResourcebookId' => $LastIdRb, 'CreatedDate' => date("Y/m/d"), 'AccessoryId' => $accessory[$i]);
            }
            if ($accessory != "") {
                $this->db->insert_batch('car_accessories_resourcebook', $AccessoriesData);
            }

            $followupday = $this->input->post('follow_up');
            if ($followupday == 2) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+1 days")));
            } else if ($followupday == 3) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+2 days")));
            } else if ($followupday == 4) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+3 days")));
            } else if ($followupday == 5) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+4 days")));
            } else if ($followupday == 6) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+5 days")));
            } else if ($followupday == 7) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+6 days")));
            } else if ($followupday == 8) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+7 days")));
            } else if ($followupday == 9) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+8 days")));
            } else if ($followupday == 10) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+9 days")));
            } else if ($followupday == 11) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+10 days")));
            } else if ($followupday == 12) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+11 days")));
            } else if ($followupday == 13) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+12 days")));
            } else if ($followupday == 14) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+13 days")));
            } else if ($followupday == 15) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+14 days")));
            } else if ($followupday == 16) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+15 days")));
            } else if ($followupday == 17) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+16 days")));
            } else if ($followupday == 18) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+17 days")));
            } else if ($followupday == 19) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+18 days")));
            } else if ($followupday == 20) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+19 days")));
            } else if ($followupday == 21) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+20 days")));
            } else if ($followupday == 22) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+21 days")));
            } else if ($followupday == 23) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+22 days")));
            } else if ($followupday == 24) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+23 days")));
            } else if ($followupday == 25) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+24 days")));
            } else if ($followupday == 26) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+25 days")));
            } else if ($followupday == 27) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+26 days")));
            } else if ($followupday == 28) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+27 days")));
            } else if ($followupday == 29) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+28 days")));
            } else if ($followupday == 30) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+29 days")));
            } else if ($followupday == 31) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+30 days")));
            } else {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"), 'followup_date' => '');
            }
            $this->db->insert('car_customer_followup', $FollowUpData);
        } else {
            $CustomerId = $this->input->post('customer_id');
            $UserId = $cookieData['userid'];
            $Model = $this->input->post('model');
            $Financier = $this->input->post('financer');
            $variant = $this->input->post('vehicle_interst');
            $DeliveryMonth = $this->input->post('delivery_month');
            $FollowUp = $this->input->post('follow_up');
            $Color1 = $this->input->post('color_choice_one');
            $ActualSalesMan = $this->input->post('salesman');
            $AllotedSalesMan = $this->input->post('a_salesman');
            if ($Financier == "Select Bank") {
                $Financier = null;
            }
            if ($Model == "Select Model") {
                $Model = null;
            }
            if ($variant == "Select Variant") {
                $variant = null;
                $FollowUp = null;
                $Color1 = null;
                $Color2 = null;
            }
            if ($FollowUp == "Select Followup") {
                $FollowUp = null;
            }
            if ($Color1 == "Select Color") {
                $Color1 = null;
            }
            if ($DeliveryMonth == "Select Delivery Month") {
                $DeliveryMonth = null;
            }
            $Payment = $this->input->post('payment_mode');
            if ($Payment == "Select PaymentMode") {
                $Payment = null;
            }
            $CustomerStatus = $this->input->post('customer_status');
            if ($CustomerStatus == 3) {
                $CustomerStatus = null;
            } else if ($CustomerStatus == "Select Customer Status") {
                $CustomerStatus = null;
            }

            if ($CustomerId == "Select Customer") {
                $this->db->insert('car_customer', $customerData);
                $insert_id = $this->db->insert_id();
                $rbData = array(
                    'Date' => $this->input->post('date'),
                    'CustomerId' => $insert_id,
                    'CustomerTypeId' => $this->input->post('customertype'),
                    'ContactTypeId' => $this->input->post('contact_type'),
                    'idModel' => $Model,
                    'VehicleInterested' => $variant,
                    'PaymentMode' => $Payment,
                    'CustomerStatus' => $CustomerStatus,
                    'FollowupStatus' => $FollowUp,
                    'Remarks' => $this->input->post('remarks'),
                    'DeliveryMonth' => $DeliveryMonth,
                    'DeliveryYear' => $this->input->post('delivery_year'),
                    'TimeConsumed' => $this->input->post('time_consumed'),
                    'AdditionalNote' => $this->input->post('additional_note'),
                    'FinancerId' => $Financier,
                    'Color1' => $Color1,
                    'Color2' => $Color2,
                    'LeadBy' => $LeadBy,
                    'IsLost' => 0,
                    'SalesmanId' => $cookieData['userid'],
                    'ActualSalesman' => $cookieData['userid']);
                $this->db->insert('car_resource_book', $rbData);
            } else {
                $this->db->where('IdCustomer', $CustomerId);
                $this->db->update('car_customer', $customerData);
                $rbData = array(
                    'Date' => $this->input->post('date'),
                    'CustomerId' => $CustomerId,
                    'CustomerTypeId' => $this->input->post('customertype'),
                    'ContactTypeId' => $this->input->post('contact_type'),
                    'idModel' => $Model,
                    'VehicleInterested' => $variant,
                    'PaymentMode' => $Payment,
                    'CustomerStatus' => $CustomerStatus,
                    'FollowupStatus' => $FollowUp,
                    'Remarks' => $this->input->post('remarks'),
                    'DeliveryMonth' => $DeliveryMonth,
                    'DeliveryYear' => $this->input->post('delivery_year'),
                    'TimeConsumed' => $this->input->post('time_consumed'),
                    'AdditionalNote' => $this->input->post('additional_note'),
                    'FinancerId' => $Financier,
                    'Color1' => $Color1,
                    'Color2' => null,
                    'LeadBy' => $LeadBy,
                    'IsLost' => 0,
                    'SalesmanId' => $cookieData['userid'],
                    'ActualSalesman' => $cookieData['userid']);
                $this->db->insert('car_resource_book', $rbData);
            }

            $LastIdRb = $this->db->insert_id();
            $AccessoriesData = array();
            $accessory = $this->input->post('accessories');
            $count = count($this->input->post('accessories'));
            for ($i = 0; $i < $count; $i++) {
                $AccessoriesData[] = array(
                    'ResourcebookId' => $LastIdRb, 'CreatedDate' => date("Y/m/d"), 'AccessoryId' => $accessory[$i]);
            }
            if ($accessory != "") {
                $this->db->insert_batch('car_accessories_resourcebook', $AccessoriesData);
            }

            $followupday = $this->input->post('follow_up');
            if ($followupday == 2) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+1 days")));
            } else if ($followupday == 3) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+2 days")));
            } else if ($followupday == 4) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+3 days")));
            } else if ($followupday == 5) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+4 days")));
            } else if ($followupday == 6) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+5 days")));
            } else if ($followupday == 7) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+6 days")));
            } else if ($followupday == 8) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+7 days")));
            } else if ($followupday == 9) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+8 days")));
            } else if ($followupday == 10) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+9 days")));
            } else if ($followupday == 11) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+10 days")));
            } else if ($followupday == 12) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+11 days")));
            } else if ($followupday == 13) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+12 days")));
            } else if ($followupday == 14) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+13 days")));
            } else if ($followupday == 15) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+14 days")));
            } else if ($followupday == 16) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+15 days")));
            } else if ($followupday == 17) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+16 days")));
            } else if ($followupday == 18) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+17 days")));
            } else if ($followupday == 19) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+18 days")));
            } else if ($followupday == 20) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+19 days")));
            } else if ($followupday == 21) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+20 days")));
            } else if ($followupday == 22) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+21 days")));
            } else if ($followupday == 23) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+22 days")));
            } else if ($followupday == 24) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+23 days")));
            } else if ($followupday == 25) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+24 days")));
            } else if ($followupday == 26) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+25 days")));
            } else if ($followupday == 27) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+26 days")));
            } else if ($followupday == 28) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+27 days")));
            } else if ($followupday == 29) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+28 days")));
            } else if ($followupday == 30) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+29 days")));
            } else if ($followupday == 31) {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"),
                    'followup_date' => date("Y/m/d", strtotime("+30 days")));
            } else {
                $FollowUpData = array(
                    'resource_bookId' => $LastIdRb, 'current_date' => date("Y/m/d"), 'followup_date' => '');
            }
            $this->db->insert('car_customer_followup', $FollowUpData);
        }
        $this->db->trans_complete();
        return $LastIdRb;
    }

    function updateResourceBook($rbID, $customerID, $rbData, $customerData) {
        $this->db->trans_start();
        $this->db->where('IdCustomer', $customerID);
        $this->db->update('car_customer', $customerData);
        $this->db->where('IdResourceBook', $rbID);
        $this->db->update('car_resource_book', $rbData);
//        $AccessoriesData = array();
//        $accessory = $this->input->post('accessories');
//        $count = count($this->input->post('accessories'));
//        for ($i = 0; $i < $count; $i++) {
//            $AccessoriesData[] = array(
//                'ResourcebookId' => $rbID, 'CreatedDate' => date("Y/m/d"), 'AccessoryId' => $accessory[$i]);
//        }
//        $this->db->where('ResourcebookId', $rbID);
//        $this->db->delete('car_accessories_resourcebook');
//        $this->db->insert_batch('car_accessories_resourcebook', $AccessoriesData);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "rollback";
        } else {
            $this->db->trans_commit();
        }
        $this->db->trans_complete();
    }

    function deleteResourceBook($rbID) {
        $this->db->where('IdResourceBook', $rbID);
        $this->db->delete('car_resource_book');
    }

    function updateCustomerFollowUp($followupID) {
        $this->db->where('id', $followupID);
        $this->db->set('attended', 1);
        $this->db->update('car_customer_followup');
    }

    function searchResourceBook($keyword, $UserId, $UserRole) {
        if ($UserId == 2 || $UserRole == 'Sales Admin' || $UserRole == 'Director') {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested= car_variants.IdVariants');
            $this->db->like('Cnic', $keyword);
            $this->db->or_like('CustomerName', $keyword);
            $this->db->or_like('Ntn', $keyword);
            $this->db->where('IsLost', 0);
        } else {
            $this->db->select('*');
            $this->db->from('car_resource_book');
            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer');
            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor');
            $this->db->join('car_variants', 'car_resource_book.VehicleInterested= car_variants.IdVariants');
            $this->db->like('Cnic', $keyword);
            $this->db->or_like('CustomerName', $keyword);
            $this->db->or_like('Ntn', $keyword);
            $this->db->where('car_resource_book.SalesmanId', $UserId);
            $this->db->where('IsLost', 0);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function searchRBwithPbo($keyword, $UserId, $UserRole) {
        if ($UserId == 2 || $UserRole == 'Sales Admin' || $UserRole == 'Director') {
            $Query = $this->db->query('SELECT * FROM car_resource_book
                        LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                        LEFT OUTER JOIN car_pbo ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
                        LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                        LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                        LEFT OUTER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                        WHERE
                        car_resource_book.isPboCreated = 1 AND car_resource_book.IsLost = 0
                        AND car_customer.CustomerName LIKE "%' . $keyword . '%"');
        } else {
//            $this->db->select('*');
//            $this->db->from('car_resource_book');
//            $this->db->join('car_pbo', 'car_pbo.ResourcebookId = car_resource_book.IdResourceBook', 'left outer');
//            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer');
//            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor');
//            $this->db->join('car_variants', 'car_resource_book.VehicleInterested= car_variants.IdVariants');
//            $this->db->where('isPboCreated', 1);
//            $this->db->where('IsLost', 0);
//            $this->db->where('car_resource_book.SalesmanId', $UserId);
//            $this->db->like('CustomerName', $keyword);
            $Query = $this->db->query('SELECT * FROM car_resource_book
                        LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                        LEFT OUTER JOIN car_pbo ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
                        LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                        LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                        LEFT OUTER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                        WHERE
                        car_resource_book.isPboCreated = 1 AND car_resource_book.IsLost = 0
                        AND car_customer.CustomerName LIKE "%' . $keyword . '%" AND car_resource_book.SalesmanId = ' . $UserId);
        }
//        $query = $this->db->get();
        return $Query->result_array();
    }

    function searchRBnoPbo($keyword, $UserId, $UserRole) {
        if ($UserId == 2 || $UserRole == 'Sales Admin' || $UserRole == 'Director') {

            $Query = $this->db->query('SELECT * FROM car_resource_book
            LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
            LEFT OUTER JOIN car_pbo ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
            LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
            LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
            LEFT OUTER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
            WHERE
            car_resource_book.isPboCreated = 0 AND car_resource_book.IsLost = 0
            AND car_customer.CustomerName LIKE "%' . $keyword . '%"');
//            $this->db->select('*');
//            $this->db->from('car_resource_book');
//            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer');
//            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor');
//            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants');
//            $this->db->where('isPboCreated', 0);
//            $this->db->where('IsLost', 0);
//            $this->db->like('Cnic', $keyword);
//            $this->db->or_like('CustomerName', $keyword);
//            $this->db->or_like('Ntn', $keyword);
        } else {
            $Query = $this->db->query('SELECT * FROM car_resource_book
            LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
            LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor AND car_resource_book.Color2 = car_color.IdColor
            LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
            WHERE
            car_resource_book.isPboCreated = 0 AND car_resource_book.IsLost = 0
            AND car_customer.CustomerName LIKE "%' . $keyword . '%" OR car_customer.Cnic LIKE "%' . $keyword . '%" AND car_resource_book.SalesmanId = ' . $UserId);
//            $this->db->select('*');
//            $this->db->from('car_resource_book');
//            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer');
//            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor');
//            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants');
//            $this->db->where('isPboCreated', 0);
//            $this->db->where('IsLost', 0);
//            $this->db->like('Cnic', $keyword);
//            $this->db->or_like('CustomerName', $keyword);
//            $this->db->or_like('Ntn', $keyword);
//            $this->db->where('car_resource_book.SalesmanId', $UserId);
        }
//        $query = $this->db->get();
        return $Query->result_array();
    }

    function searchRB($keyword, $UserId, $UserRole) {
        if ($UserId == 2 || $UserRole == 'Sales Admin' || $UserRole == 'Director') {

            $Query = $this->db->query('SELECT * FROM car_resource_book
            LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
            LEFT OUTER JOIN car_pbo ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
            LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
            LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
            LEFT OUTER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
            WHERE car_resource_book.IsLost = 0
            AND car_customer.CustomerName LIKE "%' . $keyword . '%"');
//            $this->db->select('*');
//            $this->db->from('car_resource_book');
//            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer');
//            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor');
//            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants');
//            $this->db->where('isPboCreated', 0);
//            $this->db->where('IsLost', 0);
//            $this->db->like('Cnic', $keyword);
//            $this->db->or_like('CustomerName', $keyword);
//            $this->db->or_like('Ntn', $keyword);
        } else {
            $Query = $this->db->query('SELECT * FROM car_resource_book
            LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
            LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor AND car_resource_book.Color2 = car_color.IdColor
            LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
            WHERE car_resource_book.IsLost = 0
            AND car_customer.CustomerName LIKE "%' . $keyword . '%" OR car_customer.Cnic LIKE "%' . $keyword . '%" AND car_resource_book.SalesmanId = ' . $UserId);
//            $this->db->select('*');
//            $this->db->from('car_resource_book');
//            $this->db->join('car_customer', 'car_resource_book.CustomerId = car_customer.IdCustomer');
//            $this->db->join('car_color', 'car_resource_book.Color1 = car_color.IdColor');
//            $this->db->join('car_variants', 'car_resource_book.VehicleInterested = car_variants.IdVariants');
//            $this->db->where('isPboCreated', 0);
//            $this->db->where('IsLost', 0);
//            $this->db->like('Cnic', $keyword);
//            $this->db->or_like('CustomerName', $keyword);
//            $this->db->or_like('Ntn', $keyword);
//            $this->db->where('car_resource_book.SalesmanId', $UserId);
        }
//        $query = $this->db->get();
        return $Query->result_array();
    }

    function customerFollowUp() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $query = $this->db->query("SELECT car_customer_followup.id, car_customer.CustomerName, car_variants.Variants,
                            car_color.ColorName, car_customer_followup.followup_date, car_customer_followup.attended AS Attended
                            FROM car_customer_followup INNER JOIN car_resource_book ON car_customer_followup.resource_bookId = car_resource_book.IdResourceBook
                            INNER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                            INNER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                            INNER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                            INNER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                            WHERE car_customer_followup.attended = 0 AND car_customer_followup.followup_date <= CURDATE() AND
                            car_resource_book.SalesmanId = {$cookieData['userid']}");
        return $query->result_array();
    }

    function rbfillColorCombo() {
        $query = $this->db->query('select distinct IdColor, ColorName from car_color');
        $colorCombo = $query->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            $dropDownList[$dropdown->IdColor] = $dropdown->ColorName;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function pboColorCombo($idVariant) {
        $query = $this->db->query('SELECT car_variants.Variants, car_color.ColorName,
            car_color.IdColor, car_variants.IdVariants FROM car_variants_color
            INNER JOIN car_variants ON car_variants_color.VariantId = car_variants.IdVariants
            INNER JOIN car_color ON car_variants_color.ColorId = car_color.IdColor
            WHERE car_variants.IdVariants = ' . $idVariant);
        $colorCombo = $query->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            $dropDownList[$dropdown->IdColor] = $dropdown->ColorName;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function rbfillCustomerTypeCombo() {
        $query = $this->db->query('select distinct Id, CustomerType from car_customer_type');
        $dropdowns = $query->result();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->Id] = $dropdown->CustomerType;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function rbfillCustomerStatusCombo() {
        $query = $this->db->query('select distinct Id, StatusType from car_customer_status');
        $dropdowns = $query->result();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->Id] = $dropdown->StatusType;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function rbfillVariantsCombo() {
        $query = $this->db->query('select distinct IdVariants, Variants from car_variants');
        $dropdowns = $query->result();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->IdVariants] = $dropdown->Variants;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function rbfillContactTypeCombo() {
        $query = $this->db->query('select distinct Id, ContactType from car_contact_type');
        $dropdowns = $query->result();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->Id] = $dropdown->ContactType;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function rbfillPaymentTypeCombo() {
        $query = $this->db->query('select distinct Id, PaymentType from car_mode_payment');
        $dropdowns = $query->result();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->Id] = $dropdown->PaymentType;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function rbfillModelCombo() {
        $query = $this->db->query('select distinct IdModel, Model from car_model');
        $dropdowns = $query->result();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->IdModel] = $dropdown->Model;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function rbfillFollowUpCombo() {
        $query = $this->db->query('select distinct Id, FollowupType from car_followup_status');
        $dropdowns = $query->result();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->Id] = $dropdown->FollowupType;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function CustomerDetails($CustomerId) {
        $CustomerDetails = $this->db->query('SELECT * FROM car_customer WHERE IdCustomer = ' . $CustomerId);
        $Customer = $CustomerDetails->result();
        return $Customer;
    }

    function fillSalesManCombo() {
        $query = $this->db->query('SELECT * FROM viewSalesman where RoleName = "Salesman"');
        $colorCombo = $query->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "FullName" => $dropdown->FullName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillAllSalesManCombo() {
        $query = $this->db->query('SELECT * FROM viewSalesman');
        $colorCombo = $query->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "FullName" => $dropdown->FullName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function CustomerByCnic($Cnic) {
        $CustomerDetails = $this->db->query('SELECT
            car_customer.IdCustomer,
            car_customer.CustomerName,
            car_customer.FatherName,
            car_customer.AddressDetails,
            car_customer.CompanyName,
            car_customer.Designation,
            car_customer.OfficeNumber,
            car_customer.DateOfBirth,
            car_customer.City,
            car_customer.Province,
            car_customer.Cnic,
            car_customer.Ntn,
            car_customer.Telephone,
            car_customer.Cellphone,
            car_customer.Email
            FROM
            car_resource_book
            LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
            WHERE
            car_customer.Cnic = ' . $Cnic);
        $Customer = $CustomerDetails->result();
        return $Customer;
    }

    function fillCustomerCombo() {
//        $UserId = $cookieData['userid'];
//        if ($Role != "Salesman") {
//        $query = $this->db->query('SELECT car_customer.IdCustomer, car_customer.CustomerName FROM car_resource_book LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer');
        $query = $this->db->query('SELECT IdCustomer, CustomerName FROM car_customer');
        $colorCombo = $query->result();
//        } else {
//            $query = $this->db->query('SELECT distinct car_customer.IdCustomer, car_customer.CustomerName, car_resource_book.SalesmanId FROM car_resource_book LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer WHERE car_resource_book.SalesmanId = ' . $UserId);
//            $colorCombo = $query->result();
//        }
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["IdCustomer" => $dropdown->IdCustomer, "CustomerName" => $dropdown->CustomerName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillFinancerCombo() {
        $query = $this->db->query('select distinct idFinance, FinancerName from car_finance_bank');
        $colorCombo = $query->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["idFinance" => $dropdown->idFinance, "FinancerName" => $dropdown->FinancerName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillColorCombo() {
        $query = $this->db->query('select distinct IdColor, ColorName from car_color');
        $colorCombo = $query->result();
        $dropDownList = array();
        foreach ($colorCombo as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdColor, "ColorName" => $dropdown->ColorName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillCustomerTypeCombo() {
        $query = $this->db->query('select distinct Id, CustomerType from car_customer_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "CustomerType" => $dropdown->CustomerType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillModelCombo() {
        $query = $this->db->query('select distinct IdModel, Model from car_model');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdModel, "Model" => $dropdown->Model]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillCustomerStatusCombo() {
        $query = $this->db->query('select distinct Id, StatusType from car_customer_status');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "StatusType" => $dropdown->StatusType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillPaymentTypeCombo() {
        $query = $this->db->query('select distinct Id, PaymentType from car_mode_payment');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "PaymentType" => $dropdown->PaymentType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillVariantsCombo() {
        $query = $this->db->query('select distinct IdVariants, Variants from car_variants');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdVariants, "Variants" => $dropdown->Variants]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillContactTypeCombo() {
        $query = $this->db->query('select distinct Id, ContactType from car_contact_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "ContactType" => $dropdown->ContactType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillSalesman() {
        $query = $this->db->query('SELECT Id, FullName FROM car_user_profile');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "Salesman" => $dropdown->FullName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillDealerCombo() {
        $query = $this->db->query('SELECT car_sub_dealer.`Name`, car_sub_dealer.IdSubDealer FROM car_sub_dealer
            INNER JOIN car_dealer_type ON car_sub_dealer.DealerType = car_dealer_type.IdDealer
            WHERE car_dealer_type.TypeName = "Dealer"');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdSubDealer, "Dealer" => $dropdown->Name]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillSubDealerCombo() {
        $query = $this->db->query('SELECT car_sub_dealer.`Name`, car_sub_dealer.IdSubDealer FROM car_sub_dealer
            INNER JOIN car_dealer_type ON car_sub_dealer.DealerType = car_dealer_type.IdDealer
            WHERE car_dealer_type.TypeName = "Sub Dealer"');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdSubDealer, "SubDealer" => $dropdown->Name]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillCustomerStatusRadio() {
        $query = $this->db->query('select distinct Id, StatusType from car_customer_status');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "StatusType" => $dropdown->StatusType]);
        }
        return $dropDownList;
    }

    function fillFollowUpRadio() {
        $query = $this->db->query('select Id, FollowupType from car_followup_status');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "FollowupType" => $dropdown->FollowupType]);
        }
        return $dropDownList;
    }

    function fillAllocationTypeCombo() {
        $query = $this->db->query('select Id, AllocationType from car_allocation_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "AllocationType" => $dropdown->AllocationType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillOrderTypeCombo() {
        $query = $this->db->query('select id, OrderType from car_order_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["id" => $dropdown->id, "OrderType" => $dropdown->OrderType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillFollowUpCombo() {
        $query = $this->db->query('select Id, FollowupType from car_followup_status');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "Followup" => $dropdown->FollowupType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillAccessoriesCheckBox() {
        $query = $this->db->query('select DISTINCT Id, AccessoryName, Price from car_accessory_info');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "AccessoryName" => $dropdown->AccessoryName, "Price" => $dropdown->Price]);
        }
        return $dropDownList;
    }

    function fillAccessoriesChecked($RbId) {
        $query = $this->db->query('SELECT car_accessory_info.Id as AccessoryId, car_accessory_info.AccessoryName as AccessoryName,
            car_accessories_resourcebook.AccessoryId as rbAccessoryId FROM car_accessories_resourcebook
            INNER JOIN car_accessory_info ON car_accessories_resourcebook.AccessoryId = car_accessory_info.Id
            WHERE car_accessories_resourcebook.ResourcebookId = ' . $RbId);
        $dropdowns = $query->result();
        $count = count($query);
        if ($count == 0) {
            $query1 = $this->db->query('SELECT * FROM car_accessory_info');
            $dropdowns = $query1->result();
            $dropDownList = array();
            foreach ($dropdowns as $dropdown) {
                array_push($dropDownList, ["Id" => $dropdown->Id, "AccessoryName" => $dropdown->AccessoryName]);
            }
            return $dropDownList;
        }
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["AccessoryId" => $dropdown->AccessoryId, "rbAccessoryId" => $dropdown->rbAccessoryId, "AccessoryName" => $dropdown->AccessoryName]);
        }
        return $dropDownList;
    }

    function fillColorByVariant($variantId) {
        $query = $this->db->query('SELECT car_variants_color.ColorId, car_color.ColorName
            FROM car_variants_color
            INNER JOIN car_color ON car_variants_color.ColorId = car_color.IdColor
            INNER JOIN car_variants ON car_variants_color.VariantId = car_variants.IdVariants
            WHERE car_variants_color.VariantId = ' . $variantId);
        $dropdowns = $query->result();
        return $dropdowns;
    }

    function fillVariantByModel($ModelId) {
        $query = $this->db->query('SELECT car_variants.IdVariants, car_variants.Variants FROM car_model
            INNER JOIN car_variants ON car_variants.ModelId = car_model.IdModel
            WHERE car_variants.ModelId = ' . $ModelId);
        $dropdowns = $query->result();
        return $dropdowns;
    }

//    function fillAllocationTypeCombo() {
//        $query = $this->db->query('select distinct Id, AllocationType from car_allocation_type');
//        $dropdowns = $query->result();
//        $dropDownList = array();
//        foreach ($dropdowns as $dropdown) {
//            array_push($dropDownList, ["Id" => $dropdown->Id, "AllocationType" => $dropdown->AllocationType]);
//        }
//        $finalDropDown = $dropDownList;
//        return $finalDropDown;
//    }
}
