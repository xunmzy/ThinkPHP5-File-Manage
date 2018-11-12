<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:51:"/data/www/public/../app/admin/view/login/index.html";i:1540800952;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/static/admin/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/global.css">
</head>
<body>
<div class="container demo-1">
    <div class="content">
        <div id="large-header" class="large-header">
            <div class="kit-login-box">
                <header>
                    <h1>LOGIN</h1>
                </header>
                <div class="kit-login-main">
                    <form class="layui-form" method="post">
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe612;</i>
                            </label>
                            <input type="text" name="user" lay-verify="required" autocomplete="off"
                                   placeholder="这里输入用户名." class="layui-input">
                        </div>
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe673;</i>
                            </label>
                            <input type="password" name="pwd" lay-verify="required" autocomplete="off"
                                   placeholder="这里输入密码." class="layui-input">
                        </div>
                        <div class="layui-form-item">
                            <label class="kit-login-icon">
                                <i class="layui-icon">&#xe679;</i>
                            </label>
                            <input type="text" name="verifycode" lay-verify="required" autocomplete="off"
                                   placeholder="验证码" class="layui-input">
                            <span class="form-code" id="changeCode" style="position:absolute;right:0px; top:0px;">
                                    <img id="verifyCode" src="/captcha" style="cursor:pointer;"
                                         title="点击更换验证码">
                                </span>
                        </div>
                        <div class="layui-form-item">
                            <div class="kit-pull-left kit-login-remember">
                                <input type="checkbox" name="rememberMe" value="true" lay-skin="primary" checked
                                       title="记住帐号?">
                            </div>
                            <div class="kit-pull-right">
                                <button class="layui-btn layui-btn-primary" lay-submit lay-filter="login">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i> 登录
                                </button>
                            </div>
                            <div class="kit-clear"></div>
                        </div>
                    </form>
                </div>
                <footer>
                    <p>XunM后台管理系统 &copy; 寻梦资源网</p>
                </footer>
            </div>
        </div>
    </div>
</div>
<script src="/static/admin/layui.js"></script>
<script>
    layui.use(['element', 'form', 'layer'], function () {
        var form = layui.form
            , layer = layui.layer
            , $ = layui.jquery
            , checkUrl = "<?php echo url('login/check'); ?>";
        form.on('submit(login)', function (data) {
            var index = layer.msg('登陆中，请稍候', {icon: 16, time: false, shade: 0.8});
            $.post(checkUrl, data.field, function (res) {
                if (res.code == 1) {
                    layer.close(index);
                    layer.msg(res.msg);
                    location.href = res.url;
                } else {
                    layer.close(index);
                    layer.msg(res.msg, {icon: 2, time: 1000, shade: 0.8});
                }

            }, 'json');

            return false;
        });

    });
    var verifyCode = document.getElementById('verifyCode');
    verifyCode.onclick = function () {
        this.src = '/captcha?id=' + Math.random;
    }

</script>
</body>
</html>