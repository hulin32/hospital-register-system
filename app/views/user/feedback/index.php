    <!DOCTYPE html>
<html>
    <head>
        <title>个人中心</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="dist/css/common.css" />
        <link rel="stylesheet" type="text/css" href="dist/css/base.css" />
        <link rel="stylesheet" type="text/css" href="dist/css/user_feedback.css" />
        <script src="js/base.js" type="text/javascript"></script>
    </head>
    
    <body>

        <div class="bd-wrap">
            <h2 class="title">反馈建议</h2>
            
            <form class="feedback-form" action="user_feedback_success.php">
                <div class="input-title-wrap clearfix">
                    <textarea class="input-value" placeholder="请输入主题" name="title"></textarea>
                    <span class="input-key">主题：</span>
                </div>
                <div class="input-content-wrap clearfix">
                    <textarea class="input-value" placeholder="请输入内容" name="content"></textarea>
                    <span class="input-key">内容：</span>
                    <div class="input-note">字数在200字以内</div>
                </div>
                <input class="sub-btn btn" type="submit" value="发送">
            </form>
        </div>
    </body>
</html>