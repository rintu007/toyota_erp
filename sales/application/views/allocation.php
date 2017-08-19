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
                  action="<?= base_url() ?>index.php/allocation/addallocation"
                  class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Allocation</legend>
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
                            <label>Variant Color</label>
                            <select name="color" class="color1" id="ColorList1" '>
                                <option>Select Color</option>
                            </select>
                        </div>
                        <div>
                            <label>Validity Start Date</label>
                            <input type="text" name="validitystartdate" class="date" data-validation="required">
                        </div>
                        <div>
                            <label>Validity End Date</label>
                            <input type="text" name="validityenddate" class="date" data-validation="required">
                        </div>
                        <div>
                            <label>Allocation Month</label>

                            <input type="month" name="allocation_month"  id="allocation_month" data-validation="required">
                        </div>
                        <div>
                            <br>

                            <label>Allocation Quantity</label>
                            <input type="text" name="quantity" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Allocation">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Allocation List</legend>
                    <div class="feildwrap">
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="12%">Allocation Type</th>
                                    <th width="20%">Variant</th>
                                    <th width="12%">Color</th>
                                    <th width="8%">Month</th>
                                    <th width="10%">Validity From</th>
                                    <th width="10%">Validity To</th>
                                    <th width="14%">Allocation Quantity</th>
                                    <th width="10%">Details</th>
									<th width="10%">Action</th>
                                </tr>
                            </thead>
                             <tfoot>
                                <tr>
                                    
                                    <td colspan="9">
                                        <div id="paging">
                                            <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                                Total : <?php echo $counts ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <div id="paging">
                                            <ul>
                                                <?php echo $links ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot> 
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($Allocation as $Allocations) {
                                    $idAllocation = $Allocations['idAllocation'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $Allocations['AllocationType'] ?></td>
                                        <td class="tbl-name"><?= $Allocations['Variants'] ?></td>
                                        <td class="tbl-name"><?= $Allocations['ColorName'] ?></td>
                                        <td class="tbl-name"><?= $Allocations['Month'] ?></td>
                                        <td class="tbl-name"><?= $Allocations['ValidityStartDate'] ?></td>
                                        <td class="tbl-name"><?= $Allocations['ValidityEndDate'] ?></td>
                                        <td class="tbl-name"><?= $Allocations['Quantity'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="customertypePopup('detail', '<?= $idAllocation ?>','<?= $Allocations['AllocationType'] ?>','<?= $Allocations['Variants'] ?>', '<?= $Allocations['ColorName'] ?>', '<?= $Allocations['Month'] ?>', '<?= $Allocations['ValidityStartDate'] ?>', '<?= $Allocations['ValidityEndDate'] ?>', '<?= $Allocations['Quantity'] ?>')">Edit</a>
                                        </td>
										<td>
									
                                    <a href="<?=	base_url()."index.php/allocation/delete/"  ?><?= $idAllocation ?>">Delete</a>

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
    <!--    <div style="display: none;">
            <label>Customer Type ID</label>
            <input type="text" id="idCustomerType" name="allocation_type_id">
        </div>
        <br>
        <div>
            <label>Customer Name</label>
            <input type="text" id="customertype_name" name="">
        </div> -->
        <div style="display: none;">
            <label>Allocation Type ID</label>
            <input type="text" id="idAllocation" name="">
        </div>
        <br>
        <div>
            <label>Allocation Type</label>
            <input type="text" id="allocationType" name="">
        </div>
         <div>
       
        <div>
        <label>Variant</label>
            <input type="text" id="Variant" name="">
        </div>
        <div>
        <label>Color</label>
            <input type="text" id="Colortype" name="">
        </div>
        <div>
        <label>Month</label>
            <input type="text" id="Month" name="">
        </div>
        <div>
        <label>Validity From</label>
            <input type="text" id="validityFrom" name="">
        </div>
        <div>
        <label>Validity To</label>
            <input type="text" id="validityTo" name="">
        </div>
        <div>
        <label>Allocation Quantity</label>
            <input type="text" id="allocationQuantity" name="">
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
                    }
                    catch (e) {
                        console.log(e);
                    }
                } else {
                    var items = "<option>Select Color</option>";
                    $('#ColorList1').html(items);
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

    function customertypePopup(div_id,idallocationi,allocationtypei,varianti,colori,monthi,validityfromi,validitytoi,allocationquantityi) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
           // $(this).find("#idCustomerType").val(id);
           // $(this).find("#customertype_name").val(name);
            $(this).find("#idAllocation").val(idallocationi);
            $(this).find("#allocationType").val(allocationtypei);
            $(this).find("#Variant").val(varianti);
            $(this).find("#Colortype").val(colori);
            $(this).find("#Month").val(monthi);
            $(this).find("#validityFrom").val(validityfromi);
            $(this).find("#validityTo").val(validitytoi);
            $(this).find("#allocationQuantity").val(allocationquantityi);
        });

    }

</script>