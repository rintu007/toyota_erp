<!--<div id="myModal" class="">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!-- dialog body -->
<!--            <div class="modal-body">-->
<div class="modal-header">
    <h4 class="modal-title">Token Information  <strong><?= 'T-'.date('dmy-').sprintf('%03d', $token->tokenNumber) ?></strong> </h4>

</div>
<br>
<div class="row">

    <div class="col-md-8">
        <div class="form-group">
            <label for="Csname" class="col-md-4">Customer Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="CustomerName" readonly value="<?= $token->CustomerName ?>">
                <input type="text" class="form-control" name="idToken" id="idToken" style="display:none"
                       value="<?= $token->idToken ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="Csname" class="col-md-4">Reg. Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" readonly id="" value="<?= $token->regNo ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="Csname" class="col-md-4">Chasis Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control"  readonly id="" value="<?= $token->chasis ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="Csname" class="col-md-4">Variant</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" readonly id="" value="<?= $token->Variants ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="Csname" class="col-md-4">Category</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" readonly id="" value="<?= $token->category ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="Csname" class="col-md-4">Status</label>
            <div class="col-sm-6">
                <select name="status" class="chosen-select" style="width: 150px"  id="status">
                    <option <?= ($token->status) == 'PENDING' ? 'selected' : '' ?> value="PENDING">PENDING</option>
                    <option <?= ($token->status) == 'PROCESSING' ? 'selected' : '' ?> value="PROCESSING">PROCESSING
                    </option>
                    <option <?= ($token->status) == 'CLOSED' ? 'selected' : '' ?> value="CLOSED">CLOSED</option>
                    <option <?= ($token->status) == 'CANCEL' ? 'selected' : '' ?> value="CANCEL">CANCEL</option>
                </select>
            </div>

        </div>
        <!--                        <button type="button" id="update" class="btn btn-success">Update</button>-->

    </div>

</div>
<!--            </div>-->
<!-- dialog buttons -->
<div class="modal-footer">
    <button type="button" id="update" class="btn btn-success">Update</button>
</div>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<script>
    (function () {
        $("#AddtionalJobs").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "95%"
        });
        window.isRoad = "";


        $("#update").click(function () {

            $.ajax({
                url: "<?= base_url() ?>index.php/token/updateTokenStatus",
                type: "POST",
                data: {idToken: $("#idToken").val(), status: $("#status").val()},
                success: function (data) {
                    if (data == "Updated") {
                        window.location = "<?= base_url() ?>index.php/token/";
                    } else {
                        alert("Fail To Update");
                    }
                }
            });
        });
    })();
</script>