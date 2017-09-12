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
        <div class="right-pnel">
            <form id="addroutes" name="myform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/Route/addroutes" class="form validate-form animated fadeIn">
                <div class="feildwrap">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend>Add Route</legend>
                        <div>
                            <label id="isdepartmentlbl" >Department</label>
                            <input id="isdepartment" name="isdepartment" type='checkbox' value=1 onclick="showdeparts()">
                            <div id="isshowdepart"><br><br>
                                <select id="selectdep" name = "departmentname" data-validation="">
                                    <option>Select Department</option>
                                    <?php
                                    $json_encode = json_decode($departments);
                                    foreach ($json_encode as $key) {
                                        ?>
                                        <option value=<?php echo $key->Department ?>><?php
                                            echo $key->Department;
                                            ?></option>
                                    <?php } ?>
                                </select>
                                <span class="error-isDepart cb-error help-block" style="margin-left: 350px;margin-top: -35px">Option must be selected!</span>
                            </div>
                        </div><br>
                        <div>
                            <label class="isroutesname">Route</label>
                            <input id="routename" class="isroutesname" name="routename" type='text' data-validation="required">
                        </div><br>  
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Route">
                        </div>
                </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Route List</legend>
                    <div class="feildwrap">
                        <?php echo $updateMessage ?>
                        <br><div class="btn-block-wrap dg">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="30%">S No.</th>
                                        <th width="35%">Route</th>
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
                                    $routeslist = json_decode($routeslist);
                                    foreach ($routeslist as $key) {
                                        ?>
                                        <tr id="routes">
                                            <td class="resId" name="routsno"><?= $count++ ?></td>
                                            <td name="routesname" class="tbl-name"><?= $key->Name ?></td>
                                            <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?php echo $key->idcr_route ?>', '<?php echo $key->Name ?>')">Edit</a></td>
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
                <form action="<?php echo base_url() ?>index.php/Route/updateroutes" method="post" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Route ID</label>
                        <input type="text" name="idcrroute" id="idcrroute" data-validation="">
                    </div>
                    <label id="deplbl">Department</label>
                    <input id="isdep" name="isdep" type='checkbox' value=1 onclick="showUpdatedeparts()">
                    <div id="isdepshow"><br><br>
                        <select id="selectdp" name="departmentname" style="width: 150px;">
                            <option>Select Department</option>
                            <?php
                            $json_encode = json_decode($departments);
                            foreach ($json_encode as $key) {
                                ?>
                                <option value=<?php echo $key->Department ?>><?php
                                    echo $key->Department;
                                    ?></option>
                            <?php } ?>
                        </select>
                        <span class="error-uisDepart cb-error help-block" style="width: 150px;margin-left: -215px;margin-top: -35px">Option must be selected!</span>
                    </div>
                    <div>
                        <label>Route</label>
                        <input type="text" name="name" id="name" data-validation="required">
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update Route">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#isshowdepart').hide();
        $("#isdepshow").hide();
    });

    $idcrroute = 0;
    function updateroute(val) {

        $idcrroute = val;
        $('#addroutes').hide();
        $('#updateformroute').show();
    }

    function showdeparts() {
        $("#isshowdepart").toggle();
        //        $(".isroutesname").toggle();
    }
    function showUpdatedeparts() {
        $("#isdepshow").toggle();
        //        $(".isroutesname").toggle();
    }

    function UpdatePopup(div_id, id, Name) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idcrroute").val(id);
            $(this).find("#name").val(Name);
        });
    }

    function validationform(type) {
        if (type === 'Add') {
            var isDepartment = $('#isdepartment').is(':checked');
            var selectValue = $('#selectdep').val();
            if (isDepartment) {
                if (selectValue === "Select Department") {
                    $(".error-isDepart").show();
                    return false;
                } else {
                    $(".error-isDepart").hide();
                    return true;
                }
            }
        } else {
            if (type === 'Update') {
                var isDep = $('#isdep').is(':checked');
                var slctValue = $('#selectdp').val();
                if (isDep) {
                    if (slctValue === "Select Department") {
                        $(".error-uisDepart").show();
                        return false;
                    } else {
                        $(".error-uisDepart").hide();
                        return true;
                    }
                }
            }
        }
    }

</script>