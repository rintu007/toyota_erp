<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);

        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()"  method="post"
                   class="form validate-form animated fadeIn">

                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>Do Entry</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="id" readonly value="<?=$dorder->id?>" id="">
                        </div>
                        <div>
                            <label>Entry Date</label>
                            <input type="text" class="date" name="entrydate" value="<?=$dorder->entrydate?>"  data-validation="required">
                        </div>
                        <div>
<!--                            --><?php //print_r($dispatchdata)?>
                            <label>Chasis No</label>
                            <input type="text" value="<?= $dispatchdata->ChasisNo?>" readonly name="question" id="searchnow"
                            >
                        </div>
                        <div>
                            <label>Arrival Date</label>
                            <input type="text" class="date" name="arrivaldate" value="<?= $dispatchdata->arrivaldate?>" readonly data-validation="required">
                        </div>
                        <div>
                            <label>Order Form No</label>
                            <input type="text" name="question" readonly id="searchnow">
                        </div>
                        <div>
                            <label>Dispatch No</label>
                            <input type="text" name="idDispatch"   value="<?= $dispatchdata->idDispatch?>" readonly id="idDispatch"
                            >
                        </div>
                        <div>
                            <label>Applicant</label>
                            <input type="text" name="CustomerName" value="<?= $dispatchdata->CustomerName?>" readonly id="">
                        </div>
                        <div>
                            <label>Engine No</label>
                            <input type="text" name="EngineNo" value="<?= $dispatchdata->EngineNo?>" readonly id="">
                        </div>
                        <div>
                            <label>Reminder Date</label>
                            <input type="text" class="date" name="reminderdate" value="<?= $dispatchdata->reminderdate?>" readonly>
                        </div>
                        <div>
                            <label>Reg No</label>
                            <input type="text" name="question" readonly value="<?= $dispatchdata->RegistrationNumber?>" id="searchnow"
                            >
                        </div>
                        <div>
                            <label>Vehichle</label>
                            <input type="text" name="question" value="<?= $dispatchdata->Variants?>" readonly id="searchnow">


                        </div>
                        <div>
                            <label>Color</label>
                            <input type="text" name="question"  value="<?= $dispatchdata->ColorName?>" readonly id="searchnow">

                        </div>
                        <div>
                            <label>Parking Row No</label>
                            <input readonly type="text" value="<?=$dispatchdata->parkingname?>">
                        </div>
                        <div>
                            <label>Source</label>
                            <input type="text"  value="<?=$dispatchdata->sourcename?>" readonly>
                        </div>
                        <div>
                            <label>Remarks</label>
                            <textarea name="remarks"  readonly placeholder=".."><?=$dispatchdata->remarks?></textarea>
                        </div>

                        <div>
                            <label>Salesman</label>
                            <input type="text" class="" name="" value="<?= $dispatchdata->ActualSalePerson?>" readonly>
                        </div>

                        <div>
                            <label>Sold to</label>
                            <input type="text" class=""  name="soldto" value="<?= $dorder->soldto?>" >
                        </div>

                        <div>
                            <label>Care of</label>
                            <input type="text" class="" name="careof" value="<?= $dorder->careof?>" >
                        </div>


                        <br>
                        <div>

