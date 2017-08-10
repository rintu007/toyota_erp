<div id="wrapper">
    <div id="content">
        <script>

        </script>
        <?php
        $cookieData = unserialize($_COOKIE['logindata']);
        if ($cookieData['isAdmin'] == 1) {
            include 'include/admin_leftmenu.php';
        } else {
            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <?= $message ?>
        
            <form name="myform" action="<?= base_url() ?>index.php/service/add" method="post" class="form validate-form animated fadeIn">
                <fieldset style="width: 96%;">
                    <legend>Requested Items</legend>
                    <div class="feildwrap"></div>
                    <div id="tblDispatch">
                        <div style=" margin-left: 35px; ">
                            <label>RO No.</label>
                            <br>
             <input type="text" name="RoNumber" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);">
                        </div>
					<fieldset>
                            <legend onclick="DoToggle('#CsmtrVehicleInfoDiv')">Customer and Vehicle Information</legend>
                            <div id="CsmtrVehicleInfoDiv" class="feildwrap"><br>
                           
                               <br>
                                <div>
                                    <label>Customer Name</label>
          
            <input id="CustomerNamee" type="text" name="CustomerName" placeholder="Enter Customer Name" style="width:150px;">
                                </div> <div>
                                    <label>Company Name</label>
                       
                        <input id="CompanyNamee" type="text" name="CompanyName" placeholder="Enter Company Name" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Make</label>
                                    <input id="Make" type="text" name="Make" placeholder="Enter Make" style="width: 150px;" >
                                </div>
                                <div>
                                    <label>Model</label>
                                 
                                      <input id="Modell" type="text" name="Model" placeholder="Enter Model" style="width: 150px;">
                                </div>
                             <!--   <div>
                                    <label>Model Code</label>
                                    <input id="ModelCode" type="text" name="ModelCode" placeholder="Enter Model Code" style="width: 150px;">
                                </div> -->
                                <div>
                                    <label>Reg No.</label>
                                    <input id="RegistrationNumberr" type="text" name="RegistrationNumber" placeholder="Enter Registration Number" style="width: 155px;">
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
                            <!--    <div>
                                    <label>Date</label>
                                    <input id="Date" type="text" name="Date" class="date" placeholder="Requisition Date" data-validation="required" style="width: 150px;">
                                </div>
                                <div>
                                    <label>Time</label>
                                    <input Class="Timepicker" id="Time" type="text" name="Time" data-time-format="H:i:s" data-validation="required"   placeholder="Requisition Time" style="width: 150px;">
                                </div>
-->
                                <br>
                            </div>
                        </fieldset>
                        <br>
                        <div class="btn-block-wrap dg" id="tbl-Dispatch">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="7%">No.</th>
                                        <th width="17%">Part Number</th>
                                        <!--<th width="10%">Order Detail</th>-->
                                        <th width="10%">Part Name</th>
                                        <th width="8%">Requested Qty</th>
                                         <th width="8%">Dispatch. Qty</th>
                                          <th width="8%">Remaining Qty</th>
                                          <th width="8%">Manual</th>
                                         <th width="8%">Price</th>
                                         <th width="8%">Total Price</th>
                                       <!-- <th width="10%">Total Price</th>-->
                                        <!--<th width="10%">Actual Cost</th>-->
                                        <!--<th width="10%">Land Value</th>-->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr><td colspan="10"><div id="paging"><ul></ul></div></tr>
                                </tfoot>
                                <tbody id="finalResult"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="btn-block-wrap">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="Dispatch Parts" style="margin-left: 193px;width: 270px;">
                    </div>
                </fieldset>
            </form><span id="test"></span>
        </div>
    </div>
