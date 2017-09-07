<style>
    .inpt-table {
        width: 95% !important;
        border: none !important;
    }
</style>
<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
        if($this->session->flashdata('message')){
        ?>
        <div>
            <h1 class="fadeIn" style="background: green;text-align: center;font-size: xx-large;">
                <?= $this->session->flashdata('message')?>
            </h1>
        </div>
        <?php } ?>


        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/documentreceive/sales_request_insert" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>Documents From Sales</legend>
                        <div>
                            <button type="button" class="btn" onclick="showpopup('detail')">Select Chassis</button>
                        </div>
                        <br>
                        <div>
                            <label for="salem">For Sale Manager</label>
                            <input type="radio" id="salem"  required name="type" value="Sales">
                        </div>
                        <div>
                            <label for="imc">For IMC</label>
                            <input type="radio" id="imc" required name="type" value="Excise">
<!--                            <button type="button" class="btn" onclick="showpopup('detail')">Select Chassis</button>-->
                        </div>
                        <br>
                        <input type="hidden" required name="idDispatch" id="idDispatch" value="">

                        <div>
                            <label>Chasis No</label>
                            <input type="text" id="cahsisno" readonly value="">


                        </div>

                        <div>
                            <label>Engine No</label>
                            <input type="text"  name="" readonly id="engine_no"/>
                        </div>
                        <div>
                            <label>Vehichle</label>
                            <input name="IdVariants"  readonly class="form-control" id="IdVariants"/>

                        </div>
                        <div>
                            <label>Color</label>
                            <input name="IdColor" readonly class="form-control"  id="IdColor"/>

                        </div>

                        <div>
                            <label>Delivered To</label>
                            <input type="text" name="delivered_to"  id="delivered_to">
                        </div>
                        <div>
                            <label>Current Address</label>
                            <input type="text" name="" readonly id="current_address">
                        </div>
                        <div>
                            <label>City</label>
                            <select name="city" id="city">
                                <option value="Faislabad">Faislabad</option>
                            </select>
                        </div>
                        <div>
                            <label>Telephone No</label>
                            <input type="text" name="" readonly id="telephone_no">
                        </div>
                        <div>
                            <label>Mobile</label>
                            <input type="text" name="" readonly id="mobile">
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="text" name="" readonly id="email">
                        </div>
                        <div>
                            <label>NIC No</label>
                            <input type="text" name="" readonly id="nic_no">
                        </div>
                        <br>
                        <fieldset>
                            <legend>Documents</legend>
                            <?php foreach ($docs as $row){
                                ?>
                                <div>
                                    <label for="<?=$row['iddocument']?>"><?=$row['documentname']?></label>
                                    <input type="checkbox" class="docs" name="iddocument[]" value="<?=$row['iddocument']?>" id="doc_<?=$row['iddocument']?>" />
                                </div>

                                <?php
                            }?>
                        </fieldset>
                        <br>
                        <div >
                            <input type="submit" value="SEND REQUEST" class="btn" >
                        </div>

                    </fieldset>
                </div>



            </form>
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
                            <tr onclick="filldata('<?= $row['idDispatch']?>')">
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
    var a;
    function requestdoc(elem,iddcoc) {
        a = elem
        console.log(a)

//        $(a).removeClass('btn')
        $('.docs').prop('checked',false)
        var idDispatch = $("#idDispatch").val();

        $.ajax({
            url: "<?= base_url() ?>/index.php/Documentreceive/sales_request_insert",
            type: "POST",
            data: {
                idDispatch: idDispatch,
                iddocument: iddcoc
            },
            success: function (data) {
                $(a).html('Request sent')
                $(a).prop('disabled',true)

            }
        });
    };
</script>

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

                $('.popup-detail' ).bPopup().close()


            }
        });
    }

    $('#myTable').DataTable();


</script>
