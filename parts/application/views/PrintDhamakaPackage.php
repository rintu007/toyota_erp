


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
        <div class="span12 text-center">
            <input type="button" value="Print" class="btn-primary" onClick="PrintDoc()"/>
            <input type="button" value="Print Preview" class="btn-info" onClick="PrintPreview()"/>
              <a href="http://192.168.1.195/parts/index.php/invoices/PrintDhamakaPackageexcel/<?=$OrderNo?>">  <input type="button" value="Excel Sheet" class="btn-info" /></a>
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

        <div class="full-grid text-center gray-bg"><h4>Toyota Dhamaka Package</h4></div>





        <div class="table-responsive border-none">
            <table class="table">
                <thead>
                <tr>
                    <th style="text-align:right;">Toyota</th>
                    <th style="text-align:center;">WESTERN</th>
                    <th>Motors </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="text-align:right;">Order # :</td>
                    <td style="text-align:center;"><strong><?=$OrderNo?></strong></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right;">Date :</td>
                    <td style="text-align:center;"><strong><?=$GetInvoice[0]['Date']?></strong></td>
                    <td>&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </div>




        <div class="row">
            <div class="span12 text-center bold underline">
                <span class="" style="font-size: 24px;">Toyota Dhamaka Package</span>
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
                            <th align="center">Part Number</th>
                            <th align="center">Description of Parts</th>
                            <th align="center">Model</th>
                            <th align="center">Qty</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($GetInvoice as $GetInvoices) {

                        ?>
                        <tr>
                            <td><?=$count++?></td>
                            <td><?=$GetInvoices['PartNumber']?></td>
                            <td><?=$GetInvoices['PartName']?></td>
                            <td><?=$GetInvoices['Model']?></td>
                            <td><?=$GetInvoices['Quantity']?></td>
                        </tr>
                        <?php
                        }
                        ?>
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


