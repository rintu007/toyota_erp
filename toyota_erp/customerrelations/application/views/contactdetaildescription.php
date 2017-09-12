<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin') {
            include 'include/cr_leftmenu.php';
        } else {
            if ($data['Role'] == 'Manager' || $data['Role'] == 'Executive Complaint' || $data['Role'] == 'Executive Inquiry') {
                include 'include/cr_leftsubmenu.php';
            }
        }
        ?>
        <div class="right-pnel">
            <form id="addcomplaintmodes" name="addcomplaintmodes" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/Contactdetaildescription/adddetailrules" class="form validate-form animated fadeIn">
                <div class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend>Add Detail Description</legend>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <label>Related to</label>
                                        <select id="detailrelto" onchange="onoptionchange(this)" id="idcrcomplainrelation" name = "idcrcomplainrelation" data-validation="required">
                                            <option>Select Related to</option>                                     
                                            <?php
                                            $relatedtolist = json_decode($relatedtolist);
                                            foreach ($relatedtolist as $key) {
                                                ?>
                                                <option value=<?php echo $key->idcr_complainrelation ?>><?php
                                                    echo $key->Name;
                                                    ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="error-drelto cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="detailcode" class="feildwrap">
                                            <label>Contact-Detail Code</label>
                                            <input type="text" name="contactcode" data-validation="required"><br><br>  
                                            <label>Contact-Detail Description</label>
                                            <textarea name="contactdescription" data-validation="required"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>   
                                        <br><div class="btn-block-wrap">
                                            <label>&nbsp;</label>
                                            <input type="submit" class="btn" value="Add">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <div class="feildwrap">               
                    <fieldset>     
                        <?php echo $updateMessage ?>
                        <legend>Detail</legend>
                        <br><div class="btn-block-wrap dg">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="1%">SNo</th>
                                        <th width="10%">Related to</th>
                                        <th width="10%">Detail's Code</th>
                                        <th width="50%">Detail's Description</th>
                                        <th width="10%">Detail</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="9">
                                            <div id="paging">
                                            </div>
                                    </tr>
                                </tfoot>
                                <tbody id="finalResult">
                                    <?php
                                    $count = 1;
                                    $classificationlist = json_decode($classificationlist);
                                    foreach ($classificationlist as $key) {
                                        ?>
                                        <tr id="carUsers">
                                            <td class="resId" name="resId"><?= $count++ ?></td>
                                            <td class="tbl-name"><?= $key->Relatedto ?></td>
                                            <td class="tbl-name"><?= $key->ContactDetailCode ?></td>
                                            <td style="text-align: left" class="tbl-name"><?= $key->ContactDetailsDescription ?></td>
                                            <td><a style="cursor: pointer;" onClick="rolePopup('detail', '<?= $key->idContactDetail ?>', '<?= $key->ContactDetailCode ?>', '<?= $key->ContactDetailsDescription ?>','<?= $key->Relatedto ?>')">Edit</a></td>
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
            <!-- Edit Role Pop UP -->
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?= base_url() ?>index.php/Contactdetaildescription/updatedetailrules" method="Post" onsubmit="return validationform('Update')" class="form animated fadeIn">
                    <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none">
                        <label>Detail ID</label>
                        <input readonly type="text" id="iddetai" name="idcontactcode">
                    </div><br>
                    <div>
                        <label>Related to</label>
                        <select id="udetailrelto" name = "uidcrcomplainrelation" onchange="onoptionchange(this)" data-validation="required" style="width: 250px;">
                            <option>Select Related to</option>                                     
                            <?php
                            foreach ($relatedtolist as $key) {
                                ?>
                                <option value=<?php echo $key->idcr_complainrelation ?>><?php
                                    echo $key->Name;
                                    ?></option>
                            <?php } ?>
                        </select>
                        <span class="error-udrelto cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                    </div>
                    <div style="">
                        <label>Detail Code</label>
                        <input type="text" id="detaicode" name="contactcode" data-validation="required">
                    </div><br>
                    <div style="">
                        <label>Detail Description</label>
                        <input type="text" id="detainame" name="contactdescription" data-validation="required">
                    </div><br>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update Detail">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>


    function onoptionchange() {
        var checktext = $("#idcrcomplainrelation :selected").text();
        if (checktext === "Product") {

            $("#detailcode").hide();
        }
        else {
            $("#detailcode").show();
        }
    }
    
    function updatecomplaintmode(val) {

        $idcrcomplaintmode = val;
        $('#addcomplaintmodes').hide();
        $('#updatecomplaintmodeform').show();
    }

    function rolePopup(div_id, id, code, name,relatedto) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $('#iddetai').val(id);              
            $('[name=uidcrcomplainrelation] option').filter(function() {
                return ($(this).text() === relatedto);
            }).prop('selected', true);
            $("#detaicode").val(code);
            $("#detainame").val(name);

        });
    }

    function validationform(type) {
        if (type === 'Add') {
            var shwRelatedto = $('#detailrelto').val();
            if (shwRelatedto === "Select Related to") {
                $(".error-drelto").show();
                return false;
            } else {
                $(".error-drelto").hide();
            }
        } else {
            var shwURelatedto = $('#udetailrelto').val();
            if (shwURelatedto === "Select Related to") {
                $(".error-udrelto").show();
                return false;
            } else {
                $(".error-udrelto").hide();
            }
        }
    }
</script>