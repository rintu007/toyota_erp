<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_pbo extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function onePBO($PBOid = '') {
//        echo $PBOid;
//        echo 'majid';
        $this->db->select('*');
        $this->db->from('car_pbo');
        $this->db->where('car_pbo.Id', $PBOid);
        $result = $this->db->get();
        return $result->result_array()[0];
    }

    function allPbo() {
        $this->db->select('IdPbo', 'ResourcebookId', 'PayorderNumber', 'PayorderImage', 'PboOpeningDate', 'DispatchNote', 'ChasisNumber', 'EngineNumber', 'Pdi', 'GatepassNumber', 'Is_partial', 'Is_partial_amount');
        $pbo = $this->db->get('car_pbo');

        return $pbo->result_array();
    }

     function insertPbo($pboData, $VariantId, $DeliveryMonth, $ColorId, $AllocationType, $imgPbo) {
//        print_r($pboData);
//        die;
        $IdCustomerrr = $this->input->post('customer');
        $NameOfInvoiceee = $this->input->post('nameofInvoice');
        $NameOfIndividualll = $this->input->post('NameOfIndividual');


        $this->db->where('IdCustomer', $IdCustomerrr);
        $this->db->set('NameOfInvoice', $NameOfInvoiceee);
        $this->db->set('NameOfIndividual', $NameOfIndividualll);
        $this->db->update('car_customer');
//        die;
        $this->db->select('BalanceQuantity, ConsumedQuantity');
        $this->db->where('VariantId', $VariantId);
        // $this->db->where('ColorId', $ColorId);
        $this->db->where('AllocationTypeId', $AllocationType);
        $this->db->where('Month', $DeliveryMonth);
        $Quantity = $this->db->get('car_allocation');
        $result_array = $Quantity->result_array();
        $BalanceQty = $result_array[0]['BalanceQuantity'];
        $ConsumedQty = $result_array[0]['ConsumedQuantity'];
        if ($BalanceQty <= 0) {
            return "Your Selected Vairant Is Not Available In This Month.";
        } else {
            $this->db->trans_start();

            $isPboCreated = array(
                'isPboCreated' => 1,
//                'NameOfInvoice' => $this->input->post('nameofInvoice'),
//                'NameOfIndividual' => $this->input->post('NameOfIndividual')
            );

            if ($this->input->post('order_type') == 4) {
                $this->db->trans_start();
                $this->db->where('idResourcebook', $this->input->post('idRes'));
                $this->db->update('car_resource_book', $isPboCreated);

                $ChasisNo = $this->input->post('ChasisNumber');
                $EngineNo = $this->input->post('EngineNumber');

                $EFAmount = $this->input->post('amount');
                $FIAmount = $this->input->post('Freightamount');
                $TotalAmount = $EFAmount + $FIAmount;

                $pbo = array(
                    'PboNumber' => $this->input->post('PboNumber'),
                    'ActualSalePerson' => $this->input->post('ActualSalePerson'),
                    'ResourcebookId' => $this->input->post('idRes'),
                    'PayorderNumber' => $this->input->post('payOrderNo'),
                    'PayorderImage' => $imgPbo,
                    'PboOpeningDate' => $this->input->post('OpeningDate'),
                    'AllocationMonth' => $this->input->post('allocation_month'),
                    'AllocationTypeId' => $this->input->post('allocation_type'),
                    'OrderTypeId' => $this->input->post('order_type'),
                    'ChasisNumber' => $ChasisNo,
                    'EngineNumber' => $EngineNo,
                    'ExFactoryPO' => $this->input->post('efPO'),
                    'BankName' => $this->input->post('BankName'),
                    'BankBranch' => $this->input->post('BankBranch'),
                    'BankCity' => $this->input->post('BankCity'),
                    'EFAmount' => $this->input->post('amount'),
                    'FIType' => $this->input->post('FIler'),
                    'FIPO' => $this->input->post('fiPO'),
                    'FIPONumber' => $this->input->post('fiPayOrder'),
                    'FIBankName' => $this->input->post('fiBankName'),
                    'FIBankBranch' => $this->input->post('fiBankBranch'),
                    'FIBankCity' => $this->input->post('fiBankCity'),
                    'FIAmount' => $this->input->post('Freightamount'),
                    'TotalAmount' => $TotalAmount,
                    'PurchaseOrderNumber' => $this->input->post('PurchaseOrder'),
                    'PurchaseDate' => $this->input->post('PurchaseDate'),
                    'PboSerialNumber' => $this->input->post('PboSerial'),
                    'InvoiceCreated' => 0
                );

                $this->db->insert('car_pbo', $pbo);
                $insert_id = $this->db->insert_id();
                $this->db->query("UPDATE car_allocation SET BalanceQuantity = {$BalanceQty}-1, ConsumedQuantity = {$ConsumedQty}+1 WHERE VariantId = '{$VariantId}' AND Month = '{$DeliveryMonth}' AND ColorId = '{$ColorId}' AND AllocationTypeId = '{$AllocationType}'");
                $this->db->select('idDispatch');
                $this->db->where('EngineNo', $EngineNo);
                $this->db->where('ChasisNo', $ChasisNo);
                $Dispatch = $this->db->get('car_dispatch');
                $idDispatch = $Dispatch->result_array();
                $DispatchId = $idDispatch[0]['idDispatch'];
                $this->db->where('idDispatch', $DispatchId);
                $this->db->set('PboId', $insert_id);
                $this->db->update('car_dispatch');
                $this->db->trans_complete();
                /* if($this->input->post('efPO') == 'PartialPayment')
                  {
                  $chequeone = $this->input->post('ChequeOne');
                  $chequetwo = $this->input->post('ChequeTwo');
                  $chequethree = $this->input->post('ChequeThree');
                  $partial = array(
                  'PboNumber' => $this->input->post('PboNumber'),
                  'ActualSalePerson' => $this->input->post('ActualSalePerson'),
                  'ChequeOne' => $chequeone,
                  'ChequeTwo' => $chequetwo,
                  'ChequeThree' => $chequethree,
                  'BankOne' => $this->input->post('BankOne'),
                  'BranchOne' => $this->input->post('BranchOne'),
                  'BankTwo' => $this->input->post('BankTwo'),
                  'BranchTwo' => $this->input->post('BranchTwo'),
                  'BankThree' => $this->input->post('BankThree'),
                  'BranchThree' =>$this->input->post('BranchThree'),
                  );
                  $this->db->insert('car_partial_amount', $partial);

                  } */
                return "PBO Has Been Generated.";
            } else if ($this->input->post('order_type') == 3) {
                $this->db->trans_start();
                $this->db->where('idResourcebook', $this->input->post('idRes'));
                $this->db->update('car_resource_book', $isPboCreated);

                $ChasisNo = $this->input->post('ChasisNumber');
                $EngineNo = $this->input->post('EngineNumber');

                $EFAmount = $this->input->post('amount');
                $FIAmount = $this->input->post('Freightamount');
                $TotalAmount = $EFAmount + $FIAmount;

                $pbo = array(
                    'PboNumber' => $this->input->post('PboNumber'),
                    'ActualSalePerson' => $this->input->post('ActualSalePerson'),
                    'ResourcebookId' => $this->input->post('idRes'),
                    'PayorderNumber' => $this->input->post('payOrderNo'),
                    'PayorderImage' => $imgPbo,
                    'PboOpeningDate' => $this->input->post('OpeningDate'),
                    'AllocationMonth' => $this->input->post('allocation_month'),
                    'AllocationTypeId' => $this->input->post('allocation_type'),
                    'OrderTypeId' => $this->input->post('order_type'),
                    'ExFactoryPO' => $this->input->post('efPO'),
                    'ChasisNumber' => $ChasisNo,
                    'EngineNumber' => $EngineNo,
                    'BankName' => $this->input->post('BankName'),
                    'BankBranch' => $this->input->post('BankBranch'),
                    'BankCity' => $this->input->post('BankCity'),
                    'EFAmount' => $this->input->post('amount'),
                    'FIType' => $this->input->post('FIler'),
                    'FIPO' => $this->input->post('fiPO'),
                    'FIPONumber' => $this->input->post('fiPayOrder'),
                    'FIBankName' => $this->input->post('fiBankName'),
                    'FIBankBranch' => $this->input->post('fiBankBranch'),
                    'FIBankCity' => $this->input->post('fiBankCity'),
                    'FIAmount' => $this->input->post('Freightamount'),
                    'TotalAmount' => $TotalAmount,
                    'PurchaseOrderNumber' => $this->input->post('PurchaseOrder'),
                    'PurchaseDate' => $this->input->post('PurchaseDate'),
                    'PboSerialNumber' => $this->input->post('PboSerial'),
                    'InvoiceCreated' => 0
                );

                $this->db->insert('car_pbo', $pbo);
                $insert_id = $this->db->insert_id();
                $this->db->query("UPDATE car_allocation SET BalanceQuantity = {$BalanceQty}-1, ConsumedQuantity = {$ConsumedQty}+1 WHERE VariantId = '{$VariantId}' AND Month = '{$DeliveryMonth}' AND ColorId = '{$ColorId}' AND AllocationTypeId = '{$AllocationType}'");
                $this->db->select('idDispatch');
                $this->db->where('EngineNo', $EngineNo);
                $this->db->where('ChasisNo', $ChasisNo);
                $Dispatch = $this->db->get('car_dispatch');
                $idDispatch = $Dispatch->result_array();
                $DispatchId = $idDispatch[0]['idDispatch'];
                $this->db->where('idDispatch', $DispatchId);
                $this->db->set('PboId', $insert_id);
                $this->db->update('car_dispatch');
                $this->db->trans_complete();
                return "PBO Has Been Generated.";
            } else if ($this->input->post('order_type') == 5) {
                $this->db->trans_start();
                $EFAmount = $this->input->post('amount');
                $FIAmount = $this->input->post('Freightamount');
                $TotalAmount = $EFAmount + $FIAmount;
                $pboData = array(
                    'PboNumber' => $this->input->post('PboNumber'),
                    'ActualSalePerson' => $this->input->post('ActualSalePerson'),
                    'ResourcebookId' => $this->input->post('idRes'),
                    'PayorderNumber' => $this->input->post('payOrderNo'),
                    'PayorderImage' => $imgPbo,
                    'PboOpeningDate' => $this->input->post('OpeningDate'),
                    'AllocationTypeId' => $this->input->post('allocation_type'),
                    'AllocationMonth' => $this->input->post('allocation_month'),
                    'OrderTypeId' => $this->input->post('order_type'),
                    'ChasisNumber' => NULL,
                    'EngineNumber' => NULL,
                    'ExFactoryPO' => $this->input->post('efPO'),
                    'BankName' => $this->input->post('BankName'),
                    'BankBranch' => $this->input->post('BankBranch'),
                    'BankCity' => $this->input->post('BankCity'),
                    'EFAmount' => $this->input->post('amount'),
                    'FIType' => $this->input->post('Filer'),
                    'FIPO' => $this->input->post('fiPO'),
                    'FIPONumber' => $this->input->post('fiPayOrder'),
                    'FIBankName' => $this->input->post('fiBankName'),
                    'FIBankBranch' => $this->input->post('fiBankBranch'),
                    'FIBankCity' => $this->input->post('fiBankCity'),
                    'FIAmount' => $this->input->post('Freightamount'),
                    'TotalAmount' => $TotalAmount,
                    'PurchaseOrderNumber' => $this->input->post('PurchaseOrder'),
                    'PurchaseDate' => $this->input->post('PurchaseDate'),
                    'PboSerialNumber' => $this->input->post('PboSerial'),
                    'InvoiceCreated' => 0,
                    'Is_partial' => 1,
                    'Is_partial_amount' => $TotalAmount,
                );
                $this->db->where('idResourcebook', $this->input->post('idRes'));
                $this->db->update('car_resource_book', $isPboCreated);
                $this->db->insert('car_pbo', $pboData);
                $this->db->insert_id();
                $this->db->query("UPDATE car_allocation SET BalanceQuantity = {$BalanceQty}-1, ConsumedQuantity = {$ConsumedQty}+1 WHERE VariantId = '{$VariantId}' AND Month = '{$DeliveryMonth}' AND ColorId = '{$ColorId}' AND AllocationTypeId = '{$AllocationType}'");

                //-------- New Code ------///
                $chequeone = $this->input->post('ChequeOne');
                $chequetwo = $this->input->post('ChequeTwo');
                $chequethree = $this->input->post('ChequeThree');
                $partial = array(
                    'PboNumber' => $this->input->post('PboNumber'),
                    //'ActualSalePerson' => $this->input->post('ActualSalePerson'),
                    'ChequeOne' => $chequeone,
                    'ChequeTwo' => $chequetwo,
                    'ChequeThree' => $chequethree,
                    'BankOne' => $this->input->post('BankOne'),
                    'BranchOne' => $this->input->post('BranchOne'),
                    //'BankTwo' => $this->input->post('BankTwo'),
                    //'BranchTwo' => $this->input->post('BranchTwo'),
                    //'BankThree' => $this->input->post('BankThree'),
                    //'BranchThree' =>$this->input->post('BranchThree'),
                    'ChequeNoOne' => $this->input->post('Chequeoneno')
                );
                $this->db->insert('car_partial_amount', $partial);
                $this->db->trans_complete();
                return "PBO Has Been Generated.";
            } else {
                $this->db->trans_start();
                $this->db->where('idResourcebook', $this->input->post('idRes'));
                $this->db->update('car_resource_book', $isPboCreated);
                $this->db->insert('car_pbo', $pboData);
                $this->db->insert_id();
                $this->db->query("UPDATE car_allocation SET BalanceQuantity = {$BalanceQty}-1, ConsumedQuantity = {$ConsumedQty}+1 WHERE VariantId = '{$VariantId}' AND Month = '{$DeliveryMonth}' AND ColorId = '{$ColorId}' AND AllocationTypeId = '{$AllocationType}'");
                $this->db->trans_complete();
                //-------- New Code ------///
           //     $chequeone = $this->input->post('ChequeOne');
           //     $chequetwo = $this->input->post('ChequeTwo');
           //     $chequethree = $this->input->post('ChequeThree');
           //     $partial = array(
             //       'PboNumber' => $this->input->post('PboNumber'),
             //       //'ActualSalePerson' => $this->input->post('ActualSalePerson'),
             //       'ChequeOne' => $chequeone,
               //     'ChequeTwo' => $chequetwo,
               //     'ChequeThree' => $chequethree,
               //     'BankOne' => $this->input->post('BankOne'),
                //    'BranchOne' => $this->input->post('BranchOne'),
                    //'BankTwo' => $this->input->post('BankTwo'),
                    //'BranchTwo' => $this->input->post('BranchTwo'),
                    //'BankThree' => $this->input->post('BankThree'),
                    //'BranchThree' =>$this->input->post('BranchThree'),
            //        'ChequeNoOne' => $this->input->post('Chequeoneno')
            //    );
            //    $this->db->insert('car_partial_amount', $partial);
                return "PBO Has Been Generated.";
            }

            $color2 = $this->input->post('color_choice_two');
            $color1 = $this->input->post('color_choice_one');
            $this->db->where('idResourcebook', $this->input->post('idRes'));
            $this->db->set('Color2', $color2);
            $this->db->set('Color1', $color1);
            $this->db->update('car_resource_book');
            $this->db->trans_complete();
        }
    }

    function updatePBOO($pboData) {
        $this->db->where('Id', $pboData['Id']);
        $this->db->update('car_pbo', $pboData);
        return $this->db->affected_rows();
    }

    function updatePBOPartial($pboData) {
        $this->db->where('PboNumber', $pboData['PboNumber']);
        $this->db->update('car_partial_amount', $pboData);
        return $this->db->affected_rows();
    }

    function updateCustomer($pboData) {
        $this->db->where('IdCustomer', $pboData['idCustomer']);
        $this->db->update('car_customer', $pboData);
        return $this->db->affected_rows();
    }

    function updatePbo($pboID, $pboData) {
        $this->db->where('IdPbo', $pboID);
        $this->db->update('car_pbo', $pboData);
    }

    function deletePbo($pboID) {
        $this->db->where('IdPbo', $pboID);
        $this->db->delete('car_pbo');
    }

    function AllocationMonth($AllocationType, $AllocationColor, $AllocationVariant) {
        $AllocatioMonth = $this->db->query("select Month from car_allocation where AllocationTypeId = '" . $AllocationType . "'AND VariantId = '" . $AllocationVariant . "'");
        $Month = $AllocatioMonth->result_array();
        return $Month;
    }

    function AllocationValidity($AllocationType, $AllocationColor, $AllocationVariant, $AllocationMonth) {
        $AllocatioMonth = $this->db->query("select BalanceQuantity from AllocationValidity where AllocationTypeId = '" . $AllocationType . "' AND VariantId = '" . $AllocationVariant . "' AND Month = '" . $AllocationMonth . "'");
        $Month = $AllocatioMonth->result_array();
        if ($Month == null) {
            return "Expired";
        } else if ($Month[0]['BalanceQuantity'] > 0) {
            return $Month[0]['BalanceQuantity'];
        } else {
            return "No Balance";
        }
    }

    function OpenStock($AllocationColor, $AllocationVariant) {
        $OpenStock = $this->db->query("SELECT car_dispatch.ChasisNo,car_dispatch.EngineNo,car_dispatch.ColorId,car_dispatch.VariantId
                                    FROM car_dispatch WHERE car_dispatch.PboId IS NULL AND car_dispatch.VariantId = '" . $AllocationVariant . "' AND
                                    car_dispatch.ColorId = '" . $AllocationColor . "'");
        $AgainstOpenStock = $OpenStock->result_array();
        return $AgainstOpenStock;
    }

    function CheckPboSerial($PboSerial) {
        $Serial = $this->db->query("select PboSerialNumber from car_pbo where PboSerialNumber = '" . $PboSerial . "' ");
        $Availability = $Serial->result_array();
        if ($Availability == null) {
            return "Available";
        } else {
            return "Already Exists";
        }
    }

    function CheckPboNumber($PboNumber) {
        $Number = $this->db->query("select PboNumber from car_pbo where PboNumber = '" . $PboNumber . "' ");
        $Availability = $Number->result_array();
        if ($Availability == null) {
            return "Available";
        } else {
            return "Already Exists";
        }
    }

    function PartialPayment($limit = '', $start = '') {
//        $partialpayment = $this->db->query("SELECT cp.PboNumber , cr.ResourcebookId , cr.ChasisNumber , cr.EngineNumber , cr.TotalAmount , cp.ChequeOne ,cp.ChequeTwo , cp.ChequeThree
//      FROM car_partial_amount cp
//      LEFT JOIN car_pbo cr
//      ON cp.PboNumber = cr.PboNumber;");
        $this->db->select('cp.PboNumber , cr.ResourcebookId , cr.ChasisNumber , cr.EngineNumber , cr.TotalAmount , cp.ChequeOne ,cp.ChequeTwo , cp.ChequeThree');
        $this->db->from('car_partial_amount cp');
        $this->db->join('car_pbo cr', 'cp.PboNumber = cr.PboNumber', 'LEFT');
        if (($limit)) {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('cp.Id', 'DESC');
        $query = $this->db->get();
        $amount = $query->result_array();
        return $amount;
    }

    function ReceiveAmount($pbonumber) {
        $receive = $this->db->query("select * from view_partialdetail where PboNumber = " . $pbonumber);
        $rcvamount = $receive->result_array();
//		var_dump
        return $rcvamount;
    }

    function UpdateAmount($pbo) {
        $Amount = array(
            'ChequeOne' => $this->input->post('ChequeOne'),
            'ChequeTwo' => $this->input->post('ChequeTwo'),
            'ChequeThree' => $this->input->post('ChequeThree'),
            'BankOne' => $this->input->post('BankOne'),
            'BranchOne' => $this->input->post('BranchOne'),
            'BankTwo' => $this->input->post('BankTwo'),
            'BranchTwo' => $this->input->post('BranchTwo'),
            'BankThree' => $this->input->post('BankThree'),
            'BranchThree' => $this->input->post('BranchThree'),
            'ChequeNoOne' => $this->input->post('ChequeNoOne'),
            'ChequeNoTwo' => $this->input->post('ChequeNoTwo'),
            'ChequeNoThree' => $this->input->post('ChequeNoThree'),
        );

        $this->db->where('PboNumber', $pbo);
        $this->db->update('car_partial_amount', $Amount);

        $this->db->select('*');
        $this->db->from('car_pbo');
        $this->db->where('PboNumber', $pbo);
        $return = $this->db->get();
        $query = $return->result_array()[0];
        
        if ($query) {
             $pboTotalAmount = array(
                'PboNumber' => $pbo,
                'Is_partial_amount' => $query['TotalAmount'],
            );
            $this->db->where('PboNumber', $pbo);
            $this->db->update('car_pbo', $pboTotalAmount);
            
             $this->db->select('*');
            $this->db->from('car_pbo');
            $this->db->where('PboNumber', $pbo);
            $return2 = $this->db->get();
            $query2 = $return2->result_array()[0];
            $pboDetail = array(
                'PboNumber' => $pbo,
                'Is_partial_amount' => $query2['Is_partial_amount'] - ($Amount['ChequeOne'] + $Amount['ChequeTwo'] + $Amount['ChequeThree']),
            );
             
            $this->db->where('PboNumber', $pbo);
            $this->db->update('car_pbo', $pboDetail);
//            die;
        }

//        return true;
    }

}
