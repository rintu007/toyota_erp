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
            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/reports/losssalereport">
                <fieldset>
                    <legend>RO Service/Fill Rate Report</legend>
                    <div class="feildwrap">
                        <!--<div>-->
                        <!--<label style="/*margin-left: -135px*/">Search</label>-->
                        <!--<input type="text" name="search" id="search" placeholder="Search By Name/Cnic/Ntn">-->
                        <!--</div>-->

							 <div>
                            <label>Month & Year</label>
                            <input type="month" class="" name="monthyear" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>

                        <br>

                        <div style="margin-left: 200px;">
                            <input type="submit" value="RO Service Rate Report" name="service"  style="margin-bottom: -14px;height: 30px;">
                        </div>
                        <div style="margin-left: 200px;">
                            <input type="submit" value="RO Fill Rate Report" name="fill"  style="margin-bottom: -14px;height: 30px;">
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
