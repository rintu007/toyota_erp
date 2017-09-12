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
            <form name="contactinfoform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/contactinfo/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Contact Type</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Type</label>
                            <input type="text" id="contactname" name="ContactName" placeholder="Contact Name" data-validation="required">
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
                    <legend>Contact Information List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Contact Type</label>
                        <input type="text" name="searchcontactinfo" id="searchcontactinfo"  placeholder="Search by Type">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="contactinfolisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="60%">Contact Type</th>
                                    <th width="30%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="contactinfolisthf">
                                <tr>
                                    <td colspan="3">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="contactinfolistbody">
                                <?php
                                $Counter = 1;
                                foreach ($contactInfoList as $key) {
                                    ?>
                                    <tr id="contactTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Name'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idContactInfo'] ?>', '<?= $key['Name'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/contactinfo/Delete/<?= $key['idContactInfo'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/contactinfo/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Contact Info ID</label>
                        <input type="text" name="IdContactInfo" id="idcontactinfo" data-validation="required">
                    </div>
                    <div>
                        <label>Type</label>
                        <input type="text" id="contactname" name="ContactName" placeholder="Contact Name" data-validation="required">
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

    $("#searchcontactinfo").keyup(function() {
        var search = $("#searchcontactinfo").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/contactinfo/search",
            type: "POST",
            data: {searchcontactinfo: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".contactinfolisthf").is(":visible"))) {
                                $(".contactinfolisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Name + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idContactInfo + "','" + val.Name + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/contactinfo/Delete/" + val.idContactInfo + "' >Delete</a></td></tr>";
                            });
                            $('#contactinfolistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".contactinfolisthf").hide();
                        $("#contactinfolistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idcontactinfo, contactype) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idcontactinfo").val(idcontactinfo);
            $(this).find("#contactname").val(contactype);
        });
    }

</script>