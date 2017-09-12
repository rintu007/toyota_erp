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
            <form name="psfuduration" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/psfuduration/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Psfu Duration</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Psfu Duration</label>
                            <input id="Duration" name="Duration" type="number" min="1" placeholder="Duration in Days" data-validation="required">&nbsp;&nbsp;&nbsp;Day(S)
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 425px;width: 100px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Psfu Duration List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Psfu Duration</label>
                        <input type="text" name="SearchDuration" id="SearchDuration"  placeholder="Search by Duration">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="psfudurationlisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="75%">Duration in Day(s)</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="psfudurationlisthf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="psfudurationlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($psfudurationList as $key) {
                                    ?>
                                    <tr id="psfudurationTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Duration'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdateDurationume('detail', '<?= $key['idPsfuDuration'] ?>', '<?= $key['Duration'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/psfuduration/Delete/<?= $key['idPsfuDuration'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 700px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/psfuduration/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>ID Psfu Duration</label>
                        <input id="idPsfuDuration" name="idPsfuDuration" type="text" data-validation="required">
                    </div>
                    <div>
                        <label>Psfu Duration</label>
                        <input id="uDuration" name="uDuration" type="number" min="1" placeholder="Duration in Days" data-validation="required">&nbsp;&nbsp;&nbsp;Day(s)
                    </div>
                    <div style="float: right;margin-right:60px;">
                        <input type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#SearchDuration").keyup(function() {
        var search = $("#SearchDuration").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/psfuduration/search",
            type: "POST",
            data: {duration: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".psfudurationlisthf").is(":visible"))) {
                                $(".psfudurationlisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Duration + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdateDurationume('detail','" + val.idPsfuDuration + "','" + val.Duration + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/psfuduration/Delete/" + val.idPsfuDuration + "' >Delete</a></td></tr>";
                            });
                            $('#psfudurationlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".psfudurationlisthf").hide();
                        $("#psfudurationlistbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform(type) {
        if (type === 'Add') {
            var typeName = $('#SelectDealer').val();
            if (typeName === "Select Dealer") {
                $(".error-type").show();
                return false;
            } else {
                $(".error-type").hide();
                return true;
            }
        } else {
            if (type === 'Update') {
                var updateQuestion = $('#IdDealer').val();
                if (updateQuestion === "Select Dealer") {
                    $(".error-updatetype").show();
                    return false;
                } else {
                    $(".error-updatetype").hide();
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

    function UpdateDurationume(div_id, idPsfuDuration, Duration) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idPsfuDuration").val(idPsfuDuration);
            $(this).find("#uDuration").val(Duration);
        });
    }

</script>