


<html>

<head>
    <link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css>
    <link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap.min.css>
   <script type="text/javascript">
        /*--This JavaScript method for Print command--*/
        function PrintDoc() {
            var toPrint = document.getElementById('printArea');
            var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
            popupWin.document.open();
            popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap2.css><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap.min.css></head><body onload="window.print()">');
            popupWin.document.write(toPrint.innerHTML);
            popupWin.document.write('</html>');
            popupWin.document.close();
        }
        /*--This JavaScript method for Print Preview command--*/
        function PrintPreview() {
            var toPrint = document.getElementById('printArea');
            var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
            popupWin.document.open();
            popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap2.css><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap.min.css></head><body>');
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
</head>

<body>
<?php

$count = 1;
?>
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

<div class="container border" style="width: 948px;">

<div class="report-header">
    <div class="col-sm-6 col-xs-6 pull-left"><div class="toyota-logo"><img src="<?= base_url(); ?>assets/images/toyota-logo.PNG"></div></div>
    <div class="col-sm-6 col-xs-6 pull-right"><div class="daihatsu-logo"><img src="<?= base_url(); ?>assets/images/daihaisu-logo.PNG"></div></div>
</div><!--report-header end -->

<div class="full-grid text-center gray-bg" style="background:gray !important; color:black;"><h4>Central Parts Depot</h4></div>
<div class="full-grid text-center gray-bg" style="background:gray !important; color:black;"><h4>DAMAGED PARTS REPORT DURING TRANSIT</h4></div>




<!--<form  id='gatepassform' action="<?= base_url() ?>index.php/parts/savegatepass" method="post">-->
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
                <strong><?= $smrs[0]['dealership']  ?></strong></td>
            
        </tr>
        <tr>
            <td style="text-align:left;border-bottom: 0px;border-right: 0px;border-left: 0px;">Claim Reference  #:
           TWM/SMR/<?=  sprintf("%04d",$smrs[0]['idimgsmr']) ?></td>
            
        </tr>
        <tr>
            <td style="text-align:left;border-bottom: 0px;border-right: 0px;border-left: 0px;">Date  : 
                <strong><?= date('d-m-Y',strtotime($smrs[0]['createddate']))  ?></strong></td>
            
        </tr>
       
        </tbody>
    </table>
</div>




<div class="row">
    <div class="span12 text-center bold underline">
        <span class="" style="font-size: 24px;">SHORT / EXCESS / DAMAGED / WRONG RECEIPT / OVER PRICED / UNDER PRICED</span>
    </div>
</div>
<br/>
<br/>


<div class="row-fluid">
    <div class="span12 text-center">


                        

        <div class="table-responsive order-table">
            <table class="table">
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
					 <?php
                                $count = 1;
                                foreach ($smrsdetails as $row) {
                                  
                                    ?>
                                    <tr>
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $row['orderno']  ?></td>
                                        <td class="tbl-name"><?= $row['invoiceno'] ?></td>
                                        <td class="tbl-name" style=" border-left: 0px;border-right: 0px;"><?= $row['partno'] ?></td>
										<td class="tbl-name" style=" border-left: 0px;"></td>
										<td class="tbl-name"style=" border-left: 0px;border-right: 0px;"></td>
										<td class="tbl-name"style=" border-left: 0px;border-right: 0px;"></td>
                                        <td class="tbl-name"style=" border-left: 0px;border-right: 0px;"><?= $row['DispatchedQty']  ?></td>
										<td class="tbl-name"style=" border-left: 0px;border-right: 0px;"></td>
										<td class="tbl-name"style=" border-right: 0px;"><?= $row['DamagedQty']  ?></td>
										<td class="tbl-name"style=" border-left: 0px;border-right: 0px;"></td>
                                        <td class="tbl-name"><?= $row['Cn'] ?></td>
                                        <td class="tbl-name"><?= $row['cndate'] ?></td>
                                        <td class="tbl-name"><?= $row['Remarks']  ?></td>
										                                      
                                    </tr>
                                 <?php
                                }
                                ?>
                </tbody>
            </table>
        </div>
		
		
		
	<?php 
	$img = explode(',',$row['pack_box_pictures']);
	$img1 = explode(',',$row['damaged_part_pictures']);
	
?>	
<div class="full-grid text-center gray-bg" style="background:gray !important; color:black;"><h4>DAMAGED PART DETAILS</h4></div>

<div class="middle-content">

<div class="left">
<div class="col-xs-6">
<div class="heading"><h5>Packing Box Pictures</h5></div>
<div class="box">
	<?php if($img[0]== false){?>
	<img  src="<?= base_url(); ?>assets/smrimages/no-preview-available.PNG" class="img-responsive" style = "width: 202px;height: 122px;"/>
	<?php } else { ?>
	<img  src="<?= base_url(); ?>assets/smrimages/<?= $row['idimgsmr']?>/<?= $img[0]?>" class="img-responsive" style = "width: 202px;height: 122px;"/>
	<?php } ?>
	</div>
</div>
<div class="col-xs-6">
<div class="heading"><h5>Damaged Part Pictures</h5></div>

<div class="box">
	<?php if($img1[0]== false){?>
	<img  src="<?= base_url(); ?>assets/smrimages/no-preview-available.PNG" class="img-responsive" style = "width: 202px;height: 122px;"/>
	<?php } else { ?>
	<img  src="<?= base_url(); ?>assets/smrimages/<?= $row['idimgsmr']?>/<?= $img1[0]?>" class="img-responsive" style = "width: 202px;height: 122px;"/>
	<?php } ?>
	</div>	
</div>
<div class="col-xs-6">
<div class="box">
	<?php if($img [1]== false){?>
	<img  src="<?= base_url(); ?>assets/smrimages/no-preview-available.PNG" class="img-responsive" style = "width: 202px;height: 122px;"/>
	<?php } else { ?>
	<img  src="<?= base_url(); ?>assets/smrimages/<?= $row['idimgsmr']?>/<?= $img[1]?>" class="img-responsive" style = "width: 202px;height: 122px;"/>
	<?php } ?>
	</div>
</div>
<div class="col-xs-6">

<div class="box">
	<?php if($img1[1]== false){?>
	<img  src="<?= base_url(); ?>assets/smrimages/no-preview-available.PNG" class="img-responsive" style = "width: 202px;height: 122px;"/>
	<?php } else { ?>
	<img  src="<?= base_url(); ?>assets/smrimages/<?= $row['idimgsmr']?>/<?= $img1[1]?>" class="img-responsive" style = "width: 202px;height: 122px;"/>
	<?php } ?>
	</div>
</div>
</div>
<div class="right">
<div class="col-sm-12 ">
<div class="heading"><h5>Received Against CN # & Pictures</h5></div>
<div class="box1">
	<?php if($row['received_against_cn_pictures']== false){?>
	<img  src="<?= base_url(); ?>assets/smrimages/no-preview-available.PNG" class="img-responsive" style = "width: 414px; height: 265px;"/>
	<?php } else { ?>
	<img  src="<?= base_url(); ?>assets/smrimages/<?= $row['idimgsmr']?>/<?= $row['received_against_cn_pictures']?>" class="img-responsive" style = "width: 414px; height: 265px;"/>
	<?php } ?>
	</div>
	<div>&nbsp;</div>
	</div>
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
<!--<input type='submit' value='Save' class='btn' style="margin-left: 44%;">-->
<!--</form>-->
<br/>
<br/>
<hr/>
</div>
</body>
</html>

