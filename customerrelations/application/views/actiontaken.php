
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager') {
            include 'include/cr_complaintleftmenu.php';
        } else {
            redirect(base_url() . "index.php/crpanel/");
        }
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <div id="searchform" class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend>Search Complaints</legend>
                        <div>
                            <label>Search</label>
                            <input type="text" name="padnumber" id="searchnow"
                                   placeholder="By Complaint Number">    
                        </div>
                    </fieldset>
                </div><br>
                <div class="feildwrap" id="divtblallcomplaints">
                    <fieldset>
                        <legend>Complaints </legend>
                        <div class="btn-block-wrap dg" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%">S#</th>
                                        <th width="10%">Comp#</th>
                                        <th width="10%">Reg.Date</th>
                                        <th width="15%">Attend</th>
                                        <th width="30%">Customer</th>
                                        <th width="10%">Contact</th>
                                        <th width="30%">VOC</th>
                                        <th width="10%">Route</th>
                                        <th width="10%">Mode</th>
                                        <th width="10%">RelatedTo</th>
                                        <th width="15%">Variant</th>
                                        <th width="15%">Chassis No.</th>
                                        <th width="15%">Detail</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="14">
                                            <div id="paging">
                                                <ul>
                                                    <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                    <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                    <!--                                            <li><a href="" class="active"><span>-->
                                                    <!--</span></a></li>-->
                                                    <!--                                            <li>-->
                                                    <?//= $pagination; ?><!--</li>-->
                                                    <!--                                                <li><a href=""><span>3</span></a></li>-->
                                                    <!--                                                <li><a href=""><span>4</span></a></li>-->
                                                    <!--                                                <li><a href=""><span>5</span></a></li>-->
                                                    <!--                                            <li><a href=""><span>Next</span></a></li>-->
                                                </ul>
                                            </div>
                                    </tr>
                                </tfoot>   
                                <tbody id="shwallcomplaints">
                                    <?php
                                    $count = 1;
                                    $allcomplaints = json_decode($allcomplaints);
                                    foreach ($allcomplaints as $key) {
                                        ?>
                                        <tr id="allcomplaints">
                                            <td name="complaintsno"><?= $count++ ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintPadNumber ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRegDate ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->AttenderName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->CustomerCellphone ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VoiceOfCustomer ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRecieveFrom ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintMode ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRelatedTo ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleChassisNumber ?></td>
                                            <td><a href="#divactiontaken" onclick="takevalues(<?php echo $key->ComplaintPadNumber ?>,<?php echo $key->ComplaintID ?>)">Action Taken</a></td>
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
                        <legend onclick="shwcomplaintregistration_()">Complaint Registration</legend>
                        <div id="divcomplaintregistration" class="feildwrap">
                            <div>
                                <label>Complaint Receiver</label>
                                <input id="iduserprofile" type="text" name="iduserprofile" value="Admin" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Complaint Number</label>
                                <input id="padnumber" required type="number" value="" name="padnumber" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Mode</label>
                                <div>
                                    <input id="idcrmode" type="text" name="idcrmode" class=""  data-validation="" value='Complaint' readonly>
                                </div>
                            </div>
                            <div>
                                <label>Route</label>
                                <input id="idcroute" type="text" name="idcroute" class=""  data-validation="" value='' readonly>
                            </div>
                            <div>
                                <label>Select Mode</label>
                                <input id="idcompcrmode" vehicledeliveredform type="text" name="idcompcrmode" class=""  data-validation="" value='' readonly>
                            </div>
                            <div>
                                <label>Complaint Related to</label>
                                <input id="idcomplaintrelto" type="text" name="idcomplaintrelto" class=""  data-validation="" value='' readonly>
                            </div><br>
                            <div>
                                <label>Voice of Customer</label>
                                <textarea id="voiceofcustomer" name="voiceofcustomer" style="margin: 0px; width: 724px; height: 100px;" readonly></textarea>
                            </div><br>
                            <div>
                                <label>Customer Request</label>
                                <textarea id="customerrequest" name="customerrequest" style="margin: 0px; width: 724px; height: 100px;" readonly></textarea>
                            </div>
                            <div>
                                <label>Registered Date</label>
                                <input id="regdate" class=""  name="regdate" type="text" readonly>
                            </div>
                            <div>
                                <label>User Skills</label>
                                <input id="userskills" type="text" name="userskills" class=""  data-validation="" value='' readonly>
                            </div><br><br>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="showvarianthistory_()">Variant History</legend>
                        <div id="divvarianthistory" class="feildwrap">

                            <div>
                                <label>Repair Order Number</label>
                                <input id="shwronumber" type="number" name="repairodernumber" class=""  data-validation="  " placeholder="" readonly>
                            </div>
                            <div>
                                <label>Delivery Date</label>
                                <input id="shwdeliverdate" type="text" name="deliverydate" class=""  data-validation="  " placeholder="" readonly>
                            </div>
                            <div>
                                <label>TR Number</label>
                                <input id="shwtrnumber" type="number" name="trnumber" class=""  data-validation="  "  placeholder="" readonly>
                            </div>
                            <div>
                                <label>TR Date</label>
                                <input id="shwtrdate" type="text" name="trdate" class=""  data-validation="  "  placeholder="" readonly>
                            </div>
                            <div>
                                <label>Mileage</label>
                                <input id="shwvariantmileage" type="numer" name="variantmileage" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Work Done</label>
                                <textarea id="shwvariantworkdone" name="variantworkdone" style="margin: 0px; width: 724px; height: 100px;" readonly></textarea>
                            </div><br>

                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="showsharecomplain_()">Share Complaint</legend>                                         
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
                <form id="actiontaken" action="<?= base_url() ?>index.php/actiontaken/updatecomplaintactiontaken" onsubmit="return validationform()" method="post" class="form validate-form animated fadeIn">
                    <fieldset>
                        <legend>Complaint Resolution</legend>
                        <div class="feildwrap" style="display: none">
                            <div>
                                <input id="idcrcomplain" name="idcrcomplain">
                            </div>
                            <div>
                                <input id="rpadnumber" name="rpadnumber">
                            </div>
                        </div>
                        <fieldset>
                            <legend onclick="showactiontaken_()">Action Taken</legend>
                            <div id="divactiontaken_" class="feildwrap">
                                <div>
                                    <textarea name="actiontakendescription" style="margin: 0px; width: 724px; height: 100px;" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </fieldset>
                         <fieldset>
                            <legend onclick="showactiontaken_()">Remarks</legend>
                            <div id="divactiontaken_" class="feildwrap">
                                <div>
                                    <textarea name="Remarks" style="margin: 0px; width: 724px; height: 100px;" placeholder="Remarks"></textarea>
                                </div>
                              
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend onclick="showkizentaken_()" >Kaizen Taken</legend>
                            <div id="divkaizentaken_" class="feildwrap">
                                <div>
                                    <textarea name="kaizendescription" style="margin: 0px; width: 724px; height: 100px;" placeholder="Description"></textarea>
                                </div><br>
                            </div><br>
                        </fieldset>
                        <fieldset>
                            <legend onclick="showvocclassification()">VOC Classification</legend>
                            <div  id="divvocclassification" class="feildwrap">
                                <div>
                                    <label>Complaint Related to</label>
                                    <select id="idcrelation" name = "idcrcomplainrelation" onchange="getrespectivecontactdetails(this)">
                                        <option>Select Related to</option>                                                 
                                        <?php
                                        $coutries = json_decode($complaintrelation);
                                        foreach ($coutries as $key) {
                                            ?>
                                            <option value=<?php echo $key->idcr_complainrelation ?>><?php
                                                echo $key->Name;
                                                ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="error-crrelation cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                </div><br><br>
                                <div>
                                    <label id="labeldetaildescription">Contact Details Description</label>
                                    <div>
                                        <select id="fetchcontactdetails"  name="contactdetaildescription" onchange="getrespectivesaleprocess(this)"></select>
                                        <span class="error-fetchdetail cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                    </div>
                                </div><br><br>
                                <div>
                                    <label>Sale Process Description</label>
                                    <div>
                                        <select id="fetchsaleprocess" name="saleprocessdescription"  onchange="getrespectivesalesubprocess(this)">
                                        </select>
                                        <span class="error-fetchprocess cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
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
                                                    <span class="error-fetchsubprocess cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
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
    function showfeedback_() {
        $("#divfeedback_").toggle();
    }
    function showvocclassification() {
        $("#divvocclassification").toggle();
    }
    function showclosingdatetime() {

        $("#lableclose").toggle();
        $(".closingdatetime").toggle();
    }
    function takevalues(padnum, idcomplaints) {

        $('#searchform').hide();
        $('#divtblallcomplaints').hide();
        $('#divsubmittedform').show();
        $('#divactiontaken').show();
        $('#btnsave').show();
        $.ajax({
            url: "<?= base_url() ?>index.php/Actiontaken/servicefilteredcomplaintsharing",
            type: "POST",
            data: {padnumber: padnum, idcomplaints: idcomplaints},
            dataType: "json",
            success: function(data) {

                if (data['allcomplaints'].length > 0) {

                    complaintid = data['allcomplaints'][0]['ComplaintID'];
                    pad = data['allcomplaints'][0]['ComplaintPadNumber'];
                    
                    console.log('data[]');
                    console.log(data['allcomplaints']);

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
                    $('#idcompcrmode').val(data['allcomplaints'][0]['ComplaintMode']);
                    $('#idcomplaintrelto').val(data['allcomplaints'][0]['ComplaintRelatedTo']);
                    $('#voiceofcustomer').val(data['allcomplaints'][0]['VoiceOfCustomer']);
                    $('#customerrequest').val(data['allcomplaints'][0]['CustomerRequest']);
                    $('#regdate').val(data['allcomplaints'][0]['ComplaintRegDate']);
                    $('#userskills').val(data['allcomplaints'][0]['ComplaintUserSkills']);

                    //Variant History Info
                    $('#shwronumber').val(data['allcomplaints'][0]['HistoryRONumber']);
                    $('#shwdeliverdate').val(data['allcomplaints'][0]['HistoryDeliveryDate']);
                    $('#shwtrnumber').val(data['allcomplaints'][0]['HistoryTRNumber']);
                    $('#shwtrdate').val(data['allcomplaints'][0]['HistoryTRDate']);
                    $('#shwvariantmileage').val(data['allcomplaints'][0]['HistoryMileage']);
                    $('#shwvariantworkdone').val(data['allcomplaints'][0]['HistorytWorkDone']);
                    $('#idcrelation').append($("<option></option>").val(data['allcomplaints'][0]['idcr_complainrelation']).html(data['allcomplaints'][0]['ComplaintRelatedTo']));
                    $('#idcrcomplain').val(data['allcomplaints'][0]['ComplaintID']);
                    $('#rpadnumber').val(data['allcomplaints'][0]['ComplaintPadNumber']);
                    //Complaint Shareto Info

                    var inputdepart = $('#shwalldeparts');
                    var inputroles = $('#shwallroles');
                    var inputnames = $('#shwallnames');
                    var inputfeedback = $('#shwfeedback');

                    alldeparts = new Array();
                    allroles = new Array();
                    allnames = new Array();
                    allfeedback = new Array();
                    if (data['sharingdata'].length > 0) {
                        for (var i = 0; i < data['sharingdata'].length; i++) {

                            inputdepart.append("<label>Department</label><input id='sharedepart' type='text' name='sharedepart' style='margin: 0px; width: 125px; height: 35px;'  value='" + data['sharingdata'][i]['Department'] + "' readonly><br><br>&nbsp;&nbsp;&nbsp;");
                            inputdepart.append("<label>Role</label><input id='sharedepart' type='text' name='sharedepart' style='margin: 0px; width: 125px; height: 35px;' value='" + data['sharingdata'][i]['Designation'] + "' readonly><br><br>&nbsp;&nbsp;&nbsp;");
                            inputdepart.append("<label>Name</label><input id='sharedepart' type='text' name='sharedepart' style='margin: 0px; width: 125px; height: 35px;' value='" + data['sharingdata'][i]['Name'] + "' readonly><br><br>&nbsp;&nbsp;&nbsp;");
                            inputdepart.append("<label>FeedBack</label><textarea style='margin: 0px; width: 350px; height: 100px;' readonly>" + data['sharingdata'][i]['FeedBack'] + "</textarea><br><br>&nbsp;&nbsp;&nbsp;");

                        }
                    } else {
                        $('#divsharecomplain').html('Share to None');
                    }
                }
                else {

                }
            },
            error: function(data) {

            }
        });
    }

    $(".closingdatetime").hide();
    $('#searchnow').keyup(function() {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Actiontaken/servicesearchallcomplaints",
            type: "POST",
            data: {padnumber: searchnow},
            dataType: "json",
            success: function(data) {
                if (data.length > 0) {
                    var count = 1;
                    var items = [];
                    $.each(data, function(i, val) {
                        items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ComplaintPadNumber + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ComplaintRegDate + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.AttenderName + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.CustomerName + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.CustomerCellphone + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.VoiceOfCustomer + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ComplaintRecieveFrom + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ComplaintMode + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ComplaintRelatedTo + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.VehicleName + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.VehicleChassisNumber + "</td>\n\
                                                            <td><a style='cursor: pointer;'href='#divactiontaken' onClick=takevalues('" + val.ComplaintPadNumber + "','" + val.ComplaintID + "')>Action Taken</a></td></tr>";
                    });
                    $('#shwallcomplaints').html(items);
                }
                else {
                    console.log('elseblock');
                    $("#shwallcomplaints").html("<td></td><td></td><td></td><td></td><td></td><td></td><td><label style='border: 0px;margin-left100px'><b>No Data Found</b<</label></td><td></td><td></td><td></td>v");
                }
            }, error: function() {
                console.log('error');
            }
        });
    });
