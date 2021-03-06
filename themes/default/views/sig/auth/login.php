<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $Settings->site_name ?></title>
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    
    <link href="<?= $assets ?>styles/theme.css" rel="stylesheet"/>
    <link href="<?= $assets ?>styles/style.css" rel="stylesheet"/>
    <link href="<?= $assets ?>styles/helpers/login.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
    
    <!--[if lt IE 9]>
    <script src="<?= $assets ?>js/respond.min.js"></script>
    <![endif]-->
    <style>
    body {
    background-image: url('<?= $assets ?>login/lib/images/fundo2.jpg');
    background-repeat: no-repeat;
    }
    
    
    #logoempresa{

                width: 250px;
                height: 80px;
                margin: auto;
                background-image:url(<?= $assets ?>login/lib/images/risk.jpeg);
                background-repeat:no-repeat; 
                background-size:100% 100%;
                -webkit-background-size: 100% 100%;
                -o-background-size: 100% 100%;
                -khtml-background-size: 100% 100%;
                -moz-background-size: 100% 100%;
                margin-top: -50px;
            }
    </style>
</head>

<body class="login-page"  >
<noscript>
    <div class="global-site-notice noscript">
        <div class="notice-inner">
            <p><strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript enabled in
                your browser to utilize the functionality of this website.</p>
        </div>
    </div>
</noscript>
<div style="margin-top: 100px;" >
    <div class="text-center">
    <div id="logoempresa"></div>    
    </div>
    <br>
    <div id="login" >

          <div class=" container" >

            <div class="login-form-div" >
                <div class="login-content" >
                    <?php if ($Settings->mmode) { ?>
                        <div class="alert alert-warning">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <?= lang('site_is_offline') ?>
                        </div>
                    <?php }
                    if ($error) { ?>
                        <div class="alert alert-danger">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?= $error; ?></ul>
                        </div>
                    <?php }
                    if ($message) { ?>
                        <div class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?= $message; ?></ul>
                        </div>
                    <?php } ?>
                    <?php echo form_open("auth/login", 'class="login" data-toggle="validator"'); ?>
                    <div class="div-title">
                       <center>  <font style="color:#005f8d ; margin-top: 0px;"> <h1>PROVIN</h1> </font>
                       <P>Procedimento de Verificação de Inconsistências e Pagamentos Discrepantes</P></center>
                    </div>
                    <div class="textbox-wrap form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" required="required" class="form-control" name="identity"
                                   placeholder="<?= lang('username') ?>"/>
                        </div>
                    </div>
                    <div class="textbox-wrap form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" required="required" class="form-control " name="password"
                                   placeholder="<?= lang('pw') ?>"/>
                        </div>
                    </div>
                    <?php if ($Settings->captcha) { ?>
                        <div class="textbox-wrap form-group">

                            <div class="row">
                                <div class="col-sm-6 div-captcha-left">
                                    <span class="captcha-image"><?php echo $image; ?></span>
                                </div>
                                <div class="col-sm-6 div-captcha-right">
                                    <div class="input-group">
                                        <span class="input-group-addon"><a href="<?= base_url(); ?>auth/reload_captcha"
                                                                           class="reload-captcha"><i
                                                    class="fa fa-refresh"></i></a></span>
                                        <?php echo form_input($captcha); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php } /* echo $recaptcha_html; */ ?>

                    <div class="form-action clearfix">
                        <div class="checkbox pull-left">
                            <div class="custom-checkbox">
                                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                            </div>
                            <span class="checkbox-text pull-left"><label 
                                    for="remember"><?= lang('remember_me') ?></label></span>
                        </div>
                        <button style="background-color: #FA733B" type="submit" class="btn btn-success pull-right"><?= lang('login') ?> &nbsp; <i
                                class="fa fa-sign-in"></i></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="login-form-links link2">
                    <h4 class="text-danger"><?= lang('forgot_your_password') ?></h4>
                    <span><?= lang('dont_worry') ?></span>
                    <a href="#forgot_password" class="text-danger forgot_password_link"><?= lang('click_here') ?></a>
                    <span><?= lang('para Redefinir') ?></span>
                </div>
                <?php if ($Settings->allow_reg) { ?>
                    <div class="login-form-links link1">
                        <h4 class="text-info"><?= lang('dont_have_account') ?></h4>
                        <span><?= lang('no_worry') ?></span>
                        <a href="#register" class="text-info register_link"><?= lang('click_here') ?></a>
                        <span><?= lang('to_register') ?></span>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>

    <div id="forgot_password" style="display: none;">
        <div class=" container">

            <div class="login-form-div">
                <div class="login-content">
                    <?php if ($error) { ?>
                        <div class="alert alert-danger">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?= $error; ?></ul>
                        </div>
                    <?php }
                    if ($message) { ?>
                        <div class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?= $message; ?></ul>
                        </div>
                    <?php } ?>
                    <div class="div-title">
                        <h3 class="text-primary"><?= lang('forgot_password') ?></h3>
                    </div>
                    <?php echo form_open("auth/forgot_password", 'class="login" data-toggle="validator"'); ?>
                    <div class="textbox-wrap form-group">
                        <div class="input-group">
                            <span class="input-group-addon "><i class="fa fa-envelope"></i></span>
                            <input type="email" name="forgot_email" class="form-control "
                                   placeholder="<?= lang('email_address') ?>" required="required"/>
                        </div>
                    </div>
                    <div class="form-action clearfix">
                        <a class="btn btn-success pull-left login_link" href="#login"><i
                                class="fa fa-chevron-left"></i> <?= lang('back') ?>  </a>
                        <button type="submit" class="btn btn-primary pull-right"><?= lang('submit') ?> &nbsp;&nbsp; <i
                                class="fa fa-envelope"></i></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>


        </div>
    </div>
   
    
    <div class="text-center">
        
    <footer class="main-footer" style="position: fixed; bottom: 0px; right: 0px; width: 100%; ">
        
    <div class="pull-right hidden-xs">
      <b>Version</b> <?= $Settings->version ?>
    </div>
    <strong>Copyright &copy; 2018 <a href="#"> sig </strong> All rights
    reserved. 
    
  </footer>
        
    </div>
    
</div>

<script src="<?= $assets ?>js/jquery.js"></script>
<script src="<?= $assets ?>js/bootstrap.min.js"></script>
<script src="<?= $assets ?>js/jquery.cookie.js"></script>
<script src="<?= $assets ?>js/login.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var hash = window.location.hash;
        if (hash && hash != '') {
            $("#login").hide();
            $(hash).show();
        }
    });
</script>
</body>
<!-- AdminLTE App -->
<script src="<?= $assets ?>bi/dist/js/adminlte.min.js"></script>
</html>
