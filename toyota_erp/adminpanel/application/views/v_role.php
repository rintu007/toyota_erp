<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['username'] == "admin") {
//            include 'include/admin_leftmenu.php';
//        } else if ($cookieData['Role'] == "Sales Admin") {
//            include 'include/sales_leftmenu.php';
//        } else if ($cookieData['Role'] == "Director") {
//            include 'include/director_menu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/role/newrole" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Role</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Role Name</label>
                            <input type="text" name="role_name" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Role">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>User Role List</legend>
                    <div class="feildwrap">
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="50%">Role Name</th>
                                    <th width="17%">Details</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div id="paging">
                                            <ul>
                                                <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                <!--                                            <li><a href="" class="active"><span>-->
                                                <!--</span></a></li>-->
                                                <!--                                            <li>-->
                                                <?//= $pagination; ?><!--</li>-->
                                                <!--                                                <li><a href=""><span>3</span></a></li>-->
                                                <!--                                                <li><a href=""><span>4</span></a></li>-->
                                                <!--                                                <li><a href=""><span>5</span></a></li>-->
                                                <!--                                            <li><a href=""><span>Next</span></a></li>-->
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($Role as $UserRole) {
                                    $RoleId = $UserRole['RoleId'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $UserRole['RoleName'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="rolePopup('detail', '<?= $RoleId ?>', '<?= $UserRole['RoleName'] ?>')">Edit</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- Edit Role Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/role/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Role ID</label>
            <input type="text" id="idRole" name="role_id">
        </div>
        <br>
        <div>
            <label>Role Name</label>
            <input type="text" id="role_name" name="role_name">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Role">
        </div>
    </form>
</div>
<script>
    function validationform() {
        chosen = "";

        pass = $("#pass").val();
        confirm_pass = $("#cpass").val();
        if (pass != confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }
    }

    function rolePopup(div_id, id, name) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idRole").val(id);
            $(this).find("#role_name").val(name);
        });

    }

</script>