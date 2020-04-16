<?php
class m3u8 {
    public $url;//m3u8文件URL
    public $ffmpeg;//请指定ffmpeg.exe程序所在的位置,如果在环境变量中可留空
    public $save;//下载后的保存路径,请填写绝对路径和保存的文件名
    public static $info = "该文件程序只能在Windowns系统上运行,请在\$ffmpeg变量中指定ffmpeg.exe程序位置";
    
    function __construct($_url,$_save=null){
        if(empty($_url)){
            throw new Exception("没有指定URL.这是不允许的");
        }
        
        $this->url = $_url;
        $this->save = $_save;
    }
    
    function start(){
        ignore_user_abort(true); // 后台运行
        ini_set("max_execution_time", 0);
        set_time_limit(0); // 取消脚本运行时间的超时上限
        error_reporting(E_ALL);

        if($this->save == null){//如果没有填保存路径
            $this->save = static::getdir().md5($this->url).".mp4";
        }elseif(strpos($this->save,":") == 1){//如果是全路径
            
        }elseif(strpos($this->save,"\\")!==false){
            $p = $this->save;
            $this->save = static::getdir().$p;
        }

        if(empty($this->ffmpeg)){
            $this->ffmpeg = "ffmpeg.exe";
        }
        
        $this->downvideo($this->url,$this->save);
    }
    
    
    
    //设置程序路径
    function setffmpeg($path){
        $this->ffmpeg = $path;
    }
    
    function downvideo($_url,$_save){
        $cmd = "start {$this->ffmpeg} -i \"{$_url}\" -c copy -bsf:a aac_adtstoasc {$_save}";
        system($cmd);
    }
    
    //获取脚本所在目录 最后包括[\]
    public static function getdir(){
        $dir = $_SERVER['PATH_TRANSLATED'];
        return substr($dir,0,strrpos($dir,"\\")+1);
    }

}