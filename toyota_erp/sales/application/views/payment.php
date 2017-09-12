<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">
            <?= $Response ?>
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/finance/add" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Payment</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Chassis Number</label>
                            <input type="text" name="SaleNoteNumber" data-validation="required">
                        </div>
                        <div>
                            <label>Enter Payment</label>
                            <input type="text" name="payment" data-validation="required">
                        </div><br>
                        <div style="display: none">
                            <label>Id Customer</label>
                            <input type="text" id="idCustomer" name="idCustomer" readonly>
                        </div>
                        <div>
                            <label>Customer</label>
                            <input type="text" id="Customer" name="Customer" readonly>
                        </div>                      
                        <div>
                            <label>Contact</label>
                            <input type="text" id="Contact" name="Contact" readonly>
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
                            <span class="error-paymentmode cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div>
                        <div>
                            <label>Date</label>
                            <input type="text" class="date" name="date" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Submit Payment">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="15%">Sale Note Number</th>
                                    <th width="18%">Payable</th>
                                    <th width="15%">Receivable</th>
                                    <th width="15%">Receipt</th>
                                    <th width="15%">Balance</th>
                                    <th width="20%">Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script>
    $("input[name=SaleNoteNumber]").keyup(function() {
        var search = $("input[name=SaleNoteNumber]").val();

        $.ajax({
            url: "<?= base_url() ?>index.php/finance/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    $('#idCustomer').val(a['IdCustomer']);
                    $('#Customer').val(a['CustomerName']);
                    $('#CustomerContact').val(a['Cellphone']);
                    try {
                        var items = "";
                        var count = 1;
                        $.each(a, function(i, val) {
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.SaleNoteNumber + "</td>\n\
                            <td class='tbl-name'>" + val.Payable + "</td><td class='tbl-name'>" + val.Receivable + "</td>\n\
                            <td class='tbl-name'>" + val.Receipt + "</td><td class='tbl-name'>" + val.Balance + "</td><td class='tbl-name'>" + val.Date + "</td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>");
                }
            }
        });
    });
    function validationform() {

        paymentMode = $('#PaymentMode').val();
        if (paymentMode === "Select Mode") {
            $('.error-paymentmode').show();
            return false;
        } else {
            $('.error-paymentmode').hide();
            return true;
        }
        chosen = "";
        pass = $("#pass").val();
        confirm_pass = $("#cpass").val();
        if (pass != confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }


    }
    function colorPopup(div_id, id, name, code) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idColor").val(id);
            $(this).find("#color_name").val(name);
            $(this).find("#color_code").val(code);
        });
    }

</script>