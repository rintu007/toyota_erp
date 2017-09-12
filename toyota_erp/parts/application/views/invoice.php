<div id="wrapper">
    <style>
        .beau {
            width: 118px;
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
        }
    </style>
    <div id="content">
        <?php
//         $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['isAdmin'] == 1) {
        include 'include/order_leftmenu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <h2 style="margin: 60px;font-size: x-large;"><?= $message ?></h2>
         
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>New Order</legend>
                    <div class="feildwrap custom-feild-wrap" style="margin-left: 40px;">
                        <?php
                        foreach ($OrderModes as $AllOrderModes) {
                            ?>
                        <div class="beau" id="warehouse" style="cursor: pointer;" onclick="selectBrand('detail', ' <?php echo str_replace(" ", "", strtolower($AllOrderModes['Title'])) ?>/index')">
                                <a style=" margin-left: 6px; font-size: 13px"><?= $AllOrderModes['Title'] ?></a>
                            </div>
                        <?php }
                        ?>
                    </div>
                </fieldset>
            </form>
            <div style="width: 750px;" class="feildwrap  popup popup-detail">
                <form id="brandForm" action="" method="POST" class="form animated fadeIn" onSubmit="return validationform()" style="width: 250px;">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="margin-left: 25px;width: 0px;">
                        <fieldset style="height:200px;">
                            <legend>Select Brand</legend>
                            <div class="feildwrap" style="margin-left: 225px;">
                                <div>
                                    <select id="BrandCode" name="BrandCode" style="margin-left: -50px;">
                                        <option>Select Brand</option>
                                        <?php
                                        foreach ($brandCombo as $brand) {
                                            ?>
                                            <option value="<?php echo $brand['ShortCode'] ?>" ><?php echo $brand['ParentName'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select><br><br>
                                    <span class="error-slctbrand cb-error help-block">Select Option</span>
                                </div>
                                <div style="float: right;margin-left: 25px;">
                                    <input id="OK" type="submit" class="btn" value="OK" style="width: 100px;">
                                </div>  
                            </div>                        
                        </fieldset>
                    </div><br>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/parts/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    //                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var items = "";
                            $.each(a, function(i, val) {
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

    function doSearch() {
        $('#do').edatagrid('load', {
            PartNumber: $('#idPart').val()
        });
    }

    function validationform() {
        var brandSlct = $('#BrandCode').val();
        if (brandSlct === "Select Brand")
        {
            $(".error-slctbrand").show();
            return false;
        } else {
            $(".error-slctbrand").hide();
            return true;
        }
    }

    function selectBrand(div_id, orderMode) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            var navigateTo = window.location.href;
            navigateTo = navigateTo.substring(0, navigateTo.indexOf(".php") + 5);
            var linkTo = navigateTo + orderMode;
            linkTo = linkTo.replace(" ", "");
            document.getElementById("brandForm").action = linkTo;
        });
    }

//   function selectBrand(div_id, orderMode) {
//        $('.popup-' + div_id).bPopup({
//            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
//            followSpeed: 1500, //can be a string ('slow'/'fast') or int
//            modalColor: '#333',
//            closeClass: 'close-pop'
//        }, function() {
//            var navigateTo = window.location.href;
//            navigateTo = navigateTo.substring(0, navigateTo.indexOfnavigateTo(".php") + 5);
//            document.getElementById("brandForm").action = navigateTo + orderMode;
//        });
//    }

    // No Useage
    /*
     $(".iType").change(function() {
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
     }); */

    // No Useage
    /*
     $(".iFormat").change(function() {
     if ($(".iFormat").val() === 'Daily Order') {
     $('#dailyorder').show();
     $('#do').edatagrid({
     url: '<?= base_url() ?>/index.php/invoices/allDailyOrders',
     saveUrl: '<?= base_url() ?>/index.php/invoices/saveDailyOrder',
     updateUrl: '<?= base_url() ?>/index.php/parts/edit',
     destroyUrl: 'destroy_user.php',
     onBeforeEdit: function(rowIndex) {
     setTimeout(function() {
     $(".datagrid-editable-input").keydown(function(e) {
     console.log(e.keyCode);
     if (e.keyCode === 13) {
     $('#do').edatagrid("endEdit", rowIndex);
     $('#do').edatagrid('addRow');
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
     });*/

</script>