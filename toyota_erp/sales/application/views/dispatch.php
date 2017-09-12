<div id="wrapper">
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
                  action="<?= base_url() ?>index.php/dispatch/newDispatch" onsubmit="return validationform()" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Vehicle Dispatch</legend>
                    <div class="feildwrap">
                        <div style="margin-left: 200px;">
                            <?= $message ?>
                            <br>
                            <label></label>
                            <select id="DispatchType" name="dispatch">
                                <option value="Select One">Select One</option>
                                <option value="Open Stock">Open Stock</option>
                                <option value="Pbo">Pbo</option>
                            </select>
                        </div>
                        <br>
                        <div id="PboNumber">
                            <label>Enter PBO Number</label>
                            <input type="text" name="Pbo_number">
                        </div>
                        <br>
                        <fieldset id="PboDetails">
                            <legend>PBO Details</legend>
                            <div style="display: none;">
                                <label>PBO Id</label>
                                <input type="text" name="pbo_id">
                            </div>
                            <div>
                                <label>PBO Number</label>
                                <input type="text" name="pbo_number" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Customer Name</label>
                                <input type="text" name="customer_name" readonly>
                            </div>
                            <div>
                                <label>Sales Person</label>
                                <input type="text" name="sales_person" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Variant Name</label>
                                <input type="text" name="variant_name" readonly>
                            </div>
                            <div>
                                <label>Variant Color</label>
                                <input type="text" name="variant_color" readonly>
                                <input style="display:none" type="text" name="variant_colorId" readonly>
                            </div>
                            <div style="margin-left: -65px;">
                                <label>Booking Price</label>
                                <input type="text" name="booking_price" readonly>
                            </div>
                        </fieldset>

                        <fieldset id="VehicleDetails">
                            <legend>Vehicle Receiving Details</legend>
                            <div id="dEngine">
                                <label>Engine Number</label>
                                <input type="text" name="engine_no">
                            </div>
                            <div id="EngineNo">
                                <label>Engine Number</label>
                                <input type="text" name="engine_number">
                                <span id="EngineNumberAvailability"></span>
                                <span class="error-engine cb-error help-block">Engine Number must be Unique!</span>
                            </div>
                            <div id="dChasis">
                                <label>Chasis Number</label>
                                <input type="text" name="chasis_no">
                            </div>
                            <div id="ChasisNo">
                                <label>Chasis Number</label>
                                <input type="text" name="chasis_number">
                                <span id="ChasisNumberAvailability"></span>
                                <span class="error-chasis cb-error help-block">Chasis Number must be Unique!</span>
                            </div>
                             <div id="">
                                <label>Registration Number</label>
                                <input type="text" name="RegistrationNumber">
                            </div>
                            <div id="Color">
                                <label>Variant Color</label>
                                <select id="ColorList" name="color"></select>
                                <div id="PboNumberAvailability"></div>
                                <span class="error-model cb-error help-block">Option must be matched with the above color!</span>
                            </div>
                            <div id="Variant">
                                <label>Variant</label>
                                <select name="variant" id="variants">
                                    <option>Select Variant</option>
                                    <?php
                                    foreach ($Variants as $CarVariant) {
                                        $idVariant = $CarVariant['Id'];
                                        ?>
                                        <option value="<?= $CarVariant['Id'] ?>" ><?= $CarVariant['Variants'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="VariantColor">
                                <label>Color</label>
                                <select id="ListColor" name="variant_color">
                                    <option>Select Color</option>
                                </select>
                            </div>
                            <div>
                                <label>Location</label>
                                <select name="location">
                                    <option>Select Location</option>
                                    <?php
                                    foreach ($Location as $DispatchLocation) {
                                        $idLocation = $DispatchLocation['idLocation'];
                                        ?>
                                        <option value="<?= $DispatchLocation['idLocation'] ?>" ><?= $DispatchLocation['Location'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="error-model cb-error help-block">Option must be selected!</span>
                            </div>
                            <div>
                                <label>Dispatch Date</label>
                                <input type="text" name="dispatch_date" class="date" data-validation="required">
                            </div>
                            <div>
                                <label>Warranty Book</label>
                                <select name="warranty_book">
                                    <option>Warranty Book</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                            </div>
                            <div>
                                <label>Remarks</label>
                                <textarea id="Remarks" name="Remarks" class="Remarks" ></textarea>
                            </div>

                            <div>
                                <input type="checkbox" value="GStock" id="isStock" class="checkStatus" name="isStock" style=" margin-left: 135px; "/> General Stock <br>
                                <input type="checkbox" value="CStock" id="icStock" class="checkStatus" name="icStock" style=" margin-left: 135px; "/> Corporate Stock
                            </div>
                        </fieldset>
                    </div>
                    <input type="submit" value="Add Dispatch" class="btn" style="margin-left: 425px;" id="btnDispatch">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    $('input.checkStatus').on('change', function () {
        $('input.checkStatus').not(this).prop('checked', false);
    });
    $("input[name=engine_number]").keyup(function () {
        var EngineNumber = $("input[name=engine_number]").val();
        console.log(EngineNumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/dispatch/CheckEngineNumber",
            type: "POST",
            data: {EngineNumber: EngineNumber},
            success: function (data) {
                console.log(data);
                if ($("input[name=engine_number]").val() != "") {
                    $("#EngineNumberAvailability").show();
                    if (data == 'Available') {
                        $('#EngineNumberAvailability').html("<h4 id='chasis' style='background-color: green;color: white;width: 271px;margin-left: 200px;'>Available!</h4>");
                    } else {
                        $('#EngineNumberAvailability').html("<h4 id='engine' style='background-color: maroon;color: white;width: 271px;margin-left: 200px;'>Already Exists in Database!</h4>");
                    }
                } else {
                    $("#EngineNumberAvailability").hide();
                }
            }
        });
    });

    $("input[name=chasis_number]").keyup(function () {
        var ChasisNumber = $("input[name=chasis_number]").val();
        console.log(ChasisNumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/dispatch/CheckChasisNumber",
            type: "POST",
            data: {ChasisNumber: ChasisNumber},
            success: function (data) {
                console.log(data);
                if ($("input[name=chasis_number]").val() != "") {
                    $("#ChasisNumberAvailability").show();
                    if (data == 'Available') {
                        $('#ChasisNumberAvailability').html("<h4 id='chasis' style='background-color: green;color: white;width: 271px;margin-left: 200px;'>Available!</h4>");
                    } else {
                        $('#ChasisNumberAvailability').html("<h4 id='chasis' style='background-color: maroon;color: white;width: 271px;margin-left: 200px;'>Already Exists in Database!</h4>");
                    }
                } else {
                    $("#ChasisNumberAvailability").hide();
                }
            }
        });
    });

    $("input[name=Pbo_number]").keyup(function () {
        var PBONumber = $("input[name=Pbo_number]").val();
        var VariantId = "";
        var ColorId = "";
        console.log(PBONumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/dispatch/getpbo",
            type: "POST",
            data: {Pbo: PBONumber},
            success: function (data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        $.each(a, function (i, val) {
                            $("input[name=pbo_id]").val(val.Id);
                            $("input[name=pbo_number]").val(val.PboNumber);
                            $("input[name=customer_name]").val(val.CustomerName);
                            $("input[name=sales_person]").val(val.SalesPerson);
                            $("input[name=variant_name]").val(val.Variants);
                            $("input[name=chasis_number]").val(val.VariantCode + "-");
                            VariantId = val.idVariant;
                            ColorId = val.ColorId;
//                            alert(ColorId);
                            $.ajax({
                                url: "<?= base_url() ?>index.php/dispatch/getvariantcolor",
                                type: "POST",
                                data: {Variant: VariantId},
                                success: function (data) {
                                    console.log("Variant : " + VariantId);
                                    console.log(data);
                                    var a = JSON.parse(data);
                                    console.log(a.length);
                                    if (a.length > 0) {
                                        try {

                                            $.each(a, function (i, val) {

                                                var items = "";
                                                $.each(a, function (i, val) {
                                                    var selection2 = ColorId == val.ColorId ? 'selected' : '';
                                                    items += "<option value='" + val.ColorId + "' " + selection2 + "'>" + val.ColorName + "</option>";
                                                });
                                                $('#ColorList').html(items);
                                            });
                                        } catch (e) {
                                            console.log(e);
                                        }
                                    }
                                }
                            });
                            $("input[name=variant_color]").val(val.ColorName);
                            $("input[name=booking_price]").val(val.BookingPrice);
                        });
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("input[name=pbo_id]").val("");
                    $("input[name=pbo_number]").val("");
                    $("input[name=customer_name]").val("");
                    $("input[name=sales_person]").val("");
                    $("input[name=variant_name]").val("");
                    $("input[name=chasis_number]").val("");
                    $("input[name=variant_color]").val("");
                    $("input[name=booking_price]").val("");
                    $("#ColorList").html('<option>Select Color</option>');
                }
            }
        });
    });

    $("#variants").change(function () {
        var Variant = $("#variants").val();
        console.log(Variant);
        $.ajax({
            url: "<?= base_url() ?>index.php/dispatch/getvariantcolor",
            type: "POST",
            data: {Variant: Variant},
            success: function (data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        $.each(a, function (i, val) {
                            var items = "<option>Select Color</option>";
                            $.each(a, function (i, val) {
                                items += "<option value='" + val.ColorId + "'>" + val.ColorName + "</option>";
                            });
                            $('#ListColor').html(items);
                        });
                    } catch (e) {
                        console.log(e);
                    }
                }
            }
        });
    });

