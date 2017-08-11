<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class StockReport extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model("Car_dispatch");
    }

    public function index()
    {
        $Data = array();
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
        $config["base_url"] = base_url() . "index.php/stockreport/index";
        $config["total_rows"] = $Dispatch->StockReport_count();
        $this->data['counts']=  $config["total_rows"];
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['page'] = $page+1;
        $this->data["links"] = $this->pagination->create_links();



        $this->data['StockReport'] = $Dispatch->StockReport(NULL, NULL,$config["per_page"], $page);
        $this->load->view('header');
        $this->load->view('stockreport', $this->data);
        $this->load->view('footer');
    }

    public function report()
    {

        $FromDate = $_POST['fromDate'];
        $ToDate = $_POST['toDate'];

        if (isset($_POST['pdf'])) {
            $Dispatch = new Car_dispatch();

            $Data = $Dispatch->StockReport($FromDate, $ToDate);

//            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            //set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Toyota Western Motors');
            $pdf->SetTitle('Stock Reports');
            $pdf->SetSubject('');
            $pdf->SetKeywords('Stock Report');

            //set default header data
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, "Stock Report");
            $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

            //set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            //set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            //set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            //set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            //set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            //set some language-dependent strings (optional)
            if (file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                require_once(dirname(__FILE__) . '/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            //set default font subsetting mode
            $pdf->setFontSubsetting(true);

            //Set font
            //dejavusans is a UTF-8 Unicode font, if you only need to
            //print standard ASCII chars, you can use core fonts like
            //helvetica or times to reduce file size.
            $pdf->SetFont('dejavusans', '', 8, '', true);

            //Add a page
            //This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            //set text shadow effect
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            //Set some content to print
            $html = '&nbsp;&nbsp;<span>Date:' . date('M d, Y') . '</span><br>
        <table border="1" align="center">
            <thead>
                <tr>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>S No.</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Model</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Customer</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Color</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Chassis Number</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Engine Number</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>PBO Number</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Invoice</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>WHT Filer</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>WHT Non Filer</b></td>
                    <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Receiving Date</b></td>
					 <td width="80" height="30" style="line-height: 30px;" align="center" colspan="2"><b>Actual SalePerson</b></td>
                </tr>
            </thead>
            <tbody>';
            $count = 1;
            foreach ($Data as $allData) {
                $html .= '
                <tr>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $count++ . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['Variants'] . '</td>
                     <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['CustomerName'] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData['ColorName'] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["ChasisNo"] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["EngineNo"] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["PboNumber"] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["TotalPrice"] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["WHTFiler"] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["WHTNFiler"] . '</td>
                    <td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["DispatchedDate"] . '</td>
					<td width="80" height="30" style="line-height: 30px;" align = "center" colspan="2">' . $allData["ActualSalePerson"] . '</td>
                </tr>';
            }
            $html .= '</tbody>
        </table>';

            //Print text using writeHTMLCell()
//        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->writeHTML($html, true, false, false, false, '');

            //Close and output PDF document
            //This method has several options, check the source code documentation for more information.
            $pdf->Output('twm.pdf', 'I');
        }
    }

    function insert_salereturn($idDispatch)
    {
        $this->db->insert('car_sale_return', array('idDispatch' => $idDispatch));

        $this->db->where('idDispatch', $idDispatch)
            ->update('car_dispatch', array('isStock' => 0, 'isDelivered' => 0));
        $pboId = $this->db->select("PboId")
            ->from('car_dispatch')
            ->where("idDispatch", $idDispatch)->get()->row("PboId");

        $this->db->where('Id', $pboId)
            ->update('car_pbo', array('DispatchCreated' => 0, 'ChasisNumber' => null, 'EngineNumber' => null));



        $this->session->set_flashdata('message', "Dispach no# $idDispatch has been Returned");
        redirect(site_url('index.php/StockReport/index'));
        die;

    }

    function pdi($idDispatch)
    {

        $query= $this->db->query("select cd.idDispatch,cd.PboId,cd.VariantId,cv.Variants,cd.ChasisNo,cp.RegistrationNumber
                                    from  car_dispatch cd 
                                     left join car_variants cv
                                    on cv.IdVariants=cd.VariantId
                                
										  left    join car_pbo cp 
                                    on cd.PboId = cp.Id
                                  
                                    where cd.idDispatch = $idDispatch");
        $data = array();
        $data['data'] = $query->row();
        $this->load->view('header');
        $this->load->view('pdi',$data);
        $this->load->view('footer');


    }

    function pdi_insert()
    {
//        var_dump($_POST);die;
        $post = $_POST;
        unset($post['PboId']);
        $this->db->insert("car_pdi",$post);



        $this->db->where("Id",$_POST['PboId'])
            ->update('car_pbo',array('Pdi'=>1));

        $this->db->where("idDispatch",$_POST['idDispatch'])
            ->update('car_dispatch',array('pdi'=>1));

        if(!isset($_POST['is_salereturn']))
        {

          $this->insert_salereturn($_POST['idDispatch']);

        }

        $this->session->set_flashdata('message', "Dispach no#". $_POST['idDispatch'] ." has been inserted to PDI");
        redirect(site_url('index.php/StockReport/index'));

    }


    function pdi_list()
    {
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
        $config["base_url"] = base_url() . "index.php/stockreport/pdi_list";
        $config["total_rows"] = $this->get_pdilist_count();
        $this->data['counts']=  $config["total_rows"];
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['page'] = $page+1;
        $this->data["links"] = $this->pagination->create_links();

        $this->data['pdi'] = $this->get_pdilist($config["per_page"], $page);

        $this->load->view('header');
        $this->load->view('pdilist', $this->data);
        $this->load->view('footer');

    }
    function pdi_view($id)
    {
        $query= $this->db->query("select cd.PboId,cd.VariantId,cv.Variants,cd.ChasisNo,cp.RegistrationNumber,p.*
                                    from car_pdi p
                                   
                                    join car_dispatch cd
                                    on cd.idDispatch = p.idDispatch
                                    
                                   left  join car_pbo cp 
                                     on cd.PboId = cp.Id
                                    
                                    join car_variants cv
                                    on cv.IdVariants=cd.VariantId
                                    where p.id = $id");
        $data = array();
        $data['row'] = $query->row_array();
        $this->load->view('header');
        $this->load->view('pdi_view', $data);
        $this->load->view('footer');

    }

    function get_pdilist( $perpage = '', $limit = '')
    {

        $this->db->select('pd.id,pd.idDispatch,pd.is_salereturn,pd.inspectorname,cd.ChasisNo,pb.RegistrationNumber,pd.created_date')
            ->from('car_pdi pd')
            ->join('car_dispatch cd','pd.idDispatch=cd.idDispatch','left')
            ->join('car_pbo pb','pb.Id = cd.PboId','left');

        if(isset($_POST['idDispatch']) && $_POST['idDispatch']!='')
        {
            $this->db->where('pd.idDispatch', $_POST['idDispatch']);
        }
        if(isset($_POST['ChasisNo']) && $_POST['ChasisNo']!='')
        {
            $this->db->where('cd.ChasisNo', $_POST['ChasisNo']);
        }
        if(isset($_POST['inspectorname']) && $_POST['inspectorname']!='')
        {
            $this->db->like('inspectorname', $_POST['inspectorname']);
        }
        if(isset($_POST['created_date']) && $_POST['created_date']!='')
        {
            $this->db->where('date(created_date)', $_POST['created_date']);
        }


        if(  $perpage != '' or  $limit!='')
            $this->db->limit($perpage, $limit);

        $this->db->order_by('pd.id','desc');

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_pdilist_count()
    {

        return $this->db->count_all('car_pdi');
    }
}














