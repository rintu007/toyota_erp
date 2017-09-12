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
            <form class="form animated fadeIn"  method="post" action="<?= base_url() ?>/index.php/stockreport/pdi_list">
                <fieldset>
                    <legend>PDI List</legend>
                    <div class="feildwrap">
                        <div class="">
                            <label>Dispatch Number</label>
                            <input type="text" data-validation="" name="idDispatch"
                                   value="<?= isset($_POST['idDispatch']) ? $_POST['idDispatch'] : '' ?>"
                                   placeholder="Search By Dispatch">
                        </div>
                        <div class="">
                            <label>Inspector Name</label>
                            <input type="text" data-validation="" name="inspectorname"
                                   value="<?= isset($_POST['inspectorname']) ? $_POST['inspectorname'] : '' ?>"
                                   placeholder="Search By Name">
                        </div>
                        <div class="">
                            <label>Chasis Number</label>
                            <input type="text" data-validation="" name="ChasisNo"
                                   value="<?= isset($_POST['ChasisNo']) ? $_POST['ChasisNo'] : '' ?>"
                                   placeholder="Search By Chasis Number">
                        </div>
                        <div class="">
                            <label>Created Date</label>
                            <input type="text" data-validation="" name="created_date" class="date"
                                   value="<?= isset($_POST['created_date']) ? ($_POST['created_date']) : '' ?>"
                                   placeholder="Search By Engine Number">
                        </div>


                        <input type="submit" value="search" class="btn">
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="15%">Dispatch Number</th>
                                    <th width="~15%">Sale Return</th>
                                    <th width="17%">Inpsector Name</th>
                                    <th width="10%">Chassis No</th>
                                    <th width="13%">Reg Number</th>
                                    <th width="13%">Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($pdi as $row) {

                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $page++ ?></td>
                                        <td class="tbl-variants"><?= $row['idDispatch'] ?></td>
                                        <td class="tbl-variants"><?= ($row['is_salereturn'])?'YES':'NO'?></td>
                                        <td class="tbl-name"><?= $row['inspectorname'] ?></td>
                                        <td class="tbl-date"><?= $row['ChasisNo'] ?></td>
                                        <td class="tbl-color"><?= $row['RegistrationNumber'] ?></td>
                                        <td class="tbl-phone"><?= $row['created_date'] ?></td>
                                        <td class="tbl-phone"><a href="<?=site_url(('index.php/stockreport/pdi_view').'/'.$row['id'])?>">View</a></td>
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
                                <td colspan="13">
                                    <div id="paging">
                                        <ul>
                                            <?php echo $links ?>
                                        </ul>
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

