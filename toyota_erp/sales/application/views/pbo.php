<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
        ?>
        <div class="right-pnel">
            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/generatereport/report">
                <h3><?= $PboMessage ?></h3>
                <fieldset>
                    <legend>Search</legend>
                    <div class="feildwrap">
                        <div>
                            <label style="/*margin-left: -135px*/">Search</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Pbo Number">
                        </div>
                        <br>
                        <div>
                            <label style="/*margin-left: -66px;*/">Search</label>
                            <br>
                            <br>
                            <div style="margin-left: 132px;">
                                <input type="checkbox" class="cbCity" value="City" id="" /> By City
                                <input type="checkbox" class="cbContactType" value="ContactType" /> By Contact Type
                                <input type="checkbox" class="cbColor" value="Color" /> By Color
                                <input type="checkbox" class="cbCompanyName" value="CompanyName"/> By Company Name
                                <input type="checkbox" class="cbCustomerType" value="CustomerType"/> By Customer Type
                                <input type="checkbox" class="cbCustomerName" value="CustomerName"/> By Customer Name
                                <input type="checkbox" class="cbCustomerStatus" value="CustomerStatus"/> By Customer Status
                                <br>
                                <?php
                                if ($cookieData["Role"] == 'Director' || $cookieData["Role"] == 'Admin' || $cookieData["Role"] == 'CEO' || $cookieData["Role"] == 'Senior Director') {
                                    ?>
                                    <input type="checkbox" class="cbDealer" value="Dealer"/> By Dealer
                                    <?php
                                }
                                ?>
                                <input type="checkbox" class="cbModel" value="Model"/> By Model
                                <input type="checkbox" class="cbPayment" value="Payment"/> By Payment
                                <input type="checkbox" class="cbProvince" value="Province"/> By Province
                                <input type="checkbox" class="cbVariant" value="Variant"/> By Variant
                                <?php
                                if ($cookieData["Role"] == 'Director' || $cookieData["Role"] == 'Admin' || $cookieData["Role"] == 'CEO' || $cookieData["Role"] == 'Senior Director' || $cookieData["Role"] == 'Manager') {
                                    ?>    
                                    <input type = "checkbox" class = "cbSalesman" value = "Salesman"/> By Salesman
                                    <?php
                                }
                                ?>
                            </div>

                            <input type="text" name="filter[]" class="City filter" placeholder="Search By City">
                            <select name="filter[]" class="ContactType filter">
                                <option value="">Select Contact Type</option>
                                <?php
                                foreach ($contact_type as $CType) {
                                    ?>
                                    <option value="<?= $CType['ContactType'] ?>" ><?= $CType['ContactType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="filter[]" class="Color filter">
                                <option value="">Select Color</option>
                                <?php
                                foreach ($color_choice_one as $Color) {
                                    ?>
                                    <option value="<?= $Color['ColorName'] ?>" ><?= $Color['ColorName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="text" name="filter[]" class="CompanyName filter" placeholder="Search By Company Name">
                            <select name="filter[]" class="CustomerType filter">
                                <option value="">Select Customer Type</option>
                                <?php
                                foreach ($customertype as $CType) {
                                    ?>
                                    <option value="<?= $CType['CustomerType'] ?>" ><?= $CType['CustomerType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="text" name="filter[]" class="CustomerName filter" placeholder="Search By Customer Name">
                            <select name="filter[]" class="CustomerStatus filter">
                                <option value="">Select Customer Status</option>
                                <?php
                                foreach ($CustomerStatus as $CStatus) {
                                    ?>
                                    <option value="<?= $CStatus['StatusType'] ?>" ><?= $CStatus['StatusType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="filter[]" class="Dealer filter">
                                <option value="">Select Dealer</option>
                                <?php
                                foreach ($Dealer as $Dealers) {
                                    ?>
                                    <option value="<?= $Dealers['Dealer'] ?>" ><?= $Dealers['Dealer'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="filter[]" class="Model filter">
                                <option value="">Select Model</option>
                                <?php
                                foreach ($model as $CarModel) {
                                    ?>
                                    <option value="<?= $CarModel['Model'] ?>" ><?= $CarModel['Model'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="filter[]" class="Payment filter">
                                <option value="">Select Payment Type</option>
                                <?php
                                foreach ($payment_mode as $Payment) {
                                    ?>
                                    <option value="<?= $Payment['PaymentType'] ?>" ><?= $Payment['PaymentType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                            echo form_dropdown('filter[]', $Province, '', 'class="Province filter"');
                            ?>
                            <select name="filter[]" class="Variant filter">
                                <option value="">Select Variant</option>
                                <?php
                                foreach ($vehicle_interst as $Variants) {
                                    ?>
                                    <option value="<?= $Variants['Variants'] ?>" ><?= $Variants['Variants'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="filter[]" class="Salesman filter">
                                <option value="">Select Salesman</option>
                                <?php
                                foreach ($Salesman as $SalesMan) {
                                    ?>
                                    <option value="<?= $SalesMan['Id'] ?>" ><?= $SalesMan['FullName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="filter[]" class="Dealership filter">
                                <option value="">Select DealerShip</option>
                                <?php
                                foreach ($Dealership as $DealerShip) {
                                    ?>
                                    <option value="<?= $DealerShip['Id'] ?>" ><?= $DealerShip['DealerName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
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
                            <!--<input type="image" name="pdf" src="<?= base_url(); ?>assets/images/generate.png" style="margin-bottom: -14px;height: 23px;" class="">-->
                            <input type="submit" value="Generate PDF" name="pdf"  style="margin-bottom: -14px;height: 30px;">
                            <input type="submit" value="Export Excel Report" name="excel" style="margin-bottom: -14px;height: 30px;">
                            <!--<input type="image" name="excel" src="<?= base_url(); ?>assets/images/excelexport.png" style="margin-bottom: -14px;height: 23px;" class="">-->
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
                    <legend>Resource Book List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="10%">Date</th>
                                    <th width="7%">Resource Book No</th>

                                    <?php
                                    if ($cookieData["Role"] == 'Director' || $cookieData["Role"] == 'Admin' || $cookieData["Role"] == 'CEO' || $cookieData["Role"] == 'Senior Director' || $cookieData["Role"] == 'Manager') {
                                        ?>
                                        <th width="17%">Salesman</th>
                                        <?php
                                    }
                                    ?>
                                    <th width="17%">Customer Name</th>
                                    <th width="10%">Mobile No.</th>
                                    <th width="10%">Birth Date</th>

                                    <th width="20%">Variant Interested</th>
                                    <th width="10%">Color</th>
                                    <th width="10%">Delivery Month</th>
                                    <th width="18%">Detail</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    
                                    <td colspan="9">
                                        <div id="paging">
                                            <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                                Total : <?php echo $counts ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
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
                                foreach ($ResourceBook as $CarPboResourceBook) {
                                    $ResourceBookId = $CarPboResourceBook['IdResourceBook'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>

                                        <td class="tbl-date"><?= $CarPboResourceBook['Date'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['IdResourceBook'] ?></td>

                                        <?php
                                        if ($cookieData["Role"] == 'Director' || $cookieData["Role"] == 'Admin' || $cookieData["Role"] == 'CEO' || $cookieData["Role"] == 'Senior Director' || $cookieData["Role"] == 'Manager') {
                                            ?>
                                            <td class="tbl-name"><?= $CarPboResourceBook['FullName'] ?></td>
                                            <?php
                                        }
                                        ?>
                                        <td class="tbl-name"><?= $CarPboResourceBook['CustomerName'] ?></td>
                                        <td class="tbl-phone"><?= $CarPboResourceBook['Cellphone'] ?></td>
                                        <td class="tbl-phone"><?= $CarPboResourceBook['DateOfBirth'] ?></td>

                                        <td class="tbl-variants"><?= $CarPboResourceBook['Variants'] ?></td>
                                        <td class="tbl-color"><?= $CarPboResourceBook['ColorName'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['DeliveryMonth'] ?></td>

                                        <td>
                                            <a href="<?= base_url() ?>index.php/quotation/index/<?= $ResourceBookId ?>">Quotation</a> /
                                            <?php if (($CarPboResourceBook['IsLost'] == 0) && ($CarPboResourceBook['isPboCreated'] == 0)) { ?>                                               
                                                <a style="cursor: pointer;" onClick="rbPopup('detail', <?= $ResourceBookId ?>)">Lost Sale</a> / 
                                                <a href="../resourcebook/update/<?= $ResourceBookId ?>"> Edit </a> 
                                            <?php } else { ?> 
                                                <a href="../resourcebook/show/<?= $ResourceBookId ?>">View</a> 
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
                                            <?php // echo form_upload('ImgPbo');      ?>
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
            <input type="text" id="idResourceBook" name="idResourceBook" >
        </div>
        <br>

        <div>
            <label>Date</label>
            <input type="text" class="date" name="date">
        </div>
        <br>

        <div>
            <label>Loss Sale Reason</label>
            <select id="DispatchType" name="dispatch" class="reasonType">
                <option value="Select One">Select One</option>
                <option value="Open Stock">Open Stock</option>
                <option value="Pbo">Pbo</option>
            </select>
        </div>
        <br>

        <div>
            <label>Reason</label>
            <textarea name="reason" class="reason" placeholder="Reason of Loss Sale.."></textarea>
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" id="reasonBtn" class="btn" value="Loss Sale">
        </div>
    </form>
</div>

<script>

//    $("#SearchReport").change(function() {
    $(".cbCity").change(function () {
        if (this.checked) {
            $(".City").show();
        } else {
            $(".City").val("");
            $(".City").hide();
        }
    });

    $(".cbSalesman").change(function () {
        if (this.checked) {
            $(".Salesman").show();
        } else {
            $(".Salesman").val("");
            $(".Salesman").hide();
        }
    });

    $(".cbContactType").change(function () {
        if (this.checked) {
            $(".ContactType").show();
        } else {
            $(".ContactType").val("");
            $(".ContactType").hide();
        }
    });

    $(".cbCustomerType").change(function () {
        if (this.checked) {
            $(".CustomerType").show();
        } else {
            $(".CustomerType").val("");
            $(".CustomerType").hide();
        }
    });

    $(".cbCustomerStatus").change(function () {
        if (this.checked) {
            $(".CustomerStatus").show();
        } else {
            $(".CustomerStatus").val("");
            $(".CustomerStatus").hide();
        }
    });

    $(".cbColor").change(function () {
        if (this.checked) {
            $(".Color").show();
        } else {
            $(".Color").val("");
            $(".Color").hide();
        }
    });

    $(".cbModel").change(function () {
        if (this.checked) {
            $(".Model").show();
        } else {
            $(".Model").val("");
            $(".Model").hide();
        }
    });

    $(".cbPayment").change(function () {
        if (this.checked) {
            $(".Payment").show();
        } else {
            $(".Payment").val("");
            $(".Payment").hide();
        }
    });

    $(".cbVariant").change(function () {
        if (this.checked) {
            $(".Variant").show();
        } else {
            $(".Variant").val("");
            $(".Variant").hide();
        }
    });

    $(".cbDealer").change(function () {
        if (this.checked) {
            $(".Dealer").show();
        } else {
            $(".Dealer").val("");
            $(".Dealer").hide();
        }
    });

    $(".cbProvince").change(function () {
        if (this.checked) {
            $(".Province").show();
        } else {
            $(".Province").val("");
            $(".Province").hide();
        }
    });

    $(".cbCustomerName").change(function () {
        if (this.checked) {
            $(".CustomerName").show();
        } else {
            $(".CustomerName").val("");
            $(".CustomerName").hide();
        }
    });

    $(".cbCompanyName").change(function () {
        if (this.checked) {
            $(".CompanyName").show();
        } else {
            $(".CompanyName").val("");
            $(".CompanyName").hide();
        }
    });

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
<?php
if ($cookieData["Role"] == 'Director' || $cookieData["Role"] == 'Admin' || $cookieData["Role"] == 'CEO' || $cookieData["Role"] == 'Senior Director' || $cookieData["Role"] == 'Manager') {
    ?><td class='tbl-name'>" + val.FullName + "</td><?php } ?><td class='tbl-name'>" + val.CustomerName + "</td><td>" + val.Date + "</td>\n\
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

    function rbPopup(div_id, idRb) {
        $.ajax({
            url: "<?= base_url() ?>index.php/pbo/getlossSale",
            type: "POST",
            data: {idRb: idRb},
            success: function (data) {


                var a = JSON.parse(data);
                console.log(a);
                if (a.length > 0) {
                    try {
                        var html = '';
                        $('.reasonType').empty();
                        html = '<option value="Select One">' + a[0].reason_type + '</option>';
                        $('.reasonType').append(html);
                        $('.date').val(a[0].Date);
                        $('.reason').val(a[0].Reason);
                        $('#reasonBtn').prop('disabled', true);
//                        $(':input[type="submit"]')
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $('.date').val();
                    $('.reason').val();
                    $('#reasonBtn').prop('disabled', false);
                }
            }
        });
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
            $(this).find("#idResourceBook").val(idRb);
        });
    }

    $(".excelReport").click(function () {
        var fDate = $("input[name=fromDate]").val();
        var tDate = $("input[name=toDate]").val();
//        var Search = new Array();
//        $('.filter').each(function() {
//            Search.push = $(this).val();
//        });
//        console.log(Search);
        var Search = [$("input[name=search]").val()];
        var url = "<?= base_url() ?>index.php/excel/index";
        $.ajax({
            url: url,
            type: 'POST',
            data: {Search: Search, ToDate: tDate, FromDate: fDate},
            success: function (data) {
                console.log(fDate);
                console.log(tDate);
                console.log(Search);
//                console.log();
//                window.open(url);
            }
        });
//        window.open(url + "?fromDate=" + fDate + "&toDate=" + tDate);
    });

    $(".generateReport").click(function () {
        var fDate = $("input[name=fromDate]").val();
        var tDate = $("input[name=toDate]").val();
        var City = $("input[name=reportByCity]").val();
        var ContactType = $("input[name=reportByContactType]").val();
        var Color = $("input[name=reportByColor]").val();
        var CustomerType = $("input[name=reportByCustomerType]").val();
        var CustomerStatus = $("input[name=reportByCustomerStatus]").val();
        var Model = $("input[name=reportByModel]").val();
        var Payment = $("input[name=reportByPayment]").val();
        var Variant = $("input[name=reportByVariant]").val();
        var Dealer = $("input[name=reportByDealer]").val();
        var Province = $("input[name=reportByProvince]").val();
        var CustomerName = $("input[name=reportByCustomerName]").val();
        var CompanyName = $("input[name=reportByCompanyName]").val();
        var url = "<?= base_url() ?>index.php/generatereport/index";
        if (City !== "") {
//            $.ajax({
//                url: url,
//                type: 'POST',
//                data: {City: City, ToDate: tDate, FromDate: fDate},
//                success: function(data) {
//                    console.log(data);
//                }
//            });
            window.open(url + "?reportByCity=" + City + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
//            window.open(url);
            $("input[name=reportByCity]").val("");
        } else if (ContactType !== "") {
            console.log(ContactType);
            window.open(url + "?reportByContactType=" + ContactType + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByContactType]").val("");
        } else if (Color !== "") {
            console.log(Color);
            window.open(url + "?reportByColor=" + Color + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByColor]").val("");
        } else if (CustomerType !== "") {
            console.log(CustomerType);
            window.open(url + "?reportByCustomerType=" + CustomerType + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByCustomerType]").val("");
        } else if (CustomerStatus !== "") {
            console.log(CustomerStatus);
            window.open(url + "?reportByCustomerStatus=" + CustomerStatus + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByCustomerStatus]").val("");
        } else if (Model !== "") {
            console.log(Model);
            window.open(url + "?reportByModel=" + Model + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByModel]").val("");
        } else if (Payment !== "") {
            console.log(Payment);
            window.open(url + "?reportByPayment=" + Payment + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByPayment]").val("");
        } else if (Variant !== "") {
            console.log(Variant);
            window.open(url + "?reportByVariant=" + Variant + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByVariant]").val("");
        } else if (Province !== "") {
            console.log(Province);
            window.open(url + "?reportByProvince=" + Province + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByProvince]").val("");
        } else if (Dealer !== "") {
            console.log(Dealer);
            window.open(url + "?reportByDealer=" + Dealer + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByDealer]").val("");
        } else if (CustomerName !== "") {
            console.log(CustomerName);
            window.open(url + "?reportByCustomerName=" + CustomerName + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByCustomerName]").val("");
        } else if (CompanyName !== "") {
            console.log(CompanyName);
            window.open(url + "?reportByCompanyName=" + CompanyName + "&fromDate=" + fDate + "&toDate=" + tDate, '_blank');
            $("input[name=reportByCompanyName]").val("");
        } else {
            window.open(url + "?fromDate=" + fDate + "&toDate=" + tDate, '_blank');
        }
    });
</script>
