<style>
    input:read-only {
        background-color: #aaa !important;
    }
</style>
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
            <form id="estmechanicalform" action="<?= base_url() ?>index.php/estimatemechanical/Add" method="post"
                  onSubmit="return validationform()" class="form validate-form animated fadeIn">
                <h4 style="margin-left: 230px;"><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Mechanical Estimate</legend>
                    <fieldset>
                        <legend onclick="DoToggle('#CustomerInfoDiv')">Customer Information</legend>
                        <div id="CustomerInfoDiv" class="feildwrap">
                            <div style="display: none;">
                                <label>S.No</label>
                                <input id="SNO" type="text" name="SNO" placeholder="Serial Number" style="width: 150px;"  readonly>
                            </div>

                            <div style="float: right;">
                                <label>Estimate Date</label>
                                <input id="Date" type="text" readonly name="Date" class="date" placeholder="Date" value="<?=date('d-M-Y')?>"
                                       data-validation="required" style="width:150px;">
                            </div>
                            <br><br><br><br>

                            <br><br>
                            <div>
                                <label>Customer Name</label>
                                <input type="text" name="CustomerName"  id="CustomerName">
                                <input type="hidden" name="idCustomer"  id="idCustomer">
                                <button type="button" class="btn" onclick="showpopup('customerlist')">List</button>
                            </div>

                            <div>
                                <label>Phone</label>
                                <input type="text" name="CompanyContact"  id="CompanyContact">
                            </div>
                            <div>
                                <label>Mobile</label>
                                <input type="text" class="MobileNo" name="Cellphone"  id="Cellphone">
                            </div>

                            <div>
                                <label>Address</label>
                                <textarea id="AddressDetails" name="CustomerAddress" placeholder="Enter Address"
                                          style="margin: 0px; width: 600px; height: 100px;"></textarea>
                            </div>

                            <div>
                                <label>Email</label>
                                <input type="text" name="CustomerEmail"  id="CustomerEmail">
                            </div>
                            <div>
                                <label>CNIC</label>
                                <input class="CNIC" id="Cnic" type="text" name="CustomerNIC" placeholder="Enter NIC" data-validation="">
                            </div>

                            <div>
                                <label>NTN.</label>
                                <input class="NTN" id="Ntn" type="text" name="NTN"
                                       placeholder="Enter NTN Number" style="width: 150px;">
                            </div>
                            <div>
                                <label>GST NUMBER.</label>
                                <input class="GST_NUMBER" id="Gst" type="text" name="Gst"
                                       placeholder="Enter GST NUMBER" style="width: 150px;">
                            </div>
                            <br>

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
                                <input id="ChassisNumber" type="text" name="ChassisNumber"
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
                                <input id="Mileage" type="text" name="KM" placeholder="Enter KM" style="width: 150px;">
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
                                            <select class="chosen-select slctboxes" name="pm_package" data-validation=""
                                                    id="pm_package">
                                                <option>Select PM Package</option>
                                                <?php
                                                foreach ($pmdList as $key) {
                                                    ?>
                                                    <option value="<?= $key['idPeriodicMaintenanceDetail'] ?>"><?= $key['PeriodName'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="tbl-part">
                                            <input type="text" name="pm_amount" id="pm_amount"
                                                   style=" width: 260px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"
                                                   id="amount" placeholder="Amount">
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
                                    <input name="newRowSubletBP"
                                           style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer "
                                           id="newRowSubletBP" value="+" readonly>
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

<div style="width: 750px;" class="feildwrap  popup popup-customerlist">
    <form action="" method="POST" class="form animated fadeIn" onSubmit="" style="width: 250px;">
        <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="margin-left: 25px;width: 0px;">
            <fieldset style="">
                <legend>Select Chassis</legend>
                <div class="feildwrap">
                    <table id="myTable" class="myTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>RegistrationNumber</th>
                            <th>EngineNumber</th>
                            <th>ChassisNumber</th>
                            <th>CustomerName</th>
                            <th>Cellphone</th>

                        </tr>
                        </thead>
                        <?php
                        $count = 0;
                        foreach ($customer_list as $row) {
                            ?>
                            <tr onclick="filldata(<?= $count++ ?>)">
                                <td><?= $count + 1 ?></td>

                                <td><?= $row['RegistrationNumber'] ?></td>
                                <td><?= $row['EngineNumber'] ?></td>
                                <td><?= $row['ChassisNumber'] ?></td>
                                <td><?= $row['CustomerName'] ?></td>
                                <td><?= $row['Cellphone'] ?></td>
                            </tr>

                        <?php } ?>
                    </table>
                </div>
            </fieldset>
        </div>
        <br>
    </form>
</div>
<script>


    $(".chosen-select").chosen()
    var cust_list = <?= json_encode($customer_list,false); ?>;
    function showpopup(div_id)
    {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
        });
    }
    function filldata(i){

        console.log(cust_list[i]);

        $.each((cust_list[i]),function(j,v){
            $('#'+j).val(v)
            $('#'+j).attr('readonly',true)
        })
        $(".chosen-select").trigger("chosen:updated");

        $('.popup' ).bPopup().close()
    }

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
        $("#newRowSubletBP").click(function (e) {

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
        for (j = 0; j < alljobs.length; j++) {
            items += "<option value=" + alljobs[j]['idJobRef'] + ">" + alljobs[j]['JobTask'] + "</option>";
        }
        ;

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


    $('#pm_package').change(function () {
        var id = $('#pm_package').val();
        var range = $('#Range').val();

        $.post(
            "<?=  base_url()?>index.php/estimatemechanical/getamount",
            {id: id, range: range},
            function (data) {
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

    $('.myTable').DataTable();
</script>
