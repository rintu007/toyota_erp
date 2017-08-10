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
            <form name="checklistform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Rochecklist/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add CheckList</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Name</label>
                            <input type="text" name="Name" placeholder="Check List Name" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add CheckList" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">

                <fieldset>
                    <legend>Check List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Check List</label>
                        <input type="text" name="searchchecklist" id="searchchecklist"  placeholder="Search by Name">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="checklisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="40%">Name</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="checklisthf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="checklistbody">
                                <?php
                                $Counter = 1;
                                foreach ($checkList as $key) {
                                    ?>
                                    <tr id="checklistTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Name'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idROCheckList'] ?>', '<?= $key['Name'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/Rochecklist/Delete/<?= $key['idROCheckList'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/Rochecklist/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>CheckList ID</label>
                        <input type="text" name="IdCheckList" id="idchecklist" data-validation="required">
                    </div>
                    <div>
                        <label>Name</label>
                        <input type="text" name="CheckListName" id="checklistname" data-validation="required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update CheckList">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchchecklist").keyup(function() {
        var search = $("#searchchecklist").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Rochecklist/search",
            type: "POST",
            data: {searchchecklist: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".checklisthf").is(":visible"))) {
                                $(".checklisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Name + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idROCheckList + "','" + val.Name + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/Rochecklist/Delete/" + val.idROCheckList + "'>Delete</a></td></tr>";
                            });
                            $('#checklistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".checklisthf").hide();
                        $("#checklistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idchecklist, name) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idchecklist").val(idchecklist);
            $(this).find("#checklistname").val(name);
        });
    }

</script>