
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager') {
            if($this->uri->segment(2)!= 'sale')
            {
            
            include 'include/cr_inquiryleftmenu.php';
            }
         else {
              }
        }
        else {
            redirect(base_url() . "index.php/crpanel/index");
        }
        ?>
        <div class="right-pnel">
            <br><br>
            <form method="post" class="form animated fadeIn" onsubmit="return false" >
                <div id="searchform" class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                   
                    <fieldset>                        
                        <legend>Search Inquiry</legend>
                        <div>
                            <label>Search</label>
                            <input type="text" name="padnumber" id="searchnow"
                                   placeholder="By Inquiry Number">    
                        </div>
                    </fieldset>
                </div><br>
                <div class="feildwrap" id="divtblallcomplaints">
                    <fieldset>
                        <legend>Inquiry </legend>
                        <div class="btn-block-wrap dg" id="shwinqra">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="05%">SNo</th>
                                        <th width="10%">Comp#</th>
                                        <th width="5%">Reg.Date</th>
                                        <th width="5%">Attender</th>
                                        <th width="5%">Customer</th>
                                        <th width="8%">Contact</th>
                                        <th width="5%">VOC</th>
                                        <th width="8%">RelatedTo</th>
                                        <th width="5%">Type</th>
                                        <th width="10%">Variant</th>
                                        <th width="5%">Detail</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="14">
                                    </tr>
                                </tfoot>   
                                <tbody id="shwallcomplaints">
                                    <?php
                                    $count = 1;
                                    $allinquiries = json_decode($allinquiries);
                                    foreach ($allinquiries as $key) {
                                        ?>
                                        <tr id="allcomplaints">
                                            <td name="complaintsno"><?= $count++ ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintPadNumber ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRegDate . ', ' . $key->ComplaintRegTime ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->AttenderName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerCellphone ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VoiceOfCustomer ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRelatedTo ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->FCR ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleName ?></td>
                                          
                                            <td><a href="#divactiontaken" onclick="takevalues(<?php echo $key->ComplaintPadNumber ?>,<?php echo $key->ComplaintID ?>)">Reply Action</a></td>
                                            <?php
                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
            </form>
            <div id="divsubmittedform" style="display: none;">
                <form id="ff" name="registercomplaint"  class="form validate-form animated fadeIn" >
                    <fieldset>
                        <legend onclick="showcustomerinfo_()">Customer Information</legend>
                        <div id="divcustomerinfo" class="feildwrap">
                            <div>
                                <label>Customer Name</label>
                                <input id="customername" type="text" name="customername" class=""  data-validation="" >
                            </div>
                            <div>
                                <label>Mobile Number</label>
                                <input id="customermobilenumber" type="text" name="customermobilenumber" class=""  data-validation="  " placeholder="Mobile Number" readonly>
                            </div>
                            <div>
                                <label>Phone Number</label>
                                <input id="customerphonenumber" type="text" name="customerphonenumber" class=""  data-validation="  "  placeholder="Phone Number" readonly>
                            </div>
                            <div>
                                <label>Email</label>
                                <input id="customeremail" type="email" name="customeremail" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Address</label>
                                <textarea id="customeraddress" name="customeraddress" style="margin: 0px; width: 724px; height: 100px;" readonly></textarea>
                            </div><br>
                            <div>
                                <label>Customer Profile</label>
                                <textarea id="customerprofile" name="customerprofile" style="margin: 0px; width: 724px; height: 100px;" readonly></textarea>
                            </div><br>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend onclick="showvehicleinfo_()">Vehicle Information</legend>
                        <div id="divvechicleinfo" class="feildwrap">
                            <div>
                                <label>Variant</label>
                                <input id="vehiclename" type="text" name="vehiclename" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Register Number</label>
                                <input id="vehicleregnumber" type="text" name="vehicleregnumber" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Chassis Number</label>
                                <input id="vehiclechassisnumber" type="text" name="vehiclechassisnumber" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Engine Number</label>
                                <input id="vehicleenginenum" type="text" name="vehicleenginenumber" class=""  data-validation="  " readonly>
                            </div><br>
                            <div>
                                <label>Model No.</label>
                                <input id="Model" type="text" name="Model" placeholder=""  data-validation = "" >
                            </div>
                            <div>
                                <label>Mileage </label>
                                <input id="vehiclemileage" type="text" name="vehiclemileage" class=""  data-validation="  " readonly>
                            </div>
                            <div>
                                <label>Year</label>
                                <input id="ModelYear" type="text" name="ModelYear" placeholder=""  data-validation = "" >
                            </div>
                            <div>
                                <label>Date Purchase </label>
                                <input id="vehicledate" type="text" name="vehicledate" class=""  data-validation=" " readonly>
                            </div>
                            <div>
                                <label>Delivered Form </label>
                                <textarea id="vehicledeliveredform" name="vehicledeliveredform" style="margin: 0px; width: 705px; height: 50px;" readonly></textarea>
                            </div><br>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="shwcomplaintregistration_()">Inquiry Registration</legend>
                        <div id="divcomplaintregistration" class="feildwrap">
                            <div>
                                <label>Registered Date</label>
                                <input id="regdate" class=""  name="regdate" type="text" readonly>
                            </div>
                            <div>
                                <label>Receiver</label>
                                <input id="iduserprofile" type="text" name="iduserprofile" value="Admin" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Inquiry Number</label>
                                <input id="padnumber" required type="number" value="" name="padnumber" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Mode</label>
                                <div>
                                    <input id="idcrmode" type="text" name="idcrmode" class=""  data-validation="" value='Inquiry' readonly>
                                </div>
                            </div>
                            <div>
                                <label>Route</label>
                                <input id="idcroute" type="text" name="idcroute" class=""  data-validation="" value='' readonly>
                            </div>
                            <div>
                                <label>FCR</label>
                                <input id="isfcr" type="text" name="isfcr" class=""  data-validation="" value='' readonly>
                            </div>
                            <div>
                                <label>Inquiry Related to</label>
                                <input id="idcomplaintrelto" type="text" name="idcomplaintrelto" class=""  data-validation="" value='' readonly>
                            </div><br>
                            <div>
                                <label>Voice of Customer</label>
                                <textarea id="voiceofcustomer" name="voiceofcustomer" style="margin: 0px; width: 724px; height: 100px;" readonly></textarea>
                            </div><br>                          
                            <div>
                                <label>Respond To</label>
                                <textarea id="respondto" name="respondto" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                            </div><br><br> 
<!--                            <div id="CallDurationDiv" class="feildwrap">                               
                                <div>
                                    <label>Call Start-Time</label>
                                    <input id="starttime" name="starttime" style="width: 130px" Class="Timepicker" type="text" data-time-format="H:i:s" placeholder="" data-validation = "">
                                </div>
                                <div>
                                    <label>Call End-Time</label>
                                    <input id="endtime" name="endtime" style="width: 130px" Class="Timepicker" type="text" data-time-format="H:i:s" placeholder="" data-validation = "" onfocusout="timeSpent()">
                                </div>
                                <div>
                                    <label>Call Duration</label>
                                    <input id="calldurationtime" name="calldurationtime" type="text" placeholder="" style="width: 110px" readonly>
                                </div>
                            </div><br><br>-->
                            <div>
                                <label>User Skills</label>
                                <input id="userskills" type="text" name="userskills" class=""  data-validation="" value='' readonly>
                            </div><br><br>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend id="sharedInquiry" onclick="showsharecomplain_()">Share Inquiry</legend>                                    
                        <div  id="divsharecomplain" class="feildwrap">
                            <table>
                                <tbody>
                                    <tr><td><div id='shwalldeparts'></div></td></tr>
                                    <tr><td><div id='shwallroles'></div></td></tr>
                                    <tr><td><div id='shwallnames'></div></td></tr>
                                    <tr><td><div id='shwfeedback'></div></td></tr>
                                </tbody>
                            </table>
                        </div>  
                    </fieldset>
                </form>
            </div>
            <div id="divactiontaken" class="allforms">
                <form id="replyaction" action="<?= base_url() ?>index.php/Inquiryreplyaction/updatereplyaction" onsubmit="return validationform()" method="post" class="form validate-form animated fadeIn"> 
                    <fieldset>
                        <legend>Inquiry Resolution</legend>
                        <div class="feildwrap" style="display: none">
                            <div>
                                <input id="idcrcomplain" name="idcrcomplain">
                            </div>
                            <div>
                                <input id="ripadnumber" name="ripadnumber">
                            </div>
                        </div>
                        <fieldset>
                            <legend onclick="showactiontaken_()">Reply Action</legend>
                            <div id="divactiontaken_" class="feildwrap">
                                <div>
                                    <textarea name="actiontakendescription" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                                </div>
                              
                            </div>
                        </fieldset>
                         <fieldset>
                            <legend onclick="showactiontaken_()">Remarks</legend>
                            <div id="divactiontaken_" class="feildwrap">
                                <div>
                                    <textarea name="Remarks" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                                </div>
                              
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend onclick="showkizentaken_()" >Kaizen Taken</legend>
                            <div id="divkaizentaken_" class="feildwrap">
                                <div>
                                    <textarea name="kaizendescription" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                                </div><br>
                            </div><br>
                        </fieldset>
                         <fieldset>
                            <legend onclick="showkizentaken_()" >Inquiry Potential</legend>
                            <div id="InquiryPotential" class="feildwrap">
                                <div>
                                  <select  id="InquiryPotential" name="InquiryPotential"><option>Hot</option><option>Warm</option><option>Cold</option> </select>
                                </div><br>
                            </div><br>
                        </fieldset>
                        <fieldset>
                            <legend onclick="showvocclassification()">VOC Classification</legend>
                            <div  id="divvocclassification" class="feildwrap">
                                <div>
                                    <label>Inquiry Related to</label>
                                    <select id="idcrelation" name = "idcrcomplainrelation" onchange="getrespectivecontactdetails(this)">
                                        <option>Select Related to</option>                                                 
                                        <?php
                                        $complaintrelation = json_decode($complaintrelation);
                                        foreach ($complaintrelation as $key) {
                                            ?>
                                            <option value=<?php echo $key->idcr_complainrelation ?>><?php
                                                echo $key->Name;
                                                ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error-icrrelation cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                </div><br><br>
                                <div>
                                    <label id="labeldetaildescription_">Contact Details Description</label>
                                    <div>
                                        <select id="fetchcontactdetails"  name="contactdetaildescription" onchange="getrespectivesaleprocess(this)">
                                        </select>
                                        <span class="error-ifetchdetail cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                    </div>
                                </div><br><br>
                                <div>
                                    <label>Sale Process Description</label>
                                    <div>
                                        <select id="fetchsaleprocess" name="saleprocessdescription"  onchange="getrespectivesalesubprocess(this)">
                                        </select>
                                        <span class="error-ifetchprocess cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                    </div>
                                </div><br><br>
                                <div>
                                    <label>Sub-Process Description</label>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select id="fetchsalesubprocess" name="salesubprocessdescription">
                                                    </select>&nbsp
                                                    <span class="error-ifetchsubprocess cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                                </td>
                                            </tr>   
                                        </tbody>
                                    </table>
                                </div><br>
                                </fieldset>
                                <fieldset>
                                    <legend>Update</legend>
                                    <div class="feildwrap">
                                        <table>
                                            <tbody>
                                                <tr><td><label>Information File</label></td><td></td><td><input name="isinfofile" type="checkbox" class="btn" value= 1></td></tr>
                                                <tr><td><label>FAQ'S</label></td><td></td><td><input name="isfaqs" type="checkbox" class="btn" value= 1 ></td></tr>
                                                <tr><td><label>Required Training</label></td><td></td><td> <input name="isreqtraining" type="checkbox" class="btn" value= 1 ></td></tr>
                                                <tr><td><label>Update VOC Classification</label></td><td></td><td><input name="isupdatevoc" type="checkbox" class="btn" value= 1 ></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                                <div class="feildwrap">
                                    <div class="feildwrap">
                                        <label id="lableclose">Close</label>
                                       
                                        <input name="isclose" type="checkbox" class="btn" value= 1 onclick="showclosingdatetime()">
                                       <select id="sat" name="closing_satisfy_status" required>
                                        <option value="Satisfy">Satisfy</option>
                                        <option value="unSatisfy">Un-Satisfy</option>
                                        </select>
                                        <label class="closingdatetime" id="">Closing Date</label>
                                         
                                        <input class="closingdatetime" name="closingdate" type="datetime-local" class="btn" value ="">
                                        &nbsp;&nbsp;&nbsp;<input id="btnsave" type="submit" class="btn" value="Save">
                                    </div>
                                </div>
                        </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$('#sat').hide();
    var pad = 0;
    var complaintid = 0;
    $('#btnsave').hide();
    $('#divactiontaken').hide();

    function shwcomplaintregistration_() {
        $("#divcomplaintregistration").toggle();
    }
    function showcustomerinfo_() {
        $("#divcustomerinfo").toggle();
    }
    function showvehicleinfo_() {
        $("#divvechicleinfo").toggle();
    }
    function showsharecomplain_() {
        $("#divsharecomplain").toggle();
    }
    function showvarianthistory_() {
        $("#divvarianthistory").toggle();
    }
    function showactiontaken_() {
        $("#divactiontaken_").toggle();
    }
    function showkizentaken_() {
        $("#divkaizentaken_").toggle();
    }
    function showvocclassification() {
        $("#divvocclassification").toggle();
    }
   
    function showclosingdatetime() {

        $("#lableclose").toggle();
       $('#sat').toggle();
        $(".closingdatetime").toggle();
    }
    function takevalues(padnum, idinquiry) {
        $('#searchform').hide();
        $('#divtblallcomplaints').hide();
        $('#divsubmittedform').show();
        $('#divactiontaken').show();
        $('#btnsave').show();

        $.ajax({
            url: "<?= base_url() ?>index.php/Inquiryreplyaction/servicefilteredinquirysharing",
            type: "POST",
            data: {padnumber: padnum, idinquiry: idinquiry},
            dataType: "json",
            success: function(data) {
                if (data['allcomplaints'].length > 0) {

//                    complaintid = data['allcomplaints'][0]['ComplaintID'];
//                    pad = data['allcomplaints'][0]['ComplaintPadNumber'];

                    //Customer Info
                    $('#customername').val(data['allcomplaints'][0]['CustomerName']);
                    $('#customermobilenumber').val(data['allcomplaints'][0]['CustomerCellphone']);
                    $('#customerphonenumber').val(data['allcomplaints'][0]['CustomerPhone']);
                    $('#customeremail').val(data['allcomplaints'][0]['CustomerEmail']);
                    $('#customeraddress').val(data['allcomplaints'][0]['CustomerAddress']);
                    $('#customerprofile').val(data['allcomplaints'][0]['CustomerProfile']);
                    $('#shwvehiclechassisnum').val(data['allcomplaints'][0]['CustomerProfile']);

                    //Vechilce Info


                    $('#vehiclename').val(data['allcomplaints'][0]['VehicleName']);
                    $('#vehicleregnumber').val(data['allcomplaints'][0]['VehicleRegNumber']);
                    $('#vehiclechassisnumber').val(data['allcomplaints'][0]['VehicleChassisNumber']);
                    $('#vehicleenginenum').val(data['allcomplaints'][0]['VehicleEngineNumber']);
                    $('#vehiclemileage').val(data['allcomplaints'][0]['VehicleMileage']);
                    $('#vehicledate').val(data['allcomplaints'][0]['VehicleDatePurchase']);
                    $('#vehicledeliveredform').val(data['allcomplaints'][0]['VehicleDeliveredFrom']);
                    $('#Model').val(data['allcomplaints'][0]['Model']);
                    $('#ModelYear').val(data['allcomplaints'][0]['ModelYear']);


                    //Complaint Info
                    $('#iduserprofile').val(data['allcomplaints'][0]['AttenderName']);
                    $('#padnumber').val(data['allcomplaints'][0]['ComplaintPadNumber']);
                    $('#idcrmode').val(data['allcomplaints'][0]['Mode']);
                    $('#idcroute').val(data['allcomplaints'][0]['ComplaintRecieveFrom']);
                    $('#isfcr').val(data['allcomplaints'][0]['FCR']);
                    $('#idcomplaintrelto').val(data['allcomplaints'][0]['ComplaintRelatedTo']);
                    $('#voiceofcustomer').val(data['allcomplaints'][0]['VoiceOfCustomer']);
                    $('#customerrequest').val(data['allcomplaints'][0]['CustomerRequest']);
                    $('#regdate').val(data['allcomplaints'][0]['ComplaintRegDate']);
                    $('#userskills').val(data['allcomplaints'][0]['ComplaintUserSkills']);
                    $('#idcrcomplain').val(data['allcomplaints'][0]['ComplaintID']);
                    $('#ripadnumber').val(data['allcomplaints'][0]['ComplaintPadNumber']);
                    $('#respondto').val(data['allcomplaints'][0]['RespondTo']);
                    $('#starttime').val(data['allcomplaints'][0]['CallStartTime']);
                    $('#endtime').val(data['allcomplaints'][0]['CallEndTime']);
                    $('#calldurationtime').val(data['allcomplaints'][0]['CallDurationTime']);
                    $('#ripadnumber').val(data['allcomplaints'][0]['ComplaintPadNumber']);

                    //Complsaint Shareto Info

                    var inputdepart = $('#shwalldeparts');

                    alldeparts = new Array();
                    allroles = new Array();
                    allnames = new Array();
                    allfeedback = new Array();

                    if (data['sharingdata'].length > 0) {
                        for (var i = 0; i < data['sharingdata'].length; i++) {
                            inputdepart.append("<label>Department</label><input  id='sharedepart' type='text' name='sharedepart' style='margin: 0px; width: 125px; height: 35px;'  value='" + data['sharingdata'][i]['Department'] + "' readonly><br><br>&nbsp;&nbsp;&nbsp;");
                            inputdepart.append("<label>Role</label><input id='sharedepart' type='text' name='sharedepart' style='margin: 0px; width: 125px; height: 35px;' value='" + data['sharingdata'][i]['Designation'] + "' readonly><br><br>&nbsp;&nbsp;&nbsp;");
                            inputdepart.append("<label>Name</label><input id='sharedepart' type='text' name='sharedepart' style='margin: 0px; width: 125px; height: 35px;' value='" + data['sharingdata'][i]['Name'] + "' readonly><br><br>&nbsp;&nbsp;&nbsp;");
                            inputdepart.append("<label>FeedBack</label><textarea style='margin: 0px; width: 350px; height: 100px;' readonly>" + data['sharingdata'][i]['FeedBack'] + "</textarea><br><br>&nbsp;&nbsp;&nbsp;");
                        }
                    }
                    else {
                        $('#divsharecomplain').html('No Feed Back From Department');
                    }
                }
                else {

                    console.log('Data is Empty');
                }
            },
            error: function(data) {

            }
        });
    }

    $(".closingdatetime").hide();

//    $("#replyaction").submit(function() {
//        var formData = $('#replyaction').serialize();
//        formData += "&idcrcomplain=" + complaintid;
//        formData += "&padnumber=" + pad;
//        $.ajax({
//            url: "<?= base_url() ?>index.php/Inquiryreplyaction/updatereplyaction",
//            type: "POST",
//            data: formData,
//            success: function(data) {
//                location.reload();
//            },
//            error: function(data) {
//
//            }
//        });
//        return false;
//    });

    $('#searchnow').keyup(function() {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Inquiryreplyaction/servicefilteredinquiry",
            type: "POST",
            data: {padnumber: searchnow},
            success: function(data) {
                if (data !== "null")
                {
                    var parseddata = JSON.parse(data);
                    if (parseddata.length > 0) {
                        try {
                            var count = 1;
                            var items = [];
                            $.each(parseddata, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                                                <td class='resId' name='resId'>" + val.ComplaintPadNumber + "</td>\n\
                                        <td class='resId' name='resId'>" + val.AttenderName + "</td>\n\
                        <td class='resId' name='resId'>" + val.CustomerName + "</td>\n\
                            <td class='resId' name='resId'>" + val.CustomerCellphone + "</td>\n\
                                    <td class='resId' name='resId'>" + val.VoiceOfCustomer + "</td>\n\
                                            <td class='resId' name='resId'>" + val.ComplaintRelatedTo + "</td>\n\
                                                <td class='resId' name='resId'>" + val.ComplaintStatus + "</td>\n\
                                        <td class='resId' name='resId'>" + val.VehicleName + "</td>\n\
                                    <td class='resId' name='resId'>" + val.VehicleChassisNumber + "</td>\n\
                        <td><a style='cursor: pointer;'href='#divactiontaken' onClick=takevalues('" + val.ComplaintPadNumber + "')>Reply Action</a></td></tr>";

                            });
                            $('#shwallcomplaints').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#shwallcomplaints").html("<td></td><td></td><td></td><td></td><td></td><td></td><td><label style='border: 0px;margin-left100px'><b>No Data Found</b<</label></td><td></td><td></td><td></td>v");
                    }
                }
                else {
                    console.log('elseblock');
                    $("#shwallcomplaints").html("<td style='border: 0px'>No Data Found</td>");
                }
            }, error: function() {
                console.log('error');
            }
        });
    });

    function getrespectivecontactdetails(obj) {

        $("#fetchcontactdetails").empty();
        var getrelation = $(obj).val();
        var checktext = $("#idcrelation :selected").text();
        var selectedrelation = getrelation;

        if (checktext === "Product") {
            $("#fetchsaleprocess").empty();

            if (selectedrelation !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Inquiryreplyaction/servicecontactdetaildescription",
                    type: "POST",
                    data: {detail: selectedrelation},
                    dataType: "json",
                    success: function(data) {
                        console.log('data');
                        console.log(data);

                        $("#fetchcontactdetails").append("<option>Select Process</option>");
                        if (data.length > 0) {
                            $.each(data, function(index, name) {
                                $("#fetchcontactdetails").append($("<option id=''></option>").val(name['idcr_contactdetaildescription']).html(name['ContactDetailsDescription']));
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
        else {

            $("#fetchcontactdetails").empty();

            if (getrelation !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Inquiryreplyaction/servicecontactdetaildescription",
                    type: "POST", data: {detail: getrelation},
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {

                            $("#fetchcontactdetails").append("<option>Select Detail</option>");

                            $.each(data, function(index, name) {
                                $("#fetchcontactdetails").append($("<option id=''></option>").val(name['idcr_contactdetaildescription']).html(name['ContactDetailsDescription']));
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
    }
    function getrespectivesaleprocess(obj) {

        $("#fetchsaleprocess").empty();
        var getsaleprocess = $(obj).val();
        var checktext = $("#fetchcontactdetails :selected").text();
        var selectedcdetail = getsaleprocess;

        if (selectedcdetail !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/Inquiryreplyaction/servicesaleprocessdescription",
                type: "POST", 
                data: {process: selectedcdetail},
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        console.log(data);
                        $("#fetchsaleprocess").append("<option>Select Process</option>");
                        $.each(data, function(index, value) {
                            $("#fetchsaleprocess").append($("<option id='checkme'></option>").val(value['idSaleProcess']).html(value['SaleProcessDescription']));
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
    function getrespectivesalesubprocess(obj) {

        $("#fetchsalesubprocess").empty();
        var getsalesubprocess = $(obj).val();
        var checktext = $("#fetchsaleprocess :selected").text();
        var selectedsaleprocess = getsalesubprocess;

        if (selectedsaleprocess !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/Inquiryreplyaction/servicesalesubprocessdescription",
                type: "POST", data: {subprocess: selectedsaleprocess},
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        console.log(data);
                        $("#fetchsalesubprocess").append("<option>Select SubProcess</option>");
                        $.each(data, function(index, value) {
                            $("#fetchsalesubprocess").append($("<option id='checkme'></option>").val(value['idSaleSubProcess']).html(value['Description']));
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
    function validationform() {
        var shwRelatedto = $('#idcrelation').val();
        var shwDescription = $('#fetchcontactdetails').val();
        var shwProcess = $('#fetchsaleprocess').val();
        var shwSubProcess = $('#fetchsalesubprocess').val();
        if (shwRelatedto === "Select Related to" && shwDescription === "Select Detail" && shwProcess === "Select Process" && shwSubProcess === "Select SubProcess") {
            $(".error-icrrelation").show();
            $(".error-ifetchdetail").show();
            $(".error-ifetchprocess").show();
            $(".error-ifetchsubprocess").show();
            return false;
        } else {
            if (shwRelatedto === "Select Related to" || shwDescription === "Select Detail" || shwProcess === "Select Process" || shwSubProcess === "Select SubProcess") {

                if (shwRelatedto === "Select Related to") {
                    $(".error-icrrelation").show();
                } else {
                    $(".error-icrrelation").hide();
                }

                if (shwDescription === "Select Detail") {
                    $(".error-ifetchdetail").show();
                } else {
                    $(".error-ifetchdetail").hide();
                }

                if (shwProcess === "Select Process") {
                    $(".error-ifetchprocess").show();
                } else {
                    $(".error-ifetchprocess").hide();
                }

                if (shwSubProcess === "Select SubProcess") {
                    $(".error-ifetchsubprocess").show();
                } else {
                    $(".error-ifetchsubprocess").hide();
                }
                return false;
            }
            return true;
        }
    }
</script>
