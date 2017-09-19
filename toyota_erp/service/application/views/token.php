<?php
$data = unserialize($_COOKIE['logindata']);

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Token Status - Service - Toyota</title>


    <script src='<?= base_url(); ?>assets/js/jquery.min.js'></script>
    <link href="<?= base_url(); ?>assets/scheduler/js/libs/bootstrap3.3.1/css/bootstrap.css" rel="stylesheet"type="text/css"/>
    <script src="<?= base_url(); ?>assets/scheduler/js/libs/bootstrap3.3.1/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/scheduler/js/libs/bootbox/bootbox.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/chosen.css">

    <script src="<?= base_url(); ?>assets/scheduler/js/libs/chosen/chosen.jquery.min.js"  type="text/javascript"></script>


    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
            font-size: 14px;
        }

        .token {
            /*background: green;*/
            border: double;
            margin: 8px;
            /*border-radius: 18%;*/
            padding: 0px;
        }

        .token_id {
            background: #000;

        }

        .token_id h2 {
            line-height: 94px;
            color: #fff;
        }

        .token_left{
            padding: 0px;
        }

        .token_bottom {
            border-top: 2px solid;
            text-align: center;
            height:100%;

        }

        .token_bottom p{
            margin: 6px;
            color: white;
        }
        .PENDING{
            background-color: grey;
        }
        .PROCESSING{
            background-color: green;
        }
        .CANCEL{
            background-color: red ;
        }
        .CLOSED{
            background-color: darkred;
        }


    </style>
</head>
<body>
<div class="container" id="main-container">
    <div class="header" style=" background: #ef0505;">
        <div class="menu">

            <a href="<?= base_url(); ?>index.php/jpcb"><img src="<?= base_url(); ?>assets/images/icons/dashboard.png"
                                                            alt="">Dashboard</a>

            <span style=" margin-left: 35%;font-size: -webkit-xxx-large;">TOKEN STATUS</span>
            <span class="logo" style="float: right"><img src="<?= base_url(); ?>assets/images/logo.png" alt=""></span>

        </div>
    </div>
</div>
<div id="wrapper" style="min-height: 600px">
    <br>

    <div class="container">
        <div class="row">
            <?php foreach ($token as $item) {
                ?>


                <div class="col-sm-2 token" onclick="get_token(<?= $item['idToken']?>)">
                    <div class="col-sm-5 token_id">
                        <h2><?= sprintf('%03d', $item['tokenNumber']); ?></h2>
                    </div>
                    <div class="col-sm-7 token_left">
                        <p><?= $item['CustomerName'] ?></p>
                        <p><?= $item['category'] ?></p>
                        <p><?= $item['Model'] ?></p>
                        <div class="token_bottom <?= $item['status'] ?>">
                            <p><?= 'T-'.date('dmy-').sprintf('%03d', $item['tokenNumber']) ?></p>
                        </div>
                    </div>
                </div>


            <?php } ?>
        </div>


    </div>




</div>

<script>

    function get_token(idToken)
    {
        var dialog =  bootbox.dialog({
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
            size: 'small',
            backdrop: true
        });

        dialog.init(function() {

            $.get('<?=base_url()?>/index.php/token/token_modal/' + idToken, function (res) {
                dialog.find('.bootbox-body').html(res);
                $(".chosen-select").chosen({width: "50%"})
            })
        })


    }
</script>


