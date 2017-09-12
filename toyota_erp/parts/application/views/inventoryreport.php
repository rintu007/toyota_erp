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
            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/reports/inventory">
                <fieldset>
                    <legend>Inventory Report</legend>
                    <div class="feildwrap">
                        <!--<div>-->
                        <!--<label style="/*margin-left: -135px*/">Search</label>-->
                        <!--<input type="text" name="search" id="search" placeholder="Search By Name/Cnic/Ntn">-->
                        <!--</div>-->
                        <div>
                            <label>Search By</label>
                            <select name="filter">
                                <option value="All">All</option>
                                <option value="Category">By Category</option>
                                <option value="Manufacturer">By Manufacturer</option>
                            </select>
                        </div>
                        <div id="ByCategory">
                            <label>Search By Part Category</label>
                            <select name="Category">
                                <option>Select Category</option>
                                <?php
                                foreach ($Category as $AllCategories) {
                                    ?>
                                    <option value="<?= $AllCategories['CategoryName'] ?>" ><?= $AllCategories['CategoryName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="ByManufacturer">
                            <label> OR Search By Part Manufacturer</label>
                            <select name="Manufacturer">
                                <option>Select Manufacturer</option>
                                <?php
                                foreach ($Manufacturer as $AllManufacturers) {
                                    ?>
                                    <option value="<?= $AllManufacturers['Manufacturer'] ?>" ><?= $AllManufacturers['Manufacturer'] ?></option>
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
    $('select[name=filter]').change(function() {
        if ($('select[name=filter]').val() == 'Category') {
            $('#ByCategory').show();
            $('#ByManufacturer').hide();
        } else if ($('select[name=filter]').val() == 'Manufacturer') {
            $('#ByManufacturer').show();
            $('#ByCategory').hide();
        } else {
            $('#ByCategory').hide();
            $('#ByManufacturer').hide();
        }
    });
</script>
