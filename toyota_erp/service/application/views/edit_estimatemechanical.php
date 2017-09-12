<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/estimate_leftmenu.php';
        } else {
//            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form id="estmechanicalform" action="<?= base_url() ?>index.php/estimatemechanical/save_edit" method="post"
                  onSubmit="return validationform()" class="form validate-form animated fadeIn">
                <h4 style="margin-left: 230px;"><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Mechanical Estimate</legend>
                    <fieldset>
                        <legend onclick="DoToggle('#CustomerInfoDiv')">Customer Information</legend>
                        <div id="CustomerInfoDiv" class="feildwrap">
                            <div style="display: none;">
                                <label>S.No</label>
                                <input id="SNO" type="text" name="SNO" placeholder="Serial Number" style="width: 150px;"
                                       value="<?php
                                       //                                       if ($serialNumber != Null) {
                                       //                                           echo $serialNumber + 1;
                                       //                                       } else {
                                       //                                           echo '0';
                                       //                                       }
                                       ?>" readonly>
                            </div>
							<div style="margin-left: 0px;">
                                <label>Existing Customer</label>
                                <input type="text" name="searchbyreg" id="searchbyreg"
                                       placeholder="Search by Reg.Num / Frame-Num / Engine-Num / Est.Num / Model"
                                       style="width: 400px;">
                                <span id="regresult" name="RegResult"
                                      style="margin-left:05px;font-weight: bolder;font-size: 14px;">New Customer</span>
                            </div>
                            <div style="float: right;">
                                <label>Estimate Date</label>
                                <input id="Date" type="text" name="Date" class="date" placeholder="Date"
                                       data-validation="required" style="width:150px;">
                            </div>
                            <br><br><br><br>
                            
                            <br><br>
                            <div>
                                <label>Company Name</label>
                                <input id="CompanyName" type="text" name="CompanyName" placeholder="Enter Company Name"
                                       data-validation="" style="width: 150px;">
                            </div>
                            <div>
                                <label>Company Contact No.</label>
                                <input id="CompanyContact" type="text" name="CompanyContact"
                                       placeholder="Enter Company Contact" data-validation="" style="width: 150px;">
                            </div>
                            <br>
                            <div>
                                <label>Customer Name</label>
                                <input id="CustomerName" type="text" name="CustomerName"
                                       placeholder="Enter Customer Name" data-validation="required"
                                       style="width: 150px;">
                            </div>
                            <div>
                                <label>Tel-1</label>
                                <input class="MobileNo" id="CustomerContact" type="text" name="CustomerContact"
                                       placeholder="Enter Contact Number" data-validation="required"
                                       style="width: 150px;">
                            </div>
                            <br>
                            <div>
                                <label>Tel-2</label>
                                <input Class="MobileNo" id="PhoneOne" type="text" name="PhoneOne"
                                       placeholder="Enter Contact Number" data-validation="" style="width: 150px;">
                            </div>
                            <div>
                                <label>Tel-3</label>
                                <input Class="MobileNo" id="PhoneTwo" type="text" name="PhoneTwo"
                                       placeholder="Enter Contact Number" data-validation="" style="width: 150px;">
                            </div>
                            <div>
                                <label>Email</label>
                                <input class="" id="CustomerEmail" type="email" name="CustomerEmail"
                                       placeholder="Enter Customer Email" data-validation="" style="width: 150px;">
                            </div>
                            <div>
                                <label>ATTN: Mr.</label>
                                <input id="ATTN" type="text" name="ATTN" placeholder="Enter ATTN" style="width: 150px;">
                            </div>
                            <div>
                                <label>Fax No.</label>
                                <input class="FaxNo" id="CustomerFax" type="text" name="CustomerFax"
                                       placeholder="Enter Fax Number" style="width: 150px;">
                            </div>
							<div>
                                <label>NTN.</label>
                                <input class="NTN" id="NTN" type="text" name="NTN"
                                       placeholder="Enter NTN Number" style="width: 150px;">
                            </div>
							<div>
                                <label>GST NUMBER.</label>
                                <input class="GST_NUMBER" id="GST_NUMBER" type="text" name="GST_NUMBER"
                                       placeholder="Enter GST NUMBER" style="width: 150px;">
                            </div>
                            <br>
                            <div>
                                <label>Address</label>
                                <textarea id="CustomerAddress" name="CustomerAddress" placeholder="Enter Address"
                                          style="margin: 0px; width: 600px; height: 100px;"></textarea>
                            </div>
                            <br>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#VehicleInfoDiv')">Vehicle Information</legend>
                        <div id="VehicleInfoDiv" class="feildwrap">
                            <div id="SelectBrandDiv">
                                <label>Select Brand</label>
                                <select id="SelectBrand" name="SelectBrand" onchange="getModels(this)"
                                        style="width: 172px;">
                                    <option>Select Brand</option>
                                    <?php
                                    foreach ($brandsList as $key) {
                                        $idAllBrands = $brandsList['idAllBrands'];
                                        ?>
                                        <option value="<?= $key['idAllBrands'] ?>"><?= $key['BrandName'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="SelectModelDiv">
                                <label>Select Model</label>
                                <select id="SelectModel" name="SelectModel" onclick="getAllVehicles(this)"
                                        style="width: 172px;">
                                    <option>Select Model</option>
                                </select>
                            </div>
                            <div id="SelectMakeDiv">
                                <label>Select Make</label>
                                <select id="SelectMake" name="Make" style="width: 172px;">
                                    <option>Select Make</option>
                                </select>
                            </div>
                            <div id="inputMakeDiv">
                                <label>Make</label>
                                <input id="inputMake" type="text" name="inputMake" placeholder="Enter Make"
                                       data-validation="">
                            </div>
                            <div>
                                <label>Model</label>
                                <input id="Model" type="text" name="Model" placeholder="Enter Model"
                                       style="width: 150px;">
                            </div>
                            <br>
                            <div>
                                <label>Range</label>
                                <select id="Range" name="Range" style="width: 172px;">
                                    <option>Select Range</option>
                                    <option value="RangeOneAmount">Range 1</option>
                                    <option value="RangeTwoAmount">Range 2</option>
                                    <option value="RangeThreeAmount">Range 3</option>

                                </select>
                            </div>
                            <br>
                            <div>
                                <label>Year</label>
                                <input id="Year" type="text" name="Year" placeholder="Enter Year" style="width: 150px;">
                            </div>
                            <div>
                                <label>Reg No.</label>
                                <input id="RegistrationNumber" type="text" name="RegistrationNumber"
                                       placeholder="Enter Reg Number" data-validation="required" style="width: 150px;">
                            </div>
                            <br>
                            <div>
                                <label>Chassis No.</label>
                                <input id="FrameNumber" type="text" name="FrameNumber"
                                       placeholder="Enter Chassis Number" style="width: 150px;">
                                <input type="button" class="btn" value="Take Value" style="" onclick="trimModelText()">
                            </div>
                            <div>
                                <label>Engine No.</label>
                                <input id="EngineNumber" type="text" name="EngineNumber"
                                       placeholder="Enter Engine Number" style="width: 150px;">
                            </div>
                            <div>
                                <label>KM</label>
                                <input id="KM" type="text" name="KM" placeholder="Enter KM" style="width: 150px;">
                            </div>
                        </div>
                    </fieldset>
                    <input type="checkbox" id="is_PM" value="1" name="is_PM"/> <label for="is_PM">PM Package</label>
                    <fieldset id="PM_jobs">
                        <legend onclick="DoToggle('#Package')">PM Packages</legend>
                        <div id="Package" class="feildwrap">
                            <div class="btn-block-wrap datagrid">
                                <table id="" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th width="02%">S.NO</th>
                                        <th width="50%">PM Package</th>
                                        <th width="48%">Amount</th>

                                    </tr>
                                    </thead>
                                    <tfoot class="">
                                    <tr>
                                        <td colspan="3">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                    </tfoot>

                                    <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRow">+</span>-->
                                    <tbody>
                                    <tr class="">
                                        <td class="tbl-count">1</td>
                                        <td class="tbl-part">
                                            <select class="chosen-select slctboxes" name="pm_package"  data-validation="" id="pm_package">
                                                <option>Select PM Package</option>
												<?php
                                                foreach ($pmdList as $key) {
                                                    ?>
                                                    <option value="<?= $key['idPeriodicMaintenanceDetail'] ?>" ><?= $key['PeriodName'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="tbl-part">
                                            <input type="text" name="pm_amount" id="pm_amount" style=" width: 260px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);" id="amount" placeholder="Amount">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id="GR_jobs">
                        <legend onclick="DoToggle('#JobDescDiv')">Job Description</legend>
                        <div id="JobDescDiv" class="feildwrap">
                            <div class="btn-block-wrap datagrid">
                                <table id="EstMJobTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th width="02%">S.NO</th>
                                        <th width="50%">Job Description</th>
                                        <th width="45%">Amount</th>
                                        <th width="03%">X</th>
                                    </tr>
                                    </thead>
                                    <tfoot class="">
                                    <tr>
                                        <td colspan="4">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                    </tfoot>
                                    <input name="newRow"
                                           style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer "
                                           id="newRow" value="+" readonly>
                                    <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRow">+</span>-->
                                    <tbody id="MJobDesc">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#PartsEstimateDiv')">Parts Description</legend>
                        <div id="PartsEstimateDiv" class="feildwrap">
                            <div class="btn-block-wrap datagrid">
                                <table id="PartsEstimateTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Parts Name</th>
                                        <th>Parts Number</th>
                                        <th>Amount</th>
                                        <th>X</th>
                                    </tr>
                                    </thead>
                                    <input name="newPartsRow"
                                           style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer "
                                           id="newPartsRow" value="+" readonly>
                                    <tbody id="PartsEstimateTbody">
                                    </tbody>
                                </table>
                            </div>
                    </fieldset>
					<br>
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
					
                    <br>
                    <fieldset>
                        <legend>Signature</legend>
                        <div class="feildwrap">
                            <div>
                                <label>Service Advisor</label>
                                <input id="ServiceAdvisor" name="ServiceAdvisor" placeholder="Signature" value="<?php
                                $data = unserialize($_COOKIE['logindata']);
                                echo $data['username'];
                                ?>" readonly>
                                <!--   <select id="ServiceAdvisor" name="ServiceAdvisor">
                                    <option>Select Service Advisor</option>
                                    <?php
                                //   foreach ($serviceAdvList as $key) {
                                ?>
                                        <option value="<? //= $key['idStaff'] ?>" ><? //= $key['Name'] ?></option>
                                        <?php
                                //    }
                                ?>
                                </select>-->
                                <span class="error-serviceadv cb-error help-block">Select Option</span>
                            </div>
                            <!--     <div>
                                     <label>Signature</label>
                                     <input id ="Signature" name="Signature" placeholder="Signature">
                                 </div> -->
                            <div class="btn-block-wrap">
                                <label>&nbsp;</label>
                                <label>&nbsp;</label>
                                <label>&nbsp;</label><br>
                                <input type="submit" class="btn" value="OK" style="margin-left: 400px;width: 180px;">
                            </div>
                        </div>
                    </fieldset>
                </fieldset>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
  function deleteSubletRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('SubletTableBP').deleteRow(i);
    }
	
		 function deleteSubletRowBP(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('SubletTableBP').deleteRow(i);
    }
    $(document).ready(function () {
		
	
		
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
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteSubletRow(this)'></td></tr>";
        $('#tblSubletsBP').append(items);
    });
	
	

		var alljobs = <?php echo json_encode($allJobs);?>;
		console.log(alljobs);
        $("select[name='pm_package']").chosen();
        $("#PM_jobs").hide();
        $("#is_PM").click(function () {
            if ($('#is_PM').prop('checked')) {
                $("#PM_jobs").show();
                $("#GR_jobs").hide();
            } else {
                $("#PM_jobs").hide();
                $("#GR_jobs").show();

            }

        });

        $("#inputMakeDiv").hide();
        $("#regresult").hide();
    });

    var counter = 1;
    $("#newRow").click(function (e) {
        $("#newRow").val('-');
        counter = counter + 1;
        var items = "";
			var alljobs = <?php echo json_encode($allJobs);?>;
        items +=
            "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td>" +
            "<td class = 'tbl-description'><select id='mechjobdesc' name='MechJobDesc[]' onchange=getJobDetails(this) placeholder = '' class = 'chosen-select slctboxes' style = 'width: 440px;background: #fff;  border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Job</option>";
                for(j=0;j<alljobs.length;j++) {
               items += "<option value="+ alljobs[j]['idJobRef'] +">"+ alljobs[j]['JobTask'] +"</option>";
			   } ;
			   
			   items += "</select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
            "<td class='tbl-price'><input type='text' name='MechJobAmount[]' style='width: 340px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechjobamount' placeholder='Amount' data-validation = 'required'></td>" +
            "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteRow(this)'></td></tr>";
        $('#MJobDesc').append(items);
        $("select[name='MechJobDesc[]']").chosen();
    });

    $("#newPartsRow").click(function (e) {
        counter = counter + 1;
        var items = "";
        items += "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td>" +
            "<td class='tbl-part'><select onchange=getPartDetails(this) class='chosen-select slctboxes' name='PartsName[]' style=' width: 212px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsName' data-validation=''><option>Select Part Name</option><?php
                foreach ($partsList as $val) {
                ?><option value='<?= $val['idPart'] ?>'><?= $val['PartName'] ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
            "<td class='tbl-part'><input type='text' name='PartsNumber[]' style=' width: 260px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechpartsname' placeholder='Part Number' readonly></td>" +
            "<td class='tbl-quantity'><input type='text' onkeyup= name='PartsAmount[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsAmount' placeholder='Amount' data-validation = ''></td>" +
            "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deletePartsRow(this)'></td></tr>";
        $('#PartsEstimateTbody').append(items);
        $("select[name='PartsName[]']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='PartsNumber[]']").chosen({no_results_text: "Oops, nothing found!"});

    });

    $("#searchbyreg").focusout(function () {
        var search = $("#searchbyreg").val();
        if (search !== "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/estimatemechanical/searchExistingCustomer",
                type: "POST",
                data: {searchbyreg: search},
                success: function (data) {

                    if (data !== "null") {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
							console.log(parsedData);
                            $("#regresult").show();
                            $("#regresult").html("Customer is Already Registered");
                            $("#SelectBrandDiv").hide();
                            $("#SelectModelDiv").hide();
                            $("#SelectMakeDiv").hide();
                            $("#inputMakeDiv").show();
                            $('#CompanyName').val(parsedData[0]['CompanyName']);
                            $('#CompanyContact').val(parsedData[0]['CompanyContact']);
                            $('#CustomerName').val(parsedData[0]['CustomerName']);
                            $('#CustomerContact').val(parsedData[0]['Cellphone']);
                            $('#CustomerAddress').val(parsedData[0]['AddressDetails']);
                            $('#CustomerEmail').val(parsedData[0]['CustomerEmail']);
                            $('#PhoneOne').val(parsedData[0]['PhoneOne']);
                            $('#PhoneTwo').val(parsedData[0]['PhoneTwo']);
                            $('#ATTN').val(parsedData[0]['Attender']);
                            $('#GST_NUMBER').val(parsedData[0]['Gst']);
                            $('#inputMake').val(parsedData[0]['VehicleName']);
//                        $('#ATTN').val(parsedData[0]['AddressDetails']);
                            $('#CustomerFax').val(parsedData[0]['Fax']);
                           // $('#inputMake').val(parsedData[0]['idAllVehicles']);
                           // $('#inputMake').val(parsedData[0]['Variant']);
                            $('#Model').val(parsedData[0]['Model']);
                            $('#RegistrationNumber').val(parsedData[0]['RegistrationNumber']);
                            $('#KM').val(parsedData[0]['Mileage']);
                            $('#FrameNumber').val(parsedData[0]['ChassisNumber']);
                            $('#EngineNumber').val(parsedData[0]['EngineNumber']);
                            $('#Year').val(parsedData[0]['YEAR']);
                            $('#NTN').val(parsedData[0]['NTN']);
                            $('#CustomerFax').val(parsedData[0]['Fax']);
							
							$("#Range[").val(parsedData[0]['Range']);
							if(parsedData[0]['is_PM'] == 1){
								//$('#is_PM').trigger('click');
								$('#is_PM').prop('checked', true);
								  $("#PM_jobs").show();
                $("#GR_jobs").hide();
				$("#pm_amount").val(parsedData[0]['PM_amount']);
				$("#pm_package").val(parsedData[0]['PM_package']);
				$("#pm_package").trigger("chosen:updated");
							}else{
								 var counter = 1;
								 var alljobs = <?php echo json_encode($allJobs);?>;
   for(ii=0;ii<parsedData[0]['Jobs'].length;ii++){
        $("#newRow").val('-');
     
        counter = counter + 1;
        var items = "";
        items +=
            "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td>" +
            "<td class = 'tbl-description'><select id='mechjobdesc' name='MechJobDesc[]' onchange=getJobDetails(this) placeholder = '' class = 'select_val_"+ii+" chosen-select slctboxes' style = 'width: 440px;background: #fff;  border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Job</option>";
                for(j=0;j<alljobs.length;j++) {
               items += "<option  value="+ alljobs[j]['idJobRef'] +">"+ alljobs[j]['JobTask'] +"</option>";
			   } ;
			   
			   items += "</select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
            "<td class='tbl-price'><input type='text' name='MechJobAmount[]'  value='"+parsedData[0]['Jobs'][ii]['RangeAmount']+"' style='width: 340px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechjobamount' placeholder='Amount' data-validation = 'required'></td>" +
            "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteRow(this)'></td></tr>";
        $('#MJobDesc').append(items);
		$(".select_val_"+ii).val(parsedData[0]['Jobs'][ii]['idJob']);
		$(".select_val_"+ii).trigger("chosen:updated");
        $(".select_val_"+ii).chosen();
   }
								
							}
						if(parsedData[0]['Parts'].length > 0){
							   $("#newPartsRow").val('-');
							var counter2 = 1;
							for(ii=0;ii<parsedData[0]['Parts'].length;ii++){
							 counter2 = counter2 + 1;
        var items = "";
        items += "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter2 - 1) + "</td>" +
            "<td class='tbl-part'><select onchange=getPartDetails(this) class='p_select_val_"+ii+" chosen-select slctboxes' name='PartsName[]' style=' width: 212px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsName' data-validation=''><option>Select Part Name</option><?php
                foreach ($partsList as $val) {
                ?><option value='<?= $val['idPart'] ?>'><?= $val['PartName'] ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
            "<td class='tbl-part'><input type='text' name='PartsNumber[]'  value='"+parsedData[0]['Parts'][ii]['PartNumber']+"' style=' width: 260px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechpartsname' placeholder='Part Number' readonly></td>" +
            "<td class='tbl-quantity'><input type='text' onkeyup= name='PartsAmount[]' value='"+parsedData[0]['Parts'][ii]['RetailPrice']+"' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='PartsAmount' placeholder='Amount' data-validation = ''></td>" +
            "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deletePartsRow(this)'></td></tr>";
        $('#PartsEstimateTbody').append(items);
		$(".p_select_val_"+ii).val(parsedData[0]['Parts'][ii]['idPart']);
		$(".p_select_val_"+ii).trigger("chosen:updated");
        $(".p_select_val_"+ii).chosen();
							}
						}	
						if(parsedData[0]['Sublet'].length > 0){
						var SubletCounterBP = 1;	
						 $("#newRowSubletBP").val('-');
						 for(ii=0;ii<parsedData[0]['Parts'].length;ii++){
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
        $('#tblSubletsBP').append(items);	
							
							
						}
						}
							
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

	$('#pm_package').change(function () {
		var id =  $('#pm_package').val();
		var range =  $('#Range').val();
		
		$.post( 
                  "<?=  base_url()?>index.php/estimatemechanical/getamount",
                  { id: id , range : range },
                  function(data) {
                     var value = JSON.parse(data);
                     $('#pm_amount').val(value);
                  }
               );
	});
    function DoToggle(id) {
        $(id).toggle();
    }

    function getModels(obj) {
        var brand = $(obj).val();
        $("#SelectModel").empty();
        if (brand !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/estimatemechanical/getModel",
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
                url: "<?= base_url() ?>index.php/estimatemechanical/getAllVehicles",
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

    function getJobDetails(Source) {
        var idJob = $(Source).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Estimatemechanical/getJobDetails",
            type: "POST",
            data: {idJob: idJob},
            success: function (data) {
                if (data !== "null") {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function (i, val) {
//                            $("input[name='MechJobAmount[]']").val(val.TimeTaken);
//                            $(Source).closest('td').next('td').find('input').val('Range-1: ' + val.RangeOneAmount + '/=,  Range-2: ' + val.RangeTwoAmount + '/=,  Range-3: ' + val.RangeThreeAmount + '/=');
                            var rangevalue = $("#Range").val();
                            //  console.log(rangevalue);
                            if (rangevalue == "RangeOneAmount") {
                                $(Source).closest('td').next('td').find('input').val(val.RangeOneAmount + ' /=');
                            } else if (rangevalue == "RangeTwoAmount") {

                                $(Source).closest('td').next('td').find('input').val(val.RangeTwoAmount + ' /=');
                            } else if (rangevalue == "RangeThreeAmount") {

                                $(Source).closest('td').next('td').find('input').val(val.RangeThreeAmount + ' /=');
                            } else {

                                $(Source).closest('td').next('td').find('input').val(val.RangeOneAmount + ' /=');
                            }
                        });
                    }
                }
                else {
                }
            }
        });
    }

    function getPartDetails(obj) {
        var idPart = $(obj).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/estimatebodyshop/getPartDetails",
            type: "POST",
            data: {idPart: idPart},
            success: function (data) {
                if (data !== "null") {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function (i, val) {
                            $(obj).closest('td').next('td').find('input').val(val.PartNumber);
                            $(obj).closest('td').next('td').next('td').find('input').val(val.RetailPrice);
                        });
                    } else {
                        $(obj).closest('td').next('td').find('input').val('-');
                        $(obj).closest('td').next('td').next('td').find('input').val('Not Exist');
                    }
                }
                else {
                }
            }
        });
    }

    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('EstMJobTable').deleteRow(i);
    }

    function deletePartsRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('PartsEstimateTable').deleteRow(i);
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
    function validationform() {
        var staffSlct = $('#ServiceAdvisor').val();
        var countJobRows = $("#EstMJobTable > tbody").children().length;
        var countPartsRows = $("#PartsEstimateTable > tbody").children().length;
        var isValidate = 1;
        if (countJobRows > 0) {
            $('#newRow').val('-');
            var selects = $("#EstMJobTable").find(".slctboxes");
            for (var count = 0; count < selects.length; count++) {
                if ($(selects[count]).val() === "Select Job") {
                    isValidate = 0;
                    $(selects[count]).parent().find('span').show();
                } else {
                    $(selects[count]).parent().find('span').hide();
                }
            }
        } else {
            $('#newRow').val('+');
        }

        if (countPartsRows > 0) {
            $('#newPartsRow').val('-');
            var selects = $("#PartsEstimateTable").find(".slctboxes");
            for (var count = 0; count < selects.length; count++) {
                if ($(selects[count]).val() === "Select Part Name") {
                    isValidate = 0;
                    $(selects[count]).parent().find('span').show();
                } else {
                    $(selects[count]).parent().find('span').hide();
                }
            }
        } else {
            $('#newPartsRow').val('+');
        }

        if (staffSlct === "Select Service Advisor") {
            $(".error-serviceadv").show();
            isValidate = 0;
        } else {
            $(".error-serviceadv").hide();
        }

        if (isValidate === 0) {
            return false;
        } else {
            return true;
        }
    }
</script>
