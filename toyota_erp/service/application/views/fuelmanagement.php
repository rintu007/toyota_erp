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
            <form name="fuelform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/fuelmanagement/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Fuel Volume</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Volume</label>
                            <input type="text" id="fuelvolume" name="FuelVolume" placeholder="Fuel Volume" data-validation="required">
                        </div><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Fuel Volume List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Fuel Volume</label>
                        <input type="text" name="searchfuelvol" id="searchfuelvol"  placeholder="Search by Volume">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="fuelmanagementlisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="60%">Fuel Volume</th>
                                    <th width="30%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="fuelmanagementlisthf">
                                <tr>
                                    <td colspan="3">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="fuelmanagementlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($fuelInfoList as $key) {
                                    ?>
                                    <tr id="finaceTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['FuelVolume'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idFuel'] ?>', '<?= $key['FuelVolume'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/fuelmanagement/Delete/<?= $key['idFuel'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/fuelmanagement/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Fuel ID</label>
                        <input type="text" name="IdFuel" id="idFuel" data-validation="required">
                    </div>
                    <div>
                        <label>Volume</label>
                        <input type="text" id="fuelvolume" name="FuelVolume" placeholder="Fuel Volume" data-validation="required">
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

    $("#searchfuelvol").keyup(function() {
        var search = $("#searchfuelvol").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/fuelmanagement/search",
            type: "POST",
            data: {searchfuelvol: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".fuelmanagementlisthf").is(":visible"))) {
                                $(".fuelmanagementlisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.FuelVolume + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idFuel + "','" + val.FuelVolume + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/fuelmanagement/Delete/" + val.idFuel + "' >Delete</a></td></tr>";
                            });
                            $('#fuelmanagementlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".fuelmanagementlisthf").hide();
                        $("#fuelmanagementlistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idFuel, fuelvolume) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idFuel").val(idFuel);
            $(this).find("#fuelvolume").val(fuelvolume);
        });
    }

</script>