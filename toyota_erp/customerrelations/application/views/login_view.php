<?php
if ($this->session->userdata('userid') != "") {
    redirect(base_url() . "index.php/crpanel/index");
//    echo $this->session->userdata('userid');
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login - Toyota Western Motors</title>
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
                <div class="logo-nav">
                    <span style="margin-left: 520px;" >
                        <img src="<?= base_url(); ?>assets/images/logo.png" alt="">
                    </span>
                </div>
            </div>
            <div id="wrapper">
                <div id="content">
                    <div style="min-width: 707px;height: auto;background: #FFF;border: 1px solid #efefef;
                         box-shadow: 0 5px 3px #D6D6D6;border-radius: 10px;margin-left: 333px;margin-right: 303px;">
                        <form name="myform" onSubmit="return validationform()" method="post"
                              action="<?= base_url() . 'index.php/login/process' ?>" class="form validate-form animated fadeIn">
                            <fieldset>
                                <legend>Login</legend>
                                <div class="feildwrap">
                                    <div>
                                        <h5>
                                            <?php
                                            if (!is_null($msg)) {
                                                echo $msg;
                                            }
                                            ?>
                                        </h5>
                                    </div>
                                    <div>
                                        <label>UserName</label>
                                        <input type="text" name="username" data-validation="required">
                                    </div>
                                    <br>

                                    <div>
                                        <label>Password</label>
                                        <input type="password" name="password" data-validation="required" style="width: 250px;">
                                    </div>
                                    <br>

                                    <div class="btn-block-wrap" style="float: left;">
                                        <label>&nbsp;</label>
                                        <input type="submit" class="btn" value="Login" style="width: 270px">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function validationform() {
                    chosen = "";
                    len = document.myform.follow_up.length;

                    for (i = 0; i < len; i++) {
                        if (document.myform.follow_up[i].checked) {
                            chosen = document.myform.follow_up[i].value;
                        }
                    }

                    if (chosen === "") {
                        $(".check").show();
                        return false;
                    }
                    else {
                        $(".check").hide();
                        return true;
                    }

                }
            </script>

            <!--<div id='login_form'>
                        <form action='<?php // echo site_url('login/process');                      ?>' method='post' name='process'>
                            <h2>User Login</h2>
                            <h5><?php // if (!is_null($msg)) echo $msg;                      ?></h5>          
                            <label for='username'>Username</label>
                            <input class="txtBox" type='text' name='username' id='username' size='25' /><br />
                    
                            <label for='password'>Password</label>
                            <input class="txtBox" type='password' name='password' id='password' size='25' /><br />                            
                    
                            <input type='Submit' value='Login' />            
                        </form>
                    </div>-->