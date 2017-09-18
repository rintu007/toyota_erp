<?php
$data = unserialize($_COOKIE['logindata']);
if ($data['userid'] == NULL) {
    redirect(base_url());
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Service Toyota - Dealer Faislabad System</title>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datepikker.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/chosen.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/jquery.timepicker.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/rating.css">
        <script src="<?= base_url(); ?>assets/js/jquery-1.9.0.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery-ui.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.ui.core.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.ui.datepicker.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.bpopup.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.maskedinput.js"></script>
        <script src="<?= base_url(); ?>assets/js/enscroll-0.4.0.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/validation.js"></script>
        <script src="<?= base_url(); ?>assets/js/chosen.jquery.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.timepicker.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/rating.js"></script>

        <script src="<?= base_url(); ?>assets/js/datatables.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/jquery.dataTables.css">
        <!--<script src="<?= base_url(); ?>assets/js/updaterate.js"></script>-->

        <script>
            $(document).ready(function() {
                $(".form-error").hide();
                $(".cb-error").hide();
                $("#companyName").hide();
                $("#designation").hide();
                $("#dealerName").hide();
                $("#subdealerName").hide();
                $('.Timepicker').timepicker();

                //Format
                $(".iFormat").hide();

                //Masking
                $(".MobileNo").mask('9999-9999999', {placeholder: '#'});//03121234567 (Mobile)
                $(".NTN").mask('9999999-9', {placeholder: '#'});//9999999-9 (NTN)
                $(".CNIC").mask('99999-9999999-9', {placeholder: '#'});//99999-9999999-9 (CNIC)
                $(".FaxNo").mask('999-999-9999999', {placeholder: '#'});//+1-212-9876543 (Fax Number)
                $(".Timepicker").mask('99:99:99', {placeholder: '0'});//12:12:30 (Fax Number)
//                $(".MobileNo").mask('999-99999999', {placeholder: '#'});//02131234567 (Residential)
            });
        </script>

        <style>
            ::selection {color:black;background:#9a0a06;}
            ::-moz-selection {color:black;background:#9a0a06;}

            .datefield { 
                display: inline; 
                padding: 0.3em; 
                border: inset 1px #CCC; 
                background: #FFF; 
                border-radius: 4px;
                color: #666;
                padding: 0px 5px;
                width: 260px;
            }

            .datefield * { 
                display: inline-block;
            }

            .datefield input { 
                width: 1.7em; 
                /*padding: 0 0.4em;*/ 
                padding: 7px 10px;
                border: none; 
                font-size: 100%; 
                background: none;
                color: #000;            
            }

            .datefield input#year { width:2.5em; }
            .datefield input:focus { outline:none; }
        </style>
    </head>

    <body>
        <div class="container" id="main-container" style="border:none;">
            <div class="header">
                    
                    <span class="logo"><img
                                src="<?= base_url(); ?>assets/images/logof.png" alt=""></span>
                                

                    <div class="logo-nav"><span>Dealer Management System</span>
                    </div>
                    

                    
                </div>