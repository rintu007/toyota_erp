<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "CRAdmin" || $data['Role'] == "AdminCR") {
            include 'include/psfu_leftmenu.php';
        } else {
            include 'include/admin_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form id="psfuform" action="<?= base_url() ?>index.php/psfu/Update"  method="post" onSubmit="return validationform()" 
                  class="form animated fadeIn">
                <fieldset>
                    <legend>Post Service Follow-Up</legend>    
                    <div id="PsfuDiv" class="feildwrap">
                        <div style="display: none;">
                            <input id="idRO" name="idRO" value=<?php echo $idRO; ?>>                            
                        </div>
                        <div>                        
                            <fieldset style="
                                      margin-left:100px;
                                      margin-top: 6px;
                                      width: 0px;
                                      ">
                                <legend>PSFU Actual</legend>
                                <div>
                                    <label>Date</label>
                                    <input id="PSFUActualDate" type="text" name="PSFUActualDate" class="date" placeholder="Actual Date"  
                                           data-validation = "required">
                                </div>
                                <div>
                                    <label>Time</label>
                                    <input Class="Timepicker" id="PSFUActualTime" type="text" name="PSFUActualTime" data-time-format="H:i:s" 
                                           placeholder="Actual Time" data-validation = "required">
                                </div>
                            </fieldset>
                            <fieldset style="margin-left:100px;margin-top: 6px;width: 0px;">
                                <legend>Contact Info</legend>
                                <div class="feildwrap">
                                    <?php
                                    foreach ($contactList as $key) {
                                        ?>
                                        <div style="margin-left: 50px"><input id="ContactInfo" name="ContactInfo[]" type="checkbox" 
                                                                              value="<?= $key['idContactInfo'] ?>"><?= $key['Name'] ?></div>
                                        <?php }
                                        ?>
                                </div>
                            </fieldset>
                            <?php if ($isFIR[0] === "1") { echo 'ya'; ?>
                                <fieldset style="margin-left:100px;margin-top: 6px;width: 0px;height: auto">
                                    <legend>FIR Questionnaire</legend>
                                    <div id="Questions" class="feildwrap">
                                        <?php
                                        $qCounter = 0;
                                        foreach ($Questions as $key) {
                                            $qCounter = $qCounter + 1;
                                            if ($key['Question'] == 'Was your vehicle fixed the first repair ?') {
                                                ?>
                                                <div class='myq' tag='Ques<?php echo $qCounter ?>' style='margin-left: 25px;margin-top:25px;'>
                                                    <input tag='QNo' name='QNo' value='<?= $key['QuestionNo'] ?>' style='width: 25px;height: 25px;float: 
                                                           left;' readonly>&nbsp;&nbsp;
                                                    <input tag='Question' id='Question' name='Question' value='<?= $key['Question'] ?>' placeholder='Type 
                                                           Question...' style='width: 500px;height: 25px;float: right;' readonly><br>
                                                    <input tag='Answer' id='Yes<?php echo $qCounter ?>' type='radio' name='Answer<?php echo $qCounter ?>' 
                                                           value='1' style='margin-top: 15px' onclick='shwNextQues(this)'>Yes<br>
                                                    <input tag='Answer' id='No<?php echo $qCounter ?>' type='radio' name='Answer<?php echo $qCounter ?>' 
                                                           value='0' onclick='shwNextQues(this)'>No
                                                </div>
                                            <?php } else { ?>
                                                <div class='myq' tag="Ques<?php echo $qCounter ?>" style="margin-left: 25px;margin-top:25px;display: none">
                                                    <input tag='QNo' name="QNo" value='<?= $key['QuestionNo'] ?>' style='width: 25px;height: 25px;float: 
                                                           left;' readonly>&nbsp;&nbsp;
                                                    <input tag='Question' id='Question' name='Question' value='<?= $key['Question'] ?>' placeholder='Type 
                                                           Question...' style='width: 500px;height: 25px;float: right;' readonly><br>
                                                    <input tag='Answer' id='Yes<?php echo $qCounter ?>' type='radio' name='Answer<?php echo $qCounter ?>' 
                                                           value="1" style="margin-top: 15px" onclick='shwNextQues(this)'>Yes<br>
                                                    <input tag='Answer' id='No<?php echo $qCounter ?>' type='radio' name='Answer<?php echo $qCounter ?>' 
                                                           value='0' onclick='shwNextQues(this)'>No
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </fieldset><?php  }
                                    ?>                                                                
                            <fieldset style="margin-left:100px;margin-top: 6px;width: 0px;">
                                <div>
                                    <legend>PSFU Result</legend>
                                    <div><br><br>
                                        <?php
                                        foreach ($psufList as $key) {
                                            ?>
                                            <div style="margin-left: 100px"><input id="PsfuResult" name="PsfuResult" type="radio" value="<?= $key['idPSFUResult'] ?>" checked><?= $key['Name'] ?></div>
                                        <?php }
                                        ?>
                                    </div><br><br>
                                    <div style="margin-left: 03px">
                                        <label>Staff Name</label>
                                        <select id="StaffName" name="StaffName">
                                            <option>Select Staff</option>
                                            <?php
                                            foreach ($staffList as $key) {
                                                $idStaff = $staffList['idStaff'];
                                                ?>
                                                <option value="<?= $key['idStaff'] ?>" ><?= $key['Name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="error-staff cb-error help-block">Option must be selected!</span>
                                    </div>  
                                </div>                               
                            </fieldset>
                            <fieldset style="margin-left:100px;margin-top: 6px;width: 0px;">
                                <legend>Remarks</legend>
                                <div class="feildwrap">
                                    <label style="margin-left: -87px">PSFU Remarks</label>
                                    <div style="">
                                        <textarea id="PSFURemarks" name="PSFURemarks" placeholder="Enter PSFU Remarks" style="margin: 0px; 
                                                  width: 500px; height: 200px;"></textarea>
                                    </div>                                   
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="btn-block-wrap">
                        <label>&nbsp;</label><br>
                        <input type="submit" class="btn" value="OK" style="margin-left: 400px;width: 180px;">
                    </div>
                </fieldset> 
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
    });

    function DoToggle(id) {
        $(id).toggle();
    }

    function shwNextQues(obj) {
        var ans = $(obj).val();
        if (ans == '1') {
            $(obj).closest('div').next().show();

        }
    }

    function setData() {
        var data = [];
        var divs = $('#Questions').find('div:visible');
        for (var x = 0; x < divs.length; x++) {
            var d = {};
            var tagss = $(divs[x]).find("input[tag]");
            for (var y = 0; y < tagss.length; y++) {
                var i = tagss[y];
                if ($(i).attr('tag') === 'Answer') {
                    if ($(i).is(':checked')) {
                        if ($(i).val() == '0') {
                            d[$(i).attr("tag")] = 'No';
                        } else {
                            d[$(i).attr("tag")] = 'Yes';
                        }
                    } else {

                    }
                } else {
                    d[$(i).attr("tag")] = $(i).val();
                }
            }
            data.push(d);
        }
        $("#Questions").append("<input type='text' name='FIRQ' value='" + JSON.stringify(data) + "'>");
    }

    function validationform() {
        setData();
        var staffSlct = $('#StaffName').val();
        if (staffSlct === "Select Staff") {
            $(".error-staff").show();
            return false;
        } else {
            $(".error-staff").hide();
        }

    }

</script>

