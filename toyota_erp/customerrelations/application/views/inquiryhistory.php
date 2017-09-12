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
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <div id="closedfieldset" class="feildwrap">
                    <?php echo $updateMessage ?>
                    <fieldset>
                        <legend>Search Closed Inquiries</legend>
                        <div>
                            <label>Search</label>
                            <input type="text" name="padnumber" id="searchnow"
                                   placeholder="By Inquiry Number">    
                        </div>
                    </fieldset>
                </div><br>
                <div class="feildwrap" id="divtblallcomplaints">
                    <fieldset>
                        <legend>Inquiries </legend>
                        <div class="btn-block-wrap dg">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="02%">SNo.</th>
                                        <th width="02%">Inquiry No.</th>
                                        <th width="06%">Reg.Date</th>
                                        <th width="10%">Attender</th>
                                        <th width="10%">Customer</th>
                                        <th width="08%">Contact</th>
                                        <th width="20%">VOC</th>
                                        <th width="02%">Route</th>
                                        <th width="02%">Type</th>
                                        <th width="03%">RelatedTo</th>
                                        <th width="10%">Variant</th>
                                        <th width="05%">Chassis No.</th>
                                        <th width="05">Detail</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="16">
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
                                    $allclosedinquiries = json_decode($allclosedinquiries);
                                    foreach ($allclosedinquiries as $key) {
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
                                            <td name="complaints" class="tbl-name"><?= $key->FCR ?></td>
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
            <div id="divinquiryupdateform" style="display: none">
                <form  id="inquiryupdateform" action="<?= base_url() ?>index.php/Inquiryhistory/updateinquiry" onsubmit="return validationform();" method="post" class="form validate-form animated fadeIn" >
                    <fieldset>
                        <legend onclick="shwcomplaintregistration_()">Inquiry Registration</legend>
                        <div id="divinquiryupdateform" class="feildwrap">
                            <div>
                                <label> Receiver</label>
                                <input id="iduserprofile" type="text" name="iduserprofile" value="<?= $data['username'] ?>" class=""  data-validation="" readonly>
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
                            <div class="">
                                <label>Route</label>
                                <select id="uidroute" onchange="setrouteval(this)" name = "idcrroute" style="width: 173px;">
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
                                <span class="error-uiroute cb-error help-block" style="margin-left: 375px;margin-top: -35px">Select Option!</span>
                            </div>
                            <div class=''>
                                <label>Inquiry Related to</label>
                                <select  id="uidrelatedto" onchange="setcomprelval(this)" name = "idcrcomplainrelation" style="width: 173px;">
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
                                <span class="error-uirelatedto cb-error help-block" style="margin-left: 375px;margin-top: -35px">Select Option!</span>
                            </div>
                            <div style="margin-left: 78px;">
                                <label>User Skills</label>
                                <select id="uidskills" onchange="setuserskills(this)" name = "idcruserskills" style="width: 173px;">
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
                                <span class="error-uiskills cb-error help-block" style="margin-left: 375px;margin-top: -35px">Select Option!</span>
                            </div><br>
                            <div>
                                <label>Registered Date</label>
                                <input id="regdate" class=""  name="regdate" type="text" readonly>
                            </div>
                            <div>
                                <label>FCR</label>
                                <input id="isfcr" type="text" name="isfcr" readonly style="width: 173px;">
                            </div><br><br>
                            <div>
                                <label>Voice of Customer</label>
                                <textarea id="voiceofcustomer" name="voiceofcustomer" style="margin: 0px; width: 724px; height: 100px;" ></textarea>
                            </div><br>
                            <div>
                                <label>Respond To</label>
                                <textarea id="respondto" name="respondto" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                            </div><br><br> 
                            <div id="CallDurationDiv" class="feildwrap">                               
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
                            </div><br><br>
                            <div>
                                <label>Reply Action</label>
                                <textarea id="replyaction" name="replyaction" style="margin: 0px; width: 724px; height: 100px;" ></textarea>
                            </div>
                            <div>
                                <label>Kaizen Taken</label>
                                <textarea id="kaizentaken" name="kaizentaken" style="margin: 0px; width: 724px; height: 100px;" ></textarea>
                            </div>
                              <div>
                                <label>FeedBack</label>
                                <textarea id="FeedBack" name="FeedBack"  style="margin: 0px; width: 724px; height: 100px;" ></textarea>
                            </div>
                            <div>
                                <label>Remarks</label>
                                <textarea id="Remarks" name="Remarks" style="margin: 0px; width: 724px; height: 100px;" ></textarea>
                            </div><br><br>
                            <div id="divupdatebutton" class="feildwrap">
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

    function shwcomplaintupdateform() {
        $('#divupdatebutton').toggle();
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
        $('#idcompcrmode').val(getcdetail);
    }
    function setrouteval(obj) {

        var getcdetail = obj.options[obj.selectedIndex].text;
        $('#idcrroute').val(getcdetail);
    }
    function setcomprelval(obj) {

        var getcdetail = obj.options[obj.selectedIndex].text;
        $('#idcomplaintrelto').val(getcdetail);
    }

    function updateform(padnum) {
        $('#closedfieldset').hide();
        $('#divtblallcomplaints').hide();
        $('#divinquiryupdateform').show();

        $.ajax({
            url: "<?= base_url() ?>index.php/Inquiryhistory/servicefilteredclosedinquiries",
            type: "POST",
            data: {padnumber: padnum},
            dataType: "json",
            success: function(data) {
                if (data.length > 0) {

                    //Inquiry Info
                    $('#iduserprofile').val(data[0]['AttenderName']);
                    $('#padnumber').val(data[0]['ComplaintPadNumber']);
                    $('#idcrmode').val(data[0]['Mode']);
                    $('#idcrroute').val(data[0]['ComplaintRecieveFrom']);
                    $('#idcomplaintrelto').val(data[0]['ComplaintRelatedTo']);
                    $('#voiceofcustomer').val(data[0]['VoiceOfCustomer']);
                    $('#regdate').val(data[0]['ComplaintRegDate']);
                    $('#replyaction').val(data[0]['ActionTaken']);
                    $('#kaizentaken').val(data[0]['TakeKaizen']);
                    $('#userskills').val(data[0]['ComplaintUserSkills']);
                    $('#isfcr').val(data[0]['FCR']);
                    $('#FeedBack').val(data[0]['FeedBack']);
                    
                    $('#respondto').val(data[0]['RespondTo']);
                    $('#starttime').val(data[0]['CallStartTime']);
                    $('#endtime').val(data[0]['CallEndTime']);
                    $('#calldurationtime').val(data[0]['CallDurationTime']);

                    $('[name=idcrroute] option').filter(function() {
                        return ($(this).text() === data[0]['ComplaintRecieveFrom']);
                    }).prop('selected', true);

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

    $('#searchnow').keyup(function() {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Inquiryhistory/servicefilteredclosedinquiries",
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
                                                                                    <td class='resId' name='resId'>" + val.FCR + "</td>\n\
                                                                                    <td class='resId' name='resId'>" + val.ComplaintRelatedTo + "</td>\n\
                                                                                    <td class='resId' name='resId'>" + val.VehicleName + "</td>\n\
                                                                                    <td class='resId' name='resId'>" + val.VehicleChassisNumber + "</td>\n\
                                                                                    <td><a style='cursor: pointer;'href='#divupdatecomplaint' onClick=updateform('" + val.ComplaintPadNumber + "')>Edit</a></td></tr>";

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

    function validationform() {
        var shwRoute = $('#uidroute').val();
        var shwRelatedto = $('#uidrelatedto').val();
        var shwSkills = $('#uidskills').val();

        if (shwRoute === "Select Route" && shwRelatedto === "Select Releated to" && shwSkills === "Select Skills") {
            $(".error-uiroute").show();
            $(".error-uirelatedto").show();
            $(".error-uiskills").show();
            return false;
        } else {
            if (shwRoute === "Select Route" || shwRelatedto === "Select Releated to" || shwSkills === "Select Skills") {

                if (shwRoute === "Select Route") {
                    $(".error-uiroute").show();
                } else {
                    $(".error-uiroute").hide();
                }

                if (shwRelatedto === "Select Related to") {
                    $(".error-uirelatedto").show();
                } else {
                    $(".error-uirelatedto").hide();
                }

                if (shwSkills === "Select Skills") {
                    $(".error-uiskills").show();
                } else {
                    $(".error-uiskills").hide();
                }
                return false;
            }
            return true;
        }
    }

</script>