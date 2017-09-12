<html>

    <head>
<style>
    .feildwrap select {
        width: 250px;
    }
	.feildwrap label {
    min-width: 185px;
    padding-right: 0;
    text-align: left;
}
.feildwrap div {
    width: 49%;
}
.right-pnel {
    width: 87% !important;
}
.feildwrap span {
    color: #545454 !important;
    line-height: 30px;
    font-weight: bold;
    margin: 0 0 0 10px;
    font-family: arial;
}
</style>
<?php
/*
 * Author: Umar Akbar
 * Date  : 18-02-2014
 */

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


<!--<html>

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

    <body>-->

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
        </head>
        <body>
<div id="wrapper">
    <div id="content">
        <div class="container" style="width: 948px;">
            <div class="row-fluid">
                <div class="span12 text-center">
                    <input type="button" value="Print" class="btn" onclick="PrintDoc()"/>
                    <input type="button" value="Print Preview" class="btn" onclick="PrintPreview()"/>
                </div>
            </div>
        </div>
          <div id="printArea">
            <br/><br/><br/>
                 <br/>
            <br/><br/><br/>
            <input type="text" name="PBO_Id" value="<?php echo $PBODetails['Id']; ?>" style="display: none">
            <div class="right-pnel" class="form validate-form animated fadeIn">

                <?php $ResourceBookId = $ResourceBook['IdResourceBook']; ?>

                
                <!-- Resource Book Details -->
                <div class="form validate-form animated fadeIn">
                    <div class="feildwrap">
                        <fieldset>
                            <legend>Customer Details</legend>
                            <div style="display: none;">
                                <label>Customer ID</label>
                                <span><?= $ResourceBook['IdCustomer'] ?></span>
                            </div>
                            <br>
                            <div>
                                <label>Salutation:<span><?php echo $ResourceBook['gender'] ?></span></label>
                                
                            </div>
                            <div>
                                <label>Customer Name:<span><?= $ResourceBook['CustomerName'] ?></span></label>
                                
                            </div>
                            <div>
                                <label>Name Of Invoice:<span><?php echo $ResourceBook['NameOfInvoice']; ?></span></label>
                                
                            </div>
                            <div>
                                <label>Father/Husband Name:<span style="width: 68px;"><?php echo $ResourceBook['genderType'] ?></span><span style="width: 180px;"><?= $ResourceBook['FatherName'] ?></span></label>
                                
                                
                            </div>
                            <div>
                                <label>Address:<span><?= $ResourceBook['AddressDetails'] ?></span></label>
                                
                            </div>
                            <div>
                                <label>Address 2:<span><?= $ResourceBook['AddressTwoDetails'] ?></span></label>
                                
                            </div>
                            <div>
                                <label>Name Of Business:<span><?php echo $ResourceBook['CompanyName'] ?></span></label>
                                
                            </div>
                            <div>
                                <label>Postal Code:<span><?php echo $ResourceBook['postal_code'] ?></span></label>
                                
                            </div>
                            <div>
                                <label>Name Of Individual:<span><?php echo $ResourceBook['NameOfIndividual'] ?></span></label>
                            </div>
                            <div>
                                <label>Province:<span><?php
                                echo form_dropdown('province', $province, $ResourceBook['Province'], 'disabled=disabled');
                                ?></span></label>
                            </div>
                            <div>
                                <label>City:<span><?php
                                echo form_dropdown('city', $city, $ResourceBook['City'], 'disabled=disabled');
                                ?></span></label>
                            </div>
                            <div>
                                <label>Residential Tel#:<span><?= $ResourceBook['Telephone'] ?></span></label>
                            </div>
                            <div>
                                <label>Mobile #:<span><?= $ResourceBook['Cellphone'] ?></span></label>
                            </div>
                            <div>
                                <label>Email:<span><?= $ResourceBook['Email'] ?></span></label>
                            </div>
                            <div>
                                <label>CNIC #:<span><?= $ResourceBook['Cnic'] ?></span></label>
                            </div>
                            <div>
                                <label>NTN #:<span><?= $ResourceBook['Ntn'] ?></span></label>
                            </div>

                            <div>
                                <label>Fax:<span><?php echo $ResourceBook['Fax'] ?></span></label>
                            </div>

                            <div>
                                <label>Email:<span><?php echo $ResourceBook['Email'] ?></span></label>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="form validate-form animated fadeIn">
                    <fieldset>
                        <legend>ResourceBook Details</legend>
                        <div class="feildwrap">
                            <div>
                                <label>Date:<span><?= $ResourceBook['Date'] ?></span></label>
                            </div>
                            <div>
                                <label>Contact Type:<span><?php echo form_dropdown('contact_type', $contact_type, $ResourceBook['ContactTypeId'], 'disabled=disabled') ?></span></label>
                            </div>
                            <div>
                                <label>Customer Type:<span><?php echo form_dropdown('customer_type', $customertype, $ResourceBook['CustomerTypeId'], 'disabled=disabled') ?></span></label>
                            </div>
                            <div>
                                <label>Model:<span><?php echo form_dropdown('model', $model, $ResourceBook['Model'], 'disabled=disabled') ?></span></label>
                            </div>
                            <div>
                                <label>Vehicle Interested:<span><?php echo form_dropdown('vehicle_interst', $vehicle_interst, $ResourceBook['VehicleInterested'], 'disabled=disabled') ?></span></label>           
                            </div>
                            <div>
                                <label>Mode Of Payment:<span><?php echo form_dropdown('payment_mode', $payment_mode, $ResourceBook['PaymentMode'], 'disabled=disabled'); ?></span></label>      
                            </div>
                            <div>
                                <label>Customer Status:<span><?php echo form_dropdown('customer_status', $customer_status, $ResourceBook['StatusType'], 'disabled=disabled') ?></span></label>     
                            </div>
                            <div style="display: none;">
                                <label>Follow Up</label>
                                <?php
                                if ($ResourceBook['FollowupStatus'] == 1) {
                                    echo "<input type='radio' value='1' name='follow_up' checked>7 Days
                            <input type='radio' value='2' name='follow_up' readonly>14 Days
                            <input type='radio' value='3' name='follow_up' readonly>21 Days
                            <input type='radio' value='4' name='follow_up' readonly>No";
                                } else if ($ResourceBook['FollowupStatus'] == 2) {
                                    echo "<input type='radio' value='1' name='follow_up' readonly>7 Days
                            <input type='radio' value='2' name='follow_up' checked readonly>14 Days
                            <input type='radio' value='3' name='follow_up' readonly>21 Days
                            <input type='radio' value='4' name='follow_up' readonly>No";
                                } else if ($ResourceBook['FollowupStatus'] == 3) {
                                    echo "<input type='radio' value='1' name='follow_up' readonly>7 Days
                            <input type='radio' value='2' name='follow_up' readonly>14 Days
                            <input type='radio' value='3' name='follow_up' checked readonly>21 Days
                            <input type='radio' value='4' name='follow_up' readonly>No";
                                } else {
                                    echo "<input type='radio' value='1' name='follow_up'>7 Days
                            <input type='radio' value='2' name='follow_up' readonly>14 Days
                            <input type='radio' value='3' name='follow_up' readonly>21 Days
                            <input type='radio' value='4' name='follow_up' checked readonly>No";
                                }
                                ?>
                            </div>
                            <div>
                                <label>Remarks:<span><?= $ResourceBook['Remarks'] ?></span></label>
                            </div>
                            <div>
                                <label>Delivery Month:<span><?= $ResourceBook['DeliveryMonth'] ?></span></label>
                            </div>
                            <div>
                                <label>Current Color:<span><?php
                                echo form_dropdown('color_choice_one', $color_choice_one, $ResourceBook['Color1'])
                                ?></span></label>     
                            </div>
                            <div>
                                <label>Previous Color:<span><?php
                                echo form_dropdown('color_choice_two', $color_choice_two, $ResourceBook['Color2']);
                                ?></span></label>          
                            </div>
                            <div>
                                <label>Time Consumed:<span><?= $ResourceBook['TimeConsumed'] ?></span></label>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <!-- Customer Details -->

                <div class="form validate-form animated fadeIn">

                    <fieldset>
                        <legend>Generate PBO</legend>
                        <fieldset>
                            <br>
                            <legend>Allocation and Order Type</legend>
                            <div class="feildwrap">
                                <table class="form-tbl">
                                    <tr>
                                        <td>
                                            <label>Allocation Type</label>
                                        </td>
                                        <td>
                                            <select name="allocation_type" id="allocationType">
                                                <?php
                                                foreach ($AllocationType as $Allocations) {
                                                    $idAllocation = $Allocations['Id'];
                                                    if ($idAllocation == $PBODetails['AllocationTypeId']) {
                                                        $select = 'selected="selected"';
                                                    } else {
                                                        $select = '';
                                                    }
                                                    ?>
                                                    <option value="<?= $Allocations['Id'] ?>" <?php echo $select ?>><?= $Allocations['AllocationType'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <label style=" width:90px; min-width:90px;">Month</label>
                                        </td>
                                        <td>
                                            <select name="allocation_month" id="allocationMonth">
                                                <option>Select Month</option>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Order Type</label>
                                        </td>
                                        <td>
                                            <select name="order_type">
                                                <option>Select Order Type</option>
                                                <?php
                                                foreach ($OrderType as $OType) {
                                                    $idOrderType = $OType['id'];
                                                    if ($idOrderType == $PBODetails['OrderTypeId']) {
                                                        $select = 'selected="selected"';
                                                    } else {
                                                        $select = '';
                                                    }
                                                    ?>
                                                    <option value="<?= $OType['id'] ?>" <?php echo $select ?> ><?= $OType['OrderType'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    <tr id="rowone">
                                        <td>
                                            <label>Cheque One</label>
                                        </td>

                                        <td colspan="3">
                                            <input type="text" name="ChequeOne" id="ChequeOne"/>
                                        </td>

                                    </tr>
                                    <tr id="bone">
                                        <td>
                                            <label>Bank Name</label>
                                        </td>

                                        <td colspan="3">
                                            <input type="text" name="BankOne" id="ChequeOne"/>
                                        </td>

                                    </tr>
                                    <tr id="bnone">
                                        <td>
                                            <label>Branch Name</label>
                                        </td>

                                        <td colspan="3">
                                            <input type="text" name="BranchOne" id="ChequeOne"/>
                                        </td>

                                    </tr>
                                    <tr id="btwo">
                                        <td>
                                            <label>Cheque Number</label>
                                        </td>

                                        <td colspan="3">
                                            <input type="text" name="Chequeoneno" id="Chequeoneno"/>
                                        </td>

                                    </tr>

                                    <td>
                                        <label id="lCustomerName">Customer Name</label>
                                        <input type="text" name="CustomerName" id="CustomerName"/> <br>
                                    </td>
                                    <td>
                                        <label id="lBankName">Bank Name</label>
                                        <input type="text" name="FBankName" id="FBankName"/> 
                                    </td>
                                    <td id="opt">
                                        <label>Lessor</label>
                                        <input type="Text" name="Lessor" id="Lessor" value="" style="float: left; height: 27px;"/>

                                    </td>
                                    <td>

                                    </td>
                                    <td id="Validity" style="margin-left: 105px;width: 270px;">

                                    </td>
                                    </tr>

                                </table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <br>
                            <legend>PBO Number</legend>
                            <div class="feildwrap">
                                <table class="form-tbl">
                                    <tr>
                                        <td id="PboNumberAvailability" style="margin-left: 201px;width: 270px;">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>PBO No:<?php echo $PBODetails['PboNumber']; ?><span></span></label>
                                        </td>
                                        <td>

                                            <span class="error-pbo pbo-error help-block">The Pbo You Entered is Already Exists. Please Change</span>
                                        </td>
                                        <td>
                                            <label>Actual Sale Person:<span><?php echo $PBODetails['ActualSalePerson']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Date:<span><?php echo $PBODetails['PboOpeningDate']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <br>
                            <legend>Vehicle Details</legend>
                            <div class="feildwrap">
                                <table class="form-tbl">
                                    <tr>
                                        <td>
                                            <label>Chasis No.</label>
                                        </td>
                                        <td>
                                            <input type="text" name="ChasisNo" id="efChasisNo"/>
                                            <select name="ChasisNumber" id="comboChasisNo">
                                                <option>Select Chasis Number</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label>Engine No.</label>
                                        </td>
                                        <td>
                                            <input type="text" name="EngineNo" id="efEngineNo"/>
                                            <select name="EngineNumber" id="comboEngineNo">
                                                <option>Select Engine Number</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <br>
                            <legend>Ex Factory Amount</legend>
                            <div class="feildwrap">
                                <table class="form-tbl">
                                    <tr>
                                        <td>
                                            <label>Type</label>
                                        </td>
                                        <td>
                                            <select id="efPO" name="efPO">

                                                <option value="Pay Order" <?php
                                                if ($PBODetails['ExFactoryPO'] == "Pay Order") {
                                                    print ' selected';
                                                }
                                                ?>>Pay Order</option>
                                                <option value="Demand Draft" <?php
                                                if ($PBODetails['ExFactoryPO'] == "Demand Draft") {
                                                    print ' selected';
                                                }
                                                ?>>Demand Draft</option>
                                                <option value="Cheque"  <?php
                                                if ($PBODetails['ExFactoryPO'] == "Cheque") {
                                                    print ' selected';
                                                }
                                                ?>>Cheque</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label>Number</label>
                                        </td>

                                        <td colspan="3">
                                            <input type="text" id="efPayOrder" name="payOrderNo" value="<?php echo $PBODetails['PayorderNumber']; ?>" style="margin-left: 10px;" readonly/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Bank Name:<span><?php echo $PBODetails['BankName']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <label>Bank Branch:<span><?php echo $PBODetails['BankBranch']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Bank City:<span><?php echo $PBODetails['BankCity']; ?></span></label>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Ex Factory Amount:<span><?= $ResourceBook['TotalPrice'] ?></span></label>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                        <td>
                                            <label>In Words Ex Factory:<span><?= convert_number_to_words($ResourceBook['TotalPrice']) ?></span></label>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <br>
                            <legend>WHT</legend>
                            <div class="feildwrap">
                                <table class="form-tbl">
                                    <tr>
                                        <td>
                                            <label>Filer:<span><?php echo ($PBODetails['FIType'] == "Filer" ? 'checked' : ''); ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <label>Non Filer:<span><?php echo ($PBODetails['FIType'] == "Non Filer" ? 'checked' : ''); ?></span></label>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Type</label>
                                        </td>
                                        <td>
                                            <select id="fiPO" name="fiPO" readonly="readonly"/>
                                                <option value="Pay Order" <?php
                                                if ($PBODetails['FIPO'] == "Pay Order") {
                                                    print ' selected';
                                                }
                                                ?>>Pay Order</option>
                                                <option value="Demand Draft" <?php
                                                if ($PBODetails['FIPO'] == "Demand Draft") {
                                                    print ' selected';
                                                }
                                                ?>>Demand Draft</option>
                                                <option value="Cheque"  <?php
                                                if ($PBODetails['FIPO'] == "Cheque") {
                                                    print ' selected';
                                                }
                                                ?>>Cheque</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label>Number:<span><?php echo $PBODetails['PboSerialNumber']; ?></span></label>
                                        </td>
                                        <td colspan="4">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Bank Name:<span><?php echo $PBODetails['FIBankName']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <label>Bank Branch:<span><?php echo $PBODetails['FIBankBranch']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Bank City:<span><?php echo $PBODetails['FIBankCity']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>

                                    <tr id="wht">
                                        <td>
                                            <label>WHT:<span><?= $Filer['WHTFiler'] ?></span></label>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                        <td>
                                            <label>In Words WHT:<span><?= convert_number_to_words($Filer['WHTFiler']) ?></span></label>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <br>
                            <legend>Purchase Order</legend>
                            <div class="feildwrap">
                                <table class="form-tbl">
                                    <tr>
                                        <td>
                                            <label>Purchase Order Number:<span><?php echo $PBODetails['PurchaseOrderNumber']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <label>Date:<span><?php echo $PBODetails['PurchaseDate']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                        <fieldset>
                            <br>
                            <legend>PBO Serial</legend>
                            <div class="feildwrap">
                                <table class="form-tbl">
                                    <tr>
                                        <td>
                                            <label>PBO Serial Number:<span><?php echo $PBODetails['PboSerialNumber']; ?></span></label>
                                        </td>
                                        <td>
                                        </td>
                                        <td id="SerialAvailability" class="serial" style="margin-left: 105px;width: 270px;">

                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                        <table class="form-tbl" style="margin-left: 90px;">
                            <tr style="display:none;">
                                <td>
                                    <label>Resource Book ID</label>
                                </td>
                                <td colspan="3">
                                    <input type="text" data-validation="required" id="idRb" name="idRes" value="<?= $ResourceBookId ?>"
                                           readonly=""/>
                                    <input type="text" data-validation="required" name="variantId" value="<?= $ResourceBook['VehicleInterested'] ?>"
                                           readonly=""/>
                                    <input type="text" data-validation="required" name="colorId" value="<?= $ResourceBook['Color1'] ?>"
                                           readonly=""/>
                                </td>

                            </tr>
                            <?php
                            if($PBODetails['PayorderImage']!=null){
                            ?>

                            <tr>
                                <td>
                                    <label>Image Upload P.B.O.</label>
                                </td>
                                <td colspan="3">


                                    <img src="<?php echo base_url() . "upload/" . $PBODetails['PayorderImage'] ?>" width="50px" height="50px">

                                </td>
                            </tr>
                            <?php }
                            ?>
                        </table>                       
                    </fieldset>

                </div>
            </div>
        </div>
    </div>
</div>
         </body>
</html>

<script>

    var PBODetails = JSON.parse('<?php echo json_encode($PBODetails); ?>');
    console.log(PBODetails.AllocationMonth);
    var amount = $("#amount").val();
    var wordamount = $("#efAmountInWords").val();
    var wht = $("#wht").val();
    $(document).ready(function () {

//    console.log(PBODetails);
        $("#rowone").hide();
        $("#rowtwo").hide();
        $("#rowthree").hide();
        $("#bone").hide();
        $("#bnone").hide();
        $("#btwo").hide();
        $("#bntwo").hide();
        $("#bthree").hide();
        $("#bnthree").hide();
        $('#CustomerName').hide();
        $('#FBankName').hide();
        $('#lCustomerName').hide();
        $('#lBankName').hide();
        $('#opt').hide();
        allocationType();
    });
    $("#allocationType").change(function () {
        allocationType();
    });
    function allocationType() {
        $('#CustomerName').hide();
        $('#FBankName').hide();
        $('#lCustomerName').hide();
        $('#lBankName').hide();
        $('#opt').hide();
        var AllocationType = $("#allocationType").val();
        var AllocationColor = $("select[name=color_choice_one]").val();
        var AllocationMonth = $("select[name=vehicle_interst]").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/generatepbo/getallocationmonth",
            type: "POST",
            data: {idAllocationType: AllocationType, idColor: AllocationColor, idVariant: AllocationMonth},
            success: function (data) {
                var a = JSON.parse(data);
//                console.log(JSON.parse(data));
                if (a.length > 0) {
                    try {
//                        var items = "<option>Select Month</option>";
                        $.each(a, function (i, val) {

                            var selection2 = val.Month == PBODetails.AllocationMonth ? 'selected' : '';
//                html += '<option value="' + arrSalePerson[i].idsalePerson + '"' + selection2 + '>' + arrSalePerson[i].nameSalePerson + '</option>';

                            items += "<option value='" + val.Month + "'" + selection2 + ">" + val.Month + "</option>";
                        });
                        $('#allocationMonth').html(items);
                    }
                    catch (e) {
                        console.log(e);
                    }
                } else {
                    var items = "<option>Select Month</option>";
                    $('#allocationMonth').html(items);
                }
            }
        });
        if (AllocationType == '9')
        {
            $('#CustomerName').show();
            $('#FBankName').show();
            $('#lCustomerName').show();
            $('#lBankName').show();
            $('#opt').show();

        }
    }


    $("#allocationMonth").change(function () {
        var AllocationType = $("#allocationType").val();
        var AllocationColor = $("select[name=color_choice_one]").val();
        var AllocationVariant = $("select[name=vehicle_interst]").val();
        var AllocationMonth = $("select[name=allocation_month]").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/generatepbo/AllocationValidity",
            type: "POST",
            data: {idAllocationType: AllocationType, idColor: AllocationColor, idVariant: AllocationVariant, Month: AllocationMonth},
            success: function (data) {

//                console.log(data);
                if (data == 'Expired') {
                    $('#Validity').html("<h4 style='background-color: maroon;color: white;'>Allocation Validity Has Been Expired!</h4>");
                } else if (data == 'No Balance') {
                    $('#Validity').html("<h4 style='background-color: maroon;color: white;'>No Balance Quantity Available!</h4>");
                } else {
                    $('#Validity').html("<h4 style='background-color: green;color: white;'>" + data + " Quantity Available!</h4>");
                    //                    console.log(data);
                }
            }
        });
    });
    $('select[name=order_type]').change(function () {
        $('#CustomerName').hide();
        $('#FBankName').hide();
        $('#lCustomerName').hide();
        $('#lBankName').hide();
        $('#opt').hide();
        var OrderType = $('select[name=order_type] :selected').text();
        var AllocationColor = $("select[name=color_choice_one]").val();
        var AllocationVariant = $("select[name=vehicle_interst]").val();
        if (OrderType == "Credit") {
//            $("#efEngineNo").attr('disabled', false);
//            $("#efChasisNo").attr('disabled', false);
            $('#efChasisNo').hide();
            $('#efEngineNo').hide();
            $('#comboChasisNo').show();
            $('#comboEngineNo').show();
            $.ajax({
                url: "<?= base_url() ?>index.php/generatepbo/OpenStock",
                type: "POST",
                data: {idColor: AllocationColor, idVariant: AllocationVariant},
                success: function (data) {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var engine = "<option>Select Engine Number</option>";
                            var chasis = "<option>Select Chasis Number</option>";
                            $.each(a, function (i, val) {
                                engine += "<option value='" + val.EngineNo + "'>" + val.EngineNo + "</option>";
                                chasis += "<option value='" + val.ChasisNo + "'>" + val.ChasisNo + "</option>";
                            });
                            $('#comboEngineNo').html(engine);
                            $('#comboChasisNo').html(chasis);
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
                        var engine = "<option>Select Engine Number</option>";
                        var chasis = "<option>Select Chasis Number</option>";
                        $('#comboEngineNo').html(engine);
                        $('#comboChasisNo').html(chasis);
                    }
                }
            });
        } else if (OrderType == "Against Open Stock") {
            $('#efChasisNo').hide();
            $('#efEngineNo').hide();
            $('#comboChasisNo').show();
            $('#comboEngineNo').show();
            $.ajax({
                url: "<?= base_url() ?>index.php/generatepbo/OpenStock",
                type: "POST",
                data: {idColor: AllocationColor, idVariant: AllocationVariant},
                success: function (data) {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var engine = "<option>Select Engine Number</option>";
                            var chasis = "<option>Select Chasis Number</option>";
                            $.each(a, function (i, val) {
                                engine += "<option value='" + val.EngineNo + "'>" + val.EngineNo + "</option>";
                                chasis += "<option value='" + val.ChasisNo + "'>" + val.ChasisNo + "</option>";
                            });
                            $('#comboEngineNo').html(engine);
                            $('#comboChasisNo').html(chasis);
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
                        var engine = "<option>Select Engine Number</option>";
                        var chasis = "<option>Select Chasis Number</option>";
                        $('#comboEngineNo').html(engine);
                        $('#comboChasisNo').html(chasis);
                    }
                }
            });
        } else {
            $('#efChasisNo').show();
            $('#efEngineNo').show();
            $('#comboChasisNo').hide();
            $('#comboEngineNo').hide();
        }
