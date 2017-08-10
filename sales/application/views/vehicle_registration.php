<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform"  method="post"
                  action="<?= base_url() ?>index.php/<?=$action?>" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Vehicle Registration</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="entry_no" id="entry_no" value = "<?=$vehicle_registeration['entry_no']?>" readonly>    
                        </div>
                        <div>
                            <label>Entry Date</label>
                            <input type="text" class="date" name="entry_date" value = "<?=$vehicle_registeration['entry_date']?>" data-validation="required" id="dp1496597208353"/>
                        </div>
                        <div>
                            <label>Chasis No</label>
                            <input type="text" name="chasis_no" id="chasis_no" value = "<?=$vehicle_registeration['chasis_no']?>" readonly>  
                            <button type="button" id="chasis_list" onclick="financePopup()">List</button>    
                        </div>
                        <div>
                            <label>Invoice Date</label>
                            <input type="text" class="date" name="invoice_date" value = "<?=$vehicle_registeration['invoice_date']?>" data-validation="required" id="invoice_date" readonly/>
                        </div>
                        <div>
                            <label>Engine No</label>
                            <input type="text" name="engine_no" id="engine_no" value = "<?=$vehicle_registeration['engine_no']?>" readonly>  
                        </div>
                        <div>
                            <label>Registered For</label>
                            <input type="text" name="registered_for" id="registered_for" value = "<?=$vehicle_registeration['registered_for']?>" >    
                        </div>
                        <div>
                            <label>Reg No</label>
                            <input type="text" name="registeration_no" id="registeration_no" value = "<?=$vehicle_registeration['registeration_no']?>" > 
                        </div>
                        <div>
                            <label>Reg City</label>
                            <input type="text" name="registeration_city" id="registeration_city" value = "<?=$vehicle_registeration['registeration_no']?>">    
                        </div>
                        <div>
                            <label>Req. Reg City</label>
                            <input type="text" name="requested_registeration_city" id="requested_registeration_city" value = "<?=$vehicle_registeration['registeration_no']?>">    
                        </div>
                        <div>
                            <label>Req. Reg No</label>
                            <input type="text" name="requested_registeration_no" id="requested_registeration_no" value = "<?=$vehicle_registeration['requested_registeration_no']?>">
                        </div>
                        <div>
                            <label>Father Name</label>
                            <input type="text" name="father_name" id="father_name" value = "<?=$vehicle_registeration['father_name']?>" readonly>    
                        </div> 
                        <div>
                            <label>Vehicle</label>
                            <select name="idvariant" class="form-control" id="idvariant" readonly>
                    <?php
                    if($vehicle_registeration['idvariant'] != '')
                    {
                       foreach ($variants as $val) {  ?> 
                     <option value="<?= $val['IdVariants'] ?>" <?=$val['IdVariants'] == $vehicle_registeration['idvariant'] ? 'selected' : '' ?>><?= $val['Variants'] ?></option>  
                    <?php } } else { 
                        foreach ($variants as $val) {  ?> 
                     <option value="<?= $val['IdVariants'] ?>"><?= $val['Variants'] ?></option>  
                    <?php } }
                    ?>
                </select>  
                        </div>                    
                        <div>
                            <label>Address</label>
                            <textarea name="address" id="address"><?=$vehicle_registeration['address']?></textarea>
                        </div>
                        <div>
                            <label>Color</label>
                            <select name="idcolor" class="form-control" id="idcolor" readonly>
                    <?php
                    if($vehicle_registeration['idcolor'] != '')
                    {
                       foreach ($color as $val) {  ?> 
                     <option value="<?= $val['IdColor'] ?>" <?=$val['IdColor'] == $vehicle_registeration['idcolor'] ? 'selected' : '' ?>><?= $val['ColorName'] ?></option>  
                    <?php } } else { 
                        foreach ($color as $val) {  ?> 
                     <option value="<?= $val['IdColor'] ?>"><?= $val['ColorName'] ?></option>  
                    <?php } }
                    ?>
                </select>  
                        </div>
                        <div>
                            <label>NIC No</label>
                            <input type="text" name="nic_no" id="nic_no" value="<?=$vehicle_registeration['nic_no']?>">  
                        </div>
                        <div>
                            <label>Broker</label>
                            <input type="text" name="broker" id="broker" value="<?=$vehicle_registeration['broker']?>">  
                        </div>
                        <div>
                            <label>Salesman</label>
                            <select name="idsalesman" class="form-control" id="idsalesman">
                    <?php
                    if($vehicle_registeration['idsalesman'] != '')
                    {
                       foreach ($saleperson as $val) {  ?> 
                     <option value="<?= $val['Id'] ?>" <?=$val['Id'] == $vehicle_registeration['idsalesman'] ? 'selected' : '' ?>><?= $val['FullName'] ?></option>  
                    <?php } } else { 
                        foreach ($saleperson as $val) {  ?> 
                     <option value="<?= $val['Id'] ?>"><?= $val['FullName'] ?></option>  
                    <?php } }
                    ?>
                </select>  
                        </div> 
                    </fieldset> 
                    <fieldset>
                        <legend>Voucher Detail</legend>
                        <div>
                            <label>Cheque No</label>
                            <input type="text" name="cheque_no" id="cheque_no" value="<?=$vehicle_registeration['cheque_no']?>">    
                        </div>
                        <div>
                            <label>Cheque Date</label>
                            <input type="text" class="date" name="cheque_date" data-validation="required" id="cheque_date" value="<?=$vehicle_registeration['cheque_date']?>" />
                        </div>
                        <div>
                            <label>Amount</label>
                            <input type="text" name="amount" id="amount"  value="<?=$vehicle_registeration['amount']?>">      
                        </div>
                        <div>
                            <label>Credit Account</label>
                            <select name="credit_account" class="form-control" id="credit_account">
                    <?php
                    if($vehicle_registeration['credit_account'] != '')
                    {
                       foreach ($account as $val) {  ?> 
                     <option value="<?= $val['idchartofaccount'] ?>" <?=$val['idchartofaccount'] == $vehicle_registeration['credit_account'] ? 'selected' : '' ?>><?= $val['account_code'] ?></option>  
                    <?php } } else { 
                        foreach ($account as $val) {  ?> 
                     <option value="<?= $val['idchartofaccount'] ?>"><?= $val['account_code'] ?></option>  
                    <?php } }
                    ?>
                </select>   
                        </div>
                        <div>
                            <label>Debit Account</label>
                            <select name="debit_account" class="form-control" id="debit_account">
                    <?php
                    if($vehicle_registeration['debit_account'] != '')
                    {
                       foreach ($account as $val) {  ?> 
                     <option value="<?= $val['idchartofaccount'] ?>" <?=$val['idchartofaccount'] == $vehicle_registeration['debit_account'] ? 'selected' : '' ?>><?= $val['account_code'] ?></option>  
                    <?php } } else { 
                        foreach ($account as $val) {  ?> 
                     <option value="<?= $val['idchartofaccount'] ?>"><?= $val['account_code'] ?></option>  
                    <?php } }
                    ?>
                </select>   
                        </div> 

                        <div>
                            <label>Service Amount</label>
                            <input type="text" name="service_amount" id="service_amount"  value="<?=$vehicle_registeration['service_amount']?>">      
                        </div>
                        <input type="submit" class="btn" value="Save" />
                    </fieldset>      
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit User Pop UP -->

