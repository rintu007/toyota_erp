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
        if($this->session->flashdata('message')){
            ?>
            <div>
                <h1 class="fadeIn" style="background: green;text-align: center;font-size: xx-large;">
                    <?= $this->session->flashdata('message')?>
                </h1>
            </div>
        <?php } ?>

        <div class="right-pnel">
            <a href="<?=site_url("index.php/stockreport/pdi_list/")?>">PDI View</a>

            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/stockreport/report">
                <fieldset>
                    <legend>Stock Report</legend>
                    <div class="feildwrap">
                        <div>
                            <label style="/*margin-left: -135px*/">Search</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Pbo Number">
                        </div>
                        <br>
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
                    <legend>Stock List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="2%">S No.</th>
                                    <th width="17%">Model</th>
                                    <th width="10%">Color</th>
                                    <th width="13%">Chassis Number</th>
                                    <th width="14%">Engine Number</th>
                                    <th width="15%">PBO Number</th>
                                    <th width="15%">Dispatch Number</th>
                                    <th width="10%">Invoice</th>
                                    <th width="12%">Warranty Book</th>
                                    <th width="18%"></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
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
                                foreach ($StockReport as $AllStockReport) {
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllStockReport['Variants'] ?></td>
                                        <td class="tbl-date"><?= $AllStockReport['ColorName'] ?></td>
                                        <td class="tbl-color"><?= $AllStockReport['ChasisNo'] ?></td>
                                        <td class="tbl-phone"><?= $AllStockReport['EngineNo'] ?></td>
                                        <td class="tbl-variants"><?= $AllStockReport['PboNumber'] ?></td>
                                        <td class="tbl-variants"><?= $AllStockReport['idDispatch'] ?></td>
                                        <td class="tbl-phone"><?= $AllStockReport['TotalPrice'] ?></td>
                                        <td class="tbl-phone"><?= $AllStockReport['WarrantyBook'] ?></td>
                                        <td class="tbl-phone">
                                            <?php  if(!$AllStockReport['Pdi']){ ?>
                                            <button><a  href="<?=site_url('index.php/stockReport/pdi/').'/'.$AllStockReport['idDispatch']?>">PDI</a></button>
                                            <?php }?>
                                        </td>
<!--                                        <td class="tbl-phone"><button><a onclick="return confirm('Are you sure for Sale Return?')" href="--><?//=site_url('index.php/stockReport/insert_salereturn/').'/'.$AllStockReport['idDispatch']?><!--">Sale Return</a></button></td>-->
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
                            <td class='tbl-name'>" + val.Variants + "</td><td>" + val.ColorName + "</td>\n\
<td>" + val.ChasisNo + "</td><td>" + val.EngineNo + "</td><td>" + val.PboNumber + "</td><td>" + val.TotalPrice + "</td><td>" + val.WarrantyBook + "</td>\n\
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
