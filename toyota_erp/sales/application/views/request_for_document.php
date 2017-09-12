<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Faqs/addfaqs" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Request For Document</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Entry Date</label>
                            <input type="text" class="date hasDatepicker" name="date" data-validation="required" id="dp1496597208353"><img class="ui-datepicker-trigger" src="http://127.0.0.1/toyota_erp/sales/assets/images/date.png" alt="..." title="...">
                        </div>
                        <div>
                            <label>Reg No</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Documents</label>
                            <textarea name="address" placeholder="Documents.."></textarea>   
                        </div>
                        <div>
                            <label>Chasis No</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Order Form No</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Engine No</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Applicant</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Sold To</label>
                            <select name="province" id="province">
                                    <option>Select Province</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>  
                        </div>
                        <div>
                            <label>Vehichle</label>
                            <select name="province" id="province">
                                    <option>Select Province</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>   
                        </div>
                        <div>
                            <label>Salesman</label>
                            <select name="province" id="province">
                                    <option>Select Province</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>   
                        </div>
                        <div>
                            <label>Invoice No</label>
                            <input type="text" name="question" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Invoice Date</label>
                            <input type="text" class="date hasDatepicker" name="date" data-validation="required" id="dp1496597208353"><img class="ui-datepicker-trigger" src="http://127.0.0.1/toyota_erp/sales/assets/images/date.png" alt="..." title="...">    
                        </div>                        
                        <div>
                            <label>Number Plate</label>
                            <input style="margin: 12px 0 0 0;" type="radio" class="customer_ex" data-validation="required" value="New_Customer" name="customer_ex"> 
                            <br>
                            <label>Registration Book</label>
                            <input style="margin: 12px 0 0 0;" type="radio" class="customer_ex" data-validation="required" value="New_Customer" name="customer_ex"> 
                            <br>
                            <label>Document</label>
                            <input style="margin: 20px 0 0 0;" type="radio" class="customer_ex" data-validation="required" value="New_Customer" name="customer_ex"> 
                            <br>
                            <label>Delivered To Sale Person</label>
                            <input style="margin: 12px 0 0 0;" type="radio" class="customer_ex" data-validation="required" value="New_Customer" name="customer_ex"> 
                        </div>
                        
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
//    $('#searchform').hide();
    $('#searchnow').ready(function() {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Faqs/servicegetquestionsanswers",
            type: "POST",
            data: {question: searchnow},
            dataType: "Json",
            success: function(data) {
                counter = 1;
                if (data !== "null")
                {
                    if (data.length > 0) {
                        try {

                            var items = [];
                            $.each(data, function(i, val) {
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
            }, error: function() {
                console.log('error');
            }
        });
    });

    function validationform() {

    }
</script>