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
                        <legend>View Headding</legend>
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display:none">Id Headding</th>
                                        <th>Name</th>
                              
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                   
                                    <?php foreach($visitplans as $val) { ?>
                                        <tr>
                                            <td style="display:none"><?=$val['entery_no']?></td>
                                            <td><?=$val['heading']?></td>
                                            
                                            <td><a href="<?=base_url()?>index.php/head/index/<?=$val['id']?>">Edit</a></td>
											
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