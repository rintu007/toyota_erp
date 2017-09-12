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
            <form name="myform" action="<?= base_url() ?>/index.php/dailyorder/saveDailyOrder" onSubmit="return validationform()" method="post"
                  action="" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Daily Order</legend>
                    <div class="feildwrap">
                        <div class="btn-block-wrap">
                            <div>
                                <?php
//                                echo $this->session->userdata('BrandCode');
                                if (isset($OrderNo['Number'])) {
                                    $orderNumber = $OrderNo['Number'];
                                } else {
                                    $orderNumber = 1;
                                }
                                $date = date('Y/m/d');
                                $time = strtotime($date);
                                $month_only = date('m', $time);
                                $year_only = date('y', $time);
                                $OrderNum = $cookieData['Code'] . "-" . $OrderType['Code'] . $this->session->userdata("BrandCode") . "-" . $year_only."-". $month_only."-".$orderNumber;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="feildwrap">
                    </div>
                    <div>
                        <div style=" margin-left: 35px; ">
                            <label>Order No.</label>
                            <br>
                            <input type="text" name="OrderNo" value="<?= $OrderNum ?>" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                        </div>
                        <br>
                        <div style=" margin-left: 35px; ">
                            <label>Date</label>
                            <br>
                            <input type="text" name="Date" class="date" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                        </div>
                        <br>
                        <span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRowLocal">+</span>
                        <div class="btn-block-wrap dg" id="tbl-Local">

                            <table id='LocalTable' name='LocalTable' width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="7%">No.</th>
                                        <th width="17%">Part Number</th>
                                        <th width="10%">Part Name</th>
                                        <th width="8%">Qty</th>
                                        <!--<th width="12%">Price</th>-->
                                        <th width="10%">Dealer Remarks</th>
                                        <th width="10%">IMC Remarks</th>
                                    </tr>
                                </thead>                      
                                <tbody id="localPurchase">
<!--                                    <tr class="tblPurchase">
                                        <td class="tbl-count">1</td>
                                        <td class="tbl-part">
                                            <select class="chosen-select" name="parts[]" id="PartNumber" style="background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                                                <option>Select Part Number</option>
                                    <?php
//                                    foreach ($Part as $PartNumber) {
                                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <option value="<?= $PartNumber['idPart'] ?>"><?= $PartNumber['PartNumber'] ?></option>
                                    <?php
//                                    }
                                    ?>
                                            </select>
                                        </td>
                                        <td class="tbl-description"><input type="text" name="description[]" style="background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Description" placeholder="Description"></td>
                                        <td class="tbl-quantity"><input type="text" name="quantity[]" style="width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Quantity" placeholder="Quantity"></td>
                                        <td class="tbl-price"><input type="text" name="price[]" style="width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Price" placeholder="Price"></td>
                                        <td class="tbl-discount"><input type="text" name="discount[]" style="width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="Discount" placeholder="Discount"></td>
                                        <td class="tbl-actualcost"><input type="text" name="actualcost[]" style="width: 93px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="ActualCost" placeholder="ActualCost"></td>
                                        <td class="tbl-landvalue"><input type="text" name="landvalue[]" style="width: 100px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="LandValue" placeholder="Land Value"></td>
                                    </tr>-->
                                </tbody><br><br>
                                <tfoot>
                                    <tr>                                       
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!--<td></td>--> 
                                        <!--<td><button id="OKButton" type="button" class="btn btn-block-wrap" style="width: 100px;margin-left:0px;" onclick="okButton('#LocalTable')">OK</button></td>-->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div>
                        <br>
                        <input type="submit" class="btn" style="float: right;" value="Add Daily Order">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
