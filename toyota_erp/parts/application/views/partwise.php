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
            <form method="post" target="_blank" class="form animated fadeIn" action="<?= base_url() ?>/index.php/reports/partwise">
                <fieldset>
                    <legend>Part Wise Report</legend>
                    <div class="feildwrap">
                        <!--<div>-->
                        <!--<label style="/*margin-left: -135px*/">Search</label>-->
                        <!--<input type="text" name="search" id="search" placeholder="Search By Name/Cnic/Ntn">-->
                        <!--</div>-->
                        <div>
                            <label>Search By</label>
                            <select name="filter">
                                <option value="All">All</option>
								     <?php foreach ($Parts as $AllPart) { ?>
                              <option value="<?= $AllPart['idPart'] ?>" ><?= $AllPart['PartNumber'] ?></option>
								    <?php
                                }
                                ?>
                            </select>
                        </div>
							 <div>
                            <label>From</label>
                            <input type="text" class="date" name="from" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
                        </div>
						 <div>
                            <label>To</label>
                            <input type="text" class="date" name="to" style="width: 250px; background: #fff; padding: 7px 4px 7px 7px; border: 1px solid #dfdfdf; padding: 7px 10px; -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); -moz-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.09);"/>
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
