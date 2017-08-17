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
            <form class="form animated fadeIn"  method="post" action="<?= base_url() ?>/index.php/gatepass">
                <fieldset>
                    <legend>GatePass List</legend>

                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="15%">id GatePass</th>
                                    <th width="15%">Dispatch Number</th>
                                    <th width="~15%">GatePassNumber</th>
                                    <th width="17%">GatePassDate</th>
                                    <th width="10%">Through</th>
                                    <th width="13%">Cnic</th>
                                    <th width="13%">Company</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($gp as $row) {

                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $page++ ?></td>
                                        <td class="tbl-variants"><?= $row['idGatePass'] ?></td>
                                        <td class="tbl-variants"><?= ($row['dispatchId'])?></td>
                                        <td class="tbl-name"><?= $row['GatePassNumber'] ?></td>
                                        <td class="tbl-date"><?= $row['GatePassDate'] ?></td>
                                        <td class="tbl-color"><?= $row['Through'] ?></td>
                                        <td class="tbl-phone"><?= $row['Cnic'] ?></td>
                                        <td class="tbl-phone"><?= $row['Company'] ?></td>
                                        <td class="tbl-phone">
                                            <button class=""><a href="<?=site_url("index.php/invoice/nudc/").'/'.$row['dispatchId']?>">NVDC</a></button>

                                        </td>
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

