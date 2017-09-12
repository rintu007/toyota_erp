<div id="wrapper">
    <style>
        .beau {
            width: 173px;
            height: 32px;
            margin: 10px;
            padding: 20px;
            background: #D3D2B4;
            /*            width: 200px;
                        height: 100px;
                        margin: 10px;
                        padding: 20px;
                        background: #d3d3d3;*/
            /*box-shadow: 0 1px 5px #0061aa, inset 0 10px 20px #b6f9ff;*/
            /*-o-box-shadow: 0 1px 5px #0061aa, inset 0 10px 20px #b6f9ff;*/
            /*-webkit-box-shadow: 0 1px 5px #0061aa, inset 0 10px 20px #b6f9ff;*/
            /*-moz-box-shadow: 0 1px 5px #0061aa, inset 0 10px 20px #b6f9ff;*/
        }

        .beau:hover {
            color: aquamarine;
            background: #9a0a06;
        }

        .beau a {
            font-size: 16px;
            font-weight: 800;
        }
    </style>
    <div id="content">
        <?php
//        if ($this->session->userdata('isAdmin') == 1) {
//            include 'include/admin_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
        ?>
        <div class="right-pnel">
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Parts Reports</legend>
                    <div class="feildwrap" style="margin-left: 22px;">
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/reports/inventory'">
                            <a style=" margin-left: 23px; font-size: 13px;">Inventory Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/reports/order'">
                            <a style=" margin-left: 36px; font-size: 13px;">Order Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/reports/purchase'">
                            <a style=" margin-left: 25px; font-size: 13px;">Purchase Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/reports/sale'">
                            <a style=" margin-left: 40px; font-size: 13px;">Sale Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/dailyorder/report'">
                            <a style=" margin-left: 19px; font-size: 13px;">Daily Order Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/warrantyorder/report'">
                            <a style=" margin-left: 6px; font-size: 13px;">Warranty Order Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/chemicalorder/report'">
                            <a style=" margin-left: 4px; font-size: 13px;">Chemical Order Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/byseaorder/report'">
                            <a style=" margin-left: 14px; font-size: 13px;">By SeaOrder Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/accessoriesorder/report'">
                            <a style=" margin-left: -7px; font-size: 13px;">Accessories Order Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/dhamakapackage/report'">
                            <a style=" margin-left: -1px; font-size: 12px;">Dhamaka Package Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/specialoffer/report'">
                            <a style=" margin-left: -1px; font-size: 13px;">Special Offer Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/planorder/report'">
                            <a style=" margin-left: -1px; font-size: 13px;">Plan Order Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/vor/report'">
                            <a style=" margin-left: -1px; font-size: 13px;">VOR Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/localpurchase/report'">
                            <a style=" margin-left: -1px; font-size: 13px;">Local Package Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/toyotagenuinemotoroil/report'">
                            <a style=" margin-left: -1px; font-size: 13px;">TGMO Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/dpackageorder/report'">
                            <a style=" margin-left: -1px; font-size: 13px;">D Package Reporting</a>
                        </div>
                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/mpackageorder/report'">
                            <a style=" margin-left: -1px; font-size: 13px;">M Package Reporting</a>
                        </div>
						<div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/reports/partwise'">
                            <a style=" margin-left: -1px; font-size: 13px;">Part Wise Reporting</a>
                        </div>

                        <div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/reports/losssalereport'">
                            <a style=" margin-left: -1px; font-size: 13px;">Loss Sale Report</a>
                        </div>
						
						<div class="beau" id="warehouse" style="cursor: pointer;"  onclick="location.href = '<?php echo base_url() ?>index.php/reports/Inventioncontrol'">
                            <a style=" margin-left: -1px; font-size: 13px;">Invention Control Report</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    function doSearch() {
        $('#do').edatagrid('load', {
            PartNumber: $('#idPart').val()
        });
    }

    $(".iType").change(function () {
        if ($(".iType").val() === 'Daihatsu') {
            $(".iFormat").show();
            var items = [];
            items += "<option>Select Order Format</option>";
            items += "<option>Accessories</option>";
            items += "<option>Daily Order</option>";
            items += "<option>D - Package</option>";
            items += "<option>M - Package</option>";
            items += "<option>Imported Package Order</option>";
            items += "<option>Package Order</option>";
            items += "<option>Plan Order</option>";
            items += "<option>Urgent Order</option>";
            items += "<option>VOR Order Work Shop</option>";
            $('.iFormat ').html(items);
        } else if ($(".iType").val() === 'Chemical') {
//form show
        } else if ($(".iType").val() === 'After Sales Warranty') {
//form show
        } else if ($(".iType").val() === 'Inq') {
//form show
        } else if ($(".iType").val() === 'Smr') {
//form show
        } else if ($(".iType").val() === 'Tmo') {
//form show
        }
    });

    $(".iFormat").change(function () {
        if ($(".iFormat").val() === 'Daily Order') {
            $('#dailyorder').show();
            $('#do').edatagrid({
                url: '<?= base_url() ?>/index.php/invoices/allDailyOrders',
                saveUrl: '<?= base_url() ?>/index.php/invoices/saveDailyOrder',
                updateUrl: '<?= base_url() ?>/index.php/parts/edit',
                destroyUrl: 'destroy_user.php',
                onBeforeEdit: function (rowIndex) {
                    setTimeout(function () {
                        $(".datagrid-editable-input").keydown(function (e) {
                            console.log(e.keyCode);
                            if (e.keyCode === 13) {
                                $('#do').edatagrid("endEdit", rowIndex);
                                $('#do').edatagrid('addRow');
//                                    window.location = 'index';
                                $('div.datagrid-cell-c1-OrderNumber').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= $OrderNumber . '-' . $OrderNo['Number'] ++ ?>');
                                $('div.datagrid-cell-c1-Date').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= date('Y/m/d') ?>');
                            }
                        });
                    }, 500);
                }
            });
        } else {
            //else
        }
    });

    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/parts/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
//                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var items = "";
                            $.each(a, function (i, val) {
                                items += "<tr><td class='resId' name='resId'>" + val.Id + "</td>\n\
    <td class='tbl - name'>" + val.FullName + "</td><td>" + val.Username + "</td>\n\
    <td>" + val.Department + "</td><td>" + val.RoleName + "</td><td>" + val.Name + "</td>\n\
    <td><a style='cursor: pointer;' onClick=userPopup('detail', '" + val.Id + "','" + val.FullName + "','" + val.Username + "','" + val.Password + "','" + val.Email + "','" + val.ContactNumber + "','" + val.IdDepartment + "','" + val.RoleId + "','" + val.DateOfBirth + "','" + val.DealerShip + "')> Edit </a> / <a> Delete </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
<td style='border: 0px'></td>");
                }
            }
        });
    });

    function validationform() {
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

    function partPopup(div_id, id, name, variant, quantity) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#PartId").val(id);
            $(this).find("#PartName").val(name);
            $(this).find("select#VariantId").val(variant);
            $(this).find("#Quantity").val(quantity);
        });
    }

</script>