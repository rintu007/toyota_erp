


<html>

<head>
    <link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css>
    <script type="text/javascript">
        /*--This JavaScript method for Print command--*/
        function PrintDoc() {
            var toPrint = document.getElementById('printArea');
            var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
            popupWin.document.open();
            popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css><link rel=Stylesheet href=<?= base_url(); ?>assets/css/stylesheet.css></head><body onload="window.print()">');
            popupWin.document.write(toPrint.innerHTML);
            popupWin.document.write('</html>');
            popupWin.document.close();
        }
        /*--This JavaScript method for Print Preview command--*/
        function PrintPreview() {
            var toPrint = document.getElementById('printArea');
            var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
            popupWin.document.open();
            popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css><link rel=Stylesheet href=<?= base_url(); ?>assets/css/stylesheet.css></head><body>');
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
    </style>
</head>

<body>
<?php

$count = 1;
?>
<br/>
<div class="container" style="width: 948px;">
    <div class="row-fluid">
<?php
$url=$_SERVER['REQUEST_URI'];
$ex=explode('/', $url);
$l=$ex[(count($ex)-1)];
$tot=0;
 foreach ($MonthlyOrder as $row) {
$tot= $row['UnitPrice']*$row['Quantity1']+$row['UnitPrice']*$row['Quantity2']+$row['UnitPrice']*$row['Quantity3'];
                            }
?>


        <div class="span12 text-center">
            <input type="button" value="Print" class="btn-primary" onClick="PrintDoc()"/>
            <input type="button" value="Print Preview" class="btn-info" onClick="PrintPreview()"/>
             <a href="http://192.168.1.195/parts/index.php/invoices/PrintMonthlyOrderexcel/<?=$idorder?>/<?=$l?>/<?=$tot?>">  <input type="button" value="Excel Sheet" class="btn-info" /></a>
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

        <div class="full-grid text-center gray-bg"><h4>MONTHLY ORDER</h4></div>





        <div class="table-responsive border-none">
            <table class="table">
                <thead>
                
                </thead>
                <tbody>
                <tr>
                    <td >Order # :</td>
                    <td style="text-align:left;"><strong>TWM-MO-<?=$idorder?></strong></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td >Date :</td>
                    <td style="text-align:left;"><strong><?=$MonthlyOrder[0]['CreatedDate']?></strong></td>
                    <td>&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </div>




        <div class="row">
            <div class="span12 text-center bold underline">
                <span class="" style="font-size: 24px;">Monhtly ORDER Cycle</span>
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
                            <th align="center">Order Reason</th>
                            <th align="center">Part Number</th>
                             <th align="center">Description</th>
                            <th align="center" width="2%">Qty In Stock</th>
                          
                            <th align="center">MAD</th>
                              <th align="center"><?= date('F', strtotime("2012-".$MonthlyOrder[0]['month1']."-01"));?></th>
                            <!--  <th align="center"><?= date('F', strtotime("2012-".$MonthlyOrder[0]['month2']."-01"));?></th>
                              <th align="center"><?= date('F', strtotime("2012-".$MonthlyOrder[0]['month3']."-01"));?></th>-->
                               <th align="center" width="5%">Unit Price</th>
                              <th align="center"> Total <?= date('F', strtotime("2012-".$MonthlyOrder[0]['month1']."-01"));?></th>
                            <!--  <th align="center">Total <?= date('F', strtotime("2012-".$MonthlyOrder[0]['month2']."-01"));?></th>
                              <th align="center">Total <?= date('F', strtotime("2012-".$MonthlyOrder[0]['month3']."-01"));?></th>-->
                             
<!--                              <th align="center">Total</th>-->
                             
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($MonthlyOrder as $row) {

                            ?>
                            <tr>
                                <td><?=$count++?></td>
                                <td><?=$row['OrderReason']?></td>
                                <td><?=$row['PartNumber']?></td>
                                <td><?=$row['PartName']?></td>
                                <td><?=$row['QuantityInStock']?></td>
                              
                                <td><?=$row['MAD']?></td>
                                
                                <td><?=$row['Quantity1']?></td>
                              <!--  <td><?=$row['Quantity2']?></td>
                                <td><?=$row['Quantity3']?></td>-->
                                 <td><?=$row['UnitPrice']?></td>
                                 <td><?= $row['UnitPrice']*$row['Quantity1']?> </td>
                               <!--  <td><?= $row['UnitPrice']*$row['Quantity2']?> </td>
                                 <td><?= $row['UnitPrice']*$row['Quantity3']?> </td>-->
<!--                                 <td><?= $row['UnitPrice']*$row['Quantity1']+$row['UnitPrice']*$row['Quantity2']+$row['UnitPrice']*$row['Quantity3']?> </td>-->
                             
                                
                            </tr>
                        <?php  }  ?>
                        
                            <tr>
                                <td colspan="13" style="text-align: right !important;">Total : <?= $row['UnitPrice']*$row['Quantity1']+$row['UnitPrice']*$row['Quantity2']+$row['UnitPrice']*$row['Quantity3']?></td>
                                
                                
                            </tr>
                        </tbody>
                        
                    </table>
                </div>



                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td style="width:20%;"><strong>Dealer's Remarks : </strong></td>
                            <td style="border-bottom:1px solid #000;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border-bottom:1px solid #000;">&nbsp;</td>
                        </tr>

                        <tr>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border:none !important;">&nbsp;</td>
                        </tr>

                        <tr>
                            <td style="border:none !important; width:20%;"><strong>IMC Remarks :</strong></td>
                            <td style="border-bottom:1px solid #000; border-top:none !important;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border-bottom:1px solid #000;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border:none !important;">&nbsp;</td>
                            <td style="border: !important;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-top:1px solid #000 !important;"><strong>Manager Parts Dealership</strong></td>
                            <td style="border:none !important;">&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                </div>



            </div><!--span12-->
        </div>

        <br/>
        <br/>
        <hr/>
    </div>
</body>
</html>


