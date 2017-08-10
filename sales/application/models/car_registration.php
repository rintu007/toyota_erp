<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_registration extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allRegistration() {
        $variants = $this->db->select('*')->from('car_registration')->get();
        return $variants->result_array();
    }

    function getPbo($PboNumber) {
        $variants = $this->db->select('*')->from('DispatchInvoice')->where('InvoiceCreated', 0)->where('PboNumber', $PboNumber)->get();
        return $variants->result_array();
    }

    function insertRegistration($invoiceData) {
        $this->db->trans_start();
        $this->db->insert('car_registration', $invoiceData);
        $this->db->trans_complete();
    }

    function updateRegistration($idInvoice, $invoiceData) {
        $this->db->where('idRegistration', $idInvoice);
        $this->db->update('car_registration', $invoiceData);
    }

    function deleteRegistration($idRegistration) {
        $this->db->where('idRegistration', $idRegistration);
        $this->db->delete('car_registration');
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

}
