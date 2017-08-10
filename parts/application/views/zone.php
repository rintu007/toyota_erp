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
                  action="<?= base_url() ?>index.php/zone/newZone" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Zone</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Zone</label>
                            <input type="text" name="ZoneName" data-validation="required">
                        </div>
                        <div>
                            <label>Warehouse</label>
                            <select name="WarehouseId" id="Warehouse">
                                <option>Select Warehouse</option>
                                <?php
                                foreach ($Warehouse as $PartsWarehouse) {
                                    $WarehouseId = $PartsWarehouse['idWarehouse'];
                                    ?>
                                    <option value="<?= $PartsWarehouse['idWarehouse'] ?>" ><?= $PartsWarehouse['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-warehouse cb-error help-block">Option must be selected!</span>
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Zone">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Zone List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Zone</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Zone Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Zone</th>
                                    <th width="15%">Warehouse</th>
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
                                foreach ($Zone as $AllZone) {
                                    $ZoneId = $AllZone['idZone'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllZone['ZoneName'] ?></td>
                                        <td class="tbl-name"><?= $AllZone['Name'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="zonePopup('detail', '<?= $ZoneId ?>', '<?= $AllZone['ZoneName'] ?>', '<?= $AllZone['WarehouseId'] ?>')">Edit</a>
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
    <form action="<?= base_url() ?>index.php/zone/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Zone ID</label>
            <input type="text" name="ZoneId" id="ZoneId" data-validation="required">
        </div>
        <div>
            <label>Zone</label>
            <input type="text" name="ZoneName" id="ZoneName" data-validation="required">
        </div>
        <div>
            <label>Warehouse</label>
            <select name="WarehouseId" id="WarehouseId">
                <option>Select Warehouse</option>
                <?php
                foreach ($Warehouse as $RackWarehouse) {
                    $WarehouseId = $PartsWarehouse['idWarehouse'];
                    ?>
                    <option value="<?= $PartsWarehouse['idWarehouse'] ?>" ><?= $PartsWarehouse['Name'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Zone">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/zone/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                if (data !== "null") {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var count = 1;
                            var items = "";
                            $.each(a, function (i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.ZoneName + "</td><td>" + val.Name + "</td>\n\
<td><a style='cursor: pointer;' onClick=zonePopup('detail','" + val.idZone + "','" + val.ZoneName + "','" + val.Name + "')> Edit </a> / <a> Delete </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("#finalResult").html("<td style='border: 0px' colspan='4'><span style='font-weight: bold;'>Search Result:</span> '" + search + "' has no record.</td>");
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px' colspan='4'><span style='font-weight: bold;'>Search Result:</span> '" + search + "' has no record.</td>");
                }
            }
        });
    });

    function validationform() {
        var WareHouse = $('#Warehouse').val();
        if (WareHouse === "Select Warehouse") {
            $(".error-warehouse").show();
            return false;
        } else {
            $(".error-warehouse").hide();
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

    function zonePopup(div_id, id, zone, warehouse) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
            $(this).find("#ZoneId").val(id);
            $(this).find("#ZoneName").val(zone);
            $(this).find("select#WarehouseId").val(warehouse);
        });
    }

</script>