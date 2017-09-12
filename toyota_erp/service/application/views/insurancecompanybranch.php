<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        }
        ?>
        <div class="right-pnel">

            <form name="insuranceCompanyBranch" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/insurancecompanybranch/Add" class="form validate-form animated fadeIn">
                      <?php echo $insertMessage ?>
                      <?php echo $updateMessage ?>
                      <?php echo $deleteMessage ?>
                <fieldset>
                    <legend>Add Insurance Company Branch</legend>
                    <div class="feildwrap"><br><br>
                        <div>
                            <label>Insurance Company</label>
                            <select id="SelectInsuranceCompany" name="SelectInsuranceCompany">
                                <option>Select Company</option>
                                <?php
                                foreach ($insuranceCompanyList as $key) {
                                    ?>
                                    <option value="<?= $key['idInsuranceCompany'] ?>"><?= $key['Name'] . ', ' . $key['CompanyCode'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-inscompany cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div>
                        <div>
                            <label>Branch Name</label>
                            <input id="BranchName" name="BranchName" type="text" placeholder="Insurance Company Branch" data-validation="required">
                        </div><br><br>
                        <div>
                            <label>Contact</label>
                            <input id="BranchContact" name="BranchContact" type="text" placeholder="Insurance Company Contact" data-validation="">
                        </div>
                        <div>
                            <label>Email</label>
                            <input id="BranchEmail" name="BranchEmail" type="email" placeholder="Insurance Company Emaul" data-validation="">
                        </div><br><br>
                        <div>
                            <label>Address</label>
                            <textarea id="BranchAddress" name="BranchAddress" placeholder="Insurance Company Address" style="margin: 0px; width: 250px; height: 100px;"></textarea>
                        </div><br><br><br><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Branch" style="margin-left: 200px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>

            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Insurance Company Branch List</legend>
                    <div class="feildwrap">
                        <label>Search Branch</label>
                        <input type="text" name="searchBranch" id="searchBranch"  placeholder="Search By Branch">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table id="BranchTable" width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="">
                                <tr>
                                    <th width="10%">S No.</th>
                                    <th width="20%">Company Name</th>
                                    <th width="20%">Branch Name</th>
                                    <th width="15%">Contact</th>
                                    <th width="10%">Email</th>
                                    <th width="15%">Address</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="">
                                <tr>
                                    <td colspan="7">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="BranchTBody">
                                <?php
                                $Counter = 1;
                                foreach ($insBranchList as $key) {
                                    ?>
                                    <tr id="BranchTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['InsuranceCompanyName'] . ', ' . $key['InsuranceCompanyCode'] ?></td>
                                        <td class="tbl-name"><?= $key['BranchName'] ?></td>
                                        <td class="tbl-name"><?= $key['BranchContact'] ?></td>
                                        <td class="tbl-name"><?= $key['BranchEmail'] ?></td>
                                        <td class="tbl-name"><?= $key['BranchAddress'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idInsuranceCompanyDetail'] ?>', '<?= $key['idInsuranceCompany'] ?>', '<?= $key['BranchName'] ?>', '<?= $key['BranchContact'] ?>', '<?= $key['BranchEmail'] ?>', '<?= $key['BranchAddress'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/insurancecompanybranch/Delete/<?= $key['idInsuranceCompanyDetail'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>

            <!--Update Div-->
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/insurancecompanybranch/Update" method="POST" class="form animated fadeIn" onSubmit="return validationform('Update')">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div class="feildwrap">
                        <div style="display: none;">
                            <label>Insurance Company  Branch ID</label>
                            <input id="idInsuranceCompanyBranch" name="idInsuranceCompanyBranch" type="text" data-validation="">
                        </div><br><br>
                        <div>
                            <label>Insurance Company</label>
                            <select id="SelectInsuranceCompany" name="SelectInsuranceCompany">
                                <option>Select Company</option>
                                <?php
                                foreach ($insuranceCompanyList as $key) {
                                    ?>
                                    <option value="<?= $key['idInsuranceCompany'] ?>"><?= $key['Name'] . ', ' . $key['CompanyCode'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-inscompany cb-error help-block" style="margin-left: 20px;margin-top: -10px">Option must be selected!</span>
                        </div><br><br>
                        <div>
                            <label>Branch Name</label>
                            <input id="BranchName" name="BranchName" type="text" placeholder="Insurance Company Branch" data-validation="required">
                        </div><br><br>
                        <div>
                            <label>Contact</label>
                            <input id="BranchContact" name="BranchContact" type="text" placeholder="Insurance Company Contact" data-validation="">
                        </div><br><br>
                        <div>
                            <label>Email</label>
                            <input id="BranchEmail" name="BranchEmail" type="email" placeholder="Insurance Company Email" data-validation="">
                        </div><br><br>
                        <div>
                            <label>Address</label>
                            <textarea id="BranchAddress" name="BranchAddress" placeholder="Insurance Company Address" style="margin: 0px; width: 250px; height: 100px;"></textarea>
                        </div><br><br><br><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Update Branch" style="margin-left: 10px;width: 180px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchBranch").focusout(function() {
        var search = $("#searchBranch").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/insurancecompanybranch/search",
            type: "POST",
            data: {searchBranch: search},
            success: function(data) {
                if (data !== "null")
                {
                    var parsedData = JSON.parse(data);
                    if (parsedData.length > 0) {
                        try {
                            var items = [];
                            var count = 1;
                            $.each(parsedData, function(i, val) {
                                items += "<tr>" +
                                        "<td class='resId' name='resId'>" + count++ + "</td>" +
                                        "<td class='tbl-name'>" + val.InsuranceCompanyName + ', ' + val.InsuranceCompanyCode + "</td>" +
                                        "<td class='tbl-name'>" + val.BranchName + "</td>" +
                                        "<td class='tbl-name'>" + val.BranchContact + "</td>" +
                                        "<td class='tbl-name'>" + val.BranchEmail + "</td>" +
                                        "<td class='tbl-name'>" + val.BranchAddress + "</td>" +
                                        "<td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idInsuranceCompanyDetail + "','" + val.idInsuranceCompany + "','" + encodeURI(val.BranchName) + "','" + val.BranchContact + "','" + val.BranchEmail + "','" + encodeURI(val.BranchAddress) + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/bay/Delete/" + val.idInsuranceCompany + "' >Delete</a></td></tr>";
                            });
                            $('#BranchTBody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#BranchTBody").html('<tr><td></td><td>No Company Exist</td><td></td></tr>');
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
                var updateTypeName = $('#IdDealer').val();
                if (updateTypeName === "Select Dealer") {
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

    function UpdatePopup(div_id, idInsuranceCompanyDetail, idInsuaranceCompany, BranchName, BranchContact, BranchEmail, BranchAddress) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $('[name=SelectInsuranceCompany] option').filter(function() {
                return ($(this).val() == idInsuaranceCompany);
            }).prop('selected', true);
            $(this).find("#idInsuranceCompanyBranch").val(idInsuranceCompanyDetail);
            $(this).find("#BranchName").val(decodeURI(BranchName));
            $(this).find("#BranchContact").val(BranchContact);
            $(this).find("#BranchEmail").val(BranchEmail);
            $(this).find("#BranchAddress").val(decodeURI(BranchAddress));
        });
    }

</script>