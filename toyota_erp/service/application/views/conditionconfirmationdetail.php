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
            <form name="conditionconfirmationdetailform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/conditionconfirmationdetail/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add 5W1H Detail</legend>
                    <div class="feildwrap">
                        <div>
                            <label>5W1H</label>
                            <select id="SelectCondition" name="SelectCondition">
                                <option>Select 5W1H</option>
                                <?php
                                foreach ($conditionList as $key) {
                                    ?>
                                    <option value="<?= $key['idConditionConfirmation'] ?>" ><?= $key['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-condition cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br>
                        <div>
                            <label>5W1H Detail</label>
                            <input type="text" name="ConditionDetail" placeholder="5W1H Detail" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>5W1H Detail List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search 5W1H Detail</label>
                        <input type="text" name="searchconditiondetail" id="searchconditiondetail"  placeholder="Search by 5W1H Detail">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="conditiondetailhf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="40%">5W1H </th>
                                    <th width="30%">5W1H Detail</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="conditiondetailhf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="conditiondetailbody">
                                <?php
                                $Counter = 1;
                                foreach ($conditionDetailList as $key) {
                                    ?>
                                    <tr id="condDetailTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['conditionconfirmation'] ?></td>
                                        <td class="tbl-name"><?= $key['ConditionDetail'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idConditionDetail'] ?>', '<?= $key['ConditionDetail'] ?>', '<?= $key['conditionconfirmation'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/conditionconfirmationdetail/Delete/<?= $key['idConditionDetail'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/conditionconfirmationdetail/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>5W1H Detail ID</label>
                        <input type="text" name="IdConditionDetail" id="idconditiondetail" data-validation="required">
                    </div>
                    <div>
                        <label>5W1H</label>
                        <select id="idcondition" name="IdCondition" required>
                            <option>Select Condition</option>
                            <?php
                            foreach ($conditionList as $key) {
                                ?>
                                <option value="<?= $key['idConditionConfirmation'] ?>" ><?= $key['Name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="error-updatecondition cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                    </div>
                    <div>
                        <label>5W1H Detail</label>
                        <input type="text" name="ConditionDetail" id="conditiondetail" data-validation="required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchconditiondetail").keyup(function() {
        var search = $("#searchconditiondetail").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/conditionconfirmationdetail/search",
            type: "POST",
            data: {searchconditiondetail: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".conditiondetailhf").is(":visible"))) {
                                console.log('in cond');
                                $(".conditiondetailhf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.conditionconfirmation + "</td>\n\
                            <td class='tbl-name'>" + val.ConditionDetail + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idConditionDetail + "','" + val.ConditionDetail + "','" + val.conditionconfirmation + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/conditionconfirmationdetail/Delete/" + val.idConditionDetail + "' >Delete</a></td></tr>";
                            });
                            $('#conditiondetailbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".conditiondetailhf").hide();
                        $("#conditiondetailbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform(type) {
        if (type === 'Add') {
            var condition = $('#SelectCondition').val();
            if (condition === "Select Condition") {
                $(".error-condition").show();
                return false;
            } else {
                $(".error-condition").hide();
                return true;
            }
        } else {
            if (type === 'Update') {
                var updateCondition = $('#idcondition').val();
                if (updateCondition === "Select Condition") {
                    $(".error-updatecondition").show();
                    return false;
                } else {
                    $(".error-updatecondition").hide();
                    return true;
                }
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

    function UpdatePopup(div_id, idconditiondetail, conditiondetail, condition) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idconditiondetail").val(idconditiondetail);
            $(this).find("#conditiondetail").val(conditiondetail);
        });
    }

</script>