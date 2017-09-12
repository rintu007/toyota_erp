


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

<div class="full-grid text-center gray-bg"><h4>Parts Department</h4></div>




<form  id='gatepassform' action="<?= base_url() ?>index.php/parts/savesmr" method="post">
<div class="table-responsive border-none">
    <table class="table">
<!--        <thead>
        <tr>
            <th style="text-align:right;">Toyota</th>
            <th style="text-align:center;">WESTERN</th>
            <th>Motors </th>
        </tr>
        </thead>-->
        <tbody>
         <tr>
            <td style="text-align:left;"> Claim Number :
                <input name="smrid" id="order" value="TWM/SMR/<?=  sprintf("%04d",$smrid) ?>" readonly placeholder="enter value" /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">Dealership :
           <strong><input name="dealership" id="employee" placeholder="Dealetship" /></strong></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">Date :
                <strong><input name="date" value="<?=date('d/m/Y');?>" id=" pbo/chas" placeholder="Date" /></strong></td>
            <td>&nbsp;</td>
        </tr>
       
        </tbody>
    </table>
</div>




<div class="row">
    <div class="span12 text-center bold underline">
        <span class="" style="font-size: 24px;">Create SMR</span>
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
                    <th align="center">Order #</th>
                    <th align="center">Invoice #</th>
                   
                    <th align="center" colspan="2">Part #</th>
                     <th align="center" colspan="4">Quantity</th>
					 <th align="center" colspan="2">Price</th>
					 <th align="center"></th>
					 <th align="center">IMC</th>
                </tr>
				<tr>
					<th align="center"></th>
					<th align="center"></th>
					<th align="center"></th>
                    <th align="center">Ordered</th>
					<th align="center">Received</th>
                    <th align="center">Invoiced</th>
                    <th align="center">Received</th>
					<th align="center">Ordered</th>
                    <th align="center">Damage</th>
					<th align="center">Actual</th>
					<th align="center">Charged</th>
					<th align="center">Return</th>
					<th align="center">Credit Note #</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>



        <div class="table-responsive">
            <table class="table">
                <tbody>
				<tr>
					<td>Dealer's Remarks :</td>
					<td style="width:15%;"><textarea name="dealerremarks" cols="10" rows="3"></textarea></td>
					<td>IMC Remarks :</td>
					<td style="width:15%;"><textarea name="imcremarks" cols="10" rows="3"></textarea></td>
				</tr>
                <tr>
                    <td style="width:15%;"><strong>Prepared By</strong></td>
                    <td style="border-bottom:1px solid #000;"></td>
                    
                    <td style="width:15%;"><strong>Authorized By</strong></td>
                    <td style="border-bottom:1px solid #000;"></td>
                </tr>
              
                
                </tbody>
            </table>
        </div>



    </div><!--span12-->
</div>
<input type='submit' value='Save' class='btn' style="margin-left: 44%;">
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
        items += "<tr class=\"gatepass\"><td align=\"center\">"+length+"</td><td align=\"center\"><input type=\"text\" style=\"width: 70px;\" name=\"orderno[]\" Placeholder=\"Order #\"/></td><td align=\"center\"><input type=\"text\" name=\"invoiceno[]\"  style=\"width: 70px;\" Placeholder=\"Invoice #\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"partorderd[]\" Placeholder=\"Part Ordered\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"partreceived[]\" Placeholder=\"Part Received\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"qtyinvoiced[]\" Placeholder=\"Quantity Invoiced\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"qtyreceived[]\" Placeholder=\"Quantity Received\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"qtyordered[]\" Placeholder=\"Quantity Ordered\"/></td><td align=\"center\"><input  style=\"width: 70px;\" type=\"text\" name=\"qtydamage[]\" Placeholder=\"Quantity Damage\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"priceactual[]\" Placeholder=\"Price Actual\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"pricecharged[]\" Placeholder=\"Price Charged\"/></td><td align=\"center\"><input  style=\"width: 70px;\" type=\"text\" name=\"return[]\" Placeholder=\"Return\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"creditnote[]\" Placeholder=\"Credit Note #\"/></td></tr>";
        $('#gatepassdetail tbody').append(items);
        $("select[name='idPart[]']").chosen({no_results_text: "Oops, nothing found!"});
    });

    
  

</script>
