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
            <form name="myform" action="<?= base_url() ?>/index.php/chemicalorder/saveChemicalOrder" onSubmit="return validationform()" method="post"
                  action="" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Chemical Order</legend>
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
                                        <th width="10%">PartName</th>
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                php
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
                        <input type="submit" class="btn" style="float: right;" value="Add Chemical Order">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    $("#newRowLocal").click(function (e) {
	var length = $(".tblPurchaseLocal").length+1;
        var items = "";
        items += "<tr class='tblPurchaseLocal'><td class='tbl-count'>"+length+"</td><td class='tbl-part'><select onchange=getPart(this) class='chosen-select' name='idPart[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'><option>Select Part Number</option><?php
                                    foreach ($Part as $AllPart) {
                                        ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartNumber'] ?> </option><?php } ?></select></td><td class='tbl-description'><input type='text' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description' readonly></td>" +
                "<td class='tbl-quantity'><input type='text' name='Quantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Qty'></td>" +
//                "<td class='tbl-price'><input type='text' name='Localprice[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Price' placeholder='Price'></td>" +
                "<td class='tbl-dealer'><input type='text' name='DealerRemarks[]' style='width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='DealerRemarks' placeholder='Dealer Remarks' ></td>" +
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