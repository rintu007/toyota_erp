<div id="wrapper">
    <div id="content">
        <?php
        $cookieData = unserialize($_COOKIE['logindata']);
        if ($cookieData['isAdmin'] == 1) {
            include 'include/admin_leftmenu.php';
        } else {
            include 'include/leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="dispatchmodeform" onSubmit="" method="post"
                  action="<?= base_url() ?>index.php/dispatchmode/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Dispatch Order Mode</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Mode</label>
                            <input id="DispatchMode" name="DispatchMode" type= "text" placeholder="Dispatch Order Mode" data-validation="required">
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
                    <legend>Dispatch Order   List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Dispatch Order Mode</label>
                        <input type="text" name="SearchDispatchMode" id="SearchDispatchMode"  placeholder="Search by Mode">
                    </div><br>
                    <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="dispatchmodelisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="75%">Dispatch-Mode</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="dispatchmodelisthf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="dispatchmodelistbody">
                                <?php
                                $Counter = 1;
                                foreach ($dispatchmodeList as $key) {
                                    ?>
                                    <tr id="dispatchmodeTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Mode'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdateDispatchMode('detail', '<?= $key['idDispatch'] ?>', '<?= $key['Mode'] ?>')">Edit</a>                                         
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 700px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/dispatchmode/Update" method="POST" class="form animated fadeIn" onSubmit="">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>ID Dispatch Order Mode</label>
                        <input id="idDispatch" name="idDispatch" type="text" data-validation="">
                    </div>
                    <div>
                        <label>Dispatch Order Mode</label>
                        <input id="uDispatchMode" name="uDispatchMode" type= "text" placeholder="Dispatch Order Mode" data-validation="required">
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

    $("#SearchDispatchMode").keyup(function() {
        var search = $("#SearchDispatchMode").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/dispatchmode/search",
            type: "POST",
            data: {DispatchMode: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".dispatchmodelisthf").is(":visible"))) {
                                $(".dispatchmodelisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Mode + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdateDispatchMode('detail','" + val.idDispatch + "','" + val.Mode + "')> Edit </a></td></tr>";
                            });
                            $('#dispatchmodelistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".dispatchmodelisthf").hide();
                        $("#dispatchmodelistbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function UpdateDispatchMode(div_id, idDispatch, Mode) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idDispatch").val(idDispatch);
            $(this).find("#uDispatchMode").val(Mode);
        });
    }

</script>