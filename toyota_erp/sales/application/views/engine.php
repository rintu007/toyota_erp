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
                  action="<?= base_url() ?>index.php/engine/newengine" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Engine</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Engine Name</label>
                            <input type="text" name="engine_name" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Engine">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Engine List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Engine</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Engine Name">
                        </div>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="7%">S No.</th>
                                    <th width="35%">Engine Name</th>
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
                                foreach ($Engine as $CarEngine) {
                                    $EngineId = $CarEngine['IdEngine'];
                                    ?>
                                    <tr id="carColors">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CarEngine['EngineType'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="enginePopup('detail', '<?= $EngineId ?>', '<?= $CarEngine['EngineType'] ?>')">Edit</a>
                                        </td>
										<td>
						 <a href="<?=	base_url()."index.php/engine/delete/"  ?><?= $EngineId ?>">Delete</a>
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
    <form action="<?= base_url() ?>index.php/engine/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Engine ID</label>
            <input type="text" id="idEngine" name="engine_id">
        </div>
        <br>
        <div>
            <label>Engine Type</label>
            <input type="text" id="engine_name" name="engine_name">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Engine">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/engine/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                console.log(data);
                var a = JSON.parse(data);
                console.log(a.length);
                if (a.length > 0) {
                    try {
                        var items = "";
                        var count = 1;
                        $.each(a, function(i, val) {
                            items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.EngineType + "</td>\n\
<td><a style='cursor: pointer;' onClick=\"enginePopup('detail'" + ",'" + val.IdEngine + "','" + val.EngineType + "')\">Edit</a></td></tr>";
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
        if (pass !== confirm_pass) {
            $(".pass-error").show();
            return false;
        } else {
            $(".pass-error").hide();
            return true;
        }
    }
    function enginePopup(div_id, id, name) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idEngine").val(id);
            $(this).find("#engine_name").val(name);
        });
    }

</script>