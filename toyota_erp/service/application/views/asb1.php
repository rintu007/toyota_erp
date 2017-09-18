<?php
$data = unserialize($_COOKIE['logindata']);
//if ($data['userid'] != "") {
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>ASB - Service - Toyota</title>

    <!--            <link rel="stylesheet" type="text/css" href="--><? //= base_url(); ?><!--assets/css/style.css">-->



    <link href='<?= base_url(); ?>assets/scheduler-1.7.1/fullcalendar.min.css' rel='stylesheet'/>
    <link href='<?= base_url(); ?>assets/scheduler-1.7.1/fullcalendar.print.min.css' rel='stylesheet' media='print'/>
    <link href='<?= base_url(); ?>assets/scheduler-1.7.1/scheduler.css' rel='stylesheet'/>
    <script src='<?= base_url(); ?>assets/scheduler-1.7.1/moment.min.js'></script>
    <script src='<?= base_url(); ?>assets/js/jquery.min.js'></script>
    <script src='<?= base_url(); ?>assets/scheduler-1.7.1/fullcalendar.min.js'></script>
    <script src='<?= base_url(); ?>assets/scheduler-1.7.1/scheduler.js'></script>


    <link href="<?= base_url(); ?>assets/scheduler/js/libs/bootstrap3.3.1/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="<?= base_url(); ?>assets/scheduler/js/libs/bootstrap3.3.1/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/scheduler/js/libs/bootbox/bootbox.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/scheduler/js/libs/chosen/chosen.jquery.min.js" type="text/javascript"></script>


    <script>

        $(function () { // document ready

            $('#calendar').fullCalendar({
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',

                now: '<?=$date?>',
                minTime: "09:00:00",
                maxTime: "21:00:00",
                editable: false, // enable draggable events
                aspectRatio: 1.8,
                scrollTime: '00:00', // undo default 6am scrollTime
                header: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'timelineDay,timelineThreeDays,agendaWeek,month,listWeek'
                },
                defaultView: 'timelineDay',
                views: {
                    timelineThreeDays: {
                        type: 'timeline',
                        duration: {days: 3}
                    }
                },
                resourceLabelText: 'INFO',
                resourceColumns: [
                    {
                        labelText: 'Bay',
                        field: 'BayName'
                    },
                    {
                        labelText: 'Technician',
                        field: 'Techinician'
                    }
                ],
                resources: <?=$resource?>,
                events: {
                    url: "<?=base_url()?>/index.php/jpcb/AllAsb",
                    error: function () {
                        $('#script-warning').show();
                    }
                },
                eventClick: function(calEvent, jsEvent, view) {
//                    alert('Event: ' + calEvent.title);
//                    alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//                    alert('View: ' + view.name);
                    $.get('<?=base_url()?>/index.php/jpcb/form/'+calEvent.idAppointment, function (res) {
                        bootbox.dialog({
                            message: res,
                            title: calEvent.BayName+' Reg# '+calEvent.RegistrationNumber
                        });
                    });
//                    $(this).css('border-color', 'red');
                }

            });

        });

    </script>
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 73%;
            /*width: auto;*/
            /*height: auto;*/
            margin: 50px auto;
        }

    </style>
</head>
<body>
<div class="container" id="main-container">
    <div class="header" style=" background: #ef0505;">
        <!--                <div class="logo-nav">-->
        <!--                </div>-->
        <!--                <div class="btns-nav"><span class="tital">Service Division</span>-->
        <div class="menu">

            <a href="<?= base_url(); ?>index.php/jpcb"><img
                        src="<?= base_url(); ?>assets/images/icons/dashboard.png" alt="">Dashboard</a>

            <span style=" margin-left: 35%;font-size: -webkit-xxx-large;">ASB</span>
            <span class="logo" style="float: right"><img src="<?= base_url(); ?>assets/images/logo.png" alt=""></span>

        </div>
    </div>
</div>
<div id="wrapper">
    <div id="content">

        <div id='calendar'></div>


    </div>
</div>


<div id="footer">
    <div id="footer-content">Powered by: <a href="#">SYANGE GLOBAL</a></div>
</div>

</body>
</html>
