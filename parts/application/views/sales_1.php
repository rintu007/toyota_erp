<div id="wrapper">
    <div id="content">
        <?php
        $cookieData = unserialize($_COOKIE['logindata']);
        if ($cookieData['isAdmin'] == 1) {
            include 'include/admin_leftmenu.php';
        } else {
            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <?= $message ?>
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/purchase/add" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Sale Items</legend>
                    <div class="feildwrap" id="Local">
                        <div>
                            <label>Part Name</label>
                            <select name="idPart">
                                <option>Select Part</option>
                                <?php
                                foreach ($Part as $InventoryPart) {
                                    $idPart = $InventoryPart['idPart'];
                                    ?>
                                    <option value="<?= $InventoryPart['idPart'] ?>" ><?= $InventoryPart['PartName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Sale Type</label>
                            <select name="idPurchaseType">
                                <option>Select Sale Type</option>
                                <?php
                                foreach ($SaleType as $InventorySaleType) {
                                    $idSaleType = $InventorySaleType['idSaleType'];
                                    ?>
                                    <option value="<?= $InventorySaleType['idSaleType'] ?>" ><?= $InventorySaleType['SaleType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Party Name</label>
                            <select name="idParty">
                                <option>Select Party</option>
                                <?php
                                foreach ($Party as $InventoryParty) {
                                    $idParty = $InventoryParty['idParty'];
                                    ?>
                                    <option value="<?= $InventoryParty['idParty'] ?>" ><?= $InventoryParty['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Quantity</label>
                            <input type="text" name="Quantity" data-validation="required">
                        </div>
                        <div>
                            <label>Sale Price</label>
                            <input type="text" name="SalePrice" data-validation="required">
                        </div>
                        <div>
                            <label>Cost Price</label>
                            <input type="text" name="CostPrice" data-validation="required">
                        </div>
                    </div>
                    <div class="btn-block-wrap">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="Add Sale Item" style="margin-left: 193px;width: 270px;">
                    </div>
                </fieldset>

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
            <?php // echo form_dropdown('userdepartment', $UserDepartment, '', 'id="department"'); ?>
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
            <input type="text" id="Quantity" name="Quantity">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Part">
        </div>
    </form>
</div>
<script>
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
                            <td class='tbl - name'>" + val.FullName + "</td><td>" + val.Username + "</td>\n\
<td>" + val.Department + "</td><td>" + val.RoleName + "</td><td>" + val.Name + "</td>\n\
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

    function validationform() {
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

</script>