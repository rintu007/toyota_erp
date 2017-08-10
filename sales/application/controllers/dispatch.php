<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/* Author: Umar Akbar
 * Description: Variants controller class
 */

class Dispatch extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Car_resource_book');
        $this->load->model('Car_dispatch');
        $this->load->library("pagination");
        $this->load->library('form_validation');
    }

    public function index() {
        $Data = array();
        $cookieData = unserialize($_COOKIE['logindata']);
        $Resourcebook = new Car_resource_book();
        $Dispatch = new Car_dispatch();
        $UserId = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        $Data['message'] = $this->session->flashdata('message');
        $Data['Location'] = $Dispatch->fillLocation();
        $Data['Variants'] = $Dispatch->fillVariantsCombo();
        $Data['Pbo'] = $Resourcebook->allRbWithPbo($UserId, $UserRole);

        $this->load->view('header');
        $this->load->view('dispatch', $Data);
        $this->load->view('footer');
    }

    function newDispatch() {
        $Dispatch = new Car_dispatch();
        $this->form_validation->set_rules('location', 'Location Name', 'required|xss_clean');
        $this->form_validation->set_rules('warranty_book', 'Warranty Book', 'required|xss_clean');
        $this->form_validation->set_rules('dispatch_date', 'Dispatch Date', 'required|xss_clean');
        $dispatch = $this->input->post('dispatch');

        // Changes told by Sir Saad 22-May-
//        if ($dispatch == "Pbo") {
//            $DispatchData = array(
//                'PboId' => $this->input->post('pbo_id'), 'LocationId' => $this->input->post('location'),
//                'WarrantyBook' => $this->input->post('warranty_book'),
//                'ChasisNo' => null,
//                'EngineNo' => null,
//                'VariantId' => null,
//                'ColorId' => null,
//                'DispatchedDate' => $this->input->post('dispatch_date'));
//
//            $PboData = array(
//                'ChasisNumber' => $this->input->post('chasis_number'),
//                'EngineNumber' => $this->input->post('engine_number')
//            );
//
//            $PboId = $this->input->post('pbo_id');
//            $this->session->set_flashdata('message', '<h4 style="background-color: green;color: white;font-size: initial;width: 985px;margin-left: -200px;text-align: center;">PBO Number: ' . $PboId . ' has been Dispatched!</h4>');
//            $Dispatch->insertDispatch($DispatchData, $PboData, $PboId);
//            redirect(base_url() . "index.php/dispatch/index");
//        } 
        if ($dispatch == "Pbo") {
            $variantid = $Dispatch->getidVariant($this->input->post('variant_name'));
            if ($this->input->post('isStock') == "GStock") {
                $DispatchData = array(
                    'PboId' => $this->input->post('pbo_id'), 'LocationId' => $this->input->post('location'),
                    'WarrantyBook' => $this->input->post('warranty_book'),
                    'ChasisNo' => $this->input->post('chasis_number'),
                    'EngineNo' => $this->input->post('engine_number'),
                    'VariantId' => $variantid,
                    'ColorId' => $this->input->post('color'),
                    'DispatchedDate' => $this->input->post('dispatch_date'),
                    'Remarks' => $this->input->post('Remarks'),
                    'isStock' => 0,
                    'DispatchType' => 'PBO',
                    'SaleNoteCreated' => 1,
                    'RegistrationNumber' => NULL,
                    'icStock' => 0);

                $PboData = array(
                    'ChasisNumber' => $this->input->post('chasis_number'),
                    'EngineNumber' => $this->input->post('engine_number'),
                    'DispatchCreated' => '1'
                );
            } else if ($this->input->post('icStock') == "CStock") {
                $DispatchData = array(
                    'PboId' => $this->input->post('pbo_id'), 'LocationId' => $this->input->post('location'),
                    'WarrantyBook' => $this->input->post('warranty_book'),
                    'ChasisNo' => $this->input->post('chasis_number'),
                    'EngineNo' => $this->input->post('engine_number'),
                    'VariantId' => $variantid,
                    'ColorId' => $this->input->post('color'),
                    'DispatchedDate' => $this->input->post('dispatch_date'),
                    'Remarks' => $this->input->post('Remarks'),
                    'isStock' => 0,
                     'RegistrationNumber' => NULL,
                    'DispatchType' => 'PBO',
                    'SaleNoteCreated' => 1,
                    'icStock' => 1
                    );

                $PboData = array(
                    'ChasisNumber' => $this->input->post('chasis_number'),
                    'EngineNumber' => $this->input->post('engine_number'),
                    'DispatchCreated' => '1'
                );
            } else {
                $DispatchData = array(
                    'PboId' => $this->input->post('pbo_id'), 'LocationId' => $this->input->post('location'),
                    'WarrantyBook' => $this->input->post('warranty_book'),
                    'ChasisNo' => $this->input->post('chasis_number'),
                    'EngineNo' => $this->input->post('engine_number'),
                    'VariantId' => $variantid,
                    'DispatchType' => 'PBO',
                    'SaleNoteCreated' => 1,
                     'RegistrationNumber' => NULL,
                    'ColorId' => $this->input->post('color'),
                    'DispatchedDate' => $this->input->post('dispatch_date'),
                    'Remarks' => $this->input->post('Remarks')
                );

                $PboData = array(
                    'ChasisNumber' => $this->input->post('chasis_number'),
                    'EngineNumber' => $this->input->post('engine_number'),
                    'DispatchCreated' => '1'
                );
            }

            $PboId = $this->input->post('pbo_id');
            $Dispatch->insertDispatch($DispatchData, $PboData, $PboId);
            $this->session->set_flashdata('message', '<h4 style="background-color: green;color: white;font-size: initial;width: 985px;margin-left: -200px;text-align: center;">PBO Number: ' . $PboId . ' has been Dispatched!</h4>');
            redirect(base_url() . "index.php/dispatch/index");
        } else if ($dispatch == "Open Stock") {
            if ($this->input->post('isStock') == "GStock") {
                $DispatchData = array(
                    'PboId' => null, 'LocationId' => $this->input->post('location'),
                    'WarrantyBook' => $this->input->post('warranty_book'),
                    'ChasisNo' => $this->input->post('chasis_no'),
                    'EngineNo' => $this->input->post('engine_no'),
                    'VariantId' => $this->input->post('variant'),
                    'ColorId' => $this->input->post('variant_color'),
                    'DispatchedDate' => $this->input->post('dispatch_date'),
                    'Remarks' => $this->input->post('Remarks'),
                     'RegistrationNumber' => $this->input->post('RegistrationNumber'),
                     'DispatchType' => 'OPENSTOCK',
                    'isStock' => 1,
                    'icStock' => 0);
            } else if ($this->input->post('icStock') == "CStock") {
                $DispatchData = array(
                    'PboId' => $this->input->post('pbo_id'),
                    'LocationId' => $this->input->post('location'),
                    'WarrantyBook' => $this->input->post('warranty_book'),
                    'ChasisNo' => $this->input->post('chasis_number'),
                    'EngineNo' => $this->input->post('engine_number'),
                    'VariantId' => $variantid,
                     'DispatchType' => 'OPENSTOCK',
                    'ColorId' => $this->input->post('color'),
                    'DispatchedDate' => $this->input->post('dispatch_date'),
                    'Remarks' => $this->input->post('Remarks'),
                     'RegistrationNumber' => $this->input->post('RegistrationNumber'),
                    'isStock' => 0,
                    'icStock' => 1);

                $PboData = array(
                    'ChasisNumber' => $this->input->post('chasis_number'),
                    'EngineNumber' => $this->input->post('engine_number')
                );
            } else {
                $DispatchData = array(
                    'PboId' => null, 'LocationId' => $this->input->post('location'),
                    'WarrantyBook' => $this->input->post('warranty_book'),
                    'ChasisNo' => $this->input->post('chasis_no'),
                    'EngineNo' => $this->input->post('engine_no'),
                    'VariantId' => $this->input->post('variant'),
                     'DispatchType' => 'OPENSTOCK',
                     'RegistrationNumber' => $this->input->post('RegistrationNumber'),
                    'ColorId' => $this->input->post('variant_color'),
                    'DispatchedDate' => $this->input->post('dispatch_date'),
                    'Remarks' => $this->input->post('Remarks'),);
            }
            $Dispatch->insertDispatchNoPbo($DispatchData);
            $this->session->set_flashdata('message', '<h4 style="background-color: green;color: white;font-size: initial;width: 985px;margin-left: -200px;text-align: center;">Variant Has Been Dispatched!</h4>');
            redirect(base_url() . "index.php/dispatch/index");
        }

//        if ($this->form_validation->run() == TRUE) {
//            $PboNumber = $this->input->post('pbo_number');
//            if (!empty($PboNumber)) {
//                $DispatchData = array(
//                    'PboId' => $this->input->post('pbo_id'), 'LocationId' => $this->input->post('location'),
//                    'WarrantyBook' => $this->input->post('warranty_book'),
//                    'DispatchedDate' => $this->input->post('dispatch_date'));
//
//                $PboData = array(
//                    'ChasisNumber' => $this->input->post('chasis_number'),
//                    'EngineNumber' => $this->input->post('engine_number')
//                );
//                $PboId = $this->input->post('pbo_id');
//                $Dispatch->insertDispatch($DispatchData, $PboData, $PboId);
//            } else {
//                $DispatchData = array(
//                    'PboId' => null, 'LocationId' => $this->input->post('location'),
//                    'WarrantyBook' => $this->input->post('warranty_book'),
//                    'ChasisNo' => $this->input->post('chasis_no'),
//                    'EngineNo' => $this->input->post('engine_no'),
//                    'VariantId' => $this->input->post('variant'),
//                    'ColorId' => $this->input->post('variant_color'),
//                    'DispatchedDate' => $this->input->post('dispatch_date'));
//                $Dispatch->insertDispatchNoPbo($DispatchData);
//            }
//
//
//            redirect(base_url() . "index.php/dispatch/index");
//        }
    }

    function lists() {
        $cookieData = unserialize($_COOKIE['logindata']);
        $Dispatch = new Car_dispatch();
        $idUser = $cookieData['userid'];
        $UserRole = $cookieData['Role'];
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 1;
        $config["base_url"] = base_url() . "index.php/dispatch/lists/";
        $config["total_rows"] = $Dispatch->dispatchList_count($idUser );
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['page'] =$page+1;
        $this->pagination->initialize($config);
        $this->data["counts"] = $Dispatch->dispatchList_count($idUser );

        $this->data['DispatchList'] = $Dispatch->dispatchList($UserRole, $idUser, $config["per_page"], $page);
       // print_r($this->data['DispatchList']);
        $this->data["links"] = $this->pagination->create_links();
        $this->load->view('header');
        $this->load->view('dispatchlist', $this->data);
        $this->load->view('footer');
    }

    function dispatchReceive($idDispatch)
    {
        $Dispatch = new Car_dispatch();
        $Data = array();
        $Data['dispatchdata'] =  $Dispatch->get_dispatch($idDispatch);
//        print_r($Data['dispatchdata']);
        $Data['parkingRow'] =  $Dispatch->get_table('parking_row');
        $Data['source']     =  $Dispatch->get_table('source');
        $Data['EntryNo']    =  $Dispatch->max_receive_id();

        $this->load->view('header');
        $this->load->view('dispatchreceiving',$Data);
        $this->load->view('footer');
    }

    function dispatchReceive_list()
    {

        $Dispatch = new Car_dispatch();
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = 1;
        $config["base_url"] = base_url() . "index.php/dispatch/dispatchReceive_list/";
        $count = $Dispatch->get_dispatchReceive_count();
        $config["total_rows"] = $count;
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();

        $this->data['page'] =$page+1;
        $this->data["counts"] = $count;

        $this->data['receivelist'] = $Dispatch->get_dispatchReceive_list( $config["per_page"], $page) ;
        $this->load->view('header');
        $this->load->view('dispatchcarreceivelist', $this->data);
        $this->load->view('footer');

    }
    function dispatchReceive_view($id)
    {
        $Dispatch = new Car_dispatch();

        $this->data['dispatchdata'] = $Dispatch->get_dispatchReceive($id);
        $this->load->view('header');
        $this->load->view('dispatchreceiving_view', $this->data);
        $this->load->view('footer');

    }

    function dispatchReceive_insert()
    {
//        var_dump($_POST);die;
        $Dispatch = new Car_dispatch();
        $id = $Dispatch->dispatchReceive_insert($_POST);
        $this->session->set_flashdata('message', "Dispach no# ".$_POST['idDispatch']." has been Received by entry no#$id");
        redirect(site_url('index.php/dispatch/lists'));
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
                'CreatedDate' => date('Y/m/d'));
            $this->Car_variants->updateVariants($VariantId, $VariantData);
            redirect(base_url() . "index.php/variants/index");
        }
    }

    function getPbo() {
        $Dispatch = new Car_dispatch();
        $search = $this->input->post('Pbo');
        $dataSearch = $Dispatch->getPbo($search);
        echo json_encode($dataSearch);
    }

    function getVariantColor() {
        $Dispatch = new Car_dispatch();
        $idVariant = $this->input->post('Variant');
        $GetColor = $Dispatch->fillColorByVariant($idVariant);
        echo json_encode($GetColor);
    }

    function CheckEngineNumber() {
        $Dispatch = new Car_dispatch();
        $EngineNumber = $this->input->post('EngineNumber');
        $CheckEngineNumber = $Dispatch->CheckEngineNumber($EngineNumber);
        print_r($CheckEngineNumber);
    }

    function CheckChasisNumber() {
        $Dispatch = new Car_dispatch();
        $ChasisNumber = $this->input->post('ChasisNumber');
        $CheckChasisNumber = $Dispatch->CheckChasisNumber($ChasisNumber);
        print_r($CheckChasisNumber);
    }

}
