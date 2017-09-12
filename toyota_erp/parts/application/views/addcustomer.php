<div id="wrapper">
    <div id="content">
        <?php
//        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['isAdmin'] == 1) {
        include 'include/sale_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <div>
                
            </div>
            <form name="myform"  method="post"
                  action="<?= base_url() ?>index.php/sales/customer_add" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Customer</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Customer Name</label>
                            <input type="text" name="name" data-validation="required">
                        </div><div>
                            <label>Mobile Number</label>
                            <input type="text" name="mobile" data-validation="required">
                        </div><div>
                            <label>Phone Number</label>
                            <input type="text" name="phone" data-validation="required">
                        </div><div>
                            <label>Address</label>
                            <input type="text" name="address" data-validation="required">
                        </div><div>
                            <label>Jobber</label>
                            <input type="checkbox" name="jobber" data-validation="">
                        </div><div>
                            <label>Fleet</label>
                            <input type="checkbox" name="fleet" data-validation="">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Customer">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Customers List</legend>
                    <div class="feildwrap">
                       <!-- <div>
                            <label>Search by</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Sale Type">
                        </div> -->
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
							
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Customer Name</th>
                                    <th width="10%">Mobile</th>
                                    <th width="10%">Phone</th>
                                    <th width="10%">Address</th>
                                    <th width="10%">Jobber</th>
                                    <th width="10%">Fleet</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                               $count = 1;
                                foreach ($Customers as $Customer) {
                               
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?php echo $Customer['name']?></td>
                                        <td class="tbl-name"><?php echo $Customer['mobile']?></td>
                                        <td class="tbl-name"><?php echo $Customer['phone']?></td>
                                        <td class="tbl-name"><?php echo $Customer['address']?></td>
                                        <td class="tbl-name"><input type="checkbox" <?php echo ($Customer['IsJobber']==1)? "checked":""?> disabled/></td>
                                        <td class="tbl-name"><input type="checkbox" <?php echo ($Customer['IsFleet']==1)? "checked":""?> disabled/></td>
                                       
                                           
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
<!-- Edit Party Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/sales/edittype" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Id Sale</label>
            <input type="text" name="idSaleType" id="idSaleType" data-validation="required">
        </div>
        <div>
            <label>Sale Type</label>
            <input type="text" name="TypeName" id="SaleType" data-validation="required">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Sale Type">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/sales/typesearch",
            type: "POST",
            data: {search: search},
            success: function(data) {
                var a = JSON.parse(data);
                if (a.length > 0) {
                    try {
                        var count = 1;
                        var items = "";
                        $.each(a, function(i, val) {
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.SaleType + "</td>\n\
<td><a style='cursor: pointer;' onClick=SalePopup('detail','" + val.idSaleType + "','" + val.SaleType + "')> Edit </a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>");
                }
            }
        });
    });
    function validationform() {
        var WareHouse = $('#Warehouse').val();
        if (WareHouse === "Select Warehouse") {
            $(".error-warehouse").show();
            return false;
        } else {
            $(".error-warehouse").hide();
        }
        chosen = "";
        pass = $("#pass").val();
        confirm_pass = $("#cpass").val();
        if (pass !== confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }
    }
    function SalePopup(div_id, idSaleType, SaleType) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idSaleType").val(idSaleType);
            $(this).find("#SaleType").val(SaleType);
        });
    }

</script>