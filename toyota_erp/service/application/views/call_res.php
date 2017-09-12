
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>

<style>
tr,th{
text-align:center;
width:50%;

}
textarea {
   resize: none;
   width: 100%;
}
    
</style>
<script type="text/javascript">//script for tab1
$(document).ready(function(){
$('#ro').focusout(function(){
var id=$(this).val();
if(id!=''){

 $.ajax({
        type: "POST",
        data:{"RONumber":id},
         dataType: 'json',
            cache: false,
        url: "<?= base_url()?>index.php/call_res/fe",
        success: function(data) {
if(data.length>0){
        	$('#d1').val(data[0]['drop1']);
        	$('#d2').val(data[0]['drop2']);
        	$('#d3').val(data[0]['drop3']);
        	$('#2d1').val(data[0]['2drop1']);
        	$('#2d2').val(data[0]['2drop2']);
        	$('#2d3').val(data[0]['2drop3']);
        	$("textarea[name='root']").val(data[0]['root']);
            $("textarea[name='mea']").val(data[0]['mea']);
         $("form :input").each(function(index, elm){
   if(elm.type=="radio"){

   	$("input[name='"+elm.name+"'][value='"+data[0][elm.name]+"']").attr('checked',true);
   }
   else{
 $("input[name='"+elm.name+"']").val(data[0][elm.name]);

}       
 });}
         else{alert('No data Found');$('#ro').val('');}
}
});
}

});
});
</script>
  </head>
<body>
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/ro_leftmenu.php';
        } else {
//            include 'include/leftmenu.php';
        }
        ?>
		        <div class="right-pnel">
            <form id="" action="" method="post" onSubmit="" class="form animated fadeIn">


<div class="form" style="    width: 100%;
">
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
       <input type="hidden" name="count" value="1">
             
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
  <h4 style="text-align:center;border:0px solid;    height: 22px;background: black;
} background: ;
color: white;
}">FOLLOW UP CAR RESULTS</h4>
<form method="post" action="<?= base_url()?>index.php/call_res/in" >
<label>Ro Number</label>
<input name="RONumber" id="ro" type="number">
<div class="table-responsive table-striped table-responsive fixed-solution" data-pattern="" style="width: 100%;">
  <table >

	 
			<tr><th colspan="2" style="text-align:center;">FOLLOW UP CALL</th>
			<th colspan="2" style="text-align:center;">CONTACTED</th>
						<th colspan="2" style="text-align:center;">APPOINTMENT</th>
						<th colspan="" rowspan="2" style="text-align:center;">REASON</th>
						<th colspan="" rowspan="2" style="text-align:center;WIDTH: 29%;">PROBLEM</th>
	                    <th colspan="2" rowspan="2" style="text-align:center;">ACTION TO BE <BR> TAKEN/DATE</th>
						<th colspan="2" rowspan="2" style="text-align:center;">ACTION TO BE <BR> TAKEN/DATE</th>




				</tr>
				
			<tr><th>Call</th><th>Date/time</th>
			<th>YESS</th><th>NO</th>
			<th>YESS</th><th>NO</th>
			</tr>
			
			<tr>
			<th>1</div>
			<td><input type="text" name="datetime1" value=""> </td>
			<td><input type="radio" name="contact1" value="yes"></td>
			<td><input type="radio" name="contact1" value="no"></td>
			<td> <input type="radio" name="appoin1" value="yes"> </td>
			<td><input type="radio" name="appoin1" value="no"> </td>
			<td> <input type="text" name="rea1" value="">  </td>
            <td><select id="d1" name="drop1">
            <option value="1" >APPOINTMENT ALREADY MADE</option>
 			 <option value="2">SERVICE ALREADY DONE</option>
 			 <option value="3">WRONG NO.</option>
	     	  <option value="4">NO/AMSWER/UNAVAILABLE PHONE NO</option>
   			 <option value="5">COULD NOT SPEAKE TO CUSTOME/MESSAGE LEFT.</option>
		    <option value="6">CUSTOMER WILL CALL BACK.</option>
			    <option value="7">lESS MILEAGE</option>
				<option value="8">CAR WAS SOLD/STOLEN/SCRAPED</option>				
				<option value="9">CUSTOMER REFUSE/COMPLAINT</option>
				<option value="10">OUT OF CITY</option>
				<option value="11">OTHERS</option>
</select>
</td>
            <td><input type="text" name="act1_1" value="">   </td>
			<td> <input type="text" name="act1_2" value="">  </td>
			<td> <input type="text" name="act1_3" value=""> </td>
			<td>  <input type="text" name="act1_4" value=""></td>
			</tr>

