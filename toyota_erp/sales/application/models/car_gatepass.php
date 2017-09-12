<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_gatepass extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function Gatepass_count()
    {
        return $this->db->count_all('car_gatepass');
    }

    function get_gatepass( $perpage = '', $limit = '')
    {

        $this->db->select('*')
            ->from('car_gatepass');
//            ->join('car_dispatch cd','pd.idDispatch=cd.idDispatch','left')
//            ->join('car_pbo pb','pb.Id = cd.PboId','left');
//
//        if(isset($_POST['idDispatch']) && $_POST['idDispatch']!='')
//        {
//            $this->db->where('pd.idDispatch', $_POST['idDispatch']);
//        }
//        if(isset($_POST['ChasisNo']) && $_POST['ChasisNo']!='')
//        {
//            $this->db->where('cd.ChasisNo', $_POST['ChasisNo']);
//        }
//        if(isset($_POST['inspectorname']) && $_POST['inspectorname']!='')
//        {
//            $this->db->like('inspectorname', $_POST['inspectorname']);
//        }
//        if(isset($_POST['created_date']) && $_POST['created_date']!='')
//        {
//            $this->db->where('date(created_date)', $_POST['created_date']);
//        }
//

        if(  $perpage != '' or  $limit!='')
            $this->db->limit($perpage, $limit);

        $this->db->order_by('idGatePass','desc');

        $query = $this->db->get();

        return $query->result_array();
    }
    function get_data($iddispatch)
    {
        $query = "SELECT car_dispatch.idDispatch,car_dispatch.ChasisNo, car_dispatch.EngineNo,car_pbo.RegistrationNumber,
                     car_pbo.PboNumber, car_dispatch.WarrantyBook, car_pbo.Id as pboid,
                     car_variants.Variants, car_color.ColorName,car_pbo.ActualSalePerson,
                     cc.*,car_invoice.idInvoice,car_invoice.InvoiceNumber,car_invoice.InvoiceDate
                    FROM car_dispatch
                    LEFT JOIN car_pbo ON car_dispatch.PboId = car_pbo.Id
                    LEFT JOIN car_resource_book ON car_pbo.ResourcebookId = car_resource_book.IdResourceBook
                    LEFT JOIN car_variants ON car_dispatch.VariantId = car_variants.IdVariants
                    LEFT JOIN car_color ON car_dispatch.ColorId = car_color.IdColor
                    LEFT JOIN car_customer cc ON cc.IdCustomer = car_resource_book.CustomerId
                    LEFT JOIN car_invoice ON car_invoice.DispatchId = car_dispatch.idDispatch
                    WHERE car_dispatch.idDispatch = $iddispatch
                                    ";
        return $this->db->query($query)->row();
    }

    function allGatepass() {
        $variants = $this->db->select('*')->from('car_gatepass')->get();
        return $variants->result_array();
    }

    function getPbo($PboNumber) {
        $variants = $this->db->select('*')->from('GatePassCreate')->where('PboNumber', $PboNumber)->get();
        return $variants->result_array();
    }

    function getSaleNote($ChasisNumber) {
        $variants = $this->db->select('*')->from('GatePassSaleNote')->where('isDelivered', 0)->where('ChasisNo', $ChasisNumber)->get();
        return $variants->result_array();
    }

    function CheckDeliver($ChasisNumber) {
        $variants = $this->db->select('*')->from('dispatchSaleNote')->where('ChasisNo', $ChasisNumber)->where('isDelivered', 0)->get();
        return $variants->result_array();
    }

    function GatePassReceipt($idGatepass) {
        $GatePass = $this->db->select('*')->from('gatepassreceipt')->where('idGatePass', $idGatepass)->get();
        return $GatePass->result_array();
    }

    function GatePassReceiptSaleNote($idGatepass) {
        $GatePass = $this->db->select('*')->from('gatepassreceiptsalenote')->where('idGatePass', $idGatepass)->get();
        return $GatePass->result_array();
    }

    function getReceiptPayment($ChasisNumber) {
        $variants = $this->db->query('SELECT * FROM ViewPayment WHERE Receipt IS NOT NULL AND ChasisNo = ' . $ChasisNumber);
        return $variants->result_array();
    }

    function getReceivablePayment($ChasisNumber) {
        $variants = $this->db->query('SELECT * FROM ViewPayment WHERE Receivable IS NOT NULL AND ChasisNo = ' . $ChasisNumber);
        return $variants->result_array();
    }

    function GatePassSerial() {
        $GatePass = $this->db->query('select COUNT("*")+1 AS GatePassNumber from car_gatepass');
        return $GatePass->result_array();
    }

    function DOSerial() {
        $GatePass = $this->db->query('select COUNT("*")+1 AS DONumber from car_do');
        return $GatePass->result_array();
    }

    function insertGatepass($GatePassData, $PboId) {
        $this->db->insert('car_gatepass', $GatePassData);
        return $this->db->insert_id();

        if ($this->input->post('gatepassType') == 'PBO') {
            $this->db->insert('car_gatepass', $GatePassData);
            $GatePassId = $this->db->insert_id();
            if ($GatePassId) {
                return $GatePassId;
            } else {
                return FALSE;
            }
        } else if ($this->input->post('gatepassType') == 'Open Stock') {
            if ($DoData == '') {
                $this->db->insert('car_gatepass', $GatePassData);
                $idGatePass = $this->db->insert_id();

                $idDispatch = $this->input->post('DispatchId');
                $this->db->where('idDispatch', $idDispatch);
                $this->db->set('isDelivered', 1);
                $this->db->update('car_dispatch');

                $idSaleNote = $this->input->post('SaleNoteId');
                $this->db->where('idSaleNote', $idSaleNote);
                $this->db->set('isDelivered', 1);
                $update = $this->db->update('car_salenote');
                if ($update) {
                    return $idGatePass;
                } else {
                    return FALSE;
                }
            } else {
                $this->db->insert('car_gatepass', $GatePassData);
                $idGatePass = $this->db->insert_id();

                $this->db->insert('car_do', $DoData);
                $DoId = $this->db->insert_id();

                $idSaleNote = $this->input->post('SaleNoteId');
                $this->db->where('idSaleNote', $idSaleNote);
                $this->db->set('DoId', $DoId);
                $this->db->update('car_salenote');

                $idDispatch = $this->input->post('DispatchId');
                $this->db->where('idDispatch', $idDispatch);
                $this->db->set('isDelivered', 1);
                $this->db->update('car_dispatch');

                $this->db->where('idSaleNote', $idSaleNote);
                $this->db->set('isDelivered', 1);
                $update = $this->db->update('car_salenote');
                if ($update) {
                    return $idGatePass;
                } else {
                    return FALSE;
                }
            }
        }
//        $this->db->trans_complete();
    }

