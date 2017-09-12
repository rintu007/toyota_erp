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
            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/reports/purchase">
                <fieldset>
                    <legend>Purchase Report</legend>
                    <div class="feildwrap">
                        <!--<div>-->
                        <!--<label style="/*margin-left: -135px*/">Search</label>-->
                        <!--<input type="text" name="search" id="search" placeholder="Search By Name/Cnic/Ntn">-->
                        <!--</div>-->
                        <div>
                            <label>Search By</label>
                            <select name="filter">
                                <option>Select Filter</option>
                                <option value="Type">By Type</option>
                                <option value="Party">By Party</option>
                                <option value="Both">By Type & Party</option>
                            </select>
                        </div>
                        <div id="ByType">
                            <label>Search By Purchase Type</label>
                            <select name="Type">
                                <option>Select Purchase Type</option>
                                <?php
                                foreach ($Type as $AllTypes) {
                                    ?>
                                    <option value="<?= $AllTypes['PurchaseType'] ?>" ><?= $AllTypes['PurchaseType'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div id="ByParty">
                            <label>Search By Party</label>
                            <select name="Party">
                                <option>Select Party</option>
                                <?php
                                foreach ($Party as $AllParties) {
                                    ?>
                                    <option value="<?= $AllParties['Name'] ?>" ><?= $AllParties['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div style="margin-left: 200px;">
                            <input type="submit" value="Generate PDF" name="pdf" id="ReportingButton"  style="margin-bottom: -14px;height: 30px;">
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
        if ($('select[name=filter]').val() == 'Type') {
            $('#ByType').show();
            $('#ReportingButton').show();
            $('#ByParty').hide();
        } else if ($('select[name=filter]').val() == 'Party') {
            $('#ByParty').show();
            $('#ReportingButton').show();
            $('#ByType').hide();
        } else if ($('select[name=filter]').val() == 'Both') {
            $('#ByParty').show();
            $('#ReportingButton').show();
            $('#ByType').show();
        } else {
            $('#ByCategory').hide();
            $('#ByManufacturer').hide();
            $('#ReportingButton').hide();
        }
    });
</script>
