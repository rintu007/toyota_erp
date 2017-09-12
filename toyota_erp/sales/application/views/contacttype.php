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
                  action="<?= base_url() ?>index.php/contacttype/newcontacttype"
                  class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Contact Type</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Contact Type</label>
                            <input type="text" name="contact_type" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Contact Type">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Contact Type List</legend>
                    <div class="feildwrap">
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="40%">Contact Type</th>
                                    <th width="17%">Details</th>
									<th width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    
                                    <td colspan="9">
                                        <div id="paging">
                                            <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                                Total : <?php echo $counts ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <div id="paging">
                                            <ul>
                                                <?php echo $links ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot> 
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($ContactType as $CustomerContactType) {
                                    $ContactTypeId = $CustomerContactType['Id'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CustomerContactType['ContactType'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="contacttypePopup('detail', '<?= $ContactTypeId ?>', '<?= $CustomerContactType['ContactType'] ?>')">Edit</a>
                                        </td>
										<td>
						 <a href="<?=	base_url()."index.php/contacttype/delete/"  ?><?= $ContactTypeId ?>">Delete</a>
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
<!-- Edit Contact Type Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/contacttype/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Contact Type ID</label>
            <input type="text" id="idContactType" name="contacttype_id">
        </div>
        <br>
        <div>
            <label>Contact Type</label>
            <input type="text" id="contacttype_name" name="contacttype_name">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Contact Type">
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

    function contacttypePopup(div_id, id, name) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idContactType").val(id);
            $(this).find("#contacttype_name").val(name);
        });

    }
</script>