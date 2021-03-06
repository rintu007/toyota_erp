<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';

        if($this->session->flashdata('message')){
            ?>
            <div>
                <h1 class="fadeIn" style="background: green;text-align: center;font-size: xx-large;">
                    <?= $this->session->flashdata('message')?>
                </h1>
            </div>
        <?php } ?>
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
<!--                            <input type="text" id="chasis_no" name="chasis_no" value="--><?//=$documentdelivery['chasis_no']?><!--"/>    -->

                           <?php if(isset($documentdelivery['ChasisNo']))
                           { ?>
                               <input type="text" readonly value="<?=$documentdelivery['ChasisNo']?>">
                           <?php }else {?>
                            <button type="button" class="btn" onclick="showpopup('detail')">Select Chassis</button>


                            <!--                            <select name="idDispatch" id="idDispatch" data-validation="required">-->
<!--                                <option value="">--Select--</option>-->
<!--                                --><?php //foreach ($dispatch as $row){?>
<!--                                    <option value="--><?//=$row['idDispatch']?><!--">--><?//=$row['ChasisNo']?><!--</option>-->
<!---->
<!--                                --><?php //}} ?>
<!--                            </select>-->
                            <?php }?>
                        </div>
                        <div>
                            <label>Pbo Number</label>
                            <input type="text" id="PboNumb" readonly value="<?=$documentdelivery['PboNumber']?>">
                        </div>
                        <div>
                            <label>Transfer Date</label>
                            <input type="text" class="date" name="transfer_date" value="<?=$documentdelivery['transfer_date']?>"/>
                        </div>
                        <div>
                            <label>Engine No</label>
                            <input type="text" name="" readonly id="engine_no" value="<?=$documentdelivery['EngineNo']?>"/>
                        </div>
                        <div>
                            <label>Vehichle</label>
                            <input name="IdVariants"  readonly class="form-control" value="<?=$documentdelivery['Variants']?>" id="IdVariants"/>

                        </div>
                        <div>
                            <label>Color</label>
                            <input name="IdColor" readonly class="form-control" value="<?=$documentdelivery['ColorName']?>"  id="IdColor"/>

                        </div>

                        <div>
                            <label>Delivered To</label>
                            <input type="text" name="delivered_to"  id="delivered_to" value="<?=$documentdelivery['delivered_to']?>">
                        </div>
                        <br>
                        <div>
                            <label>Customer Name</label>
                            <input type="text" name=""  id="cust" readonly value="<?=$documentdelivery['CustomerName']?>">
                        </div>
                        <div>
                            <label>Current Address</label>
                            <input type="text" name="" readonly id="current_address" value="<?=$documentdelivery['AddressDetails']?>">
                        </div>  
                        <div>
                            <label>City</label>
                            <select name="city" id="city">
                                    <option value="Faislabad">Faislabad</option>
                                </select>   
                        </div> 
                        <div>
                            <label>Telephone No</label>
                            <input type="text" name="" readonly id="telephone_no" value="<?=$documentdelivery['Telephone']?>">
                        </div>  
                        <div>
                            <label>Mobile</label>
                            <input type="text" name="" readonly id="mobile" value="<?=$documentdelivery['Cellphone']?>">
                        </div> 
                        <div>
                            <label>Email</label>
                            <input type="text" name="" readonly id="email" value="<?=$documentdelivery['Email']?>">
                        </div> 
                        <div>
                            <label>NIC No</label>
                            <input type="text" name="" readonly id="nic_no" value="<?=$documentdelivery['Cnic']?>">
                        </div>

                        <div>
                            <label>Invoice Number</label>
                            <input type="text" name="" readonly id="InvoiceNumber" value="<?=$documentdelivery['InvoiceNumber']?>">
                        </div>
                        <div>
                            <label>Invoice Date</label>
                            <input type="text" name="" readonly id="InvoiceDate" value="<?=$documentdelivery['InvoiceDate']?>">
                        </div>
                    </fieldset>  
                    <fieldset>
                        <legend>Documents to be Delivered to Customer</legend>

                        <div id="chk">

                        <?php foreach ($docs as $row){
                            ?>
                            <div>
                                <label for="<?=$row['iddocument']?>"><?=$row['documentname']?></label>
                                <input type="checkbox" class="docs" name="iddocument[]" value="<?=$row['iddocument']?>" id="doc_<?=$row['iddocument']?>"
                                <?php if(isset($doc_detail)) {
                                    if(in_array($row['iddocument'],$doc_detail))
                                        echo 'checked';
                                } ?>
                                />
                            </div>

                            <?php
                        }?>
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
<div style="width: 750px;" class="feildwrap  popup popup-detail">
    <form action="" method="POST" class="form animated fadeIn" onSubmit="" style="width: 250px;">
        <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="margin-left: 25px;width: 0px;">
            <fieldset style="">
                <legend>Select Chassis</legend>
                <div class="feildwrap">
                    <table id="myTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Chassis</th>
                            <th>Engine</th>
                        </tr>
                        </thead>
                        <?php
                        $count = 1;
                        foreach ($dispatch as $row){
                            ?>
                            <tr style="CURSOR: pointer;" onclick="filldata('<?= $row['idDispatch']?>')">
                                <td><?=$count++?></td>
                                <td ><?=$row['ChasisNo']?></td>
                                <td><?=$row['EngineNo']?></td>
                            </tr>

                        <?php } ?>
                    </table>
                </div>
            </fieldset>
        </div><br>
    </form>
