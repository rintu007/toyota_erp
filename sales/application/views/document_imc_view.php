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

            
                
                 <div id="searchform" class="feildwrap">
                   
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                        <a href="<?=base_url()?>index.php/documentdelivery/add"><button class="btn" type="button">Document Delivery Form</button></a>
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Entry No</th>
                                        <th>Entry Date</th>
                                        <th>Chasis No</th>
                                        <th>Engine NO</th>
                                        <th>Delivered To</th>
                                        <th>Cell NO</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                   
                                    <?php foreach($documentdelivery as $val) { ?>
                                        <tr>
                                            <td><?=$val['entry_no']?></td>
                                            <td><?=$val['entry_date']?></td>
                                            <td><?=$val['ChasisNo']?></td>
                                            <td><?=$val['EngineNo']?></td>
                                            <td><?=$val['delivered_to']?></td>
                                            <td><?=$val['Cellphone']?></td>
                                            <td><a href="<?=base_url()?>index.php/documentdelivery/edit/<?=$val['iddocumentdelivery']?>">Edit</a></td>
                                        </tr>
                                    <?php } ?>   
                                </tbody>
                            </table>
                        </div>  
                        <div class="col-md-9">
                                <?php echo $pagination; ?>
                        </div>             
                </div>
        </div>
    </div>
</div>
