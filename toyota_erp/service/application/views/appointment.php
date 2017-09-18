
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/admin_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form id="appointmentform" action="<?= base_url() ?>index.php/appointment/add" onSubmit="return validationform();" method="post" class="form validate-form animated fadeIn">
                <?= $Response ?>
                <fieldset>
                    <legend>Appointment Input</legend>

<!--                    <fieldset>-->
<!--                        <legend onclick="DoToggle('#PreferredReception')">Preferred Reception</legend>-->
<!--                        <div id="PreferredReception" class="feildwrap">-->
<!--                            <fieldset style="margin-left: 5px;width: 25px;">-->
<!--                                <div class="feildwrap" style="">-->
<!--                                    <div>                              -->
<!--                                        <div style="margin-left: -150px;">-->
<!--                                            <label>Date</label>-->
<!--                                            <input style="width: 130px" id="PreferredDate" type="text" name="PreferredDate" class='date' placeholder="Book in Date"  required>-->
<!--                                        </div>-->
<!--                                        <div style="margin-left: -150px;">-->
<!--                                            <label>Time</label>-->
<!--                                            <input style="width: 130px" Class="Time" id="PreferredTime" type="text" name="PreferredTime" data-time-format="H:i:s" placeholder="Book in Time" data-validation = "required">-->
<!--                                        </div>-->
<!--                                    </div><br>-->
<!--                                    <div style="margin-left: 0px;">-->
<!--                                        <span style="margin-left: 50px;">Customer Bring-In</span>-->
<!--                                        <input id="Yes" type="radio" name="isCDIn" value="1">-->
<!--                                        <span style="margin-left: 15px;">Dealer-Pick-up(Counresy Car#)</span>&nbsp;-->
<!--                                        <input id="No" type="radio" name="isCDIn" value="1">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </fieldset>-->
<!--                            <fieldset style="margin-left: 704px;margin-top: -130px;width: 160px;min-width: 100px;">-->
<!--                                <div style=" margin-top: 0px; margin-left: 5px; display: block !important; ">-->
<!--                                    <div style="">-->
<!--                                        <div>-->
<!--                                            <label style="margin-left: -108px;">Staff Name</label>-->
<!--                                            <!--<input id="PreferredStaff" type="text" name="PreferredStaff" placeholder="Staff Name" style="width: 125px;" data-validation = "">-->
<!--                                            <select name="PreferredStaff" id="PreferredStaff" style=" width: 152px; ">-->
<!--                                                <option>Select Staff</option>-->
<!--                                                --><?php
//                                                foreach ($staff as $AllStaff) {
//                                                    ?>
<!--                                                    <option value="--><?//= $AllStaff['idStaff'] ?><!--">--><?//= $AllStaff['Name'] ?><!--</option>-->
<!--                                                    --><?php
//                                                }
//                                                ?>
<!--                                            </select>-->
<!--                                        </div>                                -->
<!--                                        <div>-->
<!--                                            <label style="margin-left: -135px;">Dated</label>-->
<!--                                            <input style="width: 130px" id="PreferredStaffDate" type="text" name="PreferredStaffDate" class='date' placeholder="Book in Date"  required>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </fieldset>-->
<!--                        </div>                       -->
<!--                    </fieldset>                    -->

                    <div class="feildwrap" style="margin-left: 150px;">
                        <div>
                            <label>Follow Up Card</label>
                            <input id="FollowUpCard" type="text" name="FollowUpCard" placeholder="Enter FollowUp Card"
                                   data-validation="">
                        </div>
                        <div>
                            <label>Estimated Ref</label>
                            <input id="EstimatedRef" type="text" name="EstimatedRef"
                                   placeholder="Enter EstimatedRef" data-validation="">
                        </div>

                    </div><br>
                    <fieldset>
                        <legend onclick="DoToggle('#CustomerInfoDiv')">Customer Information</legend>
                        <div id="CustomerInfoDiv" class="feildwrap">
                            <div class="feildwrap" style="margin-left: 150px;">
                                <label>Existing Customer</label>
                                <input type="text" name="searchbyreg" id="searchbyreg" placeholder="Search by Vehicle Register Number">
                                <span id="regresult" name="RegResult" style="margin-left:05px;">New Customer</span>
                            </div>
                            <div>
                                <label>Company Name</label>
                                <input id="CompanyName" type="text" name="CompanyName" placeholder="Enter Company Name"  data-validation = "" >
                            </div>
                            <div>
                                <label>Company Contact No.</label>
                                <input id="CompanyContact" type="text" name="CompanyContact" placeholder="Enter Company Contact"  data-validation = "" >
                            </div><br>
                            <div>
                                <label>Customer Name</label>
                                <input id="CustomerName" type="text" name="CustomerName" placeholder="Enter Name"  data-validation = "required" >
                            </div>
                            <div>
                                <label>Tel</label>
                                <input Class="MobileNo" id="CustomerContact" type="text" name="CustomerContact" placeholder="Enter Contact Number" data-validation = "required">
                            </div>
                            <div>
                                <label>CNIC</label>
                                <input Class="CNIC" id="CustomerNIC" type="text" name="CustomerNIC" placeholder="Enter NIC"  data-validation = "">
                            </div>
                            <div>
                                <label>NTN</label>
                                <input Class="NTN" id="CustomerNTN" type="text" name="CustomerNTN" placeholder="Enter NTN"  data-validation = "">
                            </div>
                            <div>
                                <label>Address</label>
                                <textarea id="CustomerAddress" name="CustomerAddress" placeholder="Enter Address" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                            </div>
                            <div>

                                <label>Customer Waiting</label>
                                <select name="" id="" class="chosen-select">
                                    <option value="">No</option>
                                    <option value="">Yes</option>
                                </select>
                            </div>
                            <div>
                                <label>Fir</label>
                                <select name="" id="" class="chosen-select">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
<!--                    <fieldset>-->
<!--                        <legend onclick="DoToggle('#ConfirmDiv')">Confirmation</legend>-->
<!--                        <div id="ConfirmDiv" class="feildwrap" style="">-->
<!--                            <div>  -->
<!--                                <label>Confirmation</label>-->
<!--                                <div style="margin-left: -150px;">-->
<!--                                    <label>Date</label>-->
<!--                                    <input style="width: 130px" id="ConfirmDate" type="text" name="ConfirmDate" class='date' placeholder="Book in Date"  required>-->
<!--                                </div>-->
<!--                                <div style="margin-left: -150px;">-->
<!--                                    <label>Time</label>-->
<!--                                    <input style="width: 130px" Class="Timepicker" id="ConfirmTime" type="text" name="ConfirmTime" data-time-format="H:i:s" placeholder="Book in Time" data-validation = "required">-->
<!--                                </div>-->
<!--                                <div>-->
<!--                                    <label style="margin-left: -108px;">Staff Name</label>-->
<!--                                    <!--<input id="ConfirmStaff" type="text" name="ConfirmStaff" placeholder="Staff Name" style="width: 125px;" data-validation = "">-->
<!--                                    <select name="ConfirmStaff" id="ConfirmStaff" style=" width: 152px; ">-->
<!--                                        <option>Select Staff</option>-->
<!--                                        --><?php
//                                        foreach ($staff as $AllStaff) {
//                                            ?>
<!--                                            <option value="--><?//= $AllStaff['idStaff'] ?><!--">--><?//= $AllStaff['Name'] ?><!--</option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>  -->
<!--                            </div><br>-->
<!--                            <div>  -->
<!--                                <label>Parts Ordered</label>-->
<!--                                <div style="margin-left: -150px;">-->
<!--                                    <label>Date</label>-->
<!--                                    <input style="width: 130px" id="PartsOrderedDate" type="text" name="PartsOrderedDate" class='date' placeholder="Book in Date"  required>-->
<!--                                </div>-->
<!--                                <div style="margin-left: -150px;">-->
<!--                                    <label>Time</label>-->
<!--                                    <input style="width: 130px" Class="Timepicker" id="PartsOrderedTime" type="text" name="PartsOrderedTime" data-time-format="H:i:s" placeholder="Book in Time" data-validation = "required">-->
<!--                                </div>-->
<!--                                <div>-->
<!--                                    <label style="margin-left: -108px;">Staff Name</label>-->
<!--                                    <!--<input id="PartsOrderedStaff" type="text" name="PartsOrderedStaff" placeholder="Staff Name" style="width: 125px;" data-validation = "">-->
<!--                                    <select name="PartsOrderedStaff" id="PartsOrderedStaff" style=" width: 152px; ">-->
<!--                                        <option>Select Staff</option>-->
<!--                                        --><?php
//                                        foreach ($staff as $AllStaff) {
//                                            ?>
<!--                                            <option value="--><?//= $AllStaff['idStaff'] ?><!--">--><?//= $AllStaff['Name'] ?><!--</option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>  -->
<!--                            </div><br>-->
<!--                            <div>  -->
<!--                                <label>Parts Arrived</label>-->
<!--                                <div style="margin-left: -150px;">-->
<!--                                    <label>Date</label>-->
<!--                                    <input style="width: 130px" id="PartsArrivedDate" type="text" name="PartsArrivedDate" class='date' placeholder="Book in Date"  required>-->
<!--                                </div>-->
<!--                                <div style="margin-left: -150px;">-->
<!--                                    <label>Time</label>-->
<!--                                    <input style="width: 130px" Class="Timepicker" id="PartsArrivedTime" type="text" name="PartsArrivedTime" data-time-format="H:i:s" placeholder="Book in Time" data-validation = "required">-->
<!--                                </div>-->
<!--                                <div>-->
<!--                                    <label style="margin-left: -108px;">Staff Name</label>-->
<!--                                    <!--<input id="PartsArrivedStaff" type="text" name="PartsArrivedStaff" placeholder="Staff Name" style="width: 125px;" data-validation = "">-->
<!--                                    <select name="PartsArrivedStaff" id="PartsArrivedStaff" style=" width: 152px; ">-->
<!--                                        <option>Select Staff</option>-->
<!--                                        --><?php
//                                        foreach ($staff as $AllStaff) {
//                                            ?>
<!--                                            <option value="--><?//= $AllStaff['idStaff'] ?><!--">--><?//= $AllStaff['Name'] ?><!--</option>-->
<!--                                            --><?php
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                </div>  -->
<!--                            </div><br>-->
<!--                            <div>  -->
<!--                                <label>Preferred Delivery</label>-->
<!--                                <div style="margin-left: -150px;">-->
<!--                                    <label>Date</label>-->
<!--                                    <input style="width: 130px" id="PreferredDeliveryDate" type="text" name="PreferredDeliveryDate" class='date' placeholder="Book in Date"  required>-->
<!--                                </div>-->
<!--                                <div style="margin-left: -150px;">-->
<!--                                    <label>Time</label>-->
<!--                                    <input style="width: 130px" Class="Timepicker" id="PreferredDeliveryTime" type="text" name="PreferredDeliveryTime" data-time-format="H:i:s" placeholder="Book in Time" data-validation = "required">-->
<!--                                </div><br>-->
<!--                                <div style="margin-left: 250px;">-->
<!--                                    <span style="margin-left: 50px;">Customer Come-In</span>-->
<!--                                    <input id="Yes" type="radio" name="isCDOut" value="1">-->
<!--                                    <span style="margin-left: 15px;">Dealer-Delivery</span>&nbsp;-->
<!--                                    <input id="No" type="radio" name="isCDOut" value="1">-->
<!--                                </div> -->
<!--                            </div><br>-->
<!--                        </div>-->
<!--                    </fieldset>-->
                    <fieldset>
                        <legend onclick="DoToggle('#VehicleInfoDiv')">Vehicle Information</legend>
                        <div id="VehicleInfoDiv" class="feildwrap">
                            <div id="SelectBrandDiv">
                                <label>Select Brand</label>
                                <select id="SelectBrand" name="SelectBrand" onchange="getModels(this)" style="width: 120px">
                                    <option>Select Brand</option>
                                    <?php
                                    foreach ($brandsList as $key) {
                                        $idAllBrands = $brandsList['idAllBrands'];
                                        ?>
                                        <option value="<?= $key['idAllBrands'] ?>" ><?= $key['BrandName'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="SelectModelDiv">
                                <label>Select Model</label>
                                <select id="SelectModel" name="SelectModel" onclick="getAllVehicles(this)" style="width: 120px">
                                    <option>Select Model</option>                            
                                </select>
                            </div>
                            <div id="SelectMakeDiv">
                                <label>Select Make</label>
                                <select id="SelectMake" name="Make" style="width: 120px">
                                    <option>Select Make</option>
                                </select>
                            </div>
                            <div id="inputMakeDiv">
                                <label>Make</label>
                                <input id="inputMake" type="text" name="inputMake" placeholder="Enter Make" data-validation = "">
                            </div>
                            <div>
                                <label>Model No.</label>
                                <input id="Model" type="text" name="Model" placeholder="Enter Mdel"  data-validation = "" >
                            </div><br>
                            <div>
                                <label>Reg No.</label>
                                <input id="RegNumber" type="text" name="RegNumber" placeholder="Enter Registration Number"  data-validation = "required">
                            </div>
                            <div>
                                <label>KM</label>
                                <input id="KM" type="text" name="KM" placeholder="Enter KM">
                            </div><br>
                            <div>
                                <label>Frame No.</label>
                                <input id="FrameNumber" type="text" name="FrameNumber" placeholder="Enter Frame Number"  data-validation = "required">
                            </div>
                            <div>
                                <label>Engine No.</label>
                                <input id="EngineNumber" type="text" name="EngineNumber" placeholder="Enter Engine Number"  data-validation = "required">
                            </div>
                            <div>
                                <label>Model Code</label>
                                <input id="ModelCode" type="text" name="ModelCode" placeholder="Enter Model Code"  data-validation = "" >
                            </div>                      
                            <div>
                                <label>Est No.</label>
                                <input id="EstNum" type="text" name="EstNum" placeholder="Enter Est Number"  data-validation = "" >
                            </div>
                            <div>
                                <label>Year</label>
                                <input id="Year" type="text" name="Year" placeholder="Enter Year"  data-validation = "" >
                            </div>
                            <br>
                            <div>
                                <label>Previous Concern</label>
                                <input id="oreviousConcern" type="text" name="previousConcern" readonly  data-validation = "" >
                            </div>
                            <div>
                                <label>Additoinal Information</label>
                                <textarea id="AdditoinalInformation" name="additoinalInformation" placeholder="Enter Additoinal Information" style="margin: 0px; width: 724px; height: 100px;"></textarea>

                            </div>
                        </div>                    
                    </fieldset>

                    <fieldset>
                        <legend onclick="DoToggle('#JobInfoDiv')">Jobs Requested</legend>
                        <div id="JobInfoDiv" class="feildwrap">
                            <div id="MechanicalRepairDiv" class="feildwrap">
                                <select name="" id="job_sel" class="chosen-select" style="width: 450px">
                                    <option value="">Select Job</option>
                                <?php
                                $jobCounter = 0;
                                foreach ($mechanicalJobs as $key) {
                                        ?>
                                    <option value="<?= $jobCounter++ ?>">
                                        <?= $key['JobTask'] ?>
                                    </option>
                                <?php }
                                ?>
                                </select> <button type="button" onclick="addJob()" class="btn">+</button>
                            </div><br>

                            <table id="JobTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Job Task</th>
                                    <th>Voice of Customer</th>
                                    <th>Est Time</th>
                                    <th>Labor Cost</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="tblJobs">
                                </tbody>
                            </table>
                            <div id="estimateDiv" style="display: none;" class="popup">
                                <label for="">EstimateAmount</label>
                                <input type="text" name="EstimateAmount" id="EstimateAmount" style=" width: 50px;" value="0" readonly><span>&nbsp;Rs</span>
                            </div>

<!--                            <br>-->
<!--                            <div id="otherJobDiv" style=" width:100%;height: auto;">-->
<!--                                <span>Select Other GR Jobs</span>&nbsp;&nbsp;&nbsp;<input name="Jobs[]" onclick="addOtherJobs(this)" style=" width:15px;height:25px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodâ€¦EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" readonly><br><br><br>-->
<!--                            </div>-->
                        </div>                             
                    </fieldset>

                    <fieldset>
                        <legend onclick="DoToggle('#WorkPerformDiv')">Parts Stock Confirmation</legend>
                        <div id="WorkPerformDiv" class="feildwrap">
                            <div class="btn-block-wrap datagrid" style="margin-top: 05px;">
                                <table id="WorkTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Part Number</th>
                                            <th>Part Desc</th>
                                            <th>Qty</th>
                                            <th>Stock</th>
                                            <th>ETA</th>
                                            <th>X</th>
                                        </tr>
                                    </thead>                               
                                    <input name="newRow" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRow" value="+" readonly>
                                    <tbody id="tblParts">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>

<!--                    <fieldset style="">-->
<!--                        <legend onclick="DoToggle('#EstimateDiv')">Estimate</legend>-->
<!--                        <div id="EstimateDiv" class="feildwrap">-->
<!--                            <div>-->
<!--                                <label>Estimate</label>-->
<!--                                <input id="Labour" type="text" name="EstimateAmount" onchange="calculateNetTotal()" placeholder="Labour Amount" value="0.0"><span>&nbsp;Rs</span>-->
<!--                            </div><br>-->
<!--                            <div>-->
<!--                                <label>Parts</label>-->
<!--                                <input id="Parts" type="text" name="Parts" onchange="calculateNetTotal()" placeholder="Parts Amount" value=0.0><span>&nbsp;Rs</span>-->
<!--                            </div><br>-->
<!--                            <div>-->
<!--                                <label>Labour</label>-->
<!--                                <input id="Labour" type="text" name="LabourAmount" onchange="calculateNetTotal()" placeholder="Labour Amount" value="0.0"><span>&nbsp;Rs</span>-->
<!--                            </div><br>-->
<!--                            <div>-->
<!--                                <label>Total</label>-->
<!--                                <input id="GrandTotal" type="text" name="GrandTotal" placeholder="Grand Total" value=0.0 readonly><span>&nbsp;Rs</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="feildwrap">-->
<!--                            <label>Customer Request</label>-->
<!--                            <div style="margin-left: 15px;">-->
<!--                                <span style="margin-left: 50px;">Warranty</span>-->
<!--                                <input id="Yes" type="checkbox" name="isWarranty" value="1">-->
<!--                                <span style="margin-left: 15px;">Periodic Maintenance</span>&nbsp;-->
<!--                                <input id="No" type="checkbox" name="isPeriodicMaintenance" value="1">-->
<!--                                <span style="margin-left: 15px;">General Repair</span>&nbsp;-->
<!--                                <input id="No" type="checkbox" name="isGeneralRepair" value="1">-->
<!--                                <span style="margin-left: 15px;">Internal</span>&nbsp;-->
<!--                                <input id="No" type="checkbox" name="isInternal" value="1">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </fieldset>-->
                    <fieldset>
                        <legend onclick="DoToggle('#ConditionDiv')">5W1H</legend>
                        <div id="ConditionDiv" class="feildwrap" style="width: 95%;">
                            <?php
                            $i = 0;
                            foreach ($condConfirm as $key) {
                                ?>
<!--                                <br>-->
<!--                                <div style="margin-left: -90px;">-->

                                    <label for="ConditionDetail<?php echo $i; ?>"><?= $key['Name'] ?></label>
<!--                                </div>-->
                                <?php foreach ($key['ConditionDetail'] as $val) { ?>
                                    <input id="ConditionDetail<?php echo $i; ?>" name="ConditionDetail<?php echo $i; ?>" type="radio" value="<?= $val['idConditionDetail'] ?>"><?= $val['ConditionDetail'] ?>
                                    <?php
                                }
                                $i = $i + 1;
                            }
                            ?>
                        </div>
                    </fieldset>

                    <!--                    <fieldset>-->
<!--                        <legend onclick="DoToggle('#ConfirmationDiv')">Confirmation</legend>-->
<!--                        <div id="ConfirmationDiv" class="feildwrap" style="">-->
<!--                            <!--<label>Confirmation</label>-->
<!--                            <div style="margin-left: -150px;">-->
<!--                                <label>Date</label>-->
<!--                                <input style="width: 130px" id="PartsConfirmDate" type="text" name="PartsConfirmDate" class='date' placeholder="Book in Date"  required>-->
<!--                            </div>-->
<!--                            <div style="margin-left: -150px;">-->
<!--                                <label>Time</label>-->
<!--                                <input style="width: 130px" Class="Timepicker" id="PartsConfirmTime" type="text" name="PartsConfirmTime" data-time-format="H:i:s" placeholder="Book in Time" data-validation = "required">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <label style="margin-left: -108px;">Staff Name</label>-->
<!--                                <!--<input id="PartsConfirmStaff" type="text" name="PartsConfirmStaff" placeholder="Staff Name" style="width: 125px;" data-validation = "">-->
<!--                                <select name="PartsConfirmStaff" id="PartsConfirmStaff">-->
<!--                                    <option>Select Staff</option>-->
<!--                                    --><?php
//                                    foreach ($staff as $AllStaff) {
//                                        ?>
<!--                                        <option value="--><?//= $AllStaff['idStaff'] ?><!--">--><?//= $AllStaff['Name'] ?><!--</option>-->
<!--                                        --><?php
//                                    }
//                                    ?>
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </fieldset>-->
                    <!--                    <fieldset>
                                            <legend onclick="DoToggle('#LastServiceDiv')">Last Service</legend>
                                            <div id="LastServiceDiv" class="feildwrap" style="">
                                                <div style="margin-left: -150px;">
                                                    <label>Date</label>
                                                    <input style="width: 130px" id="BookDate" type="text" name="LastServiceDate" class='date' placeholder="Book in Date"  required>
                                                </div>
                                                <div>
                                                    <label style="margin-left: -108px;">RO#</label>
                                                    <input id="LastServiceRO" type="text" name="LastServiceRO" placeholder="RO" style="width: 125px;" data-validation = "">
                                                </div><br>  
                                                <div>
                                                    <label style="margin-left: -108px;">Odometer</label>
                                                    <input id="LastMileage" type="text" name="LastMileage" placeholder="Number" style="width: 125px;" data-validation = "">
                                                </div>
                                                <div>
                                                    <label style="margin-left: -108px;">JobType</label>
                                                    <input id="LastJobType" type="text" name="LastJobType" placeholder="Number" style="width: 125px;" data-validation = "">
                                                </div>
                                                <div>
                                                    <label style="margin-left: -108px;">History</label>
                                                    <textarea id="LastHistory" name="LastHistory" placeholder="Enter Address" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                                                </div>
                                                <div>
                                                    <label style="margin-left: -108px;">SSC/SC Info</label>
                                                    <textarea id="LastSSC" name="LastSSC" placeholder="Enter Address" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                                                </div>
                                            </div>
                                        </fieldset>-->
                    <fieldset>
                        <legend onclick="DoToggle('#AppointmentSheetDiv')">Appointment Time</legend>
                        <div id="AppointmentSheetDiv" class="feildwrap">
                            <div>
                                <div style="margin-left: -150px;">
                                    <label>Date</label>
                                    <input style="width: 130px;margin-left: 31px;" id="AppointmentDate" type="text" name="AppointmentDate" class='date' placeholder="Appointment Date"  required>
                                </div>
                                <div >
                                    <label>Color</label>
                                    <input style="width: 130px;margin-left: 31px;" id="color" type="color" value="#2424ff" name="color" class=''  required>
                                </div>
                                <br>
                                <div style="margin-left: -119px;">
                                    <label>Start Time</label>
                                    <!--<input style="width: 130px" id="StartTime" type="text" name="StartTime" data-time-format="H:i:s" placeholder="Start Time" data-validation = "required">-->
                                    <select name="StartTime">
                                        <option>Select Start Time</option>
                                        <option value="08:00">08:00</option>
                                        <option value="08:30">08:30</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                    </select>
                                </div>
                                <div style="">
                                    <label>End Time</label>
                                    <!--<input style="width: 130px" id="StartEnd" type="text" name="EndTime" data-time-format="H:i:s" placeholder="End Time" data-validation = "required">-->
                                    <select name="EndTime">
                                        <option>Select End Time</option>
                                        <option value="08:00">08:00</option>
                                        <option value="08:30">08:30</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                    </select>
                                </div>
                                <div style="margin-left: -119px;">
                                    <label>Bay</label>
                                    <!--<input style="width: 130px" id="StartTime" type="text" name="StartTime" data-time-format="H:i:s" placeholder="Start Time" data-validation = "required">-->
                                    <select name="idBay">
                                        <option>Select Bay</option>
                                        <?php
                                        foreach ($bay as $AllBays) {
                                            ?>
                                            <option value="<?= $AllBays['key'] ?>"><?= $AllBays['label'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                    <input type="submit" style="margin-left: 450px;" class="btn" >
                </fieldset> 
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#inputMakeDiv").hide();
        $("#regresult").hide();
        $("#InputOther").hide();
//        $(".warrantyCustomer").hide();
        $(".chosen-select").chosen();
        $('#BPaintDiv').hide();
        $('#isM').click(function () {
            $('#BPaintDiv').hide();
            $('#MechanicalDiv').show();
            $('#PMSelectDiv').show();

        });
        $('#isB').click(function () {
            $('#MechanicalDiv').hide();
            $('#PMSelectDiv').hide();
            $('#BPaintDiv').show();
        });
        $('#isPds').click(function () {
            $('#MechanicalDiv').hide();
            $('#PMSelectDiv').hide();
            $('#MechanicalDiv').hide();
            $('#PMSelectDiv').hide();
        });
        $('#ROMode').children().eq(0).attr("Checked", true);
        $('#MechanicalRepairDiv').children().eq(0).attr("Checked", true);

    });

    // For Work Performed Table
    var counter = 1;
    $("#newRow").click(function (e) {
        $("#newRow").val('-');
        PartsCounter = PartsCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-part'><select class='chosen-select' name='PartNumber[]' onchange='CheckPartStock(this)' style=' width: 180px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'><option>Select Part Number</option><?php
                                    foreach ($partsList as $AllPart) {
                                        ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartNumber'] ?></option><?php } ?></select><span class='error-staff cb-error help-block' style='display: none'>Option must be selected!</span></td>" +
                "<td class='tbl-price'><input type='text' name='PartsDescription[]' style='width: 202px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDescription' placeholder='Description'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsQuantity[]' style='width: 30px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsQuantity' placeholder='Qty'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsAmount[]' style='width: 50px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsAmount' placeholder='Amount'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsETA[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsSign' placeholder='Signature'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteWorkRow(this)'></td></tr>";
        "</tr>";
        $('#tblParts').append(items);
        $("select[name='PartNumber[]']").chosen({no_results_text: "Oops, nothing found!"});
    });
    // For Parts Table
    var PartsCounter = 1;
    $("#newRowParts").click(function (e) {
        $("#newRowParts").val('-');
        PartsCounter = PartsCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (PartsCounter - 1) + "</td><td class='tbl-price'><input type='date' name='PartsDate[]' style='width: 135px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDate' placeholder='Date' data-validation = 'required'></td><td class='tbl-price'><input type='text' name='PartsInvoiceNo[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsInvoiceNo' placeholder='Invoice'></td><td class='tbl-part'><select class='chosen-select' name='PartNumber[]' style=' width: 180px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'><option>Select Part Number</option><?php
                                    foreach ($partsList as $AllPart) {
                                        ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartNumber'] ?></option><?php } ?></select><span class='error-staff cb-error help-block' style='display: none'>Option must be selected!</span></td>" +
                "<td class='tbl-price'><input type='text' name='PartsQuantity[]' style='width: 30px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsQuantity' placeholder='Qty'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsDescription[]' style='width: 202px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDescription' placeholder='Description'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsAmount[]' style='width: 50px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsAmount' placeholder='Amount'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsSign[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsSign' placeholder='Signature'></td>" +
                "</tr>";
        $('#tblParts').append(items);
        $("select[name='PartNumber[]']").chosen({no_results_text: "Oops, nothing found!"});
    });


    function CheckPartStock(Source) {
        console.log($(Source).val());
        idPart = $(Source).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/appointment/CheckPartsStock",
            type: "POST",
            data: {idPart: idPart},
            success: function (data) {
                if (data == "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function (i, val) {
                            $(Source).closest('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').find('input').val("Out Of Stock").css("background-color", "Red");
                            $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val();
                        });
                    }
                }
                else {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function (i, val) {
                            $(Source).closest('td').next('td').find('input').val(val.Description);
                            $(Source).closest('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').find('input').val("In Stock").css("background-color", "Green");
                            $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val();
                        });
                    }
                }
            }
        });
    }

    // For Sublet Table
    var SubletCounter = 1;
