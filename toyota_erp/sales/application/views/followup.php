<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['username'] == "admin") {
//            include 'include/admin_leftmenu.php';
//        } else if ($cookieData['Role'] == "Sales Admin") {
//            include 'include/sales_leftmenu.php';
//        } else if ($cookieData['Role'] == "Director") {
//            include 'include/director_menu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <form action="#" method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Follow Up</legend>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="14%">Customer Name</th>
                                    <th width="30%">Selected Car</th>
                                    <th width="14%">Color</th>
                                    <th width="14%">Followup Date</th>
                                    <th width="10%">Detail</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <!--                                    <div id="paging">-->
                                        <!--                                        <ul>-->
                                        <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                        <!--                                            <li><a href="" class="active"><span>1</span></a></li>-->
                                        <!--                                            <li><a href=""><span>2</span></a></li>-->
                                        <!--                                            <li><a href=""><span>3</span></a></li>-->
                                        <!--                                            <li><a href=""><span>4</span></a></li>-->
                                        <!--                                            <li><a href=""><span>5</span></a></li>-->
                                        <!--                                            <li><a href=""><span>Next</span></a></li>-->
                                        <!--                                        </ul>-->
                                        <!--                                    </div>-->
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($CustomerFollowup as $Followup) {
                                    $FollowupId = $Followup['id'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $Followup['CustomerName'] ?></td>
                                        <td class="tbl-name"><?= $Followup['Variants'] ?></td>
                                        <td class="tbl-name"><?= $Followup['ColorName'] ?></td>
                                        <td class="tbl-name"><?= date('d/m/Y', strtotime($Followup['followup_date'])) ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>index.php/Followup/attend/<?= $FollowupId ?>">Attend</a>
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