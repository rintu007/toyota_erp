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
                    <legend>Add Purchase Item</legend>
                    <div class="feildwrap" id="Local">
                        <!--                        <div style=" margin-left: 196px; ">
                                                    <label></label>
                                                    <select style="margin-left: 200px;" name="type" id="selectType">
                                                        <option>Select</option>
                                                        <option value="Local">Local</option>
                                                        <option value="IMC">IMC</option>
                                                    </select>
                                                    <input type="radio" name="type" class="type" value="Order" /> Order
                                                    <input type="radio" name="type" class="type" value="Local" /> Local
                                                    <input type="radio" name="type" class="type" value="Force" /> Force
                                                </div>
                                                <br>
                                                <div>
                                                    <label>Part Name</label>
                                                    <select name="idPart">
                                                        <option>Select Part</option>
                        <?php
//                        foreach ($Part as $InventoryPart) {
//                            $idPart = $InventoryPart['idPart'];
                        ?>
                                                                    <option value="<?= $InventoryPart['idPart'] ?>" ><?= $InventoryPart['PartName'] ?></option>
                        <?php
//                        }
                        ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label>Purchase Type</label>
                                                    <select name="idPurchaseType">
                                                        <option>Select Purchase Type</option>
                        <?php
//                        foreach ($PurchaseType as $InventoryPurchaseType) {
//                        $idPurchaseType = $InventoryPurchaseType['idPurchaseType'];
                        ?>
                                                                <option value="<?= $InventoryPurchaseType['idPurchaseType'] ?>" ><?= $InventoryPurchaseType['PurchaseType'] ?></option>
                        <?php
//                        }
                        ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label>Party Name</label>
                                                    <select name="idParty">
                                                        <option>Select Party</option>
                        <?php
//                        foreach ($Party as $InventoryParty) {
//                            $idParty = $InventoryParty['idParty'];
                        ?>
                                                                <option value="<?= $InventoryParty['idParty'] ?>" ><?= $InventoryParty['Name'] ?></option>
                        <?php
//                        }
                        ?>
                                                    </select>
                                                </div>
                                                <div id="OrderId">
                                                    <label>Order Number</label>
                                                    <input type="text" name="OrderId" data-validation="required">
                                                </div>
                                                <div>
                                                    <label>Quantity</label>
                                                    <input type="text" name="Quantity" data-validation="required">
                                                </div>
                                                <div>
                                                    <label>Cost Price</label>
                                                    <input type="text" name="CostPrice" data-validation="required">
                                                </div>
                                                <div>
                                                    <label>Purchase Date</label>
                                                    <input type="text" name="PurchaseDate" class="date" data-validation="required">
                                                </div>
                                                <div id="InvoiceNumber">
                                                    <label>Invoice Number</label>
                                                    <input type="text" name="InvoiceNumber" data-validation="required">
                                                </div>
                                                <div id="InvoiceDate">
                                                    <label>Invoice Date</label>
                                                    <input type="text" name="InvoiceDate" class="date" data-validation="required">
                                                </div>-->

                    </div>
                    <div class="btn-block-wrap">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="Add Purchase Item" style="margin-left: 193px;width: 270px;">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
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

    $("#selectType").change(function() {
        if ($("#selectType").val() == "IMC") {
            $("#OrderId").show();
            $("#InvoiceNumber").show();
            $("#InvoiceDate").show();
        } else {
            $("#OrderId").hide();
            $("#InvoiceNumber").hide();
            $("#InvoiceDate").hide();
        }
    });

    $("input[name=PboSerial]").keyup(function() {
        var SerialNumber = $("input[name=PboSerial]").val();
        console.log(SerialNumber);
        $.ajax({
            url: "<?= base_url() ?>index.php/generatepbo/CheckPboSerial",
            type: "POST",
            data: {PboSerial: SerialNumber},
            success: function(data) {
                console.log(data);
                if ($("input[name=PboSerial]").val() != "") {
                    $("#SerialAvailability").show();
                    if (data == 'Available') {
                        $('#SerialAvailability').html("<h4 style='background-color: green;color: white;'>Available!</h4>");
                    } else {
                        $('#SerialAvailability').html("<h4 style='background-color: maroon;color: white;'>Already Exists in Database!</h4>");
                    }
                } else {
                    $("#SerialAvailability").hide();
                }
            }
        });
    });

    $(".type").click(function() {
        var Type = $('input[name=type]:checked').val();
        console.log(Type);
        if (Type == "Order") {
            $('#tblOrder').show();
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getCustomers",
                type: "POST",
                success: function(data) {
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a.length > 0) {
                        try {
                            var items = "<option>Select Customer</option>";
                            $.each(a, function(i, val) {
                                items += "<option value='" + val.IdCustomer + "'>" + val.CustomerName + "</option>";
                            });
                            $('#cusId').html(items);
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
                        var items = "<option>Select Customer</option>";
                        $('#cusId').html(items);
                    }
                }
            });
        } else if (Type == "Local") {
            $('#tblLocal').show();
        } else {

        }
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