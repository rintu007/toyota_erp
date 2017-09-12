<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin') {
            include 'include/cr_leftmenu.php';
        } else {
            include 'include/cr_leftsubmenu.php';
        }
        ?>
        <div  class="right-pnel">
            <form id="addmodes" name="modeform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Mode/addmodes" class="form validate-form animated fadeIn">
                 <div class="feildwrap">
                     <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend>Add Mode</legend>
                        <div class="feildwrap">
                            <div>
                                <label>Mode</label>
                                <input type='text' name="name" data-validation="required"> 
                            </div><br>
                            <div class="btn-block-wrap" style="float: right">
                                <input type="submit" class="btn" value="Add Mode">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
            <form id="shwmodes" method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Mode List</legend>                   
                    <div class="feildwrap">
                         <?php echo $updateMessage ?>
                        <br><div class="btn-block-wrap dg">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="30%">S No.</th>
                                        <th width="35%">Name</th>
                                        <th width="35%">Details</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                </tfoot>
                                <tbody id="finalResult">
                                    <?php
                                    $count = 1;
                                    $modeslist = json_decode($modeslist);
                                    foreach ($modeslist as $key) {
//                                    $WarehouseId = $key['idWarehouse'];
                                        ?>
                                        <tr id="carUsers">
                                            <td class="" name="modename"><?= $count++ ?></td>
                                            <td class="tbl-name"><?= $key->Name ?></td>
                                            <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?php echo $key->idcr_mode ?>', '<?php echo $key->Name ?>')">Edit</a>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/Mode/updatemodes" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Mode ID</label>
                        <input type="text" name="idMode" id="idMode" data-validation="">
                    </div>
                    <div>
                        <label>Mode Name</label>
                        <input type="text" name="name" id="name" data-validation="required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update Mode">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $idcrmode = 0;
    function updatemode(val) {

        $idcrmode = val;
        $('#addmodes').hide();
        $('#updateform').show();
    }

    $("#updateform").submit(function() {
        var formData = $('#updateform').serialize();
        formData += "&idcrmode=" + $idcrmode;
        $.ajax({
            url: "<?= base_url() ?>index.php/Mode/updatemodes",
            type: "POST",
            data: formData,
            success: function(data) {
                location.reload();
            },
            error: function(data) {

            }
        });
        return false;
    });

    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/warehouse/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
//                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var count = 1;
                            var items = "";
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                    <td class='tbl - name'>" + val.Name + "</td><td>" + val.Cellphone + "</td>\n\
<td>" + val.Address + "</td>\n\
<td><a style='cursor: pointer;' onClick=warehousePopup('detail','" + val.idWarehouse + "','" + val.Name + "','" + val.Cellphone + "','" + val.Address + "'')> Edit </a></td></tr>";
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

    }

    function UpdatePopup(div_id, idMode, modeName) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idMode").val(idMode);
            $(this).find("#name").val(modeName);
        });
    }

</script>