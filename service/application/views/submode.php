<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="subromodeform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/subromode/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Sub RO Mode</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Sub RO Mode</label>
                            <input id="subromode" name="subromode" type= "text" placeholder="Sub RO Modes" data-validation="required">
                        </div><br>
						<div>
                            <label>RO Mode</label>
                            <select id="romode" name="romode">
							<option>RO Mode</option>
							<?php
							foreach($modeList as $key) { 
							$idROMode = $modeList['idROMode'];
							?>
							<option value="<?= $key['idROMode'] ?>"><?= $key['ModeName'] ?></option>
							<?php 
							} 
							?>
							</select>
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
                    <legend>Sub RO Mode List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Sub RO Mode</label>
                        <input type="text" name="SearchMode" id="SearchMode"  placeholder="Search by Mode">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="subromodelisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="37.5%">Sub RO-Mode</th>
                                    <th width="37.5%">RO-Mode</th>
                                    <th width="20%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="subromodelisthf">
                                <tr>
                                    <td colspan="4">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="subromodelistbody">
                                <?php
                                $Counter = 1;
                                foreach ($SubModeList as $key) {
                                    ?>
                                    <tr id="subromodeTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
										<td class="tbl-name"><?= $key['SubModeName'] ?></td>
                                        <td class="tbl-name"><?= $key['ModeName'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="Updatesubmode('detail', '<?= $key['idSubMode'] ?>', '<?= $key['SubModeName'] ?>', '<?= $key['ModeName'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/subromode/Delete/<?= $key['idSubMode'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 700px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/subromode/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')"">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>ID RO Mode</label>
                        <input id="idsubmode" name="idsubmode" type="text" data-validation="required">
                    </div>
                    <div>
                        <label>Sub RO Mode</label>
                        <input id="usubromode" name="usubromode" type= "text" placeholder="RO Modes" data-validation="required">
                    </div>
					<div>
                            <label>RO Mode</label>
                            <select id="romode" name="romode">
							<option>RO Mode</option>
							<?php
							foreach($modeList as $key) { 
							$idROMode = $modeList['idROMode'];
							?>
							<option value="<?= $key['idROMode'] ?>"><?= $key['ModeName'] ?></option>
							<?php 
							} 
							?>
							</select>
                        </div>
					<!-- <div>
                        <label>Status</label>
						<?
                         foreach ($subromodeList as $key) {
                        ?>
                        <select id="status" name="status" required>
						 <option>Status</option>
                                <option value="0" >Deactive</option>
								<option value="1" >Active</option>
                                
                        </select>
                    </div> -->
                    <div style="float: right;margin-right:60px;">
                        <input type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#SearchMode").keyup(function() {
        var search = $("#SearchMode").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/subromode/search",
            type: "POST",
            data: {subromode: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".subromodelisthf").is(":visible"))) {
                                $(".subromodelisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.ModeName + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=Updatesubmode('detail','" + val.idsubromode + "','" + val.ModeName + "','" + val.SubModeName + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/subromode/Delete/" + val.idsubromode + "' >Delete</a></td></tr>";
                            });
                            $('#subromodelistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".subromodelisthf").hide();
                        $("#subromodelistbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform(type) {
        if (type === 'Add') {
            var typeName = $('#SelectDealer').val();
            if (typeName === "Select Dealer") {
                $(".error-type").show();
                return false;
            } else {
                $(".error-type").hide();
                return true;
            }
        } else {
            if (type === 'Update') {
                var updateQuestion = $('#IdDealer').val();
                if (updateQuestion === "Select Dealer") {
                    $(".error-updatetype").show();
                    return false;
                } else {
                    $(".error-updatetype").hide();
                    return true;
                }
            }
        }
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

    function Updatesubmode(div_id, idsubromode, Mode,romode) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idsubmode").val(idsubromode);
            $(this).find("#usubromode").val(Mode);
			$(this).find("#romode").val(romode);
        });
    }

</script>