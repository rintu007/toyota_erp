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
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Inventory List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Inventory By</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Part Number / Name / Category / Manufacturer" style="width: 325px;">
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="15%">Part Number</th>
                                    <th width="20%">Description</th>                                   
                                    <th width="05%">Stock Qty</th>
                                    <th width="05%">Avg. Cost</th>
                                    <th width="05%">Total</th>
                                    <th width="05%">WholeSale</th>
                                    <th width="05%">Retail</th>
                                    <th width="10%">Last Purchase</th>
                                    <th width="10%">Last Sale</th>
                                    <th width="10%">Variant</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
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
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $PartNo ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['PartName'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['StockQuantity'] ?></td>
                                        <td class="tbl-name"><?= 'AvgCost' ?></td>
                                        <td class="tbl-name"><?= 'TotalCost' ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['CostPrice'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['RetailPrice'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['LastPurchaseDate'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['LastSaleDate'] ?></td>
                                        <td class="tbl-name"><?= $PartsInventory['Variants'] ?></td>
                                        <!--<td><a style="cursor: pointer;" onClick="inventoryPopup('detail', '<?= $InventoryId ?>', '<?= $idPart ?>', '<?= $PartsInventory['PartName'] ?>', '<?= $PartsInventory['VariantId'] ?>', '<?= $PartsInventory['idCategory'] ?>', '<?= $PartsInventory['CostPrice'] ?>', '<?= $PartsInventory['RetailPrice'] ?>', '<?= $PartsInventory['ManufacturerId'] ?>', '<?= $PartsInventory['Quantity'] ?>')">Edit</a>-->
                                        <?php
                                        //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                        ?>
                                        <!--</td>-->
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
    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/inventory/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                var parsedData = JSON.parse(data);
                if (parsedData.length > 0) {
                    try {
                        var items = [];
                        $.each(parsedData, function (i, val) {
                            items += "<tr>" +
                                    "<td class='tbl-name'>" + val.PartNumber + "</td>" +
                                    "<td class='tbl-name'>" + val.PartName + "</td>" +
                                    "<td class='tbl-name'>" + val.Location + "</td>" +
                                    "<td class='tbl-name'>" + val.StockQuantity + "</td>" +
                                    "<td class='tbl-name'>AvgCost</td>" +
                                    "<td class='tbl-name'>TotalCost</td>" +
                                    "<td class='tbl-name'>" + val.CostPrice + "</td>" +
                                    "<td class='tbl-name'>" + val.RetailPrice + "</td>" +
                                    "<td class='tbl-name'>" + val.LastPurchaseDate + "</td>" +
                                    "<td class='tbl-name'>" + val.LastSaleDate + "</td>" +
                                    "<td class='tbl-name'>" + val.Variants + "</td>" +
                                    "</tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                }
                else {
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