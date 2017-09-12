<?php
$data = unserialize($_COOKIE['logindata']);
if ($data["userid"] != "") {
    ?>
    <div id="wrapper">
        <div id="content">
            <?php
            include 'include/admin_leftmenu.php';
            $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['username'] == "admin") {
//            include 'include/admin_leftmenu.php';
//        } else if ($cookieData['Role'] == "Sales Admin") {
//            include 'include/sales_leftmenu.php';
//        } else if ($cookieData['Role'] == "Director") {
//            include 'include/director_menu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
            ?>
            <div class="right-pnel">
                <form name="myform" onSubmit="return validationform()" method="post"
                      action="<?= base_url() ?>index.php/resourcebook/index" class="form validate-form animated fadeIn">
                    <fieldset>
                        <legend>Resource Book</legend>
                        <div class="feildwrap">
                            <div>
                                <label>Date</label>
                                <input type="text" name="date" class="date" value="<?= date('Y/m/d') ?>"
                                       data-validation="required">
                            </div>
                            <div>
                                <label>Contact Type</label>
                                <select name="contact_type">
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
                            </div>
                            <div>
                                <label>Customer Type</label>
                                <select name="customertype" class="cusType">
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
                            </div>
                            <div>
                                <label>Customer Name</label>
                                <input type="text" name="customer_name" id="customerName" data-validation="required">
                            </div>
                            <div>
                                <label>Father/Husband Name</label>
                                <input type="text" name="f_name" id="fatherName" data-validation="required">
                            </div>
                            <div id="companyName">
                                <label>Company Name</label>
                                <input type="text" name="company_name" data-validation="required">
                            </div>
                            <div id="designation">
                                <label>Designation</label>
                                <input type="text" name="designation" data-validation="required">
                            </div>
                            <div>
                                <label>Address</label>
                                <textarea name="address" data-validation="required" placeholder="Address.."></textarea>
                            </div>
                            <div>
                                <label>Province</label>
                                <select data-validation="required" name="province">
                                    <option>Select Province</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>
                            </div>
                            <div>
                                <label>City</label>
                                <select data-validation="required" name="city">
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
                            <div>
                                <label>Residential Tel#</label>
                                <input type="text" name="Residential_no" data-validation="number">
                            </div>
                            <div>
                                <label>Mobile Tel#</label>
                                <input type="text" name="Mobile_no" data-validation="number">
                            </div>
                            <div id="officeNumber">
                                <label>Office Tel#</label>
                                <input type="text" name="Office_no" data-validation="number">
                            </div>
                            <div>
                                <label>Email</label>
                                <input type="email" name="email" data-validation="email">
                            </div>
                            <div>
                                <label>Existing Vehicle</label>
                                <input type="text" name="existing_vehicle">
                            </div>
                            <div>
                                <label>Vehicle Interested</label>
                                <select name="vehicle_interst" class="VariantList">
                                    <option>Select Variant</option>
                                    <?php
                                    foreach ($vehicle_interst as $Variants) {
                                        $VariantsId = $Variants['Id'];
                                        ?>
                                        <option value="<?= $Variants['Id'] ?>" ><?= $Variants['Variants'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Mode Of Payment</label>
                                <select name="payment_mode">
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
                                <select name="customer_status">
                                    <option>Select CustomerStatus</option>
                                    <?php
                                    foreach ($customer_status as $CustomerStatus) {
                                        $CustomerStatusId = $CustomerStatus['Id'];
                                        ?>
                                        <option value="<?= $CustomerStatus['Id'] ?>" ><?= $CustomerStatus['StatusType'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Follow Up</label>
                                <span style="width:272px; float:right;">
                                    <?php
                                    foreach ($followup as $followupStatus) {
                                        echo "<input type='radio' value='" . $followupStatus['Id'] . "' name='follow_up'>" . $followupStatus['FollowupType'];
                                    }
                                    ?>
                                    <span class="check">This feild must be filled!</span>
                            </div>
                            <div>
                                <label>Remarks</label>
                                <textarea name="remarks" placeholder="Remarks.."></textarea>
                            </div>
                            <div>
                                <label>&nbsp;</label>
                                <span></span> <a href="javascript:" id="btn-pbo" class="btn" style="padding: 7px 75px;">Order
                                    Accessories</a>
                            </div>
                            <div>
                                <label>Delivery Month</label>
                                <select name="delivery_month">
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
                                <label>CNIC #</label>
                                <input type="text" name="CNIC_no" data-validation="number">
                            </div>
                            <div>
                                <label>NTN #</label>
                                <input type="text" name="NTN_no">
                            </div>
                            <div>
                                <label>Salesman</label>
                                <input type="text" name="salesman" readonly placeholder="salesman"
                                       value="<?= $this->session->userdata('username') ?>">
                            </div>
                            <div>
                                <label>Color Choice One</label>
                                <select name="color_choice_one" id="ColorList1">
                                    <option>Select Color One</option>
                                    <?php
//                                foreach ($color_choice_one as $Color1) {
//                                    $Color1Id = $Color1['Id'];
                                    ?>
                                        <!--<option value="<?= $Color1['Id'] ?>" ><?= $Color1['ColorName'] ?></option>-->
                                    <?php
//                                }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Color Choice Two</label>
                                <select name="color_choice_two" id="ColorList2">
                                    <option>Select Color Two</option>
                                    <?php
//                                foreach ($color_choice_two as $Color2) {
//                                    $Color2Id = $Color2['Id'];
//                                    
                                    ?>
                                        <!--<option value="//<?= $Color2['Id'] ?>" ><?= $Color2['ColorName'] ?></option>-->
                                    <?php
//                                }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Time Consumed</label>
                                <input type="text" name="time_consumed" data-validation="required">
                            </div>
                            <div class="btn-block-wrap">
                                <label>&nbsp;</label>
                                <input type="submit" class="btn" value="Save Resourcebook">
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
                            <!--                            </div>-->

                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(".cusType").change(function() {
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
            } else {
                $("#customerName").show();
                $("#fatherName").show();
                $("#companyName").show();
                $("#subdealerName").hide();
                $("#dealerName").hide();
                $("#designation").show();
                $("#officeNumber").show();
            }
        });

        $(".VariantList").change(function() {
            var variant = $(".VariantList").val();

            console.log(variant);
            $.ajax({
                url: "<?= base_url() ?>index.php/resourcebook/getColor",
                type: "POST",
                data: {variantId: variant},
                success: function(data) {
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a.length > 0) {
                        try {
                            var items = "";
                            $.each(a, function(i, val) {
                                items += "<option value='" + val.ColorId + "'>" + val.ColorName + "</option>";
                            });
                            $('#ColorList1').html(items);
                            $('#ColorList2').html(items);
                        }
                        catch (e) {
                            console.log(e);
                        }
                    }
                }
            });
        });

        function validationform() {
            chosen = "";
            len = document.myform.follow_up.length;
            for (i = 0; i < len; i++) {
                if (document.myform.follow_up[i].checked) {
                    chosen = document.myform.follow_up[i].value;
                }
            }
            if (chosen === "") {
                $(".check").show();
                return false;
            }
            else {
                $(".check").hide();
                return true;
            }
        }
    </script>
    <?php
} else {
    redirect(base_url());
}
?>