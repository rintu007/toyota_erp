<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/ro_leftmenu.php';
        } else {
//            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <h4><?= $gatePassCreated ?></h4>
            <form id="GatePassList" action="<?= base_url() ?>index.php/"  method="post" onSubmit="return validationform()" class="form animated fadeIn">
                <fieldset>
                    <legend>Gate Pass</legend>
                    <div class="feildwrap">
                        <label>Search By RO Number</label>
                        <input type="text" name="searchbyro" id="searchbyro"  placeholder="Search by RO Number">
                    </div><br><br>
                    <div id="ROFinanceDiv" class="feildwrap">
                        <div class="btn-block-wrap datagrid">
                            <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="02%">S.NO</th>
                                        <th width="02%">RO</th>
                                        <th width="12%">Book in Date</th>
                                        <th width="10%">Delivery Date</th>
                                        <th width="05%">Customer</th>
                                        <th width="15%">Contact</th>
                                        <th width="15%">Variant</th>
                                        <th width="05%">Reg Number</th>
                                        <th width="05%">Mileage</th>
                                        <th width="05%">Total Amount</th>
                                        <th width="10%">Staff</th>
                                        <th width="10%">Foreman</th>
                                        <th width="05%">Detail</th>
                                    </tr>
                                </thead>                               
                                <tfoot class="">
                                    <tr>
                                        <td colspan="13">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                </tfoot>
                                <tbody id="rogatepassbody">
                                    <?php
                                    $count = 1;
                                    foreach ($roDetails as $key) {
                                        ?>
                                        <tr id="allcomplaints">
                                            <td name=""><?= $count++ ?></td>
                                            <td name="" class="tbl-name"><?= $key['RONumber'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['BookingDate'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['DeliveryDate'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['CustomerName'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['CustomerContact'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['Vehicle'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['RegNumber'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['Mileage'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['NetTotal'] . " /=" ?></td>
                                            <td name="" class="tbl-name"><?= $key['Staff'] ?></td>
                                            <td name="" class="tbl-name"><?= $key['Foreman'] ?></td>
                                            <td name="" class="tbl-name"><a  style="cursor: pointer" onclick="getValues(<?php echo $key['idRO'] ?>);">Gate Pass</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </form>
            <form id="GatePassForm" action="<?= base_url() ?>index.php/rogatepass/createGatePass"  method="post" onSubmit="" class="form animated fadeIn">
                <fieldset>
                    <legend>Create Gate Pass</legend>
                    <div id="CustomerInfoDiv" class="feildwrap">
                        <div style="display: none">
                            <label>Id RO</label>
                            <input id="idRO" type="text" name="idRO" placeholder="" readonly>
                        </div>
                        <div>
                            <label>Customer Name</label>
                            <input id="CustomerName" type="text" name="CustomerName" placeholder="Enter Name" readonly>
                        </div>
                        <div>
                            <label>Tel</label>
                            <input id="CustomerContact" Class="MobileNo" type="text" name="CustomerContact" placeholder="Enter Contact Number" readonly>
                        </div>
                    </div><br>
                    <div id="VehicleInfoDiv" class="feildwrap">
                        <div id="inputMakeDiv">
                            <label>Make</label>
                            <input id="inputMake" type="text" name="inputMake" placeholder="Enter Make" readonly>
                        </div>                  
                        <div>
                            <label>Reg No.</label>
                            <input id="RegNumber" type="text" name="RegNumber" placeholder="Enter Registration Number" readonly>
                        </div> 
                    </div><br>  
					<div id="" class="feildwrap">
                        <div id="">
                            <label>RO MODE</label>
                            <input id="RoMode" type="text" name="RoMode" placeholder="Enter RoMode" readonly>
                        </div>                  
                        <div>
                            <label>SUB RO MODE</label>
                            <input id="subRoMode" type="text" name="subRoMode" placeholder="Enter subRoMode" readonly>
                        </div> 
                    </div><br> 
                    <div id="GatePassDiv" class="feildwrap">
                        <div>
                            <label>Gate Pass Number</label>
                            <input type="text" name="GatePassNumber" data-validation="required"   value="<?php
                            if ($gatePassNumber != Null) {
                                echo $gatePassNumber + 1;
                            } else {
                                echo '000';
                            }
                            ?>">
                        </div>
                        <div style="">
                            <label>Gate Pass Date</label>
                            <input type="text" name="GatePassDate" class="date" data-validation="required">
                        </div>
						
						<div style="">
                            <label>Gate Pass Time</label>
                            <input type="time" name="time"  data-validation="required">
                        </div>
                    </div><br>
                    <div class="btn-block-wrap">
                        <input id="CreateGatePass" type="submit" class="btn" value="Create Gate Pass" style="margin-left: 425px;width: 200px;">
                    </div>
                </fieldset>               
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#GatePassForm').hide();
    });

    $("#searchbyro").keyup(function() {
        var search = $("#searchbyro").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/rogatepass/searchRODetail",
            type: "POST",
            data: {searchbyro: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.RONumber + "</td>\n\
                            <td class='tbl-name'>" + val.BookingDate + "</td>\n\
                            <td class='tbl-name'>" + val.DeliveryDate + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerName + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerContact + "</td>\n\
                            <td class='tbl-name'>" + val.Vehicle + "</td>\n\
                            <td class='tbl-name'>" + val.RegNumber + "</td>\n\
                            <td class='tbl-name'>" + val.Mileage + "</td>\n\
                            <td class='tbl-name'>" + val.NetTotal + " /=</td>\n\
                            <td class='tbl-name'>" + val.Staff + "</td>\n\
                            <td class='tbl-name'>" + val.Foreman + "</td>\n\
                            <td class='tbl-name'><a style='cursor: pointer' onClick=getValues('" + val.idRO + "')>Gate Pass</a></td></tr>";
                            });
                            $('#rogatepassbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#rogatepassbody").html("<td></td><td></td><td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td>");
                    }
                }
            }
        });
    });

    function DoToggle(id) {
        $(id).toggle();
    }

    function getValues(idRO) {

        $('#GatePassList').hide();
        $('#GatePassForm').show();
        var search = idRO;
        $.ajax({
            url: "<?= base_url() ?>index.php/rogatepass/getRODetail",
            type: "POST",
            data: {idRO: search},
            success: function(data) {
                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        try {
							console.log(parsedData);
                            $('#idRO').val(parsedData[0]['idRO']);
                            $('#CustomerName').val(parsedData[0]['CustomerName']);
                            $('#CustomerContact').val(parsedData[0]['CustomerContact']);

                            $('#inputMake').val(parsedData[0]['Vehicle']);
                            $('#RegNumber').val(parsedData[0]['RegNumber']);   
							$('#RoMode').val(parsedData[0]['ROMode']);
                            $('#subRoMode').val(parsedData[0]['SubModeName']);
							
//                            $('#Model').val(parsedData[0]['Model']);
//                            $('#ModelCode').val(parsedData[0]['ModelCode']);
//                            $('#Year').val(parsedData[0]['Year']);
//                            $('#EstNum').val(parsedData[0]['EstNumber']);
//                            $('#FrameNumber').val(parsedData[0]['FrameNumber']);
//                            $('#EngineNumber').val(parsedData[0]['EngineNumber']);
//                            $('#KM').val(parsedData[0]['Mileage']);

                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {

                    }
                }
            }
        });
    }

</script>

