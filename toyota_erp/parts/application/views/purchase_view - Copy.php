<div id="wrapper">
    <div id="content">
        <?php
//        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['isAdmin'] == 1) {
        include 'include/purchase_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Purchase Items List</legend>
                    <div class="feildwrap">
                        <div>
                            <select id="TypePurchase">
                                <option>Select One</option>
                                <option value="IMC">IMC</option>
                                <?php
                                $user = unserialize($_COOKIE["logindata"]);

                                if ($user['username'] != "Talib") {
                                    echo '<option value="LOC">LOC</option>';
                                }
                                ?>
                            </select>
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div>
                        <div id="LocalPurchase" style="display: none;">
                            <div class="feildwrap">
                                <div>
                                    <label>Search LOC Purchase Items</label>
                                    <input type="text" name="search" id="searchLOC" placeholder="Search">
                                </div>
                                <br/>
                                <br/>
                                <div>
                                    <label> Search By Date</label>
                                </div>
                                <br/>
                                <div>
                                    <label for="fromDateLOC">From</label>
                                    <input type="text" class="date"  name="fromDateLOC" id="fromDateLOC" >
                                    <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                                </div>
                                <div>
                                    <label for="toDateLOC">To</label>
                                    <input type="text" class="date" name="toDateLOC"  id="toDateLOC" >
                                    <input type="button" id="submitLOCFilter" class="btn" value="Filter By Date">
                                </div> 
                            </div>
                            <div class="btn-block-wrap dg">
                                <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                    <thead>
                                        <tr>
                                            <th width="5%">S No.</th>
                                            <th width="8%">Part Number</th>
                                            <th width="18%">PartName</th>
                                            <th width="10%">Part Category</th>
                                            <th width="10%">Purchase Type</th>
                                            <th width="9%">CP w. GST</th>
                                            <th width="6%">Quantity</th>
                                            <th width="10%">Purchase Date</th>
                                            <th width="16%">Purchase Return</th>
                                            <th width="16%">Purchase Invoice</th>
                                            <!--<th width="10%">Details</th>-->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan="12">
                                                <div id="paging">
                                                    <ul></ul>
                                                </div>
                                        </tr>
                                    </tfoot>
                                    <tbody id="finalResultLOC">
                                        <?php
                                        $count = 1;
                                        foreach ($LOCPurchase as $row) {
                                            $InventoryId = $row['idPurchase'];
											//var_dump($InventoryId);
                                            ?>
                                            <tr id="carUsers">
                                                <td class="resId" name="resId"><?= $count++ ?></td>
                                                <td class="resId" name="resId"><?= $row['PartNumber'] ?></td>
                                                <td class="tbl-name"><?= $row['PartName'] ?></td>
                                                <td class="tbl-name"><?= $row['CategoryName'] ?></td>
                                                <td class="tbl-name"><?= $row['PurchaseType'] ?></td>
                                                <td class="tbl-name"><?= $row['LandValue'] ?></td>
                                                <td class="tbl-name"><?= $row['PurchaseQuantity'] ?></td>
                                                <td class="tbl-name"><?= $row['PurchaseDate'] ?></td>
                                                <td class="tbl-name"><a onclick='purchaseReturn("loc",<?= json_encode($row) ?>)'>Generate</a></td>
                                                <td class="tbl-name"><a href="<?= site_url('purchase/generateLoc/'.$InventoryId) ?>">Generate</a></td>
												
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
                        </div>
                        <div id="ImcPurchase" style="display: none;">
                            <div class="feildwrap">
                                <div>
                                    <label>Search IMC Purchase Items</label>
                                    <input type="text" name="search" id="searchIMC" placeholder="Search">
                                </div>
                                <br/>
                                <br/>
                                <div>
                                    <label> Search By Date</label>
                                </div>
                                <br/>
                                <div>
                                    <label for="fromDate">From</label>
                                    <input type="text" class="date"  name="fromDateIMC" id="fromDateIMC" >
                                    <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                                </div>
                                <div>
                                    <label for="toDate">To</label>
                                    <input type="text" class="date" name="toDateIMC"  id="toDateIMC" >
                                    <input type="button" id="submitIMCFilter" class="btn" value="Filter By Date">
                                </div> 
                            </div>
                            <div class="btn-block-wrap dg">
                                <table width="100%" border="0" cellpadding="1" cellspacing="1" >
                                    <thead>
                                        <tr>
                                            <th width="5%">S No.</th>
                                            <th width="8%">Order Number</th>
                                            <th width="8%">Invoice #</th>
                                            <th width="8%">Invoice Date</th>
                                            <th width="8%">Part Number</th>
                                            <th width="18%">PartName</th>
                                            <th width="6%">Quantity</th>
                                            <th width="9%">CP w. GST</th>
                                            <th width="9%">Total Cost</th>
                                            <th width="8%">Purchase Date</th>
                                            <th width="16%">Purchase Return</th>
                                            <th width="16%">Purchase Invoice</th>
                                           <!--<th width="9%">CP w. GST</th>-->
                                           <!--<th width="10%">Details</th>-->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan="12">
                                                <div id="paging">
                                                    <ul>
                                                    </ul>
                                                </div>
                                        </tr>
                                    </tfoot>
                                    <tbody id="finalResultIMC">
                                        <?php
                                        $count = 1;
                                        foreach ($IMCPurchase as $InventoryPurchaseIMC) {
                                            $InventoryIdIMC = $InventoryPurchaseIMC['idPurchase'];
											//var_dump($InventoryIdIMC);
                                            ?>
                                            <tr id="carUsers">
                                                <td class="resId" name="resId"><?= $count++ ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchaseIMC['OrderNo'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchaseIMC['InvoiceNumber'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchaseIMC['InvoiceDate'] ?></td>
                                                <td class="resId" name="resId"><?= $InventoryPurchaseIMC['PartNumber'] ?></td>
                                                <td class="resId" name="resId"><?= $InventoryPurchaseIMC['PartName'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchaseIMC['QuantityReceived'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchaseIMC['LandValue'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchaseIMC['TotalCost'] ?></td>
                                                <td class="tbl-name"><?= $InventoryPurchaseIMC['PurchaseDate'] ?></td>
                                                <td class="tbl-name"><a onclick='purchaseReturn("imc",<?= json_encode($InventoryPurchaseIMC) ?>)'>Generate</a></td>
                                                <td class="tbl-name"><a href="<?= site_url('purchase/generateImc/'.$InventoryIdIMC) ?>">Generate</a></td>
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
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!--purchase return popup-->
<div id='purchasereturn' style="width: 750px;" class="feildwrap  popup popup-purchasereturn">
    <form id="purchaseReturn" action="<?php echo base_url() ?>index.php/purchase/savepurchaseReturn" method="POST" class="form animated fadeIn"  style="width: 250px;">
        <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">

        <div>

            <fieldset style="height:200px;margin-left: 30px;" >
                <legend>Purchase Return</legend>
                <div class="feildwrap" style="">
                    <div id="sr_message"></div>
                    <div id="display_purchasereturn">
                        <div>
                            <label>Part No#</label>
                            <input type="text"  id="partnumber" readonly>

                            <label>Part Name</label>
                            <input type="text"  id="partname" readonly>



                            <label for="ReturnQuantity">Return Quantity</label>
                            <input type="number" name="ReturnQuantity" style="width: 250px;" placeholder="Enter Quantity" id="ReturnQuantity" min="1">

<!--<input type="hidden" name="idSaleDetail" id="idSaleDetail" >-->
                            <input type="hidden" name="idPurchase" id="PurchaseId" >
                            <input type="hidden" name="idPart" id="RetunPartId">
                            <input type="hidden" name="type" id="returntype">

                        </div>
                        <div style="float: right;margin-left: 25px;">
                            <input id="OK" type="submit" class="btn" value="Submit" style="width: 100px;">
                        </div>
                    </div>
                </div>                        
            </fieldset>
        </div><br>
    </form>
</div>
<script>
    $("#TypePurchase").change(function() {
        if ($("#TypePurchase").val() == "LOC") {
            $("#LocalPurchase").show();
            $("#ImcPurchase").hide();
        } else if ($("#TypePurchase").val() == "IMC") {
            $("#ImcPurchase").show();
            $("#LocalPurchase").hide();
        } else {
            $("#LocalPurchase").hide();
            $("#ImcPurchase").hide();
        }
    });

    $("#searchLOC").keyup(function() {
        var search = $("#searchLOC").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/searchLOC",
            type: "POST",
            data: {searchLOC: search},
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
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.PartNumber + "</td><td>" + val.PartName + "</td>\n\
<td>" + val.CategoryName + "</td><td>" + val.PurchaseType + "</td><td>" + val.LandValue + "</td>\n\
<td>" + val.PurchaseQuantity + "</td><td>" + val.PurchaseDate + "</td></tr>";
                        });
                        $('#finalResultLOC').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResultLOC").html("<td style='border: 0px' colspan='8'><span style='font-weight: bold;'>Search Result:</span> '" + search + "' has no record.</td>");
                }
            }
        });
    });
    $("#searchIMC").keyup(function() {
        var search = $("#searchIMC").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/searchIMC",
            type: "POST",
            data: {searchIMC: search},
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
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + ((val.OrderNo == null) ? "" : val.OrderNo) + "</td><td>" + val.InvoiceNumber + "</td>\n\
<td>" + val.InvoiceDate + "</td><td>" + val.PartNumber + "</td><td>" + val.PartName + "</td>\n\
<td>" + val.QuantityReceived + "</td><td>" + val.LandValue + "</td><td>" + ((val.TotalCost == null) ? "" : val.TotalCost) + "</td><td>" + val.PurchaseDate + "</td></tr>";
                        });
                        $('#finalResultIMC').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResultIMC").html("<td style='border: 0px' colspan='10'><span style='font-weight: bold;'>Search Result:</span> '" + search + "' has no record.</td>");
                }
            }
        });
    });

    $("#submitLOCFilter").click(function() {
        var fromDate = $("#fromDateLOC").val();
        var toDate = $("#toDateLOC").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/filterByDateLOC",
            type: "POST",
            data: {fromDate: fromDate, toDate: toDate},
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
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.PartNumber + "</td><td>" + val.PartName + "</td>\n\
<td>" + val.CategoryName + "</td><td>" + val.PurchaseType + "</td><td>" + val.LandValue + "</td>\n\
<td>" + val.PurchaseQuantity + "</td><td>" + val.PurchaseDate + "</td></tr>";
                        });
                        $('#finalResultLOC').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResultLOC").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
                                <td style='border: 0px'></td><td style='border: 0px'></td>");
                }
            }
        });
    });
    $("#submitIMCFilter").click(function() {
        var fromDate = $("#fromDateIMC").val();
        var toDate = $("#toDateIMC").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/filterByDateIMC",
            type: "POST",
            data: {fromDate: fromDate, toDate: toDate},
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
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + ((val.OrderNo == null) ? "" : val.OrderNo) + "</td><td>" + val.InvoiceNumber + "</td>\n\
<td>" + val.InvoiceDate + "</td><td>" + val.PartNumber + "</td><td>" + val.PartName + "</td>\n\
<td>" + val.QuantityReceived + "</td><td>" + val.LandValue + "</td><td>" + ((val.TotalCost == null) ? "" : val.TotalCost) + "</td><td>" + val.PurchaseDate + "</td></tr>";
                        });
                        $('#finalResultIMC').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                }
                else {
                    $("#finalResultIMC").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
                                <td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>");
                }
            }
        });
    });

    function purchaseReturn(type, val)
    {

        $("#returntype").val(type);
        $("#display_purchasereturn").show()
        salereturn = val;
        console.log(val)
        currentqty = (type == 'imc') ? val.QuantityReceived : val.PurchaseQuantity;

        var TotalReturnqty = 0
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/getPurchaseReturn",
            type: "POST",
            data: {IdPurchase: ((type == 'imc') ? val.idPurchaseImc : val.idPurchaseLocal), IdPart: val.PartId, type: type},
            success: function(data) {
                var parsedData = JSON.parse(data);
                if (parsedData.length > 0) {
                    var item = '';
                    $.each(parsedData, function(i, data) {
                        item += "<h3>Purchase return of this has been added at  " + data.CreatedDate + " of Return Quantity=" + data.ReturnQuantity + "</h3>"

                        TotalReturnqty += parseInt(data.ReturnQuantity)

                    })
                    $("#sr_message").html(item)
                    limit = currentqty - TotalReturnqty;
                    $("#ReturnQuantity").attr('max', limit)
                    if (limit <= 0)
                    {
                        $("#sr_message").append('All item have been Returned!')
                        showPopup('salereturn');
                        $("#display_purchasereturn").hide()

                    }

                }
                else {
                    $("#sr_message").html('')
                    $("#ReturnQuantity").attr('max', currentqty)

                }
            }

        })

        if (type == 'imc') {
            $("#PurchaseId").val(val.idPurchaseImc)
        }
        else
        {
            $("#PurchaseId").val(val.idPurchaseLocal)

        }
        $("#RetunPartId").val(val.PartId)
//       $("#SalePrice").val(val.SalePrice - val.Discount)
        $("#partnumber").val(val.PartNumber)
        $("#partname").val(val.PartName)

        showPopup('purchasereturn');

    }

    function showPopup(div_id) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        });
    }
</script>