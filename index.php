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