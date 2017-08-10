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
                  action="<?= base_url() ?>index.php/Processdescription/addprocessrules" class="form validate-form animated fadeIn">
                <div class="feildwrap">
                    <fieldset>
                        <h4><?= $insertMessage ?></h4>
                        <legend>Add Process Description</legend>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="feildwrap">
                                            <label>Related to</label>
                                            <select id="processrelto" onchange="onrelationchange(this, 'Add')" name = "idcrcomplainrelation" data-validation="required">
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
                                            <span class="error-prelto cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                        </div><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="feildwrap">
                                            <label id="labeldetaildescription">Detail Description</label>
                                            <select onchange="" id="fetchcontactdetails" name = "idcrcontactdetaildescription" data-validation="required">
                                                <option>Select Detail</option>                                     
                                            </select>
                                            <span class="error-pdetail cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                        </div><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="feildwrap">
                                            <label>Process Code</label>
                                            <input id="processcode" type="text" name="processcode" data-validation="required"><br><br>
                                            <label>Process Description</label>
                                            <textarea id="processdescription" name="processdescription" data-validation="required"></textarea>
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
                        <legend>Classifications Detail</legend>
                        <br><div class="btn-block-wrap dg">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="1%">SNo</th>
                                        <th width="10%">Relatedto</th>
                                        <th width="5%">Detail's Code</th>
                                        <th width="25%">Detail's Description</th>
                                        <th width="2%">Process Code</th>
                                        <th width="25%">Process Description</th>
                                        <th width="2%">Details</th>
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
                                            <td class="tbl-name"><?= $key->SaleProcessCode ?></td>
                                            <td style="text-align: left" class="tbl-name"><?= $key->SaleProcessDescription ?></td>
                                            <td><a style="cursor: pointer;" onClick="rolePopup('detail', '<?= $key->idSaleProcess ?>', '<?= $key->SaleProcessCode ?>', '<?= $key->SaleProcessDescription ?>','<?= $key->idContactDetail ?>','<?= $key->ContactDetailsDescription ?>','<?= $key->Relatedto ?>')">Edit</a></td>
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
                <form action="<?= base_url() ?>index.php/Processdescription/updateprocessrules" method="POST" onsubmit="return validationform('Update')" class="form animated fadeIn">
                    <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none">
                        <label>Process ID</label>
                        <input readonly type="text" id="idprocess" name="idprocess">
                    </div><br>
                    <div>
                        <label>Related to</label>
                        <select id="uprocessrelto" onchange="onrelationchange(this, 'Update')" id="idcrcomplainrelation" name = "uidcrcomplainrelation" style="width: 250px;">
                            <option>Select Related to</option>                                     
                            <?php
                            foreach ($relatedtolist as $key) {
                                ?>
                                <option value=<?php echo $key->idcr_complainrelation ?>><?php
                                    echo $key->Name;
                                    ?></option>
                            <?php } ?>
                        </select>  
                        <span class="error-uprelto cb-error help-block" style="margin-left: 310px;margin-top: -35px">Option must be selected!</span>
                    </div>
                    <div>
                        <label id="ulabeldetaildescription">Detail Description</label>
                        <select id="ufetchcontactdetails" name = "uidcrcontactdetaildescription" class="details" onchange="" style="width: 250px;">
                            <option>Select Detail</option>                                     
                        </select>
                        <span class="error-updetail cb-error help-block" style="margin-left: 310px;margin-top: -35px">Option must be selected!</span>
                    </div>                    
                    <div style="">
                        <label>Process Code</label>
                        <input type="text" id="procescode" name="processcode" data-validation="required">
                    </div><br>
                    <div style="">
                        <label>Process Description</label>
                        <input type="text" id="procesname" name="processdescription" data-validation="required">
                    </div><br>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update Process">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    function onrelationchange(obj, type) {
        if (type === 'Add') {
            $("#fetchcontactdetails").empty();
            var getrelation = $(obj).val();
            var checktext = $("#processrelto :selected").text();
            if (checktext === "Product") {

                $("#labeldetaildescription").hide();
                $("#fetchcontactdetails").hide();
            }
            else {
                $("#labeldetaildescription").show();
                $("#fetchcontactdetails").show();
            }

            if (getrelation !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Processdescription/servicefilteredcontactdetaillist",
                    type: "POST", data: {detail: getrelation},
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {
                            $("#fetchcontactdetails").append("<option id=''>Select Detail</option>");
                            $.each(data, function(index, name) {
                                $("#fetchcontactdetails").append($("<option id=''></option>").val(name['idcr_contactdetaildescription']).html(name['ContactDetailsDescription']));
                            });
                        }
                        else {
                        }
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }

        } else {
            $("#ufetchcontactdetails").empty();
            var getUrelation = $(obj).val();
            var text = $("#uprocessrelto :selected").text();
            if (text === "Product") {

                $("#ulabeldetaildescription").hide();
                $("#ufetchcontactdetails").hide();
            }
            else {
                $("#ulabeldetaildescription").show();
                $("#ufetchcontactdetails").show();
            }

            if (getUrelation !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Processdescription/servicefilteredcontactdetaillist",
                    type: "POST", data: {detail: getUrelation},
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {
                            $("#ufetchcontactdetails").append("<option id=''>Select Detail</option>");
                            $.each(data, function(index, name) {
                                $("#ufetchcontactdetails").append($("<option id=''></option>").val(name['idcr_contactdetaildescription']).html(name['ContactDetailsDescription']));
                            });
                        }
                        else {
                        }
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            }
        }

    }

    function rolePopup(div_id, id, code, name,idContactDetail, contactdetail, relatedto) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $('#idprocess').val(id);
            $('[name=uidcrcomplainrelation] option').filter(function() {
                return ($(this).text() === relatedto);
            }).prop('selected', true);            
            $("#ufetchcontactdetails").append($("<option id='' Selected></option>").val(idContactDetail).html(contactdetail));
            $("#procescode").val(code);
            $("#procesname").val(name);

        });
    }
    function validationform(type) {
        if (type === 'Add') {
            var shwRelatedto = $('#processrelto').val();
            var shwDescription = $('#fetchcontactdetails').val();
            if (shwRelatedto === "Select Related to" && shwDescription === "Select Detail") {
                $(".error-prelto").show();
                $(".error-pdetail").show();
                return false;
            } else {
                if (shwRelatedto === "Select Related to" || shwDescription === "Select Detail") {

                    if (shwRelatedto === "Select Related to") {
                        $(".error-prelto").show();
                    } else {
                        $(".error-prelto").hide();
                    }

                    if (shwDescription === "Select Detail") {
                        $(".error-pdetail").show();
                    } else {
                        $(".error-pdetail").hide();
                    }
                    return false;
                }
                return true;
            }
        } else {
            var shwURelatedto = $('#uprocessrelto').val();
            var shwUDescription = $('#ufetchcontactdetails').val();
            if (shwURelatedto === "Select Related to" && shwUDescription === "Select Detail") {
                $(".error-uprelto").show();
                $(".error-updetail").show();
                return false;
            } else {
                if (shwURelatedto === "Select Related to" || shwUDescription === "Select Detail") {

                    if (shwURelatedto === "Select Related to") {
                        $(".error-uprelto").show();
                    } else {
                        $(".error-uprelto").hide();
                    }

                    if (shwUDescription === "Select Detail") {
                        $(".error-updetail").show();
                    } else {
                        $(".error-updetail").hide();
                    }
                    return false;
                }
                return true;
            }
        }

    }
</script>