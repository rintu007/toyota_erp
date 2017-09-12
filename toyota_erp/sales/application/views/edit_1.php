<div id="wrapper">
    <div id="content">
        <?php
          $cookieData = unserialize($_COOKIE['logindata']);
        if ($cookieData['username'] == "admin") {
            include 'include/admin_leftmenu.php';
        } else {
            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel" class="form validate-form animated fadeIn">
            <?php $ResourceBookId = $resourcebook['IdResourceBook']; ?>
            <form action="<?= base_url() ?>index.php/resourcebook/update/<?= $ResourceBookId ?>" method="post"
                  class="form">
                <fieldset>
                    <legend>Resource Book Details</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Date</label>
                            <input type="text" class="date" name="date" value="<?= $resourcebook['Date'] ?>">
                        </div>
                        <div>
                            <label>Contact Type</label>
                            <?php echo form_dropdown('contact_type', $contact_type, $resourcebook['ContactTypeId']) ?>
                        </div>
                        <div>
                            <label>Customer Type</label>
                            <?php echo form_dropdown('customer_type', $customertype, $resourcebook['CustomerTypeId']) ?>
                        </div>
                        <div>
                            <label>Model</label>
                            <?php echo form_dropdown('model', $model, $resourcebook['Model']) ?>
                        </div>
                        <div>
                            <label>Vehicle Interested</label>
                            <?php echo form_dropdown('vehicle_interst', $vehicle_interst, $resourcebook['VehicleInterested']) ?>
                        </div>
                        <div>
                            <label>Mode Of Payment</label>
                            <?php echo form_dropdown('payment_mode', $payment_mode, $resourcebook['PaymentMode']); ?>
                        </div>
                        <div>
                            <label>Customer Status</label>
                            <?php echo form_dropdown('customer_status', $customer_status, $resourcebook['StatusType']) ?>
                        </div>
                        <div style="display: none;">
                            <label>Follow Up</label>
                            <?php
                            if ($resourcebook['FollowupStatus'] == 1) {
                                echo "<input type='radio' value='1' name='follow_up' checked>7 Days
                            <input type='radio' value='2' name='follow_up'>14 Days
                            <input type='radio' value='3' name='follow_up'>21 Days
                            <input type='radio' value='4' name='follow_up'>No";
                            } else if ($resourcebook['FollowupStatus'] == 2) {
                                echo "<input type='radio' value='1' name='follow_up'>7 Days
                            <input type='radio' value='2' name='follow_up' checked>14 Days
                            <input type='radio' value='3' name='follow_up'>21 Days
                            <input type='radio' value='4' name='follow_up'>No";
                            } else if ($resourcebook['FollowupStatus'] == 3) {
                                echo "<input type='radio' value='1' name='follow_up'>7 Days
                            <input type='radio' value='2' name='follow_up'>14 Days
                            <input type='radio' value='3' name='follow_up' checked>21 Days
                            <input type='radio' value='4' name='follow_up'>No";
                            } else {
                                echo "<input type='radio' value='1' name='follow_up'>7 Days
                            <input type='radio' value='2' name='follow_up'>14 Days
                            <input type='radio' value='3' name='follow_up'>21 Days
                            <input type='radio' value='4' name='follow_up' checked>No";
                            }
                            ?>
                        </div>
                        <div>
                            <label>Remarks</label>
                            <textarea name="remarks" placeholder="Remarks .."><?= $resourcebook['Remarks'] ?></textarea>
                        </div>
                        <div>
                            <label>Delivery Month</label>
                            <select name="delivery_month">
                                <!--<option>Select Delivery Month</option>-->
                                <option value="<?= $resourcebook['DeliveryMonth'] ?>" selected="<?= $resourcebook['DeliveryMonth'] ?>"><?= $resourcebook['DeliveryMonth'] ?></option>
                                <?php
                                foreach ($deliverymonth as $dMonth) {
                                    ?>
                                    <option value="<?= $dMonth ?>"><?= $dMonth ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Color Choice Two</label>
                            <?php
//                            $color = 'class="' . $resourcebook['ColorName'] . '"';
                            echo form_dropdown('color_choice_two', $color_choice_two, $resourcebook['Color1']);
                            ?>
                        </div>
                        <div>
                            <label>Time Consumed</label>
                            <input name="time_consumed" type="text" value=" <?= $resourcebook['TimeConsumed'] ?>">
                        </div>
                        <div>
                            <label>Additional Note</label>
                            <textarea name="additional_note"><?= $resourcebook['AdditionalNote'] ?></textarea>
                        </div>
                    </div>
                </fieldset>
                <div class="form validate-form animated fadeIn">
                    <div class="feildwrap">
                        <fieldset>
                            <legend>Customer Details</legend>
                            <div>
                                <label>Customer ID</label>
                                <input name="customer" type="text" value=" <?= $resourcebook['IdCustomer'] ?>" readonly>
                            </div>
                            <br>

                            <div>
                                <label>Customer Name</label>
                                <input name="customer_name" type="text" value="<?= $resourcebook['CustomerName'] ?>">
                            </div>
                            <div>
                                <label>Father/Husband Name</label>
                                <input name="f_name" type="text" value="<?= $resourcebook['FatherName'] ?>">
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
                                <label>Residential Tel#</label>
                                <input name="telephone" value="<?= $resourcebook['Telephone'] ?>" type="text">
                            </div>
                            <div>
                                <label>Mobile #</label>
                                <input name="cellphone" type="text" value="<?= $resourcebook['Cellphone'] ?>">
                            </div>
                            <div>
                                <label>Email</label>
                                <input name="email" type="email" value="<?= $resourcebook['Email'] ?>">
                            </div>
                            <div>
                                <label>CNIC #</label>
                                <input name="CNIC_no" type="text" value="<?= $resourcebook['Cnic'] ?>">
                            </div>
                            <div>
                                <label>NTN #</label>
                                <input name="NTN_no" type="text" value="<?= $resourcebook['Ntn'] ?>">
                            </div>
                        </fieldset>
                    </div>

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
                    <div style="margin-left: 500px;">
                        <input type="submit" class="btn" value="Update Details">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>