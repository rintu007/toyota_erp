<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/ro_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <h4><?= $updateMessage ?></h4>
            <h4><?= $cancelMessage ?></h4>
            <form id="RoList" action="<?= base_url() ?>index.php/"  method="post" onSubmit="return validationform()" class="form animated fadeIn">
                <fieldset>
                    <legend>All Opened RO</legend>
                    <div class="feildwrap">
                        <label>Search By RO Number</label>
                        <input type="text" name="searchbyro" id="searchbyro"  placeholder="Search by RO Number">
						<div>
                                    <label>Date</label>
                                    <input id="ReceptionDate" type="date" name="ReceptionDate" class="date hasDatepicker" placeholder="Reception Date" style="width: 150px;">
								
                                </div>
                    </div><br><br>
                    <div id="ROFinanceDiv" class="feildwrap">
                        <div class="btn-block-wrap datagrid">
                            <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="02%">S.NO</th>
                                        <th width="02%">RO</th>
                                        <th width="12%">Book in Date</th>
                                        <th width="10%">Delivery Date</th>
                                        <th width="05%">Customer</th>
                                        <th width="15%">Contact</th>
                                        <th width="15%">Variant</th>
                                        <th width="05%">Reg Number</th>
                                        <th width="05%">Mileage</th>
                                        <th width="05%">Total Amount</th>
                                        <th width="10%">Staff</th>
                                        <th width="10%">Foreman</th>
                                        <th width="05%">Detail</th>
                                        <th width="05%">Ro Print</th>
                                        <th width="05%">Cancel</th>
                                    </tr>
                                </thead>                               
                                <tfoot class="">
                                    <tr>
                                        <td colspan="15">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                </tfoot>
                                <tbody id="rolistbody">
                                    <?php
                                    $count = 1;
                                    foreach ($allOpenedRO as $key) {
                                        ?>
                                        <tr id="ALLOpenedRO">
                                            <td name=""><?= $count++ ?></td>
                                            <td name="" class="tbl-name"><?= $key['RONumber'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['BookingDate'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['DeliveryDate'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['CustomerName'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['CustomerContact'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['Vehicle'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['RegNumber'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['Mileage'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['NetTotal'] . " /=" ?></td>
                                            <td name="" class="tbl-name"><?= $key['Staff'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['Foreman'] ?></td>
                                            <td name="" class="tbl-name"><a  style="cursor:pointer" onclick="getDetails(<?php echo $key['idRO'] ?>);">Details</a></td>
                                            <td name="" class="tbl-name"><a  style="cursor: pointer" href="<?= base_url() ?>index.php/openedro/getRo/<?= $key['idRO'] ?>">Print</a></td>
                                            <td name="" class="tbl-name"><a  style="cursor: pointer" href="<s?= base_url() ?>index.php/openedro/cancel/<?= $key['idRO'] ?>">Cancel</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>    
            </form>
            <form id="RoListForm" action="<?= base_url() ?>index.php/rolist/Update" onSubmit="return validationform()" method="post" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend onclick="DoToggle('#RepairOrderDiv')">Repair Order / Bill</legend>
                    <div id="RepairOrderDiv" class="feildwrap">
                        <div style=" margin-bottom: 0px; display: block !important; ">
                            <div style="display: none">
                                <label>Id RO</label>
                                <input id="idRO" type="text" name="idRO" placeholder="" readonly>
                            </div>
                            <div style=" margin-bottom: 0px; display:none !important;">
                                <label>R.O No.</label>
                                <input id="RoNumber" type="text" name="RoNumber" placeholder="R.O Number" data-validation = "" readonly>
                            </div>
                            <div style=" margin-bottom: 0px; display: none !important;">
                                <label>Cash Memo No.</label>
                                <input id="CashMemo" type="text" name="CashMemo" placeholder="Cash Memo Number" data-validation = "">
                            </div>
                            <div style=" margin-bottom: 0px; display: block !important;">
                                <label>Credit Memo No.</label>
                                <input id="CreditMemo" type="text" name="CreditMemo" placeholder="Credit Memo Number" data-validation = "">
                            </div>
                            <div style="margin-bottom: 0px; display: block !important;">
                                <label>Fuel</label>
                                <?php foreach ($fuelVolume as $key) { ?>
                                    <div style=""><input id="FuelVolume" type="radio" name="FuelVolume" value="<?= $key['idFuel'] ?>" checked><span><?= $key['FuelVolume'] ?></span></div>
                                <?php }
                                ?>
                            </div>  
                            <div style=" margin-bottom: 0px; display: block !important;">
                                <label>CNG</label>
                                <?php foreach ($gasVolume as $key) { ?>
                                    <div style=""><input id="CNGVolume" type="radio" name="CNGVolume" value="<?= $key['idGas'] ?>" checked><span><?= $key['GasVolume'] ?></span></div>
                                <?php }
                                ?>
                            </div><br>
                            <div style=" margin-bottom: 0px; display: block !important;">
                                <label>LPG</label>
                                <?php foreach ($gasVolume as $key) { ?>
                                    <div style=""><input id="LPGVolume" type="radio" name="LPGVolume" value="<?= $key['idGas'] ?>" checked><span><?= $key['GasVolume'] ?></span></div>
                                <?php }
                                ?>
                            </div><br>
                            <div style="margin-left:0px;margin-bottom: 0px; display: block !important;">
                                <label>F I R</label>                                
                                <input id="FIR" type="radio" name="isFIR" value="1" checked>F I R
                                <input id="NonFIR" type="radio" name="isFIR" value="0">Non - F I R
                            </div>
                        </div>
                        <div style=" margin-top: -15%; margin-left: 38%; display: block !important; ">
                            <fieldset style="margin-left: 139px;margin-top: 0px;width: 28%;min-width: 100px;">
                                <legend>Book In</legend>
                                <div>
                                    <input style="width: 149px" id="BookDate" type="text" name="BookDate" class='date' placeholder="Book in Date"  data-validation = "required">
                                </div>
                                <div>
                                    <input style="width: 149px" Class="Timepicker" id="BookTime" type="text" name="BookTime" data-time-format="H:i:s" placeholder="Book in Time" data-validation = "required">
                                </div>
                            </fieldset>
                        </div>
                        <div style="display: block !important;">
                            <fieldset style="margin-left: 77%;margin-top: -172px;width: 17%;min-width: 100px;">
                                <legend>Delivery</legend>
                                <div>
                                    <input style="width: 149px" id="DeliveryDate" type="text" name="DeliveryDate" class='date'  placeholder="Delivery Date"  data-validation = "required">
                                </div>
                                <div>
                                    <input style="width: 149px;" Class="Timepicker" id="DeliveryTime" type="text" name="DeliveryTime" data-time-format="H:i:s" placeholder="Delivery Time" data-validation = "required">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </fieldset>
                <!--<fieldset style="">
                    <legend onclick="DoToggle('#ConditionDiv')">5W1H</legend>
                    <div id="ConditionDiv" class="feildwrap" style="width: 95%;"> 
                <?php
                $i = 0;
                foreach ($condConfirm as $key) {
                    ?>
                                <br><div style="margin-left: -90px;"><label><b><?= $key['Name'] ?></b></label></div>
                    <?php foreach ($key['ConditionDetail'] as $val) { ?>
                                        <input id="ConditionDetail" name="ConditionDetail<?php echo $i; ?>" class="ConditionDetail"  type="radio" value="<?= $val['idConditionDetail'] ?>"><?= $val['ConditionDetail'] ?>
                        <?php
                    }
                    $i = $i + 1;
                }
                ?>
                    </div><br>                                 
                </fieldset>-->
                <fieldset>
                    <legend onclick="DoToggle('#CustomerInfoDiv')">Customer Information</legend>
                    <br><div id="CustomerInfoDiv" class="feildwrap">
                        <div style="display: none">
                            <label>Id Customer</label>
                            <input id="idCustomer" type="text" name="idCustomer" placeholder="" readonly>
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
                        <div style="display: none">
                            <label>Id Vehicle</label>
                            <input id="idVehicle" type="text" name="idVehicle" placeholder="" readonly>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend onclick="DoToggle('#VehicleInfoDiv')">Vehicle Information</legend>
                    <br><div id="VehicleInfoDiv" class="feildwrap">
                        <div id="SelectBrandDiv">
                            <label>Select Brand</label>
                            <select id="SelectBrand" name="SelectBrand" onchange="getModels(this)">
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
                            <select id="SelectModel" name="SelectModel" onclick="getAllVehicles(this)">
                                <option>Select Model</option>                            
                            </select>
                        </div>
                        <div id="SelectMakeDiv">
                            <label>Select Make</label>
                            <select id="SelectMake" name="Make">
                                <option>Select Make</option>
                                <?php
                                foreach ($variantList as $key) {
                                    ?>
                                    <option value="<?= $key['idAllVehicles'] ?>" ><?= $key['Variant'] ?></option>
                                    <?php
                                }
                                ?>   
                            </select>
                            <span class="error-make cb-error help-block">Option must be selected!</span>
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
                    <legend onclick="DoToggle('#ThreeTasksDivs')">GR / Body/Paint</legend>
                    <fieldset id="typeOfJobs">
                        <div id="ROMode" class="feildwrap" style="margin-left: 230px;">
                            <?php
                            foreach ($ROMode as $key) {
                                ?>
                                <input onclick="checkROMode(this)" tag='<?= $key['ModeName'] ?>' type="radio" name="isM" value="<?= $key['idROMode'] ?>" style="margin-left: 15px;"><?= $key['ModeName'] ?>                                
                                <?php
                            }
                            ?>
                        </div>
                    </fieldset>
                    <div id="ThreeTasksDivs" style=" width: 100%; height:auto;">
                        <div id="MechanicalDiv" class="feildwrap" style=" width: 260px; float: left;">
                            <fieldset style=" width: 195px; min-width: 215px; margin-left: 10px;">
                                <legend>Mechanical Repairs</legend>
                                <div class="feildwrap">
                                    <div id="MechanicalRepairDiv" class="feildwrap">
                                        <?php
                                        $jobCounter = 0;
                                        foreach ($mechanicalJobs as $key) {
                                            $jobCounter = $jobCounter + 1;
                                            if ($jobCounter % 4 === 0) {
                                                ?>
                                                <br><br>
                                            <?php }
                                            ?>
                                            <div style="margin-left: 25px;height: auto"><input class="MechJob" name="MechJob[]" type="checkbox" value="<?= $key['idJobRef'] ?>" data-validation = ""><?= $key['JobTask'] ?></div>

                                        <?php }
                                        ?>
                                    </div><br><br>
                                    <div id="otherJobDiv" style=" width:100%;height: auto;">
                                        <span>Select Other Jobs</span><input name="otherJob" onclick="addOtherJobs()" style=" width:15px;height:25px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" readonly><br>
                                    </div>
                                </div>                            
                            </fieldset>
                        </div>
                        <div id="PMSelectDiv" class="feildwrap" style="width: 650px; float: right;">
                            <fieldset id="bodypaintfield" style=" width:650px; min-width: 215px; margin-left: -50px; margin-top:13px;">
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
                                        <div style="display: none">
                                            <label>Id PM-Package</label>
                                            <input id="idRoPMPackage" type="text" name="idRoPMPackage" placeholder="" readonly>
                                        </div>
                                    </div>                                    
                                    <div>
                                        <label>B/P Cont RO Ref Number</label>
                                        <input id="BPRoRef" type="text" name="BPRoRef" placeholder="B/P RO Ref Number"  data-validation = "">
                                    </div><br>
                                </div>
                            </fieldset>
                        </div>
                        <div id="BPaintDiv" class="feildwrap" style="margin-left:85px;width: 650px;">
                            <fieldset id="bodypaintfield" style=" width:650px; min-width: 215px; margin-left: -50px; margin-top:13px;">
                                <legend>Body/Paint</legend>
                                <div id="BodyPaintDiv" class="feildwrap">
                                    <div>
                                        <label>Job Task</label>
                                        <select class="SBp" id="SelectJob" name="SelectJob[]" multiple>
                                            <?php
                                            foreach ($bodyPaintJobs as $key) {
                                                ?>
                                                <option value="<?= $key['idJobRef'] ?>" ><?= $key['JobTask'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div><br>
                                    <div style="display: none">
                                        <label>Id Body-Paint</label>
                                        <input id="idBodyPaint" type="text" name="idBodyPaint" placeholder="" readonly>
                                    </div>
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
                                    <div>
                                        <label>Approved Labour Rs</label>

                                        <input id="LabourRs" type="text" name="LabourRs" placeholder="Enter Labour Rs"  data-validation = "">
                                    </div><br>
                                    <div>
                                        <label>Depreciation Amount Rs</label>

                                        <input id="DepAmountRs" type="text" name="DepAmountRs" placeholder="Enter Dep. Amount"  data-validation = "">
                                    </div><br>
                                    <div>
                                        <label>Invoice Number</label>
                                        <input id="InvoiceNum" type="text" name="InvoiceNum" placeholder="Enter Invoice Number"  data-validation = "">
                                    </div><br>
                                    <div>
                                        <label>Invoice Date</label>

                                        <input id="InvoiceDate" type="text" name="InvoiceDate" class='date' placeholder="Enter Invoice Date"  data-validation = "">
                                    </div><br>
                                    <div>
                                        <label>Delivery Date</label>
                                        <input id="BPDeliveryDate" type="text" name="BPDeliveryDate" class='date' placeholder="Enter Delivery Date"  data-validation = "">
                                    </div><br>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend onclick="DoToggle('#JobInfoDiv')">Job Information</legend>
                    <div id="JobInfoDiv" class="feildwrap">
                        <div>
                            <label style="margin-left: -48px;">Job Request / VOC</label>
                            <textarea id="VOC" name="VOC" placeholder = "Write Voice of Customer" style="margin: 0px; width: 490px; height: 100px;"></textarea>
                        </div>
                        <div style="display: block !important;">
                            <fieldset style="margin-left: 72%;margin-top: -135px;width: 22%;min-width: 100px;">
                                <legend>Work Order Attach</legend>
                                <div id="WorkOrderDiv">
                                    <span style="margin-left: 50px;">Yes</span>
                                    <input id="Yes" type="radio" name="isWorkOrder" value="1">
                                    <span style="margin-left: 15px;">No</span>&nbsp;
                                    <input id="No" type="radio" name="isWorkOrder" value="0" checked>
                                </div>
                            </fieldset>
                        </div>
                        <div class="btn-block-wrap datagrid" style="margin-top: 05px;">
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
                <fieldset>
                    <legend onclick="DoToggle('#TotalAmountDiv')">Check List and Total Amount</legend>
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
                                        <div style="margin-left: 50px"><input class="Clist" id="CheckList<?php echo $Counter ?>" class="Clist" name="CheckList[]" type="checkbox" value="<?= $key['idROCheckList'] ?>"><?= $key['Name'] ?></div>
                                    <?php }
                                    ?>
                                </div>
                                <div id="">
                                    <label style="margin-left: -35px;">Tools Quantity</label>
                                    <input id="toolsQty" name="toolsQty" min='0' type="number" value="0" placeholder="Qty" style="width:50px;margin-left: 51px;">
                                </div>
                                <div>
                                    <label style="margin-left: -25px;">Is Orignal Tool(s)</label><br>
                                    <input id="Yes" name="isOrignial" value="1" type="radio" data-validation = "required" style="margin-left: 55px;" checked>Yes
                                    <input id="No" name="isOrignial" value="0" type="radio" data-validation = "required">No
                                </div><br>
                                <br>
                            </fieldset>
                        </div>
                        <div class="feildwrap" style=" width: 650px; float: right;">
                            <fieldset style=" width: 665px; min-width: 215px;margin-top: 15px; margin-left: -50px;">
                                <legend>Total Amount</legend>
                                <div class="feildwrap">
                                    <div>
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
                                    </div><br><br><br>
                                    <div>
                                        <label>Labour</label>
                                        <input id="Labour" type="text" name="Labour" onchange="calculateNetTotal()" placeholder="Labour Amount" value=0.0><span>&nbsp;Rs</span>
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
                <fieldset style="display: none">
                    <legend onclick="DoToggle('#PartsDiv')">Parts</legend>
                    <div id="PartsDiv" class="feildwrap">
                        <div id="" class="btn-block-wrap datagrid">
                            <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
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
                <br><fieldset>
                    <legend onclick="DoToggle('#ConsumableDiv')">Consumables / Sublet Repair</legend>
                    <div id="ConsumableDiv" class="feildwrap">
                        <div class="btn-block-wrap datagrid">
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
                </fieldset><br>
                <fieldset style="display: none">
                    <legend onclick="DoToggle('#LubDiv')">Lub Oil</legend>
                    <div id="LubDiv" class="feildwrap">
                        <div id="" class="btn-block-wrap datagrid">
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
                </fieldset><br>
                <fieldset>
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
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
		
		$(function() {
        $(".date").datepicker({
            showOn: "button",
            buttonImage: 'http://110.93.203.204:8282/twm/service/assets/images/date.png',
            buttonImageOnly: true,
            showButtonPanel: true,
            dateFormat: "dd-M-yy"
        });
    });
	
	
	$("#ReceptionDate").change(function(){
		  var search = $("#ReceptionDate").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/openedro/searchOpenedRODetailDate",
            type: "POST",
            data: {SearchByDate: search},
            success: function (data) {
                if (data !== "null")
                {
				//	console.log(data);return;
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var items = [];
                            var count = 1;
                            $.each(a, function (i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.RONumber + "</td>\n\
                            <td class='tbl-name'>" + val.BookingDate + "</td>\n\
                            <td class='tbl-name'>" + val.DeliveryDate + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerName + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerContact + "</td>\n\
                            <td class='tbl-name'>" + val.Vehicle + "</td>\n\
                            <td class='tbl-name'>" + val.RegNumber + "</td>\n\
                            <td class='tbl-name'>" + val.Mileage + "</td>\n\
                            <td class='tbl-name'>" + val.NetTotal + " /=</td>\n\
                            <td class='tbl-name'>" + val.Staff + "</td>\n\
                            <td class='tbl-name'>" + val.Foreman + "</td>\n\
                            <td class='tbl-name'><a style='cursor: pointer' onClick=getDetails('" + val.idRO + "')>Detail</a></td>\n\
                          <td name='' class='tbl-name'><a style='cursor: pointer' href='http://110.93.203.204:8282/twm/service/index.php/openedro/getRo/" + val.idRO + "'>Print</a></td>\n\
                            <td class='tbl-name'><a style='cursor: pointer' onClick=cancelRO('" + val.idRO + "')>Cancel</a></td></tr>";
                            });
                            $('#rolistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#rolistbody").html("<td></td><td></td><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td>");
                    }
                }
            }
        });
	})
		
		
        $("#RoListForm").hide();
        $("#InputOther").hide();
        $("#inputMakeDiv").hide();
        $(".chosen-select").chosen();
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
    });
    // For Work Performed Table
    var counter = 1;
    $("#newRow").click(function (e) {
        $("#newRow").val('-');
        counter = counter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'WorkPerformed[]' style = 'width: 687px;background: #fff; border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'WorkPerformed' placeholder = 'Work to be Performed' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='WorkPerformedHrs[]' style='width: 85px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedHrs' placeholder='Hrs' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='WorkPerformedAmount[]' style='width: 70px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='WorkPerformedAmount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteWorkRow(this)'></td></tr>";
        $('#tblworkperformed').append(items);
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
                "<td class='tbl-price'><input type='date' name='SubletDate[]' style='width: 135px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletDate' placeholder='Date' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletQunatity[]' style='width: 30px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletQunatity' placeholder='Qty' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletRef[]' style='width: 198px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='SubletRef' placeholder='Reference' data-validation = 'required'></td>" +
                "<td class = 'tbl-description'><input type = 'text' name = 'SubletDesc[]' style = 'width: 340px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id = 'SubletDesc' placeholder = 'Description' data-validation = 'required'></td>" +
                "<td class='tbl-price'><input type='text' name='SubletAmount[]' onkeyup=calculateTotal() style='width: 60px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' class='ClassSubletAmount' id='SubletAmount' placeholder='Amount' data-validation = 'required'></td>" +
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

        if (value === "") {
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

    var dropDown = [];
    dropDown += "<br><div id='SlctOtherJobs'><select class='otherJobs' id='MechJob' name='MechJob[]' multiple style='margin: 0px; width: 200px; height: 35px;'><option>Select Other Jobs</option>";
    function addOtherJobs() {
        dropDown = [];
        dropDown += "<br><div id='SlctOtherJobs'><select class='otherJobs' id='MechJob' name='MechJob[]' multiple style='margin: 0px; width: 200px; height: 35px;'><option>Select Other Jobs</option>";
        $.ajax({
            url: "<?= base_url() ?>index.php/rolist/getOtherJobs",
            type: "GET",
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.length > 0) {
                    $.each(data, function (index, name) {
                        dropDown += "<option value=" + name['idJobRef'] + ">" + name['JobTask'] + "</option>";
                    });
                    dropDown += "</select></div><br>";
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
                url: "<?= base_url() ?>index.php/rolist/getModel",
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
                url: "<?= base_url() ?>index.php/rolist/getAllVehicles",
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

    function getDetails(idRO) {

        $('#RoList').hide();
        $('#RoListForm').show();
        $(".chosen-select").chosen();
        var search = idRO;
        $.ajax({
            url: "<?= base_url() ?>index.php/rolist/getRODetail",
            type: "POST",
            data: {idRO: search},
            success: function (data) {
                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
                    console.log(parsedData);
                    console.log(parsedData);
                    if (parsedData.length > 0) {
                        try {
                            $('#idRO').val(parsedData[0]['idRO']);
                            $('#RoNumber').val(parsedData[0]['RONumber']);
                            $('#CashMemo').val(parsedData[0]['CashMemo']);
                            $('#CreditMemo').val(parsedData[0]['CreditMemo']);
                            $('#BookDate').val(parsedData[0]['BookingDate']);
                            $('#BookTime').val(parsedData[0]['BookingTime']);
                            $('#DeliveryDate').val(parsedData[0]['DeliveryDate']);
                            $('#DeliveryTime').val(parsedData[0]['DeliverTime']);
                            $('#idCustomer').val(parsedData[0]['idCustomer']);
                            $('#CompanyName').val(parsedData[0]['CompanyName']);
                            $('#CompanyContact').val(parsedData[0]['CompanyContact']);
                            $('#CustomerName').val(parsedData[0]['CustomerName']);
                            $('#CustomerContact').val(parsedData[0]['CustomerContact']);
                            $('#CustomerNIC').val(parsedData[0]['CNIC']);
                            $('#CustomerNTN').val(parsedData[0]['NTN']);
                            $('#CustomerAddress').val(parsedData[0]['Address']);
                            $('#idVehicle').val(parsedData[0]['idVehicle']);
                            $('#inputMake').val(parsedData[0]['Vehicle']);
                            $('#Model').val(parsedData[0]['Model']);
                            $('#RegNumber').val(parsedData[0]['RegNumber']);
                            $('#KM').val(parsedData[0]['Mileage']);
                            $('#FrameNumber').val(parsedData[0]['FrameNumber']);
                            $('#EngineNumber').val(parsedData[0]['EngineNumber']);
                            $('#ModelCode').val(parsedData[0]['ModelCode']);
                            $('#EstNum').val(parsedData[0]['EstNumber']);
                            $('#Year').val(parsedData[0]['Year']);
                            $('#FinanceRefNo').val(parsedData[0]['FinanceRefNo']);
                            $('#Labour').val(parsedData[0]['Labour']);
                            $('#LubOil').val(parsedData[0]['LubOilAmount']);
                            $('#SubletRepair').val(parsedData[0]['SubletRepairAmount']);
                            $('#Parts').val(parsedData[0]['PartsAmount']);
                            $('#GrandTotal').val(parsedData[0]['GrandTotal']);
                            $('#GST').val(parsedData[0]['GSTax']);
                            $('#NetTotal').val(parsedData[0]['NetTotal']);
                            $('#ColourCode').val(parsedData[0]['ColorPaintCode']);
                            $('#InsuranceCode').val(parsedData[0]['InsuranceCode']);
                            $('#Surveyor').val(parsedData[0]['Surveyor']);
                            $('#BPRoRef').val(parsedData[0]['BPRORefNum']);
                            $('#MechRORef').val(parsedData[0]['MechRORefNum']);
                            $('#LabourRs').val(parsedData[0]['ApprovedLabourRs']);
                            $('#DepAmountRs').val(parsedData[0]['DepreciationAmountRs']);
                            $('#InvoiceNum').val(parsedData[0]['InvoiceNumber']);
                            $('#InvoiceDate').val(parsedData[0]['InvoiceDate']);
                            $('#BPDeliveryDate').val(parsedData[0]['BPDeliveryDate']);
                            $('#VOC').val(parsedData[0]['VOC']);
                            if (parsedData[0]['idBodyPaint'] != null) {
                                $('.ismclass').hide();
                                $('#MechanicalDiv').hide();
                                $('#PMSelectDiv').hide();
                                $('#BPaintDiv').show();
                                $('#idBodyPaint').val(parsedData[0]['idBodyPaint']);
                                var idBpJob = [];
                                var BpJob = [];

                                for (var i = 0; i < parsedData.length; i++) {
                                    idBpJob.push(parsedData[i]['idJobRefBP']);
                                    BpJob.push(parsedData[i]['JobTaskBP']);
                                }
                                idBpJob = removeDuplications(idBpJob);
                                BpJob = removeDuplications(BpJob);

                                $(".SBp > option").each(function () {
                                    if ($(this).text() == BpJob) {
                                        $(this).prop('selected', true);
                                    }
                                });
                                $("#SelectJob").chosen();

                            } else {
                                $('.isbclass').hide();
                                $('#BPaintDiv').hide();
                                $('#MechanicalDiv').show();
                                $('#PMSelectDiv').show();
                                $('#idPMPackage').val(parsedData[0]['idRoPMPackage']);
                                $('[name=SelectPMPackage] option').filter(function () {
                                    return ($(this).text() === parsedData[0]['PMPackage']);
                                }).prop('selected', true);

                                var idPJob = [];
                                var pJob = [];
                                var idOtherjob = [];
                                var Otherjob = [];

                                for (var i = 0; i < parsedData.length; i++) {
                                    $('.MechJob').filter(function () {
                                        return ($(this).val() === parsedData[i]['idJobRef']);
                                    }).prop('checked', true);

                                    idPJob.push(parsedData[i]['idPmdJobs']);
                                    pJob.push(parsedData[i]['PMJobs']);
                                    idOtherjob.push(parsedData[i]['idJobRef']);
                                    Otherjob.push(parsedData[i]['JobTask']);
                                }
                                idPJob = removeDuplications(idPJob);
                                pJob = removeDuplications(pJob);
                                idOtherjob = removeDuplications(idOtherjob);
                                Otherjob = removeDuplications(Otherjob);

                                for (val in Otherjob) {
                                    dropDown += "<option selected value=" + idOtherjob[val] + ">" + Otherjob[val] + "</option>";
                                }
                                dropDown += "</select></div><br>";
                                $("#otherJobDiv").append(dropDown);
                                $(".otherJobs").chosen();

                                for (val in pJob) {
                                    $("#PMJobsDiv").append('&nbsp;&nbsp;&nbsp;<input name="PmJobs[]" type="checkbox" value=' + idPJob[val] + ' checked /> ' + pJob[val]);
                                }
                            }
                            for (var i = 0; i < parsedData.length; i++) {
                                $('.ConditionDetail').filter(function () {
                                    return ($(this).val() === parsedData[i]['idConditionDetail']);
                                }).prop('checked', true);

                                $('.Clist').filter(function () {
                                    return ($(this).val() === parsedData[i]['idCheckList']);
                                }).prop('checked', true);
                            }
                            $('#toolsQty').val(parsedData[0]['ToolsQuantity']);
                            if (parsedData[0]['isOrignalTools'] === '1') {
                                $('#Yes').prop('checked', true);
                            } else {
                                $('#No').prop('checked', true);
                            }
                            $('[name=isWorkOrder]').filter(function () {
                                return ($(this).val() === parsedData[0]['WorkOrderAttached']);
                            }).prop('checked', true);
                            $('[name=FinanceList]').filter(function () {
                                return ($(this).val() === parsedData[0]['WorkOrderAttached']);
                            }).prop('checked', true);
                            $('[name=Make] option').filter(function () {
                                return ($(this).text() === parsedData[0]['Vehicle']);
                            }).prop('selected', true);
                            $('[name=idStaff] option').filter(function () {
                                return ($(this).text() === parsedData[0]['Staff']);
                            }).prop('selected', true);
                            $('[name=Foreman] option').filter(function () {
                                return ($(this).text() === parsedData[0]['Foreman']);
                            }).prop('selected', true);
                            $('[name=FinanceList]').filter(function () {
                                return ($(this).val() === parsedData[0]['idFinance']);
                            }).prop('checked', true);
                            $('[name=FuelVolume]').filter(function () {
                                return ($(this).val() === parsedData[0]['idFuel']);
                            }).prop('checked', true);
                            $('[name=CNGVolume]').filter(function () {
                                return ($(this).val() === parsedData[0]['idCNG']);
                            }).prop('checked', true);
                            $('[name=LPGVolume]').filter(function () {
                                return ($(this).val() === parsedData[0]['idLPG']);
                            }).prop('checked', true);
                            $('[name=isM]').filter(function () {
                                return ($(this).val() === parsedData[0]['idROMode']);
                            }).prop('checked', true);

                            // Populating WorkPerformed Grid
                            $.ajax({
                                url: "<?= base_url() ?>index.php/rolist/getWorkPerformed",
                                type: "POST",
                                data: {idRO: search},
                                success: function (data) {
                                    var workData = JSON.parse(data);
                                    if (workData.length > 0) {
                                        for (var a = 0; a < workData.length; a++) {
                                            if ($('#tblworkperformed tr').length > workData.length) {
                                                $('#tblworkperformed tr:eq(' + a + ')').remove();
                                            } else {
                                                $('#tblworkperformed').append("<tr>\n\
                                                <td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
                                                <td class='tbl-ro-number'><input  type='text' name='WorkPerformed[]' style = 'width: 687px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder='Work Performed' data-validation = 'required'></td>\n\
                                                <td class='tbl-part-number' ><input  type='text' name='WorkPerformedHrs[]' style='width: 85px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder='Hours' data-validation = 'required'></td>\n\
                                                <td class='tbl-od'><input type='text' name='WorkPerformedAmount[]' style='width: 70px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Amount' data-validation = 'required'></td>\n\
                                                <td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteWorkRow(this)'></td>");
                                            }
                                        }
                                        for (var each in workData) {
                                            $('#tblworkperformed tr:eq(' + each + ') td:eq(' + 1 + ') input').val(workData[each]['WorkPerformed']);
                                            $('#tblworkperformed tr:eq(' + each + ') td:eq(' + 2 + ') input').val(workData[each]['WorkPerformedHrs']);
                                            $('#tblworkperformed tr:eq(' + each + ') td:eq(' + 3 + ') input').val(workData[each]['WorkPerformedAmount']);
                                        }
                                    } else {

                                    }
                                }
                            });

                            // Populating Sublet Grid
                            $.ajax({
                                url: "<?= base_url() ?>index.php/rolist/getSubletUseage",
                                type: "POST",
                                data: {idRO: search},
                                success: function (data) {
                                    var subData = JSON.parse(data);
                                    if (subData.length > 0) {
                                        for (var a = 0; a < subData.length; a++) {
                                            if ($('#tblSublets tr').length > subData.length) {
                                                $('#tblSublets tr:eq(' + a + ')').remove();
                                            } else {
                                                $('#tblSublets').append("<tr>\n\
                                                <td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
                                                <td class='tbl-ro-number' ><input type='date' name='SubletDate[]' style='width: 135px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder='Date'  data-validation = 'required'></td>\n\
                                                <td class='tbl-part-number' ><input type='text' name='SubletQunatity[]' style='width: 30px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder='Quantity' data-validation = 'required'></td>\n\
                                                <td class='tbl-od'><input type='text' name='SubletRef[]' style='width: 198px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Reference' data-validation = 'required'/></td>\n\
                                                <td class='tbl-req-qty'><input type='text' name='SubletDesc[]' style = 'width:340px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Description' data-validation = 'required' /></td>\n\
                                                <td class='tbl-req-qty'><input type='text' name='SubletAmount[]' style='width: 60px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Amount' data-validation = 'required' /></td>\n\
                                                <td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer' type='button' value='X' onclick='deleteSubletRow(this)'></td>");
                                            }
                                        }
                                        for (var each in subData) {
                                            $('#tblSublets tr:eq(' + each + ') td:eq(' + 1 + ') input').val(subData[each]['SubletDate']);
                                            $('#tblSublets tr:eq(' + each + ') td:eq(' + 2 + ') input').val(subData[each]['SubletQuantity']);
                                            $('#tblSublets tr:eq(' + each + ') td:eq(' + 3 + ') input').val(subData[each]['SubletReference']);
                                            $('#tblSublets tr:eq(' + each + ') td:eq(' + 4 + ') input').val(subData[each]['SubletDescription']);
                                            $('#tblSublets tr:eq(' + each + ') td:eq(' + 5 + ') input').val(subData[each]['SubletAmount']);
                                        }
                                    } else {

                                    }
                                }
                            });
                            // Populating LubOil Grid
                            $.ajax({
                                url: "<?= base_url() ?>index.php/rolist/getLubOilUseage",
                                type: "POST",
                                data: {idRO: search},
                                success: function (data) {
                                    var LubData = JSON.parse(data);
                                    if (LubData.length > 0) {
                                        for (var a = 0; a < LubData.length; a++) {
                                            if ($('#tblLubricants tr').length > LubData.length) {
                                                $('#tblLubricants tr:eq(' + a + ')').remove();
                                            } else {
                                                $('#tblLubricants').append("<tr>\n\
                                                <td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
                                                <td class='tbl-ro-number' ><input type='date' name='LubDate[]' style='width: 135px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder='Date' data-validation = 'required'></td>\n\
                                                <td class='tbl-part-number' ><input type='text' name='LubQunatity[]' style='width: 30px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' placeholder='Quantity' data-validation = 'required'></td>\n\
                                                <td class='tbl-od'><input type='text' name='LubDesc[]' style='width: 482px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description' data-validation = 'required'/></td>\n\
                                                <td class='tbl-req-qty'><input type='text' name='LubAmount[]' style='width: 60px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Amount' data-validation = 'required'/></td>\n\
                                                <td class='tbl-req-qty'><input  type='text' name='LubSignature[]' style='width: 60px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Signature' data-validation = 'required'/></td>\n\
                                                <td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer' type='button' value='X' onclick='deleteLubRow(this)'></td>");
                                            }
                                        }
                                        for (var each in LubData) {
                                            $('#tblLubricants tr:eq(' + each + ') td:eq(' + 1 + ') input').val(LubData[each]['LubDate']);
                                            $('#tblLubricants tr:eq(' + each + ') td:eq(' + 2 + ') input').val(LubData[each]['LubQuantity']);
                                            $('#tblLubricants tr:eq(' + each + ') td:eq(' + 3 + ') input').val(LubData[each]['LubDescription']);
                                            $('#tblLubricants tr:eq(' + each + ') td:eq(' + 4 + ') input').val(LubData[each]['LubAmount']);
                                            $('#tblLubricants tr:eq(' + each + ') td:eq(' + 5 + ') input').val(LubData[each]['LubSignature']);
                                        }
                                    } else {

                                    }
                                }
                            });
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {

                    }
                }
            }
        });
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
                            $("#PMJobsDiv").append('&nbsp;&nbsp;&nbsp;<input name="PmJobs[]" type="checkbox" value=' + name["idJobRef"] + ' checked /> ' + name['JobTask']);
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

    function removeDuplications(a) {
        var b = [];
        for (var x in a) {
            if (b.indexOf($.trim(a[x])) === -1) {
                b.push($.trim(a[x]));
            }
        }
        return b;
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

    $("#searchbyro").keyup(function () {
        var search = $("#searchbyro").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/openedro/searchOpenedRODetail",
            type: "POST",
            data: {SearchByRO: search},
            success: function (data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var items = [];
                            var count = 1;
                            $.each(a, function (i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.RONumber + "</td>\n\
                            <td class='tbl-name'>" + val.BookingDate + "</td>\n\
                            <td class='tbl-name'>" + val.DeliveryDate + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerName + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerContact + "</td>\n\
                            <td class='tbl-name'>" + val.Vehicle + "</td>\n\
                            <td class='tbl-name'>" + val.RegNumber + "</td>\n\
                            <td class='tbl-name'>" + val.Mileage + "</td>\n\
                            <td class='tbl-name'>" + val.NetTotal + " /=</td>\n\
                            <td class='tbl-name'>" + val.Staff + "</td>\n\
                            <td class='tbl-name'>" + val.Foreman + "</td>\n\
                            <td class='tbl-name'><a style='cursor: pointer' onClick=getDetails('" + val.idRO + "')>Detail</a></td>\n\
							  <td name='' class='tbl-name'><a style='cursor: pointer' href='http://110.93.203.204:8282/twm/service/index.php/openedro/getRo/" + val.idRO + "'>Print</a></td>\n\
                            <td class='tbl-name'><a style='cursor: pointer' onClick=cancelRO('" + val.idRO + "')>Cancel</a></td></tr>";
                            });
                            $('#rolistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#rolistbody").html("<td></td><td></td><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td>");
                    }
                }
            }
        });
    });

//    Last Code of this Method
//    function validationform() {
//        var staffSlct = $('#idStaff').val();
//        var foremanSlct = $('#Foreman').val();
//        var makeSlct = $('#SelectMake').val();
//        if (staffSlct === "Select Technician" && foremanSlct === "Select Foreman" && makeSlct === "Select Make")
//        {
//            $(".error-staff").show();
//            $(".error-foreman").show();
//            $(".error-make").show();
//            return false;
//        } else {
//            if (staffSlct === "Select Technician" || foremanSlct === "Select Foreman" || makeSlct === "Select Make")
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
//
//                if (makeSlct === "Select Make") {
//                    $(".error-make").show();
//                } else {
//                    $(".error-make").hide();
//                }
//
//                return false;
//            }
//            return true;
//        }
//    }
</script>


