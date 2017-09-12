<div id="wrapper">
    <div id="content">  
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == 'Admin' || $data['Role'] == 'Manager' || $data['Role'] == 'Executive Complaint' || $data['Role'] == 'Executive Inquiry') {
            include 'include/cr_reportinpanel.php';
        } else {
            redirect(base_url() . "index.php/crpanel/index");
        }
        ?>
        <div class="right-pnel">
            <form id="addcomplaintmodes" name="addcomplaintmodes" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/Fivesheetanalysis/servicegetfivesheetreport" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Search</legend>
                    <div class="feildwrap">
                        <label>&nbsp;&nbsp;&nbsp;</label>
                        <span id="from">From Date</span>&nbsp;&nbsp;&nbsp;
                        <input class="date" id="filterbydateone"  name="filterbydateone" placeholder="Search by Date" style="margin: 0px; width: 155px; height: 30px;" required>&nbsp;&nbsp;&nbsp;<span id="to">to Date</span>&nbsp;&nbsp;&nbsp;
                        <input class="date"  id="filterbydatetwo" name="filterbydatetwo" placeholder="Search by Date" style="margin: 0px; width: 155px; height: 30px;" required>&nbsp;
                        <input  class="btn" type="button" id="" name="filterbybutton" value="Generate Report" onclick="filterbymonths()" >
                    </div>
                </fieldset>
            </form>
