<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rb_Quotation extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function generateQuotation($idRb) {
        $Quotation = $this->db->query("SELECT DISTINCT
                                car_resource_book.IdResourceBook,
                                car_resource_book.Date,
                                car_variants.Variants,
                                car_variants.Price,
                                car_variants.TotalPrice,
                                car_color.ColorName,
                                car_model.Model,
                                car_displacement.DisplacementName,
                                car_customer.CustomerName,
                                car_user_profile.FullName,
                                car_resource_book.DeliveryMonth,
                                car_pbo.BankName,
                                car_customer.FatherName
                                FROM
                                car_resource_book
                                LEFT JOIN car_variants ON car_resource_book.VehicleInterested = car_variants.IdVariants
                                LEFT JOIN car_pbo ON car_resource_book.IdResourceBook = car_pbo.ResourceBookId
                                LEFT JOIN car_variants_color ON car_variants_color.VariantId = car_variants.IdVariants
                                LEFT JOIN car_model ON car_resource_book.idModel = car_model.IdModel AND car_variants.ModelId = car_model.IdModel
                                LEFT JOIN car_displacement ON car_variants.DisplacementId = car_displacement.IdDisplacement
                                LEFT JOIN car_color ON car_resource_book.Color1 = car_color.IdColor
                                LEFT JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                                LEFT JOIN car_user_profile ON car_resource_book.SalesmanId = car_user_profile.Id
                                WHERE car_resource_book.IdResourceBook = '" . $idRb . "'");
        return $Quotation->result_array();
    }

}
