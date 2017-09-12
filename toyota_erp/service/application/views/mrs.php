<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
    .read{cursor: not-allowed;background-color: grey;color: white;}
  </style>
</head>
<div id="wrapper">

<form class="form-horizontal" action="<?php echo base_url() ?>index.php/repairorder/in_last" method="post" >
<?php for($i=0;$i<count($mrs);$i++) {?>
   <div id="content">
       <input type="hidden" name="count" value="<?=count($mrs)?>">
		<div class="container col-xs-12">
             
  <table class="table table-bordered" style="bottom: 31px;
position: relative;">
      <thead>
      <tr>
        <div class="head">
		<div class="row">
		<div class="col-md-12 col-xs-12">
		<h4 style="text-align:center;border:0px solid;    height: 22px;background: black;
} background: ;
color: white;
}">TOYOTA WESTERN</h4>




		</div>
		
		</div>
		<div class="row col-xs-row">
		<div class="col-md-12 col-xs-12" style="bottom: 21px;">

		<h4 style="text-align:center;border:1px solid;    height: 22px;
}"> FOLLOW UP CARD </h4>




		<div  class="row">
				<div  class="col-md-12 col-xs-12">



    <tbody>
	
      <tr>
        <td><B>CUSTOMER NAME:</B><input type="text" class="read" name="CustomerName<?=$i?>" value='<?=$mrs[$i]['CustomerName']?>' readonly/></td>
        <td><B>REG# NO:</B> <input type="text" class="read" name="RegistrationNumber<?=$i?>" value=' <?=$mrs[$i]['RegistrationNumber']?>' readonly/></td>
        <td><B>LAST R/O#:</B><input type="text" class="read" name="RONumber<?=$i?>" value=' <?=$mrs[$i]['RONumber']?>' readonly/></td>
      </tr>
      <tr>
        <td><B>CUSTOMER MOBILE:</B> <input type="text" class="read" name="Cellphone<?=$i?>" value='<?=$mrs[$i]['Cellphone']?>' readonly/></td>
        <td><B>FRAME NO:</B> <input type="text" class="read" name="ChassisNumber<?=$i?>" value='  <?=$mrs[$i]['ChassisNumber']?>' readonly/></td>
        <td><B>LAST KM:</B>  <input type="text" class="read" name="KM<?=$i?>" value='  <?=$mrs[$i]['KM']?>' readonly/></td>
      </tr>
	  <tr>
        <td><B>OFFICE PH#</B>  <input type="text" class="read" name="PhoneOne<?=$i?>" value='<?=$mrs[$i]['PhoneOne']?>' readonly/></td>
        <td><B>MAKE & VARIANT:</B> <input type="text" class="read" name="Variants<?=$i?>" value=' <?=$mrs[$i]['Variants']?>' readonly/></td>
        <td><B>LAST DATE:</B>   <input type="text" class="read" name="CreatedDate<?=$i?>" value=' <?=date('d-m-y',strtotime($mrs[$i]['CreatedDate']))?>' readonly/></td>
      </tr>
      <tr>
        <td><B>RES PH#:</B>           <input type="text" class="read" name="PhoneOne<?=$i?>" value=' <?=$mrs[$i]['PhoneOne']?>' readonly/></td>
    <td><B>DATE OF DELIVERY:</B>  <input type="text" class="read" name="DeliveryDate<?=$i?>" value='<?=date('d-m-Y',strtotime($mrs[$i]['DeliveryDate']))?>' readonly/></td>
		<td><B>LAST SERVICE:</B>   <input type="text" class="read" name="PeriodName<?=$i?>" value='    <?=$mrs[$i]['PeriodName']?>' readonly/></td>

      </tr>
	  <tr>
        <td><B>DRIVE MOBILE#:</B></td>
        <td><B>MODEL YEAR:</B> <input type="text" class="read" name="year<?=$i?>" value='  <?=$mrs[$i]['year']?>' readonly/></td>
		<td></td>
      </tr>
	  <tr>
        <td><B>EXPECTED SERVICE DATE:</B> <input type="text" class="read" name="CreatedDate<?=$i?>" value=' <?=date('d-m-Y',strtotime($mrs[$i]['CreatedDate']."+90 days"))?>' readonly/></td>
        <td><B>TIME REQUIRED:</B><input type="text" name="t_req<?=$i?>" /></td>
		<td><B>AGREED PAKAGE/COST:</B><input type="text" name="a_pak<?=$i?>"/></td>
      </tr>
	  <tr>
	    <td><B>EXPECTED MILEAGE:</B><input type="text" class="read" name="e_mile<?=$i?>" value=' <?=(int)$mrs[$i]['KM'] + 5000?>' readonly/></td>
        <td><B>LABOUR:</B><input type="text" name="lab<?=$i?>"/></td>
		<td></td>
      </tr>
	   <tr>
	    <td><B>MAINTENANCE TYPE:</B><input type="text" name="main<?=$i?>"/></td>
        <td><B>PARTS:</B><input type="text" name="parts<?=$i?>" /></td>
		<td></td>
      </tr>
	    <TR>
	    <td><B>SMS SEND:</B><input type="radio" name="sms" value="yes">  YES <input type="radio" name="sms<?=$i?>" value="no"> NO</td>
        <td><B>TOTAL COST:</B><input type="text" name="t_cost<?=$i?>"/></td>
		<td></td>
      </tr>
	  <tr>
	    <td><B>REC TYPE:</B><input type="text" name="r_type<?=$i?>"/></td>
		<td style="border: oldlace !important;"><B>REMARKS:</B><textarea name="comment<?=$i?>" rows="1" cols="60"></textarea></td>
      </tr>
	  <tr>
	    <td><B>1st CALL DATE:</B><input type="date" name="1_date<?=$i?>"/>

<input type="hidden" name="redirect" value="0"/>
      </td>
      </tr>
	  <tr>
	  <td><B>2st CALL DATE:</B><input type="date" name="2_date<?=$i?>"/></td>
      </tr>
	  <tr>
	  <td><B>3st CALL DATE:</B><input type="date" name="3_date<?=$i?>"/></td>
      </tr> 
      </tr>
	  </div>
	  		</div>

					</div>

	  	  </div>

    </tbody>
	
    </table>
  <br>
  
  </div>

			   
   
   </div>
<?php } ?>
<input type="submit" value="Submit" name="">
</form>
</div>




