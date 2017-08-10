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
                  action="<?= base_url() ?>/index.php/stockreport/pdi_insert" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">

                    <fieldset>
                        <legend>PDI</legend>
                        <div>

                            <label>Dealer</label>
                            <input type="text" name="dealer" id="searchnow"
                            />
                        </div>
                        <div>
                            <label>Model/Variant</label>
                            <input type="text" name="" readonly id="searchnow" value="<?=$data->Variants?>"
                            />
                        </div>
                        <div>
                            <label>Frame/Chasis no</label>
                            <input type="text" name="" readonly id="searchnow" value="<?=$data->ChasisNo?>"
                            />
                        </div>
                        <div>
                            <label>Car Carrier Reg.No.</label>
                            <input type="text" name="" readonly id="searchnow" value="<?=$data->RegistrationNumber?>"
                            />
                        </div>
                        <div>
                            <label>Odometer</label>
                            <input type="text" name="odometer" id="searchnow"
                            />
                        </div>
                        <div>
                            <label>Transporter Name</label>
                            <input type="text" name="transporter" id="searchnow"
                            />
                        </div>
                        <input type="hidden" name="PboId" readonly  value="<?=$data->PboId?>" >
                        <input type="hidden" name="idDispatch" readonly  value="<?=$data->idDispatch?>" >

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
                                    <td  class="tbl-name"><input type="radio" name="apaint-chip" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-chip" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="apaint-chip-remarks" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td>Scratch</td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-screatch" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-screatch" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" value=""  name="apaint-screatch-remarks"/></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td>Dirt/Stain Marks</td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-stain" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="apaint-stain" value=0""></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="apaint-stain-remarks" /></td>
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
                                    <td  class="tbl-name"><input type="radio" name="exterior-bump" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-bump" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="exterior-bump-remarks" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Loose Molding /Ornament</td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-molding" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-molding" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table"  name="exterior-molding-remarks"/></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Damages (Wind Screens, Head Lights...etc)</td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-damages" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-damages" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table"  name="exterior-damages-remakrs" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Dirt / Stain Marks</td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-dirt" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="exterior-dirt" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="exterior-dirt-remarks" /></td>
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
                                    <td  class="tbl-name"><input type="radio" name="interior-scratch" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="interior-scratch" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="interior-scratch-remarks" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Improper Operation (Audio, Remote..</td>
                                    <td  class="tbl-name"><input type="radio" name="interior-improper" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="interior-improper" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="interior-improper-remarks" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Soiling / Dirt / Stain Marks</td>
                                    <td  class="tbl-name"><input type="radio" name="interior-soiling" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="interior-soiling" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table"  name="interior-soiling-remarks"/></td>
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
                                    <td  class="tbl-name"><input type="radio" name="electrical-improper" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-improper" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="electrical-improper-remarks"/></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Battery Discharged</td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-battery" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-battery" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="electrical-battery-remarks"/></td>
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
                                    <td  class="tbl-name"><input type="radio" name="electrical-all" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-all" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="electrical-all-remarks" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >ETC are available or not</td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-etc" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="electrical-etc" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="electrical-etc-remarks" /></td>
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
                                    <td  class="tbl-name"><input type="radio" name="f-engine-overall" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="f-engine-overall" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="f-engine-overall-remarks" /></td>
                                </tr>
                                <tr id="allcomplaints">
                                    <td >Dirt / Stain Marks</td>
                                    <td  class="tbl-name"><input type="radio" name="f-engine-dirt" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="f-engine-dirt" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="f-engine-dirt-remarks"/></td>
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
                                    <td  class="tbl-name"><input type="radio" name="g-any-engine" value="1" checked></td>
                                    <td  class="tbl-name"><input type="radio" name="g-any-engine" value="0"></td>
                                    <td  class="tbl-name"><input type="text" class="inpt-table" name="g-any-engine-remarks" /></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Receiving Report</legend>
                        <div style="float: left; width: 100%;">
                            <label>Received in Proper Condition:</label>
                            <input type="checkbox" name="is_salereturn" id="salereturn" value="0" checked>
                        </div>
                        <div>
                        <div>
                            <label>Inspector's Name:</label>
                            <input type="text" name="inspectorname" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Inspector's Name:</label>
                            <input type="text" name="ddd" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Department:</label>
                            <input type="text" name="department" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Signature:</label>
                            <input type="text" name="Signature" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Designation:</label>
                            <input type="text" name="Designation" id="searchnow"
                            / >
                        </div>
                        <div>
                            <label>Date:</label>
                            <input type="text" name="Date"  class="date"
                            / >
                        </div>
                        <div>
                            <label>Stamp:</label>
                            <input type="text" name="Stamp" id="searchnow"
                            / >
                        </div>
                        <input type="submit" value="submit" >
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

    $("#salereturn").click(function()
    {
        if(!this.checked)
        {
         if(confirm("Are You Sure Want to Return to IMC?"))
         { $(this).prop('checked',false)

         }else
         {
            $(this).prop('checked',true)
         }
        }
    })
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