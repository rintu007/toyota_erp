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
            <form id="estpdyshopform" action="<?= base_url() ?>index.php/estimatebodyshop/Add"  method="post" onSubmit="return validationform()" class="form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Body/Paint Estimate</legend>                  
                     <div class="feildwrap">
                        <div style="margin-left: 50px"><input class="Insurance" name="insurance_detail" type="radio"  value="Insurance" checked>Insurance</div>
                        <div style="margin-left: 50px"><input class="Customer" name="insurance_detail" type="radio"  value="Customer"  >Customer</div>
                    </div>
                    <fieldset id="insurance_detail">
                        <legend onclick="DoToggle('#InitialInfoDiv')">Initial Information</legend>
                        <div id="InitialInfoDiv" class="feildwrap">

                            <?php if(count($token)){ ?>
                                <div style="float: right;">
                                    <label>Token Number</label>
                                    <input id="Date" type="text" readonly name="" value="<?= 'T-'.date('dmy-').sprintf('%02d',$token->tokenNumber) ?>"
                                           data-validation="required" style="width:100px;">
                                    <input type="hidden" name="idToken" value="<?=$token->idToken?>">
                                </div>
                            <?php }?>
                            <!--                            <div>
                                                            <label>S.No</label>
                                                            <input id="SNO" type="text" name="SNO" placeholder="Serial Number" data-validation="" style="width: 150px;" 
                                                                   value="<?php
                            if ($serialNumber != Null) {
                                echo $serialNumber + 1;
                            } else {
                                echo '1';
                            }
                            ?>" readonly>
                                                        </div><br>-->
                                                        <div>
                                <label>P.M.C</label>
                                <input id="PMC" type="text" name="PMC" placeholder="Enter PMC" style="width: 150px;">
                            </div><br>
                            <div>
                                <label>Insurance Co.</label>
                                <select id="Insurance" name="Insurance" style="width: 172px;" onchange="getInsuranceCompanyDetails()">
                                    <option>Select Insurance Company</option>
                                    <?php
                                    foreach ($insCompanyList as $key) {
                                        ?>
                                        <option value="<?= $key['idInsuranceCompany'] ?>" ><?= $key['Name'] . ' (' . $key['CompanyCode'] . ')' ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="error-inscompany cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                            </div>
                            <div>
                                <label>Branch</label>
                                <select id="Branch" name="Branch" style="width: 172px;" onchange="">
                                    <option>Select Branch</option>
                                </select>
                            </div>
                            <div>
                                <label>Policy No.</label>
                                <input id="PolicyNubmber" type="text" name="PolicyNubmber" placeholder="Enter Policy Number" style="width: 150px;">
                            </div>
                            <div>
                                <label>Loss No.</label>
                                <input id="LossNumber" type="text" name="LossNumber" placeholder="Enter Loss Number" style="width: 150px;">
                            </div><br> 
                            <div>
                                <label>Surveyor</label>
                                <select id="SurveyorName" name="SurveyorName" style="width: 172px;" onchange="getSurveyorDetails()">
                                    <option>Select Surveyor</option>
                                    <?php
                                    foreach ($surveyorList as $key) {
                                        ?>
                                        <option value="<?= $key['idSurveyor'] ?>" ><?= $key['Name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="error-surveyor cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                            </div>
                            <div>
                                <label>Surveyor Phone</label>
                                <input class="" id="SurveyorPhone" type="text" name="" placeholder="Enter Surveyor Phone" style="width: 150px;" readonly>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#CustomerInfoDiv')">Customer Information</legend>
                        <div id="CustomerInfoDiv" class="feildwrap">
						    
<!--                            <div style="margin-left: 0px;">-->
<!--                                <label>Existing Customer</label>-->
<!--                                <input type="text" name="searchbyreg" id="searchbyreg" placeholder="Search by Reg.Num / Frame-Num / Engine-Num / Est.Num / Model" style="width: 400px;">-->
<!--                                <span id="regresult" name="RegResult" style="margin-left:05px;font-weight: bolder;font-size: 14px;">New Customer</span>-->
<!--                            </div><br><br>-->
							<div>
                                <label>Estimate Date</label>
                                <input id="Date" type="text" name="Date" value="<?=date('d-M-Y')?>" readonly class="date" placeholder="Date" data-validation="required" style="width: 150px;">
                            </div>
                            <div>
                                <label>Company Name</label>
                                <input id="CompanyName" type="text" name="CompanyName" placeholder="Enter Company Name"  data-validation = "" style="width: 150px;">
                                <button type="button" class="btn" id="listbtn" onclick="showpopup('customerlist')">List</button>

                            </div>
                            <div>
                                <label>Company Contact No.</label>
                                <input id="CompanyContact" type="text" name="CompanyContact" placeholder="Enter Company Contact"  data-validation = "" style="width: 150px;">
                            </div><br>

                            <div>
                                <label>Customer Name</label>
                                <input id="CustomerName" type="text" name="CustomerName"  placeholder="Enter Customer Name" data-validation="required" style="width: 150px;">
                                <input type="hidden" name="idCustomer"  id="idCustomer">
                            </div>
                            <div>
                                <label>ATTN Mr.</label>
                                <input id="ATTN" type="text" name="ATTN" placeholder="Enter ATTN" style="width: 150px;">
                            </div><br>                                                     
                            <div>
                                <label>Tel</label>
                                <input class="MobileNo" id="Cellphone" type="text" name="CustomerContact" placeholder="Enter Contact Number"  data-validation="required"style="width: 150px;">
                            </div>
                            <div>
                                <label>Tel-2</label>
                                <input Class="MobileNo" id="PhoneOne" type="text" name="PhoneOne" placeholder="Enter Contact Number" data-validation = "" style="width: 150px;">
                            </div>
                            <div>
                                <label>Tel-3</label>
                                <input Class="MobileNo" id="PhoneTwo" type="text" name="PhoneTwo" placeholder="Enter Contact Number" data-validation = "" style="width: 150px;">
                            </div>
                              <div>
                                <label>Email</label>
                                <input class="" id="CustomerEmail" type="email" name="CustomerEmail" placeholder="Enter Customer Email" data-validation = "" style="width: 150px;">
                            </div>
                            <div style="display: none">
                                <label>Fax No.</label>
                                <input class="FaxNo" id="CustomerFax" type="text" name="CustomerFax" placeholder="Enter Fax Number"  data-validation=" " style="width: 150px;">
                            </div><br>
							<div>
                                <label>NTN.</label>
                                <input class="NTN" id="Ntn" type="text" name="NTN" placeholder="Enter NTN Number"  data-validation=" " style="width: 150px;">
                            </div><br>
							<div>
                                <label>GST NUMBER.</label>
                                <input class="GST_NUMBER" id="Gst" type="text" name="GST_NUMBER" placeholder="Enter GST NUMBER"  data-validation=" " style="width: 150px;">
                            </div><br>
                            <div>
                                <label>Address</label>
                                <textarea id="AddressDetails" name="CustomerAddress" placeholder="Enter Address" style="margin: 0px; width: 600px; height: 100px;"></textarea>
                            </div>                       
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#VehicleInfoDiv')">Vehicle Information</legend>
                        <div id="VehicleInfoDiv" class="feildwrap">
                            <div id="SelectBrandDiv">
                                <label>Select Brand</label>
                                <select id="SelectBrand" name="SelectBrand" onchange="getModels(this)" style="width: 172px;">
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
                                <select id="SelectModel" name="SelectModel" onclick="getAllVehicles(this)" style="width: 172px;">
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
                                <input id="inputMake" type="text" name="inputMake" placeholder="Enter Make" data-validation = "">
                            </div>
                            <div>
                                <label>Model</label>
                                <input id="Model" type="text" name="Model" placeholder="Enter Model" style="width: 150px;">
                            </div><br>
                            <div>
                                <label>Year</label>
                                <input id="Year" type="text" name="Year" placeholder="Enter Year" style="width: 150px;">
                            </div>
                            <div>
                                <label>Reg No.</label>
                                <input id="RegistrationNumber" type="text" name="RegistrationNumber" placeholder="Enter Reg Number" data-validation="required" style="width: 150px;">
                            </div><br>
                            <div>
                                <label>Chassis No.</label>
                                <input id="ChassisNumber" type="text" name="ChassisNumber" placeholder="Enter Chassis Number"  style="width: 150px;" >
								<input type="button" class="btn" value="Take Value" style="" onclick="trimModelText()"> 
                            </div>                          
                            <div>
                                <label>Engine No.</label>
                                <input id="EngineNumber" type="text" name="EngineNumber" placeholder="Enter Engine Number" style="width: 150px;" >
                            </div>
                            <div>
                                <label>KM</label>
                                <input id="Mileage" type="text" name="KM" placeholder="Enter KM" style="width: 150px;">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="DoToggle('#JobDescDiv')">Job Description</legend>
                        <div id="JobDescDiv" class="feildwrap">
                            <div class="btn-block-wrap datagrid">
                                <table id="EstBPJobTable" width="100%" border="0" cellpadding="1" cellspacing="0">
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
                                    <input name="newRow" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRow" value="+" readonly>                                 
                                    <tbody id="BSJobDesc">
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
                                    <input name="newPartsRow" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newPartsRow" value="+" readonly>                                 
                                    <tbody id="PartsEstimateTbody">
                                    </tbody>
                                </table>
                            </div>
                    </fieldset>
                    <br>
					<fieldset>
                        <legend onclick="DoToggle('#ConsumableDiv')">Consumables / Sublet Repair</legend>
                        <div id="ConsumableDiv" class="feildwrap">
                            <div id="" class="btn-block-wrap datagrid" style="overflow-x: scroll;overflow-y: scroll;">
                                <input name="newRowSublet" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRowSublet" value="+" readonly=""><table id="SubletTable" width="100%" border="0" cellpadding="1" cellspacing="0">
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
                                    
                                    <tbody id="tblSublets">
                                    </tbody>
                                    <tbody><tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><button id="TotalSubletAmount" type="button" class="btn btn-block-wrap" style="margin-left: -42px;width:75px;">OK</button></td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                    </fieldset>
					<fieldset>
                        <legend>Signature</legend>
                        <div class="feildwrap">
                            <div>
                                <label>Service Advisor</label>
								   <input id ="ServiceAdvisor" name="ServiceAdvisor" placeholder="Signature" value="<?php
                                    $data = unserialize($_COOKIE['logindata']);
                                    echo $data['username'];
                                    ?>" readonly>
                            <!--   <select id="ServiceAdvisor" name="ServiceAdvisor">
                                    <option>Select Service Advisor</option>
                                    <?php
                                  //  foreach ($serviceAdvList as $key) {
                                   //     $idStaff = $serviceAdvList['idStaff'];
                                        ?>
                                        <option value="<?//= $key['idStaff'] ?>" ><?//= $key['Name'] ?></option>
                                        <?php
                                  //  }
                                    ?>
                                </select>-->
                                <span class="error-serviceadvb cb-error help-block">Select Option</span>
                            </div>
                           <!-- <div> 
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
        document.getElementById('SubletTable').deleteRow(i);
    }


    var counter = 1;
    $(document).ready(function() {
        $("#inputMakeDiv").hide();
        $("#regresult").hide();
        $("#SurveyorName").chosen();
        $("#Insurance").chosen();
    });
	
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
	
	
	
    $("#newRow").click(function(e) {
        counter = counter + 1;
        var items = "";
        items +=
                "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td>" +
                "<td class = 'tbl-description'><input type='text' id = 'bodyjobesc' name='BodyJobDesc[]' /><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                "<td class='tbl-price'><input type='text' name='BodyJobAmount[]' style='width: 340px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='bodyjobamount' placeholder='Amount' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteRow(this)'></td></tr>";
        $('#BSJobDesc').append(items);
        $("select[name='BodyJobDesc[]']").chosen();
    }); 
	/*
	$("#newRow").click(function (e) {
        $("#newRow").val('-');
        counter = counter + 1;
        var items = "";
			var alljobs = <?php echo json_encode($allJobs);?>;
			console.log(alljobs);
        items +=
            "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td>" +
            "<td class = 'tbl-description'><select id='BSJobDesc' name='BSJobDesc[]' onchange=getJobDetails(this) placeholder = '' class = 'chosen-select slctboxes' style = 'width: 440px;background: #fff;  border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' data-validation = ''><option>Select Job</option>";
                for(j=0;j<alljobs.length;j++) {
               items += "<option value="+ alljobs[j]['idJobRef'] +">"+ alljobs[j]['JobTask'] +"</option>";
			   } ;
			   
			   items += "</select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
            "<td class='tbl-price'><input type='text' name='BodyJobAmount[]' style='width: 340px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechjobamount' placeholder='Amount' data-validation = 'required'></td>" +
            "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteRow(this)'></td></tr>";
        $('#BSJobDesc').append(items);
        $("select[name='BSJobDesc[]']").chosen();
    }); */
//<select id = 'bodyjobesc' name='BodyJobDesc[]' onchange=getJobDetails(this) placeholder = '' class = 'chosen-select slctboxes' style = 'width: 440px;background: #fff; border: 1px solid #dfdfdf; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'  data-validation = ''><option>Select Job</option><?php
                             //       foreach ($allJobs as $key) {
                                    //    ?><option value=<?php //echo $key['idJobRef'] ?>><?php //echo $key['JobTask'] . ',' ?></option><?php// } ?></select>
    $("#searchbyreg").keyup(function() {
        var search = $("#searchbyreg").val();
        if (search !== "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/estimatebodyshop/searchExistingCustomer",
                type: "POST",
                data: {searchbyreg: search},
                success: function(data) {
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
                            $('#CompanyName').val(parsedData[0]['CompanyName']);
                            $('#CompanyContact').val(parsedData[0]['CompanyContact']);
                            $('#CustomerName').val(parsedData[0]['CustomerName']);
                            $('#CustomerContact').val(parsedData[0]['Cellphone']);
                            $('#CustomerAddress').val(parsedData[0]['AddressDetails']);
//                        $('#ATTN').val(parsedData[0]['AddressDetails']);
                            $('#CustomerFax').val(parsedData[0]['Fax']);
                            $('#inputMake').val(parsedData[0]['idAllVehicles']);
                            $('#inputMake').val(parsedData[0]['Variant']);
                            $('#Model').val(parsedData[0]['Model']);
                            $('#RegistrationNumber').val(parsedData[0]['RegistrationNumber']);
                            $('#KM').val(parsedData[0]['Mileage']);
                            $('#ChassisNumber').val(parsedData[0]['ChassisNumber']);
                            $('#EngineNumber').val(parsedData[0]['EngineNumber']);
                            $('#Year').val(parsedData[0]['Year']);
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

    var counter = 1;
    $("#newPartsRow").click(function(e) {
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

    function DoToggle(id) {
        $(id).toggle();
    }

    function getModels(obj) {
        var brand = $(obj).val();
        $("#SelectModel").empty();
        if (brand !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/estimatebodyshop/getModel",
                type: "POST",
                data: {brand: brand},
                dataType: "json",
                success: function(data) {
                    console.log('data');
                    console.log(data);
                    $("#SelectModel").append($("<option id=''>Select Model</option>"));
                    if (data.length > 0) {
                        $.each(data, function(index, name) {
                            $("#SelectModel").append($("<option id=''></option>").val(name['idAllModels']).html(name['ModelName']));
                        });
                    }
                    else {
                    }
                },
                error: function() {
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
                url: "<?= base_url() ?>index.php/estimatebodyshop/getAllVehicles",
                type: "POST",
                data: {model: model},
                dataType: "json",
                success: function(data) {
                    $("#SelectMake").append($("<option id=''>Select Make</option>"));
                    if (data.length > 0) {
                        $.each(data, function(index, name) {
                            $("#SelectMake").append($("<option id=''></option>").val(name['idAllVehicles']).html(name['Variant']));
                        });
                    }
                    else {
                    }
                },
                error: function() {
                    console.log('error');
                }
            });
        }
    }

    function getJobDetails(Source) {
        var idJob = $(Source).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Estimatebodyshop/getJobDetails",
            type: "POST",
            data: {idJob: idJob},
            success: function(data) {
                if (data !== "null") {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function(i, val) {
//                            $("input[name='MechJobAmount[]']").val(val.TimeTaken);
//                            $(Source).closest('td').next('td').find('input').val('Range-1: ' + val.RangeOneAmount + '/=,  Range-2: ' + val.RangeTwoAmount + '/=,  Range-3: ' + val.RangeThreeAmount + '/=');
                            $(Source).closest('td').next('td').find('input').val(val.RangeOneAmount + ' /=');
                        });
                    }
                }
                else {
                }
            }
        });
    }

    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('EstBPJobTable').deleteRow(i);
    }
    
    function deletePartsRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById('PartsEstimateTable').deleteRow(i);
    }

    // On Select Surveyor, get Details
    function getSurveyorDetails() {
        var slctdInsCompany = $('#SurveyorName option:selected').text();
        if (slctdInsCompany !== "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/estimatebodyshop/getSurveyorDetails",
                type: "POST",
                data: {SurveyorName: slctdInsCompany},
                success: function(data) {
                    if (data !== "null")
                    {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            $('#SurveyorPhone').val(parsedData[0]['Phone']);
                        }
                    }
                }
            });
        } else {

        }
    }

    // On Select Insurance, get Details
    function getInsuranceCompanyDetails() {
        var slctdInsCompany = $('#Insurance option:selected').val();
        $("#Branch").empty();
        if (slctdInsCompany !== "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/estimatebodyshop/getInsuranceCompanyDetails",
                type: "POST",
                data: {idInsuranceCompany: slctdInsCompany},
                success: function(data) {
                    if (data !== "null")
                    {
                        var parsedData = JSON.parse(data);
                        if (parsedData.length > 0) {
                            $("#Branch").append("<option>Select Branch</option>");
                            $.each(parsedData, function(index, name) {
                                $("#Branch").append($("<option></option>").val(name['idInsuranceCompanyDetail']).html(name['BranchName']));
                            });
                            $("#Branch").chosen();
                        }
                    }
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
                    $('#ChassisNumber').val(modelText);
                } else {
                    var frameNo = modelText.indexOf("-");
                    frameNo = modelText.substr(0, frameNo);
                    $('#ChassisNumber').val(frameNo);
                }
            }
        }
    }
    function getPartDetails(obj) {
        var idPart = $(obj).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/estimatebodyshop/getPartDetails",
            type: "POST",
            data: {idPart: idPart},
            success: function(data) {
                if (data !== "null") {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        $.each(a, function(i, val) {
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

    function validationform() {
        var staffSlct = $('#ServiceAdvisor').val();
        var surveyorSlct = $('#SurveyorName').val();
        var insuranceSlct = $('#Insurance').val();
        var isValidate = 1;
        var countJobRows = $("#EstBPJobTable > tbody").children().length;
        var countPartsRows = $("#PartsEstimateTable > tbody").children().length;
        if (countJobRows > 0) {
            $('#newRow').val('-');
            var selects = $("#EstBPJobTable").find(".slctboxes");
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

        if (staffSlct === "Select Service Advisor" && surveyorSlct === "Select Surveyor" && insuranceSlct === "Select Insurance Company")
        {
            $(".error-serviceadvb").show();
            $(".error-surveyor").show();
            $(".error-inscompany").show();
            isValidate = 1;
        }
        else {
            $(".error-serviceadvb").hide();
            $(".error-surveyor").hide();
            $(".error-inscompany").hide();
            if (staffSlct === "Select Service Advisor" || surveyorSlct === "Select Surveyor" || insuranceSlct === "Select Insurance Company") {
                if (staffSlct === "Select Service Advisor") {
                    $(".error-serviceadvb").show();
                    isValidate = 1;
                } else {
                    $(".error-serviceadvb").hide();
                }
                if (surveyorSlct === "Select Surveyor") {
                    $(".error-surveyor").show();
                    isValidate = 1;
                } else {
                    $(".error-surveyor").hide();
                }
                if (insuranceSlct === "Select Insurance Company") {
                    $(".error-inscompany").show();
                    isValidate = 1;
                } else {
                    $(".error-surveyor").hide();
                }
            }
        }

        if (isValidate === 0) {
            return false;
        } else {
            return true;
        }
    }
	
	  $(document).ready(function(){
       $(".Customer").click(function(){
           $("#insurance_detail").hide();
       }) ;
        $(".Insurance").click(function(){
            $("#insurance_detail").show();
        }) ;
    });
    <?php if(count($token)){ ?>
    filldata(0);
    $("#listbtn").hide()
    <?php }?>

    $('.myTable').DataTable();
</script>

