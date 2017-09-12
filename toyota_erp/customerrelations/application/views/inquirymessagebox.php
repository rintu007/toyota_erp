<div id="wrapper">
    <div id="content">
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin') {
            include 'include/cr_leftmenu.php';
        } else {
            if ($data['Role'] == 'Manager') {
                include 'include/cr_leftsubmenu.php';
            }
            if ($data['Role'] == 'Executive Complaint') {
                include 'include/cr_leftcomplaintsubmenu.php';
            }
            if ($data['Role'] == 'Executive Inquiry') {
                include 'include/cr_leftinquirysubmenu.php';
            }
        }
        ?>
        <div class="right-pnel">
            <form method="post" class="form animated fadeIn" onsubmit="return false">                
                <div class="feildwrap" id="divtblallcomplaints">
                    <h4><?= $updateMessage ?></h4>                    
                    <fieldset>
                        <legend>Search Inquiries</legend>
                        <?php
                        $allinquiries = json_decode($allinquiries);
                        if ($allinquiries == null) {
                            ?>
                            <div><label><b>No Inquiries to Give FeedBack</b></label></div>

                        <?php } else { ?>    
                            <div id="searchform" class="feildwrap">
                                <div>
                                    <label>Search</label>
                                    <input type="text" name="padnumber" id="searchnow"
                                           placeholder="By Inquiry Number">    
                                </div>
                            </div>
                        </fieldset>
                    </div><br>
                    <fieldset>
                        <legend>Inquiries</legend>
                        <br><div class="btn-block-wrap dg" id="shwmessage">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="2%">S#</th>
                                        <th width="3%">Inq#</th>
                                        <th width="7%">Reg.Date</th>
                                        <th width="8%">Customer</th>
                                        <th width="10%">Variant</th>
                                        <th width="30%">VOC</th>
                                        <th width="30%">Customer Request</th>
                                        <th width="5%">RelatedTo</th>
                                        <th width="5%">Detail</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">
                                            <div id="paging">

                                            </div>
                                    </tr>
                                </tfoot>   
                                <tbody id="shwallcomplaints">
                                    <?php
                                    $count = 1;
                                    if ($allinquiries) {

                                        foreach ($allinquiries as $key) {
                                            ?>
                                            <tr id="allcomplaints">
                                                <td name="complaintsno"><?= $count++ ?></td>
                                                <td name="complaints" class="tbl-name"><?= $key->ComplaintPadNumber ?></td>
                                                <td name="complaints" class="tbl-name"><?= $key->ComplaintRegDate ?></td>
                                                <td name="complaints" class="tbl-name"><?= $key->CustomerName ?></td>
                                                <td name="complaints" class="tbl-name"><?= $key->VehicleName ?></td>
                                                <td name="complaints" class="tbl-name"><?= $key->VoiceOfCustomer ?></td>
                                                <td name="complaints" class="tbl-name"><?= $key->CustomerRequest ?></td>
                                                <td name="complaints" class="tbl-name"><?= $key->ComplaintRelatedTo ?></td>
                                                <td><a style="cursor: pointer;" onClick="rolePopup('detail', '<?= $key->ComplaintID ?>')">FeedBack</a></td>                                          
                                                <?php ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?> 

                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </fieldset>
        </div>
        </form>
        <!-- Edit Role Pop UP -->
        <div style="width: 800px;height: 400px" class="feildwrap  popup popup-detail">
            <form action="<?= base_url() ?>index.php/Inquirymessagebox/updatecomplaintfeedback" method="POST" class="form animated fadeIn">
                <img src="<?= base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                <div style="display: none">
                    <label>Id</label>
                    <input  readonly type="text" id="idcomplaint" name="compid">
                </div><br>
                <div class="feildwrap" style="margin-left: 40px;margin-top: 20px">
                    <textarea id="fbcomplaint" name="compfeedback" style="margin: 0px; width: 724px; height: 300px;" placeholder="Write FeedBack to this Inqiry" data-validation="required"></textarea>
                </div><br><br>
                <div class="feildwrap" style="margin-left: 720px;">
                    <input type="submit" class="btn" value="OK">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>

    function rolePopup(div_id, idcomplaint) {

        console.log('idcomplaint');
        console.log(idcomplaint);

        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
//            var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $('#idcomplaint').val(idcomplaint);

        });
    }

    $('#searchnow').keyup(function() {
        var searchnow = $('#searchnow').val();
        $.ajax({
            url: "<?= base_url() ?>index.php/Inquirymessagebox/servicefilteredinquirymessage",
            type: "POST",
            data: {padnumber: searchnow},
            success: function(data) {
                if (data !== "null")
                {
                    var parseddata = JSON.parse(data);
                    if (parseddata.length > 0) {
                        try {
                            var count = 1;
                            var items = [];
                            $.each(parseddata, function(i, val) {
                                items += "<tr><td class='resId' name='resId'>" + count++ + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ComplaintPadNumber + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ComplaintRegDate + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.CustomerName + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.VehicleName + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.VoiceOfCustomer + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.CustomerRequest + "</td>\n\
                                                            <td class='resId' name='resId'>" + val.ComplaintRelatedTo + "</td>\n\
                                                            <td><a style='cursor: pointer;' onClick=rolePopup('detail'," + val.ComplaintID + ")>FeedBack</a></td></tr>";
                            });
                            $('#shwallcomplaints').html(items);
                        } catch (e) {
                            console.log(e);
                        }
                    }
                    else {
                        $("#shwallcomplaints").html("<td></td><td></td><td></td><td></td><td><label style='border: 0px;margin-left:100px'><b>No Data Found</b<</label></td><td></td><td></td><td></td>v");
                    }
                }
            }, error: function() {
                console.log('error');
            }
        });
    });

</script>