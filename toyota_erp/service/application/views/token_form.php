
<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/admin_leftmenu.php';
        }
        if($this->session->flashdata('message')){
        ?>
            <div>
                <h1 class="fadeIn" style="background: green;text-align: center;font-size: xx-large;">
                    <?= $this->session->flashdata('message')?>
                </h1>
            </div>

        <?php } ?>

        <div class="right-pnel">
            <form id="tokenform" action="<?= base_url() ?>index.php/token/add" onSubmit="return validationform();" method="post" class="form validate-form animated fadeIn">

                <!--                --><?//= $Response ?>
                <fieldset>
                    <legend>Token System</legend>


                    <div class="feildwrap" >
                        <div>
                            <label>Token #</label>
                            <input id="idToken" type="text" value="<?=sprintf('%03d', $tokenNumber)?>" disabled name="idToken" >
                        </div>
                        <br>
                        <div>
                            <label>Date</label>
                            <input id="date" type="text" name="" readonly value="<?= date('d-M-Y')?>" class="date" placeholder="Enter date" data-validation="">
                        </div>
                        <div>
                            <label>Time</label>
                            <input id="time" type="text" name="" class="date" disabled data-validation="">
                        </div>

                        <div>
                            <label>Category</label>
                            <select name="idCategory" id="idCategory" class="chosen-select" style="width: 273px">
                                <?php
                                foreach ($s_category as $row)
                                {?>
                                    <option value="<?=$row['idCategory']?>"><?=$row['Name']?></option>

                                <?php }?>
                            </select>

                        </div>
                        <div>
                            <label>Appointment</label>
                            <input id="idAppointment" type="text" name="idAppointment" placeholder="Enter Appointment">
                            <button type="button" class="btn" onclick="showpopup('customerlist')">List</button>

                        </div>
                        <div>
                            <label>Estimate</label>
                            <input id="idEstimate" type="text" name="idEstimate" placeholder="Enter Estimate">
                            <button type="button" class="btn" onclick="showpopup('customerlist')">List</button>
                        </div>
                        <br>

                        <div>
                            <label>Customer Name</label>
                            <input type="text" name="CustomerName"  id="CustomerName">
                            <input type="hidden" name="idCustomer"  id="idCustomer">
                        </div>
                        <div>
                            <label>Registration</label>
                            <input type="text" name="regNo"  id="RegistrationNumber">
                            <button type="button" class="btn" onclick="showpopup('customerlist')">List</button>

                        </div>
                        <div>
                            <label>Phone</label>
                            <input type="text" name="CompanyContact"  id="CompanyContact">
                        </div>
                        <div>
                            <label>Mobile</label>
                            <input type="text" name="Cellphone"  id="Cellphone">
                        </div>
                        <div>
                            <label>Chasis No</label>
                            <input type="text" id="ChassisNumber" name="ChassisNumber"  value="">
                        </div>
                        <br>
                        <div>
                            <label>Make</label>
                            <select name="make" id="idVariant" class="chosen-select" style="width: 273px">
                                <?php
                                foreach ($variants as $row)
                                {?>
                                    <option value="<?=$row['IdVariants']?>"><?=$row['Variants']?></option>

                                <?php }?>
                            </select>
                        </div>
                        <br>
                        <div>
                            <label>Current Address</label>
                            <input type="text" name="AddressDetails" id="AddressDetails">
                        </div>

                        <div>
                            <label>Email</label>
                            <input type="text" name="CustomerEmail"  id="CustomerEmail">
                        </div>
                        <div>
                            <label>MSI Type</label>
                            <input type="text" name="msitype"  id="msitype">
                        </div>
                        <br>
                        <div>
                            <label>Remakrs</label>
                            <input type="text" name="remarks"  id="remarks" style="width: 300px">
                        </div>




                    </div><br>


                    <input type="submit" style="margin-left: 450px;" class="btn" >
                </fieldset> 
            </form>
        </div>
    </div>
</div>

<div style="width: 750px;" class="feildwrap  popup popup-customerlist">
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
                            <th>RegistrationNumber</th>
                            <th>EngineNumber</th>
                            <th>ChassisNumber</th>
                            <th>CustomerName</th>
                            <th>Cellphone</th>

                        </tr>
                        </thead>
                        <?php
                        $count = 0;
                        foreach ($customer_list as $row){
                            ?>
                            <tr onclick="filldata(<?=$count++?>)">
                                <td><?=$count+1?></td>

                                <td><?=$row['RegistrationNumber']?></td>
                                <td><?=$row['EngineNumber']?></td>
                                <td><?=$row['ChassisNumber']?></td>
                                <td><?=$row['CustomerName']?></td>
                                <td><?=$row['Cellphone']?></td>
                            </tr>

                        <?php } ?>
                    </table>
                </div>
            </fieldset>
        </div><br>
    </form>
</div>

<script>
    $(".chosen-select").chosen()

    var cust_list = <?= json_encode($customer_list,false); ?>;
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
    function filldata(i){
        $('#idDispatch').val(i)

        console.log(cust_list[i]);

        $.each((cust_list[i]),function(j,v){
           $('#'+j).val(v)
        })
        $(".chosen-select").trigger("chosen:updated");
//
//                $('#IdVariants').val(a.IdVariants)
//                $('#engine_no').val(a.EngineNo)
//                $('#IdVariants').val(a.Variants)
////                $('#engine_no').val(a.RegistrationNumber)
//                $('#IdColor').val(a.ColorName)
//                $('#delivered_to').val(a.CustomerName)
//                $('#current_address').val(a.AddressDetails)
//                $('#telephone_no').val(a.Telephone)
//                $('#mobile').val(a.Cellphone)
//                $('#email').val(a.Email)
//                $('#nic_no').val(a.Cnic)
//                $('#cahsisno').val(a.ChasisNo)
//                $('#InvoiceNumber').val(a.InvoiceNumber)
//                $('#InvoiceDate').val(a.InvoiceDate)
//                $('#PboNumb').val(a.PboNumber)


                $('.popup' ).bPopup().close()


    }

    $('#myTable').DataTable();
</script>

