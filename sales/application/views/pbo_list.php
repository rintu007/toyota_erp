<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn">
                <h3><?= $PboMessage ?></h3>
                <fieldset>
                    <legend>PBO List</legend>
                    <div class="feildwrap">
                        <div>
                            <label style="margin-left: -135px">Search</label>
                            <input type="text" data-validation="required" name="search" id="search"
                                   placeholder="Search By Name/Pbo Num">
                        </div>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="17%">Name</th>
                                    <th width="10%">PboNumber</th>
                                    <th width="10%">PBO Date</th>                                    
                                    <th width="10%">Engine Number</th>
                                    <th width="10%">Chasis Number</th>
                                    <th width="10%">Booking Amount</th>
                                    <th width="10%">WHT</th>
                                    <th width="10%">Sale Person</th>
                                    <th width="30%">Car</th>
                                    <th width="10%">Color</th>
                                    <th width="10%">Mobile No.</th>
                                    <th width="18%">Detail</th>
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
                                foreach ($ResourceBook as $CarPboResourceBook) {
                                    $ResourceBookId = $CarPboResourceBook['IdResourceBook'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CarPboResourceBook['CustomerName'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['PboNumber'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['Date'] ?></td>                           
                                        <td class="tbl-date"><?= $CarPboResourceBook['EngineNumber'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['ChasisNumber'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['EFAmount'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['FIAmount'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['ActualSalePerson'] ?></td>
                                        <td class="tbl-variants"><?= $CarPboResourceBook['Variants'] ?></td>
                                        <td class="tbl-color"><?= $CarPboResourceBook['ColorName'] ?></td>
                                        <td class="tbl-phone"><?= $CarPboResourceBook['Cellphone'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>index.php/pbo_list/printPBO/<?= $CarPboResourceBook['Id'] ?>">print</a>
                                            <a href="<?= base_url() ?>index.php/pbo/getPBO/<?= $CarPboResourceBook['Id'] ?>">View</a>
                                            <?php if ($CarPboResourceBook['DispatchCreated'] == '0') { ?>
                                                <a href="<?= base_url() ?>index.php/pbo/editPBO/<?= $CarPboResourceBook['Id'] ?>">Edit</a>
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
