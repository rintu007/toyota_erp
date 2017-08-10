<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';

        if($this->session->flashdata('message')){
            ?>
        <div>
            <h1 class="fadeIn" style="background: green;text-align: center;font-size: xx-large;">
                <?= $this->session->flashdata('message')?>
            </h1>
        </div>
       <?php } ?>


        <div class="right-pnel">
            <a href="<?=base_url("index.php/dispatch/dispatchReceive_list")?>">Receive List</a>
            <form class="form animated fadeIn">
                <fieldset>
                    <legend>Dispatch List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="15%">PBO Number</th>
                                    <th width="15%">Dispatch Number</th>
                                    <th width="15%">Dispatch Number Date</th>
                                    <th width="17%">Model</th>
                                    <th width="10%">Color</th>
                                    <th width="13%">Chassis Number</th>
                                    <th width="14%">Engine Number</th>
                                   
                                    <th width="10%">Price</th>
                                    <th width="18%">Warranty Book</th>
									<th width="10%">Amount Paid</th>
                                    <th width="10%">Type</th>
                                     <th width="10%">Action</th>
                                    
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
                                <td colspan="15">
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
                                foreach ($DispatchList as $AllDispatchList) {
								 if($AllDispatchList['WHTFiler'] != null) {
                                        $wht = $AllDispatchList['WHTFiler'];
                                    }else $wht = 0;
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $page++ ?></td>
                                        <td class="tbl-variants"><?= $AllDispatchList['PboNumber'] ?></td>
                                        <td class="tbl-variants"><?= $AllDispatchList['idDispatch'] ?></td>
                                        <td class="tbl-variants"><?= $AllDispatchList['DispatchedDate'] ?></td>
                                        <td class="tbl-name"><?= $AllDispatchList['Variants'] ?></td>
                                        <td class="tbl-date"><?= $AllDispatchList['ColorName'] ?></td>
                                        <td class="tbl-color"><?= $AllDispatchList['ChasisNo'] ?></td>
                                        <td class="tbl-phone"><?= $AllDispatchList['EngineNo'] ?></td>
                                         <td class="tbl-phone"><?= intval($AllDispatchList['TotalPrice'])+intval($wht) ?></td>
                                        <td class="tbl-phone"><?= $AllDispatchList['WarrantyBook'] ?></td>
										 <td class="tbl-phone"><?= $AllDispatchList['Balance'] ?></td>
                                         <td class="tbl-phone"><?= $AllDispatchList['DispatchType'] ?></td>
                                        <td class="tbl-phone">
                                            <?php if(!$AllDispatchList['receiveid']){?>

                                            <button><a href="<?= base_url("index.php/dispatch/dispatchReceive")."/".$AllDispatchList['idDispatch'] ?>">Receive</a></button>
                                        <?php } ?>
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
