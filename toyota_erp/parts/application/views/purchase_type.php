<div id="wrapper">
    <div id="content">
        <?php
//        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['isAdmin'] == 1) {
        include 'include/purchase_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <div>
                <?= $Response ?>
            </div>
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/purchase/type" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Purchase Type</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Purchase Type Name</label>
                            <input type="text" name="TypeName" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Purchase Type">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Purchase Type List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Purchase Type</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Purchase Type">
                        </div>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Purchase Type</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($PurchaseType as $AllTypes) {
                                    $idPurchaseType = $AllTypes['idPurchaseType'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllTypes['PurchaseType'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="PurchasePopup('detail', '<?= $idPurchaseType ?>', '<?= $AllTypes['PurchaseType'] ?>')">Edit</a>
                                            <?php
                                            //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                            ?>
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
<!-- Edit Party Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/purchase/edittype" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Id Purchase</label>
            <input type="text" name="idPurchaseType" id="idPurchaseType" data-validation="required">
        </div>
        <div>
            <label>Purchase Type</label>
            <input type="text" name="TypeName" id="PurchaseType" data-validation="required">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Purchase Type">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/purchase/typesearch",
            type: "POST",
            data: {search: search},
            success: function(data) {
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var count = 1;
                        var items = "";
                        $.each(a, function(i, val) {
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.PurchaseType + "</td>\n\
<td><a style='cursor: pointer;' onClick=PurchasePopup('detail','" + val.idPurchaseType + "','" + val.PurchaseType + "')> Edit </a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>");
                }
            }
        });
    });
    function validationform() {
        var WareHouse = $('#Warehouse').val();
        if (WareHouse === "Select Warehouse") {
            $(".error-warehouse").show();
            return false;
        } else {
            $(".error-warehouse").hide();
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
    function PurchasePopup(div_id, idPurchaseType, PurchaseType) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idPurchaseType").val(idPurchaseType);
            $(this).find("#PurchaseType").val(PurchaseType);
        });
    }

</script>