<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:49:"/data/www/public/../app/admin/view/file/edit.html";i:1541125502;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/static/admin/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/global.css">
    <link rel="stylesheet" href="/static/admin/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="/static/admin/codemirror/theme/eclipse.css">

</head>
<body>
<div class="subbody">

    <!--form表单-->
    <form class="layui-form" style="height: 100%;">

        <div class="layui-form-item" style="height: 100%;">
            <textarea id="text" name="text" placeholder="请输入内容" class="layui-textarea"><?php echo $code; ?></textarea>
            <input type="hidden" name="filename" id="filename">
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="addData">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<script src="/static/admin/layui.js"></script>
<script src="/static/admin/codemirror/lib/codemirror.js"></script>
<script src="/static/admin/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="/static/admin/codemirror/mode/php/php.js"></script>
<script src="/static/admin/codemirror/mode/css/css.js"></script>
<script src="/static/admin/codemirror/mode/javascript/javascript.js"></script>
<script src="/static/admin/codemirror/mode/xml/xml.js"></script>
<script src="/static/admin/codemirror/mode/clike/clike.js"></script>

<script>
    layui.use(['element', 'form', 'layer'], function () {
        var form = layui.form
            ,layer = layui.layer
            , $ = layui.jquery;
        var mycode = CodeMirror.fromTextArea(document.getElementById('text'),{
            lineNumbers:true,
            theme:"eclipse"
        });
        var ext = '<?php echo $ext; ?>';
        if(ext == 'html'){
            ext = 'htmlmixed';
        }else if(ext == 'js' || ext == 'json'){
            ext = 'javascript';
        }else{
            ext = 'php';
        }
        mycode.setOption('mode',ext);
        mycode.setSize('auto','100%');

        //监听提交
        form.on('submit(addData)', function (data) {
            data.field.text = mycode.getValue();
            var m = layer.msg('数据提交中，请稍候', {icon: 16, time: false, shade: 0.8});
            var url = "<?php echo url('file/edit'); ?>";
            $.post(url, data.field, function (res) {
                if (res.code == 1) {
                    layer.close(m);
                    layer.msg(res.msg);
                    //刷新父页面
                    parent.location.reload();
                } else {
                    layer.close(m);
                    layer.msg(res.msg);
                }
            }, 'json');
            return false;
        });
    });
</script>

</body>
</html>