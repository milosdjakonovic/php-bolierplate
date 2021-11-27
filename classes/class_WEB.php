<?php

if(!defined('APP_ROOT')){
    die('No direct access.' . PHP_EOL);
}
/*
class WEB{
    public static $html;
    public static function headers($h){
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
            foreach($data as $field){
                //str_replace_a
            }
        }
        self::$html .= $content;
    }
}
*/

/*
// WEB::headers();            // Default, text/html 
WEB::headers('plain');     // text/plain utf8
WEB::headers('json');      // Json utf8

WEB::loadTemplatePart('path/to/file', [
    'toreplace1' => $replaceval1, # %toreplace1%
    'toreplace2' => $replaceval2
    ]
);

register_shutdown_function(function(){
    echo WEB::$html;
});
*/