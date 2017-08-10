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
                  action="<?= base_url() ?>index.php/model/newmodel" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Model</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Model Name</label>
                            <input type="text" name="model_name" data-validation="required">
                        </div>
                        <div>
                            <label>Brand Name</label>
                            <select name="parent">
                                <option>Select Brand</option>
                                <?php
                                foreach ($Parent as $ParentName) {
                                    $$ParentId = $ParentName['Id'];
                                    ?>
                                    <option value="<?= $ParentName['Id'] ?>" ><?= $ParentName['ParentName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Model">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Car Model List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Model
                                <!--<span class="required">*</span>-->
                            </label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Model Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="20%">Model Name</th>
                                    <th width="20%">Brand Name</th>
                                    <th width="10%">Details</th>
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
                                foreach ($Model as $CarModel) {
                                    $ModelId = $CarModel['IdModel'];
                                    ?>
                                    <tr id="carModel">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CarModel['Model'] ?></td>
                                        <td class="tbl-name"><?= $CarModel['ParentName'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="modelPopup('detail', '<?= $ModelId ?>', '<?= $CarModel['Model'] ?>', '<?= $CarModel['ParentId'] ?>')">Edit</a>
                                        </td>
										<td>
						 <a href="<?=	base_url()."index.php/model/delete/"  ?><?= $ModelId ?>">Delete</a>
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
<!-- Edit Model Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/model/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Model ID</label>
            <input type="text" id="idModel" name="model_id">
        </div>
        <br>
        <div>
            <label>Model Name</label>
            <input type="text" id="model_name" name="model_name">
        </div>
        <div>
            <label>Model Name</label>
            <select name="parent" id="brand">
                <option>Select Brand</option>
                <?php
                foreach ($Parent as $CarParent) {
                    $CarParentId = $CarParent['IdParent'];
                    ?>
                    <option value="<?= $CarParent['Id'] ?>" ><?= $CarParent['ParentName'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Model">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/model/search",
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
                            items += "'<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                        <td class='tbl-name'>" + val.Model + "</td><td>" + val.ParentName + "</td>\n\
<td><a style='cursor: pointer;' onClick=\"modelPopup('detail','" + val.Id + "','" + val.Model + "','" + val.ParentId + "')\">Edit</a></td></tr>";
                        });
                        $('#finalResult').html(items);
                    } catch (e) {
                        console.log(e);
                    }
                } else {
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
                                <td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>\n\
<td style='border: 0px'></td>");
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

    function modelPopup(div_id, id, name, brand) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idModel").val(id);
            $(this).find("#model_name").val(name);
            $(this).find("#brand").val(brand);
        });
    }

</script>