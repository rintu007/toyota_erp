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
                  action="<?= base_url() ?>index.php/variants/newvariant" onsubmit="return validationform()" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Variant</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Variant Name</label>
                            <input type="text" name="variant_name" data-validation="required">
                        </div>
                        <div>
                            <label>Model Name</label>
                            <select name="model" id="cbModel">
                                <option>Select Model</option>
                                <?php
                                foreach ($model as $CarModel) {
                                    $ModelId = $CarModel['Id'];
                                    ?>
                                    <option value="<?= $CarModel['Id'] ?>" ><?= $CarModel['Model'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-model cb-error help-block">Option must be selected!</span>
                        </div>
                        <div>
                            <label>Engine Type</label>
                            <select name="engine" id="cbEngine">en
                                <option>Select EngineType</option>
                                <?php
                                foreach ($engine as $CarEngine) {
                                    $EngineId = $CarEngine['Id'];
                                    ?>
                                    <option value="<?= $CarEngine['Id'] ?>" ><?= $CarEngine['EngineType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-engine cb-error help-block">Option must be selected!</span>
                        </div>
                        <div>
                            <label>Displacement</label>
                            <select name="displacement" id="cbDisplacement" data-validation="required">
                                <option>Select Displacement</option>
                                <?php
                                foreach ($displacement as $CarDisplacement) {
                                    $DisplacementId = $CarDisplacement['Id'];
                                    ?>
                                    <option value="<?= $CarDisplacement['Id'] ?>" ><?= $CarDisplacement['DisplacementName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-displacement cb-error help-block">Option must be selected!</span>
                        </div>
                        <div>
                            <label>Model Code</label>
                            <input type="text" name="model_code" data-validation="required">
                        </div>
                        <div>
                            <label>Model Description</label>
                            <textarea name="model_description"></textarea>
                        </div>
                        <div>
                            <label>Variant Code</label>
                            <input type="text" name="variant_code">
                        </div>
						  <div>
                            <label>WHT Filer</label>
                            <input type="text" name="WHTFiler">
                        </div>
						 <div>
                            <label>WHT Non Filer</label>
                            <input type="text" name="WHTNFiler">
                        </div>
                        <div>
                            <label>Ex Factory Price</label>
                            <input type="text" name="price" id="ef" data-validation="required">
                        </div>
                        <br>
                       <div>
                          <!--  <label>Freight&Insurance Charges</label> -->
                            <input type="hidden" name="freight" id="fi" value = "0">
                        </div> 
                        <div>
                            <label>Total Price</label>
                            <input type="text" name="total_price" id="tp" data-validation="required">
                        </div>
                        <div>
                            <label>Engine Type Two</label>
                            <input type="text" name="engine_type_two" data-validation="required">
                        </div>
                        <div>
                            <label>Make</label>
                            <span style="width:272px; float:right;">
                                <?php
                                foreach ($make as $CarMake) {
                                    echo "<input type='radio' value='" . $CarMake['IdMake'] . "' class='idMake' name='make'>" . $CarMake['Make'];
                                }
                                ?>
                            </span>
                            <span class="check">Please select a make!</span>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Add Color To Variant</legend>
                    <div class="feildwrap"></div>
                    <div class="btn-block-wrap datagrid">
                        <table width='70%' border='0' cellpadding='1' cellspacing='1'>
                            <thead>
                                <tr>
                                    <td width="15%">Check To Add</td>
                                    <td width="50%">Color Name</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($color as $CarColor) {
                                    echo "
                                            <tr>
                                            <td><input type='checkbox' value='" . $CarColor['Id'] . "' name='color[]'></td>
                                            <td>" . $CarColor['ColorName'] . "</td>
                                            </tr>
                                            ";
                                }
                                ?>
                            </tbody>
                        </table>
                        <span class="check">This field must be filled!</span>
                    </div>
                    <!--                            </div>-->
                    <div class="btn-block-wrap">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="Add New Variant">
                    </div>
                </fieldset>
                <!--<div class="hidden pbo-form">-->
                <!--</div>-->
            </form>

            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Variants List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Variants
                                <!--<span class="required">*</span>-->
                            </label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Variant Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="28%">Variant</th>
                                    <th width="12%">Model</th>
                                    <th width="12%">Model Code</th>
                                    <th width="17%">Model Description</th>
                                    <th width="8%">Displacement</th>
                                    <th width="8%">Engine</th>
                                    <th width="5%">Make</th>
                                    <th width="10%">Color</th>
                                    <th width="10%">EX Factory Price</th>
                                    <th width="10%">Freight</th>
                                    <th width="10%">Total Price</th>
                                     <th width="10%">Active Status</th>
                                    <th width="25%">Details</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="13">
                                        <div id="paging">
                                            <ul>
                                                <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                <!--                                            <li><a href="" class="active"><span>-->
                                                <!--</span></a></li>-->
                                                <!--                                            <li>-->
                                                <!--<?//= $pagination ?></li>-->
                                                <!--                                                <li><a href=""><span>3</span></a></li>-->
                                                <!--                                                <li><a href=""><span>4</span></a></li>-->
                                                <!--                                                <li><a href=""><span>5</span></a></li>-->
                                                <!--                                            <li><a href=""><span>Next</span></a></li>-->
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                
                                $count = 1;
                                foreach ($variants as $CarVariants) {
                                    $VariantsId = $CarVariants['IdVariants'];
                                    $status = "";
                                if($CarVariants['isActive']== 1)
                                {
                                  $status = "Deactivate" ; 
                                    
                                }
                                else
                                {
                                    $status = "Activate" ; 
                                    
                                }
                                    ?>
                                    <tr id="carVariants">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CarVariants['Variants'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['Model'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['ModelCode'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['ModelDescription'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['DisplacementName'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['EngineType'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['Make'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['ColorName'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['Price'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['FICharges'] ?></td>
                                        <td class="tbl-name"><?= $CarVariants['TotalPrice'] ?></td>
                                        <td class="tbl-name"><a href="<?= base_url() ?>/index.php/variants/ChangeStatus/<?=$VariantsId?>/<?=$status?>"><?= $status ?></a></td>
                                        <td><a href="<?= base_url() ?>/index.php/variants/edit/<?= $VariantsId ?>">Edit</a>
                                        <!--<td><a style="cursor: pointer;" onClick="variantPopup('detail', '<?= $VariantsId ?>', '<?= mysql_real_escape_string($CarVariants['Variants']) ?>', '<?= mysql_real_escape_string($CarVariants['ModelId']) ?>', '<?= mysql_real_escape_string($CarVariants['ModelCode']) ?>', '<?= mysql_real_escape_string($CarVariants['ModelDescription']) ?>', '<?= mysql_real_escape_string($CarVariants['Price']) ?>', '<?= mysql_real_escape_string($CarVariants['IdMake']) ?>', '<?= mysql_real_escape_string($CarVariants['IdEngine']) ?>', '<?= mysql_real_escape_string($CarVariants['IdDisplacement']) ?>', '<?= mysql_real_escape_string($CarVariants['FICharges']) ?>', '<?= mysql_real_escape_string($CarVariants['TotalPrice']) ?>', '<?= mysql_real_escape_string($CarVariants['ColorId']) ?>')">Edit</a>-->
                                        </td> 
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- Edit Variants Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/variants/update" method="POST" onSubmit="return validationform()" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Variant ID</label>
            <input type="text" id="idVariant" name="variant_id">
        </div>
        <br>
        <div>
            <label>Variant Name</label>
            <input type="text" id="variant_name" name="variant_name">
        </div>
        <div id="model">
            <label>Model Name</label>
            <select name="model" id="model">
                <option>Select Model</option>
                <?php
                foreach ($model as $CarModel) {
                    $ModelId = $CarModel['Id'];
                    ?>
                    <option value="<?= $CarModel['Id'] ?>" ><?= $CarModel['Model'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Engine Type</label>
            <select name="engine" id="engine">
                <option>Select Engine Type</option>
                <?php
                foreach ($engine as $CarEngine) {
                    $EngineId = $CarEngine['Id'];
                    ?>
                    <option value="<?= $CarEngine['Id'] ?>" ><?= $CarEngine['EngineType'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Displacement</label>
            <select name="displacement" id="displacement">
                <option>Select Displacement</option>
                <?php
                foreach ($displacement as $CarDisplacement) {
                    $DisplacementId = $CarDisplacement['Id'];
                    ?>
                    <option value="<?= $CarDisplacement['Id'] ?>" ><?= $CarDisplacement['DisplacementName'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Model Code</label>
            <input type="text" id="modelCode" name="model_code" data-validation="required">
        </div>
        <div>
            <label>Ex Factory Price</label>
            <input type="text" id="price" name="price" data-validation="required">
        </div>
        <div>
            <label>Freight & Insurance</label>
            <input type="text" id="freight" name="freight" data-validation="required">
        </div>
        <div>
            <label>Total Price</label>
            <input type="text" name="total_price" id="totalprice" data-validation="required">
        </div>
        <div>
            <label>Model Description</label>
            <textarea id="modelDes" name="model_description"></textarea>
        </div>
        <div>
            <label>Make</label>
            <span style="width:272px; float:right;" id="make">
                <?php
                foreach ($make as $CarMake) {
                    echo "<input type='radio' value='" . $CarMake['IdMake'] . "' name='makeId' class='make'>" . $CarMake['Make'];
                }
                ?>
                <span class="form-error help-block">Please select a make!</span>
        </div>
        <div>
            <label>Variant Colors</label>
            <span style="width:272px; float:right;" id="color">
                <?php
                foreach ($color as $colorvariant) {
                    echo "<input type='checkbox' value='" . $colorvariant['Id'] . "'class='color' name='colors[]'>" . $colorvariant['ColorName'] . "<br>";
                }
                ?>
            </span>
            <span class="form-error help-block">Please select a make!</span>
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Variant">
        </div>
    </form>
</div>
<script>
    $("#fi").keyup(function() {
        var ExFacetoryPrice = $("#ef").val();
     //   var FreightCharges = $("#fi").val();
        var TotalPrice = parseInt(ExFacetoryPrice); // + parseInt(FreightCharges);
        $("#tp").val(TotalPrice);
    });

    $("#freight").keyup(function() {
        var ExFacetoryPrice = $("#price").val();
   //     var FreightCharges = $("#freight").val();
        var TotalPrice = parseInt(ExFacetoryPrice); // + parseInt(FreightCharges);
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
    <td>" + val.EngineType + "</td><td>" + val.Make + "</td><td>" + val.Color + "</td><td>" + val.Price + "</td><td>" + val.FICharges + "</td><td>" + val.TotalPrice + "</td>\n\
                                                  <td><a style='cursor: pointer;' href='<?= base_url() ?>/index.php/variants/edit/" + val.IdVariants + "')>Edit</a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>\n\
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