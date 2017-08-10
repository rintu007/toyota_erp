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
                  action="<?= base_url() ?>index.php/brand/newparent" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New Brand</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Brand Name</label>
                            <input type="text" name="parent_name" data-validation="required">
                        </div>
                        <div>
                            <label>Short Code</label>
                            <input type="text" name="parent_code" data-validation="required">
                            <span>(For Example: ' T ' for Toyota)</span>
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New Brand">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Car Brand List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Brand
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
                                    <th width="10%">Brand Name</th>
									<th width="10%">Short Code</th>
                                    <th width="10%">Details</th>
									<th width="10%">Action</th>
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
                                foreach ($Brand as $CarBrand) {
                                    $BrandId = $CarBrand['IdParent'];
                                    ?>
                                    <tr id="carModel">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CarBrand['ParentName'] ?></td>
										<td class="tbl-name"><?= $CarBrand['ShortCode'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="brandPopup('detail', '<?= $BrandId ?>', '<?= $CarBrand['ParentName'] ?>', '<?= $CarBrand['ShortCode'] ?>')">Edit</a>
                                        </td>
										<td>
						 <a href="<?=	base_url()."index.php/brand/delete/"  ?><?= $BrandId ?>">Delete</a>
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
    <form action="<?= base_url() ?>index.php/brand/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Brand ID</label>
            <input type="text" id="idBrand" name="parent_id">
        </div>
        <br>
        <div>
            <label>Brand Name</label>
            <input type="text" id="brand_name" name="parent_name">
        </div>
		 <div>
		<label>Short Code</label>
		
            <input type="text" id="brand_code" name="brand_code">
	</div>
			<div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Brand">
        </div>
       
        
    </form>
	 </div>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/brand/search",
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
                            items += "'<tr><td class='resId' name='resId'>" + val.IdParent + "</td>\n\
                        <td class='tbl-name'>" + val.ParentName + "</td>\n\
<td><a style='cursor: pointer;' onClick=\"brandPopup('detail','" + val.IdParent + "','" + val.ParentName + "')\">Edit</a></td></tr>";
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

    function brandPopup(div_id, id, name,code) {
		
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idBrand").val(id);
            $(this).find("#brand_name").val(name);
			$(this).find("#brand_code").val(code);
        });

    }

</script>