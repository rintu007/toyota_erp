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
            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/dhamakapackage/report">
                <fieldset>
                    <legend>Dhamaka Package Report</legend>
                    <div class="feildwrap">
                        <!--<div>-->
                        <!--<label style="/*margin-left: -135px*/">Search</label>-->
                        <!--<input type="text" name="search" id="search" placeholder="Search By Name/Cnic/Ntn">-->
                        <!--</div>-->
                        <div>
                            <label>Search By</label>
                            <select name="filter">
                                <option value="All">All</option>
                                <option value="OrderNumber">By OrderNumber</option>
                                <option value="Brand">By Brand</option>
                            </select>
                        </div>
                        <div id="ByOrderNumber">
                            <label>Order Number</label>
                            <input type="text" name="OrderNumber" />
                        </div>
                        <div id="ByBrand">
                            <label> Brand Name</label>
                            <select name="Brand">
                                <option value="Select Brand">Select Brand</option>
                                <?php
                                foreach ($AllBrand as $Brand) {
                                    ?>
                                    <option value="<?= $Brand['BrandCode'] ?>" ><?= $Brand['BrandName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div style="margin-left: 200px;">
                            <input type="submit" value="Generate PDF" name="pdf"  style="margin-bottom: -14px;height: 30px;">
                        </div>
                        <?php
//                        }
                        ?>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<script>
    $('select[name=filter]').change(function () {
        if ($('select[name=filter]').val() == 'OrderNumber') {
            $('#ByOrderNumber').show();
            $('#ByBrand').hide();
        } else if ($('select[name=filter]').val() == 'Brand') {
            $('#ByBrand').show();
            $('#ByOrderNumber').hide();
        } else {
            $('#ByOrderNumber').hide();
            $('#ByBrand').hide();
        }
    });
</script>
