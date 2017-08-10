<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager' || $data['Role'] == 'Executive Inquiry') {
            include 'include/cr_inquiryleftmenu.php';
        } else {
            redirect(base_url() . "index.php/crpanel/index");
        }
        ?>
        <div class="right-pnel">
            <div id="divregistercomplaint" class="allforms">
                <div class="feildwrap">
                    <div><h4><?= $insertmessage ?></h4></div><br><br>       
                    <div>
                        <label>Search Customer By</label>
                        <select id="searchby" style="width: 160px" name = "findinfo" data-validation="">
                            <option value="">Chassis Number</option>
                            <option value="">Contact Number</option>
                            <option value="">Registration Number</option>
                        </select>&nbsp;&nbsp;  
                        <input type="text" value="021-33333333" name="search" id="searchnow"
                               placeholder="Search By">
                        <span id="CustomerQueryResult"  name="CustomerQueryResult" style="margin-left:05px;font-weight: bolder;font-size: 14px;">New Customer</span>
                    </div>
                </div>
                <form id="ff" name="registercomplaint" action="<?= base_url() ?>index.php/inquiry/registerinquiry"  onSubmit="return validationform()" method="post" class="form validate-form animated fadeIn">                
                    <fieldset>
                        <legend onclick="showcustomerinfo()">Customer Information</legend>
                        <div id="divcustomerinfo" class="feildwrap">
                            <div>
                                <label>Customer Name</label>
                                <input id="shwcustomername" type="text" name="customername" class=""  data-validation="  " >
                            </div>
                            <div>
                                <label>Mobile Number</label>
                                <input id="shwmobilnum" type="text" name="customermobilenumber">
                            </div>
                            <div>
                                <label>Phone Number</label>
                                <input id="showphonenum" type="text" name="customerphonenumber">
                            </div>
                            <div>
                                <label>Email</label>
                                <input id="shwemail" type="email" name="customeremail" class=""  data-validation="  ">
                            </div>
                            <div>
                                <label>Address</label>
                                <textarea id="shwaddress" name="customeraddress" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                            </div><br>
                            <div>
                                <label>Customer Profile</label>
                                <textarea id="shwcustomerprofile" name="customerprofile" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                            </div><br>
