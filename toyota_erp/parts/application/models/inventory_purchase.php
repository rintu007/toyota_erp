    <?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inventory_purchase extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function AllPurchases($filterByDate = NULL, $idPurchase = NULL) {
        if($idPurchase != Null){
        $this->db->select('*');
        $this->db->join('inventory_purchase', 'inventory_purchase_local.PurchaseId = inventory_purchase.idPurchase');
        $this->db->join('parts_name', 'inventory_purchase_local.PartId = parts_name.idPart');
        $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_category.idCategory = parts_inventory.PartCategory');
        $this->db->join('inventory_purchase_type', 'inventory_purchase.PurchaseTypeId = inventory_purchase_type.idPurchaseType');
        $this->db->join('inventory_party', 'inventory_purchase.PartyId = inventory_party.idParty');
        $this->db->where('inventory_purchase.idPurchase', $idPurchase);
        $PurchaseLocalDetail = $this->db->get('inventory_purchase_local');
        }else{
            $this->db->select('*');
        $this->db->join('inventory_purchase', 'inventory_purchase_local.PurchaseId = inventory_purchase.idPurchase');
        $this->db->join('parts_name', 'inventory_purchase_local.PartId = parts_name.idPart');
        $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_category.idCategory = parts_inventory.PartCategory');
        $this->db->join('inventory_purchase_type', 'inventory_purchase.PurchaseTypeId = inventory_purchase_type.idPurchaseType');
        $this->db->join('inventory_party', 'inventory_purchase.PartyId = inventory_party.idParty');
        $PurchaseLocalDetail = $this->db->get('inventory_purchase_local');
        }
        return $PurchaseLocalDetail->result_array();
    }

    function LOCPurchases($filterByDate = NULL, $idPurchase = NULL) {
        if($idPurchase != Null){
        $this->db->select('*');
        $this->db->join('inventory_purchase', 'inventory_purchase_local.PurchaseId = inventory_purchase.idPurchase');
        $this->db->join('parts_name', 'inventory_purchase_local.PartId = parts_name.idPart');
        $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_category.idCategory = parts_inventory.PartCategory');
        $this->db->join('inventory_purchase_type', 'inventory_purchase.PurchaseTypeId = inventory_purchase_type.idPurchaseType');
        $this->db->join('inventory_party', 'inventory_purchase.PartyId = inventory_party.idParty');
        $this->db->where('inventory_purchase.idPurchase', $idPurchase);
		$this->db->order_by("inventory_purchase_local.InvoiceDate", "desc");
        $PurchaseLocalDetail = $this->db->get('inventory_purchase_local');
        }else{
            $this->db->select('*');
        $this->db->join('inventory_purchase', 'inventory_purchase_local.PurchaseId = inventory_purchase.idPurchase');
        $this->db->join('parts_name', 'inventory_purchase_local.PartId = parts_name.idPart');
        $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_category.idCategory = parts_inventory.PartCategory');
        $this->db->join('inventory_purchase_type', 'inventory_purchase.PurchaseTypeId = inventory_purchase_type.idPurchaseType');
        $this->db->join('inventory_party', 'inventory_purchase.PartyId = inventory_party.idParty');
        if ($filterByDate != NULL) {
            $this->db->where('inventory_purchase.PurchaseDate BETWEEN "' . $filterByDate["fromDate"] . '" AND "' . $filterByDate["toDate"] . '"');
        }
		$this->db->order_by("inventory_purchase_local.InvoiceDate", "desc");
        $PurchaseLocalDetail = $this->db->get('inventory_purchase_local');
        }
		
        return $PurchaseLocalDetail->result_array();
    }
    function IMCPurchases($filterByDate = NULL, $idPurchase = NULL) {
		if($idPurchase != Null){
        $this->db->select('*');
        $this->db->join('inventory_purchase', 'inventory_purchase_imc.PurchaseId = inventory_purchase.idPurchase');
        $this->db->join('parts_name', 'inventory_purchase_imc.PartId = parts_name.idPart');
        $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('order_invoice_details', 'order_invoice_details.idOIDetails = inventory_purchase_imc.OrderId');
		$this->db->join('order_number', 'order_number.idOrderNumber = order_invoice_details.OrderNumberId ');
        $this->db->join('parts_category', 'parts_category.idCategory = parts_inventory.PartCategory');
        $this->db->join('inventory_purchase_type', 'inventory_purchase.PurchaseTypeId = inventory_purchase_type.idPurchaseType');
        $this->db->join('inventory_party', 'inventory_purchase.PartyId = inventory_party.idParty');
		$this->db->join('parts_customer', 'order_number.CustomerName = parts_customer.CustomerName','Left');
		$this->db->where('inventory_purchase.idPurchase', $idPurchase);
		$this->db->order_by("inventory_purchase_imc.InvoiceDate", "desc");
        $PurchaseLocalDetail = $this->db->get('inventory_purchase_imc');
		}else{
		$this->db->select('*');
        $this->db->join('inventory_purchase', 'inventory_purchase_imc.PurchaseId = inventory_purchase.idPurchase');
        $this->db->join('parts_name', 'inventory_purchase_imc.PartId = parts_name.idPart');
        $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_category.idCategory = parts_inventory.PartCategory');
        $this->db->join('inventory_purchase_type', 'inventory_purchase.PurchaseTypeId = inventory_purchase_type.idPurchaseType');
        $this->db->join('inventory_party', 'inventory_purchase.PartyId = inventory_party.idParty');
        if ($filterByDate != NULL) {
            $this->db->where('inventory_purchase.PurchaseDate BETWEEN "' . $filterByDate["fromDate"] . '" AND "' . $filterByDate["toDate"] . '"');
        }
		$this->db->order_by("inventory_purchase_imc.InvoiceDate", "desc");
        $PurchaseLocalDetail = $this->db->get('inventory_purchase_imc');
		}
		
        return $PurchaseLocalDetail->result_array();
    }
    
    function getGRNumber(){
        $query = $this->db->query('select MAX(GrnNo)+1 as `GrnNo` from inventory_purchase_local');
        $grnNumber = $query->result_array();
        return $grnNumber[0];
    }
	
    function AddPurchase($PurchaseData) {
        if ($this->input->post('type') == "Local") {
            $this->db->trans_start();
            $this->db->insert('inventory_purchase', $PurchaseData);
            $idPurchase = $this->db->insert_id();

            $PurchaseLocalItem = array(
                'PurchaseId' => $idPurchase,
                'PartId' => $this->input->post('idPart'),
                'PurchaseQuantity' => $this->input->post('Quantity'),
                'Amount' => $this->input->post('costprice')
            );

            $this->db->insert('inventory_purchase_local', $PurchaseLocalItem);

            $this->db->select('PartId');
            $this->db->where('PartId', $this->input->post('idPart'));
            $GetPartQuantity = $this->db->get('inventory_main');
            $Quantity = $GetPartQuantity->result_array();

            if (empty($Quantity)) {
                $InventoryItem = array(
                    'PartId' => $this->input->post('idPart'),
                    'InventoryQuantity' => $this->input->post('Quantity'),
                );
                $AddPurchase = $this->db->insert('inventory_main', $InventoryItem);
            } else {
                $this->db->select('InventoryQuantity');
                $this->db->where('PartId', $this->input->post('idPart'));
                $GetQty = $this->db->get('inventory_main');
                $Qty = $GetQty->result_array();
                $TotalQuantity = $Qty[0]['InventoryQuantity'];
                $PurchasedQuantity = $this->input->post('Quantity');

                $NewQty = $TotalQuantity + $PurchasedQuantity;
                $this->db->where('PartId', $this->input->post('idPart'));
                $this->db->set('InventoryQuantity', $NewQty);
                $AddPurchase = $this->db->update('inventory_main');
            }

            $this->db->trans_complete();

            if ($AddPurchase) {
                return "New Purchase Item Has Been Added!";
            } else {
                return "Failed To Add New Purchase Item!";
            }
        } else if ($this->input->post('type') == 1) {
            $this->db->trans_start();
            $this->db->insert('inventory_purchase', $PurchaseData);
            $idPurchase = $this->db->insert_id();

            $PurchaseImcItem = array(
                'PurchaseId' => $idPurchase,
                'PartId' => $this->input->post('idPart'),
                'QuantityReceived' => $this->input->post('Quantity'),
                'CostPrice' => $this->input->post('CostPrice'),
                'InvoiceNumber' => $this->input->post('InvoiceNumber'),
                'InvoiceDate' => $this->input->post('InvoiceDate')
            );

            $this->db->insert('inventory_purchase_imc', $PurchaseImcItem);

            $InventoryItem = array(
                'PartId' => $this->input->post('idPart'),
                'Quantity' => $this->input->post('Quantity'),
            );
            $AddPurchase = $this->db->insert('inventory_main', $InventoryItem);

            $this->db->trans_complete();
            if ($AddPurchase) {
                return "New Purchase Item Has Been Added!";
            } else {
                return "Failed To Add New Purchase Item!";
            }
        } else {
            return "Please Select Local or IMC to Purchase New Items";
        }
    }

    function NewPurchase() {
        $PurchaseData = array();
        $idPurchaseType = $this->input->post('type');
        $PurchaseType = $this->AllPurchaseType($idPurchaseType)[0];
        $PartyID = "";
        if ($PurchaseType['PurchaseType'] == "IMC") {
            $PurchaseItem = array(
                'PurchaseTypeId' => $this->input->post('type'),
                'PartyId' => $this->input->post('PartyName'),
                'PurchaseDate' => $this->input->post('PurchaseDate')
            );
            $PartyID = $this->input->post('PartyName');
            $this->db->insert('inventory_purchase', $PurchaseItem);
            $idPurchase = $this->db->insert_id();
            $idOrder = $_POST['orderdetails'];
            $Part = $_POST['parts'];
            $Quantity = $_POST['receivedquantity'];
            $Price = $_POST['price'];
            $Discount = $_POST['discount'];
            $ActualCost = $_POST['actualcost'];
            $LandValue = $_POST['landvalue'];
            $InvoiceNumber = $_POST['InvoiceNumber'];
            $InvoiceDate = $_POST['InvoiceDate'];
            $OrderNo = $_POST['OrderNo'];
            $TotalCost = $_POST['totalcost'];

            for ($i = 0; $i < count($_POST['parts']); $i++) {
                $PurchaseData[] = array(
                    'OrderId' => $idOrder[$i],
                    'PurchaseId' => $idPurchase,
                    'OrderNo' => $OrderNo,
                    'PartId' => $Part[$i],
                    'QuantityReceived' => $Quantity[$i],
                    'CostPrice' => $Price[$i],
                    'Discount' => $Discount[$i],
                    'ActualCost' => $ActualCost[$i],
                    'LandValue' => $LandValue[$i],
                    'TotalCost' => $TotalCost[$i],
                    'InvoiceNumber' => $InvoiceNumber,
                    'InvoiceDate' => $InvoiceDate,
                );
                $partQuantity = $this->getPartQuantity($Part[$i])[0];
                $TotalQuantity = $Quantity[$i] + $partQuantity['Quantity'];
                $this->db->set('Quantity', $TotalQuantity);
                $this->db->where('idPart', $Part[$i]);
                $this->db->update('parts_name');
				$qty = $this->db->select('Quantity')->from('vieworders')->where('OrderNumber', $OrderNo)->where('idPart',$Part[$i])->get()->result_array();
                $remaining_qty = intval($qty[0]['Quantity']) - intval($Quantity[$i]);
                $this->db->set('Quantity', $remaining_qty);
                $this->db->where('idPart', $Part[$i]);
                $this->db->where('OrderNumber', $OrderNo);
                $this->db->update('vieworders');
            }
            $insert_batch = $this->db->insert_batch('inventory_purchase_imc', $PurchaseData);
            if ($insert_batch) {
				$this->Payable($PartyID, $this->input->post('NetTotal'));
                return TRUE;
            } else {
                return FALSE;
            }
        } else if ($PurchaseType['PurchaseType'] == 'LOC') {
            $PurchaseItem = array(
                'PurchaseTypeId' => $this->input->post('type'),
                'PartyId' => $this->input->post('PartyNameLocal'),
                'PurchaseDate' => $this->input->post('PurchaseDateLocal')
            );
            $PartyID = $this->input->post('PartyNameLocal');
            $this->db->insert('inventory_purchase', $PurchaseItem);
            $idPurchase = $this->db->insert_id();
            $PartLocal = $_POST['Localparts'];
            $QuantityLocal = $_POST['Localquantity'];
            $GrnNo = $_POST['GrnNoLocal'];
            $PriceLocal = $_POST['Localprice'];
            $DiscountLocal = $_POST['Localdiscount'];
            $ActualCostLocal = $_POST['Localactualcost'];
            $LandValueLocal = $_POST['Locallandvalue'];
            $InvoiceNumberLocal = $_POST['InvoiceNumberLocal'];
            $InvoiceDateLocal = $_POST['InvoiceDateLocal'];

            for ($i = 0; $i < count($_POST['Localparts']); $i++) {
                $PurchaseData[] = array(
                    'PurchaseId' => $idPurchase,
                    'GrnNo' => $GrnNo,
                    'PartId' => $PartLocal[$i],
                    'PurchaseQuantity' => $QuantityLocal[$i],
                    'Amount' => $LandValueLocal[$i],
                    'Discount' => $DiscountLocal[$i],
                    'ActualCost' => $ActualCostLocal[$i],
                    'LandValue' => $LandValueLocal[$i],
                    'InvoiceNumber' => $InvoiceNumberLocal,
                    'InvoiceDate' => $InvoiceDateLocal,
					'unitPrice' => $LandValueLocal[$i]
                );

                $partQuantity = $this->getPartQuantity($PartLocal[$i])[0];
                $TotalQuantity = $QuantityLocal[$i] + $partQuantity['Quantity'];
                $this->db->set('Quantity', $TotalQuantity);
                $this->db->where('idPart', $PartLocal[$i]);
                $this->db->update('parts_name');
            }
            $insert_batch = $this->db->insert_batch('inventory_purchase_local', $PurchaseData);
            if ($insert_batch) {
			
                $this->Payable($PartyID, $this->input->post('NetTotal'));
                return TRUE;
            } else {
                return FALSE;
            }
        }
        // Creating Payable
    }

    function EditPurchase($idPurchase, $PurchaseData) {
        $this->db->where('idPurchase', $idPurchase);
        $EditPurchase = $this->db->update('inventory_purchase', $PurchaseData);
        if ($EditPurchase) {
            return "Selected Purchase Item Has Been Updated!";
        } else {
            return "Failed To Update The Selected Purchase Item!";
        }
    }

    function SearchIMCPurchase($Keyword) {
        $this->db->select('*');
        $this->db->join('inventory_purchase', 'inventory_purchase_imc.PurchaseId = inventory_purchase.idPurchase');
        $this->db->join('parts_name', 'inventory_purchase_imc.PartId = parts_name.idPart');
        $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_category.idCategory = parts_inventory.PartCategory');
        $this->db->join('inventory_purchase_type', 'inventory_purchase.PurchaseTypeId = inventory_purchase_type.idPurchaseType');
        $this->db->join('inventory_party', 'inventory_purchase.PartyId = inventory_party.idParty');
        $this->db->like('inventory_purchase_imc.OrderNo', $Keyword);
        $this->db->or_like('inventory_purchase_imc.InvoiceNumber', $Keyword);
        $this->db->or_like('parts_name.PartNumber', $Keyword);
        $PurchaseLocalDetail = $this->db->get('inventory_purchase_imc');
        return $PurchaseLocalDetail->result_array();
    }

    function SearchLOCPurchase($Keyword) {
        $this->db->select('*');
        $this->db->join('inventory_purchase', 'inventory_purchase_local.PurchaseId = inventory_purchase.idPurchase');
        $this->db->join('parts_name', 'inventory_purchase_local.PartId = parts_name.idPart');
        $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart');
        $this->db->join('parts_category', 'parts_category.idCategory = parts_inventory.PartCategory');
        $this->db->join('inventory_purchase_type', 'inventory_purchase.PurchaseTypeId = inventory_purchase_type.idPurchaseType');
        $this->db->join('inventory_party', 'inventory_purchase.PartyId = inventory_party.idParty');
        $this->db->like('parts_name.PartNumber', $Keyword);
        $this->db->or_like('parts_name.PartName', $Keyword);
        $PurchaseLocalDetail = $this->db->get('inventory_purchase_local');
        return $PurchaseLocalDetail->result_array();
    }

    function DeletePurchase($idPurchase) {
        $this->db->where('idPurchase', $idPurchase);
        $DeletePurchase = $this->db->delete('inventory_purchase');
        if ($DeletePurchase) {
            return "Selected Purchase Item Has Been Deleted!";
        } else {
            return "Failed To Delete The Selected Item!";
        }
    }

    function getPartQuantity($idPart) {
        $Part = $this->db->select('Quantity')->from('parts_name')->where('idPart', $idPart)->get();
        return $Part->result_array();
    }

    function SearchPurchase($Keyword) { 
        $PurchaseItem = $this->db->select('*')->from('inventory_purchase')->like('idPurchase', $Keyword)->
                        like('PartName', $Keyword)->get();
        return $PurchaseItem->result_array();
    }

    function getOrder($OrderNumber) {
//        $GetOrder = $this->db->select('*')->from('vieworders')->where('OrderNumber', $OrderNumber)->get();
        $GetOrder = $this->db->select('*')->from('vieworders')->where(['OrderNumber' => $OrderNumber, "Quantity >" => "0"])->get();
        return $GetOrder->result_array();
    }

    function getPartDetails($idPart) {
        $GetPartDetails = $this->db->select('*')->from('localOrderView')->where('idPart', $idPart)->get();
        return $GetPartDetails->result_array();
    }

    function AllPurchaseType($idPurchaseType = '') {
        if ($idPurchaseType == '') {
           $user =  unserialize($_COOKIE["logindata"]);
            if($user['username'] != "Talib")
            $PurchaseType = $this->db->get('inventory_purchase_type');
            else
                $PurchaseType = $this->db->where_not_in('PurchaseType', "LOC")->get('inventory_purchase_type');
            return $PurchaseType->result_array();
        } else {
            $PurchaseType = $this->db->where('idPurchaseType', $idPurchaseType)->get('inventory_purchase_type');
            return $PurchaseType->result_array();
        }
    }

    function AddPurchaseType($PurchaseType) {
        $insert = $this->db->insert('inventory_purchase_type', $PurchaseType);
        if ($insert) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function EditPurchaseType($idPurchaseType, $PurchaseTypeData) {
        $this->db->where('idPurchaseType', $idPurchaseType);
        $EditPurchaseType = $this->db->update('inventory_purchase_type', $PurchaseTypeData);
        if ($EditPurchaseType) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function SearchPurchaseType($Keyword) {
        $PurchaseType = $this->db->select('*')->from('inventory_purchase_type')->like('PurchaseType', $Keyword)->get();
        return $PurchaseType->result_array();
    }

    function fillPurchaseTypeCombo() {
         $user =  unserialize($_COOKIE["logindata"]);
        if($user['username'] != "Talib")
        $sql_query = 'select idPurchaseType, PurchaseType from inventory_purchase_type';
        else
        $sql_query = 'select idPurchaseType, PurchaseType from inventory_purchase_type where `PurchaseType` != "LOC"';
//        var_dump($this->session->all_userdata());die;
        $query = $this->db->query($sql_query);
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

    function fillPartComboCombo() {
        $query = $this->db->query('select idPart, PartName from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartName" => $dropdown->PartName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function CheckOrderNumber($OrderNumber) {
        $Serial = $this->db->query("select PboSerialNumber from car_pbo where PboSerialNumber = '" . $PboSerial . "' ");
        $Availability = $Serial->result_array();
        if ($Availability == null) {
            return "Available";
        } else {
            return "Already Exists";
        }
    }

    //Adding Function after Login Module
    function Payable($idParty, $netTotal) {

        $isExistPayable = $this->isExistPayable($idParty);
        if ($isExistPayable != NULL) {
            $payableAmount = $isExistPayable[0]['PayableAmount'] + $netTotal;
            $payableData = array(
                'PayableAmount' => $payableAmount,
                'PayableDate' => $this->getFieldsValue()['PayableDate'],
                'PayableTime' => $this->getFieldsValue()['PayableTime'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            );
            $updatePayable = $this->updatePayable($isExistPayable[0]['idPayable'], $payableData);
            if ($updatePayable === "Payable Updated Successfully") {
                return True;
            }
        } else {
            $payableData = array(
                'idParty' => $idParty,
                'PayableAmount' => $netTotal,
                'FromDepartment' => 'PartsDepartment',
                'PayableDate' => $this->getFieldsValue()['PayableDate'],
                'PayableTime' => $this->getFieldsValue()['PayableTime'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $createPayable = $this->createPayable($payableData);
            if ($createPayable === "Payable Created Successfully") {
                return True;
            }
        }
    }

    function isExistPayable($idParty) {
        $whereClause = "idParty = '$idParty' AND FromDepartment = 'PartsDepartment' AND isActive = 1";
        $this->db->select('*');
        $this->db->from('f_payable');
        $this->db->where($whereClause);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return $isExist->result_array();
        }
    }

    function createPayable($payableData) {
        $this->db->insert('f_payable', $payableData);
        return "Payable Created Successfully";
    }

    function updatePayable($idPayable, $payableData) {
        $this->db->where('idPayable', $idPayable);
        $this->db->update('f_payable', $payableData);
        return "Payable Updated Successfully";
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "PayableDate" => date("Y-m-d"), "PayableTime" => date("H:i:s"));
        return $fieldsValue;
    }
	
	 function insertPurchaseReturn() {
        return $this->db->insert('inventory_purchase_return', $this->input->post());
    }

    function subtractPartQuantity($idPart, $quantity) {
        $this->db->where('idPart', $idPart);
        $query = $this->db->get('parts_name')->row();
        $lastquantity = $query->Quantity;
        $quantity = $lastquantity - $quantity;

        $this->db->where('idPart', $idPart);
        return $this->db->update('parts_name', array('Quantity' => $quantity));
//        
    }

    function getPurchaseReturn($idPurchase, $idPart, $type) {

        $this->db->where('idPart', $idPart);
        $this->db->where('type', $type);
        $this->db->where('idPurchase', $idPurchase);
        $query = $this->db->get('inventory_purchase_return')->result_array();
        return $query;
    }

    function getAllPurchaseReturn() 
    {
        
        $query = $this->db->query('select pr.idPurchaseReturn,pr.idPurchase,pr.IdPart,pn.PartNumber,pn.PartName,pr.ReturnQuantity,pr.`type`,pr.CreatedDate,
imc.QuantityReceived as Quantity,imc.InvoiceNumber
from inventory_purchase_return pr

left join inventory_purchase_imc imc
on imc.idPurchaseImc=pr.idPurchase && pr.IdPart=imc.PartId

left join parts_name pn
on imc.PartId=pn.idPart

where  pr.`type`="imc"
order by pr.idPurchaseReturn desc
');


        $imc = $query->result_array();


        $query = $this->db->query('select pr.idPurchaseReturn,pr.idPurchase,pr.IdPart,pn.PartNumber,pn.PartName,pr.ReturnQuantity,pr.`type`,pr.CreatedDate,
loc.PurchaseQuantity as Quantity, loc.InvoiceNumber
from inventory_purchase_return pr

left join inventory_purchase_local loc
on loc.idPurchaseLocal=pr.idPurchase && pr.IdPart=loc.PartId

left join parts_name pn
on loc.PartId=pn.idPart

where  pr.`type`="loc"
order by pr.idPurchaseReturn desc
');
        
        $loc = $query->result_array();
        
        $data = array_merge($imc,$loc);
        
        return $data;
//        var_dump($imc);
//        var_dump($loc);
//        var_dump($data);
    }

}
