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
            <form action="<?=base_url()?>index.php/lostsale/getcsv" method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Lost Sale</legend>
                    <div class="feildwrap">
					<button class="btn" id="excel">Excel Report</button>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="10%">Date</th>
                                    <th width="7%">Resource Book No</th>

                                    <th width="17%">Customer Name</th>
                                    <th width="10%">Mobile No.</th>
                                    <th width="10%">Birth Date</th>

                                    <th width="20%">Variant Interested</th>
                                    <th width="10%">Color</th>
                                    <th width="10%">Delivery Month</th>
                                    <th width="18%">Detail</th>
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
                                foreach ($LostSale as $CarLostSale) {
                                    $ResourceBookId = $CarLostSale['IdResourceBook'];
                                    ?>
                                    <tr id="rbRes">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td><?= $CarLostSale['Date'] ?></td>
                                        <td class="tbl-date"><?= $CarLostSale['IdResourceBook'] ?></td>


                                        <td class="tbl-name"><?= $CarLostSale['CustomerName'] ?></td>
                                        <td ><?= $CarLostSale['Cellphone'] ?></td>
                                        <td ><?= $CarLostSale['DateOfBirth'] ?></td>
                                        <td><?= $CarLostSale['Variants'] ?></td>
                                        <td><?= $CarLostSale['ColorName'] ?></td>
                                        <td><?= $CarLostSale['DeliveryMonth'] ?></td>
                                        <td>Lost Sale</td>
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