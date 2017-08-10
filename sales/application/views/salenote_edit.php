
    <div id="wrapper">
        <div id="content">
            <?php
            include 'include/admin_leftmenu.php';
//            print_r(($data));
            ?>
            <div class="right-pnel">
                <form name="myform" onsubmit="return validationform()" method="post"
                <form name="myform" method="post"
                      action="<?= base_url() ?>index.php/salenote/add" class="form validate-form animated fadeIn">
                         <?php //  print_r($data); ?>

                    <fieldset>
                        <legend>Variant Details</legend>
                        <div class="feildwrap">
<!--                            <legend>Search</legend>-->
                            <br>
<!--                            <div>
                                <label>Chassis Number</label>
                                <input type="text" name="ChasisNumber" value="<?php echo $data['ChasisNumber']; ?>" id="ChasisNumber" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Pbo Number</label>
                                <input type="text" name="PboNumber" value="<?php echo $data['PboNumber']; ?>" readonly="readonly"/>
                            </div>
                            <hr>-->
                            <br>
                            <div  style="display: none;">
                                <label>Dispatch ID</label>
                                <input type="text" name="dispatchId" id="Dispatch" value="<?php echo $data['ChasisNumber']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Model</label>
                                <input type="text" name="Model" id="Model" value="<?php echo $data['Model'];  ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Variant</label>
                                <input type="text" name="Variant" id="Variant" value="<?php echo $data['Variants'];  ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Color</label>
                                <input type="text" name="Color" id="VariantColor" value="<?php echo $data['ColorName'];  ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Chassis Number</label>
                                <input type="text" name="ChasisNo" id="Chasis" value="<?php echo $data['ChasisNo']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Engine Number</label>
                                <input type="text" name="EngineNo" id="Engine" readonly value="<?php echo $data['EngineNo']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Price</label>
                                <input type="text" name="Price" id="Price" value="<?php echo $data['VehiclePrice']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Purchase Price</label>
                                <input type="text" name="purchasePrice" id="purchasePrice" value="<?php echo $data['PurchasePrice']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Selling Price</label>
                                <input type="text" name="SellingPrice" id="SellingPrice" value="<?php echo $data['SellingPrice']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Net Profit</label>
                                <input type="text" name="NetProfit" id="netprofit" value="<?php echo $data['NetProfit']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Profit Percentage</label>
                                <input type="text" name="ProfitPercentage" id="ProfitPercentage" value="<?php echo $data['ProfitPercentage']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Percentage Amount</label>
                                <input type="text" name="Percentage" id="Percentage" value="<?php echo $data['Percentage']; ?>" readonly="readonly"/>
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
                                <input type="text" name="PurchaseFrom" value="<?php echo $data['PurchaseFrom']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Sale To</label>
                                <input type="text" name="customer_name" id="customer_name"  value="<?php echo $data['CustomerName']; ?>" readonly="readonly"/>
                            </div>
                            <div style="display:none">
                                <label>Date</label>
                                <input type="Date" name="Date" />
                            </div>
                            <div>
                                <label>Sale Person</label>
                                <input type="text" name="saleperson" id="saleperson" value="<?php echo $data['SalePerson']; ?>" readonly="readonly"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Customer Details</legend>
                        <div class="feildwrap">
                            
                            <div>
                                <label>Date</label>
                                <input type="text" name="date" class="date" value="<?php echo $data['CreatedDate']; ?>" readonly="readonly"/>
                            </div>
                            <div style="display: none;">
                                <label>Customer ID</label>
                                <input type="text" name="customer_id" value="<?php echo $data['gender']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Customer Name</label>
                                <input type="text" name="customer_name" id="customerName" value="<?php echo $data['CustomerName']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Father/Husband Name</label>
                                <input type="text" name="f_name" id="fatherName" value="<?php echo $data['FatherName']; ?>" readonly="readonly"/>
                            </div>
                             <div>
                                <label>Company Name</label>
                                <input type="text" name="company_name" value="<?php echo $data['CompanyName']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Designation</label>
                                <input type="text" name="designation" value="<?php echo $data['Designation']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Date of Birth</label>
                                <input type="text" class="dob" name="dob" style="width:250px;" value="<?php echo $data['DateOfBirth']; ?>" readonly="readonly"/>
                            </div>
                            <div style="display: none">
                                <label>Address</label>
                                <input type="text" name="Residential_no" id="Residential_no" value="<?php echo $data['AddressTwoDetails']; ?>" readonly="readonly"/>
                            </div>
                             <div >
                                <label>Address </label>
                                <input type="text" name="Residential_no" id="Residential_no" value="<?php echo $data['AddressDetails']; ?>" readonly="readonly"/>
                            </div>
                             <div >
                                <label>Address 2</label>
                                <input type="text" name="Residential_no2" id="Residential_no2" value="<?php echo $data['AddressTwoDetails']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Province</label>
                                 <input type="text" name="Residential_no" id="Residential_no" value="<?php echo $data['Province']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>City</label>
                                 <input type="text" name="Residential_no" id="Residential_no" value="<?php echo $data['City']; ?>" readonly="readonly"/>
                            </div>
                           
                            
                            
                            <div id="Mobile">
                                <label>Postal#</label>
                                <input type="text" name="postal_code" id="postal_code" value="<?php echo $data['postal_code']; ?>" readonly="readonly"/>
                            </div>
                            <div id="Mobile">
                                <label>Residential#</label>
                                <input type="text" name="Mobile_no" id="Mobile_no" value="<?php echo $data['Telephone']; ?>" readonly="readonly"/>
                            </div>
                            <div id="Mobile">
                                <label>Mobile Tel#</label>
                                <input type="text" name="Mobile_no" id="Mobile_no" value="<?php echo $data['Cellphone']; ?>" readonly="readonly"/>
                            </div>
                            <div id="Mobile">
                                <label>Office Tel#</label>
                                <input type="text" name="Mobile_no" id="Mobile_no" value="<?php echo $data['OfficeNumber']; ?>" readonly="readonly"/>
                            </div>
                            <div id="Mobile">
                                <label>Fax</label>
                                <input type="text" name="Mobile_no" id="Mobile_no" value="<?php echo $data['Fax']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>Email</label>
                                <input type="email" name="email" value="<?php echo $data['Email']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>CNIC #</label>
                                <input type="text" name="CNIC_no" value="<?php echo $data['Cnic']; ?>" readonly="readonly"/>
                            </div>
                            <div>
                                <label>NTN #</label>
                                <input type="text" name="NTN_no" id="NTN_no" value="<?php echo $data['Ntn']; ?>" readonly="readonly"/>
                            </div>
                    </fieldset> 
                </form>
            </div>
        </div>
    </div>