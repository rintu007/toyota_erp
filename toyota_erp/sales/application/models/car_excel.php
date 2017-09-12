<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_excel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function alldata($date) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer                                
                                WHERE car_customer_status.StatusType LIKE '" . $date . "' OR car_color.ColorName LIKE '" . $date . "'
                                OR car_mode_payment.PaymentType LIKE '" . $date . "' OR car_contact_type.ContactType LIKE '" . $date . "'
                                OR car_customer.Province LIKE '" . $date . "' OR car_customer.City LIKE '" . $date . "'
                                OR car_variants.Variants LIKE '%" . $date . "%' OR car_model.Model LIKE '" . $date . "'
                                OR car_customer.Province LIKE '" . $date . "' OR car_customer_type.CustomerType LIKE '" . $date . "'");
        return $user_query->result_array();
    }

    function reportByCity($City, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_customer.City LIKE '" . $City . "' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByContactType($ContactType, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_contact_type.ContactType LIKE '" . $ContactType . "' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByCustomerType($CustomerType, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_customer_type.CustomerType LIKE '" . $CustomerType . "' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByCustomerStatus($CustomerStatus, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_customer_status.StatusType LIKE '" . $CustomerStatus . "' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByColor($Color, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_color.ColorName LIKE '" . $Color . "' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByModel($Model, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_model.Model LIKE '" . $Model . "' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByPayment($Payment, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_mode_payment.PaymentType LIKE '" . $Payment . "' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByVariant($Variant, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_variants.Variants LIKE '%" . $Variant . "%' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByDealer($Dealer, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_sub_dealer.`Name` LIKE '" . $Dealer . "%' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByProvince($Province, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_customer.Province LIKE '" . $Province . "%' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByCustomerName($CustomerName, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType,
                                car_customer.CustomerName, car_variants.Variants,
                                car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason,
                                car_resource_book.Remarks, car_customer.CompanyName,
                                car_customer.OfficeNumber, car_model.Model,
                                car_customer.Province, car_customer.City,
                                car_customer_status.StatusType,
                                car_sub_dealer.`Name`
                                FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_customer.CustomerName LIKE '" . $CustomerName . "%' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function reportByCompanyName($CompanyName, $FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType, car_customer.CustomerName,
                                car_variants.Variants, car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason, car_resource_book.Remarks, 
                                car_customer.CompanyName, car_customer.OfficeNumber, car_model.Model, 
                                car_customer.Province, car_customer.City, car_customer_status.StatusType, 
                                car_sub_dealer.`Name` FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_customer.CompanyName LIKE '" . $CompanyName . "%' AND car_resource_book.Date between '$FromDate' and '$ToDate';");
        return $user_query->result_array();
    }

    function AllReport($FromDate, $ToDate) {
        $user_query = $this->db->query("SELECT car_resource_book.IdResourceBook, car_resource_book.Date, car_user_profile.FullName, 
                                car_resource_book.TimeConsumed, car_contact_type.ContactType, car_customer.CustomerName,
                                car_variants.Variants, car_customer.Cellphone, car_mode_payment.PaymentType,
                                car_customer_status.StatusType, car_followup_status.FollowupType,
                                car_color.ColorName, car_lost_sale.Reason, car_resource_book.Remarks, 
                                car_customer.CompanyName, car_customer.OfficeNumber, car_model.Model, 
                                car_customer.Province, car_customer.City, car_customer_status.StatusType, 
                                car_sub_dealer.`Name` FROM car_resource_book
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                                LEFT JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                                LEFT JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                                LEFT JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                                LEFT JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                                LEFT JOIN car_lost_sale ON car_resource_book.IdResourceBook = car_lost_sale.IdResourceBook
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                                INNER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                                WHERE car_resource_book.Date between '$FromDate' AND '$ToDate';");
        return $user_query->result_array();
    }

    function report($FromDate, $ToDate, $Search, $UserId, $UserRole) {
        if ($UserRole == 'Admin' || $UserRole == 'Director' || $UserRole == 'Senior Director' || $UserRole == 'CEO' || $UserRole == 'Manager') {
            $arr = array(
                $FromDate, $ToDate, $Search[0] . '%',
                $Search[1] . '%', $Search[2] . '%', $Search[3] . '%',
                $Search[4] . '%', $Search[5] . '%', $Search[6] . '%',
                $Search[7] . '%', $Search[8] . '%', $Search[9] . '%',
                $Search[10] . '%', $Search[11] . '%', $Search[12] . '%'
            );
            $Report = $this->db->query("SELECT 
                                car_resource_book.Date,
                                    car_resource_book.Remarks,
                                    car_resource_book.DeliveryMonth,
                                    car_resource_book.TimeConsumed,
                                    car_resource_book.AdditionalNote,
                                    car_customer.CustomerName,
                                    car_customer.CompanyName,
                                    car_customer.OfficeNumber,
                                    car_customer.City,
                                    car_customer.Province,
                                    car_color.ColorName,
                                    car_variants.Variants,
                                    car_user_profile.FullName,
                                    car_model.Model,
                                    car_followup_status.FollowupType,
                                    car_customer_type.CustomerType,
                                    car_customer_status.StatusType,
                                    car_contact_type.ContactType,
                                    car_mode_payment.PaymentType,
                                    car_lost_sale.Reason,
                                    car_customer.Cellphone,
                                    car_resource_book.IdResourceBook            
                            FROM car_resource_book
                    LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                    LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                    LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                    LEFT OUTER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                    LEFT OUTER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                    LEFT OUTER JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                    LEFT OUTER JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                    LEFT OUTER JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                    LEFT OUTER JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                    LEFT OUTER JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                    LEFT OUTER JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                    LEFT OUTER JOIN car_lost_sale ON car_lost_sale.IdResourceBook = car_resource_book.IdResourceBook
                    WHERE car_resource_book.Date BETWEEN ? AND ? AND
                    car_customer.City LIKE ? AND car_contact_type.ContactType LIKE ? AND
                    car_color.ColorName LIKE ? AND car_customer.CompanyName LIKE ? AND 
                    car_customer_type.CustomerType LIKE ? AND car_customer.CustomerName LIKE ? AND
                    car_customer_status.StatusType LIKE ? AND car_sub_dealer.Name LIKE ? AND
                    car_model.Model LIKE ? AND car_mode_payment.PaymentType LIKE ? AND
                    car_customer.Province LIKE ? AND car_variants.Variants LIKE ? AND
                    car_resource_book.SalesmanId LIKE ?", $arr);
        } else {
            $arr = array(
                $FromDate, $ToDate, $Search[0] . '%',
                $Search[1] . '%', $Search[2] . '%', $Search[3] . '%',
                $Search[4] . '%', $Search[5] . '%', $Search[6] . '%',
                $Search[7] . '%', $Search[8] . '%', $Search[9] . '%',
                $Search[10] . '%', $Search[11] . '%', $UserId
            );
            $Report = $this->db->query("SELECT 
                                    car_resource_book.Date,
                                    car_resource_book.Remarks,
                                    car_resource_book.DeliveryMonth,
                                    car_resource_book.TimeConsumed,
                                    car_resource_book.AdditionalNote,
                                    car_customer.CustomerName,
                                    car_customer.CompanyName,
                                    car_customer.OfficeNumber,
                                    car_customer.City,
                                    car_customer.Province,
                                    car_color.ColorName,
                                    car_variants.Variants,
                                    car_user_profile.FullName,
                                    car_model.Model,
                                    car_followup_status.FollowupType,
                                    car_customer_type.CustomerType,
                                    car_customer_status.StatusType,
                                    car_contact_type.ContactType,
                                    car_mode_payment.PaymentType,
                                    car_lost_sale.Reason,
                                    car_customer.Cellphone,
                                    car_resource_book.IdResourceBook                
                                FROM car_resource_book
                    LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                    LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                    LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                    LEFT OUTER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                    LEFT OUTER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                    LEFT OUTER JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                    LEFT OUTER JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                    LEFT OUTER JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                    LEFT OUTER JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                    LEFT OUTER JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                    LEFT OUTER JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                    LEFT OUTER JOIN car_lost_sale ON car_lost_sale.IdResourceBook = car_resource_book.IdResourceBook
                    WHERE car_resource_book.Date BETWEEN ? AND ? AND
                    car_customer.City LIKE ? AND car_contact_type.ContactType LIKE ? AND
                    car_color.ColorName LIKE ? AND car_customer.CompanyName LIKE ? AND 
                    car_customer_type.CustomerType LIKE ? AND car_customer.CustomerName LIKE ? AND
                    car_customer_status.StatusType LIKE ? AND car_sub_dealer.Name LIKE ? AND
                    car_model.Model LIKE ? AND car_mode_payment.PaymentType LIKE ? AND
                    car_customer.Province LIKE ? AND car_variants.Variants LIKE ?
                    AND car_resource_book.SalesmanId = ?", $arr);
        }
        return $Report->result_array();
    }

    function reportDate($FromDate, $ToDate, $UserId, $UserRole) {
        if ($UserRole == 'Admin' || $UserRole == 'Director' || $UserRole == 'Senior Director' || $UserRole == 'CEO' || $UserRole == 'Manager') {
            $arr = array($FromDate, $ToDate);
            $Report = $this->db->query("SELECT 
                                car_resource_book.Date,
                                    car_resource_book.Remarks,
                                    car_resource_book.DeliveryMonth,
                                    car_resource_book.TimeConsumed,
                                    car_resource_book.AdditionalNote,
                                    car_customer.CustomerName,
                                    car_customer.CompanyName,
                                    car_customer.OfficeNumber,
                                    car_customer.City,
                                    car_customer.Province,
                                    car_color.ColorName,
                                    car_variants.Variants,
                                    car_user_profile.FullName,
                                    car_model.Model,
                                    car_followup_status.FollowupType,
                                    car_customer_type.CustomerType,
                                    car_customer_status.StatusType,
                                    car_contact_type.ContactType,
                                    car_mode_payment.PaymentType,
                                    car_lost_sale.Reason,
                                    car_customer.Cellphone,
                                    car_resource_book.IdResourceBook            
                            FROM car_resource_book
                    LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                    LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                    LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                    LEFT OUTER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                    LEFT OUTER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                    LEFT OUTER JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                    LEFT OUTER JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                    LEFT OUTER JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                    LEFT OUTER JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                    LEFT OUTER JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                    LEFT OUTER JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                    LEFT OUTER JOIN car_lost_sale ON car_lost_sale.IdResourceBook = car_resource_book.IdResourceBook
                    WHERE car_resource_book.Date BETWEEN ? AND ?", $arr);
            return $Report->result_array();
        } else {
            $arr = array($FromDate, $ToDate, $UserId);
            $Report = $this->db->query("SELECT 
                                car_resource_book.Date,
                                    car_resource_book.Remarks,
                                    car_resource_book.DeliveryMonth,
                                    car_resource_book.TimeConsumed,
                                    car_resource_book.AdditionalNote,
                                    car_customer.CustomerName,
                                    car_customer.CompanyName,
                                    car_customer.OfficeNumber,
                                    car_customer.City,
                                    car_customer.Province,
                                    car_color.ColorName,
                                    car_variants.Variants,
                                    car_user_profile.FullName,
                                    car_model.Model,
                                    car_followup_status.FollowupType,
                                    car_customer_type.CustomerType,
                                    car_customer_status.StatusType,
                                    car_contact_type.ContactType,
                                    car_mode_payment.PaymentType,
                                    car_lost_sale.Reason,
                                    car_customer.Cellphone,
                                    car_resource_book.IdResourceBook            
                            FROM car_resource_book
                    LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                    LEFT OUTER JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                    LEFT OUTER JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                    LEFT OUTER JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                    LEFT OUTER JOIN car_sub_dealer ON car_user_profile.DealerShip = car_sub_dealer.IdSubDealer
                    LEFT OUTER JOIN car_model ON car_resource_book.idModel = car_model.IdModel
                    LEFT OUTER JOIN car_followup_status ON car_resource_book.FollowupStatus = car_followup_status.Id
                    LEFT OUTER JOIN car_customer_type ON car_resource_book.CustomerTypeId = car_customer_type.Id
                    LEFT OUTER JOIN car_customer_status ON car_resource_book.CustomerStatus = car_customer_status.Id
                    LEFT OUTER JOIN car_contact_type ON car_resource_book.ContactTypeId = car_contact_type.Id
                    LEFT OUTER JOIN car_mode_payment ON car_resource_book.PaymentMode = car_mode_payment.Id
                    LEFT OUTER JOIN car_lost_sale ON car_lost_sale.IdResourceBook = car_resource_book.IdResourceBook
                    WHERE car_resource_book.Date BETWEEN ? AND ?
                    AND car_resource_book.SalesmanId = ?", $arr);
            return $Report->result_array();
        }
    }

}
