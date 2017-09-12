<div id="wrapper">
    <div id="content">
        <?php
        include 'include/admin_leftmenu.php';
        $cookieData = unserialize($_COOKIE['logindata']);
//        if ($cookieData['username'] == "admin") {
//            include 'include/admin_leftmenu.php';
//        } else if ($cookieData['Role'] == "Sales Admin") {
//            include 'include/sales_leftmenu.php';
//        } else if ($cookieData['Role'] == "Director") {
//            include 'include/director_menu.php';
//        } else {
//            include 'include/leftmenu.php';
//        }
        ?>
        <div class="right-pnel">
            <form name="myform" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Adduser/adduser" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Add New User</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Full Name</label>
                            <input type="text" name="fullname" data-validation="required">
                        </div>
                        <div>
                            <label>DealerShip</label>
                            <select name="dealership">
                                <option>Select Dealer</option>
                                <?php
                                foreach ($DealerShip as $CarDealerShip) {
                                    $DealerShipId = $CarDealerShip['Id'];
                                    ?>
                                    <option value="<?= $CarDealerShip['Id'] ?>" ><?= $CarDealerShip['DealerShipName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>User Department</label>
                            <select name="userdepartment">
                                <option>Select Department</option>
                                <?php
                                foreach ($UserDepartment as $Department) {
                                    $DepartmentId = $Department['Id'];
                                    ?>
                                    <option value="<?= $Department['Id'] ?>" ><?= $Department['Department'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>User Role</label>
                            <select name="userrole">
                                <option>Select Role</option>
                                <?php
                                foreach ($UserRole as $Role) {
                                    $RoleId = $Role['Id'];
                                    ?>
                                    <option value="<?= $Role['Id'] ?>" ><?= $Role['RoleName'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>UserName</label>
                            <input type="text" name="username" data-validation="required">
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" id="pass" name="password"
                                   style="width: 250px;">
                        </div>
                        <div>
                            <label>Confirm Password</label>
                            <input type="password" id="cpass" name="confirm_password" style="width: 250px;">
                        </div>
                        <span class="pass-error" style="display: none; background: none repeat scroll 0 0 #EFEFEF;
                              border: 1px solid;
                              color: #FF3300;
                              padding: 0 10px;
                              z-index: 888;
                              position: absolute;">
                            Password Doesn't match.</span>

                        <div>
                            <label>Email</label>
                            <input type="email" name="email">
                        </div>

                        <div>
                            <label>Date of Birth</label>
                            <!--<input type="email" name="email" data-validation="email">-->
                            <input type="date" name="dob" style="width: 250px;" />
                        </div>
                        <div>
                            <label>Mobile Number</label>
                            <input type="text" name="mobile_number" data-validation="number">
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add New User">
                        </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Users List</legend>
                    <div class="feildwrap">
                        <div>
                            <label>Search Users</label>
                            <input type="text" name="search" id="search"
                                   placeholder="Search By Name">
                            <!--<input type="button" id="submitSearch" class="btn" value="Search">-->
                        </div>
                        <h4><?= $message ?></h4>
                    </div>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="5%">S No.</th>
                                    <th width="15%">Full Name</th>
                                    <th width="12%">User Name</th>
                                    <th width="5%">Department</th>
                                    <th width="8%">Role</th>
                                    <th width="18%">DealerShip</th>
                                    <!--<th width="10%">Price</th>-->
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div id="paging">
                                            <ul>
                                                <!--                                            <li><a href=""><span>Previous</span></a></li>-->
                                                <!--                                                <li><a href="" class="active"><span>1</span></a></li>-->
                                                <!--                                            <li><a href="" class="active"><span>-->
                                                <!--</span></a></li>-->
                                                <!--                                            <li>-->
                                                <?//= $pagination; ?><!--</li>-->
                                                <!--                                                <li><a href=""><span>3</span></a></li>-->
                                                <!--                                                <li><a href=""><span>4</span></a></li>-->
                                                <!--                                                <li><a href=""><span>5</span></a></li>-->
                                                <!--                                            <li><a href=""><span>Next</span></a></li>-->
                                            </ul>
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="finalResult">
                                <?php
                                $count = 1;
                                foreach ($Users as $CarUsers) {
                                    $UserId = $CarUsers['Id'];
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $CarUsers['FullName'] ?></td>
                                        <td class="tbl-name"><?= $CarUsers['Username'] ?></td>
                                        <td class="tbl-name"><?= $CarUsers['Department'] ?></td>
                                        <td class="tbl-name"><?= $CarUsers['RoleName'] ?></td>
                                        <td class="tbl-name"><?= $CarUsers['Name'] ?></td>
    <!--                                        <td class="tbl-name"><?php
//                                            if ($CarUsers['IsDeleted'] == 1) {
//                                                echo "Not Active";
//                                            } else {
//                                                echo "Active";
//                                            }
                                        ?></td>-->
                                        <td><a style="cursor: pointer;" onClick="userPopup('detail', '<?= $UserId ?>', '<?= $CarUsers['FullName'] ?>', '<?= $CarUsers['Username'] ?>', '<?= $CarUsers['Password'] ?>', '<?= $CarUsers['Email'] ?>', '<?= $CarUsers['ContactNumber'] ?>', '<?= $CarUsers['IdDepartment'] ?>', '<?= $CarUsers['RoleId'] ?>', '<?= $CarUsers['DateOfBirth'] ?>', '<?= $CarUsers['DealerShip'] ?>')">Edit</a> / 
                                            <?php
                                            echo anchor(base_url() . 'index.php/adduser/delete/' . $UserId, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- Edit User Pop UP -->
<div style="width: 500px;" class="feildwrap  popup popup-detail">
    <form action="<?= base_url() ?>index.php/adduser/update" method="POST" class="form animated fadeIn">
        <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
        <div style="display: none;">
            <label>User ID</label>
            <input type="text" id="idUser" name="user_id">
        </div>
        <br>
        <div>
            <label>Full Name</label>
            <input type="text" id="full_name" name="full_name">
        </div>
        <div>
            <label>DealerShip</label>
            <select name="dealership" id="dealership">
                <option>Select Dealer</option>
                <?php
                foreach ($DealerShip as $CarDealerShip) {
                    $DealerShipId = $CarDealerShip['Id'];
                    ?>
                    <option value="<?= $CarDealerShip['Id'] ?>" ><?= $CarDealerShip['DealerShipName'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>User Department</label>
            <?php // echo form_dropdown('userdepartment', $UserDepartment, '', 'id="department"'); ?>
            <select name="userdepartment" id="department">
                <option>Select</option>
                <?php
                foreach ($UserDepartment as $Department) {
                    $DepartmentId = $Department['Id'];
                    ?>
                    <option value="<?= $Department['Id'] ?>" ><?= $Department['Department'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>User Role</label>
            <?php // echo form_dropdown('userrole', $UserRole, '', 'id="role"'); ?>
            <select name="userrole" id="role">
                <option>Select</option>
                <?php
                foreach ($UserRole as $Role) {
                    $RoleId = $Role['Id'];
                    ?>
                    <option value="<?= $Role['Id'] ?>" ><?= $Role['RoleName'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <label>UserName</label>
            <input type="text" id="user_name" name="user_name">
        </div>
        <div id="model">
            <label>Password</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <label>Date of Birth</label>
            <!--<input type="email" name="email" data-validation="email">-->
            <input type="date" name="dob" id="dob" style="width: 250px;" />
        </div>
        <div>
            <label>Email</label>
            <input type="email" id="email" name="email" data-validation="required">
        </div>
        <div>
            <label>Mobile Number</label>
            <input type="text" id="mobilenumber" name="mobile_number" data-validation="number">
        </div>
        <div style="margin-left: 300px;">
            <input type="submit" class="btn" value="Update User">
        </div>
    </form>
</div>
<script>
    $("#search").keyup(function() {
        var search = $("#search").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/adduser/search",
            type: "POST",
            data: {search: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
//                    console.log(a.length);
                    if (a.length > 0) {
                        try {
                            var items = "";
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + val.Id + "</td>\n\
                            <td class='tbl - name'>" + val.FullName + "</td><td>" + val.Username + "</td>\n\
<td>" + val.Department + "</td><td>" + val.RoleName + "</td><td>" + val.Name + "</td>\n\
<td><a style='cursor: pointer;' onClick=userPopup('detail','" + val.Id + "','" + encodeURI(val.FullName) + "','" + encodeURI(val.Username) + "','" + encodeURI(val.Password) + "','" + val.Email + "','" + val.ContactNumber + "','" + val.IdDepartment + "','" + val.RoleId + "','" + val.DateOfBirth + "','" + encodeURI(val.DealerShip) + "')> Edit </a></td></tr>";
                            });
                            $('#finalResult').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                }
                else {
                    console.log("else Block");
                    $("#finalResult").html("<td style='border: 0px'></td><td style='border: 0px'></td><td style='border: 0px'></td>" +
                            "<td style='border: 0px'></td><td style='border: 0px'>No Data Found</td><td style='border: 0px'></td>\n\
                                <td style='border: 0px'></td>");
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

    function userPopup(div_id, id, name, user, pass, email, mobile, department, role, dob, dealership) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//                var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idUser").val(id);
            $(this).find("#full_name").val(decodeURI(name));
            $(this).find("#user_name").val(decodeURI(user));
            $(this).find("#password").val(decodeURI(pass));
            $(this).find("#email").val(email);
            $(this).find("#mobilenumber").val(mobile);
            $(this).find("select#department").val(department);
            $(this).find("select#role").val(role);
            $(this).find("#dob").val(dob);
            $(this).find("#dealership").val(decodeURI(dealership));
        });
    }

</script>