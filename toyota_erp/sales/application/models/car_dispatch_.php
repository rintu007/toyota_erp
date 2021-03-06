<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_dispatch extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allDispatch() {
        $variants = $this->db->select('*')->from('car_variants')->get();
        return $variants->result_array();
    }

    function getPbo($PboNumber) {
        $variants = $this->db->select('*')->from('viewdispatch')->where('PboNumber', $PboNumber)->get();
        return $variants->result_array();
    }

    function StockReport($FromDate = '', $ToDate = '') {
        if ($FromDate == NULL && $ToDate == NULL) {
            $StockReport = $this->db->query('SELECT * FROM StockReport');
        } else {
            $StockReport = $this->db->query("SELECT * FROM StockReport WHERE DispatchedDate BETWEEN '" . $FromDate . "' AND '" . $ToDate . "'");
        }
        return $StockReport->result_array();
    }

    function SaleReport($FromDate = '', $ToDate = '') {
        if ($FromDate == NULL && $ToDate == NULL) {
            $StockReport = $this->db->query('SELECT * FROM SaleReport');
        } else {
            $StockReport = $this->db->query("SELECT * FROM SaleReport WHERE CreatedDate BETWEEN '" . $FromDate . "' AND '" . $ToDate . "'");
        }
        return $StockReport->result_array();
    }

    function insertDispatch($DispatchData, $PboData, $PboId) {
        $this->db->trans_start();
        $this->db->insert('car_dispatch', $DispatchData);

        $this->db->where('Id', $PboId);
        $this->db->update('car_pbo', $PboData);
        $this->db->trans_complete();
    }

    function insertDispatchNoPbo($DispatchData) {
        $this->db->insert('car_dispatch', $DispatchData);
    }

    function updateDispatch($vID, $vData) {
        $this->db->where('IdVariants', $vID);
        $this->db->update('car_variants', $vData);
    }

    function deleteDispatch($vID) {
        $this->db->where('IdVariants', $vID);
        $this->db->delete('car_variants');
    }

    function fillLocation() {
        $query = $this->db->query('select idLocation, Location from car_location');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idLocation" => $dropdown->idLocation, "Location" => $dropdown->Location]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }
    function get_table($name)
    {
        return $this->db->get($name)->result_array();
    }
    function dispatchList($UserRole, $idUser, $perpage = '', $limit = '') {
        if ($UserRole == "Admin" || $UserRole == "Sales Admin" || $UserRole == "Director") {
            $query = $this->db->query('SELECT car_dispatch.idDispatch, car_dispatch.ChasisNo, car_dispatch.EngineNo,car_dispatch.DispatchedDate,
                car_pbo.PboNumber, car_dispatch.WarrantyBook,
                car_variants.Variants, car_color.ColorName, car_customer.CustomerName,
                car_salenote.SaleNoteNumber, car_resource_book.SalesmanId, car_variants.TotalPrice,car_variants.WHTFiler , view_partialdetail.Balance
                FROM car_dispatch
                LEFT OUTER JOIN car_pbo ON car_dispatch.PboId = car_pbo.Id
                LEFT OUTER JOIN car_resource_book ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
                LEFT OUTER JOIN car_variants ON car_dispatch.VariantId = car_variants.IdVariants 
                LEFT OUTER JOIN car_color ON car_dispatch.ColorId = car_color.IdColor 
                LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                LEFT OUTER JOIN car_salenote ON car_salenote.Customer = car_customer.IdCustomer AND car_salenote.Dispatch = car_dispatch.idDispatch
                LEFT OUTER JOIN view_partialdetail ON car_dispatch.PboId = view_partialdetail.PboId
                where car_dispatch.isDelivered = 0 order by car_dispatch.DispatchedDate desc
                '.
                " limit $limit,$perpage"


				);
//            var_dump($this->db->last_query());die;

        } else {
            $query = $this->db->query('SELECT car_dispatch.idDispatch,car_dispatch.ChasisNo, car_dispatch.EngineNo,
                car_pbo.PboNumber, car_dispatch.WarrantyBook,
                car_variants.Variants, car_color.ColorName, car_variants.TotalPrice,car_variants.WHTFiler,
                car_customer.CustomerName, car_salenote.SaleNoteNumber,
                car_resource_book.SalesmanId FROM car_dispatch
                LEFT OUTER JOIN car_pbo ON car_dispatch.PboId = car_pbo.Id
                LEFT OUTER JOIN car_resource_book ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
                LEFT OUTER JOIN car_variants ON car_dispatch.VariantId = car_variants.IdVariants 
                LEFT OUTER JOIN car_color ON car_dispatch.ColorId = car_color.IdColor 
                LEFT OUTER JOIN car_customer ON car_resource_book.CustomerId = car_customer.IdCustomer
                LEFT OUTER JOIN car_salenote ON car_salenote.Customer = car_customer.IdCustomer AND car_salenote.Dispatch = car_dispatch.idDispatch
                WHERE car_resource_book.SalesmanId = ' . $idUser."
                 and  car_dispatch.isDelivered = 0 order by car_dispatch.DispatchedDate desc
                 limit $limit,$perpage");
        }
        return $query->result_array();
    }

    function get_dispatch($idDispatch)
    {
        $query = "SELECT car_dispatch.idDispatch,car_dispatch.RegistrationNumber, car_dispatch.ChasisNo, car_dispatch.EngineNo,car_pbo.RegistrationNumber,
                car_pbo.PboNumber, car_dispatch.WarrantyBook,
                car_variants.Variants, car_color.ColorName
               
                FROM car_dispatch
                LEFT  JOIN car_pbo ON car_dispatch.PboId = car_pbo.Id
                LEFT  JOIN car_resource_book ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
                LEFT  JOIN car_variants ON car_dispatch.VariantId = car_variants.IdVariants 
                LEFT  JOIN car_color ON car_dispatch.ColorId = car_color.IdColor
                where idDispatch = $idDispatch
                ";
        return $this->db->query($query)->row();
    }

    function dispatchReceive_insert($data)
    {
        $insert = array(
            "entrydate"         => $data['entrydate'],
            "arrivaldate"       => $data['arrivaldate'],
            "idDispatch"        => $data['idDispatch'],
            "reminderdate"      => $data['reminderdate'],
            "idparking_row"     => $data['idparking_row'],
            "idsource"          => $data['idsource'],
            "remarks"           => $data['remarks'],
            "swappeddate"       => $data['swappeddate']

        );
        if(isset($data['generalstock']))
        {
            $insert['generalstock'] = 1;
        }
        $this->db->insert('car_receive',$insert);
        $id =  $this->db->insert_id();

        $this->db->where('idDispatch',$data['idDispatch'])
            ->update('car_dispatch',array('isDelivered' => 1,'isStock' =>1));
        return $id;

    }
    function max_receive_id()
    {
       return $this->db->query("select max(p.id) as id from car_receive p")->row('id');
    }

    function dispatchList_count()
    {
        $query = $this->db->query("
        SELECT count(*)  count       FROM car_dispatch where isDelivered=0");
//        var_dump($query->row('count'));die;
        return $query->row('count');
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

    /**
     * Changes told by Sir Saad
     */
    function getidVariant($variantname) {
        $this->db->select('IdVariants');
        $this->db->from('car_variants');
        $this->db->where('Variants', $variantname);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $query = $row->IdVariants;
        } else {
            
        }
        return $query;
//        $query = $this->db->query("select IdVariants from car_variants where Variants = '" . $variantname . "' ");
//        return $dropdowns = $query->result_array();
    }

    function CheckEngineNumber($EngineNumber) {
        $Number = $this->db->query("select EngineNumber from car_pbo where EngineNumber = '" . $EngineNumber . "' ");
        $Availability = $Number->result_array();
        if ($Availability == null) {
            return "Available";
        } else {
            return "Already Exists";
        }
    }

    function CheckChasisNumber($ChasisNumber) {
        $Number = $this->db->query("select ChasisNumber from car_pbo where ChasisNumber = '" . $ChasisNumber . "' ");
        $Availability = $Number->result_array();
        if ($Availability == null) {
            return "Available";
        } else {
            return "Already Exists";
        }
    }

}
