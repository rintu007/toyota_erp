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
                popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/css/style.css><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css><link rel=Stylesheet href=<?= base_url(); ?>assets/css/stylesheet.css></head><body onload="window.print()">');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
            /*--This JavaScript method for Print Preview command--*/
            function PrintPreview() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css><link rel=Stylesheet href=<?= base_url(); ?>assets/css/stylesheet.css></head><body>');
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
			.border-1px th, .border-1px td:nth-child(2) {    width: 20%;}
			.border-1px th, .border-1px td:nth-child(1){ width: 14%;}
			.border-1px th, .border-1px td:nth-child(3){ width: 43%;}
			.border-1px th, .border-1px td:nth-child(4){ width: 10%;}
			</style>
    </head>

    <body>
    <pre>
       <?php
//       print_r($SaleInvoice);
    ?>

        </pre>
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

        <div class="container" style="width: 948px;">

        <div class="report-header">
            <div class="col-sm-2 col-xs-2 pull-left"><div class="toyota-logo" style="margin-top: 60%;"><img src="<?= base_url(); ?>assets/images/toyota.PNG"></div></div>
            
            <div style="width:70%; float:left; text-align:center;">
            <strong>Invoice</strong>
            <h4 style="margin:0px;">Toyota Western Motors</h4>
            <p>38, Estate Avenue, S.I.T.E., Karachi, Sindh, Pakistan <br> Phone: 021-32590184,32564531 / 2564532 Fax: 9221-2564536. <br> Email: Parts@toyotawestern.com</p>
            </div>
            
            <div class="col-sm-2 col-xs-2 pull-right"><div class="daihatsu-logo" style="margin-top: 60%;"><img src="<?= base_url(); ?>assets/images/daihaisu-logo.PNG"></div></div>
        </div><!--report-header end -->

        <!--<div class="full-grid text-center gray-bg"><h4>INDUS MOTOR COMPANY LIMITED</h4></div>
        <div class="full-grid text-center gray-bg"><h4>INVOICE <small>cum sales tax invoice (Original)</small></h4></div>-->




        <div class="table-responsive report-table none-border">
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
                    <td><?=$SaleInvoice[0]['Name']?></td>
                    <td>Invoice No. : </td>
                    <td>TWM-INV-<?=$SaleInvoice[0]['InvoiceNumber']?></td>
                     
                </tr>
                <tr>
                    <td>Contact No. :</td>
                    <td><?=$SaleInvoice[0]['MobileNumber']?></td>
                    <td>Order Date. :</td>
                    <td><?=$SaleInvoice[0]['CreatedDate']?></td>
                   
                </tr>
                
				<tr>
                    <td>NTN. :</td>
					<?php if($SaleInvoice[0]['Ntn'] == null ){
						$ntn= 0;
					} else{
						$ntn= $SaleInvoice[0]['Ntn'];
					}?>
                    <td><?= $ntn ; ?></td>
                    <td>NTN. :</td>
                    <td>1554997-6</td>
                   
                </tr>
                <tr>
                    <td>STRN. :</td>
					<?php if($SaleInvoice[0]['Strn'] == null ){
						$Strn= 0;
					} else{
						$Strn= $SaleInvoice[0]['Strn'];
					}?>
                    <td><?= $Strn;?></td>
                    <td>STRN. :</td>
                    <td>17-12-8708-133-46</td>
                   
                </tr>
                </tbody>
            </table>
        </div>




        <div class="row">
            <div class="span12 bold">
                <!--<span class="" style="font-size: 24px;">Sale Invoice</span>-->
                <strong class="text-left" style="margin-left: 14%;">Remarks:</strong>
            </div>
        </div>
       

        <!--                <div class="row">
            <div class="span4">
                <div class="row-fluid">
                    <div class="span4 text-right">
                        <span class="bold">Attn :</span>
                    </div>
                    <div class="span8">
                        <span >Name</span>
                    </div>
                </div>
            </div>
            <div class="span8">
                <div class="row-fluid">
                    <div class="span12 text-center">
                        <span class="bold underline">Marketing Division</span>
                    </div>
                </div>
            </div>
        </div>-->

        <!--                <div class="row">
                            <div class="span4">
                                <div class="row-fluid">
                                    <div class="span4 text-right">
                                        <span class="bold">M/S :</span>
                                    </div>
                                    <div class="span8">
                                        <span >Bank Name</span>
                                    </div>
                                </div>
                            </div>
                            <div class="span8">
                                <div class="row-fluid">
                                    <div class="span6 text-right">
                                        <span class="bold">Reference#:</span>
                                    </div>
                                    <div class="span6">
                                        <span> Reference </span>
                                    </div>
                                </div>
                            </div>
                        </div>-->
