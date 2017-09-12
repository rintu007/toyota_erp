<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_allocation extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allAllocation($perpage = '', $limit = '') {
        $this->db->select('*');
        $this->db->from('car_allocation');
        $this->db->join('car_color', 'car_allocation.ColorId = car_color.IdColor');
        $this->db->join('car_variants', 'car_allocation.VariantId = car_variants.IdVariants');
        $this->db->join('car_allocation_type', 'car_allocation.AllocationTypeId = car_allocation_type.Id');
		$this->db->order_by("car_allocation.VariantId", "desc");
		$this->db->where('car_allocation.inActive',0);
		$this->db->limit($perpage, $limit);
        $allocation = $this->db->get();
        return $allocation->result_array();
      //  print_r($allocation);
        
    }
public function record_count() {
        
            $this->db->select('*');
			$query = $this->db->get("car_allocation");
            return $query->num_rows();
       
    }
    function insertAllocation($allocationData) {
        $Variant = $this->input->post('variant');
        $Color = $this->input->post('color');
        $AllocationType = $this->input->post('allocationType');
        $AllocationMonth = $this->input->post('allocation_month');

        $this->db->select('*');
        $this->db->from('car_allocation');
        $this->db->where('VariantId', $Variant);
        $this->db->where('ColorId', $Color);
        $this->db->where('AllocationTypeId', $AllocationType);
        $this->db->where('Month', $AllocationMonth);
        $Validate = $this->db->get();
        $result_array = $Validate->result_array();
        if (empty($result_array)) {
//            echo "available";
            $insert = $this->db->insert('car_allocation', $allocationData);
            if ($insert) {
                return true;
            } else {
                return false;
            }
            $this->db->insert_id();
        } else {
            return "not available";
        }
    }

    function checkAllocation() {
        $idVariant = $this->input->post('variant');
        $idColor = $this->input->post('color');
        $idAllocationType = $this->input->post('allocationType');
        $AllocationMonth = $this->input->post('allocation_month');
        $this->db->select('*');
        $this->db->from('car_allocation');
        $this->db->where('VariantId', $idVariant);
        $this->db->where('ColorId', $idColor);
        $this->db->where('Month', $AllocationMonth);
        $this->db->where('AllocationTypeId', $idAllocationType);
        $Check = $this->db->get();
        $CheckAllocation = $Check->result_array();
        return $CheckAllocation;
        //print_r($CheckAllocation);
    }

    function updateAllocation($idAllocation, $AllocationData) {
        $this->db->where('idAllocation', $idAllocation);
        $update = $this->db->update('car_allocation', $AllocationData);
        if ($update) {
            return "Quantity Updated";
        } else {
            return 0;
        }
    }

    function deleteAllocation($allocationID) {
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
                            WHERE car_variants.ModelId = ' . $ModelId . ' AND car_variants.isActive = 1');
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
	//////////////////////
	public function delete($idAllocation) {
		
        $data = array(
            'inActive' => 1
        );
		
        $this->db->where('idAllocation', $idAllocation);
        $this->db->update('car_allocation', $data);
        return true;
    }

}
