<div style="">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-md-12">
                        <!--<label>Scheduled Time</label>-->
                        <!--<span class="scl-time">10:00 - 14:00</span>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Csname" class="col-md-4">Customer Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="CustomerName" value="<?= $Appointment['CustomerName'] ?>">
                                <input type="text" class="form-control" id="idApointment" style="display:none" value="<?= $Appointment['idAppointment'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Csname" class="col-md-4">Reg. Number</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="RegistrationName" value="<?= $Appointment['RegistrationNumber'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4">Select Bay</label>
                            <div class="col-md-8">
                                <select class="form-control" name="idBay" id="idBay">
                                    <option>Select Bay</option>

                                    <?php
                                    foreach ($AllBays as $Bays) {
                                        if ($Appointment['idBay'] == $Bays['idBay']) {
                                            ?>
                                            <option value="<?= $Bays['idBay'] ?>" selected="selected"><?= $Bays['BayName'] ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?= $Bays['idBay'] ?>"><?= $Bays['BayName'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 text-right">Extended Time</label>
                            <div class="col-md-8">
                                <select id="ExtendTime">
                                    <?php
                                    if ($Appointment['ExtendTime'] == "00:00" || NULL) {
                                        ?>
                                        <option value="00:00" selected="selected">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:05") {
                                        ?>

                                        <option value="00:05">00:00</option>
                                        <option value="00:05" selected="selected">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:10") {
                                        ?>

                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10" selected="selected">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:15") {
                                        ?>

                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15" selected="selected">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:20") {
                                        ?>

                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20" selected="selected">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:25") {
                                        ?>

                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25" selected="selected">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:30") {
                                        ?>
                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30" selected="selected">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:35") {
                                        ?>
                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35" selected="selected">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:40") {
                                        ?>
                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40" selected="selected">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:45") {
                                        ?>
                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45" selected="selected">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:50") {
                                        ?>
                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50" selected="selected">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "00:55") {
                                        ?>
                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55" selected="selected">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    } else if ($Appointment['ExtendTime'] == "01:00") {
                                        ?>
                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00" selected="selected">01:00</option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="00:05">00:00</option>
                                        <option value="00:05">00:05</option>
                                        <option value="00:10">00:10</option>
                                        <option value="00:15">00:15</option>
                                        <option value="00:20">00:20</option>
                                        <option value="00:25">00:25</option>
                                        <option value="00:30">00:30</option>
                                        <option value="00:35">00:35</option>
                                        <option value="00:40">00:40</option>
                                        <option value="00:45">00:45</option>
                                        <option value="00:50">00:50</option>
                                        <option value="00:55">00:55</option>
                                        <option value="01:00">01:00</option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 text-right">Status</label>
                            <div class="col-md-8">
                                <input type="checkbox" id="isRoad">Road Test
                                <!--<br>-->
<!--                                <input type="checkbox" value="1" id="RoadTest">Road Test-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-12">Requested Jobs</label>
                            <table class="table table-striped table-condensed">
                                <thead>
                                <th>S No.</th>
                                <th>Jobs</th>
                                <th>Time</th>
                                <!--<th>Actions</th>-->
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($Jobs as $AppointmentJobs) {
                                        ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $AppointmentJobs['JobTask'] ?></td>
                                            <td><?= $AppointmentJobs['TimeTaken'] ?></td>
    <!--                                        <td>
                                                <a href="javascript:void(0)" ><i class='glyphicon glyphicon-edit' style='margin-right:10px;'></i></a>
                                                <a href="javascript:void(0)" value=""><i class='glyphicon glyphicon-trash'></i></a>
                                            </td>-->
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
        window.isRoad = "";
        $("#SaveAppointment").click(function () {
            if ($("#isRoad").prop("checked")) {
                isRoad = "1";
            } else {
                isRoad = "0";
            }
            $.ajax({
                url: "<?= base_url() ?>index.php/jpcb/updateAppointment",
                type: "POST",
                data: {idAppointment: $("#idApointment").val(), ExtendTime: $("#ExtendTime").val(), RoadTest: isRoad, idBay: $("#idBay").val()},
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