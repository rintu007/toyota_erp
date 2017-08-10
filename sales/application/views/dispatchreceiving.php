<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);

        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/dispatch/dispatchReceive_insert" class="form validate-form animated fadeIn">

                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>Recieving</legend>
                        <div>
                            <label>Entry No</label>
                            <input type="text" name="question" readonly value="<?= $EntryNo + 1?>" id="searchnow">
                        </div>
                        <div>
                            <label>Entry Date</label>
                            <input type="text" class="date" name="entrydate" data-validation="required">
                        </div>
                        <div>
<!--                            --><?php // print_r($dispatchdata)?>
                            <label>Chasis No</label>
                            <input type="text" value="<?= $dispatchdata->ChasisNo?>" readonly name="question" id="searchnow"
                            >
                        </div>
                        <div>
                            <label>Arrival Date</label>
                            <input type="text" class="date" name="arrivaldate" data-validation="required">
                        </div>
                        <div>
                            <label>Order Form No</label>
                            <input type="text" name="question" id="searchnow">
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
                            <input type="text" class="date" name="reminderdate" >
                        </div>
                        <div>
                            <label>Reg No</label>
                            <input type="text" name="question" readonly value="<?= $dispatchdata->DispatchRegistrationNumber?>" id="searchnow"
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
                            <select name="idparking_row" id="parkingRow">
                                <?php foreach ($parkingRow as $row) {?>
                                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div>
                            <label>Source</label>
                            <select name="idsource" id="source">
                                    <?php foreach ($source as $row) {?>
                                        <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                    <?php }?>
                                </select>
                        </div>
                        <div>
                            <label>Remarks</label>
                            <textarea name="remarks" placeholder=".."></textarea>
                        </div>

                        <div>
                            <label>Swapped Date</label>
                            <input type="text" class="date" name="swappeddate"/>
                        </div>
                        <div>
                            <label>General Stock</label>
                            <input type="checkbox"  name="generalstock"  value="1" >

                        </div>
                        <br>
                        <div>

                            <button type="submit" class="btn">Submit</button>

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
   

    function validationform() {

    }
</script>