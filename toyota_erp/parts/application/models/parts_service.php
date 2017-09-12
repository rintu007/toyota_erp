<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_service extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function AddDispatch() {
      $idPartReqInfo = $this->input->post('partsreqinfo');
        $Part = $this->input->post('parts');
        $ReqQuantity = $this->input->post('requestquantity');
        $RecQuantity = $this->input->post('dispatchquantity');
                $remain = $this->input->post('remain');
         $manual = $this->input->post('Manulr');

        for ($i = 0; $i < count($this->input->post('parts')); $i++) {
            $RemainingQty = $ReqQuantity[$i] - $RecQuantity[$i];
            if ($RemainingQty != 0 && $RemainingQty > 0) {
                $PurchaseData[] = array(
                    'idPartsReqInfo' => $idPartReqInfo[$i],
                    'DispatchedQuantity' => $RecQuantity[$i],
                    'RemainingQuantity' => $remain[$i],
                    'manual' => $manual[$i],
                  
                    'DispatchedDate' => date('Y-m-d'),
                    'isReceived' => 0,
                    'CreatedDate' => date('Y-m-d'),
                );
            } else if ($RemainingQty == 0) {
                $isDispatched = array(
                    'isDispatched' => 1
                );
                $this->db->where('idPartsReqInfo', $idPartReqInfo[$i]);
            $this->db->update('s_partsreq_partsinfo', $isDispatched);
            } else {
                
            }
        }
        $insert_batch = $this->db->insert_batch('s_partsreceivedinfo', $PurchaseData);
        if ($insert_batch) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getRo($RoNumber) {//table

        $this->db->select('*');
        $this->db->from('view_servicerequest');    
        $this->db->where('view_servicerequest.RONumber', $RoNumber);
        $this->db->where('view_servicerequest.isDispatched', 0);
        $this->db->join('parts_name', 'view_servicerequest.PartNumber = parts_name.PartNumber', 'left');
         $this->db->join('parts_inventory', 'parts_inventory.PartId = parts_name.idPart', 'left');
        $RoDetail = $this->db->get();
        return $RoDetail->result();
    }


    function getRo1($RoNumber) {

        $this->db->select('*');
  
       $this->db->from('viewrodetail vr');
       $this->db->where('vr.RONumber', $RoNumber);
      $this->db->where('vr.isActive != 0');
     $RoDetails = $this->db->get();
        return array($RoDetails->result());
    }

    function count() {
        $query = $this->db->query("SELECT COUNT('*') as `TotalDispatch` FROM view_servicerequest WHERE isDispatched = 0");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $Count) {
                return $Count->TotalDispatch;
            }
        }
    }

}
