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
                  action="<?= base_url() ?>index.php/allocationtype/add"
                  class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Allocation Type</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Allocation Type Name</label>
                            <input type="text" name="allocation_type" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Allocation Type">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Allocation Type List</legend>
                    <div class="feildwrap">
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="40%">Name</th>
                                    <th width="17%">Details</th>
									 <th width="10%">Details</th>
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
                                foreach ($Allocation as $AllocationType) {
                                    $idAllocationType = $AllocationType['Id'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllocationType['AllocationType'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="customertypePopup('detail', '<?= $idAllocationType ?>', '<?= $AllocationType['AllocationType'] ?>')">Edit</a>
                                        </td>
										<td>
									
                                    <a href="<?=	base_url()."index.php/allocationtype/delete/"  ?><?= $idAllocationType ?>">Delete</a>

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
<!-- Edit Customer Type Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/allocationtype/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Allocation Type ID</label>
            <input type="text" id="idCustomerType" name="allocation_type_id">
        </div>
        <br>
        <div>
            <label>Allocation Type Name</label>
            <input type="text" id="customertype_name" name="allocation_type">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Allocation Type">
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

    function customertypePopup(div_id, id, name) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idCustomerType").val(id);
            $(this).find("#customertype_name").val(name);
        });

    }

</script>