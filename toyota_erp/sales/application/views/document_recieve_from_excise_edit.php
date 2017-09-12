<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Documentrecievefromexcise/update" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Edit Document Rec. From Excise</legend>
                        <div>
                            <label>Entry No</label>
                             <input type="text" name="entery_no" id="entery_no" value="<?php echo $testDrivedetail['entry_no']; ?>" readonly >   
                        </div>
                        <div>
                            <label>Entry Date</label>
                            <!--/*<input type="text" class="date hasDatepicker" name="date" data-validation="required" id="dp1496597208353"><img class="ui-datepicker-trigger" src="http://127.0.0.1/toyota_erp/sales/assets/images/date.png" alt="..." title="...">*/-->
                            <input name="entry_date" type="text" class="date" value="<?php echo $testDrivedetail['entry_date']; ?>"/>
                        </div>
                        <div>
                            <label>Chasis No</label>
                            <input type="text" name="chasis_no" id="searchnow" value="<?php echo $testDrivedetail['chasis_no']; ?>"
                                   >    
                        </div>
                        <div>
                            <label>Invoice Date</label>
                            <input name="invoice_date" type="text" class="date" value="<?php echo $testDrivedetail['invoice_date']; ?>"/>
                        </div>
                        <div>
                            <label>Engine No</label>
                            <input type="text" name="engine_no" id="searchnow" value="<?php echo $testDrivedetail['engine_no']; ?>">    
                        </div>
                        <div>
                            <label>Reg No</label>
                            <input type="text" name="reg_no" id="searchnow" value="<?php echo $testDrivedetail['reg_no']; ?>"
                                   >    
                        </div>
                        <div>
                            <label>Vehichle</label>
                           <!-- <select name="vehicle" id="province" >
                            <option><?php //echo $testDrivedetail['vehicle']; ?></option>
                                    <option>Select Vehicle</option>
                                    <option value="TOYOTA">TOYOTA</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select> -->
                             
                            <select name="vehicle">
                                <option><?php echo $testDrivedetail['Variants']; ?></option>
                            <?php
							for($i=0;$i<count($Variants);$i++)
							{
								echo '<option value="'.$Variants[$i]['IdVariants'].'">'.$Variants[$i]['Variants'].      '</option>';
								
								}
							?>
                            </select>
                        </div>
                        <div>
                            <label>Color</label>
                            
                          <!--  <select name="vehicle_color" id="province">
                            <option><?php //echo $testDrivedetail['vehicle_color']; ?></option>
                                    <option>Select Color</option>
                                    
                                    <option value="BLACK">BLACK</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>   -->
                            
                             <select name="vehicle_color">
                                 <option><?php echo $testDrivedetail['ColorName']; ?></option>
                            <?php
							for($i=0;$i<count($VariantsColor);$i++)
							{
								echo '<option value="'.$VariantsColor[$i]['IdColor'].'">'.$VariantsColor[$i]['ColorName'].      '</option>';
								
								}
							?>
                            </select>
                        </div>
                        <div>
                            <label>Model</label>
                        <!--    <select name="model" id="province">
                            <option><?php //echo $testDrivedetail['model']; ?></option>
                                    <option>Select Model</option>
                                    
                                    <option value="2001">md-21</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>   -->
                            
                            <select name="model">
                                <option><?php echo $testDrivedetail['Model']; ?></option>
                            <?php
							for($i=0;$i<count($Model_no);$i++)
							{
								echo '<option value="'.$Model_no[$i]['IdModel'].'">'.$Model_no[$i]['Model'].      '</option>';
								
								}
							?>
                            </select> 
                        </div>
                        <div>
                            <label>Customer</label>
                        <!--    <select name="sold_to" id="province">
                            <option><?php //echo $testDrivedetail['sold_to']; ?></option>
                                    <option>Select customer</option>
                                   
                                    <option value="haseeb">Haseeb</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>  -->   
                            
                            <select name="sold_to">
                                     <option><?php echo $testDrivedetail['CustomerName']; ?></option>
                            <?php
							for($i=0;$i<count($Customer);$i++)
							{
								echo '<option value="'.$Customer[$i]['IdCustomer'].'">'.$Customer[$i]['CustomerName'].      '</option>';
								
								}
							?>
                            </select> 
                        </div>                     
                        <div>
                            <label>Number Plate</label>
                             <input style="margin: 12px 0 0 0;" type="checkbox" class="input_control"  name="no_plate" value="1" <?=$testDrivedetail['no_plate'] == 1 ? 'checked':''?>/>
                            <br>
                            <label>Registration Book</label>
                            <input style="margin: 12px 0 0 0;" type="checkbox" class="input_control"  name="reg_book" value="1" <?=$testDrivedetail['reg_book'] == 1 ? 'checked':''?>/> 
                            <br>
                            <label>Document</label>
                           <input style="margin: 12px 0 0 0;" type="checkbox" class="input_control"  name="document" value="1"  <?=$testDrivedetail['document'] == 1 ? 'checked' :''?>/>  
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