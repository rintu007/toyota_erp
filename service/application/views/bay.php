<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="bayform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/bay/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Bays</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Dealer</label>
                            <select id="SelectDealer" name="SelectDealer">
                                <option>Select Dealer</option>
                                <?php
                                foreach ($dealersList as $key) {
                                    $idDealer = $dealersList['IdDealer'];
                                    ?>
                                    <option value="<?= $key['IdDealer'] ?>" ><?= $key['DealerName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-type cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br>
						<div>
                            <label>Shop Wise Description</label>
                            <select id="ShopWise" name="ShopWise">
                                <option>Select Shop Wise Description</option>
                                <?php
                                foreach ($shopList as $key) {
                                    $idShopwise= $shopList['idShopwise'];
                                    ?>
                                    <option value="<?= $key['idShopwise'] ?>" ><?= $key['ShopName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-type cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br>
                        <div>
                            <label>Bay Name</label>
                            <input type="text" name="BayName" placeholder="Bay Name" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Bay" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Bays List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Bay</label>
                        <input type="text" name="searchbay" id="searchbay"  placeholder="Search by Bay">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="baylisthf">
                                <tr>
                                    <th style="width: 3%;">S No.</th>
                                    <th style="width: 10%;">Bay Name</th>
                                    <th style="width: 12%;">Dealer</th>
									<th style="width: 20%;">Shop Wise Description</th>
                                    <th style="width: 15%;">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="baylisthf">
                                <tr>
                                    <td colspan="5">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="baylistbody">
                                <?php
                                $Counter = 1;
                                foreach ($baysList as $key) {
                                    ?>
                                    <tr id="bayTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['BayName'] ?></td>
                                        <td class="tbl-name"><?= $key['TypeName'] ?></td>
                                        <td class="tbl-name"><?= $key['Typename'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idBay'] ?>', '<?= $key['BayName'] ?>', '<?= $key['TypeName'] ?>',, '<?= $key['Typename'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/bay/Delete/<?= $key['idBay'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/bay/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Bay ID</label>
                        <input type="text" name="IdBay" id="idbay" data-validation="required">
                    </div>
                    <div>
                        <label>Dealer</label>
                        <select id="IdDealer" name="IdDealer" required>
                            <option>Select Dealer</option>
                            <?php
                            foreach ($dealersList as $key) {
                                $idDealer = $dealersList['IdDealer'];
                                ?>
                                <option value="<?= $key['IdDealer'] ?>" ><?= $key['DealerName'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="error-updatetype cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                    </div>
					<div>
                        <label>Shop Wise Description</label>
                            <select id="ShopWise" name="ShopWise">
                                <option>Select Shop Wise Description</option>
                                <?php
                                foreach ($shopList as $key) {
                                    $idShopwise= $shopList['idShopwise'];
                                    ?>
                                    <option value="<?= $key['idShopwise'] ?>" ><?= $key['ShopName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-type cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                    </div>
                    <div>
                        <label>Bay Name</label>
                        <input type="text" name="BayName" id="bayname" data-validation="required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update Bay">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchbay").keyup(function() {
        var search = $("#searchbay").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/bay/search",
            type: "POST",
            data: {searchbay: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".baylisthf").is(":visible"))) {
                                $(".baylisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.BayName + "</td>\n\
                            <td class='tbl-name'>" + val.TypeName + "</td>\n\
                            <td class='tbl-name'>" + val.Typename + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idBay + "','" + val.BayName + "','" + val.TypeName + "','" + val.Typename + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/bay/Delete/" + val.idBay + "' >Delete</a></td></tr>";
                            });
                            $('#baylistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".baylisthf").hide();
                        $("#baylistbody").html("No Data Found");
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
                var updateTypeName = $('#IdDealer').val();
                if (updateTypeName === "Select Dealer") {
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

    function UpdatePopup(div_id, idbay, bayname, dealername, ShopName) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idbay").val(idbay);
            $(this).find("#bayname").val(bayname);
        });
    }

</script>