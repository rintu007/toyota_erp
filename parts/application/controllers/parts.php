<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_name');
        $this->load->model('Parts_inventory');
        $this->load->model('Parts_invoices');
        $this->load->library('form_validation');
    }

    function GetAll() {
        $PartsName = new Parts_name();
        echo json_encode($PartsName->allParts());
    }

    public function index() {
        $Data = array();
        $invoice = new Parts_invoices();
        $PartsName = new Parts_name();
//        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
//        $Data['DealerCode'] = $invoice->getDealerCode()[0];
//        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
//        $Data['Parts'] = $PartsName->allParts();
        $Data['Variants'] = $PartsName->fillVariantCheckBox();
        $Data['VariantsGroup'] = $PartsName->variantGroup();
        $Data['Brand'] = $PartsName->fillBrandNameCombo();
        $Data['Location'] = $PartsName->fillLocation();
//        print_R($Data["Location"]);
//        exit();
        $Data['Order'] = $PartsName->fillOrderMode();
        $Data['Category'] = $this->Parts_inventory->fillCategoryCombo();
        $Data['Manufacturer'] = $this->Parts_inventory->fillManufacturerCombo();
        $this->load->view('header_parts', $Data);
        $this->load->view('parts', $Data);
        $this->load->view('footer');
    }

    public function get_parts() {
        echo json_encode($this->Parts_name->allParts());
    }

    function newPart() {
        $Parts = new Parts_name();
        $this->form_validation->set_rules('PartId', 'Part ID', 'required|xss_clean');
        $this->form_validation->set_rules('PartName', 'Part Name', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            /*      echo "<pre>";
                  print_r($_POST);
                  echo "</pre>";
                  exit(); */
            $PartData = array(
                'PartNumber' => $this->input->post('PartId'),
                'PartName' => $this->input->post('PartName'),
                'VariantId' => null,
                'BrandName' => $this->input->post('BrandName'),
                'OrderMode' => NULL,
                'Description' => $this->input->post('Description'),
                'Quantity' => $this->input->post('Quantity')
            );
            $insertParts = $Parts->insertParts($PartData);
            $this->session->set_flashdata('message', '<h4>' . $insertParts . '</h4>');
            redirect(base_url() . "index.php/parts/index");
        }
    }

