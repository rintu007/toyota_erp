<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin') {
            include 'include/cr_leftmenu.php';
        } else {
            if ($data['Role'] == 'Manager') {
                include 'include/cr_leftsubmenu.php';
            } else {
                redirect(base_url() . "index.php/crpanel/index");
            }
        }
        ?>
        <div class="right-pnel">
            <form id="addcomplaintrestime" name="addcomplaintrestime" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/Complaintresponsetime/addcomplaintresponsetime" class="form validate-form animated fadeIn">
                <div class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend>Add Resolution Time</legend>   
                        <div class="feildwrap">
                            <label>Select Mode</label>
                            <select id='modecr' name="idcrmode" data-validation="" onchange="checkmodeof()">
                                <option>Select Mode</option>
                                <?php
                                $selectmode = json_decode($selectmode);
                                foreach ($selectmode as $key) {
                                    ?>
                                    <option  value=<?php echo $key->idcr_mode ?>><?php
                                        echo $key->Name;
                                        ?></option>
                                <?php } ?>
                            </select>
                            <span class="error-bothmodes cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                        </div>
                        <div class="feildwrap">
                            <div id='complainttype'>
                                <label>Type</label>
                                <select id="inqtype" name = "getcompstatus" data-validation="">
                                    <option name="compnormal" value = 0>Normal</option>
                                    <option name="compserious" value = 1>Serious</option>
                                </select>
                                <span class="error-days cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                            </div>
                            <div id='inquirytype'>
                                <label>Type</label>
                                <select id="comptype" name = "getinquirystatus" data-validation="">
                                    <option name="inqfcr" value = 1>FCR</option>
                                    <option name="inqnonfcr" value = 0>Non-FCR</option>
                                </select>
                                <span class="error-hours cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                            </div>                           
                        </div><br><br>
                        <div class="feildwrap"> 
                            <label>Resolution Time in Days</label>
                            <input type="number" min="1" name="targettimedays" placeholder="In Days" data-validation="required">
                        </div>
                        <div class="feildwrap"> 
                            <label>Resolution Time in Hours</label>
                            <input type="number" min="24" name="targettimehours" placeholder="In Hours" data-validation="required">
                        </div><br>
                        <div class="feildwrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add">
                        </div>
                    </fieldset>
                </div>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Resoultion Time List</legend>
                    <div class="feildwrap">
                        <?php echo $updateMessage ?>                    
                        <br><div class="btn-block-wrap dg">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="5%">S No.</th>
                                        <th width="25%">Mode</th>
                                        <th width="25%">Type</th>
                                        <th width="15%">Time (Days)</th>
                                        <th width="15%">Time (Hours)</th>
                                        <th width="10%">Details</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                </tfoot>
                                <tbody id="finalResult">
                                    <?php
                                    $count = 1;
                                    $complaintresponsetime = json_decode($complaintresponsetime);
                                    foreach ($complaintresponsetime as $key) {
                                        ?>
                                        <tr id="carUsers">
                                            <td class="resId" name="resId"><?= $count++ ?></td>
                                            <td class="tbl-name"><?= $key->Mode ?></td>
                                            <?php if ($key->Mode == 'Inquiry') { ?>
                                                <td class="tbl-name"><?= $key->InquiryType ?></td>
                                            <?php } else { ?>
                                                <td class="tbl-name"><?= $key->ComplaintType ?></td>
                                            <?php } ?>

                                            <td class="tbl-name"><?= $key->TimeinDays ?></td>
                                            <td class="tbl-name"><?= $key->TimeinHours ?></td>
                                            <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?php echo $key->id ?>', '<?php echo $key->Mode ?>', '<?php echo $key->TimeinDays ?>', '<?php echo $key->TimeinHours ?>')">Edit</a>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/Complaintresponsetime/updatecomplaintresponsetime" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div class="feildwrap">
                        <div style="display: none;">
                            <label>Mode ID</label>
                            <input type="text" id="idcrmode" name="uidcrmode">
                        </div>                            
                        <div id="">
                            <label>Mode</label>
                            <input type="text" id="umodecr" name="offmode" placeholder="Mode" data-validation="" readonly> 
                        </div>
                        <div id='ucomplainttype'>
                            <label>Type</label>
                            <select name = "ugetcompstatus" data-validation="">
                                <option name="compnormal" value = 0>Normal</option>
                                <option name="compserious" value = 1>Serious</option>
                            </select>
                            <span class="error-udays cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div>
                        <div id='uinquirytype'>
                            <label>Type</label>
                            <select name = "ugetinquirystatus" data-validation="">
                                <option name="inqfcr" value = 1>FCR</option>
                                <option name="inqnonfcr" value = 0>Non-FCR</option>
                            </select>
                            <span class="error-uhours cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div>  
                        <div class="feildwrap"> 
                            <label>Resolution Time in Days</label>
                            <input id="utargettimedays" name="utargettimedays" type="number" min="1" placeholder="In Days" data-validation="required">
                        </div>
                        <div class="feildwrap"> 
                            <label>Resolution Time in Hours</label>
                            <input id="utargettimehours" name="utargettimehours" type="number" min="24" placeholder="In Hours" data-validation="required">
                        </div><br><br>
                        <div class="feildwrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#inquirytype").hide();
    $("#complainttype").hide();
    function checkmodeof() {

        var checktext = $("#modecr :selected").text();
        console.log(checktext);
        if (checktext === "Inquiry") {

            $("#complainttype").hide();
            $("#inquirytype").show();
        }
        else {
            $("#complainttype").show();
            $("#inquirytype").hide();
        }
    }
    function checkmodeofUpdate() {

        var checktext = $("#umodecr").val();
        console.log(checktext);
        if (checktext === "Inquiry") {
            $("#ucomplainttype").hide();
            $("#uinquirytype").show();
        }
        else {
            $("#ucomplainttype").show();
            $("#uinquirytype").hide();
        }
    }

    function UpdatePopup(div_id, id, Name, TimeDays, TimeHours) {

        if (Name === "Complaint") {
            $("#uinquirytype").hide();
            $("#ucomplainttype").show();
        } else {
            $("#ucomplainttype").hide();
            $("#uinquirytype").show();
        }
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idcrmode").val(id);
            $(this).find("#umodecr").val(Name);
            $(this).find("#utargettimedays").val(TimeDays);
            $(this).find("#utargettimehours").val(TimeHours);
        });
    }

    function validationform(type) {

        if (type === 'Add') {
            var shwModes = $('#modecr').val();
            if (shwModes === "Select Mode") {
                $(".error-bothmodes").show();
                return false;
            } else {
                $(".error-bothmodes").hide();
                return true;
            }
        }
    }

