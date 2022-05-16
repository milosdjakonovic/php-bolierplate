<?php

if(!defined('APP_ROOT')){
    die('No direct access.' . PHP_EOL);
}

class WEB{

    // Output var
    public static $html;

    /**
     * Set Content-Type header:
     * @param $h
     *  no arg   - text/html; charset=utf-8
     *  `plain`  - text/plain; charset=utf-8
     *  `json`   - application/json; charset=utf-8
     *  `xml`    - application/xml; charset=utf-8
     */
    public static function ContentType($h=null){
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
    /**
     * Add to output template from $path, with optional symbol-value replacement.
     * Symbol should be in format %alphanumericstring%
     * all occurences in the template shall be replaced.
     * @param $path | string | a path to the template
     * @param $data | associative array of symbols and values.
    **/
    public static function templateFromFile($path, $data=false){
        if(!file_exists($path)|| !is_readable($path)){
            error_log('CLI::templateFromFile cannnot read the file specified');
            return false;
        }
        $content = file_get_contents($path);
        if($data){
            foreach($data as $key => $value){
                $content = str_replace('%' . $key . '%', $value, $content);
            }
        }
        self::$html .= $content;
    }

    /**
     * Add $content to the output
     * @param $content | string
    **/
    public static function add($content){
        self::$html .= $content;
    }

    public static function dbg($value){
        self::$html .= '<style>';
        self::$html .= <<<DDD
pre.dbg9y8f{
    font-family: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;padding: 0.2rem 0.4rem;
    font-size: 87%;
    color: #fff;
    background-color: #212529;
    border-radius: 0.2rem;
    display:block;
    width:100%;
    padding: .87rem;
    margin: .87rem;
    overflow-x:scroll;
    position:relative;
    z-index:999 !important;
}
DDD;
        self::$html .= '</style>';
        self::$html .= 
        '<pre class=\'dbg9y8f\'>';
        self::$html .= print_r($value, 1);
        self::$html .= '</pre>';
    }

}

register_shutdown_function(function(){
    ob_clean();
    ContentType();
    echo WEB::$html;
});
