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
            <form method="post" class="form animated fadeIn">
                <h3><?= $PboMessage ?></h3>
                <fieldset>
                    <legend>Open PBO</legend>
                    <div class="feildwrap">
                        <div>
                            <!--<span class="required">*</span>-->
                            <label style="margin-left: -135px">Search</label>
                            <input type="text" data-validation="required" name="search" id="search"
                                   placeholder="Search By Name/Cnic/Ntn">
                        </div>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="17%">Name</th>
                                    <th width="10%">Date</th>
                                    <th width="30%">Car</th>
                                    <th width="10%">Color</th>
                                    <th width="10%">Mobile No.</th>
                                    <th width="18%">Detail</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div id="paging">
                                            <ul>
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
                                        <td class="tbl-date"><?= $CarPboResourceBook['Date'] ?></td>
                                        <td class="tbl-variants"><?= $CarPboResourceBook['Variants'] ?></td>
                                        <td class="tbl-color"><?= $CarPboResourceBook['ColorName'] ?></td>
                                        <td class="tbl-phone"><?= $CarPboResourceBook['Cellphone'] ?></td>
                                        <td><a href="<?= base_url() ?>index.php/generatepbo/index/<?= $ResourceBookId ?>">Generate PBO</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div class="btn-block-wrap">
                <form action="uploadPbo" enctype="multipart/form-data" method="post"
                      class="form pbo-form hidden fadeIn">
                    <fieldset>
                        <legend>Add Details</legend>
                        <div class="feildwrap">
                            <table class="form-tbl">
                                <tr>
                                    <td>
                                        <label>ResourceBook ID</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" data-validation="required" id="idRb" name="idRes" value=""
                                               readonly=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Pay Order / Cheque No.</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" data-validation="required" name="payOrderNo" value=""/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Image Upload P.B.O.</label>
                                    </td>
                                    <td colspan="3">
                                        <div class="custom-file-input" id="custom-file-input">
                                            <span class="show-path"></span>
                                            <span class="browse-btn">Browse</span>
                                            <input type="file" data-validation="required" id="uploaded" name="ImgPbo"/>
                                            <?php // echo form_upload('ImgPbo');    ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Date</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" class="date" data-validation="required" style=" width:100px;"
                                               name="date" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Dispatch Note</label>
                                    </td>
                                    <td colspan="3">
                                        <select data-validation="required" name="dispatchNote">
                                            <option>Select Dispach Note</option>
                                            <option value="1000">Dispach Note 1</option>
                                            <option value="1001">Dispach Note 2</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Chasis No.</label>
                                    </td>
                                    <td>
                                        <input type="text" name="chasisNo" data-validation="number" value=""/>
                                    </td>
                                    <td>
                                        <label style=" width:90px; min-width:90px;">Engine No.</label>
                                    </td>
                                    <td>
                                        <input type="text" data-validation="number" name="engineNo" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>&nbsp;</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="checkbox" name="partialAmount" value="1">
                                        <span for="partial_payment">Partial Payment</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Amount</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="text" name="amount" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>&nbsp;</label>
                                    </td>
                                    <td colspan="3">
                                        <input type="submit" class="btn" value="Submit">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Loss Sale Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/pbo/losssale" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">

        <div style="display: none;">
            <label>ReasourceBook ID</label>
            <input type="text" id="idResourceBook" name="idResourceBook">
        </div>
        <br>

        <div>
            <label>Date</label>
            <input type="text" class="date" name="date">
        </div>
        <br>

        <div>
            <label>Reason</label>
            <textarea name="reason" placeholder="Reason of Loss Sale.."></textarea>
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Loss Sale">
        </div>
    </form>
</div>

<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/openpbo/search",
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
<td><a href='<?= base_url() ?>index.php/generatepbo/index/" + val.IdResourceBook + "'>Generate PBO</a></td></tr>";
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

    function rbPopup(div_id, idRb) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idResourceBook").val(idRb);
        });
    }
</script>
