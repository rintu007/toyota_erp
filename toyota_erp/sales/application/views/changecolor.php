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
            <div>
                <?= $message ?>
            </div>
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/changecolor/addchangecolor"
                  class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Change Color</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Allocation Type</label>
                            <select name="allocationType" data-validation="required">
                                <option>Select Allocation Type</option>
                                <?php
                                foreach ($AllocationType as $aType) {
                                    $AllocationTypeId = $aType['Id'];
                                    ?>
                                    <option value="<?= $aType['Id'] ?>" ><?= $aType['AllocationType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Model</label>
                            <select name="model" class="ModelList" data-validation="required">
                                <option>Select Model</option>
                                <?php
                                foreach ($Model as $CarModel) {
                                    $ModelId = $CarModel['Id'];
                                    ?>
                                    <option value="<?= $CarModel['Id'] ?>" ><?= $CarModel['Model'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Variant</label>
                            <select name="variant" class="VariantList" id="VariantList" data-validation="required">
                                <option>Select Variant</option>
                            </select>
                        </div>
                        <div>
                            <label>Allocation Month</label>
                            <select name="allocation_month" class="allocationMonth">
                                <option>Select Allocation Month</option>
                                <?php
                                foreach ($Month as $AllocationMonth) {
                                    ?>
                                    <option value="<?= $AllocationMonth ?>" ><?= $AllocationMonth ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>From Color</label>
                            <select name="color" class="color1" id="ColorList1" data-validation='required'>
                                <option>Select Color</option>
                            </select>
                        </div>
                        <div>
                            <label>To Change Color</label>
                            <select name="color2" class="color1" id="ColorList2" data-validation='required'>
                                <option>Select Color</option>
                            </select>
                        </div>
                        <div>
                            <label>Allocation Quantity</label>
                            <input type="text" name="quantity" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Change Color">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Change Color List</legend>
                    <div class="feildwrap">
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="12%">Change Date</th>
                                    <th width="12%">Allocation Type</th>
                                    <th width="20%">Variant</th>
                                    <th width="8%">Month</th>
                                    <th width="12%">From Color</th>
                                    <th width="12%">To Color</th>
                                    <th width="14%">Quantity</th>
                                    <!--<th width="20%">Details</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                                <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                <!--                                            <li><a href="" class="active"><span>-->
                                                <!--</span></a></li>-->
                                                <!--                                            <li>-->
                                                <?//= $pagination; ?><!--</li>-->
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
                                foreach ($ChangeColor as $Color) {
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $Color['ChangeDate'] ?></td>
                                        <td class="tbl-name"><?= $Color['AllocationType'] ?></td>
                                        <td class="tbl-name"><?= $Color['Variants'] ?></td>
                                        <td class="tbl-name"><?= $Color['Month'] ?></td>
                                        <td class="tbl-name"><?= $Color['From Color'] ?></td>
                                        <td class="tbl-name"><?= $Color['To Color'] ?></td>
                                        <td class="tbl-name"><?= $Color['Quantity'] ?></td>
                                        <!--<td><a style="cursor: pointer;" onClick="customertypePopup('detail', '<?= $idAllocation ?>', '<?= $Allocations['VariantId'] ?>', '<?= $Allocations['ColorId'] ?>', '<?= $Allocations['Month'] ?>', '<?= $Allocations['Quantity'] ?>', '<?= $Allocations['ValidityDate'] ?>')">Edit</a>-->
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
<!-- Edit Customer Type Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/allocation/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Allocation Type ID</label>
            <input type="text" id="idCustomerType" name="allocation_type_id">
        </div>
        <br>
        <div>
            <label>Allocation Type Name</label>
            <input type="text" id="customertype_name" name="allocation_type_name">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Allocation Type">
        </div>
    </form>
</div>
<script>
    $(".VariantList").change(function() {
        var variant = $(".VariantList").val();

        console.log(variant);
        $.ajax({
            url: "<?= base_url() ?>index.php/allocation/getColor",
            type: "POST",
            data: {variantId: variant},
            success: function(data) {
                var a = JSON.parse(data);
                console.log(a);
                if (a.length > 0) {
                    try {
                        var items = "<option>Select Color</option>";
                        $.each(a, function(i, val) {
                            items += "<option value='" + val.ColorId + "'>" + val.ColorName + "</option>";
                        });
                        $('#ColorList1').html(items);
                        $('#ColorList2').html(items);
                    }
                    catch (e) {
                        console.log(e);
                    }
                } else {
                    var items = "<option>Select Color</option>";
                    $('#ColorList1').html(items);
                    $('#ColorList2').html(items);
                }
            }
        });
    });

    $(".ModelList").change(function() {
        var model = $(".ModelList").val();

        console.log(model);
        $.ajax({
            url: "<?= base_url() ?>index.php/allocation/getVariants",
            type: "POST",
            data: {ModelId: model},
            success: function(data) {
                var a = JSON.parse(data);
                console.log(a);
                if (a.length > 0) {
                    try {
                        var items = "<option>Select Variant</option>";
                        $.each(a, function(i, val) {
                            items += "<option value='" + val.IdVariants + "'>" + val.Variants + "</option>";
                        });
                        $('#VariantList').html(items);
                    }
                    catch (e) {
                        console.log(e);
                    }
                } else {
                    var items = "<option>Select Variant</option>";
                    var itemsColor = "<option>Select Color</option>";
                    $('#ColorList1').html(itemsColor);
                    $('#ColorList2').html(itemsColor);
                    $('#VariantList').html(items);
                }
            }
        });
    });

    function validationform() {
        chosen = "";

        pass = $("#pass").val();
        confirm_pass = $("#cpass").val();
        if (pass != confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }
    }

    function customertypePopup(div_id, id, name) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idCustomerType").val(id);
            $(this).find("#customertype_name").val(name);
        });

    }

</script>