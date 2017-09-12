<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/ro_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form id="repairorderform" action="" onSubmit="" method="post" class="form validate-form animated fadeIn" style="display:none;">
                <fieldset>
                    <legend onclick="DoToggle('#RepairOrderDiv')">RO-Information</legend>         
                    <fieldset>
                        <legend>RO-Modes</legend><br>
                        <div id="ROMode" class="feildwrap" style="margin-left: 05px;font-weight: bolder;font-size: 13px;">

                            <?php
                            foreach ($ROMode as $key) {
                                ?>
                                <input onclick="" tag='<?= $key['ModeName'] ?>' type="radio" name="isM" value="<?= $key['idROMode'] ?>" style="margin-left: 15px;"><?= $key['ModeName'] ?>                                
                                <?php
                            }
                            ?>
                            <input id="roModeType" name="roModeType" type="text" value="GR" style="margin-left: 15px;display: none;">                               
                        </div><br>
                        <div id="BPTypeDiv" style="margin-left: 350px;" class="feildwrap">
                            <input id="BPInsuarance" name="BPType" type="radio">
                            <span id="BPInsuaranceName">Insurance</span>
                            <input id="BPCash" name="BPType" type="radio"> 
                            <span id="BPCashName">Cash</span>
                        </div><br>
                        <div id="SearchEstimateDiv" style="margin-left: 0px;display: none" class="feildwrap">
                            <label>Search By Estimate-No.</label>
                            <input id="EstimateNumber" name="EstimateNumber" type="text" onfocusout="searchByEstimateNo(this)" placeholder="Search by Estimate Number" style="width:175px;">
                            <span id="EstResult" name="EstResult" style="margin-left:05px;font-weight: bolder;font-size: 14px;"></span>
                        </div><br>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend onclick="">Initial-Information</legend>
                        <div id="RepairOrderDiv" class="feildwrap">                    
                            <div style=" margin-bottom: 0px; display: block !important; ">
                                <div style=" margin-bottom: 0px; display: none !important;">
                                    <label>Cash Memo No.</label>
                                    <input id="CashMemo" type="text" name="CashMemo" placeholder="Cash Memo Number" data-validation = "">
                                </div>
                                <div style=" margin-bottom: 0px; display: none !important;">
                                    <label>Credit Memo No.</label>
                                    <input id="CreditMemo" type="text" name="CreditMemo" placeholder="Credit Memo Number" data-validation = "">
                                </div><br>
                                <div style="margin-left:-100px;margin-bottom: 0px; display: block !important;">
                                    <label>Fuel</label>
                                    <?php foreach ($fuelVolume as $key) { ?>
                                        <div style=""><input id="FuelVolume" type="radio" name="FuelVolume" value="<?= $key['idFuel'] ?>" checked><span><?= $key['FuelVolume'] ?></span></div>
                                    <?php }
                                    ?>
                                </div><br>
                                <div style="margin-left:-100px;margin-bottom: 0px; display: block !important;">
                                    <label>CNG</label>
                                    <?php foreach ($gasVolume as $key) { ?>
                                        <div style=""><input id="CNGVolume" type="radio" name="CNGVolume" value="<?= $key['idGas'] ?>" checked><span><?= $key['GasVolume'] ?></span></div>
                                    <?php }
                                    ?>
                                </div><br>
                                <div style="margin-left:-100px;margin-bottom: 0px; display: block !important;">
                                    <label>LPG</label>
                                    <?php foreach ($gasVolume as $key) { ?>
                                        <div style=""><input id="LPGVolume" type="radio" name="LPGVolume" value="<?= $key['idGas'] ?>" checked><span><?= $key['GasVolume'] ?></span></div>
                                    <?php }
                                    ?>
                                </div><br>
                                <div style="margin-left:-100px;margin-left:0px;margin-bottom: 0px; display: block !important;">
                                    <label>F I R</label>                                
                                    <input id="FIR" type="radio" name="isFIR" value="1" checked>F I R
                                    <input id="NonFIR" type="radio" name="isFIR" value="0">Non - F I R
                                </div>
                            </div>
                            <div style="margin-top: -15%; margin-left: 33%; display: block !important; ">
                                <fieldset style="margin-left: 139px;margin-top: 0px;width: 28%;min-width: 100px;">
                                    <legend>Book In</legend>
                                    <div>
                                        <input style="width: 130px" id="BookDate" type="text" name="BookDate" class='date' placeholder="Book in Date"  data-validation = "required">
                                    </div>
                                    <div>
                                        <input style="width: 130px" Class="Timepicker" id="BookTime" type="text" name="BookTime" data-time-format="H:i:s" placeholder="Book in Time" data-validation = "required">
                                    </div>
                                </fieldset>
                            </div>
                            <div style="display: block !important;">
                                <fieldset style="margin-left: 75%;margin-top: -159px;width: 20%;min-width: 100px;">
                                    <legend>Est. Delivery</legend>
                                    <div>
                                        <input style="width: 130px" id="DeliveryDate" type="text" name="DeliveryDate" class='date'  placeholder="Est. Delivery Date"  data-validation = "required">
                                    </div>
                                    <div>
                                        <input style="width: 130px;" Class="Timepicker" id="DeliveryTime" type="text" name="DeliveryTime" data-time-format="H:i:s" placeholder="Est. Delivery Time" data-validation = "required">
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#CustomerInfoDiv')">Customer Information</legend>
                        <br><div id="CustomerInfoDiv" class="feildwrap">
                            <div class="feildwrap" style="margin-left: 0px;display: none;">
                                <label>Existing Customer</label>
                                <input type="text" name="searchbyreg" id="searchbyreg" placeholder="Search by Reg.Num / Frame-Num / Engine-Num / Est.Num / Model" style="width: 400px;">
                                <span id="regresult" name="RegResult" style="margin-left:05px;font-weight: bolder;font-size: 14px;">New Customer</span>
                            </div><br><br>
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
                                <label>Tel-1</label>
                                <input Class="MobileNo" id="CustomerContact" type="text" name="CustomerContact" placeholder="Enter Contact Number" data-validation = "required">
                            </div>
                            <div>
                                <label>Tel-2</label>
                                <input Class="MobileNo" id="PhoneOne" type="text" name="PhoneOne" placeholder="Enter Contact Number" data-validation = "">
                            </div>
                            <div>
                                <label>Tel-3</label>
                                <input Class="MobileNo" id="PhoneTwo" type="text" name="PhoneTwo" placeholder="Enter Contact Number" data-validation = "">
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
                                <textarea id="CustomerAddress" name="CustomerAddress" placeholder="Enter Address" style="margin: 0px; width: 515px; height: 100px;"></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#VehicleInfoDiv')">Vehicle Information</legend>
                        <div id="VehicleInfoDiv" class="feildwrap">
                            <div id="SelectBrandDiv">
                                <label>Select Brand</label>
                                <select id="SelectBrand" name="SelectBrand" onchange="getModels(this)">
                                    <option>Select Brand</option>
                                    <?php
                                    foreach ($brandsList as $key) {
                                        ?>
                                        <option value="<?= $key['idAllBrands'] ?>" ><?= $key['BrandName'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="SelectModelDiv">
                                <label>Select Model</label>
                                <select id="SelectModel" name="SelectModel" onchange="getAllVehicles(this)">
                                    <option>Select Model</option>                            
                                </select>
                            </div>
                            <div id="SelectMakeDiv">
                                <label>Select Make</label>
                                <select id="SelectMake" name="Make">
                                    <option>Select Make</option>
                                </select>
                            </div>
                            <div id="inputMakeDiv">
                                <label>Make</label>
                                <input id="inputMake" type="text" name="inputMake" placeholder="Enter Make" data-validation = "">
                            </div>
                            <div>
                                <label>Model No.</label>
                                <input id="Model" type="text" name="Model" placeholder="Enter Mdel"  data-validation = "" readonly>
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
                            <div style="display: none;">
                                <label>Model Code</label>
                                <input id="ModelCode" type="text" name="ModelCode" placeholder="Enter Model Code"  data-validation = "">
                            </div>                      
                            <div>
                                <label>id Estimate</label>
                                <input id="idEstimate" type="text" name="idEstimate" placeholder="id Estimate"  data-validation = "" >
                            </div>
                            <div>
                                <label>Est No.</label>
                                <input id="EstNum" type="text" name="EstNum" placeholder="Enter Est Number"  data-validation = "" >
                            </div>
                            <div>
                                <label>Mileage Bef. Road Test</label>
                                <input id="MBRT" type="number" min="0" name="MBRT" placeholder="Enter Mileage Before Test" style="width: 170px" data-validation = "">
                            </div>
                            <div>
                                <label>Mileage Aft. Road Test</label>
                                <input id="MART" type="number" name="MART" min="0" placeholder="Enter Mileage After Test" style="width: 170px"  data-validation = "" >
                            </div>
                            <div>
                                <label>Year</label>
                                <input id="Year" type="text" name="Year" placeholder="Enter Year"  data-validation = "" >
                            </div>
                        </div>                    
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#FinancialInfoDiv')">Customer Type Information</legend>
                        <div id="FinancialInfoDiv" class="feildwrap"> 
                            <div>
                                <?php
                                $financeCounter = 0;
                                foreach ($financeInfoList as $key) {
                                    $financeCounter = $financeCounter + 1;
                                    if ($key['Name'] === 'Others' || $key['Name'] === 'Other') {
                                        ?>
                                        <div style="margin-left: 50px;"><input id="FinanceList" name="FinanceList" type="radio" onclick="DoToggle('#InputOther')" value="<?= $key['idFinance'] ?>"  checked><?= $key['Name'] ?><input id="InputOther" type="text" name="InputOther" placeholder="Write Other Financials" style="margin-left: 20px;"></div>
                                    <?php } else {
                                        ?>
                                        <div style="margin-left: 50px"><input id="FinanceList" name="FinanceList" type="radio" onclick="hideFinanceInput('#InputOther')" value="<?= $key['idFinance'] ?>" checked><?= $key['Name'] ?></div>
                                        <?php
                                    }
                                }
                                ?>
                            </div><br><br>
                            <div>
                                <label>Reference Number</label>
                                <input id="FinanceRefNo" type="text" name="FinanceRefNo" placeholder="Enter Reference Number"  data-validation = "">
                            </div> 
                            <div class="warrantyCustomer">
                                <label>Invoice Number</label>
                                <input id="InvoiceNum" type="text" name="InvoiceNum" placeholder="Enter Invoice Number"  data-validation = "">
                            </div><br>
                            <div class="warrantyCustomer">
                                <label>Invoice Date</label>
                                <input id="InvoiceDate" type="text" name="InvoiceDate" class='date' placeholder="Enter Invoice Date"  data-validation = "">
                            </div>
                            <div class="warrantyCustomer">
                                <label>Vehicle Delivery Date</label>
                                <input id="BPDeliveryDate" type="text" name="BPDeliveryDate" class='date' placeholder="Enter Delivery Date"  data-validation = "">
                            </div><br>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#JobInfoDiv')">Job Information</legend>
                        <div id="JobInfoDiv" class="feildwrap">
                            <div>
                                <label style="margin-left: -30px;">Job Request / VOC</label>
                                <textarea id="VOC" name="VOC" placeholder = "Write Voice of Customer" style="margin: 0px; width: 400px; height: 100px;"></textarea>
                            </div>
                            <div style="display: block !important;">
                                <fieldset style="margin-left: 72%;margin-top: -135px;width: 22%;min-width: 100px;">
                                    <legend>Work Order Attach</legend>
                                    <div>
                                        <span style="margin-left: 50px;">Yes</span>
                                        <input id="Yes" type="radio" name="isWorkOrder" value="1">
                                        <span style="margin-left: 15px;">No</span>&nbsp;
                                        <input id="No" type="radio" name="isWorkOrder" value="0" checked>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#ConditionDiv')">5W1H</legend>
                        <div id="ConditionDiv" class="feildwrap" style="width: 95%;"> 
                            <?php
                            $i = 0;
                            foreach ($condConfirm as $key) {
                                ?>
                                <br><div style="margin-left: -60px;"><label><b><?= $key['Name'] ?></b></label></div>
                                <?php
                                foreach ($key['ConditionDetail'] as $val) {
                                    if ($val['ConditionDetail'] === 'Others' || $val['ConditionDetail'] === 'Other') {
                                        ;
                                        ?>
                                        <div style=""><input id="ConditionDetail" name="ConditionDetail<?php echo $i; ?>" type="radio" value="<?= $val['idConditionDetail'] ?>" onclick=""><?= $val['ConditionDetail'] ?><input id="InputOtherCondition" type="text" name="InputOtherCondition<?php echo $i; ?>" placeholder="Other" style="width:100px;margin-left: 20px;"></div>
                                    <?php } else {
                                        ?>
                                        <div><input id="ConditionDetail" name="ConditionDetail<?php echo $i; ?>" type="radio" value="<?= $val['idConditionDetail'] ?>" onclick=""><?= $val['ConditionDetail'] ?></div>
                                        <?php
                                    }
                                }
                                $i = $i + 1;
                            }
                            ?>
                        </div><br>                                 
                    </fieldset>                
                    <fieldset>
                        <legend onclick="DoToggle('#ThreeTasksDivs')">Mechanical / Body/Paint</legend>
                        <div id="ThreeTasksDivs" style=" width: 100%; height:auto;">
                            <div id="MechanicalDiv" class="feildwrap" style=" width: 200px; float: left;">
                                <fieldset style=" width: 195px; min-width: 150px; margin-left: 10px;">
                                    <legend>GR Jobs</legend>
                                    <div class="feildwrap">
                                        <div id="MechanicalRepairDiv">
                                            <select name="MechJob[]" class="MechJob" multiple style="width: 175px;">
                                                <option>Select Job(s)</option>
                                                <?php
                                                foreach ($mechanicalJobs as $key) {
                                                    ?>
                                                    <option value="<?= $key['idJobRef'] ?>" ><?= $key['JobTask'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <!--<span class="error-updatejrm cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>-->
                                        </div> 
                                        <div id="otherJobDiv" style=" width:100%;height: auto;">
                                            <span>Select Other GR Jobs</span>&nbsp;&nbsp;&nbsp;<input name="otherJob" onclick="addOtherJobs(this)" style=" width:15px;height:25px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodâ€¦EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" readonly><br><br><br>
                                        </div>
                                    </div>    
                                </fieldset>
                            </div>
                            <div id="PMSelectDiv" class="feildwrap" style="width: 500px; float: right;">
                                <fieldset id="bodypaintfield" style=" width:520px; min-width: 215px; margin-left: -50px; margin-top:13px;">
                                    <legend>PM Packages</legend>
                                    <div id="" class="feildwrap">
                                        <div>
                                            <label>PM Package</label>
                                            <select id="SelectPMPackage" name="SelectPMPackage" onchange="filterPMJobs(this)">
                                                <option>Select PM Packages</option>
                                                <?php
                                                foreach ($pmdList as $key) {
                                                    ?>
                                                    <option value="<?= $key['idPeriodicMaintenanceDetail'] ?>" ><?= $key['PeriodName'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div><br>
                                        <div id="PMJobsDiv" class="feildwrap">

                                        </div>                                
                                    </div>
                                    <div>
                                        <label>B/P Contu. RO Ref Number</label>
                                        <input id="BPRoRef" type="text" name="BPRoRef" placeholder="B/P RO Ref Number"  data-validation = "">
                                    </div><br>
                                </fieldset>
                            </div>                
                            <div id="BPaintDiv" class="feildwrap" style="margin-left:85px;width: 650px;">
                                <fieldset id="bodypaintfield" style=" width:650px; min-width: 215px; margin-left: -50px; margin-top:13px;">
                                    <legend>Body/Paint</legend>
                                    <div id="" class="feildwrap">
                                        <div>
                                            <label>Job Task</label>
                                            <select id="SelectJob" name="SelectJob[]" multiple class="chosen-select">
                                                <?php
                                                foreach ($bodyPaintJobs as $key) {
                                                    ?>
                                                    <option value="<?= $key['idJobRef'] ?>" ><?= $key['JobTask'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div><br>
                                        <div>
                                            <label>Color Code Applied</label>
                                            <input id="ColourCode" type="text" name="ColourCode" placeholder="Colour/Paint Code"  data-validation = "">
                                        </div><br>
                                        <div>
                                            <label>Insurance Company Code</label>
                                            <input id="InsuranceCode" type="text" name="InsuranceCode" placeholder="Insurance Company Code"  data-validation = "">
                                        </div><br>
                                        <div>
                                            <label>Surveyor</label>
                                            <input id="Surveyor" type="text" name="Surveyor" placeholder="Enter Surveyor Name"  data-validation = "">
                                        </div><br>                                  
                                        <div>
                                            <label>Mechanical RO Ref Number</label>
                                            <input id="MechRORef" type="text" name="MechRORef" placeholder="Mech. RO Ref Number"  data-validation = "">
                                        </div><br>                                                                    
                                    </div>
                                </fieldset>
                            </div>
                            <div id="SSCDiv" class="feildwrap">
                                <label>SSC Campaign</label>
                                <textarea id="SSC" name="SSC" placeholder="Enter SSC" style="margin: 0px; width: 400px; height: 100px;"></textarea>
                            </div>
                        </div>
                    </fieldset>                    
                    <fieldset>
                        <legend onclick="DoToggle('#TotalAmountDiv')">Check List</legend>
                        <div id="TotalAmountDiv" style="height:auto;">
                            <div class="feildwrap" style=" width: 217px; float: left;">
                                <fieldset style=" width: 17%; min-width: 215px; margin-left: 10px;">
                                    <legend>Check List</legend>
                                    <div id="CheckListDiv" class="feildwrap" style="float: left;"><br>
                                        <?php
                                        $Counter = 0;
                                        foreach ($checkList as $key) {
                                            $Counter = $Counter + 1;
                                            if ($Counter % 4 === 0) {
                                                ?>
                                                <br><br>
                                            <?php }
                                            ?>
                                            <div style="margin-left: 50px"><input id="CheckList<?php echo $Counter ?>" class="Clist" name="CheckList[]" type="checkbox" value="<?= $key['idROCheckList'] ?>" checked><?= $key['Name'] ?></div>
                                        <?php }
                                        ?>
                                    </div>
                                    <div id="">
                                        <label style="margin-left: -35px;">Tools Quantity</label>
                                        <input id="toolsQty" name="toolsQty" min='0' type="number" value="0" placeholder="Qty" style="width:50px;margin-left: 51px;">
                                    </div>
                                    <div>
                                        <label style="margin-left: -10px;">Is Org. Num-Plate ?</label><br>
                                        <input id="Yes" name="isOrignial" value="1" type="radio" data-validation = "required" style="margin-left: 55px;" checked>Yes
                                        <input id="No" name="isOrignial" value="0" type="radio" data-validation = "required">No
                                    </div><br>
                                    <br>
                                </fieldset>
                            </div>                           
                        </div>                                    
                    </fieldset>
                </fieldset>
            </form>
            <!--RO-Information Form -->
            <form class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>RO-Information</legend>
                    <br><label style="margin-left: 115px;"><?= $insertMessage ?></label><br><br>
                    <div id="InsertRODiv" class="feildwrap" style="margin-left: 200px;">
                        <label>Repair Order</label>
                        <input id="InsertRO" type="text" name="InsertRO" placeholder="Enter RO Number" style="width: 150px;">
                    </div><br>
                    <div id="ROModeDiv" class="feildwrap" style="margin-left: 297px;"></div>
                </fieldset>  
            </form>

            <!--RO-Detail Form for Mechanical RO-->
            <form id="RoDetailForm" action="<?= base_url() ?>index.php/rodetail/save" onSubmit="return validationform()" method="post" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend onclick="">RO-Detail</legend>  
                    <div class="feildwrap" style="display:none;">
                        <input id="IdInsertRO" type="text" name="IdInsertRO" placeholder="ID Insert RO" style="width: 150px;">
                        <input id="IsRepeatRO" type="text" name="IsRepeatRO" placeholder="Is Repeat RO" style="width: 150px;">
                        <input id="IdCustomer" type="text" name="IdCustomer" placeholder="Is Repeat RO" style="width: 150px;">
                        <input id="ROModeName" type="text" name="ROModeName" placeholder="Is Repeat RO" style="width: 150px;">
                    </div><br>
                    <fieldset>
                        <legend onclick="DoToggle('#WorkPerformDiv')">Work Perform</legend>
                        <div id="WorkPerformDiv" class="feildwrap">
                            <div class="btn-block-wrap datagrid" style="margin-top: 05px;overflow-x: scroll;overflow-y: scroll;">
                                <table id="WorkTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Work to be performed</th>
                                            <th>Hrs</th>
                                            <th>Amount</th>
                                            <th>X</th>
                                        </tr>
                                    </thead>                               
                                    <input name="newRowWorkPerformed" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRowWorkPerformed" value="+" readonly>
                                    <tbody id="tblworkperformed">
									
									 <tr>
                                        <td></td>
                                        <td></td>
										<td></td>
                                        <td></td>
                                        <td><button id="TotalLabourAmount" type="button" class="btn btn-block-wrap" style="margin-left: -42px;width:75px;">OK</button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>                           
                        </div>
                    </fieldset>
                    <fieldset style="">
                        <legend onclick="DoToggle('#PartsDiv')">Parts</legend>
                        <div id="PartsStatus" class="feildwrap" style="margin-left: 240px;">
                        </div>
                        <div id="PartsDiv" class="feildwrap">
                            <div id="" class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                <table id="PartsTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Inv.No</th>
                                            <th>Part No.</th>
                                            <th>Quantity</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Signature</th>
                                            <th>X</th>
                                        </tr>
                                    </thead> 
                                    <input name="newRowParts" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRowParts" value="+" readonly>
                                    <tbody id="tblParts">
									  <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
										<td></td>
                                        <td></td>
                                        <td><button id="TotalParstsAmount" type="button" class="btn btn-block-wrap" style="margin-left: -42px;width:75px;">OK</button></td>
                                    </tr>
									
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#ConsumableDiv')">Consumables / Sublet Repair</legend>
                        <div id="ConsumableDiv" class="feildwrap">
                            <div id="" class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                <table id="SubletTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Reference</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>X</th>
                                        </tr>
                                    </thead> 
                                    <input name="newRowSublet" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRowSublet" value="+" readonly>
                                    <tbody id="tblSublets">
                                    </tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><button id="TotalSubletAmount" type="button" class="btn btn-block-wrap" style="margin-left: -42px;width:75px;">OK</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset style="display: none;">
                        <legend onclick="DoToggle('#LubDiv')">Lub Oil</legend>
                        <div id="LubDiv" class="feildwrap">
                            <div id="" class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                <table id="LubTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Signature</th>
                                            <th>X</th>
                                        </tr>
                                    </thead>   
                                    <input name="newRowLubricants" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRowLubricants" value="+" readonly>
                                    <tbody id="tblLubricants">
									
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Total Amount</legend>
                        <div class="feildwrap" style="width: 650px;margin-left: 0px;">
                            <div class="feildwrap">
                                <div style="visibility: hidden;">
                                    <div style="margin-left: 140px;">
                                        Range-1:
                                        <input id="r1" type="radio" name="RangeAmount" value="1" onclick="calEstLabour(this)">  
                                    </div>
                                    <div style="margin-left: 60px;">
                                        Range-2:
                                        <input id="r2" type="radio" name="RangeAmount" value="2" onclick="calEstLabour(this)">
                                    </div>
                                    <div style="margin-left: 60px;">
                                        Range-3:
                                        <input id="r3" type="radio" name="RangeAmount" value="3" onclick="calEstLabour(this)">
                                    </div>                                       
                                </div><br>
                                <div id="GSTDiv">
                                    <label>G.S.T Value</label>                                    
                                    <input id="GST" type="text" name="GST" value="16" placeholder="GST"><span>&nbsp;%</span>
                                </div>
                                <div>
                                    <label>Labour</label>
                                    <input id="Labour" type="text" name="Labour" onchange="" placeholder="Labour Amount" value="0.0"><span>&nbsp;Rs</span>
                                    <input id="ApplyGSTLabour" name="ApplyGSTLabour" type="checkbox" value="1" checked style="margin-left: 10px;">Apply G.S.T
                                </div><br>
                                <div id="SSTDiv">
                                    <label>S.S.T Value</label>
                                    <input id="SST" type="text" name="SST" value="16" placeholder="S.S.T"><span>&nbsp;%</span>
                                </div><br>
                               <!-- <div>
                                    <label>Lub Oil</label>
                                    <input id="LubOil" type="text" name="LubOil" onchange="" placeholder="Lub Oil Amount" value=0.0><span>&nbsp;Rs</span>
                                    <input id="ApplySSTLub" name="ApplySSTLub" type="checkbox" value="1" checked style="margin-left: 10px;"> Apply S.S.T
                                </div><br>
								-->
								<input id="LubOil" type="hidden" name="LubOil" onchange="" placeholder="Lub Oil Amount" value=0.0>
                                <input id="ApplySSTLub" name="ApplySSTLub" type="checkbox" value="1" style="display:none;">
								<div>
                                    <label>Sublet Repair</label>
                                    <input id="SubletRepair" type="text" name="SubletRepair" onchange="" placeholder="Sublet Repair Amount" value=0.0><span>&nbsp;Rs</span>
                                    <input id="ApplySSTSublet" name="ApplySSTSublet" type="checkbox" value="1" checked style="margin-left: 10px;"> Apply S.S.T
                                </div><br>
                                <div>
                                    <label>Parts</label>
                                    <input id="Parts" type="text" name="Parts" onchange="" placeholder="Parts Amount" value=0.0><span>&nbsp;Rs</span>
                                    <input id="ApplySSTParts" name="ApplySSTParts" type="checkbox" value="1" checked style="margin-left: 10px;"> Apply S.S.T
                                </div>
                                <div id="LabourRsDiv" style="display: none;">
                                    <label>Est. Approved Labour</label>
                                    <input id="LabourRs" type="text" name="LabourRs" value="0.0" onchange="" placeholder="Enter Labour Rs"  data-validation = ""><span>&nbsp;Rs</span>
                                </div><br>
								<div>
                                    <label>Est. Depreciation %</label>
                                    <input id="DepAmountPercent" type="text" name="DepAmountPercent" value="0.0" onchange="" placeholder="Enter Dep. Amount"  data-validation = ""><span>&nbsp;%</span>
                                </div><br>
                                <div id="DepAmountRsDiv">
                                    <label>Est. Depreciation Amount</label>
                                    <input id="DepAmountRs" type="text" name="DepAmountRs" value="0.0" onchange="" placeholder="Enter Dep. Amount"  data-validation = ""><span>&nbsp;Rs</span>
                                </div><br>
                                <div>
                                    <label>VEOD %</label>
                                    <input id="VEOD_Percent" type="text" name="VEOD_Percent" value="0.0" onchange="" placeholder="Enter VEOD %" data-val-idation = ""><span>&nbsp;%</span>
                                </div><br>								
                                <div>
                                    <label>VEOD</label>
                                    <input id="VEOD" type="text" name="VEOD" value="0.0" onchange="" placeholder="Enter VEOD" data-val-idation = ""><span>&nbsp;Rs</span>
                                </div><br><br>
                                <div>
                                    <label>VEOD 2 %</label>
                                    <input id="VEOD2_Percent" type="text" name="VEOD2_Percent" value="0.0" onchange="" placeholder="Enter VEOD 2" data-val-idation = ""><span>&nbsp;%</span>
                                </div><br>								
								<div>
                                    <label>VEOD 2</label>
                                    <input id="VEOD2" type="text" name="VEOD2" value="0.0" onchange="" placeholder="Enter VEOD 2" data-val-idation = ""><span>&nbsp;Rs</span>
                                </div><br><br>   
                                <div>
                                    <input id="OKButton" name="OKButton" type="button" value="Done" class="btn" onclick="calculateAllAmounts()" style="width:125px;margin-left: 275px;">
                                </div><br><br>    
                                <div style="display: none;">
                                    <label>Grand Total</label>
                                    <input id="GrandTotal" type="text" name="GrandTotal" placeholder="Grand Total" value=0.0 readonly><span>&nbsp;Rs</span>
                                </div><br>                               
                                <div>
                                    <label>Net Total</label>
                                    <input id="NetTotal" type="text" name="NetTotal" placeholder="Net Total" value=0.0 readonly><span>&nbsp;Rs</span>
                                </div><br>          
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Save</legend>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <label>&nbsp;</label><br>
                            <input type="submit" class="btn" value="Save" style="margin-left: 400px;width: 180px;">
                        </div>
                    </fieldset>
                </fieldset>
            </form>

            <!--RO-Detail Form for Body-Paint RO-->
            <form id="RoDetailFormBodyPaint" action="<?= base_url() ?>index.php/rodetail/saveBodyPaint" onSubmit="" method="post" class="form validate-form animated fadeIn" style="display: none;">
                <fieldset>
                    <legend onclick="">RO-Detail Body-Paint</legend> 
                    <div class="feildwrap" style="display:none;">
                        <input id="IdInsertROBP" type="text" name="IdInsertROBP" placeholder="ID Insert RO" style="width: 150px;">
                        <input id="IsRepeatROBP" type="text" name="IsRepeatROBP" placeholder="Is Repeat RO" style="width: 150px;">
                        <input id="IdCustomerBP" type="text" name="IdCustomerBP" placeholder="Is Repeat RO" style="width: 150px;">
                        <input id="ROModeNameBP" type="text" name="ROModeNameBP" placeholder="Is Repeat RO" style="width: 150px;">
                    </div><br>
                    <fieldset style="">
                        <legend onclick="DoToggle('#MaterialsDiv')">Material Usage</legend>
                        <div id="MaterialStatus" class="feildwrap" style="margin-left: 240px;">
                        </div>
                        <div id="MaterialsDiv" class="feildwrap">
                            <div id="" class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                <table id="MaterialsTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Qty</th>
                                            <th>Article</th>
                                            <th>Amount</th>
                                            <th>Remarks</th>
                                            <th>X</th>
                                        </tr>
                                    </thead> 
                                    <input id="newRowMaterial" name="newRowMaterial" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer" value="+" readonly>
                                    <tbody id="tblMaterial">
                                    </tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><button id="TotalMaterialAmount" type="button" class="btn btn-block-wrap" style="margin-left: -42px;width:75px;">OK</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#ConsumableDivBP')">Consumables / Sublet Repair</legend>
                        <div id="ConsumableDivBP" class="feildwrap">
                            <div id="" class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                <table id="SubletTableBP" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Reference</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>X</th>
                                        </tr>
                                    </thead> 
                                    <input name="newRowSubletBP" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRowSubletBP" value="+" readonly>
                                    <tbody id="tblSubletsBP">
                                    </tbody>                               
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Total Amount</legend>
                        <div class="feildwrap" style="width: 650px;margin-left: 0px;">
                            <div class="feildwrap">
                                <div id="GSTDiv">
                                    <label>G.S.T Value</label>                                    
                                    <input id="GSTBP" type="text" name="GSTBP" value="16" placeholder="GST"><span>&nbsp;%</span>
                                </div>
                                <div>
                                    <label>Material Cost</label>
                                    <input id="MaterialCost" type="text" name="MaterialCost" onchange="" placeholder="Material Cost" value="0.0"><span>&nbsp;Rs</span>
                                    <input id="ApplyGSTLabourBP" name="ApplyGSTLabourBP" type="checkbox" value="1" checked style="margin-left: 10px;">Apply G.S.T
                                </div><br>                          
                                <div>
                                    <label>Painter Labour</label>
                                    <input id="PainterLabour" type="text" name="PainterLabour" onchange="" placeholder="Material Cost" value="0.0"><span>&nbsp;Rs</span>
                                </div><br>
                                <div>
                                    <label>Denter Labour</label>
                                    <input id="DenterLabour" type="text" name="DenterLabour" onchange="" placeholder="Material Cost" value="0.0"><span>&nbsp;Rs</span>

                                </div><br>
                                <div>
                                    <label>Mech. /Elec. /A/C</label>
                                    <input id="TechnicianCost" type="text" name="TechnicianCost" onchange="" placeholder="Material Cost" value="0.0"><span>&nbsp;Rs</span>
                                </div><br>
                                <div>
                                    <label>Other Expenses</label>
                                    <input id="OtherExpences" type="text" name="OtherExpences" onchange="" placeholder="Material Cost" value="0.0"><span>&nbsp;Rs</span>
                                </div><br>
                                <div id="" style="">
                                    <label>Approved Labour</label>
                                    <input id="ApprovedLabour" type="text" name="ApprovedLabour" value="0.0" onchange="" placeholder="Enter Labour Rs"  data-validation = ""><span>&nbsp;Rs</span>
                                </div><br>
                                <div id="">
                                    <label>Depreciation Amount</label>
                                    <input id="DepreciationAmount" type="text" name="DepreciationAmount" value="0.0" onchange="" placeholder="Enter Dep. Amount"  data-validation = ""><span>&nbsp;Rs</span>
                                </div><br><br>                              
                                <div>
                                    <input id="OKButtonBP" name="OKButtonBP" type="button" value="Done" class="btn" onclick="calculateTotalCost()" style="width:125px;margin-left: 275px;">
                                </div><br><br>  
                                <div>
                                    <label>Total Cost</label>
                                    <input id="TotalCost" type="text" name="TotalCost" value="0.0" onchange="" placeholder="Enter VEOD" data-val-idation = ""><span>&nbsp;Rs</span>
                                </div><br><br>   
                                <div>
                                    <label>Net Total</label>
                                    <input id="NetTotalBP" type="text" name="NetTotalBP" placeholder="Net Total" value="0.0" ><span>&nbsp;Rs</span>
                                </div><br>          
                                <div>
                                    <label>Remarks</label>
                                    <textarea id="TotalCostDescription" name="TotalCostDescription" style="width: 400px;height: 50px;"></textarea>
                                </div><br>          
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Save</legend>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <label>&nbsp;</label><br>
                            <input type="submit" class="btn" value="Save" style="margin-left: 400px;width: 180px;">
                        </div>
                    </fieldset>
                </fieldset>
            </form><div id="test"></div>
        </div>
    </div>
</div>
<script>
    var rOMode = "";
    $(document).ready(function() {
        $("#inputMakeDiv").hide();
        $("#regresult").hide();
        $("#InputOther").hide();
        $(".chosen-select").chosen();
        $(".MechJob").chosen();
        $('#BPTypeDiv').hide();
        //        $(".warrantyCustomer").hide();

        //        $('#BPaintDiv').hide();
        //        $('#isM').click(function() {
        //            $('#BPaintDiv').hide();
        //            $('#MechanicalDiv').show();
        //            $('#PMSelectDiv').show();
        //
        //        });
        //        $('#isB').click(function() {
        //            $('#MechanicalDiv').hide();
        //            $('#PMSelectDiv').hide();
        //            $('#BPaintDiv').show();
        //        });
        //        $('#isPds').click(function() {
        //            $('#MechanicalDiv').hide();
        //            $('#PMSelectDiv').hide();
        //            $('#MechanicalDiv').hide();
        //            $('#PMSelectDiv').hide();
        //        });
        //	$('#ROMode').children().eq(1).attr("Checked", true);
        //     $('#MechanicalRepairDiv').children().eq(0).attr("Checked", true);

        $('#ROMode').children().eq(0).click();
        $('#MechanicalRepairDiv').children().eq(0).attr("Checked", true);
        rOMode = "Mechanincal";
    });
//   All RO-Detail Functions
    $("#InsertRO").focusout(function() {
        var search = $("#InsertRO").val();
        if (search != "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/rodetail/getRODetail",
                type: "POST",
                data: {searchRONumber: search},
                success: function(data) {
                    $("#test").html(JSON.stringify(data));
                    if (data !== "null")
                    {
					    console.log(data);//return;
                        var result = JSON.parse(data);
						var parsedData = result['other'];
						var partsdata = result['parts'];
						console.log(result);
						//return;
                        var totalPartsAmount = 0;
                        var roModes = "";
						if (partsdata && partsdata.length > 0) {
							for(ip=0;ip<partsdata.length;ip++){
								
						var valueee = 	partsdata[ip]['CreatedDate'].split(" ")
							  
        var items = "";
        if(partsdata[ip]['manual']!=""){var mm=partsdata[ip]['manual'];}else{var mm=partsdata[ip]['PartAmount']}
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (ip+1) + "</td>\n\
                <td class='tbl-price'><input type='date' value='"+valueee[0]+"' name='PartsDate[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDate' placeholder='Date' data-validation = 'required'></td><td class='tbl-price'><input type='text' name='PartsInvoiceNo[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'  value='"+partsdata[ip]['invoice']+"' id='PartsInvoiceNo' placeholder='Invoice'></td><td class='tbl-part'><select class='chosen-select slctboxes' name='PartNumber["+ip+"]' onchange=getPart(this) style=' width: 200px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'><option>Select Part Name</option><?php
                                        foreach ($partsList as $AllPart) {
                                            ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartName'] ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left:50px;margin-top:-35px;display:none;'>Option must be Selected</span></td>" +
                "<td class='tbl-price'><input type='text' name='PartsQuantity[]' value='"+partsdata[ip]['PartQuantity']+"' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsQuantity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsDescription[]'  style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDescription' placeholder='Description'></td>" +             

                "<td class='tbl-price'><input type='text' name='PartsAmount[]' value='"+mm+"' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsAmount' placeholder='Amount' data-validation = 'required'></td>" +
             "<td class='tbl-price'><input type='text' value='"+partsdata[ip]['signature']+"' name='PartsSign[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsSign' placeholder='Signature'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deletePartRow(this)'></td></tr>";
        "</tr>";
        $('#tblParts').append(items);
        $("select[name='PartNumber["+ip+"]']").chosen({no_results_text: "Oops, nothing found!"});
		$("select[name='PartNumber["+ip+"]']").val(partsdata[ip]['idPart']);
		$("select[name='PartNumber["+ip+"]']").trigger('chosen:updated');
		
					}		
						}
						
                        if (parsedData.length > 0) {
							console.log(parsedData[0]['WorkPerformed']);
							$("#Labour").val(parsedData[0]['Labour']);
							//$("#Parts").val(parsedData[0]['PartsAmount']);
							if(parsedData[0]['WorkPerformed'] != "None"){
								 var str = parsedData[0]['WorkPerformed'];
								 var str2 = parsedData[0]['WorkPerformedAmount'];
								 var str3 = parsedData[0]['WorkPerformedHrs'];
								 var res = str.split(",");
								 var res2 = str2.split(",");
								 var res3 = str3.split(",");
								 var ccounter = 1; 
								 var iitems = "";
								 for(i=0;i<res.length;i++){
									    ccounter = ccounter + 1;
     
        iitems +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (ccounter - 1) + "</td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'WorkPerformed[]'  value ='"+res[i]+"' style = 'width: 500px;background: #fff; border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'WorkPerformed' placeholder = 'Work to be Performed' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' value ='"+res3[i]+"' name='WorkPerformedHrs[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedHrs' placeholder='Hrs' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text'  value ='"+res2[i]+"' name='WorkPerformedAmount[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteWorkRow(this)'></td></tr>";
        
								 }
								 $('#tblworkperformed').append(iitems);
								
							}else{
								if(parsedData[0]['is_PM'] == 1){
										 var ccounter = 1; 
								//var resultx = parsedData[0]['Jobs']
								 var iitems = "";
								// for(i=0;i<resultx.length;i++){
									    ccounter = ccounter + 1;
     
        iitems +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (ccounter - 1) + "</td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'WorkPerformed[]'  value ='"+parsedData[0]['PMPackage']+"' style = 'width: 500px;background: #fff; border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'WorkPerformed' placeholder = 'Work to be Performed' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' value ='' name='WorkPerformedHrs[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedHrs' placeholder='Hrs' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text'  value ='"+parsedData[0]['PM_amount']+"' name='WorkPerformedAmount[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteWorkRow(this)'></td></tr>";
        
								// }
								 $('#tblworkperformed').append(iitems);
									
									
								}else if (parsedData[0]['Jobs'].length > 0){
								
								 var ccounter = 1; 
								var resultx = parsedData[0]['Jobs']
								 var iitems = "";
								 for(i=0;i<resultx.length;i++){
									    ccounter = ccounter + 1;
     
        iitems +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (ccounter - 1) + "</td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'WorkPerformed[]'  value ='"+parsedData[0]['Jobs'][i]['JobTask']+"' style = 'width: 500px;background: #fff; border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'WorkPerformed' placeholder = 'Work to be Performed' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' value ='' name='WorkPerformedHrs[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedHrs' placeholder='Hrs' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text'  value ='"+parsedData[0]['Jobs'][i]['RangeAmount']+"' name='WorkPerformedAmount[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteWorkRow(this)'></td></tr>";
        
								 }
								 $('#tblworkperformed').append(iitems);
							}else if(parsedData[0]['PMPackage']){
											 var ccounter = 1; 
								//var resultx = parsedData[0]['Jobs']
								 var iitems = "";
								// for(i=0;i<resultx.length;i++){
									    ccounter = ccounter + 1;
     
        iitems +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (ccounter - 1) + "</td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'WorkPerformed[]'  value ='"+parsedData[0]['PMPackage']+"' style = 'width: 500px;background: #fff; border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'WorkPerformed' placeholder = 'Work to be Performed' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' value ='' name='WorkPerformedHrs[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedHrs' placeholder='Hrs' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text'  value ='"+parsedData[0]['ZPM_amountt']+"' name='WorkPerformedAmount[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteWorkRow(this)'></td></tr>";
        
								// }
								 $('#tblworkperformed').append(iitems);
								}
							}
                            roModes = parsedData[0]['ROMode'];
                            $('#InsertRO').val(parsedData[0]['RONumber']);
                            $('#ROModeDiv').html('<div style="width:500px;"><label style="font-weight: bolder;font-size:15px;"><span style="font-weight: bolder;font-size:17px;">RO-Mode :</span> ' + roModes + '</label></div>');
                            if (roModes == "BodyPaint") {
                               /* $('#RoDetailForm').hide();
                                $('#RoDetailFormBodyPaint').show();
                                $('#IdInsertROBP').val(parsedData[0]['idRO']);
                                $('#IsRepeatROBP').val(parsedData[0]['isRepeatRO']);
                                $('#IdCustomerBP').val(parsedData[0]['idCustomer']);
                                $('#ROModeNameBP').val(roModes);*/
								
								    $('#RoDetailFormBodyPaint').hide();
                                $('#RoDetailForm').show();
                                $('#IdInsertRO').val(parsedData[0]['idRO']);
                                $('#IsRepeatRO').val(parsedData[0]['isRepeatRO']);
                                $('#IdCustomer').val(parsedData[0]['idCustomer']);
                                $('#ROModeName').val(roModes);
                                getAllReceivedParts(search);
                                setTimeout(function() {
                                    var totalAmountFeild = $('#PartsTable tr td:nth-last-child(3) input');
                                    ;
                                    for (var i = 0; i < totalAmountFeild.length; i++) {
                                        totalPartsAmount = totalPartsAmount + parseInt(totalAmountFeild[i].value);
                                    }
                                    $('#Parts').val(totalPartsAmount);
                                }, 5000);
								
                            } else {
                                $('#RoDetailFormBodyPaint').hide();
                                $('#RoDetailForm').show();
                                $('#IdInsertRO').val(parsedData[0]['idRO']);
                                $('#IsRepeatRO').val(parsedData[0]['isRepeatRO']);
                                $('#IdCustomer').val(parsedData[0]['idCustomer']);
                                $('#ROModeName').val(roModes);
                                getAllReceivedParts(search);
                                setTimeout(function() {
                                    var totalAmountFeild = $('#PartsTable tr td:nth-last-child(3) input');
                                    ;
                                    for (var i = 0; i < totalAmountFeild.length; i++) {
                                        totalPartsAmount = totalPartsAmount + parseInt(totalAmountFeild[i].value);
                                    }
                                    $('#Parts').val(totalPartsAmount);
                                }, 5000);
                            }
							if(parsedData[0]['Sublet'].length > 0){
						var SubletCounterBP = 1;	
						 $("#newRowSublet").val('-');
						 for(ii=0;ii<parsedData[0]['Sublet'].length;ii++){
        SubletCounterBP = SubletCounterBP + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (SubletCounterBP - 1) + "</td>" +
                "<td class='tbl-price'><input type='date' value='"+parsedData[0]['Sublet'][ii]['SubletRepairDate']+"' name='SubletDate[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' value='"+parsedData[0]['Sublet'][ii]['Quantity']+"' name='SubletQunatity[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletQunatity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' value='"+parsedData[0]['Sublet'][ii]['Reference']+"' name='SubletRef[]' style='width: 200px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletRef' placeholder='Reference' data-validation = ''></td>" +
                "<td class = 'tbl-description'><input type = 'text' value='"+parsedData[0]['Sublet'][ii]['Description']+"' name = 'SubletDesc[]' style = 'width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'SubletDesc' placeholder = 'Description' data-validation = ''></td>" +
                "<td class='tbl-price'><input type='text' name='SubletAmount[]' value='"+parsedData[0]['Sublet'][ii]['SubletRepairAmount']+"' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' class='ClassSubletAmount' id='SubletAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteSubletRow(this)'></td></tr>";
        $('#tblSublets').append(items);	
							
							
						}
						}	
							
                        } else {
                            $('#ROModeDiv').html('<div style="width:500px;"><label style="font-weight: bolder;font-size:15px;">RO is already Closed</label></div>');
                        }
                    }
                }
            });
        } else {
            $('#ROModeDiv').html('<div style="width:500px;"><label style="font-weight: bolder;font-size:15px;margin-right:82px;">Insert any RO-Number</label></div>');
        }

    });
    // For Work Performed Table
    var counter = 1;
    $("#newRowWorkPerformed").click(function(e) {
        $("#newRowWorkPerformed").val('-');
        counter = counter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'WorkPerformed[]' style = 'width: 500px;background: #fff; border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'WorkPerformed' placeholder = 'Work to be Performed' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='WorkPerformedHrs[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedHrs' placeholder='Hrs' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='WorkPerformedAmount[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteWorkRow(this)'></td></tr>";
        $('#tblworkperformed').append(items);
    });
    // For Parts Table
    var PartsCounter = 1;
    $("#newRowParts").click(function(e) {
        $("#newRowParts").val('-');
        PartsCounter = PartsCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (PartsCounter - 1) + "</td><td class='tbl-price'><input type='date' name='PartsDate[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDate' placeholder='Date' data-validation = 'required'></td><td class='tbl-price'><input type='text' name='PartsInvoiceNo[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsInvoiceNo' placeholder='Invoice'></td><td class='tbl-part'><select class='chosen-select slctboxes' name='PartNumber[]' onchange=getPart(this) style=' width: 200px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber'><option>Select Part Name</option><?php
                                        foreach ($partsList as $AllPart) {
                                            ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartName'] ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left:50px;margin-top:-35px;display:none;'>Option must be Selected</span></td>" +
                "<td class='tbl-price'><input type='text' name='PartsQuantity[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsQuantity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsDescription[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDescription' placeholder='Description'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsAmount[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='PartsSign[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsSign' placeholder='Signature'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deletePartRow(this)'></td></tr>";
        "</tr>";
        $('#tblParts').append(items);
        $("select[name='PartNumber[]']").chosen({no_results_text: "Oops, nothing found!"});
    });
    // For Sublet Table Other than BP
    var SubletCounter = 1;
    //    var SubletTotal = 0;
    $("#newRowSublet").click(function(e) {
        $("#newRowSublet").val('-');
        SubletCounter = SubletCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (SubletCounter - 1) + "</td>" +
                "<td class='tbl-price'><input type='date' name='SubletDate[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletQunatity[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletQunatity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletRef[]' style='width: 200px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletRef' placeholder='Reference' data-validation = ''></td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'SubletDesc[]' style = 'width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'SubletDesc' placeholder = 'Description' data-validation = ''></td>" +
                "<td class='tbl-price'><input type='text' name='SubletAmount[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' class='ClassSubletAmount' id='SubletAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteSubletRow(this)'></td></tr>";
        $('#tblSublets').append(items);
    });
    // For Lubricants Table
    var LubsCounter = 1;
    $("#newRowLubricants").click(function(e) {
        $("#newRowLubricants").val('-');
        LubsCounter = LubsCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (LubsCounter - 1) + "</td>" +
                "<td class='tbl-price'><input type='date' name='LubDate[]' style='width: 135px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LubDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='LubQunatity[]' style='width: 30px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LubQunatity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'LubDesc[]' style = 'width: 482px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'LubDesc' placeholder = 'Description' data-validation = ''></td>" +
                "<td class='tbl-price'><input type='text' name='LubAmount[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LubAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='LubSignature[]' style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='LubSignature' placeholder='Signature' data-validation = ''></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer ' type='button' value='X' onclick='deleteLubRow(this)'></td></tr>";
        $('#tblLubricants').append(items);
    });

    $('#TotalSubletAmount').click(function() {
        var totalAmount = $('#SubletTable tr td:nth-last-child(2) input');
        var sumTotalAmount = 0;
        for (var i = 0; i < totalAmount.length; i++) {
            sumTotalAmount = sumTotalAmount + parseInt(totalAmount[i].value);
        }
        $('#SubletRepair').val(sumTotalAmount);
    });   

	$('#TotalParstsAmount').click(function() {
        var totalAmount = $('#PartsTable tr td:nth-last-child(3) input');
        var sumTotalAmount = 0;
        for (var i = 0; i < totalAmount.length; i++) {
            sumTotalAmount = sumTotalAmount + parseInt(totalAmount[i].value);
        }
        $('#Parts').val(sumTotalAmount);
    });
	
	$('#TotalLabourAmount').click(function() {
        var totalAmount = $('#WorkTable tr td:nth-last-child(2) input');
        var sumTotalAmount = 0;
        for (var i = 0; i < totalAmount.length; i++) {
            sumTotalAmount = sumTotalAmount + parseInt(totalAmount[i].value);
        }
        $('#Labour').val(sumTotalAmount);
    });

    function DoToggle(id) {
        $(id).toggle();
    }

    function calculateAllAmounts() {
        var labourAmount = $("#Labour").val();
        var lubOilAmount = $("#LubOil").val();
        var subletAmount = $("#SubletRepair").val();
        var partsAmount = $("#Parts").val();
        var veodAmount = $("#VEOD").val();
        var veodAmount2 = $("#VEOD2").val();
        var gst = $("#GST").val();
        var sst = $("#SST").val();
        var gstLabourTaxAmount = 0;
        var sstLubTaxAmount = 0;
        var sstSubTaxAmount = 0;
        var sstPartsTaxAmount = 0;
        var netTotal = 0;
        var roModeName = $('#ROModeName').val();
        if ($('#ApplyGSTLabour').is(':checked')) {
            gstLabourTaxAmount = (gst / 100) * labourAmount;
            labourAmount = parseInt(isNull(labourAmount)) + parseInt(isNull(gstLabourTaxAmount));
        }
        if ($('#ApplySSTLub').is(':checked')) {
            sstLubTaxAmount = (sst / 100) * lubOilAmount;
            lubOilAmount = parseInt(isNull(lubOilAmount)) + parseInt(isNull(sstLubTaxAmount));
        }
        if ($('#ApplySSTSublet').is(':checked')) {
            sstSubTaxAmount = (sst / 100) * subletAmount;
            subletAmount = parseInt((subletAmount)) + parseInt(isNull(sstSubTaxAmount));
        }
        if ($('#ApplySSTParts').is(':checked')) {
            sstPartsTaxAmount = (sst / 100) * partsAmount;
            partsAmount = parseInt(isNull(partsAmount)) + parseInt(isNull(sstPartsTaxAmount));
        }
        netTotal = parseInt(isNull(labourAmount)) + parseInt(isNull(lubOilAmount)) + parseInt(isNull(subletAmount)) + parseInt(isNull(partsAmount)) + parseInt(isNull(veodAmount)) + parseInt(isNull(veodAmount2));

        $('#NetTotal').val(netTotal);
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

    function deletePartRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('PartsTable').deleteRow(i);
    }

//    Functions for Parts Info
    function getPart(Source) {
        idPart = $(Source).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/partsrequisitionmechanical/getpartdetails",
            type: "POST",
            data: {idPart: idPart},
            success: function(data) {
                if (data !== "null") {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function(i, val) {
                            $(Source).closest('td').next('td').next('td').find('input').val(val.PartNumber);
//                            $(Source).closest('td').next('td').next('td').find('input').val();
//                            $(Source).closest('td').next('td').next('td').next('td').find('input').val();
                        });
                    }
                }
                else {
                }
            }
        });
    }

    function getAllReceivedParts(search) {
        $.ajax({
            url: "<?= base_url() ?>index.php/rodetail/receivedParts",
            type: "POST",
            data: {searchRONumber: search},
            success: function(data) {
                var receiveData = JSON.parse(data);
                if (receiveData.length > 0) {
                    for (var a = 0; a < receiveData.length; a++) {
                        if ($('#tblParts tr').length > receiveData.length) {
                            $('#tblParts tr:eq(' + a + ')').remove();
                        } else {
                            $('#tblParts').append("<tr class='tblPurchaseForce'>" +
                                    "<td class='tbl-count'>" + parseInt(a + 1) + "</td>" +
                                    "<td class='tbl-price'><input type='date' name='PartsDate[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDate' placeholder='Date' data-validation = 'required'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsInvoiceNo[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsInvoiceNo' placeholder='Invoice'></td>" +
                                    "<td class='tbl-part' ><input type='text' name='PartNumber[]' style='width: 200px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber' placeholder='Part Name'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsQuantity[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsQuantity' placeholder='Qty'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsDescription[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDescription' placeholder='Description'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsAmount[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsAmount' placeholder='Amount'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsSign[]' style='width:150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsSign' placeholder='Signature'></td>" +
                                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deletePartRow(this)'></td></tr>");
                        }
                    }
                    for (var each in receiveData) {
                        var totalAmount = 0;
                        totalAmount = receiveData[each]['RetailPrice'] * receiveData[each]['DispatchedQuantity'];
//                        $('#tblParts tr:eq(' + each + ') td:eq(' + 1 + ') input').val(receiveData[each]['RONumber']);
//                        $('#tblParts tr:eq(' + each + ') td:eq(' + 2 + ') input').val(receiveData[each]['idPartsRec']);
                        $('#tblParts tr:eq(' + each + ') td:eq(' + 3 + ') input').val(receiveData[each]['PartName']);
                        $('#tblParts tr:eq(' + each + ') td:eq(' + 4 + ') input').val(receiveData[each]['DispatchedQuantity']);
                        $('#tblParts tr:eq(' + each + ') td:eq(' + 5 + ') input').val(receiveData[each]['PartDescription']);
                        $('#tblParts tr:eq(' + each + ') td:eq(' + 6 + ') input').val(totalAmount);
                    }
                    $('#PartsStatus').html('<span>Following Parts are Received from Parts Department</span>');
                } else {
                    getAllRequestedParts(search);

                }
            }
        });
    }

    function getAllRequestedParts(search) {
        $.ajax({
            url: "<?= base_url() ?>index.php/rodetail/requestedParts",
            data: {searchRONumber: search},
            success: function(data) {
                var requestData = JSON.parse(data);
                if (requestData.length > 0) {
                    for (var a = 0; a < requestData.length; a++) {
                        if ($('#tblParts tr').length > requestData.length) {
                            $('#tblParts tr:eq(' + a + ')').remove();
                        } else {
                            $('#tblParts').append("<tr class=''>" +
                                    "<td class='tbl-count'>" + parseInt(a + 1) + "</td>" +
                                    "<td class='tbl-price'><input type='date' name='PartsDate[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDate' placeholder='Date' data-validation = 'required'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsInvoiceNo[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsInvoiceNo' placeholder='Invoice'></td>" +
                                    "<td class='tbl-part' ><input type='text' name='PartNumber[]' style='width: 200px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartNumber' placeholder='Part Name'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsQuantity[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsQuantity' placeholder='Qty'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsDescription[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsDescription' placeholder='Description'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsAmount[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsAmount' placeholder='Amount'></td>" +
                                    "<td class='tbl-price'><input type='text' name='PartsSign[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsSign' placeholder='Signature'></td>" +
                                    "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deletePartRow(this)'></td></tr>");
                        }
                    }
                    for (var each in requestData) {
//                        $('#reqData tr:eq(' + each + ') td:eq(' + 1 + ') input').val(requestData[each]['RONumber']);
//                        $('#reqData tr:eq(' + each + ') td:eq(' + 2 + ') input').val(requestData[each]['PartNumber']);
                        $('#tblParts tr:eq(' + each + ') td:eq(' + 3 + ') input').val(requestData[each]['PartName']);
                        $('#tblParts tr:eq(' + each + ') td:eq(' + 4 + ') input').val(requestData[each]['PartQuantity']);
                        $('#tblParts tr:eq(' + each + ') td:eq(' + 5 + ') input').val(requestData[each]['PartDescription']);
//                        $('#tblParts tr:eq(' + each + ') td:eq(' + 6 + ') input').val(requestData[each]['RetailPrice']);
                    }
                    $('#PartsStatus').html('<span>Following Parts are Requested to Parts Department</span>');
                } else {
                    $('#PartsStatus').html('No Part Requested or Received For this RO');
                }
            }
        });
    }

    function setAmount() {
        var totalAmountFeild = $('#PartsTable tr td:nth-last-child(3) input');
        var totalPartsAmount = 0;
        for (var i = 0; i < totalAmountFeild.length; i++) {
            totalPartsAmount = totalPartsAmount + parseInt(totalAmountFeild[i].value);
        }
        $('#Parts').val(totalPartsAmount);
    }

    function validationform() {
        var isValidate = 1;
        var countPartsRow = $("#PartsTable > tbody").children().length;
        if (countPartsRow > 0) {
            var selects = $("#PartsTable").find(".slctboxes");
            for (var count = 0; count < selects.length; count++) {
                if ($(selects[count]).val() == "Select Part Name") {
                    isValidate = 0;
                    $(selects[count]).parent().find('span').show();
                } else {
                    $(selects[count]).parent().find('span').hide();
                }
            }
        } else {
        }
        if (isValidate === 0) {
            return false;
        } else {
            return true;
        }
    }


//    Function for BodyPaint RO-Detail   

    var SubletCounterBP = 1;
    $("#newRowSubletBP").click(function(e) {
        $("#newRowSubletBP").val('-');
        SubletCounterBP = SubletCounterBP + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (SubletCounterBP - 1) + "</td>" +
                "<td class='tbl-price'><input type='date' name='SubletDate[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletQunatity[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletQunatity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletRef[]' style='width: 200px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletRef' placeholder='Reference' data-validation = ''></td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'SubletDesc[]' style = 'width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'SubletDesc' placeholder = 'Description' data-validation = ''></td>" +
                "<td class='tbl-price'><input type='text' name='SubletAmount[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' class='ClassSubletAmount' id='SubletAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteSubletRowBP(this)'></td></tr>";
        $('#tblSubletsBP').append(items);
    });

    var materialCounter = 1;
    $("#newRowMaterial").click(function(e) {
        $("#newRowMaterial").val('-');
        materialCounter = materialCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'>" +
                "<td class='tbl-count'>" + materialCounter + "</td>" +
                "<td class='tbl-price'><input type='date' name='UsageDate[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='UsageDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='Quantity[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'></td>" +
                "<td class='tbl-part' ><input type='text' name='MaterialName[]' style='width: 200px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='MaterialName' placeholder='Material Name'></td>" +
                "<td class='tbl-price'><input type='text' name='Amount[]' style='width: 150px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Amount' placeholder='Amount'></td>" +
                "<td class='tbl-price'><input type='text' name='Description[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deletePartRow(this)'></td></tr>";
        $('#tblMaterial').append(items);
    });

    $('#TotalMaterialAmount').click(function() {
        var totalAmount = $('#MaterialsTable tr td:nth-last-child(3) input');
        var sumTotalAmount = 0;
        for (var i = 0; i < totalAmount.length; i++) {
            sumTotalAmount = sumTotalAmount + parseInt(totalAmount[i].value);
        }
        $('#MaterialCost').val(sumTotalAmount);
    });

    function deleteSubletRowBP(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('SubletTableBP').deleteRow(i);
    }

    function calculateTotalCost() {
        var materialCost = $("#MaterialCost").val();
        var painterLabour = $("#PainterLabour").val();
        var denterLabour = $("#DenterLabour").val();
        var technicianCost = $("#TechnicianCost").val();
        var otherExpences = $("#OtherExpences").val();
        var labourApproved = $("#ApprovedLabour").val();
        var depAmount = $("#DepreciationAmount").val();
        var gst = $("#GST").val();
        var materialCostTaxAmount = 0;
        var netTotal = 0;
        if ($('#ApplyGSTLabourBP').is(':checked')) {
            materialCostTaxAmount = (gst / 100) * materialCost;
            materialCost = parseInt(isNull(materialCost)) + parseInt(isNull(materialCostTaxAmount));
        }
        netTotal = parseInt(isNull(materialCost)) + parseInt(isNull(painterLabour)) + parseInt(isNull(denterLabour)) + parseInt(isNull(technicianCost)) + parseInt(isNull(otherExpences)) + parseInt(isNull(depAmount)) + parseInt(isNull(labourApproved));
        $('#TotalCost').val(netTotal);
        $('#NetTotalBP').val(netTotal);
    }
</script>