//    function validationform(type) {
//
//        if (type === 'Add') {
//            var shwModes = $('#modecr').val();
//            var shwInquiryType = $('#inqtype').val();
//            var shwComplaintType = $('#comptype').val();
//            if (shwModes === "Select Mode" && shwInquiryType === "Select Type" && shwComplaintType === "Select Type") {
//                $(".error-bothmodes").show();
//                $(".error-days").show();
//                $(".error-hours").show();
//                return false;
//            } else {
//                if (shwModes === "Select Mode" || shwInquiryType === "Select Type" || shwComplaintType === "Select Type") {
//                    if (shwModes === "Select Mode") {
//                        $(".error-bothmodes").show();
//                    } else {
//                        $(".error-bothmodes").hide();
//                    }
//                    if (shwInquiryType === "Select Type") {
//                        $(".error-days").show();
//                    } else {
//                        $(".error-days").hide();
//                    }
//                    if (shwComplaintType === "Select Type") {
//                        $(".error-hours").show();
//                    } else {
//                        $(".error-hours").hide();
//                    }
//                    return false;
//                }
//                return true;
//            }
//        } else {
//            if (type === 'Update') {
//
//                var shwUInquiryType = $('#inqtype').val();
//                var shwUComplaintType = $('#comptype').val();
//                if (shwUInquiryType === "Select Type" && shwUComplaintType === "Select Type") {
//                    $(".error-days").show();
//                    $(".error-hours").show();
//                    return false;
//                }
//                else {
//                    if (shwUInquiryType === "Select Type" || shwUComplaintType === "Select Type") {
//                        if (shwUInquiryType === "Select Type") {
//                            $(".error-udays").show();
//                        } else {
//                            $(".error-udays").hide();
//                        }
//                        if (shwUComplaintType === "Select Type") {
//                            $(".error-uhours").show();
//                        } else {
//                            $(".error-uhours").hide();
//                        }
//                        return false;
//                    }
//                    return true;
//                }
//            }
//        }
//    }
</script>

