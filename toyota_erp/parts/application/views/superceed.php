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
                  action="<?= base_url() ?>index.php/superceed/newSuperceed" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add Superceed</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Superceed Part</label>
                            <input type="text" name="Superceed" data-validation="required">
                        </div>
                        <div>
                            <label>Part Name</label>
                            <select name="PartName" class='chosen-select'>
                                <option>Select Part</option>
                                <?php
                                foreach ($Parts as $OldParts) {
                                    $PartId = $OldParts['idPart'];
                                    ?>
                                    <option value="<?= $OldParts['idPart'] ?>" ><?= $OldParts['PartNumber'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Superceed">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Superceed List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Superceed</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Superceed Number">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Superceed Number</th>
                                    <th width="10%">Old Part Number</th>
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
                                foreach ($Superceed as $AllSuperceeds) {
                                    $SuperceedId = $AllSuperceeds['idSuperceed'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $AllSuperceeds['SuperceedPart'] ?></td>
                                        <td class="tbl-name"><?= $AllSuperceeds['PartNumber'] ?></td>
                                        <td><a style="cursor: pointer;" onClick="partPopup('detail', '<?= $SuperceedId ?>', '<?= $AllSuperceeds['SuperceedPart'] ?>', '<?= $AllSuperceeds['OldPart'] ?>')">Edit</a> / 
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
    <form action="<?= base_url() ?>index.php/superceed/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>Superceed ID</label>
            <input type="text" name="RackId" id="SuperceedId" data-validation="required">
        </div>
        <div>
            <label>Superceed Part</label>
            <input type="text" name="Superceed" id="Superceed" data-validation="required">
        </div>
        <div>
            <label>Part Name</label>
            <select name="PartName" id="PartName">
                <option>Select Zone</option>
                <?php
                foreach ($Parts as $PartsOld) {
                    $idParts = $PartsOld['idPart'];
                    ?>
                    <option value="<?= $PartsOld['idPart'] ?>" ><?= $PartsOld['PartName'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update Superceed">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function () {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/superceed/search",
            type: "POST",
            data: {search: search},
            success: function (data) {
                if (data !== "null") {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            var items = [];
                            var count = 1;
                            $.each(a, function (i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.SuperceedPart + "</td><td>" + val.OldPart + "</td>\n\
<td><a style='cursor: pointer;' onClick=superceedPopup('detail','" + val.idSuperceed + "','" + val.SuperceedPart + "','" + val.OldPart + "')> Edit </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td>");
                }
            }
        });
    });

    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});

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

    function superceedPopup(div_id, id, superceed, old) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function () {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#SuperceedId").val(id);
            $(this).find("#Superceed").val(superceed);
            $(this).find("select#PartName").val(old);
        });
    }

</script>