# PHP_m3u8_Download
 PHP调用ffmpeg解析m3u8文件下载视频


----------

**注意，部署之前请确保你的服务器是Windows，下载m3u8视频的时候调用ffmpeg.exe这个程序解析下载**

和你所看到的一样,三个文件
其中有两个是必要的

 - m3u8_download.php
 - ffmpeg.exe
 - index.php

m3u8_download.php 封装了调用程序来下载视频的方法


index.php是一个最简单的调用这个类的方法演示，你下载是这个文件并不是必要,不过你可以参考这个文件，知道如何去调用

**使用方法：**

```php
<?php
include "m3u8_download.php";
try
{
//$mydown = new m3u8(@$_GET['url'],m3u8::getdir()."video\\6.mp4");
$mydown = new m3u8(@$_GET['url']);
$mydown ->setffmpeg(m3u8::getdir()."ffmpeg.exe");
$mydown->start();
}catch(Exception $e){
    var_dump($e->GetMessage());
    exit;
}
?>
```

首先要 引入脚本
再有就是将m3u8这个类实例化,需要传入两个参数

 - [url] 要下载的m3u8视频文件的链接,这个参数不能为空
 - [save] 下载后视频的保存绝对路径，或脚本的相对路径,这个参数可以为空

*如果保存路径为空 那么视频将下载到脚本所在的目录下,文件名为URL的md5值后缀为mp4*

调用类函数设置 ffmpeg.exe程序所在的服务器位置，不能填相对路径,如果该程序已经在系统的环境变量中,这里可以不设置
setffmpeg(string path);

脚本提供一个静态方法，以获取脚本所在的绝对路径
返回的路径最后包含\

    m3u8::getdir();
    //  C:\www\github\

最后调用类的start方法后开始解析下载,php会在后台允许,前台浏览器可以关闭网页,知道下载结束后 php的进程结束
