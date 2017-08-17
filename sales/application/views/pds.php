<div id="wrapper">
    <div id="content">

        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/invoice/pds_insert" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">
                    <fieldset>
                        <input type="hidden" name="idDispatch" value="<?=$inp->idDispatch?>">
                        <legend>PDS</legend>
                        <div>
                            <label>Customer Name</label>
                            <input type="text"  readonly value="<?=$inp->CustomerName?>"
                                   />    
                        </div>
                        <div>
                            <label>ODOMETER</label>
                            <input type="text" name="Odometer" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Local
                            <input type="radio" name="type" value="local" checked
                                   />    
                        </div>
                        <div>
                            <label>Imported</label>
                            <input type="radio" name="type" value="imported"
                                   />  
                        </div>
                       <div>
                            <label>Model Code</label>
                            <input type="text" name="Model" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Line of Date</label>
                            <input type="text" name="Line" class="date"
                                   />    
                        </div>
                        <div>
                            <label>Job Card/RO No</label>
                            <input type="text" name="Cardnumber" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Frame Number</label>
                            <input type="text" name="Framenumber" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>IMC Dispatch Date</label>
                            <input type="text" name="IMC" class="date"
                                   />    
                        </div>
                        <div>
                            <label>Warranty Booklet No</label>
                            <input type="text" name="Warranty" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Engine Number</label>
                            <input type="text" name="Engine" id="searchnow" readonly value="<?= $inp->EngineNo ?>"
                                   />    
                        </div>
                        <div>
                            <label>DLR Receive Date</label>
                            <input type="text" name="DLR"  class="date"
                                   />    
                        </div>
                        <div>
                            <label>IMC/TTC INV.NO</label>
                            <input type="text" name="TTC" id="searchnow"
                                   />    
                        </div>
                    </fieldset>
                </div><br>
                 <div id="searchform" class="feildwrap">
                     <fieldset>
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="2">ITEMS</th>
                                        <th colspan="4">CHECK</th>
                                    </tr>
                                </thead>

                                <tbody id="shwallcomplaints">


                                <thead>
                                <tr>
                                    <th colspan="2" >Before Inspection</th>
                                    <th>OK</th>
                                    <th>ADJ</th>
                                    <th>NG</th>
                                    <th>N/A</th>
                                </tr>
                                </thead>
                                <tr >
                                    <td colspan="5">Wash and Clean vehicle. Prepared required gauges and tools,intsall required fuses,install productive covers</td>

                                </tr>

                                <?php
                                $heading = $inputs[0]['heading'];?>
                                <thead>
                                <tr>
                                    <th colspan="6"><?=$heading?></th>
                                </tr>
                                </thead>
                                <?php

                                foreach ($inputs as $row)
                                {
                                    if($heading !=$row['heading'])
                                    {
                                        $heading = $row['heading'];
                                        ?>
                                        <thead>
                                        <tr>
                                            <th colspan="6"><?=$heading?></th>
                                        </tr>
                                        </thead>
                                        <?php
                                    }
                                ?>

                                    <tr id="allcomplaints">
                                        <td>1</td>
                                        <td ><?=$row['name']?></td>
                                        <td><input checked value="1" name="p[<?=$row['id']?>]" type="radio"/></td>
                                        <td><input  value="2" name="p[<?=$row['id']?>]" type="radio"/></td>
                                        <td><input  value="3" name="p[<?=$row['id']?>]" type="radio"/></td>
                                        <td><input  value="4" name="p[<?=$row['id']?>]" type="radio"/></td>
                                    </tr>
                                <?php
                                }?>






                                </tbody>
                            </table>
                        </div>         
                    </fieldset> 
                </div>
                <input type="submit" class="btn" value="Submit" style="float: right;">
            </form>
        </div>
    </div>
</div>
