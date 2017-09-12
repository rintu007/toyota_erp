<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Car_variants extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function allVariants() {
        $variants = $this->db->select('*')->from('car_variants')->get();
        return $variants->result_array();
    }

    function allVariantsModel() {
//        $variants = $this->db->select('*')->from('car_variants')->
//                        join('car_model', 'car_variants.ModelId = car_model.IdModel')->
//                        join('car_make', 'car_variants.MakeId = car_make.IdMake')->
//                        join('car_engine', 'car_variants.EngineId = car_engine.IdEngine')->
//                        join('car_displacement', 'car_variants.DisplacementId = car_displacement.IdDisplacement')->
//                        join('car_variants_color', 'car_variants.IdVariants= car_variants_color.VariantId')->
//                        join('car_color', 'car_variants_color.ColorId= car_color.IdColor')->get();
        $variants = $this->db->query('SELECT
                                    car_variants.Variants,
                                    car_color.ColorName,
                                    car_model.Model,
                                    car_engine.EngineType,
                                    car_displacement.DisplacementName,
                                    car_make.Make,
                                    car_variants.ModelCode,
                                    car_variants.ModelDescription,
                                    car_variants.Price,
                                    car_variants_color.ColorId,
                                    car_variants.FICharges,
                                    car_variants.TotalPrice,
                                    car_variants.IdVariants,
                                    car_color.IdColor,
                                    car_make.IdMake,
                                    car_variants.ModelId,
                                    car_engine.IdEngine,
                                    car_displacement.IdDisplacement,
                                    car_variants.isActive
                                    FROM
                                    car_variants
                                    LEFT OUTER JOIN car_variants_color ON car_variants_color.VariantId = car_variants.IdVariants
                                    LEFT OUTER JOIN car_color ON car_variants_color.ColorId = car_color.IdColor
                                    LEFT OUTER JOIN car_model ON car_variants.ModelId = car_model.IdModel
                                    LEFT OUTER JOIN car_engine ON car_variants.EngineId = car_engine.IdEngine
                                    LEFT OUTER JOIN car_displacement ON car_variants.DisplacementId = car_displacement.IdDisplacement
                                    LEFT OUTER JOIN car_make ON car_variants.MakeId = car_make.IdMake
                                    GROUP BY
                                    car_variants.IdVariants
                                    ORDER BY
                                    car_variants.Variants ASC
                                    '
        );
        return $variants->result_array();
    }

    function oneVariant($idVariants) {
        $OneVaraint = $this->db->query('SELECT car_variants.Variants, car_color.ColorName, car_model.Model, car_engine.EngineType,
                                    car_displacement.DisplacementName, car_make.Make, car_variants.ModelCode,
                                    car_variants.ModelDescription, car_variants.Price, car_variants_color.ColorId,
                                    car_variants.FICharges, car_variants.TotalPrice, car_variants.IdVariants,
                                    car_variants.EngineType as EngineTypeTwo, car_variants.VariantCode,
                                    car_color.IdColor, car_make.IdMake, car_variants.ModelId, car_engine.IdEngine,
                                    car_displacement.IdDisplacement, car_variants.IdVariants, car_variants.DisplacementId,
                                    car_variants.EngineId,car_variants.WHTFiler ,car_variants.WHTNFiler  FROM car_variants
                                    INNER JOIN car_variants_color ON car_variants_color.VariantId = car_variants.IdVariants
                                    INNER JOIN car_color ON car_variants_color.ColorId = car_color.IdColor
                                    INNER JOIN car_model ON car_variants.ModelId = car_model.IdModel
                                    INNER JOIN car_engine ON car_variants.EngineId = car_engine.IdEngine
                                    INNER JOIN car_displacement ON car_variants.DisplacementId = car_displacement.IdDisplacement
                                    INNER JOIN car_make ON car_variants.MakeId = car_make.IdMake WHERE 
                                    car_variants.IdVariants = ' . $idVariants);

        return $OneVaraint->result_array();
    }

    function oneVariantsModel($keyword) {
        $variants = $this->db->select('*')->from('car_variants')->
                        join('car_model', 'car_variants.ModelId = car_model.IdModel')->
                        join('car_make', 'car_variants.MakeId = car_make.IdMake')->
                        join('car_engine', 'car_variants.EngineId = car_engine.IdEngine')->
                        join('car_displacement', 'car_variants.DisplacementId = car_displacement.IdDisplacement')->
                        like('car_variants.Variants', $keyword)->get();
        return $variants->result();
    }

    function allColors() {
        $this->db->select('*');
        $this->db->from('car_color');
        $AllColors = $this->db->get();

        return $AllColors->result_array();
    }

    function insertVariants($vData) {
        $this->db->trans_start();
        $this->db->insert('car_variants', $vData);
        $LastIdVariant = $this->db->insert_id();
        $vColorData = array();
        $color = $this->input->post('color');
        $count = count($this->input->post('color'));
        for ($i = 0; $i < $count; $i++) {
            $vColorData[] = array(
                'VariantId' => $LastIdVariant,
                'CreatedDate' => date("Y/m/d"),
                'ColorId' => $color[$i]
            );
        }
        if ($color != "") {
            $this->db->insert_batch('car_variants_color', $vColorData);
        }
        $this->db->trans_complete();
    }

    function updateVariants($vID, $vData) {
        $this->db->trans_start();

        $this->db->where('IdVariants', $vID);
        $this->db->update('car_variants', $vData);

        $this->db->where('VariantId', $vID);
        $this->db->delete('car_variants_color');

        $vColorData = array();
        $color = $this->input->post('colors');
        $count = count($this->input->post('colors'));
        for ($i = 0; $i < $count; $i++) {
            $vColorData[] = array(
                'VariantId' => $vID,
                'CreatedDate' => date("Y/m/d"),
                'ColorId' => $color[$i]
            );
        }
        if ($color != "") {
            $this->db->insert_batch('car_variants_color', $vColorData);
        }
        $this->db->trans_complete();
    }

    function deleteVariants($vID) {
        $this->db->where('IdVariants', $vID);
        $this->db->delete('car_variants');
    }

    function fillModelName() {
        $query = $this->db->query('select distinct IdModel, Model from car_model');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->IdModel] = $dropdown->Model;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillModel() {
        $query = $this->db->query('select distinct IdModel, Model from car_model');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdModel, "Model" => $dropdown->Model]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillMakeRadio() {
        $query = $this->db->query('select IdMake, Make from car_make');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["IdMake" => $dropdown->IdMake, "Make" => $dropdown->Make]);
        }
        return $dropDownList;
    }

    function fillMake($idVariant) {
        $query = $this->db->query('select MakeId from car_variants where IdVariants =' . $idVariant);
        $dropdowns = $query->result_array();
//        $dropDownList = array();
//        foreach ($dropdowns as $dropdown) {
//            array_push($dropDownList, ["IdMake" => $dropdown->IdMake, "Make" => $dropdown->Make]);
//        }
//        return $dropDownList;
        return $dropdowns;
    }

    function fillEngineType() {
        $query = $this->db->query('select distinct IdEngine, EngineType from car_engine');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->IdEngine] = $dropdown->EngineType;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillEngine() {
        $query = $this->db->query('select distinct IdEngine, EngineType from car_engine');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdEngine, "EngineType" => $dropdown->EngineType]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillDisplacementCombo() {
        $query = $this->db->query('select distinct IdDisplacement, DisplacementName from car_displacement');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            $dropDownList[$dropdown->IdDisplacement] = $dropdown->DisplacementName;
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function fillDisplacement() {
        $query = $this->db->query('select distinct IdDisplacement, DisplacementName from car_displacement');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdDisplacement, "DisplacementName" => $dropdown->DisplacementName]);
        }
        $finalDropDown = $dropDownList;
        return $finalDropDown;
    }

    function Make() {
        $query = $this->db->query('select DISTINCT IdMake, Make from car_make');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdMake, "Make" => $dropdown->Make]);
        }
        return $dropDownList;
    }

    function MakeVariant($VariantId) {
        $query = $this->db->query("SELECT
                            car_variants.MakeId,
                            car_make.Make,
                            car_make.IdMake
                            FROM
                            car_variants
                            INNER JOIN car_make ON car_variants.MakeId = car_make.IdMake
                            WHERE
                            car_variants.IdVariants = {$VariantId}");
        $dropdowns = array();
        $dropdowns = $query->result_array();
        return $dropdowns;
    }

    function fillColorCheckBox() {
        $query = $this->db->query('select DISTINCT IdColor, ColorName from car_color');
        $dropdowns = $query->result();
        $dropDownList = array();
        foreach ($dropdowns as $dropdown) {
            array_push($dropDownList, ["Id" => $dropdown->IdColor, "ColorName" => $dropdown->ColorName]);
        }
        return $dropDownList;
    }

    function editColorCheckBox() {
        $query = $this->db->query('select DISTINCT IdColor, ColorName from car_color

        ');
//        $dropdowns = $query->result();
//        $dropDownList = array();
//        foreach ($dropdowns as $dropdown) {
//            array_push($dropDownList, ["Id" => $dropdown->IdColor, "ColorName" => $dropdown->ColorName]);
//        }
//        return $dropDownList;
//    }
        $dropdowns = array();
        $dropdowns = $query->row();
        return $dropdowns;
    }

    function ColorVariant($VariantId) {
        $query = $this->db->query("SELECT
                            car_variants_color.Id,
                            car_variants_color.VariantId,
                            car_variants_color.ColorId,
                            car_variants_color.CreatedDate,
                            car_color.ColorName
                            FROM
                            car_variants_color
                            INNER JOIN car_color ON car_variants_color.ColorId = car_color.IdColor
                            WHERE
                            car_variants_color.VariantId = {$VariantId}");
//        $dropdowns = $query->result();
//        $dropDownList = array();
//        foreach ($dropdowns as $dropdown) {
//            array_push($dropDownList, ["Id" => $dropdown->IdColor, "ColorName" => $dropdown->ColorName]);
//        }
//        return $dropDownList;
//    }
//        print_r($query);
        $dropdowns = array();
        $dropdowns = $query->result_array();
        return $dropdowns;
    }
    
     function ChangeStatus($VariantId,$CurrentStatus)
    {
         if($CurrentStatus == "Deactivate")
         {
         $query = $this->db->query("UPDATE car_variants SET isActive = 0 WHERE idVariants =".$VariantId);
         
             
         }
         else {
     
         $query = $this->db->query("UPDATE car_variants SET isActive = 1 WHERE idVariants =".$VariantId);
        
     
        }
        
        
    }
    
    

}
