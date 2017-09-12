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
        <br/>
        <div class="container" style="width: 948px;">
            <div class="row-fluid">
                <div class="span12 text-center">
                    <input type="button" value="Print" class="btn-primary" onclick="PrintDoc()"/>
                    <input type="button" value="Print Preview" class="btn-info" onclick="PrintPreview()"/>
                </div>
            </div>
        </div>
        <br/>
        <div id="printArea">
            <br/><br/><br/>
                 <br/>
            <br/><br/><br/>

            <div class="container border" style="width: 948px;">
                <br/>
                <br/>
                <div class="row">
                    <div class="span12 text-center bold underline">
                        <span class="" style="font-size: 24px;">Quotation</span>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="row">
                    <div class="span4">
                        <div class="row-fluid">
                            <div class="span4 text-right">
                                <span class="bold">Attn :</span>
                            </div>
                            <div class="span8">
                                <span ><?= $_POST['FullName'] ?> </span>
                            </div>
                        </div>
                    </div>
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span12 text-center">
                                <span class="bold underline">Marketing Division</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="span4">
                        <div class="row-fluid">
                            <div class="span4 text-right">
                                <span class="bold">M/S :</span>
                            </div>
                            <div class="span8">
                                <span ><?= $_POST['BankName'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span6 text-right">
                                <span class="bold">Reference#:</span>
                            </div>
                            <div class="span6">
                                <span>TWM/<?= $_POST['IdResourceBook'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="span4"></div>
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span6 text-right">
                                <span class="bold">Date:</span>
                            </div>
                            <div class="span6">
                                <span><?= $_POST['Date'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="span4">
                        <div class="row-fluid">
                            <div class="span4 text-right">
                                <span class="bold">A/C:</span>
                            </div>
                            <div class="span8">
                                <span ><?=  $_POST['FatherName'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span12 text-center">
                        <br/>
                        <table class="table" style="width: 90%;margin: auto;">
                            <thead style="border-bottom: 2px solid black;">
                            <th style="text-align: center;width: 10%;">Sn.</th>
                            <th style="text-align: center;width: 40%;">Description</th>
                            <th style="text-align: center;width: 10%;">Qty</th>
                            <th style="text-align: center;width: 20%;">Price</th>
                            <th style="text-align: center;width: 20%;">Total Amount</th>
                            </thead>
                            <tbody>


                                    <tr>
                                        <td style="text-align: center;">1</td>
                                        <td><?= $_POST['Variants'] ?></td>
                                        <td style="text-align: center;">1</td>
                                        <td style="text-align: center;"><?= $_POST['Price'] ?></td>
                                        <td style="text-align: right;"><?= $_POST['TotalPrice'] ?></td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <br/>
                <br/>
                <hr/>
                <div class="row">
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span4 text-right">
                                <span class="bold">Displacement :</span>
                            </div>
                            <div class="span8">
                                <span><?= $_POST['DisplacementName'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span4 text-right">
                                <span class="bold">Model :</span>
                            </div>
                            <div class="span8">
                                <span><?= $_POST['Model'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span4 text-right">
                                <span class="bold">Color :</span>
                            </div>
                            <div class="span8">
                                <span><?= $_POST['ColorName'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="span8">
                        <div class="row-fluid">
                            <div class="span4 text-right">
                                <span class="bold">Delivery :</span>
                            </div>
                            <div class="span8">
                                <span><?= $_POST['DeliveryMonth'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <br/>
            <div class="container border" style="width: 948px;">
                <br/>
                <div class="row">
                    <div class="span12 text-center">
                        <span style="font-size: 24px;" class="underline bold">SPECIAL NOTES</span>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="span2 text-right">
                                <span class="bold">Delivery :</span>
                            </div>
                            <div class="span10">
                                <span>Price are inclusive of Custom duty and Sales Tax</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="span2 text-right">
                                <span class="bold">Validity :</span>
                            </div>
                            <div class="span10">
                                <span>Prices are valid for 03 days.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="span2 text-right">
                                <span class="bold">Payment :</span>
                            </div>
                            <div class="span10">
                                <span>ADVANCE 100% IN FAVOUR OF INDUS MOTORS CO LTD A/C CUSTOMER NAME.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row-fluid" style="width: 90%;margin: auto;">
                    <div class="span12 text-center underline bold">
                        <span>Please note any changes in Government or INDUS MOTOR COMPANY LIMITED policy regarding Custom Duty, Sales Tax and any other government levies of whatsoever nature will be borne by the customer and price at the time of delivery shall be final.</span>
                    </div>
                </div>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="container" style="width: 948px;border-top: 1px solid black;">
                <div class="row-fluid">
                    <div class="span6 bold">
                        <span>Fazal Alavi<br/>Assistant Manager<br/>0300-2100667</span>
                    </div>
                    <div class="span6 bold text-right">
                        <span>Shahid Ali<br/>Manager Sales<br/>0300-2017778</span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>	