//    var SubletTotal = 0;
    $("#newRowSublet").click(function (e) {
        $("#newRowSublet").val('-');
        SubletCounter = SubletCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (SubletCounter - 1) + "</td>" +
                "<td class='tbl-price'><input type='date' name='SubletDate[]' style='width: 135px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletQunatity[]' style='width: 30px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletQunatity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletRef[]' style='width: 231px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletRef' placeholder='Reference' data-validation = 'required'></td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'SubletDesc[]' style = 'width: 198px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'SubletDesc' placeholder = 'Description' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletAmount[]' onkeyup=calculateTotal() style='width: 50px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' class='ClassSubletAmount' id='SubletAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteSubletRow(this)'></td></tr>";
        $('#tblSublets').append(items);
    });
    // For Lubricants Table
    var LubsCounter = 1;
    $("#newRowLubricants").click(function (e) {
        $("#newRowLubricants").val('-');
        LubsCounter = LubsCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (LubsCounter - 1) + "</td>" +
                "<td class='tbl-price'><input type='date' name='LubDate[]' style='width: 135px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LubDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='LubQunatity[]' style='width: 30px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LubQunatity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'LubDesc[]' style = 'width: 482px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'LubDesc' placeholder = 'Description' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='LubAmount[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LubAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='LubSignature[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LubSignature' placeholder='Signature' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer ' type='button' value='X' onclick='deleteLubRow(this)'></td></tr>";
        $('#tblLubricants').append(items);
    });

    //Search Existing Customer
    $("#searchbyreg").keyup(function () {
        var search = $("#searchbyreg").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/repairorder/searchExistingCustomer",
            type: "POST", data: {searchbyreg: search},
            success: function (data) {

                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        $("#regresult").show();
                        $("#regresult").html("Customer is Already Registered");
                        $("#SelectBrandDiv").hide();
                        $("#SelectModelDiv").hide();
                        $("#SelectMakeDiv").hide();
                        $("#inputMakeDiv").show();
                        $('#CustomerName').val(parsedData[0]['CustomerName']);
                        $('#CustomerContact').val(parsedData[0]['Cellphone']);
                        $('#CustomerNIC').val(parsedData[0]['Cnic']);
                        $('#CustomerNTN').val(parsedData[0]['Ntn']);
                        $('#CustomerAddress').val(parsedData[0]['AddressDetails']);
                        $('#inputMake').val(parsedData[0]['idAllVehicles']);
                        $('#inputMake').val(parsedData[0]['Variant']);
                        $('#Model').val(parsedData[0]['Model']);
                        $('#RegNumber').val(parsedData[0]['RegistrationNumber']);
                        $('#KM').val(parsedData[0]['Mileage']);
                        $('#FrameNumber').val(parsedData[0]['ChassisNumber']);
                        $('#EngineNumber').val(parsedData[0]['EngineNumber']);
                        $('#ModelCode').val(parsedData[0]['ModelCode']);
                        $('#EstNum').val(parsedData[0]['EstNumber']);
                        $('#ModelYear').val(parsedData[0]['Year']);
                    }
                    else {

                        $('#regresult').show();
                        $("#regresult").html("Customer is Not Registered");
                    }
                }
            }
        });
    });

    function DoToggle(id) {
        $(id).toggle();
    }

    function hideFinanceInput(id) {

        if (($(id).is(":visible"))) {
            $(id).hide();
        }
    }

    function calculateNetTotal() {
        var labourAmount = $("#Labour").val();
//        var lubOilAmount = $("#LubOil").val();
//        var subletAmount = $("#SubletRepair").val();
        var partsAmount = $("#Parts").val();
//        var gst = $("#GST").val();
        var grandTotal = parseInt(isNull(labourAmount)) + parseInt(isNull(partsAmount));
//        var netTotal = (gst / 100) * (grandTotal);
        $('#GrandTotal').val(grandTotal);
//        $('#NetTotal').val(grandTotal + netTotal);
//        $('#NetTotal').val(grandTotal);
    }

    function isNull(value) {

        if (value == "") {
            return 0;
        } else {
            return value;
        }
    }

    function setDate(dateclass) {
        $(dateclass).datepicker({
            showOn: "button",
            buttonImage: '<?= base_url(); ?>assets/images/date.png',
            buttonImageOnly: true,
            showButtonPanel: true,
            dateFormat: "dd-mm-yy"
        });
    }

    function addOtherJobs(obj) {
        var rmvJobs = $(obj).val();
        var dropDown = [];
        if (rmvJobs != 'x') {
            dropDown = "<div id='SlctOtherJobs'><select class='otherJobs' id='SlctMechJobs' name='MechJob[]' multiple style='margin: 0px; width: 200px; height: 35px;'><option>Select PM Jobs</option>";
            $.ajax({
                url: "<?= base_url() ?>index.php/repairorder/getOtherJobs",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        $.each(data, function (index, name) {
                            dropDown += "<option value=" + name['idJobRef'] + ">" + name['JobTask'] + "</option>";
                        });
                        dropDown += "</select></div>";
                        $("#otherJobDiv").append(dropDown);
                        $(".otherJobs").chosen();
                    }
                    else {
                        console.log('elses');
                    }
                },
                error: function (data) {

                }
            });
            rmvJobs = $(obj).val('x');
        } else {
            $('#SlctOtherJobs').remove();
            rmvJobs = $(obj).val('+');
        }
    }

    function getModels(obj) {
        var brand = $(obj).val();
        $("#SelectModel").empty();
        if (brand !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/repairorder/getModel",
                type: "POST",
                data: {brand: brand},
                dataType: "json",
                success: function (data) {
                    console.log('data');
                    console.log(data);
                    $("#SelectModel").append($("<option id=''>Select Model</option>"));
                    if (data.length > 0) {
                        $.each(data, function (index, name) {
                            $("#SelectModel").append($("<option id=''></option>").val(name['idAllModels']).html(name['ModelName']));
                        });
                    }
                    else {
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    }

    function getAllVehicles(obj) {
        var model = $(obj).val();
        $("#SelectMake").empty();
        if (model !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/repairorder/getAllVehicles",
                type: "POST",
                data: {model: model},
                dataType: "json",
                success: function (data) {
                    console.log('data');
                    console.log(data);
                    $("#SelectMake").append($("<option id=''>Select Make</option>"));
                    if (data.length > 0) {
                        $.each(data, function (index, name) {
                            $("#SelectMake").append($("<option id=''></option>").val(name['idAllVehicles']).html(name['Variant']));
                        });
                    }
                    else {
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    }

    function deleteWorkRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('WorkTable').deleteRow(i);
    }

    function deleteSubletRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('SubletTable').deleteRow(i);
    }

    function deleteLubRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('LubTable').deleteRow(i);
    }

    function filterPMJobs(obj) {
        var pmJob = $(obj).val();
        $("#PMJobsDiv").empty();
        if (pmJob !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/repairorder/getPMJobs",
                type: "POST",
                data: {pm: pmJob},
                dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        $.each(data, function (index, name) {
                            $("#PMJobsDiv").append('&nbsp;&nbsp;&nbsp;<input name="PmJobs[]" type="checkbox" value=' + name["idJobRef"] + ' checked/> ' + name['JobTask']);
                        });
                    }
                    else {
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    }

    function calEstLabour(obj) {
        var pmArray = [];
        var otherGrArr = [];
        var grArr = [];
        var bodyPaintArr = [];
        var estAmount = 0;
        var range = $(obj).val();
        $("#MechanicalRepairDiv").find("input:checked").each(function () {
            grArr.push($(this).val());
        });
        $("#PMJobsDiv").find("input:checked").each(function () {
            pmArray.push($(this).val());
        });
        $("#SlctMechJobs option:selected").each(function () {
            grArr.push($(this).val());
        });
        $("#SelectJob option:selected").each(function () {
            bodyPaintArr.push($(this).val());
        });

        $('#Labour').empty();
        if (grArr != "") {
            for (var val in grArr) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/repairorder/getRange",
                    type: "POST",
                    data: {range: range, idJob: grArr[val]},
                    success: function (data) {
                        if (data.length > 0) {
                            estAmount += parseInt(data);
                            $('#Labour').val(estAmount);
                        } else {
                        }
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            }
        }
        if (otherGrArr != "") {
            for (var val in otherGrArr) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/repairorder/getRange",
                    type: "POST",
                    data: {range: range, idJob: otherGrArr[val]},
                    success: function (data) {
                        if (data.length > 0) {
                            estAmount += parseInt(data);
                            $('#Labour').val(estAmount);
                        } else {
                        }
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            }
        }
        if (pmArray != "") {
            for (var val in pmArray) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/repairorder/getRange",
                    type: "POST",
                    data: {range: range, idJob: pmArray[val]},
                    success: function (data) {
                        if (data.length > 0) {
                            estAmount += parseInt(data);
                            $('#Labour').val(estAmount);
                        } else {
                        }
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            }
        }
        if (bodyPaintArr != "") {
            for (var val in bodyPaintArr) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/repairorder/getRange",
                    type: "POST",
                    data: {range: range, idJob: bodyPaintArr[val]},
                    success: function (data) {
                        if (data.length > 0) {
                            estAmount += parseInt(data);
                            $('#Labour').val(estAmount);
                        } else {
                        }
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            }
        }
    }

    function checkROMode(obj) {

        var tagName = $(obj).attr('tag');
        if (tagName == 'GR') {
            $('#BPaintDiv').hide();
            $('#MechanicalDiv').show();
            $('#PMSelectDiv').show();
        } else {
            if (tagName == 'BodyPaint') {
                $('#MechanicalDiv').hide();
                $('#PMSelectDiv').hide();
                $('#BPaintDiv').show();
            } else {
                if (tagName == 'PDS') {
                    $('#MechanicalDiv').hide();
                    $('#PMSelectDiv').hide();
                    $('#BPaintDiv').hide();
                }
            }
        }
    }

    function validationform() {

        var conditions = [];
        $('#ConditionDiv').find(':radio:checked').each(function () {
            conditions.push($(this).val());
        });
        $('#ConditionDiv').append("<input type='text' name='ConditionDetail' value='" + JSON.stringify(conditions) + "'>");

        var staffSlct = $('#idStaff').val();
        if (staffSlct === "Select Service Advisor")
        {
            $(".error-staff").show();
            return false;
        } else {
            $(".error-staff").hide();
            return true;
        }
    }

//        var foremanSlct = $('#Foreman').val();
//        if (staffSlct === "Select Technician" && foremanSlct === "Select Foreman")
//        {
//            $(".error-staff").show();
//            $(".error-foreman").show();
//            return false;
//        } else {
//            if (staffSlct === "Select Technician" || foremanSlct === "Select Foreman")
//            {
//                if (staffSlct === "Select Technician") {
//                    $(".error-staff").show();
//                } else {
//                    $(".error-staff").hide();
//                }
//
//                if (foremanSlct === "Select Foreman") {
//                    $(".error-foreman").show();
//                } else {
//                    $(".error-foreman").hide();
//                }
//                return false;
//            }
//            return true;
//        }


//    function fillArr(obj, type) {
//
//        if (type === 'checkboxes') {
//            var isChecked = $(obj).is(':checked');
//            if (isChecked) {
//                tempArr.push($(obj).val());
//            } else {
//                tempArr.pop($(obj).val());
//            }
//        } else {
//            if (type == 'slct') {
//                tempOtherArr = $(obj).val();
//            }
//        }
//    }

    var Jobs = <?= json_encode($mechanicalJobs,true);?>;
    function addJob()
    {
        console.log($('#job_sel').val())
        index = $('#job_sel').val()
        if(index=='')
        {
            alert('Please Select Job')
            return
        }

        $('#estimateDiv').show()

        $('#job_sel option:selected').removeAttr('selected');
        $('#job_sel').trigger('chosen:updated');

        var items = "";
        items +='<tr>' +
            '<td>'+Jobs[index].JobTask+' <input type="hidden" name="Jobs[]" value="'+Jobs[index].idJobRef+'"></td>' +
            '<td><input type="text" placeholder="Enter Customer Voice" name="customerVoice[]"></td>' +
            '<td>'+Jobs[index].TimeTaken+'</td>' +
            '<td><input type="number" min="0" class="laborCost" name="laborCost[]" onchange="calculateEstimate()" value="'+Jobs[index].RangeOneAmount+'"></td>'+
            '<td><input type="button" class="btn" value="X" onclick="$(this).parent().parent().remove();calculateEstimate()" ></td>'+
            '</tr>'
            $('#tblJobs').append(items);
        calculateEstimate();


    }

    function calculateEstimate()
    {
        var total = 0
        $('.laborCost').each(function(i,v){
            total += (v.value * 1)
        })
        $("#EstimateAmount").val(total)

    }
</script>
