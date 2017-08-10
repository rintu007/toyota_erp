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
            <form class="form animated fadeIn">
                <fieldset>
                    <legend>Invoice List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="">Invoice No.</th>
                                    <th width="">Pbo Number</th>
                                    <th width="">Dispatch Number</th>
                                    <th width="">Certificate No.</th>
                                    <th width="">Model Year</th>
                                    <th width="">Received From</th>
                                    <th width="">Invoice Amount</th>
                                    <th width="">Invoice Date</th>
                                    <th>Action</th>
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
                                foreach ($InvoiceList as $AllInvoiceList) {
								
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllInvoiceList['InvoiceNumber'] ?></td>
                                        <td class="tbl-date"><?= $AllInvoiceList['PboNumber'] ?></td>
                                        <td class="tbl-date"><?= $AllInvoiceList['DispatchId'] ?></td>
                                        <td class="tbl-color"><?= $AllInvoiceList['CertificateNumber'] ?></td>
                                        <td class="tbl-phone"><?= $AllInvoiceList['ModelYear'] ?></td>
                                        <td class="tbl-variants"><?= $AllInvoiceList['ReceivedFrom'] ?></td>
                                        <td class="tbl-phone"><?= intval($AllInvoiceList['InvoiceAmount'])?></td>
                                        <td class="tbl-phone"><?= $AllInvoiceList['InvoiceDate'] ?></td>
                                        <td>
                                            <?php if($AllInvoiceList['idpds']==null){?>
                                            <button class=""><a href="<?=site_url("index.php/invoice/pds/").'/'.$AllInvoiceList['DispatchId']?>">PDS</a></button>
                                            <?php }?>
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
