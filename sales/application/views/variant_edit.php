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
                  action="<?= base_url() ?>index.php/variants/update" onsubmit="return validationform()" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Variant</legend>
                    <div class="feildwrap">

                        <div style="display: none;">
                            <label>Variant ID</label>
                            <input type="text" id="idVariant" name="variant_id" value="<?= $EditVariant['IdVariants'] ?>">
                        </div>
                        <br>
                        <div>
                            <label>Variant Name</label>
                            <input type="text" id="variant_name" name="variant_name" value="<?= $EditVariant['Variants'] ?>">
                        </div>
                        <div id="model">
                            <label>Model Name</label>
                            <?php
                            echo form_dropdown('model', $model, $EditVariant['ModelId']);
                            ?>
                        </div>
                        <div>
                            <label>Engine Type</label>
                            <?php
                            echo form_dropdown('engine', $engine, $EditVariant['EngineId']);
                            ?>
                        </div>
                        <div>
                            <label>Displacement</label>
                            <?php
                            echo form_dropdown('displacement', $displacement, $EditVariant['DisplacementId']);
                            ?>

                        </div>
                        <div>
                            <label>Model Code</label>
                            <input type="text" id="modelCode" name="model_code" value="<?= $EditVariant['ModelCode'] ?>">
                        </div>
                        <div>
                            <label>Ex Factory Price</label>
                            <input type="text" id="price" name="price" value="<?= $EditVariant['Price'] ?>">
                        </div>
                        <div>
                            <label>WHT Filer</label>
                            <input type="text" id="WHTFiler" name="WHTFiler" value="<?= $EditVariant['WHTFiler'] ?>">
                        </div>
						  <div>
                            <label>WHT Non Filer</label>
                            <input type="text" id="WHTNFiler" name="WHTNFiler" value="<?= $EditVariant['WHTNFiler'] ?>">
                        </div>
						
                        <div>
                            <label>Total Price</label>
                            <input type="text" name="total_price" id="totalprice" value="<?= $EditVariant['TotalPrice'] ?>">
                        </div>
                        <div>
                            <label>Variant Code</label>
                            <input type="text" name="variant_code" value="<?= $EditVariant['VariantCode'] ?>">
                        </div>
                        <div>
                            <label>Engine Type Two</label>
                            <input type="text" name="engine_type" value="<?= $EditVariant['EngineTypeTwo'] ?>">
                        </div>
                        <div>
                            <label>Model Description</label>
                            <textarea id="modelDes" name="model_description"><?= $EditVariant['ModelDescription'] ?></textarea>
                        </div>
                        <div>
                            <label>Make</label>
                            <span style="width:272px; float:right;" id="make">
                                <?php
                                $MakeArr = array();
                                foreach ($make as $CarMake) {
                                    array_push($MakeArr, $CarMake['MakeId']);
                                }
                                foreach ($AllMakes as $Makes) {
                                    if (in_array($Makes['Id'], $MakeArr)) {
                                        echo "<input type='radio' value='" . $Makes['Id'] . "' name='makeId' class='make' checked>" . $Makes['Make'];
                                    } else {
                                        echo "<input type='radio' value='" . $Makes['Id'] . "' name='makeId' class='make'>" . $Makes['Make'];
                                    }
                                }
                                ?>
                            </span>
                            <span class="form-error help-block">Please select a make!</span>
                        </div>
                        <div>
                            <label>Variant Colors</label>
                            <span style="width:272px; float:right;" id="color">
                                <?php
                                $arr = array();
                                foreach ($color as $Colors) {
                                    array_push($arr, $Colors['ColorId']);
                                }
                                foreach ($AllColors as $colorvariant) {
                                    if (in_array($colorvariant['Id'], $arr)) {
                                        echo "<input type='checkbox' value='" . $colorvariant['Id'] . "'class='color' name='colors[]' checked>" . $colorvariant['ColorName'] . "<br>";
                                    } else {
                                        echo "<input type='checkbox' value='" . $colorvariant['Id'] . "'class='color' name='colors[]'>" . $colorvariant['ColorName'] . "<br>";
                                    }
                                }
                                ?>
                            </span>
                            <span class="form-error help-block">Please select a make!</span>
                        </div>
                        <div style="margin-left: 300px;">
                            <input type="submit" class="btn" value="Update Variant">
                        </div>
                    </div>
                </fieldset>
                <!--<div class="hidden pbo-form">-->
                <!--</div>-->
            </form>
        </div>
    </div>
</div>
<script>
    $("#fi").keyup(function() {
        var ExFacetoryPrice = $("#ef").val();
        var FreightCharges = $("#fi").val();
        var TotalPrice = parseInt(ExFacetoryPrice) + parseInt(FreightCharges);
        $("#tp").val(TotalPrice);
    });

    $("#freight").keyup(function() {
        var ExFacetoryPrice = $("#price").val();
        var FreightCharges = $("#freight").val();
        var TotalPrice = parseInt(ExFacetoryPrice) + parseInt(FreightCharges);
        $("#totalprice").val(TotalPrice);
    });

    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/variants/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        var items = "";
                        var count = 1;
                        $.each(a, function(i, val) {
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
        var model = $("#cbModel").val();
        var engine = $("#cbEngine").val();
        var displacement = $("#cbDisplacement").val();
        //        || engine === "Select Engine Type" || displacement === "Select Displacement"

        if (!$('.idMake:checked').val()) {
            $('.check').show();
        } else {
            $('.check').hide();
        }

        if ($("#cbModel").val() === "Select Model") {
            $(".error-model").show();
            //            return false;
        } else {
            $(".error-model").hide();
        }

        if (engine === "Select EngineType") {
            $(".error-engine").show();
            //            return false;
        } else {
            $(".error-engine").hide();
        }

        if (displacement === "Select Displacement") {
            $(".error-displacement").show();
//            return false;
        } else {
            $(".error-displacement").hide();
        }

        //        if (pass !== confirm_pass) {
//            $(".pass-error").show();
//            return false;
//        } else {
        //            $(".pass-error").hide();
//            return true;
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

//                    console.log(data);
                    var a = data;
//                    alert(JSON.stringify(data));
//                    console.log(a.length);
                    var items = [];
                    for (var val = 0; val <= a.lenght; val++) {
                        if (jQuery.inArray(val.ColorId, a[val])) {
                            items += $(this).find(".color[value='" + val.ColorId + "']").attr('checked', true);
                            $("#color").html(items);
                            console.log("matched");
                        } else {
                            items += $(this).find(".color[value='" + val.ColorId + "']").attr('checked', false);
                            $("#color").html(items);
                            console.log("unmatched");
                        }


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
    //            $(this).find(".color").attr('checked', false);
    //                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
    //            $(this).find("#idVariant").val(id);
    //            $(this).find("#variant_name").val(name);
    //            $(this).find("#model").val(model);
    //            $(this).find("#modelCode").val(modelCode);
    //            $(this).find("#price").val(price);
    //            $(this).find("#modelDes").val(modelDes);
    //            $(this).find("#engine").val(engine);
    //            $(this).find("#displacement").val(displacement);
    //            $(this).find(".make[value='" + make + "']").attr('checked', true);
    //            $(this).find("#freight").val(freight);
    //            $(this).find("#totalprice").val(totalprice);
    //            $(this).find(".color[value='" + color + "']").attr('checked', true);
//    );
//    }
</script>