<!--                                <div class="btn-block-wrap dg">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <thead>
                                <tr>
                                    <th width="30%">S No.</th>
                                    <th width="35%">Mode</th>
                                    <th width="35%">Values</th>
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
//                                $complaintrelationlist = json_decode($totallist);
                                foreach ($totallist as $key) {
                                    ?>
                                    <tr id="carUsers">
                                        <td class="resId" name="resId"><?= $count++ ?></td>
                                        <td class="tbl-name"><?= $key['Mode'] ?></td>
                                        <td class="tbl-name"><?= $key['Total']   ?></td>
                                        <td><a href="#updaterelform" onclick="updaterelation(<?php echo $key->idcr_complainrelation ?>)">Edit</a></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>-->
            <form method="post" class="form animated fadeIn" onsubmit="return false">
                <fieldset>
                    <legend>Total VOC Contact Trend</legend>
                    <div id="shwcontacttrend" class="feildwrap">
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Top 3 Inquiries</legend>
                    <div id="shwinquiries" class="feildwrap">
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Top 3 Normal Complaints</legend>
                    <div id="shwnoramalcomplaints" class="feildwrap">
                    </div><br>
                    <div><p>Top 3 Products Complaints</p></div>
                    <div id="normalpvoc" class="feildwrap">

                    </div><br>
                    <div><p>Top 3 Sales Complaints</p></div>
                    <div id="normalsvoc" class="feildwrap">

                    </div><br>
                    <div><p>Top 3 Services Complaints</p></div>
                    <div id="normalservoc" class="feildwrap"> 

                    </div><br>
                    <div><p>Top 3 Body & Parts Complaints</p></div>
                    <div id="normalbvoc" class="feildwrap">

                    </div>
                </fieldset>
                <fieldset>
                    <legend>Top 3 Serious Complaints</legend>
                    <div id="showseriouscomplaints" class="feildwrap">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    function filterbymonths() {

        dateone = $("#filterbydateone").val();
        datetwo = $("#filterbydatetwo").val();

        $.ajax({
            url: "<?= base_url() ?>index.php/Fivesheetanalysis/servicegetfivesheetreport",
            type: "POST",
            data: {dateone: dateone, datetwo: datetwo},
            dataType: "json",
            success: function(value) {
                if (value !== "null")
                {
                    /**
                     *  For Complaints and Inquiries
                     */

                    if (value["inquirycomplaints"].length > 0) {

                        console.log(value["inquirycomplaints"]);
                        try {

                            var totalinqcomp = 0;
                            var changeinqcomp = 0;
                            var inqcomp = [];
                            $.each(value["inquirycomplaints"], function(i, val) {
                                inqcomp += "<p style='font-size: x-large'>" + val.State + ':     ' + val.Value + "</p><br><br>";
                                changeinqcomp = parseInt(val.Value);
                                totalinqcomp += changeinqcomp;

                            });
                            inqcomp += "<p style='font-size: x-large'> Total : " + totalinqcomp + "</p><br><br>";
                            $('#shwcontacttrend').html(inqcomp);
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("#shwcontacttrend").html("<p style='font-size: large'>No Complaints/Inquiries are Found in this dates</p>");
                    }

                    /**
                     *  For Inquiries
                     */

                    if (value["inquires"].length > 0) {

                        try {

                            var changeinq = 0;
                            var totalinquries = 0;
                            var inquires = [];
                            $.each(value["inquires"], function(i, val) {

                                inquires += "<p style='font-size: x-large'>" + val.State + ':     ' + val.Inquiries + "</p><br><br>";
                                changeinq = parseInt(val.Inquiries);
                                totalinquries += changeinq;
                            });
                            inquires += "<p style='font-size: x-large'> Total : " + totalinquries + "</p><br><br>";
                            $('#shwinquiries').html(inquires);
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("#shwinquiries").html("<p style='font-size: large'>No Inquiries are Found in this dates</p>");
                    }

                    /**
                     *  For Normal Complaints
                     */

                    if (value["normal"].length > 0) {

                        try {
                            var changenormalcomp = 0;
                            var totalnormalcomp = 0;
                            var normalcomplaints = [];
                            $.each(value["normal"], function(i, val) {
                                normalcomplaints += "<p style='font-size: x-large'>" + val.State + ':     ' + val.NormalComplaints + "</p><br><br>";
                                changenormalcomp = parseInt(val.NormalComplaints);
                                totalnormalcomp += changenormalcomp;

                            });
                            normalcomplaints += "<p style='font-size: x-large'> Total : " + totalnormalcomp + "</p><br><br>";
                            $('#shwnoramalcomplaints').html(normalcomplaints);
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("#shwnoramalcomplaints").html("<p style='font-size: large'>No Normal Complaints are Found in this dates</p>");
                    }

                    if (value["normalvoc"].length > 0) {
                        console.log(value["normalvoc"]);
                        try {
                            var changenormalvoccomp = 0;
                            var totalnormalvoccomp = 0;
                            var normalvoccomplaints = [];
                            $.each(value["normalvoc"], function(i, val) {
                                normalvoccomplaints += "<p style='font-size: x-large'>" + val.VOC + ':     ' + val.value + "</p><br><br>";
                                changenormalvoccomp = parseInt(val.value);
                                totalnormalvoccomp += changenormalvoccomp;

                            });
                            normalvoccomplaints += "<p style='font-size: x-large'> Total : " + totalnormalvoccomp + "</p><br><br>";
                            $('#normalpvoc').html(normalvoccomplaints);
                            $('#normalsvoc').html(normalvoccomplaints);
                            $('#normalservoc').html(normalvoccomplaints);
                            $('#normalbvoc').html(normalvoccomplaints);
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("#shwnoramalcomplaints").html("<p style='font-size: large'>No Normal Complaints are Found in this dates</p>");
                    }

                    if (value["serious"].length > 0) {
                        try {
                            var changeseriouscomp = 0;
                            var totalseriouscomp = 0;
                            var seriouscomplaints = [];
                            $.each(value["serious"], function(i, val) {

                                seriouscomplaints += "<p style='font-size: x-large'>" + val.State + ':     ' + val.SeriousComplaints + "</p><br><br>";
                                changeseriouscomp = parseInt(val.SeriousComplaints);
                                totalseriouscomp += changeseriouscomp;
                            });
                            seriouscomplaints += "<p style='font-size: x-large'> Total : " + totalseriouscomp + "</p><br><br>";
                            $('#showseriouscomplaints').html(seriouscomplaints);
                        } catch (e) {
                            console.log(e);
                        }
                    } else {
                        $("#showseriouscomplaints").html("<p style='font-size: large'>No Serious Complaints are Found in this dates</p>");
                    }
                }
            }, error: function() {
                console.log('error');
            }
        });
    }

</script>
