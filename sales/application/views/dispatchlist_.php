<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">
            <form class="form animated fadeIn">
                <fieldset>
                    <legend>Dispatch List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
<!--                                    <th style="vertical-align: middle;" width="7%">S No.</th>-->
                                    <th width="15%">PBO Number</th>
                                    <th width="17%">Model</th>
                                    <th width="10%">Color</th>
                                    <th width="13%">Chassis Number</th>
                                    <th width="14%">Engine Number</th>
                                   
                                    <th width="10%">Price</th>
                                    <th width="18%">Warranty Book</th>
									<th width="10%">Amount Paid</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                                <?php echo $links; ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($DispatchList as $AllDispatchList) {
								 if($AllDispatchList['WHTFiler'] != null) {
                                        $wht = $AllDispatchList['WHTFiler'];
                                    }else $wht = 0;
                                    ?>
                                    <tr id="rbRes">
<!--                                        <td class="resId"><?= $count++ ?></td>-->
                                        <td class="tbl-variants"><?= $AllDispatchList['PboNumber'] ?></td>
                                        <td class="tbl-name"><?= $AllDispatchList['Variants'] ?></td>
                                        <td class="tbl-date"><?= $AllDispatchList['ColorName'] ?></td>
                                        <td class="tbl-color"><?= $AllDispatchList['ChasisNo'] ?></td>
                                        <td class="tbl-phone"><?= $AllDispatchList['EngineNo'] ?></td>
                                         <td class="tbl-phone"><?= intval($AllDispatchList['TotalPrice'])+intval($wht) ?></td>
                                        <td class="tbl-phone"><?= $AllDispatchList['WarrantyBook'] ?></td>
										 <td class="tbl-phone"><?= $AllDispatchList['Balance'] ?></td>
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