<!--
        <div class="row">
            <div class="span4">
                <div class="row-fluid">
                    <div class="span4 text-right">
                        <span class="bold">Invoice Number:</span>
                    </div>
                    <div class="span8">
                        <span> <?= $SaleInvoice[0]["InvoiceNumber"]?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="row-fluid">
                    <div class="span4 text-right">
                        <span class="bold">Date:</span>
                    </div>
                    <div class="span8">
                        <span> <?= $SaleInvoice[0]["SaleDate"]?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="span4">
                <div class="row-fluid">
                    <div class="span4 text-right">
                        <span class="bold">A/C:</span>
                    </div>
                    <div class="span8">
                        <span><?= $SaleInvoice[0]["CustomerName"]?></span>
                    </div>
                </div>
            </div>
        </div>-->

        <div class="row-fluid report-table">
            <div class="span12">
                <div class="table-responsive border-1px">
                    <table class="table">
                        <thead>
						<th style="width:auto;">S No.</th>
                        <th style="width:auto;">Item ID</th>
                        <th style="width:auto;">Part Desc</th>
                        <th style="width:auto; text-align:center;">Qty</th>
                        <th style="width:auto; text-align:right;">Rate</th>
                        <th style="text-align:right !important;">Amount</th>
                        </thead>
                        <tbody>
                        <?php
                                                        $count = 1;
                                                       $totalQty = 0;
                                                       $totalAmount = 0;
                        foreach ($SaleInvoice as $saleInvoice) {
                        ?>
                        <tr>
							<td><?= $count++ ?></td>
                            <td><?=$saleInvoice["PartNumber"]?> </td>
                            <td><?=$saleInvoice["PartName"]?> </td>
                            <td style="text-align:center !important;"><?=$saleInvoice["SaleQuantity"]?> </td>
                           
                            <td style="text-align:right !important;"> <?=$saleInvoice["SalePrice"]?> </td>
                            <td style="text-align:right !important;"> <?=$saleInvoice["TotalPrice"]?> </td>
                            <!--<td style="text-align: center;"> <?=$saleInvoice["PartNumber"]?> </td>-->
                            
                        </tr>
                        
                        <?php
                        $totalQty += $saleInvoice["SaleQuantity"];
                        $totalAmount += $saleInvoice["TotalPrice"];
                        }
                        ?>

                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td style="border:none !important;"><strong>Customer Copy</strong></td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td colspan="2" style="text-align:right !important;">Total Value :</td>
                            <td style="text-align:right !important;"><?= $totalAmount.".00"?></td>
                        </tr>
                        
                        <tr>
                            <td style="border:none !important;"><strong>&nbsp;</strong></td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td colspan="2" style="text-align:right !important;">Discount</td>
                            <td style="text-align:right !important;"><?php echo $SaleInvoice[0]['Discount'].".00"?></td>
                        </tr>
						<tr>
                            <td style="border:none !important;"><strong>&nbsp;</strong></td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
							<td colspan="2" style="text-align:right !important;">Surcharge</td>
							<td style="text-align:right !important;"><?php echo $SaleInvoice[0]['Surcharge'].".00"?></td>
                        </tr>
                        
                        <tr>
                            <td style="border:none !important;"><strong>&nbsp;</strong></td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                            <td colspan="2" style="text-align:right !important;"><strong>Grand Total (Rounded) :</strong></td>
                            <td style="text-align:right !important;"><strong><?php echo $SaleInvoice[0]['TotalAmount']+$SaleInvoice[0]['Surcharge'].".00"?></strong></td>
                        </tr>

          
                        </tbody>
                    </table>

				<div class="col-sm-12">
                <p><span style="color:#f00; font-size: 16px;">*</span> Parts once sold will not be take back or exchange</p>
                <p><span style="color:#f00; font-size: 16px;">*</span> All Goods received in sound condition</p>
                </div>

                </div>


            </div>
        </div>
        
        
        
		<div class="col-sm-12">

        		<div class="col-sm-12" style="margin: 40px 10px;">
        <p>Date : <strong><?=$SaleInvoice[0]['SaleDate']?></strong></p>
        </div>
        <p><hr style="margin-top:20px; border:1px solid #dfdfdf;"></p>
        
        <div class="row">
        <div style="width:65%; float:left; text-align:right;">
        <div class="sign-box">
        <div class="title">PREPARED BY</div>
        </div>
        <div class="sign-box">
        <div class="title">CHECKED BY</div>
        </div>
        </div>
        <div style="width:30%; float:right;">
        <hr style="margin-top:25px;">
        <p class="text-center"><strong>(PARTS DEPARTMENT)</strong></p>
        </div>
        </div>
        </div>
        
        
        </div>


        
        

        <p><br/>
        <br/><br></p>
        
        

        </div>    



</body>
</html>	


