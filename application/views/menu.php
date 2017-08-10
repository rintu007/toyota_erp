<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Toyota Western Motors</title>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datepikker.css">
        <script src="<?= base_url(); ?>assets/js/jquery-1.9.0.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery-ui.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.ui.core.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.ui.datepicker.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.bpopup.js"></script>
        <script src="<?= base_url(); ?>assets/js/enscroll-0.4.0.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/validation.js"></script>

        <style>
            ::selection {color:black;background:#9a0a06;}
            ::-moz-selection {color:black;background:#9a0a06;}
        </style>
    </head>

    <body>
        <div class="container" id="main-container">
            <div style="background: #9a0a06;
                 height: 80px;
                 width: 100%;
                 min-width: 960px;
                 margin: 0 auto;">
                <div style="text-align:center;" class="logo-nav">
                    <span>
                        <img src="<?= base_url(); ?>assets/images/logof.png" alt="">
                    </span>
                </div>
            </div>
            <div id="wrapper">
                <div id="content">
                    <div style="width: 643px;height: auto;background: #FFF;border: 1px solid #efefef;box-shadow: 0 5px 3px #D6D6D6;border-radius: 10px;margin: 0 auto;">
                        <a href="<?= base_url(); ?>sales/"><button class="btn" style="width: 290px;height: 150px;margin-left: 30px;margin-top: 10px;">SALES</button></a>
                        <a href="<?= base_url(); ?>parts/"><button class="btn" style="width: 290px;height: 150px;margin-left: 0px;margin-top: 10px; margin-bottom: 10px">PARTS</button></a>
                        <a href="<?= base_url(); ?>customerrelations/"><button class="btn" style="width: 290px;height: 150px;margin-left: 30px;margin-top: 10px; margin-bottom: 10px">CUSTOMER RELATIONS</button></a>
                        <!--<a href="<?= base_url(); ?>service/"><button class="btn" style="width: 290px;height:150px;margin-left: 10px;margin-top: 10px; margin-bottom: 10px">SERVICE</button></a>-->
                        <!--<button class="btn" style="width: 594px;height:150px;margin-left: 10px;margin-top: 10px; margin-bottom: 10px" onclick="financePopup('detail')">Finance</button>-->
                        <?php if ($this->session->userdata('Role') == 'CRAdmin' || $this->session->userdata('Role') == 'AdminCR') { ?>
                            <a href="<?= base_url(); ?>service/index.php/psfuupdate/index"><button class="btn" style="width: 290px;height:150px;margin-left: 0px;margin-top: 10px; margin-bottom: 10px">SERVICE</button></a>
                        <?php } else {
                            ?>
                            <a href="<?= base_url(); ?>service/"><button class="btn" style="width: 290px;height:150px;margin-left: 0px;margin-top: 10px; margin-bottom: 10px">SERVICE</button></a>
                        <?php } ?>
                        <?php if ($this->session->userdata('Role') == 'FinanceAdmin' || $this->session->userdata('Role') == 'Admin') { ?>
                            <button class = "btn" style = "width: 290px;height:150px;margin-left: 30px;margin-top: 10px; margin-bottom: 10px" onclick = "financePopup('detail', 'FinanceAdmin')">FINANCE</button>
                        <?php } else {
                            ?>
                            <button class = "btn" style = "width: 290px;height:150px;margin-left: 30px;margin-top: 10px; margin-bottom: 10px" onclick = "financePopup('message', '')">FINANCE</button>
                        <?php } ?>                       
                        <a href="<?= base_url(); ?>adminpanel/"><button class="btn" style="width: 290px;height:150px;margin-left: 0px;margin-top: 10px; margin-bottom: 10px">ADMIN PANEL</button></a>
                        <a href="<?= base_url(); ?>index.php/login/logout"><button class="btn" style="width: 583px;height:150px;margin-left: 30px;margin-top: 10px; margin-bottom: 10px">LOGOUT</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 750px;" class="feildwrap  popup popup-detail">
            <form action="" method="POST" class="form animated fadeIn" onSubmit="" style="width: 250px;">
                <img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">
                <div style="margin-left: 25px;width: 0px;">
                    <fieldset style="">
                        <legend>Select Department</legend>
                        <div class="feildwrap" style="margin-left: 225px;">
                            <div style="">
                                <button type="button" class="btn" style="width: 200px;"><a href="<?= base_url(); ?>sales/index.php/finance/" class="">Sales Department</a></button>
                            </div><br><br>
                            <div style="">
                                <button type="button" class="btn" style="width: 200px;"><a href="<?= base_url(); ?>service/index.php/rofinance/">Service Department</a></button>
                            </div><br><br>
                            <div style="">
                                <button type="button" class="btn" style="width: 200px;"><a href="<?= base_url(); ?>parts/index.php/sales/">Parts Department</a></button>
                            </div><br><br>
                            <div style="">
                                <button type="button" class="btn" style="width: 200px;"><a href="<?= base_url(); ?>finance/index.php/payment/">General</a></button>
                            </div>
                        </div>                        
                    </fieldset>
                </div><br>
            </form>
        </div>    
        <div style="width: 750px;" class="feildwrap  popup popup-message">
            <form action="" method="POST" class="form animated fadeIn" onSubmit="" style="width: 250px;">
                <!--<img src="<?php echo base_url() ?>assets/images/icons/close.png" width="32" height="32" alt="close" class="close-pop">-->
                <div style="margin-left: 25px;width: 0px;">
                    <fieldset style="">
                        <legend>Message</legend>
                        <div class="feildwrap" style="margin-left: 125px;">
                            <div style="">
                                <p style="font-size: larger;font-weight: bolder">Not Allowed ! Please Login as Finance Admin</p>
                            </div><br>                           
                            <div style="">
                                <div style="margin-left:350px;">
                                    <input id="OK" type="button" class="btn close-pop" value="OK" style="width: 100px;margin-top: 115px;margin-right: 125px;">
                                </div>
                            </div>                        
                    </fieldset>
                </div><br>
            </form>
        </div>    
        <script>
            function financePopup(div_id, role) {
                if (role !== "") {
                    $('.popup-' + div_id).bPopup({
                        fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
                        followSpeed: 1500, //can be a string ('slow'/'fast') or int
                        modalColor: '#333',
                        closeClass: 'close-pop'
                    }, function() {
                    });
                } else {
                    $('.popup-' + div_id).bPopup({
                        fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
                        followSpeed: 1500, //can be a string ('slow'/'fast') or int
                        modalColor: '#333',
                        closeClass: 'close-pop'
                    }, function() {
                    });
                }
            }

        </script>