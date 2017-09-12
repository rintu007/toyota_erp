<div id="wrapper">
    <div id="content">
        <?php
        $cookieData = unserialize($_COOKIE['logindata']);
        if ($cookieData['isAdmin'] == 1) {
            include 'include/admin_leftmenu.php';
        } else {
            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="" class="form validate-form animated fadeIn">
                <fieldset>
<!--                    <input class="easyui-combobox" 
name="lo_client_id"
data-options="
url:'<?= base_url() ?>/index.php/invoices/test',
valueField:'idType',
textField:'TypeName',
panelHeight:'auto'
">-->
                    <legend>Toyota Genuine Motor Oil</legend>
                    <div class="feildwrap">
                        <div class="btn-block-wrap">
                            <div>
                                <?php
                                $date = date('Y/m/d');
                                $time = strtotime($date);
                                $month_only = date('m', $time);
                                //echo $output;
                                $OrderNumber = $cookieData['Code'] . "/" . $OrderType['Code'] . $_POST['BrandCode'] . "/" . $month_only;
                                ?>
                                <!--                                <label>Order Type</label>
                                                                <select name="invoiceType" class="iType">
                                                                    <option>Select Order Type</option>
                                                                    <option>Daihatsu</option>
                                                                    <option>Toyota</option>
                                                                    <option>Spare Parts</option>
                                                                    <option>After Sales Warranty</option>
                                                                    <option>Chemical</option>
                                                                    <option>Inq</option>
                                                                    <option>Smr</option>
                                                                    <option>Tmo</option>
                                                                </select>-->
                            </div>
                            <!--                            <div>
                                                            <label>Order Format</label>
                                                            <select name="invoiceType" class="iFormat">
                                                            </select>
                                                        </div>-->
                        </div>
                    </div>
                    <div class="feildwrap">

                        <?php
//                        if ($OrderNo['Number'] == 1) {
//                            $OrderNo['Number'] = $OrderNo['Number'] + 1;
//                        } else {
//                            $OrderNo['Number'] = $OrderNo['Number'];
//                        }
//                        
                        ?>
                    </div>
                    <div>
                        <table id="do" title="Toyota Genuine Motor Oil" style="width:auto;height:auto;"
                               url="<?= base_url() ?>/index.php/invoices/searchtgmo/" toolbar="#toolbar" pagination="true" idField="OrderNumber"
                               rownumbers="true" fitColumns="true" singleSelect="true" scrollbarSize="11">
                            <thead>
                                <tr>
                                    <th field="Date" width="40" editor="{type:'validatebox',options:{required:false}}">Date</th>
                                    <th field="OrderNumber" width="70" editor="{type:'validatebox',options:{required:false}}">Order Number</th>
                                    <!--<th field="PartNumber" width="60" editor="{type:'text',options:{required:true}}">Part Number</th>-->
                                    <th field="PartNumber" width="60" editor="{type:'combobox',options:{valueField:'PartNumber', textField:'PartNumber', url:'<?= base_url() ?>/index.php/invoices/parts/<?= 'Toyota Genuine Motor Oil' ?>',required:true}}">Part Number</th>
                                    <th field="Quantity" width="30" editor="{type:'validatebox',options:{required: true}}">Quantity</th>
                                    <th field="QtyOnOrder" width="30" editor="{type:'number'}">On Order</th>
                                    <th field="LTR" width="50" editor="{type:'validatebox',options:{required:false}}">LTR</th>
                                    <th field="DealerRemarks" width="70" editor="{type:'validatebox',options:{required: false}}">Dealer Remarks</th>
                                    <th field="IMCRemarks" width="70" editor="{type:'validatebox',options:{required: false}}">IMC Remarks</th>
                                    <th field="OrderStatus" width="70" editor="">Order Status</th>
                                </tr>
                            </thead>
                        </table>
                        <div id="toolbar">
                            <div>
                                <label>Part ID:</label>
                                <input id="idPart" style="margin-left: 44px;"> 
                                <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
                            </div>
                            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#do').edatagrid('addRow');
                            <?php
                            if (isset($OrderNo['Number'])) {
                                $orderNumber = $OrderNo['Number'];
                            } else {
                                $orderNumber = 1;
                            }
                            ?>
                                    $('div.datagrid-cell-c1-OrderNumber').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= $OrderNumber . '-' . $orderNumber ?>');
                                    $('div.datagrid-cell-c1-Date').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= date('Y/m/d') ?>');
//                                    $('div.datagrid-cell-c1-Dispatch-Mode').children('table').children('tbody').children('tr').children('td').children('span').children('.combo-value').val('By Road');
//                                    $('div.datagrid-cell-c1-Dispatch-Mode').children('table').children('tbody').children('tr').children('td').children('span').children('.combo-text').val('By Road');
                               ">New</a>
                            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#do').edatagrid('destroyRow');javascript:$('#do').edatagrid('reload');">Delete</a>
                            <a href="#" id="saveURL" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#do').edatagrid('saveRow')">Save</a>
                            <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#do').edatagrid('cancelRow')">Cancel</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>

    $('#do').edatagrid({
        url: '<?= base_url() ?>/index.php/ToyotaGenuineMotorOil/allTgmo',
        saveUrl: '<?= base_url() ?>/index.php/ToyotaGenuineMotorOil/saveTgmo',
        updateUrl: '<?= base_url() ?>/index.php/parts/edit',
        destroyUrl: '<?= base_url() ?>/index.php/ToyotaGenuineMotorOil/delete',
        onBeforeEdit: function (rowIndex) {
            setTimeout(function () {
                $(".datagrid-editable-input").keydown(function (e) {<?php
                            if (isset($OrderNo['Number'])) {
                                $orderNumber = $OrderNo['Number'];
                            } else {
                                $orderNumber = 1;
                            }
                            ?>
                    if (e.keyCode === 13) {
                        $('#do').edatagrid("endEdit", rowIndex);
                        $('#do').edatagrid('addRow');
                        $('div.datagrid-cell-c1-OrderNumber').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= $OrderNumber . '-' . $orderNumber ++ ?>');
                        $('div.datagrid-cell-c1-Date').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= date('Y/m/d') ?>');
//                        $('div.datagrid-cell-c1-Dispatch-Mode').children('table').children('tbody').children('tr').children('td').children('span').children('.combo-text').val("By Road");
//                        $('div.datagrid-cell-c1-Dispatch-Mode').children('table').children('tbody').children('tr').children('td').children('span').children('.combo-value').val("By Road");
                    }
                });
            }, 500);
        }
    });
    
    function destroyUser() {
        var row = $('#do').edatagrid('getSelections');
        $.each(row, function (index, value) {
            if (value) {
                $.messager.confirm('Confirm', 'Are you sure you want to delete this order?', function (r) {
                    if (r) {
                        $.post('<?= base_url() ?>/index.php/ToyotaGenuineMotorOil/delete', {id: value.OrderNumber}, function (result) {
                            window.res = result;
                            if (result.success) {
                                $('#do').edatagrid('reload');    // reload the user data
                                $.messager.show({// show success message
                                    title: 'Success',
                                    msg: "Order Number [ " + value.OrderNumber + " ] / [ " + value.PartNumber + " ] has been deleted"
                                });
                            } else {
                                $.messager.show({// show error message
                                    title: 'Error',
                                    msg: "unable to send request to the server"
                                });
                            }
                        }, 'json');
                    }
                });
            }
        });
    }

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

    function doSearch() {
        $('#do').edatagrid('load', {
            PartNumber: $('#idPart').val()
        });
    }

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