var count = 0;
    $("#newRowLocal").click(function (e) {
	count++;
        var items = "";
        items += "<tr class='tblPurchaseLocal'><td class='tbl-count'>"+count+"</td><td class='tbl-part'><select onchange=getPart(this) class='chosen-select' name='idPart[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'><option>Select Part Number</option><?php
                                    foreach ($Part as $AllPart) {
                                        ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartNumber'] ?> </option><?php } ?></select></td><td class='tbl-description'><input type='text' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description' readonly></td>" +
                "<td class='tbl-quantity'><input type='text' name='Quantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Qty'></td>" +
//                "<td class='tbl-price'><input type='text' name='Localprice[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Price' placeholder='Price'></td>" +
                "<td class='tbl-dealer'><input type='text' name='DealerRemarks[]' value=0 style='width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='DealerRemarks' placeholder='Dealer Remarks' ></td>" +
                "<td class='tbl-imc'><input type='text' name='IMCRemarks[]' style='width: 98px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='IMCRemarks' placeholder='IMC Remarks'></td>" +
                "</tr>";
        $('#localPurchase').append(items);
        $("select[name='idPart[]']").chosen({no_results_text: "Oops, nothing found!"});
    });

    function getPart(Source) {
        console.log($(Source).val());
        idPart = $(Source).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/getpartdetails",
            type: "POST",
            data: {idPart: idPart},
            success: function (data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function (i, val) {
                            $(Source).closest('td').next('td').find('input').val(val.PartName);
                            $(Source).closest('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val();
                        });
                    }
                }
                else {
                }
            }
        });
    }

    function discount(Source) {
        Discount = $(Source).val();
        if (Discount !== 0) {
            Price = $(Source).closest('td').prev('td').find('input').val();
            DiscountedPrice = (Price * Discount) / 100;
//            console.log(DiscountedPrice);
            ActualPrice = (Price - DiscountedPrice);
//            console.log(ActualPrice);
            SalesTax = $('input[name=SalesTax]').val();
            LandValue = ActualPrice + ((ActualPrice * SalesTax) / 100);
//            console.log(LandValue);
            $(Source).closest('td').next('td').find('input').val(ActualPrice);
//            console.log("AP", $(Source).closest('td').next('td').find('input'));
            Qty = $(Source).closest('td').prev('td').prev('td').find('input').val();
            TotalCost = (Qty * LandValue);
            console.log("QTY", Qty);
            console.log("LV", LandValue);
            console.log("TC", TotalCost);
            $(Source).closest('td').next('td').next('td').find('input').val(LandValue);
//            console.log("LV", $(Source).closest('td').next('td').next('td').find('input'));
            $(Source).closest('td').next('td').next('td').next('td').find('input').val(TotalCost);
//            console.log("TP ", $(Source).closest('td').next('td').next('td').next('td').find('input'));
        } else {
        }
    }

    function discountLocal(Source) {
        Discount = $(Source).val();
        if (Discount !== 0) {
            Price = $(Source).closest('td').prev('td').find('input').val();
            DiscountedPrice = (Price * Discount) / 100;
            console.log(DiscountedPrice);
            ActualPrice = (Price - DiscountedPrice);
            SalesTax = $('#SalesTaxLocal').val();
            LandValue = ActualPrice + ((ActualPrice * SalesTax) / 100);
            $(Source).closest('td').next('td').find('input').val(ActualPrice);
            $(Source).closest('td').next('td').next('td').find('input').val(LandValue);
        } else {

        }
    }

    $('#do').edatagrid({
        url: '<?= base_url() ?>/index.php/dailyorder/allDailyOrders',
        saveUrl: '<?= base_url() ?>/index.php/dailyorder/saveDailyOrder',
        updateUrl: '<?= base_url() ?>/index.php/parts/edit',
        destroyUrl: '<?= base_url() ?>/index.php/dailyorder/delete',
        onBeforeEdit: function (rowIndex) {
            setTimeout(function () {
                $(".datagrid-editable-input").keydown(function (e) {<?php
                                    if (isset($OrderNo['Number'])) {
                                        $orderNumber = $OrderNo['Number'];
                                    } else {
                                        $orderNumber = 1;
                                    }
                                    ?>

                    if (e.keyCode === 13) {
                        $('#do').edatagrid("endEdit", rowIndex);
                        $('#do').edatagrid('addRow');
                        $('div.datagrid-cell-c1-OrderNumber').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= $OrderNum . '-' . $orderNumber ?>');
                        $('div.datagrid-cell-c1-Date').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= date('Y/m/d') ?>');
                        $('div.datagrid-cell-c1-Dispatch-Mode').children('table').children('tbody').children('tr').children('td').children('span').children('.combo-text').val("By Road");
                    }
                });
            }, 500);
        }
    });

    function destroyUser() {
        var row = $('#do').edatagrid('getSelections');
        $.each(row, function (index, value) {
            if (value) {
                $.messager.confirm('Confirm', 'Are you sure you want to delete this order?', function (r) {
                    if (r) {
                        $.post('<?= base_url() ?>/index.php/dailyorder/delete', {id: value.OrderNumber}, function (result) {
                            window.res = result;
                            if (result.success) {
                                $('#do').edatagrid('reload');    // reload the user data
                                $.messager.show({// show success message
                                    title: 'Success',
                                    msg: "Order Number [ " + value.OrderNumber + " ] / [ " + value.PartNumber + " ] has been deleted"
                                });
                            } else {
                                $.messager.show({// show error message
                                    title: 'Error',
                                    msg: "unable to send request to the server"
                                });
                            }
                        }, 'json');
                    }
                });
            }
        });
    }

    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/parts/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
//                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var items = "";
                            $.each(a, function (i, val) {
                                items += "<tr><td class='resId' name='resId'>" + val.Id + "</td>\n\
    <td class='tbl - name'>" + val.FullName + "</td><td>" + val.Username + "</td>\n\
    <td>" + val.Department + "</td><td>" + val.RoleName + "</td><td>" + val.Name + "</td>\n\
    <td><a style='cursor: pointer;' onClick=userPopup('detail', '" + val.Id + "','" + val.FullName + "','" + val.Username + "','" + val.Password + "','" + val.Email + "','" + val.ContactNumber + "','" + val.IdDepartment + "','" + val.RoleId + "','" + val.DateOfBirth + "','" + val.DealerShip + "')> Edit </a> / <a> Delete </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                } else {
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
    function partPopup(div_id, id, name, variant, quantity) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#PartId").val(id);
            $(this).find("#PartName").val(name);
            $(this).find("select#VariantId").val(variant);
            $(this).find("#Quantity").val(quantity);
        });
    }
</script>