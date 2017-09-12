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
            <form id="addskills" name="skillsform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Skills/addskills" class="form validate-form animated fadeIn">
                <div class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend>Add Skills</legend>
                        <label>Skill</label>
                        <input type='text' name="name" data-validation="required">
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Skill">
                        </div>
                    </fieldset>
                </div>
            </form>
            <form id="shwmodes" method="post" class="form animated fadeIn" onsubmit="return false">
                <div class="feildwrap">              
                    <fieldset>
                        <?php echo $updateMessage ?>
                        <legend>Skills List</legend>                   
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
                                    $skillslist = json_decode($skillslist);
                                    foreach ($skillslist as $key) {
//                                    $WarehouseId = $key['idWarehouse'];
                                        ?>
                                        <tr id="carUsers">
                                            <td class="" name="skillname"><?= $count++ ?></td>
                                            <td class="tbl-name"><?= $key->Name ?></td>
                                            <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?php echo $key->idcr_userskills ?>', '<?php echo $key->Name ?>')">Edit</a>
                                             <!--<td><a href="#updateform" onclick="updatemode(<?php echo $key->idcr_userskills ?>)">Edit</a></td>-->
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </div>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/Skills/updateskills" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Skills ID</label>
                        <input type="text" id="uidSkills" name="uidSkills" data-validation="">
                    </div>
                    <div>
                        <label>Skill</label>
                        <input type="text" id="uSkills" name="uSkills" data-validation="required">
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

    $idcrskills = 0;
    function updatemode(val) {

        $idcrskills = val;
        $('#addskills').hide();
        $('#updateform').show();
    }

    function UpdatePopup(div_id, id, Name) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#uidSkills").val(id);
            $(this).find("#uSkills").val(Name);
        });
    }

//    $("#updateform").submit(function() {
//        var formData = $('#updateform').serialize();
//        formData += "&idcruserskills=" + $idcrskills;
//        $.ajax({
//            url: "<?= base_url() ?>index.php/Skills/updateskills",
//            type: "POST",
//            data: formData,
//            success: function(data) {
//                location.reload();
//            },
//            error: function(data) {
//
//            }
//        });
//        return false;
//    });

//    $("#search").keyup(function() {
//        var search = $("#search").val();
//        $.ajax({
//            url: "<?= base_url() ?>index.php/warehouse/search",
//            type: "POST",
//            data: {search: search},
//            success: function(data) {
//                if (data !== "null")
//                {
//                    var a = JSON.parse(data);
////                    console.log(a.length);
//                    if (a.length > 0) {
//                        try {
//                            var count = 1;
//                            var items = "";
//                            $.each(a, function(i, val) {
//                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
//                    <td class='tbl - name'>" + val.Name + "</td><td>" + val.Cellphone + "</td>\n\
//<td>" + val.Address + "</td>\n\
//<td><a style='cursor: pointer;' onClick=warehousePopup('detail','" + val.idWarehouse + "','" + val.Name + "','" + val.Cellphone + "','" + val.Address + "'')> Edit </a></td></tr>";
//                            });
//                            $('#finalResult').html(items);
//                        } catch (e) {
//                            console.log(e);
//                        }
//                    }
//                }
//                else {
//                    console.log("else Block");
//                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
//                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
//                        <td style='border: 0px'></td>");
//                }
//            }
//        });
//    });

//    function validationform() {
//        chosen = "";
//        pass = $("#pass").val();
//        confirm_pass = $("#cpass").val();
//        if (pass !== confirm_pass) {
//            $(".pass-error").show();
//            return false;
//        } else {
//            $(".pass-error").hide();
//            return true;
//        }
//    }
//
//    function warehousePopup(div_id, id, name, cell, address, incharge) {
//        $('.popup-' + div_id).bPopup({
//            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
//            followSpeed: 1500, //can be a string ('slow'/'fast') or int
//            modalColor: '#333',
//            closeClass: 'close-pop'
//        }, function() {
////                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
//            $(this).find("#WarehouseId").val(id);
//            $(this).find("#Name").val(name);
//            $(this).find("#Incharge").val(incharge);
//            $(this).find("#MobileNumber").val(cell);
//            $(this).find("#Address").val(address);
//        });
//    }

    function validationform() {

    }

</script>