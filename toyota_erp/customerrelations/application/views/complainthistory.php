<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager' || $data['Role'] == 'Executive Complaint') {
            include 'include/cr_complaintleftmenu.php';
        } else {
            redirect(base_url() . "index.php/crpanel/index");
        }
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <div id="closedfieldset" class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>                       
                        <legend>Search Closed Complaints</legend>
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
                        <div class="btn-block-wrap dg" id="shwcomphistory">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="02%">SNo.</th>
                                        <th width="02%">Comp No.</th>
                                        <th width="06%">Reg.Date</th>
                                        <th width="10%">Attender</th>
                                        <th width="10%">Customer</th>
                                        <th width="05%">Contact</th>
                                        <th width="25%">VOC</th>
                                        <th width="05%">Route</th>
                                        <th width="05%">Mode</th>
                                        <th width="05%">RelatedTo</th>
                                        <th width="15%">Variant</th>
                                        <th width="05%">Chassis No.</th>
                                        <th width="05%">Detail</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="18">
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
                                    $allclosedcomplaints = json_decode($allclosedcomplaints);
                                    foreach ($allclosedcomplaints as $key) {
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
                                            <td><a href="#divupdatecomplaint" onclick="updateform(<?php echo $key->ComplaintPadNumber ?>)">Edit</a></td>
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
            <div id="divsubmittedform" style="display: none">
                <form  id="updateform" action="<?= base_url() ?>index.php/Complainthistory/updatecomplaintform" onsubmit="return validationform()" method="post" class="form validate-form animated fadeIn">
                    <fieldset>
                        <legend onclick="shwcomplaintregistration_()">Complaint Registration</legend>
                        <div id="divcomplaintregistration" class="feildwrap">
                            <div>
                                <label>Complaint Receiver</label>
                                <input id="iduserprofile" type="text" name="iduserprofile" value="<?= $data['username']?>" class=""  data-validation="" readonly>
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
                            <div class="feildwrap">
                                <label>Route</label>
                                <select id="sroute" onchange="setrouteval(this)" name = "idcrroute" style="width: 173px;">
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
                                <span class="error-uroute cb-error help-block" style="margin-left: 376px;margin-top: -36px">Select Option!</span>
                            </div>
                            <div>
                                <label>Select Mode</label>
                                <select id="smode" name = "idcrcomplainmode" onchange="getmodecategory(this)" style="width: 250px;">
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
                                <span class="error-umode cb-error help-block" style="margin-left: 325px;margin-top: -35px">Select Option!</span>
                            </div>
                            <div>
                                <label id="lblcompmodectgry">Mode Category</label>
                                <select id="compmodectgry" name = "idcrcompmodectgry" style="width: 173px;">
                                    <option>Select Category</option>  
                                </select>
                                <span class="error-category cb-error help-block" style="width:86px;margin-left: 375px;margin-top: -36px">Select Option!</span>
                            </div>                           
                            <div class="feildwrap">
                                <label>Complaint Related to</label>                                                
                                <select id="selectrelto" onchange="setcomprelval(this)" name = "idcrcomplainrelation" style="width: 250px;">
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
                                <span class="error-urelatedto cb-error help-block" style="margin-left: 451px;margin-top: -35px">Select Option!</span>
                            </div>
                            <div class="feildwrap">
                                <label>User Skills</label>                                               
                                <select id="sskills" onchange="setuserskills(this)" name = "idcruserskills" style="width: 173px;">
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
                                <span class="error-uskills cb-error help-block" style="margin-left: 375px;margin-top: -35px">Select Option!</span>
                            </div><br>
                            <div>
                                <label>Voice of Customer</label>
                                <textarea id="voiceofcustomer" name="voiceofcustomer" style="margin: 0px; width: 724px; height: 100px;" placeholder="Description" data-validation=""></textarea>
                            </div><br>
                            <div>
                                <label>Customer Request</label>
                                <textarea id="customerrequest" name="customerrequest" style="margin: 0px; width: 724px; height: 100px;" placeholder="Description" data-validation=""></textarea>
                            </div><br>
                            <div>
                                <label>Action Taken</label>
                                <textarea id="actiontaken" name="actiontaken" style="margin: 0px; width: 724px; height: 100px;" placeholder="Description" data-validation=""></textarea>
                            </div><br>
                            <div>
                                <label>Kaizen Taken</label>
                                <textarea id="kaizentaken" name="kaizentaken" style="margin: 0px; width: 724px; height: 100px;" placeholder="Description" data-validation=""></textarea>
                            </div><br>
                            <div>
                                <label>Registered Date</label>
                                <input id="regdate" class=""  name="regdate" type="text" data-validation="required" readonly>
                            </div>
                            <div id="divupdatecomplaintform" class="feildwrap">
                                <label>&nbsp;</label>
                                <input type="submit" class="btn" value="Update">
                            </div>
                        </div>                       
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>

    /**
     * Comment
     */

    $('#searchnow').keyup(function() {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Complainthistory/servicefilteredclosedcomplaint",
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
                                                                                    <td><a style='cursor: pointer;'href='#divactiontaken' onClick=updateform('" + val.ComplaintPadNumber + "')>Edit</a></td></tr>";

                            });
                            $('#shwallcomplaints').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("#shwallcomplaints").html("<td></td><td></td><td></td><td></td><td></td><td></td><td><label style='border: 0px;margin-left100px'><b>No Data Found</b<</label></td><td></td><td></td><td></td>v");
                    }
                }
            }, error: function() {
                console.log('error');
            }
        });
    });

    function shwcomplaintupdateform() {
        $('#divupdatecomplaintform').toggle();
    }
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
    function setuserskills(obj) {

        var getcdetail = obj.options[obj.selectedIndex].text;
        $('#userskills').val(getcdetail);
    }
    function setcompmodeval(obj) {

        var getcdetail = obj.options[obj.selectedIndex].text;
        $('#idcrcomplainmodevalue').val(getcdetail);
    }
    function setrouteval(obj) {

        var getcdetail = obj.options[obj.selectedIndex].text;
        $('#idcrroute').val(getcdetail);
    }
    function setcomprelval(obj) {

        var getcdetail = obj.options[obj.selectedIndex].text;
        $('#idcomplaintrelto').val(getcdetail);
    }

    function getmodecategory(obj) {

        $("#compmodectgry").empty();
        var getcompmode = $(obj).val();
        var getcompname = obj.options[obj.selectedIndex].text;
        console.log(getcompname);
        if (getcompmode !== null) {
            $.ajax({
                url: "<?= base_url() ?>index.php/Complainthistory/servicegetcompmodecategory",
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

    function updateform(padnum) {
        $('#closedfieldset').hide();
        $('#divtblallcomplaints').hide();
        $('#divsubmittedform').show();
        $.ajax({
            url: "<?= base_url() ?>index.php/Complainthistory/servicefilteredclosedcomplaint",
            type: "POST",
            data: {padnumber: padnum},
            dataType: "json",
            success: function(data) {
                if (data.length > 0) {

                    //Complaint Info
                    $('#iduserprofile').val(data[0]['AttenderName']);
                    $('#padnumber').val(data[0]['ComplaintPadNumber']);
                    $('#idcrmode').val(data[0]['Mode']);
                    $('#idcrroute').val(data[0]['ComplaintRecieveFrom']);
                    $('#idcrcomplainmodevalue').val(data[0]['ComplaintMode']);
                    $('#idcomplaintrelto').val(data[0]['ComplaintRelatedTo']);
                    $('#voiceofcustomer').val(data[0]['VoiceOfCustomer']);
                    $('#customerrequest').val(data[0]['CustomerRequest']);
                    $('#regdate').val(data[0]['ComplaintRegDate']);
                    $('#actiontaken').val(data[0]['ActionTaken']);
                    $('#kaizentaken').val(data[0]['TakeKaizen']);
                    $('#userskills').val(data[0]['ComplaintUserSkills']);

                    $('[name=idcrroute] option').filter(function() {
                        return ($(this).text() === data[0]['ComplaintRecieveFrom']);
                    }).prop('selected', true);

                    $('[name=idcrcomplainmode] option').filter(function() {
                        return ($(this).text() === data[0]['ComplaintMode']);
                    }).prop('selected', true);

                    $("#compmodectgry").append($("<option id='' Selected></option>").val(data[0]['idComplaintModeCategory']).html(data[0]['ComplaintModeCategory']));

                    $('[name=idcrcomplainrelation] option').filter(function() {
                        return ($(this).text() === data[0]['ComplaintRelatedTo']);
                    }).prop('selected', true);

                    $('[name=idcruserskills] option').filter(function() {
                        return ($(this).text() === data[0]['ComplaintUserSkills']);
                    }).prop('selected', true);

                }
                else {

                    console.log('Data is Empty');
                }
            },
            error: function(data) {

            }
        });
    }

    function validationform() {

        var shwRoute = $('#sroute').val();
        var shwRelatedto = $('#selectrelto').val();
        var shwSkills = $('#sskills').val();
        var shwMode = $('#smode').val();
        var shwCategory = $('#compmodectgry').val();

        if (shwRoute === "Select Route" && shwMode === "Select Mode" && shwCategory === "Select Category" && shwRelatedto === "Select Related to" && shwSkills === "Select Skills") {
            $(".error-uroute").show();
            $(".error-umode").show();
            $(".error-urelatedto").show();
            $(".error-uskills").show();
            $(".error-category").show();
            return false;
        } else {
            if (shwRoute === "Select Route" || shwRelatedto === "Select Related to" || shwMode === "Select Mode" || shwCategory === "Select Category" || shwSkills === "Select Skills") {

                if (shwRoute === "Select Route") {
                    $(".error-uroute").show();
                } else {
                    $(".error-uroute").hide();
                }

                if (shwRelatedto === "Select Related to") {
                    $(".error-urelatedto").show();
                } else {
                    $(".error-urelatedto").hide();
                }

                if (shwMode === "Select Mode") {
                    $(".error-umode").show();
                } else {
                    $(".error-umode").hide();
                }

                if (shwCategory === "Select Category") {
                    $(".error-category").show();
                } else {
                    $(".error-category").show();
                }
                if (shwSkills === "Select Skills") {
                    $(".error-uskills").show();
                } else {
                    $(".error-uskills").hide();
                }
                return false;
            }
            return true;
        }
    }




</script>