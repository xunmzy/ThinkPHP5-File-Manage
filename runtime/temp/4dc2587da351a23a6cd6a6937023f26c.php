<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"/data/www/public/../app/admin/view/file/index.html";i:1542007914;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Title</title>
    <link rel="stylesheet" href="/static/admin/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/global.css">
    <style>
        .icon {
            width: 1em;
            height: 1em;
            vertical-align: -0.15em;
            fill: currentColor;
            overflow: hidden;
            font-size: 2.5rem;
            margin-right: 5px;
        }
    </style>
</head>
<body>
<blockquote class="layui-elem-quote quoteBox">
    <a class="layui-btn layui-btn-lg layui-btn-primary" href="?dirname=<?php echo $uppath; ?>">上级目录</a>
    <button id="refreshThis" class="layui-btn layui-btn-lg layui-btn-primary"><i
            class="layui-icon layui-icon-refresh"></i></button>
    <button class="layui-btn layui-btn-lg layui-btn-primary">当前路径：<?php echo $path; ?></button>
    <div class="layui-btn layui-btn-lg" style="float: right">文件夹：<?php echo $num['dir']; ?>个，文件：<?php echo $num['file']; ?>个</div>
</blockquote>

<table class="layui-table">
    <colgroup>
        <col width="15%">
        <col width="15%">
        <col width="15%">
        <col width="15%">
        <col width="15%">
        <col width="15%">
    </colgroup>
    <thead>
    <tr>
        <th>文件名</th>
        <th>文件大小</th>
        <th>图像预览</th>
        <th>创建时间</th>
        <th>最后修改时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($dirs) || $dirs instanceof \think\Collection || $dirs instanceof \think\Paginator): $i = 0; $__LIST__ = $dirs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <tr>
        <td>
            <div style="display:flex;margin: 3px auto;">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="<?php echo $vo['icon']; ?>"></use>
                </svg>
                <?php echo !empty($vo['dir'])?'<a href="?dirname='.$vo['dirname'].'">'.$vo['name'].'</a>' : $vo['name']; ?>
            </div>
        </td>
        <td><?php echo changeSize($vo['size'],2); ?></td>
        <td><?php echo getpic($vo['dirname']); ?></td>
        <td><?php echo date("Y-m-d",$vo['ctime']); ?></td>
        <td><?php echo date("Y-m-d",$vo['mtime']); ?></td>
        <td>
            <?php if($vo['dir'] == '0'): ?>
            <button class="layui-btn layui-btn-normal layui-btn-sm edit" data-url="<?php echo urlencode($vo['dirname']); ?>">编辑
            </button>
            <?php endif; ?>
            <button class="layui-btn layui-btn-danger layui-btn-sm del" data-url="<?php echo urlencode($vo['dirname']); ?>">删除
            </button>
            <button class="layui-btn  layui-btn-sm rename" data-url="<?php echo urlencode($vo['dirname']); ?>"
                    data-name="<?php echo basename($vo['dirname']); ?>">重命名
            </button>
            <?php if($vo['dir'] == '0'): ?>
            <button class="layui-btn layui-btn-primary layui-btn-sm down" data-url="<?php echo urlencode($vo['dirname']); ?>">下载
            </button>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<div id="page"></div>
<script src="/static/admin/layui.js"></script>
<script src="/static/admin/js/iconfont.js"></script>

<script>
    layui.use(['element', 'layer', 'table', 'laypage'], function () {
        var table = layui.table
            , $ = layui.jquery
            , layer = layui.layer
            , laypage = layui.laypage;

        layer.photos({
            photos: '.layui-table'
            , anim: 0 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
        });
        function ajaxPost(url, data, m = null){
            $.post(url, data, function (res) {
                if (res.code == 1) {
                    m == null ? '' : layer.close(m);
                    layer.msg(res.msg, {icon:1,time:500}, function () {
                        location.reload();
                    });
                    //刷新父页面
                } else {
                    m == null ? '' : layer.close(m);
                    layer.msg(res.msg,{icon:5,time:1000},function () {});
                }
            }, 'json');
        }
        $('td img').hover(function () {
            var img = "<img class='img_msg' src='" + $(this).attr('src') + "' style='width:200px;' />";
            img_show = layer.tips(img, this, {
                tips: [2, 'rgba(200,200,200,.95)'],
                area: ['200px']
            });
        }, function () {
            layer.close(img_show);
        });

        $('td img').attr('style', 'max-width:70px');


        // 删除
        $('.del').click(function () {
            var url = "<?php echo url('file/del'); ?>";
            var data = $(this).data('url');
            layer.confirm('确认删除?', {icon: 3, title: '温馨提示'}, function (index) {
                var m = layer.msg('数据提交中，请稍候', {icon: 16, time: false, shade: 0.8});
                ajaxPost(url, {data:data}, m);
                layer.close(index);
            });

        });
        // 重命名
        $('.rename').click(function () {
            var url = "<?php echo url('file/rname'); ?>";
            var data = $(this).data('url');
            var oldName = $(this).data('name');
            layer.prompt({
                value: oldName,
                title: '请输入新文件名',
            }, function (value, index, elem) {
                var m = layer.msg('数据提交中，请稍候', {icon: 16, time: false, shade: 0.8});
                ajaxPost(url, {oldname: data, newname: value}, m);
                layer.close(index);
            });
            return false;


        });
        // 文件编辑
        $('.edit').click(function () {
            var data = $(this).data('url');
            var _url = "<?php echo url('file/edit'); ?>";
            var url = "<?php echo url('file/edit'); ?>" + '?file=' + data;
            $.get(_url, {file: data}, function (res) {
                if (res.code == 0) {
                    layer.msg(res.msg);
                } else {
                    layer.open({
                        title: '正在编辑：' + decodeURIComponent(data),
                        type: 2,
                        content: url,
                        maxmin: true,
                        area: ['60%', '90%'],
                        success: function (layero, index) {
                            var body = layer.getChildFrame('body', index);
                            var iframeWin = window[layero.find('iframe')[0]['name']];
                            body.find('#filename').val(data)
                        },
                    });
                }
            }, 'json');


            return false;
        });
        // 文件下载
        $('.down').click(function () {
            var url = "<?php echo url('file/down'); ?>";
            var data = $(this).data('url');
            $.post(url, {file: data}, function (res) {
                console.log(res);
                if (res.code == 0) {
                    layer.msg(res.msg);
                } else {
                    // 转换完成，创建一个a标签用于下载
                    var a = $("<a></a>");
                    $(a).attr('href', url + '?file=' + data);
                    $("body").append(a);  // 修复firefox中无法触发click
                    $(a)[0].click();
                    $(a).remove();
                }
            }, 'json');
        });
        // 分页设置
        laypage.render({
            elem: 'page'
            , count: '<?php echo $page["count"]; ?>'
            , limit: '<?php echo $page["limit"]; ?>'
            , curr: '<?php echo $page["curr"]; ?>'
            , layout: ['prev', 'page', 'next', 'skip']
            , jump: function (obj, first) {
                if (!first) {
                    location.href = '?dirname=<?php echo urlencode($path.DIRECTORY_SEPARATOR);?>&page=' + obj.curr;
                }
            }
        });
        // 刷新
        $('#refreshThis').click(function () {
            location.reload();
        });

    });
</script>
</body>
</html>