<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">
            <form class="form animated fadeIn">
                <fieldset>
                    <legend>Invoice List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="17%">Invoice No.</th>
                                    <th width="10%">Pbo Number</th>
                                    <th width="13%">Invoice Amount</th>
                                    <th width="14%">WHT</th>
                                    <th width="14%">Commission</th>
                                    <th width="14%">Delivery Charges</th>
                                    <th width="14%">Donation Charges</th>
                                    <th width="10%">Total Amount</th>
                                    <th width="18%">Invoice Date</th>
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
//                                print_r($InvoiceList);
                                $count = 1;
                                foreach ($InvoiceList as $AllInvoiceList) {
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllInvoiceList['InvoiceNumber'] ?></td>
                                        <td class="tbl-date"><?= $AllInvoiceList['PboNumber'] ?></td>
                                        <td class="tbl-color"><?= $AllInvoiceList['InvoiceAmount'] ?></td>
                                        <td class="tbl-phone"><?= $AllInvoiceList['WHT'] ?></td>
                                        <td class="tbl-variants"><?= $AllInvoiceList['Commission'] ?></td>
                                        <td class="tbl-phone"><?= intval($AllInvoiceList['DeliveryCharges']) ?></td>
                                        <td class="tbl-phone"><?= $AllInvoiceList['DonationCharges'] ?></td>
                                        <td class="tbl-phone"><?= $AllInvoiceList['TotalAmount'] ?></td>
                                        <td class="tbl-phone"><?= $AllInvoiceList['InvoiceDate'] ?></td>
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
    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/pbo/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                console.log(data);
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var items = [];
                        var count = 1;
                        $.each(a, function (i, val) {
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
