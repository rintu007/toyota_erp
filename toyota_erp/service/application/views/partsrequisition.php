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
            <form id="partsrequisitionbodyform" action="<?= base_url() ?>index.php/partsrequisitionbodyshop/Add"  method="post" onSubmit="return validationform()" class="form animated fadeIn">
                <fieldset>
                    <legend>Requested Parts</legend>   
                    <div class="feildwrap">
                        <label>Search By RO</label>
                        <input type="text" name="searchbyro" id="searchbyro"  placeholder="Search by RO Number">
                    </div><br>
                    <div id="" class="btn-block-wrap datagrid" id="tbl-Dispatch">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S.No</th>
                                    <th width="10%">RO Number</th>
                                    <th width="10%">Part Name</th>
                                    <th width="8%">Quantity</th>
                                    <th width="8%">Invoice</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr><td colspan="6"><div id="paging"><ul></ul></div></tr>
                            </tfoot>
                            <tbody id="reqData">

                            </tbody>
                        </table>
                    </div>
                </fieldset> 
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url() ?>index.php/partsrequisition/allRequested",
            success: function(data) {
                var requestData = JSON.parse(data);
                if (requestData.length > 0) {
                    for (var a = 0; a < requestData.length; a++) {
                        if ($('#reqData tr').length > requestData.length) {
                            $('#reqData tr:eq(' + a + ')').remove();
                        } else {
                            $('#reqData').append("<tr>\n\
                                        <td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
                                        <td class='tbl-ro-number' ><input readonly type='text' name='ROnumber' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
                                        <td class='tbl-od'><input readonly type='text' name='partsreqinfo' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description'/></td>\n\
                                        <td class='tbl-req-qty'><input readonly type='text' name='requestquantity' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'/></td>\n\
                                        <td class='tbl-req-qty'><a href='<?= site_url('index.php/partsrequisition/generateInvoice/')?>/"+requestData[a]['RONumber']+ "'>Generate</a></td>");
                        }
                    }
                    for (var each in requestData) {
                        $('#reqData tr:eq(' + each + ') td:eq(' + 1 + ') input').val(requestData[each]['RONumber']);
                        $('#reqData tr:eq(' + each + ') td:eq(' + 2 + ') input').val(requestData[each]['PartName']);
                        $('#reqData tr:eq(' + each + ') td:eq(' + 3 + ') input').val(requestData[each]['PartQuantity']);
                    }
                } else {
                    $('#reqData').html("<td></td><td></td><td>No Data Found</td><td></td>");
                }
            }
        });
    });
    $("#searchbyro").keyup(function() {
        var search = $("#searchbyro").val();
        $('#reqData').html('');
        $('#reqData tr input').val('');
        $.ajax({
            url: "<?= base_url() ?>index.php/partsrequisition/search",
            type: "POST",
            data: {searchbyro: search},
            success: function(data) {
                var requestData = JSON.parse(data);
                if (requestData.length > 0) {
                    for (var a = 0; a < requestData.length; a++) {
                        if ($('#reqData tr').length > requestData.length) {
                            $('#reqData tr:eq(' + a + ')').remove();
                        } else {
                            $('#reqData').append("<tr>\n\
                                        <td class='tbl-count'>" + parseInt(a + 1) + "</td>\n\
                                        <td class='tbl-ro-number' ><input readonly type='text' name='ROnumber' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
                                        <td class='tbl-part-number' ><input readonly type='text' name='partsreqinfo[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);'></td>\n\
                                        <td class='tbl-od'><input readonly type='text' name='partsreqinfo[]' style='background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Description' placeholder='Description'/></td>\n\
                                        <td class='tbl-req-qty'><input readonly type='text' name='requestquantity[]' style='width: 69%;background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);' id='Quantity' placeholder='Quantity'/></td>");
                        }
                    }
                    for (var each in requestData) {
                        $('#reqData tr:eq(' + each + ') td:eq(' + 1 + ') input').val(requestData[each]['RONumber']);
                        $('#reqData tr:eq(' + each + ') td:eq(' + 2 + ') input').val(requestData[each]['PartNumber']);
                        $('#reqData tr:eq(' + each + ') td:eq(' + 3 + ') input').val(requestData[each]['PartName']);
                        $('#reqData tr:eq(' + each + ') td:eq(' + 4 + ') input').val(requestData[each]['PartQuantity']);
                    }
                } else {
                    $('#reqData').html("<td></td><td></td><td>No Data Found</td><td></td>");
                }
            }
        });
    });
</script>
