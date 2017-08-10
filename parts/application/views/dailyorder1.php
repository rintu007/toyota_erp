<html>
    <head>
        <title>Daily Order Invoice</title>

        <link rel=Stylesheet href='<?= base_url() ?>/assets/bootstrap/css/bootstrap.css'>

        <script type="text/javascript">
            /*--This JavaScript method for Print command--*/
            function PrintDoc() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url() ?>/assets/bootstrap/css/bootstrap.css></head><body onload="window.print()">');
                popupWin.document.write(toPrint.innerHTML);
                popupWin.document.write('</html>');
                popupWin.document.close();
            }
            /*--This JavaScript method for Print Preview command--*/
            function PrintPreview() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=670px,height=300,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Print Preview::</title><link rel=Stylesheet href=<?= base_url() ?>/assets/bootstrap/css/bootstrap.css></head><body>');
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
        <br>
        <div id="printArea">
            <div class="container border">
                <br/>
                <div class="row-fluid">
                    <div class="span12 text-center bold">
                        <span class="span2">
                            <img src="<?= base_url() ?>/assets/images/toyota.png" style="width: 200px; margin-left: 26px;" alt="Toyota" />
                        </span>
                        <span class="span7" style="font-size: 24px; margin-left: 34px;"></span>
                        <span class="span2">
                            <img src="<?= base_url() ?>/assets/images/toyota.png" style="width: 200px" alt="Toyota" />
                        </span>
                        <br>
                        <br/>
                        <br/><br/><br/>
                    </div>
                    <div class="row-fluid">
                        <div class="span12 text-left" style="margin-left:-144px;">
                            <table style="border-bottom: 2px solid black; width: 30%;margin: auto;" border="1" class="table">
                                <tbody style="border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;
                                       border-top: 2px solid black;">
                                    <tr>
                                        <td style="text-align: left; width: 10%;" class="bold"><?= $GetInvoice['ParentName'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <table style="border-bottom: 2px solid black; width: 60%;margin: auto;" border="1" class="table">
                                <tbody style="border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;
                                       border-top: 2px solid black;">
                                    <tr>
                                        <td style="text-align: center; vertical-align:middle; width: 60%;" colspan="3" class="bold"><?= $GetInvoice['Title'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; vertical-align:middle; width: 60%;" colspan="3" class="bold"><h4><?= $GetInvoice['Name'] ?></h4></td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: right; border-right: 1px solid white; vertical-align:middle; width: 45%;" class="bold">Order # :</td>
                                        <td style="text-align: left; vertical-align:middle; width: 60%;" colspan="2" class="bold underline"> <?= $GetInvoice['OrderNumber'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; border-right: 1px solid white; vertical-align:middle; width: 45%;" class="bold">Date :</td>
                                        <td style="text-align: left; vertical-align:middle; width: 60%;" colspan="2" class="bold underline"><?= $GetInvoice['Date'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <table style="border-bottom: 2px solid black; width: 60%;margin: auto;" border="1" class="table">
                                <tbody style="border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;
                                       border-top: 2px solid black;">
                                    <tr>
                                        <td style="text-align: center; vertical-align:middle; width: 40%;" rowspan="3" class="bold"><b>Dispatch Mode:</b></td>
                                        <td style="text-align: left;" class="bold"><i>Overland Shipment :</i></td>
                                        <td style="text-align: center;" colspan="2"><?php
                                            if ($GetInvoice['Dispatch Mode'] == 'Overland Shipment') {
                                                echo "Yes";
                                            } else {
                                                echo "-";
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; vertical-align:middle;" rowspan="2" class="bold"><i>Air Shipment :</i></td>
                                        <td style="text-align: center;" class="bold">Speed X</td>
                                        <td style="text-align: center;"> <?php
                                            if ($GetInvoice['Dispatch Mode'] == 'Speed X') {
                                                echo "Yes";
                                            } else {
                                                echo "-";
                                            }
                                            ?> </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center;" class="bold">TCS AIR</td>
                                        <td style="text-align: center;"> <?php
                                            if ($GetInvoice['Dispatch Mode'] == 'TCS Air') {
                                                echo 'Yes';
                                            } else {
                                                echo '-';
                                            }
                                            ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <!--<br/>-->
                            <table style="border-bottom: 2px solid black; width: 60%; height: 400px;margin: auto;" class="table">
                                <thead style="border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;
                                       border-top: 2px solid black;">
                                <th style="text-align: center;width: 10%;">S No.</th>
                                <th style="text-align: center;width: 25%;">Part Number</th>
                                <th style="text-align: center;width: 30%;">Description of Part</th>
                                <th style="text-align: center;width: 9%;">Model</th>
                                <th style="text-align: center;width: 10%;">Qty.</th>
                                </thead>
                                <tbody style="border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;
                                       border-top: 2px solid black;">
                                       <?php
                                       $count = 1;
//                                       foreach ($GetInvoice as $Invoice) {
                                       ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $count++ ?></td>
                                        <td style="text-align: center;"><?= $GetInvoice['idPart'] ?></td>
                                        <td style="text-align: center;"><?= $GetInvoice['Description'] ?></td>
                                        <td style="text-align: center;"><?= $GetInvoice['Model'] ?></td>
                                        <td style="text-align: center;"><?= $GetInvoice['Quantity'] ?></td>
                                    </tr>
                                    <?php
//                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <table style=" width: 60%;margin: auto;" class="table">
                                <tbody style="">
                                    <tr>
                                        <td style="text-align: left; vertical-align: middle; width: 10%;" rowspan="3" class="bold">Dealer's Remarks :</td>
                                        <td style="text-align: left; width: 20%; vertical-align: bottom; " >
                                            <?= $GetInvoice['DealerRemarks'] ?>
                                            <!--<br/>-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; vertical-align: bottom; width: 40%;">
                                            <br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; width: 40%;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <table style=" width: 60%;margin: auto;" class="table">
                                <tbody style="">
                                    <tr>
                                        <td style="text-align: left; vertical-align: middle; width: 10%;" rowspan="3" class="bold">IMC Remarks :</td>
                                        <td style="text-align: left; width: 20%; vertical-align: bottom; " >
                                            <?= $GetInvoice['IMCRemarks'] ?>
                                            <!--<br/>-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; vertical-align: bottom; width: 40%;">
                                            <br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; width: 40%;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="row-fluid" style="margin-left: 200px;">
                        <div class="span12 text-left">
                            <p style="margin-left: 10px;">_____________________</p>
                            <span class="bold">Manager Parts Department</span>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
        <input type="button" class="btn-success" onclick="PrintDoc()" value="Print" />
        <input type="button" class="btn-navbar" onclick="PrintPreview()()" value="Print Preview" />
    </body>
</html>