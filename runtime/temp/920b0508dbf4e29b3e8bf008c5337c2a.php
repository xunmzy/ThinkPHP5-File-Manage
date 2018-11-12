<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"/data/ww/public/../app/admin/view/index/index.html";i:1539733274;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>XunM内容管理系统</title>
    <link rel="stylesheet" href="/static/admin/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/global.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">XunM</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <div class="menu-toggle">
            <i class="layui-icon layui-icon-spread-left" aria-hidden="true"></i>
        </div>
        <ul class="layui-nav layui-layout-left">

            <li class="layui-nav-item"><a href="">控制台</a></li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    <?php echo \think\Session::get('user'); ?>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                    <dd><a href="<?php echo url('login/logout'); ?>">退出</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    <!--左侧导航start-->
    <div id="xunm-left-menu" class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree">

                <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="<?php echo $vo['icon']; ?>"></i> <?php echo $vo['title']; ?></a>
                    <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): if( count($vo['children'])==0 ) : echo "" ;else: foreach($vo['children'] as $key=>$vo1): ?>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" data-url="<?php echo url($vo1['name']); ?>" class="xunm-active"
                               data-type="tabAdd"><i class="<?php echo $vo1['icon']; ?>"></i> <?php echo $vo1['title']; ?></a></dd>
                    </dl>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>

                <!--<li class="layui-nav-item">-->
                    <!--<a href="javascript:;" data-url="<?php echo url('article/index'); ?>" class="xunm-active" data-type="tabAdd"><i class="layui-icon layui-icon-read"></i> 文章管理</a>-->
                <!--</li>-->
                <!--<li class="layui-nav-item">-->
                    <!--<a href="javascript:;">广告推广</a>-->
                    <!--<dl class="layui-nav-child">-->
                        <!--<dd><a href="javascript:;" data-url="./sys_ads.php" class="xunm-active"-->
                               <!--data-type="tabAdd">广告设置</a></dd>-->
                    <!--</dl>-->
                <!--</li>-->
                <!--<li class="layui-nav-item">-->
                    <!--<a href="javascript:;">缓存管理</a>-->
                    <!--<dl class="layui-nav-child">-->
                        <!--<dd><a href="javascript:;" data-url="./sys_cache.php" class="xunm-active" data-type="tabAdd">缓存设置</a>-->
                        <!--</dd>-->
                    <!--</dl>-->
                <!--</li>-->
                <!--<li class="layui-nav-item">-->
                    <!--<a href="javascript:;" data-url="<?php echo url('user/index'); ?>" class="xunm-active" data-type="tabAdd"><i class="layui-icon layui-icon-user"></i> 用户组管理</a>-->
                <!--</li>-->
                <!--<li class="layui-nav-item">-->
                    <!--<a href="javascript:;" data-url="<?php echo url('rule/index'); ?>" class="xunm-active" data-type="tabAdd"><i class="layui-icon layui-icon-auz"></i> 权限管理</a>-->
                <!--</li>-->
            </ul>
        </div>
    </div>
    <!--左侧导航end-->
    <!--右侧内容start-->
    <div id="right-body" class="layui-body layui-form">
        <div class="layui-tab xunm-tab" lay-filter="xunm-tab">
            <ul class="layui-tab-title">
                <li class="xunm-tab-index layui-this"><i class="layui-icon">&#xe68e;</i> 后台首页</li>
            </ul>
            <ul id="iframe-action" class="layui-nav iframe-action layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作<span
                            class="layui-nav-more"></span></a>
                    <dl class="layui-nav-child layui-anim layui-anim-upbit">
                        <dd class="layui-this"><a href="javascript:;" id="refreshThis" class="refresh refreshThis"><i
                                class="layui-icon"></i> 刷新当前</a></dd>
                        <dd><a href="javascript:;" id="closeTabOther" class="closeTabOther"><i
                                class="seraph icon-prohibit"></i> 关闭其他</a></dd>
                        <dd><a href="javascript:;" id="closeTabAll" class="closeTabAll"><i
                                class="seraph icon-guanbi"></i> 关闭全部</a></dd>
                    </dl>
                </li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe src="<?php echo url('home/index'); ?>" frameborder="0" scrolling="yes" class="xunm-ht-Index"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!--右侧内容end-->
    <!--底部start-->
    <div id="xunm-footer" class="layui-footer">
        &copy; ht.xunmzy.com - 寻梦影院后台管理系统
    </div>
    <!--右侧end-->
