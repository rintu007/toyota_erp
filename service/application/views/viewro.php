<?php
//var_dump($AdditionalJobs);

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

	<title>TOYOTA CLIFTON MOTORS</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets22/css/style.css"/>
<!---
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  ---->
  
  <!--- css link --->
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--- custom script-->
<!-- <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets22/css/bootstrap.min.css"/> --->
<!-- <script src="http:\\110.93.203.204\htdocs\twm\service\assets22\css\bootstrap.min.css"></script>  --->
<!---->

       <!-- <link rel=Stylesheet href="<?//= base_url(); ?>assets1/css/bootstrap.min.css">-->
       <!-- <link rel=Stylesheet href="<?= base_url(); ?>assets1/css/style.css"> -->
        <script type="text/javascript">
            /*--This JavaScript method for Print command--*/
            function PrintDoc() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=960px,height=700px,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href="<?= base_url(); ?>assets22/css/style.css"></head><body onload="window.print()">');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
            /*--This JavaScript method for Print Preview command--*/
            function PrintPreview() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=960px,height=300,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets1/css/bootstrap.min.css><link rel=Stylesheet href=<?= base_url(); ?>assets1/css/bootstrap.min.css><style>li{display:inline;padding: 0px 9px 0px 0px;}#y{display:inline;padding: 0px 30px 0px 10px;}#a{padding: 0px 17px 0px 10px;}</style></head><body>');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
        </script>
      
        

  

       <body>
                 <br/>
		<div class="container-fluid">
			<div class="row">
				 <div class="col-md-12">
                    <div class="span12 text-center">
                      <input type="button" value="Print" class="btn-primary" onClick="PrintDoc()"/>
                      <input type="button" value="Print Preview" class="btn-info" onClick="PrintPreview()"/>
                  </div>
              </div>
	     </div>
	</div>
		      

				 <!--Print area  starts-->
	 <div id="printArea">
						
      <div class="container-fluid" >
	  <div class="row">
	  <div class="col-md-12">
   <p style="font-size:12px;text-align:center;margin-bottom:0px"><strong>REPAIR ORDER MECHANICAL</strong></p>
     <table class="header" style="border:1px solid black;"> 
				   <tr>
				      <td style="float:left;border:none;" width="200px" align="middle"><img src="<?php echo base_url('assets/images');?>/toyota-logo.png" width="150px" align="middle"/> <br/><br/></td>
				      <td style="margin:0px;border-left:1px solid black;border-right:1px solid black;width: 100%;"><strong style="font-size:18px;font-family:Arial;padding-left:35%;text-align:center;margin-bottom:0px;">TOYOTA Western MOTORS</strong>
					  <strong><p style="margin-bottom:0px; margin-right:10%;font-size: 10px;text-align:center;">C-38, ESTATE AVENUE ,S.I.T.E ,Karachi, Pakistan-75730, Karachi <br/>
                                                                                  UAN : 021 - 111 800 786 Tel: +92-21-32584734, 32564531-5 Fax : 922132587669<br/>
                                                                                  E-mail : service@toyotawestern.com/custumer.relations@toyotawestern.com/<br/>
																				  parts@toyotawestern.com</p></strong></td>
					  <td  style="float:right;border:none;margin-bottom:0px;margin-top:0px;"><img src="<?php echo base_url('assets/images');?>/daihaisu-logo.png"width="150px"/><hr style="margin-bottom:0px;margin-top:0px;"/><br/>R.O. #  <?php echo $getRoData[0]['RONumber']?></td>
				   </tr>
				</table>
     <span>
	 </div>
	 </div>
	 </div>
	 
	 
	 
	 <div class="container-fluid">
	 <div class="row">
	 <div class="col-md-12">
	 <table class="table9">
	 
	 <tr>
	 <td>
	 <!--
       <table class="namesect" style="float:left">
	     <tr>
            <td style="padding: 4px;width:4%;border:1px solid black;">COMPANY NAME :</td>
            <td style="padding: 4px;width:4%;border:1px solid black;"><strong><?php echo $getRoData[0]['CompanyName']?></strong></td>
			
        </tr>
        
        <tr>
            <?php // print_r($getRoData);   ?>
			
            <td style="padding: 2px;border:1px solid black;width:100px;">CUSTOMER'S NAME :</td>
             <td style="padding: 2px;border:1px solid black;width:100px;"><strong><?php echo $getRoData[0]['CustomerName']?></strong></td>
			 
			 
			 <td style="padding: 2px;text-align:right;width:100px;border:1px solid black;"> PHONE: MOBILE</td>
            <td style="padding: 2px;border:1px solid black;width:100px;"><strong><?php echo $getRoData[0]['Cellphone']?></strong></td>
             
			</tr>
			<tr>
            <td style="padding: 2px;border:1px solid black;width:200px;">ADDRESS :</td>
            <td style="padding: 2px;border:1px solid black;width:200px;"><strong><?php echo $getRoData[0]['AddressDetails']?></strong></td>
            </tr>
			
			<tr>
            <td style="padding: 2px;border:1px solid black;width:200px;">RES / OFFICE:</td>
            <td style="padding: 2px;width:200px;border:1px solid black;" ><strong><?php echo $getRoData[0]['PhoneOne']?>&nbsp; / <?php echo $getRoData[0]['CompanyContact']?></strong></td>
            
			
			<td style="padding: 2px;text-align:right;width:200px;border:1px solid black;"> EMAIL:</td>
            <td style="padding: 2px;border:1px solid black;width:200px;"><strong><?php echo $getRoData[0]['CustomerEmail']?></strong></td>
			</tr>
			
			<tr>
            <td style="padding: 2px;border:1px solid black;width:200px;">Payment: Cash / Credit W.O No::</td>
            <td style="padding: 2px;width:200px;border:1px solid black;"><strong>__________________ &nbsp; / __________________</strong></td>
            
			
			<td style="padding: 2px;text-align:right;width:200px;border:1px solid black;"> Customer Code:</td>
            <td style="padding: 2px;border:1px solid black;width:200px;"><strong><?php echo $getRoData[0]['idCustomer']?></strong></td>
			</tr>
       
           </table>
		   --->
		   <table class="namesect" style="float:left">
	    <tr>
            <td style="padding: 4px;width:4%;border-left:1px solid black;border-top:1px solid black;">COMPANY NAME :</td>
            <td style="padding: 4px;width:18%;border-top:1px solid black;border-right:1px solid black;" colspan="3"><strong><?php echo $getRoData[0]['CompanyName']?></strong></td>
			
        </tr>
        <tr>
            <?php // print_r($getRoData);   ?>			
            <td style="padding: 4px;width:4%;border-left:1px solid black;">CUSTOMER'S NAME :</td>
             <td style="padding: 4px;width:18%;"><strong><?php echo $getRoData[0]['CustomerName']?></strong></td>
			 <td style="padding: 4px;width:10%;text-align:right;"> PHONE: MOBILE</td>
            <td style="padding: 4px;width:15%;border-right:1px solid black;"><strong><?php echo $getRoData[0]['Cellphone']?></strong></td>
        </tr>
        <tr>
            <td style="padding: 4px; width:4%;border-left:1px solid black;">ADDRESS :</td>
            <td style="padding: 4px;border-right:1px solid black;" colspan="3"><strong><?php echo $getRoData[0]['AddressDetails']?></strong></td>
        </tr>
		 <tr>
            <td style="padding: 4px;width:4%;border-left:1px solid black;">RES / OFFICE:</td>
            <td style="padding: 4px;width:18%;" ><strong><?php echo $getRoData[0]['PhoneOne']?>&nbsp; / <?php echo $getRoData[0]['CompanyContact']?></strong></td>
            <td style="padding: 4px;width:10%;text-align:right;"> EMAIL:</td>
            <td style="padding: 4px;width:15%;border-right:1px solid black;"><strong><?php echo $getRoData[0]['CustomerEmail']?></strong></td>
        </tr>
        <tr>
            <td style="padding: 4px;width:4%;border-left:1px solid black;">Payment: Cash / Credit W.O No::</td>
            <td style="padding: 4px;width:18%;"><strong>__________________ &nbsp; / __________________</strong></td>
            <td style="padding: 4px;width:10%;text-align:right;"> Customer Code:</td>
            <td style="padding: 4px;width:15%;border-right:1px solid black;"><strong><?php echo $getRoData[0]['idCustomer']?></strong></td>
        </tr>
        
     </table>
		   
		   </td>
		   
	 
	 <td>
	 
	  <table class="carbooking" style="float:right;">
                                <tr>
                                    <td style="height: 42px;vertical-align: top; padding: 0px 0px 0px 11px;border:1px solid black;" colspan="2">CASH MEMO NO.<br/><strong style="padding: 20px;"><?php  echo $getRoData[0]['CashMemoNumber']   ;   ?></strong></td>
                                    <td style="border: 1px solid black;height: 35px;vertical-align: top; padding: 0px 0px 0px 07px;" colspan="2">CREDIT MEMO NO.<br/><strong style="padding: 20px;"><?php echo $getRoData[0]['CreditMemoNumber']    ;  ?></strong></td>
                                </tr>
                                <tr>
                                    <td style="height: 20px;vertical-align:top;border:1px solid black; "colspan="2">BOOK IN<br/>
        <span class="left">Date</span> <span style="width:5%";"border:1px solid black";><!--Date--><?php //echo date('d-m-Y',strtotime($getRoData[0]['BookInDate']))   ;  ?></span><span style="padding-left:10%"> Time </span><span style="width:5%"><?php //echo $getRoData[0]['BookInTime']    ;  ?><!--Time--></span>
                                    </td>
                                    <td style="height: 20px;vertical-align:top;border:1px solid black; "colspan="2">DELIVERY<br/>
        <span class="left">Date</span> <span style="width:5%";"border:1px solid black"><!--Date--><?php // echo date('d-m-Y',strtotime($getRoData[0]['DeliveryDate']))    ;  ?></span><span style="padding-left:10%"> Time </span><span style="width:5%"><?php //echo $getRoData[0]['DeliveryTime']    ;  ?><!--Time--></span>
                                    </td>

									
                                </tr>
                                <tr class="bookindt" >
                                    <td style="height:45px;vertical-align:middle; border:1px solid black;padding:1px;"><strong><?php echo date('d-m-Y',strtotime($getRoData[0]['BookInDate']))   ;  ?></strong></td>
                                    <td style="height:45px;vertical-align:middle; border:1px solid black; padding:1px;"><strong><?php echo $getRoData[0]['BookInTime']    ;  ?></strong></td>
                                    <td style="height:45px;vertical-align:middle;  border:1px solid black;padding:1px;"><strong><?php echo date('d-m-Y',strtotime($getRoData[0]['DeliveryDate']))   ;  ?></strong></td>
                                    <td style="height:45px;vertical-align:middle; border:1px solid black; padding:1px;"><strong><?php echo $getRoData[0]['DeliveryTime']    ;  ?></strong></td>
                                </tr>
							</table>
							
							</td>
							</tr>
                            
							</table>
							
	 
	  </span>
	  </div>
	  </div>
	  </div>
	  
	  <div class="container-fluid">
	  <div class="row">
	  <div class="col-md-12">
	  
	  
     <table class="table1">
	  <tr class="nav1">
	      <td style="width:10%">Reg. #<br/><strong><?php echo $getRoData[0]['RegistrationNumber']?></strong></td>
	      <td style="width:10%;border-right:none;" colspan="2">Make <br/><strong>TOYOTA</strong></td>
		  <td style="border-left:none;width:2%;">&nbsp;</td>
	      <td style="width:10%;border-right:none;" colspan="2">Model <br/><strong><?php echo $getRoData[0]['Model']?><!----></strong></td>
		  <td style="border-left:none;width:2%;">&nbsp;</td>
		  <td style="width:15%">Frame #<br/><strong><?php echo $getRoData[0]['ChassisNumber']?></strong></td>
		  <td style="width:15%">Engine #<br/><strong><?php echo $getRoData[0]['EngineNumber']?></strong></td>
		  <td style="width:15%">Mileage <br/><strong><?php echo $getRoData[0]['Mileage']?></strong></td>
	      <td style="width:10%;border-right:none;">Year / Type <br/><strong><?= $getRoData[0]['Year'] ?></strong></td>
		<!--  <td style="border-left:none;width:2%;">&nbsp;</td>-->
		  <td style="width:15%"colspan="2">Color Code<br/><strong>00</strong></td>
		 
	   </tr>
	 
	   <tr>
	       <td rowspan="7" colspan="3" style="width:15%;"><!--check-list-image--></td>
		   <td colspan="3" rowspan="4" class="checkboxE">
		       <span style="float:left"><input type="checkbox" name="" value=""/></span><span style="float:right">Appointment</span><br/>
				   <span style="float:left"><input type="checkbox" name="" value=""/></span><span style="float:right">Walk In</span><br/>
				   <span style="float:left"><input type="checkbox" name="" value=""/></span><span style="float:right">Waiting</span><br/>
				   <span style="float:left"><input type="checkbox" name="" value=""/></span><span style="float:right">Non-Waiting</span><br/>
				   <br/>
				   <span style="float:left"><input type="checkbox" name="" value=""/></span><span style="float:right">PM/GR</span><br/>
				   <span style="float:left"><input type="checkbox" name="" value=""/></span><span style="float:right">Warranty</span><br/>
				   <span style="float:left"><input type="checkbox" name="" value=""/></span><span style="float:right">Internal</span><br/>
				   <span style="float:left"><input type="checkbox" name="" value=""/></span><span style="float:right">SC/SSC</span><br/>
		  </td>
		  
		  <td colspan="2"><span style="text-align:top;">Estimate Amt.</span><br/><!---Data--></td>
		  <td colspan="2"><span style="text-align:top">Revised Est. Amt</span></td>
	      <td colspan="4"><span style="text-align:top">Revised Del. Time</span><br/><span class="left"> Date</span> <span style="width:5%"><!--Date-->&nbsp;&nbsp;&nbsp;</span><span style="padding-left:5%"> Time </span><span style="width:5%">&nbsp;&nbsp;&nbsp;<!--Time--></span></td>
	   </tr>
	   <tr>
	      <td colspan="2">Rev.Est. Appr.By<br> ------<!---Data--></td>
		  <td colspan="2">Party Payment. Rs.<br> ------<!---Data--></td>
	      <td colspan="4">Ins. Payment. Rs. <br>-------<!---Data--></td>
	   </tr>                                                           
	  <tr>
	      <td colspan="8"> Previous Service History</td>
	  </tr>
      <tr class="td-border">
	      <td colspan="8"> Date:  <span style="padding-left:5%"> ____________</span> <span style="padding-left:10%">R/O # </span><span style="padding-left:5%"> ______<!----RO # --->____ </span> <span style="padding-left:10%">Km</span></span><span style="padding-left:5%">____<!----Km --->______ </span>
	      <br/><br><span class="left">Job Done <span style="padding-left:5%"> ____________________<!--data--></span></span><br/>
		   <span class="left">SSC/ SC Information <span style="padding-left:5%">____________________<!--data--></span></span></td>
	  </tr>	
	
       <tr>
	      <td colspan="6">Periodic Maintenance</td>
		  <td colspan="5">General Repairs</td>
	   </tr>
	   <tr>
	      <td colspan="6"style="text-align:left">1. Pre Delivery<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	      <td colspan="5"style="text-align:left">6. Engine Tuning<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	   </tr>
	    <tr>
	      <td colspan="6"style="text-align:left">2. 1000 Km Free Service<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	      <td colspan="5"style="text-align:left">7. Brake Adjustment<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	   </tr>
	    <tr>
		 <td colspan="3"style="text-align:center"> Check List</td>
	      <td colspan="6"style="text-align:left">3. ..........Km Periodic Maint.<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	      <td colspan="5"style="text-align:left">8. A/C Gas Charging / Repairs<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	   </tr>
	    <tr>
		  <td colspan="3" rowspan="24"  class="checklist"> 
		    <span style="float:left" > Radio / CD/DVD Player</span><span style="float:right"><input type="checkbox" name="" value="" /></span><br/>
		    <span style="float:left"> Horn</span><span style="float:right"><input type="checkbox" name="" value="" /></span><br/>
			<span style="float:left"> Central Locking</span><span style="float:right"><input type="checkbox" name="" value="" /></span><br/>
		    <span style="float:left"> Key Less Remote</span><span style="float:right"><input type="checkbox" name="" value="" /></span><br/>
			<span style="float:left"> Floor Mats</span><span style="float:right"><input type="checkbox" name="" value="" /></span><br/>
			<span style="float:left"> Lighter / Socket</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> USB / GPS /SD Card</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Sunroof</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Side Vie Mirror</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Clock</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Wheel Caps</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Monograms</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Spare Wheel</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Jack & Handle</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Tool Kit</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> No of Keys / Ring</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Perfume</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Hub Caps</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Top Cover</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Shades</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Rear View Camera</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Cassette & CD's</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> No Valuable left</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Mud Flaps</span> <span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Door Mouldings</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			<span style="float:left"> Sun Visor</span><span style="float:right"><input type="checkbox" name="" value=""/></span><br/>
			 <span style="float:left;">Fuel : E __|__|__|__|__|__F</span>
		  </td>                              
	      <td colspan="6"style="text-align:left">4.Eng. Oil Change / Gear / Diff<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	      <td colspan="5"style="text-align:left">9. Wheel Balance / Alignment<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	   </tr>
	    <tr>                                             
	      <td colspan="6"style="text-align:left">5. Replce Oil Filter Element<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	      <td colspan="5"style="text-align:left">10. Wash and Lubricate<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td>
	   </tr>
	   <tr>
	      <td colspan="11">Condition During Occurance</td>
	   </tr>
	   <tr>
	      <td colspan="11" style="text-align:left">From When : Recently / 1 Week Ago / Others ()</td>
	   </tr>
	   <tr>
	      <td colspan="11" style="text-align:left">Frequency:Always / Occasionally / One time only / Others ()</td>
	   </tr>
	    <tr>                                                
	      <td colspan="11" style="text-align:left">Place : Odinary Road /Express way /Slope / (Traffic: Yes /No)</td>
	   </tr>
	    <tr>                                                
	      <td colspan="11" style="text-align:left">Warning Lamp: Lights on / Flashing / Multiple Flashing ()</td>
	   </tr>
	    <tr>                                                
	      <td colspan="11" style="text-align:left"> Starting / Idling / Moving (Constant Speed) / Accelerating / Decelerating)</td>
	   </tr>
	    <tr>                                                
	      <td colspan="11" style="text-align:left">Stopped / Engine cold / Engine warm / Shift Position()</td>
	   </tr>                  <!------------------------------------  End of Condition During Occurence --------------------------------------------------->
	   
	    <!------------------------------------  Start Job Requested --------------------------------------------------->
	   <tr>                                                
	      <td colspan="8">Jobs Requested (VOC)</td>
		  <td colspan="2"> PRIME ITEMS</td>
	   </tr>
	   <?php  $EstimateJob = (count($EstimateJob) > 0 )? $EstimateJob : $PMJobs ;$jri=0;foreach($EstimateJob as $row){if($jri < 10){?>
	    <tr>                                                
	      <td colspan="8"><strong><?php echo $row['JobTask']?></strong></td>
		  <td colspan="2"> &nbsp;</td>
	   </tr>
	   <?php }$jri++;} ?>
	   	<?php $vale4 = 10-$jri;
		for($j=0;$j<$vale4;$j++){?>	
	<tr>                                                
	      <td colspan="8">&nbsp;</td>
		  <td colspan="2"> &nbsp;</td>
	   </tr>
		<?php } ;?>
	    
	 
	   <!------------------------------------ End of Start Job Requested --------------------------------------------------->
	   
	 
   
	   <!------------------------------------ Start of Job Input Results --------------------------------------------------->
	   <tr>
	      <td colspan="8">Job Input Results</td>
		  <td>Hours</td>
		  <td style="padding-left:20px;padding-right:20px;"> Amount</td>
	   </tr>
	   
	   <?php $jii=0;foreach($RODetailJob as $row){if($jii < 3){?>
	   <tr>
	      <td colspan="8"><strong><?php echo $row['WorkPerformed']?></strong></td>
		  <td><strong><?php echo $row['Hours']?></strong></td>
		  <td><strong><?php echo $row['Amount']?></strong></td>
	   </tr>
	   <?php }$jii++;}?>
	   	<?php $vale5 = 3-$jii;
		for($j=0;$j<$vale5;$j++){?>	
 <tr>
	      <td colspan="8"><strong></strong></td>
		  <td><strong>&nbsp</strong></td>
		  <td><strong>&nbsp</strong></td>
	   </tr>
		<?php } ;?>
	    <tr>
		  <td colspan="3"> Note:</td>
	      <td colspan="8">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
	   <tr>
		  <td colspan="3" rowspan="5" style="text-align:left;"> 
		     Loss or damage of any <br/> 
			 thing should be reported while <br/>
			 taking delivery. Defects <br/>appearing after paint on <br/>
			 previously corroded panels shall<br/> be rectified on charge basis.</td>
	      <td colspan="8">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
	   <tr>
	      <td colspan="8">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
	   <tr>
	      <td colspan="8">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
	   <tr>
	      <td colspan="8">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
	   <tr>
	      <td colspan="8">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
	 
	  <tr>
		  <td colspan="3" rowspan="7" style="text-align:left;"> 
		     The above work hereby authorized<br/>
			 and terms agreed to as outlined overleaf<br/>
			 Customers Name: <br/><br/>
			 Customer's Signature <br/><br/>
		  </td>
	       <td colspan="8">Additional Jobs /Observations</td>
		  <td>&nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
	
	 	   <?php $aji=0;foreach($AdditionalJobs as $row){if($aji < 4){?>
	   <tr>
	      <td colspan="8"><strong><?php echo $row['JobTask']?></strong></td>
		  <td> &nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
		   <?php }$aji++;}?>
	<?php $vale3 = 4-$aji;
		for($j=0;$j<$vale3;$j++){?>	
		<tr>
	      <td colspan="8">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td> &nbsp;</td>
	   </tr>
		<?php } ;?>
	   
	   <tr>
	      <td colspan="8">&nbsp;</td>
		  <td style="text-align:left;">Labour</td>
		  <td><strong><?php echo $getRoData[0]['LabourAmount']?></strong></td>
	   </tr>
	   <tr>
	      <td colspan="8">&nbsp;</td>
		  <td style="text-align:left;">Lube Oil</td>
		  <td><strong><?php echo $getRoData[0]['LubOilAmount']?></strong></td>
	   </tr>
	    <tr>
		  <td colspan="3" rowspan="6" style="text-align:left;"> 
		    <br/>
			 Customers Name: <br/><br/>
			 Customer's Signature <br/><br/>
			 Fuel: E __|__|__|__|__|__F
		  </td>
	       <td colspan="8">&nbsp;</td>
		  <td style="text-align:left;">Sublet</td>
		  <td><strong><?php echo $getRoData[0]['SubletRepairAmount']?></strong></td>
	   </tr>
	   <tr>
	      <td colspan="8">&nbsp;</td>
		  <td style="text-align:left;">Parts</td>
		  <td><strong><?php echo $getRoData[0]['PartsAmount']?></strong></td>
	   </tr>
	   <tr>
	      <td colspan="4" rowspan="4"><br/><br/><br/> _______________<br/> SERVICE ADVISOR</td>
		  <td colspan="2"rowspan="4"><br/><br/><br/> _______________<br/> SERVICE MANAGER</td>
		  <td colspan="2" rowspan="4"><br/><br/><br/> _______________<br/> BILLING CLERK</td>
		  <td>Total</td>
		  <td><?php echo $getRoData[0]['GrandTotal']?></td>
	   </tr>
	   <tr>
		  <td>G.S.T</td>
		  <td><?php echo $getRoData[0]['GSTax']?> %</td>
	   </tr>
	   <tr>
		  <td style="text-align:left;">Grand Total</td>
		  <td><strong><?php echo $getRoData[0]['GrandTotal']?></strong></td>
	   </tr>
	   <tr>
		  <td style="text-align:left;">Net Total</td>
		  <td><strong><?php echo $getRoData[0]['NetTotal']?></strong></td>
	   </tr>
	 </table>
   
   </div>
   </div>
   </div>
   
   
     

   
   
   <!--End container-fluid--->
   
   
   <br>
   <br>

   
  
     
   
   
   <div class="container-fluid">
   <div class="row">
   <div class="col-md-12">
	 <table class="table2">
	      <tr  class="font">
		     <td colspan="5"> Job Allocation /Time</td>
			 <td colspan="5">Parts Replaced</td>
		  </tr>
	     
		 <tr class="font">
		    <td colspan="2">Group/Tech</td>
			 <td colspan="3">Allocated Time</td>
			 <td>Date</td>
			 <td>Description</td>
			 <td>Part Number</td>
			 <td>Qty</td>
			 <td>Amount</td>
		</tr>
		
		<tr  class="font">
		     <td style="font-size:10px">Date</td>
	         <td style="font-size:10px">Tech. Name</td>
			 <td style="font-size:10px">Time In</td>
			 <td style="font-size:10px">Time Out</td>
			 <td style="font-size:10px">Total Time</td>
			 <td style="font-size:10px">&nbsp;</td>
			 <td style="font-size:10px">&nbsp;</td>
			 <td style="font-size:10px">&nbsp;</td>
			 <td style="font-size:10px">&nbsp;</td>
			 <td style="font-size:10px">&nbsp;</td>
		</tr>	
		<?php $ptotal = 0;
		$pi=0;
		if($Parts){
		foreach($Parts as $row){ 
		if($pi < 8){?>
		<tr class="font">
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
			 <td><strong><?php echo $row['CreatedDate']?></strong></td>
             <td><strong><?php echo $row['PartName']?></strong></td>
             <td><strong><?php echo $row['PartNumber']?></strong></td>
             <td><strong><?php echo $row['PartQuantity']?></strong></td>
             <td><strong><?php $ptotal += intval($row['PartAmount']) ; echo $row['PartAmount']?></strong></td>
         </tr>
		<?php 
		}
		$pi++;
		}
		}
		?>
		<?php $vale2 = 8-$pi;
		for($j=0;$j<$vale2;$j++){?>	
		 <tr class="font">
		    <td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		 </tr>
		<?php } ?>
	<!--	 <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
			 <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
         </tr>
		 <tr>
		    <td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		 </tr>
		  <tr>
		    <td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		 </tr>-->
		<tr  class="font">
		     <td colspan="5"> Sublet Repairs / Consumables / Lube Oils</td>
			 <td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
	     
	     <tr  class="font">
		     <td>Date</td>
             <td>Description</td>
             <td>Ref.</td>
             <td>Qty</td>
             <td>Amount</td>
			 <td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	     </tr>     
