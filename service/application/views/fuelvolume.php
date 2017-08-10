<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="fuelvolumeform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/fuelvolume/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Gas Volume</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Gas Volume</label>
                            <input id="FuelVol" name="FuelVol" type="text" placeholder="LED 1/2/3" data-validation="required">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 425px;width: 100px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Gas Volume List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Gas Volume</label>
                        <input type="text" name="SearchFuelVol" id="SearchFuelVol"  placeholder="Search by Volume">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="fuelvolumelisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="75%">Volume</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="fuelvolumelisthf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="fuelvolumelistbody">
                                <?php
                                $Counter = 1;
                                foreach ($fuelvolumeList as $key) {
                                    ?>
                                    <tr id="fuelvolumeTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['GasVolume'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdateFuelVolume('detail', '<?= $key['idGas'] ?>', '<?= $key['GasVolume'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/fuelvolume/Delete/<?= $key['idGas'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 700px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/fuelvolume/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>ID Gas Volume</label>
                        <input id="idFuelVol" name="idFuelVol" type="text" data-validation="required">
                    </div>
                    <div>
                        <label>Gas Volume</label>
                        <input id="uFuelVol" name="uFuelVol" type="text" placeholder="LED 1/2/3" data-validation="required">
                    </div>
                    <div style="float: right;margin-right:60px;">
                        <input type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#SearchFuelVol").keyup(function() {
        var search = $("#SearchFuelVol").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/fuelvolume/search",
            type: "POST",
            data: {fuelVolume: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".fuelvolumelisthf").is(":visible"))) {
                                $(".fuelvolumelisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.GasVolume + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdateFuelVolume('detail','" + val.idGas + "','" + val.GasVolume + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/fuelvolume/Delete/" + val.idGas + "' >Delete</a></td></tr>";
                            });
                            $('#fuelvolumelistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".fuelvolumelisthf").hide();
                        $("#fuelvolumelistbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform(type) {
        if (type === 'Add') {
            var typeName = $('#SelectDealer').val();
            if (typeName === "Select Dealer") {
                $(".error-type").show();
                return false;
            } else {
                $(".error-type").hide();
                return true;
            }
        } else {
            if (type === 'Update') {
                var updateQuestion = $('#IdDealer').val();
                if (updateQuestion === "Select Dealer") {
                    $(".error-updatetype").show();
                    return false;
                } else {
                    $(".error-updatetype").hide();
                    return true;
                }
            }
        }
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

    function UpdateFuelVolume(div_id, idFuelVol, fuelVolume) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idFuelVol").val(idFuelVol);
            $(this).find("#uFuelVol").val(fuelVolume);
        });
    }

</script>