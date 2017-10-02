<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/partsrequistion_leftmenu.php';
        } else {
//            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form id="partsreceived" action="<?= base_url() ?>index.php/partsreceived/Received"  method="post" onSubmit="return validationform()" class="form animated fadeIn">
                <?= $message ?>
                <fieldset>
                    <legend>Received Parts</legend>   
                    <div class="feildwrap">
                        <label>Search By RO</label>
                        <input type="text" name="searchbyro" id="searchbyro"  placeholder="Search by RO Number">
                    </div><br><br>
                    <div id="data" class="btn-block-wrap datagrid" id="tbl-Dispatch">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S.No</th>
                                    <th width="15%">RO Number</th>
                                    <th width="17%">Part Number</th>
                                    <th width="15%">Part Name</th>
                                    <th width="20%">Received Quantity</th>
                                    <th width="10%">Remaining Quantity</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr><td colspan="6"><div id="paging"><ul></ul></div></tr>
                            </tfoot>
                            <tbody id="recData"></tbody>
                        </table>
                    </div><br><br>
                    <div class="btn-block-wrap">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="Received Parts" style="margin-left: 730px;width: 200px;">
                    </div>
                </fieldset> 
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url() ?>index.php/partsreceived/allReceived",
            success: function(data) {
                var receiveData = JSON.parse(data);
                if (receiveData.length > 0) {
                    for (var a = 0; a < receiveData.length; a++) {
                        if ($('#recData tr').length > receiveData.length) {
                            $('#recData tr:eq(' + a + ')').remove();
                        } else {
                            $('#recData').append("<tr>\n\
                                        <td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
                                        <td class='tbl-ro-number'><input readonly type='text' name='ronumber[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
                                        <td class='tbl-part-number' style='display:none'><input readonly type='text' name='idpartsrec[]'></td>\n\
                                        <td class='tbl-part-number'><input readonly type='text' name='partsreqinfo[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
                                        <td class='tbl-od'><input readonly type='text' name='partsreqinfo[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description'/></td>\n\
                                        <td class='tbl-req-qty'><input readonly type='text' name='requestquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'/>\n\
                                        <td class='tbl-req-qty'><input readonly type='text' name='requestquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'/></td>");
                        }
                    }
                    for (var each in receiveData) {
                        $('#recData tr:eq(' + each + ') td:eq(' + 1 + ') input').val(receiveData[each]['RONumber']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 2 + ') input').val(receiveData[each]['idPartsRequisition']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 3 + ') input').val(receiveData[each]['PartNumber']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 4 + ') input').val(receiveData[each]['PartName']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 5 + ') input').val(receiveData[each]['DispatchedQuantity']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 6 + ') input').val(receiveData[each]['RemainingQuantity']);
                    }
                } else {
                    $('#recData').html("<td></td><td></td><td></td><td>No Data Found</td><td></td><td></td>");
                }
            }
        });
    });

    $("#searchbyro").keyup(function() {
        var search = $("#searchbyro").val();
        $('#recData').html('');
        $('#recData tr input').val('');
        $.ajax({
            url: "<?= base_url() ?>index.php/partsreceived/search",
            type: "POST",
            data: {searchbyro: search},
            success: function(data) {

                var receiveData = JSON.parse(data);
                if (receiveData.length > 0) {
                    for (var a = 0; a < receiveData.length; a++) {
                        if ($('#recData tr').length > receiveData.length) {
                            $('#recData tr:eq(' + a + ')').remove();
                        } else {
                            $('#recData').append("<tr>\n\
                                        <td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
                                        <td class='tbl-ro-number'><input readonly type='text' name='ronumber[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
                                        <td class='tbl-part-number' style='display:none'><input readonly type='text' name='idpartsrec[]'></td>\n\
                                        <td class='tbl-part-number'><input readonly type='text' name='partnumber[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
                                        <td class='tbl-od'><input readonly type='text' name='partsreqinfo[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description'/></td>\n\
                                        <td class='tbl-req-qty'><input readonly type='text' name='requestquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'/>\n\
                                        <td class='tbl-req-qty'><input readonly type='text' name='requestquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'/></td> \
                                        <td class='tbl-part-number' style='display:none'><input readonly type='text' name='idPartsReqInfo[]'></td>")

                        }
                    }
                    for (var each in receiveData) {
                        $('#recData tr:eq(' + each + ') td:eq(' + 1 + ') input').val(receiveData[each]['RONumber']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 2 + ') input').val(receiveData[each]['idPartsRequisition']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 3 + ') input').val(receiveData[each]['PartNumber']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 4 + ') input').val(receiveData[each]['PartName']);
                        // $('#recData tr:eq(' + each + ') td:eq(' + 5 + ') input').val(receiveData[each]['DispatchedQuantity']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 5 + ') input').val(receiveData[each]['PartQuantity']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 6 + ') input').val(receiveData[each]['PartQuantity']);
                        $('#recData tr:eq(' + each + ') td:eq(' + 7 + ') input').val(receiveData[each]['idPartsReqInfo']);
                    }
                } else {
                    $('#recData').html("<td></td><td></td><td></td><td>No Data Found</td><td></td><td></td>");
                }
            }
        });
    });

//    $("#searchbyro").keyup(function() {
//        var search = $("#searchbyro").val();
//        $('#recData').html('');
//        $('#recData tr input').val('');
//        $.ajax({
//            url: "<?//= base_url() ?>//index.php/partsreceived/search",
//            type: "POST",
//            data: {searchbyro: search},
//            success: function(data) {
//
//                var receiveData = JSON.parse(data);
//                if (receiveData.length > 0) {
//                    for (var a = 0; a < receiveData.length; a++) {
//                        if ($('#recData tr').length > receiveData.length) {
//                            $('#recData tr:eq(' + a + ')').remove();
//                        } else {
//                            $('#recData').append("<tr>\n\
//                                        <td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
//                                        <td class='tbl-ro-number'><input readonly type='text' name='ronumber[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
//                                        <td class='tbl-part-number' style='display:none'><input readonly type='text' name='idpartsrec[]'></td>\n\
//                                        <td class='tbl-part-number'><input readonly type='text' name='partsreqinfo[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
//                                        <td class='tbl-od'><input readonly type='text' name='partsreqinfo[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description'/></td>\n\
//                                        <td class='tbl-req-qty'><input readonly type='text' name='requestquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'/>\n\
//                                        <td class='tbl-req-qty'><input readonly type='text' name='requestquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'/></td>");
//                        }
//                    }
//                    for (var each in receiveData) {
//                        $('#recData tr:eq(' + each + ') td:eq(' + 1 + ') input').val(receiveData[each]['RONumber']);
//                        $('#recData tr:eq(' + each + ') td:eq(' + 2 + ') input').val(receiveData[each]['idPartsRec']);
//                        $('#recData tr:eq(' + each + ') td:eq(' + 3 + ') input').val(receiveData[each]['PartNumber']);
//                        $('#recData tr:eq(' + each + ') td:eq(' + 4 + ') input').val(receiveData[each]['PartName']);
//                       // $('#recData tr:eq(' + each + ') td:eq(' + 5 + ') input').val(receiveData[each]['DispatchedQuantity']);
//					    $('#recData tr:eq(' + each + ') td:eq(' + 5 + ') input').val(receiveData[each]['PartQuantity']);
//                        $('#recData tr:eq(' + each + ') td:eq(' + 6 + ') input').val(receiveData[each]['PartQuantity']);
//                    }
//                } else {
//                    $('#recData').html("<td></td><td></td><td></td><td>No Data Found</td><td></td><td></td>");
//                }
//            }
//        });
//    });
</script>
