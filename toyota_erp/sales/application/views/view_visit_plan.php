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
                        <legend>View Visit Plan</legend>
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Entry No</th>
                                        <th>Entry Date</th>
                                        <th>Sale Person</th>
                                        <th>Location</th>
                                        <th>Visit Date</th>
                                        <th>Day Of Visit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody id="shwallcomplaints">
                                   
                                    <?php foreach($visitplans as $val) { ?>
                                        <tr>
                                            <td><?=$val['entery_no']?></td>
                                            <td><?=$val['entery_date']?></td>
                                            <td><?=$val['Fullname']?></td>
                                            <td><?=$val['Location']?></td>
                                            <td><?=$val['visit_date']?></td>
                                            <td><?=$val['day_of_visit']?></td>
                                            <td><a href="<?=base_url()?>index.php/visitplan/index/<?=$val['idvisitplan']?>">Edit</a></td>
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