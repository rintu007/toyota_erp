<div style="">
    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4">Status</label>
                            <div class="col-md-8">
                                <input type="text" id="idAppointment" style="display: none;" value="<?= $Appointment ?>">
                                <input type="checkbox" id="isWash">Wash
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="button" class="btn btn-success" id="SaveAppointment" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    (function () {
        $("#AddtionalJobs").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "95%"
        });
        window.isWash = "";
        $("#SaveAppointment").click(function () {
            if ($("#isWash").prop("checked")) {
                isWash = "1";
            } else {
                isWash = "0";
            }
            $.ajax({
                url: "<?= base_url() ?>index.php/jpcb/updatewash",
                type: "POST",
                data: {idAppointment: $("#idAppointment").val(), Wash: isWash},
                success: function (data) {
                    if (data == "Updated") {
                        window.location = "<?= base_url() ?>index.php/jpcb/plan";
                    } else {
                        alert("Fail To Update");
                    }
                }
            });
        });
    })();
</script>