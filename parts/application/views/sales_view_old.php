<div id="wrapper">
    <div id="content">
        <?php
//         $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['isAdmin'] == 1) {
        include 'include/sale_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Sales List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Sale</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Part Number / Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <br/>
                        <br/>
                        <div>
                            <label> Search By Date</label>
                        </div>
                        <br/>
                        <div>
                            <label for="fromDate">From</label>
                            <input type="text" class="date"  name="fromDate" id="fromDate">
                        </div>
                        <div>
                            <label for="toDate">To</label>
                            <input type="text" class="date" name="toDate"  id="toDate">
                            <input type="button" id="submintFilter" class="btn" value="Filter By Date">
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="16%">Part</th>
                                    <th width="10%">Sale Type</th>
                                    <th width="6%">Qty Sold</th>
                                    <th width="6%">Qty in Stock</th>
                                    <th width="9%">Sale Price</th>                                  
                                    <th width="10%">Total Price</th>
                                    <th width="9%">Cost Price</th>                                   
                                    <th width="10%">Total Cost</th>                                    
                                    <th width="10%">Sale Date</th>
                                    <th width="14%">Sale Status</th>
                                    <th width="14%">Generate Invoice</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul></ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($Sale as $InventorySales) {
                                    $InventoryId = $InventorySales['idSale'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $InventorySales['PartNumber'] . ' (' . $InventorySales['PartName'] . ')' ?></td>
                                        <td class="tbl-name"><?= $InventorySales['SaleType'] ?></td>
                                        <td class="tbl-name"><?= $InventorySales['SaleQuantity'] ?></td>
                                        <td class="tbl-name"><?= $InventorySales['Quantity'] ?></td>                                   
                                        <td class="tbl-name"><?= $InventorySales['SalePrice'] - $InventorySales['Discount'] ?></td>
                                        <td class="tbl-name"><?= $InventorySales['TotalPrice'] ?></td>
                                        <td class="tbl-name"><?= $InventorySales['CostPrice'] ?></td>
                                        <td class="tbl-name"><?= $InventorySales['TotalCost'] ?></td>
                                        <td class="tbl-name"><?= $InventorySales['SaleDate'] ?></td>
                                        <?php
                                        if ($InventorySales['TotalPrice'] - $InventorySales['TotalCost'] > 0) {
                                            echo "<td class='tbl-name' style='background-color:green'><label style='font-weight:bolder;font-size:larger'>Profit</label></td>";
                                        } else {
                                            if ($InventorySales['TotalPrice'] - $InventorySales['TotalCost'] == 0) {
                                                echo "<td class='tbl-name' style='background-color:orangered'><label style='font-weight:bolder;font-size:larger'>No Profit</label></td>";
                                            } else {
                                                echo "<td class='tbl-name' style='background-color:red'><label style='font-weight:bolder;font-size:larger'>Loss</label></td>";
                                            }
                                        }
                                        ?>
                                        <td class="tbl-name"><a href="<?= base_url() . 'index.php/sales/generate/' . $InventorySales['idSale'] ?>">Generate</a></td>
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
            url: "<?= base_url() ?>index.php/sales/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var items = [];
                        var count = 1;
                        $.each(a, function (i, val) {
                            var idPart = val.idPart;
                            var idOld = val.OldPart;
                            if (idPart === idOld) {
                                idPart = val.SuperceedPart;
                            }
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.PartNumber + " (" + val.PartName + ") </td><td>" + val.SaleType + "</td>\n\
<td>" + val.SaleQuantity + "</td><td>" + val.Quantity + "</td><td>" + val.SalePrice + "</td>\n\
<td>" + val.TotalPrice + "</td><td>" + val.CostPrice + "</td><td>" + val.TotalCost + "</td><td>" + val.SaleDate + "</td>";
                            if (val.TotalPrice - val.TotalCost > 0) {
                                items += "<td class='tbl-name' style='background-color:green'><label style='font-weight:bolder;font-size:larger'>Profit</label></td>";
                            } else {
                                if (val.TotalPrice - val.TotalCost == 0) {
                                    items += "<td class='tbl-name' style='background-color:orangered'><label style='font-weight:bolder;font-size:larger'>No Profit</label></td>";
                                } else {
                                    items += "<td class='tbl-name' style='background-color:red'><label style='font-weight:bolder;font-size:larger'>Loss</label></td>";
                                }
                            }
                            items += "</tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px' colspan='11'><span style='font-weight: bold;'>Search Result:</span> '" + search + "' has no record.</td>");
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

    $("#submintFilter").click(function () {
        var fromDate = $("#fromDate").val();
        var toDate = $("#toDate").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/sales/filterByDate",
            type: "POST",
            data: {fromDate: fromDate, toDate: toDate},
            success: function (data) {
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var items = [];
                        var count = 1;
                        $.each(a, function (i, val) {
                            var idPart = val.idPart;
                            var idOld = val.OldPart;
                            if (idPart === idOld) {
                                idPart = val.SuperceedPart;
                            }
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.PartNumber + " (" + val.PartName + ") </td><td>" + val.SaleType + "</td>\n\
<td>" + val.SaleQuantity + "</td><td>" + val.Quantity + "</td><td>" + val.SalePrice + "</td>\n\
<td>" + val.TotalPrice + "</td><td>" + val.CostPrice + "</td><td>" + val.TotalCost + "</td><td>" + val.SaleDate + "</td>";
                            if (val.TotalPrice - val.TotalCost > 0) {
                                items += "<td class='tbl-name' style='background-color:green'><label style='font-weight:bolder;font-size:larger'>Profit</label></td>";
                            } else {
                                if (val.TotalPrice - val.TotalCost == 0) {
                                    items += "<td class='tbl-name' style='background-color:orangered'><label style='font-weight:bolder;font-size:larger'>No Profit</label></td>";
                                } else {
                                    items += "<td class='tbl-name' style='background-color:red'><label style='font-weight:bolder;font-size:larger'>Loss</label></td>";
                                }
                            }
                            items += "</tr>";
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