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
            <form name="myform" action="<?= base_url() ?>index.php/monthlyordercycle/saveMonthlyOrder" onSubmit="return validationform()" method="post"
                  action="" class="form validate-form animated fadeIn">
                <input type="hidden" id="BrandCode" name="BrandCode" value="<?= $BrandCode ?>" />
                <fieldset>
                    <legend>Create Monthly Order</legend>
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
                        <br>
                        <span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRowLocal">+</span>
                        <div class="btn-block-wrap dg" id="tbl-Local">

                            <table id='LocalTable' name='LocalTable' width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="">Order Reason</th>
                                          <th width="">Part Number</th>
                                        <th width="">Description</th>
                                        <th width="">Qty In Stock</th>
                                        <th width="">Unit Price</th>
                                         <th width="">MAD</th>
                                        <th width="">
                                            <select  class="chosen-select" name="month1" required="">
                                                 <option value="1">Select Month</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                            </select>
                                          </th>
                                         <!--<th width="">
                                            <select  class="chosen-select" name="month2" required="">
                                               <option value="2">Select Month</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                            </select>
                                          </th>-->
                                          <!--<th width="">
                                            <select  class="chosen-select" name="month3" required="">
                                                <option value="3">Select Month</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                            </select>
                                          </th>-->
                                            <th id="first">Month1 Total</th>
										  <!--<th id="second">Month2 Total</th>-->
										  <!--<th id="third">Month3 Total</th>-->
                                        
                                        
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
                        <input type="submit" class="btn" style="float: right;" value="Submit">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
var count = 0;

  $(".chosen-select").chosen()
  
    $("#newRowLocal").click(function (e) {
        
	count++;
        var items = "";
        items += "<tr class='tblPurchaseLocal'>"+
                "<td class='tbl-count'>"+count+"</td>"+
                "<td><input type='text' name='OrderReason[]' required id='OrderReason' placeholder='Order Reason' style='width: 100px;'></td>"+
                "<td class='tbl-part'><select style='width: 100px;' onchange=getPart(this) class='chosen-select' required name='IdPart[]'  id='PartNumber'><option>Select Part Number</option>"+
                <?php
                 foreach ($Part as $AllPart) {?>
                 "<option style='color:white;' value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartNumber'] ?> </option>"+ <?php } ?>"</select>"+
                         
                "</td><td class='tbl-description'><input style='width: 100px;' type='text' required id='Description' placeholder='Description' readonly></td>" +
                
                "<td class='tbl-dealer'><input type='text' readonly name='QuantityInStock[]' value=0  id='QuantityInStock' placeholder='Unit Price' style='width:75px;'></td>" +
                "<td class='tbl-dealer'><input type='text' readonly name='unitprice[]' value=0  id='unitprice' placeholder='Unit Price' style='width:65px;'></td>" +
                "<td class='tbl-dealer'><input type='text' name='MAD'  id='MAD' placeholder='MAD' style='width:65px;'></td>" +

                 "<td class=''><input type='number' name='Quantity1[]' required id='Quantity1' placeholder='Enter Quantity' style='width: 100px;'></td>" +
                 /*"<td class=''><input type='number' name='Quantity2[]' required id='Quantity2' placeholder='Enter Quantity' style='width: 100px;'></td>" +
                 "<td class=''><input type='number' name='Quantity3[]' required id='Quantity3' placeholder='Enter Quantity' style='width: 100px;'></td>" +*/
				"<td class=''><input type='number' name='total1[]' required readonly id='total1' placeholder='Enter Quantity' style='width: 100px;'></td>" +
                 /*"<td class=''><input type='number' name='total2[]' required  readonly id='total2' placeholder='Enter Quantity' style='width: 100px;'></td>" +
                 "<td class=''><input type='number' name='total3[]' required readonly id='total3' placeholder='Enter Quantity' style='width: 100px;'></td>" +*/
//                "<td class='tbl-price'><input type='text' name='Localprice[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Price' placeholder='Price'></td>" +
                
                "</tr>";
        $('#localPurchase').append(items);
        $("select[name='IdPart[]']").chosen({no_results_text: "Oops, nothing found!"});
    });
$("#newRowLocal").click()
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
                            $(Source).closest('td').next('td').next('td').find('input').val(val.QtyInStock);
                            $(Source).closest('td').next('td').next('td').next('td').find('input').val(val.CostPrice);
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
	
	$(document).on('change',"input[name='Quantity1[]']",function(){
	var unitprice =	$(this).parent().parent().find("input[name='unitprice[]']").val();
	var qty = $(this).val();
	var total = parseInt(unitprice) * parseInt(qty);
	$(this).parent().parent().find("input[name='total1[]']").val(total);
	//alert(total);
	});
	$(document).on('change',"input[name='Quantity2[]']",function(){
	var unitprice =	$(this).parent().parent().find("input[name='unitprice[]']").val();
	var qty = $(this).val();
	var total = parseInt(unitprice) * parseInt(qty);
	$(this).parent().parent().find("input[name='total2[]']").val(total);
	//alert(total);
	});
	$(document).on('change',"input[name='Quantity3[]']",function(){
	var unitprice =	$(this).parent().parent().find("input[name='unitprice[]']").val();
	var qty = $(this).val();
	var total = parseInt(unitprice) * parseInt(qty);
	$(this).parent().parent().find("input[name='total3[]']").val(total);
	//alert(total);
	});
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
   
</script>