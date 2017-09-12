<div id="wrapper">
    <div id="content">
        <?php
        $cookieData = unserialize($_COOKIE['logindata']);
        if ($cookieData['isAdmin'] == 1) {
            include 'include/admin_leftmenu.php';
        } else {
            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/manufacturer/newManufacturer" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Manufacturer</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Manufacturer</label>
                            <input type="text" name="Manufacturer" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Manufacturer">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Manufacturer List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Manufacturer</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Manufacturer Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Manufacturer</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                                <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                <!--                                            <li><a href="" class="active"><span>-->
                                                <!--</span></a></li>-->
                                                <!--                                            <li>-->
                                                <?//= $pagination; ?><!--</li>-->
                                                <!--                                                <li><a href=""><span>3</span></a></li>-->
                                                <!--                                                <li><a href=""><span>4</span></a></li>-->
                                                <!--                                                <li><a href=""><span>5</span></a></li>-->
                                                <!--                                            <li><a href=""><span>Next</span></a></li>-->
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($Manufacturer as $AllManufacturer) {
                                    $ManufacturerId = $AllManufacturer['idManufacturer'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllManufacturer['Manufacturer'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="manufacturerPopup('detail', '<?= $ManufacturerId ?>', '<?= $AllManufacturer['Manufacturer'] ?>')">Edit</a>
                                            <?php
                                            //echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                            ?>
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
<!-- Edit User Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/manufacturer/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Manufacturer ID</label>
            <input type="text" name="ManufacturerId" id="ManufacturerId" data-validation="required">
        </div>
        <div>
            <label>Manufacturer Name</label>
            <input type="text" name="Manufacturer" id="Manufacturer" data-validation="required">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Manufacturer">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/manufacturer/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
//                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl - name'>" + val.Manufacturer + "</td>\n\
<td><a style='cursor: pointer;' onClick=manufacturerPopup('detail','" + val.idManufacturer + "','" + val.Manufacturer + "')> Edit </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
                                <td style='border: 0px'></td>");
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

    function manufacturerPopup(div_id, id, manufacturer) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#ManufacturerId").val(id);
            $(this).find("#Manufacturer").val(manufacturer);
        });
    }

</script>