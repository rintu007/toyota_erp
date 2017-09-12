


<html>

<head>
    <link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css>
   
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
    </style>
</head>

<body>
<?php

$count = 1;
?>
<br/>

<br/>
<div id="printArea">

<div class="container border" style="width: 948px;">

<div class="report-header">
    <div class="col-sm-6 col-xs-6 pull-left"><div class="toyota-logo"><img src="<?= base_url(); ?>assets/images/toyota-logo.PNG"></div></div>
    <div class="col-sm-6 col-xs-6 pull-right"><div class="daihatsu-logo"><img src="<?= base_url(); ?>assets/images/daihaisu-logo.PNG"></div></div>
</div><!--report-header end -->

<div ><h4>Quotation</h4></div>




<form  id='gatepassform' action="<?= base_url() ?>index.php/parts/savequot" method="post">
<div class="table-responsive report-table none-border">
            <table class="table customer-details">
                <thead>
               
                </thead>
                <tbody>
               
                <tr>
                    <td>Customer Name. :</td>
                    <td><input name="cusName" id="cusname" placeholder="Customer Name" /></td>
                    <td>Date. : </td>
                    <td><input type="date" name='date' /></td>
                     
                </tr>
                <tr>
                    <td>Phone No. :</td>
                    <td><input name="PhoneNo" id="PhoneNo" placeholder="Phone No" /></td>
                    <td>Quotation No. : </td>
                    <td><input name="smrid" id="order" value="TWM/QUO/<?=  sprintf("%04d",$quotid) ?>" readonly placeholder="enter value" /></td>
                   
                </tr>
               <tr>
                   <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Address. :</td>
                    <td><input name="Address" id="Address" placeholder="Address" /></td>
                   
                </tr>
                </tbody>
            </table>
        </div>





<div class="row">
    <div class="span12 text-center bold underline">
        <span class="" style="font-size: 24px;">Create Quotation</span>
    </div>
</div>
<br/>
<br/>


<div class="row-fluid">
    <div class="span12 text-center">


                        <span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRowLocal">+</span>

        <div class="table-responsive order-table">
            <table class="table" id="gatepassdetail">
                <thead>

                <tr>
                    <th align="center">S.No</th>
                    <th align="center">Part No#</th>
                    <th align="center">Description</th>
					 <th align="center">Quantity</th>
					 <th align="center">Unit Price</th>
					 <th align="center">Tax Rate %</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>



        <div class="table-responsive report-table none-border">
            <table class="table customer-details">
            <table class="table">
                <tbody>
				<tr style="float:left;">
                    <td style=" width: 7%;">PRICE VALIDITY. :</td>
                    <td ><input type="date" name="pvalidity" id="pvalidity" placeholder="PRICE VALIDITY" /></td>
                     
                </tr>
				<tr>
				<td>&nbsp;</td>
				</tr>
                <tr style="float:left;">
                    <td style=" width: 7.2%;">PAYMENT MODE. :</td>
                    <td ><input name="pmode" id="pmode" placeholder="PAYMENT MODE" /></td>
                   
                </tr>
               <tr>
                   <td>&nbsp;</td>
                </tr>
                <tr style="float:left;">
                    <td style=" width: 7%;">DELIVERY PERIOD. :</td>
                    <td><input name="dperiod" id="dperiod" placeholder="DELIVERY PERIOD" /></td>
                   
                </tr>
                </tbody>
            </table>
        </div>



    </div><!--span12-->
</div>
<input type='submit' value='Save' class='btn-primary' style="margin-left: 44%;">
</form>
<br/>
<br/>
<hr/>
</div>
</body>
</html>

<script>

  $("#newRowLocal").click(function (e) {
	var length = $(".gatepass").length+1;
        var items = "";
        items += "<tr class=\"gatepass\"><td align=\"center\">"+length+"</td><td align=\"center\"><input type=\"text\" style=\"width: 70px;\" name=\"Partno[]\" Placeholder=\"Part No \"/></td><td align=\"center\"><input type=\"text\" style=\"width: 70px;\" name=\"Description[]\" Placeholder=\"Description \"/></td><td align=\"center\"><input type=\"text\" style=\"width: 70px;\" name=\"qty[]\" Placeholder=\"Quantity \"/></td><td align=\"center\"><input type=\"text\" style=\"width: 70px;\" name=\"unitPrice[]\" Placeholder=\"Unit Price \"/></td><td align=\"center\"><input type=\"text\" style=\"width: 70px;\" name=\"texRate[]\" Placeholder=\"Tax Rate\"/></td></tr>";
        $('#gatepassdetail tbody').append(items);
        $("select[name='idPart[]']").chosen({no_results_text: "Oops, nothing found!"});
    });

    
  

</script>
