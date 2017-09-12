<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin') {
            include 'include/cr_complaintleftmenu.php';
        } else {
            redirect(base_url() . "index.php/crpanel/index");
        }
        ?>
        <div class="right-pnel">
            <form id="addcomplaintmodes" name="addcomplaintmodes" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/Complaintmodecategory/addcomplaintcategories" class="form validate-form animated fadeIn">
                <div class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>                        
                        <legend>Add Complaint Mode Category</legend>
                        <div class="feildwrap">
                            <label>Select Mode</label>
                            <select id="idcrcompmodeval" name="idcrcompmode" data-validation="" onchange="checkmode(this, 'Add')">
                                <option>Select Mode</option>
                                <?php
                                $complaintmodeslist = json_decode($complaintmodeslist);
                                foreach ($complaintmodeslist as $key) {
                                    ?>
                                    <option  value=<?php echo $key->idcr_complainmode ?>><?php
                                        echo $key->ModeName;
                                        ?></option>
                                <?php } ?>
                            </select>
                            <span class="error-modecate cb-error help-block" style="margin-left: 483px;margin-top: -35px">Option must be selected!</span>
                        </div><br><br>
                        <div class="feildwrap">
                            <label>Category</label>
                            <input type="text" name="categoryname" data-validation="required">
                        </div><br><br>
                        <div class="feildwrap">
                            <label id="lblcasesafety">Case Safety</label>
                            <input id="divcasesafety" type="checkbox" name="issaftey" value=1>
                        </div><br><br>
                        <div class="feildwrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add">
                        </div>
                    </fieldset>
                </div>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <div class="feildwrap">                   
                    <fieldset>
                        <?php echo $updateMessage ?>
                        <legend>Complaint Mode Category List</legend>
                        <br><div class="btn-block-wrap dg">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="5%">S No.</th>
                                        <th width="25%">Complaint Mode</th>
                                        <th width="25%">Mode Category</th>
                                        <th width="25%">Case</th>
                                        <th width="15%">Details</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                </tfoot>
                                <tbody id="finalResult">
                                    <?php
                                    $count = 1;
                                    $complaintmodescategory = json_decode($complaintmodescategory);
                                    foreach ($complaintmodescategory as $key) {
                                        ?>
                                        <tr id="carUsers">
                                            <td class="resId" name="resId"><?= $count++ ?></td>
                                            <td class="tbl-name"><?= $key->ModeName ?></td>
                                            <td class="tbl-name"><?= $key->ModeCategory ?></td>
                                            <td class="tbl-name"><?= $key->Cases ?></td>
                                            <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?php echo $key->idcomplaintmodecategory ?>', '<?php echo $key->ModeCategory ?>', '<?php echo $key->ModeName ?>')">Edit</a>
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
                <form action="<?php echo base_url() ?>index.php/Complaintmodecategory/updatecategories" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Mode-Category ID</label>
                        <input type="text" id="idModeCate" name="idModeCate" data-validation="">
                    </div>
                    <label>Select Mode</label>
                    <select id="uidcrcompmodeval" name="uidcrcompmode" onchange="checkmode(this, 'Update')" style="width: 250px;">
                        <option>Select Mode</option>
                        <?php
                        foreach ($complaintmodeslist as $key) {
                            ?>
                            <option  value=<?php echo $key->idcr_complainmode ?>><?php
                                echo $key->ModeName;
                                ?></option> 
                        <?php } ?>
                    </select>
                    <span class="error-umodecate cb-error help-block" style="margin-left: 310px;margin-top: -35px">Option must be selected!</span>
                    <div>
                        <label>Category</label>
                        <input type="text" id="ucategoryname" name="ucategoryname" data-validation="required">
                    </div>
                    <div>
                        <label id="ulblcasesafety">Case Safety</label>
                        <input id="udivcasesafety" type="checkbox" name="uissaftey" value=1>
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
    function checkmode(obj, type) {
        if (type === 'Add') {
            var getcompname = obj.options[obj.selectedIndex].text;
            if (getcompname === "Normal") {

                $("#lblcasesafety").hide();
                $("#divcasesafety").hide();
            }
            else {
                $("#lblcasesafety").show();
                $("#divcasesafety").show();
            }
        } else {
            var getcompname = obj.options[obj.selectedIndex].text;
            if (getcompname === "Normal") {

                $("#ulblcasesafety").hide();
                $("#udivcasesafety").hide();
            }
            else {
                $("#ulblcasesafety").show();
                $("#udivcasesafety").show();
            }
        }
    }

    function updatecomplaintmode(val) {
        $('#addcomplaintmodes').hide();
        $('#updatecomplaintmodeform').show();
    }

    function validationform(type) {
        if (type === 'Add') {

            var shwModeCate = $('#idcrcompmodeval').val();
            if (shwModeCate === "Select Mode") {
                $(".error-modecate").show();
                return false;
            } else {
                $(".error-modecate").hide();
            }
        } else {
            var shwModeCate = $('#uidcrcompmodeval').val();
            if (shwModeCate === "Select Mode") {
                $(".error-umodecate").show();
                return false;
            } else {
                $(".error-umodecate").hide();
            }
        }
    }

    function UpdatePopup(div_id, id, Category, Mode) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idModeCate").val(id);
            $('[name=uidcrcompmode] option').filter(function() {
                return ($(this).text() === Mode);
            }).prop('selected', true);
            $(this).find("#ucategoryname").val(Category);
        });
    }

    $("#updatecomplaintmodeform").submit(function() {
        var formData = $('#updatecomplaintmodeform').serialize();
        formData += "&idcrcomplaintmode=" + $idcrcomplaintmode;
        $.ajax({
            url: "<?= base_url() ?>index.php/Complaintmode/updatecomplaintmodes",
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
</script>


