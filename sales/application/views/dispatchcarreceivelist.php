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
            <form class="form animated fadeIn">
                <fieldset>
                    <legend>Car Receive List</legend>
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
                                $count = 1;
                                foreach ($receivelist as $row) {

                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $count++ ?></td>
                                        <td class="tbl-variants"><?= $row['idDispatch'] ?></td>
                                        <td class="tbl-variants"><?= $row['arrivaldate'] ?></td>
                                        <td class="tbl-name"><?= $row['entrydate'] ?></td>
                                        <td class="tbl-date"><?= $row['swappeddate'] ?></td>
                                        <td class="tbl-color"><?= $row['reminderdate'] ?></td>
                                        <td class="tbl-phone"><?= $row['generalstock'] ?></td>
                                        <td class="tbl-phone"><a href="<?=site_url(('index.php/dispatch/dispatchReceive_view').'/'.$row['id'])?>">View</a></td>
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

