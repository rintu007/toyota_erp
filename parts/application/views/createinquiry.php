


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




<form  id='gatepassform' action="<?= base_url() ?>index.php/parts/saveinquiry" method="post">
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
            <td style="text-align:left;"> Inquiry # :
                <input name="inquiryId" id="order" type="text"  value="TWM-INQ-<?=  sprintf("%04d",$gatePassId) ?>" readonly placeholder="enter value" /></td>
            <td style="border:none;"> &nbsp;</td>
        </tr>
        <tr style='float:left'>
            <td style="text-align:left;border:none;">Date :
           <strong><input name="date" id="employee" type="text" value="<?php echo date('Y-m-d');?>" readonly/></strong></td>
            <td style="border:none;">&nbsp;</td>
        </tr>
        <tr style='float:right;'>
            <td style="text-align:left;border:none;">Customer Name :
                <strong><input name="CustomerName" id="customer_name" placeholder="Customer Name" type="text"  /></strong></td>
            <td style="border:none;">&nbsp;</td>
        </tr>
       
        </tbody>
    </table>
</div>




<div class="row">
    <div class="span12 text-center bold underline">
        <span class="" style="font-size: 24px;">Create Parts Inquiry</span>
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
                    <th align="center">Part Number</th>
                    <th align="center">Description of Parts</th>
                    <th align="center">Model</th>
                    <th align="center">Code</th>
                   
                    <th align="center">Qty</th>
                    <th align="center">By Sea</th>
                    <th align="center">By Air</th>
                
                </tr>
                </thead>
                <tbody>

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
        items += "<tr class='gatepass'><td class='tbl-count'>"+length+
               
               
      "<td class=''><input style='width: 100px;' type='text'  id='parts' name='parts[]' placeholder='Part' ></td>" +
      "<td class=''><input  style='width: 100px;' type='text'  id='Description' name='Description[]' placeholder='Description' ></td>" +
      "<td class=''><input type='text'  id='Model' name='Model[]' placeholder='Model' ></td>" +
      "<td class=''><input type='text'  id='Code' name='Code[]' placeholder='Code'></td>" +
                "<td class=''><input type='number' name='Quantity[]'  required  style='width: 50px;' class='qty'  id='Quantity' placeholder='Qty'></td>" +
                "<td class=''><input type='text' name='bysea[]'    style='width: 50px;' class='qty'  id='sea' placeholder='By Sea'></td>" +
                "<td class=''><input type='text' name='byair[]'    style='width: 50px;' class='qty'  id='air' placeholder='By Air'></td>" +
                
                "</tr>";
        $('#gatepassdetail tbody').append(items);
        $("select[name='parts[]']").chosen({no_results_text: "Oops, nothing found!"});
    });

     $("select[name='parts[]']").chosen({no_results_text: "Oops, nothing found!"});
  
   function getPart(Source) {
        console.log($(Source).val());
        idPart = $(Source).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/getpartdetails",
            type: "POST",
            data: {idPart: idPart},
            success: function (data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function (i, val) {
                            $(Source).closest('td').next('td').find('input').val(val.Description);
                          
                        });
                    }
                }
                else {
                }
            }
        });
    }
</script>
