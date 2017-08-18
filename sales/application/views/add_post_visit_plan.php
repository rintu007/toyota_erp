<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);

        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post" action="<?= base_url() ?>index.php/visitplanpost/save" class="form validate-form animated fadeIn">
               
                <div id="searchform" class="feildwrap">
                    <fieldset>
                        <legend>Add Post Visit Plan</legend>
                        <div>
                            <label>Post Visit Plan No</label>
<!--                            <input type="text" name="entery_no" id="entery_no" value="--><?//= $entery_no ?><!--" readonly >-->
                            <select name="entery_no" id="entery_no">
                                <?php foreach ( $entery_no as $item) { ?>
                                    <option value="<?=$item->idvisitplan?>"><?=$item->idvisitplan?></option>

                                <?php   }?>
                            </select>
                        </div>
                    </fieldset> 
                    <fieldset>
                        <button type="button" class="btn" id="addVisitPlanPost">Add Post Visit Plan</button>
                        <div class="btn-block-wrap datagrid" style="overflow-x: scroll;" id="shwcompat">
                            <table id="visitplan_table" width="50%" border="0" cellpadding="1" cellspacing="0">
                                
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Address</th>
                                        <th>Mobile #</th>
                                        <th>Telephone #</th>
                                        <th>Email ID</th>
                                        <th>Business Name</th>
                                        <th>Business Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="visitplanpost_tbody">
                                </tbody>
                            </table>
                        </div>   
                        <button type="submit" class="btn" id="submit">Save</button>
                    </fieldset>       
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit User Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/warehouse/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Warehouse ID</label>
            <input type="text" name="WarehouseId" id="WarehouseId" data-validation="required">
        </div>
        <div>
            <label>Mode Name</label>
            <input type="text" name="Name" id="Name" data-validation="required">
        </div>

    </form>
</div>
<script>
    $('#searchnow').ready(function () {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Faqs/servicegetquestionsanswers",
            type: "POST",
            data: {question: searchnow},
            dataType: "Json",
            success: function (data) {
                counter = 1;
                if (data !== "null")
                {
                    if (data.length > 0) {
                        try {
                            var items = [];
                            $.each(data, function (i, val) {
//                                items += "<tr><td><div class='feildwrap'><div style='font-size: larger'>Q# " + counter + 1 + ":" val.Question + " < /div><br><div style='font-size: larger'>Ans: " + val.Answer + "</div > < /div></td > < /tr>";
                                items += "<tr><td><br><div class'feildwrap'><div style='font-size: small'>Q#" + counter++ + ": " + val.Question + "</div><div style='font-size: small'>Ans: " + val.Answer + "</div><div style='font-size: small'>Date: " + val.Date + "</div><div style='font-size: small'>Time: " + val.Time + "</div></div></td></tr>";
                            });
                            $('#havefaqs').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#havefaqs").html("<tr><td><div class='feildwrap'><div style='font-size: larger'>No Data Found</div></td></tr>");
                    }
                }
            }, error: function () {
                console.log('error');
            }
        });
    });
    function validationform() {

    }
</script>


<script>
    function validationform() {
    }

    $("#addVisitPlanPost").on('click', function () {
        var html;
        var customername = <?= json_encode($customername) ?>;
        var customername_option;
//        $.each(customername, function (i, val) {
//            customername_option += "<option value = " + val['IdCustomer'] + " >" + val['CustomerName'] + "</option>";
//        });
        html += "<tr>";     
        html += "<td><input type='text' name = 'customername[]'/></td>";
        html += "<td><input type = 'text' name = 'address[]'  /> </td>";
        html += "<td><input type = 'text' onchange='getcustomer(this)' name = 'mobile[]'  /> </td>";
        html += "<td><input type = 'text' onchange='getcustomer(this)' name = 'telephone[]'  /> </td>";
        html += "<td><input type = 'text' name = 'email[]'  /> </td>";
        html += "<td><input type = 'text' name = 'businessname[]'  /> </td>";
        html += "<td><input type = 'text' name = 'businessaddress[]'  /><input type='hidden' name = 'IdCustomer[]' value=''/> </td>";
        html += "<td style='text-align:center !important;'><a href='#' class = 'remCF textoq'>Remove</a></td>"
        html += "</tr>";

        $('#visitplanpost_tbody').append(html);
    });
    $(document).on('click', '.remCF', function () {
        $(this).parent().parent().remove();
    });
    var elem
    function getcustomer(num){
        elem = num
        number = num.value

        $.ajax({
            url: "<?= base_url() ?>index.php/visitplanpost/serviceexistingcustomer",
            type: "POST", data: {searchby: 'Contact Number', searchnow: number},
            dataType: "json",
            success: function(data) {
                console.log(data)

//                $($(p).find('input')[5]).val(data['customer'][0]['Name'])
//                $($(p).find('input')[6]).val(data['customer'][0]['Name'])

                if (data['customer'].length > 0) {

                    var p = $(elem).parent().parent()[0]
                    $($(p).find('input')[0]).val(data['customer'][0]['Name'])
                    $($(p).find('input')[1]).val(data['customer'][0]['Address'])
                    $($(p).find('input')[3]).val(data['customer'][0]['PhoneNumber'])
                    $($(p).find('input')[4]).val(data['customer'][0]['Email'])
                    $($(p).find('input')[7]).val(data['customer'][0]['IdCustomer'])

//                    $('#CustomerQueryResult').html('Customer is Already Registered');
//                    $('#CustomerQueryResult').show();
//                    $('#shwvehicle').html(' ');
//                    $('#shwcustomername').val(data['customer'][0]['Name']);
//                    $('#showphonenum').val(data['customer'][0]['PhoneNumber']);
//                    $('#shwmobilnum').val(data['customer'][0]['MobileNumber']);
//                    $('#shwemail').val(data['customer'][0]['Email']);
//                    $('#shwaddress').val(data['customer'][0]['Address']);
//                    $('#shwvehicle').append($("<option>Select Variant</option>").val(data['customer'][0]['VariantId']).html(data['crcustomer'][0]['VehicleName']));
//                    $('#shwvehiclechassisnum').val(data['customer'][0]['ChassisNumber']);
//                    $('#shwvehicleenginenum').val(data['customer'][0]['EngineNumber']);
                }

            },
            error: function() {
                console.log('error');
            }
        });

    }

</script>