
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager') {
            include 'include/cr_inquiryleftmenu.php';
        } else {
            redirect(base_url() . "index.php/crpanel/index");
        }
        ?>
        <div class="right-pnel">
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
                        <legend>Non FCR Inquiries </legend>
                        <div class="btn-block-wrap dg" id="shwinqfcr">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%">SNo.</th>
                                        <th width="0%">Inquiry No.</th>
                                        <th width="30%">Reg.Date</th>
                                        <th width="30%">Attender</th>
                                        <th width="30%">Customer</th>
                                        <th width="30%">Contact</th>
                                        <th width="30%">VOC</th>
                                        <th width="30%">Route</th>
                                        <th width="30%">RelatedTo</th>
                                        <th width="30%">Variant</th>
                                        <th width="30%">Chassis No.</th>
                                        <th width="30%">Detail</th>
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
                                    $allnonfcrinquiries = json_decode($allnonfcrinquiries);
                                    foreach ($allnonfcrinquiries as $key) {
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
                                            <td name="complaints" class="tbl-name"><?= $key->ComplaintRelatedTo ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleName ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key->VehicleChassisNumber ?></td>
                                            <td><a href="#nonfcrform" onclick="takevalues(<?php echo $key->ComplaintPadNumber ?>)">Edit</a></td>
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
            <div id="divnonfcrform" style="display: none;">
                <form id="nonfcrform" name="nonfcrform" method="post" class="form validate-form animated fadeIn" action="<?= base_url() ?>index.php/Inquiryfcr/registernonfcrform">    
                    <fieldset>
                        <legend onclick="shwcomplaintregistration_()">Non FCR Inquiries</legend>
                        <div id="divnonfcrinquiryreg" class="feildwrap">
                            <div>
                                <label>Receiver</label>
                                <input id="iduserprofile" type="text" name="iduserprofile" value="<?= $data['username'] ?>" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Inquiry Number</label>
                                <input id="padnumber" required type="number" value="" name="padnumber" class=""  data-validation="" readonly>
                            </div>
                            <div>
                                <label>Inquiry Route</label>
                                <input id="idcrroute" type="text" name="idcrroute" class=""  data-validation="" value='' readonly>
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
                                <label>Feedback</label>
                                <textarea id="feedback" name="feedback" style="margin: 0px; width: 724px; height: 100px;" placeholder="Write Feedback"></textarea>
                            </div>
                            <div>
                                <label>Inquiry Registered Date</label>
                                <input id="regdate" class=""  name="regdate" type="text" readonly>
                            </div>
                            <div>
                                <label>Non-FCR Date</label>
                                <input id="nonfcrdate" type="datetime-local" name="nonfcrdate" class="" data-validation="required">
                            </div><br><br>
                            <div>
                                <label>Call Done It Self</label>
                                <input id="calldone" type="checkbox" name="calldone" class=""  data-validation="" value= 1>
                            </div>
                            <div>
                                <label>&nbsp;</label>
                                <label>Call Made By Person Involved</label>
                                <input id="callmadeby" type="checkbox" name="callmadeby" class=""  data-validation="" value= 1>
                            </div><br><br>
                            <div>
                                <label>&nbsp;</label>
                                <input id="btnsave" type="submit" class="btn" value="Save">
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
        $(".closingdatetime").toggle();
    }

    function takevalues(padnum) {

        $('#searchform').hide();
        $('#divtblallcomplaints').hide();
        $('#divnonfcrform').show();

        $.ajax({
            url: "<?= base_url() ?>index.php/Inquiryfcr/servicefilterednonfcrinquiry",
            type: "POST",
            data: {padnumber: padnum},
            dataType: "json",
            success: function(data) {
                if (data.length > 0) {

                    //Inquiry Info
                    $('#iduserprofile').val(data[0]['AttenderName']);
                    $('#padnumber').val(data[0]['ComplaintPadNumber']);
                    $('#idcrroute').val(data[0]['ComplaintRecieveFrom']);
                    $('#idcomplaintrelto').val(data[0]['ComplaintRelatedTo']);
                    $('#voiceofcustomer').val(data[0]['VoiceOfCustomer']);
                    $('#regdate').val(data[0]['ComplaintRegDate']);
                    $('#respondto').val(data[0]['RespondTo']);
                    $('#starttime').val(data[0]['CallStartTime']);
                    $('#endtime').val(data[0]['CallEndTime']);
                    $('#calldurationtime').val(data[0]['CallDurationTime']);
                }
                else {

                    console.log('Data is Empty');
                }
            },
            error: function(data) {

            }
        });
    }

//    $("#nonfcrform").submit(function() {
//        var formData = $('#nonfcrform').serialize();
//
//        $.ajax({
//            url: "<?= base_url() ?>index.php/Inquiryfcr/registernonfcrform",
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
            url: "<?= base_url() ?>index.php/Inquiryfcr/servicefilterednonfcrinquiry",
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
                                                            <td class='resId' name='resId'>" + val.ComplaintRelatedTo + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.VehicleName + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.VehicleChassisNumber + "</td>\n\
                                                            <td><a style='cursor: pointer;'href='#nonfcrform' onClick=takevalues('" + val.ComplaintPadNumber + "')>Edit</a></td></tr>";

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
            }, error: function() {
                console.log('error');
            }
        });
    });
</script>
