<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rack extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_rack');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    public function index() {
        $PartsRack = new Parts_rack();
        $Data = array();
        $invoice = new Parts_invoices();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Rack'] = $PartsRack->allRack();
        $Data['Zone'] = $PartsRack->fillZoneCombo();
        $Data['Row'] = $PartsRack->fillRowCombo();
        $Data['Alphabets'] = $PartsRack->allAlphabets();
        $Data['Warehouse'] = $PartsRack->fillWarehouseCombo();
        $this->load->view('header_parts', $Data);
        $this->load->view('rack', $Data);
        $this->load->view('footer');
    }

    function newRack() {
        $PartsRack = new Parts_rack();
//        print_r($_POST);
        $Rack = $_POST['To'];
//        $rowId = $_POST['RowId'];
//        $query = $this->db->query("select RowNumber from rows_parts where id = {$rowId}");
//        $RowNumber = $query->result_array()[0];
//        $arr = array();
//        for ($b = 0; $b < count($_POST['row1']); $b++) {
//            for ($a = $_POST['row1'][$b]; $a <= $_POST['row2'][$b]; $a++) {
//                $arr[] = array(
//                    'RackNumber' => $RowNumber['RowNumber'] . $Rack . "-" . $a,
//                    'ZoneId' => $_POST['ZoneId'],
//                    'RowId' => $rowId,
//                    'WarehouseId' => $_POST['WarehouseId']
//                );
//            }
//            $PartsRack->insertRack($arr);


        $insertRack = $PartsRack->insertRack($Rack);

//        }
        if ($insertRack) {
            redirect(base_url() . "index.php/rack/index");
        } else {
            echo "Error:::";
        }
    }

    function rackTest() {
        $Rack = $_POST['To'];
        $rowId = $_POST['RowId'];
        $query = $this->db->query("select RowNumber from rows_parts where id = {$rowId}");
        $RowNumber = $query->result_array()[0];
        $arr = array();
        for ($b = 0; $b < count($_POST['row1']); $b++) {
            for ($a = $_POST['row1'][$b]; $a <= $_POST['row2'][$b]; $a++) {
                $arr[] = array(
                    'RackNumber' => $RowNumber['RowNumber'] . $Rack . "-" . $a,
                    'ZoneId' => $_POST['ZoneId'],
                    'RowId' => $rowId,
                    'WarehouseId' => $_POST['WarehouseId']
                );
            }
//            $arr[] = array(
//                'RackNumber' => $RowNumber['RowNumber'] . $Rack . "-" . $b,
//                'ZoneId' => $_POST['ZoneId'],
//                'RowId' => $rowId,
//                'WarehouseId' => $_POST['WarehouseId']
//            );
//            array_push($arr, array(
//                'RackNumber' => $RowNumber['RowNumber'] . $Rack . "-" . $a,
//                'ZoneId' => $_POST['ZoneId'],
//                'RowId' => $rowId,
//                'WarehouseId' => $_POST['WarehouseId']
//            ));
//            $insertRack = $this->db->insert('parts_rack', $arr);
//            $insertRack = $PartsRack->insertRack($arr);
        }
        
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    function update() {
        $this->form_validation->set_rules('RackNumber', 'Rack Number', 'required|xss_clean');
        $this->form_validation->set_rules('ZoneId', 'Zone ID', 'required|xss_clean');
        $this->form_validation->set_rules('RowId', 'Row ID', 'required|xss_clean');
        $this->form_validation->set_rules('WarehouseId', 'Warehouse ID', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idRack = $this->input->post('RackId');
            $RackData = array(
                'RackNumber' => $this->input->post('RackNumber'),
                'ZoneId' => $this->input->post('ZoneId'),
                'RowId' => $this->input->post('RowId'),
                'WarehouseId' => $this->input->post('WarehouseId')
            );
            $this->Parts_rack->updateRack($RackData, $idRack);
            redirect(base_url() . "index.php/rack/index");
        }
    }

    function search() {
        $Search = $this->input->post('search');
        $InventorySearch = $this->Parts_rack->searchRack($Search);
        $PartInventory = json_encode($InventorySearch);
        print_r($PartInventory);
    }

    function getZoneByWarehouse() {
        $WarehouseId = $this->input->post('WarehouseId');
        $GetZones = $this->Parts_rack->fillZoneByWarehouse($WarehouseId);
        echo json_encode($GetZones);
    }

    function getRowByZone() {
        $ZoneId = $this->input->post('ZoneId');
        $GetRows = $this->Parts_rack->fillRowByZone($ZoneId);
        echo json_encode($GetRows);
    }

}
