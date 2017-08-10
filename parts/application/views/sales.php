<div id="wrapper">
    <div id="content">
        <?php
        //         $cookieData = unserialize($_COOKIE['logindata']);
        //        if ($cookieData['isAdmin'] == 1) {
        include 'include/sale_leftmenu.php';
        //        } else {
        //            include 'include/leftmenu.php';
        //        }
        ?>
        <div class="right-pnel">
            <?= $message ?>
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/sales/add" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Sale Items</legend>
                    <div class="feildwrap" id="Local">
                        <div>
                            <label>Sale Type</label>
                            <select id="idSaleType" name="idSaleType">
                                <option>Select Sale Type</option>
                                <!--<option value="Cash">Cash</option>-->
                                <?php
                                foreach ($SaleType as $InventorySaleType) {
                                    $idSaleType = $InventorySaleType['idSaleType'];
                                    ?>
                                    <option value="<?= $InventorySaleType['idSaleType'] ?>" ><?= $InventorySaleType['SaleType'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <span class="error-saletype cb-error help-block" style="margin-left: 275px;margin-top: -70px">Select Option!</span>
                        </div>
                        <!--<div>
                            <label>Customer Name</label>
                            <select id="idParty" name="idParty">
                                <option>Select Customer</option>
                                <?php
                                //foreach ($Party as $InventoryParty) {
                                    //$idParty = $InventoryParty['idParty'];
                                    ?>
                                    <option value="<? //$InventoryParty['idParty'] ?>" ><? // $InventoryParty['Name'] ?></option>
                                <?php
                                //}
                                ?>
                            </select>
                            <span class="error-customer cb-error help-block" style="margin-left: 275px;margin-top: -70px">Select Option!</span>
                        </div>-->
						<div id="CusName">
                            <label>Customer Name</label>
                            <input type="text" name="idParty" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
						<div id="CusNtn" style="">
                            <label>Customer NTN</label>
                            <input type="text" name="Ntn" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <!--<div id="CusName" style="">
                            <label>Customer Name</label>
                            <input type="text" name="CustomerName" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>-->
						<div id="Cusstrn" style="">
                            <label>Customer STRN</label>
                            <input type="text" name="strn" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <div id="CusJobber" style="">
                            <label>Customer Name</label>
                            <select id="jb" name="jb">
                                <option>Select Customer</option>
                                <?php
                                foreach ($Jobber as $J) {
                                    //   $idParty = $InventoryParty['idParty'];
                                    ?>
                                    <option value="<?= $J['idcustomer'] ?>" ><?= $J['name'] ." & ". $J['mobile'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div id="CusFleet" style="">
                            <label>Customer Name</label>
                            <select id="fl" name="fl">
                                <option>Select Customer</option>
                                <?php
                                foreach ($Fleet as $F) {
                                    //  $idParty = $InventoryParty['idParty'];
                                    ?>
                                    <option value="<?= $F['idcustomer'] ?>" ><?= $F['name'] ." & ".  $F['mobile'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="MobNumber" style="">
                            <label>Mobile Number</label>
                            <input type="text" name="MobileNumber" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>

                        <div id="CusAdd" style="">
                            <label>Customer Address</label>
                            <input type="text" name="CustomerAddress" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <div id="PhNumber" style="">
                            <label>Phone Number</label>
                            <input type="text" name="PhNumber" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <div>
                            <label>Sale Date</label>
                            <input type="text" class="date" name="SaleDate" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <div>
                            <label>Invoice Number</label>
                            <input type="text" name="InvoiceNumber" readonly value="<?php echo "TWM-INV-". $InvoiceNumber ?>" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
                        <div>
                            <label>Invoice Date</label>
                            <input type="text" class="date" name="InvoiceDate" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div><br>
                        <div>
                            <label>Payment Mode</label>
                            <select id="PaymentMode" name="PaymentMode">
                                <option>Select Mode</option>
                                <?php
                                foreach ($paymentMode as $key) {
                                    ?>
                                    <option value="<?= $key['PaymentType'] ?>" ><?= $key['PaymentType'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <span class="error-paymenttype cb-error help-block" style="margin-left: 250px;margin-top: 05px">Select Option!</span>
                        </div>
                        <div>
                            <label>Discount</label>
                            <input id="TotalDiscount" name="TotalDiscount" type="number" value="0" onkeyup="if (parseInt(this.value) < 0)
                                        return false;" style="width:100px;">&nbsp;PKR
                        </div>
						<div>
                            <label>Surcharge</label>
                            <input id="TotalSurcharge" name="TotalSurcharge" type="number" value="0" onkeyup="if (parseInt(this.value) < 0)
                                        return false;" style="width:100px;">&nbsp;PKR
                        </div>
                        <div class="btn-block-wrap dg" id="tbl-Sale">
                            <table id="salesTable" width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                <tr>
                                    <th width="02%">No.</th>
                                    <th width="13%">Part Number</th>
                                    <th width="08%">Qty In Stock</th>
                                    <th width="10%">PartName</th>
                                    <th width="10%">Req.Qty</th>
                                    <th width="12%">Unit Price</th>
                                    <th width="08%">Total Price</th>
                                    <th width="06%">Cost Price</th>
                                    <th width="06%">Total Cost</th>
                                    <th width="06%">Close</th>
                                </tr>
                                </thead>
                                <span style="background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRow">+</span>
                                <tbody id="SaleItems">
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><button id="OKButton" type="button" class="btn btn-block-wrap" style="margin-left: 15px;width: 50px;">OK</button></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div><br>
                    </div><br>
                    <div id='POSDiv' class="feildwrap" style="margin-left: 10px;">
                        <div id="TotalAmountDiv" class="feildwrap">
                            <label>Total Cost Price</label>
                            <input id="NetTotalCost" name="NetTotalCost" type="text" value="" style="width: 100px;margin-left: 10px;" readonly>
                        </div><br>
                        <div id="TotalAmountDiv" class="feildwrap">
                            <label>Net Amount</label>
                            <input id="TotalAmount" name="TotalAmount" type="text" value="" style="width: 100px;margin-left: 10px;" readonly>
                        </div><br>
                        <div>
                            <label>Enter Payment Received</label>
                            <input id="PaymentReceived" name="PaymentReceived"  type="number" min="0" value="0" onkeyup="if (parseInt(this.value) < 0)
                                        return false;" style="width: 100px;margin-left: 10px;">
                        </div>
                        <div style="">
                            <span onclick="checkBalance()" style="margin-left: 10px;float:right;font-weight: bolder;font-size: larger">OK</span>
                        </div><br>
                        <div id="PayDiv">
                            <span id="PayStatus"></span>
                        </div>
                        <div id="BalanceDiv" style="margin-left: 10px;">
                            <label>Balance</label>
                            <input id="Balance" type="text" name="Balance" placeholder="Balance" value=0 style="width: 100px;" readonly>
                            <span id="BalStatus"></span>
                        </div><br><br>
                        <div id="CheckRODiv" style="width: 600px;">

                        </div>
                    </div>
                    <div id="AddSaleButtonDiv" class="">
                        <input id="AddSaleButton" type="Submit" class="btn" value="Done" style="width: 125px;margin-left: 210px;">
                    </div><br>
                </fieldset>
            </form><div id="test"></div>
        </div>
    </div>
</div>
<script>

$(document).ready(function () {
    $('#PayDiv').hide();
    $('#POSDiv').hide();
    $('#BalanceDiv').hide();
    $('#AddSaleButtonDiv').hide();
    $('#CusName').show();
    $('#CusFleet').hide();
    $('#CusJobber').hide();
    $('#MobNumber').show();
    $("#idSaleType").change(function () {
        if ($("#idSaleType :selected").text() === "Cash") {
            $('#CusName').show();
            $('#MobNumber').show();
            $('#PhNumber').show();
            $('#CusAdd').show();
            $('#CusFleet').hide();
            $('#CusJobber').hide();
        } else if($("#idSaleType :selected").text() === "Jobber"){
            $('#CusName').hide();
            $('#MobNumber').hide();
            $('#PhNumber').hide();
            $('#CusAdd').hide();
            $('#CusFleet').hide();
            $('#CusJobber').show()

        }else if($("#idSaleType :selected").text() === "FLEET "){
            $('#CusName').hide();
            $('#MobNumber').hide();
            $('#PhNumber').hide();
            $('#CusAdd').hide();
            $('#CusFleet').show();
            $('#CusJobber').hide()

        }
    });
});
var icount = 0;
$("#newRow").click(function (e) {
    icount++;
    var items = "";
    items += "<tr class='tblPurchaseForce'>" +
        "<td class='tbl-count'>"+icount+"</td>" +
        "<td class='tbl-part'><select onchange=getPart(this) class='chosen-select' name='parts[]' style=' width:130px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'>" +
        "<option>Slct Part Num</option><?php foreach ($Parts as $AllPart) { ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartNumber'] ?></option><?php } ?></select></td>" +
        "<td class='tbl-qtyinstock'><input type='text' name='qtyinstock[]' style='width:50px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='qtyinstock' placeholder='Stk Qty' readonly></td>" +
        "<td class='tbl-description'><input type='text' name='description[]' style='width: 165px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='PartName' readonly></td>" +
        "<td class='tbl-quantity'><input type='text' onkeyup=totalprice(this) name='quantity[]' style='width: 55px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Req.Qty' ></td>" +
        "<td class='tbl-price'><input value='0' type='text' name='unitprice[]' style='width: 50px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Price' placeholder='UnitPrice' readonly></td>" +
        "<td class='tbl-actualcost'><input value='0' type='text' name='totalprice[]' style='width: 75px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='ActualCost' placeholder='TotalPrice' readonly></td>" +
        "<td class='tbl-price'><input value='0' type='text' name=costprice[]' style='width: 70px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Price' placeholder='ActualCost' readonly></td>" +
        "<td class='tbl-totalcost'><input value='0' type='text' name='totalcost[]' style='width: 50px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='totalcost' placeholder='TotalCost' readonly></td>" +
        "<td><button style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 12px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' onclick='delJobRow(this)'>X</button></td>" +
        "</tr>";
    $('#SaleItems').append(items);
    $("select[name='parts[]']").chosen({no_results_text: "Oops, nothing found!"});

});

$('#OKButton').click(function () {

    var tds = $('#salesTable tr td:nth-last-child(4) input');
    var allCosts = $('#salesTable tr td:nth-last-child(2) input');
    var sum = 0;
    var costValue = 0;
    var totalDiscount = 0;
    var DiscountedValue = 0;
	var totalSurcharge = 0;
    var totalSurcharge = 0;
    for (var i = 0; i < tds.length; i++) {
        sum = sum + parseInt(tds[i].value);
    }
    for (var i = 0; i < allCosts.length; i++) {
        costValue = costValue + parseInt(allCosts[i].value);
    }
    totalDiscount = $('#TotalDiscount').val();
    if (totalDiscount !== 0) {
        //   totalDiscount = (totalDiscount) / (100);
        DiscountedValue = totalDiscount;
        sum = sum - DiscountedValue;
    } else {
        console.log('No Dis');
    }
	if (totalSurcharge !== 0) {
        //   totalDiscount = (totalDiscount) / (100);
        SurchargeValue = totalSurcharge;
        sum = sum + SurchargeValue;
    } else {
        console.log('No Sur');
    }
    if (sum < costValue) {
        $('#NetTotalCost').css({"backgroundColor": "red"});
        $('#TotalAmount').css({"backgroundColor": "red"});
        alert('You are Saling below to your COST Price, kindly review the discount and press OK');
    } else {
        $('#NetTotalCost').css({"backgroundColor": "white"});
        $('#TotalAmount').css({"backgroundColor": "white"});
    }
    $('#POSDiv').show();
    $('#NetTotalCost').val(costValue);
    $('#TotalAmount').val(sum);
});

function totalprice(Source) {
    var Quantity = $(Source).val();
    var PerUnitPrice = $(Source).closest('td').next('td').find('input').val();
    var PerUnitCostPrice = $(Source).closest('td').next('td').next('td').next('td').find('input').val();
    var TotalPrice = Quantity * PerUnitPrice;
    var TotalCost = Quantity * PerUnitCostPrice;
    $(Source).closest('td').next('td').next('td').find('input').val(TotalPrice);
    $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val(TotalCost);
}

function getPart(Source) {
    idPart = $(Source).val();
    $.ajax({
        url: "<?= base_url() ?>index.php/purchase/getpartdetails",
        type: "POST",
        data: {idPart: idPart},
        success: function (data) {

            if (data !== "null")
            {
             $("#test").html(JSON.stringify(data));
                var a = JSON.parse(data);
                if (a.length > 0) {
                    if (a[0]['QtyInStock'] === '0') {
                        alert('This Part is Not Available in the Stock !');
                    } else {

                        $.each(a, function (i, val) {
                            $(Source).closest('td').next('td').find('input').val(val.QtyInStock);
                            $(Source).closest('td').next('td').next('td').find('input').val(val.PartName);
                            $(Source).closest('td').next('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val(val.RetailPrice);
                            $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val(val.CostPrice);
                            $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val();
                        });
                    }
                }
            }
            else {
            }
        }
    });
//        $(Source).closest('td').next('td').find('input').val('Desccc');
//        $(Source).closest('td').next('td').next('td').find('input').val('Qtyy');
//        $(Source).closest('td').next('td').next('td').next('td').find('input').val('Pricesss');
//        $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val('Disc');
    //        $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').find('input').val('Act Pri'); //        $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val('Land Val..');
}
//Finance Function
function isNull(value) {
    if (value === "") {
        return 0;
    } else {
        return value;
    }
}

function checkBalance() {
    var Receivable = $('#TotalAmount').val();
    var paymentReceived = $('#PaymentReceived').val();
    if (paymentReceived >= 0) {
        var balance = paymentReceived - Receivable;
        if (balance >= 0) {
            $('#BalanceDiv').show();
            $('#Balance').val(balance);
            $('#DoneBtn').show();
            $('#BalStatus').html('  Payment is Cleared');
        } else {
            if (balance < 0) {
                $('#BalanceDiv').show();
                $('#Balance').val(balance);
                $('#DoneBtn').show();
                $('#BalStatus').html('  Payment is Not Cleared');
            }
        }
        $('#AddSaleButtonDiv').show();
    }
    else {
        if (paymentReceived < 0) {
            $('#PayDiv').show();
            $('#PayStatus').html('  Enter Valid Amount');
        }
    }

}

function delJobRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById('salesTable').deleteRow(i);
}

function validationform() {
    var saleType = $('#idSaleType').val();
    var partyName = $('#idParty').val();
    var paymentMode = $('#PaymentMode').val();
    if (saleType === "Select Sale Type" && partyName === "Select Party" && paymentMode === "Select Mode")
    {
        $(".error-saletype").show();
        $(".error-customer").show();
        $(".error-paymenttype").show();
        return false;
    } else {
        if (saleType === "Select Sale Type" || partyName === "Select Party" || paymentMode === "Select Mode")
        {
            if (saleType === "Select Sale Type") {
                $(".error-saletype").show();
            } else {
                $(".error-saletype").show();
            }

            if (partyName === "Select Party") {
                $(".error-customer").show();
            } else {
                $(".error-customer").hide();
            }

            if (paymentMode === "Select Mode") {
                $(".error-paymenttype").show();
            } else {
                $(".error-paymenttype").hide();
            }
            return false;
        }
        return true;
    }
}

// Not Required Now
/*function discount(Source) {
 Discount = $(Source).val();
 Price = $(Source).closest('td').next('td').find('input').val();
 oldTotalPrice = $(Source).closest('td').next('td').find('input').val();
 DiscountedPrice = (Price * Discount) / 100;
 DiscountedPrice = ((oldTotalPrice * Discount) / 100);
 ActualPrice = (oldTotalPrice - DiscountedPrice);
 $(Source).closest('td').next('td').find('input').val(ActualPrice);
 }*/

</script>