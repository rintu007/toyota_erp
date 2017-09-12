<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="romodeform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/romode/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add RO Mode</legend>
                    <div class="feildwrap">
                        <div>
                            <label>RO Mode</label>
                            <input id="ROMode" name="ROMode" type= "text" placeholder="RO Modes" data-validation="required">
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
                    <legend>RO Mode List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search RO Mode</label>
                        <input type="text" name="SearchMode" id="SearchMode"  placeholder="Search by Mode">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="romodelisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="75%">RO-Mode</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="romodelisthf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="romodelistbody">
                                <?php
                                $Counter = 1;
                                foreach ($romodeList as $key) {
                                    ?>
                                    <tr id="romodeTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['ModeName'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdateROMode('detail', '<?= $key['idROMode'] ?>', '<?= $key['ModeName'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/romode/Delete/<?= $key['idROMode'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 700px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/romode/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>ID RO Mode</label>
                        <input id="idROMode" name="idROMode" type="text" data-validation="required">
                    </div>
                    <div>
                        <label>RO Mode</label>
                        <input id="uROMode" name="uROMode" type= "text" placeholder="RO Modes" data-validation="required">
                    </div>
					<!--<div>
                        <label>Status</label>
						<?
                         foreach ($romodeList as $key) {
                        ?>
                        <select id="status" name="status" required>
						 <option>Status</option>
                                <option value="0" >Deactive</option>
								<option value="1" >Active</option>
                                
                        </select>
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

    $("#SearchMode").keyup(function() {
        var search = $("#SearchMode").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/romode/search",
            type: "POST",
            data: {ROMode: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".romodelisthf").is(":visible"))) {
                                $(".romodelisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.ModeName + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdateROMode('detail','" + val.idROMode + "','" + val.ModeName + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/romode/Delete/" + val.idROMode + "' >Delete</a></td></tr>";
                            });
                            $('#romodelistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".romodelisthf").hide();
                        $("#romodelistbody").html("No Data Found");
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

    function UpdateROMode(div_id, idROMode, Mode) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idROMode").val(idROMode);
            $(this).find("#uROMode").val(Mode);
        });
    }

</script>