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
            <form name="psfuresultform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/psfuresult/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add PSFU Result Type</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Type</label>
                            <input type="text" id="psfuresult" name="PSFUResult" placeholder="PSFU Result" data-validation="required">
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
                    <legend>PSFU Result List List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search PSFU Result Type</label>
                        <input type="text" name="searchpsfuresult" id="searchpsfuresult"  placeholder="Search by Type">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="psfuresultlisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="60%">Type</th>
                                    <th width="30%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="psfuresultlisthf">
                                <tr>
                                    <td colspan="3">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="psfuresultlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($psfuResultList as $key) {
                                    ?>
                                    <tr id="psfuretable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Name'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idPSFUResult'] ?>','<?= $key['Name'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/psfuresult/Delete/<?= $key['idPSFUResult'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/psfuresult/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>PSFU Result ID</label>
                        <input type="text" name="IdPSFUResult" id="idpsfuresult" data-validation="required">
                    </div>
                    <div>
                        <label>Type</label>
                        <input type="text" id="psfuresult" name="PSFUResult" placeholder="PSFU Result" data-validation="required">
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

    $("#searchpsfuresult").keyup(function() {
        var search = $("#searchpsfuresult").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/psfuresult/search",
            type: "POST",
            data: {searchpsfuresult: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".psfuresultlisthf").is(":visible"))) {
                                $(".psfuresultlisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                name = val.Name;
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Name + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idPSFUResult + "','" + name + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/psfuresult/Delete/" + val.idPSFUResult + "' >Delete</a></td></tr>";
                            });
                            $('#psfuresultlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".psfuresultlisthf").hide();
                        $("#psfuresultlistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idpsfuresult, psfuresulttype) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idpsfuresult").val(idpsfuresult);
            $(this).find("#psfuresult").val(psfuresulttype);
        });
    }

</script>