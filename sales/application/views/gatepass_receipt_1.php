<html>

    <head>
        <!--<link rel=Stylesheet href='<?= base_url(); ?>assets/bootstrap/css/bootstrap.css'>-->
        <meta charset="utf-8">
        <title>GarePass Receipt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append ‘#!watch’ to the browser URL, then refresh the page. -->

        <link href="<?= base_url(); ?>assets/receipt/css/bootstrap.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/receipt/css/style.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url(); ?>assets/receipt/img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url(); ?>assets/receipt/img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url(); ?>assets/receipt/img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?= base_url(); ?>assets/receipt/img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/receipt/img/favicon.png">

        <!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
        <!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
        <!--<script type="text/javascript" src="js/scripts.js"></script>-->
        <script type="text/javascript">
            /*--This JavaScript method for Print command--*/
            function PrintDoc() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/receipt/css/bootstrap.min.css><body onload="window.print()">');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
            /*--This JavaScript method for Print Preview command--*/
            function PrintPreview() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/receipt/css/bootstrap.min.css><link rel=stylesheet href=<?= base_url(); ?>assets/css/stylesheet.css></head><body>');
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
                    <div class="col-xs-12">
                        <div class="row clearfix">
                            <div class="col-xs-3 col-xs-offset-1 text-center">
                                <img width="150" height="100" src="<?= base_url(); ?>assets/receipt/img/logo.jpg">
                            </div>
                            <div class="col-xs-7">
                                <h4 class="text-center"><b><u>Millennium Mall Management Company</u></b></h4>
                                <h5 class="text-center"><b><u>Shop Rent Bill</u></b></h5>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Serial No.</b></span>
                                <span><u>______________</u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Issue Date:</b></span>
                                <span><u>______________</u></span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Shop Number:</b></span>
                                <span><u>Askari Bank Ltd</u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Due Date:</b></span>
                                <span><u>Siraj Dr</u></span>
                            </div>
                            <!--<div class="col-xs-5 " style=" margin-left: -100px; ">-->
                                <!--<span><b>Through:</b></span>-->
                                <!--<span><u>Siraj Dr</u></span>-->
                            <!--</div>-->
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Shop Name:</b></span>
                                <span><u>Un-Registered</u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Amount Due: </b></span>
                                <span><u>Un-Registered</u></span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Monthly Rent: </b></span>
                                <span><u>2191764</u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Amount After Due Date: </b></span>
                                <span><u>2191764</u></span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Previous Arears:</b></span>
                                <span><u>2032379</u></span>
                            </div>
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Amount Paid:</b></span>
                                <span><u>2032379</u></span>
                            </div>
                        </div>
                        <br>
                        <div class="row clearfix">
                            <div class="col-xs-5 col-xs-offset-1">
                                <span><b>Billing Month</b></span>
                                <span><u>GLI A/T</u></span>
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
                                <!--<span><u>Siraj Dr</u></span>-->
                            </div>
                            <!--<div class="col-xs-5 ">-->
                            <!--</div>-->
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


