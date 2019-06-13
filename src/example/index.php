<?php

namespace Joey\PiecedImg\example;
require "../../vendor/autoload.php";

use Joey\PiecedImg\drive\Img;
use Joey\PiecedImg\drive\PiecedImg;
use Joey\PiecedImg\drive\Text;

//合成一个文字
$font = __DIR__ . "/ttf/MSYH.TTC";//字体的路径这里要用绝对路径
$nickname = Text::marginTop(20)//上边距20
->align(Text::ALIGN_CENTER)//水平居中
->vertical(Text::ALIGN_START)//垂直 向上
->build("袅袅", $font);

//合成一个头像
$avatar = Img::align(Img::ALIGN_CENTER)//水平居中
->vertical(Img::ALIGN_START)//垂直 向上
->margin(80)//上下左右边距30
->build("img/avatar.jpg");//需要合成照片的地址

//输出到浏览器
header("Content-type : image/png");
PiecedImg::backgroundImage("img/background.png")
    ->merge($nickname)//拼凑 昵称
    ->merge($avatar)//拼凑 头像
    ->writeString();//输出到浏览器

//如果需要保存则 writeSave($path),参数为保存路径