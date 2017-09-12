<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/ro_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form id="repairorderform" action="<?= base_url() ?>index.php/repairorder/Add" onSubmit="return validationform();" method="post" enctype="multipart/form-data" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend onclick="DoToggle('#RepairOrderDiv')">Repair Order / Bill</legend>
                    <label style="margin-left: 230px;"><?= $insertMessage ?></label>
                    <fieldset>
                        <legend onclick="">Custmer Type Check</legend>
                        <div>
                            <?php
                            foreach ($custype as $key) {
                                ?>
                                <input type="radio" name="csh" value="<?= $key['cusTypeId'] ?>" style="margin-left: 15px;" checked><?= $key['cusType'] ?>
                                <?php
                            }
                            ?>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>RO-Modes</legend><br>
                        <div>
                            <input onclick="" tag='' type="checkbox" name="isRepeatRO" value="1" style="margin-left: 15px;">Repeat-RO
                        </div><br>
                        <div id="ROMode" class="feildwrap" style="margin-left: 05px;font-weight: bolder;font-size: 13px;">
                            <?php
                            foreach ($ROMode as $key) {
                                ?>
                                <input onclick="checkROMode(this)" tag='<?= $key['ModeName'] ?>' type="radio" name="isM" value="<?= $key['idROMode'] ?>" style="margin-left: 15px;"><?= $key['ModeName'] ?>
                                <?php
                            }
                            ?>
                            <input id="roModeType" name="roModeType" type="text" value="GR" style="margin-left: 15px;display: none;">
                        </div>
                        <div id="BPTypeDiv" style="margin-left: 40px;margin-top: 18px;display: block;">
                            <span id="TypeWarningStatus" style="font-weight: bolder;display:none;">Select type Insurance or Cash</span><br>
                            </br><input id="BPInsuarance" name="BPType" type="radio">
                            <span id="BPInsuaranceName">Insurance</span>
                            <input id="BPCash" name="BPType" type="radio">
                            <span id="BPCashName">Cash</span>
                        </div>
                        <div id="McTypeDiv" style="margin-left: 40px;margin-top: 18px;display: block;">
                            <?php foreach ($subModesM as $key) { ?>
                                <input  onclick="checkROMode(this)" tag='<?= $key['SubModeName'] ?>' id="Mcgr"  name="subType" type="radio" value="<?= $key['idSubMode'] ?>">
                                <span id="McgrName"><?= $key['SubModeName'] . '&nbsp&nbsp&nbsp&nbsp&nbsp' ?></span>
                            <?php } ?>
                        </div>
                        <div id="WTypeDiv" style="margin-left: 40px;margin-top: 18px;display: block;">
                            <?php foreach ($subModesW as $key) { ?>
                                <input onclick="checkROMode(this)" tag='<?= $key['SubModeName'] ?>' id="Wgr" name="subType" type="radio" value="<?= $key['idSubMode'] ?>">
                                <span id="WName"><?= $key['SubModeName'] ?></span>
                            <?php } ?>
                        </div>
                        <div id="BTypeDiv" style="margin-left: 40px;margin-top: 18px;display: block;">
                            <?php foreach ($subModesB as $key) { ?>
                                <input onclick="checkROMode(this)" tag='<?= $key['SubModeName'] ?>' id="Wgr" name="subType" type="radio" value="<?= $key['idSubMode'] ?>">
                                <span id="BName"><?= $key['SubModeName'] ?></span>
                            <?php } ?>
                        </div>
                        <div id="CTypeDiv" style="margin-left: 40px;margin-top: 18px;display: block;">
                            <?php foreach ($subModesC as $key) { ?>
                                <input onclick="checkROMode(this)" tag='<?= $key['SubModeName'] ?>' id="Cgr" name="subType" type="radio" value="<?= $key['idSubMode'] ?>">
                                <span id="CName"><?= $key['SubModeName'] ?></span>
                            <?php } ?>
                        </div>
                        <div id="SearchEstimateDiv" style="margin-left: 0px;" class="feildwrap">
                            <span id="EstimateWarningStatus" class="" style="margin-left: 170px;font-weight: bolder;display:none;">Enter Estimate No. in order to Fill RO-Details</span><br>
                            <label>Search By Estimate-No.</label>
                            <input id="EstimateNumber" name="EstimateNumber" type="text" onfocusout="searchByEstimateNo(this)" placeholder="Search by Estimate Number" style="width:175px;">
                            <span id="EstResult" name="EstResult" style="margin-left:05px;font-weight: bolder;font-size: 14px;"></span>
                        </div><br>
                    </fieldset><br>
                    <fieldset class="fieldset" >
                        <legend onclick="">Warranty RO Detail</legend>
                        <div  class="feildwrap" id="WarrantyRoDetail">
                            <div style=" margin-bottom: 0px; display: block !important; ">
                                <br>
                                <div>
                                    <label>TR No.</label>
                                    <input id="trNo" type="text" name="trNo" placeholder="TR No."  data-validation = "" >
                                </div>
                                <div>
                                    <label>Dr No.</label>
                                    <input id="drNo" type="text" name="drNo" placeholder="Dr No."  data-validation = "" >
                                </div>
                                <div>
                                    <label>Warranty Claim No.</label>
                                    <input id="wrNo" type="text" name="wrNo" placeholder="Warranty Claim No."  data-validation = "" >
                                </div>
                                <div>
                                    <label>Tr Report.</label>
                                    <input id="trReport" type="File" name="trReport" >
                                </div>
                                <div>
                                    <label>EDR Report.</label>
                                    <input id="edrReport" type="File" name="edrReport"  >
                                </div>
                                <div>
                                    <label>Vehicle Image.</label>
                                    <input id="vehicalImage" type="File" name="vehicalImage" >
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset">
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
                    <fieldset class="fieldset">
                        <legend onclick="DoToggle('#CustomerInfoDiv')">Customer Information</legend>
                        <br><div id="CustomerInfoDiv" class="feildwrap">
                            <div class="feildwrap" style="margin-left: 0px;">
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
                                <label>Email</label>
                                <input class="" id="CustomerEmail" type="email" name="CustomerEmail" placeholder="Enter Customer Email" data-validation = "">
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
                                <label>GST</label>
                                <input Class="GST" id="CustomerGST" type="text" name="gst" placeholder="Enter GST"  data-validation = "">
                            </div>
                            <div>
                                <label>Address</label>
                                <textarea id="CustomerAddress" name="CustomerAddress" placeholder="Enter Address" style="margin: 0px; width: 515px; height: 100px;"></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset">
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
                                <label>Range</label>
                                <select id="Range" name="Range" data-validation="required">
                                    <option>Select Range</option>
                                    <option value="RangeOneAmount">Range 1</option>
                                    <option value="RangeTwoAmount">Range 2</option>
                                    <option value="RangeThreeAmount">Range 3</option>

                                </select>
                            </div>
                            <div>
                                <label>Model No.</label>
                                <input id="Model" type="text" name="Model" placeholder="Enter Model"  data-validation = "" readonly>
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
                                <input type="button" class="btn" value="Take Value" style="" onclick="trimModelText()">
                            </div>
                            <div>
                                <label>Engine No.</label>
                                <input id="EngineNumber" type="text" name="EngineNumber" placeholder="Enter Engine Number"  data-validation = "required">
                            </div>
                            <div style="display: none;">
                                <label>Model Code</label>
                                <input id="ModelCode" type="text" name="ModelCode" placeholder="Enter Model Code"  data-validation = "">
                            </div>
                            <div style="display: none;">
                                <label>id Estimate</label>
                                <input id="idEstimate" type="text" name="idEstimate" placeholder="id Estimate"  data-validation = "" readonly>
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
                    <fieldset class="fieldset">
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
                    <fieldset class="fieldset">
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
                    <!--<fieldset class="fieldset">
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
                    </fieldset>    -->
                    <fieldset class="fieldset">
                        <legend onclick="DoToggle('#ThreeTasksDivs')">Mechanical / Body/Paint</legend>
                        <div id="ThreeTasksDivs" style=" width: 100%; height:auto;">
                            <div id="MechanicalDiv" class="feildwrap" style=" width: 200px; float: left;">
                                <fieldset style=" width: 195px; min-width: 150px; margin-left: 10px;">
                                    <legend>GR Jobs</legend>
                                    <div class="feildwrap">
                                        <!--   <div id="MechanicalRepairDiv">
                                                <select id="MechJob[]" name="MechJob[]" class="MechJob" multiple style="width: 175px;">
                                                    <option>Select Job(s)</option>
                                        <?php
                                        //   foreach ($mechanicalJobs as $key) {
                                        ?>
                                                        <option value="<? //= $key['idJobRef']  ?>" ><? //= $key['JobTask']  ?></option>
                                        <?php
                                        //      }
                                        ?>
                                                </select>
                                                <!--<span class="error-updatejrm cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                                            </div> -->
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
                                      <!--  <div>
                                            <label>Job Task</label>
                                            <select id="SelectJob" name="SelectJob[]" multiple class="chosen-select">
                                                <?php
                                              //  foreach ($bodyPaintJobs as $key) {
                                                    ?>
                                                    <option value="<?//= $key['idJobRef'] ?>" ><?//= $key['JobTask'] ?></option>
                                                    <?php
                                              //  }
                                                ?>
                                            </select>
                                        </div><br> -->
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
                    <fieldset style="display: none;">
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
                                    <input name="newRow" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRow" value="+" readonly>
                                    <tbody id="tblworkperformed">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend onclick="DoToggle('#TotalAmountDiv')">Check List and Total Amount</legend>
                        <div id="TotalAmountDiv" style="height:auto;">
                            <div class="feildwrap" style=" width: 220px;">
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
                                    <div id="">
                                        <label style="margin-left: -35px;">Wheel Caps Qty</label>
                                        <input id="WheelCapsQty" name="WheelCapsQty" min='0' type="number" value="0" placeholder="Qty" style="width:50px;margin-left: 51px;">
                                    </div>
                                    <div id="">
                                        <label style="margin-left: -35px;">Car Keys Qty</label>
                                        <input id="CarKeysQty" name="CarKeysQty" min='0' type="number" value="0" placeholder="Qty" style="width:50px;margin-left: 51px;">
                                    </div>
                                    <div>
                                        <label style="margin-left: -10px;">Is Org. Num-Plate ?</label><br>
                                        <input id="Yes" name="isOrignial" value="1" type="radio" data-validation = "required" style="margin-left: 55px;" checked>Yes
                                        <input id="No" name="isOrignial" value="0" type="radio" data-validation = "required">No
                                    </div><br>
                                    <br>
                                </fieldset>
                            </div>
                            <div class="feildwrap" style=" width: 450px; float: right;display: none;">
                                <fieldset style=" width: 450px; min-width: 215px;margin-top: 15px; margin-left: -50px;">
                                    <legend>Est. Total Amount</legend>
                                    <div class="feildwrap"><br>
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
                                        <div>
                                            <label>Labour</label>
                                            <input id="Labour" type="text" name="Labour" onchange="calculateNetTotal()" placeholder="Labour Amount" value="0.0"><span>&nbsp;Rs</span>
                                        </div><br>
                                        <div>
                                            <label>Lub Oil</label>
                                            <input id="LubOil" type="text" name="LubOil" onchange="calculateNetTotal()" placeholder="Lub Oil Amount" value=0.0><span>&nbsp;Rs</span>
                                        </div><br>
                                        <div>
                                            <label>Sublet Repair</label>
                                            <input id="SubletRepair" type="text" name="SubletRepair" onchange="calculateNetTotal()" placeholder="Sublet Repair Amount" value=0.0><span>&nbsp;Rs</span>
                                        </div><br>
                                        <div>
                                            <label>Parts</label>
                                            <input id="Parts" type="text" name="Parts" onchange="calculateNetTotal()" placeholder="Parts Amount" value=0.0><span>&nbsp;Rs</span>
                                        </div><br>
                                        <div>
                                            <label>Est. Approved Labour Rs</label>
                                            <input id="LabourRs" type="text" name="LabourRs" placeholder="Enter Labour Rs"  data-validation = "">
                                        </div><br>
                                        <div>
                                            <label>Est. Depreciation Amount Rs</label>
                                            <input id="DepAmountRs" type="text" name="DepAmountRs" placeholder="Enter Dep. Amount"  data-validation = "">
                                        </div><br>
                                        <div>
                                            <label>Grand Total</label>
                                            <input id="GrandTotal" type="text" name="GrandTotal" placeholder="Grand Total" value=0.0 readonly><span>&nbsp;Rs</span>
                                        </div><br>
                                        <div>
                                            <label>G.S.T</label>
                                            <input id="GST" type="text" name="GST" placeholder="GST" value=16 readonly><span>&nbsp;%</span>
                                            <div>
                                                <label>Net Total</label>
                                                <input id="NetTotal" type="text" name="NetTotal" placeholder="Net Total" value=0.0 readonly><span>&nbsp;Rs</span>
                                            </div><br>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset style="display: none;">
                        <legend onclick="DoToggle('#PartsDiv')">Parts</legend>
                        <div id="PartsDiv" class="feildwrap">
                            <div id="" class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                <table width="100%" border="0" cellpadding="1" cellspacing="0">
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
                                        </tr>
                                    </thead>
                                    <input name="newRowParts" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRowParts" value="+" readonly>
                                    <tbody id="tblParts">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset style="display: none;">
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
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset style="display: none">
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
                    <fieldset class="fieldset">
                        <legend>Service Advisor</legend>
                        <div class="feildwrap">
                            <br>
                            <div>
                                <label>Service Advisor</label>
                                <select id="idStaff" name="idStaff">
                                    <option>Select Service Advisor</option>
                                    <?php
                                    foreach ($serviceAdvList as $key) {
                                        ?>
                                        <option value="<?= $key['idStaff'] ?>" ><?= $key['Name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="error-staff cb-error help-block">Select Option</span>
                            </div>
                            <label style="display: none">Foreman</label>
                            <select id="Foreman" name="Foreman" style="display: none">
                                <option>Select Foreman</option>
                                <?php
                                foreach ($foremanList as $key) {
                                    ?>
                                    <option value="<?= $key['idStaff'] ?>" ><?= $key['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span style="display: none" class="error-foreman cb-error help-block">Option must be selected!</span>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset">
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
        </div>
    </div>
</div>
<script>
    var rOMode = "";
    $(document).ready(function () {
        $("#inputMakeDiv").hide();
        $("#regresult").hide();
        $("#InputOther").hide();
        $(".chosen-select").chosen();
        $(".MechJob").chosen();
        $('#BPTypeDiv').hide();
        $('#McTypeDiv').hide();
        $('#BTypeDiv').hide();
        $('#CTypeDiv').hide();
        $('#WTypeDiv').hide();
        $('#WarrantyRoDetail').hide();
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

    // For Work Performed Table
    var counter = 1;
    $("#newRow").click(function (e) {
        $("#newRow").val('-');
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

    // For Sublet Table
    var SubletCounter = 1;
    //    var SubletTotal = 0;
    $("#newRowSublet").click(function (e) {
        $("#newRowSublet").val('-');
        SubletCounter = SubletCounter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (SubletCounter - 1) + "</td>" +
                "<td class='tbl-price'><input type='date' name='SubletDate[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletQunatity[]' style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletQunatity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletRef[]' style='width: 275px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletRef' placeholder='Reference' data-validation = 'required'></td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'SubletDesc[]' style = 'width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'SubletDesc' placeholder = 'Description' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletAmount[]' onkeyup=calculateTotal() style='width: 175px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' class='ClassSubletAmount' id='SubletAmount' placeholder='Amount' data-validation = 'required'></td>" +
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
    $("#searchbyreg").focusout(function () {
        var search = $("#searchbyreg").val();
        if (search != "") {
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
                            // Not Need Now, After the Client request
                            //                        $("#SelectBrandDiv").hide();
                            //                        $("#SelectModelDiv").hide();
                            //                        $("#SelectMakeDiv").hide();
                            //                        $("#inputMakeDiv").show();
                            //                          End
                            if (parsedData[0]['CompanyName'] != null) {
                                $('#CompanyName').val(parsedData[0]['CompanyName']);
                            } else {
                                $('#CompanyName').val('None');
                            }
                            if (parsedData[0]['CompanyContact'] != null) {
                                $('#CompanyContact').val(parsedData[0]['CompanyContact']);
                            } else {
                                $('#CompanyContact').val('None');
                            }

                            $('#CustomerName').val(parsedData[0]['CustomerName']);
                            $('#CustomerContact').val(parsedData[0]['Cellphone']);
                            $('#PhoneOne').val(parsedData[0]['PhoneOne']);
                            $('#PhoneTwo').val(parsedData[0]['PhoneTwo']);
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
                            $('[name=SelectBrand] option').filter(function () {
                                return ($(this).val() == parsedData[0]['idAllBrands']);
                            }).prop('selected', true);
                            $('#SelectBrand').trigger("change");
                            setTimeout('selectTheCombo($("#SelectModel option"),' + parsedData[0]['idAllModels'] + ')', 1000);
                            setTimeout('invokeTrigger($("#SelectModel option"))', 1000);
                            setTimeout('selectTheCombo($("#SelectMake option"),' + parsedData[0]['idAllVehicles'] + ')', 3000);
                        }
                        else {
                            $('#regresult').show();
                            $("#regresult").html("Customer is Not Registered");
                        }
                    }
                }
            });
        } else {

        }
    });

    function invokeTrigger(selector) {
        $(selector).trigger("change");
    }

    function selectTheCombo(selector, values) {
        selector.filter(function () {
            return ($(this).val() == values);
        }).prop('selected', true);
    }

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
        var lubOilAmount = $("#LubOil").val();
        var subletAmount = $("#SubletRepair").val();
        var partsAmount = $("#Parts").val();
        var gst = $("#GST").val();
        var grandTotal = parseInt(isNull(labourAmount)) + parseInt(isNull(lubOilAmount)) + parseInt(isNull(subletAmount)) + parseInt(isNull(partsAmount));
        var netTotal = (gst / 100) * (grandTotal);
        $('#GrandTotal').val(grandTotal);
        $('#NetTotal').val(grandTotal + netTotal);
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

    function ajaxaddOtherJobs() {

        var dropDown = [];

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
        var modelText = $(obj).find(":selected").text();

        $("#SelectMake").html('');
        if (model !== "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/repairorder/getAllVehicles",
                type: "POST",
                data: {model: model},
                dataType: "json",
                success: function (data) {
                    $("#SelectMake").html($("<option id=''>Select Make</option>"));
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
        } else {
        }
    }

    function trimModelText() {
        var modelText = $('#SelectModel').find(":selected").text();
        if (modelText !== "") {
            if (modelText !== "Select Model") {
                $('#Model').val(modelText);
                if (modelText.indexOf('-') === -1) {
                    $('#FrameNumber').val(modelText);
                } else {
                    var frameNo = modelText.indexOf("-");
                    frameNo = modelText.substr(0, frameNo);
                    $('#FrameNumber').val(frameNo);
                }
            }
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
        $('#Labour').val('');
        var pmArray = [];
        var grArr = [];
        var bodyPaintArr = [];
        var estAmount = 0;
        var range = $(obj).val();

        var selectedMode = $("#ROMode input[type='radio']:checked").attr("tag");
        switch (selectedMode) {
            case selectedMode = 'Mechanincal':
                $("#MechanicalRepairDiv").find("input:checked").each(function () {
                    grArr.push($(this).val());
                });
                $("#SlctMechJobs option:selected").each(function () {
                    grArr.push($(this).val());
                });
                if (grArr.length > 0) {
                    for (var val in grArr) {
                        $.ajax({
                            url: "<?= base_url() ?>index.php/repairorder/getRange",
                            type: "POST",
                            data: {range: range, idJob: grArr[val]},
                            success: function (data) {
                                console.log('data');
                                console.log();
                                console.log(data);
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
                grArr = [];
                break;
            case selectedMode = 'BodyPaint':
                $("#SelectJob option:selected").each(function () {
                    bodyPaintArr.push($(this).val());
                });
                if (bodyPaintArr.length > 0) {
                    for (var val in bodyPaintArr) {
                        $.ajax({
                            url: "<?= base_url() ?>index.php/repairorder/getRange",
                            type: "POST",
                            data: {range: range, idJob: bodyPaintArr[val]},
                            success: function (data) {
                                if (data.length > 0) {
                                    estAmount += parseFloat(data);
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
                bodyPaintArr = [];
                break;
            case selectedMode = 'PM':
                $("#PMJobsDiv").find("input:checked").each(function () {
                    pmArray.push($(this).val());
                });
                if (pmArray.length > 0) {
                    for (var val in pmArray) {
                        $.ajax({
                            url: "<?= base_url() ?>index.php/repairorder/getRange",
                            type: "POST",
                            data: {range: range, idJob: pmArray[val]},
                            success: function (data) {
                                if (data.length > 0) {
                                    estAmount += parseFloat(data);
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
                pmArray = [];
                break;
            case selectedMode = 'GR-PM':
                $("#MechanicalRepairDiv").find("input:checked").each(function () {
                    grArr.push($(this).val());
                });
                $("#SlctMechJobs option:selected").each(function () {
                    grArr.push($(this).val());
                });
                $("#PMJobsDiv").find("input:checked").each(function () {
                    pmArray.push($(this).val());
                });
                if (grArr.length > 0) {
                    for (var val in grArr) {
                        $.ajax({
                            url: "<?= base_url() ?>index.php/repairorder/getRange",
                            type: "POST",
                            data: {range: range, idJob: grArr[val]},
                            success: function (data) {
                                if (data.length > 0) {
                                    estAmount += parseFloat(data);
                                } else {
                                }
                            },
                            error: function () {
                                console.log('error');
                            }
                        });
                    }
                }
                grArr = [];
                if (pmArray.length > 0) {
                    for (var val in pmArray) {
                        $.ajax({
                            url: "<?= base_url() ?>index.php/repairorder/getRange",
                            type: "POST",
                            data: {range: range, idJob: pmArray[val]},
                            success: function (data) {
                                if (data.length > 0) {
                                    estAmount += parseFloat(data);
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
                pmArray = [];
                break;
        }

        //        if (otherGrArr.length > 0) {
        //            for (var val in otherGrArr) {
        //                $.ajax({
        //                    url: "<?= base_url() ?>index.php/repairorder/getRange",
//                    type: "POST",
//                    data: {range: range, idJob: otherGrArr[val]},
//                    success: function(data) {
//                        if (data.length > 0) {
//                            estAmount += parseInt(data);
//                            $('#Labour').val(estAmount);
//                        } else {
//                        }
//                    },
//                    error: function() {
//                        console.log('error');
//                    }
//                });
//            }
//        }
    }

    function checkROMode(obj) {
        var tagName = $(obj).attr('tag');
        switch (tagName) {
            case tagName = 'Mechanincal':
                $('#MechanicalDiv').show();
                $('#BPaintDiv').hide();
                $('#PMSelectDiv').hide();
                $('#roModeType').val('GR');
                $('#McTypeDiv').show();
                $('#BTypeDiv').hide();
                $('#CTypeDiv').hide();
                $('#WTypeDiv').hide();
                $('#WarrantyRoDetail').hide();
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                rOMode = "Mechanincal";
                $('.fieldset').show();
                //
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'GR':
                $('#MechanicalDiv').show();
                $('#BPaintDiv').hide();
                $('#PMSelectDiv').hide();
                $('#roModeType').val('GR');
                $('#McTypeDiv').show();
                $('#BTypeDiv').hide();
                $('#CTypeDiv').hide();
                $('#WTypeDiv').hide();
                $('#WarrantyRoDetail').hide();
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                rOMode = "GR";
                $('.fieldset').show();
                //
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'BodyPaint':
                $('#MechanicalDiv').hide();
                $('#PMSelectDiv').hide();
                $('#BPaintDiv').show();
                $('#roModeType').val('BP');
                $('#BPTypeDiv').show();
                $('#BTypeDiv').show();
                $('#McTypeDiv').hide();
                $('#WarrantyRoDetail').hide();
                $('#BTypeDiv').show();
                $('#CTypeDiv').hide();
                $('#WTypeDiv').hide();
                $('#SearchEstimateDiv').hide();
                $('#SSCDiv').hide(); 
                rOMode = "BodyPaint";
                $('.fieldset').hide();
                $('#TypeWarningStatus').show();
                $('#BPCash').attr('checked', false);
                $('#BPInsuarance').attr('checked', false);
                break;
            case tagName = 'PM':
                $('#MechanicalDiv').hide();
                $('#BPaintDiv').hide();
                $('#PMSelectDiv').show();
                $('#roModeType').val('PM');
                $('#WarrantyRoDetail').hide();
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                rOMode = "PM";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'PDS':
                $('#MechanicalDiv').hide();
                $('#PMSelectDiv').hide();
                $('#BPaintDiv').hide();
                $('#WarrantyRoDetail').hide();
                $('#roModeType').val('PDS');
                $('#SearchEstimateDiv').hide();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                rOMode = "PDS";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'GR-PM':
                $('#BPaintDiv').hide();
                $('#MechanicalDiv').show();
                $('#PMSelectDiv').show();
                $('#WarrantyRoDetail').hide();
                $('#roModeType').val('GR-PM');
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                rOMode = "GR-PM";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'Other-PM':
                $('#MechanicalDiv').hide();
                $('#BPaintDiv').hide();
                $('#PMSelectDiv').show();
                $('#WarrantyRoDetail').hide();
                $('#roModeType').val('Other-PM');
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                rOMode = "Other-PM";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'Other PM-GR':
                $('#BPaintDiv').hide();
                $('#MechanicalDiv').show();
                $('#PMSelectDiv').show();
                $('#roModeType').val('Other PM-GR');
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                $('#WarrantyRoDetail').hide();
                rOMode = "Other PM-GR";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'SSC':
                $('#BPaintDiv').hide();
                $('#MechanicalDiv').hide();
                $('#PMSelectDiv').hide();
                $('#roModeType').val('SSC-Campaign');
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').show();
                $('#WarrantyRoDetail').hide();
                $('#WarrantyRoDetail').hide();
                rOMode = "SSC-Campaign";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'Warranty':
                $('#MechanicalDiv').show();
                $('#BPaintDiv').hide();
                $('#PMSelectDiv').hide();
                $('#roModeType').val('Warranty');
                $('#McTypeDiv').hide();
                $('#BTypeDiv').hide();
                $('#CTypeDiv').hide();
                $('#WTypeDiv').show();
                $('#WarrantyRoDetail').show();
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                rOMode = "Warranty";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'Car wash':
                $('#MechanicalDiv').show();
                $('#BPaintDiv').hide();
                $('#PMSelectDiv').hide();
                $('#roModeType').val('Warranty');
                $('#McTypeDiv').hide();
                $('#BTypeDiv').hide();
                $('#CTypeDiv').show();
                $('#WarrantyRoDetail').hide();
                $('#WTypeDiv').hide();
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#SSCDiv').hide();
                rOMode = "Warranty";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
            case tagName = 'Repeat-RO':
                $('#BPaintDiv').hide();
                $('#MechanicalDiv').show();
                $('#PMSelectDiv').show();
                $('#roModeType').val('Repeat-RO');
                $('#SearchEstimateDiv').show();
                $('#BPTypeDiv').hide();
                $('#WarrantyRoDetail').hide();
                $('#SSCDiv').hide();
                rOMode = "Repeat-RO";
                $('.fieldset').show();
                $('#EstimateWarningStatus').hide();
                break;
        }
//        if (tagName == 'GR') {
//            $('#BPaintDiv').hide();
//            $('#MechanicalDiv').show();
//            $('#PMSelectDiv').show();
//            $('#roModeType').val('GR');
//        } else {
//            if (tagName == 'BodyPaint') {
//                $('#MechanicalDiv').hide();
//                $('#PMSelectDiv').hide();
//                $('#BPaintDiv').show();
//                $('#roModeType').val('BP');
//            } else {
//                if (tagName == 'PDS') {
//                    $('#MechanicalDiv').hide();
//                    $('#PMSelectDiv').hide();
//                    $('#BPaintDiv').hide();
//                    $('#roModeType').val('PDS');
//                }
//            }
//        }
    }

    //   Calling Function on Insurance and Cash
    $('#BPInsuarance').click(function () {
        $('#SearchEstimateDiv').show();
        $('.fieldset').hide();
        $('#EstimateWarningStatus').show();
    });
    $('#BPCash').click(function () {
        $('.fieldset').show();
        $('#SearchEstimateDiv').hide();
        $('#EstimateWarningStatus').hide();
    });

    //  Function that Search on Estimate Number
    //  Function will invoke on Focus out Event
    function searchByEstimateNo(object) {
        var obj = $(object).val();
        //	console.log(rOMode);
        if (obj !== "") {
            if (rOMode == "BodyPaint") {
                $.ajax({
                    url: "<?= base_url() ?>index.php/allestimatesbshop/search",
                    type: "POST", data: {searchbyest: obj},
                    success: function (data) {
                        if (data !== "null")
                        {
							//	console.log($('#EstimateNumber').val());
                            //  console.log(parsedData);
                             
                            var parsedData2 = JSON.parse(data);
							var parsedData = parsedData2['other'];
							var JparsedData = parsedData2['jobs'];
							// console.log(JparsedData);
                            if (parsedData.length > 0) {
                                if (parsedData[0]['CompanyName'] != null) {
                                    $('#CompanyName').val(parsedData[0]['CompanyName']);
                                } else {
                                    $('#CompanyName').val('None');
                                }
                                if (parsedData[0]['CompanyContact'] != null) {
                                    $('#CompanyContact').val(parsedData[0]['CompanyContact']);
                                } else {
                                    $('#CompanyContact').val('None');
                                }
								var jbjobs = "";
for(i=0;i<JparsedData.length;i++){
	var valuej = JparsedData[i]['JobDescription'].split("||");
jbjobs += valuej[0]+",";	
	
}
jbjobs = jbjobs.replace(/,\s*$/, "");
//var jbjobs = jbjobs.substr(0,1);
$("#VOC").val(jbjobs);
                                $('#CustomerName').val(parsedData[0]['CustomerName']);
                                $('#CustomerContact').val(parsedData[0]['Cellphone']);
                                $('#PhoneOne').val(parsedData[0]['PhoneOne']);
                                $('#PhoneTwo').val(parsedData[0]['PhoneTwo']);
                                $('#CustomerNIC').val(parsedData[0]['Cnic']);
                                $('#CustomerNTN').val(parsedData[0]['NTN']);
								$('#CustomerGST').val(parsedData[0]['Gst']);
								$('#CustomerEmail').val(parsedData[0]['CustomerEmail']);
                                $('#CustomerAddress').val(parsedData[0]['AddressDetails']);
                                $('#inputMake').val(parsedData[0]['idAllVehicles']);
                                $('#inputMake').val(parsedData[0]['Variant']);
                                $('#Model').val(parsedData[0]['Model']);
                                $('#RegNumber').val(parsedData[0]['RegistrationNumber']);
                                $('#KM').val(parsedData[0]['Mileage']);
                                $('#FrameNumber').val(parsedData[0]['ChassisNumber']);
                                $('#EngineNumber').val(parsedData[0]['EngineNumber']);
//                                $('#ModelCode').val(parsedData[0]['ModelCode']);
                                $('#EstNum').val(obj);
                                $('#idEstimate').val(parsedData[0]['idEstimate']);
                                $('#Year').val(parsedData[0]['YEAR']);
                                $('[name=SelectBrand] option').filter(function () {
                                    return ($(this).val() == parsedData[0]['idAllBrands']);
                                }).prop('selected', true);
                                $('#SelectBrand').trigger("change");
                                setTimeout('selectTheCombo($("#SelectModel option"),' + parsedData[0]['idAllModels'] + ')', 1000);
                                setTimeout('invokeTrigger($("#SelectModel option"))', 1000);
                                setTimeout('selectTheCombo($("#SelectMake option"),' + parsedData[0]['idAllVehicles'] + ')', 3000);
                                $('#InsuranceCode').val(parsedData[0]['CompanyCode']);
                                $('#Surveyor').val(parsedData[0]['SurveyorName']);
                                console.log('yeh hai!');
                                console.log(parsedData);
                                $('#SelectJob option').filter(function () {
                                    return ($(this).text() === parsedData[0]['Jobs']);
                                }).prop('selected', true);
                                $('.chosen-select').trigger('chosen:updated');
                            }
                            else {
//                                $('#regresult').show();
//                                $("#regresult").html("Estimate-Number is Not Registered");
                            }
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "<?= base_url() ?>index.php/allestimatesmech/search",
                    type: "POST", data: {searchbyest: obj},
                    success: function (data) {
                        if (data !== "null")
                        {// console.log(data);
                            var parsedData = JSON.parse(data);
                            var jjobs = parsedData['jobs'];
                            parsedData = parsedData['other'];
                            if (parsedData.length > 0) {
                                console.log(parsedData);
                                //console.log(jjobs);
//                                $("#regresult").show();
//                                $("#regresult").html("Customer is Already Registered");
                                if (parsedData[0]['CompanyName'] != null) {
                                    $('#CompanyName').val(parsedData[0]['CompanyName']);
                                } else {
                                    $('#CompanyName').val('None');
                                }
                                if (parsedData[0]['CompanyContact'] != null) {
                                    $('#CompanyContact').val(parsedData[0]['CompanyContact']);
                                } else {
                                    $('#CompanyContact').val('None');
                                }

                                $('#CustomerName').val(parsedData[0]['CustomerName']);
                                $('#CustomerContact').val(parsedData[0]['Cellphone']);
                                $('#PhoneOne').val(parsedData[0]['PhoneOne']);
                                $('#PhoneTwo').val(parsedData[0]['PhoneTwo']);
                                $('#CustomerNIC').val(parsedData[0]['Cnic']);
                                $('#CustomerNTN').val(parsedData[0]['NTN']);
								$('#CustomerGST').val(parsedData[0]['Gst']);
								$('#CustomerEmail').val(parsedData[0]['CustomerEmail']);
                                $('#CustomerAddress').val(parsedData[0]['AddressDetails']);
                                $('#inputMake').val(parsedData[0]['idAllVehicles']);
                                $('#inputMake').val(parsedData[0]['Variant']);
                                $('#Model').val(parsedData[0]['Model']);
                                $('#RegNumber').val(parsedData[0]['RegistrationNumber']);
                                $('#KM').val(parsedData[0]['Mileage']);
                                $('#FrameNumber').val(parsedData[0]['ChassisNumber']);
                                $('#EngineNumber').val(parsedData[0]['EngineNumber']);
//                                $('#ModelCode').val(parsedData[0]['ModelCode']);
                                $('#idEstimate').val(parsedData[0]['idEstimate']);
                                $('#EstNum').val(obj);
                                $('#Year').val(parsedData[0]['YEAR']);
                                $('[name=SelectBrand] option').filter(function () {
                                    return ($(this).val() == parsedData[0]['idAllBrands']);
                                }).prop('selected', true);
                                $('#SelectBrand').trigger("change");
                                //	ajaxaddOtherJobs();



                                if (parsedData[0]['is_PM'] == 1) {
                                    $("input[tag=PM]").trigger('click');
                                    var llength = $("#SelectPMPackage option").length;
                                    $("#SelectPMPackage").attr('size', llength)
                                    $("#SelectPMPackage").val(parsedData[0]['PM_package'])
                                    $("#SelectPMPackage").trigger('change')
                                } else {
                                    var dropDown = [];
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
                                                $("input[name=otherJob]").val('x');
                                                var abc = [];
                                                for (i = 0; i < jjobs.length; i++) {

                                                    abc.push(jjobs[i]['idJob'])

                                                }
                                                console.log(abc);
                                                $("#SlctMechJobs").val(abc);
                                                $("#SlctMechJobs").trigger("chosen:updated");
                                            }
                                            else {
                                                console.log('elses');
                                            }
                                        },
                                        error: function (data) {

                                        }
                                    });
                                }

                                //$("#UserRole").val(str_array[i]).trigger("chosen:updated");
                                //	var vvvalue = ['1','2'];
                                //$("#SlctMechJobs").val(vvvalue);


                                //	.trigger("chosen:updated");
                                //  $('#SlctMechJobs').trigger('chosen:updated');
                                //$('#SlctMechJobs').trigger("liszt:updated");
//                                $('#MechJob option').filter(function() {
//                                    return ($(this).text() === parsedData[0]['Jobs']);
//                                }).prop('selected', true);
//                                $('.chosen-select').trigger('chosen:updated');
                                setTimeout('selectTheCombo($("#SelectModel option"),' + parsedData[0]['idAllModels'] + ')', 1000);
                                setTimeout('invokeTrigger($("#SelectModel option"))', 1000);
                                setTimeout('selectTheCombo($("#SelectMake option"),' + parsedData[0]['idAllVehicles'] + ')', 3000);

                            }
                            else {
//                                $('#regresult').show();
//                                $("#regresult").html("Customer is Not Registered");
                            }
                        }
                    }
                });
            }
            $('.fieldset').show();
        } else {

        }
    }

    /*function validationform() {
     
     var conditions = [];
     var othersValue = [];
     $('#ConditionDiv').find(':radio:checked').each(function() {
     conditions.push($(this).val());
     });
     
     $('#ConditionDiv').find('input:text').each(function() {
     othersValue.push($(this).val());
     });
     
     $('#ConditionDiv').append("<input type='text' name='ConditionDetail' value='" + JSON.stringify(conditions) + "'>");
     $('#ConditionDiv').append("<input type='text' name='OtherValue' value='" + JSON.stringify(othersValue) + "'>");
     
     var staffSlct = $('#idStaff').val();
     if (staffSlct === "Select Service Advisor")
     {
     $(".error-staff").show();
     return false;
     } else {
     $(".error-staff").hide();
     return true;
     }
     }*/

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


    //Setting Frame Number Value on Focus out from Model No
    //    $('#Model').focusout(function() {
    //        var modelNo = $(this).val();
    //        if (modelNo !== "") {
    //            var frameNo = modelNo.substr(0, 4);
    //            $('#FrameNumber').val(frameNo);
    //        } else {
    //        }
    //    });
</script>