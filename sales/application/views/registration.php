`<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['username'] == "admin") {
//            include 'include/admin_leftmenu.php';
//        } else if ($cookieData['Role'] == "Sales Admin") {
//            include 'include/sales_leftmenu.php';
//        } else if ($cookieData['Role'] == "Director") {
//            include 'include/director_menu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <form name="myform"  method="post"
                  action="<?= base_url() ?>index.php/invoice/newInvoice" onsubmit="return validationform()" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Registration</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Enter PBO Number</label>
                            <input type="text" name="PboNumber">
                        </div>
                        <br>
                        <fieldset>
                            <legend>PBO Details</legend>
                            <div style="display: none;">
                                <label>PBO Id</label>
                                <input type="text" name="pboid">
                            </div>
                            <div>
                                <label>PBO Number</label>
                                <input type="text" name="pboNumber" readonly="">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Customer Name</label>
                                <input type="text" name="CustomerName" readonly="">
                            </div>
                            <div>
                                <label>Chassis Number</label>
                                <input type="text" name="ChasisNumber" readonly="">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Engine Number</label>
                                <input type="text" name="EngineNumber" readonly="">
                            </div>
                            <div>
                                <label>Variant Name</label>
                                <input type="text" name="VariantName" readonly="">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Variant Color</label>
                                <input type="text" name="VariantColor" readonly="">
                            </div>
                            <div>
                                <label>Displacement</label>
                                <input type="text" name="Displacement" readonly="">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Booking Price</label>
                                <input type="text" name="BookingPrice" readonly="">
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Invoice Details</legend>
                            <div>
                                <label>Invoice Number</label>
                                <input type="text" name="InvoiceNumber" data-validation="required">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Invoice Date</label>
                                <input type="text" name="InvoiceDate" class="date" data-validation="required">
                            </div>
                            <div>
                                <label>Certificate Number</label>
                                <input type="text" name="CertificateNumber">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Model Year</label>
                                <input type="text" name="ModelYear" data-validation="required">
                            </div>
                            <div>
                                <label>Remarks</label>
                                <textarea name="remarks" style="width: 250px;"></textarea>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Received From</label>
                                <select name="ReceivedFrom">
                                    <option value="None">None</option>
                                    <option value="Bank">Bank</option>
                                    <option value="IMC">IMC</option>
                                </select>
                            </div>
                            <div>
                                <label>Invoice Amount</label>
                                <input type="text" name="InvoiceAmount">
                            </div>
                        </fieldset>
                    </div>
                    <input type="submit" value="Create Invoice" class="btn" style="margin-left: 425px;">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    $("input[name=PboNumber]").keyup(function() {
        var PBONumber = $("input[name=PboNumber]").val();
        console.log(PBONumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/invoice/getpbo",
            type: "POST",
            data: {Pbo: PBONumber},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        $.each(a, function(i, val) {
                            $("input[name=pboid]").val(val.PboId);
                            $("input[name=pboNumber]").val(val.PboNumber);
                            $("input[name=CustomerName]").val(val.CustomerName);
                            $("input[name=ChasisNumber]").val(val.ChasisNumber);
                            $("input[name=EngineNumber]").val(val.EngineNumber);
                            $("input[name=Displacement]").val(val.DisplacementName);
                            $("input[name=VariantName]").val(val.Variants);
                            $("input[name=VariantColor]").val(val.ColorName);
                            $("input[name=BookingPrice]").val(val.BookingPrice);
                        });
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("input[name=pboid]").val("aaa");
                    $("input[name=pboNumber]").val("");
                    $("input[name=CustomerName]").val("");
                    $("input[name=ChasisNumber]").val("");
                    $("input[name=EngineNumber]").val("");
                    $("input[name=VariantName]").val("");
                    $("input[name=VariantColor]").val("");
                    $("input[name=Displacement]").val("");
                    $("input[name=BookingPrice]").val("");
                }
            }
        });
    });

    function validationform() {
        var chosen = "";
        var pass = $("#pass").val();
        var confirm_pass = $("#cpass").val();
        var Color = $("#ColorList :selected").html();
        var VariantColor = $("input[name=variant_color]").val();
//        if (Color !== VariantColor) {
//            $(".error-model").show();
//            return false;
//        } else {
//            $(".error-model").hide();
//            return true;
//        }

//        var engine = $("#engine").text();
//        var chasis = $("#chasis").text();
//        if (engine !== 'Already Exists in Database!') {
//            $('.error-engine').hide();
//            if (chasis !== 'Already Exists in Database!') {
//                $('.error-chasis').hide();
//            } else {
//                $('.error-chasis').show();
//                return false;
//            }
//        } else {
//            $('.error-engine').show();
//            return false;
//        }


    }

    function variantPopup(div_id, id, name, model, modelCode, modelDes, price, make, engine, displacement, freight, totalprice, color) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//            $(this).find(".color").attr('checked', false);
            $(this).find("#idVariant").val(id);
            $(this).find("#variant_name").val(name);
            $(this).find("#model").val(model);
            $(this).find("#modelCode").val(modelCode);
            $(this).find("#price").val(price);
            $(this).find("#modelDes").val(modelDes);
            $(this).find("#engine").val(engine);
            $(this).find("#displacement").val(displacement);
            $(this).find(".make[value='" + make + "']").attr('checked', true);
            $(this).find("#freight").val(freight);
//            $(this).find(".color[value='" + color + "']").attr('checked', true);
            $(this).find("#totalprice").val(totalprice);
            $.ajax({
                url: '<?= base_url() ?>index.php/variants/ColorByVariant',
                type: 'POST',
                data: {idVariant: id},
                success: function(data) {
                    console.log(data);
                    var a = JSON.parse(data);
                    alert(JSON.stringify(data));
                    console.log(a.length);
                    var items = [];
                    for (var val = 0; val <= a.lenght; val++) {
                        items += $(this).find(".color[value='" + val.ColorId + "']").attr('checked', true);
                        $("#color").html(items);
                        console.log("Donee...");
                    }
//                    try {
//
//                        $.each(a, function(i, val) {
////                            items += JSON.stringify($(this).find(".color[value='" + val[ColorId] + "']").attr('checked', true));
//                            items += ($(this).find(".color[value='" + val.ColorId + "']").attr('checked', true));
//                        });
//                        $('#color').html(items);
//
//                    } catch (e) {
//                        console.log(e);
//                    }
                }
//                    $(this).find(".color[value='" + color + "']").attr('checked', true);
            });
        });
    }
</script>