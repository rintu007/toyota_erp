<div id="wrapper">
    <div id="content">
        <?php

        include 'include/admin_leftmenu.php';

        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>SMR (DAMAGE PARTS)</legend>
                    <div class="feildwrap">

                        <h4><?= $message ?></h4>
                    </div>
                    <a  class="btn" style="text-decoration: none;" href="<?= base_url('index.php/parts/createsmr') ?>">Create SMR</a>
                    <a  class="btn" style="text-decoration: none;" href="<?= base_url('index.php/parts/createimgsmr') ?>">Create Image SMR</a>
					<a  class="btn" style="text-decoration: none; background: green; " href="<?= base_url('index.php/parts/getsmr') ?>">SMR(FOR MISTAKE PARTS)</a>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="16%">Dealership</th>
                                    <th width="16%">Remarks</th>
                                    <th width="16%">Created Date</th>
                                    <th width="16%">Action</th>
                                      
                                    
                                    
                                </tr>
                            </thead>.
                              <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($smrsdetails as $smrs) {
                                  
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $smrs['dealership']  ?></td>
                                        <td class="tbl-name"><?= $smrs['Remarks'] ?></td>
                                        <td class="tbl-name"><?= $smrs['datecreated'] ?></td>
                                        <td class="tbl-name"><?= anchor( base_url('index.php/parts/viewimgsmr').'/'.$smrs['idimgsmr'], 'view')  ?></td>
                                        
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


