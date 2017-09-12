<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);

        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()"
                   class="form validate-form animated fadeIn">

                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>Recieving</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="question" readonly value="<?= $dispatchdata->id?>" id="searchnow">
                        </div>
                        <div>
                            <label>Entry Date</label>
                            <input type="text" class="date" name="entrydate" value="<?= $dispatchdata->entrydate?>"  data-validation="required">
                        </div>
                        <div>
<!--                            --><?php //print_r($dispatchdata)?>
                            <label>Chasis No</label>
                            <input type="text" value="<?= $dispatchdata->ChasisNo?>" readonly name="question" id="searchnow"
                            >
                        </div>
                        <div>
                            <label>Arrival Date</label>
                            <input type="text" class="date" name="arrivaldate" value="<?= $dispatchdata->arrivaldate?>" readonly data-validation="required">
                        </div>
                        <div>
                            <label>PBO Number</label>
                            <input type="text" name="PboNumber" value="<?= $dispatchdata->PboNumber?>" readonly>
                        </div>
                        <div>
                            <label>Dispatch No</label>
                            <input type="text" name="idDispatch"   value="<?= $dispatchdata->idDispatch?>" readonly id="idDispatch"
                            >
                        </div>
                        <div>
                            <label>Engine No</label>
                            <input type="text" name="EngineNo" value="<?= $dispatchdata->EngineNo?>" readonly id="">
                        </div>
                        <div>
                            <label>Reminder Date</label>
                            <input type="text" class="date" name="reminderdate" value="<?= $dispatchdata->reminderdate?>" readonly>
                        </div>
                        <div>
                            <label>Reg No</label>
                            <input type="text" name="question" readonly value="<?= $dispatchdata->RegistrationNumber?>" id="searchnow"
                            >
                        </div>
                        <div>
                            <label>Vehichle</label>
                            <input type="text" name="question" value="<?= $dispatchdata->Variants?>" readonly id="searchnow">


                        </div>
                        <div>
                            <label>Color</label>
                            <input type="text" name="question"  value="<?= $dispatchdata->ColorName?>" readonly id="searchnow">

                        </div>
                        <div>
                            <label>Parking Row No</label>
                            <input type="text" value="<?=$dispatchdata->parkingname?>">
                        </div>
                        <div>
                            <label>Source</label>
                            <input type="text" value="<?=$dispatchdata->sourcename?>">
                        </div>
                        <div>
                            <label>Remarks</label>
                            <textarea name="remarks"  placeholder=".."><?=$dispatchdata->remarks?></textarea>
                        </div>

                        <div>
                            <label>Swapped Date</label>
                            <input type="text" class="date" name="swappeddate" value="<?= $dispatchdata->swappeddate?>" readonly>
                        </div>
                        <div>
                            <label>General Stock</label>
                            <input type="checkbox" <?=($dispatchdata->generalstock)?'checked':''?>  name="generalstock"  value="1" >

                        </div>
                        <br>
                        <div>

<!--                            <button type="submit" class="btn">Submit</button>-->
                            <a href="<?=site_url("index.php/dispatch/dispatchReceive_list")?>">Back</a>
                        </div>

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
    $('#searchnow').ready(function () {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Faqs/servicegetquestionsanswers",
            type: "POST",
            data: {question: searchnow},
            dataType: "Json",
            success: function (data) {
                counter = 1;
                if (data !== "null") {
                    if (data.length > 0) {
                        try {

                            var items = [];
                            $.each(data, function (i, val) {
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
            }, error: function () {
                console.log('error');
            }
        });
    });

    function validationform() {

    }
</script>