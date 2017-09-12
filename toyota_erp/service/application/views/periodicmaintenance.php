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
            <form name="periodicmaintenanceform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Periodicmaintenance/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Maintenance Package</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Name</label>
                            <input type="text" name="Name" placeholder="Name" data-validation="required">
                        </div><br>
                        <div>
                            <label>Time</label>
                            <input type="text" name="TimeTaken" placeholder="Time Taken" data-validation="required">Mins
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Maintenance Package" style="margin-left: 400px;width: 185px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Maintenance Package List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Maintenance Package</label>
                        <input type="text" id="searchpm" name="searchpm" placeholder="Search by Maintenance Package">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="pmlisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="40%">Maintenance Package Name</th>
                                    <th width="30%">Time</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="pmlisthf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="pmlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($pmList as $key) {
                                    ?>
                                    <tr id="periodicTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['PeriodName'] ?></td>
                                        <td class="tbl-name"><?= $key['TimeTaken'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idPeriodicMaintenance'] ?>', '<?= $key['PeriodName'] ?>', '<?= $key['TimeTaken'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/Periodicmaintenance/Delete/<?= $key['idPeriodicMaintenance'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/Periodicmaintenance/Update" method="POST" class="form animated fadeIn">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>PM ID</label>
                        <input type="text" name="IdPM" id="idpm" data-validation="required">
                    </div>
                    <div>
                        <label>Name</label>
                        <input type="text" name="Name" id="name" data-validation="required">
                    </div>
                    <div>
                        <label>Time Taken</label>
                        <input type="text" name="TimeTaken" id="timetaken" data-validation="required">
                    </div>
                    <div style="margin-left: 250px;">
                        <input type="submit" class="btn" value="Update Maintenance Package">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchpm").keyup(function() {
        var search = $("#searchpm").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Periodicmaintenance/search",
            type: "POST",
            data: {searchpm: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".pmlisthf").is(":visible"))) {
                                $(".pmlisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.PeriodName + "</td>\n\
                            <td class='tbl-name'>" + val.TimeTaken + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idPeriodicMaintenance + "','" + val.PeriodName + "','" + val.TimeTaken + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/bay/DeleteBay/" + val.idPeriodicMaintenance + "'>Delete</a></td></tr>";
                            });
                            $('#pmlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".pmlisthf").hide();
                        $("#pmlistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idpm, name, timetaken) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idpm").val(idpm);
            $(this).find("#name").val(name);
            $(this).find("#timetaken").val(timetaken);
        });
    }

</script>