//    } else {
//    $("#efEngineNo").attr('disabled', 'disabled');
//            $("#efChasisNo").attr('disabled', 'disabled');
//    }


        if (OrderType == 'Partial Payment')
        {

            $("#rowone").show();
            $("#rowtwo").show();
            $("#rowthree").show();
            //$("#amount").val("");
            $("#efAmountInWords").val("");
            $("#wht").show();
            $("#Freightamount").val("0");
            $("#bone").show();
            $("#bnone").show();
            $("#btwo").show();
            $("#bntwo").show();
            $("#bthree").show();
            $("#bnthree").show();
        }
        else
        {
            $("#rowone").hide();
            $("#rowtwo").hide();
            $("#rowthree").hide();
            $("#bone").hide();
            $("#bnone").hide();
            $("#btwo").hide();
            $("#bntwo").hide();
            $("#bthree").hide();
            $("#bnthree").hide();
            $("#amount").val(amount);
            $("#efAmountInWords").val(wordamount);
            $("#wht").show();
            $("#wht").val(wht);
        }

        if (OrderType == 'Financing')
        {
            $('#CustomerName').show();
            $('#FBankName').show();
            $('#lCustomerName').show();
            $('#lBankName').show();
            $('#opt').show();

        }

    });
    $("input[name=PboSerial]").keyup(function () {
        var SerialNumber = $("input[name=PboSerial]").val();
        console.log(SerialNumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/generatepbo/CheckPboSerial",
            type: "POST",
            data: {PboSerial: SerialNumber},
            success: function (data) {
                console.log(data);
                if ($("input[name=PboSerial]").val() != "") {
                    $("#SerialAvailability").show();
                    if (data == 'Available') {
                        $('#SerialAvailability').html("<h4 style='background-color: green;color: white;'>Available!</h4>");
                    } else {
                        $('#SerialAvailability').html("<h4 style='background-color: maroon;color: white;'>Already Exists in Database!</h4>");
                    }
                } else {
                    $("#SerialAvailability").hide();
                }
            }
        });
    });
    $("input[name=PboNumber]").keyup(function () {
        var PboNumber = $("input[name=PboNumber]").val();
//        console.log(PboNumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/generatepbo/CheckPboNumber",
            type: "POST",
            data: {PboNumber: PboNumber},
            success: function (data) {
//                console.log(data);
                if ($("input[name=PboNumber]").val() != "") {
                    $("#PboNumberAvailability").show();
                    if (data == 'Available') {
                        $('#PboNumberAvailability').html("<h4 class='pbocheck' style='background-color: green;color: white;'>Available!</h4>");
                    } else {
                        $('#PboNumberAvailability').html("<h4 class='pbocheck' style='background-color: maroon;color: white;'>Already Exists in Database!</h4>");
                    }
                } else {
//                    alert('asdf');
                    $("#PboNumberAvailability").hide();
                }
            }
        });
    });






    //ExFactory Payorder - Freigth Insurance Payorder
    $("#efPayOrder").keyup(function () {
        $("#fiPayOrder").val($(this).val());
    });
    //ExFactory Bank City - Freigth Insurance Bank City
    $("#efBankCity").keyup(function () {
        //$("#fiBankCity").val($(this).val());
    });
    //ExFactory Bank Branch - Freigth Insurance Bank Branch
    $("#efBankBranch").keyup(function () {
        //$("#fiBankBranch").val($(this).val());
    });
    //ExFactory Bank Name - Freigth Insurance Bank Name
    $("#efBankName").keyup(function () {
        //$("#fiBankName").val($(this).val());
    });
    //ExFactory Engine No - Freigth Insurance Engine No
    $("#efEngineNo").keyup(function () {
        $("#fiEngineNo").val($(this).val());
    });
    //ExFactory Chasis No - Freigth Insurance Chasis No
    $("#efChasisNo").keyup(function () {
        $("#fiChasisNo").val($(this).val());
    });

    function validationform() {
        var pbocheck = $('.pbocheck').text();
        if (pbocheck == "Already Exists in Database!") {
            $(".error-pbo").show();
            console.log(pbocheck);
            return false;
        } else {
            return true;
        }
    }


    $('select[name=efPO]').change(function () {

        var efPOType = $('select[name=efPO] :selected').text();


    });

    $("input[name='Filer']").click(function () {
        if ($(this).is(':checked')) {
            value = $(this).val();
            if (value == "Filer") {
                //   $("#Freightamount").val('3500');
                var filer = '<?= $Filer['WHTFiler'] ?>';
                $("#Freightamount").val(filer);
            }
            else {
                //  $("#Freightamount").val('5000');
                var Nfiler = '<?= $NFiler['WHTNFiler'] ?>';
                $("#Freightamount").val(Nfiler);
            }
        }
    });

</script>