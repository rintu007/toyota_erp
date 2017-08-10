


<html>

<head>
     <link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css>
    <link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap.min.css>
   
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
		.invoice-outer { min-width:940px;}
.top-header {     background: #BFBFBF;
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #FFF;
}
.header-2{   background: #BFBFBF;
    padding: 5px;
    text-align: center;
  }
 h3 {    padding: 0; text-transform:uppercase; font-size:18px;
    margin: 0;}

.table>thead>tr>th, .table>tbody>tr>th{     padding: 5px;}
.gray-bg{    background: #BFBFBF;}

tr.gray-bg th {
    border: 1px solid #888282;
    padding: 6px !important;
    text-align: center;
    border-top: 1px solid #888282 !important;
}
td {
    border: 1px solid;
}
.col-xs-5{ padding:0px !important;}

.border-0{ border:0px !important;}
.table>tbody>tr>th{ border-top:0px !important;    font-size: 12px;}
.box {
    width: 100%;
    margin-top: 10px;
    border: 3px solid;
    padding: 5px;
    text-align: center;
    height: 135px;
	position: relative;
}
.box1 {
    width: 100%;
    margin-top: 10px;
    border: 3px solid;
    padding: 5px;
    text-align: center;
    height: 279px;
}

	.middle-content{ width:100%; display:table; margin-top:20px;}
	.heading h5{ background: #000;
    padding: 8px;
    color: #FFF;
    text-align: center;
    font-size: 15px;
    /* font-weight: bold; */
    margin: 0px !important;}
	.middle-content .col-xs-6 {padding-left:0px !important;}
	.middle-content .col-sm-12 {padding-right:0px !important;}
	.left{ width:50%; height:auto; overflow:auto; float:left;}
	.right{ width:48%; height:auto; overflow:auto; float:right;}
	.table-responsive { overflow:inherit !important}
	.bottom .heading {    background: #BFBFBF;
    text-align: center;
    font-size: 16px;
    padding: 4px;
}
.bottom {    width: 100%;
    margin-top: 20px;}
	.col-xs-6.pull-right {
    padding: 0;
}
.heading h5 {
    background: #000;
    width: 100%;
    padding: 8px;
    color: #FFF;
    text-align: center;
    font-size: 15px;
    /* font-weight: bold; */
    margin: 0px !important;
}
.daihatsu-logo {    float: right;}
.img-responsive, .thumbnail>img, .thumbnail a>img, .carousel-inner>.item>img, .carousel-inner>.item>a>img {
    display: block;
    max-width: 100%;
    height: 100%;
}
    </style>
	<script>
	$(document).ready(function (e) {
          

// Function to preview image after validation
            $(function() {
                $("#file1").change(function() {
                    $("#message").empty(); // To remove the previous error message
                    var file = this.files[0];
                    var imagefile = file.type;
                    var match= ["image/jpeg","image/png","image/jpg"];
                    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                    {
                        $('#previewing1').attr('src','noimage.png');
                        $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                        return false;
                    }
                    else
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded1;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
            function imageIsLoaded1(e) {
                $("#file1").css("color","green");
                $('#image_preview').css("display", "block");
                $('#previewing1').attr('src', e.target.result);
                $('#previewing1').attr('width', '250px');
                $('#previewing1').attr('height', '230px');
            };// Function to preview image after validation
            $(function() {
                $("#file2").change(function() {
                    $("#message").empty(); // To remove the previous error message
                    var file = this.files[0];
                    var imagefile = file.type;
                    var match= ["image/jpeg","image/png","image/jpg"];
                    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                    {
                        $('#previewing2').attr('src','noimage.png');
                        $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                        return false;
                    }
                    else
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded2;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
            function imageIsLoaded2(e) {
                $("#file2").css("color","green");
                $('#image_preview').css("display", "block");
                $('#previewing2').attr('src', e.target.result);
                $('#previewing2').attr('width', '250px');
                $('#previewing2').attr('height', '230px');
            };// Function to preview image after validation
            $(function() {
                $("#file3").change(function() {
                    $("#message").empty(); // To remove the previous error message
                    var file = this.files[0];
                    var imagefile = file.type;
                    var match= ["image/jpeg","image/png","image/jpg"];
                    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                    {
                        $('#previewing3').attr('src','noimage.png');
                        $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                        return false;
                    }
                    else
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded3;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
            function imageIsLoaded3(e) {
                $("#file3").css("color","green");
                $('#image_preview3').css("display", "block");
                $('#previewing3').attr('src', e.target.result);
                $('#previewing3').attr('width', '250px');
                $('#previewing3').attr('height', '230px');
            };// Function to preview image after validation
            $(function() {
                $("#file4").change(function() {
                    $("#message").empty(); // To remove the previous error message
                    var file = this.files[0];
                    var imagefile = file.type;
                    var match= ["image/jpeg","image/png","image/jpg"];
                    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                    {
                        $('#previewing4').attr('src','noimage.png');
                        $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                        return false;
                    }
                    else
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded4;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
            function imageIsLoaded4(e) {
                $("#file4").css("color","green");
                $('#image_preview').css("display", "block");
                $('#previewing4').attr('src', e.target.result);
                $('#previewing4').attr('width', '250px');
                $('#previewing4').attr('height', '230px');
            };
        });// Function to preview image after validation
            $(function() {
                $("#file5").change(function() {
                    $("#message").empty(); // To remove the previous error message
                    var file = this.files[0];
                    var imagefile = file.type;
                    var match= ["image/jpeg","image/png","image/jpg"];
                    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                    {
                        $('#previewing2').attr('src','noimage.png');
                        $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                        return false;
                    }
                    else
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded5;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
            function imageIsLoaded5(e) {
                $("#file2").css("color","green");
                $('#image_preview').css("display", "block");
                $('#previewing5').attr('src', e.target.result);
                $('#previewing5').attr('width', '250px');
                $('#previewing5').attr('height', '230px');
            };
  

</script>
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

<div class="full-grid text-center gray-bg" style="background:gray !important; color:black;"><h4>Central Parts Depot</h4></div>
<div class="full-grid text-center gray-bg" style="background:gray !important; color:black;"><h4>DAMAGED PARTS REPORT DURING TRANSIT</h4></div>




<form  id='gatepassform' action="<?= base_url() ?>index.php/parts/saveimgsmr" method="post" enctype="multipart/form-data">
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
            <td style="text-align:left; border: 0px;"> Dealership :
                <input name="dealership" id="employee" placeholder="Dealetship" /></td>
            
        </tr>
        <tr>
            <td style="text-align:left;border-bottom: 0px;border-right: 0px;border-left: 0px;">Claim Reference  #:
           <strong><input name="smrid" id="order" value="TWM/SMR/<?=  sprintf("%04d",$smrid) ?>" readonly placeholder="enter value" /></strong></td>
            
        </tr>
        <tr>
            <td style="text-align:left;border-bottom: 0px;border-right: 0px;border-left: 0px;">Date  : 
                <strong><input name="date" value="<?=date('d/m/Y');?>" id=" pbo/chas" placeholder="Date" /></strong></td>
            
        </tr>
       
        </tbody>
    </table>
</div>




<div class="row">
    <div class="span12 text-center bold underline">
        <span class="" style="font-size: 24px;">Create SMR (DAMAGED PARTS)</span>
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
                     <th align="center" colspan="4">Dispatched Qty</th>
					 <th align="center" colspan="2">Damaged Qty</th>
					 <th align="center">CN #</th>		
					 <th align="center">CN Date</th>
					 <th align="center">Remarks</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
		
		
		
		
<div class="full-grid text-center gray-bg" style="background:gray !important; color:black;"><h4>DAMAGED PART DETAILS</h4></div>

<div class="middle-content">

<div class="left">
<div class="col-xs-6">
<div class="heading"><h5>Packing Box Pictures</h5></div>
<div class="box">
	<!--<form id="uploadimage" action="" method="post" enctype="multipart/form-data">-->
	<img id="previewing1" src="noimage.png" class="img-responsive"/>
	</div>
	<input type="file" name="pb1" id="file1" />
	<!--</form>-->
</div>
<div class="col-xs-6">
<div class="heading"><h5>Damaged Part Pictures</h5></div>
<div class="box">
	<!--<form id="uploadimage" action="" method="post" enctype="multipart/form-data">-->
	<img id="previewing2" src="noimage.png" class="img-responsive" style="height: 121px"/>
	</div>
	<input type="file" name="dp1" id="file2"  />
	<!--</form>-->
</div>
<div class="col-xs-6">
<div class="box">
	<!--<form id="uploadimage" action="" method="post" enctype="multipart/form-data">-->
	<img id="previewing3" src="noimage.png" class="img-responsive" style="height: 121px"/>
	</div>
	<input type="file" name="pb2" id="file3"  />
	<!--</form>-->
</div>
<div class="col-xs-6">
<div class="box">
	<!--<form id="uploadimage" action="" method="post" enctype="multipart/form-data">-->
	<img id="previewing4" src="noimage.png" class="img-responsive" style="height: 121px"/>
	</div>
	<input type="file" name="dp2" id="file4" />
	<!--</form>-->
</div>
</div>
<div class="right">
<div class="col-sm-12 ">
<div class="heading"><h5>Received Against CN # & Pictures</h5></div>
<div class="box1">
<!--<form id="uploadimage" action="" method="post" enctype="multipart/form-data">-->
	<img id="previewing5" src="noimage.png" class="img-responsive" style="height: 262px; width: 100%;"/>
	</div>
	<input type="file" name="ra1" id="file5" />
	<!--</form>--></div>
</div>
</div>
</div>
<div class="bottom">

<div class="col-xs-5">
<div class="table-responsive">
<table class="table">

<div class="heading" style="border: 2px solid; background:gray !important; color:black; " ><strong>DAMAGED PART DETAILS</strong></div>

<tbody>
<tr style="border: 2px solid; ">
<td  style=" width:198px !important; height:59px; "></td>
<td></td>

</tr>

<tr style="border: 2px solid;">
<td style="text-align:center;"><strong>Prepared by</strong></td>
<td style="text-align:center;"><strong>Manager W/H</strong></td>

</tr>
</tbody>

</table>
</div>

</div>

<div class="col-xs-6 pull-right">
<div class="table-responsive">
<table class="table">

<div class="heading" style="border: 2px solid; background:gray !important; color:black; " ><strong>IMC Remarks </strong></div>

<tbody>
<tr style="border: 2px solid; ">
<td  style=" width:115px !important; height:52px; "><strong>Approved </strong></td>
<td></td>

</tr>

<tr style="border: 2px solid;">
<td  style=" height:52px; "><strong>Not Approved </strong></td>
<td></td>

</tr>
</tbody>

</table>
</div>


</div>
</div>
        


    <!--span12-->
</div>




<input type='submit' value='Save' class='rbtn' style="margin-left: 44%;">
</form>
<br/>
<br/>
<hr/>
</div>

</div>



</body>
</html>

<script>

  $("#newRowLocal").click(function (e) {
	var length = $(".gatepass").length+1;
        var items = "";
        items += "<tr class=\"gatepass\"><td align=\"center\">"+length+"</td><td align=\"center\"><input type=\"text\" style=\"width: 70px;\" name=\"orderno[]\" Placeholder=\"Order #\"/></td><td align=\"center\"><input type=\"text\" name=\"invoiceno[]\"  style=\"width: 70px;\" Placeholder=\"Invoice #\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"partno[]\" Placeholder=\"Part No\"/></td><td></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"dispatchedQty[]\" Placeholder=\"Dispatched Qty\"/></td><td></td><td><td></td></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"damagedQty[]\" Placeholder=\"Damaged Qty\"/></td><td></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"CN[]\" Placeholder=\"	CN #\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"Date\" name=\"CNDate[]\" Placeholder=\"CN Date\"/></td><td align=\"center\"><input style=\"width: 70px;\" type=\"text\" name=\"remarks[]\" Placeholder=\"Remarks\"/></td></tr>";
        $('#gatepassdetail tbody').append(items);
        $("select[name='idPart[]']").chosen({no_results_text: "Oops, nothing found!"});
    });
	$("input[type='image']").click(function() {
    $("input[id='my_file']").click();
});

    

</script>
