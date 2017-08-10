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
                  action="<?= base_url() ?>index.php/dealer/newdealer" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Dealer</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Dealer Name</label>
                            <input type="text" name="dealer_name" data-validation="required">
                        </div>
                        <div>
                            <label>Dealer Type</label>
                            <select name="dealer">
                                <option>Select Dealer</option>
                                <?php
                                foreach ($dealer as $CarDealer) {
                                    $DealerId = $CarDealer['IdDealer'];
                                    ?>
                                    <option value="<?= $CarDealer['Id'] ?>" ><?= $CarDealer['DealerType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Amount Limit</label>
                            <input type="text" name="amount_limit" data-validation="required">
                        </div>
                        <div>
                            <label>Limit Quantity</label>
                            <input type="text" name="limit_quantity" data-validation="required">
                        </div>
                        <div>
                            <label>Vender Limit Type</label>
                            <select name="limit">
                                <option>Select Limit Type</option>
                                <?php
                                foreach ($limit as $CarLimit) {
                                    $LimitId = $CarLimit['IdLimit'];
                                    ?>
                                    <option value="<?= $CarLimit['IdLimit'] ?>" ><?= $CarLimit['LimitType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Address</label>
                            <textarea name="address"></textarea>
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Dealer">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Dealer List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Dealer
                                <!--<span class="required">*</span>-->
                            </label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Dealer Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="28%">Dealer Name</th>
                                    <th width="12%">Dealer Type</th>
                                    <th width="12%">Amount Limit</th>
                                    <th width="17%">Quantity Limit</th>
                                    <th width="8%">Vendor Limit Type</th>
                                    <th width="25%">Details</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <div id="paging">
                                            <ul>
                                                <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                <!--                                            <li><a href="" class="active"><span>-->
                                                <!--</span></a></li>-->
                                                <!--                                            <li>-->
                                                <!--<?//= $pagination ?></li>-->
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
                                foreach ($AllDealers as $CarDealer) {
                                    $DealerId = $CarDealer['IdSubDealer'];
                                    ?>
                                    <tr id="carVariants">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CarDealer['Name'] ?></td>
                                        <td class="tbl-name"><?= $CarDealer['TypeName'] ?></td>
                                        <td class="tbl-name"><?= $CarDealer['AmountLimit'] ?></td>
                                        <td class="tbl-name"><?= $CarDealer['LimitQuantity'] ?></td>
                                        <td class="tbl-name"><?= $CarDealer['LimitType'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="dealerPopup('detail', '<?= $DealerId ?>', '<?= $CarDealer['Name'] ?>', '<?= $CarDealer['IdDealer'] ?>', '<?= $CarDealer['AmountLimit'] ?>', '<?= $CarDealer['LimitQuantity'] ?>', '<?= $CarDealer['IdLimit'] ?>', '<?= $CarDealer['Address'] ?>')">Edit</a>
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
<!-- Edit Variants Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/dealer/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Dealer ID</label>
            <input type="text" id="idSubDealer" name="dealer_id">
        </div>
        <br>
        <div>
            <label>Dealer Name</label>
            <input type="text" name="dealer_name" id="dealer_name" data-validation="required">
        </div>
        <div>
            <label>Dealer Type</label>
            <select name="dealer" id="dealer">
                <option>Select Dealer</option>
                <?php
                foreach ($dealer as $CarDealer) {
                    $DealerId = $CarDealer['IdDealer'];
                    ?>
                    <option value="<?= $CarDealer['Id'] ?>" ><?= $CarDealer['DealerType'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Amount Limit</label>
            <input type="text" id="amountLimit" name="amount_limit" data-validation="required">
        </div>
        <div>
            <label>Limit Quantity</label>
            <input type="text" id="quantityLimit" name="limit_quantity" data-validation="required">
        </div>
        <div>
            <label>Vender Limit Type</label>
            <select name="limit" id="vendorLimit">
                <option>Select Limit Type</option>
                <?php
                foreach ($limit as $CarLimit) {
                    $LimitId = $CarLimit['IdLimit'];
                    ?>
                    <option value="<?= $CarLimit['IdLimit'] ?>" ><?= $CarLimit['LimitType'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>Address</label>
            <textarea name="address" id="address"></textarea>
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Dealer">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/dealer/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        var items = "";
                        var count = 1;
                        $.each(a, function(i, val) {
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.Name + "</td><td>" + val.TypeName + "</td>\n\
<td>" + val.AmountLimit + "</td><td>" + val.LimitQuantity + "</td><td>" + val.VendorLimitType + "</td>\n\
<td><a style='cursor: pointer;' onClick=\"dealerPopup('detail','" + val.IdSubDealer + "','" + val.Name + "','" + val.IdDealer + "','" + val.AmountLimit + "','" + val.LimitQuantity + "','" + val.IdLimit + "','" + val.Address + "')\">Edit</a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'>No Data Found</td><td style='border: 0px'></td><td style='border: 0px'></td>\n\
                                <td style='border: 0px'></td>");
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

    function dealerPopup(div_id, id, name, dealer, amount, quantity, limit, address) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idSubDealer").val(id);
            $(this).find("#dealer_name").val(name);
            $(this).find("#dealer").val(dealer);
            $(this).find("#amountLimit").val(amount);
            $(this).find("#quantityLimit").val(quantity);
            $(this).find("#vendorLimit").val(limit);
            $(this).find("#address").val(address);
        });
    }
</script>