</div>
<script>
    $("input[name=RoNumber]").keyup(function(e) {
        $('#finalResult').html('');
        var RoNumber = $("input[name=RoNumber]").val();
        $('.chosen-select option[selected=selected]').removeAttr('selected');
        $(".chosen-select").trigger("chosen:updated");
        $('#finalResult tr input').val('');
        $.ajax({
            url: "<?=  base_url() ?>index.php/service/get1/",
            type: "POST",
            data: {RoNumber: RoNumber},
            success: function(data) {
             
             var parsedData = JSON.parse(data);
               $('#CustomerNamee').val(parsedData[0][0]['CustomerName']);
                        $('#CompanyNamee').val(parsedData[0] [0]['CompanyNamee']);
                        $('#Make').val(parsedData[0] [0]['Vehicle']);
                        $('#Modell').val(parsedData [0][0]['Model']);
                        $('#RegistrationNumberr').val(parsedData [0][0]['RegNumber']);
                        $('#ChassisNumber').val(parsedData [0][0]['FrameNumber']);
                        $('#EngineNumber').val(parsedData [0][0]['EngineNumber']);
                        $('#ModelCode').val(parsedData [0][0]['ModelCode']);
                        $('#EstNumber').val(parsedData [0][0]['EstimateNo']);
                        $('#Year').val(parsedData[0] [0]['Year']);

         }
});
    });
             </script>
