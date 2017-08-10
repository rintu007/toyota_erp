<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/requestfordocument/save" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    
                    <fieldset>
                        <legend>Request For Document</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="entery_no" id="entery_no" value="<?=$entery_no?>" readonly >    
                        </div>
                        <div>
                            <label>Entry Date</label>
                           <input name="entry_date" type="text" class="date"/>
                        </div>
                        <div>
                            <label>Reg No</label>
                            <input type="text" name="reg_no" id="searchnow"
                                   >   
                        </div>
                        <div>
                            <label>Documents</label>
                            <textarea name="document_tx" placeholder="Documents.."></textarea>   
                        </div>
                        <div>
                            <label>Chasis No</label>
                             <input type="text" name="chasis_no" id="searchnow"
                                   >   
                        </div>
                        <div>
                            <label>Order Form No</label>
                            <input type="text" name="order_form_no" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Engine No</label>
                           <input type="text" name="engine_no" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Applicant</label>
                            <input type="text" name="application" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Sold To</label>
                             <select name="sold_to">
                            <?php
							for($i=0;$i<count($Customer);$i++)
							{
								echo '<option value="'.$Customer[$i]['IdCustomer'].'">'.$Customer[$i]['CustomerName'].      '</option>';
								
								}
							?>
                            </select>   
                        </div>
                        <div>
                            <label>Vehichle</label>
                            <select name="vehicle">
                            <?php
							for($i=0;$i<count($Variants);$i++)
							{
								echo '<option value="'.$Variants[$i]['IdVariants'].'">'.$Variants[$i]['Variants'].      '</option>';
								
								}
							?>
                            </select>  
                        </div>
                        <div>
                            <label>Salesman</label>
                            <select name="saleman">
                            <?php
							for($i=0;$i<count($Saleman);$i++)
							{
								echo '<option value="'.$Saleman[$i]['Id'].'">'.$Saleman[$i]['FullName'].      '</option>';
								
								}
							?>
                            </select>  
                        </div>
                        <div>
                            <label>Invoice No</label>
                            <input type="text" name="invoice_no" id="searchnow"
                                   >    
                        </div>
                        <div>
                            <label>Invoice Date</label>
                            <input name="invoice_date" type="text" class="date"/>
                        </div>                        
                        <div>
                            <label>Number Plate</label>
                            <input style="margin: 12px 0 0 0;" type="checkbox" class="input_control"  name="no_plate"  value="1" /> 
                            <br>
                            <label>Registration Book</label>
                            <input style="margin: 12px 0 0 0;" type="checkbox" class="input_control"  name="reg_book"  value="1" /> 
                            <br>
                            <label>Document</label>
                           <input style="margin: 12px 0 0 0;" type="checkbox" class="input_control"  name="document"  value="1" /> 
                            <br>
                            <label>Delivered To Sale Person</label>
                           <input style="margin: 12px 0 0 0;" type="checkbox" class="input_control"  name="d_saleman"  value="1" /> 
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