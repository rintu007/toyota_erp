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
                    <legend>Special Offer</legend>
                    <div class="feildwrap">
                        <div class="btn-block-wrap">
                            <div>
                                <?php
                                $date = date('Y/m/d');
                                $time = strtotime($date);
                                $month_only = date('m', $time);
                                $OrderNumber = $cookieData['Code'] . "/" . $OrderType['Code'] . $_POST['BrandCode'] . "/" . $month_only;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="feildwrap">
                    </div>
                    <div>
                        <table id="ao" title="Special Offer" style="width:auto;height:auto;"
                               url="<?= base_url() ?>/index.php/invoices/searchdailyorder/" toolbar="#toolbar" pagination="true" idField="OrderNumber"
                               rownumbers="true" fitColumns="true" singleSelect="true" scrollbarSize="11">
                            <thead>
                                <tr>
                                    <th field="Date" width="40" editor="{type:'validatebox',options:{required:false}}">Date</th>
                                    <th field="OrderNumber" width="70" editor="{type:'validatebox',options:{required:false}}">Order Number</th>
                                    <th field="PartNumber" width="60" editor="{type:'combobox',options:{valueField:'PartNumber', textField:'PartNumber', url:'<?= base_url() ?>/index.php/invoices/parts/<?= 'Special Offer' ?>',required:true}}">Part Number</th>
                                    <th field="Quantity" width="30" editor="{type:'validatebox',options:{required: true}}">Quantity</th>
                                    <th field="QtyOnOrder" width="30" editor="{type:'number'}">On Order</th>
                                    <th field="SpecialPrice" width="50" editor="{type:'validatebox',options:{required:false}}">Special Price</th>
                                    <th field="PackageDate" width="50" editor="{type:'validatebox',options:{required:false}}">Package Date</th>
                                    <th field="DealerRemarks" width="70" editor="{type:'validatebox',options:{required: false}}">Dealer Remarks</th>
                                    <th field="IMCRemarks" width="70" editor="{type:'validatebox',options:{required: false}}">IMC Remarks</th>
                                    <th field="OrderStatus" width="70">Order Status</th>
                                </tr>
                            </thead>
                        </table>
                        <div id="toolbar">
                            <div>
                                <label>Part ID:</label>
                                <input id="idPart" style="margin-left: 44px;"> 
                                <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
                            </div>
                            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#ao').edatagrid('addRow');
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
                            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#ao').edatagrid('destroyRow');
                                    javascript:$('#ao').edatagrid('reload')">Delete</a>
                            <a href="#" id="saveURL" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#ao').edatagrid('saveRow')">Save</a>
                            <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#ao').edatagrid('cancelRow')">Cancel</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    function doSearch() {
        $('#ao').edatagrid('load', {
            PartNumber: $('#idPart').val()
        });
    }
    
    function destroyUser() {
        var row = $('#ao').edatagrid('getSelections');
        $.each(row, function (index, value) {
            if (value) {
                $.messager.confirm('Confirm', 'Are you sure you want to delete this order?', function (r) {
                    if (r) {
                        $.post('<?= base_url() ?>/index.php/specialoffer/delete', {id: value.OrderNumber}, function (result) {
                            window.res = result;
                            if (result.success) {
                                $('#ao').edatagrid('reload');    // reload the user data
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
    
    $(document).ready(function () {
        $('#ao').edatagrid({
            url: '<?= base_url() ?>/index.php/specialoffer/allSpecialOffers',
            saveUrl: '<?= base_url() ?>/index.php/specialoffer/saveSpecialOffer',
            updateUrl: '<?= base_url() ?>/index.php/parts/edit',
            destroyUrl: '<?= base_url() ?>/index.php/specialoffer/delete',
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
                            $('#ao').edatagrid("endEdit", rowIndex);
                            $('#ao').edatagrid('addRow');
                            $('div.datagrid-cell-c1-OrderNumber').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?php $OrderNumber . '-' . $orderNumber ++ ?>');
                            $('div.datagrid-cell-c1-Date').children('table').children('tbody').children('tr').children('td').children('.datagrid-editable-input').val('<?= date('Y/m/d') ?>');
//                            $('div.datagrid-cell-c1-Dispatch-Mode').children('table').children('tbody').children('tr').children('td').children('span').children('.combo-value').val("By Road");
//                            $('div.datagrid-cell-c1-Dispatch-Mode').children('table').children('tbody').children('tr').children('td').children('span').children('.combo-text').val('By Road');
                        }
                    });
                }, 500);
            }
        });

        var status = $('div.datagrid-cell-c1-OrderStatus').children('table').children('tbody').children('tr').children('td').children('input').val();
        if (status === 'Pending') {
            $('div.datagrid-cell-c1-OrderStatus').children('table').children('tbody').children('tr').children('td').children('input').css('background-color', 'green');
        } else {
            $('div.datagrid-cell-c1-OrderStatus').children('table').children('tbody').children('tr').children('td').children('input').css('background-color', 'red');
        }

    });


</script>