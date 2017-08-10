<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_change_color extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allChangeColor() {
        $this->db->select('*');
        $this->db->from('ViewChangeColor');
//        $this->db->join('car_allocation', 'car_change_color.AllocationId = car_allocation.idAllocation');
//        $this->db->join('car_variants', 'car_allocation.VariantId = car_variants.IdVariants');
//        $this->db->join('car_allocation_type', 'car_allocation.AllocationTypeId = car_allocation_type.Id');
//        $this->db->join('car_color', 'car_change_color.ColorId = car_color.IdColor');
//        $this->db->join('car_color', '');
        $allocation = $this->db->get();
        return $allocation->result_array();
    }

    function checkAllocation() {
        $Variant = $this->input->post('variant');
        $Color = $this->input->post('color');
        $AllocationType = $this->input->post('allocationType');
        $AllocationMonth = $this->input->post('allocation_month');
    }

    function insertChangeColor($allocationData) {
        $Variant = $this->input->post('variant');
        $Color = $this->input->post('color');
        $Color2 = $this->input->post('color2');
        $Quantity = $this->input->post('quantity');
        $AllocationType = $this->input->post('allocationType');
        $AllocationMonth = $this->input->post('allocation_month');

        $this->db->select('idAllocation, BalanceQuantity, Quantity');
        $this->db->from('car_allocation');
        $this->db->where('VariantId', $Variant);
        $this->db->where('ColorId', $Color);
        $this->db->where('AllocationTypeId', $AllocationType);
        $this->db->where('Month', $AllocationMonth);
        $Validate = $this->db->get();
        $result_array = $Validate->result_array();
        echo $result_array[0]['BalanceQuantity'];
        if (empty($result_array)) {
//            return "This Color is not Available in Allocation";
            return "No Color";
        } else {
            if (!($result_array[0]['BalanceQuantity'] >= $Quantity)) {
                return "Not Available";
            } else {
//                echo "Available";
                $FromColorQuantity = $result_array[0]['BalanceQuantity'] - $Quantity;
                $FromColorQuantityDecrease = $result_array[0]['Quantity'] - $Quantity;

                $this->db->select('idAllocation, BalanceQuantity, Quantity');
                $this->db->from('car_allocation');
                $this->db->where('VariantId', $Variant);
                $this->db->where('ColorId', $Color2);
                $this->db->where('AllocationTypeId', $AllocationType);
                $this->db->where('Month', $AllocationMonth);
                $Validate = $this->db->get();
                $Color2Quantity = $Validate->result_array();
                if (empty($Color2Quantity)) {
                    return "Please Open an Allocation First.";
                } else {
                    $ToColorQuantity = $Color2Quantity[0]['BalanceQuantity'] + $Quantity;
                    $ToColorQuantityIncrease = $Color2Quantity[0]['Quantity'] + $Quantity;

                    $FromColorId = $result_array[0]['idAllocation'];
                    $FromColorData = array(
                        'BalanceQuantity' => $FromColorQuantity,
                        'Quantity' => $FromColorQuantityDecrease,
                    );

                    $ChangeColorData = array(
                        'AllocationId' => $FromColorId,
                        'ColorId' => $Color2,
                        'NewQuantity' => $Quantity,
                        'ChangeDate' => date('Y/m/d')
                    );

                    $ToColorId = $Color2Quantity[0]['idAllocation'];
                    $ToColorData = array(
                        'BalanceQuantity' => $ToColorQuantity,
                        'Quantity' => $ToColorQuantityIncrease,
                    );

                    $this->db->trans_start();
                    $this->db->insert('car_change_color', $ChangeColorData);

                    $this->db->where('idAllocation', $FromColorId);
                    $this->db->update('car_allocation', $FromColorData);

                    $this->db->where('idAllocation', $ToColorId);
                    $this->db->update('car_allocation', $ToColorData);
                    $trans_complete = $this->db->trans_complete();
                    return "Success";
                }


//                print_r($ChangeColorData);
//                echo "<br>";
//                echo $FromColorId;
//                echo "<br>";
//                print_r($ToColorData);
//                echo "<br>";
//                echo $ToColorId;
//                echo "<br>";
//                print_r($FromColorData);
//                $insert = $this->db->insert('car_change_color', $allocationData);
//                if ($insert) {
//                    return true;
//                } else {
//                    return false;
//                }
//                $this->db->insert_id();
            }
        }
    }

    function updateChangeColor($allocationID, $allocationData) {
        $this->db->where('Id', $allocationID);
        $this->db->update('car_allocation', $allocationData);
    }

    function deleteChangeColor($allocationID) {
        $this->db->where('Id', $allocationID);
        $this->db->delete('car_allocation');
    }

    function fillAllocationTypeCombo() {
        $query = $this->db->query('select distinct Id, AllocationType from car_allocation_type');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->Id, "AllocationType" => $dropdown->AllocationType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillModelCombo() {
        $query = $this->db->query('select IdModel, Model from car_model');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdModel, "Model" => $dropdown->Model]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillVariantByModel($ModelId) {
        $query = $this->db->query('SELECT car_variants.IdVariants, car_variants.Variants FROM car_model
                            INNER JOIN car_variants ON car_variants.ModelId = car_model.IdModel
                            WHERE car_variants.ModelId = ' . $ModelId);
        $dropdowns = $query->result();
        return $dropdowns;
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

}
