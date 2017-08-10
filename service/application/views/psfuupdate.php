<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "CRAdmin" || $data['Role'] == "AdminCR") {
            include 'include/psfu_leftmenu.php';
        } else {
            include 'include/admin_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form method="" class="form animated fadeIn" onsubmit="return false">
                <div class="feildwrap" id="">   
                    <fieldset>
                        <legend>PSFU Update</legend>
                        <?php
                        if ($psfuDue == NULL) {
                            ?>
                            <div><label><b>No Repair Order Exist to Follow</b></label></div>
                        <?php } else { ?>
                            <div>
                                <label style="margin-left: 10px;font-size: larger;font-weight: bold ">
                                    <?php
                                    if ($countRO > 0) {
                                        echo ' RO(s) to give FollowUp  (' . $countRO . ')';
                                    }
                                    ?>
                                </label>
                            </div><br><br><br>
                            <div class="btn-block-wrap datagrid" id="shwmessage">
                                <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="2%">S#</th>
                                            <th width="3%">RO#</th>
                                            <th width="10%">Customer</th>
                                            <th width="8%">Contact#</th>
                                            <th width="12%">Make</th>
                                            <th width="57%">VOC</th>
                                            <th width="8%">Detail</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan="07">
                                                <div id="paging">
                                                </div>
                                        </tr>
                                    </tfoot>   
                                    <tbody id="">
                                        <?php
                                        $count = 1;
                                        $roArray = array();
                                        if ($psfuDue) {
                                            foreach ($psfuDue as $key) {
                                                ?>
                                                <tr id="allcomplaints">
                                                    <td name="complaintsno"><?= $count++ ?></td>
                                                    <td name="complaints" class="tbl-name"><?= $key['RONumber'] ?></td>
                                                    <td name="complaints" class="tbl-name"><?= $key['CustomerName'] ?></td>
                                                    <td name="complaints" class="tbl-name"><?= $key['CustomerContact'] ?></td>
                                                    <td name="complaints" class="tbl-name"><?= $key['Vehicle'] ?></td>
                                                    <td name="complaints" class="tbl-name"><?= $key['VOC'] ?></td>
                                                    <td><a href="<?= base_url() ?>index.php/Psfu/<?= $key['idRO'] ?>/<?= $key['isFIR'] ?>">Give PSFU</a></td>                                          
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?> 

                                            <?php
                                        }
                                    }
                                    ?>
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
    function DoToggle(id) {
        $(id).toggle();
    }
</script>

