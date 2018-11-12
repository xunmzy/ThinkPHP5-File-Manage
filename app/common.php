<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


// 转换大小
function changeSize($size,$num = 0)
{
    $type = ['B','KB','MB','GB','TB'];
    $i = 0;
    for ($i; $size >= 1024; $i++){
        $size /= 1024;
    }
    return round($size,$num).$type[$i];// round四舍五入取值$num位小数
}

// 显示图片
function getpic($file,$height = 30)
{
    //$file = mb_convert_encoding(urldecode($file),'GB2312','UTF-8');
    $server = PHP_OS;
    //防止 有些中文windows或linux乱码
    if($server == "Linux"){
        $file = urldecode($file);// 有些会不支持iconv 换mb_convert_encoding函数
    }elseif($server == "WINNT"){
        $file = iconv('UTF-8','GB2312',urldecode($file));// 有些会不支持iconv 换mb_convert_encoding函数
    }else{
        $file = urldecode($file);
    }
    if($fileinfo = @getimagesize($file)){
        $filecontent = file_get_contents($file);
        $_b64 = chunk_split(base64_encode($filecontent));
        $pic = 'data:'.$fileinfo['mime'].';base64,'.$_b64;
        return "<img src='{$pic}' height='{$height}.px'>";
    }
    return '';
}
