<?php

function docrt_login_logo() { ?>
    <style type="text/css">
        body {
            height: 100%;
            width: 100%;
        }
        body, #wp-auth-check-wrap #wp-auth-check {
            background-color: rgba(161,164,166,1.0)!important /*#a1a4a6*/;
            background-image: url(<?php echo docrt_plugin_url() ?>/assets/img/login-bg.png)!important;
            background-position: center center!important;
        }
        body #login {
            top: 15%;
            position: relative;
            max-width: 391px;
            width: 100%;
            padding: 45px;
            margin: auto;
        }
        body #login h1 a, .login h1 a {
            background-image: url(<?php echo docrt_plugin_url() ?>/assets/img/login-logo.png);
            padding-bottom: 0px;
            background-size: contain;
            width: auto;
            max-height: 80px;
        }
        body #login {
            background: -moz-linear-gradient(top, rgba(24,24,69,0.7) 0%, rgba(0,0,0,0.7) 100%);
            background: -webkit-linear-gradient(top, rgba(24,24,69,0.7) 0%, rgba(0,0,0,0.7) 100%);
            background: -o-linear-gradient(top, rgba(24,24,69,0.7) 0%, rgba(0,0,0,0.7) 100%);
            background: -ms-linear-gradient(top, rgba(24,24,69,0.7) 0%, rgba(0,0,0,0.7) 100%);
            background: linear-gradient(top, rgba(24,24,69,0.7) 0%, rgba(0,0,0,0.7) 100%);
        }
         body, body *{
            vertical-align: top;
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            -o-box-sizing: border-box;
        }

        body{
            width: 100%;
            margin: 0;
            padding: 0;
            display: inline-block;
        }

        body, p{
            line-height: 23px;
            font-size: 14px;
        }

        body a, body label{
            display: inline-block;
        }

        #backtoblog {
            margin: 0px 0 0;
        }

        .mobile #login{
            padding: 15px 30px;
        }

        .login.wp-core-ui .button-primary{
            height: 34px;
            line-height: 28px;
            border-radius : 0px;
            padding: 0 12px 2px;
            border-color: transparent;
            text-shadow: none;
        }


        .login.wp-core-ui input[type=checkbox]{
            box-shadow: none;
            -ms-box-shadow: none;
            -moz-box-shadow: none;
            -o-shadow: none;
            border-color:
            }

        .login h1 a {
            background-size: contain;
            background-color: transparent;
            min-height: 92px;
            width:auto;
        }

        #login {
            top: 50%;
            position: relative;
            max-width: 391px;
            width:100%;
            padding: 45px;
            margin: auto;
            margin-top: -265px;
        }

        body.login form {
            margin-top: 0px;
            margin-left: 0;
            padding: 18px 0 23px 0;
            font-weight: 300;
            -webkit-box-shadow: none;
            box-shadow: none;
            background: transparent;
        }

        body.login #nav {
            font-size: 14px;
            padding: 0 23px;
            text-align: center;
            margin: 0px 0 0 0;
            font-weight: 300;
            color: #aeaeae;
        }

        body.login #backtoblog{
            font-size: 14px;
            padding: 0 23px;
            text-align: center;
            margin: 12px 0 11px 0;
            font-weight: 500;
        }


        body.login h1 a {
            height: 115px;
            font-size: 23px;
            font-weight: 400;
            line-height: 23px;
            margin: 0px auto 0px auto;
            padding: 0;
            text-decoration: none;
            max-width: 391px;
            width: 100%;
        }


        body.login label {
            font-size: 14px;
            line-height: 23px;
            width: 100%;
            font-weight: 300;
        }

        body.login label br{display: none;}

        body.login form .input, body.login input[type=text] {
            font-size: 17px;
            width: 100%;
            padding: 9px;
            line-height: 23px;
            margin: 5px 0 22px 0;
        }

        body.login label[for='user_login'] input[type=text]{
            margin: 5px 0 5px 0;
        }

        body.login form .input, body.login form input[type=checkbox], body.login input[type=text] {
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            -moz-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            -ms-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            -o-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            /* text-shadow: 1px 1px 1px rgba(200,200,200,.1); */
            font-weight: 300;
        }

        body.login label[for='user_login']:before,
        body.login label[for='user_pass']:before,
        body.login label[for='user_email']:before{
                display: inline-block;
              width: 20px;
              height: 20px;
              font-size: 20px;
              line-height: 1;
              font-family: dashicons;
              text-decoration: inherit;
              font-weight: 300;
              font-style: normal;
              vertical-align: top;
              text-align: center;
              -webkit-transition: color .1s ease-in 0;
              transition: color .1s ease-in 0;
              -webkit-font-smoothing: antialiased;
              float: left;
              top: 36px;
              position: relative;
              left: 7px;
              color: #aeaeae;
        }

        body.login input[type=text], body.login input[type=password], body.login input[type=email]{
            padding-left: 38px;
            float: left;
        }

        body.login label[for='user_login']:before{
            content: "\f338";
        }
        body.login label[for='user_pass']:before{
            content: "\f160";
        }
        body.login label[for='user_email']:before{
            content: "\f466";
        }



        body.login form .forgetmenot label {
            font-size: 17px;
            line-height: 23px;
            display: inline-block;
            color: #aeaeae;
            padding-left: 7px;
        }

        body.login form .forgetmenot input[type="checkbox"]{
            margin-right: 10px;
        }

        body.login form .forgetmenot{
            width:100%;
            display:block;
            margin: 15px 0 30px 0!important;
        }

        #login form p.submit {
            margin: 23px 0 0 0;
            padding: 0;
            display: inline-block;
            width: 100%;
        }

        body.login.wp-core-ui .button-primary{
            width: 100%;
            height:46px;
            line-height: 28px;
            padding: 2px 12px 2px 12px;
            font-size: 19px;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            -moz-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            -ms-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            -o-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }

        input[type=checkbox], input[type=color], input[type=date], input[type=datetime-local], input[type=datetime], input[type=email], input[type=month], input[type=number], input[type=password], input[type=radio], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], input[type=week], select, textarea {
            border: 0px solid transparent;
            border-bottom: 1px solid transparent;
            -webkit-box-shadow: none;
            box-shadow: none;
            outline: 0;
        }

        input:hover, input:focus{
            border: 0px solid transparent;
            border-bottom: 1px solid transparent;
           -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline: 0px !important;
         }

        input[type=checkbox], input[type=checkbox]:hover, input[type=checkbox]:focus{
            border: 1px solid transparent;
        }

        input[type=checkbox], input[type=color], input[type=date], input[type=datetime-local], input[type=datetime], input[type=email], input[type=month], input[type=number], input[type=password], input[type=radio], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], input[type=week], select, textarea{
            transition: background-color 0.3s ease, border 0.3s ease, color 0.3s ease, opacity 0.3s ease-in-out, padding 0.3s ease;
            -webkit-transition: background-color 0.3s ease, border 0.3s ease, color 0.3s ease, opacity 0.3s ease-in-out, padding 0.3s ease;
            -moz-transition: background-color 0.3s ease, border 0.3s ease, color 0.3s ease, opacity 0.3s ease-in-out, padding 0.3s ease;
            -ms-transition: background-color 0.3s ease, border 0.3s ease, color 0.3s ease, opacity 0.3s ease-in-out, padding 0.3s ease;
            -o-transition: background-color 0.3s ease, border 0.3s ease, color 0.3s ease, opacity 0.3s ease-in-out, padding 0.3s ease;

        }


        body.login #login_error, body.login .message {
            width: 100%;
            border-left: 0px solid transparent;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,0);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,0);
            -moz-box-shadow: 0 1px 1px 0 rgba(0,0,0,0);
            -ms-box-shadow: 0 1px 1px 0 rgba(0,0,0,0);
            -o-box-shadow: 0 1px 1px 0 rgba(0,0,0,0);
        }

        #login_error, body.login .message {
                padding: 12px 0px 0px 0px;
                text-align: center;
        }

        .login, .login form label, .login form, .login #login_error, .login .message {
            color: rgba(154,154,154,1) /*#9a9a9a;;;; */;
        }
        .login #login_error, .login .message {
            background-color: transparent!important /*transparent; */;
        }
        .login.wp-core-ui .button-primary {
            background-color: rgba(244,82,70,1) /*#f45246; */;
        }
        .login form input[type=checkbox] {
            border-color: rgba(139,140,145,1.0) /*#8b8c91; */;
        }
        .login form .input, .login form input[type=checkbox], .login input[type=text] {
            color: rgba(245,245,245,1) /*#f5f5f5; */;
        }
        .login form .input, .login form input[type=checkbox], .login input[type=text] {
            background-color: transparent!important /*transparent; */;
        }

        .interim-login #login {
            top: 0%;
            position: relative;
            max-width: 320px;
            width: 100%;
            padding: 25px;
            margin: auto;
        }
        body.interim-login {
            background-image: none!important;
            background-color: #fff!important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'docrt_login_logo' );

function docrt_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'docrt_login_logo_url' );

function docrt_login_logo_url_title() {
    return 'Aplikasi singo';
}
add_filter( 'login_headertitle', 'docrt_login_logo_url_title' );


?>
