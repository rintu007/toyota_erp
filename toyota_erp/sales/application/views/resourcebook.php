<?php
$data = unserialize($_COOKIE['logindata']);
if ($data['userid'] != "") {
    ?>
    <div id = "wrapper">
        <div id = "content">
            <?php
            include 'include/admin_leftmenu.php';
//            print_r($this->session->all_userdata());
//            $cookieData = unserialize($_COOKIE['logindata']);
//        $UserId = $cookieData['userid'];
//        print_r($cookieData);
            ?>
            <div class="right-pnel">
                <form name="myform" onsubmit="return validationform()" method="post"
                      action="<?= base_url() ?>index.php/resourcebook/index" class="form validate-form animated fadeIn">
                          <?= $message ?>
                    <fieldset>
                        <legend>Customer Details</legend>
                        <div class="feildwrap">
                            <div style="margin-left: 196px;">
                                <input type='radio' class='customer_ex' data-validation='required' value='New_Customer' name='customer_ex'>New Customer
                                <input type='radio' class='customer_ex' id="customer_ex_check" data-validation='required' value='Existing_Customer' name='customer_ex'>Existing Customer
                            </div>
                            <br>
                            <div id="CustomerCombo" style="/*margin-left: 40px;*/">
                                <label>Existing Customer</label>
                                <select name="customer_id" id="cusId">
                                    <option value="Select Customer">Select Customer</option>

                                </select>
                            </div>
                            <br>

                            <div>
                                <label>Date</label>
                                <input type="text" name="date" class="date" value="<?= date('Y/m/d') ?>">
                            </div>
                            <div id="Mobile">
                                <label>Mobile Tel#</label>
                                <input type="text" name="Mobile_no" data-validation='required' id="Mobile_no">
                            </div>
                            <div>
                                <label>Contact Type</label>
                                <select name="contact_type" class="conType" data-validation='required' id="conType">
                                    <option>Select Contact Type</option>
                                    <?php
                                    foreach ($contact_type as $ContactType) {
                                        $ContactTypeId = $ContactType['Id'];
                                        ?>
                                        <option value="<?= $ContactType['Id'] ?>" ><?= $ContactType['ContactType'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="error-contact cb-error help-block">Option must be selected!</span>
                            </div>

                            <div>
                                <label>Customer Type</label>
                                <select name="customertype" class="cusType" id="cusType">
                                    <option>Select Customer Type</option>
                                    <?php
                                    foreach ($customertype as $CustomerType) {
                                        $CustomerTypeId = $CustomerType['Id'];
                                        ?>
                                        <option value="<?= $CustomerType['Id'] ?>" ><?= $CustomerType['CustomerType'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="error-customer cb-error help-block">Option must be selected!</span>
                            </div>
                            <div>
                                <label>Customer Name</label>
                                <select name="Gender" class="cusType" id="cusType" style="width: 68px">
                                    <option>Mr.</option>
                                    <option>Mrs.</option>
                                    <option>Miss.</option>
                                </select>
                                <input type="text" name="customer_name" id="customerName" style="width: 180px">
                            </div>                            
                            <div id="fatherName">
                                <label>Father/Husband Name</label>
                                <select name="genderType"  style="width: 68px">
                                    <option>S/O</option>
                                    <option>D/O</option>
                                    <option>W/O</option>
                                </select>
                                <input type="text" name="f_name" id="fatherName" style="width: 180px">
                            </div>
                            <div id="dob">
                                <label>Date of Birth</label>
                                <!--<input type="date" class="dob" name="dob" style="width:250px;">-->
                                <input type="text" name="dob" data-validation='required' class="date dob"/>
                            </div>

                            <div>
                                <label>Address</label>
                                <textarea name="address"  placeholder="Address.."></textarea>
                            </div>
                            <div>
                                <label>Address 2</label>
                                <textarea name="address2"  placeholder="Address.."></textarea>
                            </div>
                            <div id="companyName">
                                <label>Company Name</label>
                                <input type="text" name="company_name">
                            </div>
                            <div id="designation">
                                <label>Designation</label>
                                <input type="text" name="designation">
                            </div>
                            <div id="lesse">
                                <label>A/c / Lesse</label>
                                <input type="text" name="lesse">
                            </div>
                            <div id="financer">
                                <label>Financer</label>
                                <select name="financer" data-validation="required">
                                    <option>Select Bank</option>
                                    <?php
                                    foreach ($Bank as $BankName) {
                                        $idBank = $BankName['Id'];
                                        ?>
                                        <option value="<?= $BankName['idFinance'] ?>" ><?= $BankName['FinancerName'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
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
                                    <option value="Faislabad">Faislabad</option>
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
                            <div>
                                <label>Postal Code #</label>
                                <input class="hash2" type="text" name="postal_no" >
                            </div>
                            <div id="Residential">
                                <label>Residential Tel#</label>
                                <input type="text" name="Residential_no" id="Residential_no">
                            </div>

                            <div id="officeNumber">
                                <label>Office Tel#</label>
                                <input type="text" name="Office_no" id="Office_no">
                            </div>
                            <div id="officeNumber">
                                <label>Fax #</label>
                                <input class="hash3" type="text" name="fax_no">
                            </div>
                            <div>
                                <label>Email</label>
                                <input type="email" name="email">
                            </div>
                            <div>
                                <label>CNIC #</label>
                                <input class="hash" type="text" name="CNIC_no">
                            </div>
                            <div>
                                <label>NTN #</label>
                                <input type="text" name="NTN_no" id="NTN_no">
                            </div>

                            <div>
                                <label>Preffered way to Contact</label>
                                <input type="text" name="preferedcontactway" placeholder="SMS,EMAIL,FAX" id="NTN_no">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Vehicle Details</legend>
                        <div class="feildwrap">
                            <div style="display:none;">
                                <label>Existing Vehicle</label>
                                <input type="text" name="existing_vehicle">
                            </div>
                            <div>
                                <label>Select Model</label>
                                <select name="model" class="ModelList" data-validation="required">
                                    <option>Select Model</option>
                                    <?php
                                    foreach ($Model as $CarModel) {
                                        $ModelId = $CarModel['Id'];
                                        ?>
                                        <option value="<?= $CarModel['Id'] ?>" ><?= $CarModel['Model'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Vehicle Interested</label>
                                <select name="vehicle_interst" class="VariantList" id="VariantList" data-validation="required">
                                    <option>Select Variant</option>
                                    <?php
//                                foreach ($vehicle_interst as $Variants) {
//                                    $VariantsId = $Variants['Id'];
                                    ?>
                                        <!--<option value="<?= $Variants['Id'] ?>" ><?= $Variants['Variants'] ?></option>-->
                                    <?php
//                                }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Color Choice</label>
                                <select name="color_choice_one" class="color1" id="ColorList1" data-validation='required'>
                                    <option>Select Color</option>
                                </select>
                            </div>
                            <div>
                                <label>Mode Of Payment</label>
                                <select name="payment_mode" class="payMode" data-validation="required">
                                    <option>Select PaymentMode</option>
                                    <?php
                                    foreach ($payment_mode as $payment) {
                                        $PaymentId = $payment['Id'];
                                        ?>
                                        <option value="<?= $payment['Id'] ?>" ><?= $payment['PaymentType'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Customer Status</label>
                                <?php
                                foreach ($customer_status as $CustomerStatus) {
                                    echo "<input type='radio' class='customer_status' data-validation='required' value='" . $CustomerStatus['Id'] . "' name='customer_status'>" . $CustomerStatus['StatusType'];
                                }
                                ?>
                                <span class="check">Please Select Customer Status Type</span>
                            </div>
                            <div>
                                <label>Follow Up</label>
                                <span style="width:272px; float:right;">
                                    <select name="follow_up" data-validation="required" id="FollowUp">
                                        <option>Select Followup Status</option>
                                        <?php
                                        foreach ($followup as $followupStatus) {
                                            $followupStatusId = $followupStatus['Id'];
                                            ?>
                                            <option value="<?= $followupStatus['Id'] ?>" ><?= $followupStatus['Followup'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="error-followup cb-error help-block">Must Select Followup or Select <b>No</b>!</span>
                                </span>
                            </div>
                            <div>
                                <label>Remarks</label>
                                <textarea name="remarks" placeholder="Remarks.."></textarea>
                            </div>
                            <div>
                                <label>Delivery Month</label>
                                <select name="delivery_month" class="deliveryMonth">
                                    <option>Select Delivery Month</option>
                                    <?php
                                    foreach ($deliverymonth as $dMonth) {
                                        ?>
                                        <option value="<?= $dMonth ?>" ><?= $dMonth ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Lead By</label>
                                <select name="lead">
                                    <option value="Select Lead">Select Lead</option>
                                    <?php
                                    foreach ($LeadBy as $Lead) {
                                        ?>
                                        <option value="<?= $Lead['Id'] ?>" ><?= $Lead['FullName'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Time Consumed</label>
                                <input type="text" id="TimeConsumed" name="time_consumed" data-validation="numeric"> Mins
                            </div>
                            <?php
                            if ($data['Role'] == 'Admin' || $data['Role'] == 'Sales Admin') {
                                ?>
                                <div>
                                    <label>Alloted Salesman</label>
                                    <select name="alloted_salesman">
                                        <option>Select Sales Man</option>
                                        <?php
                                        foreach ($AllotedSalesMan as $Alloted) {
                                            ?>
                                            <option value="<?= $Alloted['Id'] ?>" ><?= $Alloted['FullName'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <label>Actual Salesman</label>
                                    <select name="actual_salesman" id="actual_salesman">
                                        <option>Select Sales Man</option>
                                        <?php
                                        foreach ($ActualSalesMan as $Actual) {
                                            ?>
                                            <option value="<?= $Actual['Id'] ?>" ><?= $Actual['FullName'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <label>Visit Plan</label>
                                    <select name="visit_plan" id="visit_plan">
                                        <option value="0" >Select Visit Plan</option>
                                    </select>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div>
                                    <label>Salesman</label>
                                    <input type="text" name="salesman" readonly placeholder="salesman"
                                           value="<?= $data['username'] ?>">
                                </div>
                                <div style="display: none;">
                                    <label>Actual Salesman</label>
                                    <input type="text" name="a_salesman" readonly placeholder="salesman"
                                           value="<?= $data['username'] ?>">
                                </div>
                                <?php
                            }
                            ?>
                            <div>
                                <label>Additional Note</label>
                                <textarea name="additional_note"></textarea>
                            </div>

                            <div>
                                <label>&nbsp;</label>
                                <span></span> <a href="javascript:" id="btn-pbo" class="btn" style="padding: 7px 75px;">Order
                                    Accessories</a>
                            </div>
                        </div>
                    </fieldset>
                    <div class="hidden pbo-form">
                        <fieldset>
                            <legend>Add Accessories To Order</legend>
                            <div class="feildwrap"></div>
                            <div class="btn-block-wrap datagrid">
                                <table width='70%' border='0' cellpadding='1' cellspacing='1'>
                                    <thead>
                                        <tr>
                                            <td width="15%">Check To Add</td>
                                            <td width="50%">Accessory Name</td>
                                            <td width="20%">Price</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($accessories as $CarAccessories) {
                                            echo "
                                            <tr>
                                            <td><input type='checkbox' value='" . $CarAccessories['Id'] . "' name='accessories[]'></td>
                                            <td>" . $CarAccessories['AccessoryName'] . "</td>
                                            <td>" . $CarAccessories['Price'] . "</td>
                                            </tr>
                                            ";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <span class="check">This feild must be filled!</span>
                            </div>
                        </fieldset>
                    </div>
                    <div class="btn-block-wrap">


                        <fieldset>
                            <legend>Campaign</legend>

                            <div class="feildwrap">

                                <div>
                                    <label>Select campaign</label>
                                    <select name="idCampaign" id="idCampaign" class="">
                                        <option value="">Select campaign</option>
                                        <?php
                                        foreach ($campaigns as $row) {?>
                                            <option value="<?= $row['idCampaign'] ?>" ><?= $row['campaignType'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <label>Description</label>
                                    <input type="text" id="cmpaigndescription">
                                </div>
                                <div >
                                    <label>Remarks</label>
                                    <input type="text" id="cmpaignremarks">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Replacement</legend>

                            <div class="feildwrap">

                                <div>
                                    <label>Replacement</label>
                                    <select name="replacement" id="replacement" class="" data-validation="required">
                                        <option value="1">No</option>
                                        <option value="0">Yes</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Model</label>
                                    <select name="replacementmodel" id="">
                                        <option value="">Select Model</option>
                                    <?php
                                    foreach ($Model as $CarModel) {
                                        $ModelId = $CarModel['Id'];
                                        ?>
                                        <option value="<?= $CarModel['Id'] ?>" ><?= $CarModel['Model'] ?></option>
                                        <?php }
                                    ?>
                                    </select>
                                </div>
                                <div >
                                    <label>Model Year</label>
                                    <input type="text" id="replacementyear" name="replacementyear">
                                </div>
                                <div >
                                    <label>Variant</label>

                                    <select name="replacementvariant" id="">
                                        <option value="">Select Variant</option>

                                        <?php
                                        foreach ($vehicle_interst as $row) {
//                                            $ModelId = $CarModel['IdVariants'];
                                            ?>
                                            <option value="<?= $row['Id'] ?>" ><?= $row['Variants'] ?></option>
                                        <?php }
                                        ?>
                                    </select>

<!--                                    <input type="text" id="replacementvariant">-->
                                </div>
                                <div >
                                    <label>Mileage</label>
                                    <input type="text" name="replacementmileage">
                                </div>
                                <div >
                                    <label>Referred To</label>
                                    <input type="text" name="replacementreffered">
                                </div>
                                <div >
                                    <label>Reg No#</label>
                                    <input type="text" name="replacementregno">
                                </div>
                            </div>
                        </fieldset>


                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="Save Resourcebook" style="margin-left: 445px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("#actual_salesman").change(function () {
            var salepersonId = $("#actual_salesman").val();

            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getVisitPlan",
                type: "POST",
                data: {
                    salepersonId: salepersonId
                },
                success: function (data) {
                    console.log(data);
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a.length > 0) {
                        try {
                            var items = "<option value='0'>Select Visit Plan</option>";
                            $.each(a, function (i, val) {
                                items += "<option value='" + val.idvisitplan + "'>" + val.idvisitplan + "</option>";
                            });
                            $('#visit_plan').html(items);
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
                        var items = "<option value='0'>Select Visit Plan</option>";
                        $('#visit_plan').html(items);
                    }
                }
            });
        });

        $(".cusType").change(function () {
            if ($(".cusType :selected").text() === "Dealer") {
                $("#customerName").show();
                $("#fatherName").show();
                $("#dealerName").show();
                $("#subdealerName").hide();
                $("#companyName").hide();
                $("#designation").hide();
                $("#officeNumber").hide();
            } else if ($(".cusType :selected").text() === "Sub Dealer") {
                $("#customerName").show();
                $("#fatherName").show();
                $("#subdealerName").show();
                $("#dealerName").hide();
                $("#companyName").hide();
                $("#designation").hide();
                $("#officeNumber").hide();
            } else if ($(".cusType :selected").text() === "Individual FI" || $(".cusType :selected").text() === "Corporate FI") {
                $("#customerName").show();
                $("#fatherName").show();
                $("#companyName").show();
                $("#subdealerName").hide();
                $("#dealerName").hide();
                $("#designation").show();
                $("#lesse").show();
                $("#financer").show();
                $("#officeNumber").show();
            } else if ($(".cusType :selected").text() === "Corporate") {
                $("#customerName").show();
                $("#fatherName").hide();
                $("#companyName").show();
                $("#subdealerName").hide();
                $("#dealerName").hide();
                $("#designation").hide();
                $("#lesse").hide();
                $("#officeNumber").show();
                $("#dob").hide();
                $("#Mobile").show();
                $("#Residential").hide();
            } else {
                $("#customerName").show();
                $("#fatherName").show();
                $("#companyName").show();
                $("#subdealerName").hide();
                $("#dealerName").hide();
                $("#designation").show();
                $("#lesse").hide();
                $("#officeNumber").show();
            }
        });
        $(".VariantList").change(function () {
            var variant = $(".VariantList").val();
            console.log(variant);
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getColor",
                type: "POST",
                data: {variantId: variant},
                success: function (data) {
                    console.log("variant " + variant);
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
        $(".customer_ex").click(function () {
            var Customer = $('input[name=customer_ex]:checked').val();
            console.log(Customer);
            if (Customer == "Existing_Customer") {
                $('#CustomerCombo').show();
                $.ajax({
                    url: "<?= base_url() ?>index.php/resourcebook/getCustomers",
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
        $("input[name=cnic]").keyup(function () {
            var Cnic = $("input[name=cnic]").val();
            console.log(Cnic);
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getCustomerByCnic",
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
                                $('input[name=preferedcontactway]').val(val.preferedcontactway);

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
        $("#cusId").change(function () {
            var Customer = $('#cusId').val();
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getCustomerDetails",
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
                                $('#customerName').val(val.CustomerName);
                                $('input[name=f_name]').val(val.FatherName);
                                $('input[name=dob]').val(val.DateOfBirth);
                                $('input[name=company_name]').val(val.CompanyName);
                                $('input[name=designation]').val(val.Designation);
                                $('textarea[name=address]').val(val.AddressDetails);
                                $('textarea[name=address2]').val(val.AddressTwoDetails);
                                $('select#province').val(val.Province);
                                $('select#city').val(val.City);
                                $('input[name=Residential_no]').val(val.Telephone);
                                $('input[name=Mobile_no]').val(val.Cellphone);
                                $('input[name=Office_no]').val(val.OfficeNumber);
                                $('input[name=email]').val(val.Email);
                                $('input[name=CNIC_no]').val(val.Cnic);
                                $('input[name=NTN_no]').val(val.Ntn);
                                $('input[name=postal_no]').val(val.postal_code);
                                $('input[name=fax_no]').val(val.Fax);
                                $('input[name=postal_no]').val(val.postal_code);
                                $('input[name=preferedcontactway]').val(val.preferedcontactway);
                            });
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
                        console.log("empty");
                    }
                }
            });
        });

        $("#idCampaign").change(function () {
            var idCampaign = $('#idCampaign').val();
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getCampaign",
                type: "POST",
                data: {idCampaign: idCampaign},
                success: function (data) {
                    var a = JSON.parse(data);
                    console.log(a);
                    $('#cmpaigndescription').val(a.description)
                    $('#cmpaignremarks').val(a.remarks)
                }
            });
        });


        $("#Mobile_no").change(function () {
            var Mobile_no = $('#Mobile_no').val();
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getCustomerDetailsbyMobile",
                type: "POST",
                data: {Mobile_no: Mobile_no},
                success: function (data) {
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a.length > 0) {
                        try {
                            $("#customer_ex_check").click();

                            //                        var items = ;
                            $.each(a, function (i, val) {
                                //                            items += "<option value='" + val.IdCustomer + "'>" + val.CustomerName + "</option>";
                                $('#cusId').val(val.IdCustomer);
                                $('#customerName').val(val.CustomerName);
                                $('input[name=f_name]').val(val.FatherName);
                                $('input[name=dob]').val(val.DateOfBirth);
                                $('input[name=company_name]').val(val.CompanyName);
                                $('input[name=designation]').val(val.Designation);
                                $('textarea[name=address]').val(val.AddressDetails);
                                $('textarea[name=address2]').val(val.AddressTwoDetails);
                                $('select#province').val(val.Province);
                                $('select#city').val(val.City);
                                $('input[name=Residential_no]').val(val.Telephone);
//                                $('input[name=Mobile_no]').val(val.Cellphone);
                                $('input[name=Office_no]').val(val.OfficeNumber);
                                $('input[name=email]').val(val.Email);
                                $('input[name=CNIC_no]').val(val.Cnic);
                                $('input[name=NTN_no]').val(val.Ntn);
                                $('input[name=postal_no]').val(val.postal_code);
                                $('input[name=fax_no]').val(val.Fax);
                                $('input[name=postal_no]').val(val.postal_code);
                                $('input[name=preferedcontactway]').val(val.preferedcontactway);

                                items = "<option value='"+ val.IdCustomer+"'>"+val.CustomerName +"</option>"
                                $('#cusId').html(items);
                                $('#CustomerCombo').show();

                            });
                        }
                        catch (e) {
                            console.log(e);
                        }
                    } else {
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
            //        customerType = $('.cusType :selected').val();
            //        customerStatus = $('.cusStatus :selected').val();
            //        conType = $('.conType :selected').val();
            //        payMode = $('.payMode :selected').val();
            //        ModelList = $('.ModelList :selected').val();
            //        VariantList = $('.VariantList :selected').val();
            //        color1 = $('.color1 :selected').val();
            //        color2 = $('.color2 :selected').val();
            //
            //        if (customerType === "Select Customer Type" || ) {
            //
            //        } else {
            //        }
            var cusType = $('#cusType').val();
            var conType = $('#conType').val();
            var followUp = $('#FollowUp').val();
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

            if (followUp === "Select Followup Status") {
                $(".error-followup").show();
                return false;
            } else {
                $(".error-followup").hide();
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
    </script>
    <?php
}
?>