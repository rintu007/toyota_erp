<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/partsrequistion_leftmenu.php';
        } else {
//            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form id="partsrequisitionbodyform" action="<?= base_url() ?>index.php/partsrequisitionbodyshop/Add"  method="post" onSubmit="return validationform()" class="form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Parts Requisition From Service Department</legend>                  
                    <fieldset>
                        <legend>Body Shop</legend>
                         <fieldset>
                            <legend onclick="DoToggle('#CsmtrVehicleInfoDiv')">Customer and Vehicle Information</legend>
                            <div id="CsmtrVehicleInfoDiv" class="feildwrap"><br>
                                <div>
                                    <label>R.O. No.</label>
                                    <input id="RoNumber" type="text" name="RoNumber" placeholder="Enter R.O Number"  data-validation="  " style="width: 150px;">
                                </div>
                                <div>
                                    <label>S. No</label>
                                    <input id="SNO" type="text" name="SNO" placeholder="Serial Number" data-validation="  " style="width: 150px;"
                                           value="<?php
                                           if ($serialNumber != Null) {
                                               echo $serialNumber + 1;
                                           } else {
                                               echo '0';
                                           }
                                           ?>">
                                </div><br>
                                <div>
                                    <label>Customer Name</label>
                                    <input id="CustomerName" type="text" name="CustomerName" placeholder="Enter Customer Name" style="width: 150px;">
                                </div> <div>
                                    <label>Company Name</label>
                                    <input id="CompanyName" type="text" name="CompanyName" placeholder="Enter Company Name" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Make</label>
                                    <input id="Make" type="text" name="Make" placeholder="Enter Make" style="width: 150px;" >
                                </div>
                                <div>
                                    <label>Model</label>
                                    <input id="Model" type="text" name="Model" placeholder="Enter Model" style="width: 150px;">
                                </div>
                             <!--   <div>
                                    <label>Model Code</label>
                                    <input id="ModelCode" type="text" name="ModelCode" placeholder="Enter Model Code" style="width: 150px;">
                                </div> -->
                                <div>
                                    <label>Reg No.</label>
                                    <input id="RegistrationNumber" type="text" name="RegistrationNumber" placeholder="Enter Registration Number" style="width: 155px;">
                                </div>
                                <div>
                                    <label>Chassis No.</label>
                                    <input id="ChassisNumber" type="text" name="ChassisNumber" placeholder="Enter Chassis Number" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Engine</label>
                                    <input id="EngineNumber" type="text" name="EngineNumber" placeholder="Enter Engine Number" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Est. No.</label>
                                    <input id="EstNumber" type="text" name="EstNumber" placeholder="Enter Est Number" style="width: 150px;">
                                </div>
								<div>
                            <label>Year</label>
                            <input id="Year" type="text" name="Year" placeholder="Enter Year" readonly="">
                        </div>
                                <div>
                                    <label>Date</label>
                                    <input id="Date" type="text" name="Date" class="date" placeholder="Requisition Date" data-validation="required" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Time</label>
                                    <input Class="Timepicker" id="Time" type="text" name="Time" data-time-format="H:i:s" data-validation="required"   placeholder="Requisition Time" style="width: 150px;">
                                </div><br>
                            </div>
                        </fieldset>
                         <fieldset>
                            <legend onclick="DoToggle('#PartsDescDiv')">Parts Description</legend>
                            <div id="PartsDescDiv" class="feildwrap">
                                <div class="btn-block-wrap datagrid">
                                    <table id="MPartReqTable" width="100%" border="0" cellpadding="1" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S.NO</th>
                                                <th>Parts Name</th>
                                                <!--<th>Parts Number</th>-->                                            
                                                <th>Quantity</th>
                                                <th>X</th>
                                            </tr>
                                        </thead> 
                                        <input name="newRow" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRow" value="+" readonly>                                 
                                        <tbody id="tblMechanical">
                                        </tbody>
                                    </table>
                                </div>
                        </fieldset>
                        <br><fieldset>
                            <legend>Signature</legend>
                            <div class="feildwrap"> 
                                <div>
                                    <label>Service Advisor</label>
                                    <input id ="ServiceAdvisor" name="ServiceAdvisor" placeholder="Signature" value="<?php
                                    $data = unserialize($_COOKIE['logindata']);
                                    echo $data['username'];
                                    ?>" readonly>
                                </div>
                                <div> 
                                    <!--<label>Parts Department</label>-->
                                    <input id ="PartsDepartment" name="PartsDepartment" placeholder="Signature" type="hidden">
                                </div>
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

    var counter = 1;
    $("#newRow").click(function(e) {
        counter = counter + 1;
        var items = "";
        items += "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td><td class='tbl-part'><select onchange=getPart(this) class='chosen-select slctboxes' name='BodyParts[]' style=' width: 212px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='bodyparts'><option>Select Part Name</option><?php
                                           foreach ($Parts as $AllPart) {
                                               ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartName'] ?></option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                //"<td class='tbl-quantity'><input type='text' name='BodyPartsName[]' style=' width: 260px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechpartsname' placeholder='Part Number' readonly></td>" +
                "<td class='tbl-quantity'><input type='text' name='BodyQty[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='bodyqty' placeholder='Quantity' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteRow(this)'></td></tr>";
        $('#tblBodyShop').append(items);
        $("select[name='BodyPartsName[]']").chosen({no_results_text: "Oops, nothing found!"});
        $("select[name='BodyParts[]']").chosen({no_results_text: "Oops, nothing found!"});
    });

    $("#RoNumber").focusout(function() {
        var search = $("#RoNumber").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Partsrequisitionbodyshop/searchRONumber",
            type: "POST",
            data: {searchRONumber: search},
           success: function(data) {
                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
					
                    if (parsedData.length > 0) {

                        $('#CustomerName').val(parsedData [0]['CustomerName']);
                        $('#CompanyName').val(parsedData [0]['CompanyNamee']);
                        $('#Make').val(parsedData [0]['Vehicle']);
                        $('#Model').val(parsedData [0]['Model']);
                        $('#RegistrationNumber').val(parsedData [0]['RegNumber']);
                        $('#ChassisNumber').val(parsedData [0]['FrameNumber']);
                        $('#EngineNumber').val(parsedData [0]['EngineNumber']);
                        $('#ModelCode').val(parsedData [0]['ModelCode']);
                        $('#EstNumber').val(parsedData [0]['EstimateNo']);
                        $('#Year').val(parsedData [0]['Year']);
								if(parsedData[0]['Parts'].length > 0){
									$('#tblMechanical').html('');	
							 //  $("#newPartsRow").val('-');
							var counter2 = 1;
							for(ii=0;ii<parsedData[0]['Parts'].length;ii++){
							 counter = counter + 1;
        var items = "";
        items += "<tr class='tblPurchaseForce'><td class='tbl-count'>" + (counter - 1) + "</td><td class='tbl-part'><select onchange=getPart(this) class='p_select_val_"+ii+" chosen-select slctboxes' name='MechParts[]' style=' width: 212px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechparts' data-validation='required'><option>Select Part Name</option><?php
                                           foreach ($Parts as $AllPart) {
                                               ?><option value='<?= $AllPart['idPart'] ?>'><?= $AllPart['PartName'] ?> </option><?php } ?></select><span name='' class='error-qi cb-error help-block' style='margin-left: -140px;margin-top:35px;display:none;'>Option must be Selected</span></td>" +
                //"<td class='tbl-part'><input type='text' name='MechPartsName[]' style=' width: 260px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechpartsname' placeholder='Part Number' readonly></td>" +
                "<td class='tbl-quantity'><input type='text' name='MechPartsQty[]' style='width: 99px;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='mechpartsqty' placeholder='Quantity' data-validation = 'required'></td>" +
                "<td><input style='width:35px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer '  type='button' value='X' onclick='deleteRow(this)'></td></tr>";
        $('#tblMechanical').append(items);
		$(".p_select_val_"+ii).val(parsedData[0]['Parts'][ii]['idPart']);
		$(".p_select_val_"+ii).trigger("chosen:updated");
        $(".p_select_val_"+ii).chosen();
							}
						}	

                    } else {
                        $('#CustomerName').val('');
                        $('#Make').val('');
                        $('#Model').val('');
                        $('#RegistrationNumber').val('');
                        $('#ChassisNumber').val('');
                        $('#EngineNumber').val('');
                        $('#ModelCode').val('');
                        $('#EstNumber').val('');
                        $('#Year').val('');
                    }
                }
            }
        });
    });

    function getPart(Source) {
        idPart = $(Source).val();
        $.ajax({
            url: "<?= base_url() ?>index.php/partsrequisitionbodyshop/getpartdetails",
            type: "POST",
            data: {idPart: idPart},
            success: function(data) {
                if (data !== "null") {
                    var a = JSON.parse(data);
                    console.log(a);
                    if (a.length > 0) {
                        $.each(a, function(i, val) {
                            //$(Source).closest('td').next('td').find('input').val(val.PartNumber);
                            $(Source).closest('td').next('td').next('td').find('input').val();
                            $(Source).closest('td').next('td').next('td').next('td').find('input').val();
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
        document.getElementById('BPPartReqTable').deleteRow(i);
    }

    function DoToggle(id) {
        $(id).toggle();
    }

    function validationform() {
        var countPartRows = $("#BPPartReqTable > tbody").children().length;
        var isValidate = 1;
        if (countPartRows > 0) {
            $('#newRow').val('-');
            var selects = $("#BPPartReqTable").find(".slctboxes");
            for (var count = 0; count < selects.length; count++) {
                if ($(selects[count]).val() === "Select Part Name") {
                    isValidate = 0;
                    $(selects[count]).parent().find('span').show();
                } else {
                    $(selects[count]).parent().find('span').hide();
                }
            }
        } else {
            $('#newRow').val('+');
        }

        if (isValidate === 0) {
            return false;
        } else {
            return true;
        }
    }




</script>
