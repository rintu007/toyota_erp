<?php include'header.php' ?>
  <div id="wrapper">
    <div id="content">
      <?php include'include/leftmenu.php' ?>
      <div class="right-pnel">
        <form action="#" method="post" class="form animated fadeIn">
          <fieldset>
            <legend>Generate PBO</legend>
            <div class="feildwrap">
              <div>
                <label>CNIC # <span class="required">*</span></label>
                <input type="text" data-validation="number" name="CNIC_no" >
              </div>
              <div class="btn-block-wrap">
                <label>&nbsp;</label>
                <input type="submit" class="btn" value="Submit">
                <!-- <span>Generate PBO </span> <a href="#" class="btn">PBO</a>--> </div>
            </div>
            <div class="btn-block-wrap datagrid">
              <table width="100%" border="0" cellpadding="1" cellspacing="1">
                <thead>
                  <tr>
                     <th width="7%" >S No.</th>
                    <th width="17%">Name</th>
                    <th width="10%">Date</th>
                    <th width="35%">Car</th>
                    <th width="10%">Color</th>
                    <th width="10%">Mobile No.</th>
                    <th width="10%">Detail</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <td colspan="7"><div id="paging">
                        <ul>
                          <li><a href="#"><span>Previous</span></a></li>
                          <li><a href="#" class="active"><span>1</span></a></li>
                          <li><a href="#"><span>2</span></a></li>
                          <li><a href="#"><span>3</span></a></li>
                          <li><a href="#"><span>4</span></a></li>
                          <li><a href="#"><span>5</span></a></li>
                          <li><a href="#"><span>Next</span></a></li>
                        </ul>
                      </div>
                  </tr>
                </tfoot>
                <tbody>
                  <tr>
                   <td>100000</td>
                    <td class="tbl-name" >usman</td>
                    <td>12-12-2013</td>
                    <td>TOYOTA</td>
                    <td>Red</td>
                    <td>03477740448</td>
                    <td><a href="#" onClick="popupbox('detail')" >View</a></td>
                  </tr>
                  <tr>
                   <td>2</td>
                    <td class="tbl-name">usman</td>
                    <td>12-12-2013</td>
                    <td>TOYOTA</td>
                    <td>Red</td>
                    <td>03477740448</td>
                    <td><a href="#" onClick="popupbox('detail')" >View</a></td>
                  </tr>
                  <tr>
                   <td>3</td>
                    <td class="tbl-name">usman</td>
                    <td>12-12-2013</td>
                    <td>TOYOTA</td>
                    <td>Red</td>
                    <td>03477740448</td>
                    <td><a href="#" onClick="popupbox('detail')" >View</a></td>
                  </tr>
                  <tr>
                   <td>4</td>
                    <td class="tbl-name">usman</td>
                    <td>12-12-2013</td>
                    <td>TOYOTA</td>
                    <td>Red</td>
                    <td>03477740448</td>
                    <td><a href="#" onClick="popupbox('detail')" >View</a></td>
                  </tr>
                  <tr>
                   <td>5</td>
                    <td class="tbl-name">usman</td>
                    <td>12-12-2013</td>
                    <td>TOYOTA</td>
                    <td>Red</td>
                    <td>03477740448</td>
                    <td><a href="#" onClick="popupbox('detail')">View</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
           
        
          </fieldset>
        </form>
         <div class="btn-block-wrap">
     
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
<!--pbo detail********-->
<div class="feildwrap  popup popup-detail">
<img src="images/icons/close.png" width="32" height="32" alt="close"  class="close-pop">
 <div>
                <label>Date</label>
                <input type="text" name="date" value="12/12/2013" disabled >
              </div>
              <div>
                <label>Contact Type</label>
                <input type="text" value="Personal" name="contact_type" disabled  >
              </div>
              <div>
                <label>Customer Type</label>
            <input type="text" value="Customer Type" name="customer_type" disabled  >
              </div>
              <div>
                <label>Customer Name</label>
                <input name="customer_name" type="text" disabled="disabled" value="Abdul Rehman" >
              </div>
              <div>
                <label>Father/Husband Name</label>
                <input name="f_name" type="text" disabled="disabled" value="Asad Ullah Shaikh" >
              </div>
              <div>
                <label>Company Name</label>
                <input name="company_name" type="text" disabled="disabled" value="Interactive Cells" >
              </div>
              <div>
                <label>Address</label>
                <textarea name="address" disabled="disabled" placeholder="Address..">House No. 88, Block-B, Gulshan - e - Iqbal
Ruhani Area, Chilla Colony.</textarea>
              </div>
              <div>
                <label>Provence</label>
                    <input name="provence" value="Sindh" type="text" disabled="disabled" >
                
              </div>
              <div>
                <label>City</label>
                   <input name="city" value="Karachi" type="text" disabled="disabled" >
               
              </div>
              <div>
                <label>Residential Tel#</label>
                   <input name="residential_tel" value="021 3456 8462" type="text" disabled="disabled" >
                
              </div>
              <div>
                <label>Office Tel#</label>
                <input name="Office_no" type="text" disabled="disabled" value="021 3456 8762" >
              </div>
              <div>
                <label>Mobile Tel#</label>
                <input name="Mobile_no" type="text" disabled="disabled" value="0300 123 4567" >
              </div>
              <div>
                <label>Email Tel#</label>
                <input name="email" type="email" disabled="disabled" value="abdul.rehman@gmail.com" >
              </div>
              <div>
                <label>Existing Vehicle</label>
                <input name="existing_vehicle" type="text" disabled="disabled" value="Suzuki Margalla" >
              </div>
              <div>
                <label>Vehicle Interested</label>
            
                    <input name="vehicle_interst" value="Toyota Camry" type="text" disabled="disabled" >
              </div>
              <div>
                <label>Mode Of Payment</label>
             
                 <input name="payment_mode" value="Cash" type="text" disabled="disabled" >
              </div>
              <div>
                <label>Customer Status</label>
                    <input name="customer_status" value="Cool" type="text" disabled="disabled" >
               
              </div>
              <div>
                <label>Follow Up</label>
                <input name="follow_up" value="21 days" type="text" disabled="disabled" >
            </div>
              <div>
                <label>Remarks</label>
                <textarea name="remarks" disabled="disabled" placeholder="Remarks..">I would like to have my car within 10
days.</textarea>
              </div>
              <div>
                <label>Delivery Month</label>
                 <input name="delivery_month" value="January" type="text" disabled="disabled" >
             
              </div>
              <div>
                <label>Allocation Type</label>
                 <input name="allocation_type" value="Allocation Type" type="text" disabled="disabled" >
            
              </div>
           
              <div>
                <label>NTN #</label>
                <input name="NTN_no" type="text" disabled="disabled" value="123-4678" >
              </div>
              <div>
                <label>Salesman</label>
                <input name="salesman" type="text" disabled="disabled" placeholder="salesman" title="dynamically put name of login user" value="Hanif Rajpoot" readonly >
              </div>
              <div>
                <label>Color Choice One</label>
               
                 <input name="color_choice_one" class="black" type="text" disabled="disabled" value="" >
               
              </div>
              <div>
              
                <label>Color Choice Two</label>
                <input name="color_choice_two" class="red" type="text" disabled="disabled" value="" >
           
              </div>
             
       
            </div>
            
         

<!--pbo detail*******End*-->

  <?php include'footer.php' ?>