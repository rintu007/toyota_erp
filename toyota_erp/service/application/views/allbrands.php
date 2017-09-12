<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        } else {
            
        }
        ?>
        <div class="right-pnel">
            <form name="allbrandsform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/allbrands/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Brands</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Brand</label>
                            <input type="text" id="brandname" name="BrandName" placeholder="Brand Name" data-validation="required">
                        </div><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Brand" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onSubmit="return validationform()">
                <fieldset>
                    <legend>Brands List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Brand</label>
                        <input type="text" id="searchbrand" name="SearchBrand" placeholder="Search by Brand Name">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="brandslisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="60%">Brand</th>
                                    <th width="30%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="brandslisthf">
                                <tr>
                                    <td colspan="3">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="brandlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($brandsList as $key) {
                                    ?>
                                    <tr id="staffRolesTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['BrandName'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idAllBrands'] ?>', '<?= $key['BrandName'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/allbrands/Delete/<?= $key['idAllBrands'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/allbrands/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>All Brand ID</label>
                        <input type="text" id="idallbrand"  name="idAllBrand" data-validation="required">
                    </div>
                    <div>
                        <label>Brand Name</label>
                        <input type="text" id="brandname" name="BrandName" placeholder="Brand Name" data-validation="required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchbrand").keyup(function() {
        var search = $("#searchbrand").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/allbrands/search",
            type: "POST",
            data: {searchbrand: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".brandslisthf").is(":visible"))) {
                                $(".brandslisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.BrandName + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idAllBrands + "','" + val.BrandName + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/allbrands/Delete/" + val.idAllBrands + "' >Delete</a></td></tr>";
                            });
                            $('#brandlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".brandslisthf").hide();
                        $("#brandlistbody").html("No Data Found");
                    }
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

    function UpdatePopup(div_id, idstaffroles, rolesname) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idallbrand").val(idstaffroles);
            $(this).find("#brandname").val(rolesname);
        });
    }

</script>