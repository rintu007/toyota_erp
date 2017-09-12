<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">
            <form method="post" action="<?=site_url('index.php/pbo_list/index')?>" class="form animated fadeIn">
                <h3><?= $PboMessage ?></h3>
                <fieldset>
                    <legend>PBO List</legend>
                    <div class="feildwrap">
                        <div class="">
                            <label >PboNumber</label>
                            <input type="text" data-validation="" name="PboNumber" value="<?= isset($_POST['PboNumber'])?$_POST['PboNumber']:''?>" placeholder="Search By Name/Pbo Num">
                        </div><div class="">
                            <label >Chasis Number</label>
                            <input type="text" data-validation="" name="ChasisNumber" value="<?= isset($_POST['ChasisNumber'])?$_POST['ChasisNumber']:''?>" placeholder="Search By Chasis Number">
                        </div><div class="">
                            <label >Engine Number</label>
                            <input type="text" data-validation="" name="EngineNumber" value="<?= isset($_POST['EngineNumber'])?($_POST['EngineNumber']):''?>" placeholder="Search By Engine Number">
                        </div><div class="">
                            <label >Customer Name</label>
                            <input type="text" data-validation="" name="CustomerName" value="<?= isset($_POST['CustomerName'])?$_POST['CustomerName']:''?>" placeholder="Search By Customer Name">
                        </div>

                        <input type="submit" value="search" class="btn">
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="17%">Name</th>
                                    <th width="10%">PboNumber</th>
                                    <th width="10%">PBO Date</th>                                    
                                    <th width="10%">Engine Number</th>
                                    <th width="10%">Chasis Number</th>
                                    <th width="10%">Booking Amount</th>
                                    <th width="10%">WHT</th>
                                    <th width="10%">Sale Person</th>
                                    <th width="30%">Car</th>
                                    <th width="10%">Color</th>
                                    <th width="10%">Mobile No.</th>
                                    <th width="18%">Detail</th>
                                </tr>
                            </thead>
                            <tfoot>
                            <tr>

                                <td colspan="15">
                                    <div id="paging">
                                        <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                            Total : <?php echo $counts ?>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                                <tr>
                                    <td colspan="13">
                                        <div id="paging">
                                            <ul>
                                                <?php echo $links ?>
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php

                                foreach ($ResourceBook as $CarPboResourceBook) {
                                    $ResourceBookId = $CarPboResourceBook['IdResourceBook'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $page++ ?></td>
                                        <td class="tbl-name"><?= $CarPboResourceBook['CustomerName'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['PboNumber'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['Date'] ?></td>                           
                                        <td class="tbl-date"><?= $CarPboResourceBook['EngineNumber'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['ChasisNumber'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['EFAmount'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['FIAmount'] ?></td>
                                        <td class="tbl-date"><?= $CarPboResourceBook['ActualSalePerson'] ?></td>
                                        <td class="tbl-variants"><?= $CarPboResourceBook['Variants'] ?></td>
                                        <td class="tbl-color"><?= $CarPboResourceBook['ColorName'] ?></td>
                                        <td class="tbl-phone"><?= $CarPboResourceBook['Cellphone'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>index.php/pbo_list/printPBO/<?= $CarPboResourceBook['Id'] ?>">print</a>
                                            <a href="<?= base_url() ?>index.php/pbo/getPBO/<?= $CarPboResourceBook['Id'] ?>">View</a>
                                            <?php if ($CarPboResourceBook['DispatchCreated'] == '0') { ?>
                                                <a href="<?= base_url() ?>index.php/pbo/editPBO/<?= $CarPboResourceBook['Id'] ?>">Edit</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

