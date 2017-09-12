<div id="wrapper">
    <div id="content">
        <?php

        include 'include/admin_leftmenu.php';

        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Gate Pass</legend>
                    <div class="feildwrap">

                        <h4><?= $message ?></h4>
                    </div>
                    <a  class="btn" href="<?= base_url('index.php/parts/creategatepass') ?>">Create Gate Pass</a>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="16%">Employee</th>
                                    <th width="16%">Pbo/Chas</th>
                                    <th width="16%">Created Date</th>
                                    <th width="16%">Action</th>
                                      
                                    
                                    
                                </tr>
                            </thead>.
                              <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($GatePass as $row) {
                                  
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $row['employee']  ?></td>
                                        <td class="tbl-name"><?= $row['pbo/chas'] ?></td>
                                        <td class="tbl-name"><?= $row['CreatedDate'] ?></td>
                                        <td class="tbl-name"><?= anchor( base_url('index.php/parts/viewgatepass').'/'.$row['gatePassId'], 'view')  ?></td>
                                        
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


