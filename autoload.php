<?php
spl_autoload_register(function ($cname) {
    $file = __dir__ . "/classes/".$cname.".php";
    if(file_exists($file)){
    	include $file;
    }else{
    	throw new Exception("Unable to load file");
    }
});
?>