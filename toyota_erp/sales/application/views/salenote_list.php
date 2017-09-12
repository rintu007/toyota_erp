<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">
            <form method="post" action="<?=site_url('index.php/salenote/getAllSaleNote/')?>" class="form animated fadeIn">
                <h3><?= $PboMessage ?></h3>
                <fieldset>
                    <legend>Sale Note List</legend>
                    <div class="feildwrap">
                        <div class="">
                            <label>Dispatch ID</label>
                            <input type="text" data-validation="" name="Dispatch"
                                   value="<?= isset($_POST['Dispatch']) ? $_POST['Dispatch'] : '' ?>"
                                   placeholder="Search ByDispatch">
                        </div>

                        <div class="">
                            <label>Customer Name</label>
                            <input type="text" data-validation="" name="CustomerName"
                                   value="<?= isset($_POST['CustomerName']) ? $_POST['CustomerName'] : '' ?>"
                                   placeholder="Search By Customer Name">
                        </div>

                        <input type="submit" value="search" class="btn">
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="17%">Dispatch Number</th>
                                    <th width="17%">Customer Name</th>
                                    <th width="10%">Vehicle Price</th>
                                    <th width="10%">Purchase Price</th>                                    
                                    <th width="">Selling Price</th>
                                    <th width="">Profit Percentage</th>
                                    <th width="">Percentage</th>

                                    <th width="">Net Profit</th>
                                    <th width="">Purchase From</th>

                                    <th width="">Sale Person</th>


                                    <th width="18%">Date</th>
                                    <th width="">Status</th>
                                </tr>
                            </thead>
                            <tfoot>
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
                                foreach ($SaleNoteList as $SaleNoteList) {
//                                    $ResourceBookId = $CarPboResourceBook['IdResourceBook'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $page++ ?></td>
                                        <td class="tbl-name"><?= $SaleNoteList['Dispatch'] ?></td>
                                        <td class="tbl-name"><?= $SaleNoteList['CustomerName'] ?></td>
                                        <td class="tbl-date"><?= $SaleNoteList['VehiclePrice'] ?></td>
                                        <td class="tbl-date"><?= $SaleNoteList['PurchasePrice'] ?></td>                           
                                        <td class="tbl-date"><?= $SaleNoteList['SellingPrice'] ?></td>
                                        <td class="tbl-date"><?= $SaleNoteList['ProfitPercentage'] ?></td>
                                        <td class="tbl-date"><?= $SaleNoteList['Percentage'] ?></td>
                                        <td class="tbl-date"><?= $SaleNoteList['NetProfit'] ?></td>
                                        <td class="tbl-date"><?= $SaleNoteList['PurchaseFrom'] ?></td>
                                        <td class="tbl-variants"><?= $SaleNoteList['SalePerson'] ?></td>

                                        <td class="tbl-phone"><?= $SaleNoteList['CreatedDate'] ?></td>
                                        <td>

                                            <a href="<?= base_url() ?>index.php/salenote/update/<?= $SaleNoteList['idSaleNote'] ?>">View</a>

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
//    $("#search").keyup(function () {
//        var search = $("#search").val();
//        $.ajax({
//            url: "<?= base_url() ?>index.php/pbo_list/search",
//            type: "POST",
//            data: {search: search},
//            success: function (data) {
//                console.log(data);
//                var a = JSON.parse(data);
//                if (a.length > 0) {
//                    try {
//                        var items = [];
//                        var count = 1;
//                        $.each(a, function (i, val) {
//                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
//                            <td class='tbl-name'>" + val.CustomerName + "</td><td>" + val.Date + "</td>\n\
//<td>" + val.PboNumber + "</td><td>" + val.Variants + "</td><td>" + val.ColorName + "</td><td>" + val.Cellphone + "</td>\n\
//</tr>";
//                        });
//                        $('#finalResult').html(items);
//                    } catch (e) {
//                        console.log(e);
//                    }
//                } else {
//                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
//                            "<td style='border: 0px'>No Data Found</td><td style='border: 0px'></td><td style='border: 0px'></td>");
//                }
//            }
//        });
//    });


    $(document).ready(function () {
        jQuery.expr[':'].contains = function (a, i, m) {
            return jQuery(a).text().toUpperCase()
                    .indexOf(m[3].toUpperCase()) >= 0;
        };
        $('#search').keyup(function () {
            var search = $(this).val();
            if (search == "") {
                $("tbody tr").show();
            } else {
                $("tbody tr").hide();
                $("tr .tbl-name:contains(" + search + "),tr .tbl-date:contains(" + search + ")").parent().show();
            }


        });


    });

    function rbPopup(div_id, idRb) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
            $(this).find("#idResourceBook").val(idRb);
        });
    }
</script>
