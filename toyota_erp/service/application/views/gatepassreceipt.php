<html>

    <head>
        <!--<link rel=Stylesheet href='<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css'>-->
        <meta charset="utf-8">
        <title>GarePass Receipt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append ‘#!watch’ to the browser URL, then refresh the page. -->

        <link href="<?php echo base_url(); ?>assets/receipt/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/receipt/css/style.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/receipt/img/favicon.png">

        <!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
        <!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
        <!--<script type="text/javascript" src="js/scripts.js"></script>-->
        <script type="text/javascript">
            /*--This JavaScript method for Print command--*/
            function PrintDoc() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/bootstrap.min.css><body onload="window.print()">');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
            /*--This JavaScript method for Print Preview command--*/
            function PrintPreview() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/bootstrap.min.css><link rel=stylesheet href=<?php echo base_url(); ?>assets/css/stylesheet.css></head><body>');
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
        <br/>
        <div class="container" style="width: 600px;">
            <div class="row-fluid">
                <div class="span12 text-center">
                    <input type="button" value="Print" class="btn-primary" onclick="PrintDoc()"/>
                    <input type="button" value="Print Preview" class="btn-info" onclick="PrintPreview()"/>
                </div>
            </div>
        </div>
        <br/>
        <div id="printArea">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-xs-13">
                        <div class="row clearfix">
                            <div class="col-xs-6  text-center">
                                <img alt="140x140" width="150" style="float:left; height="25" src="<?php echo base_url(); ?>assets/receipt/img/toyota.png" style="margin-top: 35px;">
                            </div>
                            <div class="col-xs-6 text-center">
                                <img alt="140x140" width="150" style="float:right; height="25" src="<?php echo base_url(); ?>assets/receipt/img/Daihatsu.png" style="margin-top: 35px;">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-xs-13 col-xs-offset-1">
                                <h3 class="text-center"><b><u>TOYOTA WESTERN MOTORS</u></b></h3>
                                <h4 class="text-center"><b><u>GATE PASS (SERVICE)</u></b></h4>
                            </div>
                        </div>
						<br>
						 <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span style="margin-left:-14px; "> <b>RO Type :</b></span>
                                <span style="margin-left:74px; padding-left: 5px;width: 100px "> <u><?php echo $GatePassReceipt[0]['ROMode'] ?></u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-0">        
                                <span><b>RO Number :</b></span>
                                <span style="margin-left:15px;padding-left: 5px;width: 95px">
                                    <u><?php echo $GatePassReceipt[0]['RONumber']; ?></u>
                                </span>
                            </div>
							</br>
							<BR>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Serial No :</b></span>
                                <span style="margin-left:74px;padding-left: 5px;width: 100px"><u><?php echo "000" . $GatePassReceipt[0]['GatePass'] ?></u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-0">
                                <span><b>Date :</b></span>
                                <span style="margin-left:35px;padding-left: 5px;width: 95px"><u><?php echo date("d-M-Y", strtotime($GatePassReceipt[0]['GatePassDate'])) ?></u></span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Customer's Name :</b></span>
                                <span style="margin-left:12px;padding-left: 5px;width: 100px"><u><?php echo $GatePassReceipt[0]['CustomerName'] ?></u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-0">
                                <span><b>Reg.No :</b></span>
                                <span style="margin-left:18px;padding-left: 5px;width: 95px">
                                    <u><?php
                                        if ($GatePassReceipt[0]['RegNumber'] != NULL || $GatePassReceipt[0]['RegNumber'] != "") {
                                            echo $GatePassReceipt[0]['RegNumber'];
                                        } else {
                                            echo "Un-Registered";
                                        }
                                        ?></u>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Chassis No :</b></span>
                                <span style="margin-left:60px;padding-left: 5px;width: 100px"><u><?php echo $GatePassReceipt[0]['FrameNumber'] ?></u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-0">
                                <span><b>Engine No :</b></span>
                                <span style="margin-left:0px;padding-left: 5px;width: 95px"><u><?php echo $GatePassReceipt[0]['EngineNumber'] ?></u></span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Make :</b></span>
                                <span style="margin-left:95px;padding-left: 5px;width: 100px"> <u><?php echo $GatePassReceipt[0]['Vehicle'] ?></u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-0">        
                                <span><b>Mileage</b></span>
                                <span style="margin-left:20px;padding-left: 5px;width: 95px">
                                    <u><?php echo $GatePassReceipt[0]['Mileage'] . ' KM' ?></u>
                                </span>
                            </div>
                        </div>  
                        <br><br><Br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span class="text-center">
                                    <b>__________________</b>
                                    <br>
                                    <b>Prepared By</b>
                                </span>
                            </div>
                            <div class="col-xs-4 col-xs-offset-1">
                                <span class="text-center">
                                    <b>__________________</b>
                                    <br>
                                    <b>Reviewed By</b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>	


