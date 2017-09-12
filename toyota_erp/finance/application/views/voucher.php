<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin" || $data['Role'] == "FinanceAdmin") {
            include 'include/finance_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="voucherform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/voucher/Add" class="form validate-form animated fadeIn">
                <?php echo $insertMessage ?><br>
                <fieldset>
                    <legend onclick="DoToggle('#VoucherInfoDiv')">Voucher</legend>
                    <br><div id="VoucherInfoDiv" class="feildwrap">
                        <div>
                            <label>Voucher#</label>
                            <input id="VoucherNumber" type="number" name="VoucherNumber" value="<?php echo $voucherNumber ?>" placeholder="Voucher Number" style="width:250px;">
                        </div>
                        <div>
                            <label>Vendor Name</label>
                            <select id="idVendor" name="idVendor" class="">
                                <option>Select Vendor</option>
                                <?php
                                foreach ($vendorsList as $key) {
                                    ?>
                                    <option value="<?= $key['idVendor'] ?>" ><?= $key['VendorName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-vouchers cb-error help-block" style="margin-left: 250px;margin-top: -75px">Option must be selected!</span>
                        </div>
                        <div>
                            <label>Amount</label>
                            <input id="Amount" type="text" name="Amount" placeholder="Amount to be Paid" onchange="calculateNetTotal();" data-validation = "required">
                        </div>
                        <div>
                            <label>GST</label>
                            <input id="GST" type="text" name="GST" value="16" placeholder="GST" data-validation = "">
                        </div>
                        <div>
                            <label>Discount</label>
                            <input id="Discount" type="text" name="Discount" value="0" placeholder="Discount" onchange="calculateNetTotal();"  data-validation = "">
                        </div>
                        <div>
                            <label>Net-Total Amount</label>
                            <input id="NetTotal" type="text" name="NetTotal" placeholder="Total Amount"  data-validation = "" >
                        </div>                       
                        <div>
                            <label>Registration Number</label>
                            <input id="RegistrationNo" type="text" name="RegistrationNo" placeholder="Registration Number"  data-validation = "">
                        </div>
                        <div>
                            <label>Chassis Number</label>
                            <input id="ChassisNo" type="text" name="ChassisNo" placeholder="Chassis Number"  data-validation = "">
                        </div><br>
                        <div>
                            <label>Reference Number</label>
                            <input id="RefNo" type="text" name="RefNo" placeholder="Reference Number"  data-validation = "">
                        </div>
                        <div>
                            <label>Description</label>
                            <textarea id="Description" name="Description" placeholder="Description..." style="margin: 0px; width: 724px; height: 100px;"></textarea>
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Save" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>

    function calculateNetTotal() {
        var amount = $("#Amount").val();
        var gst = $("#GST").val();
        var discount = $("#Discount").val();
        var netTotal = ((gst / 100) * (amount) + parseInt(amount) - (discount));
        $('#NetTotal').val(netTotal);
    }

    function validationform() {
        var vendorName = $('#idVendor').val();
        if (vendorName === "Select Vendor")
        {
            $(".error-vouchers").show();
            return false;
        } else {
            return true;
        }
    }
</script>