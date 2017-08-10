<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin" || $data['Role'] == "FinanceAdmin") {
            include 'include/finance_leftmenu.php';
        }
        ?>
        <div class="right-pnel">
            <form name="vendorform" onSubmit="return validationform('Add')" method="post"
                  action="<?= base_url() ?>index.php/vendor/Add" class="form validate-form animated fadeIn">
                <?php echo $insertMessage ?><br>
                <?php echo $updateMessage ?><br>
                <?php echo $deleteMessage ?><br>
                <fieldset>
                    <legend onclick="DoToggle('#VendorInfoDivDiv')">Customer Information</legend>
                    <br><div id="VendorInfoDivDiv" class="feildwrap">
                        <div>
                            <label>Vendor Name</label>
                            <input id="VendorName" type="text" name="VendorName" placeholder="Enter Name"  data-validation = "required" >
                        </div>
                        <div>
                            <label>Tel</label>
                            <input Class="PhoneNo" id="VendorContact" type="text" name="VendorContact" placeholder="Enter Contact Number" data-validation = "required">
                        </div>
                        <div>
                            <label>Mobile</label>
                            <input Class="MobileNo" id="VendorMobile" type="text" name="VendorMobile" placeholder="Enter Mobile Number" data-validation = "required">
                        </div>
                        <div>
                            <label>CNIC</label>
                            <input Class="CNIC" id="VendorNIC" type="text" name="VendorNIC" placeholder="Enter NIC"  data-validation = "">
                        </div>
                        <div>
                            <label>Company Name</label>
                            <input id="CompanyName" type="text" name="CompanyName" placeholder="Enter Company Name"  data-validation = "" >
                        </div>
                        <div>
                            <label>Company Contact</label>
                            <input id="CompanyContact" type="text" name="CompanyContact" placeholder="Enter Company Contact"  data-validation = "" >
                        </div><br>
                        <div>
                            <label>Company Fax</label>
                            <input Class="Fax" id="CompanyFax" type="text" name="CompanyFax" placeholder="Fax Number"  data-validation = "">
                        </div>
                        <div>
                            <label>Company Address</label>
                            <textarea id="CompanyAddress" name="CompanyAddress" placeholder="Enter Address" style="margin: 0px; width: 724px; height: 100px;"></textarea>
                        </div>
                        <div class="btn-block-wrap">
                            <label>&nbsp;</label>
                            <input type="submit" class="btn" value="Add Vendor" style="margin-left: 400px;width: 180px;">
                        </div>
                    </div>
                </fieldset>
            </form>
            <form method="post" class="form animated fadeIn">
                <fieldset>
                    <legend>Vendors List</legend>
                    <div class="feildwrap">
                        <label>Search Vendor</label>
                        <input id="searchVendor" name="searchVendor" type="text" placeholder="Search by Vendor/Company Name">
                    </div><br>
                    <div class="btn-block-wrap datagrid">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead class="vendorlisthf">
                                <tr>
                                    <th width="05%">S No.</th>
                                    <th width="10%">Vendor Name</th>
                                    <th width="10%">Vendor Contact</th>
                                    <th width="15%">Company</th>
                                    <th width="10%">Contact</th>
                                    <th width="40">Company Address</th>
                                    <th width="10%">Details</th>
                                </tr>
                            </thead>
                            <tfoot class="vendorlisthf">
                                <tr>
                                    <td colspan="7">
                                        <div id="paging">
                                        </div>
                                </tr>
                            </tfoot>
                            <tbody id="vendorlistbody">
                                <?php
                                $Counter = 1;
                                foreach ($vendorsList as $key) {
                                    ?>
                                    <tr id="vendorTable">
                                        <td class="tbl-name"><?= $Counter++ ?></td>
                                        <td class="tbl-name"><?= $key['VendorName'] ?></td>
                                        <td class="tbl-name"><?= $key['VendorPhone'] . ' , ' . $key['VendorMobile'] ?></td>
                                        <td class="tbl-name"><?= $key['CompanyName'] ?></td>
                                        <td class="tbl-name"><?= $key['CompanyContact'] ?></td>
                                        <td class="tbl-name"><?= $key['CompanyAddress'] ?></td>
                                        <td><a style="cursor: pointer;" onclick="UpdatePopup('detail', '<?= $key['idVendor'] ?>', '<?= $key['VendorName'] ?>', '<?= $key['VendorPhone'] ?>', '<?= $key['VendorMobile'] ?>', '<?= $key['CompanyName'] ?>', '<?= $key['CompanyContact'] ?>', '<?= $key['CompanyAddress'] ?>')">Edit</a>
                                            <span>|</span>
                                            <a style="cursor: pointer;" href="<?= base_url() ?>index.php/vendor/Delete/<?= $key['idVendor'] ?>">Delete</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
            </form>
            <div style="width: 800px;" class="feildwrap  popup popup-detail">
                <form name="vendorupdateform" onSubmit="return validationform('Add')" method="post"
                      action="<?= base_url() ?>index.php/vendor/Update" class="form validate-form animated fadeIn">
                    <h4><?= $insertMessage ?></h4>
                    <fieldset>
                        <legend onclick="DoToggle('#VendorInfoDivDiv')">Vendor Information</legend>
                        <br><div id="VendorInfoDivDiv" class="feildwrap">
                            <div style="display: none;">
                                <label>Id Vendor </label>
                                <input id="uidVendor" name="uidVendor" type="text" placeholder="Enter Name"  data-validation = "required" >
                            </div><br>
                            <div>
                                <label>Vendor Name</label>
                                <input id="uVendorName" name="uVendorName" type="text" placeholder="Enter Name"  data-validation = "required" >
                            </div><br>
                            <div>
                                <label>Tel</label>
                                <input Class="PhoneNo" id="uVendorContact" name="uVendorContact" type="text"  placeholder="Enter Contact Number" data-validation = "required">
                            </div><br>
                            <div>
                                <label>Mobile</label>
                                <input Class="MobileNo" id="uVendorMobile" name="uVendorMobile" type="text"  placeholder="Enter Mobile Number" data-validation = "required">
                            </div><br>
                            <div>
                                <label>Company Name</label>
                                <input id="uCompanyName" name="uCompanyName" type="text" placeholder="Enter Company Name"  data-validation = "" >
                            </div><br>
                            <div>
                                <label>Company Contact</label>
                                <input id="uCompanyContact" name="uCompanyContact" type="text" placeholder="Enter Company Contact"  data-validation = "" >
                            </div><br>
                            <div>
                                <label>Company Address</label>
                                <textarea id="uCompanyAddress" name="uCompanyAddress" placeholder="Enter Address" style="margin: 0px; width: 430px; height: 100px;"></textarea>
                            </div><br>
                            <div class="btn-block-wrap">
                                <label>&nbsp;</label>
                                <input type="submit" class="btn" value="Update" style="float:right;width: 100px;">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $("#searchVendor").keyup(function() {
        var search = $("#searchVendor").val();
        $.ajax({
            url: "<?= base_url() ?>index.php/vendor/search",
            type: "POST",
            data: {searchVendor: search},
            success: function(data) {
                if (data !== "null")
                {
                    var a = JSON.parse(data);
                    if (a.length > 0) {
                        try {
                            if (!($(".vendorlisthf").is(":visible"))) {
                                $(".vendorlisthf").show();
                            }
                            var items = [];
                            var count = 1;
                            $.each(a, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>" +
                                        "<td class='tbl-name'>" + val.VendorName + "</td>" +
                                        "<td class='tbl-name'>" + val.VendorPhone + "," + val.VendorMobile + "</td>" +
                                        "<td class='tbl-name'>" + val.CompanyName + "</td>" +
                                        "<td class='tbl-name'>" + val.CompanyContact + "</td>" +
                                        "<td class='tbl-name'>" + val.CompanyAddress + "</td>" +
                                        "<td><a style='cursor: pointer;' onClick=UpdatePopup('detail','" + val.idVendor + "','" + val.VendorName + "','" + val.VendorPhone + "','" + val.VendorMobile + "','" + val.CompanyName + "','" + val.CompanyContact + "','" + val.CompanyAddress + "')> Edit </a><span>|</span>" +
                                        "<a style='cursor: pointer'; href='<?= base_url() ?>index.php/vendor/Delete/" + val.idVendor + "' >Delete</a></td></tr>";
                            });
                            $('#vendorlistbody').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $(".vendorlisthf").hide();
                        $("#vendorlistbody").html("No Data Found");
                    }
                }
            }
        });
    });
    function UpdatePopup(div_id, idvendor, vendorname, vendorphpne, vendormobile, companyname, companycontact, companyaddress) {

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            $(this).find("#uidVendor").val(idvendor);
            $(this).find("#uVendorName").val(vendorname);
            $(this).find("#uVendorContact").val(vendorphpne);
            $(this).find("#uVendorMobile").val(vendormobile);
            $(this).find("#uCompanyName").val(companyname);
            $(this).find("#uCompanyContact").val(companycontact);
            $(this).find("#uCompanyAddress").val(companyaddress);
        });
    }

    function validationform(type) {

    }
</script>