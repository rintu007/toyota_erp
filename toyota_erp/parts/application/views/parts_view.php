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
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Parts List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Part</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Part ID / Name / Category / Manufacturer">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="8%">Part Number</th>
                                    <th width="18%">Description</th>
                                    <th width="10%">Part Category</th>
                                    <th width="9%">Cost Price</th>
                                    <th width="9%">Retail Price</th>
                                    <th width="15%">Part Manufacturer</th>
                                    <th width="6%">Primary Location</th>
                                    <th width="6%">Secondary Location</th>
                                    <th width="10%">Details</th>
                                  <!--<th width="10%">Price</th>-->
                                  <!--<th width="10%">Details</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
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
                                foreach ($Inventory as $PartsInventory) {
                                    $InventoryId = $PartsInventory['idInventory'];
                                    $idPart = $PartsInventory['idPart'];
                                    $OldPart = $PartsInventory['OldPart'];
                                    if ($idPart == $OldPart) {
                                        $PartNo = $PartsInventory['SuperceedPart'];
                                    } else {
                                        $PartNo = $PartsInventory['PartNumber'];
                                    }
                                    ?>
                                    <?php
                                    $sumArray = explode(",", $PartsInventory['Locations']);
//                                                $totalAmount = "";
//                                    foreach ($sumArray as $val) {
//                                                    $totalAmount += $val;
//                                    }
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="resId" name="resId"><?= $PartNo ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['PartName'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['CategoryName'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['CostPrice'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['RetailPrice'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['Manufacturer'] ?></td>
                                        <td class="tbl-name"><?= ($sumArray[0]); ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['SecondaryLocation']; ?></td>
                                        <td>
                                                <!--<a style="cursor: pointer;" onClick="inventoryPopup('detail', '<?= $InventoryId ?>', '<?= $idPart ?>', '<?= $PartsInventory['PartName'] ?>', '<?= $PartsInventory['VariantId'] ?>', '<?= $PartsInventory['idCategory'] ?>', '<?= $PartsInventory['CostPrice'] ?>', '<?= $PartsInventory['RetailPrice'] ?>', '<?= $PartsInventory['ManufacturerId'] ?>', '<?= $PartsInventory['Quantity'] ?>')">-->
                                            <a style="cursor: pointer;" href="<?=base_url()?>index.php/parts/edit/<?=$PartsInventory['idPart']?>">
                                                Edit
                                            </a>
                                            <!--?>-->
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
    <form action="<?= base_url() ?>index.php/parts/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Inventory ID</label>
            <input type="text" id="InventoryId" name="InventoryId">
        </div>
        <br>
        <div>
            <label>Part ID</label>
            <input type="text" name="PartId" id="PartId" data-validation="required">
        </div>
        <div>
            <label>Part Name</label>
            <input type="text" name="PartName" id="PartName" data-validation="required">
        </div>
        <div>
            <label>Variant</label>
            <select name="VariantId" id="VariantId">
                <option>Select Variant</option>
                <?php
                foreach ($Variant as $CarVariants) {
                    $VariantId = $CarVariants['idCategory'];
                    ?>
                    <option value="<?= $CarVariants['idVariant'] ?>" ><?= $CarVariants['VariantName'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Part Category</label>
            <select name="PartCategory" id="PartCategory">
                <option>Select Category</option>
                <?php
                foreach ($Category as $PartCategory) {
                    $CategoryId = $PartCategory['idCategory'];
                    ?>
                    <option value="<?= $PartCategory['idCategory'] ?>" ><?= $PartCategory['CategoryName'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Cost Price</label>
            <input type="text" name="CostPrice" id="CostPrice" data-validation="number">
        </div>
        <div>
            <label>Retail Price</label>
            <input type="text" name="RetailPrice" id="RetailPrice" data-validation="number">
        </div>
        <div>
            <label>Part Manufacturer</label>
            <select name="ManufacturerId" id="ManufacturerId">
                <option>Select Manufacturer</option>
                <?php
                foreach ($Manufacturer as $PartManufacturer) {
                    $ManufacturerId = $PartManufacturer['idManufacturer'];
                    ?>
                    <option value="<?= $PartManufacturer['idManufacturer'] ?>" ><?= $PartManufacturer['Manufacturer'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Quantity</label>
            <input type="text" name="Quantity" id="Quantity" data-validation="number">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Inventory">
        </div>
    </form>
</div>
<script>
        $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/viewparts/searchPartDetails",
            type: "POST",
            data: {search: search},
            success: function(data) {
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var items = [];
                        var count = 1;
                        $.each(a, function(i, val) {
                            var idPart = val.idPart;
                            var idOld = val.OldPart;
                            if (idPart === idOld) {
                                idPart = val.SuperceedPart;
                            }
                            var locationArray = val['Locations'].split(',');
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>" +
                                    "<td class='tbl-name'> " + val.PartNumber + " </td>" +
                                    "<td>" + val.PartName + "</td>" +
                                    "<td>" + val.CategoryName + "</td>" +
                                    "<td>" + val.CostPrice + "</td>" +
                                    "<td>" + val.RetailPrice + "</td>" +
                                    "<td>" + val.Manufacturer + "</td>" +
                                    "<td>" + locationArray[0] + "</td>" +
                                    "<td>" + locationArray[1] + "</td>" +
                                    "<td><a style='cursor: pointer;' href='<?= base_url() ?>index.php/parts/edit/" + val.idPart + "'>Edit</a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
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

    function inventoryPopup(div_id, id, partid, partname, variant, category, cost, retail, manufacturer, quantity) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#InventoryId").val(id);
            $(this).find("#PartId").val(partid);
            $(this).find("#PartName").val(partname);
            $(this).find("select#VariantId").val(variant);
            $(this).find("select#PartCategory").val(category);
            $(this).find("#CostPrice").val(cost);
            $(this).find("#RetailPrice").val(retail);
            $(this).find("select#ManufacturerId").val(manufacturer);
            $(this).find("#Quantity").val(quantity);
        });
    }

</script>