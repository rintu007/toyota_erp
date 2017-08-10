<?php
$cookieData = unserialize($_COOKIE['logindata']);
if ($cookieData["userid"] != "") {
    ?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Parts Division - Toyota - Dealer Faislabad System</title>
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/animate.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datepikker.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/easyui/css/easyui.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/chosen.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/easyui/css/icon.css">
            <!--<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">-->

            <script src="<?= base_url(); ?>assets/js/jquery-1.9.0.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery-ui.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.ui.core.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.ui.datepicker.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.bpopup.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.maskedinput.js"></script>
            <script src="<?= base_url(); ?>assets/js/enscroll-0.4.0.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/chosen.jquery.js"></script>
            <script src="<?= base_url(); ?>assets/js/validation.js"></script>

            <!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>-->
            <script type="text/javascript" src="<?= base_url(); ?>assets/easyui/js/jquery.easyui.min.js"></script>
            <script type="text/javascript" src="<?= base_url(); ?>assets/easyui/js/jquery.edatagrid.js"></script>
            <script>
                $(document).ready(function() {
                    $(".form-error").hide();
                    $(".AddRow").hide();
                    $(".cb-error").hide();
                    $("#companyName").hide();
                    $("#designation").hide();
                    $("#dealerName").hide();
                    $("#subdealerName").hide();
                    $("#OrderId").hide();
                    $("#InvoiceNumber").hide();
                    $("#InvoiceDate").hide();

                    $("#tblOrder").hide();
                    $("#tblLocal").hide();
                    $("#tblForce").hide();

                    //Mobile Number Masking.
                    $("#MobileNumber").mask('9999-9999999', {placeholder: '#'});//03112004603

                    //Invoices List..
                    $(".DailyOrderInvoices").hide();
                    $(".PlanOrderInvoices").hide();
                    $(".AccessoriesOrderInvoices").hide();
                    $(".DPackageOrderInvoices").hide();
                    $(".MPackageOrderInvoices").hide();
                    $(".UrgentOrderInvoices").hide();
                    $("#BackOrderInvoices").hide();

                    //Search Resourcebook
                    $("#City").hide();
                    $("#ContactType").hide();
                    $("#Color").hide();
                    $("#CustomerName").hide();
                    $("#CustomerType").hide();
                    $("#CompanyName").hide();
                    $("#CustomerStatus").hide();
                    $("#Model").hide();
                    $("#Payment").hide();
                    $("#Variant").hide();
                    $("#Dealer").hide();
                    $("#Province").hide();
                    //Grid
                    $('#dailyorder').hide();

                    //Parts Reporting
                    $('#ByCategory').hide();
                    $('#ByManufacturer').hide();
                    $('#ByType').hide();
                    $('#ByParty').hide();
                    $('#ReportingButton').hide();
                    $('#ByOrderNumber').hide();
                    $('#ByBrand').hide();
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
            <div class="container" id="main-container">
                <div class="header">
                    
                    <span class="logo"><img
                                src="<?= base_url(); ?>assets/images/logof.png" alt=""></span>
                                
                        <!--<div class="icon-cont">
                       <a href="#" title="Home"><img src="<?= base_url(); ?>assets/images/icon-home.png" alt=""></a>
                       <a href="#" title="Logout"><img src="<?= base_url(); ?>assets/images/icon-logout.png" alt=""></a>
                    </div>-->
                    <div class="logo-nav"><span>Dealer Management System</span>
                    </div>
                    
                    <!--<div class="btns-nav"><span class="tital">Sales Division</span>

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
                    </div>-->
                    
                </div> 
                <?php
            } else {
                redirect(base_url());
            }
            ?>