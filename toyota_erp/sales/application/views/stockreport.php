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
            <form class="form animated fadeIn"  method="post" action="<?= base_url() ?>/index.php/stockreport/index" >
                <div class="feildwrap">
                    <div class="">
                        <label>Dispatch Number</label>
                        <input type="text" data-validation="" name="idDispatch"
                               value="<?= isset($_POST['idDispatch']) ? $_POST['idDispatch'] : '' ?>"
                               placeholder="Search By Dispatch">
                    </div>
                    <div class="">
                        <label>PboNumber</label>
                        <input type="text" data-validation="" name="PboNumber"
                               value="<?= isset($_POST['pboid']) ? $_POST['pboid'] : '' ?>"
                               placeholder="Search By Name/Pbo Num">
                    </div>
                    <div class="">
                        <label>Chasis Number</label>
                        <input type="text" data-validation="" name="ChasisNo"
                               value="<?= isset($_POST['ChasisNo']) ? $_POST['ChasisNo'] : '' ?>"
                               placeholder="Search By Chasis Number">
                    </div>
                    <div class="">
                        <label>Engine Number</label>
                        <input type="text" data-validation="" name="EngineNo"
                               value="<?= isset($_POST['EngineNo']) ? ($_POST['EngineNo']) : '' ?>"
                               placeholder="Search By Engine Number">
                    </div>
                    <div class="">
                        <label>Customer Name</label>
                        <input type="text" data-validation="" name="CustomerName"
                               value="<?= isset($_POST['CustomerName']) ? $_POST['CustomerName'] : '' ?>"
                               placeholder="Search By Customer Name">
                    </div>

                    <input type="submit" value="search" class="btn">
                </div>
                <fieldset>
                    <legend>Stock List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="2%">S No.</th>
                                    <th width="5%">PBO Number</th>
                                    <th width="5%">Dispatch Number</th>
                                    <th width="5%">Receiving Number</th>
                                    <th width="10%">Receiving Date</th>
                                    <th width="10%">Chassis Number</th>
                                    <th width="12%">Engine Number</th>

                                    <th width="15%">Model</th>
                                    <th width="5%">Color</th>
                                    <th width="15%">Customer name</th>

                                    <th width="5%">Warranty Book</th>
                                    <th width="20%"></th>
                                </tr>
                            </thead>
                            <tfoot>
                            <tr>

                                <td colspan="15">
                                    <div id="paging">
                                        <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                            Total : <?php echo $counts ?>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="13">
                                    <div id="paging">
                                        <ul>
                                            <?php echo $links ?>
                                        </ul>
                                    </div>
                            </tr>
                            </tfoot>

                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($StockReport as $AllStockReport) {
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $page++ ?></td>
                                        <td class="tbl-variants"><?= $AllStockReport['PboNumber'] ?></td>
                                        <td class="tbl-variants"><?= $AllStockReport['idDispatch'] ?></td>
                                        <td class="tbl-variants"><?= $AllStockReport['idreceive'] ?></td>
                                        <td class="tbl-variants"><?= $AllStockReport['receivedate'] ?></td>
                                        <td class="tbl-color"><?= $AllStockReport['ChasisNo'] ?></td>
                                        <td class="tbl-phone"><?= $AllStockReport['EngineNo'] ?></td>
                                        <td class="tbl-name"><?= $AllStockReport['Variants'] ?></td>
                                        <td class="tbl-date"><?= $AllStockReport['ColorName'] ?></td>
                                        <td class="tbl-date"><?= $AllStockReport['CustomerName'] ?></td>

                                        <td class="tbl-phone"><?= $AllStockReport['WarrantyBook'] ?></td>
                                        <td class="tbl-phone">
                                            <?php  if(!$AllStockReport['Pdi']){ ?>
                                            <button><a  href="<?=site_url('index.php/stockReport/pdi/').'/'.$AllStockReport['idDispatch']?>">PDI</a></button>
                                            <?php }?>

                                            <?php  if(!$AllStockReport['idpds']){
                                            if($AllStockReport['pds_request']){?>
                                                <br> <a>  Request Sent for PDS </a>
                                            <?php }else{?>
                                            <button><a onclick="return confirm('Do you want to send request for PDS?')" href="<?=site_url('index.php/invoice/pds_request').'/'.$AllStockReport['idDispatch']?>">Request for PDS</a></button>
                                            <?php }}else{
                                                echo "<br> <a>  OK for Delivery</a>";
                                            }?>
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
