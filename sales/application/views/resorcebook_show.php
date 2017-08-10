<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel" class="form validate-form animated fadeIn">
            <?php $ResourceBookId = $resourcebook['IdResourceBook']; ?>
            <form action="<?= base_url() ?>index.php/resourcebook/update/<?= $ResourceBookId ?>" method="post"
                  class="form">
                <div class="feildwrap">
                    <fieldset>
                        <legend>Customer Details</legend>
                        <div>
                            <label>Date</label>
                            <input type="text" class="date" name="date" value="<?= $resourcebook['Date'] ?>">
                        </div>
                        <div>
                            <label>Contact Type</label>
                            <?php
                            if ($resourcebook['ContactTypeId'] == null) {
                                ?>
                                <select name="contact_type">
                                    <option>Select Contact Type</option>
                                    <?php
                                    foreach ($rbConType as $ConType) {
                                        ?>
                                        <option value="<?= $ConType['Id'] ?>"><?= $ConType['CustomerType'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <?php
                            } else {
                                echo form_dropdown('contact_type', $contact_type, $resourcebook['ContactTypeId']);
                            }
                            ?>
                        </div>
                        <div>
                            <label>Customer Type</label>
                            <?php
                            if ($resourcebook['CustomerTypeId'] == null) {
                                ?>
                                <select name="customer_type">
                                    <option>Select Customer Type</option>
                                    <?php
                                    foreach ($rbCusType as $CusType) {
                                        ?>
                                        <option value="<?= $CusType['Id'] ?>"><?= $CusType['CustomerType'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <?php
                            } else {
                                echo form_dropdown('customer_type', $customertype, $resourcebook['CustomerTypeId']);
                            }
                            ?>
                        </div>
                        <div style="display:none">
                            <label>Customer ID</label>
                            <input name="customer" type="text" value=" <?= $resourcebook['IdCustomer'] ?>" readonly>
                        </div>
                        <br>

                        <div>
                            <label>Customer Name</label>
                            <input name="customer_name" type="text" value="<?= $resourcebook['gender'] ?>" style="width: 68px">
                            <input name="customer_name" type="text" value="<?= $resourcebook['CustomerName'] ?>" style="width: 180px">
                        </div>
                        <div>
                            <label>Father/Husband Name</label>
                            <input name="customer_name" type="text" value="<?= $resourcebook['genderType'] ?>" style="width: 68px">
                            <input name="f_name" type="text" value="<?= $resourcebook['FatherName'] ?>" style="width: 180px">
                        </div>
                        <div>
                            <label>Date of Birth</label>
                            <input name="dob" type="date" class="dob" value="<?= $resourcebook['DateOfBirth'] ?>" style="width: 250px;">
                        </div>
                        <div>
                            <label>Address</label>
                            <textarea name="address"
                                      placeholder="Address.."><?= $resourcebook['AddressDetails'] ?></textarea>
                        </div>
                        <div>
                            <label>Address 2</label>
                            <textarea name="address"
                                      placeholder="Address.."><?= $resourcebook['AddressTwoDetails'] ?></textarea>
                        </div>
                        <div>
                            <label>Province</label>
                            <?php
                            echo form_dropdown('province', $province, $resourcebook['Province']);
                            ?>
                        </div>
                        <div>
                            <label>City</label>
                            <?php
                            echo form_dropdown('city', $city, $resourcebook['City']);
                            ?>
                        </div>
                        <div>
                                <label>Designation</label>
                                <input type="text" name="designation" value="<?= $resourcebook['Designation'] ?>" readonly="readonly">
                            </div>
                        <div>
                            <label>Postal Code #</label>
                            <input type="text" name="postal_no" value="<?= $resourcebook['postal_code'] ?>" readonly="readonly">
                        </div>
                        <div>
                            <label>Residential Tel#</label>
                            <input name="telephone" value="<?= $resourcebook['Telephone'] ?>" type="text" id="Residential_no">
                        </div>
                        <div>
                            <label>Mobile Tel#</label>
                            <input name="cellphone" type="text" value="<?= $resourcebook['Cellphone'] ?>" id="Mobile_no">
                        </div>
                        <?php
                        if ($resourcebook['CompanyName'] == null) {
                            ?>
                            <div style="display: none;">
                                <label>Company Name</label>
                                <input name="company_name" type="text" value="<?= $resourcebook['CompanyName'] ?>">
                            </div>
                            <?php
                        } else {
                            ?>
                            <div>
                                <label>Company Name</label>
                                <input name="company_name" type="text" value="<?= $resourcebook['CompanyName'] ?>">
                            </div>
                            <?php
                        }
                        ?>
                        <div id="officeNumber">
                            <label>Office Tel#</label>
                            <input type="text" name="Office_no" id="Office_no" value="<?= $resourcebook['OfficeNumber'] ?>">
                        </div>
                        <div>
                            <label>Email</label>
                            <input name="email" type="email" value="<?= $resourcebook['Email'] ?>">
                        </div>
                        <div id="officeNumber">
                            <label>Fax #</label>
                            <input type="text" name="fax_no" value="<?= $resourcebook['Fax'] ?>">
                        </div>
                        <div>
                            <label>CNIC #</label>
                            <input name="CNIC_no" type="text" value="<?= $resourcebook['Cnic'] ?>">
                        </div>
                        <div>
                            <label>NTN #</label>
                            <input name="NTN_no" type="text" value="<?= $resourcebook['Ntn'] ?>" id="NTN_no">
                        </div>
                    </fieldset>
                </div>
                <fieldset>
                    <legend>Resource Book Details</legend>
                    <div class="feildwrap">


                        <div>
                            <label>Model</label>
                            <?php
                            if ($resourcebook['Model'] == null) {
                                ?>
                                <select name="model">
                                    <option>Select Model</option>
                                    <?php
                                    foreach ($rbModel as $model) {
                                        ?>
                                        <option value="<?= $model['Id'] ?>"><?= $model['Model'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <?php
                            } else {
                                echo form_dropdown('model', $model, $resourcebook['Model']);
                            }
                            ?>
                        </div>
                        <div>
                            <label>Vehicle Interested</label>

                            <?php
                            if ($resourcebook['VehicleInterested'] == null) {
                                ?>
                                <select name="vehicle_interst">
                                    <option>Select Variant</option>
                                    <?php
                                    foreach ($rbVariant as $Variant) {
                                        ?>
                                        <option value="<?= $Variant['Id'] ?>" ><?= $Variant['Variants'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php
                            } else {
                                echo form_dropdown('vehicle_interst', $vehicle_interst, $resourcebook['VehicleInterested']);
                            }
                            ?>
                        </div>
                        <div>
                            <label>Color</label>
                            <?php
                            if ($resourcebook['Color1'] == null) {
                                ?>
                                <select name="color_choice_one" class="deliveryMonth">
                                    <option>Select Color</option>
                                    <?php
                                    foreach ($color1 as $ColorOne) {
                                        ?>
                                        <option value="<?= $ColorOne['Id'] ?>" ><?= $ColorOne['ColorName'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php
                            } else {
                                echo form_dropdown('color_choice_one', $color_choice_one, $resourcebook['Color1']);
                            }
                            ?>
                        </div>
                        <div>
                            <label>Mode Of Payment</label>
                            <?php
                            if ($resourcebook['PaymentMode'] == null) {
                                ?>
                                <select name="payment_mode">
                                    <option>Select Payment Mode</option>
                                    <?php
                                    foreach ($rbPayment as $Payment) {
                                        ?>
                                        <option value="<?= $Payment['Id'] ?>" ><?= $Payment['PaymentType'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php
                            } else {
                                echo form_dropdown('payment_mode', $payment_mode, $resourcebook['PaymentMode']);
                            }
                            ?>
                        </div>
                        <div>
                            <label>Customer Status</label>
                            <?php
                            $arr = array();
                            array_push($arr, $resourcebook['CustomerStatus']);
                            foreach ($customer_status as $CusStatus) {
                                if (in_array($CusStatus['Id'], $arr)) {
                                    echo "<input type='radio' value='" . $CusStatus['Id'] . "' name='customer_status' checked>" . $CusStatus['StatusType'];
                                } else {
                                    echo "<input type='radio' value='" . $CusStatus['Id'] . "' name='customer_status'>" . $CusStatus['StatusType'];
                                }
                            }
                            ?>
                           
                        </div>


                        <div>
                            <label>Remarks</label>
                            <textarea name="remarks" placeholder="Remarks .."><?= $resourcebook['Remarks'] ?></textarea>
                        </div>
                        <div>
                            <label>Follow Up</label>
                            <?php
                            if ($resourcebook['FollowupType'] == null) {
                                ?>
                                <select name="follow_up">
                                    <option>Select Followup</option>
                                    <?php
                                    foreach ($rbFollowup as $FollowUp) {
                                        ?>
                                        <option value="<?= $FollowUp['Id'] ?>" ><?= $FollowUp['Followup'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php
                            } else {
                                echo form_dropdown('follow_up', $followup, $resourcebook['FollowupStatus']);
                            }
                            ?>
                        </div>
                        <div>
                            <label>Delivery Month</label>
                            <?php
                            if ($resourcebook['DeliveryMonth'] == null) {
                                ?>
                                <select name="delivery_month" readonly="readonly">
                                    <!--                                    <option>Select Delivery Month</option>-->
                                    <?php
                                    foreach ($deliverymonth as $dMonth) {
                                        ?>
                                        <option disabled="disabled" value="<?= $dMonth ?>"><?= $dMonth ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <?php
                            } else {
                                ?>
                                <select name="delivery_month" readonly="readonly">
                                    <option style="display: none;" value="<?= $resourcebook['DeliveryMonth'] ?>" selected="<?= $resourcebook['DeliveryMonth'] ?>"><?= $resourcebook['DeliveryMonth'] ?></option>
                                    <?php
                                    foreach ($deliverymonth as $dMonth) {
                                        ?>
                                        <option style="display: none;" value="<?= $dMonth ?>"><?= $dMonth ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <?php
                            }
                            ?>
                        </div>
                        <div>
                            <label>Lead By</label>
                            <?= form_dropdown('lead', $LeadBy, $resourcebook['LeadBy']); ?>
                        </div>

                       
                        <div>
                            <label>Alloted Salesman</label>
                            <select name="alloted_salesman">
                                <option>Select Sales Man</option>
                                <?php
                                foreach ($AllotedSalesMan as $Alloted) {
                                     if($Alloted['Id'] == $resourcebook['SalesmanId']){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    ?>
                                    <option value="<?= $Alloted['Id'] ?>" <?php echo $selected; ?>  ><?= $Alloted['FullName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Actual Salesman</label>
                            <select name="actual_salesman">
                                <option>Select Sales Man</option>
                                <?php
                                foreach ($ActualSalesMan as $Actual) {
                                    if($Actual['Id'] == $resourcebook['ActualSalesman']){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    ?>
                                    <option value="<?= $Actual['Id'] ?>" <?php echo $selected; ?>  ><?= $Actual['FullName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Time Consumed</label>
                            <input name="time_consumed" type="text" value=" <?= $resourcebook['TimeConsumed'] ?>"> Mins
                        </div>
                        <div>
                            <label>Additional Note</label>
                            <textarea name="additional_note" style="margin: 0px; width: 721px; height: 100px;"><?= $resourcebook['AdditionalNote'] ?></textarea>
                        </div>
                    </div>
                </fieldset>
                <div class="form validate-form animated fadeIn">


                    <div class="feildwrap">
                        <fieldset>
                            <legend>Accessories Details</legend>
                            <div class="btn-block-wrap datagrid">
                                <table width='70%' border='0' cellpadding='1' cellspacing='1'>
                                    <thead>
                                        <tr>
    <!--                                        <td width="15%">Check To Add</td>-->
    <!--                                        <td width="50%">Accessory Name</td>-->
                                            <!--                                        <td width="20%">Price</td>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($accessories as $CarAccessories) {
                                            echo "
                                            <tr>
                                            <td><input type='checkbox' value='" . $CarAccessories['AccessoryId'] . "' name='accessories[]'" . set_checkbox('accessories[]', $CarAccessories['AccessoryName'], $CarAccessories['AccessoryId'] == $CarAccessories['rbAccessoryId']) . "></td>
                                            <td>" . $CarAccessories['AccessoryName'] . "</td>
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

                </div>
            </form>
        </div>
    </div>
</div>