//    $("#ColorList").change(function() {
//        var Color = $("#ColorList :selected").html();
//        var VariantColor = $("input[name=variant_color]").val();
//        if (Color == VariantColor) {
//            $('#PboNumberAvailability').html("<h4 style='background-color: green;color: white;'>Color Matched!</h4>");
//        } else {
//            $('#PboNumberAvailability').html("<h4 style='background-color: maroon;color: white;'>Color Not Matched!</h4>");
//        }
//
//    });

    $("#DispatchType").change(function () {
        var Type = $("#DispatchType :selected").val();
        if (Type == "Open Stock") {
            //Dispatch Form
            $("#PboNumber").hide();
            $("#PboDetails").hide();
            $("#Color").hide();
            $("#VehicleDetails").show();
            $("#btnDispatch").show();
            $("#VariantColor").show();
            $("#Variant").show();
            $("#dChasis").show();
            $("#dEngine").show();
            $("#ChasisNo").hide();
            $("#EngineNo").hide();
            $("input[name=pbo_id]").val("");
            $("input[name=pbo_number]").val("");
            $("input[name=Pbo_number]").val("");
            $("input[name=customer_name]").val("");
            $("input[name=sales_person]").val("");
            $("input[name=variant_name]").val("");
            $("input[name=chasis_number]").val("");
            $("input[name=variant_color]").val("");
            $("input[name=booking_price]").val("");
            $("#ColorList").html('<option>Select Color</option>');
        } else if (Type == "Pbo") {
            //Dispatch Form
            $("#PboNumber").show();
            $("#PboDetails").show();
            $("#VehicleDetails").show();
            $("#btnDispatch").show();
            $("#Color").show();
            $("#ChasisNo").show();
            $("#EngineNo").show();
            $("#VariantColor").hide();
            $("#Variant").hide();
            $("#dChasis").hide();
            $("#dEngine").hide();
        } else {
            //Dispatch Form
            $("#PboNumber").hide();
            $("#PboDetails").hide();
            $("#VehicleDetails").hide();
            $("#Color").hide();
            $("#btnDispatch").hide();
            $("#VariantColor").hide();
            $("#Variant").hide();
            $("#dChasis").hide();
            $("#dEngine").hide();
            $("#ChasisNo").hide();
            $("#EngineNo").hide();
            $("input[name=RegistrationNumber]").hide();
            $("input[name=pbo_id]").val("");
            $("input[name=pbo_number]").val("");
            $("input[name=Pbo_number]").val("");
            $("input[name=customer_name]").val("");
            $("input[name=sales_person]").val("");
            $("input[name=variant_name]").val("");
            $("input[name=chasis_number]").val("");
            $("input[name=variant_color]").val("");
            $("input[name=booking_price]").val("");
             $("input[name=RegistrationNumber]").val("");
            
            $("#ColorList").html('<option>Select Color</option>');
        }
    });

    $("#fi").keyup(function () {
        var ExFacetoryPrice = $("#ef").val();
        var FreightCharges = $("#fi").val();
        var TotalPrice = parseInt(ExFacetoryPrice) + parseInt(FreightCharges);
        $("#tp").val(TotalPrice);
    });
    $("#freight").keyup(function () {
        var ExFacetoryPrice = $("#price").val();
        var FreightCharges = $("#freight").val();
        var TotalPrice = parseInt(ExFacetoryPrice) + parseInt(FreightCharges);
        $("#totalprice").val(TotalPrice);
    });
    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/variants/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        var items = "";
                        var count = 1;
                        $.each(a, function (i, val) {
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.Variants + "</td><td>" + val.Model + "</td>\n\
<td>" + val.ModelCode + "</td><td>" + val.ModelDescription + "</td><td>" + val.DisplacementName + "</td>\n\
    <td>" + val.EngineType + "</td><td>" + val.Make + "</td><td>" + val.Price + "</td><td>" + val.FICharges + "</td>\n\
                                                  <td><a style='cursor: pointer;' onClick=variantPopup('detail','" + val.IdVariants + "','" + val.Variants + "','" + val.ModelId + "','" + val.ModelCode + "','" + val.ModelDescription + "','" + val.Price + "','" + val.IdMake + "','" + val.IdEngine + "','" + val.IdDisplacement + "','" + val.FICharges + "','" + val.TotalPrice + "')>Edit</a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
                                          <td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>\n\
                                          <td style='border: 0px'></td>");
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