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
                  action="<?= base_url() ?>index.php/row/newRow" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Zone Row</legend>
                    <div class="feildwrap">
                        <div>
                            <label>To</label>
                            <input type="text" name="ToRow" data-validation="number">
                        </div>
                        <div>
                            <label>From</label>
                            <input type="text" name="FromRow" data-validation="number">
                        </div>
                        <div>
                            <label>Zone</label>
                            <select name="ZoneId">
                                <option>Select Zone</option>
                                <?php
                                foreach ($Zone as $RackZone) {
                                    $ZoneId = $RackZone['idZone'];
                                    ?>
                                    <option value="<?= $RackZone['idZone'] ?>" ><?= $RackZone['ZoneName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Warehouse</label>
                            <select name="WarehouseId">
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
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Row">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Zone Row List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Zone Row</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Row">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <h4><?= $message ?></h4>
                        <div>

                            <?php
                            if ($ZoneRow == null) {
                                echo $ZoneRow;
                            } else {
                                echo "<p>Zone Row Already Exists Are:</p>";
                                foreach ($ZoneRow as $Zone) {
                                    ?>
                                    <p><?= $Zone ?></p>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Zone Row</th>
                                    <!--<th width="10%">From</th>-->
                                    <!--<th width="10%">Zone</th>-->
                                    <th width="15%">Warehouse</th>
                                    <th width="10%">Details</th>
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
                                foreach ($Row as $AllRow) {
                                    $RowId = $AllRow['id'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllRow['RowNumber'] ?></td>
                                        <!--<td class="tbl-name"><?= $AllRow['From'] ?></td>-->
                                        <!--<td class="tbl-name"><?= $AllRow['ZoneName'] ?></td>-->
                                        <td class="tbl-name"><?= $AllRow['Name'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="rowPopup('detail', '<?= $RowId ?>', '<?= $AllRow['RowNumber'] ?>', '<?= $AllRow['ZoneId'] ?>', '<?= $AllRow['WarehouseId'] ?>')">Edit</a>
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
    <form action="<?= base_url() ?>index.php/row/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Row Id</label>
            <input type="text" name="RowId" id="RowId" data-validation="number">
        </div>
        <div>
            <label>Row Number</label>
            <input type="text" name="RowNumber" id="ToRow" data-validation="number">
        </div>
        <!--        <div>
                    <label>From</label>
                    <input type="text" name="FromRow" id="FromRow" data-validation="number">
                </div>-->
        <div>
            <label>Zone</label>
            <select name="ZoneId" id="ZoneId">
                <option>Select Zone</option>
                <?php
                foreach ($Zone as $RackZone) {
                    $ZoneId = $RackZone['idZone'];
                    ?>
                    <option value="<?= $RackZone['idZone'] ?>" ><?= $RackZone['ZoneName'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Warehouse</label>
            <select name="WarehouseId" id="WarehouseId">
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
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Row">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/row/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                if (data !== "0")
                {
                    var a = JSON.parse(data);
//                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var count = 1;
                            var items = [];
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                        <td class='tbl - name'>" + val.To + "</td><td>" + val.From + "</td>\n\
<td>" + val.ZoneName + "</td><td>" + val.Name + "</td>\n\
<td><a style='cursor: pointer;' onClick=rowPopup('detail','" + val.idRow + "','" + val.To + "','" + val.From + "','" + val.ZoneId + "','" + val.WarehouseId + "')> Edit </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        console.log("else Block");
                        $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                                "<td style='border: 0px'>No Data Found</td><td style='border: 0px'></td><td style='border: 0px'></td>");
                    }
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

    function rowPopup(div_id, id, rownumber, zone, warehouse) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#RowId").val(id);
            $(this).find("#ToRow").val(rownumber);
//            $(this).find("#FromRow").val(from);
            $(this).find("select#ZoneId").val(zone);
            $(this).find("select#WarehouseId").val(warehouse);
        });
    }

</script>