<?php
$data = unserialize($_COOKIE['logindata']);
if ($data['userid'] != "") {
    ?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Service Toyota - Dealer Management System</title>
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/animate.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datepikker.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/chosen.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/dhtmlxscheduler.css">
            <!--<script src="<?= base_url(); ?>assets/js/jquery-1.9.0.min.js"></script>-->
            <script src="<?= base_url(); ?>assets/scheduler/js/libs/jquery/jquery-2.1.1.js" type="text/javascript"></script>
            <script src="<?= base_url(); ?>assets/js/jquery-ui.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.ui.core.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.ui.datepicker.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.bpopup.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.maskedinput.js"></script>
            <script src="<?= base_url(); ?>assets/js/ens	roll-0.4.0.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/validation.js"></script>
            <script src="<?= base_url(); ?>assets/js/chosen.jquery.js"></script>
            <!-- Scheduler Assets -->
            <link href="<?= base_url(); ?>assets/scheduler/js/libs/bootstrap3.3.1/css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <link href="<?= base_url(); ?>assets/scheduler/js/libs/chosen/chosen.min.css" rel="stylesheet" type="text/css"/>
            <link href="<?= base_url(); ?>assets/scheduler/js/scheduler/scheduler.css" rel="stylesheet" type="text/css"/>
            <script src="<?= base_url(); ?>assets/scheduler/js/libs/bootstrap3.3.1/js/bootstrap.js" type="text/javascript"></script>
            <script src="<?= base_url(); ?>assets/scheduler/js/libs/bootbox/bootbox.js" type="text/javascript"></script>
            <script src="<?= base_url(); ?>assets/scheduler/js/libs/chosen/chosen.jquery.min.js" type="text/javascript"></script>
            <script src="<?= base_url(); ?>assets/scheduler/js/scheduler/scheduler.js" type="text/javascript"></script>

            <script>
                $(document).ready(function () {
                    console.log("before initialization ", $("#waiting"));
                    var config = {
                        fields: <?= $Bays; ?>,
//                        fields: ["BAY 1", "BAY 2", "BAY 3", "BAY 4", "BAY 5", "BAY 6", "BAY 7", "BAY 8", "BAY 9"],
                        beforeFields: [],
                        afterFields: [],
                        timeSpan: 1,
                        headerSpan: 30,
                        headSpan: 30,
                        totalTime: 8,
                        timeUnit: 60,
                        startTime: "08:00",
                        table: "#table",

                        dataURL: "http://localhost/toyota_git/toyota_erp/service/index.php/jpcb/AllAsb/<?= $date ?>",
                        formURL: "http://localhost/toyota_git/toyota_erp/service/index.php/jpcb/form",
                        RoadWashURL: "http://localhost/toyota_git/toyota_erp/service/index.php/jpcb/roadwash"
                    }
                    window.obj = new Scheduler(config);
                    $(".form-error").hide();
                    $(".cb-error").hide();
                });
            </script>

            <style>
                ::selection {color:black;background:#9a0a06;}
                ::-moz-selection {color:black;background:#9a0a06;}
            </style>

        </head>
        <body>
            <div class="container" id="main-container">
                <div class="header">
                    <div class="logo-nav"><span>Dealer Management System</span><span class="logo"><img
                                src="<?= base_url(); ?>assets/images/logo.png" alt=""></span></div>
                    <div class="btns-nav"><span class="tital">Service Division</span>
                        <div class="menu">
                            <a href="<?= base_url(); ?>index.php/jpcb"><img src="<?= base_url(); ?>assets/images/icons/dashboard.png" alt="">Dashboard</a>
                        </div>
                    </div>
                </div>
                <div id="wrapper">
                    <div id="content">


                        <div class="full-panel">
                            <span style="float: left;"><h4><?= $date ?></h4></span>
                            <a href="<?= base_url() ?>index.php/jpcb/asb/<?= date('Y-m-d', strtotime('+1 day', strtotime($date))) ?>" class="btn btn-danger btnNext" style="float: right;" >&raquo;</a>
                            <!--<a href="<?= base_url() ?>index.php/jpcb/plan/<?= strtotime('+1 day', strtotime($date)) ?>" class="btn btn-danger btnNext" style="float: right;" >&raquo;</a>-->
                            <a href="<?= base_url() ?>index.php/jpcb/asb/<?= date('Y-m-d', strtotime('-1 day', strtotime($date))) ?>" class="btn btn-danger btnPrevious" style="float: right;">&laquo;</a>
                            <table id="table" class="col-lg-12 col-md-12 table  table-condensed"  border="1">
                                <thead>
                                </thead>
                                <tbody>
                                  <!--<tr><td>asdf</td><td>asdf</td><td>asdf</td><td>asdf</td></tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="push"></div>
            </div>
            <div id="footer">
                <div id="footer-content">Powered by: <a href="#">SYANGE GLOBAL</a></div>
            </div>

            <script>
                $(document).ready(function () {
                    customscroll();
                });
            </script>
            <script>
                ///************************/
                function customscroll() {
                    $('.scrollbox').enscroll({
                        // a configuration property
                        showOnHover: false,
                        // another configuration property
                        verticalScrolling: true,
                        pollChanges: true
                                // ... more configuration properties ...
                    });
                }
            </script>

                            <!--            <script>
                                            $.validate({
                                                modules: 'location, date, security, file',
                                                onModulesLoaded: function () {
                                                    $('#country').suggestCountry();
                                                }
                                            });
                                        </script>-->
        </body>
    </html>
    <?php
}?>