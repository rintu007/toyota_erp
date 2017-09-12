<div id="wrapper">
    <div id="content">  
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ( $data['Role'] == 'Admin' ||  $data['Role'] == 'Manager' ||  $data['Role'] == 'Executive Complaint' ||  $data['Role'] == 'Executive Inquiry') {
            include 'include/cr_reportinpanel.php';
        } else {
            redirect(base_url() . "index.php/crpanel/index");
        }
        ?>
        <div class="right-pnel">
            <form id="addcomplaintmodes" name="addcomplaintmodes" onSubmit="" method="post"
                  action="<?= base_url() ?>index.php/Allreports/fivesheetreport" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Search</legend>
                    <div class="feildwrap">
                        <label>&nbsp;&nbsp;&nbsp;</label>
                        <span id="from">From Date</span>&nbsp;&nbsp;&nbsp;
                        <input class="date" id="filterbydateone"  name="filterbydateone" placeholder="Search by Date" style="margin: 0px; width: 155px; height: 30px;" data-validation="required">&nbsp;&nbsp;&nbsp;<span id="to">to Date</span>&nbsp;&nbsp;&nbsp;
                        <input class="date"  id="filterbydatetwo" name="filterbydatetwo" placeholder="Search by Date" style="margin: 0px; width: 155px; height: 30px;" data-validation="required">&nbsp;
                        <input  class="btn" type="submit" id="" name="filterbybutton" value="Generate Report" onclick="shwLoader()" >
                    </div>
                    <div id="divloader" style="margin-left: 370px;margin-top: 50px;opacity:0.5">
                        <img src="<?= base_url(); ?>assets/images/loaderone.gif" alt="">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(e) {
        $('#divloader').hide();
    });
    function shwLoader() {
        var dateOne = $('#filterbydateone').val();
        var dateTwo = $('#filterbydatetwo').val();
        if (dateOne !== "" && dateTwo !== "") {
            $('#divloader').show();
        }
    }
</script>
