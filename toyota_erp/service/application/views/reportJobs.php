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
            <form id="addcomplaintmodes" name="addcomplaintmodes" onSubmit="return validationform()" method="post"
                  action="<?= base_url() ?>index.php/reportjobs/reportAllJobs" class="form validate-form animated fadeIn">
                <fieldset>
                    <legend>Services of Different Jobs</legend>
                    <div class="feildwrap" style="margin-left: 150px;"><br><br>
                        <div id="AllJobsDiv">
                            <label>All Jobs</label>
                            <select id="SelectJob" name="SelectJob">
                                <option>Select Job</option>
                                <?php
                                foreach ($allJobs as $key) {
                                    $idJobRefTask = $allJobs['idJobRef'];
                                    ?>
                                    <option value="<?= $key['idJobRef'] ?>" ><?= $key['JobTask'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="error-reportJob cb-error help-block" style="margin-left: 250px;margin-top: -65px">Option must be selected!</span>
                            <input class="btn" type="submit" id="" name="" value="Generate Report" onclick="shwLoader()" style="margin-left: 25px;">
                        </div>
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
        $('#SelectJob').chosen();
    });
    function shwLoader() {
        var idJob = $('#SelectJob').val();
        if (idJob !== "Select Job") {
            $('#divloader').show();
        }
    }

    function validationform() {
        var typeName = $('#SelectJob').val();
        if (typeName === "Select Job") {
            $(".error-reportJob").show();
            return false;
        } else {
            $(".error-reportJob").hide();
            return true;
        }
    }
</script>
