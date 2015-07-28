<!DOCTYPE html>
<html>
    <head>
        <title>登陆</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="dist/css/common.css" />
        <link rel="stylesheet" type="text/css" href="dist/css/base.css" />
        <link rel="stylesheet" type="text/css" href="dist/css/user_login.css" />
        <script src="js/base.js" type="text/javascript"></script>
    </head>
    
    <body>
        <div class="bd-wrap">
            <h2 class="title"><a class="register" href="user_register.php">注册</a></h2>
            
            <form class="login-form" method="post" action="user_center.php">
                <input class="input-blk form-blk" placeholder="用户名/健康卡/身份证" name="login_voucher" type="text">
                <input class="input-blk form-blk" placeholder="密码" name="password" type="password">
                <div class="form-mdl form-blk clearfix">
                    <input class="checkbox" type="checkbox">
                    <span class="checkbox-text">记住用户名</span>
                    <a class="recover-pwd" href="recover_password.php">找回密码 ></a>
                </div>
                <input class="btn form-blk" type="submit" value="登陆">
            </form>
        </div>
    </body>
</html>