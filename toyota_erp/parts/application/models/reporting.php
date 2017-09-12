<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reporting extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    //************ Sale Report View *************//
    function SaleReport($FromDate = '', $ToDate = '', $SaleType = '') {
        if ($FromDate == '' && $ToDate == '') {
            $SaleReport = $this->db->select('*')->from('p_salereport')->where('idSaleType', $SaleType)->get();
            return $SaleReport->result_array();
        } else if ($SaleType == '') {
            $SaleReport = $this->db->query('SELECT * FROM p_salereport WHERE SaleDate BETWEEN "' . $FromDate . '" AND "' . $ToDate . '"');
            return $SaleReport->result_array();
        }
    }

    //************ Purchase Report View *************//
    function PurchaseReport($PurchaseType = '', $Vendor = '') {
        if ($PurchaseType == 'LOC' && $Vendor == '') {
            $PurchaseReport = $this->db->select('*')->from('p_localpurchase')->get();
            return $PurchaseReport->result_array();
        } else if ($PurchaseType == 'IMC' && $Vendor == '') {
            $PurchaseReport = $this->db->select('*')->from('p_imcpurchase')->get();
            return $PurchaseReport->result_array();
        } else if ($PurchaseType == 'Force' && $Vendor == '') {
            $PurchaseReport = $this->db->select('*')->from('p_forcepurchase')->get();
            return $PurchaseReport->result_array();
        } else if ($PurchaseType == 'LOC' && $Vendor != '') {
            $PurchaseReport = $this->db->select('*')->from('p_localpurchase')->where('PartyId', $Vendor)->get();
            return $PurchaseReport->result_array();
        } else if ($PurchaseType == 'IMC' && $Vendor != '') {
            $PurchaseReport = $this->db->select('*')->from('p_imcpurchase')->where('PartyId', $Vendor)->get();
            return $PurchaseReport->result_array();
        } else {
            $PurchaseReport = $this->db->select('*')->from('p_forcepurchase')->where('PartyId', $Vendor)->get();
            return $PurchaseReport->result_array();
        }
    }

    //************ Order Report View *************//
    function OrderReport($FromDate = '', $ToDate = '', $OrderMode = '') {
        if ($FromDate == '' && $ToDate == '') {
            $OrderReport = $this->db->select('*')->from('vieworders')->where('id', $OrderMode)->get();
            return $OrderReport->result_array();
        } else {
            $OrderReport = $this->db->query('SELECT * FROM vieworders WHERE Date BETWEEN "' . $FromDate . '" AND "' . $ToDate . '"');
            return $OrderReport->result_array();
        }
    }

    //************ Inventory Report View *************//
    function InventoryReport($Category = '', $Manufacturer = '') {
        if ($Category != '' && $Manufacturer != '') {
            $InventoryReport = $this->db->select('*')->from('p_inventoryreport')->where('CategoryName', $Category)->where('Manufacturer', $Manufacturer)->get();
            return $InventoryReport->result_array();
        } else if ($Manufacturer != '') {
            $InventoryReport = $this->db->select('*')->from('p_inventoryreport')->where('Manufacturer', $Manufacturer)->get();
            return $InventoryReport->result_array();
        } else if ($Category != '') {
            $InventoryReport = $this->db->select('*')->from('p_inventoryreport')->where('CategoryName', $Category)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('p_inventoryreport')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Daily Order Report View *************//
    function DailyOrderReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewdailyorder')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
//            $Brand = (strtolower($Brand) == "toyota" || $Brand == "Toyota" || strtoupper($Brand) == "TOYOTA") ? "T" : (strtolower($Brand) == "daihatsu" || $Brand == "Daihatsu" || strtoupper($Brand) == "DAIHATSU") ? "D" : "O";
            $InventoryReport = $this->db->select('*')->from('viewdailyorder')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewdailyorder')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Warranty Order Report View *************//
    function WarrantyOrderReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewwarrantyorder')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewwarrantyorder')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewwarrantyorder')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Chemical Order Report View *************//
    function ChemicalOrderReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewchemicalorder')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewchemicalorder')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewchemicalorder')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ By Sea Order Report View *************//
    function BySeaOrderReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewbyseaorder')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewbyseaorder')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewbyseaorder')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Accessories Order Report View *************//
    function AccessoriesOrderReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewaccessoriesorder')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewaccessoriesorder')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewaccessoriesorder')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Dhamaka Package Report View *************//
    function DhamakaPackageReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewdhamakapackage')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewdhamakapackage')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewdhamakapackage')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Special Offer Report View *************//
    function SpecialOfferReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewspecialoffer')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewspecialoffer')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewspecialoffer')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Plan Order Report View *************//
    function PlanOrderReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewplanorder')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewplanorder')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewplanorder')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ VOR Report View *************//
    function VORReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewvor')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewvor')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewvor')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Local Package Report View *************//
    function LocalPackageReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewlocalpurchase')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewlocalpurchase')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewlocalpurchase')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ TGMO Report View *************//
    function TGMOReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewtgmo')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewtgmo')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewtgmo')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ D Package Order Report View *************//
    function DPackageOrderReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewdpackageorder')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewdpackageorder')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewdpackageorder')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ M Package Order Report View *************//
    function MPackageOrderReport($OrderNumber = NULL, $Brand = NULL) {
        if ($OrderNumber !== NULL && $Brand == NULL) {
            $InventoryReport = $this->db->select('*')->from('viewmpackageorder')->where("OrderNumber", $OrderNumber)->get();
            return $InventoryReport->result_array();
        } else if ($OrderNumber == NULL && $Brand !== NULL) {
            $InventoryReport = $this->db->select('*')->from('viewmpackageorder')->where("BrandCode", $Brand)->get();
            return $InventoryReport->result_array();
        } else {
            $InventoryReport = $this->db->select('*')->from('viewmpackageorder')->get();
            return $InventoryReport->result_array();
        }
    }

    //************ Populating Dropdown **************//
    function fillSaleTypeCombo() {
        $query = $this->db->query('select idSaleType, SaleType from inventory_sale_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idSaleType" => $dropdown->idSaleType, "SaleType" => $dropdown->SaleType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillPurchaseTypeCombo() {
        $query = $this->db->query('select idPurchaseType, PurchaseType from inventory_purchase_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPurchaseType" => $dropdown->idPurchaseType, "PurchaseType" => $dropdown->PurchaseType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillPartyCombo() {
        $query = $this->db->query('select idParty, Name from inventory_party');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idParty" => $dropdown->idParty, "Name" => $dropdown->Name]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillOrderModeCombo() {
        $query = $this->db->query('select id, Title from invoice_claim_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["id" => $dropdown->id, "Title" => $dropdown->Title]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillPartCategoryCombo() {
        $query = $this->db->query('select idCategory, CategoryName from parts_category');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idCategory" => $dropdown->idCategory, "CategoryName" => $dropdown->CategoryName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillPartManufacturerCombo() {
        $query = $this->db->query('select idManufacturer, Manufacturer from parts_manufacturer');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idManufacturer" => $dropdown->idManufacturer, "Manufacturer" => $dropdown->Manufacturer]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillPartBrandCombo() {
        $query = $this->db->query('select idParent, ParentName as `BrandName`, ShortCode as `BrandCode` from car_parent');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["BrandName" => $dropdown->BrandName, "BrandCode" => $dropdown->BrandCode]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

}