//    function edit() {
//        $idPart = $this->input->post('idPart');
//        $PartNumber = $this->input->post('PartNumber');
//        $PartName = $this->input->post('PartName');
//        $Description = $this->input->post('Description');
//        $Variant = $this->input->post('VariantId');
//        $Quantity = $this->input->post('Quantity');
//
//        print_r($idPart . " ::: " . $PartName . " ::: " . $Description . " ::: " . $Variant . " ::: " . $Quantity . " ::: ");
//    }

    function Edit($idPart) {
        $PartsName = new Parts_name();
        $invoice = new Parts_invoices();
        $PartsName = new Parts_name();
        $Data['OrderType'] = $invoice->getDailyOrderCode()[0];
        $Data['DealerCode'] = $invoice->getDealerCode()[0];
        $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
        $Data['message'] = $this->session->flashdata('message');
        $Data['Parts'] = $PartsName->viewparts($idPart)[0];
        $Data['PartsVariant'] = $PartsName->partsvariant($idPart);
        $Data['Variants'] = $PartsName->fillVariantCheckBox();
        $Data['VariantsGroup'] = $PartsName->variantGroup();
        $Data['Brand'] = $PartsName->fillBrandNameCombo();
        $Data['Location'] = $PartsName->fillLocation();
        $Data['Order'] = $PartsName->fillOrderMode();
        $Data['Category'] = $this->Parts_inventory->fillCategoryCombo();
        $Data['Manufacturer'] = $this->Parts_inventory->fillManufacturerCombo();
        $this->load->view('header_parts', $Data);
        $this->load->view('parts_edit', $Data);
        $this->load->view('footer');
    }

    function update() {
        $this->form_validation->set_rules('PartId', 'Part ID', 'required|xss_clean');
        $this->form_validation->set_rules('PartName', 'Part Name', 'required|xss_clean');
//        $this->form_validation->set_rules('VariantId', 'Variant ID', 'required|xss_clean');
        $this->form_validation->set_rules('Quantity', 'Quantity', 'required|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $idPart = $this->input->post('idPart');
            $idInventory = $this->input->post('idInventory');
            $idVariants = $this->input->post('variants');
            $idOrderModes = $this->input->post('OrderMode');
            $PartData = array(
                'PartNumber' => $this->input->post('PartId'),
                'PartName' => $this->input->post('PartName'),
                'Description' => $this->input->post('Description'),
                'BrandName' => $this->input->post('BrandName'),
            );
            $InventoryData = array(
                'PartId' => $idPart,
                'PartCategory' => $this->input->post('PartCategory'),
                'CostPrice' => $this->input->post('CostPrice'),
                'RetailPrice' => $this->input->post('RetailPrice'),
                'BarcodeNumber' => $this->input->post('BarcodeNumber'),
                'MAD' => $this->input->post('Mad'),
                'MIP' => $this->input->post('Mip'),
                'LeadTime' => $this->input->post('LeadTime'),
                'OrderCycle' => $this->input->post('OrderCycle'),
                'PhaseOutQuantity' => $this->input->post('PhaseOutQuantity'),
                'SafetyStock' => $this->input->post('SafetyStock'),
                'ManufacturerId' => $this->input->post('ManufacturerId'),
				'Location' => $this->input->post('Location'),
				'SecondaryLocation' => $this->input->post('sLocation')
            );
            $updateParts = $this->Parts_name->updateParts($idPart, $PartData, $idInventory, $InventoryData, $idOrderModes, $idVariants);
            $this->session->set_flashdata('message', '<h4>' . $updateParts . '</h4>');
        } else {

        }
        redirect(base_url() . "index.php/viewparts/index");

    }

    function search() {
        $PartsName = new Parts_name();
        $search = $this->input->post('ModelName');
        $dataSearch = $PartsName->searchPart($search);
        echo json_encode($dataSearch);
    }

    function check() {
        $PartsName = new Parts_name();
        $result = $PartsName->checkLocation();
        echo json_encode($result);
    }

    function checkPart() {
        $idParts = $this->input->post('id');
        $PartsName = new Parts_name();
        $result = $PartsName->onePartCheck($idParts);
        echo json_encode($result);
    }

    function gatepass()
    {

        $Data = array();
        $Data['message'] = $this->session->flashdata('message');
        $Data['GatePass'] = $this->getallGatepass();
        $this->load->view('header_parts', $Data);
        $this->load->view('gatepass', $Data);
        $this->load->view('footer');
    }

    function inquiry()
    {

        $Data = array();
        $Data['message'] = $this->session->flashdata('message');
        $Data['inquiry'] = $this->getallinquiry();
        $this->load->view('header_parts', $Data);
        $this->load->view('inquiry', $Data);
        $this->load->view('footer');
    }

    function viewgatepass($gatePassId)
    {
        if(isset($gatePassId))
        {

            $Data = array();
            $Data['GatePass'] = $this->db->where('gatePassId',$gatePassId)->get('gatepassview')->result_array();
            $this->load->view('header_parts', $Data);
            $this->load->view('viewgatepass', $Data);
            $this->load->view('footer');

        }
        else
            redirect (base_url() . "index.php/parts/gatepass");

    }

    function viewinquiry($gatePassId)
    {
        if(isset($gatePassId))
        {

            $Data = array();
            $Data['GatePass'] = $this->db->where('inquiryId',$gatePassId)->get('partsinquiry')->result_array();
            $Data['PartsInquiry'] = $this->db->where('inquiryId',$Data['GatePass'][0]['inquiryid'])->get('partinquiry')->result_array();
            $this->load->view('header_parts', $Data);
            $this->load->view('viewinquiry', $Data);
            $this->load->view('footer');

        }
        else
            redirect (base_url() . "index.php/parts/inquiry");

    }

    function creategatepass()
    {
        $Data = array();
        $id= $this->db->query('select max(g.gatePassId) as gatePassId from gatepass g')->row();
        $Data['gatePassId'] = ($id->gatePassId)+1;

        $this->load->view('header_parts', $Data);
        $this->load->view('creategatepass', $Data);
        $this->load->view('footer');
    }

    function createinquiry()
    {
        $PartsName = new Parts_name();
        //$Sale = new Inventory_sales();
        $Data = array();
        $id= $this->db->query('select max(g.inquiryid) as inquiryid from partsinquiry g')->row();
        $Data['gatePassId'] = ($id->inquiryid)+1;
        $Data['Parts'] = $PartsName->allParts();
        $this->load->view('header_parts', $Data);
        $this->load->view('createinquiry', $Data);
        $this->load->view('footer');
    }


    function savegatepass()
    {

        $data =array(
            'employee' => $this->input->post('employee'),
            'pbo/chas' => $this->input->post('pbo/chas'),

        );
        $this->db->insert('gatepass',$data);

        $gatePassId =$this->db->insert_id();

        $PartNumber = $this->input->post('PartNumber');
        $Description = $this->input->post('Description');
        $Quantity = $this->input->post('Quantity');
        $Remarks = $this->input->post('Remarks');

        $detailData = array();
        for ($i = 0; $i < count($PartNumber); $i++) {
            $detailData[] = array(
                'PartNumber' => $PartNumber[$i],
                'Description' => $Description[$i],
                'gatePassId' =>  $gatePassId,
                'Quantity' => $Quantity[$i],
                'Remarks' => $Remarks[$i],
            );
        }
        $this->db->insert_batch('gatepassdetail', $detailData);

        redirect(base_url() . "index.php/parts/viewgatepass/$gatePassId");

    }

    function saveinquiry()
    {

        $data =array(
            'inquiryNo' => $this->input->post('inquiryId'),
            'date' => $this->input->post('date'),
            'CustomerName' => $this->input->post('CustomerName')

        );
        $this->db->insert('partsinquiry',$data);

        $gatePassId =$this->db->insert_id();

        $PartNumber = $this->input->post('parts');
        $Description = $this->input->post('Description');
        $Quantity = $this->input->post('Quantity');
        $Code = $this->input->post('Code');
        $Model = $this->input->post('Model');
        $Sea = $this->input->post('bysea');
        $Air = $this->input->post('byair');

        $detailData = array();
        for ($i = 0; $i < count($PartNumber); $i++) {
            $detailData[] = array(
                'PartNumber' => $PartNumber[$i],
                'Description' => $Description[$i],
                'Model' =>  $Model[$i],
                'Code' =>  $Code[$i],
                'Quantity' => $Quantity[$i],
                'inquiryid' => $gatePassId,
                'bysea' => $Sea[$i],
                'byair' => $Air[$i]
            );
        }
        $this->db->insert_batch('partinquiry', $detailData);

        redirect(base_url() . "index.php/parts/viewinquiry/$gatePassId");

    }

    function getallGatepass()
    {
        return $this->db->order_by("gatePassId", "desc")->get('gatepass')->result_array();

    }  function getallinquiry()
{
    return $this->db->order_by("inquiryId", "desc")->get('partsinquiry')->result_array();

    }

    /*SMR Code*/
    function getsmr()
    {
        $Data = array();
        $Data['message'] = $this->session->flashdata('message');
        $Data['smr'] = $this->getallsmr();
        $this->load->view('header_parts', $Data);
        $this->load->view('smr', $Data);
        $this->load->view('footer');
    }
	function getimgsmr()
    {
        $Data = array();
		$Data['message'] = $this->session->flashdata('message');
        $query = $this->db->query("select * from img_smrdetail ");
        $Data['smrsdetails'] = $query->result_array();
        $query = $this->db->query("select * from imgsmr");
        $Data['smrs'] = $query->result_array();
        $this->load->view('header_parts', $Data);
        $this->load->view('smrimg', $Data);
        $this->load->view('footer');
    }
	function getquot()
	{
		$Data = array();
		$Data['message'] = $this->session->flashdata('message');
		$query = $this->db->query("select * from part_quotationdetail ");
		$Data['quotationDetails'] = $query->result_array();
		$query = $this->db->query('select * from part_quotation LEFT JOIN part_quotationdetail
										ON part_quotation.quot_id=part_quotationdetail.quot_id;');
		/*$query = $this->db->select('*');
		$query = $this->db->from('part_quotation');
		$query = $this->db->join('part_quotationdetail', 'part_quotation.quot_id = part_quotationdetail.quot_id','left');*/
		$Data['quotation'] = $query->result_array();
		$this->load->view('header_parts', $Data);
		$this->load->view('quotation');
		$this->load->view('footer');
	}
	function createQuotation()
    {
        $Data = array();
        $id= $this->db->query('select max(q.quot_id) as quotid from part_quotation q')->row();
        $Data['quotid'] = ($id->quotid)+1;

        $this->load->view('header_parts', $Data);
        $this->load->view('createquotation', $Data);
        $this->load->view('footer');
    }
    function createsmr()
    {
        $Data = array();
        $id= $this->db->query('select max(s.idsmr) as smr from smr s')->row();
        $Data['smrid'] = ($id->smr)+1;

        $this->load->view('header_parts', $Data);
        $this->load->view('createsmr', $Data);
        $this->load->view('footer');
    }
	function createimgsmr()
    {
        $Data = array();
        $id= $this->db->query('select max(s.idsmr) as smr from smr s')->row();
        $Data['smrid'] = ($id->smr)+1;

        $this->load->view('header_parts', $Data);
        $this->load->view('createimgsmr', $Data);
        $this->load->view('footer');
    }
	
	function saveimgsmr(){
		$dealership = $this->input->post('dealership');
		$dataimgsmr = array(
            'dealership'=> $dealership,
            'createddate'=> date('Y-m-d H:i:s')
        );
		$this->db->insert('imgsmr', $dataimgsmr);
		$smrimgid = $this->db->insert_id();
		$orderno = $this->input->post('orderno');
		$invoiceno = $this->input->post('invoiceno');
		$partno = $this->input->post('partno');
		$DispatchedQty = $this->input->post('dispatchedQty');
		$DamagedQty = $this->input->post('damagedQty');
		$Cn = $this->input->post('CN');
		$cndate = $this->input->post('CNDate');
		$Remarks = $this->input->post('remarks');
		$pack_box_pictures = $this->input->post('pb1');
		$damaged_part_pictures = $this->input->post('dp1');
		$received_against_cn_pictures = $this->input->post('ra1');
		
		
		//$uniqueid = $this->session->userdata('productkey');
        mkdir("./assets/smrimages/$smrimgid");
        // Upload Program
        $config['upload_path'] = './assets/smrimages/' . $smrimgid;
        $config['allowed_types'] = 'jpg|jpeg|png|PNG';
        $config['max_size'] = '3000000';
        //$config['file_name'] = $smrimgid;
        $config['overwrite'] = false;
		
		$this->load->library('upload', $config);
		$this->upload->do_upload('pb1');
		$this->upload->do_upload('pb2');
		$this->upload->do_upload('dp1');
		$this->upload->do_upload('dp2');
		$this->upload->do_upload('ra1');
		
		$imagename1 = $_FILES['pb1']["name"] .','. $_FILES['pb2']["name"];
		$imagename2 = $_FILES['dp1']["name"] .','. $_FILES['dp2']["name"];
		$imagename3 = $_FILES['ra1']["name"];
		
		$detailData = array();
		for($i = 0 ; $i < count($orderno);$i++){
			$detailData[] = array(
			'orderno' => $orderno[$i],
			'invoiceno' => $invoiceno[$i],		
			'partno' => $partno[$i],	
			'DispatchedQty' => $DispatchedQty[$i],
			'DamagedQty' => $DamagedQty[$i],
			'Cn' => $Cn[$i],
			'cndate' => date('Y-m-d H:i:s'),
			'Remarks' => $Remarks[$i],
			'datecreated' => date('Y-m-d H:i:s'),
			'idimgsmr' => $smrimgid,
			'pack_box_pictures' => $imagename1,
			'damaged_part_pictures' => $imagename2,
			'received_against_cn_pictures' => $imagename3,
			'dealership' => $dealership
			);
			}
			$this->db->insert_batch('img_smrdetail', $detailData);
			
			redirect("parts/getsmr/$smrimgid");
		

        
		
        
	}
    function savesmr()
    {
        $dealerremarks = $this->input->post('dealerremarks');
        $imcremarks = $this->input->post('imcremarks');
        $dealership = $this->input->post('dealership');
        //$claimno = $this->input->post('claimno');
        $datasmr = array(
            'dealership'=> $dealership,
            'dealerremarks'=> $dealerremarks,
            'imcremarks'=> $imcremarks,
            'createddate'=> date('Y-m-d H:i:s')
        );
        $this->db->insert('smr', $datasmr);
        $smrid =$this->db->insert_id();

        $orderno = $this->input->post('orderno');
        $invoiceno = $this->input->post('invoiceno');
        $partorderd = $this->input->post('partorderd');
        $partreceived = $this->input->post('partreceived');
        $qtyinvoiced = $this->input->post('qtyinvoiced');
        $qtyreceived = $this->input->post('qtyreceived');
        $qtyordered = $this->input->post('qtyordered');
        $qtydamage = $this->input->post('qtydamage');
        $priceactual = $this->input->post('priceactual');
        $pricecharged = $this->input->post('pricecharged');
        $return = $this->input->post('return');
        $creditnote = $this->input->post('creditnote');

        $detailData = array();
        for ($i = 0; $i < count($orderno); $i++) {
            $detailData[] = array(
                'orderno' => $orderno[$i],
                'invoiceno' => $invoiceno[$i],
                'partordered' => $partorderd[$i],
                'partreceived' => $partreceived[$i],
                'qtyordered' => $qtyordered[$i],
                'qtyinvoiced' => $qtyinvoiced[$i],
                'qtyreceived' => $qtyreceived[$i],
                'qtydamage' => $qtydamage[$i],
                'priceactual' => $priceactual[$i],
                'pricecharged' => $pricecharged[$i],
                'return' => $return[$i],
                'imtcreditnote' =>  $creditnote[$i],
                'createddate' => date('Y-m-d H:i:s'),
                'idsmr' => $smrid
            );
        }
        $this->db->insert_batch('smr_detail', $detailData);

        redirect(base_url() . "index.php/parts/getsmr/$smrid");

    }
	function savequot()
    {
        $customer = $this->input->post('cusName');
        $Date = $this->input->post('date');
        $phone = $this->input->post('PhoneNo');
		$address = $this->input->post('Address');
		$quotationNo = $this->input->post('smrid');
		$priceValidity = $this->input->post('pvalidity');
		$paymentMode = $this->input->post('pmode');
		$deliveryPeriod = $this->input->post('dperiod');
		$date = $this->input->post('date');
        //$claimno = $this->input->post('claimno');
        $dataquot = array(
            'cusName'=> $customer,
            'phone'=> $phone,
            'address'=> $address,
            'quotationNo'=>$quotationNo,
			'priceValidity' =>$priceValidity,
			'paymentMode' =>$paymentMode,
			'deliveryPeriod'=>$deliveryPeriod,
			'date'=>$date,
            'createdDate'=> date('Y-m-d')
        );
        $this->db->insert('part_quotation', $dataquot);
        $quot_id =$this->db->insert_id();

        $partNo = $this->input->post('Partno');
        $description = $this->input->post('Description');
        $Quantity = $this->input->post('qty');
        $unitPrice = $this->input->post('unitPrice');
        $taxRate = $this->input->post('texRate');
        

        $detailData = array();
        for ($i = 0; $i < count($partNo); $i++) {
            $detailData[] = array(
                'quot_id' => $quot_id,
                'partNo' => $partNo[$i],
                'description' => $description[$i],
                'Quantity' => $Quantity[$i],
                'unitPrice' => $unitPrice[$i],
                'Amount' => $Quantity[$i] * $unitPrice[$i],
                'taxRate' => $taxRate[$i],
				'createdDate'=> date('Y-m-d')
            );
        }
        $this->db->insert_batch('part_quotationdetail', $detailData);

        redirect(base_url() . "index.php/parts/getquot/$quot_id");

    }
    function viewsmr($smrid)
    {
        if(isset($smrid))
        {

            $Data = array();
            $query = $this->db->query("select * from smr_detail where idsmr='$smrid'");
            $Data['smrsdetails'] = $query->result_array();
            $query = $this->db->query("select * from smr where idsmr='$smrid'");
            $Data['smrs'] = $query->result_array();
            $this->load->view('header_parts', $Data);
            $this->load->view('viewsmr', $Data);
            $this->load->view('footer');

        }
        else
            redirect (base_url() . "index.php/parts/gatepass");

    }
	function viewimgsmr($smrimgid)
    {
       if(isset($smrimgid))
        {

            $Data = array();
            $query = $this->db->query("select * from img_smrdetail where idimgsmr ='$smrimgid'");
            $Data['smrsdetails'] = $query->result_array();
            $query = $this->db->query("select * from imgsmr where idimgsmr='$smrimgid'");
            $Data['smrs'] = $query->result_array();
            $this->load->view('header_parts', $Data);
            $this->load->view('viewimgsmr', $Data);
            $this->load->view('footer');

        }
        else
            redirect (base_url() . "index.php/parts/gatepass");

        
    }
	function viewquot($viewquot)
    {
       if(isset($viewquot))
        {

            $Data = array();
            $query = $this->db->query("select * from part_quotationdetail where quot_id ='$viewquot'");
            $Data['quotdetails'] = $query->result_array();
            $query = $this->db->query("select * from part_quotation where quot_id='$viewquot'");
            $Data['quot'] = $query->result_array();
            $this->load->view('header_parts', $Data);
            $this->load->view('viewquot', $Data);
            $this->load->view('footer');

        }
        else
            redirect (base_url() . "index.php/parts/gatepass");

        
    }

    function getallsmr(){
        return $this->db->order_by("idsmr", "desc")->get('smr')->result_array();
    }
    /*SMR Code*/
}
