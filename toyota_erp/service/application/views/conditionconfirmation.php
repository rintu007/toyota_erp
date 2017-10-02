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
            <form name="conditionform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/conditionconfirmation/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add 5W1H Type</legend>
                    <div class="feildwrap">
                        <div>
                            <label>5W1H</label>
                            <input type="text" id="condition" name="Condition" placeholder="5W1H" data-validation="required">
                        </div><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>5W1H List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search 5W1H</label>
                        <input type="text" name="searchconditionconfirmation" id="searchconditionconfirmation"  placeholder="Search by 5W1H">
                    </div><br>
                    <div class="btn-block-wrap datagrid dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="conditionconfirmationlisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="60%">5W1H</th>
                                    <th width="30%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="conditionconfirmationlisthf">
                                <tr>
                                    <td colspan="3">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="conditionconfirmationlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($conditionList as $key) {
                                    ?>
                                    <tr id="condTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Name'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idConditionConfirmation'] ?>', '<?= $key['Name'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/conditionconfirmation/Delete/<?= $key['idConditionConfirmation'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/conditionconfirmation/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Finance Info ID</label>
                        <input type="text" name="IdCondition" id="idcondition" data-validation="">
                    </div>
                    <div>
                        <label>Type</label>
                        <input type="text" id="condition" name="Condition" placeholder="5W1H" data-validation="required">
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

    $("#searchconditionconfirmation").keyup(function() {
        var search = $("#searchconditionconfirmation").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/conditionconfirmation/search",
            type: "POST",
            data: {searchconditionconfirmation: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".conditionconfirmationlisthf").is(":visible"))) {
                                $(".conditionconfirmationlisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Name + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idConditionConfirmation + "','" + val.Name + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/conditionconfirmation/Delete/" + val.idConditionConfirmation + "' >Delete</a></td></tr>";
                            });
                            $('#conditionconfirmationlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".conditionconfirmationlisthf").hide();
                        $("#conditionconfirmationlistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idcondition, condition) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idcondition").val(idcondition);
            $(this).find("#condition").val(condition);
        });
    }

</script>