<?php

if(!defined('APP_ROOT')){
    die('No direct access.' . PHP_EOL);
}

class LOG{
    public function __construct(){
        $errmsg = 'Cannot log - check directory or file permissions.' . eol;
        if(!file_exists(LOGDIR . DS . 'app.log')){
            $t = touch( LOGDIR . DS . 'app.log' );
            if(!$t){
                die($errmsg);
            }
        }
        if(!is_writable(LOGDIR . DS . 'app.log')){
            die($errmsg);
        }
    }
    /**
     * 
     * Writes a log entry
     * @argument $string | string | text to log
     * Usage:
     * LOG::do('some message to be logged.');
     * 
     */
    public static function do($string){
        file_put_contents(LOGDIR . DS . 'app.log',
        date('d.m.Y H:i:s') . ': ' . $string . eol,
        FILE_APPEND);
    }
}

call_user_func(function(){
    $log = new LOG;
    $log = null;
});
