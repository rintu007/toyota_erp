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
            <form name="qualitycheckform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/qualitycheck/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Quality Check</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Type</label>
                            <input type="text" id="name" name="Name" placeholder="Quality Check Type" data-validation="required">
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
                    <legend>Quality Check List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Finance Type</label>
                        <input type="text" name="searchqualitycheck" id="searchqualitycheck"  placeholder="Search by Type">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="qualitychecklisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="60%">Quality Check Type</th>
                                    <th width="30%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="qualitychecklisthf">
                                <tr>
                                    <td colspan="3">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="qualitychecklistbody">
                                <?php
                                $Counter = 1;
                                foreach ($qualityCheckList as $key) {
                                    ?>
                                    <tr id="qualityTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Name'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idQualityCheck'] ?>', '<?= $key['Name'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/qualitycheck/Delete/<?= $key['idQualityCheck'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/qualitycheck/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Finance Info ID</label>
                        <input type="text" name="IdQualityCheck" id="idqualitycheck" data-validation="required">
                    </div>
                    <div>
                        <label>Type</label>
                        <input type="text" id="name" name="Name" placeholder="Quality Check Type" data-validation="required">
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

    $("#searchqualitycheck").keyup(function() {
        var search = $("#searchqualitycheck").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/qualitycheck/search",
            type: "POST",
            data: {searchqualitycheck: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".qualitychecklisthf").is(":visible"))) {
                                $(".qualitychecklisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Name + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idQualityCheck + "','" + val.Name + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/qualitycheck/Delete/" + val.idQualityCheck + "' >Delete</a></td></tr>";
                            });
                            $('#qualitychecklistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".qualitychecklisthf").hide();
                        $("#qualitychecklistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idqualitycheck, qualitychecktype) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idqualitycheck").val(idqualitycheck);
            $(this).find("#name").val(qualitychecktype);
        });
    }

</script>