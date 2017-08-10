<?php include'header.php' ?>
  <div id="wrapper">
    <div id="content">
      <?php include'include/leftmenu.php' ?>
      <div class="right-pnel">
        <form name="myform" onSubmit="return validationform()" method="post" action="#" class="form validate-form animated fadeIn">
          <fieldset>
            <legend>Resource Book</legend>
            <div class="feildwrap">
              <div>
                <label>Date</label>
                <input type="text" name="date" class="date"  data-validation="required">
              </div>
              <div>
                <label>Contact Type</label>
                <select data-validation="required" >
                 <option> </option>
                  <option>Select Contact Type</option>
                </select>
              </div>
              <div>
                <label>Customer Type</label>
                <select data-validation="required" >
                     <option></option>
                  <option>Select Customer  Type</option>
                </select>
              </div>
              <div>
                <label>Customer Name</label>
                <input type="text" name="customer_name" data-validation="required"  >
              </div>
              <div>
                <label>Father/Husband Name</label>
                <input type="text" data-validation="required" name="f_name" >
              </div>
              <div>
                <label>Company Name</label>
                <input type="text" data-validation="required" name="company_name" >
              </div>
              <div>
                <label>Address</label>
                <textarea name="address" data-validation="alphanumeric" placeholder="Address.."></textarea>
              </div>
              <div>
                <label>Province</label>
                <select data-validation="required" >
                     <option></option>
                  <option>Select Province</option>
                </select>
              </div>
              <div>
                <label>City</label>
                <select data-validation="required">
                      <option></option>
                  <option>Select City</option>
                </select>
              </div>
              <div>
                <label>Residential Tel#</label>
                <input type="text" name="Residential_no" data-validation="number" >
              </div>
              <div>
                <label>Office Tel#</label>
                <input type="text" name="Office_no" data-validation="number" >
              </div>
              <div>
                <label>Mobile Tel#</label>
                <input type="text" name="Mobile_no" data-validation="number" >
              </div>
              <div>
                <label>Email Tel#</label>
                <input type="email" name="email" data-validation="email" >
              </div>
              <div>
                <label>Existing Vehicle</label>
                <input type="text" name="existing_vehicle" >
              </div>
              <div>
                <label>Vehicle Interested</label>
                <select name="vehicle_interst" data-validation="required">
                      <option></option>
                  <option>Select Vehicle Interested</option>
                </select>
              </div>
              <div>
                <label>Mode Of Payment</label>
                <select data-validation="required" name="payment_mode">
                      <option></option>
                  <option>Select Payment Mode</option>
                </select>
              </div>
              <div>
                <label>Customer Status</label>
                
                <select data-validation="required" name="customer_status">
                      <option></option>
                  <option>Select Customer Status</option>
                </select>
              </div>
              <div>
                <label>Follow Up</label>
                <span style="width:272px; float:right;">
                <input type="radio" name="follow_up"  >
                7days
                <input type="radio" name="follow_up"  >
                14days
                <input type="radio" name="follow_up"  >
                21days</span>
                 <span class="check">This feild must be filled!</span>
                
                 </div>
                
               
              <div>
                <label>Remarks</label>
                <textarea name="remarks"  placeholder="Remarks.."></textarea>
              </div>
              <div>
                <label>Delivery Month</label>
                <select data-validation="required" name="delivery_month">
                      <option></option>
                  <option>Select Delivery Month</option>
                </select>
              </div>
              <div>
                <label>Allocation Type</label>
                <select data-validation="required" name="allocation_type">
                     <option></option>
                  <option>Select Allocation Type</option>
                </select>
              </div>
              <div>
                <label>CNIC #</label>
                <input type="text" name="CNIC_no"  data-validation="number">
              </div>
              <div>
                <label>NTN #</label>
                <input type="text" name="NTN_no"  data-validation="number" >
              </div>
              <div>
                <label>Salesman</label>
                <input type="text"  name="salesman" readonly placeholder="salesman" title="dynamically put name of login user" >
              </div>
              <div>
                <label>Color Choice One</label>
                <select data-validation="required" name="color_choice_one">
                <option></option>
                  <option>Chose color</option>
                </select>
              </div>
              <div>
                <label>Color Choice Two</label>
                <select name="color_choice_two">
                  <option>Chose color</option>
                </select>
              </div>
              <div class="btn-block-wrap">
                <label>&nbsp;</label>
                <input type="submit" class="btn" value="Save">
                <span>Generate PBO </span> <a href="javascript:" id="btn-pbo"  class="btn">PBO</a> </div>
            </div>
          </fieldset>
        </form>
        
        <div class="hidden pbo-form">
     
               <form action="#" method="post" class="form pbo-form hidden fadeIn">
          <fieldset>
            <legend>Add Details</legend>
            
            <div class="feildwrap">
            
          <table class="form-tbl">
    <tr><td ><label>Pay Order / Cheque No.</label></td><td colspan="3"><input type="text" data-validation="required" name="pay_order" value=""/></td></tr>
    
    <tr><td><label>Image Upload P.B.O.</label></td><td colspan="3"> 
    
    <div class="custom-file-input" id="custom-file-input">
                                    <span class="show-path"></span>
                                    <span class="browse-btn">Browse</span>
                                    <input type="file" data-validation="required"  id="uploaded" name="pbo_img"/>
                                 
                                  
                                </div>
   </td></tr>
   
    <tr><td><label>Date</label></td><td colspan="3"><input type="text" class="date" data-validation="required" style=" width:100px;" name="pay_order" value=""/></td></tr>
        <tr><td ><label>Dispach Note</label></td><td colspan="3"><select data-validation="required"><option></option><option>Select Dispach Note</option></select></td></tr>
    
    
    <tr><td><label>Chasis No.</label></td><td><input type="text" name="pay_order" data-validation="number" value=""/></td>
    
    <td><label style=" width:90px; min-width:90px;">Engine No.</label></td> <td><input type="text" data-validation="number" name="pay_order" value=""/></td>
    </tr>
<tr><td><label>&nbsp;</label></td><td colspan="3"><input type="checkbox" name="partial_payment" value="Partial Payment" ><span for="partial_payment">Partial Payment</span></td></tr>
    <tr><td ><label>Amount</label></td><td colspan="3"><input type="text" name="pay_order" value=""/></td></tr>
  <tr><td><label>&nbsp;</label></td><td colspan="3"><input type="submit" class="btn" value="Submit"></td></tr>
          </table>
            
      
            </div>
            </fieldset>
            </form>
              
               </div>
        
      </div>
    </div>
  </div>
<script>
function validationform(){
chosen = ""
len = document.myform.follow_up.length

for (i = 0; i <len; i++) {
if (document.myform.follow_up[i].checked) {
chosen = document.myform.follow_up[i].value
}
}

if (chosen == "") {
$(".check").show();
return false;
}
else {
$(".check").hide();
return true;
}	
	
	}
</script>
  <?php include'footer.php' ?>