<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        } else {
            
        }
        ?>
        <div class="right-pnel">
            <form name="periodicmaintenancedetailform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/periodicmaintenancedetail/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Maintenance Package Detail</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Maintenance Package</label>
                            <select id="selectpm" name="SelectPm">
                                <option>Select Maintenance Package</option>
                                <?php
                                foreach ($pmList as $key) {
                                    $idPm = $pmList['idPeriodicMaintenance'];
                                    ?>
                                    <option value="<?= $key['idPeriodicMaintenance'] ?>" ><?= $key['PeriodName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-period cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br>
                        <div>
                            <label>Job Reference Manual</label>
                            <select id="selectjrm" name="SelectJrm[]" multiple>
                                <option>Select Jobs</option>
                                <?php
                                foreach ($jrmList as $key) {
                                    $idJobRef = $dealersList['idJobRef'];
                                    ?>
                                    <option value="<?= $key['idJobRef'] ?>" ><?= $key['JobTask'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-updatejrm cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br>
                        <div>
                            <label>Rang-1 Amount</label>
                            <input type="text" id="AmountOne" name="AmountOne" placeholder="Range - 1 Amount" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                        </div><br>
                        <div>
                            <label>Rang-2 Amount</label>
                            <input type="text" id="AmountTwo" name="AmountTwo" placeholder="Range - 2  Amount" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                        </div><br>
                        <div>
                            <label>Rang-3 Amount</label>
                            <input type="text" id="AmountThree" name="AmountThree" placeholder="Range - 3  Amount" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                        </div><br><br>
                        <div style="display: none">
                            <label>Amount</label>
                            <input type="text" name="Amount" placeholder="Enter Amount" data-validation="">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 400px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <?php echo $updateMessage ?>
                <?php echo $deleteMessage ?><br>
                <fieldset>
                    <legend>Maintenance Package Detail List</legend>
                    <div class="feildwrap">
                        <label>Search Maintenance Package</label>
                        <input type="text" id="searchpmd" name="searchpmd" placeholder="Search by Maintenance Package">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="pmdlisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="15%">Maintenance Package</th>
                                    <th width="40%">Jobs</th>
                                    <th width="10%">Range-1 Amount</th>
                                    <th width="10%">Range-2 Amount</th>
                                    <th width="10%">Range-3 Amount</th> 
                                    <th width="5%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="pmdlisthf">
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="pmdlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($pmdList as $key) {
                                    ?>
                                    <tr id="PeriodDetailTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['PeriodName'] ?></td>
                                        <td class="tbl-name"><?= $key['JobTask'] ?></td>
                                        <td class="tbl-name"><?= $key['RangeOneAmount'] ?></td>
                                        <td class="tbl-name"><?= $key['RangeTwoAmount'] ?></td>
                                        <td class="tbl-name"><?= $key['RangeThreeAmount'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idPeriodicMaintenanceDetail'] ?>', '<?= $key['PeriodName'] ?>', '<?= $key['RangeOneAmount'] ?>', '<?= $key['RangeTwoAmount'] ?>', '<?= $key['RangeThreeAmount'] ?>', '<?= $key['JobTask'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/periodicmaintenancedetail/Delete/<?= $key['idPeriodicMaintenanceDetail'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/periodicmaintenancedetail/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none">
                        <label>PMD ID</label>
                        <input type="text" name="IdPMD" id="idpmd" data-validation="required">
                    </div>                    
                    <div>
                        <label>Maintenance Package</label>
                        <select id="updateselectpm" name="SelectPm">
                            <option>Select Maintenance Package</option>
                            <?php
                            foreach ($pmList as $key) {
                                $idPm = $pmList['idPeriodicMaintenance'];
                                ?>
                                <option value="<?= $key['idPeriodicMaintenance'] ?>" ><?= $key['PeriodName'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="error-updateperiod cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                    </div>
                    <div>
                        <label>Job Reference Manual</label>
                        <select id="updateselectjrm" name="updateSelectJrm[]" multiple>
                            <option>Select Jobs</option>
                            <?php
                            foreach ($jrmList as $key) {
                                ?>
                                <option value="<?= $key['idJobRef'] ?>" ><?= $key['JobTask'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="error-jrm cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                    </div><br>
                    <div>
                        <label>Rang-1 Amount</label>
                        <input type="text" id="AmountOne" name="AmountOne" placeholder="Range - 1 Amount"  style="width: 150px;" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                    </div><br>
                    <div>
                        <label>Rang-2 Amount</label>
                        <input type="text" id="AmountTwo" name="AmountTwo" placeholder="Range - 2  Amount" style="width: 150px;" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                    </div><br>
                    <div>
                        <label>Rang-3 Amount</label>
                        <input type="text" id="AmountThree" name="AmountThree" placeholder="Range - 3  Amount" style="width: 150px;" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                    </div><br><br>
                    <div style="display: none">
                        <label>Amount</label>
                        <input id="amount" type="text" name="Amount" data-validation="">
                    </div>
                    <div style="margin-left: 220px;">
                        <input type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#selectjrm").chosen();
    $("#searchpmd").keyup(function() {
        var search = $("#searchpmd").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/periodicmaintenancedetail/search",
            type: "POST",
            data: {searchpmd: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".pmdlisthf").is(":visible"))) {
                                $(".pmdlisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.PeriodName + "</td>\n\
                            <td class='tbl-name'>" + val.JobTask + "</td>\n\
                            <td class='tbl-name'>" + val.RangeOneAmount + "</td>\n\
                            <td class='tbl-name'>" + val.RangeTwoAmount + "</td>\n\
                            <td class='tbl-name'>" + val.RangeThreeAmount + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idPeriodicMaintenanceDetail + "','" + encodeURI(val.PeriodName) + "','" + val.RangeOneAmount + "','" + val.RangeTwoAmount + "','" + val.RangeThreeAmount + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/periodicmaintenancedetail/Delete/" + encodeURIComponent(val.idPeriodicMaintenanceDetail) + "'>Delete</td></tr>";
                            });
                            $('#pmdlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".pmdlisthf").hide();
                        $("#pmdlistbody").html("No Data Found");
                    }
                }
            }
        });
    });
    function validationform(type) {
        if (type === 'Add') {
            var jrm = $('#selectjrm').val();
            var period = $('#selectpm').val();
            if (period === "Select Maintenance Package" && jrm === "Select Jobs") {
                $(".error-period").show();
                $(".error-jrm").show();
                return false;
            } else {
                $(".error-period").hide();
                $(".error-jrm").hide();
                if ((period === "Select Maintenance Package") || (jrm === "Select Jobs")) {

                    if (period === "Select Maintenance Package") {
                        $(".error-period").show();
                    } else {
                        $(".error-period").hide();
                    }
                    if (jrm === "Select Jobs") {
                        $(".error-jrm").show();
                    } else {
                        $(".error-jrm").hide();
                    }
                    return false;
                }
                return true;
            }
        } else {
            var updateJrm = $('#updateselectjrm').val();
            var updatePeriod = $('#updateselectpm').val();
            if (updatePeriod === "Select Maintenance Package" && updateJrm === "Select Jobs") {
                $(".error-updateperiod").show();
                $(".error-updatejrm").show();
                return false;
            } else {
                $(".error-updateperiod").hide();
                $(".error-updatejrm").hide();
                if (updatePeriod === "Select Maintenance Package" || updateJrm === "Select Jobs") {
                    if (updatePeriod === "Select Maintenance Package") {
                        $(".error-updateperiod").show();
                    } else {
                        $(".error-updateperiod").hide();
                    }
                    if (updateJrm === "Select Jobs") {
                        $(".error-updatejrm").show();
                    } else {
                        $(".error-updatejrm").hide();
                    }
                    return false;
                }
                return true;
            }
        }
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

    function UpdatePopup(div_id, idpmd, periodname, amountone, amounttwo, amountthree, jobTask) {
        var jobTaskArray = "";
        jobTaskArray = (jobTask.split(','));
        for (var i = 0; i < jobTaskArray.length; i++) {
            $('#updateselectjrm > option').each(function() {
                if ($(this).text() === jobTaskArray[i]) {
                    $(this).prop('selected', true);
                }
            });
        }

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idpmd").val(idpmd);
            $(this).find("#AmountOne").val(amountone);
            $(this).find("#AmountTwo").val(amounttwo);
            $(this).find("#AmountThree").val(amountthree);
        });
        $('[name=SelectPm] option').filter(function() {
            return ($(this).text() === decodeURI(periodname));
        }).prop('selected', true);
        $("#updateselectjrm").chosen();
    }

</script>