<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        //if ($data['Role'] == "Admin") {
        include 'include/ro_leftmenu.php';
        //}
        ?>
        <div class="right-pnel">
            <form id="" action="" method="post" onSubmit="" class="form animated fadeIn">
                <h4><?= $paymentReceived ?></h4>
                <fieldset id="FieldRoFinance">
                    <legend>All Repair Orders</legend>
                    <div class="feildwrap">
                        <label>Search By RO Number</label>
                        <input type="text" name="searchbyro" id="searchbyro"  placeholder="Search by RO Number">
                    </div><br><br>
                    <div id="ROFinanceDiv" class="feildwrap">
                        <div class="btn-block-wrap datagrid">
                            <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="02%">S.NO</th>
                                    <th width="02%">RO</th>
                                    <th width="12%">Book in Date</th>
                                    <th width="10%">Delivery Date</th>
                                    <th width="05%">Customer</th>
                                    <th width="15%">Contact</th>
                                    <th width="15%">Variant</th>
                                    <th width="05%">Reg Number</th>
                                    <th width="05%">Mileage</th>
                                    <th width="05%">Total Amount</th>
                                    <th width="10%">Receivable</th>
                                    <th width="05%">Detail</th>
                                </tr>
                                </thead>
                                <tfoot class="">
                                <tr>
                                    <td colspan="13">
                                        <div id="paging">
                                        </div>
                                </tr>
                                </tfoot>
                                <tbody id="rofinancebody">
                                <?php
                                $count = 1;
                                foreach ($roDetails as $key) {
                                    ?>
                                    <tr id="allcomplaints">
                                        <td name=""><?= $count++ ?></td>
                                        <td name="" class="tbl-name"><?= $key['RONumber'] ?></td>
                                        <td name="" class="tbl-name"><?= $key['BookingDate'] ?></td>
                                        <td name="" class="tbl-name"><?= $key['DeliveryDate'] ?></td>
                                        <td style="display: none;" class="tbl-name"><?= $key['idCustomer'] ?></td>
                                        <td name="" class="tbl-name"><?= $key['CustomerName'] ?></td>
                                        <td name="" class="tbl-name"><?= $key['CustomerContact'] ?></td>
                                        <td name="" class="tbl-name"><?= $key['Vehicle'] ?></td>
                                        <td name="" class="tbl-name" Style="text-transform: uppercase;"><?= $key['RegNumber'] ?></td>
                                        <td name="" class="tbl-name"><?= $key['Mileage'] ?></td>
                                        <td name="" class="tbl-name"><?= $key['NetTotal'] . " /=" ?></td>
                                        <td name="" class="tbl-name"><?= $key['Receivable'] . " /=" ?></td>
                                        <td name="" class="tbl-name"><a  style="cursor: pointer" onclick="getValues(<?php echo $key['idRO'] ?>, 'ReceivePayment');">Receive Payment</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </form>
            <form id="RoFinanceForm" action="<?= base_url() ?>index.php/rofinance/Update"  method="post" onSubmit="" class="form animated fadeIn">
                <fieldset>
                    <legend onclick="DoToggle('#CustomerInfoDiv')">Customer and Vehicle Information</legend>
                    <br>
                    <div id="CustomerInfoDiv" class="feildwrap">
                        <div >
                            <label>Ro Number</label>
                            <input id="idRO" type="text" name="idRO" placeholder="" readonly>
                        </div>
                        <div style="display: none">
                            <label>id Customer</label>
                            <input id="idCustomer" type="text" name="idCustomer" placeholder="idCustomer" readonly>
                        </div>
                        <div>
                            <label>Customer Name</label>
                            <input id="CustomerName" type="text" name="CustomerName" placeholder="Enter Name" readonly>
                        </div>
                        <div>
                            <label>Tel</label>
                            <input id="CustomerContact" Class="MobileNo" type="text" name="CustomerContact" placeholder="Enter Contact Number" readonly>
                        </div>
                        <div id="inputMakeDiv">
                            <label>Make</label>
                            <input id="inputMake" type="text" name="inputMake" placeholder="Enter Make" readonly>
                        </div>
                        <div>
                            <label>Model No.</label>
                            <input id="Model" type="text" name="Model" placeholder="Enter Mdel"  readonly>
                        </div><br>
                        <div>
                            <label>Reg No.</label>
                            <input id="RegNumber" type="text" name="RegNumber" placeholder="Enter Registration Number" readonly>
                        </div>
                        <div>
                            <label>KM</label>
                            <input id="KM" type="text" name="KM" placeholder="Enter KM" readonly>
                        </div><br>
                        <div>
                            <label>Frame No.</label>
                            <input id="FrameNumber" type="text" name="FrameNumber" placeholder="Enter Frame Number" readonly>
                        </div>
                        <div>
                            <label>Engine No.</label>
                            <input id="EngineNumber" type="text" name="EngineNumber" placeholder="Enter Engine Number" readonly>
                        </div>
                        <!--   <div>
                               <label>Model Code</label>
                               <input id="ModelCode" type="text" name="ModelCode" placeholder="Enter Model Code"  readonly>
                           </div>   -->
                        <div>
                            <label>Est No.</label>
                            <input id="EstNum" type="text" name="EstNum" placeholder="Enter Est Number"  readonly>
                        </div>
                        <div>
                            <label>Year</label>
                            <input id="Year" type="text" name="Year" placeholder="Enter Year"  readonly>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend onclick="DoToggle('#FinancialInfoDiv')">Finance Information</legend>
                    <div id="FinancialInfoDiv" class="feildwrap">
                        <br>
                        <div>
                            <?php
                            $financeCounter = 0;
                            foreach ($financeInfoList as $key) {
                                $financeCounter = $financeCounter + 1;
                                if ($key['Name'] === 'Others' || $key['Name'] === 'Other') {
                                    ?>
                                    <div style="margin-left: 50px;"><input id="FinanceList" name="FinanceList" type="radio" onclick="DoToggle('#InputOther')" value="<?= $key['idFinance'] ?>"  checked><?= $key['Name'] ?><input id="InputOther" type="text" name="InputOther" placeholder="Write Other Financials" style="margin-left: 20px;"></div>

                                <?php } else {
                                    ?>
                                    <div style="margin-left: 50px"><input id="FinanceList" name="FinanceList" type="radio" onclick="hideFinanceInput('#InputOther')" value="<?= $key['idFinance'] ?>" checked><?= $key['Name'] ?></div>
                                    <?php
                                }
                            }
                            ?>
                        </div><br><br>
                        <div style=" margin-bottom: 0px;">
                            <label>Cash Memo No.</label>
                            <input id="CashMemo" readonly="" id="cashmemo" type="text" name="CashMemo" placeholder="Cash Memo Number" data-validation = "">
                        </div>
                        <div style=" margin-bottom: 0px;">
                            <label>Credit Memo No.</label>
                            <input id="CreditMemo" type="text" name="CreditMemo" placeholder="Credit Memo Number" data-validation = "">
                        </div>
                        <div>
                            <label>Reference Number</label>
                            <input id="FinanceRefNo" type="text" name="FinanceRefNo" placeholder="Enter Reference Number">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Total Amount</legend>
                    <div id="" class="feildwrap" style="float: left">
                        <br>
                        <div id="checkboxdiv" style="margin-left: 0px;">
                            <div>
                                <label>Labour</label>
                                <input id="Labour" name="Labour" type="number"  min="0" onchange="calculateNetTotal()" placeholder="Labour Amount" onkeyup="if(parseInt(this.value)>5) return false;" style="width: 110px;"><span>&nbsp;Rs</span>
                                <input id="ApplyGSTLabour" name="ApplyGSTLabour" type="checkbox" value="1" checked="" style="margin-left: 10px;">Apply G.S.T
                            </div><br>
                            <div>
                                <label>Lub Oil</label>
                                <input id="LubOil" type="number" name="LubOil" min="0" onchange="calculateNetTotal()" placeholder="Lub Oil Amount" onkeyup="if(parseInt(this.value)>5) return false;" style="width: 110px;"><span>&nbsp;Rs</span>
                                <input id="ApplyGSTLubOil" name="ApplyGSTLubOil" type="checkbox" value="1" checked="" style="margin-left: 10px;">Apply G.S.T</div><br>
                            <div>
                                <label>Sublet Repair</label>
                                <input id="SubletRepair" name="SubletRepair" type="number" min="0" onchange="calculateNetTotal()" placeholder="Sublet Repair Amount" onkeyup="if(parseInt(this.value)>5) return false;" style="width: 110px;"><span>&nbsp;Rs</span>
                                <input id="ApplyGSTSublet" name="ApplyGSTSublet" type="checkbox" value="1" checked="" style="margin-left: 10px;">Apply G.S.T</div><br>
                            <div>
                                <label>Parts</label>
                                <input id="Parts" type="number" min="0" name="Parts" onchange="calculateNetTotal()" placeholder="Parts Amount" onkeyup="if(parseInt(this.value)>5) return false;" style="width: 110px;"><span>&nbsp;Rs</span>
                                <input id="ApplyGSTParts" name="ApplyGSTParts" type="checkbox" value="1" checked="" style="margin-left: 10px;">Apply G.S.T</div><br>
                            <div>
                                <label>Grand Total</label>
                                <input id="GrandTotal" name="GrandTotal" type="number" min="0" placeholder="Grand Total" onkeyup="if(parseInt(this.value)>5) return false;" style="width: 110px;"><span>&nbsp;Rs</span>
                            </div><br>
                            <div>
                                <label>G.S.T</label>
                                <input id="GST" type="number" min="0" name="GST" placeholder="GST" value=16 onkeyup="if(parseInt(this.value)>5) return false;" style="width: 110px;"><span>&nbsp;%</span>
                            </div><br>
                            <div>
                                <label>Net Total</label>
                                <input id="NetTotal" name="NetTotal" type="number" min="0" placeholder="Net Total" onkeyup="if(parseInt(this.value)>5) return false;" style="width: 110px;"><span>&nbsp;Rs</span>
                            </div><br>
                            <div style="display: none">
                                <label>id Receivable</label>
                                <input id="idReceivable" type="text" name="idReceivable" placeholder="" style="width: 110px;"><span>&nbsp;Rs</span>
                            </div>
                        </div><br>
                        <div>
                            <label>Total Receivable</label>
                            <input id="Receivable" type="number" min="0" name="Receivable" placeholder="Receivable" style="width: 110px;" readonly><span>&nbsp;Rs</span>
                        </div>
                    </div>
                    <div id='POSDiv' class="feildwrap" style="margin-top:60px;margin-right:0px;float: right">
                        <div>
                            <label>Enter ED</label>
                            <input id="Discount" name="Discount" type="number" min="0" value="0" onkeyup="if (parseInt(this.value) > 5)
                                        return false" style="width: 110px;">
                        </div><br>
                        <div>
                            <label>Enter Payment Received</label>
                            <input id="PaymentReceived" name="PaymentReceived"  type="number" min="0" value="0" onkeyup="if (parseInt(this.value) < 0)
                                        return false;" style="width: 110px;">
                        </div>
                        <div>
                            <span onclick="checkBalance()" style="margin-left: 10px;font-weight: bolder;font-size: larger">OK</span>
                        </div>
                        <br>
                        <div id="PayDiv">
                            <span id="PayStatus"></span>
                        </div>
                        <div id="BalanceDiv">
                            <label>Balance</label>
                            <input id="Balance" type="text" name="Balance" placeholder="Balance" value=0 style="width: 110px;" readonly>
                            <span id="BalStatus"></span>
                        </div><br><br>
                        <div class="btn-block-wrap">
                            <input id="DoneBtn" type="button" class="btn" value="Done" onclick="checkAndReceivePayment()" style="margin-left: 182px;width: 160px;">
                        </div><br>
                        <div id="CheckRODiv" style="width: 600px;">

                        </div>
                    </div>
                </fieldset>
                <input type="hidden" id="RONumber" />
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#PayDiv').hide();
        $('#BalanceDiv').hide();
        $('#DoneBtn').hide();
        $("#InputOther").hide();
        $('#RoFinanceForm').hide();
    });

    $("#searchbyro").keyup(function() {
        var search = $("#searchbyro").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/rofinance/searchRODetail",
            type: "POST",
            data: {searchbyro: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.RONumber + "</td>\n\
                            <td class='tbl-name'>" + val.BookingDate + "</td>\n\
                            <td class='tbl-name'>" + val.DeliveryDate + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerName + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerContact + "</td>\n\
                            <td class='tbl-name'>" + val.Vehicle + "</td>\n\
                            <td class='tbl-name'>" + val.RegNumber + "</td>\n\
                            <td class='tbl-name'>" + val.Mileage + "</td>\n\
                            <td class='tbl-name'>" + val.NetTotal + " /=</td>\n\
                            <td class='tbl-name'>" + val.Staff + "</td>\n\
                            <td class='tbl-name'>" + val.Foreman + "</td>\n\
                            <td class='tbl-name'><a style='cursor: pointer' onClick=getValues('" + val.idRO + "','ReceivePayment')>Receive Payment</a></td></tr>";
                            });
                            $('#rofinancebody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#rofinancebody").html("<td></td><td></td><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td>");
                    }
                }
            }
        });
    });

    function DoToggle(id) {
        $(id).toggle();
    }

    function hideFinanceInput(id) {

        if (($(id).is(":visible"))) {
            $(id).hide();
        }
    }

    function calculateNetTotal() {
        var labourAmount = $("#Labour").val();
        var lubOilAmount = $("#LubOil").val();
        var subletAmount = $("#SubletRepair").val();
        var partsAmount = $("#Parts").val();
        var gst = $("#GST").val();
        var grandTotal = parseInt(isNull(labourAmount)) + parseInt(isNull(lubOilAmount)) + parseInt(isNull(subletAmount)) + parseInt(isNull(partsAmount));
        if($("#ApplyGSTLabour").is(':checked')){
            var labourAmountGST = (gst / 100) * (labourAmount);
        }else{
            var labourAmountGST =  0;
        }
        if($("#ApplyGSTSublet").is(':checked')){
            var subletAmountGST = (gst / 100) * (subletAmount);
        }else{
            var subletAmountGST =  0;
        }
        if($("#ApplyGSTLubOil").is(':checked')){
            var lubOilAmountGST = (gst / 100) * (lubOilAmount);
        }else{
            var lubOilAmountGST =  0;
        }
        if($("#ApplyGSTParts").is(':checked')){
            var partsAmountGST = (gst / 100) * (partsAmount);
        }else{
            var partsAmountGST =  0;
        }
        //var netTotal = (gst / 100) * (grandTotal);
        $('#GrandTotal').val(grandTotal);
        $('#NetTotal').val(grandTotal + labourAmountGST + subletAmountGST + lubOilAmountGST + partsAmountGST);
    }

    function isNull(value) {

        if (value === "") {
            return 0;
        } else {
            return value;
        }
    }

    function checkBalance() {

        var Receivable = $('#Receivable').val();
        var paymentReceived = $('#PaymentReceived').val();
        var discountAmount = $('#Discount').val();
        var netTotal = $('#NetTotal').val();
        netTotal = netTotal - discountAmount;
        if (paymentReceived >= 0) {
            var balance = paymentReceived - netTotal;
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
        }
        else {
            if (paymentReceived < 0) {
                $('#PayDiv').show();
                $('#PayStatus').html('  Enter Valid Amount');
            }
        }
    }

    function getValues(idRO, type) {

        var search = idRO;
        if (type === 'ReceivePayment') {
            $('#FieldRoFinance').hide();
            $('#RoFinanceForm').show();
            $.ajax({
                url: "<?= base_url() ?>index.php/rofinance/getRODetail",
                type: "POST",
                data: {idRO: search},
                success: function(data) {
                    if (data !== "null")
                    {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            try {
                                $('#idRO').val(parsedData[0]['idRO']);
                                $('#RONumber').val(parsedData[0]['RONumber']);
                                $('#idCustomer').val(parsedData[0]['idCustomer']);
                                $('#CustomerName').val(parsedData[0]['CustomerName']);
                                $('#CustomerContact').val(parsedData[0]['CustomerContact']);
                                $('#inputMake').val(parsedData[0]['Vehicle']);
                                $('#Model').val(parsedData[0]['Model']);
                                $('#ModelCode').val(parsedData[0]['ModelCode']);
                                $('#Year').val(parsedData[0]['Year']);
                                $('#RegNumber').val(parsedData[0]['RegNumber']);
                                $('#EstNum').val(parsedData[0]['EstNumber']);
                                $('#FrameNumber').val(parsedData[0]['FrameNumber']);
                                $('#EngineNumber').val(parsedData[0]['EngineNumber']);
                                $('#KM').val(parsedData[0]['Mileage']);
                                $('#InputOther').val(parsedData[0]['OtherFinance']);
                                $('#FinanceRefNo').val(parsedData[0]['FinanceRefNo']);
                                $('#Labour').val(parsedData[0]['Labour']);
                                $('#LubOil').val(parsedData[0]['LubOilAmount']);
                                $('#SubletRepair').val(parsedData[0]['SubletRepairAmount']);
                                $('#Parts').val(parsedData[0]['PartsAmount']);
                                $('#GrandTotal').val(parsedData[0]['GrandTotal']);
                                $('#GST').val(parsedData[0]['GSTax']);
                                $('#NetTotal').val(parsedData[0]['NetTotal']);
                                $('#idReceivable').val(parsedData[0]['idReceivable']);
                                $('#Receivable').val(parsedData[0]['Receivable']);
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {

                        }
                    }
                }
            });
        } else {
            if (type === "CheckedRO") {
                $('#PayDiv').hide();
                $('#BalanceDiv').hide();
                $('#DoneBtn').hide();
                $('#CheckRODiv').hide();
                $.ajax({
                    url: "<?= base_url() ?>index.php/rofinance/getRODetail",
                    type: "POST",
                    data: {idRO: search},
                    success: function(data) {
                        if (data !== "null")
                        {
                            var parsedData = JSON.parse(data);
                            if (parsedData.length > 0) {
                                try {
                                    $('#idRO').val(parsedData[0]['idRO']);
                                    $('#RONumber').val(parsedData[0]['RONumber']);
                                    $('#idCustomer').val(parsedData[0]['idCustomer']);
                                    $('#CustomerName').val(parsedData[0]['CustomerName']);
                                    $('#CustomerContact').val(parsedData[0]['CustomerContact']);
                                    $('#inputMake').val(parsedData[0]['Vehicle']);
                                    $('#Model').val(parsedData[0]['Model']);
                                    $('#ModelCode').val(parsedData[0]['ModelCode']);
                                    $('#Year').val(parsedData[0]['Year']);
                                    $('#RegNumber').val(parsedData[0]['RegNumber']);
                                    $('#EstNum').val(parsedData[0]['EstNumber']);
                                    $('#FrameNumber').val(parsedData[0]['FrameNumber']);
                                    $('#EngineNumber').val(parsedData[0]['EngineNumber']);
                                    $('#KM').val(parsedData[0]['Mileage']);
                                    $('#InputOther').val(parsedData[0]['OtherFinance']);
                                    $('#FinanceRefNo').val(parsedData[0]['FinanceRefNo']);
                                    $('#Labour').val(parsedData[0]['Labour']);
                                    $('#LubOil').val(parsedData[0]['LubOilAmount']);
                                    $('#SubletRepair').val(parsedData[0]['SubletRepairAmount']);
                                    $('#Parts').val(parsedData[0]['PartsAmount']);
                                    $('#GrandTotal').val(parsedData[0]['GrandTotal']);
                                    $('#GST').val(parsedData[0]['GSTax']);
                                    $('#NetTotal').val(parsedData[0]['NetTotal']);
                                    $('#idReceivable').val(parsedData[0]['idReceivable']);
                                    $('#Receivable').val(parsedData[0]['Receivable']);
                                } catch (e) {
                                    console.log(e);
                                }
                            }
                            else {

                            }
                        }
                    }
                });
            }
        }
    }

    /*--This JavaScript method for Print command--*/
    function PrintDoc(ROnumber) {

        $.ajax({
            url: "<?= base_url() ?>index.php/openedro/get_invoice_data",
            type: "POST",
            data: {ROnumber: ROnumber},
            success: function(data) {
                //console.log(data);
                // return;
                if (data !== "null")
                {

                    console.log(data);
                    var parsedData = JSON.parse(data);
                    if (parsedData['getRoData'].length > 0) {
                        try {
                            var parts_html = '';
                            var parts = (parsedData['Parts'])?parsedData['Parts']:[];
                            for(i=0;i<parts.length;i++){
                                parts_html += '<tr> <td style="float:left;padding-left:30px">'+(parseInt(i)+1)+'.</td> ' +
                                    '<td style="float:left;padding-left:2px">'+parts[i]['PartName']+'</td> ' +
                                    '<td>'+parts[i]['PartQuantity']+'</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs '+parseFloat(parts[i]['PartAmount']).toFixed(2)+'</td> </tr>' ;
                            }		  var sublet_html = '';
                            // var sublet = parsedData['Sublet'];
                            var sublet = (parsedData['Sublet'])?parsedData['Sublet']:[];
                            for(i=0;i<sublet.length;i++){
                                sublet_html += '<tr> <td style="float:left;padding-left:30px">'+(parseInt(i)+1)+'.</td> ' +
                                    '<td style="float:left;padding-left:2px">'+sublet[i]['Description']+'</td> ' +
                                    '<td>'+sublet[i]['Quantity']+'</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs '+parseFloat(sublet[i]['SubletRepairAmount']).toFixed(2)+'</td> </tr>' ;
                            }
                            var labour_html = '';
                            var labour = (parsedData['RODetailJob'])?parsedData['RODetailJob']:[];
                            // var labour = parsedData['RODetailJob'];
                            for(i=0;i<labour.length;i++){
                                labour_html += '<tr> <td style="float:left;padding-left:30px">'+(parseInt(i)+1)+'.</td> ' +
                                    '<td style="float:left;padding-left:2px">'+labour[i]['WorkPerformed']+'</td> ' +
                                    '<td>'+labour[i]['Hours']+'</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs '+parseFloat(labour[i]['Amount']).toFixed(2)+'</td> </tr>' ;
                            }
                            var result = parsedData['getRoData'][0];

                            if($("#checkboxdiv input:checkbox:checked").length > 0){
                                var gst_html =  '<div style="display: block; page-break-before: always;clear:both;" ></div>' +
                                    '<div class="container" style="border-align:center">' +
                                    ' <table class="header"> ' +
                                    '<tbody>' +
                                    '<tr> ' +
                                    '<td style="float:left">' +
                                    '<img src="<?php echo base_url('/assets/images/toyota-logo.png')?>" height="30" width="150">' +
                                    '</td> <td style="position:center;padding-left:15%">' +
                                    '<strong style="font-size:25px;padding-left:20%">Sales Tax Invoice</strong><br>' +
                                    '<strong><span style="font-size:25px">SERVICE DEPARTMENT</span></strong></td> ' +
                                    '<td style="float:right;padding-left:40%">S.NO. __________ <br><img src="<?php echo base_url('assets/images/daihaisu-logo.png')?>" height="52" width="150"></td> </tr>' +
                                    ' </tbody></table>' +
                                    ' <div class="container-top" style="border:3px solid black;width:100%;border-right:none;border-left:none;border-bottom:3px solid black;">' +
                                    ' <table width="100%">' +
                                    ' <tbody>' +
                                    '<tr> ' +
                                    '<td style="float:left;font-size:25px;margin-bottom:0px;"> <strong>TOYOTA WESTERN MOTORS</strong> </td>' +
                                    ' <td class="details" rowspan="3" valign="top" style="border:1px solid black;border-top:none;border-right:none;border-bottom:none;padding-left:15px; width:40%;"> <table> <tbody><tr> <td style="padding:3px;border-color:"><b>Date:</b></td>' +
                                    ' <td style="padding-left:5px;">'+result['BookInDate']+'</td> </tr> <tr> <td style="margin-top:2px;padding:3px;"><b>Repair Order #:</b></td> <td style="padding-left:5px;">'+result['RONumber']+'</td> </tr> <tr> </tr> <tr> <td style="padding:3px;"><b>Invoice #:</b></td> <td style="padding-left:5px;">'+result['idTransaction']+'</td> </tr> <tr> <td style="padding:3px;"><b>Advisor #:</b></td> <td style="padding-left:5px;">'+result['Advisor']+'</td> </tr> <tr> <td style="padding:3px;"><b>Make #:</b></td> <td style="padding-left:5px;">TOYOTA</td> </tr> ' +
                                    '<tr> <td style="padding:3px;"><b>Variant #:</b></td>' +
                                    ' <td style="padding-left:5px;">GLI</td> </tr> ' +
                                    '<tr> ' +
                                    '<td style="padding:3px;"><b>Registration #:</b></td> <td style="padding-left:5px;text-transform: uppercase;">'+result['RegistrationNumber']+'</td> </tr> ' +
                                    '<tr> <td style="padding:3px;"><b>Chassis #:</b></td> <td style="padding-left:5px; text-transform: uppercase;">'+result['ChassisNumber']+'</td> </tr>' +
                                    ' <tr> <td style="padding:3px;"><b>Engine #:</b></td> <td style="padding-left:5px;text-transform: uppercase;">'+result['EngineNumber']+'</td> </tr> ' +
                                    '<tr> <td style="padding:3px;"><b>Kilometer #:</b></td> <td style="padding-left:5px;">'+result['Mileage']+'</td> </tr>' +
                                    ' <tr> <td style="padding:3px;"><b>Gate Pass #:</b></td> <td style="padding-left:5px;">'+result['GatePassNumber']+'</td> </tr>' +
                                    ' </tbody></table> ' +
                                    '</td> </tr>' +
                                    ' <tr valign="top" style="margin-top:-20px;">' +
                                    ' <td> <p valign="top" style="font-size:12px">' +
                                    '<strong>38, Estate Avenue, S.I.T.E., Karachi, Sindh, Pakistan ' +
                                    '<br> Karachi, Pakistan<br> UAN: 021-111-800-777 Tel: 021-32590184,32564531 / 2564532 Fax: 9221-2564536' +
                                    '<br> E-mail: customer.relations@toyotawestern.com/service@toyotawestern.com<br> parts@toyotawestern.com </strong> </p> </td> </tr> ' +
                                    '<tr> <td style="border-top:1px solid black;border-bottom:none;"> <p style="text-transform: capitalize;"><b style="font-size:15px;text-transform: capitalize;">CUSTOMER NAME : </b> '+result['CustomerName']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px">COMPANY NAME <span style="padding-left:10%"> : </span> </b> '+result['CompanyName']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px">ADDRESS <span style="padding-left:13%"> : </span> </b> '+result['AddressDetails']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px">PHONE NO. <span style="padding-left:10%"> :</span> </b>'+result['Cellphone']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px">NTN. <span style="padding-left:18%"> :</span> </b>'+result['Ntn']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px"><strong>TYPE OF JOB <span style="padding-left:7%"> :</span> </strong></b><strong> MECHANICAL</strong></p>' +
                                    ' </td> </tr> </tbody></table> </div>' +
                                    ' <br> ' +
                                    '<div class="description" style="width:100%;margin-left:20px;align:center;">' +
                                    ' <p></p><p></p><p></p><p></p><p></p>' +
                                    '<table style="width:95%;border-collapse:collapse;">' +
                                    ' <tbody><tr> </tr></tbody>' +
                                    '<thead style="text-align:center;height:20px;width:95%"> ' +
                                    '<tr><th style="align:center;border:2px solid black;font-size:20px;height:30px;" colspan="2">JOB DESCRIPTION</th> ' +
                                    '<th style="border:2px solid black;font-size:20px;height:40px;width:20% ">AMOUNT</th> </tr></thead>' +
                                    ' <tbody><tr> <td style="float:left;padding-left:30px"></td> <td>&nbsp;</td>' +
                                    ' <td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">' +
                                    '<p>  </p></td><td> </td></tr>' +
                                    ' <tr> <td style="padding-left:25px;font-size:20px"><strong>PARTS</strong><span style="padding-left:80%">' +
                                    '<strong>QUANTITY</strong></span>' +
                                    '</td> <td>&nbsp;</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">&nbsp;</td> </tr> ' +
                                    parts_html +
                                    ' <tr> <td style="padding-left:25px;font-size:20px"><strong>SUBLET</strong><span style="padding-left:80%">' +
                                    '<strong>QUANTITY</strong></span>' +
                                    '</td> <td>&nbsp;</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">&nbsp;</td> </tr> ' +
                                    sublet_html +
                                    ' <tr> <td style="padding-left:25px;font-size:20px"><strong>LABOUR</strong><span style="padding-left:80%">' +
                                    '<strong>HOURS</strong></span>' +
                                    '</td> <td>&nbsp;</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">&nbsp;</td> </tr> ' +
                                    labour_html +
                                    ' <tr> <td style="float:left;padding-left:30px"></td> <td>&nbsp;</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right"></td>' +
                                    '<td> </td></tr>' +
                                    ' <tr> <td style="float:left;padding-left:30px"></td> <td style="padding-left:35px"><strong>LABOUR</strong></td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;"> Rs. '+parseFloat(result['LabourAmount']).toFixed(2)+'</td>' +
                                    ' </tr>' +
                                    ' <tr> ' +
                                    '<td style="float:left;padding-left:30px"></td> ' +
                                    '<td style="padding-left:35px"><strong>SUBLET</strong></td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['SubletRepairAmount']).toFixed(2)+'</td>' +
                                    ' </tr>' +
                                    ' <tr>' +
                                    ' <td style="text-align:right" colspan="2"><strong>PARTS </strong></td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['PartsAmount']).toFixed(2)+'</td>' +
                                    ' </tr> ' +
                                    ' <tr>' +
                                    ' <td style="text-align:right" colspan="2"><strong> LUB OIL </strong></td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['LubOilAmount']).toFixed(2)+'</td>' +
                                    ' </tr> ' +
                                    '<tr>' +
                                    ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em>TOTAL AMOUNT </em></strong></td> ' +
                                    '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                    '<strong>Rs. '+parseFloat(result['GrandTotal']).toFixed(2)+'</strong></td> ' +
                                    '</tr>' +
                                    '<tr>' +
                                    ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em> GST </em></strong></td> ' +
                                    '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                    '<strong>'+result['GSTax']+' %</strong></td> ' +
                                    '</tr>' +
                                    '<tr>' +
                                    ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em>NET TOTAL AMOUNT </em></strong></td> ' +
                                    '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                    '<strong>Rs. '+parseFloat(result['NetTotal']).toFixed(2)+'</strong></td> ' +
                                    '</tr>' +
                                    ' </tbody></table> ' +
                                    '<!-- <br/><br/><br/><br/><br/> ' +
                                    '<p align="center" style="font-size:15px">' +
                                    ' <b>SIGNATURE _______________</b></p> --> </div>' +
                                    ' <!----> <div style="margin-top:10%"> ' +
                                    '<table style="border-bottom:3px solid black;" width="100%"> ' +
                                    '<tbody><tr> <td><p style="padding-left:20px">'+Date()+'<span style="padding-left:70%"> Page 1 of 1</span></p></td> </tr>' +
                                    ' </tbody>' +
                                    '</table>' +
                                    ' <table class="header"> ' +
                                    '<tbody>' +
                                    '<tr> ' +
                                    '<td style="float:left">' +
                                    '<img src="<?php echo base_url('/assets/images/toyota-logo.png')?>" height="30" width="150">' +
                                    '</td> <td style="position:center;padding-left:15%">' +
                                    '<strong style="font-size:25px;padding-left:20%">Sales Tax Invoice</strong><br>' +
                                    '<strong><span style="font-size:25px">SERVICE DEPARTMENT</span></strong></td> ' +
                                    '<td style="float:right;padding-left:40%">S.NO. __________ <br><img src="<?php echo base_url('assets/images/daihaisu-logo.png')?>" height="52" width="150"></td> </tr>' +
                                    ' </tbody></table>' +
                                    ' <div class="container-top" style="border:3px solid black;width:100%;border-right:none;border-left:none;border-bottom:3px solid black;">' +
                                    ' <table width="100%">' +
                                    ' <tbody>' +
                                    '<tr> ' +
                                    '<td style="float:left;font-size:25px;margin-bottom:0px;"> <strong>TOYOTA WESTERN MOTORS</strong> </td>' +
                                    ' <td class="details" rowspan="3" valign="top" style="border:1px solid black;border-top:none;border-right:none;border-bottom:none;padding-left:15px; width:40%;"> <table> <tbody><tr> <td style="padding:3px;border-color:"><b>Date:</b></td>' +
                                    ' <td style="padding-left:5px;">'+result['BookInDate']+'</td> </tr> <tr> <td style="margin-top:2px;padding:3px;"><b>Repair Order #:</b></td> <td style="padding-left:5px;">'+result['RONumber']+'</td> </tr> <tr> </tr> <tr> <td style="padding:3px;"><b>Invoice #:</b></td> <td style="padding-left:5px;">'+result['idTransaction']+'</td> </tr> <tr> <td style="padding:3px;"><b>Advisor #:</b></td> <td style="padding-left:5px;">'+result['Advisor']+'</td> </tr> <tr> <td style="padding:3px;"><b>Make #:</b></td> <td style="padding-left:5px;">TOYOTA</td> </tr> ' +
                                    '<tr> <td style="padding:3px;"><b>Variant #:</b></td>' +
                                    ' <td style="padding-left:5px;">GLI</td> </tr> ' +
                                    '<tr> ' +
                                    '<td style="padding:3px;"><b>Registration #:</b></td> <td style="padding-left:5px;text-transform: uppercase;">'+result['RegistrationNumber']+'</td> </tr> ' +
                                    '<tr> <td style="padding:3px;"><b>Chassis #:</b></td> <td style="padding-left:5px; text-transform: uppercase;">'+result['ChassisNumber']+'</td> </tr>' +
                                    ' <tr> <td style="padding:3px;"><b>Engine #:</b></td> <td style="padding-left:5px;text-transform: uppercase;">'+result['EngineNumber']+'</td> </tr> ' +
                                    '<tr> <td style="padding:3px;"><b>Kilometer #:</b></td> <td style="padding-left:5px;">'+result['Mileage']+'</td> </tr>' +
                                    ' <tr> <td style="padding:3px;"><b>Gate Pass #:</b></td> <td style="padding-left:5px;">'+result['GatePassNumber']+'</td> </tr>' +
                                    ' </tbody></table> ' +
                                    '</td> </tr>' +
                                    ' <tr valign="top" style="margin-top:-20px;">' +
                                    ' <td> <p valign="top" style="font-size:12px">' +
                                    '<strong>38, Estate Avenue, S.I.T.E., Karachi, Sindh, Pakistan ' +
                                    '<br> Karachi, Pakistan<br> UAN: 021-111-800-777 Tel: 021-32590184,32564531 / 2564532 Fax: 9221-2564536' +
                                    '<br> E-mail: customer.relations@toyotawestern.com/service@toyotawestern.com<br> parts@toyotawestern.com </strong> </p> </td> </tr> ' +
                                    '<tr> <td style="border-top:1px solid black;border-bottom:none;"> <p style="text-transform: capitalize;"><b style="font-size:15px;text-transform: capitalize;">CUSTOMER NAME : </b> '+result['CustomerName']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px">COMPANY NAME <span style="padding-left:10%"> : </span> </b> '+result['CompanyName']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px">ADDRESS <span style="padding-left:13%"> : </span> </b> '+result['AddressDetails']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px">PHONE NO. <span style="padding-left:10%"> :</span> </b>'+result['Cellphone']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px">NTN. <span style="padding-left:18%"> :</span> </b>'+result['Ntn']+'</p>' +
                                    ' <p style="text-transform: capitalize;"><b style="font-size:15px"><strong>TYPE OF JOB <span style="padding-left:7%"> :</span> </strong></b><strong> MECHANICAL</strong></p>' +
                                    ' </td> </tr> </tbody></table> </div>' +
                                    ' <br> ' +
                                    '<div class="description" style="width:100%;margin-left:20px;align:center;">' +
                                    ' <p></p><p></p><p></p><p></p><p></p>' +
                                    '<table style="width:95%;border-collapse:collapse;">' +
                                    ' <tbody><tr> </tr></tbody>' +
                                    '<thead style="text-align:center;height:20px;width:95%"> ' +
                                    '<tr><th style="align:center;border:2px solid black;font-size:20px;height:30px;" colspan="2">JOB DESCRIPTION</th> ' +
                                    '<th style="border:2px solid black;font-size:20px;height:40px;width:20% ">AMOUNT</th> </tr></thead>' +
                                    ' <tbody><tr> <td style="float:left;padding-left:30px"></td> <td>&nbsp;</td>' +
                                    ' <td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">' +
                                    '<p>  </p></td><td> </td></tr>' +
                                    ' <tr> <td style="padding-left:25px;font-size:20px"><strong>LABOUR</strong><span style="padding-left:80%">' +
                                    '<strong>HOURS</strong></span>' +
                                    '</td> <td>&nbsp;</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">&nbsp;</td> </tr> ' +
                                    labour_html +
                                    ' <tr> <td style="float:left;padding-left:30px"></td> <td>&nbsp;</td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right"></td>' +
                                    '<td> </td></tr>' +
                                    ' <tr> <td style="float:left;padding-left:30px"></td> <td style="padding-left:35px"><strong>LABOUR</strong></td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;"> Rs. '+parseFloat(result['LabourAmount']).toFixed(2)+'</td>' +
                                    ' </tr>' +
                                    ' <tr> ' +
                                    '<td style="float:left;padding-left:30px"></td> ' +
                                    '<td style="padding-left:35px"><strong>SUBLET</strong></td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['SubletRepairAmount']).toFixed(2)+'</td>' +
                                    ' </tr>' +
                                    ' <tr>' +
                                    ' <td style="text-align:right" colspan="2"><strong>PARTS </strong></td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['PartsAmount']).toFixed(2)+'</td>' +
                                    ' </tr> ' +
                                    ' <tr>' +
                                    ' <td style="text-align:right" colspan="2"><strong> LUB OIL </strong></td> ' +
                                    '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['LubOilAmount']).toFixed(2)+'</td>' +
                                    ' </tr> ' +
                                    '<tr>' +
                                    ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em>TOTAL AMOUNT </em></strong></td> ' +
                                    '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                    '<strong>Rs. '+parseFloat(result['GrandTotal']).toFixed(2)+'</strong></td> ' +
                                    '</tr>' +
                                    '<tr>' +
                                    ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em> GST </em></strong></td> ' +
                                    '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                    '<strong>'+result['GSTax']+' %</strong></td> ' +
                                    '</tr>' +
                                    '<tr>' +
                                    ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em>NET TOTAL AMOUNT </em></strong></td> ' +
                                    '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                    '<strong>Rs. '+parseFloat(result['NetTotal']).toFixed(2)+'</strong></td> ' +
                                    '</tr>' +
                                    ' </tbody></table> ' +
                                    '<!-- <br/><br/><br/><br/><br/> ' +
                                    '<p align="center" style="font-size:15px">' +
                                    ' <b>SIGNATURE _______________</b></p> --> </div>' +
                                    ' <!----> <div style="margin-top:10%"> ' +
                                    '<table style="border-bottom:3px solid black;" width="100%"> ' +
                                    '<tbody><tr> <td><p style="padding-left:20px">'+Date()+'<span style="padding-left:70%"> Page 1 of 1</span></p></td> </tr>' +
                                    ' </tbody>' +
                                    '</table>' +
                                    ' <p style="padding-left:20px"><b>NOTE: If you have any queries please feel free to contact our <br>' +
                                    ' <span style="padding-left:5.5%"> Customer Relations Department.</span> <br> ' +
                                    'UAN : 021-111-800-777 <span style="padding-left:50%;font-size:18px"> For </span>' +
                                    ' <span style="font-size:20px;margin-right:-9px;">TOYOTA WESTERN MOTORS</span> </b></p>' +
                                    ' </div> ' +
                                    '</div>';
                            }else{
                                var gst_html =  '';
                            }

                            var html = '<div class="container" style="border-align:center">' +
                                ' <table class="header"> ' +
                                '<tbody>' +
                                '<tr> ' +
                                '<td style="float:left">' +
                                '<img src="<?php echo base_url('/assets/images/toyota-logo.png')?>" height="30" width="150">' +
                                '</td> <td style="position:center;padding-left:15%">' +
                                '<strong style="font-size:25px;padding-left:20%">INVOICE</strong><br>' +
                                '<strong><span style="font-size:25px">SERVICE DEPARTMENT</span></strong></td> ' +
                                '<td style="float:right;padding-left:40%">S.NO. __________ <br><img src="<?php echo base_url('assets/images/daihaisu-logo.png')?>" height="52" width="150"></td> </tr>' +
                                ' </tbody></table>' +
                                ' <div class="container-top" style="border:3px solid black;width:100%;border-right:none;border-left:none;border-bottom:3px solid black;">' +
                                ' <table width="100%">' +
                                ' <tbody>' +
                                '<tr> ' +
                                '<td style="float:left;font-size:25px;margin-bottom:0px;"> <strong>TOYOTA WESTERN MOTORS</strong> </td>' +
                                ' <td class="details" rowspan="3" valign="top" style="border:1px solid black;border-top:none;border-right:none;border-bottom:none;padding-left:15px; width:40%;"> <table> <tbody><tr> <td style="padding:3px;border-color:"><b>Date:</b></td>' +
                                ' <td style="padding-left:5px;">'+result['BookInDate']+'</td> </tr> <tr> <td style="margin-top:2px;padding:3px;"><b>Repair Order #:</b></td> <td style="padding-left:5px;">'+result['RONumber']+'</td> </tr> <tr> <td style="padding:3px;"><b>Credit Memo #:</b></td> <td style="padding-left:5px;">'+result['CreditMemoNumber']+'</td> </tr> <tr> <td style="padding:3px;"><b>Invoice #:</b></td> <td style="padding-left:5px;">'+result['idTransaction']+'</td> </tr> <tr> <td style="padding:3px;"><b>Advisor #:</b></td> <td style="padding-left:5px;">'+result['Advisor']+'</td> </tr> <tr> <td style="padding:3px;"><b>Make #:</b></td> <td style="padding-left:5px;">TOYOTA</td> </tr> ' +
                                '<tr> <td style="padding:3px;"><b>Variant #:</b></td>' +
                                ' <td style="padding-left:5px;">GLI</td> </tr> ' +
                                '<tr> ' +
                                '<td style="padding:3px;"><b>Registration #:</b></td> <td style="padding-left:5px;">'+result['RegistrationNumber']+'</td> </tr> ' +
                                '<tr> <td style="padding:3px;"><b>Chassis #:</b></td> <td style="padding-left:5px;">'+result['ChassisNumber']+'</td> </tr>' +
                                ' <tr> <td style="padding:3px;"><b>Engine #:</b></td> <td style="padding-left:5px;">'+result['EngineNumber']+'</td> </tr> ' +
                                '<tr> <td style="padding:3px;"><b>Kilometer #:</b></td> <td style="padding-left:5px;">'+result['Mileage']+'</td> </tr>' +
                                ' <tr> <td style="padding:3px;"><b>Gate Pass #:</b></td> <td style="padding-left:5px;">'+result['GatePassNumber']+'</td> </tr>' +
                                ' </tbody></table> ' +
                                '</td> </tr>' +
                                ' <tr valign="top" style="margin-top:-20px;">' +
                                ' <td> <p valign="top" style="font-size:12px">' +
                                '<strong>38, Estate Avenue, S.I.T.E., Karachi, Sindh, Pakistan ' +
                                '<br> Karachi, Pakistan<br> UAN: 021-111-800-777 Tel: 021-32590184,32564531 / 2564532 Fax: 9221-2564536' +
                                '<br> E-mail: customer.relations@toyotawestern.com/service@toyotawestern.com<br> parts@toyotawestern.com </strong> </p> </td> </tr> ' +
                                '<tr> <td style="border-top:1px solid black;border-bottom:none;"> <p style="text-transform: capitalize;"><b style="font-size:15px">CUSTOMER NAME : </b> '+result['CustomerName']+'</p>' +
                                ' <p style="text-transform: capitalize;"><b style="font-size:15px">COMPANY NAME <span style="padding-left:10%"> : </span> </b> '+result['CompanyName']+'</p>' +
                                ' <p style="text-transform: capitalize;"><b style="font-size:15px">ADDRESS <span style="padding-left:13%"> : </span> </b> '+result['AddressDetails']+'</p>' +
                                ' <p style="text-transform: capitalize;"><b style="font-size:15px">PHONE NO. <span style="padding-left:10%"> :</span> </b>'+result['Cellphone']+'</p>' +
                                ' <p style="text-transform: capitalize;"><b style="font-size:15px">NTN. <span style="padding-left:18%"> :</span> </b>'+result['Ntn']+'</p>' +
                                ' <p style="text-transform: capitalize;"><b style="font-size:15px"><strong>TYPE OF JOB <span style="padding-left:7%"> :</span> </strong></b><strong> MECHANICAL</strong></p>' +
                                ' </td> </tr> </tbody></table> </div>' +
                                ' <br> ' +
                                '<div class="description" style="width:100%;margin-left:20px;align:center;">' +
                                ' <p></p><p></p><p></p><p></p><p></p>' +
                                '<table style="width:95%;border-collapse:collapse;">' +
                                ' <tbody><tr> </tr></tbody>' +
                                '<thead style="text-align:center;height:20px;width:95%"> ' +
                                '<tr><th style="align:center;border:2px solid black;font-size:20px;height:30px;" colspan="2">JOB DESCRIPTION</th> ' +
                                '<th style="border:2px solid black;font-size:20px;height:40px;width:20% ">AMOUNT</th> </tr></thead>' +
                                ' <tbody><tr> <td style="float:left;padding-left:30px"></td> <td>&nbsp;</td>' +
                                ' <td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">' +
                                '<p>  </p></td><td> </td></tr>' +
                                ' <tr> <td style="padding-left:25px;font-size:20px"><strong>PARTS</strong><span style="padding-left:80%">' +
                                '<strong>QUANTITY</strong></span>' +
                                '</td> <td>&nbsp;</td> ' +
                                '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">&nbsp;</td> </tr> ' +
                                parts_html +
                                ' <tr> <td style="padding-left:25px;font-size:20px"><strong>SUBLET</strong><span style="padding-left:80%">' +
                                '<strong>QUANTITY</strong></span>' +
                                '</td> <td>&nbsp;</td> ' +
                                '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">&nbsp;</td> </tr> ' +
                                sublet_html +
                                ' <tr> <td style="padding-left:25px;font-size:20px"><strong>LABOUR</strong><span style="padding-left:80%">' +
                                '<strong>HOURS</strong></span>' +
                                '</td> <td>&nbsp;</td> ' +
                                '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right">&nbsp;</td> </tr> ' +
                                labour_html +
                                ' <tr> <td style="float:left;padding-left:30px"></td> <td>&nbsp;</td> ' +
                                '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right"></td>' +
                                '<td> </td></tr>' +
                                ' <tr> <td style="float:left;padding-left:30px"></td> <td style="padding-left:35px"><strong>LABOUR</strong></td> ' +
                                '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;"> Rs. '+parseFloat(result['LabourAmount']).toFixed(2)+'</td>' +
                                ' </tr>' +
                                ' <tr> ' +
                                '<td style="float:left;padding-left:30px"></td> ' +
                                '<td style="padding-left:35px"><strong>SUBLET</strong></td> ' +
                                '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['SubletRepairAmount']).toFixed(2)+'</td>' +
                                ' </tr>' +
                                ' <tr>' +
                                ' <td style="text-align:right" colspan="2"><strong>PARTS </strong></td> ' +
                                '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['PartsAmount']).toFixed(2)+'</td>' +
                                ' </tr> ' +
                                ' <tr>' +
                                ' <td style="text-align:right" colspan="2"><strong> LUB OIL </strong></td> ' +
                                '<td style="width:20%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">Rs. '+parseFloat(result['LubOilAmount']).toFixed(2)+'</td>' +
                                ' </tr> ' +
                                '<tr>' +
                                ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em>TOTAL AMOUNT </em></strong></td> ' +
                                '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                '<strong>Rs. '+parseFloat(result['GrandTotal']).toFixed(2)+'</strong></td> ' +
                                '</tr>' +
                                '<tr>' +
                                ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em> GST </em></strong></td> ' +
                                '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                '<strong>'+result['GSTax']+' %</strong></td> ' +
                                '</tr>' +
                                '<tr>' +
                                ' <td style="text-align:right;font-size:20px" colspan="2"><strong><em>NET TOTAL AMOUNT </em></strong></td> ' +
                                '<td style="width:20%;height:50%;border:1px solid black;border-left:2px solid black;border-right:2px solid black;text-align:right;padding-right:10px;">' +
                                '<strong>Rs. '+parseFloat(result['NetTotal']).toFixed(2)+'</strong></td> ' +
                                '</tr>' +
                                ' </tbody></table> ' +
                                '<!-- <br/><br/><br/><br/><br/> ' +
                                '<p align="center" style="font-size:15px">' +
                                ' <b>SIGNATURE _______________</b></p> --> </div>' +
                                ' <!----> <div style="margin-top:10%"> ' +
                                '<table style="border-bottom:3px solid black;" width="100%"> ' +
                                '<tbody><tr> <td><p style="padding-left:20px">'+Date()+'<span style="padding-left:70%"> Page 1 of 1</span></p></td> </tr>' +
                                ' </tbody>' +
                                '</table>' +
                                ' <p style="padding-left:20px"><b>NOTE: If you have any queries please feel free to contact our <br>' +
                                ' <span style="padding-left:5.5%"> Customer Relations Department.</span> <br> ' +
                                'UAN : 021-111-800-777 <span style="padding-left:50%;font-size:18px"> For </span>' +
                                ' <span style="font-size:20px;margin-right:-9px;">TOYOTA WESTERN MOTORS</span> </b></p>' +
                                ' </div> ' +
                                '</div>'+gst_html;

                            var toPrint = document.getElementById('printArea');
                            var popupWin = window.open('', '_blank', 'width=948px,height=700px,location=no,left=200px');
                            popupWin.document.open();
                            popupWin.document.write('<html><title>::Preview::</title><link rel=Stylesheet href=<?php echo base_url(); ?>assets/invoice/style.css><body onload="window.print()">');
                            popupWin.document.write(html);
                            popupWin.document.write('</html>');
                            popupWin.document.close();


                        } catch (e) {
                            console.log(e);
                        }
                    }

                }
            }
        });



    }

    function checkAndReceivePayment() {

        var $roData = {};
        $roData['idRO'] = $('#idRO').val();
        // $roData['RONumber'] = $('#RONumber').val();
        $roData['idCustomer'] = $('#idCustomer').val();
        $roData['CustomerName'] = $('#CustomerName').val();
        $roData['RegNumber'] = $('#RegNumber').val();
        $roData['FinanceList'] = $('input:radio[name=FinanceList]:checked').val();
        $roData['Labour'] = $('#Labour').val();
        $roData['LubOil'] = $('#LubOil').val();
        $roData['SubletRepair'] = $('#SubletRepair').val();
        $roData['Parts'] = $('#Parts').val();
        $roData['GrandTotal'] = $('#GrandTotal').val();
        $roData['GST'] = $('#GST').val();
        $roData['NetTotal'] = $('#NetTotal').val();
        $roData['idReceivable'] = $('#idReceivable').val();
        $roData['Receivable'] = $('#Receivable').val();
        $roData['PaymentReceived'] = $('#PaymentReceived').val();
        $roData['Discount'] = $('#Discount').val();
        $roData['Balance'] = $('#Balance').val();
        $roData['CashMemo'] = $('#CashMemo').val();
        $roData['CreditMemo'] = $('#CreditMemo').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/rofinance/Update",
            type: "POST",
            data: {data: $roData},
            success: function(data) {
                //  console.log('data');
                //  console.log();
                //  console.log(data);
                if (data !== "")
                {
                    if (data === "Payment Received") {
                        var RROnumber = 	$('#RONumber').val();
                        PrintDoc(RROnumber);
                        //   location.reload();
                    } else {
                        $('#PaymentReceived').val('');
                        if (!$('#CheckRODiv').is(':visible')) {
                            $('#CheckRODiv').show();
                        }
                        $('#CheckRODiv').html("<label style='widht:550px'>Payment of another RO is Not Cleared for this" +
                            " Customer Click the Link to Receive it</label><br>" +
                            "<label><a style='cursor: pointer;margin-left:210px;' onClick=getValues('" + data + "','CheckedRO')>Receive Payment</a></label>");
                    }
                }
            }
        });
    }
</script>