</div>
<div class="xunm-mask"></div>
<script src="/static/admin/layui.js"></script>
<script src="/static/admin/login.js"></script>
<script>
    var lay_filter = 'xunm-tab';
    //JavaScript代码区域
    layui.use('element', function () {
        var $ = layui.jquery,
            element = layui.element;
        var tab = {
            tabAdd: function (lay_filter_name, title, url, id) {
                //新增一个Tab项
                element.tabAdd(lay_filter_name, {
                    title: title, //tab标题
                    content: '<iframe tab-id="' + id + '" frameborder="0" src="' + url + '" scrolling="yes" class="xunm-ht-Index"></iframe>', //tab内容
                    id: id //tab的id
                });
            },
            //切换tab项
            tabChange: function (lay_filter_name, id) {
                element.tabChange(lay_filter_name, id);
            },
            //删除tab项
            tabDelete: function (lay_filter_name, id) {
                element.tabDelete(lay_filter_name, id); //删除
            }
        };
        $('.xunm-active').on('click', function () {
            var title = $(this).html() + '<i class="layui-icon layui-unselect layui-tab-close">&#x1006;</i>'; //添加删除按钮
            var id = $(".layui-side-scroll .layui-nav a").index($(this))+1;
            var url = $(this).attr('data-url');
            var li = $('.layui-tab-title li[lay-id="' + id + '"]').length;
            if (li <= 0) { //判断是否存在重复的lay-id不重复添加tab否则直接切换tab
                tab.tabAdd(lay_filter, title, url, id);
            }
            tab.tabChange(lay_filter, id);
        });
        $('.layui-tab-title').on('click', '.layui-tab-close', function () { //删除tab事件函数
            tab.tabDelete(lay_filter, $(this).parent("li").attr('lay-id'));
        });
        $('.menu-toggle').click(function () {
            if ($('#xunm-left-menu').css('width') == '0px') {
                //此处左侧菜单是隐藏状态，点击显示
                $('#right-body').animate({
                    left: '200px'
                });
                $('#xunm-footer').animate({
                    left: '200px'
                });
                $('#xunm-left-menu').animate({
                    width: '200px'
                });
                //点击显示后，判断屏幕宽度较小时显示遮罩背景
                if ($(window).width() < 768) {
                    $('.xunm-mask').show();
                    $('.xunm-mask').click(function () {
                        $('.xunm-mask').hide();
                        $('.menu-toggle').click();
                    });
                }
                return false;
            } else {
                //此处左侧菜单是显示状态，点击隐藏
                $('#right-body').animate({
                    left: '0'
                });
                $('#xunm-footer').animate({
                    left: '0'
                });
                $('#xunm-left-menu').animate({
                    width: '0'
                });
                $('.xunm-mask').hide();
                return false;

            }
        });

        //tab的操作
        $('#iframe-action dd a').click(function () {
            var _id = $(this).attr('id');
            var _this = $('.layui-show').children('iframe');
            var _class = _this.attr('tab-id');//获取iframe的tabid
            if (_id == 'refreshThis') {
                if (typeof(_class) == 'undefined') {
                    _class = '.' + _this.attr('class');
                } else {
                    _class = 'iframe[tab-id="' + _this.attr('tab-id') + '"]';
                }
                //刷新当前tab页面 iframe
                $(_class)[0].contentWindow.location.reload(true);
            } else if (_id == 'closeTabOther') {
                var lay_id_arr = $('.layui-tab-title li[lay-id]'),
                    lay_id_count = lay_id_arr.length;//获取tab打开的数量
                $.each(lay_id_arr, function (k, v) {
                    //循环删除tab
                    var _layid = $(v).attr('lay-id');//获取tab标题的layid
                    if (_layid != _class) {
                        tab.tabDelete(lay_filter, $(v).attr('lay-id'));
                    }
                });
            } else if (_id == 'closeTabAll') {
                //关闭全部tab iframe
                var lay_id_arr = $('.layui-tab-title li[lay-id]'),
                    lay_id_count = lay_id_arr.length;//获取tab打开的数量
                $.each(lay_id_arr, function (k, v) {
                    //循环删除tab
                    tab.tabDelete(lay_filter, $(v).attr('lay-id'));
                });
            }

        });
    });
</script>
</body>

</html>
