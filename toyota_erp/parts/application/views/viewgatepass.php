


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

<div class="full-grid text-center gray-bg"><h4>Parts Department</h4></div>




<!--<form  id='gatepassform' action="<?= base_url() ?>index.php/parts/savegatepass" method="post">-->
<div class="table-responsive border-none">
    <table class="table">

        <tbody>
        <tr>
            <td style="text-align:left;"> Gate Pass :
               <?=  sprintf("%04d",$GatePass[0]['gatePassId']) ?></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">Employee :
                <strong><?= $GatePass[0]['employee']  ?></strong></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;">PBO/Chas :
                <strong><?= $GatePass[0]['pbo/chas']  ?></strong></td>
            <td>&nbsp;</td>
        </tr>
       
        </tbody>
    </table>
</div>




<div class="row">
    <div class="span12 text-center bold underline">
        <span class="" style="font-size: 24px;">GATE PASS</span>
    </div>
</div>
<br/>
<br/>


<div class="row-fluid">
    <div class="span12 text-center">


                        <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRowLocal">+</span>-->

        <div class="table-responsive order-table">
            <table class="table" id="gatepassdetail">
                <thead>

                <tr>
                    <th align="center">S.No</th>
                    <th align="center">Part Number</th>
                    <th align="center">Description of Parts</th>
                   
                    <th align="center">Quantity</th>
                    <th align="center">Date</th>
                     <th align="center">Remarks</th>
                </tr>
                </thead>
                <tbody>
                     <?php
                                $count = 1;
                                foreach ($GatePass as $row) {
                                  
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $row['PartNumber']  ?></td>
                                        <td class="tbl-name"><?= $row['Description'] ?></td>
                                        <td class="tbl-name"><?= $row['Quantity'] ?></td>
                                        <td class="tbl-name"><?= $row['CreatedDate'] ?></td>
                                        <td class="tbl-name"><?= $row['Remarks']  ?></td>
                                        
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                    

                </tbody>
            </table>
        </div>



        <div class="table-responsive">
            <table class="table">
                <tbody>
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
<!--<input type='submit' value='Save' class='btn' style="margin-left: 44%;">-->
<!--</form>-->
<br/>
<br/>
<hr/>
</div>
</body>
</html>

