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
            <form name="staffrolesrolesform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/staffroles/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Staff Roles</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Role</label>
                            <input type="text" id="rolename" name="RoleName" placeholder="Role Name" data-validation="required">
                        </div><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Staff Role" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onSubmit="return validationform()">
                <fieldset>
                    <legend>Staff Roles List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Roles</label>
                        <input type="text" name="searchstaffroles" id="searchstaffroles"  placeholder="Search by Role">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="staffroleslisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="60%">Role</th>
                                    <th width="30%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="staffroleslisthf">
                                <tr>
                                    <td colspan="3">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="staffroleslistbody">
                                <?php
                                $Counter = 1;
                                foreach ($staffRolesList as $key) {
                                    ?>
                                    <tr id="staffRolesTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['RoleName'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idStaffRoles'] ?>', '<?= $key['RoleName'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/staffroles/Delete/<?= $key['idStaffRoles'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/staffroles/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Staff Roles ID</label>
                        <input type="text" name="IdStaffRole" id="idstaffroles" data-validation="required">
                    </div>
                    <div>
                        <label>Role Name</label>
                        <input type="text" id="rolename" name="RoleName" placeholder="Role Name" data-validation="required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update Staff Roles">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchstaffroles").keyup(function() {
        var search = $("#searchstaffroles").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/staffroles/search",
            type: "POST",
            data: {searchstaffroles: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".staffroleslisthf").is(":visible"))) {
                                $(".staffroleslisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.RoleName + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idStaffRoles + "','" + val.RoleName + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/staffroles/Delete/" + val.idStaffRoles + "' >Delete</a></td></tr>";
                            });
                            $('#staffroleslistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".staffroleslisthf").hide();
                        $("#staffroleslistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idstaffroles, rolesname) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idstaffroles").val(idstaffroles);
            $(this).find("#rolename").val(rolesname);
        });
    }

</script>