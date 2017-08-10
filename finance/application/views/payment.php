<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin" || $data['Role'] == "FinanceAdmin") {
            include 'include/finance_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="paymentform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/payment/Transaction" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Payments</legend>
                    <div class="feildwrap">
                        <div style="margin-left: 135px;width: 100px;">
                            <fieldset>
                                <legend>Payment Type</legend>
                                <div style="margin-left: 200px;">
                                    <span>Receivables</span>
                                    <input id="isReceivables" name="transactionType" type="radio" value="Receivables" onclick="checkTransactionType(this);">
                                </div>
                                <div style="margin-left: 50px;">
                                    <span>Payable</span>
                                    <input id="isPayable" name="transactionType" type="radio" value="Payable" onclick="checkTransactionType(this);">
                                </div>
                            </fieldset>
                        </div><br>
                        <div id="PaymentDiv" class="feildwrap" style="display: none">
                            <fieldset style="margin-left: 135px;width: 200px;">     
                                <legend>Receivables / Payable</legend><br><br>
                                <div id="PaymentStatusDiv" style="display: none;margin-left: 115px;">
                                    <label id="PaymentStaus"></label>
                                </div><br><br>
                                <div id="DepartmentDiv" style="">
                                    <label>Department</label>
                                    <select id="DepartmentName" name="DepartmentName" onchange="" style="width: 270px;">
                                        <option value="">Select Department</option>
                                        <option value="SalesDepartment">Sales</option>
                                        <option value="ServiceDepartment">Service</option>
                                        <option value="PartsDepartment">Parts</option>                                  
                                        <option value="GeneralDepartment">General</option>                                  
                                        <option value="TCUVDepartment">TCUV</option>                                  
                                    </select>
                                    <span class="error-departments cb-error help-block" style="margin-left: 460px;margin-top: -35px">Option must be selected!</span>
                                </div><br>
                                <div id="CustomerDiv" style="">
                                    <label>Customer</label>
                                    <select id="idCustomer" name="idCustomer" onchange="getTotalPayment(this, 'Customer');" style="width: 270px;">
                                        <option>Select Customer</option>
                                        <?php
                                        foreach ($customersList as $key) {
                                            ?>
                                            <option value="<?= $key['idCustomer'] ?>" ><?= $key['Customer'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="error-customers cb-error help-block" style="margin-left: 460px;margin-top: -35px">Option must be selected!</span>
                                </div><br>
                                <div id="VendorDiv" style="">
                                    <label>Vendor/Company</label>
                                    <select id="idVendor" name="idVendor" class="chosen-select" onchange="getTotalPayment(this, 'Vendor');">
                                        <option>Select Vendor</option>
                                        <?php
                                        foreach ($vendorsList as $key) {
                                            ?>
                                            <option value="<?= $key['idVendor'] ?>" ><?= $key['VendorName'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="error-vendors cb-error help-block" style="margin-left: 460px;margin-top: -35px">Option must be selected!</span>
                                </div>
                                <div id="PayableDiv"> 
                                    <input id="idPayable" name="idPayable" type="hidden">
                                    <label>Total Payable</label>
                                    <input id="TotalPayable" name="PayableAmount" type="text" placeholder="Total Payable" data-validation="" readonly>
                                </div>
                                <div id="PayableDateDiv">
                                    <label>Payable Date</label>
                                    <input id="PayableDate" name="PayableDate" type="text" placeholder="Total Receivables" data-validation="" readonly>
                                </div>
                                <div id="ReceivablesDiv">
                                    <input id="idReceivables" name="idTotalAmount" type="hidden">
                                    <label>Total Receivables</label>
                                    <input id="TotalReceivables" name="TotalAmount" type="text" placeholder="Total Receiveables" data-validation="" readonly>
                                </div><br>
                                <div>
                                    <label>Department</label>
                                    <input id="From" name="From" type="text" placeholder="Belong to" data-validation="" readonly>
                                </div><br>
                                <div id="ReceivablesDateDiv">
                                    <label>Receivables Date</label>
                                    <input id="ReceivablesDate" name="ReceivablesDate" type="text" placeholder="Total Receivables" data-validation="" readonly>
                                </div>
                                <div>
                                    <label>Payment Received</label>
                                    <input id="PaymentReceived" name="PaymentReceived" type="number" min="0" placeholder="Enter Received Payment" data-validation="required" style="width: 250px;">
                                </div><br>
                                <div id="VendorDiv">
                                    <label>Payment Mode</label>
                                    <select id="PaymentMode" name="PaymentMode" style="width:250px;">
                                        <option>Select Mode</option>
                                        <?php
                                        foreach ($paymentModes as $key) {
                                            ?>
                                            <option value="<?= $key['PaymentType'] ?>" ><?= $key['PaymentType'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="error-paymentmode cb-error help-block" style="margin-left: 460px;margin-top: -35px">Option must be selected!</span>
                                </div><br>
                                <div>
                                    <label>Reference No.</label>
                                    <input id="RefernceNo" name="RefernceNo" type="text" placeholder="Refernce Number" data-validation="">
                                </div><br>
                                <div>
                                    <label>Description</label>
                                    <textarea id="Description" name="Description" placeholder="Description..." style="margin: 0px; width: 430px; height: 100px;"></textarea>
                                </div><br>                                
                            </fieldset>
                            <div class="btn-block-wrap">
                                <label>&nbsp;</label>
                                <input type="submit" class="btn" value="Save" style="float:right;width: 100px;">
                            </div> 
                        </div>                      
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#PaymentDiv').hide();
    });
    function checkTransactionType(object) {

        var transactionType = $(object).val();
        $('#PaymentDiv').show();
        if (transactionType === 'Receivables') {
            $('#VendorDiv').hide();
            $('#PayableDiv').hide();
            $('#PayableDateDiv').hide();
            $('#CustomerDiv').show();
            $('#ReceivablesDiv').show();
            $('#ReceivablesDateDiv').show();
        } else {
            $('#CustomerDiv').hide();
            $('#ReceivablesDiv').hide();
            $('#ReceivablesDateDiv').hide();
            $('#VendorDiv').show();
            $('#PayableDiv').show();
            $('#PayableDateDiv').show();
        }
    }

    function getTotalPayment(object, type) {
        var idParty = $(object).val();
        var department = $("#DepartmentName option:selected").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/payment/search",
            type: "POST", data: {idParty: idParty, party: type, department: department},
            success: function(data) {
                if (data != "")
                {
                    var parsedData = JSON.parse(data);

                    if (parsedData.length > 0) {
                        $('#PaymentStatusDiv').show();
                        if (type === "Customer") {
                            $('#PaymentStaus').html('Dear Customer, Amount of ' + parsedData[0]['ReceiveableAmount'] + '/= is Due on your name.');
                            $('#idReceivables').val(parsedData[0]['idReceivable']);
                            $('#TotalReceivables').val(parsedData[0]['ReceiveableAmount']);
                            $('#ReceivablesDate').val(parsedData[0]['ReceivableDate'] + ', ' + parsedData[0]['ReceivableTime']);
                            $('#From').val(parsedData[0]['FromDepartment']);

                        } else {
                            if (type === "Vendor") {
                                $('#PaymentStaus').html('Amount of, ' + parsedData[0]['PayableAmount'] + '/= is Due on Dealership.');
                                $('#idPayable').val(parsedData[0]['idPayable']);
                                $('#TotalPayable').val(parsedData[0]['PayableAmount']);
                                $('#PayableDate').val(parsedData[0]['PayableDate'] + ', ' + parsedData[0]['PayableTime']);
                                $('#From').val(parsedData[0]['FromDepartment']);
                            }
                        }
                    }
                    else {
                        $('#PaymentStatusDiv').show();
                        if (type === "Customer") {
                            $('#PaymentStaus').html('Payment is Clear for this Customer.');
                        }
                        else {
                            $('#PaymentStaus').html('Payment is Clear for this Vendor.');
                        }
                    }
                }
            }
        });
    }

    function validationform() {
        var type = $("input[name='transactionType']:checked").val();
        var paymentMode = $("select[name='PaymentMode']").val();
        if (type === "Payable") {
            var vendorName = $("select[name='idVendor']").val();
            if (vendorName === "Select Vendor" && paymentMode === "Select Mode")
            {
                $(".error-vendors").show();
                $(".error-paymentmode").show();
                return false;
            } else {
                if (vendorName === "Select Vendor" || paymentMode === "Select Mode")
                {
                    if (vendorName === "Select Vendor") {
                        $(".error-vendors").show();
                    } else {
                        $(".error-vendors").hide();
                    }

                    if (paymentMode === "Select Mode") {
                        $(".error-paymentmode").show();
                    } else {
                        $(".error-paymentmode").show();
                    }
                    return false;
                }
                return true;
            }
        } else {
            var customerName = $("select[name='idCustomer']").val();
            if (customerName === "Select Customer" && paymentMode === "Select Mode")
            {
                $(".error-customers").show();
                $(".error-paymentmode").show();
                return false;
            } else {
                if (customerName === "Select Customer" || paymentMode === "Select Mode")
                {
                    if (customerName === "Select Customer") {
                        $(".error-customers").show();
                    } else {
                        $(".error-customers").hide();
                    }
                    if (paymentMode === "Select Mode") {
                        $(".error-paymentmode").show();
                    } else {
                        $(".error-paymentmode").show();
                    }
                    return false;
                }
                return true;
            }
        }
    }

</script>