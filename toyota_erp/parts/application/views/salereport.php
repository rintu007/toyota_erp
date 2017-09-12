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
            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/reports/sale">
                <fieldset>
                    <legend>Sale Report</legend>
                    <div class="feildwrap">
                        <!--<div>-->
                        <!--<label style="/*margin-left: -135px*/">Search</label>-->
                        <!--<input type="text" name="search" id="search" placeholder="Search By Name/Cnic/Ntn">-->
                        <!--</div>-->
                        <div>
                            <label>Search By Sale Type</label>
                            <select name="SaleType">
                                <option>Select Sale Type</option>
                                <?php
                                foreach ($SaleType as $AllSaleType) {
                                    ?>
                                    <option value="<?= $AllSaleType['idSaleType'] ?>" ><?= $AllSaleType['SaleType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <div style="/*margin-left: -150px;*/">
                            <label>From</label>
                            <input type="text" name="fromDate" class="date">
                        </div>
                        <div style="//margin-left: -123px;">
                            <label>To</label>
                            <input type="text" name="toDate" class="date toDate">
                        </div>
                        <div style="margin-left: 200px;">
                            <input type="submit" value="Generate PDF" name="pdf"  style="margin-bottom: -14px;height: 30px;">
                        </div>
                        <?php
//                        }
                        ?>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/pbo/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var items = [];
                        var count = 1;
                        $.each(a, function(i, val) {
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                                        <td class='tbl-name'>" + val.CustomerName + "</td><td>" + val.Date + "</td>\n\
<td>" + val.Variants + "</td><td>" + val.ColorName + "</td><td>" + val.Cellphone + "</td>\n\
                                <td><a href='<?= base_url() ?>index.php/quotation/index/" + val.IdResourceBook + "'>Quotation</a> / <a style='cursor: pointer;' onClick=rbPopup('detail','" + val.IdResourceBook + "')>Lost Sale</a> / <a href='<?= base_url() ?>/index.php/resourcebook/update/" + val.IdResourceBook + "'>Edit</a></td></tr>"
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'>No Data Found</td><td style='border: 0px'></td><td style='border: 0px'></td>");
                }
            }
        });
    });
</script>
