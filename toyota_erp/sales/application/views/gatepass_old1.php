<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">
            <?= $Response ?>
            <form name="myform"  method="post"
                  action="<?= base_url() ?>index.php/gatepass/newGatepass" onsubmit="return validationform()" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Gate Pass</legend>
                    <div class="feildwrap">
                        <div>
                            <label>&nbsp;</label>
                            <select id="gpType" name="gatepassType">
                                <option value="Select">Select</option>
                                <option value="PBO">PBO</option>
                                <option value="Open Stock">Open Stock</option>
                            </select>
                        </div>
                        <br>
                        <div id="gpPbo">
                            <label>Enter PBO Number</label>
                            <input type="text" name="PboNumber">
                        </div>
                        <div id="gpChasis">
                            <label>Enter Chasis Number</label>
                            <input type="text" name="ChasisNo">
                            <span>
                                <h4 id="paymentErr" style=" margin-left: 200px; "></h4>
                            </span>
                        </div>
                        <br>
                        <!-- PBO -->
                        <fieldset id="pbodetails">
                            <legend>PBO Details</legend>
                            <div style="display: none;">
                                <label>PBO Id</label>
                                <input type="text" name="pboid">
                            </div>
                            <div>
                                <label>PBO Number</label>
                                <input type="text" name="pboNumber" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Customer Name</label>
                                <input type="text" name="CustomerName" readonly>
                            </div>
                            <div>
                                <label>Chassis Number</label>
                                <input type="text" name="ChasisNumber" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Engine Number</label>
                                <input type="text" name="EngineNumber" readonly>
                            </div>
                            <div>
                                <label>Variant Name</label>
                                <input type="text" name="VariantName" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Variant Color</label>
                                <input type="text" name="VariantColor" readonly>
                            </div>
                            <div>
                                <label>Displacement</label>
                                <input type="text" name="Displacement" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Booking Price</label>
                                <input type="text" name="BookingPrice" readonly>
                            </div>
                        </fieldset>
                        <!-- Open Stock Sale Note -->
                        <fieldset id="openstockdetails">
                            <legend>Open Stock Details</legend>
                            <div style="display: none;">
                                <label>Dispatch Id</label>
                                <input type="text" name="DispatchId">
                            </div>
                            <div style="display: none;">
                                <label>Sale Note Id</label>
                                <input type="text" name="SaleNoteId">
                            </div>
                            <div>
                                <label>Sale Note Number</label>
                                <input type="text" name="SaleNoteNumber" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Customer Name</label>
                                <input type="text" name="CustomerName" readonly>
                            </div>
                            <div>
                                <label>Chassis Number</label>
                                <input type="text" name="ChasisNumber" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Engine Number</label>
                                <input type="text" name="EngineNumber" readonly>
                            </div>
                            <div>
                                <label>Variant Name</label>
                                <input type="text" name="VariantName" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Variant Color</label>
                                <input type="text" name="VariantColor" readonly>
                            </div>
                            <div>
                                <label>Displacement</label>
                                <input type="text" name="Displacement" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Booking Price</label>
                                <input type="text" name="BookingPrice" readonly>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Gate Pass Details</legend>
                            <div>
                                <?php
                                $cookieData = unserialize($_COOKIE['logindata']);
                                $GatePassSerial = $cookieData['Code'] . "-000" . $GatePassNumber[0]['GatePassNumber'];
                                $DoSerial = $cookieData['Code'] . "-000" . $DoNumber[0]['DONumber'];
