<?php //var_dump($allEstimates);?>
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/estimate_leftmenu.php';
        } else {
//            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form id="estmechanicalform" action="<?= base_url() ?>index.php/estimatemechanical/Add"  method="post" onSubmit="return validationform()" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>All Estimates  Mechanical</legend>
                    <div class="feildwrap">
                        <label>Search By Estimate No</label>
                        <input type="text" name="searchbyest" id="searchbyest"  placeholder="Search by Estimate Number">
                    </div><br><br>
                    <div id="JobDescDiv" class="feildwrap">
                        <div class="btn-block-wrap dg">
                            <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="05%">S.NO</th>
                                        <th width="05%">Est.NO</th>
                                        <th width="10%">Customer</th>
                                        <th width="10%">Contact</th>
                                        <th width="15%">Vehicle</th>
                                        <th width="20%">Jobs</th>
                                        <th width="05%">Amount</th>
<!--                                        <th width="05%">Range-Two</th>
                                        <th width="05%">Range-Three</th>-->
                                        <th width="10%">On Date</th>
                                        <th width="05%">Detail</th>
                                    </tr>
                                </thead>                               
                                <tfoot class="">
                                    <tr>
                                        <td colspan="11">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                </tfoot>
                                <tbody id="allestbody">
                                    <?php
                                    $count = 1;
                                    foreach ($allEstimates as $key) {
                                        ?>
                                        <tr id="allcomplaints">
                                            <td name="complaintsno"><?= $count++ ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key['SerialNumber'] ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key['CustomerName'] ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key['Cellphone'] ?></td>
                                            <td name="complaints" class="tbl-name"><?= $key['VehicleName'] ?></td>
											<?php if($key['is_PM'] == 0){?>
                                            <td name="complaints" class="tbl-name"><?= $key['Jobs'] ?></td>
                                            <td name="complaints" class="tbl-name">
                                                <?php
                                                $sumArray = explode(",", $key[$key['Rangee']]);
                                                $totalAmount = 0;
                                                foreach ($sumArray as $val) {
                                                    $totalAmount += $val;
                                                }
												if($key['SubletP']){
													$totalAmount += $key['SubletP'];
												}if($key['PartsP']){
													$totalAmount += $key['PartsP'];
												}
                                                echo $totalAmount . "";
                                                ?>
                                            </td>
											<?php }else{ $CI =& get_instance();
;											?>
												    <td name="complaints" class="tbl-name"><?= $CI->pm_package($key['PM_package']); ?></td>
                                            <td name="complaints" class="tbl-name">
                                                <?php
                                                $sumArray = explode(",", $key[$key['Rangee']]);
                                                $totalAmount = 0;
                                                foreach ($sumArray as $val) {
                                                    $totalAmount += $val;
                                                } 
												$totalAmount2 = $key['PM_amount'];
												if($key['SubletP']){
													$totalAmount2 += $key['SubletP'];
												}if($key['PartsP']){
													$totalAmount2 += $key['PartsP'];
												}
                                                echo $totalAmount2 . "";
                                                ?>
                                            </td>
												
											<?php } ?>
    <!--                                            <td name="complaints" class="tbl-name">
                                            <?php
                                            $sumArray = explode(",", $key['RangeTwoAmount']);
                                            $totalAmount = 0;
                                            foreach ($sumArray as $val) {
                                                $totalAmount += $val;
                                            }
                                            echo $totalAmount . " /=";
                                            ?>
                                            </td>
                                            <td name="complaints" class="tbl-name">
                                            <?php
                                            $sumArray = explode(",", $key['RangeThreeAmount']);
                                            $totalAmount = 0;
                                            foreach ($sumArray as $val) {
                                                $totalAmount += $val;
                                            }
                                            echo $totalAmount . "";
                                            ?>
                                            </td>-->
                                            <td name="complaints" class="tbl-name">
                                                <?php
                                                echo date("d-M-Y", strtotime($key['Date']));
                                                ?>
                                            </td>
                                            <td name="complaints" class="tbl-name"><a target="_blank" href="<?= base_url() ?>index.php/allestimatesmech/printEstimate/<?= $key['SerialNumber'] ?>">Print</a></td>
                                            <?php
                                            ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>       
                <fieldset style="display: none">
                    <legend onclick="DoToggle('#CustomerInfoDiv')">Customer Information</legend>
                    <div id="CustomerInfoDiv" class="feildwrap">
                        <div>
                            <label>S.No</label>
                            <input id="SNO" type="text" name="SNO" placeholder="Serial Number" style="width: 150px;" 
                                   value="<?php
                                   if ($serialNumber != Null) {
                                       echo $serialNumber + 1;
                                   } else {
                                       echo '0';
                                   }
                                   ?>">
                        </div>
                        <div>
                            <label>Date</label>
                            <input id="Date" type="text" name="Date" class="date" placeholder="Date" data-validation="required" style="width:150px;">
                        </div><br>
                        <div>
                            <label>Customer Name</label>
                            <input id="CustomerName" type="text" name="CustomerName"  placeholder="Enter Customer Name"  data-validation="required" style="width: 150px;" >
                        </div>
                        <div>
                            <label>Tel</label>
                            <input class="MobileNo" id="CustomerContact" type="text" name="CustomerContact" placeholder="Enter Contact Number" data-validation="required" style="width: 150px;">
                        </div><br>
                        <div>
                            <label>ATTN: Mr.</label>
                            <input id="ATTN" type="text" name="ATTN" placeholder="Enter ATTN" style="width: 150px;">
                        </div>
                        <div>
                            <label>Fax No.</label>
                            <input class="FaxNo" id="CustomerFax" type="text" name="CustomerFax" placeholder="Enter Fax Number" style="width: 150px;">
                        </div><br>
                        <div>
                            <label>Address</label>
                            <textarea id="" name="CustomerAddress" placeholder="Enter Address" style="margin: 0px; width: 600px; height: 100px;"></textarea>
                        </div><br>
                    </div>
                </fieldset>
                <fieldset style="display: none">
                    <legend onclick="DoToggle('#VehicleInfoDiv')">Vehicle Information</legend>
                    <div id="VehicleInfoDiv" class="feildwrap">
                        <div>
                            <label>Make</label>
                            <input id="Make" type="text" name="Make" placeholder="Enter Make" data-validation="required" style="width: 150px;">
                        </div>
                        <div>
                            <label>Model</label>
                            <input id="Model" type="text" name="Model" placeholder="Enter Model" style="width: 150px;">
                        </div><br>
                        <div>
                            <label>Year</label>
                            <input id="Year" type="text" name="Year" placeholder="Enter Year" style="width: 150px;">
                        </div>
                        <div>
                            <label>Reg No.</label>
                            <input id="RegistrationNumber" type="text" name="RegistrationNumber" placeholder="Enter Reg Number" data-validation="required" style="width: 150px;">
                        </div><br>
                        <div>
                            <label>Chassis No.</label>
                            <input id="FrameNumber" type="text" name="FrameNumber" placeholder="Enter Chassis Number" style="width: 150px;" >
                        </div>                          
                        <div>
                            <label>Engine No.</label>
                            <input id="EngineNumber" type="text" name="EngineNumber" placeholder="Enter Engine Number" style="width: 150px;" >
                        </div>
                        <div>
                            <label>KM</label>
                            <input id="KM" type="text" name="KM" placeholder="Enter KM" style="width: 150px;">
                        </div>
                    </div>
                </fieldset>
                <fieldset style="display: none">
                    <legend onclick="DoToggle('#JobDescDiv')">Job Description</legend>
                    <div id="JobDescDiv" class="feildwrap">
                        <div class="btn-block-wrap datagrid">
                            <table width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="05%">S.NO</th>
                                        <th width="80%">Job Description</th>
                                        <th width="15%">Amount</th>
                                    </tr>
                                </thead>                               
                                <tfoot class="">
                                    <tr>
                                        <td colspan="3">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                </tfoot>
                                <input name="newRow" style=" width:15px;height:30px;text-align:center;background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " id="newRow" value="+" readonly>                                 
                                <!--<span style=" background: rgb(250,85,55); background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: -moz-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgb(250,85,55)), color-stop(50%, rgb(242,111,92)), color-stop(51%, rgb(245,41,12)), color-stop(100%, rgb(227,53,37))); background: -webkit-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -o-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: -ms-linear-gradient(top, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); background: linear-gradient(to bottom, rgb(250,85,55) 0%, rgb(242,111,92) 50%, rgb(245,41,12) 51%, rgb(227,53,37) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fa5537', endColorstr='#e33525', GradientType=0 ); border: 1px solid #a41100 !important; color: #fff !important; padding: 0px 5px; font-size: 22px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); text-shadow: 0 1px 1px #333333; float: right; cursor: pointer " value="+" id="newRow">+</span>-->
                                <tbody id="MJobDesc">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
                <fieldset style="display: none">
                    <legend>Signature</legend>
                    <div class="feildwrap"> 
                        <div>
                            <label>Service Advisor</label>
                            <input id="ServiceAdvisor" name="ServiceAdvisor" placeholder="Service Advisor Name">
                        </div>
                        <div> 
                            <label>Signature</label>
                            <input id ="Signature" name="Signature" placeholder="Signature">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <label>&nbsp;</label><br>
                            <input type="submit" class="btn" value="OK" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
                </fieldset> 
            </form>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {

    });
    function DoToggle(id) {
        $(id).toggle();
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

    $("#searchbyest").keyup(function() {
        var search = $("#searchbyest").val();
        var totalAmount = 0;
        var rangeTwoArray = 0;
        var rangeThreeArray = 0;
        var rangeTwo = 0;
        var rangeThree = 0;
        var totalArray = 0;
        $.ajax({
            url: "<?= base_url() ?>index.php/allestimatesmech/search",
            type: "POST",
            data: {searchbyest: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                totalArray = (val.RangeOneAmount).split(",");
                                for (var key in totalArray) {
                                    totalAmount += parseInt(totalArray[key]);
                                }
//                                rangeTwoArray = (val.RangeTwoAmount).split(",");
//                                for (var key in totalArray) {
//                                    rangeTwo += parseInt(rangeTwoArray[key]);
//                                }
//                                rangeThreeArray = (val.RangeThreeAmount).split(",");
//                                for (var key in totalArray) {
//                                    rangeThree += parseInt(rangeThreeArray[key]);
//                                }
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.SerialNumber + "</td>\n\
                            <td class='tbl-name'>" + val.CustomerName + "</td>\n\
                            <td class='tbl-name'>" + val.Cellphone + "</td>\n\
                            <td class='tbl-name'>" + val.VehicleName + "</td>\n\
                            <td class='tbl-name'>" + val.Jobs + "</td>\n\
                            <td class='tbl-name'>" + totalAmount + "/=</td>\n\
                            <td class='tbl-name'>" + val.Date + "</td>\n\
                            <td class='tbl-name'><a target='_blank' href='<?= base_url() ?>index.php/allestimatesmech/printEstimate/" + val.SerialNumber + "'>Print</a></td></tr>";
                                totalAmount = 0;
                                rangeTwo = 0;
                                rangeThree = 0;
                            });
                            $('#allestbody').html(items);

                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#allestbody").html("<td></td><td></td><td></td><td></td><td>No Data Found</td><td></td><td></td><td></td><td></td>");
                    }
                }
            }
        });
    });
</script>
