<?php

if(!defined('APP_ROOT')){
    die('No direct access.' . PHP_EOL);
}

class WEB{
    public static $html;
    public static function headers($h=null){
        if($h === 'plain'){
            header('Content-Type: text/plain; charset=utf-8');
        } elseif('json'){
            header('Content-Type: application/json; charset=utf-8');
        } elseif('xml'){
            header("Content-Type: application/xml; charset=utf-8");
        } else {
            header('Content-Type: text/html; charset=utf-8');
        }
    }
    public static function loadTemplatePart($path, $data=false){
        if(!file_exists($path)|| !is_readable($path)){
            error_log('CLI::loadTemplatePart cannnot read the file specified');
            return false;
        }
        $content = file_get_contents($path);
        if($data){
            foreach($data as $key => $value){
                $content = str_replace('%' . $key . '%', $value, $content);
            }
        }
        self::$html .= $content;
        register_shutdown_function(function(){
            echo self::$html;
        });
    }
}


