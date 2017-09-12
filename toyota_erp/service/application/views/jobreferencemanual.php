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
            <form name="jrmform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Jobreferencemanual/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Job Reference Manual</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Job Task</label>
                            <input type="text" name="JobTask" placeholder="Job Task" data-validation="required">
                        </div><br>
                        <div>
                            <label>Time</label>
                            <input type="text" name="TimeTaken" placeholder="Time will take (in Minutes)" data-validation="required"><span>&nbsp;<b>Minutes</b></span>
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
                        <div>
                            <label>&nbsp;</label>
                            <input type="checkbox" name="isBodyPaint" value="1">
                            <span>OF Body Paint</span>
                        </div>                        
                        <div>
                            <label>&nbsp;</label>
                            <input type="checkbox" name="isDefault" value="1">
                            <span>PM Job</span>
                        </div><br><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">

                <fieldset>
                    <legend>Job Reference Manual List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Job Task</label>
                        <input type="text" name="searchjrm" id="searchjrm"  placeholder="Search by Job Task">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="jrmlisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="20%">Job Task</th>
                                    <th width="30%">Time (minutes)</th>
                                    <th width="10%">Range-1 Amount</th>
                                    <th width="10%">Range-2 Amount</th>
                                    <th width="10%">Range-3 Amount</th>                                    
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="jrmlisthf">
                                <tr>
                                    <td colspan="7">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="jrmlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($jrmList as $key) {
                                    ?>
                                    <tr id="jobTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['JobTask'] ?></td>
                                        <td class="tbl-name"><?= $key['TimeTaken'] ?></td>
                                        <td class="tbl-name"><?= $key['RangeOneAmount'] ?></td>
                                        <td class="tbl-name"><?= $key['RangeTwoAmount'] ?></td>
                                        <td class="tbl-name"><?= $key['RangeThreeAmount'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idJobRef'] ?>', '<?= $key['JobTask'] ?>', '<?= $key['TimeTaken'] ?>', '<?= $key['RangeOneAmount'] ?>', '<?= $key['RangeTwoAmount'] ?>', '<?= $key['RangeThreeAmount'] ?>', '<?= $key['isBodyPaint'] ?>', '<?= $key['isDefault'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/Jobreferencemanual/Delete/<?= $key['idJobRef'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 600px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/Jobreferencemanual/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div class="feildwrap"> 
                        <div style="display: none;">
                            <label>JRM ID</label>
                            <input id="idjrm" type="text" name="IdJrm" data-validation="required">
                        </div>
                        <div>
                            <label>Job Task</label>
                            <input id="jobtask"  type="text" name="JobTask" data-validation="required">
                        </div>
                        <div>
                            <label>Time</label>
                            <input id="timetaken" type="text" name="TimeTaken" data-validation="required">
                        </div><br>                       
                        <div>
                            <label>Rang-1 Amount</label>
                            <input type="text" id="RAmountOne" name="RAmountOne" placeholder="Range - 1 Amount" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                        </div><br>
                        <div>
                            <label>Rang-2 Amount</label>
                            <input type="text" id="RAmountTwo" name="RAmountTwo" placeholder="Range - 2  Amount" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                        </div><br>
                        <div>
                            <label>Rang-3 Amount</label>
                            <input type="text" id="RAmountThree" name="RAmountThree" placeholder="Range - 3  Amount" data-validation=""><span>&nbsp;<b>/= Rs</b></span>
                        </div><br><br>
                        <div style="margin-left: 0px;">   
                            <label>&nbsp;</label>                    
                            <input type="checkbox" id="uisBodyPaint" name="uisBodyPaint" value="1">
                            <span>OF Body Paint</span>
                        </div><br><br>
                        <div style="margin-left: 0px;">  
                            <label>&nbsp;</label>
                            <input type="checkbox" id="uisDefault" name="uisDefault" value="1">
                            <span>PM Job</span>
                        </div>
                        <div style="margin-left: 300px;">
                            <input type="submit" class="btn" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchjrm").keyup(function() {
        var search = $("#searchjrm").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Jobreferencemanual/search",
            type: "POST",
            data: {searchjrm: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    console.log('JRM Data');
                    console.log(a);
                    if (a.length > 0) {
                        try {

                            if (!($(".jrmlisthf").is(":visible"))) {
                                console.log('hidden');
                                $(".jrmlisthf").show();
                            } else {
                                console.log('showing already');
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.JobTask + "</td>\n\
                            <td class='tbl-name'>" + val.TimeTaken + "</td>\n\
                            <td class='tbl-name'>" + val.RangeOneAmount + "</td>\n\
                            <td class='tbl-name'>" + val.RangeTwoAmount + "</td>\n\
                            <td class='tbl-name'>" + val.RangeThreeAmount + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idJobRef + "','" + encodeURI(val.JobTask) + "','" + val.TimeTaken + "','" + val.RangeOneAmount + "','" + val.RangeTwoAmount + "','" + val.RangeThreeAmount + "','" + val.isBodyPaint + "','" + val.isDefault + "')> Edit</a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/Jobreferencemanual/Delete/" + val.idJobRef + "'>Delete</a></td></tr>";
                            });
                            $('#jrmlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".jrmlisthf").hide();
                        $("#jrmlistbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform() {
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

    function UpdatePopup(div_id, idbay, jobtask, timetaken, amountone, amounttwo, amountthree, idbp, ipm) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idjrm").val(idbay);
            $(this).find("#jobtask").val(decodeURI(jobtask));
            $(this).find("#timetaken").val(timetaken);
            $(this).find("#RAmountOne").val(amountone);
            $(this).find("#RAmountTwo").val(amounttwo);
            $(this).find("#RAmountThree").val(amountthree);
        });

        $('#uisDefault').filter(function() {
            return ($(this).val() == ipm);
        }).prop('checked', true);

        $('#uisBodyPaint').filter(function() {
            return ($(this).val() == idbp);
        }).prop('checked', true);
    }

</script>