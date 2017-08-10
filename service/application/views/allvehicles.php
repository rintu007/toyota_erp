<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        } else {
            
        }
        ?>
        <div class="right-pnel">
            <form name="allvehicleform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/allvehicles/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Vehicles</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Brand</label>
                            <select id="SelectBrand" name="SelectBrand" onchange="getModel(this, 'Add')">
                                <option>Select Brand</option>
                                <?php
                                foreach ($brandsList as $key) {
                                    $idAllBrands = $brandsList['idAllBrands'];
                                    ?>
                                    <option value="<?= $key['idAllBrands'] ?>" ><?= $key['BrandName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-allbrands cb-error help-block" style="margin-left: 0px;margin-top: -10px">Option must be selected!</span>
                        </div><br>                        
                        <div>
                            <label>Select Model</label>
                            <select id="SelectModel" name="SelectModel">
                                <option>Select Model</option>
                            </select>
                            <span class="error-allmodels cb-error help-block" style="margin-left: 0px;margin-top: -10px">Option must be selected!</span>
                        </div><br>  
                        <div>
                            <label>Variant</label>
                            <input type="text" id="variant" name="Variant" placeholder="Varaint Name" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Vehicles List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Variant</label>
                        <input type="text" name="searchvariant" id="searchvariant"  placeholder="Search by Variant">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="vehicleslisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="25%">Brand</th>
                                    <th width="30%">Model</th>
                                    <th width="30%">Variant</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="vehicleslisthf">
                                <tr>
                                    <td colspan="5">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="allvehiclesbody">
                                <?php
                                $Counter = 1;
                                foreach ($allvehiclesList as $key) {
                                    ?>
                                    <tr id="bayTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['BrandName'] ?></td>
                                        <td class="tbl-name"><?= $key['ModelName'] ?></td>
                                        <td class="tbl-name"><?= $key['Variant'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idAllVehicles'] ?>', '<?= $key['Variant'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/allvehicles/Delete/<?= $key['idAllVehicles'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/allvehicles/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>All Vehicles ID</label>
                        <input type="text" id="idallvehicles" name="IdAllVehicles">
                    </div>
                    <div>
                        <label>Brand</label>
                        <select id="idallbrands" name="idAllBrands" onchange="getModel(this, 'Update')">
                            <option>Select Brand</option>
                            <?php
                            foreach ($brandsList as $key) {
                                $idAllBrands = $brandsList['idAllBrands'];
                                ?>
                                <option value="<?= $key['idAllBrands'] ?>" ><?= $key['BrandName'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="error-uallbrands cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                    </div><br>
                    <div>
                        <label>Select Model</label>
                        <select id="uSelectModel" name="uSelectModel">
                            <option>Select Model</option>
                        </select>
                        <span class="error-uallmodels cb-error help-block" style="margin-left: 0px;margin-top: -10px">Option must be selected!</span>
                    </div>
                    <div>
                        <label>Variant</label>
                        <input type="text" id="variantname"  name="VariantName" data-validation="required">
                    </div>
                    <div style="margin-left: 402px;">
                        <input type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchvariant").keyup(function() {
        var search = $("#searchvariant").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/allvehicles/search",
            type: "POST",
            data: {searchvariant: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".vehicleslisthf").is(":visible"))) {
                                $(".vehicleslisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.BrandName + "</td>\n\
                            <td class='tbl-name'>" + val.ModelName + "</td>\n\
                            <td class='tbl-name'>" + val.Variant + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idAllVehicles + "','" + val.Variant + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/allvehicles/Delete/" + val.idAllVehicles + "' >Delete</a></td></tr>";
                            });
                            $('#allvehiclesbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".vehicleslisthf").hide();
                        $("#allvehiclesbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform(type) {
        if (type === 'Add') {
            var brandName = $('#SelectBrand').val();
            var modelName = $('#SelectModel').val();

            if (brandName === "Select Brand" && modelName === "Select Model") {
                $(".error-allbrands").show();
                $(".error-allmodels").show();
                return false;
            } else {
                if (brandName === "Select Brand" || modelName === "Select Model")
                {
                    if (brandName === "Select Brand") {
                        $(".error-allbrands").show();
                    } else {
                        $(".error-allbrands").hide();
                    }
                    if (modelName === "Select Model") {
                        $(".error-allmodels").show();
                    } else {
                        $(".error-allmodels").hide();
                    }
                    return false;
                }
                return true;
            }
        } else {
            if (type === 'Update') {
                var ubrandName = $('#idallbrands').val();
                var umodelName = $('#uSelectModel').val();
                if (ubrandName === "Select Brand" && umodelName === "Select Model")
                {
                    $(".error-uallbrands").show();
                    $(".error-uallmodels").show();
                    return false;
                }
                else {
                    if (ubrandName === "Select Brand" || umodelName === "Select Model")
                    {
                        if (ubrandName === "Select Brand") {
                            $(".error-uallbrands").show();
                        } else {
                            $(".error-uallbrands").hide();
                        }
                        if (umodelName === "Select Model") {
                            $(".error-uallmodels").show();
                        } else {
                            $(".error-uallmodels").hide();
                        }
                        return false;
                    }
                    return true;
                }
            }
        }
        chosen = "";
        pass = $("#pass").val();
        confirm_pass = $("#cpass").val();
        if (pass !== confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }
    }

    function UpdatePopup(div_id, idALLVehicles, VariantName) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idallvehicles").val(idALLVehicles);
            $(this).find("#variantname").val(VariantName);
        });
    }

    function getModel(obj, type) {
        if (type === 'Add') {
            var brand = $(obj).val();
            $("#SelectModel").empty();
            if (brand !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/allvehicles/getModel",
                    type: "POST",
                    data: {brand: brand},
                    dataType: "json",
                    success: function(data) {
                        console.log('data');
                        console.log(data);
                        if (data.length > 0) {
                            $("#SelectModel").append($("<option id=''>Select Model</option>"));
                            $.each(data, function(index, name) {
                                $("#SelectModel").append($("<option id=''></option>").val(name['idAllModels']).html(name['ModelName']));
                            });
                        }
                        else {
                        }
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }
        } else {
            var updateBrand = $(obj).val();
            $("#uSelectModel").empty();
            if (updateBrand !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/allvehicles/getModel",
                    type: "POST",
                    data: {brand: updateBrand},
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {
                            $("#uSelectModel").append($("<option id=''>Select Model</option>"));
                            $.each(data, function(index, name) {
                                $("#uSelectModel").append($("<option id=''></option>").val(name['idAllModels']).html(name['ModelName']));
                            });
                        }
                        else {
                        }
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }
        }
    }

</script>