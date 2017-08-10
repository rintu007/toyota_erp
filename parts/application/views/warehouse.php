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
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/warehouse/newWarehouse" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Warehouse</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Warehouse Name</label>
                            <input type="text" name="Name" data-validation="required">
                        </div>
                        <br>
                        <div>
                            <label>Person Incharge</label>
                            <input type="text" name="Incharge" data-validation="required">
                        </div>
                        <div>
                            <label>Mobile Number</label>
                            <input type="text" name="MobileNumber" id="MobileNumber" data-validation="numeric">
                        </div>
                        <div>
                            <label>Address</label>
                            <textarea name="Address" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Warehouse">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Warehouse List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Warehouse</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Warehouse Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Name</th>
                                    <th width="20%">Person Incharge</th>
                                    <th width="10%">Mobile Number</th>
                                    <th width="20%">Address</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul></ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($Warehouse as $AllWarehouse) {
                                    $WarehouseId = $AllWarehouse['idWarehouse'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllWarehouse['Name'] ?></td>
                                        <td class="tbl-name"><?= $AllWarehouse['PersonIncharge'] ?></td>
                                        <td class="tbl-name"><?= $AllWarehouse['Cellphone'] ?></td>
                                        <td class="tbl-name"><?= $AllWarehouse['Address'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="warehousePopup('detail', '<?= $WarehouseId ?>', '<?= $AllWarehouse['Name'] ?>', '<?= $AllWarehouse['Cellphone'] ?>', '<?= $AllWarehouse['Address'] ?>', '<?= $AllWarehouse['PersonIncharge'] ?>')">Edit</a> 
                                            <?php
                                            //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                            ?>
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
<!-- Edit User Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/warehouse/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Warehouse ID</label>
            <input type="text" name="WarehouseId" id="WarehouseId" data-validation="required">
        </div>
        <div>
            <label>Warehouse Name</label>
            <input type="text" name="Name" id="Name" data-validation="required">
        </div>
        <div>
            <label>Person Incharge</label>
            <input type="text" name="Incharge" id="Incharge" data-validation="required">
        </div>
        <div>
            <label>Mobile Number</label>
            <input type="text" name="MobileNumber" id="MobileNumber" data-validation="numeric">
        </div>
        <div>
            <label>Address</label>
            <textarea name="Address" id="Address"></textarea>
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Warehouse">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/warehouse/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var count = 1;
                            var items = "";
                            $.each(a, function (i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.Name + "</td><td class='tbl - name'>" + val.PersonIncharge + "</td><td>" + val.Cellphone + "</td>\n\
<td>" + val.Address + "</td>\n\
<td><a style='cursor: pointer;' onClick=warehousePopup('detail','" + val.idWarehouse + "','" + val.Name + "','" + val.Cellphone + "','" + val.Address + "'')> Edit </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("#finalResult").html("<<td style='border: 0px' colspan='6'><span style='font-weight: bold;'>Search Result:</span> '"+search+"' has no record.</td>");
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px' colspan='6'><span style='font-weight: bold;'>Search Result:</span> '"+search+"' has no record.</td>");
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

    function warehousePopup(div_id, id, name, cell, address, incharge) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#WarehouseId").val(id);
            $(this).find("#Name").val(name);
            $(this).find("#Incharge").val(incharge);
            $(this).find("#MobileNumber").val(cell);
            $(this).find("#Address").val(address);
        });
    }

</script>