<tr>
			<th>2</div>
			<td><input type="text" name="datetime2" value=""> </td>
			<td><input type="radio" name="contact2" value="yes"></td>
			<td><input type="radio" name="contact2" value="no"></td>
			<td> <input type="radio" name="appoin2" value="yes"> </td>
			<td><input type="radio" name="appoin2" value="no"> </td>
			<td> <input type="text" name="rea2" value="">  </td>
            <td>
 <select name="drop2" id="d2">
            <option value="1"  >APPOINTMENT ALREADY MADE</option>
 			 <option value="2">SERVICE ALREADY DONE</option>
 			 <option value="3">WRONG NO.</option>
	     	  <option value="4">NO/AMSWER/UNAVAILABLE PHONE NO</option>
   			 <option value="5">COULD NOT SPEAKE TO CUSTOME/MESSAGE LEFT.</option>
		    <option value="6">CUSTOMER WILL CALL BACK.</option>
			    <option value="7">lESS MILEAGE</option>
				<option value="8">CAR WAS SOLD/STOLEN/SCRAPED</option>				
				<option value="9">CUSTOMER REFUSE/COMPLAINT</option>
				<option value="10">OUT OF CITY</option>
				<option value="11">OTHERS</option>
</select>
</td>
            <td><input type="text" name="act2_1" value="">   </td>
			<td> <input type="text" name="act2_2" value="">  </td>
			<td> <input type="text" name="act2_3" value=""> </td>
			<td>  <input type="text" name="act2_4" value=""></td>
			</tr>



<tr>
			<th>3</div>
			<td><input type="text" name="datetime3" value=""> </td>
			<td><input type="radio" name="contact3" value="yes"></td>
			<td><input type="radio" name="contact3" value="no"></td>
			<td> <input type="radio" name="appoin3" value="yes"> </td>
			<td><input type="radio" name="appoin3" value="no"> </td>
			<td> <input type="text" name="rea3" value="">  </td>
            <td>
            <select id="d3" name="drop3">
            <option value="1" >APPOINTMENT ALREADY MADE</option>
 			 <option value="2">SERVICE ALREADY DONE</option>
 			 <option value="3">WRONG NO.</option>
	     	  <option value="4">NO/AMSWER/UNAVAILABLE PHONE NO</option>
   			 <option value="5">COULD NOT SPEAKE TO CUSTOME/MESSAGE LEFT.</option>
		    <option value="6">CUSTOMER WILL CALL BACK.</option>
			    <option value="7">lESS MILEAGE</option>
				<option value="8">CAR WAS SOLD/STOLEN/SCRAPED</option>				
				<option value="9">CUSTOMER REFUSE/COMPLAINT</option>
				<option value="10">OUT OF CITY</option>
				<option value="11">OTHERS</option>
</select>
</td>
            <td><input type="text" name="act3_1" value="">   </td>
			<td> <input type="text" name="act3_2" value="">  </td>
			<td> <input type="text" name="act3_3" value=""> </td>
			<td>  <input type="text" name="act3_4" value=""></td>
			</tr>



			<tr><th>
			<td></td>
			<td></td>
			<td></td>
			<td>   </td>
			<td>  </td>
			<td>  </td>
				<th>
				<h4><b>2nd Cell Cyscle</b></h4>
				</th>
				<td>   </td>
				<td>   </td>
				<td>   </td>
				<td>   </td>
			</tr>

			
				<tr><th colspan="2" style="text-align:center;">FOLLOW UP CALL</th>
			<th colspan="2" style="text-align:center;">CONTACTED</th>
						<th colspan="2" style="text-align:center;">APPOINTMENT</th>
						<th colspan="" rowspan="2" style="text-align:center;">REASON</th>
						<th colspan="" rowspan="2" style="text-align:center;WIDTH: 29%;">PROBLEM</th>
	                    <th colspan="2" rowspan="2" style="text-align:center;">ACTION TO BE <BR> TAKEN/DATE</th>
						<th colspan="2" rowspan="2" style="text-align:center;">ACTION TO BE <BR> TAKEN/DATE</th>




				</tr>
				
			<tr><th>Call</th><th>Date/time</th>
			<th>YESS</th><th>NO</th>
			<th>YESS</th><th>NO</th>
			</tr>
			
			<tr>
			<th>1</div>
			<td><input type="text" name="2datetime1" value=""> </td>
			<td><input type="radio" name="2contact1" value="yes"></td>
			<td><input type="radio" name="2contact1" value="no"></td>
			<td> <input type="radio" name="2appoin1" value="yes"> </td>
			<td><input type="radio" name="2appoin1" value="no"> </td>
			<td> <input type="text" name="2rea1" value="">  </td>
            <td>
            <select name="2drop1" id="2d1">
            <option value="1" >APPOINTMENT ALREADY MADE</option>
 			 <option value="2">SERVICE ALREADY DONE</option>
 			 <option value="3">WRONG NO.</option>
	     	  <option value="4">NO/AMSWER/UNAVAILABLE PHONE NO</option>
   			 <option value="5">COULD NOT SPEAKE TO CUSTOME/MESSAGE LEFT.</option>
		    <option value="6">CUSTOMER WILL CALL BACK.</option>
			    <option value="7">lESS MILEAGE</option>
				<option value="8">CAR WAS SOLD/STOLEN/SCRAPED</option>				
				<option value="9">CUSTOMER REFUSE/COMPLAINT</option>
				<option value="10">OUT OF CITY</option>
				<option value="11">OTHERS</option>
