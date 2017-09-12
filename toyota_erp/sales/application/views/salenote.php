<?php
$data = unserialize($_COOKIE['logindata']);
if ($data['userid'] != "") {
    ?>
    <div id="wrapper">
        <div id="content">
            <?php
            include 'include/admin_leftmenu.php';
            ?>
            <div class="right-pnel">
                <!--<form name="myform" onsubmit="return validationform()" method="post"-->
                <form name="myform" method="post"
                      action="<?= base_url() ?>index.php/salenote/add" class="form validate-form animated fadeIn">
                          <?= $Response ?>

                    <fieldset>
                        <legend>Variant Details</legend>
                        <div class="feildwrap">
                            <legend>Search</legend>
                            <br>
                            <div>
                                <label>Chassis Number</label>
                                <input type="text" name="ChasisNumber" id="ChasisNumber" />
                            </div>
                            <div>
                                <label>Pbo Number</label>
                                <input type="text" name="PboNumber" />
                            </div>
                            <hr>
                            <br>
                            <div  style="display: none;">
                                <label>Dispatch ID</label>
                                <input type="text" name="dispatchId" id="Dispatch" readonly/>
                            </div>
                            <div>
                                <label>Model</label>
                                <input type="text" name="Model" id="Model" readonly/>
                            </div>
                            <div>
                                <label>Variant</label>
                                <input type="text" name="Variant" id="Variant" readonly/>
                            </div>
                            <div>
                                <label>Color</label>
                                <input type="text" name="Color" id="VariantColor" readonly/>
                            </div>
                            <div>
                                <label>Chassis Number</label>
                                <input type="text" name="ChasisNo" id="Chasis" readonly/>
                            </div>
                            <div>
                                <label>Engine Number</label>
                                <input type="text" name="EngineNo" id="Engine" readonly/>
                            </div>
                            <div>
                                <label>Price</label>
                                <input type="text" name="Price" id="Price" />
                            </div>
                            <div>
                                <label>Purchase Price</label>
                                <input type="text" name="purchasePrice" id="purchasePrice" />
                            </div>
                            <div>
                                <label>Selling Price</label>
                                <input type="text" name="SellingPrice" id="SellingPrice"/>
                            </div>
                            <div>
                                <label>Net Profit</label>
                                <input type="text" name="NetProfit" id="netprofit"/>
                            </div>
                            <div>
                                <label>Profit Percentage</label>
                                <input type="text" name="ProfitPercentage" id="ProfitPercentage"/>
                            </div>
                            <div>
                                <label>Percentage Amount</label>
                                <input type="text" name="Percentage" id="Percentage"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <!--<legend style=" background: none repeat scroll 0 0 #000; border: 1px solid #333333; border-radius: 6px; color: #FFFFFF; font-size: 18px; font-weight: normal; padding: 10px 20px; margin-left: 55px; margin-top: 10px; width: 147px; text-align: center; ">Sale Note</legend>-->
                        <legend >Sale Note</legend>
                        <div class="feildwrap">
                            <!--                            <div>
                                                            <label>Sale Note Number</label>
                                                            <input type="text" name="SaleNoteNumber" />
                                                        </div>-->
                            <div>
                                <label>Purchase From</label>
                                <input type="text" name="PurchaseFrom" />
                            </div>
                            <div>
                                <label>Sale To</label>
                                <input type="text" name="customer_name" id="customer_name" readonly="readonly"/>
                            </div>
                            <div style="display:none">
                                <label>Date</label>
                                <input type="Date" name="Date" />
                            </div>
                            <div>
                                <label>Sale Person</label>
                                <input type="text" name="saleperson" id="saleperson" />
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Customer Details</legend>
                        <div class="feildwrap">
                            <div style="margin-left: 196px;" id="cateCustomer">
                                <input type='radio' class='customer_ex' value='New_Customer' name='customer_ex'>New Customer
                                <input type='radio' class='customer_ex'  value='Existing_Customer' name='customer_ex'>Existing Customer
                            </div>
                            <br>
                            <div id="CustomerCombo" style="/*margin-left: 40px;*/">
                                <label>Existing Customer</label>
                                <select name="customer_id" id="cusId">
                                    <option>Select Customer</option>
                                </select>
                                <label>Search By CNIC</label>
                                <input type="text" name="cnic" id="cnic"/>
                            </div>
                            <br>
                            <div>
                                <label>Date</label>
                                <input type="text" name="date" class="date" value="<?= date('Y/m/d') ?>">
                            </div>
                            <div style="display: none;">
                                <label>Customer ID</label>
                                <input type="text" name="customer_id">
                            </div>
                            <div>
                                <label>Customer Name</label>
                                <input type="text" name="customer_name" id="customerName">
                            </div>
                            <div>
                                <label>Father/Husband Name</label>
                                <input type="text" name="f_name" id="fatherName">
                            </div>
                            <div>
                                <label>Date of Birth</label>
                                <input type="date" class="dob" name="dob" style="width:250px;">
                            </div>
                            <div>
                                <label>Company Name</label>
                                <input type="text" name="company_name">
                            </div>
                            <div>
                                <label>Designation</label>
                                <input type="text" name="designation">
                            </div>
                            <div>
                                <label>Address</label>
                                <textarea name="address"  placeholder="Address.."></textarea>
                            </div>
                            <div>
                                <label>Province</label>
                                <select name="province" id="province">
                                    <option>Select Province</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>
                            </div>
                            <div>
                                <label>City</label>
                                <select name="city" id="city">
                                    <option>Select City</option>
                                    <option value="Karachi">Karachi</option>
                                    <option value="Lahore">Lahore</option>
                                    <option value="Islamabad">Islamabad</option>
                                    <option value="Rawalpindi">Rawalpindi</option>
                                    <option value="Multan">Multan</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Quetta">Quetta</option>
                                    <option value="Peshawar">Peshawar</option>
                                </select>
                            </div>
                            <div id="Residential">
                                <label>Residential Tel#</label>
                                <input type="text" name="Residential_no" id="Residential_no">
                            </div>
                            <div id="Mobile">
                                <label>Mobile Tel#</label>
                                <input type="text" name="Mobile_no" id="Mobile_no">
                            </div>
                            <div>
                                <label>Email</label>
                                <input type="email" name="email">
                            </div>
                            <div>
                                <label>CNIC #</label>
                                <input type="text" name="CNIC_no">
                            </div>
                            <div>
                                <label>NTN #</label>
                                <input type="text" name="NTN_no" id="NTN_no">
                            </div>
                    </fieldset> 
                    <div class="btn-block-wrap">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="Save Sale Note" style="margin-left: 445px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("input[name=ChasisNumber]").keyup(function () {
            var ChasisNumber = $("input[name=ChasisNumber]").val();
            console.log(ChasisNumber);
            $.ajax({
                url: "<?= base_url() ?>index.php/salenote/getDispatch",
                type: "POST",
                data: {ChassisNo: ChasisNumber},
                success: function (data) {
                    console.log(data);
                    var a = JSON.parse(data);
                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            $.each(a, function (i, val) {
                                $("input[name=dispatchId]").val(val.idDispatch);
                                $("input[name=Model]").val(val.Model);
                                $("input[name=Variant]").val(val.Variants);
                                $("input[name=Color]").val(val.ColorName);
                                $("input[name=ChasisNo]").val(val.ChasisNo);
                                $("input[name=EngineNo]").val(val.EngineNo);
                                $("input[name=Price]").val(val.TotalPrice);
                            });
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("input[name=dispatchId]").val("");
                        $("input[name=Model]").val("");
                        $("input[name=Variant]").val("");
                        $("input[name=Color]").val("");
                        $("input[name=ChasisNo]").val("");
                        $("input[name=EngineNo]").val("");
                        $("input[name=Price]").val("");
                    }
                }
            });
        });

        $("input[name=PboNumber]").keyup(function () {
            var PboNumber = $("input[name=PboNumber]").val();
            console.log(PboNumber);
            $.ajax({
                url: "<?= base_url() ?>index.php/salenote/getDispatchByPbo",
                type: "POST",
                data: {PboNumber: PboNumber},
                success: function (data) {
                    console.log(data);
                    var a = JSON.parse(data);
                    console.log(a.length);
                    if (a.length > 0) {
                        try {


                            var cnictest = '';
                            $.each(a, function (i, val) {
                                cnictest = val.CustomerNIC;
                                $("input[name=dispatchId]").val(val.idDispatch);
                                $("input[name=Model]").val(val.Model);
                                $("input[name=Variant]").val(val.Variants);
                                $("input[name=Color]").val(val.ColorName);
                                $("input[name=ChasisNo]").val(val.ChasisNo);
                                $("input[name=EngineNo]").val(val.EngineNo);
                                $("input[name=Price]").val(val.Price);
                                $("#ChasisNumber").val(val.ChasisNo);
                                $("#saleperson").val(val.ActualSalePerson);
                                if (val.ActualSalePerson) {
                                    $("#customer_name").prop("readonly", true);
                                    $("#saleperson").prop("readonly", true);
                                }
                                $("#customer_name").val(val.CustomerName);
                            });
                            $("input[name=customer_ex][value='Existing_Customer']").trigger("click");
                            $("input[name=cnic]").val(cnictest);
                            $("input[name=cnic]").trigger("keyup");
                            $("#cateCustomer").hide();
                            $("#cusId").hide();
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("input[name=dispatchId]").val("");
                        $("input[name=Model]").val("");
                        $("input[name=Variant]").val("");
                        $("input[name=Color]").val("");
                        $("input[name=ChasisNo]").val("");
                        $("input[name=EngineNo]").val("");
                        $("input[name=Price]").val("");
                        $("#saleperson").val("");
                        $("#customer_name").val("");
                        $("#cateCustomer").show();
                        $("#cusId").show();
                        $("input[name=cnic]").val("");
                        $("input[name=cnic]").trigger("keyup");
                        $("#customer_name").prop("readonly", true);
                        $("#saleperson").prop("readonly", false);
                    }
                }
            });
        });

        $("input[name=cnic]").keyup(function () {
            var Cnic = $("input[name=cnic]").val();
            console.log(Cnic);
            $.ajax({
                url: "<?= base_url() ?>index.php/salenote/getCustomerByCnic",
                type: "POST",
                data: {Cnic: Cnic},
                success: function (data) {
                    console.log(data);
                    var a = JSON.parse(data);
                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            $.each(a, function (i, val) {
                                $("input[name=customer_id]").val(val.IdCustomer);
                                $("input[name=customer_name]").val(val.CustomerName);
                                $("input[name=f_name]").val(val.FatherName);
                                $("input[name=dob]").val(val.DateOfBirth);
                                $("input[name=company_name]").val(val.CompanyName);
                                $("input[name=designation]").val(val.Designation);
                                $("textarea[name=address]").val(val.AddressDetails);
                                $("select[name=province]").val(val.Province);
                                $("select[name=city]").val(val.City);
                                $("input[name=Residential_no]").val(val.Telephone);
                                $("input[name=Mobile_no]").val(val.Cellphone);
                                $("input[name=email]").val(val.Email);
                                $("input[name=CNIC_no]").val(val.Cnic);
                                $("input[name=NTN_no]").val(val.Ntn);
                            });
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("input[name=customer_name]").val("");
                        $("input[name=f_name]").val("");
                        $("input[name=dob]").val("");
                        $("input[name=company_name]").val("");
                        $("input[name=designation]").val("");
                        $("input[name=address]").val("");
                        $("input[name=province]").val("");
                        $("input[name=city]").val("");
                        $("input[name=Residential_no]").val("");
                        $("input[name=Mobile_no]").val("");
                        $("input[name=email]").val("");
                        $("input[name=CNIC_no]").val("");
                        $("input[name=NTN_no]").val("");
                    }
                }
            });
        });

        $(".VariantList").change(function () {
            var variant = $(".VariantList").val();

            console.log(variant);
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getColor",
                type: "POST",
                data: {variantId: variant},
                success: function (data) {
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a.length > 0) {
                        try {
                            var items = "<option>Select Color</option>";
                            $.each(a, function (i, val) {
                                items += "<option value='" + val.ColorId + "'>" + val.ColorName + "</option>";
                            });
                            $('#ColorList1').html(items);
                            $('#ColorList2').html(items);
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
                        var items = "<option>Select Color</option>";
                        $('#ColorList1').html(items);
                        $('#ColorList2').html(items);
                    }
                }
            });
        });

    //        $(".customer_ex").click(function () {
    //          
    //            customersss();
    //        });


        $(".customer_ex").change(function () {

            var Customer = $('input[name=customer_ex]:checked').val();
            console.log(Customer);
            if (Customer == "Existing_Customer") {
                $('#CustomerCombo').show();
                $.ajax({
                    url: "<?= base_url() ?>index.php/salenote/getCustomers",
                    type: "POST",
                    success: function (data) {
                        var a = JSON.parse(data);
                        console.log(a);
                        if (a.length > 0) {
                            try {
                                var items = "<option>Select Customer</option>";
                                $.each(a, function (i, val) {
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
            } else {
                $('#CustomerCombo').hide();
            }
    //      
        });

        $("#cusId").change(function () {
            var Customer = $('#cusId').val();

            console.log(Customer);
            $.ajax({
                url: "<?= base_url() ?>index.php/salenote/getCustomerDetails",
                type: "POST",
                data: {idCustomer: Customer},
                success: function (data) {
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a.length > 0) {
                        try {
    //                        var items = ;
                            $.each(a, function (i, val) {
    //                            items += "<option value='" + val.IdCustomer + "'>" + val.CustomerName + "</option>";
                                $("input[name=customer_id]").val(val.IdCustomer);
                                $('#customerName').val(val.CustomerName);
                                $('input[name=f_name]').val(val.FatherName);
                                $('input[name=dob]').val(val.DateOfBirth);
                                $('input[name=company_name]').val(val.CompanyName);
                                $('input[name=designation]').val(val.Designation);
                                $('textarea[name=address]').val(val.AddressDetails);
                                $('select#province').val(val.Province);
                                $('select#city').val(val.City);
                                $('input[name=Residential_no]').val(val.Telephone);
                                $('input[name=Mobile_no]').val(val.Cellphone);
                                $('input[name=Office_no]').val(val.OfficeNumber);
                                $('input[name=email]').val(val.Email);
                                $('input[name=CNIC_no]').val(val.Cnic);
                                $('input[name=NTN_no]').val(val.Ntn);
                                $('input[name=customer_name]').val(val.CustomerName);
                            });
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
                        $('input[name=customer_name]').val("");
                        console.log("empty");
                    }
                }
            });
        });

        $(".ModelList").change(function () {
            var model = $(".ModelList").val();

            console.log(model);
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getVariants",
                type: "POST",
                data: {ModelId: model},
                success: function (data) {
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a.length > 0) {
                        try {
                            var items = "<option>Select Variant</option>";
                            $.each(a, function (i, val) {
                                items += "<option value='" + val.IdVariants + "'>" + val.Variants + "</option>";
                            });
                            $('#VariantList').html(items);
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
                        var items = "<option>Select Variant</option>";
                        var itemsColor = "<option>Select Color</option>";
                        $('#ColorList1').html(itemsColor);
                        $('#ColorList2').html(itemsColor);
                        $('#VariantList').html(items);
                    }
                }
            });
        });

        function validationform() {
            var cusType = $('#cusType').val();
            var conType = $('#conType').val();
            if (cusType === "Select Customer Type") {
                $(".error-customer").show();
                return false;
            } else {
                $(".error-customer").hide();
            }

            if (conType === "Select Contact Type") {
                $(".error-contact").show();
                return false;
            } else {
                $(".error-contact").hide();
            }

            if (!$('.customer_status:checked').val()) {
                $('.check').show();
                return false;
            } else {
                $('.check').hide();
            }
    //        chosen = "";
    //        len = document.myform.follow_up.length;
    //        for (i = 0; i < len; i++) {
    //            if (document.myform.follow_up[i].checked) {
    //                chosen = document.myform.follow_up[i].value;
    //            }
    //        }
    //        if (chosen === "") {
    //            $(".check").show();
    //        }
    //        else {
    //            $(".check").hide();
    //        }
        }

        $("#SellingPrice").keyup(function () {
            var purchaseprice = parseInt($("#purchasePrice").val());
            var sellingprice = parseInt($("#SellingPrice").val());
            var Profit = sellingprice - purchaseprice;
            $("#netprofit").val(Profit);
        });
        
        $("#ProfitPercentage").keyup(function () {

            var profitpercentage = parseInt($("#ProfitPercentage").val());
            profitpercentage = (profitpercentage / 100);
            var netprofit = parseInt($("#purchasePrice").val()) - parseInt($("#Price").val());
            netprofit = netprofit * profitpercentage;
            $("#Percentage").val(netprofit);


        });
        
        $("#customerName").keyup(function () {
            var customerName = ($("#customerName").val());            
            $("#customer_name").val(customerName);
        });

    </script>    
    <?php
}
?>