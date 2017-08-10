<style>
.feildwrap input[type="text"] {
    width: 179px;
}
.feildwrap select {
    width: auto;
}
</style>
<?php
$data = unserialize($_COOKIE['logindata']);
if ($data['userid'] != "") {
    ?>
    <div id="wrapper">
        <div id="content">
            <?php
            include 'include/admin_leftmenu.php';
            ?>
            <div class="right-pnel">
                <!--<form name="myform" onsubmit="return validationform()" method="post"-->
                <form name="myform" method="post"
                      action="<?= base_url() ?>index.php/ffs/insert_ffs" class="form validate-form animated fadeIn">
<!--                          --><?//= $Response ?>

                    <fieldset>
                        <legend>FOLLOWUP CARD FFS</legend>
                        <div class="feildwrap">
                            <!--<legend>Search</legend>-->
                            <br>
                            <div>
                                <label>Card Number</label>
                                <input type="text" value="<?= $id?>" readonly id="" />
                                <input type="hidden" name="idGatePass" value="<?= $gp->idGatePass?>"  readonly id="" />
                            </div>
                            <div>
                                <label>List Up Date</label>
                                <input type="text"  name="listupdate" class="date"/>
                            </div>
                            <div>
                                <label>Customer Name</label>
                                <input type="text" value="<?= $gp->CustomerName?>" readonly name="" />
                            </div>
                            <div>
                                <label>Mobile</label>
                                <input type="text"  name="" id="" value="<?= $gp->Cellphone?>" readonly/>
                            </div>
                            <div>
                                <label>Contact #</label>
                                <input type="text" name="" id="" value="<?= $gp->Telephone?>" readonly/>
                            </div>
                            <div>
                                <label>Driver Name</label>
                                <input type="text" name="drivername" id="" />
                            </div>
                            <div>
                                <label>Driver Contact</label>
                                <input type="text" name="drivercontact" id=""/>
                            </div>
                            <div>
                                <label>EX Visit Date</label>
                                <input type="text" name="exvisitdate" class="date"/>
                            </div>
                            <div>
                                <label>Chasis Number</label>
                                <input type="text" name="" id="" value="<?= $gp->ChasisNo?>" readonly/>
                            </div>
                            <div>
                                <label>Reg No</label>
                                <input type="text" name="" id=""value="<?= $gp->RegistrationNumber?>" readonly />
                            </div>
                            <div>
                                <label>Make / Variant</label>
                                <input type="text" name="" id="" value="<?= $gp->Variants?>" readonly />
                            </div>
                            <div>
                                <label>Date of Sales</label>
                                <input type="text" class="date" value="<?= $gp->GatePassDate?>" readonly/>
                            </div>
                            <div>
                                <label>Main Type</label>
                                <input type="text" name="maintype" id=""/>
                            </div>
                            <div>
                                <label>Last Repair Order</label>
                                <input type="text" name="" id=""/>
                            </div>
                            <div>
                                <label>Last R/O Date</label>
                                <input type="text" name="" class="date"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <!--<legend style=" background: none repeat scroll 0 0 #000; border: 1px solid #333333; border-radius: 6px; color: #FFFFFF; font-size: 18px; font-weight: normal; padding: 10px 20px; margin-left: 55px; margin-top: 10px; width: 147px; text-align: center; ">Sale Note</legend>-->
                        <legend>1st Call Cycle</legend>
                        <div class="feildwrap">
                            <!--                            <div>
                                                            <label>Sale Note Number</label>
                                                            <input type="text" name="SaleNoteNumber" />
                                                        </div>-->
                            <div>
                                <label>Appointment Date</label>
                                <input type="text" class="date" name="appointmentdate"/>
                            </div>
                            <div>
                                <label>SMS Received</label>
                                <select name="contact_type" class="conType" id="conType">
                                    <option>Select Contact Type</option>
                                    <option value="1">Walk-in</option>
                                    <option value="2">Email</option>
                                    <option value="3">Personal Inquiry Call - Incoming</option>
                                </select>
                            </div>
                            <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="visitplan_table" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Followup Date (Call/Date)</th>
                                        <th>Contacted (Yes/No)</th>
                                        <th>App (Yes/No)</th>
                                        <th>Reason</th>
                                        <th>Problem</th>
                                        <th>Action to be Taken</th>
                                        <th>Action Completed</th>
                                    </tr>
                                </thead>
                                <tbody id="visitplan_tbody">
                                <tr>
                                    <td>
                                        <input type="text" name="followupdate[]" class="date"/>
                                    </td>
                                    <td>
                                        <select name="contacted[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="app[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="reason[]">
                                    </td>
                                    <td>
                                        <input type="text" name="problem[]" class="textoq" id="date1" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actiontaken[]" class="textoq" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actioncompleted[]" class="textoq" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="followupdate[]" class="date"/>
                                    </td>
                                    <td>
                                        <select name="contacted[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="app[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="reason">
                                    </td>
                                    <td>
                                        <input type="text" name="problem[]" class="textoq" id="date1" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actiontaken[]" class="textoq" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actioncompleted[]" class="textoq" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="followupdate[]" class="date"/>
                                    </td>
                                    <td>
                                        <select name="contacted[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="app[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="reason">
                                    </td>
                                    <td>
                                        <input type="text" name="problem[]" class="textoq" id="date1" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actiontaken[]" class="textoq" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actioncompleted[]" class="textoq" value="">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!--<button type="submit" class="btn" id="submit">Save</button> -->   
                        </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <!--<legend style=" background: none repeat scroll 0 0 #000; border: 1px solid #333333; border-radius: 6px; color: #FFFFFF; font-size: 18px; font-weight: normal; padding: 10px 20px; margin-left: 55px; margin-top: 10px; width: 147px; text-align: center; ">Sale Note</legend>-->
                        <legend>2nd Call Cycle</legend>
                        <div class="feildwrap">
                            <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="visitplan_table" width="100%" border="0" cellpadding="1" cellspacing="0">
                               <!-- <thead>
                                    <tr>
                                        <th>Followup Date (Call/Date)</th>
                                        <th>Contacted (Yes/No)</th>
                                        <th>App (Yes/No)</th>
                                        <th>Reason</th>
                                        <th>Problem</th>
                                        <th>Action to be Taken</th>
                                        <th>Action Completed</th>
                                    </tr>
                                </thead>-->
                                <tbody id="visitplan_tbody">
                                <tr>
                                    <td>
                                        <input type="text" name="followupdate[]" class="date"/>
                                    </td>
                                    <td>
                                        <select name="contacted[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="app[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="reason">
                                    </td>
                                    <td>
                                        <input type="text" name="problem[]" class="textoq" id="date1" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actiontaken[]" class="textoq" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actioncompleted[]" class="textoq" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="followupdate[]" class="date"/>
                                    </td>
                                    <td>
                                        <select name="contacted[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="app[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="reason">
                                    </td>
                                    <td>
                                        <input type="text" name="problem[]" class="textoq" id="date1" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actiontaken[]" class="textoq" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actioncompleted[]" class="textoq" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="followupdate[]" class="date"/>
                                    </td>
                                    <td>
                                        <select name="contacted[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="app[]" id="">
                                            <option value="1" >Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="reason">
                                    </td>
                                    <td>
                                        <input type="text" name="problem[]" class="textoq" id="date1" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actiontaken[]" class="textoq" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="actioncompleted[]" class="textoq" value="">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                                <input type="submit" value="Submit" name="typesubmit" class="btn">
                        </div>
                        </div>
                    </fieldset>
                   <!-- <div class="btn-block-wrap">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn" value="Save Sale Note" style="margin-left: 445px;">
                    </div>-->
                </form>
            </div>
        </div>
    </div>
    <script>


    </script>    
    <?php
}
?>