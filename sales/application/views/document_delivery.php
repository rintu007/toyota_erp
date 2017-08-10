<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" method="post"
                  action="<?= base_url() ?>index.php/<?=$action?>" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Document Delivery Form</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="entry_no" id="entry_no" value="<?=$documentdelivery['entry_no']?>" readonly>    
                        </div>
                        <div>
                            <label>Entry Date</label>
                            <input type="text" class="date" name="entry_date" value="<?=$documentdelivery['entry_date']?>"/>
                        </div>
                        <div>
                            <label>Chasis No</label>
                            <input type="text" id="chasis_no" name="chasis_no" value="<?=$documentdelivery['chasis_no']?>"/>    
                        </div>
                        <div>
                            <label>Transfer Date</label>
                            <input type="text" class="date" name="transfer_date" value="<?=$documentdelivery['transfer_date']?>"/>
                        </div>
                        <div>
                            <label>Engine No</label>
                            <input type="text" name="engine_no" id="engine_no" value="<?=$documentdelivery['engine_no']?>">    
                        </div>
                        <div>
                            <label>Vehichle</label>
                            <select name="IdVariants" class="form-control" id="IdVariants">
                    <?php
                    if($documentdelivery['IdVariants'] != '')
                    {
                       foreach ($variant as $val) {  ?> 
                     <option value="<?= $val['IdVariants'] ?>" <?=$val['IdVariants'] == $documentdelivery['IdVariants'] ? 'selected' : '' ?>><?= $val['Variants'] ?></option>  
                    <?php } } else { 
                        foreach ($variant as $val) {  ?> 
                     <option value="<?= $val['IdVariants'] ?>"><?= $val['Variants'] ?></option>  
                    <?php } }
                    ?>
                </select>     
                        </div>
                        <div>
                            <label>Color</label>
                            <select name="IdColor" class="form-control" id="IdColor">
                    <?php
                    if($documentdelivery['IdColor'] != '')
                    {
                       foreach ($color as $val) {  ?> 
                     <option value="<?= $val['IdColor'] ?>" <?=$val['IdColor'] == $documentdelivery['IdColor'] ? 'selected' : '' ?>><?= $val['ColorName'] ?></option>  
                    <?php } } else { 
                        foreach ($color as $val) {  ?> 
                     <option value="<?= $val['IdColor'] ?>"><?= $val['ColorName'] ?></option>  
                    <?php } }
                    ?>
                </select>     
                        </div>
                        <div>
                            <label>Order Type</label>
                            <select name="idordertype" class="form-control" id="idordertype">
                    <?php
                    if($documentdelivery['idordertype'] != '')
                    {
                       foreach ($ordertype as $val) {  ?> 
                     <option value="<?= $val['id'] ?>" <?=$val['id'] == $documentdelivery['idordertype'] ? 'selected' : '' ?>><?= $val['OrderType'] ?></option>  
                    <?php } } else { 
                        foreach ($ordertype as $val) {  ?> 
                     <option value="<?= $val['id'] ?>"><?= $val['OrderType'] ?></option>  
                    <?php } }
                    ?>
                </select>     
                        </div>
                        <div>
                            <label>Delivered To</label>
                            <input type="text" name="delivered_to" id="delivered_to" value="<?=$documentdelivery['delivered_to']?>">    
                        </div>  
                        <div>
                            <label>Current Address</label>
                            <input type="text" name="current_address" id="current_address" value="<?=$documentdelivery['current_address']?>">    
                        </div>  
                        <div>
                            <label>City</label>
                            <select name="city" id="city">
                                    <option value="Faislabad">Faislabad</option>
                                </select>   
                        </div> 
                        <div>
                            <label>Telephone No</label>
                            <input type="text" name="telephone_no" id="telephone_no" value="<?=$documentdelivery['telephone_no']?>">    
                        </div>  
                        <div>
                            <label>Mobile</label>
                            <input type="text" name="mobile" id="mobile" value="<?=$documentdelivery['mobile']?>">    
                        </div> 
                        <div>
                            <label>Email</label>
                            <input type="text" name="email" id="email" value="<?=$documentdelivery['email']?>">    
                        </div> 
                        <div>
                            <label>NIC No</label>
                            <input type="text" name="nic_no" id="nic_no" value="<?=$documentdelivery['nic_no']?>">    
                        </div>                   
                    </fieldset>  
                    <fieldset>
                        <legend>Documents Delivered</legend>
                        <div>
                            <label>Sales Certificate</label>
                            <input style="margin: 10px 0 0 0;" type="checkbox" class="customer_ex" value="1" name="sales_certificate" <?=$documentdelivery['sales_certificate'] == 1 ? 'checked' : ''?>> 
                        </div>
                        <div>
                            <label>Transfer Letter</label>
                            <input style="margin: 10px 0 0 0;" type="checkbox" class="customer_ex"  value="1" name="transfer_letter" <?=$documentdelivery['transfer_letter'] == 1 ? 'checked' : ''?>> 
                        </div>
                        <div>
                            <label>Sales Invoice</label>
                            <input style="margin: 10px 0 0 0;" type="checkbox" class="customer_ex"  value="1" name="sale_invoice" <?=$documentdelivery['sale_invoice'] == 1 ? 'checked' : ''?>> 
                        </div>
                        <div>
                            <label>Navigation Card</label>
                            <input style="margin: 10px 0 0 0;" type="checkbox" class="customer_ex"  value="1" name="navigation_card" <?=$documentdelivery['navigation_card'] == 1 ? 'checked' : ''?>> 
                        </div>
                        <div>
                            <label>Warranty Book</label>
                            <input style="margin: 10px 0 0 0;" type="checkbox" class="customer_ex"  value="1" name="warranty_book" <?=$documentdelivery['warranty_book'] == 1 ? 'checked' : ''?>> 
                        </div>
                    </fieldset>  

                    <input style="margin: 0px 0 0 40px;" class="btn" type="submit" name="submit" value="Submit">
                    <a href="<?=base_url()?>index.php/documentdelivery"><button class="btn" type="button">Back</button></a>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<script>

</script>