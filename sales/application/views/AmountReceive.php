<div id="wrapper">
    <div id="content">

        <div class="right-pnel" class="form validate-form animated fadeIn">


            <div class="form validate-form animated fadeIn">
                <form action="<?= base_url() ?>/index.php/ReceiveAmount/updateamount" method="post">
                    <fieldset>
                        <legend>Receive Amount</legend>
                        <div class="feildwrap">

                            <div>
                                <label>Pbo Number</label>
                                <input name="PboNumber" type="text" value="<?= $receive[0]['PboNumber'] ?>" readonly="">
                            </div>
                            <div>
                                <label>Resourcebook Id</label>
                                <input name="ResourcebookId" type="text" value="<?= $receive[0]['ResourcebookId'] ?>">
                            </div>
                            <div>
                                <label>Chasis Number</label>
                                <input name="ChasisNumber" type="text" value="<?= $receive[0]['ChasisNumber'] ?>">
                            </div>
                            <div>
                                <label>Engine Number</label>
                                <input name="EngineNumber" type="text" value="<?= $receive[0]['EngineNumber'] ?>">
                            </div>

                            <div>
                                <label>Cheque One Amount
                                </label>
                                <input id="ChequeOne" name="ChequeOne" type="text"
                                       value="<?= $receive[0]['ChequeOne'] ?>"><br>
                                <label>Cheque No</label>
                                <input name="ChequeNoOne" type="text" value="<?= $receive[0]['ChequeNoOne'] ?>"><br>
                                <label>Bank One</label>
                                <input name="BankOne" type="text" value="<?= $receive[0]['BankOne'] ?>"><br>
                                <label>Branch One</label>
                                <input name="BranchOne" type="text" value="<?= $receive[0]['BranchOne'] ?>"><br>
                            </div>
                            <div>
                                <label>Cheque Two Amount</label>
                                <input id="ChequeTwo" name="ChequeTwo" type="text"
                                       value="<?= $receive[0]['ChequeTwo'] ?>"><br>
                                <label>Cheque No</label>
                                <input name="ChequeNoTwo" type="text" value="<?= $receive[0]['ChequeNoTwo'] ?>"><br>
                                <label>Bank Two</label>
                                <input name="BankTwo" type="text" value="<?= $receive[0]['BankTwo'] ?>"><br>
                                <label>Branch Two</label>
                                <input name="BranchTwo" type="text" value="<?= $receive[0]['BranchTwo'] ?>"><br>
                            </div>
                            <div>
                                <label>Cheque Three Amount</label>
                                <input id="ChequeThree" name="ChequeThree" type="text"
                                       value="<?= $receive[0]['ChequeThree'] ?>"><br>
                                <label>Cheque No</label>
                                <input name="ChequeNoThree" type="text" value="<?= $receive[0]['ChequeNoThree'] ?>"><br>
                                <label>Bank Three</label>
                                <input name="BankThree" type="text" value="<?= $receive[0]['BankThree'] ?>"><br>
                                <label>Branch Three</label>
                                <input name="BranchThree" type="text" value="<?= $receive[0]['BranchThree'] ?>"><br>
                            </div>
                            <div>
                                <label>Total Amount</label>
                                <input id="totalamount" name="TotalAmount" type="text"
                                       value="<?= intval($receive[0]['TotalAmount']); ?>"><br>
                            </div>
                            <div>
                                <label>Amount Paid</label>
                                <input id="amountpaid" name="Balance" type="text" value="<?= $receive[0]['Balance'] ?>">
                            </div>
                            <div>
                                <label>Remaining</label>
                                <input id="remaining" name="Remaining" type="text"
                                       value="<?= $receive[0]['Remaining'] ?>">
                            </div>


                            <input type="submit" class="btn" value="Update" style="width: 187px;">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var amount = parseInt($('#ChequeOne').val()) + parseInt($('#ChequeTwo').val()) + parseInt($('#ChequeThree').val());
        $('#amountpaid').val(amount.toString());
        var remaining = parseInt($('#totalamount').val()) - amount;
        $('#remaining').val(remaining.toString());
    });
    $('#ChequeOne').keyup(function () {
        var amount = parseInt($('#ChequeOne').val()) + parseInt($('#ChequeTwo').val()) + parseInt($('#ChequeThree').val());
        $('#amountpaid').val(amount.toString());
        var remaining = parseInt($('#totalamount').val()) - amount;
        $('#remaining').val(remaining.toString());

        if (amount > $('#totalamount').val()) {

            alert('Amount Is Greater Than Reamining Amount');
            var remaining = parseInt($(this).val()) + remaining;
            var totalAmount = parseInt($('#amountpaid').val()) - parseInt($(this).val());
            $('#amountpaid').val(totalAmount.toString());
            $('#remaining').val(remaining.toString());
            $(this).val(0);
        }
    });

    $('#ChequeTwo').keyup(function () {
        var amount = parseInt($('#ChequeOne').val()) + parseInt($('#ChequeTwo').val()) + parseInt($('#ChequeThree').val());
        $('#amountpaid').val(amount.toString());
        var remaining = parseInt($('#totalamount').val()) - amount;
        $('#remaining').val(remaining.toString());

        if (amount > $('#totalamount').val()) {

            alert('Amount Is Greater Than Reamining Amount');
            var remaining = parseInt($(this).val()) + remaining;
            var totalAmount = parseInt($('#amountpaid').val()) - parseInt($(this).val());
            $('#amountpaid').val(totalAmount.toString());
            $('#remaining').val(remaining.toString());
            $(this).val(0);
        }
    });
    $('#ChequeThree').keyup(function () {
        var amount = parseInt($('#ChequeOne').val()) + parseInt($('#ChequeTwo').val()) + parseInt($('#ChequeThree').val());
        $('#amountpaid').val(amount.toString());
        var remaining = parseInt($('#totalamount').val()) - amount;
        $('#remaining').val(remaining.toString());

        if (amount > $('#totalamount').val()) {

            alert('Amount Is Greater Than Reamining Amount');
            var remaining = parseInt($(this).val()) + remaining;
            var totalAmount = parseInt($('#amountpaid').val()) - parseInt($(this).val());
            $('#amountpaid').val(totalAmount.toString());
            $('#remaining').val(remaining.toString());
            $(this).val(0);
        }
    });

    $('#amountpaid').focusout(function () {
        var remaining = parseInt($('#totalamount').val()) - parseInt($(this).val());
        $('#remaining').val(remaining.toString());
        var remaining = parseInt($('#totalamount').val()) - amount;
        $('#remaining').val(remaining.toString());


    });
</script>