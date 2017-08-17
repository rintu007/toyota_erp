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
                <form class="form animated fadeIn"  action="<?=site_url('index.php/dispatch/dispatchReceive_list')?>" method="post">
                <fieldset>
                    <legend>Car Receive List</legend>
                    <div class="feildwrap">
                        <div class="">
                            <label>Dispatch Number</label>
                            <input type="text" data-validation="" name="idDispatch"
                                   value="<?= isset($_POST['idDispatch']) ? $_POST['idDispatch'] : '' ?>"
                                   placeholder="Search By id Dispatch">
                        </div>
                        <div class="">
                            <label>Entry Date</label>
                            <input type="text" data-validation="" name="entrydate" class="date"
                                   value="<?= isset($_POST['entrydate']) ? $_POST['entrydate'] : '' ?>"
                                   placeholder="Search By entrydate">
                        </div>
                        <div class="">
                            <label>Arrival Date</label>
                            <input type="text" data-validation="" name="arrivaldate" class="date"
                                   value="<?= isset($_POST['arrivaldate']) ? $_POST['arrivaldate'] : '' ?>"
                                   placeholder="Search By arrivaldate">
                        </div>
                        <div class="">
                            <label>Remarks</label>
                            <input type="text" data-validation="" name="remarks"
                                   value="<?= isset($_POST['remarks']) ? ($_POST['remarks']) : '' ?>"
                                   placeholder="Search By remarks">
                        </div>


                        <input type="submit" value="search" class="btn">
                    </div>

                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="15%">Dispatch Number</th>
                                    <th width="15%">Arrival Date</th>
                                    <th width="17%">Parking Date</th>
                                    <th width="10%">Entry Date</th>
                                    <th width="13%">Reminder Date</th>
                                    <th width="13%">General Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="finalResult">
                                <?php
//                                $count = 1;
                                foreach ($receivelist as $row) {

                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $page++ ?></td>
                                        <td class="tbl-variants"><?= $row['idDispatch'] ?></td>
                                        <td class="tbl-variants"><?= $row['arrivaldate'] ?></td>
                                        <td class="tbl-name"><?= $row['entrydate'] ?></td>
                                        <td class="tbl-date"><?= $row['swappeddate'] ?></td>
                                        <td class="tbl-color"><?= $row['reminderdate'] ?></td>
                                        <td class="tbl-phone"><?= ($row['generalstock'])?'YES':'NO' ?></td>
                                        <td class="tbl-phone"><a href="<?=site_url(('index.php/dispatch/dispatchReceive_view').'/'.$row['id'])?>">View</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
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
                                <td colspan="15">
                                    <div id="paging">
                                        <ul>
                                            <?php echo $links ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