<!--                             <div id="CallDurationDiv" class="feildwrap">                               
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
                            </div><br><br>--><br><br>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend onclick="showvehicleinfo()">Vehicle Information</legend>
                        <div id="divvechicleinfo" class="feildwrap">
                            <div>
                                <label>Variant</label>
                                <select id="shwvehicle" name="vehiclename" style="width: 250px;">
                                    <option>Select Variant</option>             
                                    <?php
                                    $variants = json_decode($variants);
                                    foreach ($variants as $key) {
                                        ?>
                                        <option value=<?php echo $key->IdVariants ?>><?php
                                            echo $key->Variants;
                                            ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div>
                                <label>Register Number</label>
                                <input id="shwvehicleregnum" type="text" name="vehicleregnumber" class=""  data-validation="  ">
                            </div>
                            <div>
                                <label>Chassis Number</label>
                                <input id="shwvehiclechassisnum" type="text" name="vehiclechassisnumber" class=""  data-validation="  ">
                            </div>
                            <div>
                                <label>Engine Number</label>
                                <input id="shwvehicleenginenum" type="text" name="vehicleenginenumber" class=""  data-validation="  ">
                            </div><br>
                            <div>
                                <label>Model No.</label>
                                <input id="Model" type="text" name="Model" placeholder=""  data-validation = "" >
                            </div>
                            <div>
                                <label>Mileage </label>
                                <input id="shwvehiclemilage" type="text" name="vehiclemileage" class=""  data-validation="  ">
                            </div>
                            <div>
                                <label>Year</label>
                                <input id="ModelYear" type="text" name="ModelYear" placeholder=""  data-validation = "" >
                            </div>
                            <div>
                                <label>Date Purchase </label>
                                <input id="shwvehiledatepur" type="date" name="vehicledate" class=""  data-validation="  ">
                            </div>
                            <div>
                                <label>Delivered Form </label>
                                <textarea name="vehicledeliveredform" style="margin: 0px; width: 705px; height: 50px;"></textarea>
                            </div><br>

                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="shwcomplaintregistration()">Inquiry Registration</legend>
                        <div id="divcomplaintregistration" class="feildwrap">
			<div id="CallDurationDiv" class="feildwrap"> 
                            <div>
                                <label>Registered Date</label>
                                <input id="regdate" name="regdate" type="date" data-validation="required">
                            </div><br>
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
                            </div><br>
<!--                            <div>
                                <label>Registered Date</label>
                                <input id="regdate" name="regdate" type="date" data-validation="required">
                            </div><br>-->
                            <div>
                                <label>Receiver</label>
                                <input type="text" name="iduserprofile" value="<?= $data['username'] ?>" class=""  data-validation="" readonly>
                            </div>
                            <div class="" style="width:500px;display: none";>
                                <label>Inquiry Number</label>
                                <input id="inquirynum" type="text" name="padnumber" value=""  placeholder="Inquiry Number" readonly>
                                <!--Acc to New Change-->
<!--                                <table>
                    <tbody>
                        </tr>
                        <tr>
                            <td>
                                <label>Inquiry Number</label>
                                <input id="inquirynum" type="text" name="padnumber" value="<?php echo $padnumber + 1 ?>"  placeholder="Inquiry Number" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>-->
                            </div><br>
                            <div>
                                <label>Mode</label>
                                <div>
                                    <input type="text" name="idcrmode" class=""  data-validation="" value='Inquiry' readonly>
                                </div>
                            </div>
                            <div>
                                <label>Route</label>
                                <select id="idroute" name = "idcrroute">
                                    <option>Select Route</option>                                  
                                    <?php
                                    $inquiryroute = json_decode($inquiryroute);

                                    foreach ($inquiryroute as $key) {
                                        ?>

                                        <option value=<?php echo $key->idcr_route ?>><?php
                                            echo $key->Name;
                                            ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error-iroute cb-error help-block" style="margin-left: 235px;margin-top: -72px">Option must be selected!</span>
                            </div>
                          <div>
                                <label>Inquiry Related to</label>
                                <select id="idrelatedto" name = "idcrcomplainrelation">
                                    <option>Select Related to</option>                                     
                                    <?php
                                    $inquiryrelation = json_decode($inquiryrelation);
                                    foreach ($inquiryrelation as $key) {
                                        ?>
                                        <option value=<?php echo $key->idcr_complainrelation ?>><?php
                                            echo $key->Name;
                                            ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error-irelatedto cb-error help-block" style="margin-left: 235px;margin-top: -72px">Option must be selected!</span>
                            </div> 
                              <div class="feildwrap">
                                <div>
                                    <label id="isfcrlabel" >Is FCR</label>
                                    <select id="idrelatedto" name = "isfcr">
                                        <option value="1">FCR</option>  
                                        <option value="2">Non-FCR</option>  

                                    </select>
                                </div><br>
                            <div>
                                <label>Voice of Customer</label>
                                <textarea name="voiceofcustomer" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                            </div><br>    
                            <div>
                                <label>Respond To</label>
                                <textarea name="respondto" style="margin: 0px; width: 724px; height: 100px;"></textarea>
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
                                <select id="idskills" name = "idcruserskills" style="width: 150px;">
                                    <option>Select Skills</option>  
                                    <?php
                                    $inquiryuserskills = json_decode($inquiryuserskills);
                                    foreach ($inquiryuserskills as $key) {
                                        ?>
                                        <option value=<?php echo $key->idcr_userskills ?>><?php
                                            echo $key->Name;
                                            ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error-iskills cb-error help-block" style="margin-left: 235px;margin-top: -72px">Option must be selected!</span>
                            </div><br>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="">Share Inquiry</legend>
                        <div id="divdecision" class="feildwrap">
                            <span>Do you want to share the Inquiry ?</span>
                            <input id="shareIYes" name="isshare" type="radio" value="1">Yes
                            <input id="shareINo"  name="isshare" type="radio" value="0" checked>No
                        </div><br>
                        <div id="divshwRange" class="feildwrap">
                            <span>Share up to number of Department(s)</span>
                            <input id="shwIRange" name='shwrange' type="number" min="1" max="5" name="sex" onchange="shwShareComplaint(this)" onkeyup="if (parseInt(this.value) > 5)
                                        return false;
                                    shwShareComplaint(this)">
                        </div><br><br>
                        <div id="divsharecomplain" class="feildwrap" style="margin-left: -60px">
                            <div id='Ideparts'>
                                <label>Departments</label>
                            </div><br>
                            <div id='Iroles'>
                                <label>Roles</label>
                            </div><br>
                            <div id='Inames'>
                                <label>Names</label>
                            </div>
                        </div><br>
                        <div style="float: right;margin-right: 50px">
                            <input id="shareButton" name="shareButton" type="submit" class="btn" value="Share" style="width: 200px">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>

    var getdepartval = "";
    var getdepartindex = "";

    $(document).ready(function() {
        $('#divtblallcomplaints').hide();
        $('#divsharecomplain').hide();
        $('#divshwRange').hide();
        $("#shareIYes").click(function() {
            $('#divshwRange').show();
        });
        $("#shareINo").click(function() {
            $('#divsharecomplain').hide();
            $('#divshwRange').hide();
        });
        $('#CustomerQueryResult').hide();
    });

    $('#searchnow').focusout(function() {
        var searchby = $("#searchby option:selected").text();
        var searchnow = $('#searchnow').val();
        if (searchnow !== "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/Inquiry/serviceexistingcustomer",
                type: "POST", data: {searchby: searchby, searchnow: searchnow},
                dataType: "json",
                success: function(data) {
                    if (data['customer'].length > 0) {
                        $('#CustomerQueryResult').html('Customer is Already Registered');
                        $('#CustomerQueryResult').show();
                        $('#shwvehicle').html(' ');
                        $('#shwcustomername').val(data['customer'][0]['Name']);
                        $('#showphonenum').val(data['customer'][0]['PhoneNumber']);
                        $('#shwmobilnum').val(data['customer'][0]['MobileNumber']);
                        $('#shwemail').val(data['customer'][0]['Email']);
                        $('#shwaddress').val(data['customer'][0]['Address']);
                        $('#shwvehicle').append($("<option>Select Variant</option>").val(data['customer'][0]['VariantId']).html(data['crcustomer'][0]['VehicleName']));
                        $('#shwvehiclechassisnum').val(data['customer'][0]['ChassisNumber']);
                        $('#shwvehicleenginenum').val(data['customer'][0]['EngineNumber']);
                    }
                    else {
                        if (data['crcustomer'].length > 0) {
                            $('#CustomerQueryResult').html('Customer is Already Registered');
                            $('#CustomerQueryResult').show();
                            $('#shwvehicle').html(' ');
                            $('#shwcustomername').val(data['crcustomer'][0]['Name']);
                            $('#showphonenum').val(data['crcustomer'][0]['PhoneNumber']);
                            $('#shwmobilnum').val(data['crcustomer'][0]['MobileNumber']);
                            $('#shwemail').val(data['crcustomer'][0]['Email']);
                            $('#shwaddress').val(data['crcustomer'][0]['Address']);
                            $('#shwvehicle').append($("<option>Select Variant</option>").val(data['crcustomer'][0]['VariantId']).html(data['crcustomer'][0]['VehicleName']));
                            $('#shwvehiclechassisnum').val(data['crcustomer'][0]['ChassisNumber']);
                            $('#shwvehicleenginenum').val(data['crcustomer'][0]['EngineNumber']);
                            $('#shwvehicleregnum').val(data['crcustomer'][0]['RegNumber']);
                            $('#Model').val(data['crcustomer'][0]['Model']);
                            $('#ModelYear').val(data['crcustomer'][0]['ModelYear']);
                            $('#shwvehiledatepur').val(data['crcustomer'][0]['DateOfPurchase']);
                        } else {
                            $('#CustomerQueryResult').html('Customer is Not Registered');
                            $('#CustomerQueryResult').show();
                        }
                    }
                },
                error: function() {
                    console.log('error');
                }
            });
        } else {
//            location.reload();
        }
    });

    function shwShareComplaint(obj) {

        $('#divsharecomplain').show();
        $('#Ideparts').html('');
        $('#Iroles').html('');
        $('#Inames').html('');
        var upTo = $(obj).val();
        var items = "<label>Departments</label>";
        $.ajax({
            url: "<?= base_url() ?>index.php/Inquiry/servicegetdepartments",
            dataType: "json",
            success: function(data) {
                try {
                    for (var a = 1; a <= upTo; a++) {
                        items += "<select id='selecteddepartment' name='selecteddepartment[]' style='margin-left: 05px; width: 150px; height: 35px;' onchange='getrespectivevalue(this," + a + ")'>";
                        items += "<option>Select Department</option>";
                        $.each(data, function(index, value) {
                            items += "<option value='" + value['IdDepartment'] + "'>" + value['Department'] + "</option>";
                        });
                        items += "</select>";
                    }
//                    items += "</div><br><br>";
                    $('#Ideparts').append(items);

                } catch (e) {

                }
            },
            error: function(data) {
            }
        });

        var roles = "<label>Roles</label>";
        $.ajax({
            url: "<?= base_url() ?>index.php/Inquiry/serviceapprole",
            dataType: "json",
            success: function(data) {
                try {
                    for (var i = 1; i <= upTo; i++) {
                        roles += "<select id='selectedrole" + i + "' name='selectedrole[]' style='margin-left: 05px; width: 150px; height: 35px;' onchange='getrespectiveusername(this," + i + ")' >";
                        roles += "<option>Select Roles</option>";
                        $.each(data, function(index, value) {
                            roles += "<option value='" + value['abc'] + "'>" + value['RoleName'] + "</option>";
                        });
                        roles += "</select>";
                    }
                    $('#Iroles').append(roles);
                } catch (e) {

                }
            },
            error: function(data) {
            }
        });
        var names = "<label>Names</label>";
        try {
            for (var i = 1; i <= upTo; i++) {
                names += "<select id='selectedname" + i + "' name='selectedname[]' style='margin-left: 05px; width: 150px; height: 35px;'>";
                names += "<option>Select Names</option></select>";
                names += "<span id='errorname" + i + "' class='error-names cb-error help-block' style='margin-left: -150px;margin-top: 40px;display:none'>Select Name</span>";
            }
            $('#Inames').append(names);
        } catch (e) {

        }

    }

    function showcustomerinfo() {
        $("#divcustomerinfo").toggle();
    }

    function showvehicleinfo() {
        $("#divvechicleinfo").toggle();
    }

    function shwcomplaintregistration() {
        $("#divcomplaintregistration").toggle();
    }

    function showsharecomplain() {
        $("#divsharecomplain").toggle();
    }

    function showvarianthistory() {
        $("#divvarianthistory").toggle();
    }

    function showactiontaken() {
        $("#divactiontaken").toggle();
    }

    function showkizentaken() {
        $("#divkizentaken").toggle();
    }

    function showupdatecomplaintregister() {
        $("#divupdatecomplaintregister").toggle();
    }

    function showtblcomplaints() {

        $('.allforms').toggle();
        $("#divtblallcomplaints").toggle();
    }

    function getrespectivevalue(obj, value_) {
        getdepartval = obj.options[obj.selectedIndex].text;
        getdepartindex = value_;
    }

    function getrespectiveusername(obj, value_) {

        $("#selectedname" + value_).empty();
        var getval = obj.options[obj.selectedIndex].text;
        if (value_ === getdepartindex) {
            var selectedepart = getdepartval;
        }
        var selectedrole = getval;
        if (selectedrole !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/Inquiry/servicegetuserinfo",
                type: "POST", data: {department: selectedepart, role: selectedrole},
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        console.log(data);
                        $("#selectedname" + value_).append($("<option>Select Name</option>"));
                        $.each(data, function(index, value) {
                            $("#selectedname" + value_).append($("<option id=''></option>").val(value['id']).html(value['Name']));
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

    function changeText() {
        if ($('#isfcr').is(':checked')) {
            $('#shareButton').val('Close');
        } else {
            $('#shareButton').val('Share');
        }
    }

    function validationform() {
        var shwRoute = $('#idroute').val();
        var shwRelatedto = $('#idrelatedto').val();
        var shwSkills = $('#idskills').val();
        var nameOne = $('#selectedname1').val();
        var nameTwo = $('#selectedname2').val();
        var nameThree = $('#selectedname3').val();
        var nameFour = $('#selectedname4').val();
        var nameFive = $('#selectedname5').val();
        if (shwRoute === "Select Route" && shwRelatedto === "Select Releated to" && shwSkills === "Select Skills" && nameOne === "Select Names" && nameTwo === "Select Names" && nameThree === "Select Names" && nameFour === "Select Names" && nameFive === "Select Names") {
            $(".error-iroute").show();
            $(".error-irelatedto").show();
            $(".error-iskills").show();
            $("#errorname1").show();
            $("#errorname2").show();
            $("#errorname3").show();
            $("#errorname4").show();
            $("#errorname5").show();
            return false;
        } else {
            if (shwRoute === "Select Route" || shwRelatedto === "Select Releated to" || shwSkills === "Select Skills" || nameOne === "Select Names" || nameTwo === "Select Names" || nameThree === "Select Names" || nameFour === "Select Names" || nameFive === "Select Names") {

                if (shwRoute === "Select Route") {
                    $(".error-iroute").show();
                } else {
                    $(".error-iroute").hide();
                }

                if (shwRelatedto === "Select Related to") {
                    $(".error-irelatedto").show();
                } else {
                    $(".error-irelatedto").hide();
                }

                if (shwSkills === "Select Skills") {
                    $(".error-iskills").show();
                } else {
                    $(".error-iskills").hide();
                }

                if (nameOne === "Select Names") {
                    $("#errorname1").show();
                } else {
                    $("#errorname1").hide();
                }

                if (nameTwo === "Select Names") {
                    $("#errorname2").show();
                } else {
                    $("#errorname2").hide();
                }

                if (nameThree === "Select Names") {
                    $("#errorname3").show();
                } else {
                    $("#errorname3").hide();
                }

                if (nameFour === "Select Names") {
                    $("#errorname4").show();
                } else {
                    $("#errorname4").hide();
                }

                if (nameFive === "Select Names") {
                    $("#errorname5").show();
                } else {
                    $("#errorname5").hide();
                }
                return false;
            }
            return true;
        }
    }

    // Calculating Call Duration
    function timeSpent() {
        var callStart = $("#starttime").val();
        var callEnd = $("#endtime").val();
        if (callStart == "") {
            callStart = "00:00:00";
        }
        if (callEnd == "") {
            callEnd = "00:00:00";
        }
        callStart = callStart.split(":");
        callEnd = callEnd.split(":");
        var timeStart = new Date(0, 0, 0, callStart[0], callStart[1], callStart[2]);
        var timeEnd = new Date(0, 0, 0, callEnd[0], callEnd[1], callEnd[2]);
        var diff = timeEnd.getTime() - timeStart.getTime();
        var hours = Math.floor(diff / 1000 / 60 / 60);
        var minutes = Math.floor(diff / 1000 / 60);
        var seconds = Math.floor(diff / 1000);
        $("#calldurationtime").val((hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes + ":" + (seconds < 9 ? "0" : "") + seconds);

//        Code for Converting Minutes to Hours
//        var mintModulus = minutes % 60;
//        if (mintModulus === 0) {
//            hours = hours + Math.floor(minutes / 60);
//            console.log('The Hour is ' + hours);
//        } else {
//            hours = hours + Math.floor(minutes / 60);
//            console.log('The Added Hour is ' + hours);
//            console.log();
////            minutes = minutes + mintModulus;
//            console.log('The Added Minute is ' + mintModulus);
//        }
    }

</script>
