<div id="wrapper">
<div id="content">
<?php
//        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['isAdmin'] == 1) {
include 'include/parts_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
?>
<div class="right-pnel">
<?= $message; ?>
<form name="myform" onSubmit="return validationform()" method="post"
      action="<?= base_url() ?>index.php/parts/update" class="form validate-form animated fadeIn">
<fieldset>
    <legend>Edit Part</legend>
    <div class="feildwrap">
        <div>
            <label>Part Number</label>
            <input type="text" name="idPart" style="display: none;" value="<?= $Parts['idPart'] ?>">
                            <input type="text" name="idInventory" style="display: none;" value="<?= $Parts['idInventory'] ?>">
            <input type="text" name="PartId" data-validation="required" value="<?= $Parts['PartNumber'] ?>">
        </div>
        <div>
            <label>Part Name</label>
            <input type="text" name="PartName" data-validation="required" value="<?= $Parts['PartName'] ?>">
        </div>
        <div>
            <label>Barcode Number</label>
            <input type="text" name="BarcodeNumber" value="<?= $Parts['BarcodeNumber'] ?>">
        </div>
        <div>
            <label>Brand Name</label>
            <select id="BrandName" name="BrandName" data-validation="required">
                <option>Select Brand</option>
                <?php
                foreach ($Brand as $BrandName) {
                    $BrandId = $BrandName['IdParent'];
                    if ($BrandId == $Parts['BrandName']) {
                        ?>
                        <option value="<?= $BrandName['IdParent'] ?>" selected="selected"><?= $BrandName['ParentName'] ?></option>
                    <?php
                    } else {
                        ?>
                        <option value="<?= $BrandName['IdParent'] ?>" ><?= $BrandName['ParentName'] ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
            <span class="error-brand cb-error help-block">Select Option</span>
        </div>
        <div>
            <label>Part Category</label>
            <select id="PartCategory" name="PartCategory">
                <option>Select Category</option>
                <?php
                foreach ($Category as $PartCategory) {
                    $CategoryId = $PartCategory['idCategory'];
                    if ($CategoryId == $Parts['PartCategory']) {
                        ?>
                        <option value="<?= $PartCategory['idCategory'] ?>" selected=""><?= $PartCategory['CategoryName'] ?></option>
                    <?php
                    } else {
                        ?>
                        <option value="<?= $PartCategory['idCategory'] ?>" ><?= $PartCategory['CategoryName'] ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
            <span class="error-category cb-error help-block">Select Option</span>
        </div>
        <div>
            <label>WholeSale Price</label>
            <input type="text" name="CostPrice" data-validation="number" value="<?= $Parts['CostPrice'] ?>">
        </div>
        <div>
            <label>Retail Price</label>
            <input type="text" name="RetailPrice" data-validation="number" value="<?= $Parts['RetailPrice'] ?>">
        </div>
        <div>
            <label>MAD</label>
            <input type="text" name="Mad" value="<?= $Parts['MAD'] ?>">
        </div>
        <div>
            <label>MIP</label>
            <input type="text" name="Mip" value="<?= $Parts['MIP'] ?>" >
        </div>
        <div>
            <label>Lead Time</label>
            <input type="text" name="LeadTime" value="<?= $Parts['LeadTime'] ?>">
        </div>
        <div>
            <label>Primary Location</label>
            <select id="Location" name="Location">
                <option value="Select Primary Location">Select Primary Location</option>
                <option value="Nill">Nill</option>
                <?php
                foreach ($Location as $PartLocation) {
                    $idRack = $PartLocation['idRack'];
                    echo $idRack . "::" . $Parts['Location'];
                    if ($idRack == $Parts['Location']) {
                        ?>
                        <option value="<?= $PartLocation['idRack'] ?>" selected=""><?= $PartLocation['RackNumber'] ?></option>
                    <?php
                    } else {
                        ?>
                        <option value="<?= $PartLocation['idRack'] ?>" ><?= $PartLocation['RackNumber'] ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
            <span class="error-location cb-error help-block">Select Option</span>
        </div>
        <div>
            <label>Secondary Location</label>
            <select id="sLocation" name="sLocation">
                <option value="Select Secondary Location">Select Secondary Location</option>
                <option value="Nill">Nill</option>
                <?php
                foreach ($Location as $PartLocation) {
                    $idRack = $PartLocation['idRack'];
					echo $idRack . "::" . $Parts['SecondaryLocation'];
                    if ($idRack == $Parts['SecondaryLocation']) {
                        ?>
                        <option value="<?= $PartLocation['idRack'] ?>" selected=""><?= $PartLocation['RackNumber'] ?></option>
                    <?php
                    } else {
                        ?>
                        <option value="<?= $PartLocation['idRack'] ?>" ><?= $PartLocation['RackNumber'] ?></option>
                    <?php
                    }
                    ?>
                    <!--<option value="<?= $PartLocation['idRack'] ?>" ><?= $PartLocation['RackNumber'] ?></option>-->
                <?php
                }
                ?>
            </select>
            <span class="error-slocation cb-error help-block">Select Option</span>
        </div>
        <div>
            <label>Order Cycle</label>
            <input type="text" name="OrderCycle" value="<?= $Parts['OrderCycle'] ?>">
        </div>
        <div>
            <label>Order Mode</label>
            <select id="OrderMode" name="OrderMode[]" multiple>
                <?php
                                if ($Parts['OrderMode'] != NULL) {
                                    $orderModeArray = explode(',', $Parts['OrderMode']);
                                }
                foreach ($Order as $OrderMode) {
                    $id = $OrderMode['id'];
                    if ($id == $Parts['idOrderMode']) {
                        ?>
                        <option value="<?= $OrderMode['id'] ?>" selected="" ><?= $OrderMode['Title'] ?></option>
                    <?php
                    } else {
                        ?>
                        <option value="<?= $OrderMode['id'] ?>" ><?= $OrderMode['Title'] ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
            <span class="error-ordermode cb-error help-block">Select Option</span>
        </div>
        <div>
            <label>Part Manufacturer</label>
            <select id="ManufacturerId" name="ManufacturerId">
                <option>Select Manufacturer</option>
                <?php
                foreach ($Manufacturer as $PartManufacturer) {
                    $ManufacturerId = $PartManufacturer['idManufacturer'];
                    if ($ManufacturerId == $Parts['ManufacturerId']) {
                        ?>
                        <option value="<?= $PartManufacturer['idManufacturer'] ?>" selected=""><?= $PartManufacturer['Manufacturer'] ?></option>
                    <?php
                    } else {
                        ?>
                        <option value="<?= $PartManufacturer['idManufacturer'] ?>" ><?= $PartManufacturer['Manufacturer'] ?></option>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </select>
            <span class="error-manufacturer cb-error help-block">Select Option</span>
        </div>
        <div>
            <label>Safety Stock</label>
            <input type="text" name="SafetyStock" value="<?= $Parts['SafetyStock'] ?>">
        </div>
        <div>
            <label>Quantity</label>
            <input type="number" id="Quantity" min="0" name="Quantity" value="<?= $Parts['Quantity'] ?>">
        </div>
        <div>
            <label>Phase Out Quantity</label>
            <input type="text" name="PhaseOutQuantity" value="<?= $Parts['PhaseOutQuantity'] ?>">
        </div>
        <div>
            <label>Part Description</label>
            <textarea name="Description" style="margin: 0px; width: 512px; height: 100px;"><?= $Parts['Description'] ?></textarea>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Select Variants For Part</legend>
    <div class="feildwrap">
        <div id="OrderNumDiv" class="feildwrap" style="">
            <label>Sort by Model</label>
            <input id="ModelName" name="ModelName" type="text" style="width: 250px;">
        </div><br>
        <div>
            <div class="feildwrap"></div>
            <div class="btn-block-wrap datagrid">
                <table width='100%' border='0' cellpadding='1' cellspacing='1'>
                    <thead>
                    <tr>
                        <td width="15%">Check To Add</td>
                        <td width="25%">Model</td>
                        <td width="35%">Variant Name</td>
                        <td width="25%">Model Code</td>
                    </tr>
                    </thead>
                    <tbody id="VariantsTbody">
                    <?php
                    $arr = array();
                    foreach ($PartsVariant as $PV) {
                        array_push($arr, $PV['VariantId']);
                    }
                    foreach ($Variants as $CarVariants) {
                        if (in_array($CarVariants['Id'], $arr)) {
                            echo
                                "<tr>
                            <td><input type='checkbox' checked='checked' value='" . $CarVariants['Id'] . "' name='variants[]'></td>
                                            <td>" . $CarVariants['Model'] . "</td>
                                            <td>" . $CarVariants['Variants'] . "</td>
                                            <td>" . $CarVariants['ModelCode'] . "</td>
                                        </tr>";
                        } else {
                            echo
                                "<tr>
                            <td><input type='checkbox'  value='" . $CarVariants['Id'] . "' name='variants[]'></td>
                                            <td>" . $CarVariants['Model'] . "</td>
                                            <td>" . $CarVariants['Variants'] . "</td>
                                            <td>" . $CarVariants['ModelCode'] . "</td>
                                        </tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <span class="check">This field must be filled!</span>
            </div>
        </div>
    </div>
</fieldset>
<div class="btn-block-wrap">
    <label>&nbsp;</label>
                    <input type="submit" class="btn" value="Update Part" style="margin-left: 460px;width: 180px;">
</div>
</form>
</div>
</div>
</div>
<!-- Edit User Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/parts/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div>
            <label>Part Id</label>
            <input type="text" id="idPart" name="idPart">
        </div>
        <div>
            <label>Part Number</label>
            <input type="text" id="PartId" name="PartId">
        </div>
        <div>
            <label>Part Name</label>
            <input type="text" id="PartName" name="PartName">
        </div>
        <div>
            <label>Variant</label>
            <?php // echo form_dropdown('userdepartment', $UserDepartment, '', 'id="department"');      ?>
            <select name="VariantId" id="VariantId">
                <option>Select Variant</option>
                <?php
                foreach ($Variant as $CarVariant) {
                    $VariantId = $CarVariant['IdVariant'];
                    ?>
                    <option value="<?= $CarVariant['IdVariant'] ?>" ><?= $CarVariant['VariantName'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Quantity</label>
            <input type="number" id="Quantity" min="0" name="Quantity">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Part">
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#OrderMode').chosen();
    });
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/parts/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    //                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var items = "";
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + val.Id + "</td>\n\
                        <td class='tbl - name'>" + val.FullName + "</td><td>" + val.Username + "</td>\n\ <td>" + val.Department + "</td><td>" + val.RoleName + "</td><td>" + val.Name + "</td>\n\
                                    <td><a style='cursor: pointer;' onClick=userPopup('detail','" + val.Id + "','" + val.FullName + "','" + val.Username + "','" + val.Password + "','" + val.Email + "','" + val.ContactNumber + "','" + val.IdDepartment + "','" + val.RoleId + "','" + val.DateOfBirth + "','" + val.DealerShip + "')> Edit </a> / <a> Delete </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                        "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
            <td style='border: 0px'></td>");
                }
            }
        });
    });
    $("#Location").change(function() {
        var Location = $("#Location option:selected").val();

        if (Location !== 'Select Primary Location' && Location !== 'Nill') {
            $("#sLocation").empty();
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/parts/check/",
                type: "POST",
                data: {PrimaryLocation: Location},
                success: function(data) {
                    if (data !== "null")
                    {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            try {
                                $("#sLocation").append("<option>Select Secondary Location</option>");
                                $.each(parsedData, function(index, name) {//                                    
                                    $("#sLocation").append($("<option></option>").val(name['idRack']).html(name['RackNumber']));
                                });
                            } catch (e) {
                                console.log(e);
                            }
                        }
                        else {

                        }
                    }
                },
                error: function(data) {
                }
            });
        }
    });
    function validationform() {
        var brandName = $('#BrandName').val();
        var category = $('#PartCategory').val();
        var location = $('#Location').val();
        var orderMode = $('#OrderMode').val();
        var manufacturer = $('#ManufacturerId').val();
        console.log('location');
        console.log(location);
        //        if (brandName === "Select Brand" && category === "Select Category" && location === "Select Location" && orderMode === "Select Order Mode" && manufacturer === "Select Manufacturer")
        if (brandName === "Select Brand" && category === "Select Category" && location === "Select Primary Location" && manufacturer === "Select Manufacturer")
        {
            $(".error-brand").show();
            $(".error-category").show();
            $(".error-location").show();
            //            $(".error-ordermode").show();
            $(".error-manufacturer").show();
            return false;
        } else {
            //            if (brandName === "Select Brand" || category === "Select Category" || location === "Select Location" || orderMode === "Select Order Mode" || manufacturer === "Select Manufacturer")
            if (brandName === "Select Brand" || category === "Select Category" || location === "Select Primary Location" || manufacturer === "Select Manufacturer")
            {
                if (brandName === "Select Brand") {
                    $(".error-brand").show();
                } else {
                    $(".error-brand").hide();
                }

                if (category === "Select Category") {
                    $(".error-category").show();
                } else {
                    $(".error-category").hide();
                }

                if (location === "Select Primary Location") {
                    $(".error-location").show();
                } else {
                    $(".error-location").hide();
                }

                //                if (orderMode === "Select Order Mode") {
                //                    $(".error-ordermode").show();
                //                } else {
                //                    $(".error-ordermode").hide();
                //                }

                if (manufacturer === "Select Manufacturer") {
                    $(".error-manufacturer").show();
                } else {
                    var manufacturerName = $("#ManufacturerId option:selected").text();
                    $(".error-manufacturer").hide();
                    if (manufacturerName === "IMC") {
                        if (orderMode === "Select Order Mode") {
                            $(".error-ordermode").show();
                        } else {
                            $(".error-ordermode").hide();
                        }
                    }
                }
                return false;
            }
            return true;
        }
    }

    function partPopup(div_id, id, number, name, variant, quantity) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            //                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idPart").val(id);
            $(this).find("#PartId").val(number);
            $(this).find("#PartName").val(name);
            $(this).find("select#VariantId").val(variant);
            $(this).find("#Quantity").val(quantity);
        });
    }

    $("input[name=ModelName]").keyup(function(e) {
        var ModelName = $("input[name=ModelName]").val();
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/parts/search/",
            type: "POST",
            data: {ModelName: ModelName},
            success: function(data) {
                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        try {
                            var items = [];
                            $.each(parsedData, function(i, val) {
                                items += "<tr>" +
                                    "<td class='tbl-name'>" +
                                    "<input type='checkbox' value=" + val.Id + " name='variants[]'>" +
                                    "</td>" +
                                    "<td class='tbl-name'>" + val.Model + "</td>" +
                                    "<td class='tbl-name'>" + val.Variants + "</td>" +
                                    "<td class='tbl-name'>" + val.ModelCode + "</td>" +
                                    "</tr>";
                            });
                            $('#VariantsTbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#VariantsTbody").html("<br><br><tr><td></td><td></td><td>No Data Found</td><td></td></tr>");
                    }
                }
            },
            error: function(data) {
            }
        });
    });

</script>