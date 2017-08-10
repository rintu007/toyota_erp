<style>
    .inpt-table {
        width: 95% !important;
        border: none !important;
    }
</style>
<?php
include 'include/admin_leftmenu.php';
$cookieData = unserialize($_COOKIE['logindata']);

?>

<div id="wrapper">
    <div id="content">
        <?php
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
                  action="<?= base_url() ?>/" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>PDI #<?=$row['id']?> View </legend>
                        <div>

                            <label>Dealer</label>
                            <input type="text" name="dealer" id="searchnow" value="<?=$row['dealer']?>"
                            />
                        </div>
                        <div>
                            <label>Model/Variant</label>
                            <input type="text" name="" readonly id="searchnow" value="<?=$row['Variants']?>"
                            />
                        </div>
                        <div>
                            <label>Frame/Chasis no</label>
                            <input type="text" name="" readonly id="searchnow" value="<?=$row['ChasisNo']?>"
                            />
                        </div>
                        <div>
                            <label>Car Carrier Reg.No.</label>
                            <input type="text" name="" readonly id="searchnow" value="<?=$row['RegistrationNumber']?>"
                            />
                        </div>
                        <div>
                            <label>Odometer</label>
                            <input type="text" name="odometer" value="<?=$row['odometer']?>" id="searchnow"
                            />
                        </div>
                        <div>
                            <label>Transporter Name</label>
                            <input type="text" name="transporter" value="<?=$row['transporter']?>" id="searchnow"
                            />
                        </div>
                        <input type="hidden" name="PboId"  readonly  value="<?=$row['PboId']?>" >
                        <input type="hidden" name="idDispatch"  readonly  value="<?=$row['idDispatch']?>" >

                    </fieldset>
                </div>
                <br>
                <div id="searchform" class="feildwrap">
                    <fieldset>
                        <legend>Check Points for walk around Inspections</legend>
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>A-PAINT</th>
                                    <th>OK</th>
                                    <th>NG</th>
                                    <th>Remarks/Details</th>
                                </tr>
                                </thead>

                                <tbody id="shwallcomplaints">

                                <tr id="allcomplaints">
                                    <td>Chip</td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-chip" <?=($row['apaint-chip'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-chip" <?=($row['apaint-chip'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" value="<?=$row['apaint-chip-remarks']?>" name="apaint-chip-remarks" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td>Scratch</td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-screatch" <?=($row['apaint-screatch'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-screatch" <?=($row['apaint-screatch'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" value="<?=$row['apaint-screatch-remarks']?>"  name="apaint-screatch-remarks"/></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td>Dirt/Stain Marks</td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-stain" <?=($row['apaint-stain'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-stain" <?=($row['apaint-stain'])?'':'checked'?> value=0""></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="apaint-stain-remarks"  value="<?=$row['apaint-stain-remarks'] ?>" /></td>
                                </tr>
                                <thead>
                                <tr>
                                    <th>B-EXTERIOR</th>
                                    <th>OK</th>
                                    <th>NG</th>
                                    <th>Remarks/Details</th>
                                </tr>
                                </thead>
                                <tr id="allcomplaints">
                                    <td >Body Dent / Bump</td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-bump" <?=($row['exterior-bump'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-bump" <?=($row['exterior-bump'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="exterior-bump-remarks" value="<?=$row['exterior-bump-remarks'] ?>" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Loose Molding /Ornament</td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-molding" <?=($row['exterior-molding'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-molding" <?=($row['exterior-molding'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table"  name="exterior-molding-remarks" value="<?=$row['exterior-molding-remarks'] ?>"/></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Damages (Wind Screens, Head Lights...etc)</td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-damages" <?=($row['exterior-damages'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-damages" <?=($row['exterior-damages'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table"  name="exterior-damages-remakrs" value="<?=$row['exterior-damages-remakrs'] ?>" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Dirt / Stain Marks</td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-dirt" <?=($row['exterior-dirt'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-dirt" <?=($row['exterior-dirt'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="exterior-dirt-remarks" value="<?=$row['exterior-dirt-remarks'] ?>" /></td>
                                </tr>
                                <thead>
                                <tr>
                                    <th>C-INTERIOR</th>
                                    <th>OK</th>
                                    <th>NG</th>
                                    <th>Remarks/Details</th>
                                </tr>
                                </thead>
                                <tr id="allcomplaints">
                                    <td >Scratch</td>
                                    <td  class="tbl-name"><input type="radio" name="interior-scratch" <?=($row['interior-scratch'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="interior-scratch" <?=($row['interior-scratch'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="interior-scratch-remarks" value="<?=$row['interior-scratch-remarks'] ?>" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Improper Operation (Audio, Remote..</td>
                                    <td  class="tbl-name"><input type="radio" name="interior-improper" <?=($row['interior-improper'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="interior-improper" <?=($row['interior-improper'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="interior-improper-remarks" value="<?=$row['interior-improper-remarks'] ?>" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Soiling / Dirt / Stain Marks</td>
                                    <td  class="tbl-name"><input type="radio" name="interior-soiling" <?=($row['interior-soiling'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="interior-soiling" <?=($row['interior-soiling'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table"  name="interior-soiling-remarks" value="<?=$row['interior-soiling-remarks'] ?>"/></td>
                                </tr>
                                <thead>
                                <tr>
                                    <th>D-ELECTRICAL & ACCESSORY:</th>
                                    <th>OK</th>
                                    <th>NG</th>
                                    <th>Remarks/Details</th>
                                </tr>
                                </thead>
                                <tr id="allcomplaints">
                                    <td >Improper Operation (All Lamps.. etc)</td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-improper" <?=($row['electrical-improper'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-improper" <?=($row['electrical-improper'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="electrical-improper-remarks" value="<?=$row['electrical-improper-remarks'] ?>"/></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Battery Discharged</td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-battery" <?=($row['electrical-battery'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-battery" <?=($row['electrical-battery'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="electrical-battery-remarks" value="<?=$row['electrical-battery-remarks'] ?>"/></td>
                                </tr>
                                <thead>
                                <tr>
                                    <th>E-MISIING ITEMS CHECK:</th>
                                    <th>OK</th>
                                    <th>NG</th>
                                    <th>Remarks/Details</th>
                                </tr>
                                </thead>
                                <tr id="allcomplaints">
                                    <td >All Manuals, Tool Kit, Cigarette Lighter, Remote..</td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-all" <?=($row['electrical-all'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-all" <?=($row['electrical-all'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="electrical-all-remarks"  value="<?=$row['electrical-all-remarks'] ?>"/></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >ETC are available or not</td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-etc" <?=($row['electrical-etc'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-etc" <?=($row['electrical-etc'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="electrical-etc-remarks"  value="<?=$row['electrical-etc-remarks'] ?>"/></td>
                                </tr>
                                <thead>
                                <tr>
                                    <th>F-ENGINE CONDITION:</th>
                                    <th>OK</th>
                                    <th>NG</th>
                                    <th>Remarks/Details</th>
                                </tr>
                                </thead>
                                <tr id="allcomplaints">
                                    <td >Overall Visual Check</td>
                                    <td  class="tbl-name"><input type="radio" name="f-engine-overall" <?=($row['f-engine-overall'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="f-engine-overall" <?=($row['f-engine-overall'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="f-engine-overall-remarks" value="<?=$row['f-engine-overall-remarks'] ?>" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Dirt / Stain Marks</td>
                                    <td  class="tbl-name"><input type="radio" name="f-engine-dirt" <?=($row['f-engine-dirt'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="f-engine-dirt" <?=($row['f-engine-dirt'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="f-engine-dirt-remarks" value="<?=$row['f-engine-dirt-remarks'] ?>"/></td>
                                </tr>
                                <thead>
                                <tr>
                                    <th>G-Any other additional observation:</th>
                                    <th>OK</th>
                                    <th>NG</th>
                                    <th>Remarks/Details</th>
                                </tr>
                                </thead>
                                <tr id="allcomplaints">
                                    <td ><input type="text" name="g-any-engine-input" class="inpt-table" /></td>
                                    <td  class="tbl-name"><input type="radio" name="g-any-engine" <?=($row['g-any-engine'])?'checked':''?> value="1"></td>
                                    <td  class="tbl-name"><input type="radio" name="g-any-engine" <?=($row['g-any-engine'])?'':'checked'?> value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="g-any-engine-remarks" value="<?=$row['g-any-engine-remarks'] ?>" /></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Receiving Report</legend>
                        <div style="float: left; width: 100%;">
                            <label>Received in Proper Condition:</label>
                            <input type="checkbox" name="is_salereturn" id="salereturn" <?=(!$row['is_salereturn'])?'checked':''?>  readonly value="0">
                        </div>
                        <div>
                        <div>
                            <label>Inspector's Name:</label>
                            <input type="text" name="inspectorname" value="<?= $row['inspectorname']?>" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Inspector's Name:</label>
                            <input type="text" name="ddd" value="<?= $row['ddd']?>" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Department:</label>
                            <input type="text" name="department" value="<?= $row['department']?>" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Signature:</label>
                            <input type="text" name="Signature" value="<?= $row['Signature']?>" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Designation:</label>
                            <input type="text" name="Designation" value="<?= $row['Designation']?>" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Date:</label>
                            <input type="text" name="Date" value="<?= $row['Date']?>"
                            / >
                        </div>
                        <div>
                            <label>Stamp:</label>
                            <input type="text" name="Stamp" value="<?= $row['Stamp']?>" id="searchnow"
                            / >
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


</script>