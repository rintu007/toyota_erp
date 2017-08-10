<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Umar Akbar
 * Description: Variants controller class
 */

class Variants extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_variants');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['model'] = $this->Car_variants->fillModel();
        $this->data['variants'] = $this->Car_variants->allVariantsModel();
        $this->data['make'] = $this->Car_variants->fillMakeRadio();
        $this->data['engine'] = $this->Car_variants->fillEngine();
        $this->data['displacement'] = $this->Car_variants->fillDisplacement();
        $this->data['color'] = $this->Car_variants->fillColorCheckBox();
        $this->data['colors'] = $this->Car_variants->editColorCheckBox();
        $this->load->view('header');
        $this->load->view('variants', $this->data);
        $this->load->view('footer');
    }

    function newvariant() {
        $this->form_validation->set_rules('variant_name', 'Varaint Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $variantsData = array(
                'Variants' => $this->input->post('variant_name'), 'ModelId' => $this->input->post('model'),
                'ModelCode' => $this->input->post('model_code'), 'ModelDescription' => $this->input->post('model_description'),
                'EngineId' => $this->input->post('engine'), 'DisplacementId' => $this->input->post('displacement'),
                'VariantCode' => $this->input->post('variant_code'), 'EngineType' => $this->input->post('engine_type_two'),
                'Price' => $this->input->post('price'), 'FICharges' => $this->input->post('freight'),
                'TotalPrice' => $this->input->post('total_price'), 'MakeId' => $this->input->post('make'),
                'WHTFiler' => $this->input->post('WHTFiler'), 
                'WHTNFiler' => $this->input->post('WHTNFiler'),
                'CreatedDate' => date('Y/m/d'),
                'isActive' => 1);
            $this->Car_variants->insertVariants($variantsData);
            redirect(base_url() . "index.php/variants/index");
        }
    }

    function update() {
        $this->form_validation->set_rules('variant_id', 'Role ID', 'required|xss_clean');
        $this->form_validation->set_rules('variant_name', 'Role Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $VariantId = $this->input->post('variant_id');
            $VariantData = array(
                'Variants' => $this->input->post('variant_name'), 'ModelId' => $this->input->post('model'),
                'ModelCode' => $this->input->post('model_code'), 'ModelDescription' => $this->input->post('model_description'),
                'EngineId' => $this->input->post('engine'), 'DisplacementId' => $this->input->post('displacement'),
                'Price' => $this->input->post('price'), 'FICharges' => $this->input->post('freight'),
                'TotalPrice' => $this->input->post('total_price'), 'MakeId' => $this->input->post('makeId'),
                'VariantCode' => $this->input->post('variant_code'), 'EngineType' => $this->input->post('engine_type'),
                'CreatedDate' => date('Y/m/d'),
                'WHTFiler' => $this->input->post('WHTFiler'),
                'WHTNFiler' => $this->input->post('WHTNFiler')     
                 );
            $this->Car_variants->updateVariants($VariantId, $VariantData);
            redirect(base_url() . "index.php/variants/index");
        }
    }

    function edit($idVariant) {
        $Vairant = new Car_variants();
        $OneVariant = $Vairant->oneVariant($idVariant)[0];

        $Data = array();

        $Data['EditVariant'] = $OneVariant;
        $Data['AllColors'] = $Vairant->fillColorCheckBox();
        $Data['color'] = $Vairant->ColorVariant($idVariant);
//        $Data['make'] = $Vairant->fillMake($idVariant)[0];
        $Data['make'] = $Vairant->MakeVariant($idVariant);
//        $Data['AllMakes'] = $Vairant->fillMakeRadio();
        $Data['AllMakes'] = $Vairant->Make();
        $Data['displacement'] = $Vairant->fillDisplacementCombo();
        $Data['engine'] = $Vairant->fillEngineType();
        $Data['model'] = $Vairant->fillModelName();

//        print_r($Data['make']);
        $this->load->view('header');
        $this->load->view('variant_edit', $Data);
        $this->load->view('footer');
    }

    function search() {
        $search = $this->input->post('search');
        $dataSearch = $this->Car_variants->oneVariantsModel($search);
        $CarVariants = json_encode($dataSearch);
        print_r($CarVariants);
    }

    function ColorByVariant() {
        $VariantId = $this->input->post('idVariant');
        $Variant = new Car_variants();
        $ColorVariant = $Variant->ColorVariant($VariantId);
        print_r($ColorVariant);
//        return $ColorVariant;
//        echo json_encode($ColorVariant);
    }
    
    function ChangeStatus($VariantId,$status)
    {
       
        $Variant = new Car_variants();
        $status = $Variant->ChangeStatus($VariantId,$status);
        $this->index();
        
    }
}
