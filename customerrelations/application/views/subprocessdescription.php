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
                  action="<?= base_url() ?>index.php/Subprocessdescription/addsubprocessrules" class="form validate-form animated fadeIn">
                <div class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend>Add SubProcess Description</legend>                 
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="feildwrap">
                                            <label>Related to</label>
                                            <select id="subrelto" onchange="onrelationchange(this, 'Add')" name = "idcrcomplainrelation" data-validation="required">
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
                                            <span class="error-srelto cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                        </div><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="feildwrap">
                                            <label id="labeldetaildescription">Detail Description</label>
                                            <select id="fetchcontactdetails" name = "idcrcontactdetaildescription" onchange="ondetailoptionchange(this, 'Add')">
                                                <option>Select Detail</option>                                     
                                            </select>
                                            <span class="error-sdetail cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                        </div><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="feildwrap">
                                            <label id="labeldetaildescription">Process Description</label>
                                            <select id="fetchprocessdescription" name = "idcrsaleprocessdescription" onchange="" data-validation="required">
                                                <option>Select Process</option>                                     
                                            </select>
                                            <span class="error-sprocesss cb-error help-block" style="margin-left: 480px;margin-top: -35px">Option must be selected!</span>
                                        </div><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="feildwrap">
                                            <label>Sub-Process Code</label>
                                            <input type="text" name="subprocesscode" data-validation="required"><br><br>
                                            <label>Sub-Process Description</label>
                                            <textarea  name="subprocessdescription" data-validation="required"></textarea>
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
                                        <th width="5%">Sub-Process Code</th>
                                        <th width="25%">Sub-Process Description</th>
                                        <th width="25%">Details</th>
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
                                            <td class="tbl-name"><?= $key->Code ?></td>
                                            <td class="tbl-name"><?= $key->Description ?></td>
                                            <td><a style="cursor: pointer;" onClick="rolePopup('detail', '<?= $key->idSaleSubProcess ?>', '<?= $key->Code ?>', '<?= $key->Description ?>','<?= $key->idSaleProcess ?>', '<?= $key->SaleProcessDescription?>')">Edit</a></td>
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
                <form action="<?= base_url() ?>index.php/Subprocessdescription/updatesubprocessrules" method="POST"  onSubmit="return validationform('Update')" class="form animated fadeIn">
                    <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none">
                        <label>Process ID</label>
                        <input readonly type="text" id="idsubprocess" name="idsubprocess">
                    </div>
                    <div>
                        <label>Related to</label>
                        <select id="usubrelto" onchange="onrelationchange(this, 'Update')" name = "uidcrcomplainrelation" style="width: 250px;">
                            <option>Select Related to</option>                                     
                            <?php
                            foreach ($relatedtolist as $key) {
                                ?>
                                <option value=<?php echo $key->idcr_complainrelation ?>><?php
                                    echo $key->Name;
                                    ?></option>
                            <?php } ?>
                        </select>  
                        <span class="error-usrelto cb-error help-block" style="margin-left: 310px;margin-top: -35px">Option must be selected!</span>
                    </div>
                    <div>
                        <label id="ulabeldetaildescription">Detail Description</label>
                        <select id="ufetchcontactdetails" name = "uidcrcontactdetaildescription" onchange="ondetailoptionchange(this, 'Update')" style="width: 250px;">
                            <option>Select Detail</option>                                     
                        </select>
                        <span class="error-usdetail cb-error help-block" style="margin-left: 310px;margin-top: -35px">Option must be selected!</span>
                    </div>
                    <div>
                        <label id="ulabeldetaildescription">Process Description</label>
                        <select id="ufetchprocessdescription" name = "uidcrsaleprocessdescription" onchange="" style="width: 250px;">
                            <option>Select Process</option>                                     
                        </select>
                        <span class="error-usprocesss cb-error help-block" style="margin-left: 310px;margin-top: -35px">Option must be selected!</span>
                    </div>                              
                    <div style="">
                        <label>Sub Process Code</label>
                        <input type="text" id="subprocescode" name="subprocesscode" data-validation="required">
                    </div>
                    <div style="">
                        <label>Sub Process Description</label>
                        <input type="text" id="subprocesname" name="subprocessdescription" data-validation="required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update SubProcess">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    function onrelationchange(obj, type) {
        if (type === 'Add') {
            var getrelation = $(obj).val();
            var checktext = $("#subrelto :selected").text();
            if (checktext === "Product") {

                $("#labeldetaildescription").hide();
                $("#fetchcontactdetails").hide();
                $("#fetchprocessdescription").empty();

                if (getrelation !== null) {
                    $.ajax({
                        url: "<?= base_url() ?>index.php/Subprocessdescription/servicefilteredprocesslist",
                        type: "POST",
                        data: {relation: getrelation},
                        dataType: "json",
                        success: function(data) {
                            console.log('data');
                            console.log(data);
                            if (data.length > 0) {
                                $("#fetchprocessdescription").append($("<option id=''>Select Process</option>"));
                                $.each(data, function(index, name) {
                                    $("#fetchprocessdescription").append($("<option id=''></option>").val(name['idSaleProcess']).html(name['Description']));
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
            else {

                $("#labeldetaildescription").show();
                $("#fetchcontactdetails").show();
                $("#fetchcontactdetails").empty();

                if (getrelation !== null) {
                    $.ajax({
                        url: "<?= base_url() ?>index.php/Processdescription/servicefilteredcontactdetaillist",
                        type: "POST", data: {detail: getrelation},
                        dataType: "json",
                        success: function(data) {
                            console.log('data');
                            console.log(data);
                            if (data.length > 0) {
                                $("#fetchcontactdetails").append($("<option id=''>Select Detail</option>"));
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
            }

        } else {

            var getrelation = $(obj).val();
            var checktext = $("#usubrelto :selected").text();
            if (checktext === "Product") {
                $("#ulabeldetaildescription").hide();
                $("#ufetchcontactdetails").hide();
                $("#ufetchprocessdescription").empty();

                if (getrelation !== null) {
                    $.ajax({
                        url: "<?= base_url() ?>index.php/Subprocessdescription/servicefilteredprocesslist",
                        type: "POST",
                        data: {relation: getrelation},
                        dataType: "json",
                        success: function(data) {
                            if (data.length > 0) {
                                $("#ufetchprocessdescription").append($("<option id=''>Selet Process</option>"));
                                $.each(data, function(index, name) {
                                    $("#ufetchprocessdescription").append($("<option id=''></option>").val(name['idSaleProcess']).html(name['Description']));
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
            else {

                $("#ulabeldetaildescription").show();
                $("#ufetchcontactdetails").show();
                $("#ufetchcontactdetails").empty();

                if (getrelation !== null) {
                    $.ajax({
                        url: "<?= base_url() ?>index.php/Processdescription/servicefilteredcontactdetaillist",
                        type: "POST", data: {detail: getrelation},
                        dataType: "json",
                        success: function(data) {
                            console.log('data');
                            console.log(data);
                            if (data.length > 0) {
                                $("#ufetchcontactdetails").append($("<option id=''>Select Detail</option>"));
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
    }
    function ondetailoptionchange(obj, type) {

        if (type === 'Add') {
            $("#fetchprocessdescription").empty();
            var getdetail = $(obj).val();
            var checktext = $("#idcrcomplainrelation :selected").val();

            if (checktext === "Product") {

                $("#labeldetaildescription").hide();
                $("#fetchcontactdetails").hide();
            }
            else {
                $("#labeldetaildescription").show();
                $("#fetchcontactdetails").show();
            }

            if (getdetail !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Subprocessdescription/servicefilteredprocesslist",
                    type: "POST",
                    data: {process: getdetail},
                    dataType: "json",
                    success: function(data) {
                        console.log('data');
                        console.log(data);
                        if (data.length > 0) {
                            $("#fetchprocessdescription").append($("<option id=''>Select Process</option>"));
                            $.each(data, function(index, name) {
                                $("#fetchprocessdescription").append($("<option id=''></option>").val(name['idSaleProcess']).html(name['SaleProcessDescription']));
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
            $("#ufetchprocessdescription").empty();
            var getdetail = $(obj).val();
            var checktext = $("#uidcrcomplainrelation :selected").val();

            if (checktext === "Product") {

                $("#ulabeldetaildescription").hide();
                $("#ufetchcontactdetails").hide();
            }
            else {
                $("#ulabeldetaildescription").show();
                $("#ufetchcontactdetails").show();
            }

            if (getdetail !== null) {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Subprocessdescription/servicefilteredprocesslist",
                    type: "POST",
                    data: {process: getdetail},
                    dataType: "json",
                    success: function(data) {
                        if (data.length > 0) {
                            $("#ufetchprocessdescription").append($("<option id=''>Select Process</option>"));
                            $.each(data, function(index, name) {
                                $("#ufetchprocessdescription").append($("<option id=''></option>").val(name['idSaleProcess']).html(name['SaleProcessDescription']));
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
    function rolePopup(div_id, id, code, name,idsaleprocess,saleprocess) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $('#idsubprocess').val(id);
            $("#ufetchprocessdescription").append($("<option id='' Selected></option>").val(idsaleprocess).html(saleprocess));
            $("#subprocescode").val(code);
            $("#subprocesname").val(name);

        });
    }
    function validationform(type) {
        if (type === 'Add') {
            var shwRelatedto = $('#subrelto').val();
            var shwDescription = $('#fetchcontactdetails').val();
            var shwProcess = $('#fetchprocessdescription').val();
            if (shwRelatedto === "Select Related to" && shwDescription === "Select Detail" && shwProcess === "Select Process") {
                $(".error-srelto").show();
                $(".error-sdetail").show();
                $(".error-sprocesss").show();
                return false;
            } else {
                if (shwRelatedto === "Select Related to" || shwDescription === "Select Detail" || shwProcess === "Select Process") {

                    if (shwRelatedto === "Select Related to") {
                        $(".error-srelto").show();
                    } else {
                        $(".error-srelto").hide();
                    }

                    if (shwDescription === "Select Detail") {
                        $(".error-sdetail").show();
                    } else {
                        $(".error-sdetail").hide();
                    }

                    if (shwProcess === "Select Process") {
                        $(".error-sprocesss").show();
                    } else {
                        $(".error-sprocesss").hide();
                    }
                    return false;
                }
                return true;
            }
        } else {
            var shwRelatedto = $('#usubrelto').val();
            var shwDescription = $('#ufetchcontactdetails').val();
            var shwProcess = $('#ufetchprocessdescription').val();
            if (shwRelatedto === "Select Related to" && shwDescription === "Select Detail" && shwProcess === "Select Process") {
                $(".error-usrelto").show();
                $(".error-usdetail").show();
                $(".error-usprocesss").show();
                return false;
            } else {
                if (shwRelatedto === "Select Related to" || shwDescription === "Select Detail" || shwProcess === "Select Process") {

                    if (shwRelatedto === "Select Related to") {
                        $(".error-usrelto").show();
                    } else {
                        $(".error-usrelto").hide();
                    }

                    if (shwDescription === "Select Detail") {
                        $(".error-usdetail").show();
                    } else {
                        $(".error-usdetail").hide();
                    }

                    if (shwProcess === "Select Process") {
                        $(".error-usprocesss").show();
                    } else {
                        $(".error-usprocesss").hide();
                    }
                    return false;
                }
                return true;
            }
        }
    }

</script>