<!--                            <button type="submit" class="btn">Submit</button>-->
<!--                            <a href="--><?//=site_url("index.php/dispatch/dispatchReceive_list")?><!--">Back</a>-->
                        </div>


                        <br>



                        <div>
                            <label>User Name</label>

                            <select name="custId" id="cusId">

                                <?php
                                foreach ($customers as $row)
                                {
                                ?>
                                    <option value="<?=$row['IdCustomer']?>"  <?= ($row['IdCustomer']==$dispatchdata->IdCustomer)?'selected':''?>><?=$row['CustomerName']?></option>
                                <?php }
                                ?>

                            </select>
                        </div>

                        <div>
                            <label>Father/Husband Name</label>

                            <input name="" readonly id="FatherName" type="text" value="<?= $dispatchdata->FatherName ?>" style="width: 180px">
                        </div>
                        <div>
                            <label>Date of Birth</label>
                            <input name="dob" type="date" class="dob" readonly value="<?= $dispatchdata->DateOfBirth ?>" style="width: 250px;">
                        </div>
                        <div>
                            <label>Address</label>
                            <textarea name="address" readonly
                                      placeholder="Address.."><?= $dispatchdata->AddressDetails ?></textarea>
                        </div>

                        <div>
                            <label>Address 2</label>
                            <textarea name="address2" readonly placeholder="Address.."><?= $dispatchdata->AddressTwoDetails ?></textarea>
                        </div>
                        <div>
                            <label>Company Name</label>
                            <input type="text" name="company_name" value="<?= $dispatchdata->CompanyName ?>">
                        </div>
                        <div>
                            <label>Designation</label>
                            <input type="text" name="designation" readonly value="<?= $dispatchdata->Designation ?>">
                        </div>
                        <div>
                            <label>Province</label>
                            <input type="text" value="<?=$dispatchdata->Province?>" readonly>


                        </div>
                        <div>
                            <label>City</label>
                            <input type="text" value="<?=$dispatchdata->City?>" readonly>


                        </div>
                        <div>
                            <label>Postal Code #</label>
                            <input type="text" name="postal_no" value="<?= $dispatchdata->postal_code ?>">
                        </div>
                        <div>
                            <label>Residential Tel#</label>
                            <input name="telephone" value="<?= $dispatchdata->Telephone ?>" type="text" id="Residential_no">
                        </div>

                        <div id="Mobile">
                            <label>Mobile Tel#</label>
                            <input type="text" name="Mobile_no" id="Mobile_no" value="<?= $dispatchdata->Cellphone ?>">
                        </div>
                        <div id="officeNumber">
                            <label>Office Tel#</label>
                            <input type="text" name="Office_no" id="Office_no" value="<?= $dispatchdata->OfficeNumber ?>">
                        </div>

                        <div id="officeNumber">
                            <label>Fax #</label>
                            <input type="text" name="fax_no" value="<?= $dispatchdata->Fax ?>">
                        </div>
                        <div>
                            <label>Email</label>
                            <input name="email" type="email" value="<?= $dispatchdata->Email ?>">
                        </div>
                        <div>
                            <label>CNIC #</label>
                            <input name="CNIC_no" type="text" value="<?= $dispatchdata->Cnic ?>">
                        </div>
                        <div>
                            <label>NTN #</label>
                            <input name="NTN_no" type="text" value="<?= $dispatchdata->Ntn ?>" id="NTN_no">
                        </div>

                        <div>
                            <label>Invoice Number </label>
                            <input name="" type="text" value="<?= $dispatchdata->InvoiceNumber ?>" id="">
                        </div>

                        <div>
                            <label>InvoiceDate</label>
                            <input name="" type="text" readonly value="<?= $dispatchdata->InvoiceDate ?>" id="">
                        </div>
                         <div>
                            <label>Driver</label>
                            <input name="driver" type="text" value="<?= $dorder->driver ?>" data-validation="required" id="">
                        </div>

                        <div>
                            <label>Customer Account</label>
                            <select name="code_sub_account" id="">
                                <option value="">--Select--</option>
                                <?php foreach ($sub_account as $row){?>
                                    <option value="<?=$row['code_sub_account']?>"  <?=($dorder->code_sub_account == $row['code_sub_account'])?'selected':''?> > <?=$row['sub_account']?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label>FFS Follow Up</label>
                            <input type="checkbox" name="FFSFollowup" id="FFSFollowup" <?=($dorder->FFSFollowupdate)?'checked':''?>>
                            <input type="date" name="FFSFollowupdate" id="FFSFollowupdate" value="<?=$dorder->FFSFollowupdate?>">
                        </div>
                        <div>
                            <label for="">
                                Clear Delivery Order
                                <input type="checkbox" name="cashdeliveryorder" <?=($dorder->cashdeliveryorder)?'checked':'' ?> >
                            </label>
                            <label for="">
                                Receive do in Finance
                                <input type="checkbox" name="receivedoinfinance" <?=($dorder->receivedoinfinance)?'checked':'' ?>>
                            </label>
                            <label for="">
                                Loyalty Card Offer
                                <input type="checkbox" name="loyaltycardoffer" <?=($dorder->loyaltycardoffer)?'checked':'' ?>>
                            </label>
                            <label for="">
                                Resale
                                <input type="checkbox" name="resale" <?=($dorder->resale)?'checked':'' ?>>
                            </label>

                        </div>



                    </fieldset>

            </form>
        </div>
    </div>
</div>
<!-- Edit User Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/warehouse/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Warehouse ID</label>
            <input type="text" name="WarehouseId" id="WarehouseId" data-validation="required">
        </div>
        <div>
            <label>Mode Name</label>
            <input type="text" name="Name" id="Name" data-validation="required">
        </div>

    </form>
</div>
<script>
    //    $('#searchform').hide();
    $('#CustomerCombo').show();

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
                            $('#customerName').val(val.FatherName);
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


    function validationform() {

    }
</script>