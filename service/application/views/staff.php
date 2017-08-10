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
            <form name="staffform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/staff/Add" class="form validate-form animated fadeIn">
                <h4><?= $insertMessage ?></h4>
                <fieldset>
                    <legend>Add Staff</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Name</label>
                            <input type="text" name="StaffName" placeholder="Staff Name" data-validation="required">
                        </div><br>
                        <div>
                            <label>Staff Role</label>
                            <select id="SelectStaffRole" name="SelectStaffRole">
                                <option>Select Role</option>
                                <?php
                                foreach ($staffRolesList as $key) {
                                    $idStaffRoles = $staffRolesList['idStaffRoles'];
                                    ?>
                                    <option value="<?= $key['idStaffRoles'] ?>" ><?= $key['RoleName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-staff cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br>
						<div>
                            <label>Staff Description</label>
                            <select id="SelectStaffDesc" name="SelectStaffDesc">
                                <option>Select Description</option>
                                <?php
                                foreach ($StaffDescList as $key) {
                                    $idStaffDesc = $StaffDescList['idStaffDesc'];
                                    ?>
                                    <option value="<?= $key['idStaffDesc'] ?>" ><?= $key['StaffDesc'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-staff cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br>
						<div>
                            <label>Salary</label>
                            <input type="text" name="Salary" placeholder="Salary " data-validation="required">
                        </div><br>
                        <label>Rating</label>
                        <div class="star-rating">
                            <input type="radio" name="StaffRating" class="rating" value="1" />
                            <input type="radio" name="StaffRating" class="rating" value="2" />
                            <input type="radio" name="StaffRating" class="rating" value="3" />
                            <input type="radio" name="StaffRating" class="rating" value="4" />
                            <input type="radio" name="StaffRating" class="rating" value="5" />
                            <input type="radio" name="StaffRating" class="rating" value="6" />
                            <input type="radio" name="StaffRating" class="rating" value="7" />
                            <input type="radio" name="StaffRating" class="rating" value="8" />
                            <input type="radio" name="StaffRating" class="rating" value="9" />
                            <input type="radio" name="StaffRating" class="rating" value="10" />
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Staff" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Staff List</legend>
                    <?php echo $updateMessage ?>
                    <?php echo $deleteMessage ?><br>
                    <div class="feildwrap">
                        <label>Search Staff Member</label>
                        <input type="text" name="searchstaff" id="searchstaff"  placeholder="Search by Name">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="stafflisthf">
                                <tr>
                                    <th style="width:10%;">S No.</th>
                                    <th style="width:10%;">Staff Name</th>
                                    <th style="width:10%;">Role</th>
                                    <th style="width:10%;">Salary</th>
                                    <th style="width:10%;">Staff Description</th>
                                    <th style="width:10%;">Rating</th>
                                    <th style="width:10%;">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="stafflisthf">
                                <tr>
                                    <td colspan="7">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="stafflistbody">
                                <?php
                                $Counter = 1;
                                foreach ($staffsList as $key) {
                                    ?>
                                    <tr id="staffTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Name'] ?></td>
                                        <td class="tbl-name"><?= $key['RoleName'] ?></td>
                                        <td class="tbl-name"><?= $key['salary'] ?></td>
                                        <td class="tbl-name"><?= $key['StaffDesc'] ?></td>
                                        <td class="tbl-name"><?= $key['Rating'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idStaff'] ?>', '<?= $key['Name'] ?>', '<?= $key['RoleName'] ?>', '<?= $key['salary'] ?>', '<?= $key['StaffDesc'] ?>', '<?= $key['Rating'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/staff/Delete/<?= $key['idStaff'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/staff/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div style="display: none;">
                        <label>Staff ID</label>
                        <input type="text" name="IdStaff" id="idstaff" data-validation="required">
                    </div>
                    <div>
                        <label>Staff Name</label>
                        <input type="text" name="StaffName" id="staffname" data-validation="required">
                    </div>
                    <div>
                        <label>Staff Role</label>
                        <select id="RoleName" name="SelectStaffRole" >
                            <?php foreach($staffsList as $key) { ?>
							<option value="<?= $key['idStaffRoles'] ?>" ><?= $key['RoleName']; } ?></option>
                            <?php
                            foreach ($staffRolesList as $key) {
                                $idStaffRoles = $staffRolesList['idStaffRoles'];
                                ?>
                                <option value="<?= $key['idStaffRoles'] ?>"><?= $key['RoleName'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span class="error-updatestaff cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                    </div><br>
					<div>
                            <label>Staff Description</label>
                            <select id="StaffDesc" name="SelectStaffDesc">
							<?php foreach($staffsList as $key) { ?>
                                <option value="<?= $key['idStaffDesc'] ?>"><?= $key['StaffDesc']; }?></option>
                                <?php
                                foreach ($StaffDescList as $key) {
                                    $idStaffDesc = $StaffDescList['idStaffDesc'];
                                    ?>
                                    <option value="<?= $key['idStaffDesc'] ?>" ><?= $key['StaffDesc'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-staff cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br>
						<div>
                            <label>Salary</label>
                            <input type="text" name="Salary" id="salary" placeholder="Salary " data-validation="required">
                        </div><br>
                    <label>Rating</label>
                    <div id="updateRatings" class="star-rating">
                        <input type="radio" id="uRating1" name="StaffRating" class="urating" value="1" />
                        <input type="radio" id="uRating2"  name="StaffRating" class="urating" value="2" />
                        <input type="radio" id="uRating3"  name="StaffRating" class="urating" value="3" />
                        <input type="radio" id="uRating4"  name="StaffRating" class="urating" value="4" />
                        <input type="radio" id="uRating5"  name="StaffRating" class="urating" value="5" />
                        <input type="radio" id="uRating6"  name="StaffRating" class="urating" value="6" />
                        <input type="radio" id="uRating7" name="StaffRating" class="urating" value="7" />
                        <input type="radio" id="uRating8"  name="StaffRating" class="urating" value="8" />
                        <input type="radio" id="uRating9" name="StaffRating" class="urating" value="9" />
                        <input type="radio" id="uRating10"  name="StaffRating" class="urating" value="10" />
                    </div>
                    <div style="margin-left: 300px;">
                        <input type="submit" class="btn" value="Update Staff">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {                   // Start when document ready
        $('.star-rating').rating(); // Call the rating plugin
        // Call the rating plugin

    });
    $("#searchstaff").keyup(function() {
        var search = $("#searchstaff").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/staff/search",
            type: "POST",
            data: {searchstaffname: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {

                            if (!($(".stafflisthf").is(":visible"))) {
                                $(".stafflisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                            <td class='tbl-name'>" + val.Name + "</td>\n\
                            <td class='tbl-name'>" + val.RoleName + "</td>\n\
                            <td class='tbl-name'>" + val.salary + "</td>\n\
							<td class='tbl-name'>" + val.StaffDesc + "</td>\n\
							<td class='tbl-name'>" + val.Rating + "</td>\n\
                            <td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idStaff + "','" + val.StaffName + "','" + val.RoleName + "','" + val.salary + "','" + val.StaffDesc + "','" + val.Rating + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/staff/Delete/" + val.idStaff + "' >Delete</a></td></tr>";
                            });
                            $('#stafflistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".stafflisthf").hide();
                        $("#stafflistbody").html("No Data Found");
                    }
                }
            }
        });
    });

    function validationform(type) {
        if (type === 'Add') {
            var staffRole = $('#SelectStaffRole').val();
            if (staffRole === "Select Role") {
                $(".error-staff").show();
                return false;
            } else {
                $(".error-staff").hide();
                return true;
            }
        } else {
            if (type === 'Update') {
                var updateStaffRole = $('#UpdateSelectStaffRole').val();
                if (updateStaffRole === "Select Role") {
                    $(".error-updatestaff").show();
                    return false;
                } else {
                    $(".error-updatestaff").hide();
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

    function UpdatePopup(div_id, idstaff, staffname, RoleName, salary, StaffDesc, rating) {

        for (var i = 1; i <= rating; i++) {
            $('#updateRatings #StaffRating' + i).trigger('click');
        }
        $('#uRating' + rating).attr('checked', true);

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idstaff").val(idstaff);
            $(this).find("#staffname").val(staffname);
			$(this).find("#RoleName").val(RoleName);
			$(this).find("#salary").val(salary);
			$(this).find("#StaffDesc").val(StaffDesc);
			$(this).find("#rating").val(rating);
			
        });
    }

</script>