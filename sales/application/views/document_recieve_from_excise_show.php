<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        
            include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">

            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Faqs/addfaqs" class="form validate-form animated fadeIn">
                
                 <div id="searchform" class="feildwrap">
                    <fieldset>
                        <legend>View Document Rec. From Excise</legend>
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                   <tr>
                                        <th>Entry No</th>
                                        <th>Entry Date</th>
                                        <th>Invoice Date</th>
                                        <th>Customer</th>
                                        <th>Chasis No</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                   
                                    <?php foreach($testDrive as $val) { ?>
                                        <tr>
                                            <td><?=$val['entry_no']?></td>
                                            <td><?=$val['entry_date']?></td>
                                            <td><?=$val['invoice_date']?></td>
                                            <td><?=$val['CustomerName']?></td>
                                            <td><?=$val['chasis_no']?></td>
                                            <td><a href="<?=base_url()?>index.php/Documentrecievefromexcise/edit/<?=$val['id_excise']?>">Edit</a></td>
                                        </tr>
                                    <?php } ?>   
                                </tbody>
                            </table>
                        </div>         
                    </fieldset>       
                </div>
            </form>
        </div>
    </div>
</div>
<script>

</script>