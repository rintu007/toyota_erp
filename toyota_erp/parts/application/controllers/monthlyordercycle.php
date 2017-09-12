<?php 
class Monthlyordercycle extends CI_Controller {

    protected $brand;

    function __construct() {
        parent::__construct();
        $this->load->model('Parts_invoices');
		$this->load->model('parts_invoices');
        $this->load->model('Order_mode');
        $this->load->model('Reporting');
        $this->load->library("Pdf");
    }
	function getDealer($Dealer) {
        $Dealer = $this->db->query("SELECT IdSubDealer from car_sub_dealer WHERE Name = '$Dealer'");
        return $Dealer->row();
    }
	function getTypeId($TypeName) {
        $idType = $this->db->query("SELECT id from invoice_claim_type WHERE Title = '$TypeName'");
        return $idType->row();
    }
    public function index() {
        
        $Data = array();
        $invoice = new Parts_invoices();
        if (isset($_POST["BrandCode"])) {
            $this->brand = $_POST["BrandCode"];
            $this->session->set_userdata('BrandCode', $this->brand);
            $Data['BrandCode'] = $this->brand;
			$Data['OrderType'] = $invoice->getMonthlyOrderCode()[0];
            $Data['OrderNo'] = $invoice->getOrderNumber($Data['OrderType']);
            $Data['Part'] = $this->parts('Daily Order');
//                    print_r($Data["Part"]);exit();
            $this->load->view('header_parts', $Data);
            $this->load->view('monthlyordercreate', $Data);
            $this->load->view('footer');
            
        } 
        else {
           redirect(base_url() . "index.php/invoices");
        }
    }
    function saveMonthlyOrder()
    {  
		
		if(isset($_POST))
		{
		$cookieData = unserialize($_COOKIE['logindata']);
		$this->db->trans_start();
        $OrderNo = $this->input->post('OrderNo');
        $pos = strrpos($OrderNo, '-');
        $OrderNumbr = $pos === false ? $OrderNo : substr($OrderNo, $pos + 1);
        $DealerId = $this->getDealer($cookieData['Dealer']);
        $idDealer = $DealerId->IdSubDealer;
        $TypeId = $this->getTypeId('MONTHLY ORDER CYCLE');
        $idType = $TypeId->id;
        $Date = $this->input->post('Date');
        $IdPart = $this->input->post('IdPart');
        $DealerRemarks = NULL;
        $IMCRemarks = NULL;
        $date = date('Y/m/d');
        $time = strtotime($date);
        $month_only = date('m', $time);
        $Month = $month_only;
		$Year =date('Y', $time);
		$Quantity1 =  $this->input->post('Quantity1');
		$Quantity2 =  null;
		$Quantity3 =  null;
        $month1 =  $this->input->post('month1');
        $month2 =  null;
        $month3 =  null;
        $OrderReason =  $this->input->post('OrderReason');
        $QuantityInStock =  $this->input->post('QuantityInStock');
        $unitprice =  $this->input->post('unitprice');
        $MAD =  $this->input->post('MAD');
        $Quantity1 =  $this->input->post('Quantity1');
        $Quantity2 =  null;
        $Quantity3 =  null;
        $BrandCode =  $this->input->post('BrandCode');
//        $month3 =  $this->input->post('month3');
//        $month3 =  $this->input->post('month3');
//        $month3 =  $this->input->post('month3');
//        $month3 =  $this->input->post('month3');
//        $month3 =  $this->input->post('month3');
//        $month3 =  $this->input->post('month3');
				
				
                $Data = array();
                for ($i = 0; $i < count($IdPart); $i++) 
                {
					$OrderNumber= array(
						"DealerId" => $idDealer,
						"TypeId" => $idType,
						"Month" => $Month,
						"Year" => $Year,
						"Number" => $OrderNumbr,
						"BrandCode" => $this->input->post('BrandCode'),
						"DealerRemarks" => $DealerRemarks[$i],
						"IMCRemarks" => $IMCRemarks[$i],
						"Date" => $Date
						);
					$this->db->insert('order_number', $OrderNumber);
					$idOrderNumber = $this->db->insert_id();
					$InvoiceDetails= array(
						"DispatchId" => NULL,
						"OrderNumberId" => $idOrderNumber,
						"PartId" => $IdPart[$i],
						"Quantity" => $Quantity1[$i]
						);
						
				  $this->db->insert('order_invoice_details', $InvoiceDetails);
                    $Data[]= array(
                      'IdPart' => $IdPart[$i],
                      'month1' => $month1,
                      'month2' => $month2,
                      'month3' => $month3,
                      'OrderReason' => $OrderReason[$i],
                      'QuantityInStock' => $QuantityInStock[$i],
                      'unitprice' =>  $unitprice[$i],
                      'Quantity1' => $Quantity1[$i],
                      'Quantity2' => $Quantity2[$i],
                      'Quantity3' => $Quantity3[$i],
                      'MAD' => $MAD,
                      'BrandCode' => $BrandCode
                     
                  );
				  
              }
			  $this->db->insert_batch('monthly_order_cycle', $Data);
			$this->db->trans_complete();
            }
            $this->session->set_flashdata('message','Monthly Order Saved Successfully');
             redirect(base_url() . "index.php/invoices");
			 
            
    }
    function saveDailyOrder() {
        
    }
            
    
     function parts() {
        $invoice = new Parts_invoices();
        return $invoice->fillPartCombo('MONTHLY ORDER CYCLE');
        
//        $fillPartCombo = $invoice->fillPartCombo();
//        echo json_encode($fillPartCombo);
    }
}