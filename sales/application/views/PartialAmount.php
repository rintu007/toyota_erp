<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn">

                <fieldset>
                    <legend>Partial Amount</legend>
                    <div class="feildwrap">
                        <div>
                            <label style="margin-left: -135px">Search</label>
                            <input type="text" data-validation="required" name="search" id="search"
                                   placeholder="Search By Name/Cnic/Ntn">
                        </div>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="17%">PboNumber</th>
                                    <th width="10%">ResourcebookId</th>
                                    <th width="10%">ChasisNumber</th>
                                    <th width="30%">EngineNumber</th>
                                    <th width="10%">TotalAmount</th>
                                    <th width="10%">ChequeOne</th>
                                    <th width="10%">ChequeTwo</th>
                                    <th width="10%">ChequeThree</th>
                                    <!--				    <th width="10%">BankThree</th>
                                                        <th width="10%">BranhThree</th>-->
                                    <th width="10%">Remaning Amount</th>
                                    <th width="10%">Receive Amount</th>

                                <!--                                    <th width="18%">Detail</th>-->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>

                                    <td colspan="11">
                                        <div id="paging">
                                            <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                                Total : <?php echo $count ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="11">
                                        <div id="paging">
                                            <ul>
                                                <?php echo $links ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($PartialAmount as $Amount) {
                                    $remaining = intval($Amount['TotalAmount']) - (intval($Amount['ChequeOne']) + intval($Amount['ChequeTwo']) + intval($Amount['ChequeThree']));
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $Amount['PboNumber'] ?></td>
                                        <td class="tbl-date"><?= $Amount['ResourcebookId'] ?></td>
                                        <td class="tbl-date"><?= $Amount['ChasisNumber'] ?></td>
                                        <td class="tbl-variants"><?= $Amount['EngineNumber'] ?></td>
                                        <td class="tbl-color"><?= $Amount['TotalAmount'] ?></td>
                                        <td class="tbl-phone"><?= $Amount['ChequeOne'] ?></td>
                                        <td class="tbl-phone"><?= $Amount['ChequeTwo'] ?></td>
                                        <td class="tbl-phone"><?= $Amount['ChequeThree'] ?></td>
                                        <td class="tbl-phone"><?= $remaining; ?></td>
                                        <!--					<td class="tbl-phone"><?= $Amount['BankThree'] ?></td>
                                            <td class="tbl-phone"><?= $Amount['BranchThree'] ?></td>-->

                                        <td class="tbl-phone">
                                            <?php if ($remaining != 0) { ?><a href="<?= base_url() ?>index.php/ReceiveAmount/index/<?= $Amount['PboNumber'] ?>">Receive</a><?php } else { ?> <span style="color: green;">Paid</span></span> <?php } ?>
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
<script>

</script>

