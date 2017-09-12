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
            <form id="addcomplaintmodes" name="addcomplaintmodes" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/complaintmode/addcomplaintmodes" class="form validate-form animated fadeIn">
                <div class="feildwrap">  
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>                      
                        <legend>Add Complaint Mode</legend>
                        <div class="feildwrap">
                            <div>
                                <label>Complaint Mode</label>
                                <input type="text" name="name" data-validation="required">
                            </div>
                            <div class="btn-block-wrap">
                                <label>&nbsp;</label>
                                <input type="submit" class="btn" value="Add">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <div class="feildwrap">                
                    <fieldset>
                        <?php echo $updateMessage ?>
                        <legend>Complaint Mode List</legend>
                        <br><div class="btn-block-wrap dg">
                            <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                <thead>
                                    <tr>
                                        <th width="25%">S No.</th>
                                        <th width="25%">Name</th>
                                        <th width="25%">Details</th>
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
                                    $complaintmodeslist = json_decode($complaintmodeslist);
                                    foreach ($complaintmodeslist as $key) {
                                        ?>
                                        <tr id="carUsers">
                                            <td class="resId" name="resId"><?= $count++ ?></td>
                                            <td class="tbl-name"><?= $key->ModeName ?></td>
                                            <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?php echo $key->idcr_complainmode ?>', '<?php echo $key->ModeName ?>')">Edit</a>
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
                <form action="<?= base_url() ?>index.php/Complaintmode/updatecomplaintmodes" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Mode ID</label>
                        <input type="text" id="idcrcomplaintmode" name="idcrcomplaintmode"  data-validation="">
                    </div>
                    <div>
                        <label>Complaint Mode</label>
                        <input type="text" name="name" id="name" data-validation="required">
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

    $idcrcomplaintmode = 0;
    function updatecomplaintmode(val) {

        $idcrcomplaintmode = val;
        $('#addcomplaintmodes').hide();
        $('#updatecomplaintmodeform').show();
    }

    function validationform() {
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

    function UpdatePopup(div_id, id, Name) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idcrcomplaintmode").val(id);
            $(this).find("#name").val(Name);
        });
    }
</script>