<!-- POP UP -->
<div style="width: 750px;" class="feildwrap  popup popup-detail">
    <form action="" method="POST" class="form animated fadeIn" onSubmit="" style="width: 250px;">
        <img src="http://localhost/toyota_erp/assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="margin-left: 25px;width: 0px;">
            <fieldset style="">
                <legend>Chasis NO</legend>
                <div style="width:100%;" class="feildwrap">
                    <!--<div style="">-->     
                    <div class="btn-block-wrap datagrid" id="shwcompat">
                        <table class="table" width="100%" border="0" cellpadding="1" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Chasis Number</th>
                                    <th>Engine Number</th>
                                </tr>
                            </thead>

                            <tbody>
                               <?php foreach($chasis_no as $val) {?>

                               <tr>
                                   <td><input type="radio" name="selected_chasis_no" class = "selected_chasis_no" value="<?=$val['ChasisNo']?>"></td>
                                   <td><?=$val['ChasisNo']?></td>
                                   <td><?=$val['EngineNo']?></td>
                               </tr>

                               <?php } ?>
                            </tbody>
                        </table>
                        <button type="button" id="select">Select</button>
                    </div>
                </div>
            </fieldset>

        </div><br>
    </form>
</div>

<script>

function financePopup() {
        $('.popup').bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
        });
    }
$('#select').on('click',function(){

    var chasis_no  = $('input[name=selected_chasis_no]:checked').val();
                
               $.post( 
                  "<?=  base_url()?>index.php/vehicle_registeration/getDetail",
                  { chasis_no: chasis_no },
                  function(data) {
                     var value = JSON.parse(data);
                     $('#chasis_no').val(chasis_no);
                     $('#engine_no').val(value.EngineNumber);
                     $('input[name=invoice_date]').val(value.InvoiceDate);
                     $('#idvariant').val(value.IdVariants).change();
                     $('#idcolor').val(value.IdColor).change();
                     $('#address').val(value.AddressDetails);
                     $('#nic_no').val(value.Cnic);
                     $('#father_name').val(value.FatherName);


                  }
               );

     $('.close-pop').click();          

});
</script>