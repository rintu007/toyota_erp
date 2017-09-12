<?php
$cookieData = unserialize($_COOKIE['logindata']);
if ($cookieData["userid"] != "") {
    ?>
    <!doctype html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Sales Division - Toyota - Dealer Faislabad System</title>
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/animate.css">
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/datepikker.css">
            <script src="<?= base_url(); ?>assets/js/jquery-1.9.0.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery-ui.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.ui.core.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.ui.datepicker.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.bpopup.js"></script>
            <script src="<?= base_url(); ?>assets/js/jquery.maskedinput.js"></script>
            <script src="<?= base_url(); ?>assets/js/enscroll-0.4.0.min.js"></script>
            <script src="<?= base_url(); ?>assets/js/validation.js"></script>
            <script src="<?= base_url(); ?>assets/js/datatables.js"></script>
            <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/jquery.dataTables.css">


            <script>
                $(document).ready(function() {
                    $(".form-error").hide();
                    $(".cb-error").hide();
                    $(".pbo-error").hide();
                    $("#CustomerCombo").hide();
                    $("#companyName").hide();
                    $("#designation").hide();
                    $("#lesse").hide();
                    $("#financer").hide();
                    $("#dealerName").hide();
                    $("#subdealerName").hide();
                    $("#efEngineNo").attr('disabled', 'disabled');
                    $("#efChasisNo").attr('disabled', 'disabled');

                    //Format
                    $(".iFormat").hide();

                    //Resourcebook Mobile Number Masking.
                    $("#TimeConsumed").mask('99:99', {placeholder: '#'});//03112004603
                    $("#Mobile_no").mask('9999-9999999', {placeholder: '#'});//03112004603
                    $("#Office_no").mask('999-99999999', {placeholder: '#'});//02134915889
                    $("#Residential_no").mask('999-99999999', {placeholder: '#'});//02134915889
                    $("#NTN_no").mask('9999999-9', {placeholder: '#'});//0003456-2
					$(".hash").mask('9999999999999', {placeholder: '#'});//0003456-2
					$(".hash2").mask('99999', {placeholder: '#'});//0003456-2
					$(".hash3").mask('99999999999', {placeholder: '#'});//0003456-2

                    //Search Resourcebook
                    $(".City").hide();
                    $(".ContactType").hide();
                    $(".Color").hide();
                    $(".CustomerName").hide();
                    $(".CustomerType").hide();
                    $(".CompanyName").hide();
                    $(".CustomerStatus").hide();
                    $(".Model").hide();
                    $(".Payment").hide();
                    $(".Variant").hide();
                    $(".Salesman").hide();
                    $(".Dealership").hide();
                    $(".Dealer").hide();
                    $(".Province").hide();

                    //Dispatch Form
                    $("#PboNumber").hide();
                    $("#PboDetails").hide();
                    $("#Color").hide();
                    $("#VehicleDetails").hide();
                    $("#btnDispatch").hide();
                    $("#dChasis").hide();
                    $("#dEngine").hide();
                    $("#ChasisNo").hide();
                    $("#EngineNo").hide();

                    //GatePass
                    $("#gpPbo").hide();
                    $("#gpChasis").hide();
                    $('#pbodetails').hide();
                    $('#openstockdetails').hide();

                    //PBO
                    $("#comboChasisNo").hide();
                    $("#comboEngineNo").hide();

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
                .icon-cont {
					float: left;
					padding: 0px 0px 5px 1%;
					width: 99%;
					background: #9a0a06;
				}
				.icon-cont a img {
					padding: 0 3px;
				}
                .datefield input#year { width:2.5em; }
                .datefield input:focus { outline:none; }
            </style>
        </head>

        <body>
        <style>
          div#wrapper {
				margin: 0 !important;
			}
        </style>
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