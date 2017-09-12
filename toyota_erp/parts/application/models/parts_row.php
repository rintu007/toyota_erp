<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts_row extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allRow() {
        $this->db->select('*');
        $this->db->from('rows_parts');
        $this->db->join('parts_zone', 'rows_parts.ZoneId = parts_zone.idZone');
        $this->db->join('parts_warehouse', 'rows_parts.WarehouseId = parts_warehouse.idWarehouse');
        $PartRow = $this->db->get();
        return $PartRow->result_array();
    }

    function oneRow($idRow) {
        $PartRow = $this->db->select('*')->from('parts_row')->where('idRow', $idRow)->get();
        return $PartRow->result_array();
    }

    function insertRow($RowData) {
        $ToRow = $this->input->post('ToRow');
        $FromRow = $this->input->post('FromRow');
        $Zone = $this->input->post('ZoneId');
        $query = $this->db->query("select ZoneName from parts_zone where idZone = {$Zone}");
        $ZoneName = $query->result_array()[0];
        $validation = $this->db->query("SELECT RowNumber FROM rows_parts where RowNumber = '" . $ZoneName['ZoneName'] . $ToRow . "'");
        $test = $validation->result_array();
        $arr = array();
        $AllRows = array();
        for ($row = $ToRow; $row <= $FromRow; $row++) {
            if ($FromRow <= 9) {
                $PartRows = array(
                    'To' => $ToRow,
                    'From' => $FromRow,
                    'RowNumber' => $ZoneName['ZoneName'] . "0" . $row,
                    'ZoneId' => $this->input->post('ZoneId'),
                    'WarehouseId' => $this->input->post('WarehouseId')
                );
            } else {
                $PartRows = array(
                    'To' => $ToRow,
                    'From' => $FromRow,
                    'RowNumber' => $ZoneName['ZoneName'] . $row,
                    'ZoneId' => $this->input->post('ZoneId'),
                    'WarehouseId' => $this->input->post('WarehouseId')
                );
            }

            array_push($AllRows, $ZoneName['ZoneName'] . $row);
            $validation = $this->db->query("SELECT RowNumber FROM rows_parts where RowNumber = '" . $ZoneName['ZoneName'] . $row . "'");
            $test = $validation->result_array();
            if (empty($test)) {
//                $InsertRack = $this->db->insert('rows_parts', $PartRows);
                $this->db->insert('rows_parts', $PartRows);
//                if ($InsertRack) {
//                    return TRUE;
//                } else {
//                    return FALSE;
//                }
            } else {
                array_push($arr, $ZoneName['ZoneName'] . $row);
//                $arr[] = $ZoneName['ZoneName'] . $row;
            }
        }
        return $arr;
    }

//else {
//            for ($row = $ToRow; $row <= $FromRow; $row++) {
//                $PartRows = array(
//                    'To' => $ToRow,
//                    'From' => $FromRow,
//                    'RowNumber' => $ZoneName['ZoneName'] . $row,
//                    'ZoneId' => $this->input->post('ZoneId'),
//                    'WarehouseId' => $this->input->post('WarehouseId')
//                );
//                $validation = $this->db->query("SELECT RowNumber FROM rows_parts where RowNumber = '" . $ZoneName['ZoneName'] . '0' . $row . "'");
//                $test = $validation->result_array();
//                if (empty($test)) {
////                    print_r($PartRows);
//                    echo "<br> Test Else Array: <br>";
//                    print_r($test);
//                    $InsertRack = $this->db->insert('rows_parts', $PartRows);
////                    if ($InsertRack) {
////                        return "Successfully Inserted";
////                    } else {
////                        return "Already Exist";
////                    }
//                } else {
//                    $arr[] = $ZoneName['ZoneName'] . "0" . $row;
////                    return $arr;
//                    echo "<br><br><br><br>Else: Array of already Exists: <br>";
//                    print_r($arr);
//                }
//            }
//        }
    function deleteRow($idRow) {
        $this->db->where('idRow', $idRow);
        $this->db->delete('parts_row');
    }

    function updateRow($RowData, $idRow) {
        $this->db->where('id', $idRow);
        $this->db->update('rows_parts', $RowData);
    }

    function searchRow($SearchKeyword) {
        $this->db->select('*');
        $this->db->from('parts_row');
        $this->db->join('parts_zone', 'parts_row.ZoneId = parts_zone.idZone');
        $this->db->join('parts_warehouse', 'parts_row.WarehouseId = parts_warehouse.idWarehouse');
        $this->db->like('parts_row.To', $SearchKeyword);
        $this->db->or_like('parts_row.From', $SearchKeyword);
        $SearchRow = $this->db->get();
        return $SearchRow->result_array();
    }

    function fillZoneCombo() {
        $query = $this->db->query('select distinct idZone, ZoneName from parts_zone');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idZone" => $dropdown->idZone, "ZoneName" => $dropdown->ZoneName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillWarehouseCombo() {
        $query = $this->db->query('select distinct idWarehouse, Name from parts_warehouse');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["idWarehouse" => $dropdown->idWarehouse, "Name" => $dropdown->Name]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

}
