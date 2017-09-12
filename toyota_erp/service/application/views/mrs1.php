<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
$('#row').focusout(function(){
  var row=$(this).val();
  $.ajax({
        type: "POST",
        data:{"id":row},
         dataType: 'json',
            cache: false,
        url: "<?php echo base_url() ?>index.php/repairorder1/fa_last",
        success: function(data) {
          if(data.length>0){
         
           $("form :input").each(function(index, elm){    
           if(elm.type=="radio"){

            $('input[type="radio"][value="'+data[0]['sms']+'"]').attr('checked',true)}  
              if(elm.type=="text"){
         $("input[name='"+elm.name+"']").val(data[0][elm.name.replace('0','')]);}
       });
          }
          else{
alert('NOT FOUND');
$("#row").val('');

}

}


});
});

    });
  </script>
  <style type="text/css">
    .read{cursor: not-allowed;background-color: grey;color: white;}
  </style>
</head>
<div id="wrapper">
<input type="number" name="num" id='row'>
<form class="form-horizontal" action="<?php echo base_url() ?>index.php/repairorder1/up" method="post" >
<?php

 for($i=0;$i<1;$i++) {?>
   <div id="content">
       <input type="hidden" name="count" value="1">
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
        <td><B>CUSTOMER NAME:</B><input type="text" class="read" name="CustomerName<?=$i?>" value='' readonly/></td>
        <td><B>REG# NO:</B> <input type="text" class="read" name="RegistrationNumber<?=$i?>" value=' ' readonly/></td>
        <td><B>LAST R/O#:</B><input type="text" class="read" name="RONumber" value=' ' readonly/></td>
      </tr>
      <tr>
        <td><B>CUSTOMER MOBILE:</B> <input type="text" class="read" name="Cellphone<?=$i?>" value='' readonly/></td>
        <td><B>FRAME NO:</B> <input type="text" class="read" name="ChassisNumber<?=$i?>" value=' ' readonly/></td>
        <td><B>LAST KM:</B>  <input type="text" class="read" name="KM<?=$i?>" value='' readonly/></td>
      </tr>
	  <tr>
        <td><B>OFFICE PH#</B>  <input type="text" class="read" name="PhoneOne<?=$i?>" value='' readonly/></td>
        <td><B>MAKE & VARIANT:</B> <input type="text" class="read" name="Variants<?=$i?>" value='' readonly/></td>
        <td><B>LAST DATE:</B>   <input type="text" class="read" name="CreatedDate<?=$i?>" value='' readonly/></td>
      </tr>
      <tr>
        <td><B>RES PH#:</B>           <input type="text" class="read" name="PhoneOne<?=$i?>" value=' ' readonly/></td>
    <td><B>DATE OF DELIVERY:</B>  <input type="text" class="read" name="DeliveryDate<?=$i?>" value='' readonly/></td>
		<td><B>LAST SERVICE:</B>   <input type="text" class="read" name="PeriodName<?=$i?>" value='' readonly/></td>

      </tr>
	  <tr>
        <td><B>DRIVE MOBILE#:</B></td>
        <td><B>MODEL YEAR:</B> <input type="text" class="read" name="year<?=$i?>" value=' ' readonly/></td>
		<td></td>
      </tr>
	  <tr>
        <td><B>EXPECTED SERVICE DATE:</B> <input type="text" class="read" name="CreatedDate<?=$i?>" value=' ' readonly/></td>
        <td><B>TIME REQUIRED:</B><input type="text" name="t_req<?=$i?>" /></td>
		<td><B>AGREED PAKAGE/COST:</B><input type="text" name="a_pak<?=$i?>"/></td>
      </tr>
	  <tr>
	    <td><B>EXPECTED MILEAGE:</B><input type="text" class="read" name="e_mile<?=$i?>" value=' ' readonly/></td>
        <td><B>LABOUR:</B><input type="text" name="lab<?=$i?>"/></td>
		<td></td>
      </tr>
	   <tr>
	    <td><B>MAINTENANCE TYPE:</B><input type="text" name="main<?=$i?>"/></td>
        <td><B>PARTS:</B><input type="text" name="parts<?=$i?>" /></td>
		<td></td>
      </tr>
	    <TR>
	    <td><B>SMS SEND:</B><input type="radio" name="sms" value="yes">  YES <input type="radio" name="sms" value="no"> NO</td>
        <td><B>TOTAL COST:</B><input type="text" name="t_cost<?=$i?>"/></td>
		<td></td>
      </tr>
	  <tr>
	    <td><B>REC TYPE:</B><input type="text" name="r_type<?=$i?>"/></td>
		<td style="border: oldlace !important;"><B>REMARKS:</B><textarea name="comment<?=$i?>" rows="1" cols="60"></textarea></td>
      </tr>
	  <tr>

    <input type="hidden" name="redirect" value="1"/>
	    <td><B>1st CALL DATE:</B><input type="date" name="1_date<?=$i?>"/></td>
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
<input type="submit" value="Submit" name="a">
</form>
</div>