//onchange functions
    function getrespectivecontactdetails(obj) {

        $("#fetchcontactdetails").empty();
        var getrelation = $(obj).val();
        var checktext = $("#idcrelation :selected").text();
        var selectedrelation = getrelation;
        if (checktext === "Product") {
            if (selectedrelation !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Actiontaken/servicecontactdetaildescription",
                    type: "POST",
                    data: {detail: selectedrelation},
                    dataType: "json",
                    success: function(data) {
                        console.log('data');
                        console.log(data);
                        if (data.length > 0) {

                            $("#fetchcontactdetails").append("<option>Select Process</option>");
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
                    url: "<?= base_url() ?>index.php/Actiontaken/servicecontactdetaildescription",
                    type: "POST", data: {detail: getrelation},
                    dataType: "json",
                    success: function(data) {
                        console.log('data');
                        console.log(data);
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

        $("#fetchsaleprocess").html(' ');
        var getsaleprocess = $(obj).val();
        console.log(getsaleprocess);
//        var checktext = $("#fetchcontactdetails :selected").text();
        var selectedcdetail = getsaleprocess;
        if (selectedcdetail !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/Actiontaken/servicesaleprocessdescription",
                type: "POST", data: {process: selectedcdetail},
                dataType: "json",
                success: function(data) {

                    console.log(data.length);
                    if (data.length > 0) {

                        $("#fetchsaleprocess").append("<option>Select Process</option>");
                        $.each(data, function(index, value) {
                            $("#fetchsaleprocess").append($("<option></option>").val(value['idSaleProcess']).html(value['SaleProcessDescription']));
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
                url: "<?= base_url() ?>index.php/Actiontaken/servicesalesubprocessdescription",
                type: "POST", data: {subprocess: selectedsaleprocess},
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {

                        $("#fetchsalesubprocess").append("<option>Select SubProcess</option>");
                        $.each(data, function(index, value) {
                            $("#fetchsalesubprocess").append($("<option></option>").val(value['idSaleSubProcess']).html(value['Description']));
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
            $(".error-crrelation").show();
            $(".error-fetchdetail").show();
            $(".error-fetchprocess").show();
            $(".error-fetchsubprocess").show();
            return false;
        } else {
            if (shwRelatedto === "Select Related to" || shwDescription === "Select Detail" || shwProcess === "Select Process" || shwSubProcess === "Select SubProcess") {

                if (shwRelatedto === "Select Related to") {
                    $(".error-crrelation").show();
                } else {
                    $(".error-crrelation").hide();
                }

                if (shwDescription === "Select Detail") {
                    $(".error-fetchdetail").show();
                } else {
                    $(".error-fetchdetail").hide();
                }

                if (shwProcess === "Select Process") {
                    $(".error-fetchprocess").show();
                } else {
                    $(".error-fetchprocess").hide();
                }

                if (shwSubProcess === "Select SubProcess") {
                    $(".error-fetchsubprocess").show();
                } else {
                    $(".error-fetchsubprocess").hide();
                }
                return false;
            }
            return true;
        }
    }
</script>
