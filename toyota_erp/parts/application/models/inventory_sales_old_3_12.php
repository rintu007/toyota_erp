<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Inventory_sales extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function AllSales($filterByDate = NULL, $idSale = NULL) {
        if ($idSale != NULL) {
            $this->db->select('*');
            $this->db->join('inventory_sale', 'inventory_sale_detail.SaleId = inventory_sale.idSale');
            $this->db->join('parts_name', 'inventory_sale_detail.PartId = parts_name.idPart');
            $this->db->join('inventory_sale_type', 'inventory_sale.SaleTypeId = inventory_sale_type.idSaleType');
            $this->db->join('inventory_party', 'inventory_sale.PartyId = inventory_party.idParty');
            $this->db->where('inventory_sale.idSale', $idSale);
			$this->db->order_by('InvoiceDate','desc');
            $SaleDetail = $this->db->get('inventory_sale_detail');
            //echo "QQQ:" . $this->db->last_query();
        } else {
            $this->db->select('*');
            $this->db->join('inventory_sale', 'inventory_sale_detail.SaleId = inventory_sale.idSale');
            $this->db->join('parts_name', 'inventory_sale_detail.PartId = parts_name.idPart');
            $this->db->join('inventory_sale_type', 'inventory_sale.SaleTypeId = inventory_sale_type.idSaleType');
            $this->db->join('inventory_party', 'inventory_sale.PartyId = inventory_party.idParty');
            if ($filterByDate != NULL) {
                $this->db->where('inventory_sale.SaleDate BETWEEN "' . $filterByDate["fromDate"] . '" AND "' . $filterByDate["toDate"] . '"');
            }
			$this->db->order_by('InvoiceDate','desc');
			$SaleDetail = $this->db->get('inventory_sale_detail');
        }

        return $SaleDetail->result_array();
    }

    function AddSales() {
        $this->db->trans_start();
        $SaleItem = array();
        $SalesData = array(
            'SaleTypeId' => $this->input->post('idSaleType'),
            'PartyId' => $this->input->post('idParty'),
            'SaleDate' => $this->input->post('SaleDate'),
            'Discount' => $this->input->post('TotalDiscount'),
            'TotalAmount' => $this->input->post('TotalAmount')
        );
        $transactionData = array(
            'PartyId' => $this->input->post('idParty'),
            'Discount' => $this->input->post('TotalDiscount'),
            'TotalAmount' => $this->input->post('TotalAmount'),
            'PaymentReceived' => $this->input->post('PaymentReceived'),
            'Balance' => $this->input->post('Balance'),
            'GST' => $this->input->post('SalesTax'),
            'PaymentType' => $this->input->post('PaymentMode')
        );

        $this->db->insert('inventory_sale', $SalesData);
        $idSale = $this->db->insert_id();

        $Parts = $_POST['parts'];
        $Quantity = $_POST['quantity'];
//        $GrnNo = $_POST['GrnNo'];
        $RetailPrice = $_POST['unitprice'];
        $CostPrice = $_POST['costprice'];
        $TotalCost = $_POST['totalcost'];
        $InvoiceNumber = explode('-',$_POST['InvoiceNumber']);
        $InvoiceDate = $_POST['InvoiceDate'];
        $CustomerName = $_POST['CustomerName'];
        $MobileNumber = $_POST['MobileNumber'];
        $TotalPrice = $_POST['totalprice'];

        for ($i = 0; $i < count($_POST['parts']); $i++) {
            $SaleItem[] = array(
                'SaleId' => $idSale,
                'PartId' => $Parts[$i],
                'SaleQuantity' => $Quantity[$i],
                'SalePrice' => $RetailPrice[$i],
                'TotalPrice' => $TotalPrice[$i],
                'CostPrice' => $CostPrice[$i],
                'TotalCost' => $TotalCost[$i],
                'Discount' => NULL, // Individual Discount Not Required
//                'GrnNo' => $GrnNo,
                'InvoiceNumber' => $InvoiceNumber[2],
                'CustomerName' => $CustomerName,
                'MobileNumber' => $MobileNumber,
                'InvoiceDate' => $InvoiceDate
            );
            $partQuantity = $this->getPartQuantity($Parts[$i])[0];
            if ($partQuantity['Quantity'] < $Quantity[$i]) {
                $this->db->trans_rollback();
//                echo $Quantity[$i];
//                print_r($partQuantity);
//                exit();
                return "No Such Quantity Available. Total Quantity " . $partQuantity['Quantity'] . " Available";
            } else {

                $NewQuantity = $partQuantity['Quantity'] - $Quantity[$i];
                if ($NewQuantity < 0) {
                    $NewQuantity = 0;
                }
                $this->db->set('Quantity', $NewQuantity);
                $this->db->where('idPart', $Parts[$i]);
                $this->db->update('parts_name');
            }
            
            
        }
		$insert_batch = $this->db->insert_batch('inventory_sale_detail', $SaleItem);
		if ($insert_batch) {
                $this->Receivable($this->input->post('idParty'), $this->input->post('TotalAmount'));
                $receivable = $this->isExistReceivable($this->input->post('idParty'));
                if ($balance >= 0) {
                    $receivable = $receivable[0]['ReceiveableAmount'] - $this->input->post('TotalAmount');
                    if ($receivable <= 0) {
                        $receivable = 0;
                    }
                } else {
                    $receivable = $receivable[0]['ReceiveableAmount'] - $this->input->post['PaymentReceived'];
                    if ($receivable <= 0) {
                        $receivable = 0;
                    }
                }
                $transaction = $this->Transaction($transactionData, $receivable, $receivable[0]['idReceivable']);
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }
                if ($transaction) {
                    return "TRUE";
                } else {
                    
                }
            } else {
                return "FALSE";
            }
    }

    function getPartQuantity($idPart) {
        $Part = $this->db->select('Quantity')->from('parts_name')->where('idPart', $idPart)->get();
        return $Part->result_array();
    }

    function EditSales($idPurchase, $PurchaseData) {
        $this->db->where('idSale', $idPurchase);
        $EditPurchase = $this->db->update('inventory_sale', $PurchaseData);
        if ($EditPurchase) {
            return "Selected Sale Item Has Been Updated!";
        } else {
            return "Failed To Update The Selected Sale Item!";
        }
    }

    function DeleteSales($idSale) {
        $this->db->where('idSale', $idSale);
        $DeleteSale = $this->db->delete('inventory_sale');
        if ($DeleteSale) {
            return "Selected Sale Item Has Been Deleted!";
        } else {
            return "Failed To Delete The Selected Item!";
        }
    }

    function SearchSales($Keyword) {
        $this->db->select('*');
        $this->db->join('inventory_sale', 'inventory_sale_detail.SaleId = inventory_sale.idSale');
        $this->db->join('parts_name', 'inventory_sale_detail.PartId = parts_name.idPart');
        $this->db->join('inventory_sale_type', 'inventory_sale.SaleTypeId = inventory_sale_type.idSaleType');
        $this->db->join('inventory_party', 'inventory_sale.PartyId = inventory_party.idParty');
        $this->db->like('parts_name.PartNumber', $Keyword);
        $this->db->or_like('parts_name.PartName', $Keyword);
        $this->db->or_like('inventory_sale_type.SaleType', $Keyword);
        $SaleItems = $this->db->get('inventory_sale_detail');
        return $SaleItems->result_array();
    }

    function AllSaleType() {
        $PurchaseType = $this->db->get('inventory_sale_type');
        return $PurchaseType->result_array();
    }

    function AddSaleType($SaleType) {
        $insert = $this->db->insert('inventory_sale_type', $SaleType);
        if ($insert) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function EditSaleType($idSaleType, $SaleTypeData) {
        $this->db->where('idSaleType', $idSaleType);
        $EditPurchaseType = $this->db->update('inventory_sale_type', $SaleTypeData);
        if ($EditPurchaseType) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function SearchSaleType($Keyword) {
        $SaleType = $this->db->select('*')->from('inventory_sale_type')->like('SaleType', $Keyword)->get();
        return $SaleType->result_array();
    }

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
        $query = $this->db->query('select idPart, PartNumber from parts_name');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idPart" => $dropdown->idPart, "PartNumber" => $dropdown->PartNumber]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    //Adding Function after Login Module
    function Receivable($idParty, $netTotal) {

        $isExistReceivable = $this->isExistReceivable($idParty);
        if ($isExistReceivable != NULL) {
            $receivableAmount = $isExistReceivable[0]['ReceiveableAmount'] + $netTotal;
            $receivableData = array(
                'ReceiveableAmount' => $receivableAmount,
                'ReceivableDate' => $this->getFieldsValue()['ReceivableDate'],
                'ReceivableTime' => $this->getFieldsValue()['ReceivableTime'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
            );
            $updateReceivable = $this->updateReceivable($isExistReceivable[0]['idReceivable'], $receivableData);
            if ($updateReceivable === "Receivable Updated Successfully") {
                return True;
            }
        } else {
            $receivableData = array(
                'idParty' => $idParty,
                'ReceiveableAmount' => $netTotal,
                'FromDepartment' => 'PartsDepartment',
                'ReceivableDate' => $this->getFieldsValue()['ReceivableDate'],
                'ReceivableTime' => $this->getFieldsValue()['ReceivableTime'],
                'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
                'ModifiedDate' => $this->getFieldsValue()['ModifiedDate'],
                'isActive' => $this->getFieldsValue()['isActive']
            );
            $createReceivable = $this->createReceivable($receivableData);
            if ($createReceivable === "Receivable Created Successfully") {
                return True;
            }
        }
    }

    function isExistReceivable($idParty) {
        $whereClause = "idParty = '$idParty' AND FromDepartment = 'PartsDepartment' AND isActive = 1";
        $this->db->select('*');
        $this->db->from('f_receivable');
        $this->db->where($whereClause);
        $isExist = $this->db->get();
        if ($isExist->num_rows() > 0) {
            return $isExist->result_array();
        }
    }

    function createReceivable($receivableData) {
        $this->db->insert('f_receivable', $receivableData);
        return "Receivable Created Successfully";
    }

    function updateReceivable($idReceivable, $receivableData) {
        $this->db->where('idReceivable', $idReceivable);
        $this->db->update('f_receivable', $receivableData);
        return "Receivable Updated Successfully";
    }

    function Transaction($transactionData, $receivable, $idReceivable) {

        $transactionData = array(
            'TransactionType' => 'Receivable',
            'PaymentType' => $transactionData['PaymentType'],
            'FromDepartment' => 'PartsDepartment',
            'Description' => NULL,
            'idCustomer' => $transactionData['idParty'],
            'idVendor' => NULL,
            'Discount' => $transactionData['Discount'],
            'GST' => $transactionData['GST'],
            'NetTotal' => $transactionData['TotalAmount'],
            'PaymentAmount' => $transactionData['PaymentReceived'],
            'BalanceAmount' => $receivable,
            'TransactionDate' => $this->getFieldsValue()['TransactionDate'],
            'TransactionTime' => $this->getFieldsValue()['TransactionTime'],
            'CreatedDate' => $this->getFieldsValue()['CreatedDate'],
            'isActive' => $this->getFieldsValue()['isActive']
        );
        $createTransaction = $this->createTransaction($transactionData);
        if ($createTransaction === "Transaction Done Successfully") {
            $receivableData = array(
                'ReceiveableAmount' => $receivable,
            );
            $updateReceivable = $this->updateReceivable($idReceivable, $receivableData);
            if ($updateReceivable === "Receivable Updated Successfully") {
                return True;
            }
        }
    }

    function createTransaction($transactionData) {
        $this->db->insert('f_transaction', $transactionData);
        return "Transaction Done Successfully";
    }

    function getFieldsValue() {

        $fieldsValue = array("CreatedDate" => date("Y-m-d H:i:s"), "ModifiedDate" => date("Y-m-d H:i:s"), "isActive" => 1, "ReceivableDate" => date("Y-m-d"), "ReceivableTime" => date("H:i:s"));
        return $fieldsValue;
    }
	
	function getdiscountperitem($Saleid){
        $this->db->select('inventory_sale.Discount as Discount, inventory_sale_detail.SalePrice',false);
        $this->db->join('inventory_sale','inventory_sale.idSale = inventory_sale_detail.Saleid');
        $this->db->where('inventory_sale.idSale', $Saleid);
        $inventoysale = $this->db->get('inventory_sale_detail');
        if($inventoysale->num_rows() > 0){
            return $inventoysale->num_rows();
        }
    }


}
