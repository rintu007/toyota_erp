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
            <form name="financeinfoform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/financeinfo/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Customer Type</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Type</label>
                            <input type="text" id="financename" name="FinanceName" placeholder="Customer Type" data-validation="required">
                        </div><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Customer Type Information List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Customer Type</label>
                        <input type="text" name="searchfinanceinfo" id="searchfinanceinfo"  placeholder="Search by Customer Type">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="financeinfolisthf">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="60%">Customer Type</th>
                                    <th width="30%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="financeinfolisthf">
                                <tr>
                                    <td colspan="3">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="financeinfolistbody">
                                <?php
                                $Counter = 1;
                                foreach ($financeInfoList as $key) {
                                    ?>
                                    <tr id="finaceTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Name'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idFinance'] ?>', '<?= $key['Name'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/financeinfo/Delete/<?= $key['idFinance'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/financeinfo/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform()" >
                    <img src ="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                      <div style="display: none;">
                        <label>Finance Info ID</label>
                        <input type="text" name="IdFinanceInfo" id="idfinanceinfo" data-validation="required">
                    </div>
                    <div>
                        <label>Type</label>
                        <input type="text" id="financename" name="FinanceName" placeholder="Finance Name" data-validation="required">
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

    $("#searchfinanceinfo").keyup(function() {
        var search = $("#searchfinanceinfo").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/financeinfo/search",
            type: "POST",
            data: {searchfinanceinfo: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".financeinfolisthf").is(":visible"))) {
                                $(".financeinfolisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Name + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idFinance + "','" + val.Name + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/financeinfo/Delete/" + val.idFinance + "' >Delete</a></td></tr>";
                            });
                            $('#financeinfolistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".financeinfolisthf").hide();
                        $("#financeinfolistbody").html("No Data Found");
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

    function UpdatePopup(div_id, idfinanceinfo, financetype) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idfinanceinfo").val(idfinanceinfo);
            $(this).find("#financename").val(financetype);
        });
    }

</script>