</select>
</td>
            <td><input type="text" name="2act1_1" value="">   </td>
			<td> <input type="text" name="2act1_2" value="">  </td>
			<td> <input type="text" name="2act1_3" value=""> </td>
			<td>  <input type="text" name="2act1_4" value=""></td>
			</tr>

<tr>
			<th>2</div>
			<td><input type="text" name="2datetime2" value=""> </td>
			<td><input type="radio" name="2contact2" value="yes"></td>
			<td><input type="radio" name="2contact2" value="no"></td>
			<td> <input type="radio" name="2appoin2" value="yes"> </td>
			<td><input type="radio" name="2appoin2" value="no"> </td>
			<td> <input type="text" name="2rea2" value="">  </td>
            <td>
            <select id="2d2" name="2drop2" >
            <option value="1" >APPOINTMENT ALREADY MADE</option>
 			 <option value="2">SERVICE ALREADY DONE</option>
 			 <option value="3">WRONG NO.</option>
	     	  <option value="4">NO/AMSWER/UNAVAILABLE PHONE NO</option>
   			 <option value="5">COULD NOT SPEAKE TO CUSTOME/MESSAGE LEFT.</option>
		    <option value="6">CUSTOMER WILL CALL BACK.</option>
			    <option value="7">lESS MILEAGE</option>
				<option value="8">CAR WAS SOLD/STOLEN/SCRAPED</option>				
				<option value="9">CUSTOMER REFUSE/COMPLAINT</option>
				<option value="10">OUT OF CITY</option>
				<option value="11">OTHERS</option>
</select>
</td>
            <td><input type="text" name="2act2_1" value="">   </td>
			<td> <input type="text" name="2act2_2" value="">  </td>
			<td> <input type="text" name="2act2_3" value=""> </td>
			<td>  <input type="text" name="2act2_4" value=""></td>
			</tr>



<tr>
			<th>3</div>
			<td><input type="text" name="2datetime3" value=""> </td>
			<td><input type="radio" name="2contact3" value="yes"></td>
			<td><input type="radio" name="2contact3" value="no"></td>
			<td> <input type="radio" name="2appoin3" value="yes"> </td>
			<td><input type="radio" name="2appoin3" value="no"> </td>
			<td> <input type="text" name="2rea3" value="">  </td>
            <td>
            <select name="2drop3" id="2d3">
            <option value="1" >APPOINTMENT ALREADY MADE</option>
 			 <option value="2">SERVICE ALREADY DONE</option>
 			 <option value="3">WRONG NO.</option>
	     	  <option value="4">NO/AMSWER/UNAVAILABLE PHONE NO</option>
   			 <option value="5">COULD NOT SPEAKE TO CUSTOME/MESSAGE LEFT.</option>
		    <option value="6">CUSTOMER WILL CALL BACK.</option>
			    <option value="7">lESS MILEAGE</option>
				<option value="8">CAR WAS SOLD/STOLEN/SCRAPED</option>				
				<option value="9">CUSTOMER REFUSE/COMPLAINT</option>
				<option value="10">OUT OF CITY</option>
				<option value="11">OTHERS</option>
</select>
</td>
            <td><input type="text" name="2act3_1" value="">   </td>
			<td> <input type="text" name="2act3_2" value="">  </td>
			<td> <input type="text" name="2act3_3" value=""> </td>
			<td>  <input type="text" name="2act3_4" value=""></td>
			</tr>

		
	
			</table>
			<div class="row">
<div class="col-md-12">
<div class="col-md-6" style="border:1px solid;    height: 88px;
">
<textarea rows="4" cols="50" name="root" placeholder="Root Coust Analysis:-">
</textarea>

</div>
<div class="col-md-6 " style="border:1px solid;    height: 88px;      position: relative;
   
">
<textarea rows="4" cols="50" name="mea" placeholder="Counter Measure:-">
</textarea>

</div>
</div>

</div>
<br>
		<button>Submit</button>
  </div></form>

</div>
</div>
</div>

