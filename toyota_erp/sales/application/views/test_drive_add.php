<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';
			//print_r($_POST);
			
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/testdrive/Save" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Test Drive</legend>
                        <div>
                            <label>Entry No</label>
                           <!-- <input type="text" name="question" id="searchnow">-->
                            <input type="text" name="entery_no" id="entery_no" value="<?=$entery_no?>" readonly >    
                        </div>
                        <div>
                            <label>Entry Date</label>
                           <!-- <input type="text" class="date hasDatepicker" name="entry_date" data-validation="required" id=""><img class="ui-datepicker-trigger" src="http://127.0.0.1/toyota_erp/sales/assets/images/date.png" alt="..." title="...">-->
                           <input name="entry_date" type="text" class="date"/>
                        </div>
                        <div>
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" id="searchnow"
                                   >      
                        </div>
                        <div>
                            <label>Address</label>
                            <textarea name="address" placeholder=".."></textarea>
                        </div>
                        <div>
                            <label>Mobile No</label>
                            <input class="hash3" type="text" name="mobile_no" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Telephone No</label>
                            <input class="hash3" type="text" name="telephone" id="searchnow"
                                   >  
                        </div>
                        <div>
                            <label>Email Address</label>
                            <input type="text" name="email_address" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Vehicle Intrested</label>
                            <!--<input type="text" name="Model" id="searchnow"
                                   > -->
                             <select name="Model">
                            <?php
							for($i=0;$i<count($Model_no);$i++)
							{
								echo '<option value="'.$Model_no[$i]['IdModel'].'">'.$Model_no[$i]['Model'].      '</option>';
								
								}
							?>
                            </select> 
                        </div>
                        
                        <div>
                            <label>Existing Vehicle</label>
                           
                           <select name="ExistingVehicle">
                            <?php
							for($i=0;$i<count($Variants);$i++)
							{
								echo '<option value="'.$Variants[$i]['IdVariants'].'">'.$Variants[$i]['Variants'].      '</option>';
								
								}
							?>
                            </select>
                              
                        </div>
                        <div>
                            <label >Occupation</label>
                            <textarea name="occupation" placeholder=".."></textarea>
                        </div>
                        <div>
                            <label>License No</label>
                            <input type="text" name="license_no" id="searchnow"
                                   >    
                        </div>
                        <div><?php //print_r($Salemans); ?>
                            <label>Salesman</label>
                            <select name="Saleman">
                            <?php
							for($i=0;$i<count($Salemans);$i++)
							{
								echo '<option value="'.$Salemans[$i]['Id'].'">'.$Salemans[$i]['FullName'].      '</option>';
								
								}
							?>
                            </select>
                        </div>
                        
                    </fieldset> 
                    <fieldset>
                        <legend>Post Drive Questionare</legend>
                        <div>
                            <label>Smooth Shifting Of Gears</label>
                            <select name="shifting_gear" id="province">
                                    <option>Select option</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select> 
                        </div>
                        <div>
                            <label>Ease Of Driving</label>
                            <select name="ease_drive" id="province">
                                    <option>Select option</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>   
                        </div>
                        <div>
                            <label>Acceleration</label>
                            <select name="acceleration" id="province">
                                    <option>Select option</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select>   
                        </div> 
                        <div>
                            <label>Quietness Of Engine</label>
                            <select name="quitness_engine" id="province">
                                    <option>Select option</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select> 
                        </div>
                        <div>
                            <label>Brake Impact</label>
                            <select name="brake_impact" id="province">
                                    <option>Select option</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select> 
                        </div>
                        <div>
                            <label>Overall Driving Experience</label>
                            <select name="drive_experience" id="province">
                                   <option>Select option</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                </select> 
                        </div>
                        <div>
                                <label>Are You Intended to Buy</label>
                                <!--<input type="checkbox" id="dOrder" name="dOrder" value="check">-->
                                <input type="checkbox" class="input_control"  name="is_intended"  value="subject" />
                               <!-- Text: <input type="text" name="txt" id="txt">
									<input type="checkbox" name="opt" id="opt" value="Y" onclick="check()">-->
                        </div>
                        <br>
                        <div>
                            <label>Reason For Not Interested in Buying</label>
                            <textarea class="textarea" name="is_interest" placeholder=".." ></textarea>
                        </div>
                        <div>
                            <label>Suggestion</label>
                            <textarea class="textarea" name="suggestion" placeholder=".." ></textarea>
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
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
s = 1;
   function check(){
       o = document.getElementById('opt');
       if(o.value=='Y'){
           s++;
           if(s%2==0)
           $('#txt').prop('disabled',true);
           else
           $('#txt').prop('disabled',false);
       }
       
   }
</script> -->
<script>
$(document).ready(function(){
    $('.input_control').change(function () {
        $(".textbox").prop('disabled', this.checked);
        $(".textarea").prop('disabled', this.checked);
    });
    $('.input_control').prop('checked', true);
    $('.input_control').trigger('change');
});
</script>
