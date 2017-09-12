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
                    <legend>PDS Request List</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;" width="7%">S No.</th>
                                    <th width="">Dispatch Number</th>
                                    <th width="">Pbo Number</th>
                                    <th width="">Chassis</th>
                                    <th width="">Engine</th>
                                    <th width="">Dispatch Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($pdsList as $row) {
								
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $row['idDispatch'] ?></td>
                                        <td class="tbl-date"><?= $row['PboId'] ?></td>
                                        <td class="tbl-date"><?= $row['ChasisNo'] ?></td>
                                        <td class="tbl-color"><?= $row['EngineNo'] ?></td>
                                        <td class="tbl-phone"><?= $row['DispatchedDate'] ?></td>

                                        <td>
                                            <button class=""><a href="<?=site_url("index.php/invoice/pds").'/'.$row['idDispatch']?>">Create PDS</a></button>

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


