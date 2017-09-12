<div id="wrapper">
    <div id="content">
        <?php
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

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="" class="form validate-form animated fadeIn">
                <div id="searchform" class="feildwrap">
                    <fieldset>
                        <input type="hidden" name="idDispatch" value="<?=$inp['idDispatch']?>">
                        <legend>PDS</legend>
                        <div>
                            <label>Customer Name</label>
                            <input type="text"  readonly value="<?=$i['CustomerName']?>"
                                   />    
                        </div>

                        <div>
                            <label>PboNumber</label>
                            <input type="text"  readonly value="<?=$i['PboNumber']?>"
                                   />
                        </div>
                        <div>
                            <label>ODOMETER</label>
                            <input type="text" name="Odometer" value="<?=$inp['Odometer']?>" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Local </label>
                            <input type="radio" name="type" value="<?=$inp['type']?>" value="local" checked/>
                        </div>
                        <div>
                            <label>Imported</label>
                            <input type="radio" name="type" value="<?=$inp['type']?>" value="imported"/>
                        </div>
                       <div>
                            <label>Model Code</label>
                            <input type="text" name="Model" value="<?=$inp['Model']?>" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Line of Date</label>
                            <input type="text" name="Line" value="<?=$inp['Line']?>" class="date"
                                   />    
                        </div>
                        <div>
                            <label>JOb Card/RO No</label>
                            <input type="text" name="Cardnumber" value="<?=$inp['Cardnumber']?>" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Frame Number</label>
                            <input type="text" name="Framenumber" value="<?=$inp['Framenumber']?>" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>IMC Dispatch Date</label>
                            <input type="text" name="IMC" value="<?=$inp['IMC']?>" class="date"
                                   />    
                        </div>
                        <div>
                            <label>Warranty Booklet No</label>
                            <input type="text" name="Warranty" value="<?=$inp['Warranty']?>" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>Engine Number</label>
                            <input type="text" name="Engine" value="<?=$i['EngineNo']?>" id="searchnow" readonly />
                        </div>
                        <div>
                            <label>DLR Receive Date</label>
                            <input type="text" name="DLR" value="<?=$inp['DLR']?>" id="searchnow"
                                   />    
                        </div>
                        <div>
                            <label>IMC/TTC INV.NO</label>
                            <input type="text" name="TTC" value="<?=$inp['TTC']?>" id="searchnow"
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
                                        <td><input <?=($row['value']==1)?'checked':''?> value="1"  type="radio"/></td>
                                        <td><input <?=($row['value']==2)?'checked':''?> value="2"  type="radio"/></td>
                                        <td><input <?=($row['value']==3)?'checked':''?> value="3"  type="radio"/></td>
                                        <td><input <?=($row['value']==4)?'checked':''?> value="4"  type="radio"/></td>
                                    </tr>
                                <?php
                                }?>






                                </tbody>
                            </table>
                        </div>         
                    </fieldset> 
                </div>
            </form>
        </div>
    </div>
</div>