//                                echo $GatePassSerial;
//                                print_r($GatePassNumber);
                                ?>
                                <label>Gate Pass Number</label>
                                <input type="text" name="GatePassNumber" data-validation="required" value="<?= $GatePassSerial ?>">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Gate Pass Date</label>
                                <input type="text" name="GatePassDate" class="date" data-validation="required">
                            </div>
                            <div>
                                <label>Through</label>
                                <input type="text" name="Through">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>CNIC</label>
                                <input class="hash" type="text" name="Cnic" data-validation="required">
                            </div>
                            <div>
                                <label>Registration Number</label>
                                <input type="text" name="RegistrationNumber">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Company Name</label>
                                <input type="text" name="CompanyName">
                            </div>
                            <div>
                                <label>&nbsp;</label>
                                <input type="checkbox" id="dOrder" name="dOrder" value="check">Generate Delivery Order
                            </div>
                            <div style="margin-left: 40px;display: none;" id="do">
                                <label>DO Number</label>
                                <input type="text" name="do" value="<?= $DoSerial ?>">
                            </div>
                        </fieldset>
                    </div>
                    <input type="submit" value="Create GatePass" id="btnGatePass" class="btn" style="margin-left: 425px;">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    $('#dOrder').click(function() {
        $("#do").toggle(this.checked);
    });

    $("#gpType").change(function() {
        if ($('#gpType').val() == 'Open Stock') {
            $('#gpChasis').show();
            $('#openstockdetails').show();
            $('#gpPbo').hide();
            $('#pbodetails').hide();
            $('#btnGatePass').hide();
        } else if ($('#gpType').val() == 'PBO') {
            $('#gpPbo').show();
            $('#pbodetails').show();
            $('#gpChasis').hide();
            $('#openstockdetails').hide();
        } else {
            $('#gpPbo').hide();
            $('#pbodetails').hide();
            $('#gpChasis').hide();
            $('#openstockdetails').hide();
        }
    });

    $("input[name=PboNumber]").keyup(function() {
        var PBONumber = $("input[name=PboNumber]").val();
        console.log(PBONumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/gatepass/getpbo",
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

    $("input[name=ChasisNo]").keyup(function() {
        var ChasisNumber = $("input[name=ChasisNo]").val();
        console.log(ChasisNumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/gatepass/getSaleNote",
            type: "POST",
            data: {ChasisNo: ChasisNumber},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    $('#btnGatePass').show();
                    try {
                        $.each(a, function(i, val) {
                            if (val != ".") {
                                $('#paymentErr').html("");
                                $("input[name=SaleNoteId]").val(val.idSaleNote);
                                $("input[name=DispatchId]").val(val.idDispatch);
                                $("input[name=SaleNoteNumber]").val(val.SaleNoteNumber);
                                $("input[name=CustomerName]").val(val.CustomerName);
                                $("input[name=ChasisNumber]").val(val.ChasisNo);
                                $("input[name=EngineNumber]").val(val.EngineNo);
                                $("input[name=Displacement]").val(val.DisplacementName);
                                $("input[name=VariantName]").val(val.Variants);
                                $("input[name=VariantColor]").val(val.ColorName);
                                $("input[name=BookingPrice]").val(val.BookingPrice);
                            } else {
//                                $('#paymentErr').html(data);
                            }
                        });
//                        $('#paymentErr').html(data);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $('#btnGatePass').hide();
                    $.ajax({
                        url: "<?= base_url() ?>index.php/gatepass/getpayment",
                        type: "POST",
                        data: {ChasisNo: ChasisNumber},
                        success: function(data) {
                            console.log(data);
                            var a = JSON.parse(data);
                            console.log(a.length);
                            if (a.length > 0) {
                                try {
                                    $.each(a, function(i, val) {
                                        if (val != ".") {
                                            $('#paymentErr').html("Please Clear Your Payment First <br> Rs. " + val + " Payment Left.");
                                        } else {
                                            $('#paymentErr').html(data);
                                        }
                                    });
                                } catch (e) {
                                    console.log(e);
                                }
                            } else {
                                $('#paymentErr').html("Given Chasis Number is not Exists.");
                            }
                        }
                    });
                    $("input[name=SaleNoteId]").val("");
                    $("input[name=SaleNoteNumber]").val("");
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