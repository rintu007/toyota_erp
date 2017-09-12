<div id="wrapper">
    <div id="content">  
        <?php
        $data = unserialize($_COOKIE['logindata']);
        if ($data['Role'] == "Admin") {
            include 'include/reports_leftmenu.php';
        } else {
            
        }
        ?>
        <div class="right-pnel">
            <form id="addcomplaintmodes" name="addcomplaintmodes" onSubmit="" method="post"
                  action="<?= base_url() ?>index.php/reportservices/reportAllServices" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Services</legend>
                    <div class="feildwrap" style="margin-left: 180px;">
                        <span id="from">From Date</span>
                        <input class="date" id="filterbydateone"  name="filterbydateone" placeholder="From Date" style="" data-validation="required"><span id="to" style="margin-left: 25px;">to Date</span>
                        <input style="margin-left:15px;" class="date"  id="filterbydatetwo" name="filterbydatetwo" placeholder="To Date" style="" data-validation="required">
                        <input class="btn" type="submit" id="" name="filterbybutton" value="Generate Report" onclick="shwLoader()" style="margin-left: 25px;">
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
