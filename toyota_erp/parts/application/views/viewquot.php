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
            popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css><style>.table-responsive.order-table table tr td:first-child {border-left: 2px solid #dfdfdf !important;}</style></head><body onload="window.print()">');
            popupWin.document.write(toPrint.innerHTML);
            popupWin.document.write('</html>');
            popupWin.document.close();
        }
        /*--This JavaScript method for Print Preview command--*/
        function PrintPreview() {
            var toPrint = document.getElementById('printArea');
            var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
            popupWin.document.open();
            popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css><style>.table-responsive.order-table table tr td:first-child {border-left: 2px solid #dfdfdf !important;}</style></head><body>');
            popupWin.document.write(toPrint.innerHTML);
            popupWin.document.write('</html>');
            popupWin.document.close();
        }
    </script>
    <style>
        .border {
            border:1px solid black;
        }
        .bold {
            font-weight: bold;
        }
        .underline {
            text-decoration: underline;
        }
		.table-responsive.order-table table tr td:first-child {
			border-left: 2px solid #dfdfdf !important; }
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

<div class="container border" style="width: 948px;">

<div class="report-header" style="border: none !important;">
    <div class="col-sm-6 col-xs-6 pull-left"><div class="toyota-logo"><img src="<?= base_url(); ?>assets/images/toyota-logo.PNG"></div></div>
    <div class="col-sm-6 col-xs-6 pull-right"><div class="daihatsu-logo"><img src="<?= base_url(); ?>assets/images/daihaisu-logo.PNG"></div></div>
</div><!--report-header end -->

<div class=" text-center "><h2 style="margin-top: -14px; color:gray;">Quotation</h2></div>
<div class=" text-center "><h3 style="margin-top: -22px; color:#1f1f14;">TOYOTA WESTERN MOTORS<h3></div>
<div class=" text-center "><h5 style="margin-top: -19px; color:gray;">C-38 ESTATE AVENU SITE KARACHI</h5></div>
<div class=" text-center "><h5 style="margin-top: -12px; font-family:arial;">Phone 0213-2590184   Fax 0213-2590186</h5></div>




<!--<form  id='gatepassform' action="<?= base_url() ?>index.php/parts/savegatepass" method="post">-->

        <div class="table-responsive report-table none-border" style="font-size:px;">
            <table class="table customer-details">
                <thead>
               
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>Customer Name. :</td>
                    <td style="color: gray;"><?= $quot[0]['cusName']  ?></td>
                    <td>Date. : </td>
                    <td style="color: gray;"><?= $quot[0]['date']  ?></td>
                     
                </tr>
                <tr>
                    <td>Phone No. :</td>
                    <td style="color: gray;"><?= $quot[0]['phone']  ?></td>
                    <td>Quotation No. :</td>
                    <td style="color: gray;"><?= $quot[0]['quotationNo']  ?></td>
                   
                </tr>
                
				<tr>
                    <td>Address. :</td>
                    <td style="color: gray;"><?= $quot[0]['address']  ?></td>
                   
                </tr>
               
                </tbody>
            </table>
        </div>




<div class="row-fluid">
    <div class="span12 text-center">


                        <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRowLocal">+</span>-->

        <div class="table-responsive order-table">
		<table class="table" id="gatepassdetail">
                <thead>

                <tr style="font-size:12px;">
                    <th align="center">S.No</th>
                    <th align="center">Part No#</th>
                    <th align="center">Description</th>
					 <th align="center">Quantity</th>
					 <th align="center">Unit Price</th>
					 <th align="center">Amount</th>
                </tr>
                </thead>
                <tbody>
 <?php							$totalAmount = 0;
                                $count = 1;
                                foreach ($quotdetails as $row) {
                                  
                                    ?>
                                    <tr id="carUsers"  style="font-size:12px">
                                        <td class="resId" name="resId" style="width: 32px;"><?= $count++ ?></td>
                                        <td class="tbl-name" style="width: 217px;"><?= $row['partNo']  ?></td>
                                        <td class="tbl-name" style="width: 350px;"><?= $row['description']  ?></td>
                                        <td class="tbl-name" style="width: 100px;"><?= $row['Quantity']  ?></td>
                                        <td class="tbl-name" style="width: 100px;"><?= $row['unitPrice']  ?></td>
                                        <td class="tbl-name" style="width: 100px; border-right: 2px solid #dfdfdf !important;"><?= $row['Amount']  ?></td>
                                                                              
                                    </tr>
									 <?php
									 $totalAmount += $row['Amount'];
                                }
                                ?>
									<tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="border-right: 2px solid #dfdfdf !important;">&nbsp;</td>
                        </tr>
						<tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="border-right: 2px solid #dfdfdf !important;">&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td style="border:none !important; height:25px; font-size:12px;border-left: 2px solid #dfdfdf !important;"><strong>Note</strong></td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td  style="text-align:center !important; font-size:11px;"><strong>SUBTOTAL</strong></td>
                            <td style="text-align:center !important;border-right: 2px solid #dfdfdf !important;"><?= $totalAmount  ?></td>
                        </tr>
                        
                        <tr>
                            <td style="border:none !important; height:30px; font-size:12px;border-left: 2px solid #dfdfdf !important;"></td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="text-align:center !important;font-size:12px;"><strong>TAX RATE</strong></td>
                            <td style="text-align:center !important;border-right: 2px solid #dfdfdf !important;"><?= $row['taxRate']  ?></td>
                        </tr>
						<tr>
                            <td style="border:none !important; height:30px; font-size:12px;border-left: 2px solid #dfdfdf !important;"></td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
							<td  style="text-align:center !important; width:160px;font-size:12px;"><strong>SALES TAX</strong></td>
							<td style="text-align:center !important;border-right: 2px solid #dfdfdf !important;"><?= $row['taxRate']/100*$totalAmount  ?></td>
                        </tr>
						<tr>
                            <td style="border:none !important; height:30px; font-size:12px; border-left: 2px solid #dfdfdf !important;"></td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
							<td  style="text-align:center !important; font-size:12px; "><strong>OTHER</strong></td>
							<td style="text-align:center !important;border-right: 2px solid #dfdfdf !important;"></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" style="text-align:left !important; font-size:12px;border-bottom: 2px solid #dfdfdf !important;"><strong>IN RUPEES :</strong>&nbsp;&nbsp;&nbsp;<?= convert_number_to_words($row['taxRate']/100*$totalAmount+$totalAmount)?></td>
                            <td style="text-align:center !important; font-size:12px;border-bottom: 2px solid #dfdfdf !important;"><strong>Grand Total (Rounded) </strong></td>
                            <td style="text-align:center !important;border-right: 2px solid #dfdfdf !important;border-bottom: 2px solid #dfdfdf !important;"><?= $row['taxRate']/100*$totalAmount+$totalAmount ?></td>
                        </tr>
                                   
                </tbody>
            </table>
        </div>

<div class="table-responsive border-none">
    <table class="table">
		
        <tbody>
        <tr>
            <td style="text-align:left; border:none !important; text-decoration:underline;"><strong>TERM & CONDITION :</strong></td>
          <?php 
		  foreach($quot as $row){
		  ?>
        </tr>
        <tr>
        <tr>
            <td style="text-align:left; border:none !important;font-size:12px;">&nbsp;&nbsp;&nbsp;PRICE VALIDITY<strong style="margin-left: 15px;">:&nbsp;&nbsp;&nbsp<?= $row['priceValidity']?></strong></td>
			
		</tr>
        <tr>
            <td style="text-align:left; border:none !important;font-size:12px;">&nbsp;&nbsp;&nbsp;PAYMENT MODE<strong style="margin-left: 12px;">:&nbsp;&nbsp;&nbsp<?= $row['paymentMode']?></strong></td>
			
		</tr>    
		<tr>
            <td style="text-align:left; border:none !important;font-size:12px;">&nbsp;&nbsp;&nbsp;DELIVERY PERIOD<strong style="margin-left: 3px;">:&nbsp;&nbsp;&nbsp<?= $row['deliveryPeriod']?></strong></td>

		</tr>  
		<tr>
            <td style="text-align:left; border:none !important;">&nbsp;&nbsp;&nbsp;<strong></strong>
                </strong></td>
            <td style="text-align:left; border:none !important;">&nbsp;</td>
        </tr> 
		<tr>
            <td style="text-align:left; border:none !important;font-size:14px;">&nbsp;&nbsp;&nbsp;<strong>Thanks & regards,</strong>
                </strong></td>
            <td style="text-align:left; border:none !important;">&nbsp;</td>
        </tr> 
		  <?php } ?>
        </tbody>
    </table>
</div>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                <tr>
					<td style="text-align:left; border:none!important; height:40px;"><strong></strong></td>
					<td style="text-align:left; border-top:none; border-bottom:1px solid black;"><strong></strong></td>
					<td style="text-align:left; border:none !important;"><strong></strong></td>
					<td style="text-align:left; border:none !important;"><strong></strong></td>
					<td style="text-align:left; border:none !important;"><strong></strong></td>
					<td style="text-align:left; border:none !important;"><strong></strong></td>
                    
                </tr>
				<tr>
                    <td style="width:4%; border:none !important;"><strong></strong></td>
                    <td style="text-align:left;width:15%; border:none!important;"><strong>&nbsp;&nbsp;&nbsp;Manager Parts</strong></td>
                    <td style="width:15%; border:none !important;"><strong></strong></td>
                    <td style="width:15%; border:none !important;"><strong></strong></td>
                    <td style="width:15%; border:none !important;"><strong></strong></td>
                    
                </tr>
              
                
                </tbody>
            </table>
        </div>



    </div><!--span12-->
</div>
<!--<input type='submit' value='Save' class='btn' style="margin-left: 44%;">-->
<!--</form>-->
<br/>
<br/>
<hr/>
</div>
</body>
</html>

