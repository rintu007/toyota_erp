<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/masterdata_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="insuranceCompanyForm" onSubmit="" method="post"
                  action="<?= base_url() ?>index.php/Insurancecompany/Add" class="form validate-form animated fadeIn">
                      <?php echo $insertMessage ?>
                      <?php echo $updateMessage ?>
                      <?php echo $deleteMessage ?>
                <fieldset>
                    <legend>Add Insurance Company</legend>
                    <div class="feildwrap">
                        <br><br><div>
                            <label>Name</label>
                            <input id="InsuranceCompanyName" name="InsuranceCompanyName" type="text" placeholder="Insurance Company Name" data-validation="required">
                        </div><br><br>
                        <div>
                            <label>Code</label>
                            <input id="InsuranceCompanyCode" name="InsuranceCompanyCode" type="text" placeholder="Insurance Company Code" data-validation="required">
                        </div><br><br>
                        <div>
                            <label>Remarks</label>
                            <textarea id="InsuranceCompanyRemarks" name="InsuranceCompanyRemarks" placeholder="Insurance Company Remarks" style="margin: 0px; width: 250px; height: 100px;"></textarea>
                        </div><br><br>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add" style="margin-left: 50px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Insurance Company List</legend>              
                    <div class="feildwrap">
                        <label>Search Company</label>
                        <input type="text" name="SearchInsuranceCompany" id="SearchInsuranceCompany" placeholder="Search By Ins. Company / Code" style="width: 300px;">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="InsuranceCompanyListHF">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="30%">Name</th>
                                    <th width="15%">Code</th>
                                    <th width="40%">Remarks</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="InsuranceCompanyListHF">
                                <tr>
                                    <td colspan="7">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="InsuranceCompanyTBody">
                                <?php
                                $Counter = 1;
                                foreach ($insuranceCompanyList as $key) {
                                    ?>
                                    <tr id="insuranceCompanyTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['Name'] ?></td>
                                        <td class="tbl-name"><?= $key['CompanyCode'] ?></td>
                                        <td class="tbl-name"><?= $key['Remarks'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idInsuranceCompany'] ?>', '<?= $key['Name'] ?>', '<?= $key['CompanyCode'] ?>', '<?= rawurlencode($key['Remarks']) ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/insurancecompany/Delete/<?= $key['idInsuranceCompany'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 500px;" class="feildwrap  popup popup-detail">
                <form action="<?php echo base_url() ?>index.php/insurancecompany/Update" method="POST" class="form animated fadeIn" onSubmit="">
                    <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                    <div class="feildwrap" style="margin-left: -60px;">
                        <div style="display: none;">
                            <label>Insurance Company ID</label>
                            <input id="idInsuranceCompany" name="idInsuranceCompany" type="text" data-validation="">
                        </div><br><br>
                        <div>
                            <label>Name</label>
                            <input id="InsuranceCompanyName" name="InsuranceCompanyName" type="text" placeholder="Insurance Company Name" data-validation="required">
                        </div><br><br>
                        <div>
                            <label>Code</label>
                            <input id="InsuranceCompanyCode" name="InsuranceCompanyCode" type="text" placeholder="Insurance Company Code" data-validation="required">
                        </div><br><br>
                        <div>
                            <label>Remarks</label>
                            <textarea id="InsuranceCompanyRemarks" name="InsuranceCompanyRemarks" placeholder="Insurance Company Remarks" style="margin: 0px; width: 250px; height: 100px;"></textarea>
                        </div><br><br>
                        <div style="margin-left: 300px;">
                            <input type="submit" class="btn" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#SearchInsuranceCompany").focusout(function() {
        var search = $("#SearchInsuranceCompany").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/insurancecompany/search",
            type: "POST",
            data: {searchinsurancecompany: search},
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
                                        "<td class='tbl-name'>" + val.Name + "</td>" +
                                        "<td class='tbl-name'>" + val.CompanyCode + "</td>" +
                                        "<td class='tbl-name'>" + val.Remarks + "</td>" +
                                        "<td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idInsuranceCompany + "','" + encodeURI(val.Name) + "','" + encodeURI(val.CompanyCode) + "','" + encodeURI(val.Remarks) + "')> Edit </a><span>|</span><a style='cursor: pointer'; href='<?= base_url() ?>index.php/bay/Delete/" + val.idInsuranceCompany + "' >Delete</a></td></tr>";
                            });
                            $('#InsuranceCompanyTBody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#InsuranceCompanyTBody").html('<tr><td></td><td>No Company Exist</td><td></td></tr>');
                    }
                }
            }
        });
    });

    function validationform(type) {
    }

    function UpdatePopup(div_id, idInsuranceCompany, Name, CompanyCode, Remarks) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow',
            followSpeed: 1500,
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#idInsuranceCompany").val(idInsuranceCompany);
            $(this).find("#InsuranceCompanyName").val(decodeURI(Name));
            $(this).find("#InsuranceCompanyCode").val(decodeURI(CompanyCode));
            $(this).find("#InsuranceCompanyRemarks").val(decodeURI(Remarks));
        });
    }

</script>