<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager' || $data['Role'] == 'Executive Complaint') {
            include 'include/cr_complaintleftmenu.php';
        } else {
            redirect(base_url() . "index.php/login/index");
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
                        <input type="text" name="search" id="searchnow"
                               placeholder="Search By" style="width:175px">
                        <span id="CustomerQueryResult" name="CustomerQueryResult" style="margin-left:05px;font-weight: bolder;font-size: 14px;">New Customer</span>
                    </div>
                </div>
                <form id="ff" action="<?= base_url() ?>index.php/complaint/registercomplaint" name="registercomplaint" onSubmit="return validationform()" method="post" class="form validate-form animated fadeIn">
                    <fieldset>
                        <legend onclick="showcustomerinfo()">Customer Information</legend>
                        <div id="divcustomerinfo" class="feildwrap">
                            <div>
                                <label>Customer Name</label>
                                <input id="shwcustomername" type="text" name="customername" class="">
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
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend onclick="showvehicleinfo()">Vehicle Information</legend>

                        <!-- For Chassiss Number-->

                        <div id="divvechicleinfo" class="feildwrap">
                            <div id="shwvehicleseldiv">
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
<!--                                <input id="shwvehicle" type="text" name="vehiclename" class=""  data-validation="  ">-->
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
                                <input id="shwvehiledatepur"  class="" type="date" name="vehicledate" data-validation="" value="">
                            </div>
                            <div>
                                <label>Delivered Form </label>
                                <textarea name="vehicledeliveredform" style="margin: 0px; width: 705px; height: 50px;"></textarea>
                            </div><br>
                        </div>

                        <!-- For Contact Number-->

                        <!--                        <div id="divvecinfocntct" class="feildwrap">
                                                    <div id="shwvehicleseldiv">
                                                        <label>Variant</label>
                                                        <select id="shwvehicle" name="vehiclename">
                                                            <option>Select Variant</option>             
                        <?php
                        $variants = json_decode($variants);
                        foreach ($variants as $key) {
                            ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <option value=<?php echo $key->IdVariants ?>><?php
                            echo $key->Variants;
                            ?></option>
                        <?php } ?>-->

                    </fieldset>
                    <fieldset>
                        <legend onclick="shwcomplaintregistration()">Complaint Registration</legend>
                        <div id="divcomplaintregistration" class="feildwrap">
                            <div>
                                <label>Complaint Receiver</label>
                                <input type="text" name="iduserprofile" value="<?= $data['username'] ?>" class=""  data-validation="" readonly>
                            </div>
                            <div class="feildwrap" style="width:400px;">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td id="PadNumberAvailability">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="display: none;">
                                                <label>Complaint Number</label>
                                                <input required id="complaintnum" type="number" value="" name="padnumber" class=""  data-validation="" placeholder="Complaint Number" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <label>Mode</label>
                                <div>
                                    <input type="text" name="idcrmode" class=""  data-validation="" value='Complaint' readonly>
                                </div>
                            </div>
                            <div>
                                <label>Route</label>
                                <select id="idcrroute" name="idcrroute">
                                    <option>Select Route</option>             
                                    <?php
                                    $json_encode = json_decode($route);
                                    foreach ($json_encode as $key) {
                                        ?>
                                        <option value=<?php echo $key->idcr_route ?>><?php
                                            echo $key->Name;
                                            ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error-route cb-error help-block" style="margin-left: 235px;margin-top: -72px">Option must be selected!</span>
                            </div>
                            <div>
                                <label>Select Mode</label>
                                <select id="idcrcomplainmode" name = "idcrcomplainmode" onchange="getmodecategory(this)">
                                    <option>Select Mode</option>  
                                    <?php
                                    $json_encode = json_decode($complaintmode);
                                    foreach ($json_encode as $key) {
                                        ?>
                                        <option value=<?php echo $key->idcr_complainmode ?>><?php
                                            echo $key->ModeName;
                                            ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error-mode cb-error help-block" style="margin-left: 235px;margin-top: -72px">Option must be selected!</span>
                            </div>
                            <div>
                                <label id="lblcompmodectgry">Mode Category</label>
                                <select id="compmodectgry" name = "idcrcompmodectgry">
                                    <option>Select Category</option>  
                                </select>
                                <span class="error-category cb-error help-block" style="margin-left: 235px;margin-top: -72px">Option must be selected!</span>
                            </div>
                            <div>
                                <label>Complaint Related to</label>
                                <select id="idcrcomplainrelation" name = "idcrcomplainrelation">
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
                                <span class="error-relatedto cb-error help-block" style="margin-left: 235px;margin-top: -72px">Option must be selected!</span>
                            </div><br>
                            <div>
                                <label>Voice of Customer</label>
                                <textarea name="voiceofcustomer" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                            </div><br>
                            <div>
                                <label>Response to Customer</label>
                                <textarea name="customerrequest" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                            </div>
                            <div>
                                <label>Registered Date</label>
                                <input id="regdate" name="regdate" type="datetime-local" data-validation="required">
                            </div>
                            <div>
                                <label>User Skills</label>
                                <select id="idcruserskills" name = "idcruserskills">
                                    <option>Select Skills</option>  
                                    <?php
                                    $json_encode = json_decode($complaintuserskills);
                                    foreach ($json_encode as $key) {
                                        ?>
                                        <option value=<?php echo $key->idcr_userskills ?>><?php
                                            echo $key->Name;
                                            ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error-skills cb-error help-block" style="margin-left: 235px;margin-top: -72px">Option must be selected!</span>
                            </div><br><br>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="showvarianthistory()">Vehicle History</legend>
                        <div  id="divvarianthistory" class="feildwrap">
                            <div>
                                <label>TR Number</label>
                                <input id="shwtrnumber" type="number" name="trnumber" class=""  data-validation="  "  placeholder="">
                            </div>
                            <div>
                                <label>TR Date</label>
                                <input id="shwtrdate" type="date" name="trdate" class=""  data-validation="  "  placeholder="">
                            </div>
                            <div style="float: left">
                                <label>Repair Order Number(s)</label>
                                <input id="shwronumber" type="number" name="repairodernumber" class=""  data-validation="" placeholder="" >
                                <!--<select id="shwronumber" name="repairodernumber[]" class="chosen-select" multiple  style="width: 250px;" readonly>
                                    <option value="View All ROs" selected>View All ROs</option>             
                                </select>-->  
                            </div>
                            <div style="float: right">
                                <label>Delivery Date(s)</label>
                                <input id="shwdeliverdate" type="datetime" name="deliverydate" class=""  placeholder="" >
                                <!--<select id="shwdeliverdate" name="deliverydate[]"  class="chosen-select" multiple  style="width: 250px;" readonly>
                                    <option value="View Delivery Dates">View Delivery Dates</option>             
                                </select> -->
                            </div>                         
                            <div style="float: left">
                                <label>Mileage(s)</label>
                                <input id="shwvariantmileage" type="numer" name="variantmileage" class=""  data-validation="" >
                                <!--<select id="shwvariantmileage" name="variantmileage[]" class="chosen-select" multiple style="width: 250px;" readonly>
                                    <option value="View Mileages">View Mileages</option>             
                                </select> -->
                            </div>
                            <div>
                                <label>Work Done</label>
                                <textarea id="shwvariantworkdone" name="variantworkdone" style="margin: 0px; width: 724px; height: 100px;" ></textarea>
                            </div><br>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend onclick="">Share Complaint</legend>
                        <div id="divdecision" class="feildwrap">
                            <span>Do you want to share the Complaint ?</span>
                            <input id="shareYes" name="isshare" type="radio" value="1">Yes
                            <input id="shareNo"  name="isshare" type="radio" value="0" checked>No
                        </div><br>
                        <div id="divshwRange" class="feildwrap">
                            <span>Share up to number of Department(s)</span>
                            <input id="shwRange" name='shwrange' type="number" min="1" max="5" onchange="shwShareComplaint(this)" onkeyup="if (parseInt(this.value) > 5)
                                        return false;
                                    shwShareComplaint(this)">
                        </div><br><br>
                        <div id="divsharecomplain" class="feildwrap" style="margin-left: -60px;">
                            <div id='departs'>
                                <label>Departments</label>
                            </div><br>
                            <div id='roles'>
                                <label>Roles</label>
                            </div><br>
                            <div id='names'>
                                <label>Names</label>
                            </div>
                        </div><br>
                        <div style="float: right;margin-right: 50px">
                            <input type="submit" class="btn" value="Share" style="width: 200px">
                        </div>
                    </fieldset>
                </form>
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
        $("#shareYes").click(function() {
            $('#divshwRange').show();
        });
        $("#shareNo").click(function() {
            $('#divsharecomplain').hide();
            $('#divshwRange').hide();
        });
        $('#CustomerQueryResult').hide();
        $('.chosen-select').chosen();
    });
    function shwShareComplaint(obj) {

        $('#divsharecomplain').show();
        $('#departs').html('');
        $('#roles').html('');
        $('#names').html('');
        var upTo = $(obj).val();
        var items = "<label>Departments</label>";
        $.ajax({
            url: "<?= base_url() ?>index.php/Complaint/servicegetdepartments",
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
                    $('#departs').append(items);
                } catch (e) {

                }
            },
            error: function(data) {
            }
        });
        var roles = "<label>Roles</label>";
        $.ajax({
            url: "<?= base_url() ?>index.php/Complaint/serviceapprole",
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
                    $('#roles').append(roles);
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
            $('#names').append(names);
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

    function getmodecategory(obj) {

        $("#compmodectgry").empty();
        var getcompmode = $(obj).val();
        var getcompname = obj.options[obj.selectedIndex].text;
        console.log(getcompname);
        if (getcompmode !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/Complaint/servicegetcompmodecategory",
                type: "POST",
                data: {compmode: getcompmode},
                dataType: "json",
                success: function(data) {
                    console.log('data');
                    console.log(data);
                    if (data.length > 0) {
                        $("#compmodectgry").append($("<option >Select Category</option>"));
                        $.each(data, function(index, name) {
                            $("#compmodectgry").append($("<option id=''></option>").val(name['idcr_complaintmodecategories']).html(name['ModeCategory']));
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
                url: "<?= base_url() ?>index.php/Complaint/servicegetuserinfo",
                type: "POST", data: {department: selectedepart,
                    role: selectedrole},
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
                        $("#selectedname" + value_).append($("<option id=''></option>").html('None'));
                    }
                },
                error: function() {
                    console.log('error');
                }
            });
        }
    }

    function validationform() {

        var shwRoute = $('#idcrroute').val();
        var shwRelatedto = $('#idcrcomplainrelation').val();
        var shwSkills = $('#idcruserskills').val();
        var shwMode = $('#idcrcomplainmode').val();
        var shwCategory = $('#compmodectgry').val();
        var nameOne = $('#selectedname1').val();
        var nameTwo = $('#selectedname2').val();
        var nameThree = $('#selectedname3').val();
        var nameFour = $('#selectedname4').val();
        var nameFive = $('#selectedname5').val();
        if (shwRoute === "Select Route" && shwMode === "Select Mode" && shwRelatedto === "Select Releated to" && shwSkills === "Select Skills" && shwCategory === "Select Category" && nameOne === "Select Names" && nameTwo === "Select Names" && nameThree === "Select Names" && nameFour === "Select Names" && nameFive === "Select Names") {
            $(".error-route").show();
            $(".error-mode").show();
            $(".error-category").show();
            $(".error-relatedto").show();
            $(".error-skills").show();
            $("#errorname1").show();
            $("#errorname2").show();
            $("#errorname3").show();
            $("#errorname4").show();
            $("#errorname5").show();
            return false;
        }
        else {
            if (shwRoute === "Select Route" || shwMode === "Select Mode" || shwRelatedto === "Select Releated to" || shwSkills === "Select Skills" || shwCategory === "Select Category" || nameOne === "Select Names" || nameTwo === "Select Names" || nameThree === "Select Names" || nameFour === "Select Names" || nameFive === "Select Names") {

                if (shwRoute === "Select Route") {
                    $(".error-route").show();
                } else {
                    $(".error-route").hide();
                }

                if (shwMode === "Select Mode") {
                    $(".error-mode").show();
                } else {
                    $(".error-mode").hide();
                }

                if (shwRelatedto === "Select Related to") {
                    $(".error-relatedto").show();
                } else {
                    $(".error-relatedto").hide();
                }

                if (shwSkills === "Select Skills") {
                    $(".error-skills").show();
                } else {
                    $(".error-skills").hide();
                }

                if (shwCategory === "Select Category") {
                    $(".error-category").show();
                } else {
                    $(".error-category").hide();
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

    $('#searchnow').focusout(function() {

        var searchby = $("#searchby option:selected").text();
        var searchnow = $('#searchnow').val();
        var mileageVal = 0;
        var deliveryDateVal = 0;
        if (searchnow != "") {
            $.ajax({
                url: "<?= base_url() ?>index.php/Complaint/serviceexistingcustomer",
                type: "POST",
                data: {searchby: searchby, searchnow: searchnow},
                dataType: "json",
                success: function(data) {
                    if (data['serviceCustomer'].length > 0) {
                        $('#shwronumber').html('');
                        $('#shwdeliverdate').html('');
                        $('#shwvariantmileage').html('');
                        for (var i = 0; i < data['serviceCustomer'].length; i++) {
                            mileageVal = data['serviceCustomer'][i]['Mileage'];
                            deliveryDateVal = data['serviceCustomer'][i]['DeliveryDate'];
                            if (mileageVal === '') {
                                mileageVal = 'NULL';
                            }
                            if (deliveryDateVal === '') {
                                deliveryDateVal = '0000-00-00 00:00:00';
                            }
                            $('#shwronumber').append($("<option selected>View All ROs</option>").val(data['serviceCustomer'][i]['RONumber']).html(data['serviceCustomer'][i]['RONumber']));
                            $('#shwdeliverdate').append($("<option selected>View Delivery Dates</option>").val(data['serviceCustomer'][i]['DeliveryDate']).html(data['serviceCustomer'][i]['DeliveryDate']));
                            $('#shwvariantmileage').append($("<option selected>View Mileages</option>").val(mileageVal).html(mileageVal));
                            $('#shwvariantworkdone').text(data['serviceCustomer'][i]['WorkPerformed'] + ', ');
                            $('.chosen-select').trigger('chosen:updated');
                        }

                        $('#CustomerQueryResult').html('Customer is already Registered and Customer is of Service Department');
                        $('#CustomerQueryResult').show();
                        $('#shwvehicle').html(' ');
                        $('#shwcustomername').val(data['serviceCustomer'][0]['CustomerName']);
                        $('#showphonenum').val(data['serviceCustomer'][0]['PhoneOne']);
                        $('#shwmobilnum').val(data['serviceCustomer'][0]['Cellphone']);
                        $('#shwaddress').val(data['serviceCustomer'][0]['AddressDetails']);
                        $('#shwvehicle').append($("<option>Select Variant</option>").val(data['serviceCustomer'][0]['idAllVehicles']).html(data['serviceCustomer'][0]['Variant']));
                        $('#shwvehiclechassisnum').val(data['serviceCustomer'][0]['ChassisNumber']);
                        $('#shwvehicleenginenum').val(data['serviceCustomer'][0]['EngineNumber']);
                        $('#shwvehicleregnum').val(data['serviceCustomer'][0]['RegistrationNumber']);
                        $('#shwvehiclemilage').val(data['serviceCustomer'][0]['Mileage']);
                        $('#ModelYear').val(data['serviceCustomer'][0]['Year']);
                    } else if (data['crcustomer'].length > 0) {
                        $('#shwronumber').html('');
                        $('#shwdeliverdate').html('');
                        $('#shwvariantmileage').html('');
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
                        $('#shwvehiledatepur').val(data['crcustomer'][0]['DateOfPurchase']);

                        $('#shwronumber').append($("<option selected>View All ROs</option>").val('View All ROs').html('View All ROs'));
                        $('#shwdeliverdate').append($("<option selected>View Delivery Dates</option>").val('View Delivery Dates').html('View Delivery Dates'));
                        $('#shwvariantmileage').append($("<option selected>View Mileages</option>").val('View Mileages').html('View Mileages'));
                        $('.chosen-select').trigger('chosen:updated');

                    } else if (data['customer'].length > 0) {
                        $('#shwronumber').html('');
                        $('#shwdeliverdate').html('');
                        $('#shwvariantmileage').html('');
                        $('#CustomerQueryResult').html('Customer is Already Registered');
                        $('#CustomerQueryResult').show();
                        $('#shwvehicle').html(' ');
                        $('#shwcustomername').val(data['customer'][0]['Name']);
                        $('#showphonenum').val(data['customer'][0]['PhoneNumber']);
                        $('#shwmobilnum').val(data['customer'][0]['MobileNumber']);
                        $('#shwemail').val(data['customer'][0]['Email']);
                        $('#shwaddress').val(data['customer'][0]['Address']);
                        $('#shwvehicle').append($("<option>Select Variant</option>").val(data['customer'][0]['VariantId']).html(data['customer'][0]['VehicleName']));
                        $('#shwvehiclechassisnum').val(data['customer'][0]['ChassisNumber']);
                        $('#shwvehicleenginenum').val(data['customer'][0]['EngineNumber']);

                        $('#shwronumber').append($("<option selected>View All ROs</option>").val('View All ROs').html('View All ROs'));
                        $('#shwdeliverdate').append($("<option selected>View Delivery Dates</option>").val('View Delivery Dates').html('View Delivery Dates'));
                        $('#shwvariantmileage').append($("<option selected>View Mileages</option>").val('View Mileages').html('View Mileages'));
                        $('.chosen-select').trigger('chosen:updated');

                    } else {
                        $('#shwronumber').html('');
                        $('#shwdeliverdate').html('');
                        $('#shwvariantmileage').html('');
                        $('#CustomerQueryResult').html('Customer is Not Registered');
                        $('#CustomerQueryResult').show();
                    }

                },
                error: function() {
                    console.log('error');
                }
            });
        } else {
            location.reload();
        }
    });

</script>
