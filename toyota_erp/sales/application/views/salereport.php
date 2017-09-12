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
            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/salereport/report">
                <fieldset>
                    <legend>Sale Report</legend>
                    <div class="feildwrap">
                        <div>
                            <label style="/*margin-left: -135px*/">Search</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Name/Cnic/Ntn">
                        </div>
                        
                      <div style="/*margin-left: -150px;*/">
                            <label>From</label>
                            <input type="text" name="fromDate" class="date">
                        </div>
                        <div style="margin-left: -123px;">
                            <label>To</label>
                            <input type="text" name="toDate" class="date toDate">
                        </div>
                        <div style="margin-left: 200px;">
                            <input type="submit" value="Generate PDF" name="pdf"  style="margin-bottom: -14px;height: 30px;">
                        </div>
                        <br/>
                        <div>
                        </div>
                        <?php
//                        }
                        ?>
                    </div>
                </fieldset>
            </form>
            <form class="form animated fadeIn">
                <fieldset>
                    <legend>Sale Report List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="17%">Make</th>
									 <th width="17%">Created Date</th>
                                    <th width="10%">Color</th>
                                    <th width="14%">Engine Number</th>
                                    <th width="13%">Chassis Number</th>
                                    <th width="15%">Purchase From</th>
                                    <th width="10%">Sold To</th>
                                    <th width="18%">Purchase Amount</th>
                                    <th width="18%">Sold Amount</th>
                                    <th width="10%">Profit</th>
                                    <th width="10%">Percentage</th>
                                    <th width="10%">ProfitPercentage</th>
                                    <th width="10%">NetProfit</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="10">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($SaleReport as $AllSaleReport) {
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllSaleReport['Variants'] ?></td>
										<td class="tbl-name"><?= $AllSaleReport['CreatedDate'] ?></td>
                                        <td class="tbl-date"><?= $AllSaleReport['ColorName'] ?></td>
                                        <td class="tbl-phone"><?= $AllSaleReport['EngineNo'] ?></td>
                                        <td class="tbl-color"><?= $AllSaleReport['ChasisNo'] ?></td>
                                        <td class="tbl-color"><?= $AllSaleReport['PurchaseFrom'] ?></td>
                                        <td class="tbl-phone"><?= $AllSaleReport['CustomerName'] ?></td>
                                        <td class="tbl-phone"><?= $AllSaleReport['VehiclePrice'] ?></td>
                                        <td class="tbl-phone"><?= $AllSaleReport['SellingPrice'] ?></td>
                                        <td class="tbl-phone"><?= $AllSaleReport['SellingPrice'] - $AllSaleReport['VehiclePrice'] ?></td>
                                        <td class="tbl-phone"><?= $AllSaleReport['Percentage'] ?></td>
                                        <td class="tbl-phone"><?= $AllSaleReport['ProfitPercentage'] ?></td>
                                        <td class="tbl-phone"><?= $AllSaleReport['NetProfit'] ?></td>
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
