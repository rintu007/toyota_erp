<?php //var_dump($Estimate);?>

<html>

<head>
    <!--<link rel=Stylesheet href='<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css'>-->
    <meta charset="utf-8">
    <title>Estimate Receipt</title>
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed"
          href="<?php echo base_url(); ?>assets/receipt/img/apple-touch-icon-57-precomposed.png">
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
            popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/bootstrap.min.css><link rel=Stylesheet href=<?php echo base_url(); ?>assets/receipt/css/print.css><body onload="window.print()">');
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
            border: 1px solid black;
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
                    <div class="col-xs-6  text-center">
                        <img alt="140x140" width="150" style="float:left; height=" 25" src="<?php echo base_url(); ?>
                        assets/receipt/img/toyota.png" style="margin-top: 35px;" >
                    </div>
                    <div class="col-xs-6 text-center">
                        <img alt="140x140" width="150" style="float:right; height=" 25" src="<?php echo base_url(); ?>
                        assets/receipt/img/Daihatsu.png" style="margin-top: 35px;" >
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-xs-13   text-center">
                        <h3 class="text-center"><b><u>TOYOTA WESTERN MOTORS</u></b></h3>
                        <?php if ($Estimate[0]['isMechanical'] == 1) { ?>
                            <h4 class="text-center"><b><u>Estimate Mechanical</u></b></h4>
                        <?php } else { ?>
                            <h4 class="text-center"><b><u>Estimate BodyShop</u></b></h4>
                        <?php } ?>
                    </div>
                </div>
                <br/>
                <br/>

                <div class="row clearfix">
                    <div class="col-xs-5 col-xs-offset-1">

                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-xs-6">
                        <span><b>Date:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u><?= date("d-M-Y", strtotime($Estimate[0]['Date'])) ?></u></span>
                    </div>
                    <div class="col-xs-6">
                        <span><b>Estimate Number:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u><?= $Estimate[0]['SerialNumber']; ?></u></span>
                    </div>
                </div>

                <br>
                <div class="row clearfix">
                    <div class="col-xs-6">
                        <span><b>Customer Name:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u
                                    class="uppercase"><?= $Estimate[0]['CustomerName'] ?></u></span>
                    </div>
                    <div class="col-xs-6">
                        <span><b>Company Name:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u
                                    class="uppercase"><?= $Estimate[0]['CompanyName'] ?></u></span>
                    </div>

                </div>
                <br>
                <div class="row clearfix">
                    <div class="col-xs-6">
                        <span><b>Address & Cellphone:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u><?= $Estimate[0]['AddressDetails'] ?>
                                & <?= $Estimate[0]['Cellphone'] ?></u></span>
                    </div>
                    <div class="col-xs-6">
                        <span><b>Company Contact:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u><?= $Estimate[0]['CompanyContact'] ?></u></span>
                    </div>

                </div>
                <br>
                <div class="row clearfix">
                    <div class="col-xs-6">
                        <span><b>ATTN Mr:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><U
                                    class="uppercase"><?= $Estimate[0]['Attender'] ?></U></span>
                    </div>
                    <div class="col-xs-6">
                        <span><b>Customer Email:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u><?= $Estimate[0]['CustomerEmail'] ?></u></span>
                    </div>

                </div>

                <br>
                <div class="row clearfix">
                    <div class="col-xs-6">
                        <span><b>Ntn:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u><?= $Estimate[0]['Ntn'] ?></u></span>
                    </div>
                    <div class="col-xs-6">
                        <span><b>Gst:</b></span>
                        <span style="margin-left:12px;padding-left: 5px;width: 100px"><u><?= $Estimate[0]['Gst'] ?></u></span>
                    </div>

                </div>

                <br>
                <style>
                    th {
                        font-size: 15px;
                    }

                    td {

                        font-size: 10px;
                    }

                    td b {

                        font-size: 14px;
                    }

                    td, th {

                        border: 1px solid #dddddd;

                    }

                    .aligning > td, th {
                        text-align: center;
                    }

                    .uppercase {
                        text-transform: uppercase;
                    }

                    .amount {
                        text-align: right;
                    }
                </style>
                <table class="table requisition table-border" style="border:1px solid #dddddd">
                    <thead>
                    <tr>
                        <th><b>MAKE</b></th>
                        <th><b>MODEL</b></th>
                        <th><b>YEAR</b></th>
                        <th><b class="uppercase">REG No.</b></th>
                        <th><b>CHASIS No.</b></th>
                        <th><b class="uppercase">ENG No.</b></th>
                        <th><b>K.M</b></th>
                        <th><b>AMOUNT</b></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr class="aligning">
                        <td><?= $Estimate[0]['VehicleName'] ?></td>
                        <td><?= $Estimate[0]['Model'] ?></td>
                        <td><?= $Estimate[0]['YEAR'] ?></td>
                        <td class="uppercase"><?= $Estimate[0]['RegistrationNumber'] ?></td>
                        <td><?= $Estimate[0]['ChassisNumber'] ?></td>
                        <td class="uppercase"><?= $Estimate[0]['EngineNumber'] ?></td>
                        <td><?= $Estimate[0]['Mileage'] ?></td>
                        <td></td>

                    </tr>
                    <?php

                    if ($Estimate[0]['isMechanical'] == 1)
                        $jjobs = explode(",", $Estimate[0]['Jobs']);
                    else
                        $jjobs = explode(",", $Estimate[0]['JJobs']);
                    //var_dump($jjobs);die;
                    if ($Estimate[0]['is_PM'] == 0) {
                        if ($jjobs[0]) {
                            ?>
                            <tr>

                                <td colspan=7 align="left"><b> JOB DESCRIPTION </b></td>
                                <td></td>
                            </tr>

                            <?php // $jjobs = explode(",", $Estimate[0]['Jobs']);
                            //  var_dump($jjobs);die;
                            if ($Estimate[0]['isMechanical'] == 1) {
                                $sumArray2 = explode(",", $Estimate[0][$Estimate[0]['Rangee']]);
                            } else {
                                $sumArray2 = explode(",", $Estimate[0]['TotalAmountOne']);
                            }
                            // $sumArray2 = explode(",", $Estimate[0][$Estimate[0]['Rangee']]);
                            //var_dump($sumArray2);die
                            $ii = 0;
                            $jjamount = 0;
                        $JobTotal=0;
                            foreach ($jjobs as $val) {

                                if ($Estimate[0]['isMechanical'] == 1) {
                                    $JobTotal += $sumArray2[$ii];
                                    ?>
                                    <tr>

                                    <td colspan=7 align="left" class="uppercase"><?= $val; ?></td>
                                    <td class="amount"><?php echo number_format((float)$sumArray2[$ii++], 2, '.', ''); ?></td>

                                    </tr> <?php } else {
                                    $r = explode("||", $val);
                                    $JobTotal +=$r[1];

                                    ?>

                                    <tr>

                                        <td colspan=7 align="left" class="uppercase"><?= $r[0]; ?></td>
                                        <td class="amount"><?php $jjamount += (float)$r[1];
                                            echo number_format((float)$r[1], 2, '.', ''); ?></td>

                                    </tr>


                                <?php }
                            }
                            ?>
                            <tr>
                                <td colspan=7 align="eft"><strong>Total Jobs</strong></td>
                                <td class="amount"><strong><?php echo number_format((float)$JobTotal, 2, '.', ''); ?></strong></td>
                            </tr>
                            <?php
                        }
                    } elseif ($Estimate[0]['is_PM'] == 1) {
                        ?>
                        <tr>
                            <td colspan=7 align="left"><b> PM Package </b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan=7 align="left">  <?php $CI =& get_instance();
                                echo $CI->pm_package($Estimate[0]['PM_package']); ?> </td>
                            <td class="amount"><?= number_format((float)$Estimate[0]['PM_amount'], 2, '.', ''); ?></td>
                        </tr>

                    <?php }
                    if ($Parts) { ?>
                        <tr>
                            <td colspan=7 align="left"><b> PARTS DESCRIPTION </b></td>
                            <td></td>
                        </tr>
                        <?php
                        $partsTotal =0;
                        foreach ($Parts as $p) {
                            $partsTotal+= $p['Price'];
                            ?>

                            <tr>
                                <td colspan=7 align="eft"><?= $p['PartName']; ?></td>
                                <td class="amount"><?php echo number_format((float)$p['Price'], 2, '.', ''); ?></td>
                            </tr>


                        <?php } ?>
                        <tr>
                            <td colspan=7 align="eft"><strong>Total Parts</strong></td>
                            <td class="amount"><strong><?php echo number_format((float)$partsTotal, 2, '.', ''); ?></strong></td>
                        </tr>

                    <?php }
                    if ($Sublet) { ?>
                        <tr>
                            <td colspan=7 align="left"><b> Sublets </b></td>
                            <td></td>
                        </tr>
                        <?php
                        $toalSublet = 0;
                        foreach ($Sublet as $s) {
                            $toalSublet+=$s['SubletRepairAmount'];
                            ?>

                            <tr>
                                <td colspan=7 align="eft" class="uppercase"><?= $s['Description']; ?>
                                    ( <?= $s['Quantity']; ?> )
                                </td>
                                <td class="amount"><?php echo number_format((float)$s['SubletRepairAmount'], 2, '.', ''); ?></td>
                            </tr>


                        <?php }
                        ?>

                        <tr>
                            <td colspan=7 align="eft"><b>Total Sublet</b></td>
                            <td class="amount"><b><?php echo number_format((float)$toalSublet, 2, '.', ''); ?></b></td>
                        </tr>

                        <?php
                    } ?>

                    <tr>
                        <td colspan=7 align="left"><b>TOTAL</b></td>

                        <td class="amount"><b style="font-size:18px"><?php
                                $totalAmount = 0;
                                if ($Estimate[0]['is_PM'] != 1) {
                                    if ($Estimate[0]['isMechanical'] == 1) {
                                        $sumArray = explode(",", $Estimate[0][$Estimate[0]['Rangee']]);
                                        foreach ($sumArray as $val) {
                                            $totalAmount += $val;
                                        }
                                    } else {
//jjamount		
                                        //  $sumArray = explode(",", $Estimate[0]['TotalAmountOne']);
                                        $totalAmount = $jjamount;
                                    }

                                } else {
                                    $totalAmount = $Estimate[0]['PM_amount'];
                                }

                                $totalAmount2 = 0;
                                if ($Parts) {
                                    foreach ($Parts as $vall) {
                                        $totalAmount2 += $vall['Price'];
                                    }
                                }
                                if ($Sublet) {
                                    foreach ($Sublet as $vall) {
                                        $totalAmount2 += $vall['SubletRepairAmount'];
                                    }
                                }
                                echo number_format((float)($totalAmount + $totalAmount2), 2, '.', '') . " /="; ?></b>
                        </td>
                    </tr>
                    </tbody>
                </table>

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



