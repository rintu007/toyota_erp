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
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/color/newcolor" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Color</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Color Name</label>
                            <input type="text" name="color_name" data-validation="required">
                        </div>
                        <div>
                            <label>Color Code</label>
                            <input type="text" name="color_code" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Color">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Colors List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Colors</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By ColorName">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="45%">Color Name</th>
                                    <th width="10%">Color Code</th>
                                    <th width="17%">Details</th>
									 <th width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    
                                    <td colspan="9">
                                        <div id="paging">
                                            <p style="color: #fff;font-weight: bold;text-align: right;padding: 5px 5px 5px 0;">
                                                Total : <?php echo $counts ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
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
                                foreach ($Color as $CarColor) {
                                    $ColorId = $CarColor['IdColor'];
                                    ?>
                                    <tr id="carColors">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CarColor['ColorName'] ?></td>
                                        <td class="tbl-name"><?= $CarColor['ColorCode'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="colorPopup('detail', '<?= $ColorId ?>', '<?= $CarColor['ColorName'] ?>', '<?= $CarColor['ColorCode'] ?>')">Edit</a>
                                        </td>
										<td>
						 <a href="<?=	base_url()."index.php/color/delete/"  ?><?= $ColorId ?>">Delete</a>
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
<!-- Edit Color Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/color/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Color ID</label>
            <input type="text" id="idColor" name="color_id">
        </div>
        <br>
        <div>
            <label>Color Name</label>
            <input type="text" id="color_name" name="color_name">
        </div>
        <div>
            <label>Color Code</label>
            <input type="text" id="color_code" name="color_code">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Color">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/color/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        var items = "";
                        $.each(a, function(i, val) {
                            items += "<tr><td class='resId' name='resId'>" + val.IdColor + "</td>\n\
                            <td class='tbl-name'>" + val.ColorName + "</td>\n\
                            <td class='tbl-name'>" + val.ColorCode + "</td>\n\
<td><a style='cursor: pointer;' onClick=\"colorPopup('detail'" + ",'" + val.IdColor + "','" + val.ColorName + "','" + val.ColorCode + "')\">Edit</a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>");
                }
            }
        });
    });
    function validationform() {
        chosen = "";
        pass = $("#pass").val();
        confirm_pass = $("#cpass").val();
        if (pass != confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }
    }
    function colorPopup(div_id, id, name, code) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idColor").val(id);
            $(this).find("#color_name").val(name);
            $(this).find("#color_code").val(code);
        });
    }

</script>