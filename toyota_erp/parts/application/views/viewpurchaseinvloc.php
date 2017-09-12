<?php //var_dump($SaleInvoice);
function convert_number_to_words($number) {
    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = array(
        0 => 'Zero',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Fourty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety',
        100 => 'Hundred',
        1000 => 'Thousand',
        1000000 => 'Million',
        1000000000 => 'Billion',
        1000000000000 => 'Trillion',
        1000000000000000 => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    return $string;
}

?>
<html>
<head>
<link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css>
<script type="text/javascript">
        /*--This JavaScript method for Print command--*/
        function PrintDoc() {
            var toPrint = document.getElementById('printArea');
            var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
            popupWin.document.open();
            popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/custom.css><link rel=Stylesheet href=<?= base_url(); ?>assets/css/stylesheet.css></head><body onload="window.print()">');
            popupWin.document.write(toPrint.innerHTML);
            popupWin.document.write('</html>');
            popupWin.document.close();
        }
        /*--This JavaScript method for Print Preview command--*/
        function PrintPreview() {
            var toPrint = document.getElementById('printArea');
            var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
            popupWin.document.open();
            popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/custom.css><link rel=Stylesheet href=<?= base_url(); ?>assets/css/stylesheet.css></head><body>');
			
            popupWin.document.write(toPrint.innerHTML);
            popupWin.document.write('</html>');
            popupWin.document.close();
        }
    </script>
<style>
.border {
	border: 1px solid black;
}
.bold {
	font-weight: bold;
}
.underline {
	text-decoration: underline;
}
.gray-bg {
	background: #ebebeb !important;
	color: #000 !important;
	border-top: 1px solid;
	border-bottom: 1px solid;
}
h4 {
	font-size: 19.5px;
}
.half-width {
	width: 42%;
	display: inline-block;
	padding: 16px;
	font-size: 16px;
}
.table th, .table td {
	border: 0px !important;
}
.table th {
	font-weight: bold;
	font-size: 13px;
	background: #f5f5f5;
	text-align:top;
}
.table-responsive.order-table.bottom table thead tr th {
	background: #f5f5f5;
	border: 1px solid #C5C5C5 !important;
}
p {
	padding: 5px;
	padding-left: 10px;
	padding-bottom: 0;
	margin: 0;
}
.footer-lbl {
	float: left;
	width: 30%;
	padding-left: 10px;
}
.invoi_right_td {
	width: 42%;
	float: right;
	text-align: left !important;
}
.table th, .table td {
	padding-bottom: 4px !important;
	padding-top: 0 !important;
	
}
.invio_left_td {
	text-align: left !important;
	padding-left: 15px !important;
}
</style>
</head>

<body>
<?php

$count = 1;
?>
<br/>
<div class="container" style="width: 948px;">
  <div class="row-fluid">
    <div class="span12 text-center">
      <input type="button" value="Print" class="btn-primary" onClick="PrintDoc()"/>
      <input type="button" value="Print Preview" class="btn-info" onClick="PrintPreview()"/>
    </div>
  </div>
</div>
<br/>
<div id="printArea">
<div id="ImcPurchase" class="container border" style="width: 948px;">
  <div class="report-header">
    <div class="col-sm-6 col-xs-6 pull-left">
      <div class="toyota-logo"><img src="<?= base_url(); ?>assets/images/toyota-logo.PNG"></div>
    </div>
    <div class="col-sm-6 col-xs-6 pull-right">
      <div class="daihatsu-logo"><img src="<?= base_url(); ?>assets/images/daihaisu-logo.PNG"></div>
    </div>
  </div>
  <!--report-header end -->
  
  <div class="full-grid text-center gray-bg">
    <h4>INDUS MOTOR COMPANY LIMITED</h4>
  </div>
  <div class="full-grid text-center gray-bg">
    <h4>INVOICE cum sales tax invoice (Original)</h4>
  </div>
  
  <!--<form  id='gatepassform' action="<?= base_url() ?>index.php/parts/savegatepass" method="post">-->
  <div class="table-responsive border-none">
    <div class="half-width"><strong>Customer Detail</strong></div>
    <div class="half-width" style="text-align:right;"><strong>LOC Detail&nbsp:(Local Parts)</strong></div>
    <table class="table">
      <tbody>
      <td class="invio_left_td"> Customer Code : <strong>
          <??>
          </strong></td>
        <td class="invoi_right_td">Invoice No :
          <strong><?=  sprintf($PurchaseInvoice[0]['InvoiceNumber']) ?></strong></td>
      </tr>
      <tr>
        <td class="invio_left_td">Customer Name : <strong>
          <? ?>
          </strong></td>
        <td class="invoi_right_td">Invoice Date :
          <strong><?=  sprintf($PurchaseInvoice[0]['InvoiceDate']) ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td class="invoi_right_td">Delivery Note No:
          <strong><? ?></strong></td>
      </tr>
      <tr>
        <td class="invio_left_td">Address : <strong>
          <??>
          </strong></td>
        <td class="invoi_right_td">Delivery Note Date:
          <strong><? ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="invio_left_td">PO Number : <strong>
          <?  ?>
          </strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="invio_left_td">PO Date : <strong>
          <? ?>
          </strong></td>
        <td class="invoi_right_td">Ord Reason : 
          <? ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="invio_left_td">STRN : <strong>
          <?= '119000763' ?>
          </strong></td>
        <td class="invoi_right_td">STRN :
            <strong><?= '02-04-8703-001-55' ?></strong></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="invio_left_td">NTN: <strong>
                 <?= '0676546-7'?>
          </strong></td>
        <td class="invoi_right_td">NTN :
            <strong><?= '1554997-6'?></strong></td>
        <td>&nbsp;</td>
      </tr>
      </tbody>
      
    </table>
  </div>
  <div class="row"> </div>
  <br/>
  <br/>
  <div class="row-fluid">
    <div class="span12 text-center"> 
      
      <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRowLocal">+</span>-->
      
      <div class="table-responsive order-table">
        <table class="table" id="gatepassdetail">
          <thead>
            <tr>
              <th align="center">S.No</th>
              <th align="Center" style="width:117px;">Part Number</th>
              <th align="center">Description of Parts</th>
              <th align="center">Quantity</th>
              <th align="center">Unit Price Excluding Sales Tax</th>
              <th align="center">Gross Value Excluding Sales Tax</th>
              <th align="center">Trade Discount</th>
              <th align="center">Net Value Excluding Sales Tax</th>
              <th align="center">Sales Tax @17%</th>
              <th align="center">Extra Sales Tax @2%</th>
              <th align="center">Further Sales Tax @1%</th>
              <th align="center">Total Value Including Sales Tax</th>
              
            </tr>
          </thead>
      </div>
      <div class="table-responsive">
	  <tbody>
             <?php
                                        $count = 0;
										$count1 = count($PurchaseInvoice);
										$TotalSaletax=[];
										$TotalSaletax1=[];
										$TotalSaletax2=[];
										$Tdiscount = [];
										$TNetvalue = [];
										for($i=1;$i <= $count1;$i++)
										{
											array_push($TotalSaletax,  17 / 100 * $PurchaseInvoice[$i-1]['Amount']);
										}
										for($i=1;$i <= $count1;$i++)
										{
											array_push($TotalSaletax1,  2 / 100 * $PurchaseInvoice[$i-1]['Amount']);
										}
										for($i=1;$i <= $count1;$i++)
										{
											array_push($TotalSaletax2,  1 / 100 * $PurchaseInvoice[$i-1]['Amount']);
										}
										for($i=1;$i <= $count1;$i++)
										{
											array_push($Tdiscount,  $PurchaseInvoice[$i-1]['Discount']);
										}
										for($i=1;$i <= $count1;$i++)
										{
											array_push($TNetvalue,  $PurchaseInvoice[$i-1]['Amount']);
										}
										$totalamount = array_sum($Tdiscount)+array_sum($TNetvalue)+array_sum($TotalSaletax)+array_sum($TotalSaletax1)+array_sum($TotalSaletax2);
                                        foreach ($PurchaseInvoice as $InventoryPurchase) {
                                            $InventoryId = $InventoryPurchase['idPurchase'];
											//var_dump($InventoryIdIMC);.
											$saletax1 =17 / 100 * $InventoryPurchase['Amount'];
											$saletax2 =2 / 100 * $InventoryPurchase['Amount'];
											$saletax3 =1 / 100 * $InventoryPurchase['Amount'];
											
                                            ?>
                                            <tr id="carUsers">
                                                <td class="resId" name="resId"><?= $count++ ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchase['PartNumber']?></td>
                                                <td class="tbl-name"><?= $InventoryPurchase['Description'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchase['PurchaseQuantity'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchase['unitPrice'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchase['Amount'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchase['Discount'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchase['Amount'] ?></td>
                                                <td class="tbl-name"><?= $saletax1 ?></td>
                                                <td class="tbl-name"><?= $saletax2 ?></td>
                                                <td class="tbl-name"><?= $saletax3 ?></td>
                                                <td class="tbl-name"><?= ($InventoryPurchase['Amount'] + $saletax1 + $saletax2 + $saletax3) ?></td> 
                                                
                                                <?php
                                                //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                                ?>
                                                <!--</td>-->
                                            </tr>
                                            <?php
                                        }
										
                                        ?>
          </tbody>
        </table>
      </div>
    </div>
    <!--span12--> 
  </div>
  <!--<input type='submit' value='Save' class='btn' style="margin-left: 44%;">--> 
  <!--</form>--> 
  <br/>
  <br/>
  <hr/>
  <div class="row-fluid">
    <div class="table-responsive order-table bottom">
      <table class="table" id="gatepassdetail">
        <thead>								
          <tr>
            <th style="text-align: left; width: 29%;">Amount In Words: </th>
            <th align="center"> Total: </th>
			<th align="center"> &nbsp 0 &nbsp</th>
			<th align="center"> &nbsp 0 &nbsp</th>
			<th align="center"> &nbsp 0 &nbsp</th>
			<th align="center"> &nbsp 0 &nbsp</th>
            <th align="center">&nbsp <?= array_sum($Tdiscount) ?>&nbsp</th>
            <th align="center"><?= array_sum($TNetvalue)?></th>
            <th align="center"><?= array_sum($TotalSaletax)?></th>
            <th align="center"><?= array_sum($TotalSaletax1)?></th>
            <th align="center"><?= array_sum($TotalSaletax2)?></th>
            <th align="center"><?= $totalamount; ?></th>
          </tr>
        </thead>
      </table>
      <div class="fill-width" style="border-bottom: 1px solid #000; padding: 10px;padding-top: 0;"> 
          <strong><?= convert_number_to_words($totalamount)?></strong>
      </div>
      <p>   - Extra sales tax applied as per Chapter XIII of Sales Tax Special Procedure Rules, 2007 on imported auto parts and accessories.<br>
            - We are EXEMPT from Witholding Income Tax on these IMPORTED Supplies Under Section 153 (5) of the Income Tax Ordinance, 2001.<br>
            - We are also EXEMPT from witholding Sales Tax on these Imported supplies Under Rule 5 (XI) of sales tax special procedure (witholding) Rule, 2007.</p>
    </div>
    <div class="gray-bg " style="text-align:center;"><strong>This is computer generated invoice and do not require any stamp or signature</strong></div>
    <div class="footer-bottom">
        <div class="footer-info">&nbsp&nbsp   <strong>Head Office &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</strong> &nbsp&nbsp&nbsp Factory/Registered Office: Plot No: N.W.Z./P-1, Port Qasim Authority, Karachi. Phones:(92-21)34720041-48Fax:(92-21) 34720037</div>
      <div class="footer-info">&nbsp&nbsp   <strong>Islamabad Office :</strong>&nbsp&nbsp&nbsp&nbsp 1-b 1st floor, Awan Arcade,Nazimuddin Road, Islamabad. Phones:(92-51) 2810300-01, Fax:(92-51) 2810302</div>
      <div class="footer-info">&nbsp&nbsp   <strong>Lahore Office &nbsp&nbsp&nbsp&nbsp&nbsp: </strong>&nbsp&nbsp&nbsp 9Z, Commercial Area, Phase III, DHA Lahore Cantt.Phones: (92-42) 35743580-81, Fax: (92-42) 35743582</div>
    </div>
  </div>
</div>
</body>
</html>
 
 