<script>
    $("input[name=RoNumber]").keyup(function(e) {
        $('#finalResult').html('');
        var RoNumber = $("input[name=RoNumber]").val();
        $('.chosen-select option[selected=selected]').removeAttr('selected');
        $(".chosen-select").trigger("chosen:updated");
        $('#finalResult tr input').val('');
        $.ajax({
            url: "<?=  base_url() ?>index.php/service/get/",
            type: "POST",
            data: {RoNumber: RoNumber},
            success: function(data) {
             var parsedData = JSON.parse(data);      
                      //  $('#test').html(JSON.stringify(data));
//                                                        <td class='tbl-discount'><input type='text' name='discount[]' onkeyup=discount(this) style='width: 77%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Discount' placeholder='Discount'/></td>
                var GetRoNumber = JSON.parse(data);
               
                var count = 1;
                for (var a = 0; a < GetRoNumber.length; a++) {
                    if ($('#finalResult tr').length > GetRoNumber.length) {
                        $('#finalResult tr:eq(' + a + ')').remove();
                    } else {

                        $('#finalResult').append("<tr><td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
                                        <td class='tbl-part-number'><select onchange=getPart(this) class='chosen-select' name='parts[]' id='PartNumber' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'><option>Select Part Number</option><?php foreach ($Part as $PartNumber) { ?><option value='<?= $PartNumber['idPart'] ?>'><?= $PartNumber['PartNumber'] ?></option><?php } ?></select></td>\n\
                                        <td class='tbl-od' style='display:none'><input type='text' name='partsreqinfo[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description'/></td>\n\
                                        <td class='tbl-part-name'><input type='text' name='partname[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description' readonly/></td>\n\
                                        <td class='tbl-req-qty'><input type='text' name='requestquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity_"+a+"' placeholder='Quantity' readonly/></td>\n\
                                         <td class='tbl-dis'><input onfocusout='myFunction(this.id)' class='a"+a+"' type='text' name='dispatchquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='disp_"+a+"' placeholder='dispatchquantity'/></td>\n\
                                            <td class='tbl-dis'><input type='text' name='remain[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='remain"+a+"' placeholder='Remain'/></td>\n\
                                        <td class='tbl-rem-qty'><input type='text'  onfocusout='myFunction(this.id)' name='Manulr[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='man_"+a+"' placeholder='Manul Rate'/></td>\n\
                                        <td class='tbl-rem-qty'><input type='text' name='pri[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='pri"+a+"' placeholder='Price' readonly/></td>\n\
                                         <td class='tbl-dis'><input type='text' name='tot[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='tot"+a+"' placeholder='Total Price' readonly/></td>");
                        $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
                    }
                }


                for (var each in GetRoNumber) {
     $('#finalResult tr:eq(' + each + ') td:eq(' + 1 + ') select').find('option:contains(' + GetRoNumber[each]['PartNumber'] + ')').attr('selected', true);
     $(".chosen-select").trigger("chosen:updated");
     $('#finalResult tr:eq(' + each + ') td:eq(' + 2 + ') input').val(GetRoNumber[each]['idPartsReqInfo']);
     $('#finalResult tr:eq(' + each + ') td:eq(' + 3 + ') input').val(GetRoNumber[each]['PartName']);
     $('#finalResult tr:eq(' + each + ') td:eq(' + 4 + ') input').val(GetRoNumber[each]['PartQuantity']);
      $('#finalResult tr:eq(' + each + ') td:eq(' + 5+ ') input').val();
     $('#finalResult tr:eq(' + each + ') td:eq(' + 6 + ') input').val(GetRoNumber[each]['manual']);
    
     $('#finalResult tr:eq(' + each + ') td:eq(' + 7 + ') input').val(GetRoNumber[each]['RemainingQty']);
   
       $('#finalResult tr:eq(' + each + ') td:eq(' + 8 + ') input').val(GetRoNumber[each]['RetailPrice']);
        $('#finalResult tr:eq(' + each + ') td:eq(' + 8 + ') input').val();
                }
				$('#SelectModel').val(GetRoNumber[0][0].Model);
				$('#RegistrationNumber').val(GetRoNumber[0][0].RegistrationNumber);
				$('#Year').val(GetRoNumber[0][0].Year);
				$('#FrameNumber').val(GetRoNumber[0][0].ChassisNumber);
				$('#EngineNumber').val(GetRoNumber[0][0][0].EngineNumber);
				$('#KM').val(GetRoNumber[0][0].Mileage);
            },
            error: function(data) {
            }
        });
    });
 function myFunction(e){
  var id=e.split("_")[1];
 // alert(id);
  var man=$("#man_"+id).val();
  var disp=$("#disp_"+id).val();
  var pri=$("#pri"+id).val();
  if(man=="" || man==0){
  var res=disp*pri;
  $('#tot'+id).val(res);
  //alert("man="+man+"disp="+disp+"res="+res);
}
else{
  var res=disp*man;
  $('#tot'+id).val(res);
   // alert("man="+man+"disp="+disp+"res="+res);
}



var qua=$('#Quantity_'+id).val();
var remain=qua-disp;
$("#remain"+id).val(remain);

}

 function myFunction2(e){



    }

    function validationform() {
        chosen = "";
        pass = $("#pass").val();
        confirm_pass = $("#cpass").val();
        if (pass !== confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }
    }

    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
function getPart(Source) {
    idPart = $(Source).val();
    $.ajax({
        url: "<?= base_url() ?>index.php/purchase/getpartdetails",
        type: "POST",
        data: {idPart: idPart},
        success: function (data) {

            if (data !== "null")
            {
             $("#test").html(JSON.stringify(data));
                var a = JSON.parse(data);
                if (a.length > 0) {
                    if (a[0]['QtyInStock'] === '0') {
                        alert('This Part is Not Available in the Stock !');
                    } else {

                        $.each(a, function (i, val) {
                            $(Source).closest('td').next('td').next('td').next('td').find('input').val(val.QtyInStock);
                            $(Source).closest('td').next('td').next('td').find('input').val(val.PartName);
                                   $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val('');
                           $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').find('input').val('');
$(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val('');
                 $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val(val.RetailPrice);
                          //   $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').find('input').val();
                     //       $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').find('input').val();
                     //       $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val(val.CostPrice);
                        $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val('');
                        });
                    }
                }
            }
            else {
            }
        }
    });
//        $(Source).closest('td').next('td').find('input').val('Desccc');
//        $(Source).closest('td').next('td').next('td').find('input').val('Qtyy');
//        $(Source).closest('td').next('td').next('td').next('td').find('input').val('Pricesss');
//        $(Source).closest('td').next('td').next('td').next('td').next('td').find('input').val('Disc');
    //        $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').find('input').val('Act Pri'); //        $(Source).closest('td').next('td').next('td').next('td').next('td').next('td').next('td').find('input').val('Land Val..');
}
    
  
  
</script>