</div>
<script>

    function showpopup(div_id)
    {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
        });
    }
    function filldata(idDispatch){
        $('#idDispatch').val(idDispatch)
        $('#chk').hide()
        filldocs(idDispatch)
        $.ajax({
            url: "<?= base_url() ?>index.php/documentdelivery/get_dispatch_data",
            type: "POST",
            data: {
                idDispatch: idDispatch
            },
            success: function (data) {
//                console.log(data);
                a = JSON.parse(data);
                console.log(a);


                $('#IdVariants').val(a.IdVariants)
                $('#engine_no').val(a.EngineNo)
                $('#IdVariants').val(a.Variants)
//                $('#engine_no').val(a.RegistrationNumber)
                $('#IdColor').val(a.ColorName)
                $('#delivered_to').val(a.CustomerName)
                $('#current_address').val(a.AddressDetails)
                $('#telephone_no').val(a.Telephone)
                $('#mobile').val(a.Cellphone)
                $('#email').val(a.Email)
                $('#nic_no').val(a.Cnic)
                $('#cahsisno').val(a.ChasisNo)
                $('#InvoiceNumber').val(a.InvoiceNumber)
                $('#InvoiceDate').val(a.InvoiceDate)
                $('#PboNumb').val(a.PboNumber)

                $('.popup-detail' ).bPopup().close()


            }
        });
    }

    function filldocs(idDispatch)
    {

        $.ajax({
            url: "<?= base_url() ?>index.php/documentdelivery/get_received_documents",
            type: "POST",
            data: {
                idDispatch: idDispatch
            },
            success: function (data) {
//                console.log(data);
                a = JSON.parse(data);
                console.log(a);
                if ( a[0].type=='Excise' && (a[0].registered=='0') )
                {
                    alert('Documents Received but not yet Registered From Excise')

                }
                else{

                    html=''
                    $.each(a,function(i,v){
                        html +='<div>\n' +
                            '<label for="1">'+v.documentname+'</label>\n' +
                            '<input type="checkbox" class="docs" name="iddocument[]" value="'+v.iddocument+'" id="doc_'+v.iddocument+'">\n' +
                            '</div>'
                    })

                    $('#chk').html(html)
                    $('#chk').show()


                }

            }
        });
    }

    $('#myTable').DataTable();

    var a;
    $("#idDispatch").change(function () {
        $('.docs').prop('checked',false)
        var idDispatch = $("#idDispatch").val();

        $.ajax({
            url: "<?= base_url() ?>index.php/documentdelivery/get_dispatch_data",
            type: "POST",
            data: {
                idDispatch: idDispatch
            },
            success: function (data) {
//                console.log(data);
                 a = JSON.parse(data);
                console.log(a);



            }
        });
    });
</script>