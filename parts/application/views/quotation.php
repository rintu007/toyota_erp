<div id="wrapper">
    <div id="content">
        <?php

        include 'include/admin_leftmenu.php';

        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>SMR (FOR MISTAKE PARTS)</legend>
                    <div class="feildwrap">

                        <h4><?= $message ?></h4>
                    </div>
                    <a  class="btn" style="text-decoration: none;" href="<?= base_url('index.php/parts/createQuotation') ?>">Create Quotation</a>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="16%">Customer Name</th>
                                    <th width="16%">PARTS No</th>
									<th width="16%">Description</th>
                                    <th width="16%">Created Date</th>
                                    <th width="16%">Action</th>
                                      
                                    
                                    
                                </tr>
                            </thead>.
                              <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($quotation as $smrs) {
                                  
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $smrs['cusName']  ?></td>
                                        <td class="tbl-name"><?= $smrs['partNo'] ?></td>
                                        <td class="tbl-name"><?= $smrs['description'] ?></td>
                                        <td class="tbl-name"><?= $smrs['date'] ?></td>
                                        <td class="tbl-name"><?= anchor( base_url('index.php/parts/viewquot').'/'.$smrs['quot_id'], 'view')  ?></td>
                                        
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            
                            
                            <tfoot>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul></ul>
                                        </div>
                                </tr>
                            </tfoot>
                          
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>


