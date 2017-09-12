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
            <form name="allmodelform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/allmodels/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Models</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Brand</label>
                            <select id="SelectBrand" name="SelectBrand">
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
                            <label>Model</label>
                            <input type="text" id="modelname" name="ModelName" placeholder="Model Name" data-validation="required">
                        </div><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Models List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Variant</label>
                        <input type="text" name="searchmodel" id="searchmodel"  placeholder="Search by Model">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="modellisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="40%">Brand</th>
                                    <th width="45%">Model</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="modellisthf">
                                <tr>
                                    <td colspan="5">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="allmodelsbody">
                                <?php
                                $Counter = 1;
                                foreach ($allModelsList as $key) {
                                    ?>
                                    <tr id="bayTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['BrandName'] ?></td>
                                        <td class="tbl-name"><?= $key['ModelName'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idAllModels'] ?>', '<?= $key['ModelName'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/allmodels/Delete/<?= $key['idAllModels'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/allmodels/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>All Models ID</label>
                        <input type="text" id="idallmodels" name="IdAllModels">
                    </div>
                    <div>
                        <label>Brand</label>
                        <select id="uidallbrands" name="uidAllBrands" required>
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
                    </div>
                    <div>
                        <label>Model</label>
                        <input type="text" id="umodelname" name="UModelName" data-validation="required">
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

    $("#searchmodel").keyup(function() {
        var search = $("#searchmodel").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/allmodels/search",
            type: "POST",
            data: {searchmodel: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".modellisthf").is(":visible"))) {
                                $(".modellisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.BrandName + "</td>\n\
                            <td class='tbl-name'>" + val.ModelName + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idAllModels + "','" + val.ModelName + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/allmodels/Delete/" + val.idAllModels + "' >Delete</a></td></tr>";
                            });
                            $('#allmodelsbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".modellisthf").hide();
                        $("#allmodelsbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform(type) {
        if (type === 'Add') {
            var typeName = $('#SelectBrand').val();
            if (typeName === "Select Brand") {
                $(".error-allbrands").show();
                return false;
            } else {
                $(".error-allbrands").hide();
                return true;
            }
        } else {
            if (type === 'Update') {
                var updateTypeName = $('#uidallbrands').val();
                if (updateTypeName === "Select Brand") {
                    $(".error-uallbrands").show();
                    return false;
                } else {
                    $(".error-uallbrands").hide();
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

    function UpdatePopup(div_id, idALLVehicles, ModelName) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idallmodels").val(idALLVehicles);
            $(this).find("#umodelname").val(ModelName);
        });
    }

</script>