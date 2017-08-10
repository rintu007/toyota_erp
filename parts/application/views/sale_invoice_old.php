<?php
function convert_number_to_words($number) {
    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = array(
        0 => 'Zero',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Fourty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety',
        100 => 'Hundred',
        1000 => 'Thousand',
        1000000 => 'Million',
        1000000000 => 'Billion',
        1000000000000 => 'Trillion',
        1000000000000000 => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    return $string;
}

?>

<html>

    <head>
        <link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css>
        <script type="text/javascript">
            /*--This JavaScript method for Print command--*/
            function PrintDoc() {
                var toPrint = document.getElementById('printArea');
                var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
                popupWin.document.open();
                popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?= base_url(); ?>assets/css/style.css><link rel=Stylesheet href=<?= base_url(); ?>assets/bootstrap/css/bootstrap.css><link rel=Stylesheet href=<?= base_url(); ?>assets/css/stylesheet.css></head><body onload="window.print()">');
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
    <pre>
 <!--       <?php         print_r($SaleInvoice);
    ?> -->

        </pre>
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
            <div class="col-sm-6 col-xs-6 pull-left"><div class="toyota-logo"><img src="<?= base_url(); ?>assets/images/toyota.PNG"></div></div>
            <div class="col-sm-6 col-xs-6 pull-right"><div class="daihatsu-logo"><img src="<?= base_url(); ?>assets/images/daihaisu-logo.PNG"></div></div>
        </div><!--report-header end -->

        <div class="full-grid text-center gray-bg"><h4>INDUS MOTOR COMPANY LIMITED</h4></div>
        <div class="full-grid text-center gray-bg"><h4>INVOICE <small>cum sales tax invoice (Original)</small></h4></div>




        <div class="table-responsive report-table">
            <table class="table customer-details">
                <thead>
                <tr>
                    <th>Customer Details</th>
                    <th>&nbsp;</th>
                    <th>IMC Details : </th>
                    <th class="text-right">(IMPORTED PARTS)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Customer Code :</td>
                    <td><strong>300031</strong></td>
                    <td>Invoice No. :</td>
                    <td><strong>91573161</strong></td>
                </tr>
                <tr>
                    <td>Customer Name :</td>
                    <td><strong>TOYOTA WESTERN MOTORS</strong></td>
                    <td>Invoice Date : </td>
                    <td><strong>13.01.2015</strong></td>
                </tr>
                <tr>
                    <td>Address :</td>
                    <td><strong>C-38, ESTATE AVENUE S.I.T.E. KARACHI</strong></td>
                    <td>Delivery Note No. :</td>
                    <td><strong>80901606</strong></td>
                </tr>
                <tr>
                    <td>PO Number :</td>
                    <td><strong>TWM WOT</strong></td>
                    <td>Delivery Note Date :</td>
                    <td><strong>91573161</strong></td>
                </tr>
                <tr>
                    <td>PO Date :</td>
                    <td><strong>01.01.2015</strong></td>
                    <td>Order No. :</td>
                    <td><strong>271238</strong></td>
                </tr>
                <tr>
                    <td>STRN :</td>
                    <td><strong>119000763</strong></td>
                    <td>Order Date :</td>
                    <td><strong>12.01.201</strong></td>
                </tr>
                <tr>
                    <td>NTN :</td>
                    <td><strong>119000763</strong></td>
                    <td><strong>Ord. Reason :</strong></td>
                    <td><strong>Warrenty Order</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><strong>STRN. :</strong></td>
                    <td><strong>02-04-8703-001-55</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><strong>NTN :</strong></td>
                    <td><strong>0676546-7</strong></td>
                </tr>
                </tbody>
            </table>
        </div>




        <div class="row">
            <div class="span12 text-center bold underline">
                <span class="" style="font-size: 24px;">Sale Invoice</span>
            </div>
        </div>
        <br/>
        <br/>

        <!--                <div class="row">
            <div class="span4">
                <div class="row-fluid">
                    <div class="span4 text-right">
                        <span class="bold">Attn :</span>
                    </div>
                    <div class="span8">
                        <span >Name</span>
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
        </div>-->

        <!--                <div class="row">
                            <div class="span4">
                                <div class="row-fluid">
                                    <div class="span4 text-right">
                                        <span class="bold">M/S :</span>
                                    </div>
                                    <div class="span8">
                                        <span >Bank Name</span>
                                    </div>
                                </div>
                            </div>
                            <div class="span8">
                                <div class="row-fluid">
                                    <div class="span6 text-right">
                                        <span class="bold">Reference#:</span>
                                    </div>
                                    <div class="span6">
                                        <span> Reference </span>
                                    </div>
                                </div>
                            </div>
                        </div>-->

        <div class="row">
            <div class="span4">
                <div class="row-fluid">
                    <div class="span4 text-right">
                        <span class="bold">Invoice Number:</span>
                    </div>
                    <div class="span8">
                        <span> <?= $SaleInvoice[0]["InvoiceNumber"]?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span4">
                <div class="row-fluid">
                    <div class="span4 text-right">
                        <span class="bold">Date:</span>
                    </div>
                    <div class="span8">
                        <span> <?= $SaleInvoice[0]["SaleDate"]?></span>
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
                        <span><?= $SaleInvoice[0]["CustomerName"]?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid report-table">
            <div class="span12 text-center">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <th>S No.</th>
                        <th>Part Number</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total Amount</th>
                        </thead>
                        <tbody>
                        <?php
                        //                                $count = 1;
                        //                                foreach ($Quotation as $quotation) {
                        ?>
                        <tr>
                            <td>1</td>
                            <td> <?=$SaleInvoice[0]["PartNumber"]?> </td>
                            <td>Rs. <?=$SaleInvoice[0]["SaleQuantity"]?> </td>
                            <td>Rs. <?=$SaleInvoice[0]["SalePrice"]?> </td>
                            <td>Rs. <?=$SaleInvoice[0]["TotalPrice"]?> </td>
                            <!--<td style="text-align: center;"> <?=$SaleInvoice[0]["PartNumber"]?> </td>-->
                        </tr>
                        <?php
                        //                                }
                        ?>

                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr class="total-amount">
                            <td width="140px">Amount in Words :</td>
                            <td>&nbsp;</td>
                            <td>1</td>
                            <td>1200.00</td>
                            <td>1200.00</td>
                        </tr>

                        <tr>
                            <td colspan="5" style="border-bottom:1px solid #dfdfdf;"><strong>Rs. <?php echo convert_number_to_words($SaleInvoice[0]["TotalPrice"]);?> ONLY</strong> </td>
                        </tr>
                        </tbody>
                    </table>



                </div>




                <p>-Extra sales tax applied as per Chapter XIII of Sales Tax Special Procedure Rules, 2007 on imported auto parts and accessories.</p>



                <p>-We are EXEMPT from witholding Income Tax on these IMPORTED Supplies Under Section 153 (5) of the Income Tax Ordinance, 2001. </p>



                <p>-We are also EXEMPT from witholding Sales Tax on these Imported Supplies Under Rules 5 (XI) of sales tax special procedure (witholding) Rule, 2007. </p>



                <div class="full-grid gray-bg text-center">This is computer generated invoice and do not require any stamp or signature </div>

                <p><span>Head Office :</span>
                    Factory/Registered Office: Plot No:N.W.Z./P-1, Port Qasim Authority, Karachi. Phones:(92-21)34720041-48 Fax:(92-21)34720037</p>



                <p><span>Islamabad Office :</span>
                    Islamabad Office : 1-b 1st floor, Awan Arcade, Nazimuddin Road, Islamabad. Phones:(92-42)2810300-01, Fax:(92-51)2810302</p>



                <p><span>Lahore Office :</span>
                    9Z, Commercial Area, Phase III, DHA Lahore Cantt. Phones:(92-42)35743582</p>


            </div>
        </div>

        <br/>
        <br/>
        <hr/>
        </div>    </body>
</html>	