//    function insertGatepass($GatePassData, $PboId, $DoData = '') {
////        $this->db->trans_start();
//        if ($this->input->post('gatepassType') == 'PBO') {
//            if ($DoData == '') {
//                $this->db->insert('car_gatepass', $GatePassData);
//                $GatePassId = $this->db->insert_id();
//                $PboData = array(
//                    'RegistrationNumber' => $this->input->post('RegistrationNumber'),
//                    'GatepassNumber' => $GatePassId
//                );
//                $this->db->where('Id', $PboId);
//                $PboUpdate = $this->db->update('car_pbo', $PboData);
//                if ($PboUpdate) {
//                    return $GatePassId;
//                } else {
//                    return FALSE;
//                }
//            } else {
//                $this->db->insert('car_gatepass', $GatePassData);
//                $GatePassId = $this->db->insert_id();
//
//                $this->db->insert('car_do', $DoData);
//                $DoId = $this->db->insert_id();
//
//                $PboData = array(
//                    'RegistrationNumber' => $this->input->post('RegistrationNumber'),
//                    'GatepassNumber' => $GatePassId,
//                    'DeliveryOrder' => $DoId
//                );
//                $this->db->where('Id', $PboId);
//                $PboUpdate = $this->db->update('car_pbo', $PboData);
//                if ($PboUpdate) {
//                    return $GatePassId;
//                } else {
//                    return FALSE;
//                }
//            }
//        } else if ($this->input->post('gatepassType') == 'Open Stock') {
//            if ($DoData == '') {
//                $this->db->insert('car_gatepass', $GatePassData);
//                $idGatePass = $this->db->insert_id();
//
//                $idDispatch = $this->input->post('DispatchId');
//                $this->db->where('idDispatch', $idDispatch);
//                $this->db->set('isDelivered', 1);
//                $this->db->update('car_dispatch');
//
//                $idSaleNote = $this->input->post('SaleNoteId');
//                $this->db->where('idSaleNote', $idSaleNote);
//                $this->db->set('isDelivered', 1);
//                $update = $this->db->update('car_salenote');
//                if ($update) {
//                    return $idGatePass;
//                } else {
//                    return FALSE;
//                }
//            } else {
//                $this->db->insert('car_gatepass', $GatePassData);
//                $idGatePass = $this->db->insert_id();
//
//                $this->db->insert('car_do', $DoData);
//                $DoId = $this->db->insert_id();
//
//                $idSaleNote = $this->input->post('SaleNoteId');
//                $this->db->where('idSaleNote', $idSaleNote);
//                $this->db->set('DoId', $DoId);
//                $this->db->update('car_salenote');
//
//                $idDispatch = $this->input->post('DispatchId');
//                $this->db->where('idDispatch', $idDispatch);
//                $this->db->set('isDelivered', 1);
//                $this->db->update('car_dispatch');
//
//                $this->db->where('idSaleNote', $idSaleNote);
//                $this->db->set('isDelivered', 1);
//                $update = $this->db->update('car_salenote');
//                if ($update) {
//                    return $idGatePass;
//                } else {
//                    return FALSE;
//                }
//            }
//        }
////        $this->db->trans_complete();
//    }

    function updateGatepass($idInvoice, $invoiceData) {
        $this->db->where('idGatepass', $idInvoice);
        $this->db->update('car_gatepass', $invoiceData);
    }

    function deleteGatepass($idRegistration) {
        $this->db->where('idGatepass', $idRegistration);
        $this->db->delete('car_gatepass');
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