<?php $stotal = 0;$si = 0;foreach($Sublet as $row){
if($si < 5){	?>		 
        <tr  class="font">
             <td><strong><?php echo $row['SubletRepairDate']?></strong></td>
             <td><strong><?php echo $row['Description']?></strong></td>
             <td><strong><?php echo $row['Reference']?></strong></td>
             <td><strong><?php echo $row['Quantity']?></strong></td>
             <td><strong><?php $stotal+=$row['SubletRepairAmount']; echo $row['SubletRepairAmount']?></strong></td>
			 <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
         </tr>
<?php  } $si++;}?>
	<?php $vale = 5-$si;for($j=0;$j<$vale;$j++){?>	
		 <tr  class="font">
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
			 <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
         </tr>
	<?php } ?>
		 
        <tr class="font">
            <td colspan="4" style="text-align:right;"> Total </td>
            <td> <?php echo $stotal;?> </td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
        </tr>		 
		
        <tr  class="font">
			 <td  colspan="5" >Diagnostic Questionnaire  (For General Repair)</td>
		     <td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
        <tr  class="font">
			<td  colspan="5" style="text-align:left;">Inspection Details/Result</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>	
         <tr  class="font">
			<td  colspan="5" style="text-align:left;">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
        <tr  class="font">
			<td  colspan="5" style="text-align:left;">&nbsp;</td>
			 <td colspan="4" style="text-align:right;"> Total </td>
            <td> <?php echo $ptotal; ?> </td>
		</tr>	
        <tr  class="font">
			<td  colspan="5" style="text-align:left;">Results. Discovered / Prediction / Reasons</td>
			<td colspan="5"> Pre Delivery Confirmation</td>
		</tr>
         <tr  class="font">
			<td  colspan="3" style="text-align:left;border-right:none">Main Cause</td>
		    <td  colspan="2"style="text-align:center;border-left:none">Follow up Status</td>
			<td colspan="4"style="text-align:left;border-right:none">All Jobs Completed R/T,QC Done </td>		
			<td style="text-align:left;border-left:none"> <input type="checkbox" />  </td>
		</tr>	
        <tr  class="font">
		    <td  colspan="5" style="text-align:left;">&nbsp;</td>
			<td colspan="4" style="text-align:left;border-right:none">RJT, QC DONE</td>		
		    <td style="text-align:left;border-left:none"> <input type="checkbox" />  </td>
		</tr>
         <tr  class="font">
			<td  colspan="3" style="text-align:left;border-right:none;">Job Instruction</td>
			<td colspan="2" style="text-align:center;border-left:none;">Warranty  <input type="checkbox"/></td>
		    <td colspan="4" style="text-align:left;border-right:none">Clenliness (Exterior/Interior)</td> 		
		  <td style="text-align:left;border-left:none"> <input type="checkbox" />  </td>
		</tr>	
         <tr  class="font">
		    <td  colspan="5" style="text-align:left;">&nbsp;</td>
			<td colspan="4" style="text-align:left;border-right:none">Courtesy items removed </td>
		    <td style="text-align:left;border-left:none"> <input type="checkbox" />  </td>
		</tr>
        <tr  class="font">
			<td  colspan="5" style="text-align:left;">&nbsp;</td>
	        <td colspan="5">Post Service Follow up (Service Advisor)</td>
		</tr>	
         <tr  class="font">
		    <td colspan="4">Job Completion Notification</td>
		    <td colspan="6"><span> Date</span> <span style="width:5%"><!--Date-->&nbsp;&nbsp;&nbsp;</span><span style="padding-left:5%"> Time </span><span style="width:5%">&nbsp;&nbsp;&nbsp;<!--Time--></span></td>
		 </tr>                       	
		
		 <tr  class="font">
		    <td colspan="4" rowspan="4" style="text-align:left;border-left:1px solid;border-right:1px solid;">
			Cust. Name<span style="width:5%">________<!--  Name--></span><br/>
			Contact #<span style="width:5%">________<!--  Contact--></span><br/>
			Date: <span style="width:5%">________<!--  Date--></span><br/>
			Time: <span style="width:5%">________<!--  Time--></span><br/>
			</td>
			<td colspan="6" style="text-align:left;border-right:1px solid black;" >P.S.F.U (Plan)<span style="width:5%">&nbsp;</span></td>
		</tr>
		   
		<tr class="td-border">
		    <td  class="font" colspan="6" rowspan="3" style="text-align:left;border:none;border-right:1px solid black;">
			Contact .Info<span style="width:5%"> ________________<!--  Contact info--></span><br/>
			Tel. #<span style="width:5%"> ________________<!--  Tel.--></span> <span style="padding-left:15%;">(Res./ Bussn./ Mobile)</span><br/>
			Email:<span style="width:5%"> ________________<!--  Email--></span><br/>
			</td>
		</tr>
         <tr></tr>   <!--- don't remove -->
		  <tr></tr>   <!--- don't remove -->
       <tr  class="font">
	       <td colspan="4">Job Result Explanation</td>
		   <td colspan="6" style="text-align:left;border:1px solid;">Other: </td>
	   </tr>
	  <tr class="t-border" style="border:1px solid black; text-align:left">
	       <td colspan="4" rowspan="5">
		     Repairs &nbsp done explained &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp     <span><input type="checkbox" /></span><br/>
			 Additional jobs explained&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp   <span><input type="checkbox"/></span><br/>
			 Result &nbsp Confirmation   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp  <span><input type="checkbox"/></span><br/>
			 Walk &nbsp Around Check    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp   <span><input type="checkbox"/></span>
		   </td>
		   <td colspan="6" style="border:1px solid black;">P.S.F.U (Actual) CR Department</td>
	   <tr/>
	   <!-- 
	    <td style="border:none;"><input type="checkbox" name="" value="" /></span></td>
	   <td colspan="5"style="text-align:left">6. Engine Tuning<span style="float:right;padding-right:10%"><input type="checkbox" name="" value=""/></span></td> -->
	  <tr  class="font">
		   <td style="border-left:none;"colspan="6" >
		   Date: <span style="padding-left:5px;">-----<!-- Date --></span> 
		  <span style="padding-left:5%"> Time: </span> <span style="padding-left:5px;">-----<!-- Time --></span>
		  <span style="padding-left:5%"> Place: </span><span style="padding-left:5px;">-----<!-- Place --></span></td>
	   <tr/>
	   <tr  class="font">
	       <td rowspan="2" colspan="6"style="text-align:left;"> Custumer <!---------  CUSTOMER NAME--------> <br/>
		     Owner / Family / Driver / Other <br/>
		   </td>
	   </tr>
	   <tr  class="font">
	       <td colspan="4"> Quality Control Inspection</td>
	   </tr>
	   
	 
	   <tr class="line-border">
	      <td colspan="4" rowspan="5" style="text-align:left;">
		      Other Findings /Advice<br/>
			  <br/>
			  Explain Q.C Results<br/>
			  <br/>
			  QC Inspector /Foreman
		  </td>
	 <td colspan="6" rowspan="5" style="text-align:left;">
		 <table class="noborder">
		 <tr style="border:none;">
		     <td colspan="2" style="border:none;">P.S.F.U  </td>
		     <td style="border:none;"><input type="checkbox" name="" value="" /></span></td>
		 </tr>
		 <tr style="border:none;">
		      <td style="border:none;">Fixed</td>
			   <td style="border:none;">&nbsp;&nbsp;&nbsp;</td>
			  <td style="border:none;"><input type="checkbox" name="" value="" /></span></td>
		 </tr>
		  <tr style="border:none;">
		      <td style="border:none;"> Not Fixed</td>
			  <td style="border:none;">&nbsp;&nbsp;&nbsp;</td>
			  <td style="border:none;"><input type="checkbox" name="" value="" /></span></td>
			  <td style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  <td style="border:none;"> Date</span>______________________<span style="padding-left:10%">Time</span>________________</td>
		 </tr>
		   <tr style="border:none;">
		      <td style="border:none;"> Follow up Status</td>
			  <td style="border:none;">&nbsp;&nbsp;&nbsp;</td>
			  <td style="border:none;"><input type="checkbox" name="" value="" /></span></td>
			  <td style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		   <tr style="border:none;">
		      <td style="border:none;">(Follow up again) </td>
			  <td style="border:none;">&nbsp;&nbsp;&nbsp;</td>
			  <td style="border:none;"><input type="checkbox" name="" value="" /></span></td>
			   <td style="border:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  <td style="border:none;"> Date</span>______________________<span style="padding-left:10%">Time</span>________________</td>
		 </tr>
		 </table>
		 
		  </td>
	   </tr>
	   	 <tr></tr><tr></tr>  <tr></tr><tr></tr>   <!--- don't remove -->
		 
		
		 
		<tr style="border:none;border-right:1px solid black;"><td colspan="10" >&nbsp;</td></tr>
	  <tr style="border:1px solid black;">
	  
	     <table class="stamptable">
	        <tr>
		      <td style="border:none;width:7%">&nbsp;</td>
              <td colspan="2"style="text-align:center;width:20%;height:28%;border:1px solid black;valign:bottom;"><p><br><br>QG1<br/> JC </p></td>
              <td style="border:none;width:16%">&nbsp;</td>
              <td  colspan="2"style="text-align:center;width:20%;height:28%;border:1px solid black;valign:bottom;"><p><br><br>QG2<br/> TA </p></td>
              <td style="border:none;width:15.5%">&nbsp;</td>
		      <td colspan="2" style="text-align:center;width:20%;height:28%;border:1px solid black;valign:bottom;"><p><br><br>QG3<br/> SA </p></td>
              <td style="border:none;width:18%">&nbsp;</td>
			</tr>
			
			<table class="terms">
     <tr>
           <td colspan="10" style="font-size:15px;text-align:center"> Terms and Conditions</td>
     </tr>
	 <tr>
           <td colspan="10" style="border:1px solid black;font-size:8px;text-align:left"> 
		    <p><ol style="text-align:left">
              <li>COMPANY'S EMPLOYEES MAY OPERATE VEHICLE FOR PURPOSES OF TESTING INSPECTION AND/OR DELIVERY AT CUSTOMER'S RISK</li>
	          <li>CUSTOMER ACKNOWLEDGES AN EXPRESS MECHANICS LIEN TO SECURE THE AMOUNT OF REPAIRS THERETO</li>
	          <li>THE COMPANY WILL NOT BE HELD RESPONSIBLE FOR LOSS OR DAMAGES TO THE VEHICLE OR ARTICLES LEFT IN THE VEHICLE IN CASE OF FIRE,THEFT,ACCIDENT OF ANY OTHER
	              CAUSE BEYOND THE COMPANY'S CONTROL.</li>
	          <li>NO CLAIMS FOR UNSATISFACTORY REPAIRS TO VEHICLE UNDER THIS REPAIR ORDER WILL BE CONSIDERED UNLESS RECEIVED BY THE COMPANY WITHIN FIVE(5)
	              DAYS AFTER THE VEHICLE HAS BEEN DELIVERED.</li>
	          <li>CUSTOMER AGREE TO PAY INTEREST AT THE RATE OF 1% PER MONTH ON ALL ACCOUNTS NOT PAID WHEN DUE</li>
	          <li style='margin-bottom:5px' >IN CASE OF LITIGATION OR NON-PAYMENT OF THIS REPAIR ORDER CUSTOMER AGREES TO SUBMIT HISSELF TO THE HURISDICTION OF THE COURTS.</li>
          </ol>
                  <hr style="margin-top:0px;margin-bottom:0px;" /><hr style="margin-top:0px;margin-bottom:0px;"/><br / >
        <b style="padding-left:15px;font-size:15px;text-align:left">Distribution of Copies</b><br/>
        <b style="padding-left:35%">  * Oiginal   Customer <span width="5%">&nbsp;<span>
               * Pink       Reception / Controller <span width="5%">&nbsp;<span>
               * Hard Copy  Controller / Cardex  <span width="5%">&nbsp;<span>
	        
	   </b></p>
		   
		   </td>
     </tr>
	 </table>
	</table>
	   </tr>
	<tr>
	</tr>
	</table>
   
   
       
	   
		</div>
		</div>
		</div>
                <!--Print area  End-->
				</div>
                <script src="assets/js/jquery-2.1.1.min.js"></script>
      </body>
	  
   


