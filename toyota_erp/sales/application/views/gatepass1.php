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


                        <!-- PBO -->
                        <fieldset id="pbodetailss">
                            <legend>Customer Details</legend>


                            <div>
                                <label>Customer Type</label>
                                <select  id="customerType">
                                    <option value="0" >Select Category</option>
                                    <?php
                                    if ($customertype) {
                                        for ($i = 0; $i < count($customertype); $i++) {
                                            echo '<option value="' . $customertype[$i]['Id'] . '" >' . $customertype[$i]['CustomerType'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Customer Name</label>
                                <input type="text" name="CustomerName" value="<?= $dispatchdata->CustomerName?>" readonly>
                            </div>
                            <div>
                                <label>Father Name</label>
                                <input type="text" name="FatherName" value="<?= $dispatchdata->FatherName?>" readonly>
                            </div>
                            <div >
                                <label>Address</label>
                                <input type="text" name="Address" value="<?= $dispatchdata->AddressDetails?>" readonly>
                            </div>

                            <div >
                                <label>Phone</label>
                                <input type="text" name="Phone" value="<?= $dispatchdata->Cellphone?>" readonly>
                            </div>

                            <div >
                                <label>City</label>
                                <input type="text" name="City" value="<?= $dispatchdata->City?>" readonly>
                            </div>


                            <div>
                                <label>CNIC</label>
                                <input type="text" name="Cnic" value="<?= $dispatchdata->Cnic?>" data-validation="required">
                            </div>
                            <div >
                                <label>Company Name</label>
                                <input type="text" name="CompanyName" value="<?= $dispatchdata->CompanyName?>">
                            </div>
                            <div >
                                <label>NTN</label>
                                <input type="text" name="NTN" value="<?= $dispatchdata->Ntn?>">
                            </div>

                        </fieldset>

                        <fieldset id="">
                            <legend>PBO Details</legend>
                            <div >
                                <label>PBO Id</label>
                                <input type="text" name="pboid" readonly value="<?= $dispatchdata->pboid?>">
                            </div>
                            <div>
                                <label>PBO Number</label>
                                <input type="text" name="pboNumber" value="<?= $dispatchdata->PboNumber?>" readonly>
                            </div>

                            <div>
                                <label>Chassis Number</label>
                                <input type="text" name="ChasisNumber" value="<?= $dispatchdata->ChasisNo?>" readonly>
                            </div>
                            <div>
                                <label>Engine Number</label>
                                <input type="text" name="EngineNumber" value="<?= $dispatchdata->EngineNo?>" readonly>
                            </div>
                            <div>
                                <label>Variant Name</label>
                                <input type="text" name="VariantName" value="<?= $dispatchdata->Variants?>" readonly>
                            </div>
                            <div>
                                <label>Variant Color</label>
                                <input type="text" name="VariantColor" value="<?= $dispatchdata->ColorName?>" readonly>
                            </div>

                            <div>
                                <label>Purpose</label>
                                <input type="text" name="Through" >
                            </div>
                            <div>
                                <label>Description</label>
                                <input type="text" name="Description"  readonly>
                            </div>

                            <div>
                                <label>Registration Number</label>
                                <input type="text" name="" value="<?= $dispatchdata->RegistrationNumber?>">
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
                                <input type="text" name="GatePassNumber"  data-validation="required" value="<?= $GatePassSerial ?>">
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Gate Pass Date</label>
                                <input type="text" name="GatePassDate" class="date" data-validation="required">
                            </div>
                            
                            <div>
                                <label>Customer Id</label>
                                <input type="text" name="CustomerId" value="<?= $dispatchdata->IdCustomer?>"  readonly >
                            </div>
                            
                            <div >
                                <label>Dispatch Id</label>
                                <input type="text" name="DispatchId" value="<?= $dispatchdata->idDispatch?>" readonly>
                            </div>


                            <!--                            <div>
                                                            <label>&nbsp;</label>
                                                            <input type="checkbox" id="dOrder" name="dOrder" value="check">Generate Delivery Order
                                                        </div>
                                                        <div style="margin-left: 40px;display: none;" id="do">
                                                            <label>DO Number</label>
                                                            <input type="text" name="do" value="<?= $DoSerial ?>">
                                                        </div>-->
                        </fieldset>
                    </div>
                    <input type="submit" value="Create GatePass" id="btnGatePass" class="btn" style="margin-left: 425px;">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    $('#dOrder').click(function () {
        $("#do").toggle(this.checked);
    });
    $('#pbodetails').show();
    $("#gpType").change(function () {
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

    $("input[name=PboNumber]").keyup(function () {
        var Typee = '<?php echo json_encode($customertype); ?>';
        var Typeee = JSON.parse(Typee);
        var customerType = {
            idType: '',
            Type: ''
        };

        var arrCustomerTpye = [];
        $.each(Typeee, function (index, name) {
            customerType = {
                idType: name['Id'],
                Type: name['CustomerType']
            };
            arrCustomerTpye.push(customerType);
        });
        var PBONumber = $("input[name=PboNumber]").val();
        console.log(PBONumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/gatepass/getpbo",
            type: "POST",
            data: {Pbo: PBONumber},
            success: function (data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        var html = '';
                        $.each(a, function (i, val) {
                            for (i = 0; i < arrCustomerTpye.length; i++) {
                                var selection2 = val['CustomerType'] == arrCustomerTpye[i].idType ? 'selected' : '';
                                html += '<option value="' + arrCustomerTpye[i].idType + '"' + selection2 + '>' + arrCustomerTpye[i].Type + '</option>';
                            }
                            $("input[name=pboid]").val(val.PboId);
                            $("input[name=pboNumber]").val(val.PboNumber);
                            $("input[name=CustomerName]").val(val.CustomerName);
                            $("input[name=FatherName]").val(val.FatherName);
                            $("input[name=Address]").val(val.AddressDetails);
                            $("input[name=Phone]").val(val.Celphone);
                            $("input[name=Cnic]").val(val.CNIC);
                            $("input[name=City]").val(val.City);
                            $("input[name=CompanyName]").val(val.CompanyName);
                            $("input[name=NTN]").val(val.NTN);

                            $("input[name=ChasisNumber]").val(val.ChasisNumber);
                            $("input[name=EngineNumber]").val(val.EngineNumber);
                            $("input[name=Displacement]").val(val.DisplacementName);
                            $("input[name=VariantName]").val(val.Variants);
                            $("input[name=VariantColor]").val(val.ColorName);
                            $("input[name=BookingPrice]").val(val.BookingPrice);
                            $("input[name=RegistrationNumber]").val(val.RegistrationNumber);
                            $("input[name=CustomerId]").val(val.CustomerId);
                            $("input[name=DispatchId]").val(val.DispatchId);
                        });

                        $('#customerType').html(html);
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
                    $("input[name=RegistrationNumber]").val("");
                }
            }
        });
    });

    $("input[name=ChasisNo]").keyup(function () {
        var Typee = '<?php echo json_encode($customertype); ?>';
        var Typeee = JSON.parse(Typee);
        var customerType = {
            idType: '',
            Type: ''
        };

        var arrCustomerTpye = [];
        $.each(Typeee, function (index, name) {
            customerType = {
                idType: name['Id'],
                Type: name['CustomerType']
            };
            arrCustomerTpye.push(customerType);
        });
        var ChasisNumber = $("input[name=ChasisNo]").val();
//        console.log(ChasisNumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/gatepass/getSaleNote",
            type: "POST",
            data: {ChasisNo: ChasisNumber},
            success: function (data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    $('#btnGatePass').show();
                    try {
                        var html = '';
                        $.each(a, function (i, val) {
                            if (val != ".") {
                                for (i = 0; i < arrCustomerTpye.length; i++) {
                                    var selection2 = val['CustomerType'] == arrCustomerTpye[i].idType ? 'selected' : '';
                                    html += '<option value="' + arrCustomerTpye[i].idType + '"' + selection2 + '>' + arrCustomerTpye[i].Type + '</option>';
                                }
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
                                $("input[name=RegistrationNumber]").val(val.RegistrationNumber);
                            } else {
//                                $('#paymentErr').html(data);
                            }

                        });
                        $('#customerType').html(html);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $('#btnGatePass').hide();
                    $.ajax({
                        url: "<?= base_url() ?>index.php/gatepass/getpayment",
                        type: "POST",
                        data: {ChasisNo: ChasisNumber},
                        success: function (data) {
                            console.log(data);
                            var a = JSON.parse(data);
                            console.log(a.length);
                            if (a.length > 0) {
                                try {
                                    $.each(a, function (i, val) {
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
                    $("input[name=RegistrationNumber]").val("");
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
        }, function () {
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
                success: function (data) {
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