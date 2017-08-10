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
        <link rel=Stylesheet href=<?= base_url(); ?>assets3/css/bootstrap.min.css>
        <link rel=Stylesheet href=<?= base_url(); ?>assets3/css/style.css>
        <script type="text/javascript">
            /*--This JavaScript method for Print command--*/
            function PrintDoc() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=900px,height=700px,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets3/css/bootstrap.min.css><link rel=Stylesheet href=<?= base_url(); ?>assets3/bootstrap/css/bootstrap.css><link rel=Stylesheet href=<?= base_url(); ?>assets3/css/bootstrap.min.css></head><body onload="window.print()">');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
            /*--This JavaScript method for Print Preview command--*/
            function PrintPreview() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets3/css/bootstrap.min.css><link rel=Stylesheet href=<?= base_url(); ?>assets3/css/style.css></head><body>');
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

        <div class="container requisition" style="border:1px solid black;width:90%;margin-bottom:10%;">
<h3 style="text-decoration:underline; text-align:center;">Part Requisition From Service Department</h3>
<!--
<div class="col-sm-12">
<div class="row">
<div class="col-sm-7 text-align:center;">
<h2 style=" background-color:#000;text-align:center;color: #fff;margin-top: 1;"><span style="width:40%"class="box">MECHANICAL</span></h2>
</div>

<div class="col-sm-4 pull-right"><br/><br/>
<strong>S.NO.</strong> <span class="span2">27999</span>
</div>
</div>
</div>

<div class="col-sm-m-btm">
<div class="col-sm-3"> <strong>Date:</strong> <span><?php $Date=$getPartsByRo[0]['CreatedDate'];
														echo date("d-m-Y", strtotime($Date)); ?></span>
</div>
</div>

<div class="col-sm-12 m-btm">
<div class="col-sm-3 pull-right"> <strong>Time</strong> <span><?php $time=$getPartsByRo[0]['CreatedDate'];
														echo date("H:i",strtotime($time)); ?></span>
</div>
</div>

<div class="col-sm-12 m-btm">
<div class="col-sm-8"> <strong>Customer Name</strong> <span>&nbsp;&nbsp;&nbsp;<?= $time=$getPartsByRo[0]['CustomerName'] ?></span></div>
<div class="col-sm-4"> <strong>Make</strong> <span>XYZ</span></div>
</div>

<div class="col-sm-12 m-btm">
<div class="col-sm-4"> <strong>Model</strong> <span><?= $time=$getPartsByRo[0]['Model'] ?></span></div>
<div class="col-sm-4"> <strong>Model Code</strong> <span><?= $time=$getPartsByRo[0]['ModelCode'] ?></span></div>
<div class="col-sm-4"> <strong>Reg No.</strong> <span><?= $time=$getPartsByRo[0]['RegistrationNumber'] ?></span></div>
</div>


<div class="col-sm-12 m-btm">
<div class="col-sm-3"> <strong>Chassis</strong> <span><?= $time=$getPartsByRo[0]['ChassisNumber'] ?></span></div>
<div class="col-sm-3"> <strong>Engine</strong> <span><?= $time=$getPartsByRo[0]['EngineNumber'] ?></span></div>
<div class="col-sm-3"> <strong>EST.NO</strong> <span><?= $time=$getPartsByRo[0]['EstNumber'] ?></span></div>
<div class="col-sm-3"> <strong>R. O. No.</strong> <span><?= $time=$getPartsByRo[0]['idRepairOrderBill'] ?></span></div>
</div>
-->
<h2 style="text-align:center;"><span class="box">MECHANICAL</span></h2>

<table class="namesect">
<!--<tr>
    <th colspan="12" style="text-align:center;"><span class="box">MECHANICAL</span></th>
</tr>-->
<tr>
    <td colspan="4">&nbsp;</td>
	<td><strong>S.NO. </strong>27999</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
    <td><strong>Date:</strong></td>
	<td><?php $Date=$getPartsByRo[0]['CreatedDate'];
	                                        echo date("d-m-Y", strtotime($Date)); ?> </td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	
	<td><strong>Time:</strong></td>
	<td><?php $time=$getPartsByRo[0]['CreatedDate'];
											echo date("H:i",strtotime($time)); ?> </td>												
</tr>
<tr>
    <td>&nbsp;</td>
</tr>

<tr>
    <td><strong>Customer Name</strong></td>
	<td style="padding-left:5px;"><?= $time=$getPartsByRo[0]['CustomerName'] ?></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td><strong>Make</strong></td>
	<td>Toyota Grande</td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
    <td><strong>Model</strong></td>
	<td><?= $time=$getPartsByRo[0]['Model'] ?></td> 
   <td>&nbsp;&nbsp;&nbsp;</td>
	<td><strong>Model Year</strong></td>
	<td style="padding-left:5px;">2016</td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
     <td><strong>Reg No.</strong></td>
	 <td><?= $time=$getPartsByRo[0]['RegistrationNumber'] ?></td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	 <td><strong>Chassis</strong></td>
	 <td style="padding-left:5px;"><?= $time=$getPartsByRo[0]['ChassisNumber'] ?></td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
	 <td><strong>Engine</strong></td>
	 <td><?= $time=$getPartsByRo[0]['EngineNumber'] ?></td>
	 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	 <td><strong>EST.NO</strong></td>
	 <td><?= $time=$getPartsByRo[0]['EstNumber'] ?></td>
	</td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr>
     <td> <strong>R.O. No.</strong></td>
	 <td><?= $time=$getPartsByRo[0]['idRepairOrderBill'] ?></td>
</tr>

</table>
<br><br>
<table class="table requisition table-border">
<thead>
<tr>
<th>S.NO.</th>
<th align="center">Part Name</th>
<th>Parts Number</th>
<th>Qty</th>
<th>Amount</th>
</tr>
</thead>

		<tbody>
			<?php
					$count = 1;
					foreach($getPartsByRo as $key){
			?>
			<tr>
				<td><?= $count++ ?></td>
				<td><?= $key['PartName']?></td>
				<td style="font-size:20px;">-<?php //$key['PartNumber'] ?></td>
				<td><?= $key['PartQuantity']?></td>
				<td><?= $key['CostPrice']*$key['PartQuantity']?></td>
			</tr>
					<?php } ?>
			<tr>
				<td></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
</table>

     <div class="signature pull-left">
           <strong>Service Advisor </strong>
     </div>

     <div class="signature pull-right">
            <strong>Parts Department</strong> 
     </div>
<br><br>
</div>

        </div>    



</body>
</html>	


