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
            <script src="<?= base_url(); ?>assets/js/jquery-1.9.0.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery-ui.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.ui.core.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.ui.datepicker.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.bpopup.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.maskedinput.js"></script>
            <script src="<?= base_url(); ?>assets/js/enscroll-0.4.0.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/validation.js"></script>
            <script src="<?= base_url(); ?>assets/js/chosen.jquery.js"></script>
            <script src='<?= base_url(); ?>assets/js/dhtmlxscheduler.js' type="text/javascript" charset="utf-8"></script>
            <script src='<?= base_url(); ?>assets/js/dhtmlxscheduler_timeline.js' type="text/javascript" charset="utf-8"></script>

            <script>
                $(document).ready(function() {
                    $(".form-error").hide();
                    $(".cb-error").hide();
                });
            </script>

            <style>
                ::selection {color:black;background:#9a0a06;}
                ::-moz-selection {color:black;background:#9a0a06;}
            </style>
            <script type="text/javascript" charset="utf-8">
                function init() {
                    scheduler.locale.labels.timeline_tab = "Timeline";
                    scheduler.locale.labels.section_custom = "Section";
                    scheduler.config.details_on_create = true;
                    scheduler.config.details_on_dblclick = true;
                    scheduler.config.xml_date = "%Y-%m-%d %H:%i";
                    //===============
                    //Configuration
                    //===============
    //                var sections = [
    //                    {key: 1, label: "Bay 1"},
    //                    {key: 2, label: "Bay 2"},
    //                    {key: 3, label: "Bay 3"},
    //                    {key: 4, label: "Bay 4"}
    //                ];

                    var sections = <?= $Bays ?>;
                    var jobref = <?= $JobRef; ?>;
                    scheduler.createTimelineView({
                        name: "timeline",
                        x_unit: "minute",
                        x_date: "%H:%i",
                        x_step: 30,
                        x_size: 19,
                        x_start: 18,
                        x_length: 24,
                        y_unit: sections,
                        y_property: "section_id",
                        render: "bar",
                        first_hour: 9,
                        last_hour: 5
                    });
                    //===============
                    //Data loading
                    //===============
                    scheduler.config.lightbox.sections = [
                        {name: "description", height: 130, map_to: "text", type: "textarea", focus: true},
                        {name: "Bay", height: 23, type: "select", options: sections, map_to: "section_id"},
                        {name: "Job Ref Manual", value: "Ahmer Dhakkan", height: 23, type: "job", options: jobref, map_to: "jobref_id"},
                        {name: "time", height: 72, type: "time", map_to: "auto"}
                    ];
    //                scheduler.init('jpcb', new Date('2014', '6', '8'), "timeline");
                    scheduler.init('jpcb', new Date('<?= date('Y m d') ?>'), "timeline");
    //                scheduler.parse([
    //                    {start_date: "2014-07-08 09:00", end_date: "2014-07-08 12:00", text: "Task A-12458", section_id: 15, jobref_id: 1},
    //                    {start_date: "2014-07-08 09:05", end_date: "2014-07-08 12:05", text: "Task A-12458", section_id: 15, jobref_id: 1},
    //                    {start_date: "2014-07-08 10:00", end_date: "2014-07-08 16:00", text: "Task A-89411", section_id: 15, jobref_id: 1},
    //                    {start_date: "2014-07-08 10:00", end_date: "2014-07-08 14:00", text: "Task A-64168", section_id: 15, jobref_id: 1},
    //                    {start_date: "2014-07-08 16:00", end_date: "2014-07-08 17:00", text: "Task A-46598", section_id: 15, jobref_id: 2},
    //                    {start_date: "2014-07-08 12:00", end_date: "2014-07-08 20:00", text: "Task B-48865", section_id: 2, jobref_id: 2},
    //                    {start_date: "2014-07-08 14:00", end_date: "2014-07-08 16:00", text: "Task B-44864", section_id: 2, jobref_id: 1},
    //                    {start_date: "2014-07-08 16:30", end_date: "2014-07-08 18:00", text: "Task B-46558", section_id: 2, jobref_id: 1},
    //                    {start_date: "2014-07-08 18:30", end_date: "2014-07-08 20:00", text: "Task B-45564", section_id: 2, jobref_id: 1},
    //                    {start_date: "2014-07-08 08:00", end_date: "2014-07-08 12:00", text: "Task C-32421", section_id: 16, jobref_id: 1},
    //                    {start_date: "2014-07-08 14:30", end_date: "2014-07-08 16:45", text: "Task C-14244", section_id: 16, jobref_id: 1},
    //                    {start_date: "2014-07-08 09:20", end_date: "2014-07-08 12:20", text: "Task D-52688", section_id: 16, jobref_id: 1},
    //                    {start_date: "2014-07-08 11:40", end_date: "2014-07-08 16:30", text: "Task D-46588", section_id: 16, jobref_id: 1},
    //                    {start_date: "2014-07-08 12:00", end_date: "2014-07-08 18:00", text: "Task D-12458", section_id: 16, jobref_id: 1}
    //                ], "json");

                    scheduler.parse(<?= $AllJpcb ?>, "json");
                }
            </script>
        </head>
        <body onload="init();">
            <div class="container" id="main-container">
                <div class="header">
                    <div class="logo-nav"><span>Dealer Management System</span><span class="logo"><img
                                src="<?= base_url(); ?>assets/images/logo.png" alt=""></span></div>
                    <div class="btns-nav"><span class="tital">Service Division</span>
                        <div class="menu">
                            <a href="<?= base_url() ?>index.php/pbo/index"><img
                                    src="<?= base_url(); ?>assets/images/icons/search_icon.png" alt="">Search</a>
                            <a href=""><img src="<?= base_url(); ?>assets/images/icons/print.png" alt="">Print</a>
                            <a href=""><img src="<?= base_url(); ?>assets/images/icons/add.png" alt="">Add</a>
                            <a href=""><img src="<?= base_url(); ?>assets/images/icons/edit.png" alt="">Edit</a>
                            <a href=""><img src="<?= base_url(); ?>assets/images/icons/delete.png" alt="">Delete</a>
                            <a href=""><img src="<?= base_url(); ?>assets/images/icons/save.png" alt="">Save</a>
                            <a href=""><img src="<?= base_url(); ?>assets/images/icons/undo.png" height="35" width="35" alt="">Undo</a>
                        </div>
                    </div>
                </div>
                <div id="wrapper">
                    <div id="content">
                        <?php
                        if ($data['username'] == "admin") {
                            include 'include/admin_leftmenu.php';
                        } else {
                            
                        }
                        ?>

                        <div class="right-pnel">
                            <!--<form action="#" method="post" class="form animated fadeIn">-->
                            <!--<fieldset>-->
                            <!--<legend>Job Progress Control Board</legend>-->
                            <div  id="jpcb" class="dhx_cal_container" style='width:100%; height:100%;'>
                                <div class="dhx_cal_navline">
                                    <div class="dhx_cal_prev_button">&nbsp;</div>
                                    <div class="dhx_cal_next_button">&nbsp;</div>
                                    <!--<div class="dhx_cal_today_button"></div>-->
                                    <div class="dhx_cal_date"></div>
                                    <!--<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>-->
                                    <!--<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>-->
                                    <!--<div class="dhx_cal_tab" name="timeline_tab" style="right:280px;"></div>-->
                                    <!--<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>-->
                                </div>
                                <div class="dhx_cal_header"></div>
                                <div class="dhx_cal_data" style="width: 1094px; /* left: 0px; */ top: 81px; height: auto !important"></div>		
                            </div>
                            <!--</fieldset>-->
                            <!--</form>-->
                        </div>
                    </div>
                </div>
                <div class="push"></div>
            </div>
            <div id="footer">
                <div id="footer-content">Powered by: <a href="#">Interactivecells.com</a></div>
            </div>

            <script>
                $(document).ready(function(e) {
                    customscroll();
                    //        $(".datagrid td[name=resId]").click(function(e) {
                    //            $(".pbo-form").fadeIn(1000);
                    //            $("#idRb").val(e.target.innerHTML);
                    //        });
                    $("#btn-pbo").click(function() {
                        $(".pbo-form").fadeIn(1000);
                    });
                    $(document.body).on('click', ".form-error", function() {
                        $(this).hide();
                    });
                });
                $(function() {
                    $(".date").datepicker({
                        showOn: "button",
                        buttonImage: '<?= base_url(); ?>assets/images/date.png',
                        buttonImageOnly: true,
                        showButtonPanel: true,
                        dateFormat: "yy-mm-dd"
                    });
                });</script>
            <script>
                function formhide() {
                    $(".close-pop").trigger('click');
                }
                function popupbox(div_id, elem) {
                    $('.popup-' + div_id).bPopup({
                        fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
                        followSpeed: 1500, //can be a string ('slow'/'fast') or int
                        modalColor: '#333',
                        closeClass: 'close-pop'
                    }, function() {
                        var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
                        $(this).find("#idResourceBook").val(value);
                    });
                }
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
            <script>
                //    (function() {
                //        var elem = document.getElementById('custom-file-input'),
                //                input = elem.getElementsByTagName('input')[0],
                //                showPath = elem.getElementsByTagName('span')[0];
                //        input.onchange = function() {
                //            showPath.textContent = this.value;
                //            this.title = this.value;
                //        };
                //    })();
            </script>

            <script>
                $.validate({
                    modules: 'location, date, security, file',
                    onModulesLoaded: function() {
                        $('#country').suggestCountry();
                    }
                });
            </script>
        </body>
    </html>
    <?php
}?>